// pages/orderdetails/orderdetails.js

const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
      state:true,
  },
  settlement_info:function () {
    console.log(this.data.state);
    var that = this;
    if (that.data.state){
      that.setData({
        state :false
      })
    }else{
      that.setData({
        state: true
      })
    }
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var oid = options.oid;
    var type = 'consume'
    var data = {oid : oid , type:type}
    that.getOrderDetails(data);
  },

  getOrderDetails: function(data){
    console.log(data);
    var that = this;
    var url = "https://api.user.ispa.cn/Orderinfo/getOrderDetails";
    app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          orderdetails: res
       }, function () {
         wx.hideLoading();
       })
     }).catch((errMsg) => {
       util.showError(errMsg)
      wx.hideLoading();
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