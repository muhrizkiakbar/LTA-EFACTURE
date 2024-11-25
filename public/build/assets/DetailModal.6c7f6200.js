import{o as w,d as V,a as t,n as u,t as i,b as _,w as v,u as I,f as S}from"./app.2b828a8f.js";import{_ as k}from"./PrimaryButton.b207566e.js";import{_ as T}from"./SecondaryButton.1845019d.js";const j={class:"px-5"},K={class:"font-semibold"},L={class:"font-semibold"},B={class:"font-semibold"},O={class:"bg-slate-100 -mx-5 px-5 py-2 flex justify-between"},$=t("p",{class:"text-gray-600"},"Customer",-1),A={class:"font-semibold"},E=t("p",{class:"text-gray-600"},"NIK",-1),F={class:"font-semibold"},P={class:"py-4"},p=t("p",{class:"text-gray-600"},"Address",-1),z={class:"font-semibold"},G={class:"flex space-x-2 justify-end pb-4 pt-3 border-t -mx-5 px-5"},H={__name:"DetailModal",props:{detail:{type:Object,default:{}},branch:{type:String,default:""},companyId:String},emits:["close","submit"],setup(e,{emit:h}){const a=e,D=()=>{var l,d,o,c,n,r,m;console.log(a.detail);const x=I({DocNum:(l=a.detail)==null?void 0:l.DocNum,CardCode:(d=a.detail)==null?void 0:d.CardCode,CardName:(o=a.detail)==null?void 0:o.CardName,Street:(c=a.detail)==null?void 0:c.Street,LicTradNum:(n=a.detail)==null?void 0:n.LicTradNum,status:0,branch_id:a.branch,posting_date:(r=a==null?void 0:a.detail)==null?void 0:r.DocDate,company_id:a==null?void 0:a.companyId});(m=a.detail)!=null&&m.isValid?x.post(route("arInvoice.store"),{onError:s=>alert(s.DocNum),onSuccess:s=>console.log(s),onFinish:()=>h("close")}):alert("Data not valid")};return(x,l)=>{var d,o,c,n,r,m,s,f,b,N,y,g,C;return w(),V("div",j,[t("div",null,[t("div",{class:u([(d=e.detail)!=null&&d.isValid?"text-gray-900":"bg-orange-500 text-white","flex space-x-4 justify-between -mx-5 px-5 py-4"])},[t("div",null,[t("p",{class:u([(o=e.detail)!=null&&o.isValid?"text-gray-600":"text-white"])},"Doc. Number",2),t("h1",K,i((c=e.detail)==null?void 0:c.DocNum),1)]),t("div",null,[t("p",{class:u([(n=e.detail)!=null&&n.isValid?"text-gray-600":"text-white"])},"Customer Code",2),t("h1",L,i((r=e.detail)==null?void 0:r.CardCode),1)]),t("div",null,[t("p",{class:u([(m=e.detail)!=null&&m.isValid?"text-gray-600":"text-white"])},"NPWP",2),t("h1",B,i(((s=e.detail)==null?void 0:s.LicTradNum)!==null?(f=e.detail)==null?void 0:f.LicTradNum:"KOSONG"),1)])],2),t("div",O,[t("div",null,[$,t("h1",A,i((b=e.detail)==null?void 0:b.CardName),1)]),t("div",null,[E,t("h1",F,i((N=e.detail)!=null&&N.NIK?(y=e.detail)==null?void 0:y.NIK:"-"),1)])]),t("div",P,[p,t("h1",z,i(((g=e.detail)==null?void 0:g.Street)!==null?(C=e.detail)==null?void 0:C.Street:"kosong"),1)])]),t("div",G,[_(T,{onClick:l[0]||(l[0]=M=>h("close"))},{default:v(()=>[S("Close")]),_:1}),_(k,{onClick:D},{default:v(()=>[S(" Store to A/R Series")]),_:1})])])}}};export{H as default};
