import{aH as t}from"./index-e4851b67.js";function a(){return t.get({url:"/article/cate"})}function r(a){return t.get({url:"/article/lists",data:a})}function e(a){return t.get({url:"/article/detail",data:a})}function l(a){return t.post({url:"/article/addCollect",data:a},{isAuth:!0})}function c(a){return t.post({url:"/article/cancelCollect",data:a},{isAuth:!0})}function n(){return t.get({url:"/article/collect"})}export{a,e as b,c,l as d,n as e,r as g};
