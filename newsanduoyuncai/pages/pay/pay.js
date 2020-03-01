// pages/pay/pay.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        report_id: '',
        userinfo: '',
        targetUnusual:{
            level_3:0,
            level_2:0,
            level_1:0,
        }
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var that = this;
        this.setData({
            report_id: options.report_id,
            userinfo: app.globalData.userInfo
        }, function () {
            that.reportSummary();
        })
    },
    reportSummary: function () {
        var that = this;
        var data = {report_id: that.data.report_id};//要传的数组对象
        var url = app.globalData.url + 'Pay/testProfile';
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {
            if(res.total_fee>0){
                that.setData({
                    total_fee:res.total_fee,
                    targetUnusual:res.targetUnusual
                })
                wx.hideLoading();
            }else{
                that.updateReportPaymentStatus();
            }

        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
    },
    updateReportPaymentStatus:function(){
        var that = this;
        var data = {report_id: that.data.report_id};//要传的数组对象
        var url = app.globalData.url + 'Pay/requestCouponPay';
        app.post(url, data).then((res) => {
            if(res.msg == 'success'){
                wx.redirectTo({
                    url: '../circle/circle?report_id=' + that.data.report_id,
                })
            }else{
                util.showError(res.msg);
            }
            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
    },
    /**
     * 去支付
     */
    goToPay:function(){
        //跳转注册页面
        wx.navigateTo({
            url: '../couponpay/couponpay?report_id=' + this.data.report_id,
        })
    },
    toHistory:function(){
        let that = this;
        wx.navigateTo({
            url: '../history/history?report_id=' + that.data.report_id
        })
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