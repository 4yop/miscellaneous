//显示临时图片
  function loadImg () {
    let that = this;
    //获取文件
    var obj = document.querySelector('#upload_file');
    var file = obj.files[0];
    //创建读取文件的对象
    var reader = new FileReader();
    //为文件读取成功设置事件
    reader.onload=function(e) {
        var imgSrc = e.target.result;
        $('#pic_show').html('<img src="'+imgSrc+'"/><span></span>');
    };
    $('#pic_show img').show();
    //正式读取文件
    reader.readAsDataURL(file);
} //end loadImg