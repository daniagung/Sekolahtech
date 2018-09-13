/*Sweet alert 7.0.3*/
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):e.Sweetalert2=t()}(this,function(){"use strict";var e={title:"",titleText:"",text:"",html:"",type:null,toast:!1,customClass:"",target:"body",backdrop:!0,animation:!0,allowOutsideClick:!0,allowEscapeKey:!0,allowEnterKey:!0,showConfirmButton:!0,showCancelButton:!1,preConfirm:null,confirmButtonText:"OK",confirmButtonAriaLabel:"",confirmButtonColor:"#3085d6",confirmButtonClass:null,cancelButtonText:"Cancel",cancelButtonAriaLabel:"",cancelButtonColor:"#aaa",cancelButtonClass:null,buttonsStyling:!0,reverseButtons:!1,focusConfirm:!0,focusCancel:!1,showCloseButton:!1,closeButtonAriaLabel:"Close this dialog",showLoaderOnConfirm:!1,imageUrl:null,imageWidth:null,imageHeight:null,imageAlt:"",imageClass:null,timer:null,width:500,padding:20,background:"#fff",input:null,inputPlaceholder:"",inputValue:"",inputOptions:{},inputAutoTrim:!0,inputClass:null,inputAttributes:{},inputValidator:null,grow:!1,position:"center",progressSteps:[],currentProgressStep:null,progressStepsDistance:"40px",onBeforeOpen:null,onOpen:null,onClose:null,useRejections:!1,expectRejections:!1},t=["useRejections","expectRejections"],n=function(e){var t={};for(var n in e)t[e[n]]="swal2-"+e[n];return t},o=n(["container","shown","iosfix","popup","modal","no-backdrop","toast","toast-shown","overlay","fade","show","hide","noanimation","close","title","content","contentwrapper","buttonswrapper","confirm","cancel","icon","image","input","has-input","file","range","select","radio","checkbox","textarea","inputerror","validationerror","progresssteps","activeprogressstep","progresscircle","progressline","loading","styled","top","top-left","top-right","center","center-left","center-right","bottom","bottom-left","bottom-right","grow-row","grow-column","grow-fullscreen"]),r=n(["success","warning","info","question","error"]),i=function(e,t){(e=String(e).replace(/[^0-9a-f]/gi,"")).length<6&&(e=e[0]+e[0]+e[1]+e[1]+e[2]+e[2]),t=t||0;for(var n="#",o=0;o<3;o++){var r=parseInt(e.substr(2*o,2),16);n+=("00"+(r=Math.round(Math.min(Math.max(0,r+r*t),255)).toString(16))).substr(r.length)}return n},a=function(e){console.warn("SweetAlert2: "+e)},s=function(e){console.error("SweetAlert2: "+e)},l=[],u=function(e){-1===l.indexOf(e)&&(l.push(e),a(e))},c={previousActiveElement:null,previousBodyPadding:null},d=function(e){var t=f();t&&(t.parentNode.removeChild(t),T(document.body,o["no-backdrop"]),T(document.body,o["has-input"]),T(document.body,o["toast-shown"]));{if("undefined"!=typeof document){var n=document.createElement("div");n.className=o.container,n.innerHTML=p;("string"==typeof e.target?document.querySelector(e.target):e.target).appendChild(n);var r=m(),i=q(r,o.input),a=q(r,o.file),l=r.querySelector("."+o.range+" input"),u=r.querySelector("."+o.range+" output"),c=q(r,o.select),d=r.querySelector("."+o.checkbox+" input"),b=q(r,o.textarea),h=function(){Q.isVisible()&&Q.resetValidationError()};return i.oninput=h,a.onchange=h,c.onchange=h,d.onchange=h,b.oninput=h,l.oninput=function(){h(),u.value=l.value},l.onchange=function(){h(),l.previousSibling.value=l.value},r}s("SweetAlert2 requires document to initialize")}},p=('\n <div role="dialog" aria-modal="true" aria-labelledby="'+o.title+'" aria-describedby="'+o.content+'" class="'+o.popup+'" tabindex="-1">\n   <ul class="'+o.progresssteps+'"></ul>\n   <div class="'+o.icon+" "+r.error+'">\n     <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>\n   </div>\n   <div class="'+o.icon+" "+r.question+'">?</div>\n   <div class="'+o.icon+" "+r.warning+'">!</div>\n   <div class="'+o.icon+" "+r.info+'">i</div>\n   <div class="'+o.icon+" "+r.success+'">\n     <div class="swal2-success-circular-line-left"></div>\n     <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n     <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n     <div class="swal2-success-circular-line-right"></div>\n   </div>\n   <img class="'+o.image+'" />\n   <div class="'+o.contentwrapper+'">\n   <h2 class="'+o.title+'" id="'+o.title+'"></h2>\n   <div id="'+o.content+'" class="'+o.content+'"></div>\n   </div>\n   <input class="'+o.input+'" />\n   <input type="file" class="'+o.file+'" />\n   <div class="'+o.range+'">\n     <output></output>\n     <input type="range" />\n   </div>\n   <select class="'+o.select+'"></select>\n   <div class="'+o.radio+'"></div>\n   <label for="'+o.checkbox+'" class="'+o.checkbox+'">\n     <input type="checkbox" />\n   </label>\n   <textarea class="'+o.textarea+'"></textarea>\n   <div class="'+o.validationerror+'" id="'+o.validationerror+'"></div>\n   <div class="'+o.buttonswrapper+'">\n     <button type="button" class="'+o.confirm+'">OK</button>\n     <button type="button" class="'+o.cancel+'">Cancel</button>\n   </div>\n   <button type="button" class="'+o.close+'">×</button>\n </div>\n').replace(/(^|\n)\s*/g,""),f=function(){return document.body.querySelector("."+o.container)},m=function(){return f()?f().querySelector("."+o.popup):null},b=function(e){return f()?f().querySelector("."+e):null},h=function(){return b(o.title)},g=function(){return b(o.content)},v=function(){return b(o.image)},y=function(){return b(o.progresssteps)},w=function(){return b(o.validationerror)},C=function(){return b(o.confirm)},x=function(){return b(o.cancel)},k=function(){return b(o.buttonswrapper)},S=function(){return b(o.close)},A=function(){var e=Array.from(m().querySelectorAll('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])')).sort(function(e,t){return e=parseInt(e.getAttribute("tabindex")),t=parseInt(t.getAttribute("tabindex")),e>t?1:e<t?-1:0}),t=Array.prototype.slice.call(m().querySelectorAll('button, input:not([type=hidden]), textarea, select, a, [tabindex="0"]'));return function(e){var t=[];for(var n in e)-1===t.indexOf(e[n])&&t.push(e[n]);return t}(e.concat(t))},B=function(){return!document.body.classList.contains(o["toast-shown"])},P=function(e,t){return!!e.classList&&e.classList.contains(t)},E=function(e){if(e.focus(),"file"!==e.type){var t=e.value;e.value="",e.value=t}},L=function(e,t){if(e&&t){t.split(/\s+/).filter(Boolean).forEach(function(t){e.classList.add(t)})}},T=function(e,t){if(e&&t){t.split(/\s+/).filter(Boolean).forEach(function(t){e.classList.remove(t)})}},q=function(e,t){for(var n=0;n<e.childNodes.length;n++)if(P(e.childNodes[n],t))return e.childNodes[n]},O=function(e,t){t||(t=e===m()||e===k()?"flex":"block"),e.style.opacity="",e.style.display=t},V=function(e){e.style.opacity="",e.style.display="none"},N=function(e){return e.offsetWidth||e.offsetHeight||e.getClientRects().length},j=function(){var e=document.createElement("div"),t={WebkitAnimation:"webkitAnimationEnd",OAnimation:"oAnimationEnd oanimationend",animation:"animationend"};for(var n in t)if(t.hasOwnProperty(n)&&void 0!==e.style[n])return t[n];return!1}(),M="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},H=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},R=H({},e),I=[],D=void 0,U=void 0;"undefined"==typeof Promise&&s("This package requires a Promise library, please include a shim to enable it in this browser (See: https://github.com/limonte/sweetalert2/wiki/Migration-from-SweetAlert-to-SweetAlert2#1-ie-support)");var W=function(e){for(var t in e)Q.isValidParameter(t)||a('Unknown parameter "'+t+'"'),Q.isDeprecatedParameter(t)&&u('The parameter "'+t+'" is deprecated and will be removed in the next major release.')},z=function(t){("string"==typeof t.target&&!document.querySelector(t.target)||"string"!=typeof t.target&&!t.target.appendChild)&&(a('Target parameter is not valid, defaulting to "body"'),t.target="body");var n=void 0,i=m(),l="string"==typeof t.target?document.querySelector(t.target):t.target;n=i&&l&&i.parentNode!==l.parentNode?d(t):i||d(t);var u=t.width===e.width&&t.toast?"auto":t.width;n.style.width="number"==typeof u?u+"px":u;var c=t.padding===e.padding&&t.toast?"inherit":t.padding;n.style.padding="number"==typeof c?c+"px":c,n.style.background=t.background;for(var p=n.querySelectorAll("[class^=swal2-success-circular-line], .swal2-success-fix"),b=0;b<p.length;b++)p[b].style.background=t.background;var w=f(),A=h(),B=g(),P=k(),E=C(),q=x(),N=S();if(t.titleText?A.innerText=t.titleText:A.innerHTML=t.title.split("\n").join("<br />"),t.backdrop||L(document.body,o["no-backdrop"]),t.text||t.html){if("object"===M(t.html))if(B.innerHTML="",0 in t.html)for(var j=0;j in t.html;j++)B.appendChild(t.html[j].cloneNode(!0));else B.appendChild(t.html.cloneNode(!0));else t.html?B.innerHTML=t.html:t.text&&(B.textContent=t.text);O(B)}else V(B);if(t.position in o&&L(w,o[t.position]),t.grow&&"string"==typeof t.grow){var H="grow-"+t.grow;H in o&&L(w,o[H])}t.showCloseButton?(N.setAttribute("aria-label",t.closeButtonAriaLabel),O(N)):V(N),n.className=o.popup,t.toast?(L(document.body,o["toast-shown"]),L(n,o.toast)):L(n,o.modal),t.customClass&&L(n,t.customClass);var R=y(),I=parseInt(null===t.currentProgressStep?Q.getQueueStep():t.currentProgressStep,10);t.progressSteps.length?(O(R),function(e){for(;e.firstChild;)e.removeChild(e.firstChild)}(R),I>=t.progressSteps.length&&a("Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"),t.progressSteps.forEach(function(e,n){var r=document.createElement("li");if(L(r,o.progresscircle),r.innerHTML=e,n===I&&L(r,o.activeprogressstep),R.appendChild(r),n!==t.progressSteps.length-1){var i=document.createElement("li");L(i,o.progressline),i.style.width=t.progressStepsDistance,R.appendChild(i)}})):V(R);for(var D=m().querySelectorAll("."+o.icon),U=0;U<D.length;U++)V(D[U]);if(t.type){var W=!1;for(var z in r)if(t.type===z){W=!0;break}if(!W)return s("Unknown alert type: "+t.type),!1;var K=n.querySelector("."+o.icon+"."+r[t.type]);if(O(K),t.animation)switch(t.type){case"success":L(K,"swal2-animate-success-icon"),L(K.querySelector(".swal2-success-line-tip"),"swal2-animate-success-line-tip"),L(K.querySelector(".swal2-success-line-long"),"swal2-animate-success-line-long");break;case"error":L(K,"swal2-animate-error-icon"),L(K.querySelector(".swal2-x-mark"),"swal2-animate-x-mark")}}var Z=v();t.imageUrl?(Z.setAttribute("src",t.imageUrl),Z.setAttribute("alt",t.imageAlt),O(Z),t.imageWidth?Z.setAttribute("width",t.imageWidth):Z.removeAttribute("width"),t.imageHeight?Z.setAttribute("height",t.imageHeight):Z.removeAttribute("height"),Z.className=o.image,t.imageClass&&L(Z,t.imageClass)):V(Z),t.showCancelButton?q.style.display="inline-block":V(q),t.showConfirmButton?function(e,t){e.style.removeProperty?e.style.removeProperty(t):e.style.removeAttribute(t)}(E,"display"):V(E),t.showConfirmButton||t.showCancelButton?O(P):V(P),E.innerHTML=t.confirmButtonText,q.innerHTML=t.cancelButtonText,E.setAttribute("aria-label",t.confirmButtonAriaLabel),q.setAttribute("aria-label",t.cancelButtonAriaLabel),t.buttonsStyling&&(E.style.backgroundColor=t.confirmButtonColor,q.style.backgroundColor=t.cancelButtonColor),E.className=o.confirm,L(E,t.confirmButtonClass),q.className=o.cancel,L(q,t.cancelButtonClass),t.buttonsStyling?(L(E,o.styled),L(q,o.styled)):(T(E,o.styled),T(q,o.styled),E.style.backgroundColor=E.style.borderLeftColor=E.style.borderRightColor="",q.style.backgroundColor=q.style.borderLeftColor=q.style.borderRightColor=""),!0===t.animation?T(n,o.noanimation):L(n,o.noanimation),t.showLoaderOnConfirm&&!t.preConfirm&&a("showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://limonte.github.io/sweetalert2/#ajax-request")},K=function(){null===c.previousBodyPadding&&document.body.scrollHeight>window.innerHeight&&(c.previousBodyPadding=document.body.style.paddingRight,document.body.style.paddingRight=function(){if("ontouchstart"in window||navigator.msMaxTouchPoints)return 0;var e=document.createElement("div");e.style.width="50px",e.style.height="50px",e.style.overflow="scroll",document.body.appendChild(e);var t=e.offsetWidth-e.clientWidth;return document.body.removeChild(e),t}()+"px")},Z=function(){if(/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream&&!P(document.body,o.iosfix)){var e=document.body.scrollTop;document.body.style.top=-1*e+"px",L(document.body,o.iosfix)}},Q=function e(){for(var t=arguments.length,n=Array(t),r=0;r<t;r++)n[r]=arguments[r];if(void 0===n[0])return s("SweetAlert2 expects at least 1 attribute!"),!1;var a=H({},R);switch(M(n[0])){case"string":a.title=n[0],a.html=n[1],a.type=n[2];break;case"object":if(W(n[0]),H(a,n[0]),a.extraParams=n[0].extraParams,"email"===a.input&&null===a.inputValidator){var l=function(e){return new Promise(function(t,n){/^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(e)?t():n("Invalid email address")})};a.inputValidator=a.expectRejections?l:e.adaptInputValidator(l)}if("url"===a.input&&null===a.inputValidator){var u=function(e){return new Promise(function(t,n){/^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_+.~#?&//=]*)$/.test(e)?t():n("Invalid URL")})};a.inputValidator=a.expectRejections?u:e.adaptInputValidator(u)}break;default:return s('Unexpected type of argument! Expected "string" or "object", got '+M(n[0])),!1}z(a);var d=f(),p=m();return new Promise(function(t,n){var r=function(n){e.closePopup(a.onClose),t(a.useRejections?n:{value:n})},l=function(o){e.closePopup(a.onClose),a.useRejections?n(o):t({dismiss:o})},u=function(t){e.closePopup(a.onClose),n(t)};a.timer&&(p.timeout=setTimeout(function(){return l("timer")},a.timer));var b=function(e){if(!(e=e||a.input))return null;switch(e){case"select":case"textarea":case"file":return q(p,o[e]);case"checkbox":return p.querySelector("."+o.checkbox+" input");case"radio":return p.querySelector("."+o.radio+" input:checked")||p.querySelector("."+o.radio+" input:first-child");case"range":return p.querySelector("."+o.range+" input");default:return q(p,o.input)}};a.input&&setTimeout(function(){var e=b();e&&E(e)},0);for(var H=function(t){if(a.showLoaderOnConfirm&&e.showLoading(),a.preConfirm){var n=Promise.resolve().then(function(){return a.preConfirm(t,a.extraParams)});a.expectRejections?n.then(function(e){return r(e||t)},function(t){e.hideLoading(),t&&e.showValidationError(t)}):n.then(function(n){N(w())?e.hideLoading():r(n||t)},function(e){return u(e)})}else r(t)},R=function(t){var n=t||window.event,o=n.target||n.srcElement,r=C(),s=x(),c=r&&(r===o||r.contains(o)),d=s&&(s===o||s.contains(o));switch(n.type){case"mouseover":case"mouseup":a.buttonsStyling&&(c?r.style.backgroundColor=i(a.confirmButtonColor,-.1):d&&(s.style.backgroundColor=i(a.cancelButtonColor,-.1)));break;case"mouseout":a.buttonsStyling&&(c?r.style.backgroundColor=a.confirmButtonColor:d&&(s.style.backgroundColor=a.cancelButtonColor));break;case"mousedown":a.buttonsStyling&&(c?r.style.backgroundColor=i(a.confirmButtonColor,-.2):d&&(s.style.backgroundColor=i(a.cancelButtonColor,-.2)));break;case"click":if(c&&e.isVisible())if(e.disableButtons(),a.input){var p=function(){var e=b();if(!e)return null;switch(a.input){case"checkbox":return e.checked?1:0;case"radio":return e.checked?e.value:null;case"file":return e.files.length?e.files[0]:null;default:return a.inputAutoTrim?e.value.trim():e.value}}();if(a.inputValidator){e.disableInput();var f=Promise.resolve().then(function(){return a.inputValidator(p,a.extraParams)});a.expectRejections?f.then(function(){e.enableButtons(),e.enableInput(),H(p)},function(t){e.enableButtons(),e.enableInput(),t&&e.showValidationError(t)}):f.then(function(t){e.enableButtons(),e.enableInput(),t?e.showValidationError(t):H(p)},function(e){return u(e)})}else H(p)}else H(!0);else d&&e.isVisible()&&(e.disableButtons(),l("cancel"))}},I=p.querySelectorAll("button"),W=0;W<I.length;W++)I[W].onclick=R,I[W].onmouseover=R,I[W].onmouseout=R,I[W].onmousedown=R;S().onclick=function(){l("close")},a.toast?p.onclick=function(t){t.target!==p||a.showConfirmButton||a.showCancelButton||a.allowOutsideClick&&(e.closePopup(a.onClose),l("overlay"))}:d.onclick=function(e){e.target===d&&a.allowOutsideClick&&l("overlay")};var Q=k(),Y=C(),_=x();a.reverseButtons?Y.parentNode.insertBefore(_,Y):Y.parentNode.insertBefore(Y,_);var $=function(e,t){for(var n=A(a.focusCancel),o=0;o<n.length;o++){(e+=t)===n.length?e=0:-1===e&&(e=n.length-1);var r=n[e];if(N(r))return r.focus()}};U||(D=window.onkeydown,U=!0,window.onkeydown=function(t){var n=t||window.event;if("Enter"!==n.key||n.isComposing)if("Tab"===n.key){for(var o=n.target||n.srcElement,r=A(a.focusCancel),i=-1,s=0;s<r.length;s++)if(o===r[s]){i=s;break}n.shiftKey?$(i,-1):$(i,1),n.stopPropagation(),n.preventDefault()}else-1!==["ArrowLeft","ArrowRight","ArrowUp","ArrowDown","Left","Right","Up","Down"].indexOf(n.key)?document.activeElement===Y&&N(_)?_.focus():document.activeElement===_&&N(Y)&&Y.focus():"Escape"!==n.key&&"Esc"!==n.key||!0!==a.allowEscapeKey||l("esc");else if(n.target===b()){if("textarea"===n.target.tagName.toLowerCase())return;e.clickConfirm(),n.preventDefault()}}),a.buttonsStyling&&(Y.style.borderLeftColor=a.confirmButtonColor,Y.style.borderRightColor=a.confirmButtonColor),e.hideLoading=e.disableLoading=function(){a.showConfirmButton||(V(Y),a.showCancelButton||V(k())),T(Q,o.loading),T(p,o.loading),p.removeAttribute("aria-busy"),Y.disabled=!1,_.disabled=!1},e.getTitle=function(){return h()},e.getContent=function(){return g()},e.getInput=function(){return b()},e.getImage=function(){return v()},e.getButtonsWrapper=function(){return k()},e.getConfirmButton=function(){return C()},e.getCancelButton=function(){return x()},e.enableButtons=function(){Y.disabled=!1,_.disabled=!1},e.disableButtons=function(){Y.disabled=!0,_.disabled=!0},e.enableConfirmButton=function(){Y.disabled=!1},e.disableConfirmButton=function(){Y.disabled=!0},e.enableInput=function(){var e=b();if(!e)return!1;if("radio"===e.type)for(var t=e.parentNode.parentNode.querySelectorAll("input"),n=0;n<t.length;n++)t[n].disabled=!1;else e.disabled=!1},e.disableInput=function(){var e=b();if(!e)return!1;if(e&&"radio"===e.type)for(var t=e.parentNode.parentNode.querySelectorAll("input"),n=0;n<t.length;n++)t[n].disabled=!0;else e.disabled=!0},e.showValidationError=function(e){var t=w();t.innerHTML=e,O(t);var n=b();n&&(n.setAttribute("aria-invalid",!0),n.setAttribute("aria-describedBy",o.validationerror),E(n),L(n,o.inputerror))},e.resetValidationError=function(){var e=w();V(e);var t=b();t&&(t.removeAttribute("aria-invalid"),t.removeAttribute("aria-describedBy"),T(t,o.inputerror))},e.getProgressSteps=function(){return a.progressSteps},e.setProgressSteps=function(e){a.progressSteps=e,z(a)},e.showProgressSteps=function(){O(y())},e.hideProgressSteps=function(){V(y())},e.enableButtons(),e.hideLoading(),e.resetValidationError(),a.input&&L(document.body,o["has-input"]);for(var J=["input","file","range","select","radio","checkbox","textarea"],X=void 0,F=0;F<J.length;F++){var G=o[J[F]],ee=q(p,G);if(X=b(J[F])){for(var te in X.attributes)if(X.attributes.hasOwnProperty(te)){var ne=X.attributes[te].name;"type"!==ne&&"value"!==ne&&X.removeAttribute(ne)}for(var oe in a.inputAttributes)X.setAttribute(oe,a.inputAttributes[oe])}ee.className=G,a.inputClass&&L(ee,a.inputClass),V(ee)}var re=void 0;switch(a.input){case"text":case"email":case"password":case"number":case"tel":case"url":(X=q(p,o.input)).value=a.inputValue,X.placeholder=a.inputPlaceholder,X.type=a.input,O(X);break;case"file":(X=q(p,o.file)).placeholder=a.inputPlaceholder,X.type=a.input,O(X);break;case"range":var ie=q(p,o.range),ae=ie.querySelector("input"),se=ie.querySelector("output");ae.value=a.inputValue,ae.type=a.input,se.value=a.inputValue,O(ie);break;case"select":var le=q(p,o.select);if(le.innerHTML="",a.inputPlaceholder){var ue=document.createElement("option");ue.innerHTML=a.inputPlaceholder,ue.value="",ue.disabled=!0,ue.selected=!0,le.appendChild(ue)}re=function(e){for(var t in e){var n=document.createElement("option");n.value=t,n.innerHTML=e[t],a.inputValue.toString()===t&&(n.selected=!0),le.appendChild(n)}O(le),le.focus()};break;case"radio":var ce=q(p,o.radio);ce.innerHTML="",re=function(e){for(var t in e){var n=document.createElement("input"),r=document.createElement("label"),i=document.createElement("span");n.type="radio",n.name=o.radio,n.value=t,a.inputValue.toString()===t&&(n.checked=!0),i.innerHTML=e[t],r.appendChild(n),r.appendChild(i),r.for=n.id,ce.appendChild(r)}O(ce);var s=ce.querySelectorAll("input");s.length&&s[0].focus()};break;case"checkbox":var de=q(p,o.checkbox),pe=b("checkbox");pe.type="checkbox",pe.value=1,pe.id=o.checkbox,pe.checked=Boolean(a.inputValue);var fe=de.getElementsByTagName("span");fe.length&&de.removeChild(fe[0]),(fe=document.createElement("span")).innerHTML=a.inputPlaceholder,de.appendChild(fe),O(de);break;case"textarea":var me=q(p,o.textarea);me.value=a.inputValue,me.placeholder=a.inputPlaceholder,O(me);break;case null:break;default:s('Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'+a.input+'"')}"select"!==a.input&&"radio"!==a.input||(a.inputOptions instanceof Promise?(e.showLoading(),a.inputOptions.then(function(t){e.hideLoading(),re(t)})):"object"===M(a.inputOptions)?re(a.inputOptions):s("Unexpected type of inputOptions! Expected object or Promise, got "+M(a.inputOptions))),function(e,t,n){var r=f(),i=m();null!==t&&"function"==typeof t&&t(i),e?(L(i,o.show),L(r,o.fade),T(i,o.hide)):T(i,o.fade),O(i),r.style.overflowY="hidden",j&&!P(i,o.noanimation)?i.addEventListener(j,function e(){i.removeEventListener(j,e),r.style.overflowY="auto"}):r.style.overflowY="auto",L(document.documentElement,o.shown),L(document.body,o.shown),L(r,o.shown),B()&&(K(),Z()),c.previousActiveElement=document.activeElement,null!==n&&"function"==typeof n&&setTimeout(function(){n(i)})}(a.animation,a.onBeforeOpen,a.onOpen),a.toast||(a.allowEnterKey?a.focusCancel&&N(_)?_.focus():a.focusConfirm&&N(Y)?Y.focus():$(-1,1):document.activeElement&&document.activeElement.blur()),f().scrollTop=0})};return Q.isVisible=function(){return!!m()},Q.queue=function(e){I=e;var t=function(){I=[],document.body.removeAttribute("data-swal2-queue-step")},n=[];return new Promise(function(e,o){!function o(r,i){r<I.length?(document.body.setAttribute("data-swal2-queue-step",r),Q(I[r]).then(function(a){void 0!==a.value?(n.push(a.value),o(r+1,i)):(t(),e({dismiss:a.dismiss}))})):(t(),e({value:n}))}(0)})},Q.getQueueStep=function(){return document.body.getAttribute("data-swal2-queue-step")},Q.insertQueueStep=function(e,t){return t&&t<I.length?I.splice(t,0,e):I.push(e)},Q.deleteQueueStep=function(e){void 0!==I[e]&&I.splice(e,1)},Q.close=Q.closePopup=Q.closeModal=Q.closeToast=function(e){var t=f(),n=m();if(n){T(n,o.show),L(n,o.hide),clearTimeout(n.timeout),document.body.classList.contains(o["toast-shown"])||(!function(){if(c.previousActiveElement&&c.previousActiveElement.focus){var e=window.scrollX,t=window.scrollY;c.previousActiveElement.focus(),e&&t&&window.scrollTo(e,t)}}(),window.onkeydown=D,U=!1);var r=function(){t.parentNode&&t.parentNode.removeChild(t),T(document.documentElement,o.shown),T(document.body,o.shown),T(document.body,o["no-backdrop"]),T(document.body,o["has-input"]),T(document.body,o["toast-shown"]),B()&&(null!==c.previousBodyPadding&&(document.body.style.paddingRight=c.previousBodyPadding,c.previousBodyPadding=null),function(){if(P(document.body,o.iosfix)){var e=parseInt(document.body.style.top,10);T(document.body,o.iosfix),document.body.style.top="",document.body.scrollTop=-1*e}}())};j&&!P(n,o.noanimation)?n.addEventListener(j,function e(){n.removeEventListener(j,e),P(n,o.hide)&&r()}):r(),null!==e&&"function"==typeof e&&setTimeout(function(){e(n)})}},Q.clickConfirm=function(){return C().click()},Q.clickCancel=function(){return x().click()},Q.showLoading=Q.enableLoading=function(){var e=m();e||Q(""),e=m();var t=k(),n=C(),r=x();O(t),O(n,"inline-block"),L(t,o.loading),L(e,o.loading),n.disabled=!0,r.disabled=!0,e.setAttribute("aria-busy",!0),e.focus()},Q.isValidParameter=function(t){return e.hasOwnProperty(t)||"extraParams"===t},Q.isDeprecatedParameter=function(e){return-1!==t.indexOf(e)},Q.setDefaults=function(e){if(!e||"object"!==(void 0===e?"undefined":M(e)))return s("the argument for setDefaults() is required and has to be a object");W(e);for(var t in e)Q.isValidParameter(t)&&(R[t]=e[t])},Q.resetDefaults=function(){R=H({},e)},Q.adaptInputValidator=function(e){return function(t,n){return e.call(this,t,n).then(function(){},function(e){return e})}},Q.noop=function(){},Q.version="7.0.3",Q.default=Q,Q}),window.Sweetalert2&&(window.sweetAlert=window.swal=window.Sweetalert2);


// For Shortcode
function es_submit_pages(e, url) {

    // Finding the active Form - from where the button is clicked
    e = e || window.event;
    var target = e.target || e.srcElement;
    var es_shortcode_form = target.parentElement;

    while ( es_shortcode_form.nodeName !== 'FORM' ) {
        es_shortcode_form = es_shortcode_form.parentElement;
    }

    if ( typeof es_shortcode_form !== 'undefined' && es_shortcode_form !== '' ) {
        var es_email = es_shortcode_form.querySelector( "input[name=es_txt_email_pg]" );
        var es_name  = es_shortcode_form.querySelector( "input[name=es_txt_name_pg]" );
        var es_group = es_shortcode_form.querySelector( "input[name=es_txt_group_pg]" );

        if ( es_email.value == "" ) {
            swal(es_widget_page_notices.es_error_title,es_widget_page_notices.es_email_notice,'error');
            es_email.focus();
            return false;
        }

        if ( es_email.value!="" && ( es_email.value.indexOf("@",0) == -1 || es_email.value.indexOf(".",0) == -1 ) ) {
            swal(es_widget_page_notices.es_error_title,es_widget_page_notices.es_incorrect_email,'error');
            es_email.focus();
            es_email.select();
            return false;
        }

        var es_msg = es_shortcode_form.querySelector("#es_msg_pg") || '';
        es_msg.innerHTML = es_widget_page_notices.es_load_more;

        var date_now = "";
        var mynumber = Math.random();
        var str= "es_email="+ encodeURIComponent(es_email.value) + "&es_name=" + encodeURIComponent(es_name.value) + "&es_group=" + encodeURIComponent(es_group.value) + "&timestamp=" + encodeURIComponent(date_now) + "&action=" + encodeURIComponent(mynumber);

        es_submit_requests(url+'/?es=subscribe', str, es_shortcode_form); // Passing the form to the submit request
    }

}

var http_req = false;
function es_submit_requests(url, parameters, es_shortcode_form) {
    http_req = false;
    if (window.XMLHttpRequest) {
        http_req = new XMLHttpRequest();
        if (http_req.overrideMimeType) {
            http_req.overrideMimeType('text/html');
        }
    } else if (window.ActiveXObject) {
        try {
            http_req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {

            }
        }
    }
    if (!http_req) {
        swal(es_widget_page_notices.es_error_title,es_widget_page_notices.es_ajax_error,'error');
        return false;
    }

    http_req.onreadystatechange = function(){eemail_submitresults(es_shortcode_form)}; // Passing the form to the submit request
    http_req.open('POST', url, true);
    http_req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // http_req.setRequestHeader("Content-length", parameters.length);
    // http_req.setRequestHeader("Connection", "close");
    http_req.send(parameters);
}

function eemail_submitresults(es_shortcode_form) {
    if (http_req.readyState == 4) {
        if (http_req.status == 200) {
            if (http_req.readyState==4 || http_req.readyState=="complete") {
                if (typeof es_shortcode_form !== 'undefined') {
                    var es_email = es_shortcode_form.querySelector("input[name=es_txt_email_pg]");
                    var es_name  = es_shortcode_form.querySelector("input[name=es_txt_name_pg]");
                    var es_msg   = es_shortcode_form.querySelector("#es_msg_pg") || '';
                    var es_msg_text = '';
                    var esSuccessEvent = new CustomEvent("es_response", {
                        detail: {
                            es_response : "error",
                            msg: ''
                        },
                        bubbles: true,
                        cancelable: true
                    } );

                    if ((http_req.responseText).trim() == "subscribed-successfully") {
                        es_msg_text = es_widget_page_notices.es_success_message;
                        esSuccessEvent.detail.es_response = 'success';
                        es_email.value = "";
                        es_name.value = "";
                    } else if((http_req.responseText).trim() == "subscribed-pending-doubleoptin") {
                        swal(es_widget_page_notices.es_success_title, es_widget_page_notices.es_success_notice,'success');
                        esSuccessEvent.detail.es_response = 'success';
                        es_msg_text = es_widget_page_notices.es_success_message;
                        es_email.value = "";
                        es_name.value = "";
                    } else if((http_req.responseText).trim() == "already-exist") {
                        es_msg_text = es_widget_page_notices.es_email_exists;
                    } else if((http_req.responseText).trim() == "unexpected-error") {
                        es_msg_text = es_widget_page_notices.es_error;
                    } else if((http_req.responseText).trim() == "invalid-email") {
                        es_msg_text = es_widget_page_notices.es_invalid_email;
                    } else {
                        es_msg_text = es_widget_page_notices.es_try_later;
                    }
                    es_msg.innerHTML = es_msg_text;
                    esSuccessEvent.detail.msg = es_msg_text;
                    es_shortcode_form.dispatchEvent(esSuccessEvent); // Trigger ES-Success Event
                }
            }
        } else {
            // alert(es_widget_page_notices.es_problem_request);
        }
    }

}

//Polyfill for ie
(function () {
    if ( typeof window.CustomEvent === "function" ) return false;

    function CustomEvent ( event, params ) {
        params = params || { bubbles: false, cancelable: false, detail: undefined };
        var evt = document.createEvent( 'CustomEvent' );
        evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
        return evt;
    }

    CustomEvent.prototype = window.Event.prototype;

    window.CustomEvent = CustomEvent;
})();