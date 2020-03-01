//app.js
var md5 = require('./utils/md5.js');
var util = require('./utils/util.js');
App({
    globalData: {
        userInfo: '',
/*        appid: 'wxfe0c241198923c27',
        secret: 'be421d5b5d5dab46c454e7ea2c205986',*/
        url:'https://api.sanduoyuncai.com/',//正式服务器
        //url:'http://www.api.com/',
        encryptedData:'',
        iv:'',
        code:'',
        openid:'',
        unionid:''
    },
    onLaunch: function (e) {
        // 展示本地存储能力
        // var logs = wx.getStorageSync('logs') || []
        // logs.unshift(Date.now())
        // wx.setStorageSync('logs', logs)
        // 登录
        wx.login({
            success: res => {
                // 发送 res.code 到后台换取 openId, sessionKey, unionId
                this.globalData.code = res.code;
            }
        })
        // 获取用户信息
        wx.getSetting({
            success: res => {
                if (res.authSetting['scope.userInfo']) {
                    // 已经授权，可以直接调用 getUserInfo 获取头像昵称，不会弹框
                    wx.getUserInfo({
                        success: res => {
                            // 可以将 res 发送给后台解码出 unionId
                            this.globalData.userInfo = res.userInfo;
                            this.globalData.encryptedData = res.encryptedData;
                            this.globalData.iv = res.iv;

                            // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
                            // 所以此处加入 callback 以防止这种情况
                            if (this.userInfoReadyCallback) {
                                this.userInfoReadyCallback(res)
                            }
                        }
                    })
                }
            }
        })
    },
    /**
     * 获取openid
     * @param code
     */
    getopenid: function (code) {
        var _this = this;
        var data = {
            code: code,
            appid: _this.globalData.appid,
            secret: _this.globalData.secret
        }
        let url = _this.globalData.url+'Central/getWechartAppOpenid';
        _this.post(url, data).then((res) => {
            _this.globalData.openid = res.openid;
            _this.globalData.unionid = res.unionid;
        }).catch((errMsg) => {
            console.log(errMsg);
            wx.hideLoading();
        });
    },

// var url ='http://api.ispa.local/login/getWechartAppOpenid';
// var data={
//     code: res.code
// }
// that.post(url, data).then((res) => {
//     console.log(res);
// that.globalData.openid = res.openid;
// that.globalData.session_key = res.session_key;
// }).catch((errMsg) => {
//     console.log(errMsg)
// });
    /**
     * 公共请求方法
     * @param url
     * @param data
     * @returns {boolean}
     */
    post: function (url, data) {
        var check = new Object();
        check['agentId'] = '1868569939';
        check['agentKey'] = '0f11a2cdf1b205c1c3be8bf5fe04d5ffad5661bf';
        check['timestamp'] = parseInt(new Date().getTime() / 1000);
        check['sign'] = this.authSign(check);

        var promise = new Promise((resolve, reject) => {
            var that = this;
            data['agentId'] = check['agentId'];
            data['agentKey'] = check['agentKey'];
            data['timestamp'] = check['timestamp'];
            data['sign'] = check['sign'];
            var postData = data;
            wx.request({
                url: url,
                data: postData,
                method: 'POST',
                header: {'content-type': 'application/x-www-form-urlencoded'},
                success: function (res) {//服务器返回数据
                    console.log(res.data);
                    if (res.data.status == 1) {//res.data 为 后台返回数据，格式为{"data":{...}, "info":"成功", "status":1}, 后台规定：如果status为1,既是正确结果。可以根据自己业务逻辑来设定判断条件
                        resolve(res.data.data);
                    } else {
                        reject(res.data.info);
                    }
                },
                error: function (e) {
                    reject('网络出错');
                }
            })
        });
        return promise;
    },
    authSign: function (e) {
        util.ksort(e);
        return md5.hexMD5(util.build_query(e) + e['agentKey']);
    }
})