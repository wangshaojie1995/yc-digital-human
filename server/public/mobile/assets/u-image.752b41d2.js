import{q as e,s as t,o as r,c as o,w as i,n as a,g as s,L as d,i as l,h as n}from"./index-53bd83dd.js";import{_ as u}from"./u-icon.d48ac815.js";import{_ as h}from"./_plugin-vue_export-helper.1b428a4d.js";const c=h({name:"u-image",emits:["click","error","load"],props:{src:{type:String,default:""},mode:{type:String,default:"aspectFill"},width:{type:[String,Number],default:"100%"},height:{type:[String,Number],default:"auto"},shape:{type:String,default:"square"},borderRadius:{type:[String,Number],default:0},lazyLoad:{type:Boolean,default:!0},showMenuByLongpress:{type:Boolean,default:!0},loadingIcon:{type:String,default:"photo"},errorIcon:{type:String,default:"error-circle"},showLoading:{type:Boolean,default:!0},showError:{type:Boolean,default:!0},fade:{type:Boolean,default:!0},webp:{type:Boolean,default:!1},duration:{type:[String,Number],default:500},bgColor:{type:String,default:"#f3f4f6"}},data(){return{isError:!1,loading:!0,opacity:1,durationTime:this.duration,backgroundStyle:{}}},watch:{src:{immediate:!0,handler(e){e?this.isError=!1:(this.isError=!0,this.loading=!1)}}},computed:{wrapStyle(){let e={};return e.width=this.$u.addUnit(this.width),e.height=this.$u.addUnit(this.height),e.borderRadius="circle"==this.shape?"50%":this.$u.addUnit(this.borderRadius),e.overflow=this.borderRadius>0?"hidden":"visible",this.fade&&(e.opacity=this.opacity,e.transition=`opacity ${Number(this.durationTime)/1e3}s ease-in-out`),e}},methods:{onClick(){this.$emit("click")},onErrorHandler(e){this.loading=!1,this.isError=!0,this.$emit("error",e)},onLoadHandler(){if(this.loading=!1,this.isError=!1,this.$emit("load"),!this.fade)return this.removeBgColor();this.opacity=0,this.durationTime=0,setTimeout((()=>{this.durationTime=this.duration,this.opacity=1,setTimeout((()=>{this.removeBgColor()}),this.durationTime)}),50)},removeBgColor(){this.backgroundStyle={backgroundColor:"transparent"}}}},[["render",function(h,c,g,y,p,m){const f=l,b=e(t("u-icon"),u),w=n;return r(),o(w,{class:"u-image",onClick:m.onClick,style:a([m.wrapStyle,p.backgroundStyle])},{default:i((()=>[p.isError?s("",!0):(r(),o(f,{key:0,src:g.src,mode:g.mode,onError:m.onErrorHandler,onLoad:m.onLoadHandler,"lazy-load":g.lazyLoad,class:"u-image__image",style:a({borderRadius:"circle"==g.shape?"50%":h.$u.addUnit(g.borderRadius)})},null,8,["src","mode","onError","onLoad","lazy-load","style"])),g.showLoading&&p.loading?(r(),o(w,{key:1,class:"u-image__loading",style:a({borderRadius:"circle"==g.shape?"50%":h.$u.addUnit(g.borderRadius),backgroundColor:g.bgColor})},{default:i((()=>[h.$slots.loading?d(h.$slots,"loading",{key:0},void 0,!0):(r(),o(b,{key:1,name:g.loadingIcon,width:g.width,height:g.height},null,8,["name","width","height"]))])),_:3},8,["style"])):s("",!0),g.showError&&p.isError&&!p.loading?(r(),o(w,{key:2,class:"u-image__error",style:a({borderRadius:"circle"==g.shape?"50%":h.$u.addUnit(g.borderRadius)})},{default:i((()=>[h.$slots.error?d(h.$slots,"error",{key:0},void 0,!0):(r(),o(b,{key:1,name:g.errorIcon,width:g.width,height:g.height},null,8,["name","width","height"]))])),_:3},8,["style"])):s("",!0)])),_:3},8,["onClick","style"])}],["__scopeId","data-v-be15e63c"]]);export{c as _};
