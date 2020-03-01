// miniprogram/pages/login/login.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
      time: '获取验证码', //按钮文字
      currentTime: 61, //倒计时
      disabled: false, //按钮是否禁用
      phone: '', //获取到的手机栏中的值
      formdisabled:true,
      check:false,
      showModalStatus: false,
  },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
      console.log(options)
      this.setData({
        appopenid:options.openid,
        images:options.img
      })
    },
    phoneInput: function (e) {
        this.setData({
            phone: e.detail.value
        })
    },

    //获取验证码按钮
    bindButtonTap: function () {
        var that = this;
      
        that.setData({
            disabled: true, //只要点击了按钮就让按钮禁用 （避免正常情况下多次触发定时器事件）
            color: '#e3e3e3',
        })

        var phone = that.data.phone;
        var currentTime = that.data.currentTime //把手机号跟倒计时值变例成js值

        var warn = null; //warn为当手机号为空或格式不正确时提示用户的文字，默认为空

        if (phone == '') {
            warn = "号码不能为空";
        } else if (phone.trim().length != 11 || !/^1[3|4|5|6|7|8|9]\d{9}$/.test(phone)) {
            warn = "手机号格式不正确";
        } else {
            //当手机号正确的时候提示用户短信验证码已经发送
            wx.showToast({
                title: '短信验证码已发送',
                icon: 'none',
                duration: 2000
            });
            console.log(that.data.phone);
            var mobile = that.data.phone;
            var data={
              mobile: mobile
            }
            that.actionGetVerifycode(data);
            var interval = setInterval(function () {
                currentTime--; //每执行一次让倒计时秒数减一
                that.setData({
                    time: currentTime + 's', //按钮文字变成倒计时对应秒数

                })
//如果当秒数小于等于0时 停止计时器 且按钮文字变成重新发送 且按钮变成可用状态 倒计时的秒数也要恢复成默认秒数 即让获取验证码的按钮恢复到初始化状态只改变按钮文字
                if (currentTime <= 0) { clearInterval(interval)
                    that.setData({
                        time: '重新发送',
                        currentTime: 61,
                        disabled: false,
                        color: '#cfba93'
                    })
                }
            }, 1000);

        };

//判断 当提示错误信息文字不为空 即手机号输入有问题时提示用户错误信息 并且提示完之后一定要让按钮为可用状态 因为点击按钮时设置了只要点击了按钮就让按钮禁用的情况
        if (warn != null) {
            // wx.showModal({
            //     title: '提示',
            //     content: warn
            // })
            util.showError(warn)
            that.setData({
                disabled: false,
                color: '#cfba93'
            })
            return;

        };
    },
    // 同意阅读
    agreecheck:function (e) {
        var that=this;
        if(that.data.check){
            that.setData({
                check:false,
                formdisabled:true
            })
        }else{
            that.setData({
                check:true,
                formdisabled:false
            })
        }
    },
    //弹框展示
    powerDrawer: function (e) {
        var that = this;
        var currentStatu = e.currentTarget.dataset.statu;
        var currentTitle = e.currentTarget.dataset.title;
        if (currentStatu=='close'){//关闭弹框
            // console.log('关闭弹框');
        }else{
            // console.log('显示弹框');//可请求数据
        }
        that.setData({
            currentTitle: currentTitle,
        })
        console.log(currentStatu);
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
  formlogin:function (e) {
    var that = this;
    var mobile = e.detail.value.mobile;
    var code = e.detail.value.code;
    var openid=that.data.appopenid;
    var data = {
      mobile:mobile,
      code:code,
      appopenid:openid
    }
    that.actionlogin(data);

  },
  actionGetVerifycode:function (data){
    var that = this;
    var url = "https://api.user.ispa.cn/Login/actionGetVerifycode";//发送短信
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        sendmsg: res,
        // formdisabled:false
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg)
      wx.hideLoading();
    });
  },
  actionlogin: function (data) {
    console.log(data);
    var that = this;
    var url = "https://api.user.ispa.cn/Login/login";//login
    app.post(url, data).then((res) => {
      console.log(res);
      that.setData({
        loginmsg: res
      }, function () {
        wx.navigateTo({
          url: '../index/index'
        })
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      // wx.showModal({
      //   title: '提示',
      //   content: errMsg,
      //   showCancel: false
      // })
      util.showError(errMsg)
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