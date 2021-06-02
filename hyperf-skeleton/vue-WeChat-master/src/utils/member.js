
import { http_request } from "@/utils/http_request";
import  url from "@/utils/url";
import localforage from 'localforage';

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
                localforage.setItem('sessionId',res.token).then(()=>{
                    status();
                    setTimeout(()=>{
                        window.location.reload();
                    });
                });

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
            localforage.setItem('member',res.data)
        },
        eCallback : function (res) {
            alert("未登录");
        },
    };//end params
    http_request(params);
};
;
const is_login = function () {
    return localforage.getItem('member', function(err, value) {
        return value ? true : false;
    });
};

export { login,register,is_login }