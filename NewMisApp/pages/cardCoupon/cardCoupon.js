// pages/cardCoupon/cardCoupon.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    onnum:'',
    usenum:'',
    expirednum:'',
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var data = {
      userid: options.userid
    }
    that.mycoupon(data)
    
  },
  mycoupon: function (data) {
    var that = this;
    var url = "https:///Usercard/mycoupon";//礼券卡
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        coupon: res,
        onnum:res.num.on,
        usenum:res.num.use,
        expirednum: res.num.expired
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