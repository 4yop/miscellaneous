
import { http_request } from "@/utils/http_request";
import  url from "@/utils/url";


const login = function (username,password) {
    let params = {
        url  : url.login,
        data : {
            username : username,
            password : password
        },
        type : 'POST',
        sCallback : function (res) {
            if (res.code == 0)
            {
                window.localStorage['sessionId'] = res.token;
                status();
                setTimeout(()=>{
                    window.location.reload();
                },1000);
            }
        },
        eCallback : function (res) {
            alert(res.message ? res.message : '登录失败');
        },
    };//end params
    http_request(params);
};

const register = function (username,password) {
    let params = {
        url  : url.register,
        data : {
            username : username,
            password : password
        },
        type : 'POST',
        sCallback : function (res) {
            alert(res.message ? res.message : '注册成功');
        },
        eCallback : function (res) {
            alert(res.message ? res.message : '注册失败');
        },
    };//end params
    http_request(params);
};

const status = function (){
    let params = {
        url  : url.member,
        type : 'GET',
        sCallback : function (res) {
            window.localStorage['member'] = res.data;
        },
        eCallback : function (res) {
            alert("未登录");
        },
    };//end params
    http_request(params);
};

const is_login = function () {
    return window.localStorage['member'] ? true : false;
};

export { login,register,is_login }