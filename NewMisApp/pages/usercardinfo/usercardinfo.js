// pages/usercardinfo/usercardinfo.js
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
    console.log(options);
    var that = this;
    var data = {
      userid:options.userid
    }
    that.userDetail(data)
    that.setData({
      bid:options.bid
    })
  },
  userDetail: function (data) {
    var that = this;
    var url = "https:///Usercard/userDetail";//我的会员
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        userinfo: res
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },
  toorder: function (options){
    var that = this;
    wx.navigateTo({
      url: '../order/index?bid=' + options.currentTarget.dataset.toggle +'&role=users'
    })
  },
  tocardStored: function (options) {
    var that = this;
    wx.navigateTo({
      url: '../cardStored/cardStored?userid=' + options.currentTarget.dataset.toggle
    })
  }, 
  tocardNostorage: function(options) {
    console.log(options.currentTarget.dataset.toggle);
    var that = this;
    wx.navigateTo({
      url: '../cardNostorage/cardNostorage?userid=' + options.currentTarget.dataset.toggle
    })
  },
  tocardSpecial: function (options) {
    console.log(options.currentTarget.dataset.toggle);
    var that = this;
    wx.navigateTo({
      url: '../cardSpecial/cardSpecial?userid=' + options.currentTarget.dataset.toggle
    })
  },

  tocardCoupon: function (options) {
    console.log(options.currentTarget.dataset.toggle);
    var that = this;
    wx.navigateTo({
      url: '../cardCoupon/cardCoupon?userid=' + options.currentTarget.dataset.toggle
    })
  },
  tocardPower: function (options) {
    console.log(options.currentTarget.dataset.toggle);
    var that = this;
    wx.navigateTo({
      url: '../cardPower/cardPower?userid=' + options.currentTarget.dataset.toggle
    })
  },
  toSummaryNotes: function (options) {
    // console.log(this.data.bid);
    var bid = this.data.bid;
    var that = this;
    wx.navigateTo({
      url: '../summaryNotes/summaryNotes?userid=' + options.currentTarget.dataset.toggle+'&bid='+bid
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