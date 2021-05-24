module.exports = {
  publicPath: process.env.NODE_ENV === 'production'? '/': '/',

  // 解决开发环境启动的 https，服务端接口是 http 造成跨域的问题。
  devServer: {
    open: true,
    host: 'localhost',
    port: 8081,
    https: false,
    proxy: {
      '/api': {
        target: "http://127.0.0.1:9501/api/",  // 配置到服务器后端的API头部
        ws: true,
        pathRewrite: {
          '^/api': ''  // 路径重写，第一个与上面相同，第二个/queue-admin 为server.context-path（服务器的上下文）
        },
        // 以下解决https 访问问题。上面的可以访问http
        changeOrigin: true,
        secure: false
      },
      '/ws': {
        target: 'ws://127.0.0.1:9502/ws',//后端目标接口地址
        changeOrigin: true,//是否允许跨域
        pathRewrite: {
          '^/ws': '',//重写,
        },
        ws: true //开启ws, 如果是http代理此处可以不用设置
      },
      '/im': {
        target: 'ws://127.0.0.1:9502/im',//后端目标接口地址
        changeOrigin: true,//是否允许跨域
        pathRewrite: {
          '^/im': '',//重写,
        },
        ws: true //开启ws, 如果是http代理此处可以不用设置
      }
    }
  }
}
