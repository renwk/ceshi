// pages/couponpay/couponpay.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        report_id: '',
        couponCode:'',
        showDialog: false,//是否弹出代金券
        showCenterDialog: false,//是否弹出优惠券
        vouchers_show: true,//是否显示代金券按钮()
        vouchers_money: 0,//代金券选择后金额
        coupontrue_height: 0,
        testFee: 0,//检测费用
        actualCost: 0,//真实费用
        couponTrue_money:0,//优惠券金额
        couponTrueSelectId:'',//优惠券id
        couponTrueMoneyShow:true,//是否展示优惠券数量
        couponTrueMoney:0//优惠券选择后金额
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var that = this;
        that.setData({
            report_id:options.report_id
        },function () {
            that.reportSummary();
            that.getCouponTrueList();
        });

    },

    /**
     * 显示弹窗
     * @param e
     */
    onClickButton: function (e) {
        let that = this;
        switch (e.currentTarget.dataset.index) {
            case '0':
                that.setData({
                    showDialog: !this.data.showDialog
                });
                break;
            case '1':
                that.setData({
                    showCenterDialog: !this.data.showCenterDialog
                });
                break;
        }
    },
    /**
     * 关闭底部弹窗
     */
    onClickdiaView: function () {
        var that = this;
        that.setData({
            showDialog: !that.data.showDialog
        });
    },
    /**
     * 点击按钮关闭底部弹窗并清空选中列表
     */
    onClickCouponTrueView:function () {
            let that = this;
            that.onClickdiaView();
            that.clearCouponTrueCurr();

    },
    /**
     * 关闭中间弹窗
     */
    onClickdiaCenterView: function () {
        this.setData({
            showCenterDialog: !this.data.showCenterDialog
        });
    },
    onClickCouponView:function () {
      let that = this;
      that.setData({
          couponCode:''
      },function () {
          that.onClickdiaCenterView();
      })
    },
    /**
     * 获取支付信息
     */
    reportSummary: function () {
        var that = this;
        var data = {report_id: that.data.report_id};//要传的数组对象
        var url = app.globalData.url + 'Pay/testProfile';
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {
            that.setData({
                testFee:res.total_fee,
                actualCost:res.total_fee,
            },function () {
                wx.hideLoading();
            })
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
    },
    /**
     * 获取代金券内容
     */
    setCouponCode: function (e) {
        this.setData({
            couponCode: e.detail.value
        });
    },
    /**
     * 提交代金券码,验证代金券
     */
    submitCouponCode: function () {
        //this.data.couponCode
        var that = this;
        if (this.data.couponCode) {
            var url = app.globalData.url + 'Coupon/checkCouponCode';
            var data = {
                code: that.data.couponCode
            };
            wx.showLoading({
                title: '加载中...',
            })
            app.post(url, data).then((res) => {
                if (res.msg == 'success') {
                    that.setData({
                        vouchers_money: res.data.money / 100,
                        vouchers_show: false
                    }, function () {
                        var testFee = that.data.testFee;
                        var couponTrueMoney = that.data.couponTrueMoney;
                        var vouchers_money = that.data.vouchers_money;
                        var money = (testFee - vouchers_money) >= 0 ? vouchers_money : testFee;
                        var over_money = (testFee-money) >= 0  ? (testFee-money) : '0.00';
                        over_money = over_money.toFixed(2);
                        that.setData({
                            vouchers_show:false,
                            vouchers_money:money
                        })
                        if(that.data.couponTrue_money > 0){
                            if(over_money - that.data.couponTrue_money /100 >= 0){
                                var reduction_money = that.data.couponTrue_money / 100;
                            }else{
                                var reduction_money = (that.data.couponTrue_money / 100 - (that.data.couponTrue_money / 100 - over_money));
                            }
                            over_money = (over_money - reduction_money) >= 0 ? (over_money - reduction_money) : 0;
                            over_money = over_money.toFixed(2);
                            if(reduction_money > 0){
                                that.setData({
                                    couponTrueMoney:reduction_money.toFixed(2)
                                })
                            }else{
                                that.clearCouponTrueCurr();
                                that.setData({
                                    couponTrueMoneyShow:true,
                                    couponCount:that.data.couponCount,
                                    couponTrueSelectId:null
                                })
                            }
                        }
                        that.setData({
                            actualCost:over_money
                        })
                        that.onClickdiaCenterView();
                    })

                } else {
                    util.showError(res.data);
                }
                wx.hideLoading();
            }).catch((errMsg) => {
                util.showError(errMsg);
                wx.hideLoading();
            });
            return false;
        } else {
            util.showError('代金券码为空');
        }

    },
    /**
     * 选择使用优惠券
     */
    selectedCouponTrue: function (evet) {
        var that = this;
        var id = evet.currentTarget.dataset.id;
        var curr_status = evet.currentTarget.dataset.curr;
        var couponTrueList = that.data.couponTrueList;
        if(id){

            for (let i = 0 ;i<couponTrueList.length;i++){
                var curr = 'couponTrueList['+i+'].id';

                if(couponTrueList[i].id == id){
                    if(curr_status){
                        that.data.couponTrueList[i].curr = false;
                    }else{
                        that.data.couponTrueList[i].curr = true;
                    }
                }else{
                    that.data.couponTrueList[i].curr = false;
                }
            }
        }
        that.setData(this.data);
        if(curr_status){
            that.setData({
                couponTrueSelectId:null
            })
        }else{
            that.setData({
                couponTrueSelectId:id
            })
        }
    },
    /**
     * 获取优惠券列表
     * @returns {boolean}
     */
    getCouponTrueList: function () {
        var that = this;
        var url = app.globalData.url + "Coupon/getCouponTrueList";
        var data = {
            report_id:that.data.report_id
        };
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {
            if(res.msg == 'success'){
                that.setData({
                    couponTrueList:res.list,
                    couponCount:res.count
                },function () {

                })
            }else{

            }
            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
        return false;
    },
    /**
     * 确定选择优惠券
     */
    submitCouponTrue:function () {
      var that = this;
      var url = app.globalData.url+'Coupon/checkcouponsInfo';
      var data = {
            report_id:that.data.report_id,
            code:that.data.couponTrueSelectId
      };
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {
            (res);
            if(res.msg=='success'){
                var testFee = that.data.testFee;
                var couponTrue_money = res.data.money /100;
                var vouchers_money = that.data.vouchers_money;
                if(that.data.vouchers_money > 0){
                    testFee = testFee-that.data.vouchers_money;
                }
                var money = (testFee - couponTrue_money) >= 0 ? couponTrue_money : testFee;
                var over_money = (testFee - money) >= 0 ? (testFee - money) : '0.00';
                over_money = over_money.toFixed(2);
                that.setData({
                    couponTrue_money : couponTrue_money,
                    couponTrueMoney  : money.toFixed(2)
                })
                if(money > 0){
                    that.setData({
                        couponTrueMoneyShow:false
                    })
                }else{
                    that.clearCouponTrueCurr();
                    that.setData({
                        couponTrueMoneyShow:true,
                        couponCount:that.data.couponCount,
                        couponTrueSelectId:null
                    })
                }
                that.setData({
                    actualCost:over_money
                })
                that.onClickdiaView();
            }else{
                util.showError(res.data);
            }
            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
        return false;
      //var
    },
    clearCouponTrueCurr:function () {
        var that = this;
        var couponTrueList = that.data.couponTrueList;
        for (let i = 0 ;i<couponTrueList.length;i++){
            var curr = 'couponTrueList['+i+'].id';
            that.data.couponTrueList[i].curr = false;
        }
        that.setData(this.data);
    },
    /**
     * 最终支付
     */
    submitPay: function () {

        var that = this;
        if(that.data.actualCost > 0){
            wx.login({
                success: res => {
                    var code = res.code;
                    var url = app.globalData.url+'pay/wxAppPay';
                    var data = {
                        code: code,
                        report_id:that.data.report_id,
                        actualCost:that.data.actualCost,
                        couponCode:that.data.couponCode,
                        couponTrueSelectId:that.data.couponTrueSelectId
                    };
                    wx.showLoading({
                        title: '加载中...',
                    })
                    app.post(url, data).then((response) => {
                        var jsApiParameters = response.jsApiParameters;
                        if(response['jump'] == 1 && response['jump']){
                            wx.redirectTo({
                                url: '../circle/circle?report_id=' + that.data.report_id,
                            })
                        }else{
                            wx.requestPayment({
                                'timeStamp': jsApiParameters.timeStamp,
                                'nonceStr': jsApiParameters.nonceStr,
                                'package': jsApiParameters.package,
                                'signType': 'MD5',
                                'paySign': jsApiParameters.paySign,
                                'success':function(res){
                                    that.updateCoupon();
                                    wx.showToast({
                                        title: '支付成功'
                                    });
                                },
                                fail:function (res) {
                                }

                            });
                        }

                        wx.hideLoading();
                    }).catch((errMsg) => {
                        util.showError(errMsg);
                        wx.hideLoading();
                    });
                    return false;
                }
            })
        }else{
            that.updateCoupon();
        }


    },
    updateCoupon:function () {
        var that = this;
        var url = app.globalData.url+'pay/requestCouponPay';
        var data = {
            report_id:that.data.report_id,
            actualCost:that.data.actualCost,
            couponCode:that.data.couponCode,
            couponTrueSelectId:that.data.couponTrueSelectId
        };
        app.post(url, data).then((response) => {
            wx.redirectTo({
                url: '../circle/circle?report_id=' + that.data.report_id,
            })
        }).catch((errMsg) => {
            util.showError(errMsg);
        });
        return false;
    },
    /**
     * 生命周期函数--监听页面初次渲染完成
     */
    onReady: function () {

    },

    /**
     * 生命周期函数--监听页面显示
     */
    onShow: function () {

    },

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide: function () {

    },

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload: function () {

    },

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh: function () {

    },

    /**
     * 页面上拉触底事件的处理函数
     */
    onReachBottom: function () {

    },

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    }
})