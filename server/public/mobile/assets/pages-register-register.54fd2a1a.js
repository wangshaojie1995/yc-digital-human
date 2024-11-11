import{k as e,z as a,u as t,m as r,y as l,o as s,b as o,a as u,w as p,f as d,v as n,c as m,e as c,g as i,F as f,ad as x,ae as _,q as g,s as h,h as y}from"./index-e4851b67.js";import{_ as b}from"./page-meta.d3be293c.js";import{_ as v}from"./u-input.4c37cb18.js";import{_ as w}from"./router-navigate.e70b1eca.js";import{_ as V,a as j}from"./u-modal.cc8b82ed.js";import{_ as k}from"./u-button.31c1d6f6.js";import{_ as C}from"./_plugin-vue_export-helper.1b428a4d.js";import"./u-icon.74289404.js";import"./emitter.1571a5d9.js";import"./u-loading.d1f9d4ff.js";import"./u-popup.c78c5737.js";const U=C(e({__name:"register",setup(e){const C=a(!1),U=t(),$=r((()=>1==U.getLoginConfig.login_agreement)),S=l({account:"",password:"",password_confirm:""}),q=a(!1),z=async()=>S.account?S.password?S.password_confirm?!C.value&&$.value?q.value=!0:S.password!=S.password_confirm?uni.$u.toast("两次输入的密码不一致"):(await x(S),void _()):uni.$u.toast("请输入确认密码"):uni.$u.toast("请输入密码"):uni.$u.toast("请输入账号");return(e,a)=>{const t=g(h("page-meta"),b),r=y,l=g(h("u-input"),v),x=g(h("router-navigate"),w),_=g(h("u-checkbox"),V),U=g(h("u-button"),k),A=g(h("u-modal"),j);return s(),o(f,null,[u(t,{"page-style":e.$theme.pageStyle},null,8,["page-style"]),u(r,{class:"register bg-white min-h-full flex flex-col items-center px-[40rpx] pt-[40rpx] box-border"},{default:p((()=>[u(r,{class:"w-full"},{default:p((()=>[u(r,{class:"text-2xl font-medium mb-[60rpx]"},{default:p((()=>[d("注册新账号")])),_:1}),u(r,{class:"px-[18rpx] border border-solid border-lightc border-light rounded-[10rpx] h-[100rpx] items-center flex"},{default:p((()=>[u(l,{class:"flex-1",modelValue:S.account,"onUpdate:modelValue":a[0]||(a[0]=e=>S.account=e),border:!1,placeholder:"请输入账号"},null,8,["modelValue"])])),_:1}),u(r,{class:"px-[18rpx] border border-solid border-lightc border-light rounded-[10rpx] h-[100rpx] items-center flex mt-[40rpx]"},{default:p((()=>[u(l,{class:"flex-1",type:"password",modelValue:S.password,"onUpdate:modelValue":a[1]||(a[1]=e=>S.password=e),placeholder:"请输入密码",border:!1},null,8,["modelValue"])])),_:1}),u(r,{class:"px-[18rpx] border border-solid border-lightc border-light rounded-[10rpx] h-[100rpx] items-center flex mt-[40rpx]"},{default:p((()=>[u(l,{class:"flex-1",type:"password",modelValue:S.password_confirm,"onUpdate:modelValue":a[2]||(a[2]=e=>S.password_confirm=e),placeholder:"请再次输入密码",border:!1},null,8,["modelValue"])])),_:1}),n($)?(s(),m(r,{key:0,class:"mt-[40rpx]"},{default:p((()=>[u(_,{modelValue:C.value,"onUpdate:modelValue":a[5]||(a[5]=e=>C.value=e),shape:"circle"},{default:p((()=>[u(r,{class:"text-xs flex"},{default:p((()=>[d(" 已阅读并同意 "),u(r,{onClick:a[3]||(a[3]=c((()=>{}),["stop"]))},{default:p((()=>[u(x,{class:"text-primary","hover-class":"none",to:"/pages/agreement/agreement?type=service"},{default:p((()=>[d(" 《服务协议》 ")])),_:1})])),_:1}),d(" 和 "),u(r,{onClick:a[4]||(a[4]=c((()=>{}),["stop"]))},{default:p((()=>[u(x,{class:"text-primary","hover-class":"none",to:"/pages/agreement/agreement?type=privacy"},{default:p((()=>[d(" 《隐私协议》 ")])),_:1})])),_:1})])),_:1})])),_:1},8,["modelValue"])])),_:1})):i("",!0),u(r,{class:"mt-[60rpx]"},{default:p((()=>[u(U,{type:"primary","hover-class":"none",onClick:z,customStyle:{height:"100rpx",opacity:S.account&&S.password&&S.password_confirm?"1":"0.5"}},{default:p((()=>[d(" 注册 ")])),_:1},8,["customStyle"])])),_:1})])),_:1})])),_:1}),u(A,{modelValue:q.value,"onUpdate:modelValue":a[6]||(a[6]=e=>q.value=e),"show-cancel-button":"","show-title":!1,onConfirm:a[7]||(a[7]=e=>{C.value=!0,q.value=!1}),onCancel:a[8]||(a[8]=e=>q.value=!1),"confirm-color":"var(--color-primary)"},{default:p((()=>[u(r,{class:"text-center px-[70rpx] py-[60rpx]"},{default:p((()=>[u(r,null,{default:p((()=>[d(" 请先阅读并同意")])),_:1}),u(r,{class:"flex justify-center"},{default:p((()=>[u(x,{"data-theme":"",to:"/pages/agreement/agreement?type=service"},{default:p((()=>[u(r,{class:"text-primary"},{default:p((()=>[d("《服务协议》")])),_:1})])),_:1}),d(" 和 "),u(x,{to:"/pages/agreement/agreement?type=privacy"},{default:p((()=>[u(r,{class:"text-primary"},{default:p((()=>[d("《隐私协议》")])),_:1})])),_:1})])),_:1})])),_:1})])),_:1},8,["modelValue"])],64)}}}),[["__scopeId","data-v-776b3c23"]]);export{U as default};
