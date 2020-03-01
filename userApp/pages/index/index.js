//index.js
//获取应用实例
const app = getApp()
const util = require('../../utils/util.js');
Page({
  data: {
    motto: '1000.00',
    userInfo: {},
    hasUserInfo: '',
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    title: '授权提示',
    content: 'iSpa希望获取您的头像昵称信息',
    cancelText: '拒绝',
    confirmText: '同意',
    showModalStatus: false,//模态框展示
  },

  onLoad: function () {
    var that = this;
    console.log(wx.getStorageSync('userinfo'))
    if (wx.getStorageSync('userinfo')) {
      that.setData({
        hasUserInfo: false
      })
    } else {
      that.setData({
        hasUserInfo: true
      })
    }
    that.verifyLogin();

  },
  verifyLogin:function (){
    var that = this;
    if (app.globalData.userInfo) {
      wx.setStorageSync("userinfo", app.globalData.userInfo);
      this.setData({
        userInfo: app.globalData.userInfo,
        // hasUserInfo: true
      }, function () {
        that.getopenid();
      })
    } else if (this.data.canIUse) {
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      app.userInfoReadyCallback = res => {
        wx.setStorageSync("userinfo", res.userInfo);
        app.globalData.encryptedData = res.encryptedData;
        app.globalData.iv = res.iv;
        app.globalData.userInfo = res.userInfo;
        this.setData({
          userInfo: res.userInfo,
          // hasUserInfo: true
        }, function () {
          that.getopenid();
        })
      }
    } else {
      // 在没有 open-type=getUserInfo 版本的兼容处理
      wx.getUserInfo({
        success: res => {
          wx.setStorageSync("userinfo", res.userInfo);
          app.globalData.userInfo = res.userInfo;
          app.globalData.encryptedData = res.encryptedData;
          app.globalData.iv = res.iv;
          this.setData({
            userInfo: res.userInfo,
            // hasUserInfo: true
          }, function () {
            that.getopenid();
          })
        }
      })
    }
  },

  bindgetuserinfo: function(e) {
    var that = this;
    if (!e.detail.userInfo) {
      that.showDialog();
    } else {
      that.cancelEvent();
      wx.setStorageSync("userinfo", e.detail.userInfo);
      app.globalData.userInfo = e.detail.userInfo;
      app.globalData.encryptedData = e.detail.encryptedData;
      app.globalData.iv = e.detail.iv;
      this.setData({
        userInfo: e.detail.userInfo,
        // hasUserInfo: true
      }, function () {
        that.getopenid();
      })
    }
  },
  getopenid: function () {
    var that = this;
    if (app.globalData.openid) {
      that.getdatainfo(app.globalData.openid);
    } else {
      wx.login({
        success: res => {
          getApp().globalData.code = res.code;
          var data = { code: res.code }
          var url = "https://api.user.ispa.cn/login/getWechartAppOpenid";

          app.post(url, data).then((res) => {
            console.log(res)
            getApp().globalData.openid = res.openid;
            that.getdatainfo(res.openid);
          }).catch((errMsg) => {
            util.showError(errMsg)
            wx.hideLoading();
          });
        }
      })
    }
  },
  getdatainfo: function (e) {
    var that = this;
    var url = "https://api.user.ispa.cn/Index/index";
    var userinfo = wx.getStorageSync('userinfo')
    var data = {
      openid: e,
      avatarUrl: userinfo.avatarUrl,
      city: userinfo.city,
      country: userinfo.country,
      sex:userinfo.gender,
      language: userinfo.language,
      nickName: userinfo.nickName,
      province: userinfo.province,
    }

    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        list: res
      }, function () {
        if(res.is_read_agreement == 0 && res.cardNums != 0){
            // e.currentTarget.dataset.statu
            var data=
                {'currentTarget':
                      { 'dataset':
                          {'statu' : 'open'}
                      }
                };
            that.powerDrawer(data)
        }
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      if (errMsg == '未绑定手机号') {
        wx.navigateTo({
          url: '../login/login?openid=' + e + '&img=' + userinfo.avatarUrl
        })
      } else {
        util.showError(errMsg)
        wx.hideLoading();
      }

    });

  },
  readAgreement: function (data) {
      var that=this;
      var url = "https://api.user.ispa.cn/Index/readAgreement";
      // var url = "http://userapi.ispa.local/Index/readAgreement";
      app.post(url, data).then((res) => {
        that.setData({
        }, function () {
            wx.hideLoading();
        })
      }).catch((errMsg) => {
          util.showError(errMsg)
          wx.hideLoading();
      });
  },

  powerDrawer: function (e) {//弹框展示
      // console.log(e);return false;
      var that = this;
      var currentStatu = e.currentTarget.dataset.statu;
      if (currentStatu=='close'){//关闭弹框
          var openid = that.data.list.openid;
          var data ={
              openid:openid
          }
          that.readAgreement(data);
      }else{
          // console.log('显示弹框');//可请求数据
      }
      that.util(currentStatu)
  },
  util: function (currentStatu) {
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
  /**
     * 展示授权弹窗
     */
  showDialog: function () {
    var that = this;
    that.setData({
      hasUserInfo: true
    })
  },


  /**
   * 隐藏授权弹窗
   */
  cancelEvent: function () {
    var that = this;
    that.setData({
      hasUserInfo: false
    })
  },
  // 分享
  onShareAppMessage: function () {
    wx.showShareMenu({
      withShareTicket: true
    })
    return {
      title: 'iSpa会员系统',//分享内容
      path: '/pages/index/index',//分享地址
      // imageUrl: '../../image/icon/img_share.png',//分享图片
      success: function (res) {
        if (res.errMsg == 'shareAppMessage:ok') {//判断分享是否成功
          console.log('分享成功')
        }
      }
    }
  },
  // 预约单
  getBespeakInfo: function (e) {
    wx.navigateTo({
      url: '../bespeak/bespeak?uid=' + e.currentTarget.dataset.uid
    })
  },
  // 我的消费
  getConsumeInfo: function (e) {
    wx.navigateTo({
      url: '../consume/consume?uid=' + e.currentTarget.dataset.uid + '&userid=' + e.currentTarget.dataset.userid
    })
  },
  // 个人资料
  gotouserinfo: function (e) {
    wx.navigateTo({
      url: '../userinfo/userinfo?uid=' + e.currentTarget.dataset.uid + '&openid=' + e.currentTarget.dataset.openid
    })
  },
  // 优惠券
  gotocoupon: function (e) {
    wx.navigateTo({
      url: '../coupon/coupon?userid=' + e.currentTarget.dataset.userid
    })
  },
  // 会员卡
  gotomycard: function (e) {
    wx.navigateTo({
      url: '../mycard/mycard?uid=' + e.currentTarget.dataset.uid
    })
  },
  gotocollect:function (e) {
      wx.navigateTo({
          url: '../collect/collect?uid=' + e.currentTarget.dataset.uid
      })
  },
  // 充值
  gotobuy: function (e) {
      wx.navigateTo({
          url: '../buy/index?uid=' + e.currentTarget.dataset.uid
      })
  },
  gotoinvite: function (e) {
      wx.navigateTo({
          url: '../invite/index?uid=' + e.currentTarget.dataset.uid
      })
  }
})
