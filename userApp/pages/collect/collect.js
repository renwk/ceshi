// pages/collect/collect.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
      items: [],
      startX: 0, //开始坐标
      startY: 0
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var data ={
      uid:options.uid,
      type:'store'
    }
    that.getcollect(data);

    that.setData({
      uid : options.uid,
      type:'store'
    })

  },
  tabChange:function (e) {
      var that=this;
      var type = '';
      if(e.detail.idx == 1){
          type = 'beauticianAndConsultant';
      }else{
          type = 'store';
      }
      var data={
          uid:e.detail.infoid,
          type:type
      }
      that.getcollect(data);
      that.setData({
          type:type
      })
  },
  getcollect:function (data) {
      console.log(data)
      var that = this;
      var url = "https://api.user.ispa.cn/collect/index";
      app.post(url, data).then((res) => {
          that.setData({
              items: res
          }, function () {
              wx.hideLoading();
          })
      }).catch((errMsg) => {
          util.showError(errMsg)
          wx.hideLoading();
      });
  },
    //删除事件
    del: function (e) {
        var that = this;
        var id = e.currentTarget.dataset.id;
        var uid = that.data.uid;
        var data={
            uid:uid,
            id:id
        };
        that.delcollect(data)
    },
    delcollect:function (data) {
        var that = this;
        var url = "https://api.user.ispa.cn/collect/collectdel";
        app.post(url, data).then((res) => {
        that.setData({
        }, function () {
            util.showError(res)
            var arr ={
                uid:data.uid,
                type:that.data.type
            }
            that.getcollect(arr);
            wx.hideLoading();
        })
    }).catch((errMsg) => {
        util.showError(errMsg)
        wx.hideLoading();
    });
    },
    //手指触摸动作开始 记录起点X坐标
    touchstart: function (e) {
    //开始触摸时 重置所有删除
        this.data.items.forEach(function (v, i) {
            if (v.isTouchMove)//只操作为true的
                v.isTouchMove = false;
        })
        this.setData({
            startX: e.changedTouches[0].clientX,
            startY: e.changedTouches[0].clientY,
            items: this.data.items
        })
    },
    //滑动事件处理
    touchmove: function (e) {
        var that = this,
            index = e.currentTarget.dataset.index,//当前索引
            startX = that.data.startX,//开始X坐标
            startY = that.data.startY,//开始Y坐标
            touchMoveX = e.changedTouches[0].clientX,//滑动变化坐标
            touchMoveY = e.changedTouches[0].clientY,//滑动变化坐标
    //获取滑动角度
            angle = that.angle({ X: startX, Y: startY }, { X: touchMoveX, Y: touchMoveY });
        that.data.items.forEach(function (v, i) {
            v.isTouchMove = false
    //滑动超过30度角 return
            if (Math.abs(angle) > 30) return;
            if (i == index) {
                if (touchMoveX > startX) //右滑
                    v.isTouchMove = false
                else //左滑
                    v.isTouchMove = true
            }
        })
    //更新数据
        that.setData({
            items: that.data.items
        })
    },
    /**
     * 计算滑动角度
     * @param {Object} start 起点坐标
     * @param {Object} end 终点坐标
     */
    angle: function (start, end) {
        var _X = end.X - start.X,
            _Y = end.Y - start.Y
    //返回角度 /Math.atan()返回数字的反正切值
        return 360 * Math.atan(_Y / _X) / (2 * Math.PI);
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