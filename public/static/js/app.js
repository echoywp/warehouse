new Vue({
    el: '#app',
});


// 通过 CDN 引入时不会自动注册 Lazyload 组件
// 可以通过下面的方式手动注册
Vue.use(vant.Lazyload);
