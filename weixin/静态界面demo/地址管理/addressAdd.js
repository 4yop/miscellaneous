var util = require("../../utils/util.js"), status = require("../../utils/index.js"), wcache = require("../../utils/wcache.js"), app = getApp();

Page({
  data:{
   
    name: '',
    mobile: '',
    zip_code: '',
    province: '',
    city: '',
    area: '',
    detail: '',
    id : 0,
    autoKnowText: '',
    nvabarData: {
      titlename: '添加地址',
    }
  },
  onLoad: function (e) {

    this.setData({
      name: e.name,
      mobile: e.mobile,
      zip_code: e.zip_code,
      province: e.province,
      city: e.city,
      area: e.area,
      detail: e.detail,
    });

    var id = e.id && e.id > 0 ? e.id : 0;
    if (id > 0){
    this.setData({
       id : id,
      nvabarData: {
        titlename: '编辑地址',
      }
    }),this.getData();
    }
  },

  //start getData 获取地址信息
  getData:function(){
    var that = this;
    
    app.util.request({
      url: "entry/wxapp/user",
      data: {
        controller: "address.one",
        id: that.data.id,
        token: wx.getStorageSync('token'),
      },
      dataType: "json",
      method: "get",
      success: function (res) {
        var res = res.data;
        if(res.code == 0 && res.data){
          var data = res.data;
          that.setData({
            'name': data.name,
            'mobile': data.mobile,
            'province': data.province,
            'city': data.city,
            'area': data.area,
            'detail': data.detail,
            'zip_code': data.zip_code,
          });
        }
        
      }
    }); 
  }, //end getData

  //start bindNameInput 输入收获人姓名
  bindNameInput:function(e){
    this.setData({
      name: e.detail.value.trim(),
    });  
  },//end bindNameInput

  //start bindMobileInput 输入手机
  bindMobileInput: function (e) {
    this.setData({
      mobile: e.detail.value.trim(),
    });
  },//end bindMobileInput

  //start bindZipCodeInput 输入邮编
  bindZipCodeInput: function (e) {
    this.setData({
      zip_code: e.detail.value.trim(),
    });
  },//end bindZipCodeInput

  //start bindAddressInput 输入详情地址
  bindAddressInput: function (e) {
    this.setData({
      detail: e.detail.value.trim(),
    });
  },//end bindAddressInput

  //start changeRegion 选择地区
  changeRegion:function(e){
    var region = e.detail.value;
    this.setData({
      province: region[0],
      city: region[1],
      area: region[2],
    });
  },//end changeRegion

  //自动识别 start
  autoKnow: function (e) {
    var t = this;
    t.setData({
      autoKnowText: e.detail.value,
    });
    app.util.request({
      url: "entry/wxapp/user",
      data: {
        controller: "address.auto_know",
        text: e.detail.value,
        token: wx.getStorageSync('token'),
      },
      dataType: "json",
      method: "get",
      success: function (res) {
        console.log(res.data);
        var newData = res.data,
          oldData = t.data;//原来的收件人信息
        t.setData({
          'name': newData.name ? newData.name : oldData.name,
          'mobile': newData.mobile ? newData.mobile : oldData.mobile,
          'province': newData.province ? newData.province : '',
          'city': newData.province ? newData.city : '',
          'area': newData.province ? newData.area : '',
          'detail': newData.detail ? newData.detail : oldData.detail,
          'zip_code': newData.postcode ? newData.postcode : oldData.zip_code,
        });
      }
    });
  },//自动识别 end
 
 
 
 

  //start   addAddress 提交表单
  addAddress:function(){
    var data = this.data,
        that = this,
        token = wx.getStorageSync('token'),
        data = that.data;
    this.inputValidate();    
    if(!token){
      wx.showToast({
        title:  "请先登录",
        icon: 'none',
        duration: 2000,
      });
    }  
    wx.showLoading({
      title: '请求中',
    })
    //请求start
    app.util.request({
      url: "entry/wxapp/user",
      data: {
        controller: "address.save",
        token: token,
        name: data.name,
        mobile: data.mobile,
        province: data.province,
        city: data.city,
        area: data.area,
        detail: data.detail,
        zip_code : data.zip_code,
        id : data.id,
      },
      method : 'post',
      dataType: "json",
      success: function (res) {
        if(res.code == 0){
          var msg = res.data.msg ? res.data.msg : '操作成功';
        }else{
          var msg = res.data.msg ? res.data.msg : '操作失败';  
        }
        that.msgBox(msg);
      },//success
      fail:function(res){
        wx.hideLoading();
        that.msgBox('操作失败');
      }
    });//请求end


  },//end address
  
  inputValidate:function(){
    var data = this.data,
        name = data.name,
        mobile = data.mobile,
        province = data.province,
        city = data.city,
        area = data.area,
        detail = data.detail;
        console.log(data);
    if (!name || name.length < 0){
      this.msgBox("收货人必须输入");return;
    }
    if (!mobile || mobile.length < 0) {
      this.msgBox("手机号必须输入"); return;
    }
    if(util.checkPhone(mobile) === false) {
      this.msgBox("手机号格式有误"); return;
    }
    if (!province || !city || !area) {
      this.msgBox("请选择地区"); return;
    }
    if (!detail || name.detail < 0) {
      this.msgBox("请输入详细地址"); return;
    }
  },

  msgBox:function(title){
    wx.showToast({
      title: title,
      icon: 'none',
      duration: 2000,
    });
  },
  
 
  

  
  
});