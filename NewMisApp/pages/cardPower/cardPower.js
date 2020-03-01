// pages/cardPower/cardPower.js
const app = getApp()
const util = require('../../utils/util.js');
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
    var that=this;
    console.log(options.userid);
    var data={
      userid: options.userid
    }
    that.gettitleCard(data);
  },

  gettitleCard: function (data) {
    var that = this;
    var url = "https://api.ispa.cn/Usercard/titleCard";//我的会员
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        mycourse_info: res.mycourse_info
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
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