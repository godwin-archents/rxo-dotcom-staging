"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[1143,2175,881,382,9511],{32175:function(e,t,n){n.r(t),n.d(t,{UseCookieScanData:function(){return r}});var a=n(30270),o=n(48399);const r=(0,a.Ue)(((e,t)=>({initialLoadCompleted:!1,setInitialLoadCompleted:t=>e({initialLoadCompleted:t}),iframeLoaded:!1,loading:!1,nextPage:!1,progress:0,cookies:[],lastLoadedIframe:"",setIframeLoaded:t=>e({iframeLoaded:t}),setLastLoadedIframe:t=>e((e=>({lastLoadedIframe:t}))),setProgress:t=>e({progress:t}),fetchProgress:()=>(e({loading:!0}),o.doAction("get_scan_progress",{}).then((t=>(e({initialLoadCompleted:!0,loading:!1,nextPage:t.next_page,progress:t.progress,cookies:t.cookies}),t))))})))},80881:function(e,t,n){n.r(t);var a=n(69307),o=n(48399),r=n(56293),c=n(82485),s=n(55609),l=n(32175),i=n(82387);t.default=(0,a.memo)((e=>{let{type:t="action",style:n="tertiary",label:d,onClick:u,href:m="",target:f="",disabled:p,action:g,field:h,children:b}=e;if(!d&&!b)return null;const _=(h&&h.button_text?h.button_text:d)||b,{fetchFieldsData:E,showSavedSettingsNotice:v}=(0,r.default)(),{setInitialLoadCompleted:k,setProgress:y}=(0,l.UseCookieScanData)(),{setProgressLoaded:w}=(0,i.default)(),{selectedSubMenuItem:C}=(0,c.default)(),[N,L]=(0,a.useState)(!1),z=`button cmplz-button button--${n} button-${t}`,S=async e=>{await o.doAction(h.action,{}).then((e=>{e.success&&(E(C),"reset_settings"===e.id&&(k(!1),y(0),w(!1)),v(e.message))}))},x=h&&h.warn?h.warn:"";return"action"===t?(0,a.createElement)(a.Fragment,null,s.__experimentalConfirmDialog&&(0,a.createElement)(s.__experimentalConfirmDialog,{isOpen:N,onConfirm:async()=>{L(!1),await S()},onCancel:()=>{L(!1)}},x),(0,a.createElement)("button",{className:z,onClick:async e=>{if("action"!==t||!u)return"action"===t&&g?s.__experimentalConfirmDialog?void(h&&h.warn?L(!0):await S()):void await S():void(window.location.href=h.url);u(e)},disabled:p},_)):"link"===t?(0,a.createElement)("a",{className:z,href:m,target:f},_):void 0}))},382:function(e,t,n){n.r(t),n.d(t,{default:function(){return S}});var a=n(69307),o=n(87462),r=n(99196),c=n(28771),s=n(25360),l=n(36206),i=n(77342),d=n(57898),u=n(7546),m=n(29115),f=n(75320);const p="Checkbox",[g,h]=(0,s.b)(p),[b,_]=g(p),E=(0,r.forwardRef)(((e,t)=>{const{__scopeCheckbox:n,name:a,checked:s,defaultChecked:d,required:u,disabled:m,value:p="on",onCheckedChange:g,...h}=e,[_,E]=(0,r.useState)(null),w=(0,c.e)(t,(e=>E(e))),C=(0,r.useRef)(!1),N=!_||Boolean(_.closest("form")),[L=!1,z]=(0,i.T)({prop:s,defaultProp:d,onChange:g}),S=(0,r.useRef)(L);return(0,r.useEffect)((()=>{const e=null==_?void 0:_.form;if(e){const t=()=>z(S.current);return e.addEventListener("reset",t),()=>e.removeEventListener("reset",t)}}),[_,z]),(0,r.createElement)(b,{scope:n,state:L,disabled:m},(0,r.createElement)(f.WV.button,(0,o.Z)({type:"button",role:"checkbox","aria-checked":k(L)?"mixed":L,"aria-required":u,"data-state":y(L),"data-disabled":m?"":void 0,disabled:m,value:p},h,{ref:w,onKeyDown:(0,l.M)(e.onKeyDown,(e=>{"Enter"===e.key&&e.preventDefault()})),onClick:(0,l.M)(e.onClick,(e=>{z((e=>!!k(e)||!e)),N&&(C.current=e.isPropagationStopped(),C.current||e.stopPropagation())}))})),N&&(0,r.createElement)(v,{control:_,bubbles:!C.current,name:a,value:p,checked:L,required:u,disabled:m,style:{transform:"translateX(-100%)"}}))})),v=e=>{const{control:t,checked:n,bubbles:a=!0,...c}=e,s=(0,r.useRef)(null),l=(0,d.D)(n),i=(0,u.t)(t);return(0,r.useEffect)((()=>{const e=s.current,t=window.HTMLInputElement.prototype,o=Object.getOwnPropertyDescriptor(t,"checked").set;if(l!==n&&o){const t=new Event("click",{bubbles:a});e.indeterminate=k(n),o.call(e,!k(n)&&n),e.dispatchEvent(t)}}),[l,n,a]),(0,r.createElement)("input",(0,o.Z)({type:"checkbox","aria-hidden":!0,defaultChecked:!k(n)&&n},c,{tabIndex:-1,ref:s,style:{...e.style,...i,position:"absolute",pointerEvents:"none",opacity:0,margin:0}}))};function k(e){return"indeterminate"===e}function y(e){return k(e)?"indeterminate":e?"checked":"unchecked"}const w=E,C=(0,r.forwardRef)(((e,t)=>{const{__scopeCheckbox:n,forceMount:a,...c}=e,s=_("CheckboxIndicator",n);return(0,r.createElement)(m.z,{present:a||k(s.state)||!0===s.state},(0,r.createElement)(f.WV.span,(0,o.Z)({"data-state":y(s.state),"data-disabled":s.disabled?"":void 0},c,{ref:t,style:{pointerEvents:"none",...e.style}})))}));var N=n(65736),L=n(23361),z=n(80881),S=(0,a.memo)((e=>{let{indeterminate:t,label:n,value:o,id:r,onChange:c,required:s,disabled:l,options:i={}}=e;const[d,u]=(0,a.useState)(!1),[m,f]=(0,a.useState)(!1);let p=o;Array.isArray(p)||(p=""===p?[]:[p]),(0,a.useEffect)((()=>{let e=1===Object.keys(i).length&&"true"===Object.keys(i)[0];u(e)}),[]),t&&(o=!0);const g=p;let h=!1;Object.keys(i).length>10&&(h=!0);const b=e=>d?o:g.includes(""+e)||g.includes(parseInt(e)),_=()=>{f(!m)};let E=l&&!Array.isArray(l);return 0===Object.keys(i).length?(0,a.createElement)(a.Fragment,null,(0,N.__)("No options found","complianz-gdpr")):(0,a.createElement)("div",{className:"cmplz-checkbox-group"},Object.entries(i).map(((e,i)=>{let[u,f]=e;return(0,a.createElement)("div",{key:u,className:"cmplz-checkbox-group__item"+(!m&&i>9?" cmplz-hidden":"")},(0,a.createElement)(w,{className:"cmplz-checkbox-group__checkbox",id:r+"_"+u,checked:b(u),"aria-label":n,disabled:E||Array.isArray(l)&&l.includes(u),required:s,onCheckedChange:e=>((e,t)=>{if(d)c(!o);else{const e=g.includes(""+t)||g.includes(parseInt(t))?g.filter((e=>e!==""+t&&e!==parseInt(t))):[...g,t];c(e)}})(0,u)},(0,a.createElement)(C,{className:"cmplz-checkbox-group__indicator"},(0,a.createElement)(L.default,{name:t?"indeterminate":"check",size:14,color:"dark-blue"}))),(0,a.createElement)("label",{className:"cmplz-checkbox-group__label",htmlFor:r+"_"+u},f))})),!m&&h&&(0,a.createElement)(z.default,{onClick:()=>_()},(0,N.__)("Show more","complianz-gdpr")),m&&h&&(0,a.createElement)(z.default,{onClick:()=>_()},(0,N.__)("Show less","complianz-gdpr")))}))},61143:function(e,t,n){n.r(t);var a=n(69307),o=n(382),r=n(65736),c=n(9511);t.default=(0,a.memo)((()=>{const{documents:e,downloadUrl:t,deleteDocuments:s,documentsLoaded:l,fetchData:i}=(0,c.default)(),[d,u]=(0,a.useState)(""),[m,f]=(0,a.useState)([]),[p,g]=(0,a.useState)({}),[h,b]=(0,a.useState)(!1),[_,E]=(0,a.useState)(!1),[v,k]=(0,a.useState)(null);(0,a.useEffect)((()=>{n.e(44).then(n.bind(n,90044)).then((e=>{let{default:t}=e;k((()=>t))}))}),[]),(0,a.useEffect)((()=>{l||i()}),[l]);const y=async()=>{let n=e.filter((e=>m.includes(e.id)));f([]);const a=async()=>{if(n.length>0){const e=n.shift(),o=t+"/"+e.file;u(!0);try{let t=new XMLHttpRequest;t.responseType="blob",t.open("get",o,!0),t.send(),t.onreadystatechange=function(){if(4===this.readyState&&200===this.status){let t=window.URL.createObjectURL(this.response),n=window.document.createElement("a");n.setAttribute("href",t),n.setAttribute("download",e.filename),window.document.body.appendChild(n),n.click(),setTimeout((function(){window.URL.revokeObjectURL(t)}),6e4)}},await a()}catch(e){console.error(e),u(!1)}}};await a(),u(!1)},w=e=>(e.sort(((e,t)=>e.file<t.file?-1:e.file>t.file?1:0)),e),C=[{name:(0,a.createElement)(o.default,{options:{true:""},indeterminate:h,value:_,onChange:t=>(t=>{if(t){E(!0);let t=p.currentPage?p.currentPage:1,n=w(e).slice(10*(t-1),10*t);f(n.map((e=>e.id)))}else E(!1),f([]);b(!1)})(t)}),selector:e=>e.selectControl,grow:1,minWidth:"50px"},{name:(0,r.__)("Document","complianz-gdpr"),selector:e=>e.file,sortable:!0,grow:5},{name:(0,r.__)("Region","complianz-gdpr"),selector:e=>(0,a.createElement)("img",{alt:"region",width:"20px",height:"20px",src:cmplz_settings.plugin_url+"assets/images/"+e.region+".svg"}),sortable:!0,grow:2,right:!0},{name:(0,r.__)("Consent","complianz-gdpr"),selector:e=>e.consent,sortable:!0,grow:2,right:!0},{name:(0,r.__)("Date","complianz-gdpr"),selector:e=>e.time,sortable:!0,grow:4,right:!0}];let N=[...e];N=w(N);let L=[];return N.forEach((t=>{let n={...t};n.selectControl=(0,a.createElement)(o.default,{value:m.includes(n.id),options:{true:""},onChange:t=>((t,n)=>{let a=[...m];t?a.includes(n)||(a.push(n),f(a)):(a=[...m.filter((e=>e!==n))],f(a));let o=p.currentPage?p.currentPage:1,r=w(e).slice(10*(o-1),10*o),c=!0,s=!1;r.forEach((e=>{a.includes(e.id)?s=!0:c=!1})),c?(E(!0),b(!1)):s?(E(!1),b(!0)):b(!1)})(!m.includes(n.id),n.id)}),L.push(n)})),(0,a.createElement)(a.Fragment,null,m.length>0&&(0,a.createElement)("div",{className:"cmplz-selected-document"},m.length>1&&(0,r.__)("%s items selected","complianz-gdpr").replace("%s",m.length),1===m.length&&(0,r.__)("1 item selected","complianz-gdpr"),(0,a.createElement)("div",{className:"cmplz-selected-document-controls"},(0,a.createElement)("button",{disabled:d,className:"button button-default cmplz-btn-reset",onClick:()=>y()},(0,r.__)("Download Proof of Consent","complianz-gdpr")),(0,a.createElement)("button",{className:"button button-default cmplz-reset-button",onClick:()=>(async e=>{f([]),await s(e)})(m)},(0,r.__)("Delete","complianz-gdpr")))),v&&(0,a.createElement)(a.Fragment,null,(0,a.createElement)(v,{className:"cmplz-data-table",columns:C,data:L,dense:!0,pagination:!0,paginationPerPage:10,onChangePage:e=>{g({...p,currentPage:e})},paginationState:p,noDataComponent:(0,a.createElement)("div",{className:"cmplz-no-documents"},(0,r.__)("No documents","complianz-gdpr")),persistTableHead:!0,theme:"really-simple-plugins",customStyles:{headCells:{style:{paddingLeft:"0",paddingRight:"0"}},cells:{style:{paddingLeft:"0",paddingRight:"0"}}}})))}))},9511:function(e,t,n){n.r(t);var a=n(30270),o=n(48399);const r=(0,a.Ue)(((e,t)=>({documentsLoaded:!1,fetching:!1,generating:!1,documents:[],downloadUrl:"",regions:[],fields:[],deleteDocuments:async n=>{let a=t().documents.filter((e=>n.includes(e.id)));e((e=>({documents:e.documents.filter((e=>!n.includes(e.id)))})));let r={};r.documents=a,await o.doAction("delete_proof_of_consent_documents",r).then((e=>e)).catch((e=>{console.error(e)}))},generateProofOfConsent:async()=>{e({generating:!0}),await o.doAction("generate_proof_of_consent",{}).then((e=>e)).catch((e=>{console.error(e)})),await t().fetchData(),e({generating:!1})},fetchData:async()=>{if(t().fetching)return;e({fetching:!0});const{documents:n,regions:a,download_url:r}=await o.doAction("get_proof_of_consent_documents",{}).then((e=>e)).catch((e=>{console.error(e)}));e((e=>({documentsLoaded:!0,documents:n,regions:a,downloadUrl:r,fetching:!1})))}})));t.default=r},29115:function(e,t,n){n.d(t,{z:function(){return s}});var a=n(99196),o=n(91850),r=n(28771),c=n(9981);const s=e=>{const{present:t,children:n}=e,s=function(e){const[t,n]=(0,a.useState)(),r=(0,a.useRef)({}),s=(0,a.useRef)(e),i=(0,a.useRef)("none"),d=e?"mounted":"unmounted",[u,m]=function(e,t){return(0,a.useReducer)(((e,n)=>{const a=t[e][n];return null!=a?a:e}),e)}(d,{mounted:{UNMOUNT:"unmounted",ANIMATION_OUT:"unmountSuspended"},unmountSuspended:{MOUNT:"mounted",ANIMATION_END:"unmounted"},unmounted:{MOUNT:"mounted"}});return(0,a.useEffect)((()=>{const e=l(r.current);i.current="mounted"===u?e:"none"}),[u]),(0,c.b)((()=>{const t=r.current,n=s.current;if(n!==e){const a=i.current,o=l(t);e?m("MOUNT"):"none"===o||"none"===(null==t?void 0:t.display)?m("UNMOUNT"):m(n&&a!==o?"ANIMATION_OUT":"UNMOUNT"),s.current=e}}),[e,m]),(0,c.b)((()=>{if(t){const e=e=>{const n=l(r.current).includes(e.animationName);e.target===t&&n&&(0,o.flushSync)((()=>m("ANIMATION_END")))},n=e=>{e.target===t&&(i.current=l(r.current))};return t.addEventListener("animationstart",n),t.addEventListener("animationcancel",e),t.addEventListener("animationend",e),()=>{t.removeEventListener("animationstart",n),t.removeEventListener("animationcancel",e),t.removeEventListener("animationend",e)}}m("ANIMATION_END")}),[t,m]),{isPresent:["mounted","unmountSuspended"].includes(u),ref:(0,a.useCallback)((e=>{e&&(r.current=getComputedStyle(e)),n(e)}),[])}}(t),i="function"==typeof n?n({present:s.isPresent}):a.Children.only(n),d=(0,r.e)(s.ref,i.ref);return"function"==typeof n||s.isPresent?(0,a.cloneElement)(i,{ref:d}):null};function l(e){return(null==e?void 0:e.animationName)||"none"}s.displayName="Presence"},57898:function(e,t,n){n.d(t,{D:function(){return o}});var a=n(99196);function o(e){const t=(0,a.useRef)({value:e,previous:e});return(0,a.useMemo)((()=>(t.current.value!==e&&(t.current.previous=t.current.value,t.current.value=e),t.current.previous)),[e])}}}]);