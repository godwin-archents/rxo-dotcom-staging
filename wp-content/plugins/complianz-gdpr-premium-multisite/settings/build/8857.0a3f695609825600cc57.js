"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[8857],{38857:function(e,t,c){c.r(t),c.d(t,{default:function(){return _}});var n=c(69307),r=c(87462),a=c(99196),o=c(36206),l=c(28771),u=c(25360),s=c(77342),d=c(57898),i=c(7546),p=c(75320);const h="Switch",[b,m]=(0,u.b)(h),[f,k]=b(h),v=(0,a.forwardRef)(((e,t)=>{const{__scopeSwitch:c,name:n,checked:u,defaultChecked:d,required:i,disabled:h,value:b="on",onCheckedChange:m,...k}=e,[v,E]=(0,a.useState)(null),C=(0,l.e)(t,(e=>E(e))),y=(0,a.useRef)(!1),_=!v||Boolean(v.closest("form")),[z=!1,S]=(0,s.T)({prop:u,defaultProp:d,onChange:m});return(0,a.createElement)(f,{scope:c,checked:z,disabled:h},(0,a.createElement)(p.WV.button,(0,r.Z)({type:"button",role:"switch","aria-checked":z,"aria-required":i,"data-state":g(z),"data-disabled":h?"":void 0,disabled:h,value:b},k,{ref:C,onClick:(0,o.M)(e.onClick,(e=>{S((e=>!e)),_&&(y.current=e.isPropagationStopped(),y.current||e.stopPropagation())}))})),_&&(0,a.createElement)(w,{control:v,bubbles:!y.current,name:n,value:b,checked:z,required:i,disabled:h,style:{transform:"translateX(-100%)"}}))})),w=e=>{const{control:t,checked:c,bubbles:n=!0,...o}=e,l=(0,a.useRef)(null),u=(0,d.D)(c),s=(0,i.t)(t);return(0,a.useEffect)((()=>{const e=l.current,t=window.HTMLInputElement.prototype,r=Object.getOwnPropertyDescriptor(t,"checked").set;if(u!==c&&r){const t=new Event("click",{bubbles:n});r.call(e,c),e.dispatchEvent(t)}}),[u,c,n]),(0,a.createElement)("input",(0,r.Z)({type:"checkbox","aria-hidden":!0,defaultChecked:c},o,{tabIndex:-1,ref:l,style:{...e.style,...s,position:"absolute",pointerEvents:"none",opacity:0,margin:0}}))};function g(e){return e?"checked":"unchecked"}const E=v,C=(0,a.forwardRef)(((e,t)=>{const{__scopeSwitch:c,...n}=e,o=k("SwitchThumb",c);return(0,a.createElement)(p.WV.span,(0,r.Z)({"data-state":g(o.checked),"data-disabled":o.disabled?"":void 0},n,{ref:t}))}));var y=c(56293),_=(0,n.memo)((e=>{let{value:t,onChange:c,required:r,disabled:a,className:o,label:l,id:u}=e;const{getField:s}=(0,y.default)();let d=t;return"0"!==t&&"1"!==t||(d="1"===t),(0,n.createElement)("div",{className:"cmplz-input-group cmplz-switch-group"},(0,n.createElement)(E,{className:"cmplz-switch-root "+o,checked:d,onCheckedChange:e=>{"banner"===s(u).data_target&&(e=e?"1":"0"),c(e)},disabled:a,required:r},(0,n.createElement)(C,{className:"cmplz-switch-thumb"})))}))},57898:function(e,t,c){c.d(t,{D:function(){return r}});var n=c(99196);function r(e){const t=(0,n.useRef)({value:e,previous:e});return(0,n.useMemo)((()=>(t.current.value!==e&&(t.current.previous=t.current.value,t.current.value=e),t.current.previous)),[e])}}}]);