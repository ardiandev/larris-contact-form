(()=>{"use strict";var o,e={989:()=>{const o=window.wp.blocks,e=window.wp.i18n,r=window.wp.blockEditor,t=window.wp.components,n=window.wp.element,l=window.ReactJSXRuntime,a=({btnBgColor:o,setAttributes:e})=>(0,l.jsx)(t.ColorPalette,{colors:[{name:"dark",color:"#0a1128"},{name:"gray",color:"#d9d9d9"},{name:"yellow",color:"#ffd700"},{name:"light blue",color:"#87ceeb"},{name:"coral",color:"#ff7f50"},{name:"green",color:"#28a745"},{name:"deep red",color:"#b22222"},{name:"purple",color:"#6a0dad"}],value:o,onChange:o=>e({btnBgColor:o})}),s=({btnTextColor:o,setAttributes:e})=>(0,l.jsx)(t.ColorPalette,{colors:[{name:"dark",color:"#0a1128"},{name:"gray",color:"#d9d9d9"},{name:"yellow",color:"#ffd700"},{name:"light blue",color:"#87ceeb"},{name:"coral",color:"#ff7f50"},{name:"green",color:"#28a745"},{name:"deep red",color:"#b22222"},{name:"purple",color:"#6a0dad"}],value:o,onChange:o=>e({btnTextColor:o})}),c=({btnBgColor:o,btnTextColor:e})=>(0,l.jsxs)(l.Fragment,{children:[(0,l.jsx)(i,{}),(0,l.jsx)(u,{}),(0,l.jsx)(b,{}),(0,l.jsx)(m,{}),(0,l.jsx)(d,{btnBgColor:o,btnTextColor:e})]}),i=()=>{const[o,e]=(0,n.useState)("");return(0,l.jsx)(t.TextControl,{label:"Your Name",value:o,onChange:o=>e(o),className:"larris-contact-form__item"})},u=()=>{const[o,e]=(0,n.useState)("");return(0,l.jsx)(t.TextControl,{label:"Your Email",value:o,onChange:o=>e(o),className:"larris-contact-form__item"})},b=()=>{const[o,e]=(0,n.useState)("");return(0,l.jsx)(t.TextControl,{label:"Subject",value:o,onChange:o=>e(o),className:"larris-contact-form__item"})},m=()=>{const[o,e]=(0,n.useState)("");return(0,l.jsx)(t.TextareaControl,{label:"Message",value:o,onChange:o=>e(o),className:"larris-contact-form__item"})},d=({btnBgColor:o,btnTextColor:r})=>(console.log(o),(0,l.jsx)("button",{className:"larris-contact-form-button",style:{backgroundColor:o,color:r},children:(0,e.__)("Submit","larris-contact-form")})),x=JSON.parse('{"UU":"create-block/larris-contact-form"}');(0,o.registerBlockType)(x.UU,{edit:function(o){const{attributes:n,setAttributes:i}=o,{btnBgColor:u,btnTextColor:b}=n,{emailRecipent:m,setEmailRecipent:d}=o.attributes;return(0,l.jsxs)(l.Fragment,{children:[(0,l.jsx)(r.InspectorControls,{group:"settings",children:(0,l.jsxs)(t.PanelBody,{title:(0,e.__)("Button Style","larris-contact-form"),initialOpen:!0,children:[(0,l.jsx)(t.PanelRow,{children:"Background"}),(0,l.jsx)(a,{btnBgColor:u,setAttributes:i}),(0,l.jsx)(t.PanelRow,{children:"Text"}),(0,l.jsx)(s,{btnTextColor:b,setAttributes:i})]})}),(0,l.jsx)("div",{...(0,r.useBlockProps)(),children:(0,l.jsx)(c,{btnBgColor:u,btnTextColor:b})})]})}})}},r={};function t(o){var n=r[o];if(void 0!==n)return n.exports;var l=r[o]={exports:{}};return e[o](l,l.exports,t),l.exports}t.m=e,o=[],t.O=(e,r,n,l)=>{if(!r){var a=1/0;for(u=0;u<o.length;u++){for(var[r,n,l]=o[u],s=!0,c=0;c<r.length;c++)(!1&l||a>=l)&&Object.keys(t.O).every((o=>t.O[o](r[c])))?r.splice(c--,1):(s=!1,l<a&&(a=l));if(s){o.splice(u--,1);var i=n();void 0!==i&&(e=i)}}return e}l=l||0;for(var u=o.length;u>0&&o[u-1][2]>l;u--)o[u]=o[u-1];o[u]=[r,n,l]},t.o=(o,e)=>Object.prototype.hasOwnProperty.call(o,e),(()=>{var o={553:0,213:0};t.O.j=e=>0===o[e];var e=(e,r)=>{var n,l,[a,s,c]=r,i=0;if(a.some((e=>0!==o[e]))){for(n in s)t.o(s,n)&&(t.m[n]=s[n]);if(c)var u=c(t)}for(e&&e(r);i<a.length;i++)l=a[i],t.o(o,l)&&o[l]&&o[l][0](),o[l]=0;return t.O(u)},r=globalThis.webpackChunklarris_contact_form=globalThis.webpackChunklarris_contact_form||[];r.forEach(e.bind(null,0)),r.push=e.bind(null,r.push.bind(r))})();var n=t.O(void 0,[213],(()=>t(989)));n=t.O(n)})();