import{u as h,r as b,o as i,d as r,b as t,w as e,a,e as v,f as n,g as l,F as $,h as x,t as k,n as A}from"./app.2b828a8f.js";import{_ as N}from"./ActionMessage.c6eb034b.js";import{_ as j}from"./ActionSection.20773b99.js";import{_ as P}from"./Checkbox.6f6763de.js";import{_ as U}from"./ConfirmationModal.cb8b0e16.js";import{_ as L}from"./DangerButton.625e16be.js";import{_ as T}from"./DialogModal.0a24c668.js";import{_ as M}from"./FormSection.bb28e1e5.js";import{_ as z}from"./InputError.64defbd4.js";import{_ as w}from"./InputLabel.d6f23afb.js";import{_ as S}from"./PrimaryButton.b207566e.js";import{_ as C}from"./SecondaryButton.1845019d.js";import{S as E}from"./SectionBorder.30504d2c.js";import{_ as Y}from"./TextInput.850951f2.js";import"./SectionTitle.f8e4babd.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./Modal.e290b86f.js";const q={class:"col-span-6 sm:col-span-4"},G={key:0,class:"col-span-6"},H={class:"mt-2 grid grid-cols-1 md:grid-cols-2 gap-4"},J={class:"flex items-center"},K={class:"ml-2 text-sm text-gray-600"},O={key:0},Q={class:"mt-10 sm:mt-0"},R={class:"space-y-6"},W={class:"flex items-center"},X={key:0,class:"text-sm text-gray-400"},Z=["onClick"],ee=["onClick"],se=a("div",null," Please copy your new API token. For your security, it won't be shown again. ",-1),te={key:0,class:"mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500"},oe={class:"grid grid-cols-1 md:grid-cols-2 gap-4"},ne={class:"flex items-center"},le={class:"ml-2 text-sm text-gray-600"},Ae={__name:"ApiTokenManager",props:{tokens:Array,availablePermissions:Array,defaultPermissions:Array},setup(c){const m=h({name:"",permissions:c.defaultPermissions}),d=h({permissions:[]}),y=h(),g=b(!1),p=b(null),f=b(null),F=()=>{m.post(route("api-tokens.store"),{preserveScroll:!0,onSuccess:()=>{g.value=!0,m.reset()}})},I=u=>{d.permissions=u.abilities,p.value=u},V=()=>{d.put(route("api-tokens.update",p.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>p.value=null})},D=u=>{f.value=u},B=()=>{y.delete(route("api-tokens.destroy",f.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>f.value=null})};return(u,o)=>(i(),r("div",null,[t(M,{onSubmitted:F},{title:e(()=>[n(" Create API Token ")]),description:e(()=>[n(" API tokens allow third-party services to authenticate with our application on your behalf. ")]),form:e(()=>[a("div",q,[t(w,{for:"name",value:"Name"}),t(Y,{id:"name",modelValue:l(m).name,"onUpdate:modelValue":o[0]||(o[0]=s=>l(m).name=s),type:"text",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"]),t(z,{message:l(m).errors.name,class:"mt-2"},null,8,["message"])]),c.availablePermissions.length>0?(i(),r("div",G,[t(w,{for:"permissions",value:"Permissions"}),a("div",H,[(i(!0),r($,null,x(c.availablePermissions,s=>(i(),r("div",{key:s},[a("label",J,[t(P,{checked:l(m).permissions,"onUpdate:checked":o[1]||(o[1]=_=>l(m).permissions=_),value:s},null,8,["checked","value"]),a("span",K,k(s),1)])]))),128))])])):v("",!0)]),actions:e(()=>[t(N,{on:l(m).recentlySuccessful,class:"mr-3"},{default:e(()=>[n(" Created. ")]),_:1},8,["on"]),t(S,{class:A({"opacity-25":l(m).processing}),disabled:l(m).processing},{default:e(()=>[n(" Create ")]),_:1},8,["class","disabled"])]),_:1}),c.tokens.length>0?(i(),r("div",O,[t(E),a("div",Q,[t(j,null,{title:e(()=>[n(" Manage API Tokens ")]),description:e(()=>[n(" You may delete any of your existing tokens if they are no longer needed. ")]),content:e(()=>[a("div",R,[(i(!0),r($,null,x(c.tokens,s=>(i(),r("div",{key:s.id,class:"flex items-center justify-between"},[a("div",null,k(s.name),1),a("div",W,[s.last_used_ago?(i(),r("div",X," Last used "+k(s.last_used_ago),1)):v("",!0),c.availablePermissions.length>0?(i(),r("button",{key:1,class:"cursor-pointer ml-6 text-sm text-gray-400 underline",onClick:_=>I(s)}," Permissions ",8,Z)):v("",!0),a("button",{class:"cursor-pointer ml-6 text-sm text-red-500",onClick:_=>D(s)}," Delete ",8,ee)])]))),128))])]),_:1})])])):v("",!0),t(T,{show:g.value,onClose:o[3]||(o[3]=s=>g.value=!1)},{title:e(()=>[n(" API Token ")]),content:e(()=>[se,u.$page.props.jetstream.flash.token?(i(),r("div",te,k(u.$page.props.jetstream.flash.token),1)):v("",!0)]),footer:e(()=>[t(C,{onClick:o[2]||(o[2]=s=>g.value=!1)},{default:e(()=>[n(" Close ")]),_:1})]),_:1},8,["show"]),t(T,{show:p.value!=null,onClose:o[6]||(o[6]=s=>p.value=null)},{title:e(()=>[n(" API Token Permissions ")]),content:e(()=>[a("div",oe,[(i(!0),r($,null,x(c.availablePermissions,s=>(i(),r("div",{key:s},[a("label",ne,[t(P,{checked:l(d).permissions,"onUpdate:checked":o[4]||(o[4]=_=>l(d).permissions=_),value:s},null,8,["checked","value"]),a("span",le,k(s),1)])]))),128))])]),footer:e(()=>[t(C,{onClick:o[5]||(o[5]=s=>p.value=null)},{default:e(()=>[n(" Cancel ")]),_:1}),t(S,{class:A(["ml-3",{"opacity-25":l(d).processing}]),disabled:l(d).processing,onClick:V},{default:e(()=>[n(" Save ")]),_:1},8,["class","disabled"])]),_:1},8,["show"]),t(U,{show:f.value!=null,onClose:o[8]||(o[8]=s=>f.value=null)},{title:e(()=>[n(" Delete API Token ")]),content:e(()=>[n(" Are you sure you would like to delete this API token? ")]),footer:e(()=>[t(C,{onClick:o[7]||(o[7]=s=>f.value=null)},{default:e(()=>[n(" Cancel ")]),_:1}),t(L,{class:A(["ml-3",{"opacity-25":l(y).processing}]),disabled:l(y).processing,onClick:B},{default:e(()=>[n(" Delete ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{Ae as default};
