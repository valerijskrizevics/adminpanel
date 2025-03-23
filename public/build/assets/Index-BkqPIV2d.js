import{r as g,c as x,o as n,w as l,a as t,b as d,e as f,u as m,P as c,f as o,d as u,F as h,g as v,t as b,h as N,W as k}from"./app-Co-jS4sb.js";import{_ as B}from"./Breadcrumbs-C7f5Vi5c.js";import{_ as V}from"./ConfirmationModal-B6OCGmiE.js";import{_ as C}from"./AppLayout-CSmcBuId.js";import"./Modal-kdGgZKW8.js";import"./ResponsiveNavLink-CLaTC42C.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const M={class:"bg-white min-h-screen"},P={class:"max-w-3xl mx-auto p-6 bg-white"},$={class:"mb-4 sm-ml-6"},A={class:"min-w-full bg-white border border-gray-300 sm-ml-6"},D={key:0,class:"text-left px-4 py-2"},T={class:"text-left align-top px-4 py-2"},U={class:"text-left align-top px-4 py-2 sm-whitespace-nowrap"},E={key:0,class:"text-left align-top px-4 py-2 whitespace-nowrap"},F=["onClick"],q={__name:"Index",props:{posts:Array,canViewBlog:Boolean,canViewNews:Boolean,canManage:Boolean,canManageAny:Boolean,currentUser:Object},setup(a){const r=g(!1),w=g(null),p=i=>{w.value=i,r.value=!0},y=()=>{w.value&&(k.delete(route("news.destroy",w.value.id)),r.value=!1)};return(i,e)=>(n(),x(C,{title:"Manage News Posts",canViewBlog:a.canViewBlog,canViewNews:a.canViewNews},{default:l(()=>[t("div",M,[t("div",P,[d(B,{items:[{label:"News",link:"#"}]}),e[7]||(e[7]=t("h1",{class:"text-2xl font-semibold mb-4 sm-ml-6"},"News Posts",-1)),t("div",$,[a.canManage?(n(),x(m(c),{key:0,href:i.route("news.create"),class:"px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"},{default:l(()=>e[2]||(e[2]=[o(" New ")])),_:1},8,["href"])):f("",!0)]),t("table",A,[t("thead",null,[t("tr",null,[e[3]||(e[3]=t("th",{class:"text-left px-4 py-2"},"Title",-1)),e[4]||(e[4]=t("th",{class:"text-left px-4 py-2"},"User",-1)),a.canManage?(n(),u("th",D,"Actions")):f("",!0)])]),t("tbody",null,[(n(!0),u(h,null,v(a.posts,s=>(n(),u("tr",{key:s.id},[t("td",T,[d(m(c),{href:i.route("news.show",s.id),class:"text-blue-600"},{default:l(()=>[o(b(s.title),1)]),_:2},1032,["href"])]),t("td",U,b(s.user.name),1),a.canManage&&(a.canManageAny||s.user.id===a.currentUser.id)?(n(),u("td",E,[d(m(c),{href:i.route("news.edit",s.id),class:"text-blue-600"},{default:l(()=>e[5]||(e[5]=[o("Edit")])),_:2},1032,["href"]),e[6]||(e[6]=o(" | ")),t("button",{onClick:N(W=>p(s),["prevent"]),class:"text-red-600"},"X",8,F)])):f("",!0)]))),128))])])])]),d(V,{show:r.value,onClose:e[1]||(e[1]=s=>r.value=!1)},{title:l(()=>e[8]||(e[8]=[o(" Delete News Post ")])),content:l(()=>e[9]||(e[9]=[o(" Are you sure you want to delete this post? ")])),footer:l(()=>[t("button",{onClick:e[0]||(e[0]=s=>r.value=!1),class:"px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"},"Cancel"),t("button",{onClick:y,class:"px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 ml-3"},"Delete")]),_:1},8,["show"])]),_:1},8,["canViewBlog","canViewNews"]))}};export{q as default};
