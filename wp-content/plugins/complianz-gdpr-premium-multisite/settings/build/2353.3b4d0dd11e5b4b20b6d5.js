"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[2353,2588],{22353:function(e,l,t){t.r(l);var a=t(69307),n=t(32588),o=t(5830),c=t(56293),r=t(65736),m=t(27856),i=t.n(m);l.default=(0,a.memo)((e=>{const{customizeUrl:l,selectedBanner:t,bannerDataLoaded:m}=(0,o.default)(),{updateField:s,setChangedField:u}=(0,c.default)();let p,d="cmplz-logo-preview";return"complianz"===e.value?d+=" cmplz-complianz-logo":"site"===e.value&&(d+=" cmplz-theme-image"),(0,a.createElement)("div",{className:"cmplz-logo-container"},(0,a.createElement)(n.default,{label:e.label,onChange:l=>{return a=l,s(e.id,a),u(e.id,a),void(document.querySelector(".cmplz-cookiebanner .cmplz-logo").innerHTML=t.logo_options[a]);var a},value:e.value,options:e.options}),"complianz"===e.value&&(0,a.createElement)("div",{className:d},(0,a.createElement)("div",{dangerouslySetInnerHTML:{__html:i().sanitize(t.logo_options[e.value])}})),"site"===e.value&&(0,a.createElement)("div",{className:d},(0,a.createElement)("div",{dangerouslySetInnerHTML:{__html:i().sanitize(t.logo_options[e.value])}}),"site"===e.value&&0===t.logo_options[e.value].length&&(0,a.createElement)(a.Fragment,null,(0,a.createElement)("p",null,(0,r.__)("No logo found. Please add a logo in the customizer.","complianz-gdpr")))),"custom"===e.value&&(0,a.createElement)("div",{className:"cmplz-logo-preview cmplz-clickable",onClick:()=>(p||(p=wp.media({title:(0,r.__)("Select a logo","complianz-gdpr"),button:{text:(0,r.__)("Set logo","complianz-gdpr")},multiple:!1}),p.on("select",(function(){for(var e=p.state().get("selection").length,l=p.state().get("selection").models,t=0;t<e;t++){var a=l[t].id,n=!1;if((n=l[t].attributes.sizes.cmplz_banner_image)||(n=l[t].attributes.sizes.medium),n||(n=l[t].attributes.sizes.thumbnail),n||(n=l[t].attributes.sizes.full),n){var o=n.url;s("logo_attachment_id",a),u("logo_attachment_id",a);let e=document.createElement("img");document.querySelector(".cmplz-cookiebanner .cmplz-logo").appendChild(e),document.querySelector(".cmplz-cookiebanner .cmplz-logo img").src=o,document.querySelector(".cmplz-custom-image img").src=o}}}))),void p.open())},(0,a.createElement)("div",{dangerouslySetInnerHTML:{__html:i().sanitize(t.logo_options[e.value])},alt:"Banner Logo",className:"cmplz-custom-image"})))}))},32588:function(e,l,t){t.r(l);var a=t(69307),n=t(40683),o=t(23361),c=t(65736);l.default=(0,a.memo)((e=>{let{value:l=!1,onChange:t,required:r,defaultValue:m,disabled:i,options:s={},canBeEmpty:u=!0,label:p}=e;if(Array.isArray(s)){let e={};s.map((l=>{e[l.value]=l.label})),s=e}return u?(""===l||!1===l||0===l)&&(l="0",s={0:(0,c.__)("Select an option","complianz-gdpr"),...s}):l||(l=Object.keys(s)[0]),(0,a.createElement)("div",{className:"cmplz-input-group cmplz-select-group",key:p},(0,a.createElement)(n.fC,{value:l,defaultValue:m,onValueChange:t,required:r,disabled:i&&!Array.isArray(i)},(0,a.createElement)(n.xz,{className:"cmplz-select-group__trigger"},(0,a.createElement)(n.B4,null),(0,a.createElement)(o.default,{name:"chevron-down"})),(0,a.createElement)(n.VY,{className:"cmplz-select-group__content",position:"popper"},(0,a.createElement)(n.u_,{className:"cmplz-select-group__scroll-button"},(0,a.createElement)(o.default,{name:"chevron-up"})),(0,a.createElement)(n.l_,{className:"cmplz-select-group__viewport"},(0,a.createElement)(n.ZA,null,Object.entries(s).map((e=>{let[l,t]=e;return(0,a.createElement)(n.ck,{disabled:Array.isArray(i)&&i.includes(l),className:"cmplz-select-group__item",key:l,value:l},(0,a.createElement)(n.eT,null,t))})))),(0,a.createElement)(n.$G,{className:"cmplz-select-group__scroll-button"},(0,a.createElement)(o.default,{name:"chevron-down"})))))}))}}]);