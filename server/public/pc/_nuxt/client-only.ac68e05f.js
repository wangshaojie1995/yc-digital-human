import{cd as K,ce as Y,cf as $e,cg as re,bA as X,ch as Ie,ci as ie,cj as G,ck as ce,an as we,bd as Ee,cl as Fe,cm as Be,cn as Oe,co as De,b7 as ke,cp as Le,aS as Me,A as ue,a7 as Pe,f as L,ad as Re,$ as H,bL as Ne,D as B,cq as _e,o as O,c as N,a as _,W as F,O as S,k as o,t as Ue,b as U,w as E,m as J,a9 as Ge,R as Ke,n as W,X as de,_ as fe,cr as Ve,a8 as Q,bp as ge,aM as qe,au as ze,ap as x,r as j,cs as Je,ct as We,aq as Ye,cu as Ze,F as ee,aw as Xe,G as be,L as He,bR as ae,ao as Qe,C as xe,bj as oe,M as ea,J as aa,N as oa,cv as ta,cw as na,aI as sa,b3 as la,T as ra,U as ia,aC as ca,cx as ua,a2 as da}from"./entry.ad0f3fd4.js";import{k as ye,g as pe,s as fa,a as ga,b as ba,c as Z,d as ya,i as pa}from"./isUndefined.9717dae4.js";function ma(e,a){for(var t=-1,d=e==null?0:e.length;++t<d&&a(e[t],t,e)!==!1;);return e}function va(e,a){return e&&K(a,ye(a),e)}function Ta(e,a){return e&&K(a,Y(a),e)}function Ca(e,a){return K(e,pe(e),a)}var Aa=Object.getOwnPropertySymbols,ha=Aa?function(e){for(var a=[];e;)ga(a,pe(e)),e=$e(e);return a}:fa;const me=ha;function Sa(e,a){return K(e,me(e),a)}function ja(e){return ba(e,Y,me)}var $a=Object.prototype,Ia=$a.hasOwnProperty;function wa(e){var a=e.length,t=new e.constructor(a);return a&&typeof e[0]=="string"&&Ia.call(e,"index")&&(t.index=e.index,t.input=e.input),t}function Ea(e,a){var t=a?re(e.buffer):e.buffer;return new e.constructor(t,e.byteOffset,e.byteLength)}var Fa=/\w*$/;function Ba(e){var a=new e.constructor(e.source,Fa.exec(e));return a.lastIndex=e.lastIndex,a}var te=X?X.prototype:void 0,ne=te?te.valueOf:void 0;function Oa(e){return ne?Object(ne.call(e)):{}}var Da="[object Boolean]",ka="[object Date]",La="[object Map]",Ma="[object Number]",Pa="[object RegExp]",Ra="[object Set]",Na="[object String]",_a="[object Symbol]",Ua="[object ArrayBuffer]",Ga="[object DataView]",Ka="[object Float32Array]",Va="[object Float64Array]",qa="[object Int8Array]",za="[object Int16Array]",Ja="[object Int32Array]",Wa="[object Uint8Array]",Ya="[object Uint8ClampedArray]",Za="[object Uint16Array]",Xa="[object Uint32Array]";function Ha(e,a,t){var d=e.constructor;switch(a){case Ua:return re(e);case Da:case ka:return new d(+e);case Ga:return Ea(e,t);case Ka:case Va:case qa:case za:case Ja:case Wa:case Ya:case Za:case Xa:return Ie(e,t);case La:return new d;case Ma:case Na:return new d(e);case Pa:return Ba(e);case Ra:return new d;case _a:return Oa(e)}}var Qa="[object Map]";function xa(e){return ie(e)&&Z(e)==Qa}var se=G&&G.isMap,eo=se?ce(se):xa;const ao=eo;var oo="[object Set]";function to(e){return ie(e)&&Z(e)==oo}var le=G&&G.isSet,no=le?ce(le):to;const so=no;var lo=1,ro=2,io=4,ve="[object Arguments]",co="[object Array]",uo="[object Boolean]",fo="[object Date]",go="[object Error]",Te="[object Function]",bo="[object GeneratorFunction]",yo="[object Map]",po="[object Number]",Ce="[object Object]",mo="[object RegExp]",vo="[object Set]",To="[object String]",Co="[object Symbol]",Ao="[object WeakMap]",ho="[object ArrayBuffer]",So="[object DataView]",jo="[object Float32Array]",$o="[object Float64Array]",Io="[object Int8Array]",wo="[object Int16Array]",Eo="[object Int32Array]",Fo="[object Uint8Array]",Bo="[object Uint8ClampedArray]",Oo="[object Uint16Array]",Do="[object Uint32Array]",s={};s[ve]=s[co]=s[ho]=s[So]=s[uo]=s[fo]=s[jo]=s[$o]=s[Io]=s[wo]=s[Eo]=s[yo]=s[po]=s[Ce]=s[mo]=s[vo]=s[To]=s[Co]=s[Fo]=s[Bo]=s[Oo]=s[Do]=!0;s[go]=s[Te]=s[Ao]=!1;function z(e,a,t,d,l,u){var r,i=a&lo,f=a&ro,b=a&io;if(t&&(r=l?t(e,d,l,u):t(e)),r!==void 0)return r;if(!we(e))return e;var v=Ee(e);if(v){if(r=wa(e),!i)return Fe(e,r)}else{var g=Z(e),C=g==Te||g==bo;if(Be(e))return Oe(e,i);if(g==Ce||g==ve||C&&!l){if(r=f||C?{}:De(e),!i)return f?Sa(e,Ta(r,e)):Ca(e,va(r,e))}else{if(!s[g])return l?e:{};r=Ha(e,g,i)}}u||(u=new ke);var c=u.get(e);if(c)return c;u.set(e,r),so(e)?e.forEach(function(p){r.add(z(p,a,t,p,e,u))}):ao(e)&&e.forEach(function(p,T){r.set(T,z(p,a,t,T,e,u))});var y=b?f?ja:ya:f?Y:ye,$=v?void 0:y(e);return ma($||e,function(p,T){$&&(T=p,p=e[T]),Le(r,T,z(p,a,t,T,e,u))}),r}const ko=(...e)=>a=>{e.forEach(t=>{Me(t)?t(a):t.value=a})},Ae=Symbol("dialogInjectionKey"),he=ue({center:Boolean,alignCenter:Boolean,closeIcon:{type:Pe},customClass:{type:String,default:""},draggable:Boolean,fullscreen:Boolean,showClose:{type:Boolean,default:!0},title:{type:String,default:""},ariaLevel:{type:String,default:"2"}}),Lo={close:()=>!0},Mo=["aria-level"],Po=["aria-label"],Ro=["id"],No=L({name:"ElDialogContent"}),_o=L({...No,props:he,emits:Lo,setup(e){const a=e,{t}=Re(),{Close:d}=Ve,{dialogRef:l,headerRef:u,bodyId:r,ns:i,style:f}=H(Ae),{focusTrapRef:b}=H(Ne),v=B(()=>[i.b(),i.is("fullscreen",a.fullscreen),i.is("draggable",a.draggable),i.is("align-center",a.alignCenter),{[i.m("center")]:a.center},a.customClass]),g=ko(b,l),C=B(()=>a.draggable);return _e(l,u,C),(c,y)=>(O(),N("div",{ref:o(g),class:S(o(v)),style:de(o(f)),tabindex:"-1"},[_("header",{ref_key:"headerRef",ref:u,class:S(o(i).e("header"))},[F(c.$slots,"header",{},()=>[_("span",{role:"heading","aria-level":c.ariaLevel,class:S(o(i).e("title"))},Ue(c.title),11,Mo)]),c.showClose?(O(),N("button",{key:0,"aria-label":o(t)("el.dialog.close"),class:S(o(i).e("headerbtn")),type:"button",onClick:y[0]||(y[0]=$=>c.$emit("close"))},[U(o(Ke),{class:S(o(i).e("close"))},{default:E(()=>[(O(),J(Ge(c.closeIcon||o(d))))]),_:1},8,["class"])],10,Po)):W("v-if",!0)],2),_("div",{id:o(r),class:S(o(i).e("body"))},[F(c.$slots,"default")],10,Ro),c.$slots.footer?(O(),N("footer",{key:0,class:S(o(i).e("footer"))},[F(c.$slots,"footer")],2)):W("v-if",!0)],6))}});var Uo=fe(_o,[["__file","dialog-content.vue"]]);const Go=ue({...he,appendToBody:Boolean,appendTo:{type:Q(String),default:"body"},beforeClose:{type:Q(Function)},destroyOnClose:Boolean,closeOnClickModal:{type:Boolean,default:!0},closeOnPressEscape:{type:Boolean,default:!0},lockScroll:{type:Boolean,default:!0},modal:{type:Boolean,default:!0},openDelay:{type:Number,default:0},closeDelay:{type:Number,default:0},top:{type:String},modelValue:Boolean,modalClass:String,width:{type:[String,Number]},zIndex:{type:Number},trapFocus:{type:Boolean,default:!1},headerAriaLevel:{type:String,default:"2"}}),Ko={open:()=>!0,opened:()=>!0,close:()=>!0,closed:()=>!0,[ge]:e=>qe(e),openAutoFocus:()=>!0,closeAutoFocus:()=>!0},Vo=(e,a)=>{var t;const l=He().emit,{nextZIndex:u}=ze();let r="";const i=x(),f=x(),b=j(!1),v=j(!1),g=j(!1),C=j((t=e.zIndex)!=null?t:u());let c,y;const $=Je("namespace",We),p=B(()=>{const m={},w=`--${$.value}-dialog`;return e.fullscreen||(e.top&&(m[`${w}-margin-top`]=e.top),e.width&&(m[`${w}-width`]=Ye(e.width))),m}),T=B(()=>e.alignCenter?{display:"flex"}:{});function M(){l("opened")}function V(){l("closed"),l(ge,!1),e.destroyOnClose&&(g.value=!1)}function q(){l("close")}function P(){y==null||y(),c==null||c(),e.openDelay&&e.openDelay>0?{stop:c}=ae(()=>R(),e.openDelay):R()}function D(){c==null||c(),y==null||y(),e.closeDelay&&e.closeDelay>0?{stop:y}=ae(()=>n(),e.closeDelay):n()}function k(){function m(w){w||(v.value=!0,b.value=!1)}e.beforeClose?e.beforeClose(m):D()}function A(){e.closeOnClickModal&&k()}function R(){Qe&&(b.value=!0)}function n(){b.value=!1}function h(){l("openAutoFocus")}function I(){l("closeAutoFocus")}function Se(m){var w;((w=m.detail)==null?void 0:w.focusReason)==="pointer"&&m.preventDefault()}e.lockScroll&&Ze(b);function je(){e.closeOnPressEscape&&k()}return ee(()=>e.modelValue,m=>{m?(v.value=!1,P(),g.value=!0,C.value=pa(e.zIndex)?u():C.value++,Xe(()=>{l("open"),a.value&&(a.value.scrollTop=0)})):b.value&&D()}),ee(()=>e.fullscreen,m=>{a.value&&(m?(r=a.value.style.transform,a.value.style.transform=""):a.value.style.transform=r)}),be(()=>{e.modelValue&&(b.value=!0,g.value=!0,P())}),{afterEnter:M,afterLeave:V,beforeLeave:q,handleClose:k,onModalClick:A,close:D,doClose:n,onOpenAutoFocus:h,onCloseAutoFocus:I,onCloseRequested:je,onFocusoutPrevented:Se,titleId:i,bodyId:f,closed:v,style:p,overlayDialogStyle:T,rendered:g,visible:b,zIndex:C}},qo=["aria-label","aria-labelledby","aria-describedby"],zo=L({name:"ElDialog",inheritAttrs:!1}),Jo=L({...zo,props:Go,emits:Ko,setup(e,{expose:a}){const t=e,d=xe();oe({scope:"el-dialog",from:"the title slot",replacement:"the header slot",version:"3.0.0",ref:"https://element-plus.org/en-US/component/dialog.html#slots"},B(()=>!!d.title)),oe({scope:"el-dialog",from:"custom-class",replacement:"class",version:"2.3.0",ref:"https://element-plus.org/en-US/component/dialog.html#attributes",type:"Attribute"},B(()=>!!t.customClass));const l=ea("dialog"),u=j(),r=j(),i=j(),{visible:f,titleId:b,bodyId:v,style:g,overlayDialogStyle:C,rendered:c,zIndex:y,afterEnter:$,afterLeave:p,beforeLeave:T,handleClose:M,onModalClick:V,onOpenAutoFocus:q,onCloseAutoFocus:P,onCloseRequested:D,onFocusoutPrevented:k}=Vo(t,u);aa(Ae,{dialogRef:u,headerRef:r,bodyId:v,ns:l,rendered:c,style:g});const A=ua(V),R=B(()=>t.draggable&&!t.fullscreen);return a({visible:f,dialogContentRef:i}),(n,h)=>(O(),J(ca,{to:n.appendTo,disabled:n.appendTo!=="body"?!1:!n.appendToBody},[U(ia,{name:"dialog-fade",onAfterEnter:o($),onAfterLeave:o(p),onBeforeLeave:o(T),persisted:""},{default:E(()=>[oa(U(o(ta),{"custom-mask-event":"",mask:n.modal,"overlay-class":n.modalClass,"z-index":o(y)},{default:E(()=>[_("div",{role:"dialog","aria-modal":"true","aria-label":n.title||void 0,"aria-labelledby":n.title?void 0:o(b),"aria-describedby":o(v),class:S(`${o(l).namespace.value}-overlay-dialog`),style:de(o(C)),onClick:h[0]||(h[0]=(...I)=>o(A).onClick&&o(A).onClick(...I)),onMousedown:h[1]||(h[1]=(...I)=>o(A).onMousedown&&o(A).onMousedown(...I)),onMouseup:h[2]||(h[2]=(...I)=>o(A).onMouseup&&o(A).onMouseup(...I))},[U(o(na),{loop:"",trapped:o(f),"focus-start-el":"container",onFocusAfterTrapped:o(q),onFocusAfterReleased:o(P),onFocusoutPrevented:o(k),onReleaseRequested:o(D)},{default:E(()=>[o(c)?(O(),J(Uo,sa({key:0,ref_key:"dialogContentRef",ref:i},n.$attrs,{"custom-class":n.customClass,center:n.center,"align-center":n.alignCenter,"close-icon":n.closeIcon,draggable:o(R),fullscreen:n.fullscreen,"show-close":n.showClose,title:n.title,"aria-level":n.headerAriaLevel,onClose:o(M)}),la({header:E(()=>[n.$slots.title?F(n.$slots,"title",{key:1}):F(n.$slots,"header",{key:0,close:o(M),titleId:o(b),titleClass:o(l).e("title")})]),default:E(()=>[F(n.$slots,"default")]),_:2},[n.$slots.footer?{name:"footer",fn:E(()=>[F(n.$slots,"footer")])}:void 0]),1040,["custom-class","center","align-center","close-icon","draggable","fullscreen","show-close","title","aria-level","onClose"])):W("v-if",!0)]),_:3},8,["trapped","onFocusAfterTrapped","onFocusAfterReleased","onFocusoutPrevented","onReleaseRequested"])],46,qo)]),_:3},8,["mask","overlay-class","z-index"]),[[ra,o(f)]])]),_:3},8,["onAfterEnter","onAfterLeave","onBeforeLeave"])],8,["to","disabled"]))}});var Wo=fe(Jo,[["__file","dialog.vue"]]);const Xo=da(Wo),Ho=L({name:"ClientOnly",inheritAttrs:!1,props:["fallback","placeholder","placeholderTag","fallbackTag"],setup(e,{slots:a,attrs:t}){const d=j(!1);return be(()=>{d.value=!0}),l=>{var f;if(d.value)return(f=a.default)==null?void 0:f.call(a);const u=a.fallback||a.placeholder;if(u)return u();const r=l.fallback||l.placeholder||"",i=l.fallbackTag||l.placeholderTag||"span";return N(i,t,r)}}});export{Xo as E,Ho as _,z as b,ko as c};
