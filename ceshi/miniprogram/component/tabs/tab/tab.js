// component/Tabs/tab/tab.js
Component({

    relations:{
        '../tabs':{
            type: 'parent',
        }
    },

    properties: {
        title: String,
        active :{
            type: Boolean,
            value:false
        },
    },
    /**
     * 组件的初始数据
     */
    data: {
        visiable: false,
    },

    /**
     * 组件的方法列表
     */
    methods: {
        _active:function(arg){
            if(arg){
                this.setData({
                    visiable:true
                })
            } else {
                this.setData({
                    visiable:false
                })
            }
        },
        getActive:function(){
            return this.properties.active;
        }
    }
})