// pages/myGradeStaff/myGradeStaff.js
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
        var that = this;
        var timestamp = Date.parse(new Date());

        var daytime = new Date(timestamp);
        var day1 = util.formatTime(daytime);
        var time1 = day1.substr(5);

        var daytime2 = new Date(timestamp - 86400000);
        var day2 = util.formatTime(daytime2);
        var time2 = day2.substr(5);

        var daytime3 = new Date(timestamp -172800000);
        var day3 = util.formatTime(daytime3);
        var time3 = day3.substr(5);

        console.log(options);
        var data = {
          bid: options.userid,
          role: options.role,
          time: time1
        }
        that.getperformanceinfo(data);
        this.setData({
          times:{
              tday:time1,
              yday:time2,
              bday:time3
          },
          slidownKey: 'tday',
          bid: options.userid,
          role: options.role,

        })
    },
    getperformanceinfo:function (data){
        var that = this;
        var url = "https://api.ispa.cn/Performance/performanceInfo";
        app.post(url, data).then((res) => { 
            console.log(res);
        that.setData({
            performance: res
        }, function () {
            wx.hideLoading();
        })
        }).catch((errMsg) => {
          wx.showModal({
            title: '提示',
            content: res.msg,
            showCancel: false
          })
            wx.hideLoading();
        });
    },
    getperformance:function(e){
        var that=this;
        var time = e.currentTarget.dataset.time
        var bid = e.currentTarget.dataset.bid
        var role = e.currentTarget.dataset.role
        var slidownKey = e.currentTarget.dataset.toggle
        var data={
            bid: bid,
            role: role,
            time: time
        }
        console.log(data);
        that.getperformanceinfo(data);
        this.setData({
            slidownKey: slidownKey,

        })
    },
    historyGrade: function (options) {
    var that = this;
      var bid = options.currentTarget.dataset.bid;
      var role = options.currentTarget.dataset.role;
      var time = options.currentTarget.dataset.time;
    wx.navigateTo({
      url: '../historyGradeStaff/historyGradeStaff?bid='+bid+'&role='+role+'&time='+time
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