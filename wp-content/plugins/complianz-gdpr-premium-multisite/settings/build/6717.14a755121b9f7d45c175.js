"use strict";(self.webpackChunkcomplianz_gdpr=self.webpackChunkcomplianz_gdpr||[]).push([[6717],{6717:function(e,t,a){a.r(t);var n=a(69307),l=a(9478),d=a(30286),r=a(23855),s=a(69119),o=a(83894),u=a(77349),c=a(43703),i=a(11640),D=a(4135),f=a(38148),m=a(21593),y=a(10876),p=a(3151),g=a(49546),w=a(23361),h=a(65736),b=a(18667);t.default=()=>{const[e,t]=(0,n.useState)(null),a=Boolean(e),_=(0,b.default)((e=>e.startDate)),z=(0,b.default)((e=>e.endDate)),M=(0,b.default)((e=>e.setStartDate)),E=(0,b.default)((e=>e.setEndDate)),k=(0,b.default)((e=>e.range)),v=(0,b.default)((e=>e.setRange)),C={startDate:(0,r.Z)(_),endDate:(0,r.Z)(z),key:"selection"},S=(0,n.useRef)(0),Z=["today","yesterday","last-7-days","last-30-days","last-90-days","last-month","last-year","year-to-date"],L={today:{label:(0,h.__)("Today","complianz-gdpr"),range:()=>({startDate:(0,s.default)(new Date),endDate:(0,o.default)(new Date)})},yesterday:{label:(0,h.__)("Yesterday","complianz-gdpr"),range:()=>({startDate:(0,s.default)((0,u.default)(new Date,-1)),endDate:(0,o.default)((0,u.default)(new Date,-1))})},"last-7-days":{label:(0,h.__)("Last 7 days","complianz-gdpr"),range:()=>({startDate:(0,s.default)((0,u.default)(new Date,-7)),endDate:(0,o.default)((0,u.default)(new Date,-1))})},"last-30-days":{label:(0,h.__)("Last 30 days","complianz-gdpr"),range:()=>({startDate:(0,s.default)((0,u.default)(new Date,-30)),endDate:(0,o.default)((0,u.default)(new Date,-1))})},"last-90-days":{label:(0,h.__)("Last 90 days","complianz-gdpr"),range:()=>({startDate:(0,s.default)((0,u.default)(new Date,-90)),endDate:(0,o.default)((0,u.default)(new Date,-1))})},"last-month":{label:(0,h.__)("Last month","complianz-gdpr"),range:()=>({startDate:(0,c.default)((0,i.default)(new Date,-1)),endDate:(0,D.default)((0,i.default)(new Date,-1))})},"year-to-date":{label:(0,h.__)("Year to date","complianz-gdpr"),range:()=>({startDate:(0,f.Z)(new Date),endDate:(0,o.default)(new Date)})},"last-year":{label:(0,h.__)("Last year","complianz-gdpr"),range:()=>({startDate:(0,f.Z)((0,m.default)(new Date,-1)),endDate:(0,y.Z)((0,m.default)(new Date,-1))})}};function O(e){const t=this.range();return(0,p.default)(e.startDate,t.startDate)&&(0,p.default)(e.endDate,t.endDate)}const R=[];for(const[e,t]of Object.entries(Z))t&&(R.push(L[t]),R[R.length-1].isSelected=O);const j=e=>{t(null)},F="MMMM d, yyyy",N=_?(0,g.default)(new Date(_),F):(0,g.default)(defaultStart,F),P=z?(0,g.default)(new Date(z),F):(0,g.default)(defaultEnd,F);return(0,n.createElement)("div",{className:"cmplz-date-range-container"},(0,n.createElement)("button",{onClick:e=>{t(e.currentTarget)},id:"cmplz-date-range-picker-open-button"},(0,n.createElement)(w.default,{name:"calendar",size:"18"}),"custom"===k&&N+" - "+P,"custom"!==k&&L[k].label,(0,n.createElement)(w.default,{name:"chevron-down"})),(0,n.createElement)(l.ZP,{anchorEl:e,anchorOrigin:{vertical:"bottom",horizontal:"right"},transformOrigin:{vertical:"top",horizontal:"right"},open:a,onClose:j,className:"burst"},(0,n.createElement)("div",{id:"cmplz-date-range-picker-container"},(0,n.createElement)(d.Dw,{ranges:[C],rangeColors:["var(--rsp-brand-primary)"],dateDisplayFormat:F,monthDisplayFormat:"MMMM",onChange:e=>{(e=>{S.current++;let t=(0,g.default)(e.selection.startDate,"yyyy-MM-dd"),a=(0,g.default)(e.selection.endDate,"yyyy-MM-dd"),n="custom";for(const[t,a]of Object.entries(L))a.isSelected(e.selection)&&(n=t);e.selection.startDate,e.selection.endDate,2!==S.current&&t===a&&"custom"===n||(S.current=0,M(t),E(a),v(n),j())})(e)},inputRanges:[],showSelectionPreview:!0,months:2,direction:"horizontal",minDate:new Date(2022,0,1),maxDate:new Date,staticRanges:R}))))}}}]);