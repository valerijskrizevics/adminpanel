import{C as m,r as d,d as u,o as p,b as a,u as e,m as f,w as t,a as r,h as c,n as _,f as w,F as b}from"./app-BmkWWvPF.js";import{A as g}from"./AuthenticationCard-DQWi0MJd.js";import{_ as x}from"./AuthenticationCardLogo-DRlDMtG7.js";import{_ as v,a as y}from"./TextInput-CPA8Afyn.js";import{_ as C}from"./InputLabel-BksNtQ8X.js";import{_ as V}from"./PrimaryButton-DLwGlFx1.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const $={class:"flex justify-end mt-4"},T={__name:"ConfirmPassword",setup(k){const s=m({password:""}),i=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),i.value.focus()}})};return(h,o)=>(p(),u(b,null,[a(e(f),{title:"Secure Area"}),a(g,null,{logo:t(()=>[a(x)]),default:t(()=>[o[2]||(o[2]=r("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1)),r("form",{onSubmit:c(n,["prevent"])},[r("div",null,[a(C,{for:"password",value:"Password"}),a(v,{id:"password",ref_key:"passwordInput",ref:i,modelValue:e(s).password,"onUpdate:modelValue":o[0]||(o[0]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(y,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),r("div",$,[a(V,{class:_(["ms-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:t(()=>o[1]||(o[1]=[w(" Confirm ")])),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{T as default};
