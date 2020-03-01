//app.js
App({

    globalDatas: {

    },
    onLaunch: function () {
      var that = this
        // 展示本地存储能力
        /*    var logs = wx.getStorageSync('logs') || []
            logs.unshift(Date.now())
            wx.setStorageSync('logs', logs)*/

        // 登录
        wx.login({
            success: res => {
                // 发送 res.code 到后台换取 openId, sessionKey, unionId
                that.globalData.code = res.code;

              // var d = that.globalData;
              // var l = 'https://api.weixin.qq.com/sns/jscode2session?appid=' + d.appid + '&secret=' + d.secret + '&js_code=' + that.globalData.code +'&grant_type=authorization_code';
              // wx.request({
              //   url: l,
              //   data: {},
              //   method: 'GET',
              //   success: function (e) {
              //     console.log(e);
              //     that.globalData.openid = e.data.openid;
              //     that.globalData.session_key = e.data.session_key;
                  // var obj = {};
                  // obj.openid = res.data.openid;
                  // obj.expires_in = Date.now() + res.data.expires_in;
                  // //console.log(obj);
                  // wx.setStorageSync('user', obj);//存储openid 
              //   }
              // });

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
      }
      let url = 'http://api.ispa.local/login/getWechartAppOpenid';
      _this.post(url, data).then((res) => {
        console.log(res);
        _this.globalData.openid = res.openid;
        _this.globalData.unionid = res.unionid;
      }).catch((errMsg) => {
        console.log(errMsg);
        wx.hideLoading();
      });
    },
    /**
     * ajax公共请求方法
     * @param url
     * @param data
     * @returns {boolean}
     */
    post: function (url, data){
/*        var check = new Object();
        check['agentId'] = '1868569939';
        check['agentKey'] = '0f11a2cdf1b205c1c3be8bf5fe04d5ffad5661bf';
        check['timestamp'] = parseInt(new Date().getTime() / 1000);
        check['sign'] = this.authSign(check);*/

        var promise = new Promise((resolve, reject) => {
            var that = this;
/*            data['agentId'] = check['agentId'];
            data['agentKey'] = check['agentKey'];
            data['timestamp'] = check['timestamp'];
            data['sign'] = check['sign'];*/
            var postData = data;
            wx.request({
                url: url,
                data: postData,
                method: 'POST',
                header: {'content-type': 'application/x-www-form-urlencoded'},
                success: function (res) {//服务器返回数据
                    if (res.data.status == true) {//res.data 为 后台返回数据，格式为{"data":{...}, "msg":"success", "status":true}, 后台规定：如果status为true,既是正确结果。可以根据自己业务逻辑来设定判断条件
                        resolve(res.data.data);
                    } else {
                        reject(res.data.msg);
                    }
                },
                error: function (e) {
                    reject('网络出错');
                }
            })
        });
        return promise;
    },
    globalData: {
        userInfo: null,
        apiUrl: null,
        encryptedData: '',
        iv: '',
        code: '',
        openid: '',
        unionid: '',
      // appid: 'wx300dfad01974a9e1',
      // secret: '02203c9cad88463fa12d44e039ee84bc',
    }
})