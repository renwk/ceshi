// pages/circle/circle.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        report_id: '',
        timer: '',
        reportTimes: '',//报告时间
        accounted: 0,//打败比例
        healthSelect: true,//健康指数选择
        physicalSelect: false,//身体状况选择
        iconArray: null,//健康指数图标
        reportInfo: null,//健康报告信息
        hideModal: true, //模态框的状态  true-隐藏  false-显示
        animationData: {},//用户须知动画
        canvasShow: false//canvas状态 true-隐藏  false 显示
    },
    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        let that = this;
        that.setData({
            report_id: options.report_id
        }, function () {
            // 以下两个是测试数据
            that.getReportInfo();
        })


    },
    /**
     * 画图
     * @param rightItems
     * @param totalItems
     */
    showScoreAnimation: function (rightItems, totalItems) {
        /*
        cxt_arc.arc(x, y, r, sAngle, eAngle, counterclockwise);
        x	                    Number	  圆的x坐标
        y	                    Number	  圆的y坐标
        r	                    Number	  圆的半径
        sAngle	            Number	  起始弧度，单位弧度（在3点钟方向）
        eAngle	            Number	  终止弧度
        counterclockwise	    Boolean	  可选。指定弧度的方向是逆时针还是顺时针。默认是false，即顺时针。
        */
        let that = this;
        let copyRightItems = 0;
        that.setData({
            timer: setInterval(function () {
                copyRightItems++;
                if (copyRightItems == rightItems) {
                    clearInterval(that.data.timer)
                } else {
                    // 页面渲染完成
                    // 这部分是灰色底层
                    let cxt_arc = wx.createCanvasContext('canvasArc');//创建并返回绘图上下文context对象。
                    cxt_arc.setLineWidth(6);//绘线的宽度
                    cxt_arc.setStrokeStyle('#d2d2d2');//绘线的颜色d2d2d2
                    cxt_arc.setLineCap('round');//线条端点样式
                    cxt_arc.beginPath();//开始一个新的路径
                    cxt_arc.arc(36, 36, 32, 0, 2 * Math.PI, false);//设置一个原点(53,53)，半径为50的圆的路径到当前路径
                    cxt_arc.stroke();//对当前路径进行描边
                    //这部分是蓝色部分
                    cxt_arc.setLineWidth(6);
                    cxt_arc.setStrokeStyle('#FFFFFF');//
                    cxt_arc.setLineCap('round')
                    cxt_arc.beginPath();//开始一个新的路径
                    cxt_arc.arc(36, 36, 32, -Math.PI * 1 / 2, 2 * Math.PI * (copyRightItems / totalItems) - Math.PI * 1 / 2, false);
                    cxt_arc.stroke();//对当前路径进行描边
                    cxt_arc.draw();
                }
            }, 20)
        })
    },
    /**
     * 获取分数
     * @param completePercent
     */
    getResultComment: function (completePercent) {
        let that = this;
        that.setData({
            completePercent: completePercent,
        })
    },
    /**
     * 健康指数显隐
     * @param e
     */
    healthIndex: function (e) {
        this.setData({
            healthSelect: true,
            physicalSelect: false
        })
    },
    /**
     * 身体状况显隐
     * @param e
     */
    physicalCondition: function (e) {
        this.setData({
            healthSelect: false,
            physicalSelect: true
        })
    },
    // 显示遮罩层
    showModal: function () {
        var that = this;
        that.setData({
            hideModal: false,
            canvasShow: true
        })
        var animation = wx.createAnimation({
            duration: 600,//动画的持续时间 默认400ms   数值越大，动画越慢   数值越小，动画越快
            timingFunction: 'ease',//动画的效果 默认值是linear
        })
        this.animation = animation
        setTimeout(function () {
            that.fadeIn();//调用显示动画
        }, 200)
    },
// 隐藏遮罩层
    hideModal: function () {
        var that = this;
        var animation = wx.createAnimation({
            duration: 600,//动画的持续时间 默认400ms   数值越大，动画越慢   数值越小，动画越快
            timingFunction: 'ease',//动画的效果 默认值是linear
        })
        this.animation = animation
        that.fadeDown();//调用隐藏动画
        setTimeout(function () {
            that.setData({
                hideModal: true,
                canvasShow: false
            })
        }, 200)//先执行下滑动画，再隐藏模块

    },
    //动画集
    fadeIn: function () {
        this.animation.translateY(0).step()
        this.setData({
            animationData: this.animation.export()//动画实例的export方法导出动画数据传递给组件的animation属性
        })
    },
    fadeDown: function () {
        this.animation.translateY(1000).step()
        this.setData({
            animationData: this.animation.export(),
        })
    },
    /**
     * 获取报告信息
     * @returns {boolean}
     */
    getReportInfo: function () {
        var that = this;
        var url = app.globalData.url + 'Inspectresultbaseinfo/index';
        var data = {
            report_id: that.data.report_id,
            openid:app.globalData.openid,
            unionid:app.globalData.unionid,
            headimgurl:app.globalData.userInfo.avatarUrl
        };//要传的数组对象
        wx.showLoading({
            title: '加载中...',
        })
        app.post(url, data).then((res) => {

            if(res.phone || !res.self){
                if (res.report.base.trade_state == 'SUCCESS') {
                    that.setData({
                        accounted: res.defeatPercentage,
                        reportTimes: util.formatTime(res.report.base.inspect_date),
                        iconArray: res.health_icon,
                        reportInfo: res.report
                    }, function () {
                        let totalItems = 100;
                        let rightItems = res.report.base.total_score;
                        let completePercent = parseInt((rightItems / totalItems) * 100);
                        that.getResultComment(completePercent);
                        that.showScoreAnimation(rightItems, totalItems);
                    });
                } else {
                    wx.navigateTo({
                        url: '../pay/pay?report_id=' + that.data.report_id,
                    })
                }
            }else{
                wx.navigateTo({
                    url: '../login/login?report_id=' + that.data.report_id,
                })
            }


            wx.hideLoading();
        }).catch((errMsg) => {
            util.showError(errMsg);
            wx.hideLoading();
        });
        return false;
    },
    /**
     * 跳转详情页面
     * @param e
     */
    reportDetail: function (e) {
        var that = this;
        let data = e.currentTarget.dataset;
        //跳转需要传指标id，报告id，openid
        let target_id = data.target_id;
        if(target_id == 3163){
            wx.navigateTo({
                url: '../nutrition/nutrition?report_id=' + that.data.report_id
            })
        }else{
            wx.navigateTo({
                url: '../detailreport/detailreport?report_id=' + that.data.report_id
            })
        }
    },
    /**
     * 跳转身边的机器人页面
     * @param e
     */
    robotMapShow: function (e) {
        let that = this;
        wx.navigateTo({
            url: '../mapshow/mapshow?report_id=' + that.data.report_id
        })
    },
    toHistory: function () {
        let that = this;
        wx.navigateTo({
            url: '../history/history?report_id=' + that.data.report_id
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