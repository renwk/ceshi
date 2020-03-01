// pages/info/info.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
      userInfo:{},
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    console.log(options);
    this.getdatainfo(options);
  },
  getdatainfo: function (e){
    var that = this;
    var openid = e.userid;
    wx.request({
      url: 'http://api.ispa.local/api/ApiIndex/info',//给函数传递服务器地址参数 
      data: {
        openid: openid,
      },//给服务器传递数据，本次请求不需要数据，可以不填
      header: {
        'content-type': 'application/json' // 默认值，返回的数据设置为json数组格式
      },
      success: function (res) {
        console.log(res)
        if(res.data.msg == 'success'){
          that.setData({
            userInfo: res.data
          })
        }else{
          wx.showModal({
            title: '提示',
            content: res.msg,
            showCancel: false
          })
        }
        
      },
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