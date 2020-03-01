// pages/usercard/usercard.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    slidownKey: 2,
    init: true,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    console.log(options)
    var that=this;
    var data = {
      bid: options.userid,
      sname:options.sname,
      type:options.type
    }
    that.userlist(data);
    that.storelist();
    that.setData({
      sname:options.sname,
      bid: options.userid,
      type:options.type
    })
  },
  toDropdown: function (e) {
    
    var that = this;
    let slidownKey = e.currentTarget.dataset.slidownkey;
    if (slidownKey == 1) {//开启状态 需要关闭
      that.setData({
        slidownKey: 2
      })
    } else {
      that.setData({
        slidownKey: 1
      })
    }
  },
  selectTrue:function(e){
    this.setData({
      slidownKey:2,
      sname: e.currentTarget.dataset.selected_value
    })
  },
  formSubmit:function (e) {//查询
    var that = this;
    var data={
      sname: e.detail.target.dataset.sname,
      bid: e.detail.target.dataset.bid,
      search: e.detail.value.search,
      type: e.detail.target.dataset.type
    }
    
    that.userlist(data);
  },

  toUserinfo: function (options){
    var that = this;
    wx.navigateTo({
      url: '../usercardinfo/usercardinfo?userid=' + options.currentTarget.dataset.uid + '&bid=' + that.data.bid
    })
  },
  bindPickerChange: function (e) {
    var that = this;
    that.setData({
      init: false,
      index: e.detail.value
    })
  },
  storelist:function () {
    var that = this;
    var data={};
    var url = "https:///Usercard/storelist";//门店列表
    app.post(url, data).then((res) => {
      that.setData({
        stores:res
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
  userlist: function (data) {
    var that = this;
    console.log(data)
    var url = "https:///Usercard/userlist";//我的会员
    app.post(url, data).then((res) => {
      that.setData({
        list:res
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