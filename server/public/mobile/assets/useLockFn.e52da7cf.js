import{z as t}from"./index-e4851b67.js";function a(a){const n=t(!1);return{isLock:n,lockFn:async(...t)=>{if(!n.value){n.value=!0;try{const o=await a(...t);return n.value=!1,o}catch(o){throw n.value=!1,o}}}}}export{a as u};
