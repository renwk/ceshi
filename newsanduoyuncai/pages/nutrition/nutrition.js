// pages/nutrition/nutrition.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        userinfo: '',
        report_id:'',
        nutrition:'',
        user_info:'',
        trade_state:'',
        noRecipe:''
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var that = this;
        that.setData({
            userinfo: app.globalData.userInfo,
            report_id:options.report_id
        },function(){
          that.getNutritionInfo();
        })
    },
    /**
     * 获取营养报告首页信息
     */
    getNutritionInfo:function () {
        var that = this;
        var data = {report_id: that.data.report_id};//要传的数组对象
        var url = app.globalData.url+'Nutrition/index';
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {
            that.setData({
                user_info:res.userinfo,
                nutrition:res.nutrition,
                trade_state:res.trade_state,
                report_id:res.inspectId,
                noRecipe:res.noRecipe
            })
            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
        return false;
    },
    /**
     * 历史消息
     */
    toHistory:function () {
        let that = this;
        wx.navigateTo({
            url: '../history/history?report_id=' + that.data.report_id
        })
    },
    /**
     * 定制专属食材
     * @param options
     */
    customIngredients:function (options) {
        var report_id = options.currentTarget.dataset.inspectid;
        var noRecipe = options.currentTarget.dataset.norecipe;
        if(noRecipe == 1){
            wx.navigateTo({
                url: '../custom/custom?report_id=' + report_id
            })
        }else{
            wx.navigateTo({
                url: '../norecipe/norecipe?report_id=' + report_id
            })
        }

    },
    /**
     * 了解全面身体状况
     * @param options
     */
    comprehensive:function (options) {
        var report_id = options.currentTarget.dataset.inspectid;
        var trade_state = options.currentTarget.dataset.trade_state;
        if (trade_state == 'SUCCESS') {
            wx.navigateTo({
                url: '../circle/circle?report_id=' + report_id,
            })
        } else {
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