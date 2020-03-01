// pages/beauticiansort/oneBidInfo.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        overtimeInitDate: util.formatMonth(new Date()),
        plInitDate: util.formatMonth(new Date()),
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
      var that = this;
        console.log(options);
        
        var postdata={
            bid:options.userid,
            role:options.role
        }
      that.requestBidOverTime(postdata);
        that.setData({
          role: postdata.role,
          infoid: postdata.bid
        })
    },
    onReady: function () {
      this.tabs = this.selectComponent("#tabs");
    },
    tabChange: function (e) {
      var that = this;
      console.log(e.detail);

      if (e.detail.idx == 0) { //加班
        var data = {
          bid: e.detail.infoid,
          role: e.detail.role
        }
        that.requestBidOverTime(data);
      } else if (e.detail.idx == 1){ // P/L
        var data = {
          bid: e.detail.infoid,
          role: e.detail.role
        }
        that.requestBidLeaveTime(data);
      }
    },
    formSubmit:function (e) {//加班查询
      var that = this;
      console.log(e);
      var data={
        role: e.detail.target.dataset.role,
        bid: e.detail.target.dataset.bid,
        date:e.detail.value.timedate
      }
      that.requestBidOverTime(data);
    },
    formSearch: function (e) {// P/L查询
      var that = this;
      console.log(e);
      var data = {
        role: e.detail.target.dataset.role,
        bid: e.detail.target.dataset.bid,
        date: e.detail.value.timedate
      }
      that.requestBidLeaveTime(data);
    },
    requestBidOverTime:function (data){
      var that = this;
      var url = "http://api.ispa.local/Beauticiansort/requestBidInfo";//加班
      app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          overtime: res
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
    requestBidLeaveTime: function (data) {
      var that = this;
      var url = "http://api.ispa.local/Beauticiansort/requestBidLeaveTime";//P/L
      app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          pltime: res
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
     * 我的加班时间选择
     * @param e
     */
    bindOvertimeInitDateChange: function (e) {
        this.setData({
            overtimeInitDate: e.detail.value
        })
    },
    /**
     * Pl时间选择
     * @param e
     */
    bindPlInitDateChange:function (e) {
        this.setData({
            plInitDate: e.detail.value
        })
    },
    /**
     * 生命周期函数--监听页面初次渲染完成
     */
    onReady:function () {
        },

    /**
     * 生命周期函数--监听页面显示
     */
    onShow: function () {

    }
    ,

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide: function () {

    }
    ,

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload: function () {

    }
    ,

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh: function () {

    }
    ,

    /**
     * 页面上拉触底事件的处理函数
     */
    onReachBottom: function () {

    }
    ,

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    }
})