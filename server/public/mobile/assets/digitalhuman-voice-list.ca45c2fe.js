import{k as e,z as l,bb as a,C as s,av as o,o as c,c as t,w as n,a as r,f as u,b as i,r as f,F as d,G as p,H as v,h as g,bd as _,t as x,e as y,b8 as b,a8 as m,ae as h}from"./index-53bd83dd.js";import{a as k,b as w}from"./voice.8de5d0dd.js";import{_ as C}from"./_plugin-vue_export-helper.1b428a4d.js";const j=C(e({__name:"list",setup(e){const C=l(),j=l(!1),z=l(),P=l(!1),S=l([]);let $=a();s((e=>{A(),E(),$.onStop((()=>{console.log("onStop"),z.value="",j.value=!1})),$.onPlay((()=>{j.value=!0})),$.onPause((()=>{console.log("onPause"),z.value="",j.value=!1})),$.onCanplay((e=>{console.log("res",e)})),$.onError((e=>{console.log("err",e),j.value=!1})),e.backStatus&&(P.value=!0)}));const A=()=>{k().then((e=>{C.value=e.data}))},E=()=>{w({}).then((e=>{S.value=e.lists}))},F=(e,l)=>{l?(z.value=e,j.value?$.pause():($.src!=l&&($.src=l),$.play())):b({title:"暂无播放地址",icon:"none"})},G=()=>{p({url:"/digitalhuman/voice/add"})},H=e=>{if(console.log(e),console.log(P.value),P.value){let l=m(),a=l[l.length-2];return a.$vm.voice_id=e.voice_id,a.$vm.name=e.name,h(),!0}};return o((()=>{if($)try{$.pause(),$.destroy()}catch(e){}})),(e,l)=>{const a=v,s=g,o=_("viwe");return c(),t(s,null,{default:n((()=>[r(s,{class:"p-20"},{default:n((()=>[r(s,{class:"bg-grey round-10 p-15 flex flex-y-center grid-gap-10",onClick:G},{default:n((()=>[r(a,{class:"iconfont icon-jingminglaba fs-25",style:{color:"var(--purple)"}}),r(s,{class:"flex flex-column grid-gap-6 flex-1"},{default:n((()=>[r(a,{class:"text-white fs-18 fw-600"},{default:n((()=>[u("一比一复制你的声音")])),_:1}),r(a,{class:"fs-12 text-grey-1"},{default:n((()=>[u("高度还原你的声音，说话风格，口音等")])),_:1})])),_:1}),r(s,{class:"w-20 h-20 flex flex-center round-circle bg-purple"},{default:n((()=>[r(a,{class:"iconfont icon-youjiantou fs-10",style:{color:"var(--white)"}})])),_:1})])),_:1}),r(s,{class:"grid-gap-10 flex flex-column mt-10"},{default:n((()=>[(c(!0),i(d,null,f(S.value,((e,l)=>(c(),t(o,{key:l,class:"bg-grey-3 flex flex-x-space-between p-15 round-8 flex-y-center",onClick:l=>H(e)},{default:n((()=>[r(a,{class:"text-white fs-17 fw-600"},{default:n((()=>[u(x(e.name),1)])),_:2},1024),r(s,{class:"w-30 h-30 round-circle bg-white flex flex-center",onClick:y((l=>F(e.voice_id,e.local_voice_url)),["stop"])},{default:n((()=>[z.value==e.voice_id?(c(),t(a,{key:0,class:"iconfont icon-zanting1 fs-13",style:{color:"var(--purple)"}})):(c(),t(a,{key:1,class:"iconfont icon-bofang fs-13",style:{color:"var(--purple)"}}))])),_:2},1032,["onClick"])])),_:2},1032,["onClick"])))),128))])),_:1})])),_:1}),r(s,{class:"bg-grey round-top-10 p-15"},{default:n((()=>[r(a,{class:"fs-17 fw-bold text-white"},{default:n((()=>[u("公共声音")])),_:1}),r(s,{class:"grid-gap-10 flex flex-column mt-10"},{default:n((()=>[(c(!0),i(d,null,f(C.value,((e,l)=>(c(),t(o,{key:l,class:"bg-grey-3 flex flex-x-space-between p-15 round-8",onClick:l=>H(e)},{default:n((()=>[r(a,{class:"text-white"},{default:n((()=>[u(x(e.name),1)])),_:2},1024),r(s,{class:"w-30 h-30 round-circle bg-white flex flex-center",onClick:y((l=>F(e.voice_id,e.local_vioce_url)),["stop"])},{default:n((()=>[z.value==e.voice_id?(c(),t(a,{key:0,class:"iconfont icon-zanting1 fs-13",style:{color:"var(--purple)"}})):(c(),t(a,{key:1,class:"iconfont icon-bofang fs-13",style:{color:"var(--purple)"}}))])),_:2},1032,["onClick"])])),_:2},1032,["onClick"])))),128))])),_:1})])),_:1})])),_:1})}}}),[["__scopeId","data-v-e4c38943"]]);export{j as default};
