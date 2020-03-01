// pages/info/info.js
const app = getApp()
const util = require('../../utils/util.js');
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
    var openid = e.openid;
    wx.request({
      url: 'Index/info',//给函数传递服务器地址参数
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
    upuser:function (e) {
        var that = this;
        wx.showModal({
            title: '提示',
            content: '确定退出',
            success: function (res) {
                if (res.confirm) {
                    var appopenid = e.currentTarget.dataset.toggle;
                    var data = { appopenid: appopenid }
                    that.deluser(data);
                } else {
                    console.log(that.data);
                    console.log('弹框后点取消了')
                }
            }
        })
    },
    deluser: function (data) {
        var that = this;
        var url = "Index/deluser";
        app.post(url, data).then((res) => {
            that.setData({
        }, function () {
            util.showError(res);
            wx.hideLoading();
            wx.navigateTo({
                url: '../login/login?openid=' + that.data.userInfo.data.appopenid
            })
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