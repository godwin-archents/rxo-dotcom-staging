"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[8808,1789,3252],{71789:function(e,t,a){a.r(t);var o=a(30270),s=a(48399);const n=(0,o.Ue)(((e,t)=>({licenseStatus:cmplz_settings.licenseStatus,processing:!1,licenseNotices:[],noticesLoaded:!1,getLicenseNotices:async()=>{const{licenseStatus:t,notices:a}=await s.doAction("license_notices",{}).then((e=>e));e((e=>({noticesLoaded:!0,licenseNotices:a,licenseStatus:t})))},activateLicense:async t=>{let a={};a.license=t,e({processing:!0});const{licenseStatus:o,notices:n}=await s.doAction("activate_license",a);e((e=>({processing:!1,licenseNotices:n,licenseStatus:o})))},deactivateLicense:async()=>{e({processing:!0});const{licenseStatus:t,notices:a}=await s.doAction("deactivate_license");e((e=>({processing:!1,licenseNotices:a,licenseStatus:t})))}})));t.default=n},38808:function(e,t,a){a.r(t);var o=a(69307),s=a(56293),n=a(23252),i=a(71789);t.default=(0,o.memo)((()=>{const{fields:e,getFieldValue:t}=(0,s.default)(),[l,r]=(0,o.useState)(!1),[c,d]=(0,o.useState)(!1),{consentType:g,setConsentType:b,statisticsData:u,emptyStatisticsData:f,consentTypes:p,loaded:m,fetchStatisticsData:C,statisticsLoading:h}=(0,n.default)(),[k,y]=(0,o.useState)(null),{licenseStatus:_}=(0,i.default)();(0,o.useEffect)((()=>{a.e(9449).then(a.bind(a,69449)).then((e=>{let{Chart:t,CategoryScale:a,LinearScale:o,BarElement:s,Title:n,Tooltip:i,Legend:l}=e;t.register(a,o,s,n,i,l)})),Promise.all([a.e(9449),a.e(6495)]).then(a.bind(a,26495)).then((e=>{let{Bar:t}=e;y((()=>t))}))}),[]),(0,o.useEffect)((()=>{!m&&l&&C()}),[m,l]),(0,o.useEffect)((()=>{1==t("a_b_testing")?r(!0):r(!1)}),[e]),(0,o.useEffect)((()=>{"valid"===_&&l?f.hasOwnProperty(g)&&d(f[g]):u.hasOwnProperty(g)&&d(u[g])}),[]),(0,o.useEffect)((()=>{l&&d(u[g])}),[g,l,m]);const T=h?"cmplz-loading":"";return(0,o.createElement)(o.Fragment,null,p.length>1&&(0,o.createElement)("select",{value:g,onChange:e=>b(e.target.value)},p.map(((e,t)=>(0,o.createElement)("option",{key:t,value:e.id},e.label)))),c&&k&&(0,o.createElement)(k,{className:`cmplz-loading-container ${T}`,options:{responsive:!0,plugins:{legend:{position:"top"}}},data:c}))}))},23252:function(e,t,a){a.r(t);var o=a(30270),s=a(48399);const n={optin:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["0","0","0","0","0","0"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"A (default)",fill:"false",borderDash:[0,0]},{data:["0","0","0","0","0","0"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"B",fill:"false",borderDash:[0,0]}],max:5},optout:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["0","0","0","0","0","0"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"A (default)",fill:"false",borderDash:[0,0]},{data:["0","0","0","0","0","0"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"B",fill:"false",borderDash:[0,0]}],max:5}},i={optin:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["29","747","174","292","30","10"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"Demo A (default)",fill:"false",borderDash:[0,0]},{data:["3","536","240","389","45","32"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"Demo B",fill:"false",borderDash:[0,0]}],max:5},optout:{labels:["Functional","Statistics","Marketing","Do Not Track","No Choice","No Warning"],categories:["functional","statistics","marketing","do_not_track","no_choice","no_warning"],datasets:[{data:["29","747","174","292","30","10"],backgroundColor:"rgba(46, 138, 55, 1)",borderColor:"rgba(46, 138, 55, 1)",label:"A (default)",fill:"false",borderDash:[0,0]},{data:["3","536","240","389","45","32"],backgroundColor:"rgba(244, 191, 62, 1)",borderColor:"rgba(244, 191, 62, 1)",label:"Demo B",fill:"false",borderDash:[0,0]}],max:5}},l=(0,o.Ue)(((e,t)=>({consentType:"optin",setConsentType:t=>{e({consentType:t})},statisticsLoading:!1,consentTypes:[],regions:[],defaultConsentType:"optin",loaded:!1,statisticsData:n,emptyStatisticsData:n,bestPerformerEnabled:!1,daysLeft:"",abTrackingCompleted:!1,labels:[],setLabels:t=>{e({labels:t})},fetchStatisticsData:async()=>{if(!cmplz_settings.is_premium)return void e({saving:!1,loaded:!0,consentType:"optin",consentTypes:["optin","optout"],statisticsData:i,defaultConsentType:"optin",bestPerformerEnabled:!1,regions:"eu",daysLeft:11,abTrackingCompleted:!1});if(e({saving:!0}),t().loaded)return;const{daysLeft:a,abTrackingCompleted:o,consentTypes:n,statisticsData:l,defaultConsentType:r,regions:c,bestPerformerEnabled:d}=await s.doAction("get_statistics_data",{}).then((e=>e)).catch((e=>{console.error(e)}));e({saving:!1,loaded:!0,consentType:r,consentTypes:n,statisticsData:l,defaultConsentType:r,bestPerformerEnabled:d,regions:c,daysLeft:a,abTrackingCompleted:o})}})));t.default=l}}]);