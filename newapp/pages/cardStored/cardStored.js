// pages/cardStored/cardStored.js
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
    init:true
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that=this;
    console.log(options);
    var data = {
      userid:options.userid
    }
    that.usercardInfo(data)
  },
  bindPickerChange: function (e) {
    var that=this;
    var card = this.data.cardInfo[e.detail.value].mycardid;
    console.log(card);
    var carddata={
      card:card
    }
    that.setData({
      init:false,
      index: e.detail.value
    })
    that.mycardinfo(carddata);
  },

  usercardInfo: function (data) {
    var that = this;
    var url = "https://api.ispa.cn/Usercard/usercardInfo";//我的储值卡
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
  mycardinfo: function (data) {
    var that = this;
    var url = "https://api.ispa.cn/Usercard/requestMycardinfo";//储值卡详情
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        mycard_info: res.mycard_info,
        mycard_log: res.mycard_log
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


})