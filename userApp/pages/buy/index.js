const app = getApp()
const util = require('../../utils/util.js');
Page({

    data: {

        swiperCurrent: 0,
        circular: true,
        indicatorDots: true,
        autoplay: false,
        interval: 5000,
        duration: 1000,
        indicatorCo:"#ffdfdc",
        indicatoraAC:"#ff948a",

    },

    onLoad: function (options) {
        console.log(options);
        var that = this;
        that.setData({
            uid:options.uid
        });
        that.getcardlist();
    },
    tabChange:function(e) {
        var that = this;
        // console.log(e.detail);
        if (e.detail.idx == 0) {
            that.getcardlist();
        }else{
            var data = {
                uid:e.detail.infoid
            }
            that.getcards(data);
        }
    },
    getcardlist:function () {//购卡
        var that=this;
        var data = {};
        var url = "https://api.user.ispa.cn/Buy/index";
        // var url = "http://userapi.ispa.local/Buy/index";
        app.post(url, data).then((res) => {
            console.log(res);
            that.setData({
                cardlist:res
            }, function () {
                if(res){
                    that.setData({
                        cardlistinfo:res[0]
                    })
                }
                wx.hideLoading();
            })
        }).catch((errMsg) => {
            util.showError(errMsg)
            wx.hideLoading();
        });
    },
    getcards:function (data) {//续卡
        var that=this;
        var url = "https://api.user.ispa.cn/Buy/getcards";
        // var url = "http://userapi.ispa.local/Buy/getcards";
        app.post(url, data).then((res) => {
            console.log(res);
            that.setData({
                cards:res,
            }, function () {
                if(res){
                    that.setData({
                        cardsinfo:res[0]
                    })
                }
                wx.hideLoading();
            })
        }).catch((errMsg) => {
                util.showError(errMsg)
            wx.hideLoading();
        });
    },
    //轮播图的切换事件

    swiperChange: function (e) {
        var that=this;
        var id = e.detail.current;
        var cardlistinfo = that.data.cardlist[id];
        // console.log(cardlistinfo);
        this.setData({
            cardlistinfo:cardlistinfo
        })

    },
    swiperChange1: function (e) {
        var that=this;
        // console.log(e.detail.current);
        var id = e.detail.current;
        var cardsinfo = that.data.cards[id];
        this.setData({
            cardsinfo:cardsinfo
        })
    },

    //点击指示点切换

    chuangEvent: function (e) {
        this.setData({
            swiperCurrent: e.currentTarget.id
        })
    },

    //点击图片触发事件

    swipclick: function (e) {
        wx.switchTab({
            url: this.data.links[this.data.swiperCurrent]
        })
    },

    gotopay: function (e) {
        var that = this;
        var cardid = that.data.cardlistinfo.cardid;
        var uid = that.data.uid;
        wx.navigateTo({
            url: '../gotopay/gotopay?cardid=' + cardid + '&uid=' + uid
        })
    }

})