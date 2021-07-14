(self.webpackChunk=self.webpackChunk||[]).push([[566],{2690:(t,s,a)=>{"use strict";a.r(s),a.d(s,{default:()=>o});const e={name:"UserRegister",props:{socialLoginStatus:{type:String,default:""},hideLoginLink:{type:Boolean,default:!1},targetWindowReload:{type:String,default:"/user-dashboard"}},data:function(){return{input:{name:"",email:"",password:"",password_confirmation:""},errors:{name:"",email:"",password:"",password_confirmation:""},isPasswordOpen:!1,isLoading:!1,alert:{status:"",message:""}}},created:function(){},computed:{stateName:function(){return"no-error"==this.errors.name||!this.errors.name&&null},stateEmail:function(){return"no-error"==this.errors.email||!this.errors.email&&null},statePassword:function(){return"no-error"==this.errors.password||!this.errors.password&&null}},methods:{submit:function(t){var s=this;t.preventDefault();var a=this;this.isLoading=!0,axios.post("/user-register",this.input).then((function(t){console.log(t.data),a.isLoading=!1;a.input={name:"",email:"",password:"",password_confirmation:""},window.open(s.targetWindowReload,"_self")})).catch((function(t){a.isLoading=!1;var e=t.response.data.errors;a.alert.status=e?"danger":t.response.data.status,a.alert.message=t.response.data.message,s.errors.name=e.name?e.name[0]:"no-error",s.errors.email=e.email?e.email[0]:"no-error",s.errors.password=e.password?e.password[0]:"no-error"}))}}};const o=(0,a(1900).Z)(e,(function(){var t=this,s=t.$createElement,a=t._self._c||s;return a("b-card",{staticClass:"text-center",attrs:{id:"login-form"}},[a("b-card-title",[a("a",{attrs:{href:"/"}},[a("b-img",{staticStyle:{"max-height":"30px"},attrs:{fluid:"",src:"/images/logo-large.png",alt:"application logo"}})],1)]),t._v(" "),a("b-alert",{attrs:{show:""!=t.socialLoginStatus,variant:"warning"}},[t._v("\n    "+t._s(t.socialLoginStatus)+"\n  ")]),t._v(" "),a("b-alert",{attrs:{variant:t.alert.status,show:""!=t.alert.status}},[t._v("\n    "+t._s(t.alert.message)+"\n  ")]),t._v(" "),a("div",{staticClass:"py-2"},[a("a",{staticClass:"btn btn-block text-white",staticStyle:{"background-color":"#3B5998"},attrs:{href:"/facebook"}},[a("i",{staticClass:"fa fa-facebook"}),t._v("\n      Login with Facebook")]),t._v(" "),a("a",{staticClass:"btn btn-block text-white",staticStyle:{"background-color":"#DC4E41"},attrs:{href:"/google"}},[a("i",{staticClass:"fa fa-google"}),t._v("\n      Login with Google")])]),t._v(" "),a("div",[t._v("\n    OR\n  ")]),t._v(" "),a("b-form",{staticClass:"mt-2",on:{submit:t.submit}},[a("b-form-group",{staticClass:"position-relative",attrs:{"invalid-feedback":t.errors.name,state:t.stateName}},[a("b-form-input",{staticClass:"form-control pl-5",attrs:{type:"text",placeholder:"Full Name",state:t.stateName},model:{value:t.input.name,callback:function(s){t.$set(t.input,"name",s)},expression:"input.name"}}),t._v(" "),a("i",{staticClass:"fa fa-briefcase position-absolute text-secondary",staticStyle:{top:"12px",left:"18px"}})],1),t._v(" "),a("b-form-group",{staticClass:"position-relative",attrs:{"invalid-feedback":t.errors.email,state:t.stateEmail}},[a("b-form-input",{staticClass:"form-control pl-5",attrs:{type:"email",placeholder:"Email",state:t.stateEmail},model:{value:t.input.email,callback:function(s){t.$set(t.input,"email",s)},expression:"input.email"}}),t._v(" "),a("i",{staticClass:"fa fa-envelope position-absolute text-secondary",staticStyle:{top:"12px",left:"18px"}})],1),t._v(" "),a("b-form-group",{staticClass:"position-relative",attrs:{"invalid-feedback":t.errors.password,state:t.statePassword}},[a("b-form-input",{staticClass:"form-control pl-5",attrs:{type:t.isPasswordOpen?"text":"password",placeholder:"Password",state:t.statePassword},model:{value:t.input.password,callback:function(s){t.$set(t.input,"password",s)},expression:"input.password"}}),t._v(" "),a("i",{staticClass:"fa fa-key position-absolute text-secondary",staticStyle:{top:"12px",left:"18px"}}),t._v(" "),a("i",{directives:[{name:"show",rawName:"v-show",value:!t.isPasswordOpen,expression:"!isPasswordOpen"}],staticClass:"fa fa-eye position-absolute text-secondary",staticStyle:{top:"12px",right:"18px"},on:{click:function(s){t.isPasswordOpen=!0}}}),t._v(" "),a("i",{directives:[{name:"show",rawName:"v-show",value:t.isPasswordOpen,expression:"isPasswordOpen"}],staticClass:"fa fa-eye-slash position-absolute text-secondary",staticStyle:{top:"12px",right:"18px"},on:{click:function(s){t.isPasswordOpen=!1}}})],1),t._v(" "),a("b-form-group",{staticClass:"position-relative"},[a("b-form-input",{staticClass:"form-control pl-5",attrs:{type:t.isPasswordOpen?"text":"password",placeholder:"Confirm Password"},model:{value:t.input.password_confirmation,callback:function(s){t.$set(t.input,"password_confirmation",s)},expression:"input.password_confirmation"}}),t._v(" "),a("i",{staticClass:"fa fa-key position-absolute text-secondary",staticStyle:{top:"12px",left:"18px"}})],1),t._v(" "),a("div",{staticClass:" mt-3 "},[a("b-btn",{staticClass:"rounded",attrs:{type:"submit",variant:"primary",block:""}},[t._v("Register")])],1),t._v(" "),t.hideLoginLink?t._e():a("div",{staticClass:"mt-3 text-center"},[t._v("\n      Already have Account? "),a("a",{attrs:{href:"/user-login"}},[t._v("Sign In")])]),t._v(" "),a("b-overlay",{attrs:{variant:"dark",show:t.isLoading,blur:"",fixed:"","no-wrap":""}})],1)],1)}),[],!1,null,null,null).exports},1900:(t,s,a)=>{"use strict";function e(t,s,a,e,o,r,i,n){var l,c="function"==typeof t?t.options:t;if(s&&(c.render=s,c.staticRenderFns=a,c._compiled=!0),e&&(c.functional=!0),r&&(c._scopeId="data-v-"+r),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=l):o&&(l=n?function(){o.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(c.functional){c._injectStyles=l;var p=c.render;c.render=function(t,s){return l.call(s),p(t,s)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}a.d(s,{Z:()=>e})}}]);