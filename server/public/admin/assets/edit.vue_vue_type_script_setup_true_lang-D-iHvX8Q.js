import{at as we,au as ie,el as Te,ca as Ue,a4 as ke,a5 as W,a6 as le,eY as ae,b6 as me,ah as Ae,d as se,eZ as Ne,dO as $e,ab as Ce,an as Se,i as _,aJ as Oe,c as L,bI as Be,eE as Ie,aG as Fe,k as De,o as y,C as U,w as s,b as r,Y as G,e as l,as as de,m as o,bJ as Pe,a as H,U as O,S as Re,bU as Le,F as Me,r as qe,p as k,t as xe,E as ce,bm as Ke,n as R,ao as pe,b8 as Ge,bF as We,ar as He,af as te,aF as ze,ay as je,s as fe,e_ as Je,j as Ye,e$ as b,G as A,f0 as Ze,f1 as Qe,L as Xe}from"./index-Db5CBa4F.js";import{E as el,a as ll}from"./el-form-item-DdPN1Y-B.js";import{_ as tl}from"./picker.vue_vue_type_script_setup_true_lang-r8sDB4KH.js";import"./el-tag-CxPsTVqn.js";import"./el-select-BcOBwzuk.js";import"./el-tree-B0y5MMU4.js";import"./el-checkbox-BvO8hgnA.js";import{E as al}from"./el-tree-select-Dg7HPCkD.js";/* empty css                       */import{E as sl,a as ol}from"./el-radio-DYnCiASz.js";import{a as nl,b as ul,c as rl,d as il}from"./menu-4QDrs0-F.js";import{P as dl}from"./index-Cynsnu2B.js";const pl=we({valueKey:{type:String,default:"value"},modelValue:{type:[String,Number],default:""},debounce:{type:Number,default:300},placement:{type:ie(String),values:["top","top-start","top-end","bottom","bottom-start","bottom-end"],default:"bottom-start"},fetchSuggestions:{type:ie([Function,Array]),default:Te},popperClass:{type:String,default:""},triggerOnFocus:{type:Boolean,default:!0},selectWhenUnmatched:{type:Boolean,default:!1},hideLoading:{type:Boolean,default:!1},teleported:Ue.teleported,highlightFirstItem:{type:Boolean,default:!1},fitInputWidth:{type:Boolean,default:!1},clearable:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},name:String,...ke(["ariaLabel"])}),fl={[W]:g=>le(g),[ae]:g=>le(g),[me]:g=>le(g),focus:g=>g instanceof FocusEvent,blur:g=>g instanceof FocusEvent,clear:()=>!0,select:g=>Ae(g)},ve="ElAutocomplete",ml=se({name:ve,inheritAttrs:!1}),cl=se({...ml,props:pl,emits:fl,setup(g,{expose:z,emit:V}){const p=g,M=Ne(),B=$e(),$=Ce(),h=Se("autocomplete"),f=_(),q=_(),a=_(),x=_();let I=!1,F=!1;const E=_([]),i=_(-1),D=_(""),T=_(!1),C=_(!1),u=_(!1),e=Oe(),v=L(()=>B.style),m=L(()=>(E.value.length>0||u.value)&&T.value),c=L(()=>!p.hideLoading&&u.value),j=L(()=>f.value?Array.from(f.value.$el.querySelectorAll("input")):[]),N=()=>{m.value&&(D.value=`${f.value.$el.offsetWidth}px`)},J=()=>{i.value=-1},K=Be(async t=>{if(C.value)return;const d=w=>{u.value=!1,!C.value&&(te(w)?(E.value=w,i.value=p.highlightFirstItem?0:-1):ze(ve,"autocomplete suggestions must be an array"))};if(u.value=!0,te(p.fetchSuggestions))d(p.fetchSuggestions);else{const w=await p.fetchSuggestions(t,d);te(w)&&d(w)}},p.debounce),Y=t=>{const d=!!t;if(V(ae,t),V(W,t),C.value=!1,T.value||(T.value=d),!p.triggerOnFocus&&!t){C.value=!0,E.value=[];return}K(t)},n=t=>{var d;$.value||(((d=t.target)==null?void 0:d.tagName)!=="INPUT"||j.value.includes(document.activeElement))&&(T.value=!0)},ge=t=>{V(me,t)},be=t=>{F?F=!1:(T.value=!0,V("focus",t),p.triggerOnFocus&&!I&&K(String(p.modelValue)))},ye=t=>{setTimeout(()=>{var d;if((d=a.value)!=null&&d.isFocusInsideContent()){F=!0;return}T.value&&P(),V("blur",t)})},Ve=()=>{T.value=!1,V(W,""),V("clear")},ne=async()=>{m.value&&i.value>=0&&i.value<E.value.length?Z(E.value[i.value]):p.selectWhenUnmatched&&(V("select",{value:p.modelValue}),E.value=[],i.value=-1)},Ee=t=>{m.value&&(t.preventDefault(),t.stopPropagation(),P())},P=()=>{T.value=!1},_e=()=>{var t;(t=f.value)==null||t.focus()},he=()=>{var t;(t=f.value)==null||t.blur()},Z=async t=>{V(ae,t[p.valueKey]),V(W,t[p.valueKey]),V("select",t),E.value=[],i.value=-1},Q=t=>{if(!m.value||u.value)return;if(t<0){i.value=-1;return}t>=E.value.length&&(t=E.value.length-1);const d=q.value.querySelector(`.${h.be("suggestion","wrap")}`),S=d.querySelectorAll(`.${h.be("suggestion","list")} li`)[t],X=d.scrollTop,{offsetTop:re,scrollHeight:ee}=S;re+ee>X+d.clientHeight&&(d.scrollTop+=ee),re<X&&(d.scrollTop-=ee),i.value=t,f.value.ref.setAttribute("aria-activedescendant",`${e.value}-item-${i.value}`)},ue=Ie(x,()=>{m.value&&P()});return Fe(()=>{ue==null||ue()}),De(()=>{f.value.ref.setAttribute("role","textbox"),f.value.ref.setAttribute("aria-autocomplete","list"),f.value.ref.setAttribute("aria-controls","id"),f.value.ref.setAttribute("aria-activedescendant",`${e.value}-item-${i.value}`),I=f.value.ref.hasAttribute("readonly")}),z({highlightedIndex:i,activated:T,loading:u,inputRef:f,popperRef:a,suggestions:E,handleSelect:Z,handleKeyEnter:ne,focus:_e,blur:he,close:P,highlight:Q}),(t,d)=>(y(),U(l(We),{ref_key:"popperRef",ref:a,visible:l(m),placement:t.placement,"fallback-placements":["bottom-start","top-start"],"popper-class":[l(h).e("popper"),t.popperClass],teleported:t.teleported,"gpu-acceleration":!1,pure:"","manual-mode":"",effect:"light",trigger:"click",transition:`${l(h).namespace.value}-zoom-in-top`,persistent:"",role:"listbox",onBeforeShow:N,onHide:J},{content:s(()=>[r("div",{ref_key:"regionRef",ref:q,class:G([l(h).b("suggestion"),l(h).is("loading",l(c))]),style:de({[t.fitInputWidth?"width":"minWidth"]:D.value,outline:"none"}),role:"region"},[o(l(Pe),{id:l(e),tag:"ul","wrap-class":l(h).be("suggestion","wrap"),"view-class":l(h).be("suggestion","list"),role:"listbox"},{default:s(()=>[l(c)?(y(),H("li",{key:0},[O(t.$slots,"loading",{},()=>[o(l(Re),{class:G(l(h).is("loading"))},{default:s(()=>[o(l(Le))]),_:1},8,["class"])])])):(y(!0),H(Me,{key:1},qe(E.value,(w,S)=>(y(),H("li",{id:`${l(e)}-item-${S}`,key:S,class:G({highlighted:i.value===S}),role:"option","aria-selected":i.value===S,onClick:X=>Z(w)},[O(t.$slots,"default",{item:w},()=>[k(xe(w[t.valueKey]),1)])],10,["id","aria-selected","onClick"]))),128))]),_:3},8,["id","wrap-class","view-class"])],6)]),default:s(()=>[r("div",{ref_key:"listboxRef",ref:x,class:G([l(h).b(),t.$attrs.class]),style:de(l(v)),role:"combobox","aria-haspopup":"listbox","aria-expanded":l(m),"aria-owns":l(e)},[o(l(ce),Ke({ref_key:"inputRef",ref:f},l(M),{clearable:t.clearable,disabled:l($),name:t.name,"model-value":t.modelValue,"aria-label":t.ariaLabel,onInput:Y,onChange:ge,onFocus:be,onBlur:ye,onClear:Ve,onKeydown:[R(pe(w=>Q(i.value-1),["prevent"]),["up"]),R(pe(w=>Q(i.value+1),["prevent"]),["down"]),R(ne,["enter"]),R(P,["tab"]),R(Ee,["esc"])],onMousedown:n}),Ge({_:2},[t.$slots.prepend?{name:"prepend",fn:s(()=>[O(t.$slots,"prepend")])}:void 0,t.$slots.append?{name:"append",fn:s(()=>[O(t.$slots,"append")])}:void 0,t.$slots.prefix?{name:"prefix",fn:s(()=>[O(t.$slots,"prefix")])}:void 0,t.$slots.suffix?{name:"suffix",fn:s(()=>[O(t.$slots,"suffix")])}:void 0]),1040,["clearable","disabled","name","model-value","aria-label","onKeydown"])],14,["aria-expanded","aria-owns"])]),_:3},8,["visible","placement","popper-class","teleported","transition"]))}});var vl=He(cl,[["__file","autocomplete.vue"]]);const gl=je(vl),bl={class:"edit-popup"},yl={class:"flex-1"},Vl={class:"flex-1"},El={class:"flex-1"},_l={class:"flex-1"},hl={class:"flex-1"},Fl=se({__name:"edit",emits:["success","close"],setup(g,{expose:z,emit:V}){const p=V,M=fe(),B=fe(),$=_("add"),h=L(()=>$.value=="edit"?"编辑菜单":"新增菜单"),f=_(Je()),q=(u,e)=>{const v=u?f.value.filter(m=>m.toLowerCase().includes(u.toLowerCase())):f.value;e(v.map(m=>({value:m})))},a=Ye({id:"",pid:0,type:b.CATALOGUE,icon:"",name:"",sort:0,paths:"",perms:"",component:"",selected:"",params:"",is_cache:1,is_show:1,is_disable:0}),x={pid:[{required:!0,message:"请选择父级菜单",trigger:["blur","change"]}],name:[{required:!0,message:"请输入菜单名称",trigger:"blur"}],paths:[{required:!0,message:"请输入路由地址",trigger:"blur"}],component:[{required:!0,message:"请输入组件地址",trigger:"blur"}]},I=_([]),F=async()=>{const u=await nl({page_type:0}),e={id:0,name:"顶级",children:[]};e.children=Ze(Qe(u.lists).filter(v=>v.type!=b.BUTTON)),I.value.push(e)},E=async()=>{var u,e;await((u=M.value)==null?void 0:u.validate()),$.value=="edit"?await ul(a):await rl(a),(e=B.value)==null||e.close(),p("success")},i=(u="add")=>{var e;$.value=u,(e=B.value)==null||e.open()},D=u=>{for(const e in a)u[e]!=null&&u[e]!=null&&(a[e]=u[e])},T=async u=>{const e=await il({id:u.id});D(e)},C=()=>{p("close")};return F(),z({open:i,setFormData:D,getDetail:T}),(u,e)=>{const v=sl,m=ol,c=el,j=al,N=ce,J=tl,oe=gl,K=Xe,Y=ll;return y(),H("div",bl,[o(dl,{ref_key:"popupRef",ref:B,title:l(h),async:!0,width:"550px",onConfirm:E,onClose:C},{default:s(()=>[o(Y,{ref_key:"formRef",ref:M,model:l(a),"label-width":"80px",rules:x},{default:s(()=>[o(c,{label:"菜单类型",prop:"type",required:""},{default:s(()=>[o(m,{modelValue:l(a).type,"onUpdate:modelValue":e[0]||(e[0]=n=>l(a).type=n)},{default:s(()=>[o(v,{value:l(b).CATALOGUE},{default:s(()=>e[13]||(e[13]=[k("目录")])),_:1},8,["value"]),o(v,{value:l(b).MENU},{default:s(()=>e[14]||(e[14]=[k("菜单")])),_:1},8,["value"]),o(v,{value:l(b).BUTTON},{default:s(()=>e[15]||(e[15]=[k("按钮")])),_:1},8,["value"])]),_:1},8,["modelValue"])]),_:1}),o(c,{label:"父级菜单",prop:"pid"},{default:s(()=>[o(j,{class:"flex-1",modelValue:l(a).pid,"onUpdate:modelValue":e[1]||(e[1]=n=>l(a).pid=n),data:l(I),clearable:"","node-key":"id",props:{label:"name"},"default-expand-all":!0,placeholder:"请选择父级菜单","check-strictly":""},null,8,["modelValue","data"])]),_:1}),o(c,{label:"菜单名称",prop:"name"},{default:s(()=>[o(N,{modelValue:l(a).name,"onUpdate:modelValue":e[2]||(e[2]=n=>l(a).name=n),placeholder:"请输入菜单名称",clearable:""},null,8,["modelValue"])]),_:1}),l(a).type!=l(b).BUTTON?(y(),U(c,{key:0,label:"菜单图标",prop:"icon"},{default:s(()=>[o(J,{class:"flex-1",modelValue:l(a).icon,"onUpdate:modelValue":e[3]||(e[3]=n=>l(a).icon=n)},null,8,["modelValue"])]),_:1})):A("",!0),l(a).type!=l(b).BUTTON?(y(),U(c,{key:1,label:"路由路径",prop:"paths"},{default:s(()=>[r("div",yl,[o(N,{modelValue:l(a).paths,"onUpdate:modelValue":e[4]||(e[4]=n=>l(a).paths=n),placeholder:"请输入路由路径",clearable:""},null,8,["modelValue"]),e[16]||(e[16]=r("div",{class:"form-tips"}," 访问的路由地址，如：`user`，如外网地址需内链访问则以`http(s)://`开头 ",-1))])]),_:1})):A("",!0),l(a).type==l(b).MENU?(y(),U(c,{key:2,label:"组件路径",prop:"component"},{default:s(()=>[r("div",Vl,[o(oe,{class:"w-full",modelValue:l(a).component,"onUpdate:modelValue":e[5]||(e[5]=n=>l(a).component=n),"fetch-suggestions":q,clearable:"",placeholder:"请输入组件路径"},null,8,["modelValue"]),e[17]||(e[17]=r("div",{class:"form-tips"}," 访问的组件路径，如：`user/setting`，默认在`views`目录下 ",-1))])]),_:1})):A("",!0),l(a).type==l(b).MENU?(y(),U(c,{key:3,label:"选中菜单",prop:"selected"},{default:s(()=>[r("div",El,[o(N,{modelValue:l(a).selected,"onUpdate:modelValue":e[6]||(e[6]=n=>l(a).selected=n),placeholder:"请输入路由路径",clearable:""},null,8,["modelValue"]),e[18]||(e[18]=r("div",{class:"form-tips"}," 访问详情页面，编辑页面时，菜单高亮显示，如`/consumer/lists` ",-1))])]),_:1})):A("",!0),l(a).type!=l(b).CATALOGUE?(y(),U(c,{key:4,label:"权限字符",prop:"perms"},{default:s(()=>[r("div",_l,[o(N,{modelValue:l(a).perms,"onUpdate:modelValue":e[7]||(e[7]=n=>l(a).perms=n),placeholder:"请输入权限字符",clearable:""},null,8,["modelValue"]),e[19]||(e[19]=r("div",{class:"form-tips"}," 将作为server端API验权使用，如`auth.admin/user`，请谨慎修改 ",-1))])]),_:1})):A("",!0),l(a).type==l(b).MENU?(y(),U(c,{key:5,label:"路由参数",prop:"params"},{default:s(()=>[r("div",null,[r("div",hl,[o(N,{modelValue:l(a).params,"onUpdate:modelValue":e[8]||(e[8]=n=>l(a).params=n),placeholder:"请输入路由参数",clearable:""},null,8,["modelValue"])]),e[20]||(e[20]=r("div",{class:"form-tips"},' 访问路由的默认传递参数，如：`{"id": 1, "name": "admin"}`或`id=1&name=admin` ',-1))])]),_:1})):A("",!0),l(a).type==l(b).MENU?(y(),U(c,{key:6,label:"是否缓存",prop:"is_cache",required:""},{default:s(()=>[r("div",null,[o(m,{modelValue:l(a).is_cache,"onUpdate:modelValue":e[9]||(e[9]=n=>l(a).is_cache=n)},{default:s(()=>[o(v,{value:1},{default:s(()=>e[21]||(e[21]=[k("缓存")])),_:1}),o(v,{value:0},{default:s(()=>e[22]||(e[22]=[k("不缓存")])),_:1})]),_:1},8,["modelValue"]),e[23]||(e[23]=r("div",{class:"form-tips"},"选择缓存则会被`keep-alive`缓存",-1))])]),_:1})):A("",!0),l(a).type!=l(b).BUTTON?(y(),U(c,{key:7,label:"是否显示",prop:"is_show",required:""},{default:s(()=>[r("div",null,[o(m,{modelValue:l(a).is_show,"onUpdate:modelValue":e[10]||(e[10]=n=>l(a).is_show=n)},{default:s(()=>[o(v,{value:1},{default:s(()=>e[24]||(e[24]=[k("显示")])),_:1}),o(v,{value:0},{default:s(()=>e[25]||(e[25]=[k("隐藏")])),_:1})]),_:1},8,["modelValue"]),e[26]||(e[26]=r("div",{class:"form-tips"}," 选择隐藏则路由将不会出现在侧边栏，但仍然可以访问 ",-1))])]),_:1})):A("",!0),l(a).type!=l(b).BUTTON?(y(),U(c,{key:8,label:"菜单状态",prop:"is_disable",required:""},{default:s(()=>[r("div",null,[o(m,{modelValue:l(a).is_disable,"onUpdate:modelValue":e[11]||(e[11]=n=>l(a).is_disable=n)},{default:s(()=>[o(v,{value:0},{default:s(()=>e[27]||(e[27]=[k("正常")])),_:1}),o(v,{value:1},{default:s(()=>e[28]||(e[28]=[k("停用")])),_:1})]),_:1},8,["modelValue"]),e[29]||(e[29]=r("div",{class:"form-tips"},"选择停用则路由将不会出现在侧边栏，也不能被访问",-1))])]),_:1})):A("",!0),o(c,{label:"菜单排序",prop:"sort"},{default:s(()=>[r("div",null,[o(K,{modelValue:l(a).sort,"onUpdate:modelValue":e[12]||(e[12]=n=>l(a).sort=n),min:0,max:9999},null,8,["modelValue"]),e[30]||(e[30]=r("div",{class:"form-tips"},"数值越大越排前",-1))])]),_:1})]),_:1},8,["model"])]),_:1},8,["title"])])}}});export{Fl as _};
