// pages/summaryNotes/summaryNotes.js
const app = getApp()
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    tags:[],

    showModalStatus: false,
      selected1:false,
      selected2:true,

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    console.log(options);
    var that = this;
    var data={
      userid:options.userid
    }
    that.mytaginfo(data);
    that.setData({
      loaddata:options
    })
  },

  // 触摸开始时间
  touchStartTime: 0,
  // 触摸结束时间
  touchEndTime: 0,
  // 最后一次单击事件点击发生时间
  lastTapTime: 0,
  // 单击事件点击后要触发的函数
  lastTapTimeoutFunc: null,
  /// 按钮触摸开始触发的事件
  touchStart: function (e) {
    this.touchStartTime = e.timeStamp
  },

  /// 按钮触摸结束触发的事件
  touchEnd: function (e) {
    this.touchEndTime = e.timeStamp
  },
  doubleTap: function (e) {
    var that = this
    // 控制点击事件在350ms内触发，加这层判断是为了防止长按时会触发点击事件
    if (that.touchEndTime - that.touchStartTime < 350) {
      // 当前点击的时间
      var currentTime = e.timeStamp
      var lastTapTime = that.lastTapTime
      // 更新最后一次点击时间
      that.lastTapTime = currentTime

      // 如果两次点击时间在300毫秒内，则认为是双击事件
      if (currentTime - lastTapTime < 300) {
        // console.log("double tap")
        // 成功触发双击事件时，取消单击事件的执行
        clearTimeout(that.lastTapTimeoutFunc);

        var consultant_id = e.currentTarget.dataset.cid
        var loaddata = that.data.loaddata;
        if (consultant_id == loaddata.bid){
          var code = e.currentTarget.dataset.code;
          var userid = loaddata.userid
          wx.showModal({
            title: '提示',
            content: '确定删除该标签',
            success: function (res) {
              if (res.confirm) {
                var data={
                  userid: userid,
                  tagcode: code,
                  bid: consultant_id
                }
                that.delTag(data);
                // that.onLoad(loaddata);
              } else {
                console.log('弹框后点取消了')
              }
            }
          })
        }else{
          wx.showModal({
            title: '提示',
            content: '仅会员专属顾问可删',
            showCancel: false
          })
        }

      }
    }
  },
  delTag:function (data) {
    var that = this;
    var url = "https://api.ispa.cn/Usercard/delTag";
    app.post(url, data).then((res) => {
      that.setData({
        msg:res
      }, function () {
        that.onLoad(that.data.loaddata);
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },

  mytaginfo:function (data) { //会员标签
    var that = this;
    var url = "https://api.ispa.cn/Usercard/mytaginfo";
    app.post(url, data).then((res) => {
      that.setData({
        usertag: res.usertag,
        user :res.user,
        comment:res.comment,
        usercontent: res.usercontent
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },

  powerDrawer: function (e) {//弹框展示
    var that = this;
    var currentStatu = e.currentTarget.dataset.statu;
    var currentTitle = e.currentTarget.dataset.title;
    var showtype = e.currentTarget.dataset.showtype;
    var text = e.currentTarget.dataset.text;
    var upid = e.currentTarget.dataset.upid;
    if (currentStatu=='close'){
      text = '';
      upid = '';
    }

    if (showtype==1){
      // var search = e.currentTarget.value.search
      var data={
      }
      // that.gettagtype(data);
      that.gettag(data);
    }
    that.setData({
      currentTitle: currentTitle,
      showtype:showtype,
      text:text,
      upid:upid,
    })
    that.util(currentStatu)
  },

  formSubmit:function (options) {//提交更改数据
    var that = this;
    var showtype = options.detail.target.dataset.showtype;
    if (showtype==2){
      var userid = options.detail.target.dataset.toggle;
      var newremark = options.detail.value.newremark;
      var newdata2 = {
        userid: userid,
        newremark: newremark
      }
      that.upremark(newdata2);
    } else if (showtype == 3){
      var userid = options.detail.target.dataset.toggle;
      var content = options.detail.value.content;
      var bid = that.data.loaddata.bid;
      var newdata3 ={
        userid: userid,
        bid:bid,
        content: content,
        type:'content'
      }
      console.log(newdata3);
      that.addtag(newdata3);
    } else if (showtype == 4){
      var upid = options.detail.target.dataset.upid;
      var content = options.detail.value.content;
      var newdata4 = {
        id: upid,
        content: content,
      }
      console.log(newdata4);
      that.upContent(newdata4);
    } else{
        var codes ='';
        for (var j = 0; j < that.data.tags.length; j++) {
            if(that.data.tags[j]['tag']){
                for(var i = 0; i < that.data.tags[j]['tag'].length; i++) {
                    if (that.data.tags[j]['tag'][i].checked == true) {
                        var code = that.data.tags[j]['tag'][i]['tag_code'];
                        codes += code+',';
                    }
                }
            }
        }
        console.log(codes);
        var newdata1 = {
            tagcode : codes,
            type:'code',
            bid:that.data.loaddata.bid,
            userid:that.data.loaddata.userid,
        }
        that.addtag(newdata1)
    }
    console.log(that.data.loaddata)
    // that.onLoad(that.data.loaddata);
  },
  addtag: function (data) { //添加护理日志
    var that = this;
    var url = "https://api.ispa.cn/Usercard/addtag";
    app.post(url, data).then((res) => {
      console.log(res)
      that.setData({
        msg:res
      }, function () {
        that.onLoad(that.data.loaddata);
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },
  upContent: function (data) { //添加护理日志
    var that = this;
    var url = "https://api.ispa.cn/Usercard/upContent";
    app.post(url, data).then((res) => {
      that.setData({
        msg: res
      }, function () {
        that.onLoad(that.data.loaddata);
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },
  upremark: function (data) { //护理汇总
    var that = this;
    var url = "https://api.ispa.cn/Usercard/upremark";
    app.post(url, data).then((res) => {
      that.setData({
        msg: res
      }, function () {
        that.onLoad(that.data.loaddata);
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },
  gettag: function (data) { //会员标签
    var that = this;
    var url = "https://api.ispa.cn/Usercard/gettag";
    app.post(url, data).then((res) => {
      that.setData({
        tags:res
      }, function () {
        wx.hideLoading();
      })
    }).catch((errMsg) => {
      util.showError(errMsg);
      wx.hideLoading();
    });
  },

    search:function(e){
      var that = this;
      var search = e.detail.value;

      var data = {
        search:search,
      }
      // that.gettagtype(data);
      that.gettag(data);
    },

    chooseOs: function (event) {
      var that = this;
      console.log(event);
        for (var j = 0; j < that.data.tags.length; j++) {
          if(that.data.tags[j]['tag']){
          for(var i = 0; i < that.data.tags[j]['tag'].length; i++) {
              if (event.currentTarget.id == that.data.tags[j]['tag'][i].tag_code) {
                  if (that.data.tags[j]['tag'][i].checked == true) {
                      that.data.tags[j]['tag'][i].checked = false;
                      var tags = that.data.tags;
                      that.setData({
                          tags:tags//重定义tags
                      })
                  } else {
                      that.data.tags[j]['tag'][i].checked = true;
                      var tags = that.data.tags;
                      that.setData({
                          tags:tags
                      })
                  }
              }
          }
          }
        }
    },
    selected:function(e){

        var togg = e.currentTarget.dataset.toggle;
        if(togg == 11000){
            this.setData({
                selected1:false,
                selected2:true
            })
        } else{
            this.setData({
                selected1:togg,
                selected2:false
            })
        }

    },
    // selected1:function(e){
    //   console.log(2)
    //     this.setData({
    //         selected:false,
    //         selected1:true
    //     })
    // },


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
    var that = this;
    that.onLoad(that.data.loaddata);

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