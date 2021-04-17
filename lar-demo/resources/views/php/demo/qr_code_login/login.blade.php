<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" type="text/css" href="/css/vertical_horizontal_center.css">
        <script src="/js/axios.js"></script>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .title{
                width:100px;
            }
            .v-h-center{
                background-color: #FFF;
            }
        </style>
    </head>
    <body >
        <div class="v-h-center">
            <p >扫码登录</p>
            <div>
                <img class="qr_code_img" src="/img/loading.png" width="100%" height="100%" >
            </div>
        </div>
    </body>
</html>

<script>
    var img = document.querySelector('.qr_code_img');

    get_code();

    setInterval(function(){
        get_code();
    },15000);

    function get_code()
    {
        let url = "{{ route('qr_code_login.code') }}";
        img.src = "/img/loading.png";
        axios.get(url)
            .then(function (response) {
                if (response &&  response.data.code == 1) {
                    let data = response.data.data;
                    if (data.qr_code)
                    {
                        img.src = data.qr_code;
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }


    check();
    function check()
    {
        let url = "{{ route('qr_code_login.check') }}";
        axios.get(url)
            .then(function (response) {
                if (response &&  response.data.code == 1) {
                    alert("登录成功");
                    window.location.reload();
                    return;
                }else{
                    setTimeout(function(){
                        check();
                    },1000);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }
</script>

