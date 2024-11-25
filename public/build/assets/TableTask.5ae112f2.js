import{n as g}from"./numeral.d4bbc991.js";import{o as p,d as c,a as t,r as h,f as y,t as s,b as m,g as b,e as v,F as _,h as k,n as T}from"./app.2b828a8f.js";function E(n,a){return p(),c("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[t("path",{"fill-rule":"evenodd",d:"M16.403 12.652a3 3 0 000-5.304 3 3 0 00-3.75-3.751 3 3 0 00-5.305 0 3 3 0 00-3.751 3.75 3 3 0 000 5.305 3 3 0 003.75 3.751 3 3 0 005.305 0 3 3 0 003.751-3.75zm-2.546-4.46a.75.75 0 00-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z","clip-rule":"evenodd"})])}const N={class:"flex justify-between items-center px-3 py-2 bg-white border shadow-sm rounded mb-4"},A={class:"flex items-center space-x-2"},B={class:"text-[12px] text-gray-500"},C={class:"font-semibold text-gray-800"},D={key:0},I={type:"button",class:"border px-2 py-1 rounded flex items-center space-x-2 ml-4 bg-green-100 group hover:bg-green-800"},O=t("span",{class:"text-[13px] text-green-800 font-semibold group-hover:text-white"},"Mark as done",-1),S={class:"text-[12px] text-gray-500"},M={class:"font-semibold text-gray-800"},V={class:"overflow-x-scroll shadow ring-1 ring-black ring-opacity-5 max-w-screen-2xl md:rounded-md"},P={class:"min-w-full divide-y divide-gray-300"},U=t("thead",{class:"bg-gray-50"},[t("tr",{class:"divide-x"},[t("th",{scope:"col",class:"py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900 sm:pl-3"},"#"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"POST DATE"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"BP. CODE"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"DOC NUM"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"BP. REF. NO"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"BP. NAME"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"DELIVERY DATE"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"OR AMOUNT"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"BALANCE DUE"),t("th",{scope:"col",class:"px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900"},"STATUS")])],-1),z={key:0,class:"bg-white"},F={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 w-10 sm:pl-3"},L=["onClick","checked"],R={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"},j={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"},K={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-bold text-gray-900 sm:pl-3"},W={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"},Y={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"},$={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"},q={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"},G={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"},H={class:"whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-white sm:pl-3 uppercase bg-cyan-600 text-center"},J={key:1,class:"bg-white"},Q=t("tr",null,[t("td",{colspan:"16",class:"py-8 w-full text-center"},[t("p",{class:"text-gray-400"},"Data Task Kosong")])],-1),X=[Q],st={__name:"TableTask",props:{data:{type:Array,default:[]},total:{type:Number,default:0}},setup(n){const a=h([]);h(!1);const d=o=>g(o).format("0,0.00"),f=o=>{x(o.id)[0]?u(o.id):a.value.push(o)};function u(o){const l=a.value.findIndex(r=>r.id===o);a.value.splice(l,1)}const x=o=>a.value.filter(l=>l.id===o);return(o,l)=>{var r,i;return p(),c(_,null,[t("div",N,[t("div",A,[t("p",B,[y("Selected : "),t("span",C,s((r=a.value)==null?void 0:r.length),1)]),a.value.length>0?(p(),c("div",D,[t("button",I,[m(b(E),{class:"w-5 h-5 text-green-800 group-hover:text-white"}),O])])):v("",!0)]),t("div",null,[t("p",S,[y("Total : "),t("span",M,s(n.total),1)])])]),t("div",V,[t("table",P,[U,((i=n.data)==null?void 0:i.length)>0?(p(),c("tbody",z,[(p(!0),c(_,null,k(n.data,(e,w)=>(p(),c("tr",{class:T([w%2===0?void 0:"bg-gray-50","divide-x hover:bg-gray-200/70"])},[t("td",F,[t("input",{type:"checkbox",onClick:Z=>f(e),checked:!!x(e==null?void 0:e.id)[0]},null,8,L)]),t("td",R,s(e.posting_date),1),t("td",j,s(e.bp_code),1),t("td",K,s(e.doc_num),1),t("td",W,s(e.bp_ref_no),1),t("td",Y,s(e.bp_name),1),t("td",$,s(e.delivery_date),1),t("td",q,s(d(e.original_amount)),1),t("td",G,s(d(e.balance_due)),1),t("td",H,s(e.status),1)],2))),256))])):(p(),c("tbody",J,X))])])],64)}}};export{st as default};
