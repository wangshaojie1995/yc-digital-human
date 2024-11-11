import{R as e,o as t,c as i,w as a,L as r,d as s,n,g as o,e as p,h as l,ar as d}from"./index-e4851b67.js";import{_ as h}from"./_plugin-vue_export-helper.1b428a4d.js";const u=h({name:"u-button",emits:["click","getphonenumber","getuserinfo","error","opensetting","launchapp"],props:{hairLine:{type:Boolean,default:!0},type:{type:String,default:"default"},size:{type:String,default:"default"},shape:{type:String,default:"square"},plain:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},loading:{type:Boolean,default:!1},openType:{type:String,default:""},formType:{type:String,default:""},appParameter:{type:String,default:""},hoverStopPropagation:{type:Boolean,default:!1},lang:{type:String,default:"en"},sessionFrom:{type:String,default:""},sendMessageTitle:{type:String,default:""},sendMessagePath:{type:String,default:""},sendMessageImg:{type:String,default:""},showMessageCard:{type:Boolean,default:!1},hoverBgColor:{type:String,default:""},rippleBgColor:{type:String,default:""},ripple:{type:Boolean,default:!1},hoverClass:{type:String,default:""},customStyle:{type:Object,default:()=>({})},dataName:{type:String,default:""},throttleTime:{type:[String,Number],default:500},hoverStartTime:{type:[String,Number],default:20},hoverStayTime:{type:[String,Number],default:150},timerId:{type:[String,Number]}},computed:{getHoverClass(){if(this.loading||this.disabled||this.ripple||this.hoverClass)return"";let e="";return e=this.plain?"u-"+this.type+"-plain-hover":"u-"+this.type+"-hover",e},showHairLineBorder(){return["primary","success","error","warning"].indexOf(this.type)>=0&&!this.plain?"":"u-hairline-border"}},data(){return{btnTimerId:this.timerId||"button_"+Math.floor(1e8*Math.random()+0),rippleTop:0,rippleLeft:0,fields:{},waveActive:!1}},methods:{click(e){this.$u.throttle((()=>{!0!==this.loading&&!0!==this.disabled&&(this.ripple&&(this.waveActive=!1,this.$nextTick((function(){this.getWaveQuery(e)}))),this.$emit("click",e))}),this.throttleTime,!0,this.btnTimerId)},getWaveQuery(e){this.getElQuery().then((t=>{let i=t[0];if(!i.width||!i.width)return;if(i.targetWidth=i.height>i.width?i.height:i.width,!i.targetWidth)return;this.fields=i;let a="",r="";a=e.touches[0].clientX,r=e.touches[0].clientY,this.rippleTop=r-i.top-i.targetWidth/2,this.rippleLeft=a-i.left-i.targetWidth/2,this.$nextTick((()=>{this.waveActive=!0}))}))},getElQuery(){return new Promise((t=>{let i="";i=e().in(this),i.select(".u-btn").boundingClientRect(),i.exec((e=>{t(e)}))}))},getphonenumber(e){this.$emit("getphonenumber",e)},getuserinfo(e){this.$emit("getuserinfo",e)},error(e){this.$emit("error",e)},opensetting(e){this.$emit("opensetting",e)},launchapp(e){this.$emit("launchapp",e)}}},[["render",function(e,h,u,g,m,f){const y=l,c=d;return t(),i(c,{id:"u-wave-btn",class:s(["u-btn u-line-1 u-fix-ios-appearance",["u-size-"+u.size,u.plain?"u-btn--"+u.type+"--plain":"",u.loading?"u-loading":"","circle"==u.shape?"u-round-circle":"",u.hairLine?f.showHairLineBorder:"u-btn--bold-border","u-btn--"+u.type,u.disabled?`u-btn--${u.type}--disabled`:""]]),"hover-start-time":Number(u.hoverStartTime),"hover-stay-time":Number(u.hoverStayTime),disabled:u.disabled,"form-type":u.formType,"open-type":u.openType,"app-parameter":u.appParameter,"hover-stop-propagation":u.hoverStopPropagation,"send-message-title":u.sendMessageTitle,"send-message-path":"sendMessagePath",lang:u.lang,"data-name":u.dataName,"session-from":u.sessionFrom,"send-message-img":u.sendMessageImg,"show-message-card":u.showMessageCard,onGetphonenumber:f.getphonenumber,onGetuserinfo:f.getuserinfo,onError:f.error,onOpensetting:f.opensetting,onLaunchapp:f.launchapp,style:n([u.customStyle,{overflow:u.ripple?"hidden":"visible"}]),onClick:h[0]||(h[0]=p((e=>f.click(e)),["stop"])),"hover-class":f.getHoverClass,loading:u.loading},{default:a((()=>[r(e.$slots,"default",{},void 0,!0),u.ripple?(t(),i(y,{key:0,class:s(["u-wave-ripple",[m.waveActive?"u-wave-active":""]]),style:n({top:m.rippleTop+"px",left:m.rippleLeft+"px",width:m.fields.targetWidth+"px",height:m.fields.targetWidth+"px","background-color":u.rippleBgColor||"rgba(0, 0, 0, 0.15)"})},null,8,["class","style"])):o("",!0)])),_:3},8,["class","hover-start-time","hover-stay-time","disabled","form-type","open-type","app-parameter","hover-stop-propagation","send-message-title","lang","data-name","session-from","send-message-img","show-message-card","onGetphonenumber","onGetuserinfo","onError","onOpensetting","onLaunchapp","style","hover-class","loading"])}],["__scopeId","data-v-e9aa5dea"]]);export{u as _};
