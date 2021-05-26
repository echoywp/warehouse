import axios from "axios";

// 环境
axios.defaults.baseURL = 'http://test.warehouse.com/'   //  要请求的后台地址
// 请求超时
axios.defaults.timeout = 30000
var HttpRequest = {
    getRequest({ url, data = {}, method = "GET" }) {
        return new Promise((resolve, reject) => {
            this._getRequest(url, resolve, reject, data, method);
        });
    },
    _getRequest: function(url, resolve, reject, data = {}, method = "GET") {
        let format = method.toLocaleLowerCase() ==='get'?'params':'data';
        axios({
            url: url,
            method: method,
            [format]: data,
            header: {
                "content-type": "application/json"
            }
        }).then(res => {
            resolve(res);
        }).catch(error => {
            reject(error);
        })
    }
};
export { HttpRequest };
