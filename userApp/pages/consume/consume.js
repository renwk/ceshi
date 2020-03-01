// pages/consume/consume.js\
const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
     showModalStatus: false,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var uid = options.uid;
    // var uid = '8ffe5baf_b794_5082_078d_f3dd29cb7daf';
    var idx = 0
    var data = {uid: uid, idx: idx}
    that.getOrderInfo(data)
    that.setData({
        uid:uid,
    })
  },
  tabChange:function(e){
    var that = this;
    var uid = e.currentTarget.dataset.uid
    var idx = e.detail.idx
    var data = { uid: uid, idx: idx}
    that.getOrderInfo(data)
  },
  /**
   * 获取订单信息
   */
  getOrderInfo: function (data){
      var that = this;
      var url = "https://api.user.ispa.cn/Orderinfo/getOrderInfo";
      app.post(url,data).then((res) => {
        console.log(res)
          that.setData({
            order: res
          },function () {
            wx.hideLoading();
          })
      }).catch((errMsg) => {
        util.showError(errMsg)
        wx.hideLoading();
      })

  },
  /**
   * 获取消费详情
   */
  getOrderDetails: function (order_code){
    var oid = order_code.currentTarget.dataset.oid
    wx.navigateTo({
      url: '../orderdetails/orderdetails?oid='+oid
    })

  },
  /**
   * 获取充值详情
   */
  getRechargeOrderDetails: function(oid){
    var oid = oid.currentTarget.dataset.oid
    wx.navigateTo({
      url: '../rechargedetails/rechargedetails?oid=' + oid
    })
  },

  powerDrawer: function (e) {//弹框展示
    var that = this;
    var currentStatu = e.currentTarget.dataset.statu;
    var currentTitle = e.currentTarget.dataset.title;
    if (currentStatu == 'close') {//关闭弹框
    } else {
      var oid = e.currentTarget.dataset.oid
      var data = {oid:oid}
      that.getOrderCollectionInfo(data);
    }
    that.setData({
      currentTitle: currentTitle,
    })
    that.util(currentStatu)
  },
  formSubmit: function (options) {//提交更改数据
    console.log(options);
  },
  // 获取多选框list中选中的值和对应的id
  checkboxChange: function (e) {//门店
    var that = this;
    var data = {
        uid:that.data.uid,
        type:'store',
        action:e.currentTarget.dataset.action,
        id:e.currentTarget.dataset.id
    };
    that.actionCollect(data);
  },
  checkboxChange1: function (e) {//顾问理疗师
    var that = this;
    var that = this;
    var data = {
        uid:that.data.uid,
        type:'adviser',
        action:e.currentTarget.dataset.action,
        id:e.currentTarget.dataset.id
    };
    that.actionCollect(data);
  },
  actionCollect:function (data) {
      var that = this;
      var url = "https://api.user.ispa.cn/Orderinfo/actionCollect";
      app.post(url, data).then((res) => {
        that.setData({

        }, function () {
            wx.hideLoading();
        })
      }).catch((errMsg) => {
          util.showError(errMsg);
          wx.hideLoading();
      });
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
   * 获取收藏信息
   */
  getOrderCollectionInfo: function (data){
    var that = this;
    var url = "https://api.user.ispa.cn/Orderinfo/getOrderCollectionInfo";
    app.post(url, data).then((res) => {
      that.setData({
        order_col: res
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg)
      wx.hideLoading();
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