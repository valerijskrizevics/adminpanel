import{C as f,c as _,o as i,w,a as o,b,h,j as l,d as n,e as d,n as a,u as s,p as m,t as u,P as v,f as V}from"./app-Co-jS4sb.js";import{_ as N}from"./Breadcrumbs-C7f5Vi5c.js";import{_ as g}from"./AppLayout-CSmcBuId.js";import"./ResponsiveNavLink-CLaTC42C.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const k={class:"bg-white min-h-screen"},y={class:"max-w-3xl mx-auto p-6 bg-white"},B={class:"mb-4"},C={key:0,class:"text-red-500 text-sm mt-1"},P={class:"mb-4"},S={key:0,class:"text-red-500 text-sm mt-1"},T={class:"mb-4"},D={key:0,class:"text-red-500 text-sm mt-1"},U={class:"flex justify-between mt-4"},q={__name:"Create",props:{canViewBlog:Boolean,canViewNews:Boolean},setup(p){const t=f({title:"",short_description:"",text:""});function x(){t.post(route("news.store"),{onSuccess:()=>{t.reset()}})}return(c,e)=>(i(),_(g,{title:"New News Post",canViewBlog:p.canViewBlog,canViewNews:p.canViewNews},{default:w(()=>[o("div",k,[o("div",y,[b(N,{items:[{label:"News",link:c.route("news.index")},{label:"New Post",link:"#"}]},null,8,["items"]),e[8]||(e[8]=o("h1",{class:"text-2xl font-semibold mb-4 sm-ml-6"},"New News Post",-1)),o("form",{onSubmit:h(x,["prevent"]),class:"sm-ml-6"},[o("div",B,[e[3]||(e[3]=o("label",{for:"title",class:"block font-medium"},"Title",-1)),l(o("input",{"onUpdate:modelValue":e[0]||(e[0]=r=>s(t).title=r),id:"title",type:"text",class:a(["w-full border p-2 rounded",{"border-red-500":s(t).errors.title}])},null,2),[[m,s(t).title]]),s(t).errors.title?(i(),n("div",C,u(s(t).errors.title),1)):d("",!0)]),o("div",P,[e[4]||(e[4]=o("label",{for:"short_description",class:"block font-medium"},"Short Description",-1)),l(o("input",{"onUpdate:modelValue":e[1]||(e[1]=r=>s(t).short_description=r),id:"short_description",type:"text",class:a(["w-full border p-2 rounded",{"border-red-500":s(t).errors.short_description}])},null,2),[[m,s(t).short_description]]),s(t).errors.short_description?(i(),n("div",S,u(s(t).errors.short_description),1)):d("",!0)]),o("div",T,[e[5]||(e[5]=o("label",{for:"text",class:"block font-medium"},"Text",-1)),l(o("textarea",{"onUpdate:modelValue":e[2]||(e[2]=r=>s(t).text=r),id:"text",class:a(["w-full border p-2 rounded",{"border-red-500":s(t).errors.text}])},null,2),[[m,s(t).text]]),s(t).errors.text?(i(),n("div",D,u(s(t).errors.text),1)):d("",!0)]),o("div",U,[b(s(v),{href:c.route("news.index"),class:"px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"},{default:w(()=>e[6]||(e[6]=[V(" Back ")])),_:1},8,["href"]),e[7]||(e[7]=o("button",{type:"submit",class:"px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"},"Save",-1))])],32)])])]),_:1},8,["canViewBlog","canViewNews"]))}};export{q as default};
