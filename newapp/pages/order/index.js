const app = getApp()
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        //消费
        beginDate: '2018-11-15',
        endDate: '2018-11-15',
        slidownKey: 2,
        check:false,
        dataStatus: true,
        selected_info:"今天",
        today_status:true,
        week_status:false,
        month_status:false,
        custom_status:false,
        //交易
        trading_beginDate:'2018-11-15',
        trading_endDate: '2018-11-15',
        trading_slidownKey:2,
        ordertype:1
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
      var that = this;
      if (options.role){
        var data={
          bid:options.bid,
          role:options.role,
          datetype:'今天',
          ordertype:1,
        }
      }else if(options.sid){
        var data = {
          bid: options.sid,
          role: options.role,
          datetype: '今天',
          ordertype: 1,
        }
      }
      console.log(data)
      that.getorderlist(data)
      that.setData({
        role: data.role,
        infoid: data.bid
      })
    },
    bindBeginDateChange: function (e) {
        this.setData({
            beginDate: e.detail.value
        })
    },
    bindEndDateChange: function (e) {
        this.setData({
            endDate: e.detail.value
        })
    },
    usernotes:function (e) {
      var that = this;
        var userid = e.currentTarget.dataset.userid;
        var ordercode = e.currentTarget.dataset.ordercode;
        var role = that.data.role;
        var bid = that.data.infoid;
        // if(role == 'consultant' || role =='manage'){
            wx.navigateTo({
                url: '../summaryNotes/summaryNotes?userid='+userid+'&bid='+bid+'&ordercode='+ordercode
            })
        // }
    },
    tousercardinfo:function (e) {
        var that = this;
        var userid = e.currentTarget.dataset.userid;
        var role = that.data.role;
        var bid = that.data.infoid;
        // if(role == 'consultant' || role =='manage'){
            wx.navigateTo({
                url: '../usercardinfo/usercardinfo?userid='+userid+'&bid='+bid
            })
        // }
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
    selectTrue: function (e) {
        var that = this;
        let selected_value = e.currentTarget.dataset.selected_value;
        var timestamp = Date.parse(new Date());
        var daytime = new Date(timestamp);
        var today1 = util.formatTime(daytime);
        // var today1 ='';
      console.log(e.currentTarget)
        if (selected_value == 1) {
            that.setData({
                selected_info: '今天',
                dataStatus:true,
                today_status:true,
                week_status:false,
                custom_status:false,
                slidownKey:2
            })
        } else if (selected_value == 2) {
            that.setData({
                selected_info:"最近一周",
                dataStatus:true,
                today_status:false,
                week_status:true,
                month_status:false,
                custom_status:false,
                slidownKey:2
            })
        } else if (selected_value == 3) {
            that.setData({
                selected_info:"本月",
                dataStatus:true,
                today_status:false,
                week_status:false,
                month_status:true,
                custom_status:false,
                slidownKey:2
            })
        } else {
            that.setData({
                selected_info:"自定义时间",
                dataStatus:false,
                today_status:false,
                week_status:false,
                month_status:false,
                custom_status:true,
                slidownKey:2,
                beginDate: today1,
                endDate: today1,
                trading_beginDate: today1,
                trading_endDate:today1,
            })
        }
    },
    bindTradBeginDateChange: function (e) {
        this.setData({
            trading_beginDate: e.detail.value
        })
    },
    bindTradEndDateChange: function (e) {
        this.setData({
            trading_endDate: e.detail.value
        })
    },
    tradToDropdown: function (e) {
        var that = this;
        let slidownKey = e.currentTarget.dataset.trading_slidownkey;
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

    toOrderoService: function(options) {//跳转服务订单
      console.log(options.currentTarget.dataset.toggle);
      var that = this;
      wx.navigateTo({
        url: '../orderService/orderService?order_code=' + options.currentTarget.dataset.toggle
      })
    },
    toOrderRecharge: function (options) {//跳转充值订单
      console.log(options.currentTarget.dataset.toggle);
      var that = this;
      wx.navigateTo({
        url: '../orderRecharge/orderRecharge?order_code='+options.currentTarget.dataset.toggle
      })
    },

    getorderlist:function (data) {
      var that = this;
      var url = "https:///order/orderList";//订单列表
      app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          order: res
        }, function () {
          wx.hideLoading();
        })
      }).catch((errMsg) => {
        util.showError(errMsg)
        wx.hideLoading();
      });
    },

  searchConsumption:function (e) {
    var that = this;
    console.log(e);
  },
    agreecheck:function (e) {
        var that=this;
        if(that.data.check){
            that.setData({
                check:false
            })
        }else{
            that.setData({
                check:true
            })
        }
    },
  formSubmit: function (e) {
    var that = this;
    console.log(e);
    var onotes = 0;
    if(that.data.check){
        onotes=1;
    }
      var subdate={
        role: e.detail.target.dataset.role,
        bid: e.detail.target.dataset.bid,
        datetype: e.detail.target.dataset.toggle,
        ordertype: e.detail.target.dataset.ordertype,
        condition: e.detail.value.condition,
        stime: e.detail.value.stime,
        etime: e.detail.value.etime,
        onotes:onotes
      }
      console.log(subdate);
      that.getorderlist(subdate);

  },
  tabChange:function(e){
    var that = this;
    console.log(e.detail);
    if (e.detail.idx==0){
      var tabdata={
        role: e.detail.role,
        bid: e.detail.infoid,
        datetype:'今天',
        ordertype:1
      }
      that.getorderlist(tabdata);
      that.setData({
        selected_info: '今天',
        dataStatus: true,
        today_status: true,
        week_status: false,
        month_status: false,
        custom_status: false,
        slidownKey: 2,
        ordertype:e.detail.idx
      })
    } else if (e.detail.idx==1){
      var tabdata = {
        role: e.detail.role,
        bid: e.detail.infoid,
        datetype: '今天',
        ordertype: 2
      }
      that.getorderlist(tabdata);
      that.setData({
        selected_info: '今天',
        dataStatus: true,
        today_status: true,
        week_status: false,
        month_status: false,
        custom_status: false,
        slidownKey: 2,
        ordertype:e.detail.idx
      })
    }
  },
  onReady:function() {
    this.tabs = this.selectComponent("#tabs");
  }


})