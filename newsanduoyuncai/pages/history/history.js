// pages/history/history.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        report_id: '',
        reportList: {}
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        var that = this;
        that.setData({
            report_id: options.report_id
        }, function () {
            that.getHistoryInfo();
        })
    },
    /**
     * 获取历史数据
     */
    getHistoryInfo: function () {
        var that = this;
        var data = {inspectId: that.data.report_id};//要传的数组对象
        var url = app.globalData.url + 'Inspectresultbaseinfo/requestToHistoryReport';
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {
            console.log(res);
            if (res.msg == 'success') {
                that.setData({
                    reportList:res.data
                })
            } else {
                util.showError('获取信息失败，请返回上级页面重新操作');
            }
            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
        return false;
    },
    toHomePage:function (options) {
        var that = this;
        var report_id = options.currentTarget.dataset.report_id;
        var show_type = options.currentTarget.dataset.show_type;
        var trade_state = options.currentTarget.dataset.trade_state;
        if(report_id){
            if(show_type == 1){
                wx.navigateTo({
                    url: '../nutrition/nutrition?report_id=' + report_id,
                })
            }else if(show_type == 2){
                if(trade_state == 'SUCCESS'){
                    wx.navigateTo({
                        url: '../circle/circle?report_id=' + report_id,
                    })
                }else{
                    wx.navigateTo({
                        url: '../pay/pay?report_id=' + report_id,
                    })
                }

            }

        }else{
            util.showError('报告信息获取失败');
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