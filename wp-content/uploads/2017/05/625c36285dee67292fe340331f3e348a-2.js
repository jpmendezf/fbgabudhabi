/**handles:html5shiv,excanvas**/
!function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=E.elements;return"string"==typeof e?e.split(" "):e}function a(e,t){var n=E.elements;"string"!=typeof n&&(n=n.join(" ")),"string"!=typeof e&&(e=e.join(" ")),E.elements=n+" "+e,m(t)}function o(e){var t=y[e[g]];return t||(t={},v++,e[g]=v,y[v]=t),t}function c(e,n,r){if(n||(n=t),s)return n.createElement(e);r||(r=o(n));var a;return a=r.cache[e]?r.cache[e].cloneNode():p.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!a.canHaveChildren||h.test(e)||a.tagUrn?a:r.frag.appendChild(a)}function i(e,n){if(e||(e=t),s)return e.createDocumentFragment();n=n||o(e);for(var a=n.frag.cloneNode(),c=0,i=r(),l=i.length;c<l;c++)a.createElement(i[c]);return a}function l(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return E.shivMethods?c(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/[\w\-:]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(E,t.frag)}function m(e){e||(e=t);var r=o(e);return!E.shivCSS||u||r.hasCSS||(r.hasCSS=!!n(e,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),s||l(e,r),e}var u,s,d="3.7.3",f=e.html5||{},h=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g="_html5shiv",v=0,y={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",u="hidden"in e,s=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(e){u=!0,s=!0}}();var E={elements:f.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:d,shivCSS:f.shivCSS!==!1,supportsUnknownElements:s,shivMethods:f.shivMethods!==!1,type:"default",shivDocument:m,createElement:c,createDocumentFragment:i,addElements:a};e.html5=E,m(t),"object"==typeof module&&module.exports&&(module.exports=E)}("undefined"!=typeof window?window:this,document);
document.createElement("canvas").getContext||!function(){function t(){return this.context_||(this.context_=new l(this))}function e(t,e,i){var r=C.call(arguments,2);return function(){return t.apply(e,r.concat(C.call(arguments)))}}function i(t){var e=t.srcElement;switch(t.propertyName){case"width":e.style.width=e.attributes.width.nodeValue+"px",e.getContext().clearRect();break;case"height":e.style.height=e.attributes.height.nodeValue+"px",e.getContext().clearRect()}}function r(t){var e=t.srcElement;e.firstChild&&(e.firstChild.style.width=e.clientWidth+"px",e.firstChild.style.height=e.clientHeight+"px")}function s(){return[[1,0,0],[0,1,0],[0,0,1]]}function n(t,e){for(var i=s(),r=0;r<3;r++)for(var n=0;n<3;n++){for(var a=0,o=0;o<3;o++)a+=t[r][o]*e[o][n];i[r][n]=a}return i}function a(t,e){e.fillStyle=t.fillStyle,e.lineCap=t.lineCap,e.lineJoin=t.lineJoin,e.lineWidth=t.lineWidth,e.miterLimit=t.miterLimit,e.shadowBlur=t.shadowBlur,e.shadowColor=t.shadowColor,e.shadowOffsetX=t.shadowOffsetX,e.shadowOffsetY=t.shadowOffsetY,e.strokeStyle=t.strokeStyle,e.globalAlpha=t.globalAlpha,e.arcScaleX_=t.arcScaleX_,e.arcScaleY_=t.arcScaleY_,e.lineScale_=t.lineScale_}function o(t){var e,i=1;if(t=String(t),"rgb"==t.substring(0,3)){var r=t.indexOf("(",3),s=t.indexOf(")",r+1),n=t.substring(r+1,s).split(",");e="#";for(var a=0;a<3;a++)e+=T[Number(n[a])];4==n.length&&"a"==t.substr(3,1)&&(i=n[3])}else e=t;return{color:e,alpha:i}}function h(t){switch(t){case"butt":return"flat";case"round":return"round";case"square":default:return"square"}}function l(t){this.m_=s(),this.mStack_=[],this.aStack_=[],this.currentPath_=[],this.strokeStyle="#000",this.fillStyle="#000",this.lineWidth=1,this.lineJoin="miter",this.lineCap="butt",this.miterLimit=1*S,this.globalAlpha=1,this.canvas=t;var e=t.ownerDocument.createElement("div");e.style.width=t.clientWidth+"px",e.style.height=t.clientHeight+"px",e.style.overflow="hidden",e.style.position="absolute",t.appendChild(e),this.element_=e,this.arcScaleX_=1,this.arcScaleY_=1,this.lineScale_=1}function c(t,e,i,r){t.currentPath_.push({type:"bezierCurveTo",cp1x:e.x,cp1y:e.y,cp2x:i.x,cp2y:i.y,x:r.x,y:r.y}),t.currentX_=r.x,t.currentY_=r.y}function u(t){for(var e=0;e<3;e++)for(var i=0;i<2;i++)if(!isFinite(t[e][i])||isNaN(t[e][i]))return!1;return!0}function _(t,e,i){if(u(e)&&(t.m_=e,i)){var r=e[0][0]*e[1][1]-e[0][1]*e[1][0];t.lineScale_=v(m(r))}}function f(t){this.type_=t,this.x0_=0,this.y0_=0,this.r0_=0,this.x1_=0,this.y1_=0,this.r1_=0,this.colors_=[]}function p(){}var y=Math,d=y.round,x=y.sin,g=y.cos,m=y.abs,v=y.sqrt,S=10,w=S/2,C=Array.prototype.slice,b={init:function(t){if(/MSIE/.test(navigator.userAgent)&&!window.opera){var i=t||document;i.createElement("canvas"),i.attachEvent("onreadystatechange",e(this.init_,this,i))}},init_:function(t){if(t.namespaces.g_vml_||t.namespaces.add("g_vml_","urn:schemas-microsoft-com:vml","#default#VML"),t.namespaces.g_o_||t.namespaces.add("g_o_","urn:schemas-microsoft-com:office:office","#default#VML"),!t.styleSheets.ex_canvas_)var e=null,i="canvas{display:inline-block;overflow:hidden;text-align:left;width:300px;height:150px}g_vml_\\:*{behavior:url(#default#VML)}g_o_\\:*{behavior:url(#default#VML)}";try{e=t.createStyleSheet(),e.owningElement.id="ex_canvas_",e.cssText=i}catch(t){e=document.styleSheets[document.styleSheets.length-1],e.cssText+="\r\n"+i}for(var r=t.getElementsByTagName("canvas"),s=0;s<r.length;s++)this.initElement(r[s])},initElement:function(e){if(!e.getContext){e.getContext=t,e.innerHTML="",e.attachEvent("onpropertychange",i),e.attachEvent("onresize",r);var s=e.attributes;s.width&&s.width.specified?e.style.width=s.width.nodeValue+"px":e.width=e.clientWidth,s.height&&s.height.specified?e.style.height=s.height.nodeValue+"px":e.height=e.clientHeight}return e}};b.init();for(var T=[],P=0;P<16;P++)for(var k=0;k<16;k++)T[16*P+k]=P.toString(16)+k.toString(16);var E=l.prototype;E.clearRect=function(){this.element_.innerHTML=""},E.beginPath=function(){this.currentPath_=[]},E.moveTo=function(t,e){var i=this.getCoords_(t,e);this.currentPath_.push({type:"moveTo",x:i.x,y:i.y}),this.currentX_=i.x,this.currentY_=i.y},E.lineTo=function(t,e){var i=this.getCoords_(t,e);this.currentPath_.push({type:"lineTo",x:i.x,y:i.y}),this.currentX_=i.x,this.currentY_=i.y},E.bezierCurveTo=function(t,e,i,r,s,n){var a=this.getCoords_(s,n),o=this.getCoords_(t,e),h=this.getCoords_(i,r);c(this,o,h,a)},E.quadraticCurveTo=function(t,e,i,r){var s=this.getCoords_(t,e),n=this.getCoords_(i,r),a={x:this.currentX_+2/3*(s.x-this.currentX_),y:this.currentY_+2/3*(s.y-this.currentY_)},o={x:a.x+(n.x-this.currentX_)/3,y:a.y+(n.y-this.currentY_)/3};c(this,a,o,n)},E.arc=function(t,e,i,r,s,n){i*=S;var a=n?"at":"wa",o=t+g(r)*i-w,h=e+x(r)*i-w,l=t+g(s)*i-w,c=e+x(s)*i-w;o!=l||n||(o+=.125);var u=this.getCoords_(t,e),_=this.getCoords_(o,h),f=this.getCoords_(l,c);this.currentPath_.push({type:a,x:u.x,y:u.y,radius:i,xStart:_.x,yStart:_.y,xEnd:f.x,yEnd:f.y})},E.rect=function(t,e,i,r){this.moveTo(t,e),this.lineTo(t+i,e),this.lineTo(t+i,e+r),this.lineTo(t,e+r),this.closePath()},E.strokeRect=function(t,e,i,r){var s=this.currentPath_;this.beginPath(),this.moveTo(t,e),this.lineTo(t+i,e),this.lineTo(t+i,e+r),this.lineTo(t,e+r),this.closePath(),this.stroke(),this.currentPath_=s},E.fillRect=function(t,e,i,r){var s=this.currentPath_;this.beginPath(),this.moveTo(t,e),this.lineTo(t+i,e),this.lineTo(t+i,e+r),this.lineTo(t,e+r),this.closePath(),this.fill(),this.currentPath_=s},E.createLinearGradient=function(t,e,i,r){var s=new f("gradient");return s.x0_=t,s.y0_=e,s.x1_=i,s.y1_=r,s},E.createRadialGradient=function(t,e,i,r,s,n){var a=new f("gradientradial");return a.x0_=t,a.y0_=e,a.r0_=i,a.x1_=r,a.y1_=s,a.r1_=n,a},E.drawImage=function(t,e){var i,r,s,n,a,o,h,l,c=t.runtimeStyle.width,u=t.runtimeStyle.height;t.runtimeStyle.width="auto",t.runtimeStyle.height="auto";var _=t.width,f=t.height;if(t.runtimeStyle.width=c,t.runtimeStyle.height=u,3==arguments.length)i=arguments[1],r=arguments[2],a=o=0,h=s=_,l=n=f;else if(5==arguments.length)i=arguments[1],r=arguments[2],s=arguments[3],n=arguments[4],a=o=0,h=_,l=f;else{if(9!=arguments.length)throw Error("Invalid number of arguments");a=arguments[1],o=arguments[2],h=arguments[3],l=arguments[4],i=arguments[5],r=arguments[6],s=arguments[7],n=arguments[8]}var p=this.getCoords_(i,r),x=[],g=10,m=10;if(x.push(" <g_vml_:group",' coordsize="',S*g,",",S*m,'"',' coordorigin="0,0"',' style="width:',g,"px;height:",m,"px;position:absolute;"),1!=this.m_[0][0]||this.m_[0][1]){var v=[];v.push("M11=",this.m_[0][0],",","M12=",this.m_[1][0],",","M21=",this.m_[0][1],",","M22=",this.m_[1][1],",","Dx=",d(p.x/S),",","Dy=",d(p.y/S),"");var w=p,C=this.getCoords_(i+s,r),b=this.getCoords_(i,r+n),T=this.getCoords_(i+s,r+n);w.x=y.max(w.x,C.x,b.x,T.x),w.y=y.max(w.y,C.y,b.y,T.y),x.push("padding:0 ",d(w.x/S),"px ",d(w.y/S),"px 0;filter:progid:DXImageTransform.Microsoft.Matrix(",v.join(""),", sizingmethod='clip');")}else x.push("top:",d(p.y/S),"px;left:",d(p.x/S),"px;");x.push(' ">','<g_vml_:image src="',t.src,'"',' style="width:',S*s,"px;"," height:",S*n,'px;"',' cropleft="',a/_,'"',' croptop="',o/f,'"',' cropright="',(_-a-h)/_,'"',' cropbottom="',(f-o-l)/f,'"'," />","</g_vml_:group>"),this.element_.insertAdjacentHTML("BeforeEnd",x.join(""))},E.stroke=function(t){var e=[],i=o(t?this.fillStyle:this.strokeStyle),r=i.color,s=i.alpha*this.globalAlpha,n=10,a=10;e.push("<g_vml_:shape",' filled="',!!t,'"',' style="position:absolute;width:',n,"px;height:",a,'px;"',' coordorigin="0 0" coordsize="',S*n," ",S*a,'"',' stroked="',!t,'"',' path="');for(var l={x:null,y:null},c={x:null,y:null},u=0;u<this.currentPath_.length;u++){var _,f=this.currentPath_[u];switch(f.type){case"moveTo":_=f,e.push(" m ",d(f.x),",",d(f.y));break;case"lineTo":e.push(" l ",d(f.x),",",d(f.y));break;case"close":e.push(" x "),f=null;break;case"bezierCurveTo":e.push(" c ",d(f.cp1x),",",d(f.cp1y),",",d(f.cp2x),",",d(f.cp2y),",",d(f.x),",",d(f.y));break;case"at":case"wa":e.push(" ",f.type," ",d(f.x-this.arcScaleX_*f.radius),",",d(f.y-this.arcScaleY_*f.radius)," ",d(f.x+this.arcScaleX_*f.radius),",",d(f.y+this.arcScaleY_*f.radius)," ",d(f.xStart),",",d(f.yStart)," ",d(f.xEnd),",",d(f.yEnd))}f&&((null==l.x||f.x<l.x)&&(l.x=f.x),(null==c.x||f.x>c.x)&&(c.x=f.x),(null==l.y||f.y<l.y)&&(l.y=f.y),(null==c.y||f.y>c.y)&&(c.y=f.y))}if(e.push(' ">'),t)if("object"==typeof this.fillStyle){var p=this.fillStyle,x=0,g={x:0,y:0},m=0,v=1;if("gradient"==p.type_){var w=p.x0_/this.arcScaleX_,C=p.y0_/this.arcScaleY_,b=p.x1_/this.arcScaleX_,T=p.y1_/this.arcScaleY_,P=this.getCoords_(w,C),k=this.getCoords_(b,T),E=k.x-P.x,M=k.y-P.y;x=180*Math.atan2(E,M)/Math.PI,x<0&&(x+=360),x<1e-6&&(x=0)}else{var P=this.getCoords_(p.x0_,p.y0_),X=c.x-l.x,Y=c.y-l.y;g={x:(P.x-l.x)/X,y:(P.y-l.y)/Y},X/=this.arcScaleX_*S,Y/=this.arcScaleY_*S;var L=y.max(X,Y);m=2*p.r0_/L,v=2*p.r1_/L-m}var A=p.colors_;A.sort(function(t,e){return t.offset-e.offset});for(var j=A.length,V=A[0].color,z=A[j-1].color,H=A[0].alpha*this.globalAlpha,R=A[j-1].alpha*this.globalAlpha,W=[],u=0;u<j;u++){var O=A[u];W.push(O.offset*v+m+" "+O.color)}e.push('<g_vml_:fill type="',p.type_,'"',' method="none" focus="100%"',' color="',V,'"',' color2="',z,'"',' colors="',W.join(","),'"',' opacity="',R,'"',' g_o_:opacity2="',H,'"',' angle="',x,'"',' focusposition="',g.x,",",g.y,'" />')}else e.push('<g_vml_:fill color="',r,'" opacity="',s,'" />');else{var D=this.lineScale_*this.lineWidth;D<1&&(s*=D),e.push("<g_vml_:stroke",' opacity="',s,'"',' joinstyle="',this.lineJoin,'"',' miterlimit="',this.miterLimit,'"',' endcap="',h(this.lineCap),'"',' weight="',D,'px"',' color="',r,'" />')}e.push("</g_vml_:shape>"),this.element_.insertAdjacentHTML("beforeEnd",e.join(""))},E.fill=function(){this.stroke(!0)},E.closePath=function(){this.currentPath_.push({type:"close"})},E.getCoords_=function(t,e){var i=this.m_;return{x:S*(t*i[0][0]+e*i[1][0]+i[2][0])-w,y:S*(t*i[0][1]+e*i[1][1]+i[2][1])-w}},E.save=function(){var t={};a(this,t),this.aStack_.push(t),this.mStack_.push(this.m_),this.m_=n(s(),this.m_)},E.restore=function(){a(this.aStack_.pop(),this),this.m_=this.mStack_.pop()},E.translate=function(t,e){var i=[[1,0,0],[0,1,0],[t,e,1]];_(this,n(i,this.m_),!1)},E.rotate=function(t){var e=g(t),i=x(t),r=[[e,i,0],[-i,e,0],[0,0,1]];_(this,n(r,this.m_),!1)},E.scale=function(t,e){this.arcScaleX_*=t,this.arcScaleY_*=e;var i=[[t,0,0],[0,e,0],[0,0,1]];_(this,n(i,this.m_),!0)},E.transform=function(t,e,i,r,s,a){var o=[[t,e,0],[i,r,0],[s,a,1]];_(this,n(o,this.m_),!0)},E.setTransform=function(t,e,i,r,s,n){var a=[[t,e,0],[i,r,0],[s,n,1]];_(this,a,!0)},E.clip=function(){},E.arcTo=function(){},E.createPattern=function(){return new p},f.prototype.addColorStop=function(t,e){e=o(e),this.colors_.push({offset:t,color:e.color,alpha:e.alpha})},G_vmlCanvasManager=b,CanvasRenderingContext2D=l,CanvasGradient=f,CanvasPattern=p}();