import{o as d,d as i,a as e,r as y,i as C,k as T,b as r,w as j,e as $,v as g,O as L,t as l,g as n,f as w,A as I,F as M,h as B,u as R,n as u}from"./app.2b828a8f.js";import{_ as U}from"./PrimaryButton.b207566e.js";import{r as S,a as V,b as A}from"./WalletIcon.7eef0b38.js";function z(c,p){return d(),i("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"})])}const E={class:"px-5"},K={class:"mt-8 flex flex-col"},O={class:"-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"},W={class:"inline-block min-w-full py-2 align-middle px-3"},q={class:"overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"},G={class:"bg-slate-50 flex justify-between px-3 py-3 border-b"},H={class:"flex space-x-3 items-center"},J={key:0,class:"flex space-x-2"},Q=e("span",null,"SAVE AR",-1),X={class:"flex items-end space-x-3"},Y=e("option",{value:null}," All ",-1),Z=e("option",{value:!0}," Verified ",-1),ee=e("option",{value:!1}," unverified ",-1),se=e("option",{value:"nsfp"}," NSFP ",-1),te=[Y,Z,ee,se],oe={class:"text-xs"},ae={class:"text-xs"},le={class:"flex space-x-3"},ne={class:"flex space-x-2 items-center text-gray-700"},ce=e("span",null,"NPWP",-1),re={class:"flex space-x-2 items-center text-gray-700"},de=e("span",null,"NIK",-1),ie={class:"flex space-x-2 items-center text-gray-700"},pe=e("span",null,"Address",-1),ue={class:"min-w-full divide-y divide-gray-300"},he={class:"bg-white"},xe={class:"px-3 py-3.5 w-10 text-left text-sm font-semibold text-gray-900"},_e=e("th",{scope:"col",class:"py-3.5 pl-4 pr-3 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900 sm:pl-6"}," Doc. number",-1),ve=e("th",{scope:"col",class:"px-3 py-3.5 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900"}," Card code",-1),fe=e("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"}," Customer",-1),ye=e("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"}," NSFP",-1),ge=e("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"}," Cus. Ref Number",-1),we=e("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"}," Company",-1),be={scope:"col",class:"relative py-3.5 pl-3 pr-4 text-center sm:pr-6"},me={key:0,class:"bg-white"},Ne={class:"px-3 py-2"},ke=["value","onChange"],Ce=["onClick"],Ie={class:"whitespace-nowrap px-3 py-2 text-sm text-gray-700"},Se={class:"whitespace-nowrap px-3 py-2 text-sm text-gray-900"},Ve={class:"whitespace-nowrap px-3 py-2 text-sm text-gray-700"},Ae={class:"whitespace-nowrap px-3 py-2 text-sm text-gray-700"},De={class:"whitespace-nowrap px-3 py-2 text-sm text-gray-700"},Fe={class:"relative whitespace-nowrap py-2 text-sm font-medium flex items-center space-x-4 justify-center"},Pe={key:1},Te=e("tr",null,[e("td",{colspan:"6",class:"py-3 text-center"}," Ar invoice kosong ")],-1),je=[Te],Be={__name:"TableInvoice",props:{dataInvoice:{type:Object,default:{}},openDetail:{type:Function,default:()=>{}},branch:String,companyId:Number},setup(c){const p=c,h=y(!0),a=y([]),x=y(!1),_=C(()=>p.dataInvoice.filter(o=>{const t=h.value;return t==null?p.dataInvoice:t==!0?o.isValid==t:t==!1?o.isValid==!1:t=="nsfp"?o.NSFP==null&&(o==null?void 0:o.isValid)==!0:o.isValid==t})),D=C(()=>{switch(p.companyId){case 1:return"PT Laut Timur Ardiprima";case 2:return"PT Trijaya Adhiraja Abadi"}});T(()=>x.value,o=>{if(o)for(const t in _.value)a.value.push({..._.value[t],company_id:p.companyId});else a.value=[]});const F=o=>{a.value.filter(t=>t.DocNum==o.DocNum)},P=()=>{R({invoices:a.value,branch:p.branch}).post(route("arInvoice.multipleStore"),{onSuccess:()=>a.value=[]})};return(o,t)=>{var b,m,N,k;return d(),i("div",E,[e("div",K,[e("div",O,[e("div",W,[e("div",q,[e("div",G,[e("div",H,[a.value.length>0?(d(),i("div",J,[r(U,{class:"py-2 flex space-x-2 bg-emerald-700",onClick:P},{default:j(()=>[Q,r(n(z),{class:"w-5 h-5"})]),_:1})])):$("",!0),e("div",X,[e("div",null,[g(e("select",{"onUpdate:modelValue":t[0]||(t[0]=s=>h.value=s),class:"text-sm border border-gray-300 rounded"},te,512),[[L,h.value]])])]),e("div",null,[e("p",oe,"AR: "+l((b=c.dataInvoice.length)!=null?b:0),1),e("p",ae,"Selected: "+l((m=a.value.length)!=null?m:0),1)])]),e("div",le,[e("div",ne,[r(n(S),{class:"w-5 h-5"}),w(),ce]),e("div",re,[r(n(V),{class:"w-5 h-5"}),w(),de]),e("div",ie,[r(n(A),{class:"w-5 h-5"}),w(),pe])])]),e("table",ue,[e("thead",he,[e("tr",null,[e("th",xe,[g(e("input",{type:"checkbox","onUpdate:modelValue":t[1]||(t[1]=s=>x.value=s)},null,512),[[I,x.value]])]),_e,ve,fe,ye,ge,we,e("th",be,l((N=c.dataInvoice)==null?void 0:N.length)+" Invoice ",1)])]),((k=c.dataInvoice)==null?void 0:k.length)>0?(d(),i("tbody",me,[(d(!0),i(M,null,B(n(_).sort((s,v)=>s.DocNum-v.DocNum),(s,v)=>(d(),i("tr",{class:u([v%2?"bg-gray-50":"",s!=null&&s.isValid?"":"bg-orange-100 hover:bg-orange-200","hover:bg-gray-100 cursor-pointer"])},[e("td",Ne,[g(e("input",{type:"checkbox",value:{...s,company_id:c.companyId},"onUpdate:modelValue":t[2]||(t[2]=f=>a.value=f),onChange:f=>F({...s,company_id:c.companyId})},null,40,ke),[[I,a.value]])]),e("td",{onClick:f=>c.openDetail(s),class:"whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 hover:underline"},l(s==null?void 0:s.DocNum),9,Ce),e("td",Ie,l(s==null?void 0:s.CardCode),1),e("td",Se,l(s==null?void 0:s.CardName),1),e("td",Ve,l(s==null?void 0:s.NSFP),1),e("td",Ae,l(s==null?void 0:s.NumAtCard),1),e("td",De,l(n(D)),1),e("td",Fe,[r(n(S),{class:u(["w-5 h-5",[(s==null?void 0:s.LicTradNum)=="00.000.000.0-000.000"||(s==null?void 0:s.LicTradNum)==null?"text-rose-500":"text-emerald-500"]])},null,8,["class"]),r(n(V),{class:u(["w-5 h-5",[(s==null?void 0:s.NIK)==null?"text-rose-500":"text-emerald-500"]])},null,8,["class"]),r(n(A),{class:u(["w-5 h-5",[(s==null?void 0:s.Street)==null?"text-rose-500":"text-emerald-500"]])},null,8,["class"])])],2))),256))])):(d(),i("tbody",Pe,je))])])])])])])}}};export{Be as default};
