import{k as e,z as a,bb as t,J as l,ao as s,o as r,c,w as o,a as n,f as u,g as i,t as f,aF as d,b8 as p,ae as x,bc as g,H as m,h as v}from"./index-53bd83dd.js";import{_ as h}from"./_plugin-vue_export-helper.1b428a4d.js";const _=h(e({__name:"recorder",props:{iconSize:{default:"50"},maxDuration:{default:19}},emits:["start","success"],setup(e,{expose:h,emit:_}){const y=e,w=a(1),b=a(!1),k=a(!0);let z,C,D,E,M=[],P=!1;const T=a(0);let F=t();const R=()=>{T.value=0,P?(_("start"),navigator.mediaDevices.getUserMedia({audio:!0}).then((e=>{w.value=2,M=[],C=e,z=new MediaRecorder(e,{audioBitsPerSecond:128e3}),z.ondataavailable=e=>{b.value=!0,M.push(e.data)},z.onstop=()=>{clearInterval(E),b.value=!1;const e=new File(M,"recorder.mp3",{type:"audio/mp3"}),a=URL.createObjectURL(e);F.src=a,_("success",{url:a,file:e,duration:T.value})},z.start(),D=(new Date).getTime(),E=setInterval((()=>{T.value=Math.floor(((new Date).getTime()-D)/1e3),y.maxDuration&&T.value>=y.maxDuration&&S()}),1e3),b.value=!0})).catch((e=>{let a="";switch(e.name){case"NotAllowedError":a="当前浏览器不支持录音，请更换浏览器或在微信中打开。";break;case"NotReadableError":a="麦克风权限被拒绝，请刷新页面后授权麦克风权限。";break;default:a="未知错误，请刷新页面重试："+JSON.stringify(e)}d({content:a,success:e=>{e.confirm&&x()}})}))):p({title:"请允许使用麦克风",icon:"none"})},S=()=>{w.value=3,z.stop(),C.getTracks().forEach((e=>{e.stop()}))};l((()=>{"https:"!==location.protocol?(d({content:"录音只能在HTTPS环境中使用"}),k.value=!1):navigator.mediaDevices&&window.MediaRecorder?(document.createElement("audio"),navigator.mediaDevices.getUserMedia({audio:!0}).then((e=>{P=!0,e.getTracks().forEach((e=>{e.stop()}))})).catch((e=>console.error("Error:",e)))):(d({content:"当前浏览器不支持录音，请更换浏览器或在微信中打开。"}),k.value=!1),F.onCanplay((()=>{alert(F.duration),F.duration!=1/0&&(T.value=Math.ceil(F.duration))})),F.onPlay((()=>{j.value=!0})),F.onStop((()=>{j.value=!1})),F.onPause((()=>{j.value=!1}))})),h({start:R,stop:S});const j=a(!1),U=()=>{0==j.value?F.play():F.pause()},I=()=>{g({count:1,extension:["mp3","wav","m4a","webm"],success:e=>{F.src=e.tempFilePaths[0],w.value=3,_("success",{url:e.tempFilePaths[0],file:e.tempFiles[0],duration:T.value})}})};return s((()=>{if(F)try{F.pause(),F.destroy()}catch(e){}})),(e,a)=>{const t=m,l=v;return r(),c(l,{class:"text-white"},{default:o((()=>[1===w.value?(r(),c(l,{key:0,class:"flex flex-y-center flex-column grid-gap-8"},{default:o((()=>[n(l,{class:"w-90 h-90 bg-purple flex border-purple-2 flex-center round-circle",style:{"border-width":"12rpx"},onClick:R},{default:o((()=>[n(t,{class:"iconfont icon-maikefeng",style:{"font-size":"100rpx"}})])),_:1}),n(l,{class:"fs-12 text-center flex flex-column grid-gap-4 text-grey-1"},{default:o((()=>[n(t,null,{default:o((()=>[u("点击录制自己的声音")])),_:1}),n(t,null,{default:o((()=>[u("录制15~30秒")])),_:1})])),_:1})])),_:1})):i("",!0),2===w.value?(r(),c(l,{key:1,class:"flex flex-y-center flex-column grid-gap-8"},{default:o((()=>[n(l,{class:"flex flex-column grid-gap-4 text-center"},{default:o((()=>[n(t,{class:"text-white fs-18 fw-600"},{default:o((()=>[u(f(T.value),1)])),_:1}),n(t,{class:"fs-14 text-grey-1"},{default:o((()=>[u("录音中")])),_:1})])),_:1}),n(l,{class:"w-90 h-90 bg-purple flex border-purple-2 flex-center round-circle",style:{"border-width":"12rpx"},onClick:S},{default:o((()=>[n(t,{class:"iconfont icon-zanting",style:{"font-size":"70rpx"}})])),_:1})])),_:1})):i("",!0),3===w.value?(r(),c(l,{key:2,class:"flex flex-y-center flex-column grid-gap-8"},{default:o((()=>[n(l,{class:"flex flex-column grid-gap-4 text-center"},{default:o((()=>[n(t,{class:"text-white fs-18 fw-600"},{default:o((()=>[u(f(T.value),1)])),_:1}),n(t,{class:"fs-14 text-grey-1"},{default:o((()=>[u("录音结束")])),_:1})])),_:1}),n(l,{class:"flex flex-center text-center"},{default:o((()=>[n(l,{onClick:a[0]||(a[0]=e=>w.value=1)},{default:o((()=>[n(l,{class:"w-50 h-50 flex flex-center bg-purple-2 round-circle mb-6"},{default:o((()=>[n(t,{class:"iconfont icon-zhongshi",style:{"font-size":"40rpx"}})])),_:1}),n(t,null,{default:o((()=>[u("重录")])),_:1})])),_:1}),n(l,{class:"w-90 h-90 ml-30 bg-purple flex border-purple-2 flex-center round-circle",onClick:U},{default:o((()=>[0==j.value?(r(),c(t,{key:0,class:"iconfont icon-bofang",style:{"font-size":"70rpx"}})):(r(),c(t,{key:1,class:"iconfont icon-zanting1",style:{"font-size":"70rpx"}}))])),_:1})])),_:1})])),_:1})):i("",!0),n(l,{class:"border-white p-8 mt-30 round-10 flex flex-y-center",onClick:e.upload,style:{"border-style":"dashed"}},{default:o((()=>[n(l,{class:"bg-grey-3 w-60 h-60 round-8 flex flex-center"},{default:o((()=>[n(t,{class:"iconfont icon-shangchuanwenjian text-white fs-25"})])),_:1}),n(l,{class:"flex flex-column grid-gap-8 ml-8",onClick:I},{default:o((()=>[n(t,{class:"fw-600 text-white fs-16"},{default:o((()=>[u("从文件中选择")])),_:1}),n(t,{class:"fs-12 text-grey-1"},{default:o((()=>[u("格式要求:mp3 m4a wav")])),_:1})])),_:1})])),_:1},8,["onClick"])])),_:1})}}}),[["__scopeId","data-v-adb926c2"]]);export{_ as y};
