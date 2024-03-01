"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[3709,7499,6057,2640,5671,1789,3252],{17499:function(e,t,a){a.r(t);var s=a(69307),i=a(23361),n=a(65736),r=a(23252);t.default=()=>{const[e,t]=(0,s.useState)(!1),[a,o]=(0,s.useState)(1),[c,l]=(0,s.useState)(0),[d,p]=(0,s.useState)(0),{consentType:u,statisticsData:g,loaded:m,fetchStatisticsData:f,labels:h,setLabels:b}=(0,r.default)();return(0,s.useEffect)((()=>{!m&&cmplz_settings.is_premium&&f()}),[]),(0,s.useEffect)((()=>{if(""===u||!m)return;if(!g||!g.hasOwnProperty(u))return;let e=[...g[u].labels],t=g[u].categories;t="optin"===u?t.filter((e=>"functional"===e||"no_warning"===e||"do_not_track"===e)):t.filter((e=>"functional"===e||"marketing"===e||"statistics"===e||"preferences"===e));let a=t.map((e=>g[u].categories.indexOf(e)));for(let t=a.length-1;t>=0;t--)e.splice(a[t],1);b(e)}),[m,u]),(0,s.useEffect)((()=>{if(""===u||!m||!g)return;let e=g[u].datasets.filter((e=>e.default));if(e.length>0){let a=e[0].data,s=a.reduce(((e,t)=>parseInt(e)+parseInt(t)),0);s=s>0?s:1,o(s),l(e[0].full_consent),p(e[0].no_consent),a=a.slice(2),t(a)}}),[m,u]),(0,s.createElement)("div",{className:"cmplz-statistics"},(0,s.createElement)("div",{className:"cmplz-statistics-select"},(0,s.createElement)("div",{className:"cmplz-statistics-select-item"},(0,s.createElement)(i.default,{name:"dial-max-light",color:"green",size:"22"}),(0,s.createElement)("h2",null,c),(0,s.createElement)("span",null,(0,n.__)("Full Consent","complianz-gdpr"))),(0,s.createElement)("div",{className:"cmplz-statistics-select-item"},(0,s.createElement)(i.default,{name:"dial-min-light",color:"red",size:"22"}),(0,s.createElement)("h2",null,d),(0,s.createElement)("span",null,(0,n.__)("No Consent","complianz-gdpr")))),(0,s.createElement)("div",{className:"cmplz-statistics-list"},h.length>0&&h.map(((t,n)=>{return(0,s.createElement)("div",{className:"cmplz-statistics-list-item",key:n},(e=>{let t="dial-med-low-light";return 1===e?t="dial-med-light":2===e?t="dial-light":3===e?t="dial-off-light":4===e&&(t="dial-min-light"),(0,s.createElement)(s.Fragment,null,(0,s.createElement)(i.default,{name:t,color:"black"}))})(n),(0,s.createElement)("p",{className:"cmplz-statistics-list-item-text"},t),(0,s.createElement)("p",{className:"cmplz-statistics-list-item-number"},e.hasOwnProperty(n)?(r=e[n],r=parseInt(r),Math.round(r/a*100)):0,"%"));var r}))))}},26057:function(e,t,a){a.r(t);var s=a(69307),i=a(56293),n=a(85671),r=a(23361),o=a(65736),c=a(71789);t.default=e=>{const{fields:t,getFieldValue:a}=(0,i.default)(),[l,d]=(0,s.useState)(!1),{integrationsLoaded:p,plugins:u,fetchIntegrationsData:g}=(0,n.default)(),{licenseStatus:m}=(0,c.default)();(0,s.useEffect)((()=>{let t=e.item;if(t.field){let e=a(t.field.name)==t.field.value;d(e)}}),[t]),(0,s.useEffect)((()=>{p||g()}),[]);let f=e.item;if(f.plugin)return u.filter((e=>e.id===f.plugin)).length>0?(0,s.createElement)("div",{className:"cmplz-tool"},(0,s.createElement)("div",{className:"cmplz-tool-title"},f.title),(0,s.createElement)("div",{className:"cmplz-tool-link"},(0,s.createElement)("a",{href:f.link,target:"_blank",rel:"noopener noreferrer"},(0,s.createElement)(r.default,{name:"circle-chevron-right",color:"black",size:14})))):null;let h=cmplz_settings.is_premium&&"valid"===m,b=((0,o.__)("Read more","complianz-gdpr"),f.link);h&&(!l&&f.enableLink&&(b=f.enableLink),f.field&&!l||!f.viewLink||(b=f.viewLink));let _=-1!==b.indexOf("https://"),k=_?"_blank":"_self",y=_?"external-link":"circle-chevron-right";return(0,s.createElement)("div",{className:"cmplz-tool"},(0,s.createElement)("div",{className:"cmplz-tool-title"},f.title,f.plusone&&f.plusone),(0,s.createElement)("div",{className:"cmplz-tool-link"},(0,s.createElement)("a",{href:b,target:k,rel:_?"noopener noreferrer":""},(0,s.createElement)(r.default,{name:y,color:"black",size:14}))))}},83709:function(e,t,a){a.r(t);var s=a(69307),i=a(56293),n=a(65736),r=a(82640),o=a(17499),c=a(26057);const l=e=>(0,s.createElement)("div",{className:"cmplz-plusone"},e.count);t.default=()=>{const{fields:e,getFieldValue:t}=(0,i.default)(),[a,d]=(0,s.useState)(!1),[p,u]=(0,s.useState)(!1),{recordsLoaded:g,fetchData:m,totalOpen:f}=(0,r.default)();(0,s.useEffect)((()=>{g||m(10,1,"ID","ASC")}),[g]),(0,s.useEffect)((()=>{let e=1==t("a_b_testing");d(e);let a=1==t("a_b_testing_buttons");u(a)}),[e]);const h=[{title:(0,n.__)("Data Requests","complianz-gdpr"),viewLink:"#tools/data-requests",enableLink:"#wizard/security-consent",field:{name:"datarequest",value:"yes"},link:"https://complianz.io/definition/what-is-a-data-request/",plusone:(0,s.createElement)(l,{count:f})},{title:(0,n.__)("Records of Consent","complianz-gdpr"),viewLink:"#tools/records-of-consent",enableLink:"#wizard/security-consent",field:{name:"records_of_consent",value:"yes"},link:"https://complianz.io/records-of-consent/"},{title:(0,n.__)("Processing Agreements","complianz-gdpr"),viewLink:"#tools/processing-agreements",link:"https://complianz.io/definition/what-is-a-processing-agreement/"},{title:(0,n.__)("Consent Statistics","complianz-gdpr"),viewLink:"#tools/ab-testing",link:"https://complianz.io/a-quick-introduction-to-a-b-testing/"},{title:(0,n.__)("A/B Testing","complianz-gdpr"),viewLink:"#tools/ab-testing",link:"https://complianz.io/a-quick-introduction-to-a-b-testing/"},{title:(0,n.__)("Documentation","complianz-gdpr"),link:"https://complianz.io/support/"},{title:(0,n.__)("Premium Support","complianz-gdpr"),viewLink:"#tools/support",link:"https://complianz.io/about-premium-support/"},{title:"WooCommerce",plugin:"woocommerce",link:cmplz_settings.admin_url+"admin.php?page=wc-settings&tab=account"},{title:(0,n.__)("Security","complianz-gdpr"),link:"#tools/security",viewLink:"#tools/security"}];let b=cmplz_settings.is_multisite_plugin?"#tools/tools-multisite":"https://complianz.io/complianz-for-wordpress-multisite-installations/";return cmplz_settings.is_multisite&&h.push({title:(0,n.__)("Multisite","complianz-gdpr"),link:b,viewLink:b}),a?(0,s.createElement)(s.Fragment,null,(0,s.createElement)(o.default,{abTestingEnabled:p})):(0,s.createElement)(s.Fragment,null,h.map(((e,t)=>(0,s.createElement)(c.default,{key:t,item:e}))))}},82640:function(e,t,a){a.r(t);var s=a(30270),i=a(48399),n=a(12902);a(69307);const r=(0,s.Ue)(((e,t)=>({recordsLoaded:!1,searchValue:"",setSearchValue:t=>e({searchValue:t}),status:"open",setStatus:t=>e({status:t}),selectedRecords:[],setSelectedRecords:t=>e({selectedRecords:t}),fetching:!1,generating:!1,progress:!1,records:[],totalRecords:0,totalOpen:0,exportLink:"",noData:!1,indeterminate:!1,setIndeterminate:t=>e({indeterminate:t}),paginationPerPage:10,pagination:{currentPage:1},setPagination:t=>e({pagination:t}),orderBy:"ID",setOrderBy:t=>e({orderBy:t}),order:"DESC",setOrder:t=>e({order:t}),deleteRecords:async a=>{let s={};s.per_page=t().paginationPerPage,s.page=t().pagination.currentPage,s.order=t().order.toUpperCase(),s.orderBy=t().orderBy,s.search=t().searchValue,s.status=t().status;let n=t().records.filter((e=>a.includes(e.ID)));e((e=>({records:e.records.filter((e=>!a.includes(e.ID)))}))),s.records=n,await i.doAction("delete_datarequests",s).then((e=>e)).catch((e=>{console.error(e)})),await t().fetchData(),t().setSelectedRecords([]),t().setIndeterminate(!1)},resolveRecords:async a=>{let s={};s.per_page=t().paginationPerPage,s.page=t().pagination.currentPage,s.order=t().order.toUpperCase(),s.orderBy=t().orderBy,s.search=t().searchValue,s.status=t().status,e((0,n.ZP)((e=>{e.records.forEach((function(t,s){a.includes(t.ID)&&(e.records[s].resolved=!0)}))}))),s.records=t().records.filter((e=>a.includes(e.ID))),await i.doAction("resolve_datarequests",s).then((e=>e)).catch((e=>{console.error(e)})),await t().fetchData(),t().setSelectedRecords([]),t().setIndeterminate(!1)},fetchData:async()=>{if(t().fetching)return;e({fetching:!0});let a={};a.per_page=t().paginationPerPage,a.page=t().pagination.currentPage,a.order=t().order.toUpperCase(),a.orderBy=t().orderBy,a.search=t().searchValue,a.status=t().status;const{records:s,totalRecords:n,totalOpen:r}=await i.doAction("get_datarequests",a).then((e=>e)).catch((e=>{console.error(e)}));e((()=>({recordsLoaded:!0,records:s,totalRecords:n,totalOpen:r,fetching:!1})))},startExport:async()=>{e({generating:!0,progress:0,exportLink:""})},fetchExportDatarequestsProgress:async(t,a,s)=>{(t=void 0!==t&&t)||e({generating:!0});let n={};n.startDate=a,n.endDate=s,n.statusOnly=t;const{progress:r,exportLink:o,noData:c}=await i.doAction("export_datarequests",n).then((e=>e)).catch((e=>{console.error(e)}));let l=!1;r<100&&(l=!0),e({progress:r,exportLink:o,generating:l,noData:c})}})));t.default=r},85671:function(e,t,a){a.r(t);var s=a(30270),i=a(12902),n=a(48399);const r=(0,s.Ue)(((e,t)=>({integrationsLoaded:!1,fetching:!1,services:[],plugins:[],scripts:[],placeholders:[],blockedScripts:[],setScript:(t,a)=>{e((0,i.ZP)((e=>{if("block_script"===a){let a=e.blockedScripts;if(t.urls){for(const[e,s]of Object.entries(t.urls)){if(!s||0===s.length)continue;let e=!1;for(const[t,i]of Object.entries(a))s===t&&(e=!0);e||(a[s]=s)}e.blockedScripts=a}}const s=e.scripts[a].findIndex((e=>e.id===t.id));-1!==s&&(e.scripts[a][s]=t)})))},fetchIntegrationsData:async()=>{if(t().fetching)return;e({fetching:!0});const{services:a,plugins:s,scripts:i,placeholders:n,blocked_scripts:r}=await o();let c=i;c.block_script&&c.block_script.length>0&&c.block_script.forEach(((e,t)=>{e.id=t})),c.add_script&&c.add_script.length>0&&c.add_script.forEach(((e,t)=>{e.id=t})),c.whitelist_script&&c.whitelist_script.length>0&&c.whitelist_script.forEach(((e,t)=>{e.id=t})),e((()=>({integrationsLoaded:!0,services:a,plugins:s,scripts:c,fetching:!1,placeholders:n,blockedScripts:r})))},addScript:a=>{e({fetching:!0}),t().scripts[a]&&Array.isArray(t().scripts[a])||e((0,i.ZP)((e=>{e.scripts[a]=[]}))),e((0,i.ZP)((e=>{e.scripts[a].push({name:"general",id:e.scripts[a].length,enable:!0})})));let s=t().scripts;return n.doAction("update_scripts",{scripts:s}).then((t=>(e({fetching:!1}),t))).catch((e=>{console.error(e)}))},saveScript:(a,s)=>{e({fetching:!0}),t().scripts[s]&&Array.isArray(t().scripts[s])||e((0,i.ZP)((e=>{e.scripts[s]=[]}))),e((0,i.ZP)((e=>{const t=e.scripts[s].findIndex((e=>e.id===a.id));-1!==t&&(e.scripts[s][t]=a)})));let r=t().scripts;return n.doAction("update_scripts",{scripts:r}).then((t=>(e({fetching:!1}),t))).catch((e=>{console.error(e)}))},deleteScript:(a,s)=>{e({fetching:!0}),t().scripts[s]&&Array.isArray(t().scripts[s])||e((0,i.ZP)((e=>{e.scripts[s]=[]}))),e((0,i.ZP)((e=>{const t=e.scripts[s].findIndex((e=>e.id===a.id));-1!==t&&e.scripts[s].splice(t,1)})));let r=t().scripts;return n.doAction("update_scripts",{scripts:r}).then((t=>(e({fetching:!1}),t))).catch((e=>{console.error(e)}))},updatePluginStatus:async(t,a)=>{e({fetching:!0}),e((0,i.ZP)((e=>{const s=e.plugins.findIndex((e=>e.id===t));-1!==s&&(e.plugins[s].enabled=a)})));const s=await n.doAction("update_plugin_status",{plugin:t,enabled:a}).then((e=>e)).catch((e=>{console.error(e)}));return e({fetching:!1}),s},updatePlaceholderStatus:async(t,a,s)=>{e({fetching:!0}),s&&e((0,i.ZP)((e=>{const s=e.plugins.findIndex((e=>e.id===t));-1!==s&&(e.plugins[s].placeholder=a?"enabled":"disabled")})));const r=await n.doAction("update_placeholder_status",{id:t,enabled:a}).then((e=>e)).catch((e=>{console.error(e)}));return e({fetching:!1}),r}})));t.default=r;const o=()=>n.doAction("get_integrations_data",{}).then((e=>e)).catch((e=>{console.error(e)}))},71789:function(e,t,a){a.r(t);var s=a(30270),i=a(48399);const n=(0,s.Ue)(((e,t)=>({licenseStatus:cmplz_settings.licenseStatus,processing:!1,licenseNotices:[],noticesLoaded:!1,getLicenseNotices:async()=>{const{licenseStatus:t,notices:a}=await i.doAction("license_notices",{}).then((e=>e));e((e=>({noticesLoaded:!0,licenseNotices:a,licenseStatus:t})))},activateLicense:async t=>{let a={};a.license=t,e({processing:!0});const{licenseStatus:s,notices:n}=await i.doAction("activate_license",a);e((e=>({processing:!1,licenseNotices:n,licenseStatus:s})))},deactivateLicense:async()=>{e({processing:!0});const{licenseStatus:t,notices:a}=await i.doAction("deactivate_license");e((e=>({processing:!1,licenseNotices:a,licenseStatus:t})))}})));t.default=n},23252:function(e,t,a){a.r(t);var s=a(30270),i=a(48399);const n={optin:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["0","0","0","0","0","0"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"A (default)",fill:"false",borderDash:[0,0]},{data:["0","0","0","0","0","0"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"B",fill:"false",borderDash:[0,0]}],max:5},optout:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["0","0","0","0","0","0"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"A (default)",fill:"false",borderDash:[0,0]},{data:["0","0","0","0","0","0"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"B",fill:"false",borderDash:[0,0]}],max:5}},r={optin:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["29","747","174","292","30","10"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"Demo A (default)",fill:"false",borderDash:[0,0]},{data:["3","536","240","389","45","32"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"Demo B",fill:"false",borderDash:[0,0]}],max:5},optout:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["29","747","174","292","30","10"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"A (default)",fill:"false",borderDash:[0,0]},{data:["3","536","240","389","45","32"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"Demo B",fill:"false",borderDash:[0,0]}],max:5}},o=(0,s.Ue)(((e,t)=>({consentType:"optin",setConsentType:t=>{e({consentType:t})},statisticsLoading:!1,consentTypes:[],regions:[],defaultConsentType:"optin",loaded:!1,statisticsData:n,emptyStatisticsData:n,bestPerformerEnabled:!1,daysLeft:"",abTrackingCompleted:!1,labels:[],setLabels:t=>{e({labels:t})},fetchStatisticsData:async()=>{if(!cmplz_settings.is_premium)return void e({saving:!1,loaded:!0,consentType:"optin",consentTypes:["optin","optout"],statisticsData:r,defaultConsentType:"optin",bestPerformerEnabled:!1,regions:"eu",daysLeft:11,abTrackingCompleted:!1});if(e({saving:!0}),t().loaded)return;const{daysLeft:a,abTrackingCompleted:s,consentTypes:n,statisticsData:o,defaultConsentType:c,regions:l,bestPerformerEnabled:d}=await i.doAction("get_statistics_data",{}).then((e=>e)).catch((e=>{console.error(e)}));e({saving:!1,loaded:!0,consentType:c,consentTypes:n,statisticsData:o,defaultConsentType:c,bestPerformerEnabled:d,regions:l,daysLeft:a,abTrackingCompleted:s})}})));t.default=o}}]);