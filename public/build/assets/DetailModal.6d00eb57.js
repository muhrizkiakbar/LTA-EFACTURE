import{u as O,o as c,d as m,a as e,t as l,b as _,g as T,w as n,c as U,e as A,n as z,Q as E,f as r}from"./app.2b828a8f.js";import{_ as f}from"./PrimaryButton.b207566e.js";import{_ as M}from"./SecondaryButton.1845019d.js";import{_ as Q}from"./TextInput.850951f2.js";const R={class:"px-5"},W={class:z(["flex space-x-4 justify-between -mx-5 px-5 py-4"])},q=e("p",{class:"text-gray-600"},"Doc. Number",-1),H={class:"font-semibold"},J=e("p",{class:"text-gray-600"},"Customer Code",-1),X={class:"font-semibold"},Y=e("p",{class:"text-gray-600"},"NPWP",-1),Z={class:"font-semibold"},ee={class:"bg-slate-100 -mx-5 px-5 py-2"},se=e("p",{class:"text-gray-600"},"Customer",-1),te={class:"font-semibold"},ae={class:"py-4"},oe=e("p",{class:"text-gray-600"},"Address",-1),le={class:"font-semibold"},de={key:0,class:"flex space-x-2 items-end py-4"},ie={key:1,class:"py-4"},ce=e("p",{class:"text-gray-600"},"NSFP",-1),ne={class:"font-semibold"},re={class:"flex space-x-2 justify-end pb-4 pt-3 border-t -mx-5 px-5"},ye={__name:"DetailModal",props:{detail:{type:Object,default:{}},branch:{type:String,default:""}},emits:["close","submit"],setup(s,{emit:u}){var y,h,x,p,k,g,b;const o=s,d=O({ar_series:(y=o.detail)==null?void 0:y.id,docNum:(h=o.detail)==null?void 0:h.DocNum,series:null,keyId:null}),G=O({series:(p=(x=o.detail)==null?void 0:x.key)==null?void 0:p.series,docnum:(k=o.detail)==null?void 0:k.DocNum,address:(g=o.detail)==null?void 0:g.Street,date:(b=o.detail)==null?void 0:b.posting_date}),I=()=>{E.get(route("keySeries.generate")).then(t=>{var a,i;console.log(t.data),d.series=(a=t.data)==null?void 0:a.series,d.keyId=(i=t.data)==null?void 0:i.id}).catch(t=>{console.log(t)})},K=()=>d.post(route("pair.store"),{onSuccess:()=>u("close")}),L=()=>G.post(route("arSeries.update"),{onSuccess:t=>u("close")});return(t,a)=>{var i,N,v,C,S,V,D,P,B,$,j,w;return c(),m("div",R,[e("div",null,[e("div",W,[e("div",null,[q,e("h1",H,l((i=s.detail)==null?void 0:i.DocNum),1)]),e("div",null,[J,e("h1",X,l((N=s.detail)==null?void 0:N.CardCode),1)]),e("div",null,[Y,e("h1",Z,l(((v=s.detail)==null?void 0:v.LicTradNum)!==null?(C=s.detail)==null?void 0:C.LicTradNum:"KOSONG"),1)])]),e("div",ee,[se,e("h1",te,l((S=s.detail)==null?void 0:S.CardName),1)]),e("div",ae,[oe,e("h1",le,l(((V=s.detail)==null?void 0:V.Street)!==null?(D=s.detail)==null?void 0:D.Street:"kosong"),1)]),s.detail.key===null?(c(),m("div",de,[e("div",null,[_(Q,{modelValue:T(d).series,"onUpdate:modelValue":a[0]||(a[0]=F=>T(d).series=F),disabled:!0},null,8,["modelValue"])]),e("div",null,[_(f,{onClick:I,class:"py-2.5"},{default:n(()=>[r("Generate NSFP")]),_:1})])])):(c(),m("div",ie,[ce,e("h1",ne,l((B=(P=s.detail)==null?void 0:P.key)==null?void 0:B.series),1)]))]),e("div",re,[_(M,{onClick:a[1]||(a[1]=F=>u("close"))},{default:n(()=>[r("Close")]),_:1}),(($=s.detail)==null?void 0:$.status)=="0"?(c(),U(f,{key:0,onClick:K},{default:n(()=>[r("Pairing key")]),_:1})):A("",!0),((j=s.detail)==null?void 0:j.status)=="1"||((w=s.detail)==null?void 0:w.status)=="2"?(c(),U(f,{key:1,onClick:L},{default:n(()=>[r("Update AR")]),_:1})):A("",!0)])])}}};export{ye as default};
