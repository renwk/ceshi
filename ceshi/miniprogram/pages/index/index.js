//index.js
//获取应用实例
const app = getApp()
const util = require('../../utils/util.js');
Page({
    data: {
        motto: 'Hello World',
        userInfo: {},
        hasUserInfo: false,
        canIUse: wx.canIUse('button.open-type.getUserInfo'),
        title: '授权提示',
        content: '智能检测机器人希望获取您的头像昵称信息',
        cancelText: '拒绝',
        confirmText: '同意',
        showModalStatus: false,
        list:{}
    },
    //事件处理函数
    bindViewTap: function () {
        wx.navigateTo({
            url: '../logs/logs'
        })
    },
    onLoad: function () {
      var that = this;
      that.bindgetuserinfo();


    },
    onReady: function () {
      this.tabs = this.selectComponent("#tabs");
    },
    powerDrawer: function (e) {
        var currentStatu = e.currentTarget.dataset.statu;
        var bid = e.currentTarget.dataset.bid;
        var role = e.currentTarget.dataset.role;
        var datetype = e.currentTarget.dataset.datetype;
        var userdata={
          bid:bid,
          role:role,
          datetype:datetype
        }
        this.getonePerformance(userdata);
        this.util(currentStatu);
        
    },
    tabChange: function (e) {
      var that = this;
      var userdata = {
        bid: e.detail.infoid,
        role: e.detail.role,
        datetype: e.detail.idx +1
      }
      this.getonePerformance(userdata);
    },
    performance:function(e){
      var bid = e.currentTarget.dataset.bid;
      var role = e.currentTarget.dataset.role;
      var datetype = e.currentTarget.dataset.datetype;
      var userdata = {
        bid: bid,
        role: role,
        datetype: datetype
      }
      this.getonePerformance(userdata);
    },
    util: function(currentStatu){
        /* 动画部分 */
        // 第1步：创建动画实例
        var animation = wx.createAnimation({
            duration: 200,  //动画时长
            timingFunction: "linear", //线性
            delay: 0  //0则不延迟
        });

        // 第2步：这个动画实例赋给当前的动画实例
        this.animation = animation;

        // 第3步：执行第一组动画
        animation.opacity(0).rotateX(0).step();

        // 第4步：导出动画对象赋给数据对象储存
        this.setData({
            animationData: animation.export()
        })

        // 第5步：设置定时器到指定时候后，执行第二组动画
        setTimeout(function () {
            // 执行第二组动画
            animation.opacity(1).rotateX(0).step();
            // 给数据对象储存的第一组动画，更替为执行完第二组动画的动画对象
            this.setData({
                animationData: animation
            })

            //关闭
            if (currentStatu == "close") {
                this.setData(
                    {
                        showModalStatus: false
                    }
                );
            }
        }.bind(this), 200)

        // 显示
        if (currentStatu == "open") {
            this.setData(
                {
                    showModalStatus: true
                }
            );
        }
    },

    bindgetuserinfo: function () {
        var that = this;
        if (app.globalData.userInfo) {
            this.setData({
                userInfo: app.globalData.userInfo,
                hasUserInfo: true
            }, function () {
              that.getopenid();
            })
        } else if (this.data.canIUse) {
            // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
            // 所以此处加入 callback 以防止这种情况
            
            app.userInfoReadyCallback = res => {
              console.log(res);
              app.globalData.encryptedData = res.encryptedData;
              app.globalData.iv = res.iv;
              app.globalData.userInfo = res.userInfo;
              
                this.setData({
                    userInfo: res.userInfo,
                    hasUserInfo: true
                }, function () {
                  that.getopenid();
                })
            }
        } else {
            // 在没有 open-type=getUserInfo 版本的兼容处理
            wx.getUserInfo({
                success: res => {
                  app.globalData.userInfo = res.userInfo
                    this.setData({
                        userInfo: res.userInfo,
                        hasUserInfo: true
                    }, function () {
                      that.getopenid();
                    })
                }
            })
        }
    },
    getUserInfo: function (e) {
       var that = this;
        if (!e.detail.userInfo) {
            that.showDialog();
        }else{
            app.globalData.userInfo = e.detail.userInfo;
            app.globalData.encryptedData=e.detail.encryptedData;
            app.globalData.iv=e.detail.iv;
        }

      that.getopenid();
      
      console.log(121);

        this.setData({
            userInfo: e.detail.userInfo,
            hasUserInfo: true
        })
    },
    
    getopenid:function(){
      var that = this;
        wx.login({
          success: res => {
            getApp().globalData.code = res.code;
            var data = { code: res.code}
            var url = "http://api.ispa.local/login/getWechartAppOpenid";

            app.post(url, data).then((res) => {
              console.log(res);
              getApp().globalData.openid = res.openid;
              that.getdatainfo(res.openid);
            }).catch((errMsg) => {
              console.log(errMsg)
              wx.hideLoading();
            });
          }
        })
    },

    getdatainfo: function (e) {
      var that = this;
      var url = "http://api.ispa.local/Index/Appindex";
      var data = { openid: e, }
      app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          list: res
        }, function () {
          if (res.role == 'consultant' || res.role == 'beautician')
          var qdata={
            brand: res.info.brand,
            sid: res.info.sid,
            bid: res.info.id,
            role: res.role
          }
          console.log(qdata)
          that.getPerformanceSort(qdata)
          wx.hideLoading();
        })
      }).catch((errMsg) => {
          if(errMsg=='未绑定手机号'){
            wx.navigateTo({
              url: '../login/login?openid=' + e
            })
          }else{
            console.log(errMsg)
            wx.showModal({
            title: '提示',
            content: errMsg,
            showCancel: false
            })
          }

        wx.hideLoading();
      });

    },
    getPerformanceSort: function (data) {
      var that = this;
      var url = "http://api.ispa.local/Index/performanceSort";
      app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          performanceSort: res
        }, function () {
          wx.hideLoading();
        })
      }).catch((errMsg) => {
        console.log(errMsg)
        wx.hideLoading();
      });
    },
    getonePerformance: function (e) {
      var that = this;
      var url = "http://api.ispa.local/Index/onePerformance";
      var data = { bid: e.bid,role: e.role,type:e.datetype }
      app.post(url, data).then((res) => {
        console.log(res);
        that.setData({
          performance:res
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
     * 展示授权弹窗
     */
    showDialog: function () {
        var that = this;
        that.setData({
            hasUserInfo:false
        })
    },
    
    
    /**
     * 隐藏授权弹窗
     */
    cancelEvent: function () {
        var that = this;
        that.setData({
            hasUserInfo:true
        })
    },
    goToInfoView: function (options) {

        var that = this;
        wx.navigateTo({
          url: '../info/info?userid=' + options.currentTarget.dataset.toggle//实际路径要写全
        })
    },
    goTomyReservation: function (options) {

        var that = this;
        wx.navigateTo({
          url: '../myReservation/myReservation?bid=' + options.currentTarget.dataset.toggle + '&role=' + options.currentTarget.dataset.role
        })
    },
    goTomyOrder: function (options) {
      var that = this;
      console.log(options);
        wx.navigateTo({
          url: '../order/index?bid=' + options.currentTarget.dataset.toggle + '&role=' + options.currentTarget.dataset.role
        })
    },
    goTomyGradeStaff: function (options) {

      var that = this;
        wx.navigateTo({
          url: '../myGradeStaff/myGradeStaff?userid=' + options.currentTarget.dataset.toggle + '&role=' + options.currentTarget.dataset.role
        })
    },
    goTomyGradeBeautician: function (options) {

      var that = this;
      wx.navigateTo({
        url: '../myGradeBeautician/myGradeBeautician?userid=' + options.currentTarget.dataset.toggle + '&role='+ options.currentTarget.dataset.role
      })
    },
    goToUsercard: function (options) {

      var that = this;
      wx.navigateTo({
        url: '../usercard/usercard?userid=' + options.currentTarget.dataset.toggle + '&sname=' + options.currentTarget.dataset.sname + '&type=' + options.currentTarget.dataset.type
      })
    },
    goToStoreOrder: function (options) {
      var that = this;
      wx.navigateTo({
        url: '../order/index?bid=' + options.currentTarget.dataset.sid +'&role=store'
      })
    },
    goToOneBidInfo: function (options) {
      var that = this;
      wx.navigateTo({
        url: '../Beauticiansort/oneBidInfo?userid=' + options.currentTarget.dataset.toggle + '&role=' + options.currentTarget.dataset.role
      })
    },
    goToScheduling: function (options) {
      var that = this;
      wx.navigateTo({
        url: '../Beauticiansort/scheduling?userid=' + options.currentTarget.dataset.toggle
      })
    },
    goToBidHoursSort:function (options) {
      var that = this;
      wx.navigateTo({
        url: '../bidHoursSort/bidHoursSort?sid=' + options.currentTarget.dataset.toggle
      })
    }
})
