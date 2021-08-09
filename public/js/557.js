(self.webpackChunk=self.webpackChunk||[]).push([[557],{8557:(t,e,s)=>{"use strict";s.r(e),s.d(e,{default:()=>r});const a={name:"UserLogin",props:{socialLoginStatus:{type:String,default:""},hideRegisterLink:{type:Boolean,default:!1},targetWindowReload:{type:String,default:"/user-dashboard"}},data:function(){return{input:{email:"",password:"",remember:!1},errors:{email:"",password:""},isPasswordOpen:!1,isLoading:!1,alert:{status:"",message:""}}},created:function(){},computed:{stateEmail:function(){return"no-error"==this.errors.email||!this.errors.email&&null},statePassword:function(){return"no-error"==this.errors.password||!this.errors.password&&null}},methods:{submit:function(t){var e=this;t.preventDefault();var s=this;this.isLoading=!0,axios.post("/user-login",this.input).then((function(t){console.log(t.data),s.isLoading=!1;s.input={email:"",password:""},window.open(e.targetWindowReload,"_self")})).catch((function(t){s.isLoading=!1,s.errors={email:"",password:""},console.log(t.response.data);var a=t.response.data.errors;s.alert.status=a?"danger":t.response.data.status,s.alert.message=t.response.data.message,e.errors.email=a.email?a.email[0]:"no-error",e.errors.password=a.password?a.password[0]:"no-error"}))}}};const r=(0,s(1900).Z)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("b-card",{staticClass:"text-center",attrs:{id:"login-form"}},[s("b-card-title",[s("a",{attrs:{href:"/"}},[s("b-img",{staticStyle:{"max-height":"30px"},attrs:{fluid:"",src:"/images/logo-large.png",alt:"application logo"}})],1)]),t._v(" "),s("b-alert",{attrs:{show:""!=t.socialLoginStatus,variant:"warning"}},[t._v("\n    "+t._s(t.socialLoginStatus)+"\n  ")]),t._v(" "),s("b-alert",{attrs:{variant:t.alert.status,show:""!=t.alert.status}},[t._v("\n    "+t._s(t.alert.message)+"\n  ")]),t._v(" "),s("div",{staticClass:"py-2"},[s("a",{staticClass:"btn btn-block text-white",staticStyle:{"background-color":"#3B5998"},attrs:{href:"/facebook"}},[s("i",{staticClass:"fa fa-facebook"}),t._v("\n      "+t._s(t._f("trans")("auth.loginWith"))+" Facebook")]),t._v(" "),s("a",{staticClass:"btn btn-block text-white",staticStyle:{"background-color":"#DC4E41"},attrs:{href:"/google"}},[s("i",{staticClass:"fa fa-google"}),t._v("\n      "+t._s(t._f("trans")("auth.loginWith"))+" Google")])]),t._v(" "),s("div",[t._v("\n    OR\n  ")]),t._v(" "),s("b-form",{staticClass:"mt-2",on:{submit:t.submit}},[s("b-form-group",{staticClass:"position-relative",attrs:{"invalid-feedback":t.errors.email,state:t.stateEmail}},[s("b-form-input",{staticClass:"form-control pl-5",attrs:{type:"email",placeholder:t._f("trans")("auth.email"),state:t.stateEmail,autocomplete:"on"},model:{value:t.input.email,callback:function(e){t.$set(t.input,"email",e)},expression:"input.email"}}),t._v(" "),s("i",{staticClass:"fa fa-envelope position-absolute text-secondary",staticStyle:{top:"12px",left:"18px"}})],1),t._v(" "),s("b-form-group",{staticClass:"position-relative",attrs:{"invalid-feedback":t.errors.password,state:t.statePassword}},[s("b-form-input",{staticClass:"form-control pl-5",attrs:{type:t.isPasswordOpen?"text":"password",placeholder:t._f("trans")("auth.password"),state:t.statePassword,autocomplete:"on"},model:{value:t.input.password,callback:function(e){t.$set(t.input,"password",e)},expression:"input.password"}}),t._v(" "),s("i",{staticClass:"fa fa-key position-absolute text-secondary",staticStyle:{top:"12px",left:"18px"}}),t._v(" "),s("i",{directives:[{name:"show",rawName:"v-show",value:!t.isPasswordOpen,expression:"!isPasswordOpen"}],staticClass:"fa fa-eye position-absolute text-secondary",staticStyle:{top:"12px",right:"18px"},on:{click:function(e){t.isPasswordOpen=!0}}}),t._v(" "),s("i",{directives:[{name:"show",rawName:"v-show",value:t.isPasswordOpen,expression:"isPasswordOpen"}],staticClass:"fa fa-eye-slash position-absolute text-secondary",staticStyle:{top:"12px",right:"18px"},on:{click:function(e){t.isPasswordOpen=!1}}})],1),t._v(" "),s("div",{staticClass:"d-flex    justify-content-between"},[s("div",{},[s("div",{staticClass:"form-check"},[s("input",{directives:[{name:"model",rawName:"v-model",value:t.input.remember,expression:"input.remember"}],staticClass:"form-check-input",attrs:{type:"checkbox",value:"",id:"remember-me-user"},domProps:{checked:Array.isArray(t.input.remember)?t._i(t.input.remember,"")>-1:t.input.remember},on:{change:function(e){var s=t.input.remember,a=e.target,r=!!a.checked;if(Array.isArray(s)){var o=t._i(s,"");a.checked?o<0&&t.$set(t.input,"remember",s.concat([""])):o>-1&&t.$set(t.input,"remember",s.slice(0,o).concat(s.slice(o+1)))}else t.$set(t.input,"remember",r)}}}),t._v(" "),s("label",{staticClass:"form-check-label",attrs:{for:"remember-me-user"}},[t._v("\n            "+t._s(t._f("trans")("auth.rememberMe"))+"\n          ")])])]),t._v(" "),s("div",[s("a",{staticClass:"text-dark",attrs:{href:"/user-forgot-password"}},[t._v(t._s(t._f("trans")("auth.forgotPassword")))])])]),t._v(" "),s("div",{staticClass:" mt-3 "},[s("b-btn",{staticClass:"rounded",attrs:{type:"submit",variant:"primary",block:""}},[t._v(t._s(t._f("trans")("auth.login")))])],1),t._v(" "),t.hideRegisterLink?t._e():s("div",{staticClass:"mt-3 text-center"},[t._v("\n      "+t._s(t._f("trans")("auth.dontHaveAccount"))+" "),s("a",{attrs:{href:"/user-register"}},[t._v(t._s(t._f("trans")("auth.signUp")))])]),t._v(" "),s("b-overlay",{attrs:{variant:"dark",show:t.isLoading,blur:"",fixed:"","no-wrap":""}})],1)],1)}),[],!1,null,null,null).exports},1900:(t,e,s)=>{"use strict";function a(t,e,s,a,r,o,i,n){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=s,c._compiled=!0),a&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=l):r&&(l=n?function(){r.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(c.functional){c._injectStyles=l;var p=c.render;c.render=function(t,e){return l.call(e),p(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}s.d(e,{Z:()=>a})}}]);