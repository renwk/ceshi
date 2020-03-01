// pages/inspectresultbaseinfo/index.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        report_id: '',
        dialog: null,
        hasUserInfo: false,
        canIUse: wx.canIUse("button.open-type.getUserInfo"),
        userInfo: {},
        loading: false,
        title: '授权提示',
        content:'智能检测机器人希望获取您的头像昵称信息',
        cancelText:'拒绝',
        confirmText:'同意',
        isShow:true

    },
    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        if(options.report_id){
            this.setData({
                report_id: options.report_id
            })
        }
        this.verifyLogin();
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
     * 绑定用户授权获取用户信息
     * @param e
     * @returns {boolean}
     * @private
     */
    bindgetuserinfo: function (e) {
        var that = this;
        if (!e.detail.userInfo) {
            that.showDialog();
        } else {
            app.globalData.userInfo = e.detail.userInfo;
            app.globalData.encryptedData=e.detail.encryptedData;
            app.globalData.iv=e.detail.iv;
            that.setData({
                userInfo: e.detail.userInfo,
                isShow:false
            }, function () {
                that.goLoginOrIndex();
            })

        }
    },
    verifyLogin: function () {
        var that = this;
        if (app.globalData.userInfo) {
            that.setData({
                userInfo: app.globalData.userInfo,
                isShow: false
            }, function () {
                that.goLoginOrIndex();
            })
        } else if (that.data.canIUse) {
            //that.auth();
            // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
            // 所以此处加入 callback 以防止这种情况
            app.userInfoReadyCallback = res => {

                app.globalData.encryptedData=res.encryptedData;
                app.globalData.iv=res.iv;
                app.globalData.userInfo = res.userInfo;
                that.setData({
                    userInfo: res.userInfo,
                    isShow: false
                }, function () {
                    that.goLoginOrIndex();
                })
            }
        } else {
            // 在没有 open-type=getUserInfo 版本的兼容处理
            wx.getUserInfo({
                success: res => {
                    app.globalData.userInfo = res.userInfo;
                    app.globalData.encryptedData=res.encryptedData;
                    app.globalData.iv=res.iv;
                    that.setData({
                        userInfo: res.userInfo,
                        isShow: false
                    }, function () {
                        that.goLoginOrIndex();
                    })
                }
            })
        }

    },
    /**
     * 验证是否注册
     * @returns {boolean}
     */
    goLoginOrIndex: function () {
        var that = this;

        wx.login({
            success: res => {
                let url = app.globalData.url + 'Central/decryption';
                let data = {
                    report_id: that.data.report_id,
                    code:res.code,
                    encryptedData:app.globalData.encryptedData,
                    iv:app.globalData.iv
                };
                app.post(url, data).then((re) => {
                    getApp().globalData.unionid = re.unionid;
                    getApp().globalData.openid = re.openid;
                    if(re.type == 3){
                        wx.redirectTo({
                            url: '../login/login?report_id=' + re.report_id,
                        })
                    }else{
                        if(re.show_type == 1){
                            //进入营养页面
                            wx.redirectTo({
                                url: '../nutrition/nutrition?report_id=' + re.report_id,
                            })

                        }else if(re.show_type == 2){
                            if(re.type == 1){
                                wx.redirectTo({
                                    url: '../circle/circle?report_id=' + re.report_id,
                                })
                            }else if(re.type == 2){
                                wx.redirectTo({
                                    url: '../pay/pay?report_id=' + re.report_id,
                                })
                            }
                        }
                    }
                }).catch((errMsg) => {

                    util.showError(errMsg);
                });
                return false;
            }
        })


    },
    /**
     * 展示授权弹窗
     */
    showDialog: function () {
        var that = this;
        that.setData({
            isShow:true
        })
    },
    /**
     * 隐藏授权弹窗
     */
    cancelEvent: function () {
        var that = this;
        that.setData({
            isShow:false
        })
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