// pages/custom/custom.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        report_id: '',
        inspectNameStr:'',
        recipe:'',
        trade_state:'',
        recipeUnusual:''
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var that = this;
        that.setData({
            report_id: options.report_id
        }, function () {
            that.getCustomInfo();
        })
    },
    getCustomInfo: function () {
        var that = this;
        var data = {report_id: that.data.report_id};//要传的数组对象
        var url = app.globalData.url + 'Nutrition/myRecipe';
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {
            that.setData({
                recipeUnusual: res.recipeUnusual,
                recipe: res.recipe,
                trade_state: res.trade_state,
                report_id: res.inspectId,
                inspectNameStr:res.inspectNameStr
            })
            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
        return false;
    },
    comprehensive:function (options) {
        var report_id = options.currentTarget.dataset.inspectid;
        var trade_state = options.currentTarget.dataset.trade_state;
        if(trade_state == 'SUCCESS'){
            wx.navigateTo({
                url: '../circle/circle?report_id=' + report_id,
            })
        }else{
            wx.navigateTo({
                url: '../pay/pay?report_id=' + report_id,
            })
        }
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