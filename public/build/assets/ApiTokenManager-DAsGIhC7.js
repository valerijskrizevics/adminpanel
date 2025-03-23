import{C as _,r as C,d as a,o as r,b as o,e as k,w as s,u as l,f as n,n as $,a as i,F as x,g as A,t as g}from"./app-BmkWWvPF.js";import{_ as j}from"./ActionMessage-CjbT-evc.js";import{_ as U,a as T}from"./DialogModal-BJr7N5wV.js";import{_ as w}from"./Checkbox-BnQFfFUp.js";import{_ as L}from"./ConfirmationModal-BaOKPLRj.js";import{_ as M}from"./DangerButton-C7Cvm2-G.js";import{_ as z}from"./FormSection-BiDpe8UW.js";import{_ as E,a as Y}from"./TextInput-CPA8Afyn.js";import{_ as S}from"./InputLabel-BksNtQ8X.js";import{_ as I}from"./PrimaryButton-DLwGlFx1.js";import{_ as P}from"./SecondaryButton-BGipNd3o.js";import{S as q}from"./SectionBorder-CHEXMQ3V.js";import"./SectionTitle-D7eQtV3t.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Modal-DH5VUQb0.js";const G={class:"col-span-6 sm:col-span-4"},H={key:0,class:"col-span-6"},J={class:"mt-2 grid grid-cols-1 md:grid-cols-2 gap-4"},K={class:"flex items-center"},O={class:"ms-2 text-sm text-gray-600"},Q={key:0},R={class:"mt-10 sm:mt-0"},W={class:"space-y-6"},X={class:"break-all"},Z={class:"flex items-center ms-2"},h={key:0,class:"text-sm text-gray-400"},ee=["onClick"],se=["onClick"],te={key:0,class:"mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 break-all"},oe={class:"grid grid-cols-1 md:grid-cols-2 gap-4"},ne={class:"flex items-center"},le={class:"ms-2 text-sm text-gray-600"},$e={__name:"ApiTokenManager",props:{tokens:Array,availablePermissions:Array,defaultPermissions:Array},setup(u){const m=_({name:"",permissions:u.defaultPermissions}),p=_({permissions:[]}),b=_({}),y=C(!1),f=C(null),v=C(null),F=()=>{m.post(route("api-tokens.store"),{preserveScroll:!0,onSuccess:()=>{y.value=!0,m.reset()}})},V=d=>{p.permissions=d.abilities,f.value=d},D=()=>{p.put(route("api-tokens.update",f.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>f.value=null})},B=d=>{v.value=d},N=()=>{b.delete(route("api-tokens.destroy",v.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>v.value=null})};return(d,e)=>(r(),a("div",null,[o(z,{onSubmitted:F},{title:s(()=>e[9]||(e[9]=[n(" Create API Token ")])),description:s(()=>e[10]||(e[10]=[n(" API tokens allow third-party services to authenticate with our application on your behalf. ")])),form:s(()=>[i("div",G,[o(S,{for:"name",value:"Name"}),o(E,{id:"name",modelValue:l(m).name,"onUpdate:modelValue":e[0]||(e[0]=t=>l(m).name=t),type:"text",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"]),o(Y,{message:l(m).errors.name,class:"mt-2"},null,8,["message"])]),u.availablePermissions.length>0?(r(),a("div",H,[o(S,{for:"permissions",value:"Permissions"}),i("div",J,[(r(!0),a(x,null,A(u.availablePermissions,t=>(r(),a("div",{key:t},[i("label",K,[o(w,{checked:l(m).permissions,"onUpdate:checked":e[1]||(e[1]=c=>l(m).permissions=c),value:t},null,8,["checked","value"]),i("span",O,g(t),1)])]))),128))])])):k("",!0)]),actions:s(()=>[o(j,{on:l(m).recentlySuccessful,class:"me-3"},{default:s(()=>e[11]||(e[11]=[n(" Created. ")])),_:1},8,["on"]),o(I,{class:$({"opacity-25":l(m).processing}),disabled:l(m).processing},{default:s(()=>e[12]||(e[12]=[n(" Create ")])),_:1},8,["class","disabled"])]),_:1}),u.tokens.length>0?(r(),a("div",Q,[o(q),i("div",R,[o(U,null,{title:s(()=>e[13]||(e[13]=[n(" Manage API Tokens ")])),description:s(()=>e[14]||(e[14]=[n(" You may delete any of your existing tokens if they are no longer needed. ")])),content:s(()=>[i("div",W,[(r(!0),a(x,null,A(u.tokens,t=>(r(),a("div",{key:t.id,class:"flex items-center justify-between"},[i("div",X,g(t.name),1),i("div",Z,[t.last_used_ago?(r(),a("div",h," Last used "+g(t.last_used_ago),1)):k("",!0),u.availablePermissions.length>0?(r(),a("button",{key:1,class:"cursor-pointer ms-6 text-sm text-gray-400 underline",onClick:c=>V(t)}," Permissions ",8,ee)):k("",!0),i("button",{class:"cursor-pointer ms-6 text-sm text-red-500",onClick:c=>B(t)}," Delete ",8,se)])]))),128))])]),_:1})])])):k("",!0),o(T,{show:y.value,onClose:e[3]||(e[3]=t=>y.value=!1)},{title:s(()=>e[15]||(e[15]=[n(" API Token ")])),content:s(()=>[e[16]||(e[16]=i("div",null," Please copy your new API token. For your security, it won't be shown again. ",-1)),d.$page.props.jetstream.flash.token?(r(),a("div",te,g(d.$page.props.jetstream.flash.token),1)):k("",!0)]),footer:s(()=>[o(P,{onClick:e[2]||(e[2]=t=>y.value=!1)},{default:s(()=>e[17]||(e[17]=[n(" Close ")])),_:1})]),_:1},8,["show"]),o(T,{show:f.value!=null,onClose:e[6]||(e[6]=t=>f.value=null)},{title:s(()=>e[18]||(e[18]=[n(" API Token Permissions ")])),content:s(()=>[i("div",oe,[(r(!0),a(x,null,A(u.availablePermissions,t=>(r(),a("div",{key:t},[i("label",ne,[o(w,{checked:l(p).permissions,"onUpdate:checked":e[4]||(e[4]=c=>l(p).permissions=c),value:t},null,8,["checked","value"]),i("span",le,g(t),1)])]))),128))])]),footer:s(()=>[o(P,{onClick:e[5]||(e[5]=t=>f.value=null)},{default:s(()=>e[19]||(e[19]=[n(" Cancel ")])),_:1}),o(I,{class:$(["ms-3",{"opacity-25":l(p).processing}]),disabled:l(p).processing,onClick:D},{default:s(()=>e[20]||(e[20]=[n(" Save ")])),_:1},8,["class","disabled"])]),_:1},8,["show"]),o(L,{show:v.value!=null,onClose:e[8]||(e[8]=t=>v.value=null)},{title:s(()=>e[21]||(e[21]=[n(" Delete API Token ")])),content:s(()=>e[22]||(e[22]=[n(" Are you sure you would like to delete this API token? ")])),footer:s(()=>[o(P,{onClick:e[7]||(e[7]=t=>v.value=null)},{default:s(()=>e[23]||(e[23]=[n(" Cancel ")])),_:1}),o(M,{class:$(["ms-3",{"opacity-25":l(b).processing}]),disabled:l(b).processing,onClick:N},{default:s(()=>e[24]||(e[24]=[n(" Delete ")])),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{$e as default};
