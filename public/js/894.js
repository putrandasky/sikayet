(self.webpackChunk=self.webpackChunk||[]).push([[894],{4894:(e,t,i)=>{"use strict";i.r(t),i.d(t,{default:()=>n});const s={name:"CompanyDetailReviewAction",props:{review_owner_id:{type:Number,required:!0},user:{type:Object,default:null},review_id:{type:Number,required:!0},proplike:{type:Number},propdislike:{type:Number}},data:function(){return{like:0,dislike:0}},computed:{currentlike:function(){return this.proplike+this.like},currentdislike:function(){return this.propdislike+this.dislike},isDisabled:function(){return!(this.user&&Object.keys(this.user).length>0)||this.review_owner_id==this.user.id}},methods:{submit:function(e){var t=this;axios.post("/give-review-response",{action:e,review_id:this.review_id}).then((function(i){console.log(i.data),t[e]+=1,t.toastSuccess(i.data.message)})).catch((function(e){console.log(e),t.toastError(e.response.data.message)}))}}};const n=(0,i(1900).Z)(s,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("b-btn",{attrs:{disabled:e.isDisabled,variant:"light",size:"sm"},on:{click:function(t){return e.submit("like")}}},[i("i",{staticClass:" fa fa-thumbs-up"}),e._v(" Useful "),i("b-badge",[e._v(e._s(e.currentlike))])],1),e._v(" "),i("b-btn",{attrs:{disabled:e.isDisabled,variant:"light",size:"sm"},on:{click:function(t){return e.submit("dislike")}}},[i("i",{staticClass:" fa fa-thumbs-down"}),e._v(" Not Useful "),i("b-badge",[e._v(e._s(e.currentdislike))])],1)],1)}),[],!1,null,null,null).exports},1900:(e,t,i)=>{"use strict";function s(e,t,i,s,n,r,o,a){var u,l="function"==typeof e?e.options:e;if(t&&(l.render=t,l.staticRenderFns=i,l._compiled=!0),s&&(l.functional=!0),r&&(l._scopeId="data-v-"+r),o?(u=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),n&&n.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(o)},l._ssrRegister=u):n&&(u=a?function(){n.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:n),u)if(l.functional){l._injectStyles=u;var c=l.render;l.render=function(e,t){return u.call(t),c(e,t)}}else{var d=l.beforeCreate;l.beforeCreate=d?[].concat(d,u):[u]}return{exports:e,options:l}}i.d(t,{Z:()=>s})}}]);