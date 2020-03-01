// pages/orderRecharge/orderRecharge.js
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
    console.log(options);
    var data={
      ordercode:options.order_code,
    }
    that.chargeOrderDetail(data)
  },

  chargeOrderDetail: function (data) {
    var that = this;
    var url = "https:///order/chargeOrderDetail";//充值订单详情
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        order: res
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      wx.showModal({
        title: '提示',
        content: errMsg,
        showCancel: false
      })
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