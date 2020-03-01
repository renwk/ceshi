// pages/login/login.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        year: new Date().getFullYear(),
        endyear: new Date().getFullYear(),
        curr: true,//true 顯示女，false顯示男
        sex: 2,//性别
        hideModal: true, //模态框的状态  true-隐藏  false-显示
        animationData: {},//用户须知动画
        canvasShow: false,//canvas状态 true-隐藏  false 显示
        verifyCode: '', //验证码
        captchaLabel: '发送验证码',
        seconds: util.length,
        captchaDisabled: false,
        phone: '',
        report_id:''
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var userinfo = app.globalData.userInfo;
        this.setData({
            userinfo: userinfo,
            curr: userinfo.gender == 1 ? false : true,
            sex: userinfo.gender,
            report_id:options.report_id
        });

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
    bindPhoneInput: function (e) {
        var that = this;
        var phone = e.detail.value;
        that.setData({
            phone: phone
        })

    },
    /**
     * 发送验证码
     * @param e
     */
    captcha: function (e) {
        var phone = util.checkPhone(this.data.phone);
        if (phone) {
            var param = {
                phone: phone
            };
            // 禁用按钮点击
            this.setData({
                captchaDisabled: true
            });
            // 立刻显示重发提示，不必等待倒计时启动
            this.setData({
                captchaLabel: util.length + 's'
            });
            // 启动以1s为步长的倒计时
            var interval = setInterval(() => {
                util.countdown(this);
            }, 1000);

            this.sendCode(phone);
            // 停止倒计时
            setTimeout(function () {
                clearInterval(interval);
            }, util.length * 1000);

        }

    },
    /**
     * 发送短信
     * @param phone
     * @returns {boolean}
     */
    sendCode: function (phone) {
        var that = this;
        var url = app.globalData.url+'Sms/authentication';
        var data = {
            report_id: that.data.report_id,
            unionid:app.globalData.unionid,
            mobile: phone
        };
        app.post(url, data).then((res) => {
            if (res.msg != 'success') {
                wx.showToast({
                    title: '发送失败'
                });
            }
        }).catch((errMsg) => {
            util.showError(errMsg);
        });
        return false;
    },
    /**
     * 輸入验证码
     * @param e
     */
    bindCodeInput: function (e) {
        var that = this;
        var verifyCode = e.detail.value;
        that.setData({
            verifyCode: verifyCode
        })
    },
    /**
     * 性別更換
     * @param e
     */
    changeSex: function (e) {
        var that = this;
        let sex = e.currentTarget.dataset.sex;
        if (sex == 1) {
            that.setData({
                curr: false,
                sex: 1
            })
        } else if (sex == 2) {
            that.setData({
                curr: true,
                sex: 2
            })
        }
    },
    /**
     * 年份選擇
     * @param e
     */
    bindYearsChage: function (e) {
        let that = this;
        let year = e.detail.value;
        that.setData({
            year: year
        })

    },
    submitUserInfo: function () {
        var that = this;
        var phone = that.data.phone;
        var sex = that.data.sex;
        var year = that.data.year;
        var verifyCode = that.data.verifyCode;
        phone = util.checkPhone(phone);
        if (phone.length != 11) {
            util.showError('请输入正确的手机号码');
        } else if (verifyCode.length == 0 || verifyCode.length < 4) {
            util.showError('请输入正确的验证码');
        } else if (sex.length == 0) {
            util.showError('请选择性别');
        } else if (year.length == 0) {
            util.showError('请选择出生年份');
        }
        var url = app.globalData.url+'central/requestLogin';
        var data = {
            report_id : that.data.report_id,
            mobile:phone,
            openid:app.globalData.openid,
            checkcode:verifyCode,
            sex:sex,
            birthday:year,
            headimgurl:that.data.userinfo.avatarUrl,
            nickname:that.data.userinfo.nickName,
            unionid:app.globalData.unionid
        }
        app.post(url, data).then((res) => {
            if(res.msg == 'success' ){
                var report_id = res.report_id;
                wx.showToast({
                    title:'注册成功',
                    complete:function(){
                        if(res.total_fee > 0){
                            if(res.show_type == 1){
                                //进入营养页面
                                wx.redirectTo({
                                    url: '../nutrition/nutrition?report_id=' + re.report_id,
                                })
                            }else{
                                if(res.trade_state == 'SUCCESS'){
                                    wx.redirectTo({
                                        url: '../circle/circle?report_id=' + report_id,
                                    })
                                }else{
                                    //跳转支付页面
                                    wx.redirectTo({
                                        url: '../pay/pay?report_id=' + report_id,
                                    })
                                }
                            }

                        }else{
                            that.updateReportPaymentStatus(report_id,res.show_type,res.trade_state);
                        }


                    }
                })
            }
        }).catch((errMsg) => {
            util.showError(errMsg);
        });
        return false;

    },
    updateReportPaymentStatus:function(report_id,show_type,trade_state){
        var that = this;
        var data = {report_id: report_id};//要传的数组对象
        var url = app.globalData.url + 'Pay/requestCouponPay';
        app.post(url, data).then((res) => {
            if(res.msg == 'success'){
                if(show_type == 1){
                    //进入营养页面
                    wx.redirectTo({
                        url: '../nutrition/nutrition?report_id=' + report_id,
                    })
                }else{
                    if(trade_state == 'SUCCESS'){
                        wx.redirectTo({
                            url: '../circle/circle?report_id=' + report_id,
                        })
                    }else{
                        wx.redirectTo({
                            url: '../pay/pay?report_id=' + report_id,
                        })
                    }

                }

            }else{
                util.showError(res.msg);
            }
            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
    },
    // 显示遮罩层
    showModal: function () {
        var that = this;
        that.setData({
            hideModal: false,
            canvasShow: true
        })
        var animation = wx.createAnimation({
            duration: 600,//动画的持续时间 默认400ms   数值越大，动画越慢   数值越小，动画越快
            timingFunction: 'ease',//动画的效果 默认值是linear
        })
        this.animation = animation
        setTimeout(function () {
            that.fadeIn();//调用显示动画
        }, 200)
    }
    ,
// 隐藏遮罩层
    hideModal: function () {
        var that = this;
        var animation = wx.createAnimation({
            duration: 600,//动画的持续时间 默认400ms   数值越大，动画越慢   数值越小，动画越快
            timingFunction: 'ease',//动画的效果 默认值是linear
        })
        this.animation = animation
        that.fadeDown();//调用隐藏动画
        setTimeout(function () {
            that.setData({
                hideModal: true,
                canvasShow: false
            })
        }, 200)//先执行下滑动画，再隐藏模块

    }
    ,
    //动画集
    fadeIn: function () {
        this.animation.translateY(0).step()
        this.setData({
            animationData: this.animation.export()//动画实例的export方法导出动画数据传递给组件的animation属性
        })
    }
    ,
    fadeDown: function () {
        this.animation.translateY(1000).step()
        this.setData({
            animationData: this.animation.export(),
        })
    }
    ,
    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide: function () {

    }
    ,

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload: function () {

    }
    ,

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh: function () {

    }
    ,

    /**
     * 页面上拉触底事件的处理函数
     */
    onReachBottom: function () {

    }
    ,

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    }
})