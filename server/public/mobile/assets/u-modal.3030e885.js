import{_ as e}from"./u-icon.d48ac815.js";import{q as t,s as l,o as i,c as a,w as o,a as s,d as n,n as r,L as u,h as c,f as h,t as d,g as p,b as m,F as f}from"./index-53bd83dd.js";import{_ as b}from"./_plugin-vue_export-helper.1b428a4d.js";import{_ as y}from"./u-loading.a4f34545.js";import{_}from"./u-popup.bbe0211f.js";const C=b({name:"u-checkbox",emits:["update:modelValue","input","change"],props:{value:{type:Boolean,default:!1},modelValue:{type:Boolean,default:!1},name:{type:[String,Number],default:""},shape:{type:String,default:""},disabled:{type:[String,Boolean],default:""},labelDisabled:{type:[String,Boolean],default:""},activeColor:{type:String,default:""},iconSize:{type:[String,Number],default:""},labelSize:{type:[String,Number],default:""},size:{type:[String,Number],default:""}},data:()=>({parentDisabled:!1,newParams:{}}),created(){this.parent=this.$u.$parent.call(this,"u-checkbox-group"),this.parent&&this.parent.children.push(this)},computed:{valueCom(){return this.modelValue},isDisabled(){return""!==this.disabled?this.disabled:!!this.parent&&this.parent.disabled},isLabelDisabled(){return""!==this.labelDisabled?this.labelDisabled:!!this.parent&&this.parent.labelDisabled},checkboxSize(){return this.size?this.size:this.parent?this.parent.size:34},checkboxIconSize(){return this.iconSize?this.iconSize:this.parent?this.parent.iconSize:20},elActiveColor(){return this.activeColor?this.activeColor:this.parent?this.parent.activeColor:"primary"},elShape(){return this.shape?this.shape:this.parent?this.parent.shape:"square"},iconStyle(){let e={};return this.elActiveColor&&this.valueCom&&!this.isDisabled&&(e.borderColor=this.elActiveColor,e.backgroundColor=this.elActiveColor),e.width=this.$u.addUnit(this.checkboxSize),e.height=this.$u.addUnit(this.checkboxSize),e},iconColor(){return this.valueCom?"#ffffff":"transparent"},iconClass(){let e=[];return e.push("u-checkbox__icon-wrap--"+this.elShape),1==this.valueCom&&e.push("u-checkbox__icon-wrap--checked"),this.isDisabled&&e.push("u-checkbox__icon-wrap--disabled"),this.valueCom&&this.isDisabled&&e.push("u-checkbox__icon-wrap--disabled--checked"),e.join(" ")},checkboxStyle(){let e={};return this.parent&&this.parent.width&&(e.width=this.parent.width,e.flex=`0 0 ${this.parent.width}`),this.parent&&this.parent.wrap&&(e.width="100%",e.flex="0 0 100%"),e}},mounted(){this._emitEvent()},watch:{valueCom:{handler:function(e,t){this._emitEvent()}}},methods:{_emitEvent(){let e={value:this.valueCom,name:this.name};this.parent&&this.parent.emitEvent&&this.parent._emitEvent(e)},onClickLabel(){this.isLabelDisabled||this.isDisabled||this.setValue()},toggle(){this.isDisabled||this.setValue()},emitEvent(){let e={value:!this.valueCom,name:this.name};this.$emit("change",e),this.parent&&this.parent.emitEvent&&this.parent.emitEvent(e)},setValue(){let e=this.valueCom,t=0;if(this.parent&&this.parent.children&&this.parent.children.map((e=>{e.value&&t++})),1==e)this.emitEvent(),this.$emit("input",!e),this.$emit("update:modelValue",!e);else{if(this.parent&&t>=this.parent.max)return this.$u.toast(`最多可选${this.parent.max}项`);this.emitEvent(),this.$emit("input",!e),this.$emit("update:modelValue",!e)}}}},[["render",function(h,d,p,m,f,b){const y=t(l("u-icon"),e),_=c;return i(),a(_,{class:"u-checkbox",style:r([b.checkboxStyle])},{default:o((()=>[s(_,{class:n(["u-checkbox__icon-wrap",[b.iconClass]]),onClick:b.toggle,style:r([b.iconStyle])},{default:o((()=>[s(y,{class:"u-checkbox__icon-wrap__icon",name:"checkbox-mark",size:b.checkboxIconSize,color:b.iconColor},null,8,["size","color"])])),_:1},8,["onClick","class","style"]),s(_,{class:"u-checkbox__label",onClick:b.onClickLabel,style:r({fontSize:h.$u.addUnit(p.labelSize)})},{default:o((()=>[u(h.$slots,"default",{},void 0,!0)])),_:3},8,["onClick","style"])])),_:3},8,["style"])}],["__scopeId","data-v-e8a09fb1"]]);const v=b({name:"u-modal",emits:["update:modelValue","input","confirm","cancel"],props:{value:{type:Boolean,default:!1},modelValue:{type:Boolean,default:!1},zIndex:{type:[Number,String],default:""},title:{type:[String],default:"提示"},width:{type:[Number,String],default:600},content:{type:String,default:"内容"},showTitle:{type:Boolean,default:!0},showConfirmButton:{type:Boolean,default:!0},showCancelButton:{type:Boolean,default:!1},confirmText:{type:String,default:"确认"},cancelText:{type:String,default:"取消"},confirmColor:{type:String,default:"#2979ff"},cancelColor:{type:String,default:"#606266"},borderRadius:{type:[Number,String],default:16},titleStyle:{type:Object,default:()=>({})},contentStyle:{type:Object,default:()=>({})},cancelStyle:{type:Object,default:()=>({})},confirmStyle:{type:Object,default:()=>({})},zoom:{type:Boolean,default:!0},asyncClose:{type:Boolean,default:!1},maskCloseAble:{type:Boolean,default:!1},negativeTop:{type:[String,Number],default:0},blur:{type:[Number,String],default:0}},data:()=>({loading:!1,popupValue:!1}),computed:{valueCom(){return this.modelValue},cancelBtnStyle(){return Object.assign({color:this.cancelColor},this.cancelStyle)},confirmBtnStyle(){return Object.assign({color:this.confirmColor},this.confirmStyle)},uZIndex(){return this.zIndex?this.zIndex:this.$u.zIndex.popup}},watch:{valueCom(e){!0===e&&(this.loading=!1),this.popupValue=e}},methods:{confirm(){this.asyncClose?this.loading=!0:(this.$emit("input",!1),this.$emit("update:modelValue",!1)),this.$emit("confirm")},cancel(){this.$emit("cancel"),this.$emit("input",!1),this.$emit("update:modelValue",!1),setTimeout((()=>{this.loading=!1}),300)},popupClose(){this.$emit("input",!1),this.$emit("update:modelValue",!1)},clearLoading(){this.loading=!1}}},[["render",function(e,n,b,C,v,S){const g=c,k=t(l("u-loading"),y),x=t(l("u-popup"),_);return i(),a(g,null,{default:o((()=>[s(x,{blur:b.blur,zoom:b.zoom,mode:"center",popup:!1,"z-index":S.uZIndex,modelValue:v.popupValue,"onUpdate:modelValue":n[0]||(n[0]=e=>v.popupValue=e),length:b.width,"mask-close-able":b.maskCloseAble,"border-radius":b.borderRadius,onClose:S.popupClose,"negative-top":b.negativeTop},{default:o((()=>[s(g,{class:"u-model"},{default:o((()=>[b.showTitle?(i(),a(g,{key:0,class:"u-model__title u-line-1",style:r([b.titleStyle])},{default:o((()=>[h(d(b.title),1)])),_:1},8,["style"])):p("",!0),s(g,{class:"u-model__content"},{default:o((()=>[e.$slots.default||e.$slots.$default?(i(),a(g,{key:0,style:r([b.contentStyle])},{default:o((()=>[u(e.$slots,"default",{},void 0,!0)])),_:3},8,["style"])):(i(),a(g,{key:1,class:"u-model__content__message",style:r([b.contentStyle])},{default:o((()=>[h(d(b.content),1)])),_:1},8,["style"]))])),_:3}),b.showCancelButton||b.showConfirmButton?(i(),a(g,{key:1,class:"u-model__footer u-border-top"},{default:o((()=>[b.showCancelButton?(i(),a(g,{key:0,"hover-stay-time":100,"hover-class":"u-model__btn--hover",class:"u-model__footer__button",style:r([S.cancelBtnStyle]),onClick:S.cancel},{default:o((()=>[h(d(b.cancelText),1)])),_:1},8,["style","onClick"])):p("",!0),b.showConfirmButton||e.$slots["confirm-button"]?(i(),a(g,{key:1,"hover-stay-time":100,"hover-class":b.asyncClose?"none":"u-model__btn--hover",class:"u-model__footer__button hairline-left",style:r([S.confirmBtnStyle]),onClick:S.confirm},{default:o((()=>[e.$slots["confirm-button"]?u(e.$slots,"confirm-button",{key:0},void 0,!0):(i(),m(f,{key:1},[v.loading?(i(),a(k,{key:0,mode:"circle",color:b.confirmColor},null,8,["color"])):(i(),m(f,{key:1},[h(d(b.confirmText),1)],64))],64))])),_:3},8,["hover-class","style","onClick"])):p("",!0)])),_:3})):p("",!0)])),_:3})])),_:3},8,["blur","zoom","z-index","modelValue","length","mask-close-able","border-radius","onClose","negative-top"])])),_:3})}],["__scopeId","data-v-988710b1"]]);export{C as _,v as a};
