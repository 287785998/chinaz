(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pages/mine/info/edit"],{220:function(e,n,r){"use strict";(function(e,n){var t=r(4);r(26);t(r(25));var o=t(r(221));e.__webpack_require_UNI_MP_PLUGIN__=r,n(o.default)}).call(this,r(1)["default"],r(2)["createPage"])},221:function(e,n,r){"use strict";r.r(n);var t=r(222),o=r(224);for(var u in o)["default"].indexOf(u)<0&&function(e){r.d(n,e,(function(){return o[e]}))}(u);r(226);var i,s=r(45),a=Object(s["default"])(o["default"],t["render"],t["staticRenderFns"],!1,null,null,null,!1,t["components"],i);a.options.__file="pages/mine/info/edit.vue",n["default"]=a.exports},222:function(e,n,r){"use strict";r.r(n);var t=r(223);r.d(n,"render",(function(){return t["render"]})),r.d(n,"staticRenderFns",(function(){return t["staticRenderFns"]})),r.d(n,"recyclableRender",(function(){return t["recyclableRender"]})),r.d(n,"components",(function(){return t["components"]}))},223:function(e,n,r){"use strict";var t;r.r(n),r.d(n,"render",(function(){return o})),r.d(n,"staticRenderFns",(function(){return i})),r.d(n,"recyclableRender",(function(){return u})),r.d(n,"components",(function(){return t}));try{t={uAvatar:function(){return Promise.all([r.e("common/vendor"),r.e("uni_modules/uview-ui/components/u-avatar/u-avatar")]).then(r.bind(null,425))},uniForms:function(){return Promise.all([r.e("common/vendor"),r.e("uni_modules/uni-forms/components/uni-forms/uni-forms")]).then(r.bind(null,433))},uniFormsItem:function(){return Promise.all([r.e("common/vendor"),r.e("uni_modules/uni-forms/components/uni-forms-item/uni-forms-item")]).then(r.bind(null,446))},uniEasyinput:function(){return r.e("uni_modules/uni-easyinput/components/uni-easyinput/uni-easyinput").then(r.bind(null,453))},zTabbar:function(){return r.e("components/z-tabbar/z-tabbar").then(r.bind(null,368))}}}catch(s){if(-1===s.message.indexOf("Cannot find module")||-1===s.message.indexOf(".vue"))throw s;console.error(s.message),console.error("1. 排查组件名称拼写是否正确"),console.error("2. 排查组件是否符合 easycom 规范，文档：https://uniapp.dcloud.net.cn/collocation/pages?id=easycom"),console.error("3. 若组件不符合 easycom 规范，需手动引入，并在 components 中注册该组件")}var o=function(){var e=this,n=e.$createElement;e._self._c},u=!1,i=[];o._withStripped=!0},224:function(e,n,r){"use strict";r.r(n);var t=r(225),o=r.n(t);for(var u in t)["default"].indexOf(u)<0&&function(e){r.d(n,e,(function(){return t[e]}))}(u);n["default"]=o.a},225:function(e,n,r){"use strict";(function(e){var t=r(4);Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var o=r(207),u=r(36),i=t(r(30)),s=i.default.baseUrl,a={data:function(){return{user:{truename:"",phone:"",email:""},userpic:"",userpics:"",uploadInfo:{},rules:{truename:{rules:[{required:!0,errorMessage:"用户昵称不能为空"}]},phone:{rules:[{required:!0,errorMessage:"手机号码不能为空"},{pattern:/^1[3|4|5|6|7|8|9][0-9]\d{8}$/,errorMessage:"请输入正确的手机号码"}]},email:{rules:[{required:!0,errorMessage:"邮箱地址不能为空"},{format:"email",errorMessage:"请输入正确的邮箱地址"}]}}}},onLoad:function(){this.getUser()},onReady:function(){this.$refs.form.setRules(this.rules)},methods:{getUser:function(){var e=this;(0,u.getInfo)().then((function(n){if(1==n.code){var r=n.data.userid;(0,o.getUserProfile)({userid:r}).then((function(n){e.user=n.data[0],e.userpic=n.data[0].userpic}))}}))},changeAvatar:function(){var n=this;e.chooseImage({count:1,sizeType:["original","compressed"],sourceType:["album"],success:function(r){var t=r.tempFilePaths;e.uploadFile({url:s+"/ecmsapi/index.php?mod=user&act=uploaduserpic",filePath:t[0],name:"file",success:function(e){console.log(e),console.log(JSON.parse(e.data)),this.uploadInfo=JSON.parse(e.data),n.userpics=this.uploadInfo.data.location}})}})},submit:function(e){var n=this,r=this;this.$refs.form.validate().then((function(e){r.userpics&&(n.user.userpic=n.userpics),(0,o.updateUserProfile)(n.user).then((function(e){n.$modal.msgSuccess("修改成功")}))}))}}};n.default=a}).call(this,r(2)["default"])},226:function(e,n,r){"use strict";r.r(n);var t=r(227),o=r.n(t);for(var u in t)["default"].indexOf(u)<0&&function(e){r.d(n,e,(function(){return t[e]}))}(u);n["default"]=o.a},227:function(e,n,r){}},[[220,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../../../.sourcemap/mp-weixin/pages/mine/info/edit.js.map