(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pages/movie/list"],{298:function(e,n,t){"use strict";(function(e,n){var s=t(4);t(26);s(t(25));var i=s(t(299));e.__webpack_require_UNI_MP_PLUGIN__=t,n(i.default)}).call(this,t(1)["default"],t(2)["createPage"])},299:function(e,n,t){"use strict";t.r(n);var s=t(300),i=t(302);for(var o in i)["default"].indexOf(o)<0&&function(e){t.d(n,e,(function(){return i[e]}))}(o);t(304);var a,r=t(45),c=Object(r["default"])(i["default"],s["render"],s["staticRenderFns"],!1,null,null,null,!1,s["components"],a);c.options.__file="pages/movie/list.vue",n["default"]=c.exports},300:function(e,n,t){"use strict";t.r(n);var s=t(301);t.d(n,"render",(function(){return s["render"]})),t.d(n,"staticRenderFns",(function(){return s["staticRenderFns"]})),t.d(n,"recyclableRender",(function(){return s["recyclableRender"]})),t.d(n,"components",(function(){return s["components"]}))},301:function(e,n,t){"use strict";var s;t.r(n),t.d(n,"render",(function(){return i})),t.d(n,"staticRenderFns",(function(){return a})),t.d(n,"recyclableRender",(function(){return o})),t.d(n,"components",(function(){return s}));try{s={topMenu:function(){return t.e("components/top-menu/top-menu").then(t.bind(null,314))},uSticky:function(){return Promise.all([t.e("common/vendor"),t.e("uni_modules/uview-ui/components/u-sticky/u-sticky")]).then(t.bind(null,321))},uTabs:function(){return Promise.all([t.e("common/vendor"),t.e("uni_modules/uview-ui/components/u-tabs/u-tabs")]).then(t.bind(null,329))},uSearch:function(){return Promise.all([t.e("common/vendor"),t.e("uni_modules/uview-ui/components/u-search/u-search")]).then(t.bind(null,498))},movieList:function(){return Promise.all([t.e("common/vendor"),t.e("components/movie-list/movie-list")]).then(t.bind(null,530))},uLoadmore:function(){return Promise.all([t.e("common/vendor"),t.e("uni_modules/uview-ui/components/u-loadmore/u-loadmore")]).then(t.bind(null,352))},uBackTop:function(){return Promise.all([t.e("common/vendor"),t.e("uni_modules/uview-ui/components/u-back-top/u-back-top")]).then(t.bind(null,360))},zTabbar:function(){return t.e("components/z-tabbar/z-tabbar").then(t.bind(null,368))}}}catch(r){if(-1===r.message.indexOf("Cannot find module")||-1===r.message.indexOf(".vue"))throw r;console.error(r.message),console.error("1. 排查组件名称拼写是否正确"),console.error("2. 排查组件是否符合 easycom 规范，文档：https://uniapp.dcloud.net.cn/collocation/pages?id=easycom"),console.error("3. 若组件不符合 easycom 规范，需手动引入，并在 components 中注册该组件")}var i=function(){var e=this,n=e.$createElement;e._self._c},o=!1,a=[];i._withStripped=!0},302:function(e,n,t){"use strict";t.r(n);var s=t(303),i=t.n(s);for(var o in s)["default"].indexOf(o)<0&&function(e){t.d(n,e,(function(){return s[e]}))}(o);n["default"]=i.a},303:function(e,n,t){"use strict";(function(e){Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var s=t(182),i={data:function(){return{keywords:"",classid:4,page:1,pagesize:10,list:[],current:0,status:"loading",navinfo:{classname:"新闻动态"},scrollTop:0,classlist:[{name:"全部",classid:4}]}},onLoad:function(e){e.id&&(e.keyword&&(this.keywords=e.keyword),this.classid=e.id),e.current&&(this.current=e.current,this.cl),e.keywords&&(this.keywords=e.keywords),this.getNewsList(),this.getNavClassInfo(),this.getClassList()},onPageScroll:function(e){this.scrollTop=e.scrollTop},onReachBottom:function(){this.isLastPage||this.getNewsList()},onPullDownRefresh:function(){this.page=1,this.list=[],this.getNewsList()},methods:{navTo:function(n){e.navigateTo({url:"/pages/msg/details?id="+n.id})},search:function(e){this.keywords=e,this.page=1,this.list=[],this.getNewsList()},clear:function(){this.keywords="",this.page=1,this.list=[],this.getNewsList()},getNavClassInfo:function(){var n=this;(0,s.geNavClassInfo)({classid:this.classid}).then((function(t){"1"==t.code&&(n.navinfo=t.list,e.setNavigationBarTitle({title:t.list.classname}))}))},getClassList:function(){var e=this;(0,s.getClassList)({classid:4}).then((function(n){n.list&&n.list.length>0&&n.list.forEach((function(e){e.name=e.classname})),e.classlist=e.classlist.concat(n.list)})).catch((function(e){}))},tabClass:function(n){console.log(n.classid),e.showLoading(),this.classid=n.classid,this.page=1,this.list=[],this.getNewsList()},getNewsList:function(){var n=this;(0,s.getMovieList)({page:this.page,pagesize:this.pagesize,classid:this.classid,keyword:this.keywords}).then((function(t){e.stopPullDownRefresh(),e.hideLoading(),"1"==t.code&&(t.data.list.length<n.pagesize&&(n.isLastPage=!0,n.status="nomore"),n.list=n.list.concat(t.data.list),n.page=n.page+1,n.isLoading=!1)}))}}};n.default=i}).call(this,t(2)["default"])},304:function(e,n,t){"use strict";t.r(n);var s=t(305),i=t.n(s);for(var o in s)["default"].indexOf(o)<0&&function(e){t.d(n,e,(function(){return s[e]}))}(o);n["default"]=i.a},305:function(e,n,t){}},[[298,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../../.sourcemap/mp-weixin/pages/movie/list.js.map