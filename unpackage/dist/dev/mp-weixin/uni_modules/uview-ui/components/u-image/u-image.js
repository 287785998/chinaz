(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["uni_modules/uview-ui/components/u-image/u-image"],{671:function(n,i,e){"use strict";e.r(i);var t=e(672),r=e(674);for(var o in r)["default"].indexOf(o)<0&&function(n){e.d(i,n,(function(){return r[n]}))}(o);e(676);var u,d=e(45),a=Object(d["default"])(r["default"],t["render"],t["staticRenderFns"],!1,null,"042b391e",null,!1,t["components"],u);a.options.__file="uni_modules/uview-ui/components/u-image/u-image.vue",i["default"]=a.exports},672:function(n,i,e){"use strict";e.r(i);var t=e(673);e.d(i,"render",(function(){return t["render"]})),e.d(i,"staticRenderFns",(function(){return t["staticRenderFns"]})),e.d(i,"recyclableRender",(function(){return t["recyclableRender"]})),e.d(i,"components",(function(){return t["components"]}))},673:function(n,i,e){"use strict";var t;e.r(i),e.d(i,"render",(function(){return r})),e.d(i,"staticRenderFns",(function(){return u})),e.d(i,"recyclableRender",(function(){return o})),e.d(i,"components",(function(){return t}));try{t={uTransition:function(){return Promise.all([e.e("common/vendor"),e.e("uni_modules/uview-ui/components/u-transition/u-transition")]).then(e.bind(null,615))},uIcon:function(){return Promise.all([e.e("common/vendor"),e.e("uni_modules/uview-ui/components/u-icon/u-icon")]).then(e.bind(null,544))}}}catch(d){if(-1===d.message.indexOf("Cannot find module")||-1===d.message.indexOf(".vue"))throw d;console.error(d.message),console.error("1. 排查组件名称拼写是否正确"),console.error("2. 排查组件是否符合 easycom 规范，文档：https://uniapp.dcloud.net.cn/collocation/pages?id=easycom"),console.error("3. 若组件不符合 easycom 规范，需手动引入，并在 components 中注册该组件")}var r=function(){var n=this,i=n.$createElement,e=(n._self._c,n.__get_style([n.wrapStyle,n.backgroundStyle])),t=n.isError||"circle"==n.shape?null:n.$u.addUnit(n.radius),r=n.isError?null:n.$u.addUnit(n.width),o=n.isError?null:n.$u.addUnit(n.height),u=n.showLoading&&n.loading&&"circle"!=n.shape?n.$u.addUnit(n.radius):null,d=n.showLoading&&n.loading?n.$u.addUnit(n.width):null,a=n.showLoading&&n.loading?n.$u.addUnit(n.height):null,s=n.showError&&n.isError&&!n.loading&&"circle"!=n.shape?n.$u.addUnit(n.radius):null,c=n.showError&&n.isError&&!n.loading?n.$u.addUnit(n.width):null,l=n.showError&&n.isError&&!n.loading?n.$u.addUnit(n.height):null;n.$mp.data=Object.assign({},{$root:{s0:e,g0:t,g1:r,g2:o,g3:u,g4:d,g5:a,g6:s,g7:c,g8:l}})},o=!1,u=[];r._withStripped=!0},674:function(n,i,e){"use strict";e.r(i);var t=e(675),r=e.n(t);for(var o in t)["default"].indexOf(o)<0&&function(n){e.d(i,n,(function(){return t[n]}))}(o);i["default"]=r.a},675:function(n,i,e){"use strict";(function(n){var t=e(4);Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var r=t(e(606)),o={name:"u-image",mixins:[n.$u.mpMixin,n.$u.mixin,r.default],data:function(){return{isError:!1,loading:!0,opacity:1,durationTime:this.duration,backgroundStyle:{},show:!1}},watch:{src:{immediate:!0,handler:function(n){n?(this.isError=!1,this.loading=!0):this.isError=!0}}},computed:{wrapStyle:function(){var i={};return i.width=this.$u.addUnit(this.width),i.height=this.$u.addUnit(this.height),i.borderRadius="circle"==this.shape?"10000px":n.$u.addUnit(this.radius),i.overflow=this.borderRadius>0?"hidden":"visible",n.$u.deepMerge(i,n.$u.addStyle(this.customStyle))}},mounted:function(){this.show=!0},methods:{onClick:function(){this.$emit("click")},onErrorHandler:function(n){this.loading=!1,this.isError=!0,this.$emit("error",n)},onLoadHandler:function(n){this.loading=!1,this.isError=!1,this.$emit("load",n),this.removeBgColor()},removeBgColor:function(){this.backgroundStyle={backgroundColor:"transparent"}}}};i.default=o}).call(this,e(2)["default"])},676:function(n,i,e){"use strict";e.r(i);var t=e(677),r=e.n(t);for(var o in t)["default"].indexOf(o)<0&&function(n){e.d(i,n,(function(){return t[n]}))}(o);i["default"]=r.a},677:function(n,i,e){}}]);
//# sourceMappingURL=../../../../../.sourcemap/mp-weixin/uni_modules/uview-ui/components/u-image/u-image.js.map
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'uni_modules/uview-ui/components/u-image/u-image-create-component',
    {
        'uni_modules/uview-ui/components/u-image/u-image-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('2')['createComponent'](__webpack_require__(671))
        })
    },
    [['uni_modules/uview-ui/components/u-image/u-image-create-component']]
]);
