const axios = require('axios');
import url from "@/utils/url";

/**
 * @param params  url:请求url
 *                setUpUrl : 是否第三方地址
 *                type :请求类型
 *                data : 请求参数
 *                sCallback : 成功的回调
 *                eCallback : 失败的回调
 */

const http_request = function (params) {
    let request_url = url.restUrl + params.url;
    if(!params.type){
        params.type='GET';
    }

    /*不需要再次组装地址,可能是第三方的地址*/
    if(params.setUpUrl == false){
        request_url = params.url;
    }


    axios({
        url: request_url,//请求地址
        data: params.data,//请求数据
        method:params.type,//请求方法 GET POST 等
        headers : {
            'content-type': 'application/json',
            'Accept' : 'application/json',
            'X-Session-Id' : window.localStorage['sessionId'],//登录的token
        },
    })
    .then(function (response) {
        params.sCallback && params.sCallback(response.data);
    })
    .catch(function (error) {
        params.eCallback && params.eCallback(error.data);
    });
};




export { http_request }