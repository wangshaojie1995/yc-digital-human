import{d as I,s as g,i as x,j as G,k as H,H as V,z as M,o as p,a as O,m as t,w as a,e as s,n as J,p as i,b as Q,B as v,C as f,t as W,G as N,I as X,E as Y,v as Z,q as ee,K as te}from"./index-Db5CBa4F.js";import{E as ae,a as le}from"./el-table-column-CwsjKE_0.js";import"./el-checkbox-BvO8hgnA.js";import"./el-tag-CxPsTVqn.js";import{E as oe}from"./el-card-CdrfA3tk.js";import{E as ne,a as se}from"./el-form-item-DdPN1Y-B.js";import{E as ie,a as re}from"./el-select-BcOBwzuk.js";import{e as de,f as pe}from"./department-C1S_Sa6u.js";import{_ as me}from"./edit.vue_vue_type_script_setup_true_lang-uemJ13Gq.js";import{E as ue}from"./index-CjI4u-fQ.js";import"./_Uint8Array-QK_0xYq9.js";import"./isEqual-B2ISp8N_.js";import"./_initCloneObject-uEbz8wZF.js";import"./_baseClone-DqE177pC.js";import"./token-DI9FKtlJ.js";import"./el-tree-B0y5MMU4.js";import"./el-tree-select-Dg7HPCkD.js";import"./index-Cynsnu2B.js";import"./index--VjTFVLi.js";import"./useDictOptions-C-8xz0wX.js";const fe={class:"department"},ce=I({name:"department"}),Le=I({...ce,setup(_e){const R=g(),c=g(),D=g();let b=!1;const E=x(!1),w=x([]),m=G({status:"",name:""}),y=x(!1),u=async()=>{E.value=!0,w.value=await de(m),E.value=!1},K=()=>{var l;(l=D.value)==null||l.resetFields(),u()},$=async l=>{var e,n;y.value=!0,await V(),l&&((e=c.value)==null||e.setFormData({pid:l})),(n=c.value)==null||n.open("add")},L=async l=>{var e,n;y.value=!0,await V(),(e=c.value)==null||e.open("edit"),(n=c.value)==null||n.getDetail(l)},P=async l=>{await X.confirm("确定要删除？"),await pe({id:l}),u()},B=()=>{b=!b,T(w.value,b)},T=(l,e=!0)=>{var n;for(const r in l)(n=R.value)==null||n.toggleRowExpansion(l[r],e),l[r].children&&T(l[r].children,e)};return H(async()=>{await u(),V(()=>{B()})}),(l,e)=>{const n=Y,r=ne,C=ie,S=re,d=Z,q=se,h=oe,z=ee,_=ae,U=ue,j=le,k=M("perms"),A=te;return p(),O("div",fe,[t(h,{class:"!border-none",shadow:"never"},{default:a(()=>[t(q,{ref_key:"formRef",ref:D,class:"mb-[-16px]",model:s(m),inline:!0},{default:a(()=>[t(r,{class:"w-[280px]",label:"部门名称",prop:"name"},{default:a(()=>[t(n,{modelValue:s(m).name,"onUpdate:modelValue":e[0]||(e[0]=o=>s(m).name=o),placeholder:"输入部门名称",clearable:"",onKeyup:J(u,["enter"])},null,8,["modelValue"])]),_:1}),t(r,{class:"w-[280px]",label:"部门状态",prop:"status"},{default:a(()=>[t(S,{modelValue:s(m).status,"onUpdate:modelValue":e[1]||(e[1]=o=>s(m).status=o)},{default:a(()=>[t(C,{label:"全部",value:""}),t(C,{label:"正常",value:"1"}),t(C,{label:"停用",value:"0"})]),_:1},8,["modelValue"])]),_:1}),t(r,null,{default:a(()=>[t(d,{type:"primary",onClick:u},{default:a(()=>e[4]||(e[4]=[i("查询")])),_:1}),t(d,{onClick:K},{default:a(()=>e[5]||(e[5]=[i("重置")])),_:1})]),_:1})]),_:1},8,["model"])]),_:1}),t(h,{class:"!border-none mt-4",shadow:"never"},{default:a(()=>[Q("div",null,[v((p(),f(d,{type:"primary",onClick:e[2]||(e[2]=o=>$())},{icon:a(()=>[t(z,{name:"el-icon-Plus"})]),default:a(()=>[e[6]||(e[6]=i(" 新增 "))]),_:1})),[[k,["dept.dept/add"]]]),t(d,{onClick:B},{default:a(()=>e[7]||(e[7]=[i(" 展开/折叠 ")])),_:1})]),v((p(),f(j,{ref_key:"tableRef",ref:R,class:"mt-4",size:"large",data:s(w),"row-key":"id","tree-props":{children:"children",hasChildren:"hasChildren"}},{default:a(()=>[t(_,{label:"部门名称",prop:"name","min-width":"150","show-overflow-tooltip":""}),t(_,{label:"部门状态",prop:"status","min-width":"100"},{default:a(({row:o})=>[t(U,{class:"ml-2",type:o.status?"primary":"danger"},{default:a(()=>[i(W(o.status_desc),1)]),_:2},1032,["type"])]),_:1}),t(_,{label:"排序",prop:"sort","min-width":"100"}),t(_,{label:"更新时间",prop:"update_time","min-width":"180"}),t(_,{label:"操作",width:"160",fixed:"right"},{default:a(({row:o})=>[v((p(),f(d,{type:"primary",link:"",onClick:F=>$(o.id)},{default:a(()=>e[8]||(e[8]=[i(" 新增 ")])),_:2},1032,["onClick"])),[[k,["dept.dept/add"]]]),v((p(),f(d,{type:"primary",link:"",onClick:F=>L(o)},{default:a(()=>e[9]||(e[9]=[i(" 编辑 ")])),_:2},1032,["onClick"])),[[k,["dept.dept/edit"]]]),o.pid!==0?v((p(),f(d,{key:0,type:"danger",link:"",onClick:F=>P(o.id)},{default:a(()=>e[10]||(e[10]=[i(" 删除 ")])),_:2},1032,["onClick"])),[[k,["dept.dept/delete"]]]):N("",!0)]),_:1})]),_:1},8,["data"])),[[A,s(E)]])]),_:1}),s(y)?(p(),f(me,{key:0,ref_key:"editRef",ref:c,onSuccess:u,onClose:e[3]||(e[3]=o=>y.value=!1)},null,512)):N("",!0)])}}});export{Le as default};
