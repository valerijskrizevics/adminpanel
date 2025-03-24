import{c,o as r,w as i,a as t,b as n,t as s,f as l,u as d,P as m}from"./app-Co-jS4sb.js";import{_ as g}from"./Breadcrumbs-C7f5Vi5c.js";import{_ as w}from"./AppLayout-CSmcBuId.js";import"./ResponsiveNavLink-CLaTC42C.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const h={class:"bg-white min-h-screen"},u={class:"container mx-auto p-6 max-w-2xl"},f={class:"bg-white p-6"},x=["src"],_={class:"text-3xl font-bold mt-4"},p={class:"text-sm text-gray-500 mt-2"},b={class:"mt-4 text-gray-700 italic"},V=["innerHTML"],B={class:"flex justify-start mt-4 sm-ml-6"},P={__name:"Show",props:{post:Object,canViewBlog:Boolean,canViewNews:Boolean},setup(e){return(o,a)=>(r(),c(w,{title:"View Blog Post",canViewBlog:e.canViewBlog,canViewNews:e.canViewNews},{default:i(()=>[t("div",h,[t("div",u,[t("div",f,[n(g,{items:[{label:"Blog",link:o.route("blog.index")},{label:"View Post",link:"#"}]},null,8,["items"]),t("img",{src:"/photos/"+e.post.id%10+".jpg",class:"rounded-md w-full h-60 object-cover"},null,8,x),t("h1",_,s(e.post.title),1),t("p",p,[t("strong",null,s(e.post.user.name),1),l(" • "+s(new Date(e.post.created_at).toLocaleDateString("ru-RU")),1)]),t("p",b,s(e.post.short_description),1),t("p",{innerHTML:e.post.text.replace(/\n+/g,"<br>"),class:"mt-4 text-gray-700"},null,8,V),t("div",B,[n(d(m),{href:o.route("blog.index"),class:"px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"},{default:i(()=>a[0]||(a[0]=[l(" Back ")])),_:1},8,["href"])])])])])]),_:1},8,["canViewBlog","canViewNews"]))}};export{P as default};
