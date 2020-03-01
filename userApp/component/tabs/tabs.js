Component({
    options:{
        multipleSlots: true
    },
    relations:{
        './tab/tab':{
            type:'child',
            linked: function(target) {
                // console.log(target)
                this.data.listTitles.push(target.data.title);
                this.setData({
                    listTitles: this.data.listTitles
                })
            }
        }
    },
    /**
     * 组件的属性列表
     */
    properties: {
        infoid:{
            type:String,
            value:''
        },
        role:{
          type: String,
          value: ''
        }
    },

    /**
     * 组件的初始数据
     */
    data: {
        listTitles:[],
        activeIndex: 0,

    },
    ready:function(){
        var nodes = this.getRelationNodes('./tab/tab');
        let noActive = nodes.every(function(v){
            return v.getActive() == false;
        })
        if(noActive){
            nodes[0]._active(true);
            return;
        }
        nodes.map((v,i)=>{
            if(nodes[i].getActive()){
                nodes[i]._active(true);
                this.setData({activeIndex: i})
            }
        })
    },
    /**
     * 组件的方法列表
     */
    methods: {
        action(event) {
            let { activeIndex} = this.data;
            let idx = event.currentTarget.dataset.idx;

            if (activeIndex == idx) return;
            activeIndex = idx;
            let nodes = this.getRelationNodes('./tab/tab');
            nodes.map((v,i)=>{
                nodes[i]._active(activeIndex == i)
            })
            activeIndex = idx;

            this.setData({
                activeIndex: activeIndex
            });
     
            this.triggerEvent('change', event.currentTarget.dataset);

        }
    }
})