// pages/historyGradeStaff/historyGradeStaff.js
var util = require('../../utils/util.js');
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var TIME = util.formatTime(new Date());
    console.log(options);
    that.getperformanceinfo(options);
    this.setData({
      datainfo: options,
      Datetime: TIME.substring(0, 10),
    });
  },

  getperformanceinfo: function (data) {
    var that = this;
    var url = "http://api.ispa.local/api/Performance/performanceInfo";
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        performance: res
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },

  bindEndDateChange: function (e) {
    console.log(e);

    this.setData({
      Datetime: e.detail.value
    })
  },
  getperformance: function (e) {
    var that = this;
    var time = e.currentTarget.dataset.time
    var bid = e.currentTarget.dataset.bid;
    var role = e.currentTarget.dataset.role;
    var data = {
      bid: bid,
      role: role,
      time: time
    }
    that.getperformanceinfo(data);
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