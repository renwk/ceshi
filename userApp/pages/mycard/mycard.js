// pages/mycard/mycard.js
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
    var that = this
    console.log(options);
    var data = {
      uid : options.uid,
      state:'all'
    }
    that.getlist(data);
    that.setData({
        uid : options.uid,
    })
  },
  getlist:function (data) {
      var that = this;
      var url = "https://api.user.ispa.cn/card/index";
      app.post(url, data).then((res) => {
          console.log(res);
          that.setData({
              cardlist: res
          }, function () {
              wx.hideLoading();
          })
      }).catch((errMsg) => {
          util.showError(errMsg)
          wx.hideLoading();
      });
  },
  tabChange:function (e) {
      var that=this;
      var state = '';
      if(e.detail.idx == 1){
          state = 'normal';
      }else if(e.detail.idx ==2){
          state = 'frozen';
      }else{
          state = 'all';
      }
      var data={
          uid:e.detail.infoid,
          state:state
      }
      that.getlist(data);
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