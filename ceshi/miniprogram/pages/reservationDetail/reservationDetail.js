// miniprogram/pages/reservationDetail/reservationDetail.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
      list:{},
      role:'',
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

    var that = this;
    var url = "http://api.ispa.local/api/Bespeakorder/bespeakInfo";
    var data = {
      ordercode: options.id,
    }
    app.post(url, data).then((res) => {
      console.log(options.role);
      that.setData({
        list: res,
        role:options.role,
      }, function () {
        wx.showModal({
          title: '提示',
          content: res.msg,
          showCancel: false
        })
        wx.hideLoading();
      })






    })
    .catch((errMsg) => {
      // util.showError(errMsg);
      
      
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