"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[8189,2175,881,2588,4573],{32175:function(e,t,n){n.r(t),n.d(t,{UseCookieScanData:function(){return o}});var a=n(30270),l=n(48399);const o=(0,a.Ue)(((e,t)=>({initialLoadCompleted:!1,setInitialLoadCompleted:t=>e({initialLoadCompleted:t}),iframeLoaded:!1,loading:!1,nextPage:!1,progress:0,cookies:[],lastLoadedIframe:"",setIframeLoaded:t=>e({iframeLoaded:t}),setLastLoadedIframe:t=>e((e=>({lastLoadedIframe:t}))),setProgress:t=>e({progress:t}),fetchProgress:()=>(e({loading:!0}),l.doAction("get_scan_progress",{}).then((t=>(e({initialLoadCompleted:!0,loading:!1,nextPage:t.next_page,progress:t.progress,cookies:t.cookies}),t))))})))},68189:function(e,t,n){n.r(t);var a=n(69307),l=n(23361),o=n(65736),r=n(34573),c=n(99057),i=n(56293),s=n(382),d=n(32588);const u=e=>{const{getFieldValue:t,showSavedSettingsNotice:n}=(0,i.default)(),{language:l,saving:r,purposesOptions:u,services:m,updateCookie:p,toggleDeleteCookie:f,saveCookie:_}=(0,c.default)(),[g,b]=(0,a.useState)(""),[E,h]=(0,a.useState)(""),[v,k]=(0,a.useState)(""),[y,z]=(0,a.useState)([]);let N="no"!==t("use_cdb_api"),C=!!N&&1==e.sync,w=C;r&&(w=!0);let O=!1;e.slug.length>0&&(O="https://cookiedatabase.org/cookie/"+(e.service?e.service:"unknown-service")+"/"+e.slug),(0,a.useEffect)((()=>{e&&e.cookieFunction&&k(e.cookieFunction)}),[e]);const I=(e,t,n)=>{p(t,n,e)};(0,a.useEffect)((()=>{e&&e.name&&b(e.name)}),[e.name]),(0,a.useEffect)((()=>{if(!e)return;if(e.name===g)return;const t=setTimeout((()=>{p(e.ID,"name",g)}),500);return()=>{clearTimeout(t)}}),[g]),(0,a.useEffect)((()=>{if(!e)return;if(e.cookieFunction===v)return;const t=setTimeout((()=>{p(e.ID,"cookieFunction",v)}),500);return()=>{clearTimeout(t)}}),[v]),(0,a.useEffect)((()=>{e&&e.retention&&h(e.retention)}),[e.retention]),(0,a.useEffect)((()=>{if(!e)return;if(e.retention===E)return;const t=setTimeout((()=>{p(e.ID,"retention",E)}),500);return()=>{clearTimeout(t)}}),[E]),(0,a.useEffect)((()=>{let e=u&&u.hasOwnProperty(l)?u[l]:[];e=e.map((e=>({label:e.label,value:e.label}))),z(e)}),[l,u]);const x=(e,t,n)=>{p(t,n,e)};if(!e)return null;let D=-1!==e.name.indexOf("cmplz_")||C,S=1!=e.deleted?"cmplz-reset-button":"",T=m.map(((e,t)=>({value:e.ID,label:e.name}))),A=!1,P="Marketing";y.forEach((function(e,t){e.value&&-1!==e.value.indexOf("/")&&(A=!0,P=e.value,P=P.substring(0,P.indexOf("/")))}));let L=e.purpose&&-1!==e.purpose.indexOf("/");L&&(P=e.purpose.substring(0,e.purpose.indexOf("/"))),A&&!L&&y.forEach((function(e,t){e.value&&-1!==e.value.indexOf("/")&&(e.value=P,e.label=P,y[t]=e)}));let M=e.purpose;return!A&&L&&(M=P),(0,a.createElement)(a.Fragment,null,(0,a.createElement)("div",{className:"cmplz-details-row cmplz-details-row__checkbox"},(0,a.createElement)(s.default,{id:e.ID+"_cdb_api",disabled:!N,value:C,onChange:t=>x(t,e.ID,"sync"),options:{true:(0,o.__)("Sync cookie with cookiedatabase.org","complianz-gdpr")}})),(0,a.createElement)("div",{className:"cmplz-details-row cmplz-details-row__checkbox"},(0,a.createElement)(s.default,{id:e.ID+"showOnPolicy",disabled:w,value:e.showOnPolicy,onChange:t=>x(t,e.ID,"showOnPolicy"),options:{true:(0,o.__)("Show cookie on Cookie Policy","complianz-gdpr")}})),(0,a.createElement)("div",{className:"cmplz-details-row"},(0,a.createElement)("label",null,(0,o.__)("Name","complianz-gdpr")),(0,a.createElement)("input",{disabled:w,onChange:e=>b(e.target.value),type:"text",placeholder:(0,o.__)("Name","complianz-gdpr"),value:g})),(0,a.createElement)("div",{className:"cmplz-details-row"},(0,a.createElement)("label",null,(0,o.__)("Service","complianz-gdpr")),(0,a.createElement)(d.default,{disabled:w,value:e.serviceID,options:T,onChange:t=>I(t,e.ID,"serviceID")})),(0,a.createElement)("div",{className:"cmplz-details-row"},(0,a.createElement)("label",null,(0,o.__)("Expiration","complianz-gdpr")),(0,a.createElement)("input",{disabled:D,onChange:e=>h(e.target.value),type:"text",placeholder:(0,o.__)("1 year","complianz-gdpr"),value:E})),(0,a.createElement)("div",{className:"cmplz-details-row"},(0,a.createElement)("label",null,(0,o.__)("Cookie function","complianz-gdpr")),(0,a.createElement)("input",{disabled:w,onChange:e=>k(e.target.value),type:"text",placeholder:(0,o.__)("e.g. store user ID","complianz-gdpr"),value:v})),(0,a.createElement)("div",{className:"cmplz-details-row"},(0,a.createElement)("label",null,(0,o.__)("Purpose","complianz-gdpr")),(0,a.createElement)(d.default,{disabled:w,value:M,options:y,onChange:t=>I(t,e.ID,"purpose")})),O&&(0,a.createElement)("div",{className:"cmplz-details-row"},(0,a.createElement)("a",{href:O,target:"_blank",rel:"noopener noreferrer"},(0,o.__)("View cookie on cookiedatabase.org","complianz-gdpr"))),(0,a.createElement)("div",{className:"cmplz-details-row cmplz-details-row__buttons"},(0,a.createElement)("button",{disabled:r,onClick:t=>(async e=>{await _(e),n((0,o.__)("Saved cookie","complianz-gdpr"))})(e.ID),className:"button button-default"},(0,o.__)("Save","complianz-gdpr")),(0,a.createElement)("button",{className:"button button-default "+S,onClick:t=>(async e=>{await f(e)})(e.ID)},1==e.deleted&&(0,o.__)("Restore","complianz-gdpr"),1!=e.deleted&&(0,o.__)("Delete","complianz-gdpr"))))};t.default=(0,a.memo)((e=>{let{cookie:t,id:n}=e,c="";t.deleted?c=" | "+(0,o.__)("Deleted","complianz-gdpr"):t.showOnPolicy?t.isMembersOnly&&(c=" | "+(0,o.__)("Logged in users only, ignored","complianz-gdpr")):c=" | "+(0,o.__)("Admin, ignored","complianz-gdpr");let i=t.name;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(r.default,{id:n,summary:i,comment:c,icons:(0,a.createElement)(a.Fragment,null,t.complete&&(0,a.createElement)(l.default,{tooltip:(0,o.__)("The data for this cookie is complete","complianz-gdpr"),name:"success",color:"green"}),!t.complete&&(0,a.createElement)(l.default,{tooltip:(0,o.__)("This cookie has missing fields","complianz-gdpr"),name:"times",color:"red"}),t.sync&&t.synced&&(0,a.createElement)(l.default,{name:"rotate",color:"green"}),!t.synced||!t.sync&&(0,a.createElement)(l.default,{tooltip:(0,o.__)("This cookie is not synchronized with cookiedatabase.org.","complianz-gdpr"),name:"rotate-error",color:"red"}),t.showOnPolicy&&(0,a.createElement)(l.default,{tooltip:(0,o.__)("This cookie will be on your Cookie Policy","complianz-gdpr"),name:"file",color:"green"}),!t.showOnPolicy&&(0,a.createElement)(l.default,{tooltip:(0,o.__)("This cookie is not shown on the Cookie Policy","complianz-gdpr"),name:"file-disabled",color:"grey"}),t.old&&(0,a.createElement)(l.default,{tooltip:(0,o.__)("This cookie has not been detected on your site in the last three months","complianz-gdpr"),name:"calendar-error",color:"red"}),!t.old&&(0,a.createElement)(l.default,{tooltip:(0,o.__)("This cookie has recently been detected","complianz-gdpr"),name:"calendar",color:"green"})),details:u(t),style:(()=>{if(t.deleted)return Object.assign({},{backgroundColor:"var(--rsp-red-faded)"})})()}))}))},80881:function(e,t,n){n.r(t);var a=n(69307),l=n(48399),o=n(56293),r=n(82485),c=n(55609),i=n(32175),s=n(82387);t.default=(0,a.memo)((e=>{let{type:t="action",style:n="tertiary",label:d,onClick:u,href:m="",target:p="",disabled:f,action:_,field:g,children:b}=e;if(!d&&!b)return null;const E=(g&&g.button_text?g.button_text:d)||b,{fetchFieldsData:h,showSavedSettingsNotice:v}=(0,o.default)(),{setInitialLoadCompleted:k,setProgress:y}=(0,i.UseCookieScanData)(),{setProgressLoaded:z}=(0,s.default)(),{selectedSubMenuItem:N}=(0,r.default)(),[C,w]=(0,a.useState)(!1),O=`button cmplz-button button--${n} button-${t}`,I=async e=>{await l.doAction(g.action,{}).then((e=>{e.success&&(h(N),"reset_settings"===e.id&&(k(!1),y(0),z(!1)),v(e.message))}))},x=g&&g.warn?g.warn:"";return"action"===t?(0,a.createElement)(a.Fragment,null,c.__experimentalConfirmDialog&&(0,a.createElement)(c.__experimentalConfirmDialog,{isOpen:C,onConfirm:async()=>{w(!1),await I()},onCancel:()=>{w(!1)}},x),(0,a.createElement)("button",{className:O,onClick:async e=>{if("action"!==t||!u)return"action"===t&&_?c.__experimentalConfirmDialog?void(g&&g.warn?w(!0):await I()):void await I():void(window.location.href=g.url);u(e)},disabled:f},E)):"link"===t?(0,a.createElement)("a",{className:O,href:m,target:p},E):void 0}))},382:function(e,t,n){n.r(t),n.d(t,{default:function(){return I}});var a=n(69307),l=n(87462),o=n(99196),r=n(28771),c=n(25360),i=n(36206),s=n(77342),d=n(57898),u=n(7546),m=n(29115),p=n(75320);const f="Checkbox",[_,g]=(0,c.b)(f),[b,E]=_(f),h=(0,o.forwardRef)(((e,t)=>{const{__scopeCheckbox:n,name:a,checked:c,defaultChecked:d,required:u,disabled:m,value:f="on",onCheckedChange:_,...g}=e,[E,h]=(0,o.useState)(null),z=(0,r.e)(t,(e=>h(e))),N=(0,o.useRef)(!1),C=!E||Boolean(E.closest("form")),[w=!1,O]=(0,s.T)({prop:c,defaultProp:d,onChange:_}),I=(0,o.useRef)(w);return(0,o.useEffect)((()=>{const e=null==E?void 0:E.form;if(e){const t=()=>O(I.current);return e.addEventListener("reset",t),()=>e.removeEventListener("reset",t)}}),[E,O]),(0,o.createElement)(b,{scope:n,state:w,disabled:m},(0,o.createElement)(p.WV.button,(0,l.Z)({type:"button",role:"checkbox","aria-checked":k(w)?"mixed":w,"aria-required":u,"data-state":y(w),"data-disabled":m?"":void 0,disabled:m,value:f},g,{ref:z,onKeyDown:(0,i.M)(e.onKeyDown,(e=>{"Enter"===e.key&&e.preventDefault()})),onClick:(0,i.M)(e.onClick,(e=>{O((e=>!!k(e)||!e)),C&&(N.current=e.isPropagationStopped(),N.current||e.stopPropagation())}))})),C&&(0,o.createElement)(v,{control:E,bubbles:!N.current,name:a,value:f,checked:w,required:u,disabled:m,style:{transform:"translateX(-100%)"}}))})),v=e=>{const{control:t,checked:n,bubbles:a=!0,...r}=e,c=(0,o.useRef)(null),i=(0,d.D)(n),s=(0,u.t)(t);return(0,o.useEffect)((()=>{const e=c.current,t=window.HTMLInputElement.prototype,l=Object.getOwnPropertyDescriptor(t,"checked").set;if(i!==n&&l){const t=new Event("click",{bubbles:a});e.indeterminate=k(n),l.call(e,!k(n)&&n),e.dispatchEvent(t)}}),[i,n,a]),(0,o.createElement)("input",(0,l.Z)({type:"checkbox","aria-hidden":!0,defaultChecked:!k(n)&&n},r,{tabIndex:-1,ref:c,style:{...e.style,...s,position:"absolute",pointerEvents:"none",opacity:0,margin:0}}))};function k(e){return"indeterminate"===e}function y(e){return k(e)?"indeterminate":e?"checked":"unchecked"}const z=h,N=(0,o.forwardRef)(((e,t)=>{const{__scopeCheckbox:n,forceMount:a,...r}=e,c=E("CheckboxIndicator",n);return(0,o.createElement)(m.z,{present:a||k(c.state)||!0===c.state},(0,o.createElement)(p.WV.span,(0,l.Z)({"data-state":y(c.state),"data-disabled":c.disabled?"":void 0},r,{ref:t,style:{pointerEvents:"none",...e.style}})))}));var C=n(65736),w=n(23361),O=n(80881),I=(0,a.memo)((e=>{let{indeterminate:t,label:n,value:l,id:o,onChange:r,required:c,disabled:i,options:s={}}=e;const[d,u]=(0,a.useState)(!1),[m,p]=(0,a.useState)(!1);let f=l;Array.isArray(f)||(f=""===f?[]:[f]),(0,a.useEffect)((()=>{let e=1===Object.keys(s).length&&"true"===Object.keys(s)[0];u(e)}),[]),t&&(l=!0);const _=f;let g=!1;Object.keys(s).length>10&&(g=!0);const b=e=>d?l:_.includes(""+e)||_.includes(parseInt(e)),E=()=>{p(!m)};let h=i&&!Array.isArray(i);return 0===Object.keys(s).length?(0,a.createElement)(a.Fragment,null,(0,C.__)("No options found","complianz-gdpr")):(0,a.createElement)("div",{className:"cmplz-checkbox-group"},Object.entries(s).map(((e,s)=>{let[u,p]=e;return(0,a.createElement)("div",{key:u,className:"cmplz-checkbox-group__item"+(!m&&s>9?" cmplz-hidden":"")},(0,a.createElement)(z,{className:"cmplz-checkbox-group__checkbox",id:o+"_"+u,checked:b(u),"aria-label":n,disabled:h||Array.isArray(i)&&i.includes(u),required:c,onCheckedChange:e=>((e,t)=>{if(d)r(!l);else{const e=_.includes(""+t)||_.includes(parseInt(t))?_.filter((e=>e!==""+t&&e!==parseInt(t))):[..._,t];r(e)}})(0,u)},(0,a.createElement)(N,{className:"cmplz-checkbox-group__indicator"},(0,a.createElement)(w.default,{name:t?"indeterminate":"check",size:14,color:"dark-blue"}))),(0,a.createElement)("label",{className:"cmplz-checkbox-group__label",htmlFor:o+"_"+u},p))})),!m&&g&&(0,a.createElement)(O.default,{onClick:()=>E()},(0,C.__)("Show more","complianz-gdpr")),m&&g&&(0,a.createElement)(O.default,{onClick:()=>E()},(0,C.__)("Show less","complianz-gdpr")))}))},32588:function(e,t,n){n.r(t);var a=n(69307),l=n(40683),o=n(23361),r=n(65736);t.default=(0,a.memo)((e=>{let{value:t=!1,onChange:n,required:c,defaultValue:i,disabled:s,options:d={},canBeEmpty:u=!0,label:m}=e;if(Array.isArray(d)){let e={};d.map((t=>{e[t.value]=t.label})),d=e}return u?(""===t||!1===t||0===t)&&(t="0",d={0:(0,r.__)("Select an option","complianz-gdpr"),...d}):t||(t=Object.keys(d)[0]),(0,a.createElement)("div",{className:"cmplz-input-group cmplz-select-group",key:m},(0,a.createElement)(l.fC,{value:t,defaultValue:i,onValueChange:n,required:c,disabled:s&&!Array.isArray(s)},(0,a.createElement)(l.xz,{className:"cmplz-select-group__trigger"},(0,a.createElement)(l.B4,null),(0,a.createElement)(o.default,{name:"chevron-down"})),(0,a.createElement)(l.VY,{className:"cmplz-select-group__content",position:"popper"},(0,a.createElement)(l.u_,{className:"cmplz-select-group__scroll-button"},(0,a.createElement)(o.default,{name:"chevron-up"})),(0,a.createElement)(l.l_,{className:"cmplz-select-group__viewport"},(0,a.createElement)(l.ZA,null,Object.entries(d).map((e=>{let[t,n]=e;return(0,a.createElement)(l.ck,{disabled:Array.isArray(s)&&s.includes(t),className:"cmplz-select-group__item",key:t,value:t},(0,a.createElement)(l.eT,null,n))})))),(0,a.createElement)(l.$G,{className:"cmplz-select-group__scroll-button"},(0,a.createElement)(o.default,{name:"chevron-down"})))))}))},34573:function(e,t,n){n.r(t);var a=n(69307),l=n(23361);t.default=e=>{const[t,n]=(0,a.useState)(!1);return(0,a.createElement)("div",{className:"cmplz-panel__list__item",style:e.style?e.style:{}},(0,a.createElement)("details",{open:t},(0,a.createElement)("summary",{onClick:e=>(e=>{e.preventDefault(),n(!t)})(e)},e.icon&&(0,a.createElement)(l.default,{name:e.icon}),(0,a.createElement)("h5",{className:"cmplz-panel__list__item__title"},e.summary),(0,a.createElement)("div",{className:"cmplz-panel__list__item__comment"},e.comment),(0,a.createElement)("div",{className:"cmplz-panel__list__item__icons"},e.icons),(0,a.createElement)(l.default,{name:"chevron-down",size:18})),(0,a.createElement)("div",{className:"cmplz-panel__list__item__details"},t&&e.details)))}},29115:function(e,t,n){n.d(t,{z:function(){return c}});var a=n(99196),l=n(91850),o=n(28771),r=n(9981);const c=e=>{const{present:t,children:n}=e,c=function(e){const[t,n]=(0,a.useState)(),o=(0,a.useRef)({}),c=(0,a.useRef)(e),s=(0,a.useRef)("none"),d=e?"mounted":"unmounted",[u,m]=function(e,t){return(0,a.useReducer)(((e,n)=>{const a=t[e][n];return null!=a?a:e}),e)}(d,{mounted:{UNMOUNT:"unmounted",ANIMATION_OUT:"unmountSuspended"},unmountSuspended:{MOUNT:"mounted",ANIMATION_END:"unmounted"},unmounted:{MOUNT:"mounted"}});return(0,a.useEffect)((()=>{const e=i(o.current);s.current="mounted"===u?e:"none"}),[u]),(0,r.b)((()=>{const t=o.current,n=c.current;if(n!==e){const a=s.current,l=i(t);e?m("MOUNT"):"none"===l||"none"===(null==t?void 0:t.display)?m("UNMOUNT"):m(n&&a!==l?"ANIMATION_OUT":"UNMOUNT"),c.current=e}}),[e,m]),(0,r.b)((()=>{if(t){const e=e=>{const n=i(o.current).includes(e.animationName);e.target===t&&n&&(0,l.flushSync)((()=>m("ANIMATION_END")))},n=e=>{e.target===t&&(s.current=i(o.current))};return t.addEventListener("animationstart",n),t.addEventListener("animationcancel",e),t.addEventListener("animationend",e),()=>{t.removeEventListener("animationstart",n),t.removeEventListener("animationcancel",e),t.removeEventListener("animationend",e)}}m("ANIMATION_END")}),[t,m]),{isPresent:["mounted","unmountSuspended"].includes(u),ref:(0,a.useCallback)((e=>{e&&(o.current=getComputedStyle(e)),n(e)}),[])}}(t),s="function"==typeof n?n({present:c.isPresent}):a.Children.only(n),d=(0,o.e)(c.ref,s.ref);return"function"==typeof n||c.isPresent?(0,a.cloneElement)(s,{ref:d}):null};function i(e){return(null==e?void 0:e.animationName)||"none"}c.displayName="Presence"}}]);