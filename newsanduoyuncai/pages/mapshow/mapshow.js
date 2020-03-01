const app = getApp();
const util = require('../../utils/util.js');
Page({
    data: {
        report_id: '',
        Height: 0,
        scale: 13,
        latitude: "",
        longitude: "",
        markers: [],
        icon_share: app.globalData.url+'public/wechartApp/image/img/share.png?v=1',//分享图标
        sharemask: true,//分享遮罩
        user: '',
        shareSrc: app.globalData.url+'public/wechartApp/image/img/share_bg.png?v=1',
        ispaIcon:app.globalData.url+'public/wechartApp/image/img/ispa.jpg?v=1'
    },

    onLoad: function (options) {
        var that = this;
        that.setData({
            report_id: options.report_id
        },function () {
            let _markers = that.getRobotMapInfo();
        })
    },
    getRobotMapInfo: function (e) {

        var that = this;
        var data = {report_id: that.data.report_id};//要传的数组对象
        var url = app.globalData.url+'Mapshow/index';
        wx.showLoading({
            title: '加载中...',
        })

        app.post(url, data).then((res) => {
            var marker = [];
            for (let item of res.xiaoUInfo.data) {
                let marker_child = that.createMarker(item);
                marker.push(marker_child)
            }
            that.setData({
                user: res.report,
                markers: marker
            })
            that.drawMap();
            wx.hideLoading();

        }).catch((errMsg) => {
            wx.hideLoading();
        });
        return false;
    },
    createMarker: function (point) {
        let latitude = point.latitude;
        let longitude = point.longitude;
        let marker = {
            iconPath: "../../image/xiaou2.png",
            id: point.company_children_id || 0,
            name: point.name || '',
            title: point.name || '',
            latitude: latitude,
            longitude: longitude,
            width: 30,
            height: 30,
            callout: {
                content: point.name + '\n 地址: ' + point.address + '\n 电话: ' + point.telephone,
                fontSize: 14,
                padding: 10,
                borderRadius: 10
            }
        };

        return marker;
    },
    drawMap: function () {
        var that = this;
        wx.getSystemInfo({
            success: function (res) {
                //设置map高度，根据当前设备宽高满屏显示
                that.setData({
                    view: {
                        Height: res.windowHeight
                    }
                })
            }
        })

        wx.getLocation({
            type: 'wgs84', // 默认为 wgs84 返回 gps 坐标，gcj02 返回可用于 wx.openLocation 的坐标
            success: function (res) {
                let current = [{
                    id: "1",
                    latitude: res.latitude,
                    longitude: res.longitude,
                    label: {
                        content: '您的位置',
                        fontSize: 14,
                        borderWidth: 1,
                        borderColor: '#FF0000DD',
                        anchorX: 20,
                        anchorY: -20,
                        bgColor: '#FFFFFF',
                        padding: 2
                    }
                }];
                let markers = current.concat(that.data.markers);
                that.setData({
                    latitude: res.latitude,
                    longitude: res.longitude,
                    markers: markers
                })
            }
        })
    },
    markertap: function (e) {

    },
// 页面显示
    onShow: function () {
        // 1.创建地图上下文，移动当前位置到地图中心
        this.mapCtx = wx.createMapContext("map"); // 地图组件的id
        this.movetoPosition()
    },
    // 定位函数，移动位置到地图中心
    movetoPosition: function () {
        this.mapCtx.moveToLocation();
    },
    /**
     * 分享图片变化，遮罩提示
     * @param e
     */
    share: function (e) {
        let that = this;
        that.setData({
            icon_share: app.globalData.url+'public/wechartApp/image/img/share_curr.png?v=1',
            sharemask: false
        })
    },
    /**
     * 关闭分享遮罩
     * @param e
     */
    closeShare: function (e) {
        let that = this;
        that.setData({
            icon_share: app.globalData.url+'public/wechartApp/image/img/share.png?v=1',
            sharemask: true
        })
    },
    /**
     * 转发给好友
     * @param res
     * @returns {{title: string, path: string, success: success}}
     */
    onShareAppMessage: function (res) {
        let that = this;
        if (res.from === 'button') {
            // 来自页面内转发按钮
            (res.target)
        }
        return {
            title: '我在你的身边藏了个智能体检机器人，快来找一找。',
            path: '/pages/mapshow/mapshow?report_id=' + that.data.report_id,
            success: function (e) {
                wx.showToast({
                    title: '转发成功',
                    icon: 'succes',
                    duration: 1000,
                    mask: true
                })
            }
        }
    },

})
