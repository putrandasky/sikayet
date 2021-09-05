/*! For license information please see 198.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[198],{138:(e,t,i)=>{"use strict";i.r(t),i.d(t,{default:()=>s});var n=i(3645),r=i.n(n)()((function(e){return e[1]}));r.push([e.id,".drag-drop-area label.btn[data-v-39c58275]{margin-bottom:0;margin-right:1rem}.drag-drop-area .drop-active[data-v-39c58275]{top:0;bottom:0;right:0;left:0;position:fixed;z-index:9999;opacity:.6;text-align:center;background:#000}.drag-drop-area .drop-active h3[data-v-39c58275]{margin:-.5em 0 0;position:absolute;top:50%;left:0;right:0;transform:translateY(-50%);font-size:40px;color:#fff;padding:0}",""]);const s=r},3645:e=>{"use strict";e.exports=function(e){var t=[];return t.toString=function(){return this.map((function(t){var i=e(t);return t[2]?"@media ".concat(t[2]," {").concat(i,"}"):i})).join("")},t.i=function(e,i,n){"string"==typeof e&&(e=[[null,e,""]]);var r={};if(n)for(var s=0;s<this.length;s++){var a=this[s][0];null!=a&&(r[a]=!0)}for(var o=0;o<e.length;o++){var u=[].concat(e[o]);n&&r[u[0]]||(i&&(u[2]?u[2]="".concat(i," and ").concat(u[2]):u[2]=i),t.push(u))}},t}},6808:(e,t,i)=>{var n,r;!function(s){if(void 0===(r="function"==typeof(n=s)?n.call(t,i,t,e):n)||(e.exports=r),!0,e.exports=s(),!!0){var a=window.Cookies,o=window.Cookies=s();o.noConflict=function(){return window.Cookies=a,o}}}((function(){function e(){for(var e=0,t={};e<arguments.length;e++){var i=arguments[e];for(var n in i)t[n]=i[n]}return t}function t(e){return e.replace(/(%[0-9A-Z]{2})+/g,decodeURIComponent)}return function i(n){function r(){}function s(t,i,s){if("undefined"!=typeof document){"number"==typeof(s=e({path:"/"},r.defaults,s)).expires&&(s.expires=new Date(1*new Date+864e5*s.expires)),s.expires=s.expires?s.expires.toUTCString():"";try{var a=JSON.stringify(i);/^[\{\[]/.test(a)&&(i=a)}catch(e){}i=n.write?n.write(i,t):encodeURIComponent(String(i)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),t=encodeURIComponent(String(t)).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent).replace(/[\(\)]/g,escape);var o="";for(var u in s)s[u]&&(o+="; "+u,!0!==s[u]&&(o+="="+s[u].split(";")[0]));return document.cookie=t+"="+i+o}}function a(e,i){if("undefined"!=typeof document){for(var r={},s=document.cookie?document.cookie.split("; "):[],a=0;a<s.length;a++){var o=s[a].split("="),u=o.slice(1).join("=");i||'"'!==u.charAt(0)||(u=u.slice(1,-1));try{var l=t(o[0]);if(u=(n.read||n)(u,l)||t(u),i)try{u=JSON.parse(u)}catch(e){}if(r[l]=u,e===l)break}catch(e){}}return e?r[e]:r}}return r.set=s,r.get=function(e){return a(e,!1)},r.getJSON=function(e){return a(e,!0)},r.remove=function(t,i){s(t,"",e(i,{expires:-1}))},r.defaults={},r.withConverter=i,r}((function(){}))}))},1198:(e,t,i)=>{"use strict";i.r(t),i.d(t,{default:()=>r});const n={name:"CompanyProfileImage",props:["profileimage"],components:{FileUpload:i(8782).Z},data:function(){return{isOpenModal:!1,updatedprofileimage:""}},mounted:function(){this.updatedprofileimage=this.profileimage},watch:{},methods:{openModal:function(){this.isOpenModal=!0},changeProfileImage:function(e){this.updatedprofileimage=e.response.data,this.toastSuccess(e.response.message)},deleteProfileImage:function(){var e=this;axios.delete("/company-dashboard/profile-image").then((function(t){e.toastSuccess(t.data.message),e.updatedprofileimage=null})).catch((function(e){console.log(e)}))}}};const r=(0,i(1900).Z)(n,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"bg-white  rounded",staticStyle:{height:"auto",width:"120px"}},[i("div",{staticClass:"position-relative"},[e.updatedprofileimage?i("b-img",{attrs:{fluid:"",src:"/storage/company/"+e.updatedprofileimage}}):e._e(),e._v(" "),e.updatedprofileimage?e._e():i("b-avatar",{attrs:{rounded:"",size:"120px"}},[i("i",{staticClass:"fa fa-briefcase fa-3x"})]),e._v(" "),i("div",{staticClass:"btn--corner-offset"},[i("div",[i("b-btn",{staticClass:"btn--xs w-100",attrs:{variant:"success"},on:{click:function(t){e.isOpenModal=!0}}},[i("i",{staticClass:"fa fa-edit"})])],1),e._v(" "),i("div",[e.updatedprofileimage?i("b-btn",{staticClass:"btn--xs w-100",attrs:{variant:"danger"},on:{click:e.deleteProfileImage}},[i("i",{staticClass:"fa fa-trash"})]):e._e()],1)])],1),e._v(" "),i("b-modal",{staticClass:"position-relative",attrs:{size:"sm","hide-footer":"",title:e._f("trans")("dashboard.avatarUpload.placeholder")},on:{close:function(t){e.isOpenModal=!1}},model:{value:e.isOpenModal,callback:function(t){e.isOpenModal=t},expression:"isOpenModal"}},[i("file-upload",{attrs:{url:"/company-dashboard/profile-image"},on:{uploaded:e.changeProfileImage}})],1)],1)}),[],!1,null,null,null).exports},8782:(e,t,i)=>{"use strict";i.d(t,{Z:()=>a});var n=i(6808),r=i.n(n);const s={name:"FileUpload",props:["url"],components:{"file-upload":i(2948)},data:function(){return{showOverlay:0,data:[],files:[],xsrfToken:""}},created:function(){},mounted:function(){this.xsrfToken=r().get("XSRF-TOKEN")},methods:{onmouseover:function(e){this.showOverlay=e+1},onmouseblur:function(){this.showOverlay=0},inputFile:function(e,t){e&&t&&(e.active!==t.active&&console.log("Start upload",e.active,e),e.progress!==t.progress&&console.log("progress",e.progress,e),e.error!==t.error&&console.log("error",e.error,e),e.success!==t.success&&(console.log("success",e.success,e),this.$emit("uploaded",e))),!e&&t&&t.success&&t.response.id},inputFilter:function(e,t,i){if(e&&!t){if(!/\.(jpeg|jpe|jpg|webp|png)$/i.test(e.name))return i();if(e.size>524288)return i();e.blob="";var n=window.URL||window.webkitURL;n&&n.createObjectURL&&(e.blob=n.createObjectURL(e.file))}e&&t&&(e.version||(e.version=0),e.version++)}}};i(3550);const a=(0,i(1900).Z)(s,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"drag-drop-area"},[i("div",{staticClass:"upload"},[i("div",{staticClass:" float-right mb-2"}),e._v(" "),e.files.length?i("div",{staticClass:"pb-3",staticStyle:{border:"2px dashed grey",clear:"both"}},e._l(e.files,(function(t){return i("div",{key:t.id,staticClass:"mb-1 p-1",staticStyle:{position:"relative"}},[i("div",{staticClass:"w-100 text-center"},[i("b-img",{staticClass:"shadow-sm",attrs:{fluid:"",src:t.blob}})],1),e._v(" "),i("div",{staticStyle:{"overflow-wrap":"anywhere"}},[i("strong",[e._v(e._s(t.name))])]),e._v(" "),i("div",[i("small",[e._v("Size : "+e._s(e._f("formatSize")(t.size))+" ")])]),e._v(" "),t.active||t.success||t.error?i("b-progress",{attrs:{height:"2px",value:1*t.progress,variant:"primary"}}):e._e(),e._v(" "),i("div",[t.error?i("span",[i("span",{staticClass:"badge badge-pill badge-danger"},[i("i",{staticClass:"fa fa-exclamation"}),e._v(" "+e._s(t.error))])]):t.success?i("span",[i("span",{staticClass:"badge badge-pill badge-success"},[i("i",{staticClass:"fa fa-check"}),e._v(" "+e._s(e._f("trans")("dashboard.avatarUpload.uploaded")))])]):t.active?i("span",[e._v(e._s(t.progress))]):i("span")])],1)})),0):e._e(),e._v(" "),e.files.length?e._e():i("div",{staticClass:"text-center p-3",staticStyle:{border:"2px dashed grey",clear:"both"}},[i("h4",{staticClass:"text-muted"},[e._v(e._s(e._f("trans")("dashboard.avatarUpload.dropFile")))]),e._v(" "),i("h6",{staticClass:"text-muted"},[e._v(e._s(e._f("trans")("dashboard.avatarUpload.acceptedFiles")))])]),e._v(" "),i("div",{directives:[{name:"show",rawName:"v-show",value:e.$refs.upload&&e.$refs.upload.dropActive,expression:"$refs.upload && $refs.upload.dropActive"}],staticClass:"drop-active"},[i("h3",[e._v(e._s(e._f("trans")("dashboard.avatarUpload.dropToUpload")))])]),e._v(" "),i("div",{staticClass:"example-btn mt-2 float-right"},[i("button",{directives:[{name:"show",rawName:"v-show",value:e.files.length>0&&(!e.$refs.upload||!e.$refs.upload.active),expression:" files.length > 0 && ( !$refs.upload || !$refs.upload.active)"}],staticClass:"btn btn-outline-danger btn-sm",attrs:{type:"button"},on:{click:function(t){t.preventDefault(),e.files=[]}}},[i("i",{staticClass:"fa fa-trash",attrs:{"aria-hidden":"true"}}),e._v("\n        "+e._s(e._f("trans")("dashboard.avatarUpload.clearFile"))+"\n      ")]),e._v(" "),i("file-upload",{directives:[{name:"show",rawName:"v-show",value:0==e.files.length,expression:"files.length == 0"}],ref:"upload",staticClass:"btn btn-outline-secondary btn-sm",staticStyle:{cursor:"pointer"},attrs:{headers:{"x-xsrf-token":e.xsrfToken},"post-action":e.url,multiple:!1,drop:!0,"drop-directory":!1,accept:"image/jpeg,image/jpg,image/png"},on:{"input-filter":e.inputFilter,"input-file":e.inputFile},model:{value:e.files,callback:function(t){e.files=t},expression:"files"}},[i("i",{staticClass:"fa fa-plus"}),e._v("\n        "+e._s(e._f("trans")("dashboard.avatarUpload.addImage"))+"\n      ")]),e._v(" "),!(e.files.length>0)||e.$refs.upload&&e.$refs.upload.active?e._e():i("button",{staticClass:"btn btn-secondary btn-sm",attrs:{type:"button"},on:{click:function(t){t.preventDefault(),e.$refs.upload.active=!0}}},[i("i",{staticClass:"fa fa-arrow-up",attrs:{"aria-hidden":"true"}}),e._v("\n        "+e._s(e._f("trans")("dashboard.avatarUpload.startUpload"))+"\n      ")]),e._v(" "),e.files.length>0&&e.$refs.upload&&e.$refs.upload.active?i("button",{staticClass:"btn btn-danger btn-sm",attrs:{type:"button"},on:{click:function(t){t.preventDefault(),e.$refs.upload.active=!1}}},[i("i",{staticClass:"fa fa-stop",attrs:{"aria-hidden":"true"}}),e._v("\n        Stop Upload\n      ")]):e._e()],1)])])}),[],!1,null,"39c58275",null).exports},1900:(e,t,i)=>{"use strict";function n(e,t,i,n,r,s,a,o){var u,l="function"==typeof e?e.options:e;if(t&&(l.render=t,l.staticRenderFns=i,l._compiled=!0),n&&(l.functional=!0),s&&(l._scopeId="data-v-"+s),a?(u=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(a)},l._ssrRegister=u):r&&(u=o?function(){r.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:r),u)if(l.functional){l._injectStyles=u;var c=l.render;l.render=function(e,t){return u.call(t),c(e,t)}}else{var d=l.beforeCreate;l.beforeCreate=d?[].concat(d,u):[u]}return{exports:e,options:l}}i.d(t,{Z:()=>n})},3550:(e,t,i)=>{var n=i(138);n.__esModule&&(n=n.default),"string"==typeof n&&(n=[[e.id,n,""]]),n.locals&&(e.exports=n.locals);(0,i(5346).Z)("4f48d50c",n,!0,{})},5346:(e,t,i)=>{"use strict";function n(e,t){for(var i=[],n={},r=0;r<t.length;r++){var s=t[r],a=s[0],o={id:e+":"+r,css:s[1],media:s[2],sourceMap:s[3]};n[a]?n[a].parts.push(o):i.push(n[a]={id:a,parts:[o]})}return i}i.d(t,{Z:()=>h});var r="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!r)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var s={},a=r&&(document.head||document.getElementsByTagName("head")[0]),o=null,u=0,l=!1,c=function(){},d=null,f="data-vue-ssr-id",p="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function h(e,t,i,r){l=i,d=r||{};var a=n(e,t);return v(a),function(t){for(var i=[],r=0;r<a.length;r++){var o=a[r];(u=s[o.id]).refs--,i.push(u)}t?v(a=n(e,t)):a=[];for(r=0;r<i.length;r++){var u;if(0===(u=i[r]).refs){for(var l=0;l<u.parts.length;l++)u.parts[l]();delete s[u.id]}}}}function v(e){for(var t=0;t<e.length;t++){var i=e[t],n=s[i.id];if(n){n.refs++;for(var r=0;r<n.parts.length;r++)n.parts[r](i.parts[r]);for(;r<i.parts.length;r++)n.parts.push(g(i.parts[r]));n.parts.length>i.parts.length&&(n.parts.length=i.parts.length)}else{var a=[];for(r=0;r<i.parts.length;r++)a.push(g(i.parts[r]));s[i.id]={id:i.id,refs:1,parts:a}}}}function m(){var e=document.createElement("style");return e.type="text/css",a.appendChild(e),e}function g(e){var t,i,n=document.querySelector("style["+f+'~="'+e.id+'"]');if(n){if(l)return c;n.parentNode.removeChild(n)}if(p){var r=u++;n=o||(o=m()),t=k.bind(null,n,r,!1),i=k.bind(null,n,r,!0)}else n=m(),t=C.bind(null,n),i=function(){n.parentNode.removeChild(n)};return t(e),function(n){if(n){if(n.css===e.css&&n.media===e.media&&n.sourceMap===e.sourceMap)return;t(e=n)}else i()}}var y,b=(y=[],function(e,t){return y[e]=t,y.filter(Boolean).join("\n")});function k(e,t,i,n){var r=i?"":n.css;if(e.styleSheet)e.styleSheet.cssText=b(t,r);else{var s=document.createTextNode(r),a=e.childNodes;a[t]&&e.removeChild(a[t]),a.length?e.insertBefore(s,a[t]):e.appendChild(s)}}function C(e,t){var i=t.css,n=t.media,r=t.sourceMap;if(n&&e.setAttribute("media",n),d.ssrId&&e.setAttribute(f,t.id),r&&(i+="\n/*# sourceURL="+r.sources[0]+" */",i+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(r))))+" */"),e.styleSheet)e.styleSheet.cssText=i;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(i))}}},2948:function(e){e.exports=function(){"use strict";var e=function(e){var t=new XMLHttpRequest;return t.open(e.method||"GET",e.url),t.responseType="json",e.headers&&Object.keys(e.headers).forEach((function(i){t.setRequestHeader(i,e.headers[i])})),t},t=function(e,t){return new Promise((function(i,n){e.onload=function(){if(e.status>=200&&e.status<300){var t;try{t=JSON.parse(e.response)}catch(i){t=e.response}i(t)}else n(e.response)},e.onerror=function(){return n(e.response)},e.send(JSON.stringify(t))}))},i=function(e,t){var i=new FormData;for(var n in t)i.append(n,t[n]);return new Promise((function(t,n){e.onload=function(){if(e.status>=200&&e.status<300){var i;try{i=JSON.parse(e.response)}catch(t){i=e.response}t(i)}else n(e.response)},e.onerror=function(){return n(e.response)},e.send(i)}))};function n(i){var n=e(i);return t(n,i.body)}var r=function(){function e(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(t,i,n){return i&&e(t.prototype,i),n&&e(t,n),t}}();function s(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var a=function(){function t(e,i){s(this,t),this.file=e,this.options=i,this.chunks=[],this.sessionId=null,this.chunkSize=null,this.speedInterval=null}return r(t,[{key:"createChunks",value:function(){this.chunks=[];for(var e=0,t=this.chunkSize;e<this.fileSize;)this.chunks.push({blob:this.file.file.slice(e,t),startOffset:e,active:!1,retries:this.maxRetries}),t=(e=t)+this.chunkSize}},{key:"updateFileProgress",value:function(){this.file.progress=this.progress}},{key:"pause",value:function(){this.file.active=!1,this.stopChunks()}},{key:"stopChunks",value:function(){this.chunksUploading.forEach((function(e){e.xhr.abort(),e.active=!1})),this.stopSpeedCalc()}},{key:"resume",value:function(){this.file.active=!0,this.startChunking()}},{key:"upload",value:function(){var e=this;return this.promise=new Promise((function(t,i){e.resolve=t,e.reject=i})),this.start(),this.promise}},{key:"start",value:function(){var e=this;n({method:"POST",headers:Object.assign({},this.headers,{"Content-Type":"application/json"}),url:this.action,body:Object.assign(this.startBody,{phase:"start",mime_type:this.fileType,size:this.fileSize,name:this.fileName})}).then((function(t){if("success"!==t.status)return e.file.response=t,e.reject("server");e.sessionId=t.data.session_id,e.chunkSize=t.data.end_offset,e.createChunks(),e.startChunking()})).catch((function(t){e.file.response=t,e.reject("server")}))}},{key:"startChunking",value:function(){for(var e=0;e<this.maxActiveChunks;e++)this.uploadNextChunk();this.startSpeedCalc()}},{key:"uploadNextChunk",value:function(){if(this.file.active){if(this.hasChunksToUpload)return this.uploadChunk(this.chunksToUpload[0]);if(0===this.chunksUploading.length)return this.finish()}}},{key:"uploadChunk",value:function(t){var n=this;t.progress=0,t.active=!0,this.updateFileProgress(),t.xhr=e({method:"POST",headers:this.headers,url:this.action}),t.xhr.upload.addEventListener("progress",(function(e){e.lengthComputable&&(t.progress=Math.round(e.loaded/e.total*100))}),!1),i(t.xhr,Object.assign(this.uploadBody,{phase:"upload",session_id:this.sessionId,start_offset:t.startOffset,chunk:t.blob})).then((function(e){if(t.active=!1,"success"===e.status)t.uploaded=!0;else if(t.retries--<=0)return n.stopChunks(),n.reject("upload");n.uploadNextChunk()})).catch((function(){if(t.active=!1,t.retries--<=0)return n.stopChunks(),n.reject("upload");n.uploadNextChunk()}))}},{key:"finish",value:function(){var e=this;this.updateFileProgress(),this.stopSpeedCalc(),n({method:"POST",headers:Object.assign({},this.headers,{"Content-Type":"application/json"}),url:this.action,body:Object.assign(this.finishBody,{phase:"finish",session_id:this.sessionId})}).then((function(t){if(e.file.response=t,"success"!==t.status)return e.reject("server");e.resolve(t)})).catch((function(t){e.file.response=t,e.reject("server")}))}},{key:"startSpeedCalc",value:function(){var e=this;this.file.speed=0;var t=0;this.speedInterval||(this.speedInterval=window.setInterval((function(){var i=e.progress/100*e.fileSize;e.file.speed=i-t,t=i}),1e3))}},{key:"stopSpeedCalc",value:function(){this.speedInterval&&window.clearInterval(this.speedInterval),this.speedInterval=null,this.file.speed=0}},{key:"maxRetries",get:function(){return parseInt(this.options.maxRetries,10)}},{key:"maxActiveChunks",get:function(){return parseInt(this.options.maxActive,10)}},{key:"fileType",get:function(){return this.file.type}},{key:"fileSize",get:function(){return this.file.size}},{key:"fileName",get:function(){return this.file.name}},{key:"action",get:function(){return this.options.action||null}},{key:"startBody",get:function(){return this.options.startBody||{}}},{key:"uploadBody",get:function(){return this.options.uploadBody||{}}},{key:"finishBody",get:function(){return this.options.finishBody||{}}},{key:"headers",get:function(){return this.options.headers||{}}},{key:"readyToUpload",get:function(){return!!this.chunks}},{key:"progress",get:function(){var e=this,t=this.chunksUploaded.length/this.chunks.length*100,i=this.chunksUploading.reduce((function(t,i){return t+(0|i.progress)/e.chunks.length}),0);return Math.min(t+i,100)}},{key:"chunksToUpload",get:function(){return this.chunks.filter((function(e){return!e.active&&!e.uploaded}))}},{key:"hasChunksToUpload",get:function(){return this.chunksToUpload.length>0}},{key:"chunksUploading",get:function(){return this.chunks.filter((function(e){return!!e.xhr&&!!e.active}))}},{key:"chunksUploaded",get:function(){return this.chunks.filter((function(e){return!!e.uploaded}))}}]),t}();function o(e,t,i,n,r,s,a,o,u,l){"boolean"!=typeof a&&(u=o,o=a,a=!1);var c,d="function"==typeof i?i.options:i;if(e&&e.render&&(d.render=e.render,d.staticRenderFns=e.staticRenderFns,d._compiled=!0,r&&(d.functional=!0)),n&&(d._scopeId=n),s?(c=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),t&&t.call(this,u(e)),e&&e._registeredComponents&&e._registeredComponents.add(s)},d._ssrRegister=c):t&&(c=a?function(){t.call(this,l(this.$root.$options.shadowRoot))}:function(e){t.call(this,o(e))}),c)if(d.functional){var f=d.render;d.render=function(e,t){return c.call(t),f(e,t)}}else{var p=d.beforeCreate;d.beforeCreate=p?[].concat(p,c):[c]}return i}var u=o,l=void 0,c=void 0,d=void 0,f=u({render:function(){var e=this,t=e.$createElement;return(e._self._c||t)("input",{attrs:{type:"file",name:e.$parent.name,id:e.$parent.inputId||e.$parent.name,accept:e.$parent.accept,capture:e.$parent.capture,disabled:e.$parent.disabled,webkitdirectory:e.$parent.directory&&e.$parent.features.directory,directory:e.$parent.directory&&e.$parent.features.directory,multiple:e.$parent.multiple&&e.$parent.features.html5},on:{change:e.change}})},staticRenderFns:[]},l,{methods:{change:function(e){this.$parent.addInputFile(e.target),e.target.files?(e.target.value="",e.target.files.length&&!/safari/i.test(navigator.userAgent)&&(e.target.type="",e.target.type="file")):(this.$destroy(),new this.constructor({parent:this.$parent,el:this.$el}))}}},c,!1,d,void 0,void 0),p=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var i=arguments[t];for(var n in i)Object.prototype.hasOwnProperty.call(i,n)&&(e[n]=i[n])}return e},h="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};function v(e){if(Array.isArray(e)){for(var t=0,i=Array(e.length);t<e.length;t++)i[t]=e[t];return i}return Array.from(e)}var m={headers:{},action:"",minSize:1048576,maxActive:3,maxRetries:5,handler:a},g={components:{InputFile:f},props:{inputId:{type:String},name:{type:String,default:"file"},accept:{type:String},capture:{},disabled:{},multiple:{type:Boolean},maximum:{type:Number,default:function(){return this.multiple?0:1}},addIndex:{type:[Boolean,Number]},directory:{type:Boolean},postAction:{type:String},putAction:{type:String},customAction:{type:Function},headers:{type:Object,default:Object},data:{type:Object,default:Object},timeout:{type:Number,default:0},drop:{default:!1},dropDirectory:{type:Boolean,default:!0},size:{type:Number,default:0},extensions:{default:Array},value:{type:Array,default:Array},thread:{type:Number,default:1},chunkEnabled:{type:Boolean,default:!1},chunk:{type:Object,default:function(){return m}}},data:function(){return{files:this.value,features:{html5:!0,directory:!1,drop:!1},active:!1,dropActive:!1,uploading:0,destroy:!1}},mounted:function(){var e=document.createElement("input");if(e.type="file",e.multiple=!0,window.FormData&&e.files?("boolean"!=typeof e.webkitdirectory&&"boolean"!=typeof e.directory||(this.features.directory=!0),this.features.html5&&void 0!==e.ondrop&&(this.features.drop=!0)):this.features.html5=!1,this.maps={},this.files)for(var t=0;t<this.files.length;t++){var i=this.files[t];this.maps[i.id]=i}this.$nextTick((function(){var e=this;this.$parent?(this.$parent.$forceUpdate(),this.$parent.$nextTick((function(){e.watchDrop(e.drop)}))):this.watchDrop(this.drop)}))},beforeDestroy:function(){this.destroy=!0,this.active=!1,this.watchDrop(!1)},computed:{uploaded:function(){for(var e=void 0,t=0;t<this.files.length;t++)if((e=this.files[t]).fileObject&&!e.error&&!e.success)return!1;return!0},chunkOptions:function(){return Object.assign(m,this.chunk)},className:function(){return["file-uploads",this.features.html5?"file-uploads-html5":"file-uploads-html4",this.features.directory&&this.directory?"file-uploads-directory":void 0,this.features.drop&&this.drop?"file-uploads-drop":void 0,this.disabled?"file-uploads-disabled":void 0]}},watch:{active:function(e){this.watchActive(e)},dropActive:function(){this.$parent&&this.$parent.$forceUpdate()},drop:function(e){this.watchDrop(e)},value:function(e){if(this.files!==e){this.files=e;var t=this.maps;this.maps={};for(var i=0;i<this.files.length;i++){var n=this.files[i];this.maps[n.id]=n}for(var r in this.maps){var s=this.maps[r],a=t[r];s!==a&&this.emitFile(s,a)}for(var o in t)this.maps[o]||this.emitFile(void 0,t[o])}}},methods:{clear:function(){if(this.files.length){var e=this.files;this.files=[],this.maps={},this.emitInput();for(var t=0;t<e.length;t++)this.emitFile(void 0,e[t])}return!0},get:function(e){return!!e&&("object"===(void 0===e?"undefined":h(e))?this.maps[e.id]||!1:this.maps[e]||!1)},add:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:this.addIndex,i=e,n=i instanceof Array;n||(i=[i]);for(var r=[],s=0;s<i.length;s++){var a=i[s];this.features.html5&&a instanceof Blob&&(a={file:a,size:a.size,name:a.webkitRelativePath||a.relativePath||a.name||"unknown",type:a.type});var o=!1;if(!1===a.fileObject||(a.fileObject||"undefined"!=typeof Element&&a.el instanceof Element||"undefined"!=typeof Blob&&a.file instanceof Blob)&&(o=!0),o&&((a=p({fileObject:!0,size:-1,name:"Filename",type:"",active:!1,error:"",success:!1,putAction:this.putAction,postAction:this.postAction,timeout:this.timeout},a,{response:{},progress:"0.00",speed:0})).data=p({},this.data,a.data?a.data:{}),a.headers=p({},this.headers,a.headers?a.headers:{})),a.id||(a.id=Math.random().toString(36).substr(2)),!this.emitFilter(a,void 0)){if(this.maximum>1&&r.length+this.files.length>=this.maximum)break;if(r.push(a),1===this.maximum)break}}if(!r.length)return!1;1===this.maximum&&this.clear();var u=void 0;if(!0===t||0===t)u=r.concat(this.files);else if(t){var l;(l=u=this.files.concat([])).splice.apply(l,[t,0].concat(r))}else u=this.files.concat(r);this.files=u;for(var c=0;c<r.length;c++){var d=r[c];this.maps[d.id]=d}this.emitInput();for(var f=0;f<r.length;f++)this.emitFile(r[f],void 0);return n?r:r[0]},addInputFile:function(e){var t=[];if(e.files)for(var i=0;i<e.files.length;i++){var n=e.files[i];t.push({size:n.size,name:n.webkitRelativePath||n.relativePath||n.name,type:n.type,file:n})}else{var r=e.value.replace(/\\/g,"/").split("/");delete e.__vuex__,t.push({name:r[r.length-1],el:e})}return this.add(t)},addDataTransfer:function(e){var t=this,i=[];if(e.items&&e.items.length){for(var n=[],r=0;r<e.items.length;r++){var s=e.items[r];(s=s.getAsEntry?s.getAsEntry()||s.getAsFile():s.webkitGetAsEntry&&s.webkitGetAsEntry()||s.getAsFile())&&n.push(s)}return new Promise((function(e,r){!function r(s){var a=n[s];if(!a||t.maximum>0&&i.length>=t.maximum)return e(t.add(i));t.getEntry(a).then((function(e){i.push.apply(i,v(e)),r(s+1)}))}(0)}))}if(e.files.length){for(var a=0;a<e.files.length&&(i.push(e.files[a]),!(this.maximum>0&&i.length>=this.maximum));a++);return Promise.resolve(this.add(i))}return Promise.resolve([])},getEntry:function(e){var t=this,i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";return new Promise((function(n,r){if(e.isFile)e.file((function(e){n([{size:e.size,name:i+e.name,type:e.type,file:e}])}));else if(e.isDirectory&&t.dropDirectory){var s=[],a=e.createReader();!function r(){a.readEntries((function(a){!function o(u){return!a[u]&&0===u||t.maximum>0&&s.length>=t.maximum?n(s):a[u]?void t.getEntry(a[u],i+e.name+"/").then((function(e){s.push.apply(s,v(e)),o(u+1)})):r()}(0)}))}()}else n([])}))},replace:function(e,t){var i=this.get(e),n=this.get(t);if(!i||!n||i===n)return!1;var r=this.files.concat([]),s=r.indexOf(i),a=r.indexOf(n);return-1!==s&&-1!==a&&(r[s]=n,r[a]=i,this.files=r,this.emitInput(),!0)},remove:function(e){var t=this.get(e);if(t){if(this.emitFilter(void 0,t))return!1;var i=this.files.concat([]),n=i.indexOf(t);if(-1===n)return console.error("remove",t),!1;i.splice(n,1),this.files=i,delete this.maps[t.id],this.emitInput(),this.emitFile(void 0,t)}return t},update:function(e,t){var i=this.get(e);if(i){var n=p({},i,t);if(!i.fileObject||!i.active||n.active||n.error||n.success||(n.error="abort"),this.emitFilter(n,i))return!1;var r=this.files.concat([]),s=r.indexOf(i);return-1===s?(console.error("update",i),!1):(r.splice(s,1,n),this.files=r,delete this.maps[i.id],this.maps[n.id]=n,this.emitInput(),this.emitFile(n,i),n)}return!1},emitFilter:function(e,t){var i=!1;return this.$emit("input-filter",e,t,(function(){return i=!0})),i},emitFile:function(e,t){this.$emit("input-file",e,t),!(e&&e.fileObject&&e.active)||t&&t.active?e&&e.fileObject&&e.active||!t||!t.fileObject||!t.active||this.uploading--:(this.uploading++,this.$nextTick((function(){var t=this;setTimeout((function(){t.upload(e).then((function(){(e=t.get(e))&&e.fileObject&&t.update(e,{active:!1,success:!e.error})})).catch((function(i){t.update(e,{active:!1,success:!1,error:i.code||i.error||i.message||i})}))}),parseInt(50*Math.random()+50,10))}))),!this.active||Boolean(e)===Boolean(t)&&e.active===t.active||this.watchActive(!0)},emitInput:function(){this.$emit("input",this.files)},upload:function(e){var t=this.get(e);if(!t)return Promise.reject("not_exists");if(!t.fileObject)return Promise.reject("file_object");if(t.error)return Promise.reject(t.error);if(t.success)return Promise.resolve(t);var i=this.extensions;if(i&&(i.length||void 0===i.length)&&("object"===(void 0===i?"undefined":h(i))&&i instanceof RegExp||("string"==typeof i&&(i=i.split(",").map((function(e){return e.trim()})).filter((function(e){return e}))),i=new RegExp("\\.("+i.join("|").replace(/\./g,"\\.")+")$","i")),-1===t.name.search(i)))return Promise.reject("extension");if(this.size>0&&t.size>=0&&t.size>this.size)return Promise.reject("size");if(this.customAction)return this.customAction(t,this);if(this.features.html5){if(this.shouldUseChunkUpload(t))return this.uploadChunk(t);if(t.putAction)return this.uploadPut(t);if(t.postAction)return this.uploadHtml5(t)}return t.postAction?this.uploadHtml4(t):Promise.reject("No action configured")},shouldUseChunkUpload:function(e){return this.chunkEnabled&&!!this.chunkOptions.handler&&e.size>this.chunkOptions.minSize},uploadChunk:function(e){var t=this.chunkOptions.handler;return e.chunk=new t(e,this.chunkOptions),e.chunk.upload()},uploadPut:function(e){var t=[],i=void 0;for(var n in e.data)null!=(i=e.data[n])&&t.push(encodeURIComponent(n)+"="+encodeURIComponent(i));var r=t.length?(-1===e.putAction.indexOf("?")?"?":"&")+t.join("&"):"",s=new XMLHttpRequest;return s.open("PUT",e.putAction+r),this.uploadXhr(s,e,e.file)},uploadHtml5:function(e){var t=new window.FormData,i=void 0;for(var n in e.data)(i=e.data[n])&&"object"===(void 0===i?"undefined":h(i))&&"function"!=typeof i.toString?i instanceof File?t.append(n,i,i.name):t.append(n,JSON.stringify(i)):null!=i&&t.append(n,i);t.append(this.name,e.file,e.file.filename||e.name);var r=new XMLHttpRequest;return r.open("POST",e.postAction),this.uploadXhr(r,e,t)},uploadXhr:function(e,t,i){var n=this,r=t,s=0,a=0;e.upload.onprogress=function(e){if(r=n.get(r),e.lengthComputable&&r&&r.fileObject&&r.active){var t=Math.round(Date.now()/1e3);t!==s&&(s=t,r=n.update(r,{progress:(e.loaded/e.total*100).toFixed(2),speed:e.loaded-a}),a=e.loaded)}};var o=setInterval((function(){if(!(r=n.get(r))||!r.fileObject||r.success||r.error||!r.active){o&&(clearInterval(o),o=!1);try{e.abort(),e.timeout=1}catch(e){}}}),100);return new Promise((function(t,s){var a=void 0,u=function(i){if(!a){if(a=!0,o&&(clearInterval(o),o=!1),!(r=n.get(r)))return s("not_exists");if(!r.fileObject)return s("file_object");if(r.error)return s(r.error);if(!r.active)return s("abort");if(r.success)return t(r);var u={};switch(i.type){case"timeout":case"abort":u.error=i.type;break;case"error":e.status?e.status>=500?u.error="server":e.status>=400&&(u.error="denied"):u.error="network";break;default:e.status>=500?u.error="server":e.status>=400?u.error="denied":u.progress="100.00"}if(e.responseText){var l=e.getResponseHeader("Content-Type");l&&-1!==l.indexOf("/json")?u.response=JSON.parse(e.responseText):u.response=e.responseText}return(r=n.update(r,u)).error?s(r.error):t(r)}};for(var l in e.onload=u,e.onerror=u,e.onabort=u,e.ontimeout=u,r.timeout&&(e.timeout=r.timeout),r.headers)e.setRequestHeader(l,r.headers[l]);r=n.update(r,{xhr:e}),e.send(i)}))},uploadHtml4:function(e){var t=this,i=e,n=function(e){27===e.keyCode&&e.preventDefault()},r=document.createElement("iframe");r.id="upload-iframe-"+i.id,r.name="upload-iframe-"+i.id,r.src="about:blank",r.setAttribute("style","width:1px;height:1px;top:-999em;position:absolute; margin-top:-999em;");var s=document.createElement("form");s.action=i.postAction,s.name="upload-form-"+i.id,s.setAttribute("method","POST"),s.setAttribute("target","upload-iframe-"+i.id),s.setAttribute("enctype","multipart/form-data");var a=void 0,o=void 0;for(var u in i.data)(a=i.data[u])&&"object"===(void 0===a?"undefined":h(a))&&"function"!=typeof a.toString&&(a=JSON.stringify(a)),null!=a&&((o=document.createElement("input")).type="hidden",o.name=u,o.value=a,s.appendChild(o));s.appendChild(i.el),document.body.appendChild(r).appendChild(s);var l=function(){var e=void 0;try{r.contentWindow&&(e=r.contentWindow.document)}catch(e){}if(!e)try{e=r.contentDocument?r.contentDocument:r.document}catch(t){e=r.document}return e&&e.body?e.body.innerHTML:null};return new Promise((function(e,a){setTimeout((function(){if(!(i=t.update(i,{iframe:r})))return a("not_exists");var o=setInterval((function(){(i=t.get(i))&&i.fileObject&&!i.success&&!i.error&&i.active||(o&&(clearInterval(o),o=!1),r.onabort({type:i?"abort":"not_exists"}))}),100),u=void 0,c=function(r){if(!u){if(u=!0,o&&(clearInterval(o),o=!1),document.body.removeEventListener("keydown",n),!(i=t.get(i)))return a("not_exists");if(!i.fileObject)return a("file_object");if(i.error)return a(i.error);if(!i.active)return a("abort");if(i.success)return e(i);var s=l(),c={};switch(r.type){case"abort":c.error="abort";break;case"error":i.error?c.error=i.error:c.error=null===s?"network":"denied";break;default:i.error?c.error=i.error:null===c?c.error="network":c.progress="100.00"}if(null!==s){if(s&&"{"===s.substr(0,1)&&"}"===s.substr(s.length-1,1))try{s=JSON.parse(s)}catch(e){}c.response=s}return(i=t.update(i,c)).error?a(i.error):e(i)}};r.onload=c,r.onerror=c,r.onabort=c,document.body.addEventListener("keydown",n),s.submit()}),50)})).then((function(e){return r.parentNode&&r.parentNode.removeChild(r),e})).catch((function(e){return r.parentNode&&r.parentNode.removeChild(r),e}))},watchActive:function(e){for(var t=void 0,i=0;t=this.files[i];)if(i++,t.fileObject)if(e&&!this.destroy){if(this.uploading>=this.thread||this.uploading&&!this.features.html5)break;t.active||t.error||t.success||this.update(t,{active:!0})}else t.active&&this.update(t,{active:!1});0===this.uploading&&(this.active=!1)},watchDrop:function(e){var t=e;if(this.features.drop){if(this.dropElement)try{document.removeEventListener("dragenter",this.onDragenter,!1),document.removeEventListener("dragleave",this.onDragleave,!1),document.removeEventListener("drop",this.onDocumentDrop,!1),this.dropElement.removeEventListener("dragover",this.onDragover,!1),this.dropElement.removeEventListener("drop",this.onDrop,!1)}catch(e){}t?"string"==typeof t?t=document.querySelector(t)||this.$root.$el.querySelector(t):!0===t&&(t=this.$parent.$el):t=!1,this.dropElement=t,this.dropElement&&(document.addEventListener("dragenter",this.onDragenter,!1),document.addEventListener("dragleave",this.onDragleave,!1),document.addEventListener("drop",this.onDocumentDrop,!1),this.dropElement.addEventListener("dragover",this.onDragover,!1),this.dropElement.addEventListener("drop",this.onDrop,!1))}},onDragenter:function(e){if(e.preventDefault(),!this.dropActive&&e.dataTransfer){var t=e.dataTransfer;t.files&&t.files.length?this.dropActive=!0:t.types?(t.types.indexOf&&-1!==t.types.indexOf("Files")||t.types.contains&&t.types.contains("Files"))&&(this.dropActive=!0):this.dropActive=!0}},onDragleave:function(e){e.preventDefault(),this.dropActive&&("HTML"===e.target.nodeName||e.target===e.explicitOriginalTarget||!e.fromElement&&(e.clientX<=0||e.clientY<=0||e.clientX>=window.innerWidth||e.clientY>=window.innerHeight))&&(this.dropActive=!1)},onDragover:function(e){e.preventDefault()},onDocumentDrop:function(){this.dropActive=!1},onDrop:function(e){e.preventDefault(),this.addDataTransfer(e.dataTransfer)}}},y="undefined"!=typeof navigator&&/msie [6-9]\\b/.test(navigator.userAgent.toLowerCase());function b(e){return function(e,t){return _(e,t)}}var k=document.head||document.getElementsByTagName("head")[0],C={};function _(e,t){var i=y?t.media||"default":e,n=C[i]||(C[i]={ids:new Set,styles:[]});if(!n.ids.has(e)){n.ids.add(e);var r=t.source;if(t.map&&(r+="\n/*# sourceURL="+t.map.sources[0]+" */",r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(t.map))))+" */"),n.element||(n.element=document.createElement("style"),n.element.type="text/css",t.media&&n.element.setAttribute("media",t.media),k.appendChild(n.element)),"styleSheet"in n.element)n.styles.push(r),n.element.styleSheet.cssText=n.styles.filter(Boolean).join("\n");else{var s=n.ids.size-1,a=document.createTextNode(r),o=n.element.childNodes;o[s]&&n.element.removeChild(o[s]),o.length?n.element.insertBefore(a,o[s]):n.element.appendChild(a)}}}var x=void 0,w=void 0,O=u({render:function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("span",{class:e.className},[e._t("default"),e._v(" "),i("label",{attrs:{for:e.inputId||e.name}}),e._v(" "),i("input-file")],2)},staticRenderFns:[]},(function(e){e&&e("data-v-76d380b6_0",{source:".file-uploads{overflow:hidden;position:relative;text-align:center;display:inline-block}.file-uploads.file-uploads-html4 input,.file-uploads.file-uploads-html5 label{background:#fff;opacity:0;font-size:20em;z-index:1;top:0;left:0;right:0;bottom:0;position:absolute;width:100%;height:100%}.file-uploads.file-uploads-html4 label,.file-uploads.file-uploads-html5 input{background:rgba(255,255,255,0);overflow:hidden;position:fixed;width:1px;height:1px;z-index:-1;opacity:0}",map:void 0,media:void 0})}),g,x,!1,w,b,void 0);function S(e){return e&&e.default||e}return S(Object.freeze({default:O}))}()}}]);