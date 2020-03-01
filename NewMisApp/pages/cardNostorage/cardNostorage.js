// pages/cardNostorage/cardNostorage.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    cardInfo: {},
    mycard_info: {},
    mycard_log: {},
    index: 1,
    init: true
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    console.log(options);
    var data = {
      userid:options.userid
    }
    that.mycourse(data)
  },
  bindPickerChange: function(e){
    var that=this;
    var card = this.data.cardInfo[e.detail.value].mycardid;
    console.log(card);
    var carddata = {
      card: card
    }
    that.setData({
      init: false,
      index: e.detail.value
    })
    that.courseinfo(carddata);
  },


  mycourse: function (data) {
    var that = this;
    var url = "https:///Usercard/mycourse";//我的会员
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        cardInfo: res
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },
  courseinfo: function (data) {
    var that = this;
    var url = "https:///Usercard/requestMycourse";//储值卡详情
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        mycourse_info: res.mycourse_info,
        mycourse_log: res.mycourse_log
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