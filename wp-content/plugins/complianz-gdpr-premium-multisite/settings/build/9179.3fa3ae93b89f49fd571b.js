"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[9179,1655,9510],{59179:function(e,t,n){n.r(t);var c=n(69307),a=n(39510),o=n(65736),i=n(56293),l=n(71655);t.default=(0,c.memo)((()=>{const{savedDocument:e,conclusions:t}=(0,a.default)(),{addHelpNotice:n}=(0,i.default)();return(0,c.useEffect)((()=>{e.has_to_be_reported&&n("create-data-breach-reports","warning",(0,o.__)("This wizard is intended to provide a general guide to a possible data breach.","complianz-gdpr")+" "+(0,o.__)("Specialist legal advice should be sought about your specific circumstances.","complianz-gdpr"),(0,o.__)("Specialist legal advice required","complianz-gdpr"),!1)}),[e]),(0,c.createElement)(c.Fragment,null,(0,c.createElement)("div",{id:"cmplz-conclusion"},(0,c.createElement)("h3",null,(0,o.__)("Your dataleak report:","complianz-gdpr")),(0,c.createElement)("ul",{className:"cmplz-conclusion__list"},t.length>0&&t.map(((e,t)=>(0,c.createElement)(l.default,{conclusion:e,key:t,delay:1e3*t}))))))}))},71655:function(e,t,n){n.r(t);var c=n(69307),a=n(23361),o=n(27856),i=n.n(o);t.default=(0,c.memo)((e=>{let{conclusion:t,delay:n}=e;const[o,l]=(0,c.useState)(!0);(0,c.useEffect)((()=>{setTimeout((()=>{s()}),n)}));const s=()=>{l(!1)};let r="green";return"warning"===t.report_status&&(r="orange"),"error"===t.report_status&&(r="red"),(0,c.createElement)(c.Fragment,null,o&&(0,c.createElement)("li",{className:"cmplz-conclusion__check icon-loading"},(0,c.createElement)(a.default,{name:"loading",color:"grey"}),(0,c.createElement)("div",{className:"cmplz-conclusion__check--report-text"}," ",t.check_text," ")),!o&&(0,c.createElement)("li",{className:"cmplz-conclusion__check icon-"+t.report_status},(0,c.createElement)(a.default,{name:t.report_status,color:r}),(0,c.createElement)("div",{className:"cmplz-conclusion__check--report-text",dangerouslySetInnerHTML:{__html:i().sanitize(t.report_text)}}," ")))}))},39510:function(e,t,n){n.r(t);var c=n(30270),a=n(12902),o=n(48399),i=n(75169);const l=(0,c.Ue)(((e,t)=>({documentsLoaded:!1,savedDocument:{},conclusions:[],region:"",fileName:"",fetching:!1,updating:!1,loadingFields:!1,documents:[],regions:[],fields:[],editDocumentId:!1,resetEditDocumentId:t=>{e({editDocumentId:!1,region:""})},editDocument:async t=>{e({updating:!0}),await o.doAction("load_databreach_report",{id:t}).then((t=>{e({fields:t.fields,region:t.region,updating:!1,fileName:t.file_name})})).catch((e=>{console.error(e)})),e({editDocumentId:t})},setRegion:t=>{e({region:t})},updateField:(n,c)=>{let o=!1,l=!1;e((0,a.ZP)((e=>{e.fields.forEach((function(e,t){e.id===n&&(l=t,o=!0)})),!1!==l&&(e.fields[l].value=c)})));let s=(0,i.updateFieldsListWithConditions)(t().fields);e({fields:s})},save:async n=>{e({updating:!0});let c=t().editDocumentId,a=0;await o.doAction("save_databreach_report",{fields:t().fields,region:n,post_id:c}).then((t=>(a=t.post_id,e({updating:!1,conclusions:t.conclusions}),t))).catch((e=>{console.error(e)})),await t().fetchData();let i=t().documents.filter((e=>e.id===a));i.length>0&&e({savedDocument:i[0]})},deleteDocuments:async n=>{let c=t().documents.filter((e=>n.includes(e.id)));e((e=>({documents:e.documents.filter((e=>!n.includes(e.id)))})));let a={};a.documents=c,await o.doAction("delete_databreach_report",a).then((e=>e)).catch((e=>{console.error(e)}))},fetchData:async()=>{if(t().fetching)return;e({fetching:!0});const{documents:n,regions:c}=await o.doAction("get_databreach_reports",{}).then((e=>e)).catch((e=>{console.error(e)}));e((e=>({documentsLoaded:!0,documents:n,regions:c,fetching:!1})))},fetchFields:async t=>{let n={region:t};e({loadingFields:!0});const{fields:c}=await o.doAction("get_databreach_report_fields",n).then((e=>e)).catch((e=>{console.error(e)}));let a=(0,i.updateFieldsListWithConditions)(c);e((e=>({fields:a,loadingFields:!1})))}})));t.default=l}}]);