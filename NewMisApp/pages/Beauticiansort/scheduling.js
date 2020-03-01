// pages/beauticiansort/scheduling.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        initCalendar:null,
      initDate: util.formatMonth(new Date()),
        schedultype:[
            {config_description:'早班',config_note:'#5EE825'},
            {config_description:'中班',config_note:'#E8255B'},
            {config_description:'晚班',config_note:'#B7B6BF'},
            {config_description:'休息',config_note:'#444444'}
        ],

    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
      var that = this;
      var month = util.formatMonth(new Date());
      var data={
        bid:options.userid,
        time:month
      }
      console.log(data)
      that.showscheduling(data);
      that.setData({
        bid:options.userid
      })

    },
    showscheduling: function (data) {
      var that = this;
      var url = "https:///Beauticiansort/showscheduling";//排班
      app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          initCalendar: res.show,
          schedultype: res.schedultype
        }, function () {
          wx.hideLoading();
        })
      }).catch((errMsg) => {
        util.showError(errMsg);
        wx.hideLoading();
      });
    },
    /**
     * 初始化日历数据
     */
    setInitCalendar : function () {
        var that = this;
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth();
        var firstDay = new Date(year,month,1);
        var weekday = firstDay.getDay();
        var days = new Date(year,month+1,0).getDate();

        var res = [];
        for ( var i=1-weekday;i<=days;){
            var notes = [];
            for ( var j=0;j<7;j++ ){
                var info = {};
                if(i >days || i <= 0){
                    info['dayname'] = '';
                    info['colors'] = '';

                }else{
                    info['dayname'] = i;
                    info['colors'] = '';
                }
                notes.push(info);
                i++;
            }
            res.push(notes);
        }
        that.setData({
            initCalendar:res
        })
    },
    /**
     * 绑定时间
     * @param e
     */
    bindInitDateChange: function (e) {
        this.setData({
            initDate: e.detail.value
        })
    },
    /**
     * 搜索
     */
    bindSearchInfo: function (e) {
        var that = this;
        var data = {
          bid: e.currentTarget.dataset.bid,
          time: e.currentTarget.dataset.time
        }
        that.showscheduling(data);
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