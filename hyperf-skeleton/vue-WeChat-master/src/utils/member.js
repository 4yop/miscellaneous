
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
            }
            console.log(res);
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
            console.log(res);
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

export { login,register }