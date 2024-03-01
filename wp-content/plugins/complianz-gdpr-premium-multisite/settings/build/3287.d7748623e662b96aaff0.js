"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[3287,4573,7853],{34573:function(e,t,a){a.r(t);var n=a(69307),l=a(23361);t.default=e=>{const[t,a]=(0,n.useState)(!1);return(0,n.createElement)("div",{className:"cmplz-panel__list__item",style:e.style?e.style:{}},(0,n.createElement)("details",{open:t},(0,n.createElement)("summary",{onClick:e=>(e=>{e.preventDefault(),a(!t)})(e)},e.icon&&(0,n.createElement)(l.default,{name:e.icon}),(0,n.createElement)("h5",{className:"cmplz-panel__list__item__title"},e.summary),(0,n.createElement)("div",{className:"cmplz-panel__list__item__comment"},e.comment),(0,n.createElement)("div",{className:"cmplz-panel__list__item__icons"},e.icons),(0,n.createElement)(l.default,{name:"chevron-down",size:18})),(0,n.createElement)("div",{className:"cmplz-panel__list__item__details"},t&&e.details)))}},17853:function(e,t,a){a.r(t);var n=a(30270),l=a(12902),i=a(48399),c=a(75169);const r=(0,n.Ue)(((e,t)=>({documentsLoaded:!1,region:"",fileName:"",serviceName:"",fetching:!1,updating:!1,loadingFields:!1,documents:[],regions:[],fields:[],editDocumentId:!1,resetEditDocumentId:t=>{e({editDocumentId:!1,region:"",serviceName:""})},editDocument:async t=>{e({updating:!0}),await i.doAction("load_processing_agreement",{id:t}).then((t=>{e({fields:t.fields,region:t.region,serviceName:t.serviceName,updating:!1,fileName:t.file_name})})).catch((e=>{console.error(e)})),e({editDocumentId:t})},setRegion:t=>{e({region:t})},setServiceName:t=>{e({serviceName:t})},updateField:(a,n)=>{let i=!1,r=!1;e((0,l.ZP)((e=>{e.fields.forEach((function(e,t){e.id===a&&(r=t,i=!0)})),!1!==r&&(e.fields[r].value=n)})));let s=(0,c.updateFieldsListWithConditions)(t().fields);e({fields:s})},save:async(a,n)=>{e({updating:!0});let l=t().editDocumentId;await i.doAction("save_processing_agreement",{fields:t().fields,region:a,serviceName:n,post_id:l}).then((t=>(e({updating:!1}),t))).catch((e=>{console.error(e)})),t().fetchData()},deleteDocuments:async a=>{let n=t().documents.filter((e=>a.includes(e.id)));e((e=>({documents:e.documents.filter((e=>!a.includes(e.id)))})));let l={};l.documents=n,await i.doAction("delete_processing_agreement",l).then((e=>e)).catch((e=>{console.error(e)}))},fetchData:async()=>{if(t().fetching)return;e({fetching:!0});const{documents:a,regions:n}=await i.doAction("get_processing_agreements",{}).then((e=>e)).catch((e=>{console.error(e)}));e((()=>({documentsLoaded:!0,documents:a,regions:n,fetching:!1})))},fetchFields:async t=>{let a={region:t};e({loadingFields:!0});const{fields:n}=await i.doAction("get_processing_agreement_fields",a).then((e=>e)).catch((e=>{console.error(e)}));let l=(0,c.updateFieldsListWithConditions)(n);e((e=>({fields:l,loadingFields:!1})))}})));t.default=r},63287:function(e,t,a){a.r(t);var n=a(69307),l=a(65736),i=a(23361),c=a(34573),r=a(56293),s=a(17853),o=a(82485);t.default=(0,n.memo)((e=>{const{updateField:t,setChangedField:a,saveFields:d}=(0,r.default)(),{documentsLoaded:m,documents:u}=(0,s.default)(),{selectedMainMenuItem:p}=(0,o.default)(),[g,_]=wp.element.useState(e.processor.name?e.processor.name:""),[f,v]=wp.element.useState(e.processor.purpose?e.processor.purpose:""),[E,h]=wp.element.useState(e.processor.country?e.processor.country:""),[z,y]=wp.element.useState(e.processor.data?e.processor.data:""),N=(n,l)=>{let i=[...e.field.value];Array.isArray(i)||(i=[]);let c={...i[e.index]};c[l]=n,i[e.index]=c,t(e.field.id,i),a(e.field.id,i)};(0,n.useEffect)((()=>{const e=setTimeout((()=>{N(g,"name")}),500);return()=>{clearTimeout(e)}}),[g]),(0,n.useEffect)((()=>{const e=setTimeout((()=>{N(z,"data")}),500);return()=>{clearTimeout(e)}}),[z]),(0,n.useEffect)((()=>{const e=setTimeout((()=>{N(E,"country")}),500);return()=>{clearTimeout(e)}}),[E]),(0,n.useEffect)((()=>{const e=setTimeout((()=>{N(f,"purpose")}),500);return()=>{clearTimeout(e)}}),[f]);let w=m?[...u]:[];w.push({id:-1,title:(0,l.__)("A Processing Agreement outside Complianz Privacy Suite","complianz-gdpr"),region:"",service:"",date:""});let C={...e.processor};return C.processing_agreement||(C.processing_agreement=0),(0,n.createElement)(n.Fragment,null,(0,n.createElement)(c.default,{summary:g,details:(c=>(0,n.createElement)(n.Fragment,null,(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,l.__)("Name","complianz-gdpr")),(0,n.createElement)("input",{onChange:e=>_(e.target.value),type:"text",placeholder:(0,l.__)("Name","complianz-gdpr"),value:g})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,l.__)("Country","complianz-gdpr")),(0,n.createElement)("input",{onChange:e=>h(e.target.value),type:"text",placeholder:(0,l.__)("Country","complianz-gdpr"),value:E})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,l.__)("Purpose","complianz-gdpr")),(0,n.createElement)("input",{onChange:e=>v(e.target.value),type:"text",placeholder:(0,l.__)("Purpose","complianz-gdpr"),value:f})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,l.__)("Data","complianz-gdpr")),(0,n.createElement)("input",{onChange:e=>y(e.target.value),type:"text",placeholder:(0,l.__)("Data","complianz-gdpr"),value:z})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,l.__)("Processing Agreement","complianz-gdpr")),m&&(0,n.createElement)("select",{onChange:e=>N(e.target.value,"processing_agreement"),value:c.processing_agreement},(0,n.createElement)("option",{value:"0"},(0,l.__)("Select an option","complianz-gdpr")),w.map(((e,t)=>(0,n.createElement)("option",{key:t,value:e.id},e.title)))),!m&&(0,n.createElement)("div",{className:"cmplz-documents-loader"},(0,n.createElement)("div",null,(0,n.createElement)(i.default,{name:"loading",color:"grey"})),(0,n.createElement)("div",null,(0,l.__)("Loading...","complianz-gdpr")))),(0,n.createElement)("div",{className:"cmplz-details-row__buttons"},(0,n.createElement)("button",{className:"button button-default cmplz-reset-button",onClick:n=>(async n=>{let l=e.field.value;Array.isArray(l)||(l=[]);let i=[...l];i.hasOwnProperty(e.index)&&i.splice(e.index,1),t(e.field.id,i),a(e.field.id,i),await d(p,!1,!1)})()},(0,l.__)("Delete","complianz-gdpr")))))(C)}))}))}}]);