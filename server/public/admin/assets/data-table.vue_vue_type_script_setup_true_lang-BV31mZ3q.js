import{d as B,s as P,j as T,i as D,V as R,o as b,a as g,m as e,w as o,U,e as a,n as h,p as v,B as F,b as I,D as N,I as S,E as j,v as z,K as L}from"./index-Db5CBa4F.js";import{E as $,a as M}from"./el-table-column-CwsjKE_0.js";import"./el-checkbox-BvO8hgnA.js";import"./el-tag-CxPsTVqn.js";import{E as q,a as A}from"./el-form-item-DdPN1Y-B.js";import{f as G,h as H}from"./code-MpVWC4Cm.js";import{_ as J}from"./index.vue_vue_type_script_setup_true_lang-BH1fcTP5.js";import{P as O}from"./index-Cynsnu2B.js";import{u as Q}from"./usePaging-PxVE1wmU.js";const W={class:"data-table"},X={class:"m-4"},Y={class:"flex justify-end mt-4"},re=B({__name:"data-table",emits:["success"],setup(Z,{emit:w}){const C=w,d=P(),n=T({name:"",comment:""}),{pager:s,getLists:f,resetParams:V,resetPage:p}=Q({fetchFun:H,params:n,size:10}),u=D([]),y=l=>{u.value=l.map(({name:t,comment:i})=>({name:t,comment:i}))},E=async()=>{var l;if(!u.value.length)return S.msgError("请选择数据表");await G({table:u.value}),(l=d.value)==null||l.close(),C("success")};return R(()=>{var l;return(l=d.value)==null?void 0:l.visible},l=>{l&&f()}),(l,t)=>{const i=j,c=q,_=z,k=A,r=$,x=M,K=L;return b(),g("div",W,[e(O,{ref_key:"popupRef",ref:d,clickModalClose:!1,title:"选择表",width:"900px",async:!0,onConfirm:E},{trigger:o(()=>[U(l.$slots,"default")]),default:o(()=>[e(k,{class:"ls-form",model:a(n),inline:""},{default:o(()=>[e(c,{class:"w-[280px]",label:"表名称"},{default:o(()=>[e(i,{modelValue:a(n).name,"onUpdate:modelValue":t[0]||(t[0]=m=>a(n).name=m),clearable:"",onKeyup:h(a(p),["enter"])},null,8,["modelValue","onKeyup"])]),_:1}),e(c,{class:"w-[280px]",label:"表描述"},{default:o(()=>[e(i,{modelValue:a(n).comment,"onUpdate:modelValue":t[1]||(t[1]=m=>a(n).comment=m),clearable:"",onKeyup:h(a(p),["enter"])},null,8,["modelValue","onKeyup"])]),_:1}),e(c,null,{default:o(()=>[e(_,{type:"primary",onClick:a(p)},{default:o(()=>t[3]||(t[3]=[v("查询")])),_:1},8,["onClick"]),e(_,{onClick:a(V)},{default:o(()=>t[4]||(t[4]=[v("重置")])),_:1},8,["onClick"])]),_:1})]),_:1},8,["model"]),F((b(),g("div",X,[e(x,{height:"400",size:"large",data:a(s).lists,onSelectionChange:y},{default:o(()=>[e(r,{type:"selection",width:"55"}),e(r,{label:"表名称",prop:"name","min-width":"150"}),e(r,{label:"表描述",prop:"comment","min-width":"160"}),e(r,{label:"创建时间",prop:"create_time","min-width":"180"})]),_:1},8,["data"])])),[[K,a(s).loading]]),I("div",Y,[e(J,{modelValue:a(s),"onUpdate:modelValue":t[2]||(t[2]=m=>N(s)?s.value=m:null),onChange:a(f)},null,8,["modelValue","onChange"])])]),_:3},512)])}}});export{re as _};
