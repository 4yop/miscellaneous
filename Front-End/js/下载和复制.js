function copyText(dom) {
    let text = $(dom).data('url');
    console.log(text);
    if (text == '' || text == undefined)
    {
        layer.msg('复制失败,内容为空');
        return;
    }
    let input = document.getElementById("copy_tmp");
    input.value = text; // 修改文本框的内容
    input.select(); // 选中文本
    document.execCommand("copy"); // 执行浏览器复制命令
    layer.msg('复制成功');
}


function downloadIamge(dom)
{//下载图片地址和图片名
    let src = $(dom).data('src');
    let name = $(dom).data('name');

    let image = new Image();
    // 解决跨域 Canvas 污染问题
    image.setAttribute("crossOrigin", "anonymous");
    image.onload = function() {
        let canvas = document.createElement("canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        let context = canvas.getContext("2d");
        context.drawImage(image, 0, 0, image.width, image.height);
        let url = canvas.toDataURL("image/png"); //得到图片的base64编码数据
        let a = document.createElement("a"); // 生成一个a元素
        let event = new MouseEvent("click"); // 创建一个单击事件
        a.download = name || "photo"; // 设置图片名称
        a.href = url; // 将生成的URL设置为a.href属性
        a.dispatchEvent(event); // 触发a的单击事件
    };
    image.src = src;
}