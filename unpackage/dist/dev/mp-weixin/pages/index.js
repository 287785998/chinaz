(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pages/index"],{176:function(e,t,n){"use strict";(function(e,t){var i=n(4);n(26);i(n(25));var s=i(n(177));e.__webpack_require_UNI_MP_PLUGIN__=n,t(s.default)}).call(this,n(1)["default"],n(2)["createPage"])},177:function(e,t,n){"use strict";n.r(t);var i=n(178),s=n(180);for(var o in s)["default"].indexOf(o)<0&&function(e){n.d(t,e,(function(){return s[e]}))}(o);n(183);var a,r=n(45),c=Object(r["default"])(s["default"],i["render"],i["staticRenderFns"],!1,null,null,null,!1,i["components"],a);c.options.__file="pages/index.vue",t["default"]=c.exports},178:function(e,t,n){"use strict";n.r(t);var i=n(179);n.d(t,"render",(function(){return i["render"]})),n.d(t,"staticRenderFns",(function(){return i["staticRenderFns"]})),n.d(t,"recyclableRender",(function(){return i["recyclableRender"]})),n.d(t,"components",(function(){return i["components"]}))},179:function(e,t,n){"use strict";var i;n.r(t),n.d(t,"render",(function(){return s})),n.d(t,"staticRenderFns",(function(){return a})),n.d(t,"recyclableRender",(function(){return o})),n.d(t,"components",(function(){return i}));try{i={topMenu:function(){return n.e("components/top-menu/top-menu").then(n.bind(null,314))},uSticky:function(){return Promise.all([n.e("common/vendor"),n.e("uni_modules/uview-ui/components/u-sticky/u-sticky")]).then(n.bind(null,321))},uTabs:function(){return Promise.all([n.e("common/vendor"),n.e("uni_modules/uview-ui/components/u-tabs/u-tabs")]).then(n.bind(null,329))},uSwiper:function(){return Promise.all([n.e("common/vendor"),n.e("uni_modules/uview-ui/components/u-swiper/u-swiper")]).then(n.bind(null,337))},articleList:function(){return Promise.all([n.e("common/vendor"),n.e("components/article-list/article-list")]).then(n.bind(null,345))},uLoadmore:function(){return Promise.all([n.e("common/vendor"),n.e("uni_modules/uview-ui/components/u-loadmore/u-loadmore")]).then(n.bind(null,352))},uBackTop:function(){return Promise.all([n.e("common/vendor"),n.e("uni_modules/uview-ui/components/u-back-top/u-back-top")]).then(n.bind(null,360))},zTabbar:function(){return n.e("components/z-tabbar/z-tabbar").then(n.bind(null,368))}}}catch(r){if(-1===r.message.indexOf("Cannot find module")||-1===r.message.indexOf(".vue"))throw r;console.error(r.message),console.error("1. 排查组件名称拼写是否正确"),console.error("2. 排查组件是否符合 easycom 规范，文档：https://uniapp.dcloud.net.cn/collocation/pages?id=easycom"),console.error("3. 若组件不符合 easycom 规范，需手动引入，并在 components 中注册该组件")}var s=function(){var e=this,t=e.$createElement;e._self._c},o=!1,a=[];s._withStripped=!0},180:function(e,t,n){"use strict";n.r(t);var i=n(181),s=n.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){n.d(t,e,(function(){return i[e]}))}(o);t["default"]=s.a},181:function(e,t,n){"use strict";(function(e){Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var i=n(182),s={data:function(){return{keywords:"",classid:2,page:1,pagesize:10,list:[],slist:[],current:0,status:"loading",navinfo:{classname:"新闻动态"},scrollTop:0,classlist:[{name:"全部",classid:2},{name:"视频",classid:4,tbname:"movie"}],showswiper:!0,siteinfo:{}}},onLoad:function(t){e.hideTabBar(),this.getNewsList(),this.getClassList(),this.getSwiperList(),e.getStorageSync("siteinfo")&&(this.siteinfo=e.getStorageSync("siteinfo"),e.setNavigationBarTitle({title:this.siteinfo.sitename}))},onPageScroll:function(e){this.scrollTop=e.scrollTop},onReachBottom:function(){this.isLastPage||this.getNewsList()},onPullDownRefresh:function(){this.page=1,this.list=[],this.getNewsList()},methods:{navTo:function(t){e.navigateTo({url:"/pages/msg/details?id="+t.id})},search:function(e){this.keywords=e,this.page=1,this.list=[],this.getNewsList()},clear:function(){this.keywords="",this.page=1,this.list=[],this.getNewsList()},getNavClassInfo:function(){var t=this;(0,i.geNavClassInfo)({classid:this.classid}).then((function(n){"1"==n.code&&(t.navinfo=n.list,e.setNavigationBarTitle({title:n.list.classname}))}))},getClassList:function(){var e=this;(0,i.getClassList)({classid:2}).then((function(t){t.list&&t.list.length>0&&t.list.forEach((function(e){e.name=e.classname})),e.classlist=e.classlist.concat(t.list)})).catch((function(e){}))},tabClass:function(t){console.log(t),2!=t.classid?this.showswiper=!1:this.showswiper=!0,4==t.classid&&e.reLaunch({url:"/pages/movie/list?id="+t.classid}),"news"==t.tbname?e.reLaunch({url:"/pages/article/list?id="+t.classid}):"movie"==t.tbname&&e.reLaunch({url:"/pages/movie/list?id="+t.classid})},getNewsList:function(){var t=this;(0,i.getNewsList)({page:this.page,pagesize:this.pagesize,classid:this.classid,keyword:this.keywords}).then((function(n){e.stopPullDownRefresh(),e.hideLoading(),"1"==n.code&&(n.data.list.length<t.pagesize&&(t.isLastPage=!0,t.status="nomore"),t.list=t.list.concat(n.data.list),t.page=t.page+1,t.isLoading=!1)}))},getSwiperList:function(){var e=this;(0,i.getNewsList)({page:1,pagesize:5,classid:2}).then((function(t){"1"==t.code&&(e.slist=t.data.list)}))}}};t.default=s}).call(this,n(2)["default"])},183:function(e,t,n){"use strict";n.r(t);var i=n(184),s=n.n(i);for(var o in i)["default"].indexOf(o)<0&&function(e){n.d(t,e,(function(){return i[e]}))}(o);t["default"]=s.a},184:function(e,t,n){}},[[176,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../.sourcemap/mp-weixin/pages/index.js.map