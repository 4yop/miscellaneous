var util = require("../../utils/util.js"), status = require("../../utils/index.js"), wcache = require("../../utils/wcache.js"), app = getApp();

Page({
  data: {
    addressData:[],
    nvabarData: {
      titlename: '地址管理',
    },
    page : 1,
    is_load : true,
    loadText: "加载中",
    fromType : 0,
    select_id : 0,
    select_index : 0,
    parame : {},
    onload : 0,
  },
  onLoad: function (e) {
    
    var fromType = e.fromType && e.fromType > 0 ? e.fromType : 0;  //判断从哪个页面进来
    this.setData({
      fromType: fromType,
      parame : e,
      onload : 1,
    });
    this.getAddressList();

  },
  //start getAddressList
  getAddressList:function(){
    var that = this,
        page = that.data.page;
    wx.showLoading({
      title: '加载中',
    })
    app.util.request({
      url: "entry/wxapp/user",
      data: {
        controller: "address.manger",
        token: wx.getStorageSync('token'),
        page: page,
      },
      dataType: "json",
      method: "get",
      success: function (res) {
        if(res.data.data.length > 0){
          var data = that.data.addressData.concat(res.data.data);
          that.setData({
            addressData: data,
            is_load: (res.data.data.length >= 10),
            loadText: res.data.data.length >= 10 ? '加载中' : "—— 没有更多了 ——",
          });
        }else{
          that.setData({
            is_load : false,
            loadText: "—— 没有更多了 ——",
          });
        }
        wx.hideLoading();
      },
      fail: function (res) {
        wx.hideLoading();
        
      }
    });

  },//end getAddressList
  

  onReachBottom:function(){
    if (this.data.is_load){
      this.setData({
        page : this.data.page + 1,
      });
      this.getAddressList();
    }
  },

  onShow: function () {
    if(this.data.onLoad == 0){
      console.log('onshow');
      this.onPullDownRefresh();
    }else{
      this.setData({
        onLoad : 0,
      });
    }
  },
  
  onHide: function () {
    
  },
  
 
  
  
  onPullDownRefresh: function () {
    var that = this;
    that.setData({
      addressData: [],
      page: 1,
      select_id: 0,
      is_load: true,
    }), that.getAddressList();
  },

  //start delAddress
  delAddress:function(e){
    var dataset = e.target.dataset,
        that = this;
    

    wx.showModal({
      title: '提示',
      content: '是否删除该地址',
      success(res) {
        if (res.confirm) {
          
          app.util.request({
            url: "entry/wxapp/user",
            data: {
              controller: "address.del",
              token: wx.getStorageSync('token'),
              id: dataset.id,
            },
            dataType: "json",
            method: "get",
            success: function (res) {
                var code = res.data.code;
                if(code == 0){
                  var msg = res.data.msg ? res.data.msg : '操作成功';
                  var data = that.delObjByIndex(dataset.index, that.data.addressData);
                  that.setData({
                    addressData: data,
                    page : 1,
                    select_id : 0,
                  }),that.getAddressList();
                }else{
                  var msg = res.data.msg ? res.data.msg : '操作失败';
                }
                that.msgBox(msg);

            },
            fail: function (res) {
              wx.hideLoading();

            }
          });

        } else if (res.cancel) {
          
        }
      }
    });//end showModal

  },//end delAddress

  msgBox: function (title) {
    wx.showToast({
      title: title,
      icon: 'none',
      duration: 2000,
    });
  },
  //根据index删除元素
  delObjByIndex:function(index,data){
    data.splice(index, 1);
    return data;
  },//end delObjByIndex
  //上拉刷新 start
  onPullDownRefresh:function(){
    this.setData({
      addressData :  [],
      is_load : true,
      page : 1,
    });
    this.getAddressList();
  },//上拉刷新start
  
   //start getWxAddress
getWxAddress: function () {
  var that = this;
  wx.getSetting({
    success(res) {
      console.log("vres.authSetting['scope.address']：", res.authSetting['scope.address'])
      if (res.authSetting['scope.address']) {
        wx.chooseAddress({
          success(res) {
            wx.showLoading({
              title: '加载中',
            });
            var url = "/qidian_sqlife/pages/user/addressAdd?city=" + res.cityName + "&area=" + res.countyName + "&detail=" + res.detailInfo + "&zip_code=" + res.postalCode + "&mobile=" + res.telNumber + "&name=" + res.userName + '&province=' + res.provinceName; 
            
            console.log(url);
            wx.navigateTo({
              url: url,
            })
            setTimeout(function () {
              wx.hideLoading()
            }, 2000)
            
          }
        })
      } else {
        if (res.authSetting['scope.address'] == false) {
          wx.openSetting({
            success(res) {
              console.log(res.authSetting)
            }
          })
        } else {
          wx.chooseAddress({
            success(res) {
            }
          })
        }
      }
    }
  })//end getSetting
  },//end getWxAddress

  //start checkAddress
  checkAddr:function(e){
    var dataset = e.currentTarget.dataset; 
    console.log(dataset);
    this.setData({
      select_id: dataset.id,
      select_index: dataset.index,
    });
  },//end checkAddress

  //start backOrder
  backOrder:function(){
    var select_id = this.data.select_id,
      select_index = this.data.select_index;
    if (select_id < 1 && select_index >= 0){
      wx.showToast({
        title: '请选择地址',
        icon : 'none',
      });
    }
    var selectAddress = this.data.addressData[select_index];
    wx.setStorage({
      key: 'selectAddress',
      data: selectAddress,
    });
    wx.navigateBack({
      delta : 1,
    });
  },//end backOrder  
});