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
        selected1:true,
        selected2:false,
        selected3:false
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

    mytaginfo:function (data) { //会员标签
        var that = this;
        var url = "https:///Usercard/mytaginfo";
        app.post(url, data).then((res) => {
            console.log(res);
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


    selected:function(e){

        var togg = e.currentTarget.dataset.toggle;
        if(togg == 2){
            this.setData({
                selected1:false,
                selected2:true,
                selected3:false
            })
        } else if(togg == 3){
            this.setData({
                selected1:false,
                selected2:false,
                selected3:true
            })
        } else{
            this.setData({
                selected1:true,
                selected2:false,
                selected3:false
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