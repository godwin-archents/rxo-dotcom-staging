"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[1424,5070],{91424:function(e,t,n){n.r(t);var a=n(69307),l=n(65736),i=n(14531),r=n(5070);t.default=()=>{const{dataLoaded:e,pluginData:t,pluginActions:n,fetchOtherPluginsData:o,error:c}=(0,r.default)();return(0,a.useEffect)((()=>{e||o()}),[]),!e||c?(0,a.createElement)(i.default,{lines:"3",error:c}):(0,a.createElement)("div",{className:"cmplz-other-plugins-container"},t.map(((e,t)=>((e,t)=>(0,a.createElement)("div",{key:t,className:"cmplz-other-plugins-element cmplz-"+e.slug},(0,a.createElement)("a",{href:e.wordpress_url,target:"_blank",rel:"noopener noreferrer",title:e.title},(0,a.createElement)("div",{className:"cmplz-bullet"}),(0,a.createElement)("div",{className:"cmplz-other-plugins-content"},e.title)),(0,a.createElement)("div",{className:"cmplz-other-plugin-status"},"upgrade-to-premium"===e.pluginAction&&(0,a.createElement)("a",{target:"_blank",href:e.upgrade_url,rel:"noopener noreferrer"},(0,l.__)("Upgrade","complianz-gdpr")),"upgrade-to-premium"!==e.pluginAction&&"installed"!==e.pluginAction&&(0,a.createElement)("a",{href:"#",onClick:t=>n(e.slug,e.pluginAction,t)},e.pluginActionNice),"installed"===e.pluginAction&&(0,l.__)("Installed","complianz-gdpr"))))(e,t))))}},5070:function(e,t,n){n.r(t);var a=n(30270),l=n(48399),i=n(65736);const r=(0,a.Ue)(((e,t)=>({error:!1,dataLoaded:!1,pluginData:[],updatePluginData:(n,a)=>{let l=t().pluginData;l.forEach((function(e,t){e.slug===n&&(l[t]=a)})),e((e=>({dataLoaded:!0,pluginData:l})))},getPluginData:e=>t().pluginData.filter((t=>t.slug===e))[0],fetchOtherPluginsData:async()=>{const{pluginData:t,error:n}=await l.doAction("otherpluginsdata").then((e=>{let t=[];t=e.plugins;let n=e.error;return n||t.forEach((function(e,n){t[n].pluginActionNice=o(e.pluginAction)})),{pluginData:t,error:n}}));e((e=>({dataLoaded:!0,pluginData:t,error:n})))},pluginActions:(e,n,a)=>{a&&a.preventDefault();let i={};i.slug=e,i.pluginAction=n;let r=t().getPluginData(e);"download"===n?r.pluginAction="downloading":"activate"===n&&(r.pluginAction="activating"),r.pluginActionNice=o(r.pluginAction),t().updatePluginData(e,r),"installed"!==n&&"upgrade-to-premium"!==n&&l.doAction("plugin_actions",i).then((n=>{r=n,t().updatePluginData(e,r),t().pluginActions(e,r.pluginAction)}))}})));t.default=r;const o=e=>({download:(0,i.__)("Install","complianz-gdpr"),activate:(0,i.__)("Activate","complianz-gdpr"),activating:(0,i.__)("Activating...","complianz-gdpr"),downloading:(0,i.__)("Downloading...","complianz-gdpr"),"upgrade-to-premium":(0,i.__)("Downloading...","complianz-gdpr")}[e])}}]);