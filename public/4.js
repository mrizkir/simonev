(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/AutoNumeric/dist/autoNumeric.min.js":
/*!**********************************************************!*\
  !*** ./node_modules/AutoNumeric/dist/autoNumeric.min.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * AutoNumeric.js v4.5.9
 * © 2009-2019 Robert J. Knothe, Alexandre Bonneau
 * Released under the MIT License.
 */
!function(e,t){ true?module.exports=t():undefined}(this,function(){return(n={},a.m=i=[function(e,t,i){"use strict";i.r(t);var n={allowedTagList:["b","caption","cite","code","const","dd","del","div","dfn","dt","em","h1","h2","h3","h4","h5","h6","input","ins","kdb","label","li","option","output","p","q","s","sample","span","strong","td","th","u"]};Object.freeze(n.allowedTagList),Object.defineProperty(n,"allowedTagList",{configurable:!1,writable:!1}),n.keyCode={Backspace:8,Tab:9,Enter:13,Shift:16,Ctrl:17,Alt:18,Pause:19,CapsLock:20,Esc:27,Space:32,PageUp:33,PageDown:34,End:35,Home:36,LeftArrow:37,UpArrow:38,RightArrow:39,DownArrow:40,Insert:45,Delete:46,num0:48,num1:49,num2:50,num3:51,num4:52,num5:53,num6:54,num7:55,num8:56,num9:57,a:65,b:66,c:67,d:68,e:69,f:70,g:71,h:72,i:73,j:74,k:75,l:76,m:77,n:78,o:79,p:80,q:81,r:82,s:83,t:84,u:85,v:86,w:87,x:88,y:89,z:90,OSLeft:91,OSRight:92,ContextMenu:93,numpad0:96,numpad1:97,numpad2:98,numpad3:99,numpad4:100,numpad5:101,numpad6:102,numpad7:103,numpad8:104,numpad9:105,MultiplyNumpad:106,PlusNumpad:107,MinusNumpad:109,DotNumpad:110,SlashNumpad:111,F1:112,F2:113,F3:114,F4:115,F5:116,F6:117,F7:118,F8:119,F9:120,F10:121,F11:122,F12:123,NumLock:144,ScrollLock:145,HyphenFirefox:173,MyComputer:182,MyCalculator:183,Semicolon:186,Equal:187,Comma:188,Hyphen:189,Dot:190,Slash:191,Backquote:192,LeftBracket:219,Backslash:220,RightBracket:221,Quote:222,Command:224,AltGraph:225,AndroidDefault:229},Object.freeze(n.keyCode),Object.defineProperty(n,"keyCode",{configurable:!1,writable:!1}),n.fromCharCodeKeyCode={0:"LaunchCalculator",8:"Backspace",9:"Tab",13:"Enter",16:"Shift",17:"Ctrl",18:"Alt",19:"Pause",20:"CapsLock",27:"Escape",32:" ",33:"PageUp",34:"PageDown",35:"End",36:"Home",37:"ArrowLeft",38:"ArrowUp",39:"ArrowRight",40:"ArrowDown",45:"Insert",46:"Delete",48:"0",49:"1",50:"2",51:"3",52:"4",53:"5",54:"6",55:"7",56:"8",57:"9",91:"OS",92:"OSRight",93:"ContextMenu",96:"0",97:"1",98:"2",99:"3",100:"4",101:"5",102:"6",103:"7",104:"8",105:"9",106:"*",107:"+",109:"-",110:".",111:"/",112:"F1",113:"F2",114:"F3",115:"F4",116:"F5",117:"F6",118:"F7",119:"F8",120:"F9",121:"F10",122:"F11",123:"F12",144:"NumLock",145:"ScrollLock",173:"-",182:"MyComputer",183:"MyCalculator",186:";",187:"=",188:",",189:"-",190:".",191:"/",192:"`",219:"[",220:"\\",221:"]",222:"'",224:"Meta",225:"AltGraph"},Object.freeze(n.fromCharCodeKeyCode),Object.defineProperty(n,"fromCharCodeKeyCode",{configurable:!1,writable:!1}),n.keyName={Unidentified:"Unidentified",AndroidDefault:"AndroidDefault",Alt:"Alt",AltGr:"AltGraph",CapsLock:"CapsLock",Ctrl:"Control",Fn:"Fn",FnLock:"FnLock",Hyper:"Hyper",Meta:"Meta",OSLeft:"OS",OSRight:"OS",Command:"OS",NumLock:"NumLock",ScrollLock:"ScrollLock",Shift:"Shift",Super:"Super",Symbol:"Symbol",SymbolLock:"SymbolLock",Enter:"Enter",Tab:"Tab",Space:" ",LeftArrow:"ArrowLeft",UpArrow:"ArrowUp",RightArrow:"ArrowRight",DownArrow:"ArrowDown",End:"End",Home:"Home",PageUp:"PageUp",PageDown:"PageDown",Backspace:"Backspace",Clear:"Clear",Copy:"Copy",CrSel:"CrSel",Cut:"Cut",Delete:"Delete",EraseEof:"EraseEof",ExSel:"ExSel",Insert:"Insert",Paste:"Paste",Redo:"Redo",Undo:"Undo",Accept:"Accept",Again:"Again",Attn:"Attn",Cancel:"Cancel",ContextMenu:"ContextMenu",Esc:"Escape",Execute:"Execute",Find:"Find",Finish:"Finish",Help:"Help",Pause:"Pause",Play:"Play",Props:"Props",Select:"Select",ZoomIn:"ZoomIn",ZoomOut:"ZoomOut",BrightnessDown:"BrightnessDown",BrightnessUp:"BrightnessUp",Eject:"Eject",LogOff:"LogOff",Power:"Power",PowerOff:"PowerOff",PrintScreen:"PrintScreen",Hibernate:"Hibernate",Standby:"Standby",WakeUp:"WakeUp",Compose:"Compose",Dead:"Dead",F1:"F1",F2:"F2",F3:"F3",F4:"F4",F5:"F5",F6:"F6",F7:"F7",F8:"F8",F9:"F9",F10:"F10",F11:"F11",F12:"F12",Print:"Print",num0:"0",num1:"1",num2:"2",num3:"3",num4:"4",num5:"5",num6:"6",num7:"7",num8:"8",num9:"9",a:"a",b:"b",c:"c",d:"d",e:"e",f:"f",g:"g",h:"h",i:"i",j:"j",k:"k",l:"l",m:"m",n:"n",o:"o",p:"p",q:"q",r:"r",s:"s",t:"t",u:"u",v:"v",w:"w",x:"x",y:"y",z:"z",A:"A",B:"B",C:"C",D:"D",E:"E",F:"F",G:"G",H:"H",I:"I",J:"J",K:"K",L:"L",M:"M",N:"N",O:"O",P:"P",Q:"Q",R:"R",S:"S",T:"T",U:"U",V:"V",W:"W",X:"X",Y:"Y",Z:"Z",Semicolon:";",Equal:"=",Comma:",",Hyphen:"-",Minus:"-",Plus:"+",Dot:".",Slash:"/",Backquote:"`",LeftParenthesis:"(",RightParenthesis:")",LeftBracket:"[",RightBracket:"]",Backslash:"\\",Quote:"'",numpad0:"0",numpad1:"1",numpad2:"2",numpad3:"3",numpad4:"4",numpad5:"5",numpad6:"6",numpad7:"7",numpad8:"8",numpad9:"9",NumpadDot:".",NumpadDotAlt:",",NumpadMultiply:"*",NumpadPlus:"+",NumpadMinus:"-",NumpadSubtract:"-",NumpadSlash:"/",NumpadDotObsoleteBrowsers:"Decimal",NumpadMultiplyObsoleteBrowsers:"Multiply",NumpadPlusObsoleteBrowsers:"Add",NumpadMinusObsoleteBrowsers:"Subtract",NumpadSlashObsoleteBrowsers:"Divide",_allFnKeys:["F1","F2","F3","F4","F5","F6","F7","F8","F9","F10","F11","F12"],_someNonPrintableKeys:["Tab","Enter","Shift","ShiftLeft","ShiftRight","Control","ControlLeft","ControlRight","Alt","AltLeft","AltRight","Pause","CapsLock","Escape"],_directionKeys:["PageUp","PageDown","End","Home","ArrowDown","ArrowLeft","ArrowRight","ArrowUp"]},Object.freeze(n.keyName._allFnKeys),Object.freeze(n.keyName._someNonPrintableKeys),Object.freeze(n.keyName._directionKeys),Object.freeze(n.keyName),Object.defineProperty(n,"keyName",{configurable:!1,writable:!1}),Object.freeze(n);var d=n;function a(e){return function(e){if(Array.isArray(e)){for(var t=0,i=new Array(e.length);t<e.length;t++)i[t]=e[t];return i}}(e)||function(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}function r(){return(r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var i=arguments[t];for(var n in i)Object.prototype.hasOwnProperty.call(i,n)&&(e[n]=i[n])}return e}).apply(this,arguments)}function h(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e)){var i=[],n=!0,a=!1,r=void 0;try{for(var s,o=e[Symbol.iterator]();!(n=(s=o.next()).done)&&(i.push(s.value),!t||i.length!==t);n=!0);}catch(e){a=!0,r=e}finally{try{n||null==o.return||o.return()}finally{if(a)throw r}}return i}}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}function o(e){return(o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}var D=function(){function s(){!function(e){if(!(e instanceof s))throw new TypeError("Cannot call a class as a function")}(this)}return function(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}(s,[{key:"isNull",value:function(e){return null===e}},{key:"isUndefined",value:function(e){return void 0===e}},{key:"isUndefinedOrNullOrEmpty",value:function(e){return null==e||""===e}},{key:"isString",value:function(e){return"string"==typeof e||e instanceof String}},{key:"isEmptyString",value:function(e){return""===e}},{key:"isBoolean",value:function(e){return"boolean"==typeof e}},{key:"isTrueOrFalseString",value:function(e){var t=String(e).toLowerCase();return"true"===t||"false"===t}},{key:"isObject",value:function(e){return"object"===o(e)&&null!==e&&!Array.isArray(e)}},{key:"isEmptyObj",value:function(e){for(var t in e)if(Object.prototype.hasOwnProperty.call(e,t))return!1;return!0}},{key:"isNumberStrict",value:function(e){return"number"==typeof e}},{key:"isNumber",value:function(e){return!this.isArray(e)&&!isNaN(parseFloat(e))&&isFinite(e)}},{key:"isDigit",value:function(e){return/\d/.test(e)}},{key:"isNumberOrArabic",value:function(e){var t=this.arabicToLatinNumbers(e,!1,!0,!0);return this.isNumber(t)}},{key:"isInt",value:function(e){return"number"==typeof e&&parseFloat(e)===parseInt(e,10)&&!isNaN(e)}},{key:"isFunction",value:function(e){return"function"==typeof e}},{key:"isIE11",value:function(){return"undefined"!=typeof window&&!!window.MSInputMethodContext&&!!document.documentMode}},{key:"contains",value:function(e,t){return!(!this.isString(e)||!this.isString(t)||""===e||""===t)&&-1!==e.indexOf(t)}},{key:"isInArray",value:function(e,t){return!(!this.isArray(t)||t===[]||this.isUndefined(e))&&-1!==t.indexOf(e)}},{key:"isArray",value:function(e){if("[object Array]"===Object.prototype.toString.call([]))return Array.isArray(e)||"object"===o(e)&&"[object Array]"===Object.prototype.toString.call(e);throw new Error("toString message changed for Object Array")}},{key:"isElement",value:function(e){return"undefined"!=typeof Element&&e instanceof Element}},{key:"isInputElement",value:function(e){return this.isElement(e)&&"input"===e.tagName.toLowerCase()}},{key:"decimalPlaces",value:function(e){var t=h(e.split("."),2)[1];return this.isUndefined(t)?0:t.length}},{key:"indexFirstNonZeroDecimalPlace",value:function(e){var t=h(String(Math.abs(e)).split("."),2)[1];if(this.isUndefined(t))return 0;var i=t.lastIndexOf("0");return-1===i?i=0:i+=2,i}},{key:"keyCodeNumber",value:function(e){return void 0===e.which?e.keyCode:e.which}},{key:"character",value:function(e){var t;if("Unidentified"===e.key||void 0===e.key||this.isSeleniumBot()){var i=this.keyCodeNumber(e);if(i===d.keyCode.AndroidDefault)return d.keyName.AndroidDefault;var n=d.fromCharCodeKeyCode[i];t=s.isUndefinedOrNullOrEmpty(n)?String.fromCharCode(i):n}else{var a;switch(e.key){case"Add":t=d.keyName.NumpadPlus;break;case"Apps":t=d.keyName.ContextMenu;break;case"Crsel":t=d.keyName.CrSel;break;case"Decimal":t=e.char?e.char:d.keyName.NumpadDot;break;case"Del":t="firefox"===(a=this.browser()).name&&a.version<=36||"ie"===a.name&&a.version<=9?d.keyName.Dot:d.keyName.Delete;break;case"Divide":t=d.keyName.NumpadSlash;break;case"Down":t=d.keyName.DownArrow;break;case"Esc":t=d.keyName.Esc;break;case"Exsel":t=d.keyName.ExSel;break;case"Left":t=d.keyName.LeftArrow;break;case"Meta":case"Super":t=d.keyName.OSLeft;break;case"Multiply":t=d.keyName.NumpadMultiply;break;case"Right":t=d.keyName.RightArrow;break;case"Spacebar":t=d.keyName.Space;break;case"Subtract":t=d.keyName.NumpadMinus;break;case"Up":t=d.keyName.UpArrow;break;default:t=e.key}}return t}},{key:"browser",value:function(){var e,t=navigator.userAgent,i=t.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i)||[];return/trident/i.test(i[1])?{name:"ie",version:(e=/\brv[ :]+(\d+)/g.exec(t)||[])[1]||""}:"Chrome"===i[1]&&null!==(e=t.match(/\b(OPR|Edge)\/(\d+)/))?{name:e[1].replace("OPR","opera"),version:e[2]}:(i=i[2]?[i[1],i[2]]:[navigator.appName,navigator.appVersion,"-?"],null!==(e=t.match(/version\/(\d+)/i))&&i.splice(1,1,e[1]),{name:i[0].toLowerCase(),version:i[1]})}},{key:"isSeleniumBot",value:function(){return!0===window.navigator.webdriver}},{key:"isNegative",value:function(e,t,i){var n=1<arguments.length&&void 0!==t?t:"-",a=!(2<arguments.length&&void 0!==i)||i;return e===n||""!==e&&(s.isNumber(e)?e<0:a?this.contains(e,n):this.isNegativeStrict(e,n))}},{key:"isNegativeStrict",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:"-";return e.charAt(0)===i}},{key:"isNegativeWithBrackets",value:function(e,t,i){return e.charAt(0)===t&&this.contains(e,i)}},{key:"isZeroOrHasNoValue",value:function(e){return!/[1-9]/g.test(e)}},{key:"setRawNegativeSign",value:function(e){return this.isNegativeStrict(e,"-")?e:"-".concat(e)}},{key:"replaceCharAt",value:function(e,t,i){return"".concat(e.substr(0,t)).concat(i).concat(e.substr(t+i.length))}},{key:"clampToRangeLimits",value:function(e,t){return Math.max(t.minimumValue,Math.min(t.maximumValue,e))}},{key:"countNumberCharactersOnTheCaretLeftSide",value:function(e,t,i){for(var n=new RegExp("[0-9".concat(i,"-]")),a=0,r=0;r<t;r++)n.test(e[r])&&a++;return a}},{key:"findCaretPositionInFormattedNumber",value:function(e,t,i,n){var a,r=i.length,s=e.length,o=0;for(a=0;a<r&&o<s&&o<t;a++)(e[o]===i[a]||"."===e[o]&&i[a]===n)&&o++;return a}},{key:"countCharInText",value:function(e,t){for(var i=0,n=0;n<t.length;n++)t[n]===e&&i++;return i}},{key:"convertCharacterCountToIndexPosition",value:function(e){return Math.max(e,e-1)}},{key:"getElementSelection",value:function(e){var t,i={};try{t=this.isUndefined(e.selectionStart)}catch(e){t=!1}try{if(t){var n=window.getSelection().getRangeAt(0);i.start=n.startOffset,i.end=n.endOffset,i.length=i.end-i.start}else i.start=e.selectionStart,i.end=e.selectionEnd,i.length=i.end-i.start}catch(e){i.start=0,i.end=0,i.length=0}return i}},{key:"setElementSelection",value:function(e,t,i){var n=2<arguments.length&&void 0!==i?i:null;if(this.isUndefinedOrNullOrEmpty(n)&&(n=t),this.isInputElement(e))e.setSelectionRange(t,n);else if(!s.isNull(e.firstChild)){var a=document.createRange();a.setStart(e.firstChild,t),a.setEnd(e.firstChild,n);var r=window.getSelection();r.removeAllRanges(),r.addRange(a)}}},{key:"throwError",value:function(e){throw new Error(e)}},{key:"warning",value:function(e,t){1<arguments.length&&void 0!==t&&!t||console.warn("Warning: ".concat(e))}},{key:"isWheelUpEvent",value:function(e){return e.deltaY||this.throwError("The event passed as a parameter is not a valid wheel event, '".concat(e.type,"' given.")),e.deltaY<0}},{key:"isWheelDownEvent",value:function(e){return e.deltaY||this.throwError("The event passed as a parameter is not a valid wheel event, '".concat(e.type,"' given.")),0<e.deltaY}},{key:"forceDecimalPlaces",value:function(e,t){var i=h(String(e).split("."),2),n=i[0],a=i[1];return a?"".concat(n,".").concat(a.substr(0,t)):e}},{key:"roundToNearest",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:1e3;return 0===e?0:(0===i&&this.throwError("The `stepPlace` used to round is equal to `0`. This value must not be equal to zero."),Math.round(e/i)*i)}},{key:"modifyAndRoundToNearestAuto",value:function(e,t,i){e=Number(this.forceDecimalPlaces(e,i));var n=Math.abs(e);if(0<=n&&n<1){var a,r=Math.pow(10,-i);if(0===e)return t?r:-r;var s,o=i,l=this.indexFirstNonZeroDecimalPlace(e);return a=o-1<=l?r:Math.pow(10,-(l+1)),s=t?e+a:e-a,this.roundToNearest(s,a)}e=parseInt(e,10);var c,u=Math.abs(e).toString().length;switch(u){case 1:c=0;break;case 2:case 3:c=1;break;case 4:case 5:c=2;break;default:c=u-3}var h,m=Math.pow(10,c);return(h=t?e+m:e-m)<=10&&-10<=h?h:this.roundToNearest(h,m)}},{key:"addAndRoundToNearestAuto",value:function(e,t){return this.modifyAndRoundToNearestAuto(e,!0,t)}},{key:"subtractAndRoundToNearestAuto",value:function(e,t){return this.modifyAndRoundToNearestAuto(e,!1,t)}},{key:"arabicToLatinNumbers",value:function(e,t,i,n){var a=!(1<arguments.length&&void 0!==t)||t,r=2<arguments.length&&void 0!==i&&i,s=3<arguments.length&&void 0!==n&&n;if(this.isNull(e))return e;var o=e.toString();if(""===o)return e;if(null===o.match(/[٠١٢٣٤٥٦٧٨٩۴۵۶]/g))return a&&(o=Number(o)),o;r&&(o=o.replace(/٫/,".")),s&&(o=o.replace(/٬/g,"")),o=o.replace(/[٠١٢٣٤٥٦٧٨٩]/g,function(e){return e.charCodeAt(0)-1632}).replace(/[۰۱۲۳۴۵۶۷۸۹]/g,function(e){return e.charCodeAt(0)-1776});var l=Number(o);return isNaN(l)?l:(a&&(o=l),o)}},{key:"triggerEvent",value:function(e,t,i,n,a){var r,s=1<arguments.length&&void 0!==t?t:document,o=2<arguments.length&&void 0!==i?i:null,l=!(3<arguments.length&&void 0!==n)||n,c=!(4<arguments.length&&void 0!==a)||a;window.CustomEvent?r=new CustomEvent(e,{detail:o,bubbles:l,cancelable:c}):(r=document.createEvent("CustomEvent")).initCustomEvent(e,l,c,{detail:o}),s.dispatchEvent(r)}},{key:"parseStr",value:function(e){var t,i,n,a,r={};if(0===e&&1/e<0&&(e="-0"),e=e.toString(),this.isNegativeStrict(e,"-")?(e=e.slice(1),r.s=-1):r.s=1,-1<(t=e.indexOf("."))&&(e=e.replace(".","")),t<0&&(t=e.length),(i=-1===e.search(/[1-9]/i)?e.length:e.search(/[1-9]/i))===(n=e.length))r.e=0,r.c=[0];else{for(a=n-1;"0"===e.charAt(a);a-=1)n-=1;for(n-=1,r.e=t-i-1,r.c=[],t=0;i<=n;i+=1)r.c[t]=+e.charAt(i),t+=1}return r}},{key:"testMinMax",value:function(e,t){var i=t.c,n=e.c,a=t.s,r=e.s,s=t.e,o=e.e;if(!i[0]||!n[0])return i[0]?a:n[0]?-r:0;if(a!==r)return a;var l=a<0;if(s!==o)return o<s^l?1:-1;for(a=-1,r=(s=i.length)<(o=n.length)?s:o,a+=1;a<r;a+=1)if(i[a]!==n[a])return i[a]>n[a]^l?1:-1;return s===o?0:o<s^l?1:-1}},{key:"randomString",value:function(e){var t=0<arguments.length&&void 0!==e?e:5;return Math.random().toString(36).substr(2,t)}},{key:"domElement",value:function(e){return s.isString(e)?document.querySelector(e):e}},{key:"getElementValue",value:function(e){return"input"===e.tagName.toLowerCase()?e.value:this.text(e)}},{key:"setElementValue",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;"input"===e.tagName.toLowerCase()?e.value=i:e.textContent=i}},{key:"cloneObject",value:function(e){return r({},e)}},{key:"camelize",value:function(e,t,i,n){var a=1<arguments.length&&void 0!==t?t:"-",r=!(2<arguments.length&&void 0!==i)||i,s=!(3<arguments.length&&void 0!==n)||n;if(this.isNull(e))return null;r&&(e=e.replace(/^data-/,""));var o=e.split(a).map(function(e){return"".concat(e.charAt(0).toUpperCase()).concat(e.slice(1))});return o=o.join(""),s&&(o="".concat(o.charAt(0).toLowerCase()).concat(o.slice(1))),o}},{key:"text",value:function(e){var t=e.nodeType;return t===Node.ELEMENT_NODE||t===Node.DOCUMENT_NODE||t===Node.DOCUMENT_FRAGMENT_NODE?e.textContent:t===Node.TEXT_NODE?e.nodeValue:""}},{key:"setText",value:function(e,t){var i=e.nodeType;i!==Node.ELEMENT_NODE&&i!==Node.DOCUMENT_NODE&&i!==Node.DOCUMENT_FRAGMENT_NODE||(e.textContent=t)}},{key:"filterOut",value:function(e,t){var i=this;return e.filter(function(e){return!i.isInArray(e,t)})}},{key:"trimPaddedZerosFromDecimalPlaces",value:function(e){if(""===(e=String(e)))return"";var t=h(e.split("."),2),i=t[0],n=t[1];if(this.isUndefinedOrNullOrEmpty(n))return i;var a=n.replace(/0+$/g,"");return""===a?i:"".concat(i,".").concat(a)}},{key:"getHoveredElement",value:function(){var e=a(document.querySelectorAll(":hover"));return e[e.length-1]}},{key:"arrayTrim",value:function(e,t){var i=e.length;return 0===i||i<t?e:t<0?[]:(e.length=parseInt(t,10),e)}},{key:"arrayUnique",value:function(){var e;return a(new Set((e=[]).concat.apply(e,arguments)))}},{key:"mergeMaps",value:function(){for(var e=arguments.length,t=new Array(e),i=0;i<e;i++)t[i]=arguments[i];return new Map(t.reduce(function(e,t){return e.concat(a(t))},[]))}},{key:"objectKeyLookup",value:function(e,t){var i=Object.entries(e).find(function(e){return e[1]===t}),n=null;return void 0!==i&&(n=i[0]),n}},{key:"insertAt",value:function(e,t,i){if(i>(e=String(e)).length)throw new Error("The given index is out of the string range.");if(1!==t.length)throw new Error("The given string `char` should be only one character long.");return""===e&&0===i?t:"".concat(e.slice(0,i)).concat(t).concat(e.slice(i))}},{key:"scientificToDecimal",value:function(e){var t=Number(e);if(isNaN(t))return NaN;if(e=String(e),!this.contains(e,"e")&&!this.contains(e,"E"))return e;var i=h(e.split(/e/i),2),n=i[0],a=i[1],r=n<0;r&&(n=n.replace("-",""));var s=+a<0;s&&(a=a.replace("-",""));var o,l=h(n.split(/\./),2),c=l[0],u=l[1];return o=s?(o=c.length>a?this.insertAt(c,".",c.length-a):"0.".concat("0".repeat(a-c.length)).concat(c),"".concat(o).concat(u||"")):u?(n="".concat(c).concat(u),a<u.length?this.insertAt(n,".",+a+c.length):"".concat(n).concat("0".repeat(a-u.length))):(n=n.replace(".",""),"".concat(n).concat("0".repeat(Number(a)))),r&&(o="-".concat(o)),o}}]),s}(),s=function(){function t(e){if(function(e){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this),null===e)throw new Error("Invalid AST")}return function(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}(t.prototype,[{key:"evaluate",value:function(e){if(null==e)throw new Error("Invalid AST sub-tree");if("number"===e.type)return e.value;if("unaryMinus"===e.type)return-this.evaluate(e.left);var t=this.evaluate(e.left),i=this.evaluate(e.right);switch(e.type){case"op_+":return Number(t)+Number(i);case"op_-":return t-i;case"op_*":return t*i;case"op_/":return t/i;default:throw new Error("Invalid operator '".concat(e.type,"'"))}}}]),t}(),l=function(){function a(){!function(e){if(!(e instanceof a))throw new TypeError("Cannot call a class as a function")}(this)}return function(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}(a,[{key:"createNode",value:function(e,t,i){var n=new a;return n.type=e,n.left=t,n.right=i,n}},{key:"createUnaryNode",value:function(e){var t=new a;return t.type="unaryMinus",t.left=e,t.right=null,t}},{key:"createLeaf",value:function(e){var t=new a;return t.type="number",t.value=e,t}}]),a}();function c(e,t,i){!function(e){if(!(e instanceof c))throw new TypeError("Cannot call a class as a function")}(this),this.type=e,this.value=t,this.symbol=i}var u=function(){function t(e){!function(e){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this),this.text=e,this.textLength=e.length,this.index=0,this.token=new c("Error",0,0)}return function(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}(t.prototype,[{key:"_skipSpaces",value:function(){for(;" "===this.text[this.index]&&this.index<=this.textLength;)this.index++}},{key:"getIndex",value:function(){return this.index}},{key:"getNextToken",value:function(e){var t=0<arguments.length&&void 0!==e?e:".";if(this._skipSpaces(),this.textLength===this.index)return this.token.type="EOT",this.token;if(D.isDigit(this.text[this.index]))return this.token.type="num",this.token.value=this._getNumber(t),this.token;switch(this.token.type="Error",this.text[this.index]){case"+":this.token.type="+";break;case"-":this.token.type="-";break;case"*":this.token.type="*";break;case"/":this.token.type="/";break;case"(":this.token.type="(";break;case")":this.token.type=")"}if("Error"===this.token.type)throw new Error("Unexpected token '".concat(this.token.symbol,"' at position '").concat(this.token.index,"' in the token function"));return this.token.symbol=this.text[this.index],this.index++,this.token}},{key:"_getNumber",value:function(e){this._skipSpaces();for(var t=this.index;this.index<=this.textLength&&D.isDigit(this.text[this.index]);)this.index++;for(this.text[this.index]===e&&this.index++;this.index<=this.textLength&&D.isDigit(this.text[this.index]);)this.index++;if(this.index===t)throw new Error("No number has been found while it was expected");return this.text.substring(t,this.index).replace(e,".")}}]),t}(),m=function(){function i(e){var t=1<arguments.length&&void 0!==arguments[1]?arguments[1]:".";return function(e){if(!(e instanceof i))throw new TypeError("Cannot call a class as a function")}(this),this.text=e,this.decimalCharacter=t,this.lexer=new u(e),this.token=this.lexer.getNextToken(this.decimalCharacter),this._exp()}return function(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}(i.prototype,[{key:"_exp",value:function(){var e=this._term(),t=this._moreExp();return l.createNode("op_+",e,t)}},{key:"_moreExp",value:function(){var e,t;switch(this.token.type){case"+":return this.token=this.lexer.getNextToken(this.decimalCharacter),e=this._term(),t=this._moreExp(),l.createNode("op_+",t,e);case"-":return this.token=this.lexer.getNextToken(this.decimalCharacter),e=this._term(),t=this._moreExp(),l.createNode("op_-",t,e)}return l.createLeaf(0)}},{key:"_term",value:function(){var e=this._factor(),t=this._moreTerms();return l.createNode("op_*",e,t)}},{key:"_moreTerms",value:function(){var e,t;switch(this.token.type){case"*":return this.token=this.lexer.getNextToken(this.decimalCharacter),e=this._factor(),t=this._moreTerms(),l.createNode("op_*",t,e);case"/":return this.token=this.lexer.getNextToken(this.decimalCharacter),e=this._factor(),t=this._moreTerms(),l.createNode("op_/",t,e)}return l.createLeaf(1)}},{key:"_factor",value:function(){var e,t,i;switch(this.token.type){case"num":return i=this.token.value,this.token=this.lexer.getNextToken(this.decimalCharacter),l.createLeaf(i);case"-":return this.token=this.lexer.getNextToken(this.decimalCharacter),t=this._factor(),l.createUnaryNode(t);case"(":return this.token=this.lexer.getNextToken(this.decimalCharacter),e=this._exp(),this._match(")"),e;default:throw new Error("Unexpected token '".concat(this.token.symbol,"' with type '").concat(this.token.type,"' at position '").concat(this.token.index,"' in the factor function"))}}},{key:"_match",value:function(e){var t=this.lexer.getIndex()-1;if(this.text[t]!==e)throw new Error("Unexpected token '".concat(this.token.symbol,"' at position '").concat(t,"' in the match function"));this.token=this.lexer.getNextToken(this.decimalCharacter)}}]),i}();function v(e){return function(e){if(Array.isArray(e)){for(var t=0,i=new Array(e.length);t<e.length;t++)i[t]=e[t];return i}}(e)||function(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}function S(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e)){var i=[],n=!0,a=!1,r=void 0;try{for(var s,o=e[Symbol.iterator]();!(n=(s=o.next()).done)&&(i.push(s.value),!t||i.length!==t);n=!0);}catch(e){a=!0,r=e}finally{try{n||null==o.return||o.return()}finally{if(a)throw r}}return i}}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}function y(){return(y=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var i=arguments[t];for(var n in i)Object.prototype.hasOwnProperty.call(i,n)&&(e[n]=i[n])}return e}).apply(this,arguments)}function b(e){return(b="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function g(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var p,f=function(){function I(){var s=this,e=0<arguments.length&&void 0!==arguments[0]?arguments[0]:null,t=1<arguments.length&&void 0!==arguments[1]?arguments[1]:null,i=2<arguments.length&&void 0!==arguments[2]?arguments[2]:null;!function(e){if(!(e instanceof I))throw new TypeError("Cannot call a class as a function")}(this);var n=I._setArgumentsValues(e,t,i),a=n.domElement,r=n.initialValue,o=n.userOptions;if(this.domElement=a,this.defaultRawValue="",this._setSettings(o,!1),this._checkElement(),this.savedCancellableValue=null,this.historyTable=[],this.historyTableIndex=-1,this.onGoingRedo=!1,this.parentForm=this._getParentForm(),!this.runOnce&&this.settings.formatOnPageLoad)this._formatDefaultValueOnPageLoad(r);else{var l;if(D.isNull(r))switch(this.settings.emptyInputBehavior){case I.options.emptyInputBehavior.min:l=this.settings.minimumValue;break;case I.options.emptyInputBehavior.max:l=this.settings.maximumValue;break;case I.options.emptyInputBehavior.zero:l="0";break;case I.options.emptyInputBehavior.focus:case I.options.emptyInputBehavior.press:case I.options.emptyInputBehavior.always:case I.options.emptyInputBehavior.null:l="";break;default:l=this.settings.emptyInputBehavior}else l=r;this._setElementAndRawValue(l)}this.runOnce=!0,this.hasEventListeners=!1,(this.isInputElement||this.isContentEditable)&&(this.settings.noEventListeners||this._createEventListeners(),this._setWritePermissions(!0)),this._saveInitialValues(r),this.sessionStorageAvailable=this.constructor._storageTest(),this.storageNamePrefix="AUTO_",this._setPersistentStorageName(),this.isFocused=!1,this.isWheelEvent=!1,this.isDropEvent=!1,this.isEditing=!1,this.rawValueOnFocus=void 0,this.internalModification=!1,this.attributeToWatch=this._getAttributeToWatch(),this.getterSetter=Object.getOwnPropertyDescriptor(this.domElement.__proto__,this.attributeToWatch),this._addWatcher(),this.settings.createLocalList&&this._createLocalList(),this.constructor._addToGlobalList(this),this.global={set:function(t,e){var i=1<arguments.length&&void 0!==e?e:null;s.autoNumericLocalList.forEach(function(e){e.set(t,i)})},setUnformatted:function(t,e){var i=1<arguments.length&&void 0!==e?e:null;s.autoNumericLocalList.forEach(function(e){e.setUnformatted(t,i)})},get:function(e){var t=0<arguments.length&&void 0!==e?e:null,i=[];return s.autoNumericLocalList.forEach(function(e){i.push(e.get())}),s._executeCallback(i,t),i},getNumericString:function(e){var t=0<arguments.length&&void 0!==e?e:null,i=[];return s.autoNumericLocalList.forEach(function(e){i.push(e.getNumericString())}),s._executeCallback(i,t),i},getFormatted:function(e){var t=0<arguments.length&&void 0!==e?e:null,i=[];return s.autoNumericLocalList.forEach(function(e){i.push(e.getFormatted())}),s._executeCallback(i,t),i},getNumber:function(e){var t=0<arguments.length&&void 0!==e?e:null,i=[];return s.autoNumericLocalList.forEach(function(e){i.push(e.getNumber())}),s._executeCallback(i,t),i},getLocalized:function(e){var t=0<arguments.length&&void 0!==e?e:null,i=[];return s.autoNumericLocalList.forEach(function(e){i.push(e.getLocalized())}),s._executeCallback(i,t),i},reformat:function(){s.autoNumericLocalList.forEach(function(e){e.reformat()})},unformat:function(){s.autoNumericLocalList.forEach(function(e){e.unformat()})},unformatLocalized:function(e){var t=0<arguments.length&&void 0!==e?e:null;s.autoNumericLocalList.forEach(function(e){e.unformatLocalized(t)})},update:function(){for(var e=arguments.length,t=new Array(e),i=0;i<e;i++)t[i]=arguments[i];s.autoNumericLocalList.forEach(function(e){e.update.apply(e,t)})},isPristine:function(){var t=!(0<arguments.length&&void 0!==arguments[0])||arguments[0],i=!0;return s.autoNumericLocalList.forEach(function(e){i&&!e.isPristine(t)&&(i=!1)}),i},clear:function(e){var t=0<arguments.length&&void 0!==e&&e;s.autoNumericLocalList.forEach(function(e){e.clear(t)})},remove:function(){s.autoNumericLocalList.forEach(function(e){e.remove()})},wipe:function(){s.autoNumericLocalList.forEach(function(e){e.wipe()})},nuke:function(){s.autoNumericLocalList.forEach(function(e){e.nuke()})},has:function(e){return e instanceof I?s.autoNumericLocalList.has(e.node()):s.autoNumericLocalList.has(e)},addObject:function(e){var t,i;i=e instanceof I?(t=e.node(),e):I.getAutoNumericElement(t=e),s._hasLocalList()||s._createLocalList();var n,a=i._getLocalList();0===a.size&&(i._createLocalList(),a=i._getLocalList()),(n=a instanceof Map?D.mergeMaps(s._getLocalList(),a):(s._addToLocalList(t,i),s._getLocalList())).forEach(function(e){e._setLocalList(n)})},removeObject:function(e,t){var i,n,a=1<arguments.length&&void 0!==t&&t;n=e instanceof I?(i=e.node(),e):I.getAutoNumericElement(i=e);var r=s.autoNumericLocalList;s.autoNumericLocalList.delete(i),r.forEach(function(e){e._setLocalList(s.autoNumericLocalList)}),a||i!==s.node()?n._createLocalList():n._setLocalList(new Map)},empty:function(e){var t=0<arguments.length&&void 0!==e&&e;s.autoNumericLocalList.forEach(function(e){t?e._createLocalList():e._setLocalList(new Map)})},elements:function(){var t=[];return s.autoNumericLocalList.forEach(function(e){t.push(e.node())}),t},getList:function(){return s.autoNumericLocalList},size:function(){return s.autoNumericLocalList.size}},this.options={reset:function(){return s.settings={rawValue:s.defaultRawValue},s.update(I.defaultSettings),s},allowDecimalPadding:function(e){return s.update({allowDecimalPadding:e}),s},alwaysAllowDecimalCharacter:function(e){return s.update({alwaysAllowDecimalCharacter:e}),s},caretPositionOnFocus:function(e){return s.settings.caretPositionOnFocus=e,s},createLocalList:function(e){return s.settings.createLocalList=e,s.settings.createLocalList?s._hasLocalList()||s._createLocalList():s._deleteLocalList(),s},currencySymbol:function(e){return s.update({currencySymbol:e}),s},currencySymbolPlacement:function(e){return s.update({currencySymbolPlacement:e}),s},decimalCharacter:function(e){return s.update({decimalCharacter:e}),s},decimalCharacterAlternative:function(e){return s.settings.decimalCharacterAlternative=e,s},decimalPlaces:function(e){return D.warning("Using `options.decimalPlaces()` instead of calling the specific `options.decimalPlacesRawValue()`, `options.decimalPlacesShownOnFocus()` and `options.decimalPlacesShownOnBlur()` methods will reset those options.\nPlease call the specific methods if you do not want to reset those.",s.settings.showWarnings),s.update({decimalPlaces:e}),s},decimalPlacesRawValue:function(e){return s.update({decimalPlacesRawValue:e}),s},decimalPlacesShownOnBlur:function(e){return s.update({decimalPlacesShownOnBlur:e}),s},decimalPlacesShownOnFocus:function(e){return s.update({decimalPlacesShownOnFocus:e}),s},defaultValueOverride:function(e){return s.update({defaultValueOverride:e}),s},digitalGroupSpacing:function(e){return s.update({digitalGroupSpacing:e}),s},digitGroupSeparator:function(e){return s.update({digitGroupSeparator:e}),s},divisorWhenUnfocused:function(e){return s.update({divisorWhenUnfocused:e}),s},emptyInputBehavior:function(e){return null===s.rawValue&&e!==I.options.emptyInputBehavior.null&&(D.warning("You are trying to modify the `emptyInputBehavior` option to something different than `'null'` (".concat(e,"), but the element raw value is currently set to `null`. This would result in an invalid `rawValue`. In order to fix that, the element value has been changed to the empty string `''`."),s.settings.showWarnings),s.rawValue=""),s.update({emptyInputBehavior:e}),s},eventBubbles:function(e){return s.settings.eventBubbles=e,s},eventIsCancelable:function(e){return s.settings.eventIsCancelable=e,s},failOnUnknownOption:function(e){return s.settings.failOnUnknownOption=e,s},formatOnPageLoad:function(e){return s.settings.formatOnPageLoad=e,s},formulaMode:function(e){return s.settings.formulaMode=e,s},historySize:function(e){return s.settings.historySize=e,s},isCancellable:function(e){return s.settings.isCancellable=e,s},leadingZero:function(e){return s.update({leadingZero:e}),s},maximumValue:function(e){return s.update({maximumValue:e}),s},minimumValue:function(e){return s.update({minimumValue:e}),s},modifyValueOnWheel:function(e){return s.settings.modifyValueOnWheel=e,s},negativeBracketsTypeOnBlur:function(e){return s.update({negativeBracketsTypeOnBlur:e}),s},negativePositiveSignPlacement:function(e){return s.update({negativePositiveSignPlacement:e}),s},negativeSignCharacter:function(e){return s.update({negativeSignCharacter:e}),s},noEventListeners:function(e){return e===I.options.noEventListeners.noEvents&&s.settings.noEventListeners===I.options.noEventListeners.addEvents&&s._removeEventListeners(),s.update({noEventListeners:e}),s},onInvalidPaste:function(e){return s.settings.onInvalidPaste=e,s},outputFormat:function(e){return s.settings.outputFormat=e,s},overrideMinMaxLimits:function(e){return s.update({overrideMinMaxLimits:e}),s},positiveSignCharacter:function(e){return s.update({positiveSignCharacter:e}),s},rawValueDivisor:function(e){return s.update({rawValueDivisor:e}),s},readOnly:function(e){return s.settings.readOnly=e,s._setWritePermissions(),s},roundingMethod:function(e){return s.update({roundingMethod:e}),s},saveValueToSessionStorage:function(e){return s.update({saveValueToSessionStorage:e}),s},symbolWhenUnfocused:function(e){return s.update({symbolWhenUnfocused:e}),s},selectNumberOnly:function(e){return s.settings.selectNumberOnly=e,s},selectOnFocus:function(e){return s.settings.selectOnFocus=e,s},serializeSpaces:function(e){return s.settings.serializeSpaces=e,s},showOnlyNumbersOnFocus:function(e){return s.update({showOnlyNumbersOnFocus:e}),s},showPositiveSign:function(e){return s.update({showPositiveSign:e}),s},showWarnings:function(e){return s.settings.showWarnings=e,s},styleRules:function(e){return s.update({styleRules:e}),s},suffixText:function(e){return s.update({suffixText:e}),s},unformatOnHover:function(e){return s.settings.unformatOnHover=e,s},unformatOnSubmit:function(e){return s.settings.unformatOnSubmit=e,s},valuesToStrings:function(e){return s.update({valuesToStrings:e}),s},watchExternalChanges:function(e){return s.update({watchExternalChanges:e}),s},wheelOn:function(e){return s.settings.wheelOn=e,s},wheelStep:function(e){return s.settings.wheelStep=e,s}},this._triggerEvent(I.events.initialized,this.domElement,{newValue:D.getElementValue(this.domElement),newRawValue:this.rawValue,error:null,aNElement:this})}return t=[{key:"version",value:function(){return"4.5.9"}},{key:"_setArgumentsValues",value:function(e,t,i){D.isNull(e)&&D.throwError("At least one valid parameter is needed in order to initialize an AutoNumeric object");var n,a,r,s=D.isElement(e),o=D.isString(e),l=D.isObject(t),c=Array.isArray(t)&&0<t.length,u=D.isNumberOrArabic(t)||""===t,h=this._isPreDefinedOptionValid(t),m=D.isNull(t),g=D.isEmptyString(t),d=D.isObject(i),v=Array.isArray(i)&&0<i.length,p=D.isNull(i),f=this._isPreDefinedOptionValid(i);return s&&m&&p?(n=e,a=r=null):s&&u&&p?(n=e,r=t,a=null):s&&l&&p?(n=e,r=null,a=t):s&&h&&p?(n=e,r=null,a=this._getOptionObject(t)):s&&c&&p?(n=e,r=null,a=this.mergeOptions(t)):s&&(m||g)&&d?(n=e,r=null,a=i):s&&(m||g)&&v?(n=e,r=null,a=this.mergeOptions(i)):o&&m&&p?(n=document.querySelector(e),a=r=null):o&&l&&p?(n=document.querySelector(e),r=null,a=t):o&&h&&p?(n=document.querySelector(e),r=null,a=this._getOptionObject(t)):o&&c&&p?(n=document.querySelector(e),r=null,a=this.mergeOptions(t)):o&&(m||g)&&d?(n=document.querySelector(e),r=null,a=i):o&&(m||g)&&v?(n=document.querySelector(e),r=null,a=this.mergeOptions(i)):o&&u&&p?(n=document.querySelector(e),r=t,a=null):o&&u&&d?(n=document.querySelector(e),r=t,a=i):o&&u&&f?(n=document.querySelector(e),r=t,a=this._getOptionObject(i)):o&&u&&v?(n=document.querySelector(e),r=t,a=this.mergeOptions(i)):s&&u&&d?(n=e,r=t,a=i):s&&u&&f?(n=e,r=t,a=this._getOptionObject(i)):s&&u&&v?(n=e,r=t,a=this.mergeOptions(i)):D.throwError("The parameters given to the AutoNumeric object are not valid, '".concat(e,"', '").concat(t,"' and '").concat(i,"' given.")),D.isNull(n)&&D.throwError("The selector '".concat(e,"' did not select any valid DOM element. Please check on which element you called AutoNumeric.")),{domElement:n,initialValue:r,userOptions:a}}},{key:"mergeOptions",value:function(e){var t=this,i={};return e.forEach(function(e){y(i,t._getOptionObject(e))}),i}},{key:"_isPreDefinedOptionValid",value:function(e){return Object.prototype.hasOwnProperty.call(I.predefinedOptions,e)}},{key:"_getOptionObject",value:function(e){var t;return D.isString(e)?null==(t=I.getPredefinedOptions()[e])&&D.warning("The given pre-defined option [".concat(e,"] is not recognized by autoNumeric. Please check that pre-defined option name."),!0):t=e,t}},{key:"_doesFormHandlerListExists",value:function(){var e=b(window.aNFormHandlerMap);return"undefined"!==e&&"object"===e}},{key:"_createFormHandlerList",value:function(){window.aNFormHandlerMap=new Map}},{key:"_checkValuesToStringsArray",value:function(e,t){return D.isInArray(String(e),t)}},{key:"_checkValuesToStringsSettings",value:function(e,t){return this._checkValuesToStringsArray(e,Object.keys(t.valuesToStrings))}},{key:"_checkStringsToValuesSettings",value:function(e,t){return this._checkValuesToStringsArray(e,Object.values(t.valuesToStrings))}},{key:"_unformatAltHovered",value:function(e){e.hoveredWithAlt=!0,e.unformat()}},{key:"_reformatAltHovered",value:function(e){e.hoveredWithAlt=!1,e.reformat()}},{key:"_getChildANInputElement",value:function(e){var t=this,i=e.getElementsByTagName("input"),n=[];return Array.prototype.slice.call(i,0).forEach(function(e){t.test(e)&&n.push(e)}),n}},{key:"test",value:function(e){return this._isInGlobalList(D.domElement(e))}},{key:"_createWeakMap",value:function(e){window[e]=new WeakMap}},{key:"_createGlobalList",value:function(){this.autoNumericGlobalListName="autoNumericGlobalList",this._createWeakMap(this.autoNumericGlobalListName)}},{key:"_doesGlobalListExists",value:function(){var e=b(window[this.autoNumericGlobalListName]);return"undefined"!==e&&"object"===e}},{key:"_addToGlobalList",value:function(e){this._doesGlobalListExists()||this._createGlobalList();var t=e.node();if(this._isInGlobalList(t)){if(this._getFromGlobalList(t)===this)return;D.warning("A reference to the DOM element you just initialized already exists in the global AutoNumeric element list. Please make sure to not initialize the same DOM element multiple times.",e.getSettings().showWarnings)}window[this.autoNumericGlobalListName].set(t,e)}},{key:"_removeFromGlobalList",value:function(e){this._doesGlobalListExists()&&window[this.autoNumericGlobalListName].delete(e.node())}},{key:"_getFromGlobalList",value:function(e){return this._doesGlobalListExists()?window[this.autoNumericGlobalListName].get(e):null}},{key:"_isInGlobalList",value:function(e){return!!this._doesGlobalListExists()&&window[this.autoNumericGlobalListName].has(e)}},{key:"validate",value:function(e,t,i){var n=!(1<arguments.length&&void 0!==t)||t,a=2<arguments.length&&void 0!==i?i:null;!D.isUndefinedOrNullOrEmpty(e)&&D.isObject(e)||D.throwError("The userOptions are invalid ; it should be a valid object, [".concat(e,"] given."));var r,s=D.isObject(a);s||D.isNull(a)||D.throwError("The 'originalOptions' parameter is invalid ; it should either be a valid option object or `null`, [".concat(e,"] given.")),D.isNull(e)||this._convertOldOptionsToNewOnes(e),r=n?y({},this.getDefaultConfig(),e):e,D.isTrueOrFalseString(r.showWarnings)||D.isBoolean(r.showWarnings)||D.throwError("The debug option 'showWarnings' is invalid ; it should be either 'true' or 'false', [".concat(r.showWarnings,"] given."));var o,l=/^[0-9]+$/,c=/[0-9]+/,u=/^-?[0-9]+(\.?[0-9]+)?$/,h=/^[0-9]+(\.?[0-9]+)?$/;D.isTrueOrFalseString(r.allowDecimalPadding)||D.isBoolean(r.allowDecimalPadding)||r.allowDecimalPadding===I.options.allowDecimalPadding.floats||D.throwError("The decimal padding option 'allowDecimalPadding' is invalid ; it should either be `false`, `true` or `'floats'`, [".concat(r.allowDecimalPadding,"] given.")),r.allowDecimalPadding!==I.options.allowDecimalPadding.never&&"false"!==r.allowDecimalPadding||r.decimalPlaces===I.options.decimalPlaces.none&&r.decimalPlacesShownOnBlur===I.options.decimalPlacesShownOnBlur.none&&r.decimalPlacesShownOnFocus===I.options.decimalPlacesShownOnFocus.none||D.warning("Setting 'allowDecimalPadding' to [".concat(r.allowDecimalPadding,"] will override the current 'decimalPlaces*' settings [").concat(r.decimalPlaces,", ").concat(r.decimalPlacesShownOnBlur," and ").concat(r.decimalPlacesShownOnFocus,"]."),r.showWarnings),D.isTrueOrFalseString(r.alwaysAllowDecimalCharacter)||D.isBoolean(r.alwaysAllowDecimalCharacter)||D.throwError("The option 'alwaysAllowDecimalCharacter' is invalid ; it should either be `true` or `false`, [".concat(r.alwaysAllowDecimalCharacter,"] given.")),D.isNull(r.caretPositionOnFocus)||D.isInArray(r.caretPositionOnFocus,[I.options.caretPositionOnFocus.start,I.options.caretPositionOnFocus.end,I.options.caretPositionOnFocus.decimalLeft,I.options.caretPositionOnFocus.decimalRight])||D.throwError("The display on empty string option 'caretPositionOnFocus' is invalid ; it should either be `null`, 'focus', 'press', 'always' or 'zero', [".concat(r.caretPositionOnFocus,"] given.")),o=s?a:this._correctCaretPositionOnFocusAndSelectOnFocusOptions(e),D.isNull(o)||o.caretPositionOnFocus===I.options.caretPositionOnFocus.doNoForceCaretPosition||o.selectOnFocus!==I.options.selectOnFocus.select||D.warning("The 'selectOnFocus' option is set to 'select', which is in conflict with the 'caretPositionOnFocus' which is set to '".concat(o.caretPositionOnFocus,"'. As a result, if this has been called when instantiating an AutoNumeric object, the 'selectOnFocus' option is forced to 'doNotSelect'."),r.showWarnings),D.isInArray(r.digitGroupSeparator,[I.options.digitGroupSeparator.comma,I.options.digitGroupSeparator.dot,I.options.digitGroupSeparator.normalSpace,I.options.digitGroupSeparator.thinSpace,I.options.digitGroupSeparator.narrowNoBreakSpace,I.options.digitGroupSeparator.noBreakSpace,I.options.digitGroupSeparator.noSeparator,I.options.digitGroupSeparator.apostrophe,I.options.digitGroupSeparator.arabicThousandsSeparator,I.options.digitGroupSeparator.dotAbove,I.options.digitGroupSeparator.privateUseTwo])||D.throwError("The thousand separator character option 'digitGroupSeparator' is invalid ; it should be ',', '.', '٬', '˙', \"'\", '', ' ', ' ', ' ', ' ' or empty (''), [".concat(r.digitGroupSeparator,"] given.")),D.isTrueOrFalseString(r.showOnlyNumbersOnFocus)||D.isBoolean(r.showOnlyNumbersOnFocus)||D.throwError("The 'showOnlyNumbersOnFocus' option is invalid ; it should be either 'true' or 'false', [".concat(r.showOnlyNumbersOnFocus,"] given.")),D.isInArray(r.digitalGroupSpacing,[I.options.digitalGroupSpacing.two,I.options.digitalGroupSpacing.twoScaled,I.options.digitalGroupSpacing.three,I.options.digitalGroupSpacing.four])||2<=r.digitalGroupSpacing&&r.digitalGroupSpacing<=4||D.throwError("The grouping separator option for thousands 'digitalGroupSpacing' is invalid ; it should be '2', '2s', '3', or '4', [".concat(r.digitalGroupSpacing,"] given.")),D.isInArray(r.decimalCharacter,[I.options.decimalCharacter.comma,I.options.decimalCharacter.dot,I.options.decimalCharacter.middleDot,I.options.decimalCharacter.arabicDecimalSeparator,I.options.decimalCharacter.decimalSeparatorKeySymbol])||D.throwError("The decimal separator character option 'decimalCharacter' is invalid ; it should be '.', ',', '·', '⎖' or '٫', [".concat(r.decimalCharacter,"] given.")),r.decimalCharacter===r.digitGroupSeparator&&D.throwError("autoNumeric will not function properly when the decimal character 'decimalCharacter' [".concat(r.decimalCharacter,"] and the thousand separator 'digitGroupSeparator' [").concat(r.digitGroupSeparator,"] are the same character.")),D.isNull(r.decimalCharacterAlternative)||D.isString(r.decimalCharacterAlternative)||D.throwError("The alternate decimal separator character option 'decimalCharacterAlternative' is invalid ; it should be a string, [".concat(r.decimalCharacterAlternative,"] given.")),""===r.currencySymbol||D.isString(r.currencySymbol)||D.throwError("The currency symbol option 'currencySymbol' is invalid ; it should be a string, [".concat(r.currencySymbol,"] given.")),D.isInArray(r.currencySymbolPlacement,[I.options.currencySymbolPlacement.prefix,I.options.currencySymbolPlacement.suffix])||D.throwError("The placement of the currency sign option 'currencySymbolPlacement' is invalid ; it should either be 'p' (prefix) or 's' (suffix), [".concat(r.currencySymbolPlacement,"] given.")),D.isInArray(r.negativePositiveSignPlacement,[I.options.negativePositiveSignPlacement.prefix,I.options.negativePositiveSignPlacement.suffix,I.options.negativePositiveSignPlacement.left,I.options.negativePositiveSignPlacement.right,I.options.negativePositiveSignPlacement.none])||D.throwError("The placement of the negative sign option 'negativePositiveSignPlacement' is invalid ; it should either be 'p' (prefix), 's' (suffix), 'l' (left), 'r' (right) or 'null', [".concat(r.negativePositiveSignPlacement,"] given.")),D.isTrueOrFalseString(r.showPositiveSign)||D.isBoolean(r.showPositiveSign)||D.throwError("The show positive sign option 'showPositiveSign' is invalid ; it should be either 'true' or 'false', [".concat(r.showPositiveSign,"] given.")),D.isString(r.suffixText)&&(""===r.suffixText||!D.isNegative(r.suffixText,r.negativeSignCharacter)&&!c.test(r.suffixText))||D.throwError("The additional suffix option 'suffixText' is invalid ; it should not contains the negative sign '".concat(r.negativeSignCharacter,"' nor any numerical characters, [").concat(r.suffixText,"] given.")),D.isString(r.negativeSignCharacter)&&1===r.negativeSignCharacter.length&&!D.isUndefinedOrNullOrEmpty(r.negativeSignCharacter)&&!c.test(r.negativeSignCharacter)||D.throwError("The negative sign character option 'negativeSignCharacter' is invalid ; it should be a single character, and cannot be any numerical characters, [".concat(r.negativeSignCharacter,"] given.")),D.isString(r.positiveSignCharacter)&&1===r.positiveSignCharacter.length&&!D.isUndefinedOrNullOrEmpty(r.positiveSignCharacter)&&!c.test(r.positiveSignCharacter)||D.throwError("The positive sign character option 'positiveSignCharacter' is invalid ; it should be a single character, and cannot be any numerical characters, [".concat(r.positiveSignCharacter,"] given.\nIf you want to hide the positive sign character, you need to set the `showPositiveSign` option to `true`.")),r.negativeSignCharacter===r.positiveSignCharacter&&D.throwError("The positive 'positiveSignCharacter' and negative 'negativeSignCharacter' sign characters cannot be identical ; [".concat(r.negativeSignCharacter,"] given."));var m=S(D.isNull(r.negativeBracketsTypeOnBlur)?["",""]:r.negativeBracketsTypeOnBlur.split(","),2),g=m[0],d=m[1];if((D.contains(r.digitGroupSeparator,r.negativeSignCharacter)||D.contains(r.decimalCharacter,r.negativeSignCharacter)||D.contains(r.decimalCharacterAlternative,r.negativeSignCharacter)||D.contains(g,r.negativeSignCharacter)||D.contains(d,r.negativeSignCharacter)||D.contains(r.suffixText,r.negativeSignCharacter))&&D.throwError("The negative sign character option 'negativeSignCharacter' is invalid ; it should not be equal or a part of the digit separator, the decimal character, the decimal character alternative, the negative brackets or the suffix text, [".concat(r.negativeSignCharacter,"] given.")),(D.contains(r.digitGroupSeparator,r.positiveSignCharacter)||D.contains(r.decimalCharacter,r.positiveSignCharacter)||D.contains(r.decimalCharacterAlternative,r.positiveSignCharacter)||D.contains(g,r.positiveSignCharacter)||D.contains(d,r.positiveSignCharacter)||D.contains(r.suffixText,r.positiveSignCharacter))&&D.throwError("The positive sign character option 'positiveSignCharacter' is invalid ; it should not be equal or a part of the digit separator, the decimal character, the decimal character alternative, the negative brackets or the suffix text, [".concat(r.positiveSignCharacter,"] given.")),D.isNull(r.overrideMinMaxLimits)||D.isInArray(r.overrideMinMaxLimits,[I.options.overrideMinMaxLimits.ceiling,I.options.overrideMinMaxLimits.floor,I.options.overrideMinMaxLimits.ignore])||D.throwError("The override min & max limits option 'overrideMinMaxLimits' is invalid ; it should either be 'ceiling', 'floor' or 'ignore', [".concat(r.overrideMinMaxLimits,"] given.")),D.isString(r.maximumValue)&&u.test(r.maximumValue)||D.throwError("The maximum possible value option 'maximumValue' is invalid ; it should be a string that represents a positive or negative number, [".concat(r.maximumValue,"] given.")),D.isString(r.minimumValue)&&u.test(r.minimumValue)||D.throwError("The minimum possible value option 'minimumValue' is invalid ; it should be a string that represents a positive or negative number, [".concat(r.minimumValue,"] given.")),parseFloat(r.minimumValue)>parseFloat(r.maximumValue)&&D.throwError("The minimum possible value option is greater than the maximum possible value option ; 'minimumValue' [".concat(r.minimumValue,"] should be smaller than 'maximumValue' [").concat(r.maximumValue,"].")),D.isInt(r.decimalPlaces)&&0<=r.decimalPlaces||D.isString(r.decimalPlaces)&&l.test(r.decimalPlaces)||D.throwError("The number of decimal places option 'decimalPlaces' is invalid ; it should be a positive integer, [".concat(r.decimalPlaces,"] given.")),D.isNull(r.decimalPlacesRawValue)||D.isInt(r.decimalPlacesRawValue)&&0<=r.decimalPlacesRawValue||D.isString(r.decimalPlacesRawValue)&&l.test(r.decimalPlacesRawValue)||D.throwError("The number of decimal places for the raw value option 'decimalPlacesRawValue' is invalid ; it should be a positive integer or `null`, [".concat(r.decimalPlacesRawValue,"] given.")),this._validateDecimalPlacesRawValue(r),D.isNull(r.decimalPlacesShownOnFocus)||l.test(String(r.decimalPlacesShownOnFocus))||D.throwError("The number of expanded decimal places option 'decimalPlacesShownOnFocus' is invalid ; it should be a positive integer or `null`, [".concat(r.decimalPlacesShownOnFocus,"] given.")),!D.isNull(r.decimalPlacesShownOnFocus)&&Number(r.decimalPlaces)>Number(r.decimalPlacesShownOnFocus)&&D.warning("The extended decimal places 'decimalPlacesShownOnFocus' [".concat(r.decimalPlacesShownOnFocus,"] should be greater than the 'decimalPlaces' [").concat(r.decimalPlaces,"] value. Currently, this will limit the ability of your user to manually change some of the decimal places. Do you really want to do that?"),r.showWarnings),(D.isNull(r.divisorWhenUnfocused)||h.test(r.divisorWhenUnfocused))&&0!==r.divisorWhenUnfocused&&"0"!==r.divisorWhenUnfocused&&1!==r.divisorWhenUnfocused&&"1"!==r.divisorWhenUnfocused||D.throwError("The divisor option 'divisorWhenUnfocused' is invalid ; it should be a positive number higher than one, preferably an integer, [".concat(r.divisorWhenUnfocused,"] given.")),D.isNull(r.decimalPlacesShownOnBlur)||l.test(r.decimalPlacesShownOnBlur)||D.throwError("The number of decimals shown when unfocused option 'decimalPlacesShownOnBlur' is invalid ; it should be a positive integer or `null`, [".concat(r.decimalPlacesShownOnBlur,"] given.")),D.isNull(r.symbolWhenUnfocused)||D.isString(r.symbolWhenUnfocused)||D.throwError("The symbol to show when unfocused option 'symbolWhenUnfocused' is invalid ; it should be a string, [".concat(r.symbolWhenUnfocused,"] given.")),D.isTrueOrFalseString(r.saveValueToSessionStorage)||D.isBoolean(r.saveValueToSessionStorage)||D.throwError("The save to session storage option 'saveValueToSessionStorage' is invalid ; it should be either 'true' or 'false', [".concat(r.saveValueToSessionStorage,"] given.")),D.isInArray(r.onInvalidPaste,[I.options.onInvalidPaste.error,I.options.onInvalidPaste.ignore,I.options.onInvalidPaste.clamp,I.options.onInvalidPaste.truncate,I.options.onInvalidPaste.replace])||D.throwError("The paste behavior option 'onInvalidPaste' is invalid ; it should either be 'error', 'ignore', 'clamp', 'truncate' or 'replace' (cf. documentation), [".concat(r.onInvalidPaste,"] given.")),D.isInArray(r.roundingMethod,[I.options.roundingMethod.halfUpSymmetric,I.options.roundingMethod.halfUpAsymmetric,I.options.roundingMethod.halfDownSymmetric,I.options.roundingMethod.halfDownAsymmetric,I.options.roundingMethod.halfEvenBankersRounding,I.options.roundingMethod.upRoundAwayFromZero,I.options.roundingMethod.downRoundTowardZero,I.options.roundingMethod.toCeilingTowardPositiveInfinity,I.options.roundingMethod.toFloorTowardNegativeInfinity,I.options.roundingMethod.toNearest05,I.options.roundingMethod.toNearest05Alt,I.options.roundingMethod.upToNext05,I.options.roundingMethod.downToNext05])||D.throwError("The rounding method option 'roundingMethod' is invalid ; it should either be 'S', 'A', 's', 'a', 'B', 'U', 'D', 'C', 'F', 'N05', 'CHF', 'U05' or 'D05' (cf. documentation), [".concat(r.roundingMethod,"] given.")),D.isNull(r.negativeBracketsTypeOnBlur)||D.isInArray(r.negativeBracketsTypeOnBlur,[I.options.negativeBracketsTypeOnBlur.parentheses,I.options.negativeBracketsTypeOnBlur.brackets,I.options.negativeBracketsTypeOnBlur.chevrons,I.options.negativeBracketsTypeOnBlur.curlyBraces,I.options.negativeBracketsTypeOnBlur.angleBrackets,I.options.negativeBracketsTypeOnBlur.japaneseQuotationMarks,I.options.negativeBracketsTypeOnBlur.halfBrackets,I.options.negativeBracketsTypeOnBlur.whiteSquareBrackets,I.options.negativeBracketsTypeOnBlur.quotationMarks,I.options.negativeBracketsTypeOnBlur.guillemets])||D.throwError("The brackets for negative values option 'negativeBracketsTypeOnBlur' is invalid ; it should either be '(,)', '[,]', '<,>', '{,}', '〈,〉', '｢,｣', '⸤,⸥', '⟦,⟧', '‹,›' or '«,»', [".concat(r.negativeBracketsTypeOnBlur,"] given.")),(D.isString(r.emptyInputBehavior)||D.isNumber(r.emptyInputBehavior))&&(D.isInArray(r.emptyInputBehavior,[I.options.emptyInputBehavior.focus,I.options.emptyInputBehavior.press,I.options.emptyInputBehavior.always,I.options.emptyInputBehavior.min,I.options.emptyInputBehavior.max,I.options.emptyInputBehavior.zero,I.options.emptyInputBehavior.null])||u.test(r.emptyInputBehavior))||D.throwError("The display on empty string option 'emptyInputBehavior' is invalid ; it should either be 'focus', 'press', 'always', 'min', 'max', 'zero', 'null', a number, or a string that represents a number, [".concat(r.emptyInputBehavior,"] given.")),r.emptyInputBehavior===I.options.emptyInputBehavior.zero&&(0<r.minimumValue||r.maximumValue<0)&&D.throwError("The 'emptyInputBehavior' option is set to 'zero', but this value is outside of the range defined by 'minimumValue' and 'maximumValue' [".concat(r.minimumValue,", ").concat(r.maximumValue,"].")),u.test(String(r.emptyInputBehavior))){var v=S(this._checkIfInRangeWithOverrideOption(r.emptyInputBehavior,r),2),p=v[0],f=v[1];p&&f||D.throwError("The 'emptyInputBehavior' option is set to a number or a string that represents a number, but its value [".concat(r.emptyInputBehavior,"] is outside of the range defined by the 'minimumValue' and 'maximumValue' options [").concat(r.minimumValue,", ").concat(r.maximumValue,"]."))}D.isTrueOrFalseString(r.eventBubbles)||D.isBoolean(r.eventBubbles)||D.throwError("The event bubbles option 'eventBubbles' is invalid ; it should be either 'true' or 'false', [".concat(r.eventBubbles,"] given.")),D.isTrueOrFalseString(r.eventIsCancelable)||D.isBoolean(r.eventIsCancelable)||D.throwError("The event is cancelable option 'eventIsCancelable' is invalid ; it should be either 'true' or 'false', [".concat(r.eventIsCancelable,"] given.")),D.isInArray(r.leadingZero,[I.options.leadingZero.allow,I.options.leadingZero.deny,I.options.leadingZero.keep])||D.throwError("The leading zero behavior option 'leadingZero' is invalid ; it should either be 'allow', 'deny' or 'keep', [".concat(r.leadingZero,"] given.")),D.isTrueOrFalseString(r.formatOnPageLoad)||D.isBoolean(r.formatOnPageLoad)||D.throwError("The format on initialization option 'formatOnPageLoad' is invalid ; it should be either 'true' or 'false', [".concat(r.formatOnPageLoad,"] given.")),D.isTrueOrFalseString(r.formulaMode)||D.isBoolean(r.formulaMode)||D.throwError("The formula mode option 'formulaMode' is invalid ; it should be either 'true' or 'false', [".concat(r.formulaMode,"] given.")),l.test(r.historySize)&&0!==r.historySize||D.throwError("The history size option 'historySize' is invalid ; it should be a positive integer, [".concat(r.historySize,"] given.")),D.isTrueOrFalseString(r.selectNumberOnly)||D.isBoolean(r.selectNumberOnly)||D.throwError("The select number only option 'selectNumberOnly' is invalid ; it should be either 'true' or 'false', [".concat(r.selectNumberOnly,"] given.")),D.isTrueOrFalseString(r.selectOnFocus)||D.isBoolean(r.selectOnFocus)||D.throwError("The select on focus option 'selectOnFocus' is invalid ; it should be either 'true' or 'false', [".concat(r.selectOnFocus,"] given.")),D.isNull(r.defaultValueOverride)||""===r.defaultValueOverride||u.test(r.defaultValueOverride)||D.throwError("The unformatted default value option 'defaultValueOverride' is invalid ; it should be a string that represents a positive or negative number, [".concat(r.defaultValueOverride,"] given.")),D.isTrueOrFalseString(r.unformatOnSubmit)||D.isBoolean(r.unformatOnSubmit)||D.throwError("The remove formatting on submit option 'unformatOnSubmit' is invalid ; it should be either 'true' or 'false', [".concat(r.unformatOnSubmit,"] given.")),D.isNull(r.valuesToStrings)||D.isObject(r.valuesToStrings)||D.throwError("The option 'valuesToStrings' is invalid ; it should be an object, ideally with 'key -> value' entries, [".concat(r.valuesToStrings,"] given.")),D.isNull(r.outputFormat)||D.isInArray(r.outputFormat,[I.options.outputFormat.string,I.options.outputFormat.number,I.options.outputFormat.dot,I.options.outputFormat.negativeDot,I.options.outputFormat.comma,I.options.outputFormat.negativeComma,I.options.outputFormat.dotNegative,I.options.outputFormat.commaNegative])||D.throwError("The custom locale format option 'outputFormat' is invalid ; it should either be null, 'string', 'number', '.', '-.', ',', '-,', '.-' or ',-', [".concat(r.outputFormat,"] given.")),D.isTrueOrFalseString(r.isCancellable)||D.isBoolean(r.isCancellable)||D.throwError("The cancellable behavior option 'isCancellable' is invalid ; it should be either 'true' or 'false', [".concat(r.isCancellable,"] given.")),D.isTrueOrFalseString(r.modifyValueOnWheel)||D.isBoolean(r.modifyValueOnWheel)||D.throwError("The increment/decrement on mouse wheel option 'modifyValueOnWheel' is invalid ; it should be either 'true' or 'false', [".concat(r.modifyValueOnWheel,"] given.")),D.isTrueOrFalseString(r.watchExternalChanges)||D.isBoolean(r.watchExternalChanges)||D.throwError("The option 'watchExternalChanges' is invalid ; it should be either 'true' or 'false', [".concat(r.watchExternalChanges,"] given.")),D.isInArray(r.wheelOn,[I.options.wheelOn.focus,I.options.wheelOn.hover])||D.throwError("The wheel behavior option 'wheelOn' is invalid ; it should either be 'focus' or 'hover', [".concat(r.wheelOn,"] given.")),(D.isString(r.wheelStep)||D.isNumber(r.wheelStep))&&("progressive"===r.wheelStep||h.test(r.wheelStep))&&0!==Number(r.wheelStep)||D.throwError("The wheel step value option 'wheelStep' is invalid ; it should either be the string 'progressive', or a number or a string that represents a positive number (excluding zero), [".concat(r.wheelStep,"] given.")),D.isInArray(r.serializeSpaces,[I.options.serializeSpaces.plus,I.options.serializeSpaces.percent])||D.throwError("The space replacement character option 'serializeSpaces' is invalid ; it should either be '+' or '%20', [".concat(r.serializeSpaces,"] given.")),D.isTrueOrFalseString(r.noEventListeners)||D.isBoolean(r.noEventListeners)||D.throwError("The option 'noEventListeners' that prevent the creation of event listeners is invalid ; it should be either 'true' or 'false', [".concat(r.noEventListeners,"] given.")),D.isNull(r.styleRules)||D.isObject(r.styleRules)&&(Object.prototype.hasOwnProperty.call(r.styleRules,"positive")||Object.prototype.hasOwnProperty.call(r.styleRules,"negative")||Object.prototype.hasOwnProperty.call(r.styleRules,"ranges")||Object.prototype.hasOwnProperty.call(r.styleRules,"userDefined"))||D.throwError("The option 'styleRules' is invalid ; it should be a correctly structured object, with one or more 'positive', 'negative', 'ranges' or 'userDefined' attributes, [".concat(r.styleRules,"] given.")),D.isNull(r.styleRules)||!Object.prototype.hasOwnProperty.call(r.styleRules,"userDefined")||D.isNull(r.styleRules.userDefined)||r.styleRules.userDefined.forEach(function(e){Object.prototype.hasOwnProperty.call(e,"callback")&&!D.isFunction(e.callback)&&D.throwError("The callback defined in the `userDefined` attribute is not a function, ".concat(b(e.callback)," given."))}),(D.isNull(r.rawValueDivisor)||h.test(r.rawValueDivisor))&&0!==r.rawValueDivisor&&"0"!==r.rawValueDivisor&&1!==r.rawValueDivisor&&"1"!==r.rawValueDivisor||D.throwError("The raw value divisor option 'rawValueDivisor' is invalid ; it should be a positive number higher than one, preferably an integer, [".concat(r.rawValueDivisor,"] given.")),D.isTrueOrFalseString(r.readOnly)||D.isBoolean(r.readOnly)||D.throwError("The option 'readOnly' is invalid ; it should be either 'true' or 'false', [".concat(r.readOnly,"] given.")),D.isTrueOrFalseString(r.unformatOnHover)||D.isBoolean(r.unformatOnHover)||D.throwError("The option 'unformatOnHover' is invalid ; it should be either 'true' or 'false', [".concat(r.unformatOnHover,"] given.")),D.isTrueOrFalseString(r.failOnUnknownOption)||D.isBoolean(r.failOnUnknownOption)||D.throwError("The debug option 'failOnUnknownOption' is invalid ; it should be either 'true' or 'false', [".concat(r.failOnUnknownOption,"] given.")),D.isTrueOrFalseString(r.createLocalList)||D.isBoolean(r.createLocalList)||D.throwError("The debug option 'createLocalList' is invalid ; it should be either 'true' or 'false', [".concat(r.createLocalList,"] given."))}},{key:"_validateDecimalPlacesRawValue",value:function(e){D.isNull(e.decimalPlacesRawValue)||(e.decimalPlacesRawValue<e.decimalPlaces&&D.warning("The number of decimal places to store in the raw value [".concat(e.decimalPlacesRawValue,"] is lower than the ones to display [").concat(e.decimalPlaces,"]. This will likely confuse your users.\nTo solve that, you'd need to either set `decimalPlacesRawValue` to `null`, or set a number of decimal places for the raw value equal of bigger than `decimalPlaces`."),e.showWarnings),e.decimalPlacesRawValue<e.decimalPlacesShownOnFocus&&D.warning("The number of decimal places to store in the raw value [".concat(e.decimalPlacesRawValue,"] is lower than the ones shown on focus [").concat(e.decimalPlacesShownOnFocus,"]. This will likely confuse your users.\nTo solve that, you'd need to either set `decimalPlacesRawValue` to `null`, or set a number of decimal places for the raw value equal of bigger than `decimalPlacesShownOnFocus`."),e.showWarnings),e.decimalPlacesRawValue<e.decimalPlacesShownOnBlur&&D.warning("The number of decimal places to store in the raw value [".concat(e.decimalPlacesRawValue,"] is lower than the ones shown when unfocused [").concat(e.decimalPlacesShownOnBlur,"]. This will likely confuse your users.\nTo solve that, you'd need to either set `decimalPlacesRawValue` to `null`, or set a number of decimal places for the raw value equal of bigger than `decimalPlacesShownOnBlur`."),e.showWarnings))}},{key:"areSettingsValid",value:function(e){var t=!0;try{this.validate(e,!0)}catch(e){t=!1}return t}},{key:"getDefaultConfig",value:function(){return I.defaultSettings}},{key:"getPredefinedOptions",value:function(){return I.predefinedOptions}},{key:"_generateOptionsObjectFromOptionsArray",value:function(e){var t,i=this;return D.isUndefinedOrNullOrEmpty(e)||0===e.length?t=null:(t={},1===e.length&&Array.isArray(e[0])?e[0].forEach(function(e){y(t,i._getOptionObject(e))}):1<=e.length&&e.forEach(function(e){y(t,i._getOptionObject(e))})),t}},{key:"format",value:function(e){if(D.isUndefined(e)||null===e)return null;var t;t=D.isElement(e)?D.getElementValue(e):e,D.isString(t)||D.isNumber(t)||D.throwError('The value "'.concat(t,'" being "set" is not numeric and therefore cannot be used appropriately.'));for(var i=arguments.length,n=new Array(1<i?i-1:0),a=1;a<i;a++)n[a-1]=arguments[a];var r=this._generateOptionsObjectFromOptionsArray(n),s=y({},this.getDefaultConfig(),r);s.isNegativeSignAllowed=t<0,s.isPositiveSignAllowed=0<=t,this._setBrackets(s),this._cachesUsualRegularExpressions(s,{});var o=this._toNumericValue(t,s);isNaN(Number(o))&&D.throwError("The value [".concat(o,"] that you are trying to format is not a recognized number."));var l=S(this._checkIfInRangeWithOverrideOption(o,s),2),c=l[0],u=l[1];return c&&u||(D.triggerEvent(I.events.formatted,document,{oldValue:null,newValue:null,oldRawValue:null,newRawValue:null,isPristine:null,error:"Range test failed",aNElement:null},!0,!0),D.throwError("The value [".concat(o,"] being set falls outside of the minimumValue [").concat(s.minimumValue,"] and maximumValue [").concat(s.maximumValue,"] range set for this element"))),s.valuesToStrings&&this._checkValuesToStringsSettings(t,s)?s.valuesToStrings[t]:(this._correctNegativePositiveSignPlacementOption(s),this._calculateDecimalPlacesOnInit(s),D.isUndefinedOrNullOrEmpty(s.rawValueDivisor)||0===s.rawValueDivisor||""===o||null===o||(o*=s.rawValueDivisor),o=this._roundFormattedValueShownOnFocus(o,s),o=this._modifyNegativeSignAndDecimalCharacterForFormattedValue(o,s),o=this._addGroupSeparators(o,s,!1,o))}},{key:"formatAndSet",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null,n=this.format(e,i);return D.setElementValue(e,n),n}},{key:"unformat",value:function(e){if(D.isNumberStrict(e))return e;var t;if(""===(t=D.isElement(e)?D.getElementValue(e):e))return"";if(D.isUndefined(t)||null===t)return null;(D.isArray(t)||D.isObject(t))&&D.throwError("A number or a string representing a number is needed to be able to unformat it, [".concat(t,"] given."));for(var i=arguments.length,n=new Array(1<i?i-1:0),a=1;a<i;a++)n[a-1]=arguments[a];var r=this._generateOptionsObjectFromOptionsArray(n),s=y({},this.getDefaultConfig(),r);if(s.isNegativeSignAllowed=!1,s.isPositiveSignAllowed=!0,t=t.toString(),s.valuesToStrings&&this._checkStringsToValuesSettings(t,s))return D.objectKeyLookup(s.valuesToStrings,t);if(D.isNegative(t,s.negativeSignCharacter))s.isNegativeSignAllowed=!0,s.isPositiveSignAllowed=!1;else if(!D.isNull(s.negativeBracketsTypeOnBlur)){var o=S(s.negativeBracketsTypeOnBlur.split(","),2);s.firstBracket=o[0],s.lastBracket=o[1],t.charAt(0)===s.firstBracket&&t.charAt(t.length-1)===s.lastBracket&&(s.isNegativeSignAllowed=!0,s.isPositiveSignAllowed=!1,t=this._removeBrackets(t,s,!1))}return t=this._convertToNumericString(t,s),new RegExp("[^+-0123456789.]","gi").test(t)?NaN:(this._correctNegativePositiveSignPlacementOption(s),s.decimalPlacesRawValue?s.originalDecimalPlacesRawValue=s.decimalPlacesRawValue:s.originalDecimalPlacesRawValue=s.decimalPlaces,this._calculateDecimalPlacesOnInit(s),D.isUndefinedOrNullOrEmpty(s.rawValueDivisor)||0===s.rawValueDivisor||""===t||null===t||(t/=s.rawValueDivisor),t=(t=this._roundRawValue(t,s)).replace(s.decimalCharacter,"."),t=this._toLocale(t,s.outputFormat,s))}},{key:"unformatAndSet",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null,n=this.unformat(e,i);return D.setElementValue(e,n),n}},{key:"localize",value:function(e,t){var i,n,a=1<arguments.length&&void 0!==t?t:null;return""===(i=D.isElement(e)?D.getElementValue(e):e)?"":(D.isNull(a)&&(a=I.defaultSettings),i=this.unformat(i,a),0===Number(i)&&a.leadingZero!==I.options.leadingZero.keep&&(i="0"),n=D.isNull(a)?a.outputFormat:I.defaultSettings.outputFormat,this._toLocale(i,n,a))}},{key:"localizeAndSet",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null,n=this.localize(e,i);return D.setElementValue(e,n),n}},{key:"isManagedByAutoNumeric",value:function(e){return this._isInGlobalList(D.domElement(e))}},{key:"getAutoNumericElement",value:function(e){var t=D.domElement(e);return this.isManagedByAutoNumeric(t)?this._getFromGlobalList(t):null}},{key:"set",value:function(e,t,i,n){var a,r=2<arguments.length&&void 0!==i?i:null,s=!(3<arguments.length&&void 0!==n)||n,o=D.domElement(e);return this.isManagedByAutoNumeric(o)?this.getAutoNumericElement(o).set(t,r,s):(a=!(!D.isNull(r)&&Object.prototype.hasOwnProperty.call(r,"showWarnings"))||r.showWarnings,D.warning("Impossible to find an AutoNumeric object for the given DOM element or selector.",a),null)}},{key:"getNumericString",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return this._get(e,"getNumericString",i)}},{key:"getFormatted",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return this._get(e,"getFormatted",i)}},{key:"getNumber",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return this._get(e,"getNumber",i)}},{key:"_get",value:function(e,t,i){var n=2<arguments.length&&void 0!==i?i:null,a=D.domElement(e);return this.isManagedByAutoNumeric(a)||D.throwError("Impossible to find an AutoNumeric object for the given DOM element or selector."),this.getAutoNumericElement(a)[t](n)}},{key:"getLocalized",value:function(e,t,i){var n=1<arguments.length&&void 0!==t?t:null,a=2<arguments.length&&void 0!==i?i:null,r=D.domElement(e);return this.isManagedByAutoNumeric(r)||D.throwError("Impossible to find an AutoNumeric object for the given DOM element or selector."),this.getAutoNumericElement(r).getLocalized(n,a)}},{key:"_stripAllNonNumberCharacters",value:function(e,t,i,n){return this._stripAllNonNumberCharactersExceptCustomDecimalChar(e,t,i,n).replace(t.decimalCharacter,".")}},{key:"_stripAllNonNumberCharactersExceptCustomDecimalChar",value:function(e,t,i,n){var a=(e=(e=this._normalizeCurrencySuffixAndNegativeSignCharacters(e,t)).replace(t.allowedAutoStrip,"")).match(t.numRegAutoStrip);if(e=a?[a[1],a[2],a[3]].join(""):"",t.leadingZero===I.options.leadingZero.allow||t.leadingZero===I.options.leadingZero.keep){var r="",s=S(e.split(t.decimalCharacter),2),o=s[0],l=s[1],c=o;D.contains(c,t.negativeSignCharacter)&&(r=t.negativeSignCharacter,c=c.replace(t.negativeSignCharacter,"")),""===r&&c.length>t.mIntPos&&"0"===c.charAt(0)&&(c=c.slice(1)),""!==r&&c.length>t.mIntNeg&&"0"===c.charAt(0)&&(c=c.slice(1)),e="".concat(r).concat(c).concat(D.isUndefined(l)?"":t.decimalCharacter+l)}return(i&&t.leadingZero===I.options.leadingZero.deny||!n&&t.leadingZero===I.options.leadingZero.allow)&&(e=e.replace(t.stripReg,"$1$2")),e}},{key:"_toggleNegativeBracket",value:function(e,t,i){return i?this._removeBrackets(e,t):this._addBrackets(e,t)}},{key:"_addBrackets",value:function(e,t){return D.isNull(t.negativeBracketsTypeOnBlur)?e:"".concat(t.firstBracket).concat(e.replace(t.negativeSignCharacter,"")).concat(t.lastBracket)}},{key:"_removeBrackets",value:function(e,t,i){var n,a=!(2<arguments.length&&void 0!==i)||i;return D.isNull(t.negativeBracketsTypeOnBlur)||e.charAt(0)!==t.firstBracket?e:(n=(n=e.replace(t.firstBracket,"")).replace(t.lastBracket,""),a?(n=n.replace(t.currencySymbol,""),this._mergeCurrencySignNegativePositiveSignAndValue(n,t,!0,!1)):"".concat(t.negativeSignCharacter).concat(n))}},{key:"_setBrackets",value:function(e){if(D.isNull(e.negativeBracketsTypeOnBlur))e.firstBracket="",e.lastBracket="";else{var t=S(e.negativeBracketsTypeOnBlur.split(","),2),i=t[0],n=t[1];e.firstBracket=i,e.lastBracket=n}}},{key:"_convertToNumericString",value:function(e,t){e=this._removeBrackets(e,t,!1),e=(e=this._normalizeCurrencySuffixAndNegativeSignCharacters(e,t)).replace(new RegExp("[".concat(t.digitGroupSeparator,"]"),"g"),""),"."!==t.decimalCharacter&&(e=e.replace(t.decimalCharacter,".")),D.isNegative(e)&&e.lastIndexOf("-")===e.length-1&&(e=e.replace("-",""),e="-".concat(e)),t.showPositiveSign&&(e=e.replace(t.positiveSignCharacter,""));var i=t.leadingZero!==I.options.leadingZero.keep,n=D.arabicToLatinNumbers(e,i,!1,!1);return isNaN(n)||(e=n.toString()),e}},{key:"_normalizeCurrencySuffixAndNegativeSignCharacters",value:function(e,t){return e=String(e),t.currencySymbol!==I.options.currencySymbol.none&&(e=e.replace(t.currencySymbol,"")),t.suffixText!==I.options.suffixText.none&&(e=e.replace(t.suffixText,"")),t.negativeSignCharacter!==I.options.negativeSignCharacter.hyphen&&(e=e.replace(t.negativeSignCharacter,"-")),e}},{key:"_toLocale",value:function(e,t,i){if(D.isNull(t)||t===I.options.outputFormat.string)return e;var n;switch(t){case I.options.outputFormat.number:n=Number(e);break;case I.options.outputFormat.dotNegative:n=D.isNegative(e)?e.replace("-","")+"-":e;break;case I.options.outputFormat.comma:case I.options.outputFormat.negativeComma:n=e.replace(".",",");break;case I.options.outputFormat.commaNegative:n=e.replace(".",","),n=D.isNegative(n)?n.replace("-","")+"-":n;break;case I.options.outputFormat.dot:case I.options.outputFormat.negativeDot:n=e;break;default:D.throwError("The given outputFormat [".concat(t,"] option is not recognized."))}return t!==I.options.outputFormat.number&&"-"!==i.negativeSignCharacter&&(n=n.replace("-",i.negativeSignCharacter)),n}},{key:"_modifyNegativeSignAndDecimalCharacterForFormattedValue",value:function(e,t){return"-"!==t.negativeSignCharacter&&(e=e.replace("-",t.negativeSignCharacter)),"."!==t.decimalCharacter&&(e=e.replace(".",t.decimalCharacter)),e}},{key:"_isElementValueEmptyOrOnlyTheNegativeSign",value:function(e,t){return""===e||e===t.negativeSignCharacter}},{key:"_orderValueCurrencySymbolAndSuffixText",value:function(e,t,i){var n;if(t.emptyInputBehavior===I.options.emptyInputBehavior.always||i)switch(t.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.left:case I.options.negativePositiveSignPlacement.prefix:case I.options.negativePositiveSignPlacement.none:n=e+t.currencySymbol+t.suffixText;break;default:n=t.currencySymbol+e+t.suffixText}else n=e;return n}},{key:"_addGroupSeparators",value:function(e,t,i,n,a){var r,s=4<arguments.length&&void 0!==a?a:null;if(r=D.isNull(s)?D.isNegative(e,t.negativeSignCharacter)||D.isNegativeWithBrackets(e,t.firstBracket,t.lastBracket):s<0,e=this._stripAllNonNumberCharactersExceptCustomDecimalChar(e,t,!1,i),this._isElementValueEmptyOrOnlyTheNegativeSign(e,t))return this._orderValueCurrencySymbolAndSuffixText(e,t,!0);var o,l=D.isZeroOrHasNoValue(e);switch(r&&(e=e.replace("-","")),t.digitalGroupSpacing=t.digitalGroupSpacing.toString(),t.digitalGroupSpacing){case I.options.digitalGroupSpacing.two:o=/(\d)((\d)(\d{2}?)+)$/;break;case I.options.digitalGroupSpacing.twoScaled:o=/(\d)((?:\d{2}){0,2}\d{3}(?:(?:\d{2}){2}\d{3})*?)$/;break;case I.options.digitalGroupSpacing.four:o=/(\d)((\d{4}?)+)$/;break;case I.options.digitalGroupSpacing.three:default:o=/(\d)((\d{3}?)+)$/}var c,u=S(e.split(t.decimalCharacter),2),h=u[0],m=u[1];if(t.decimalCharacterAlternative&&D.isUndefined(m)){var g=S(e.split(t.decimalCharacterAlternative),2);h=g[0],m=g[1]}if(""!==t.digitGroupSeparator)for(;o.test(h);)h=h.replace(o,"$1".concat(t.digitGroupSeparator,"$2"));return e=0===(c=i?t.decimalPlacesShownOnFocus:t.decimalPlacesShownOnBlur)||D.isUndefined(m)?h:(m.length>c&&(m=m.substring(0,c)),"".concat(h).concat(t.decimalCharacter).concat(m)),e=I._mergeCurrencySignNegativePositiveSignAndValue(e,t,r,l),D.isNull(s)&&(s=n),null!==t.negativeBracketsTypeOnBlur&&(s<0||D.isNegativeStrict(e,t.negativeSignCharacter))&&(e=this._toggleNegativeBracket(e,t,i)),t.suffixText?"".concat(e).concat(t.suffixText):e}},{key:"_mergeCurrencySignNegativePositiveSignAndValue",value:function(e,t,i,n){var a,r="";if(i?r=t.negativeSignCharacter:t.showPositiveSign&&!n&&(r=t.positiveSignCharacter),t.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix)if(t.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(i||!i&&t.showPositiveSign&&!n))switch(t.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.prefix:case I.options.negativePositiveSignPlacement.left:a="".concat(r).concat(t.currencySymbol).concat(e);break;case I.options.negativePositiveSignPlacement.right:a="".concat(t.currencySymbol).concat(r).concat(e);break;case I.options.negativePositiveSignPlacement.suffix:a="".concat(t.currencySymbol).concat(e).concat(r)}else a=t.currencySymbol+e;else if(t.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix)if(t.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(i||!i&&t.showPositiveSign&&!n))switch(t.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.suffix:case I.options.negativePositiveSignPlacement.right:a="".concat(e).concat(t.currencySymbol).concat(r);break;case I.options.negativePositiveSignPlacement.left:a="".concat(e).concat(r).concat(t.currencySymbol);break;case I.options.negativePositiveSignPlacement.prefix:a="".concat(r).concat(e).concat(t.currencySymbol)}else a=e+t.currencySymbol;return a}},{key:"_truncateZeros",value:function(e,t){var i;switch(t){case 0:i=/(\.(?:\d*[1-9])?)0*$/;break;case 1:i=/(\.\d(?:\d*[1-9])?)0*$/;break;default:i=new RegExp("(\\.\\d{".concat(t,"}(?:\\d*[1-9])?)0*"))}return e=e.replace(i,"$1"),0===t&&(e=e.replace(/\.$/,"")),e}},{key:"_roundRawValue",value:function(e,t){return this._roundValue(e,t,t.decimalPlacesRawValue)}},{key:"_roundFormattedValueShownOnFocus",value:function(e,t){return this._roundValue(e,t,Number(t.decimalPlacesShownOnFocus))}},{key:"_roundFormattedValueShownOnBlur",value:function(e,t){return this._roundValue(e,t,Number(t.decimalPlacesShownOnBlur))}},{key:"_roundFormattedValueShownOnFocusOrBlur",value:function(e,t,i){return i?this._roundFormattedValueShownOnFocus(e,t):this._roundFormattedValueShownOnBlur(e,t)}},{key:"_roundValue",value:function(e,t,i){if(D.isNull(e))return e;if(e=""===e?"0":e.toString(),t.roundingMethod===I.options.roundingMethod.toNearest05||t.roundingMethod===I.options.roundingMethod.toNearest05Alt||t.roundingMethod===I.options.roundingMethod.upToNext05||t.roundingMethod===I.options.roundingMethod.downToNext05)return this._roundCloseTo05(e,t);var n,a=S(I._prepareValueForRounding(e,t),2),r=a[0],s=(e=a[1]).lastIndexOf("."),o=-1===s,l=S(e.split("."),2),c=l[0];if(!(0<l[1]||t.allowDecimalPadding!==I.options.allowDecimalPadding.never&&t.allowDecimalPadding!==I.options.allowDecimalPadding.floats))return 0===Number(e)?c:"".concat(r).concat(c);n=t.allowDecimalPadding===I.options.allowDecimalPadding.always||t.allowDecimalPadding===I.options.allowDecimalPadding.floats?i:0;var u,h=o?e.length-1:s,m=e.length-1-h,g="";if(m<=i){if(g=e,m<n){o&&(g="".concat(g).concat(t.decimalCharacter));for(var d="000000";m<n;)g+=d=d.substring(0,n-m),m+=d.length}else n<m?g=this._truncateZeros(g,n):0===m&&0===n&&(g=g.replace(/\.$/,""));return 0===Number(g)?g:"".concat(r).concat(g)}u=o?i-1:Number(i)+Number(s);var v,p=Number(e.charAt(u+1)),f=e.substring(0,u+1).split("");if(v="."===e.charAt(u)?e.charAt(u-1)%2:e.charAt(u)%2,this._shouldRoundUp(p,t,r,v))for(var y=f.length-1;0<=y;y-=1)if("."!==f[y]){if(f[y]=+f[y]+1,f[y]<10)break;0<y&&(f[y]="0")}return f=f.slice(0,u+1),g=this._truncateZeros(f.join(""),n),0===Number(g)?g:"".concat(r).concat(g)}},{key:"_roundCloseTo05",value:function(e,t){switch(t.roundingMethod){case I.options.roundingMethod.toNearest05:case I.options.roundingMethod.toNearest05Alt:e=(Math.round(20*e)/20).toString();break;case I.options.roundingMethod.upToNext05:e=(Math.ceil(20*e)/20).toString();break;default:e=(Math.floor(20*e)/20).toString()}return D.contains(e,".")?e.length-e.indexOf(".")<3?e+"0":e:e+".00"}},{key:"_prepareValueForRounding",value:function(e,t){var i="";return D.isNegativeStrict(e,"-")&&(i="-",e=e.replace("-","")),e.match(/^\d/)||(e="0".concat(e)),0===Number(e)&&(i=""),(0<Number(e)&&t.leadingZero!==I.options.leadingZero.keep||0<e.length&&t.leadingZero===I.options.leadingZero.allow)&&(e=e.replace(/^0*(\d)/,"$1")),[i,e]}},{key:"_shouldRoundUp",value:function(e,t,i,n){return 4<e&&t.roundingMethod===I.options.roundingMethod.halfUpSymmetric||4<e&&t.roundingMethod===I.options.roundingMethod.halfUpAsymmetric&&""===i||5<e&&t.roundingMethod===I.options.roundingMethod.halfUpAsymmetric&&"-"===i||5<e&&t.roundingMethod===I.options.roundingMethod.halfDownSymmetric||5<e&&t.roundingMethod===I.options.roundingMethod.halfDownAsymmetric&&""===i||4<e&&t.roundingMethod===I.options.roundingMethod.halfDownAsymmetric&&"-"===i||5<e&&t.roundingMethod===I.options.roundingMethod.halfEvenBankersRounding||5===e&&t.roundingMethod===I.options.roundingMethod.halfEvenBankersRounding&&1===n||0<e&&t.roundingMethod===I.options.roundingMethod.toCeilingTowardPositiveInfinity&&""===i||0<e&&t.roundingMethod===I.options.roundingMethod.toFloorTowardNegativeInfinity&&"-"===i||0<e&&t.roundingMethod===I.options.roundingMethod.upRoundAwayFromZero}},{key:"_truncateDecimalPlaces",value:function(e,t,i,n){i&&(e=this._roundFormattedValueShownOnFocus(e,t));var a=S(e.split(t.decimalCharacter),2),r=a[0],s=a[1];if(s&&s.length>n)if(0<n){var o=s.substring(0,n);e="".concat(r).concat(t.decimalCharacter).concat(o)}else e=r;return e}},{key:"_checkIfInRangeWithOverrideOption",value:function(e,t){if(D.isNull(e)&&t.emptyInputBehavior===I.options.emptyInputBehavior.null)return[!0,!0];e=(e=e.toString()).replace(",",".");var i,n=D.parseStr(t.minimumValue),a=D.parseStr(t.maximumValue),r=D.parseStr(e);switch(t.overrideMinMaxLimits){case I.options.overrideMinMaxLimits.floor:i=[-1<D.testMinMax(n,r),!0];break;case I.options.overrideMinMaxLimits.ceiling:i=[!0,D.testMinMax(a,r)<1];break;case I.options.overrideMinMaxLimits.ignore:i=[!0,!0];break;default:i=[-1<D.testMinMax(n,r),D.testMinMax(a,r)<1]}return i}},{key:"_readCookie",value:function(e){for(var t=e+"=",i=document.cookie.split(";"),n="",a=0;a<i.length;a+=1){for(n=i[a];" "===n.charAt(0);)n=n.substring(1,n.length);if(0===n.indexOf(t))return n.substring(t.length,n.length)}return null}},{key:"_storageTest",value:function(){var e="modernizr";try{return sessionStorage.setItem(e,e),sessionStorage.removeItem(e),!0}catch(e){return!1}}},{key:"_correctNegativePositiveSignPlacementOption",value:function(e){if(D.isNull(e.negativePositiveSignPlacement))if(D.isUndefined(e)||!D.isUndefinedOrNullOrEmpty(e.negativePositiveSignPlacement)||D.isUndefinedOrNullOrEmpty(e.currencySymbol))e.negativePositiveSignPlacement=I.options.negativePositiveSignPlacement.left;else switch(e.currencySymbolPlacement){case I.options.currencySymbolPlacement.suffix:e.negativePositiveSignPlacement=I.options.negativePositiveSignPlacement.prefix;break;case I.options.currencySymbolPlacement.prefix:e.negativePositiveSignPlacement=I.options.negativePositiveSignPlacement.left}}},{key:"_correctCaretPositionOnFocusAndSelectOnFocusOptions",value:function(e){return D.isNull(e)?null:(!D.isUndefinedOrNullOrEmpty(e.caretPositionOnFocus)&&D.isUndefinedOrNullOrEmpty(e.selectOnFocus)&&(e.selectOnFocus=I.options.selectOnFocus.doNotSelect),D.isUndefinedOrNullOrEmpty(e.caretPositionOnFocus)&&!D.isUndefinedOrNullOrEmpty(e.selectOnFocus)&&e.selectOnFocus===I.options.selectOnFocus.select&&(e.caretPositionOnFocus=I.options.caretPositionOnFocus.doNoForceCaretPosition),e)}},{key:"_calculateDecimalPlacesOnInit",value:function(e){this._validateDecimalPlacesRawValue(e),e.decimalPlacesShownOnFocus===I.options.decimalPlacesShownOnFocus.useDefault&&(e.decimalPlacesShownOnFocus=e.decimalPlaces),e.decimalPlacesShownOnBlur===I.options.decimalPlacesShownOnBlur.useDefault&&(e.decimalPlacesShownOnBlur=e.decimalPlaces),e.decimalPlacesRawValue===I.options.decimalPlacesRawValue.useDefault&&(e.decimalPlacesRawValue=e.decimalPlaces);var t=0;e.rawValueDivisor&&e.rawValueDivisor!==I.options.rawValueDivisor.none&&(t=String(e.rawValueDivisor).length-1)<0&&(t=0),e.decimalPlacesRawValue=Math.max(Math.max(e.decimalPlacesShownOnBlur,e.decimalPlacesShownOnFocus)+t,Number(e.originalDecimalPlacesRawValue)+t)}},{key:"_calculateDecimalPlacesOnUpdate",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;this._validateDecimalPlacesRawValue(e),D.isNull(i)&&D.throwError("When updating the settings, the previous ones should be passed as an argument.");var n="decimalPlaces"in e;if(n||"decimalPlacesRawValue"in e||"decimalPlacesShownOnFocus"in e||"decimalPlacesShownOnBlur"in e||"rawValueDivisor"in e){n?("decimalPlacesShownOnFocus"in e&&e.decimalPlacesShownOnFocus!==I.options.decimalPlacesShownOnFocus.useDefault||(e.decimalPlacesShownOnFocus=e.decimalPlaces),"decimalPlacesShownOnBlur"in e&&e.decimalPlacesShownOnBlur!==I.options.decimalPlacesShownOnBlur.useDefault||(e.decimalPlacesShownOnBlur=e.decimalPlaces),"decimalPlacesRawValue"in e&&e.decimalPlacesRawValue!==I.options.decimalPlacesRawValue.useDefault||(e.decimalPlacesRawValue=e.decimalPlaces)):(D.isUndefined(e.decimalPlacesShownOnFocus)&&(e.decimalPlacesShownOnFocus=i.decimalPlacesShownOnFocus),D.isUndefined(e.decimalPlacesShownOnBlur)&&(e.decimalPlacesShownOnBlur=i.decimalPlacesShownOnBlur));var a=0;e.rawValueDivisor&&e.rawValueDivisor!==I.options.rawValueDivisor.none&&(a=String(e.rawValueDivisor).length-1)<0&&(a=0),e.decimalPlaces||e.decimalPlacesRawValue?e.decimalPlacesRawValue=Math.max(Math.max(e.decimalPlacesShownOnBlur,e.decimalPlacesShownOnFocus)+a,Number(e.decimalPlacesRawValue)+a):e.decimalPlacesRawValue=Math.max(Math.max(e.decimalPlacesShownOnBlur,e.decimalPlacesShownOnFocus)+a,Number(i.originalDecimalPlacesRawValue)+a)}}},{key:"_cachesUsualRegularExpressions",value:function(e,t){var i;i=e.negativeSignCharacter!==I.options.negativeSignCharacter.hyphen?"([-\\".concat(e.negativeSignCharacter,"]?)"):"(-?)",t.aNegRegAutoStrip=i,e.allowedAutoStrip=new RegExp("[^-0123456789\\".concat(e.decimalCharacter,"]"),"g"),e.numRegAutoStrip=new RegExp("".concat(i,"(?:\\").concat(e.decimalCharacter,"?([0-9]+\\").concat(e.decimalCharacter,"[0-9]+)|([0-9]*(?:\\").concat(e.decimalCharacter,"[0-9]*)?))")),e.stripReg=new RegExp("^".concat(t.aNegRegAutoStrip,"0*([0-9])")),e.formulaChars=new RegExp("[0-9".concat(e.decimalCharacter,"+\\-*/() ]"))}},{key:"_convertOldOptionsToNewOnes",value:function(e){var t={aSep:"digitGroupSeparator",nSep:"showOnlyNumbersOnFocus",dGroup:"digitalGroupSpacing",aDec:"decimalCharacter",altDec:"decimalCharacterAlternative",aSign:"currencySymbol",pSign:"currencySymbolPlacement",pNeg:"negativePositiveSignPlacement",aSuffix:"suffixText",oLimits:"overrideMinMaxLimits",vMax:"maximumValue",vMin:"minimumValue",mDec:"decimalPlacesOverride",eDec:"decimalPlacesShownOnFocus",scaleDecimal:"decimalPlacesShownOnBlur",aStor:"saveValueToSessionStorage",mRound:"roundingMethod",aPad:"allowDecimalPadding",nBracket:"negativeBracketsTypeOnBlur",wEmpty:"emptyInputBehavior",lZero:"leadingZero",aForm:"formatOnPageLoad",sNumber:"selectNumberOnly",anDefault:"defaultValueOverride",unSetOnSubmit:"unformatOnSubmit",outputType:"outputFormat",debug:"showWarnings",allowDecimalPadding:!0,alwaysAllowDecimalCharacter:!0,caretPositionOnFocus:!0,createLocalList:!0,currencySymbol:!0,currencySymbolPlacement:!0,decimalCharacter:!0,decimalCharacterAlternative:!0,decimalPlaces:!0,decimalPlacesRawValue:!0,decimalPlacesShownOnBlur:!0,decimalPlacesShownOnFocus:!0,defaultValueOverride:!0,digitalGroupSpacing:!0,digitGroupSeparator:!0,divisorWhenUnfocused:!0,emptyInputBehavior:!0,eventBubbles:!0,eventIsCancelable:!0,failOnUnknownOption:!0,formatOnPageLoad:!0,formulaMode:!0,historySize:!0,isCancellable:!0,leadingZero:!0,maximumValue:!0,minimumValue:!0,modifyValueOnWheel:!0,negativeBracketsTypeOnBlur:!0,negativePositiveSignPlacement:!0,negativeSignCharacter:!0,noEventListeners:!0,onInvalidPaste:!0,outputFormat:!0,overrideMinMaxLimits:!0,positiveSignCharacter:!0,rawValueDivisor:!0,readOnly:!0,roundingMethod:!0,saveValueToSessionStorage:!0,selectNumberOnly:!0,selectOnFocus:!0,serializeSpaces:!0,showOnlyNumbersOnFocus:!0,showPositiveSign:!0,showWarnings:!0,styleRules:!0,suffixText:!0,symbolWhenUnfocused:!0,unformatOnHover:!0,unformatOnSubmit:!0,valuesToStrings:!0,watchExternalChanges:!0,wheelOn:!0,wheelStep:!0,allowedAutoStrip:!0,formulaChars:!0,isNegativeSignAllowed:!0,isPositiveSignAllowed:!0,mIntNeg:!0,mIntPos:!0,numRegAutoStrip:!0,originalDecimalPlaces:!0,originalDecimalPlacesRawValue:!0,stripReg:!0};for(var i in e)if(Object.prototype.hasOwnProperty.call(e,i)){if(!0===t[i])continue;Object.prototype.hasOwnProperty.call(t,i)?(D.warning("You are using the deprecated option name '".concat(i,"'. Please use '").concat(t[i],"' instead from now on. The old option name will be dropped very soon™."),!0),e[t[i]]=e[i],delete e[i]):e.failOnUnknownOption&&D.throwError("Option name '".concat(i,"' is unknown. Please fix the options passed to autoNumeric"))}"mDec"in e&&D.warning("The old `mDec` option has been deprecated in favor of more accurate options ; `decimalPlaces`, `decimalPlacesRawValue`, `decimalPlacesShownOnFocus` and `decimalPlacesShownOnBlur`.",!0)}},{key:"_setNegativePositiveSignPermissions",value:function(e){e.isNegativeSignAllowed=e.minimumValue<0,e.isPositiveSignAllowed=0<=e.maximumValue}},{key:"_toNumericValue",value:function(e,t){var i;return D.isNumber(Number(e))?i=D.scientificToDecimal(e):(i=this._convertToNumericString(e.toString(),t),D.isNumber(Number(i))||(D.warning('The given value "'.concat(e,'" cannot be converted to a numeric one and therefore cannot be used appropriately.'),t.showWarnings),i=NaN)),i}},{key:"_checkIfInRange",value:function(e,t,i){var n=D.parseStr(e);return-1<D.testMinMax(t,n)&&D.testMinMax(i,n)<1}},{key:"_shouldSkipEventKey",value:function(e){var t=D.isInArray(e,d.keyName._allFnKeys),i=e===d.keyName.OSLeft||e===d.keyName.OSRight,n=e===d.keyName.ContextMenu,a=D.isInArray(e,d.keyName._someNonPrintableKeys),r=e===d.keyName.NumLock||e===d.keyName.ScrollLock||e===d.keyName.Insert||e===d.keyName.Command,s=e===d.keyName.Unidentified;return t||i||n||a||s||r}},{key:"_serialize",value:function(e,t,i,n,a){var r,s=this,o=1<arguments.length&&void 0!==t&&t,l=2<arguments.length&&void 0!==i?i:"unformatted",c=3<arguments.length&&void 0!==n?n:"+",u=4<arguments.length&&void 0!==a?a:null,h=[];return"object"===b(e)&&"form"===e.nodeName.toLowerCase()&&Array.prototype.slice.call(e.elements).forEach(function(t){if(t.name&&!t.disabled&&-1===["file","reset","submit","button"].indexOf(t.type))if("select-multiple"===t.type)Array.prototype.slice.call(t.options).forEach(function(e){e.selected&&(o?h.push({name:t.name,value:e.value}):h.push("".concat(encodeURIComponent(t.name),"=").concat(encodeURIComponent(e.value))))});else if(-1===["checkbox","radio"].indexOf(t.type)||t.checked){var e,i;if(s.isManagedByAutoNumeric(t))switch(l){case"unformatted":i=s.getAutoNumericElement(t),D.isNull(i)||(e=s.unformat(t,i.getSettings()));break;case"localized":if(i=s.getAutoNumericElement(t),!D.isNull(i)){var n=D.cloneObject(i.getSettings());D.isNull(u)||(n.outputFormat=u),e=s.localize(t,n)}break;case"formatted":default:e=t.value}else e=t.value;D.isUndefined(e)&&D.throwError("This error should never be hit. If it has, something really wrong happened!"),o?h.push({name:t.name,value:e}):h.push("".concat(encodeURIComponent(t.name),"=").concat(encodeURIComponent(e)))}}),o?r=h:(r=h.join("&"),"+"===c&&(r=r.replace(/%20/g,"+"))),r}},{key:"_serializeNumericString",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:"+";return this._serialize(e,!1,"unformatted",i)}},{key:"_serializeFormatted",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:"+";return this._serialize(e,!1,"formatted",i)}},{key:"_serializeLocalized",value:function(e,t,i){var n=1<arguments.length&&void 0!==t?t:"+",a=2<arguments.length&&void 0!==i?i:null;return this._serialize(e,!1,"localized",n,a)}},{key:"_serializeNumericStringArray",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:"+";return this._serialize(e,!0,"unformatted",i)}},{key:"_serializeFormattedArray",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:"+";return this._serialize(e,!0,"formatted",i)}},{key:"_serializeLocalizedArray",value:function(e,t,i){var n=1<arguments.length&&void 0!==t?t:"+",a=2<arguments.length&&void 0!==i?i:null;return this._serialize(e,!0,"localized",n,a)}}],g((e=I).prototype,[{key:"_saveInitialValues",value:function(e){this.initialValueHtmlAttribute=D.scientificToDecimal(this.domElement.getAttribute("value")),D.isNull(this.initialValueHtmlAttribute)&&(this.initialValueHtmlAttribute=""),this.initialValue=e,D.isNull(this.initialValue)&&(this.initialValue="")}},{key:"_createEventListeners",value:function(){var t=this;this.formulaMode=!1,this._onFocusInFunc=function(e){t._onFocusIn(e)},this._onFocusInAndMouseEnterFunc=function(e){t._onFocusInAndMouseEnter(e)},this._onFocusFunc=function(){t._onFocus()},this._onKeydownFunc=function(e){t._onKeydown(e)},this._onKeypressFunc=function(e){t._onKeypress(e)},this._onKeyupFunc=function(e){t._onKeyup(e)},this._onFocusOutAndMouseLeaveFunc=function(e){t._onFocusOutAndMouseLeave(e)},this._onPasteFunc=function(e){t._onPaste(e)},this._onWheelFunc=function(e){t._onWheel(e)},this._onDropFunc=function(e){t._onDrop(e)},this._onKeydownGlobalFunc=function(e){t._onKeydownGlobal(e)},this._onKeyupGlobalFunc=function(e){t._onKeyupGlobal(e)},this.domElement.addEventListener("focusin",this._onFocusInFunc,!1),this.domElement.addEventListener("focus",this._onFocusInAndMouseEnterFunc,!1),this.domElement.addEventListener("focus",this._onFocusFunc,!1),this.domElement.addEventListener("mouseenter",this._onFocusInAndMouseEnterFunc,!1),this.domElement.addEventListener("keydown",this._onKeydownFunc,!1),this.domElement.addEventListener("keypress",this._onKeypressFunc,!1),this.domElement.addEventListener("keyup",this._onKeyupFunc,!1),this.domElement.addEventListener("blur",this._onFocusOutAndMouseLeaveFunc,!1),this.domElement.addEventListener("mouseleave",this._onFocusOutAndMouseLeaveFunc,!1),this.domElement.addEventListener("paste",this._onPasteFunc,!1),this.domElement.addEventListener("wheel",this._onWheelFunc,!1),this.domElement.addEventListener("drop",this._onDropFunc,!1),this._setupFormListener(),this.hasEventListeners=!0,I._doesGlobalListExists()||(document.addEventListener("keydown",this._onKeydownGlobalFunc,!1),document.addEventListener("keyup",this._onKeyupGlobalFunc,!1))}},{key:"_removeEventListeners",value:function(){this.domElement.removeEventListener("focusin",this._onFocusInFunc,!1),this.domElement.removeEventListener("focus",this._onFocusInAndMouseEnterFunc,!1),this.domElement.removeEventListener("focus",this._onFocusFunc,!1),this.domElement.removeEventListener("mouseenter",this._onFocusInAndMouseEnterFunc,!1),this.domElement.removeEventListener("blur",this._onFocusOutAndMouseLeaveFunc,!1),this.domElement.removeEventListener("mouseleave",this._onFocusOutAndMouseLeaveFunc,!1),this.domElement.removeEventListener("keydown",this._onKeydownFunc,!1),this.domElement.removeEventListener("keypress",this._onKeypressFunc,!1),this.domElement.removeEventListener("keyup",this._onKeyupFunc,!1),this.domElement.removeEventListener("paste",this._onPasteFunc,!1),this.domElement.removeEventListener("wheel",this._onWheelFunc,!1),this.domElement.removeEventListener("drop",this._onDropFunc,!1),this._removeFormListener(),this.hasEventListeners=!1,document.removeEventListener("keydown",this._onKeydownGlobalFunc,!1),document.removeEventListener("keyup",this._onKeyupGlobalFunc,!1)}},{key:"_updateEventListeners",value:function(){this.settings.noEventListeners||this.hasEventListeners||this._createEventListeners(),this.settings.noEventListeners&&this.hasEventListeners&&this._removeEventListeners()}},{key:"_setupFormListener",value:function(){var e=this;D.isNull(this.parentForm)||(this._onFormSubmitFunc=function(){e._onFormSubmit()},this._onFormResetFunc=function(){e._onFormReset()},this._hasParentFormCounter()?this._incrementParentFormCounter():(this._initializeFormCounterToOne(),this.parentForm.addEventListener("submit",this._onFormSubmitFunc,!1),this.parentForm.addEventListener("reset",this._onFormResetFunc,!1),this._storeFormHandlerFunction()))}},{key:"_removeFormListener",value:function(){if(!D.isNull(this.parentForm)){var e=this._getParentFormCounter();1===e?(this.parentForm.removeEventListener("submit",this._getFormHandlerFunction().submitFn,!1),this.parentForm.removeEventListener("reset",this._getFormHandlerFunction().resetFn,!1),this._removeFormDataSetInfo()):1<e?this._decrementParentFormCounter():D.throwError("The AutoNumeric object count on the form is incoherent.")}}},{key:"_hasParentFormCounter",value:function(){return"anCount"in this.parentForm.dataset}},{key:"_getParentFormCounter",value:function(){return Number(this.parentForm.dataset.anCount)}},{key:"_initializeFormCounterToOne",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;this._getFormElement(t).dataset.anCount=1}},{key:"_incrementParentFormCounter",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;this._getFormElement(t).dataset.anCount++}},{key:"_decrementParentFormCounter",value:function(){this.parentForm.dataset.anCount--}},{key:"_hasFormHandlerFunction",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return"anFormHandler"in this._getFormElement(t).dataset}},{key:"_getFormElement",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return D.isNull(t)?this.parentForm:t}},{key:"_storeFormHandlerFunction",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;this.constructor._doesFormHandlerListExists()||this.constructor._createFormHandlerList();var i=D.randomString();this._getFormElement(t).dataset.anFormHandler=i,window.aNFormHandlerMap.set(i,{submitFn:this._onFormSubmitFunc,resetFn:this._onFormResetFunc})}},{key:"_getFormHandlerKey",value:function(){this._hasFormHandlerFunction()||D.throwError("Unable to retrieve the form handler name");var e=this.parentForm.dataset.anFormHandler;return""===e&&D.throwError("The form handler name is invalid"),e}},{key:"_getFormHandlerFunction",value:function(){var e=this._getFormHandlerKey();return window.aNFormHandlerMap.get(e)}},{key:"_removeFormDataSetInfo",value:function(){this._decrementParentFormCounter(),window.aNFormHandlerMap.delete(this._getFormHandlerKey()),this.parentForm.removeAttribute("data-an-count"),this.parentForm.removeAttribute("data-an-form-handler")}},{key:"_setWritePermissions",value:function(e){0<arguments.length&&void 0!==e&&e&&this.domElement.readOnly||this.settings.readOnly?this._setReadOnly():this._setReadWrite()}},{key:"_setReadOnly",value:function(){this.isInputElement?this.domElement.readOnly=!0:this.domElement.setAttribute("contenteditable",!1)}},{key:"_setReadWrite",value:function(){this.isInputElement?this.domElement.readOnly=!1:this.domElement.setAttribute("contenteditable",!0)}},{key:"_addWatcher",value:function(){var t=this;if(!D.isUndefined(this.getterSetter)){var e=this.getterSetter,i=e.set,n=e.get;Object.defineProperty(this.domElement,this.attributeToWatch,{configurable:!0,get:function(){return n.call(t.domElement)},set:function(e){i.call(t.domElement,e),t.settings.watchExternalChanges&&!t.internalModification&&t.set(e)}})}}},{key:"_removeWatcher",value:function(){var t=this;if(!D.isUndefined(this.getterSetter)){var e=this.getterSetter,i=e.set,n=e.get;Object.defineProperty(this.domElement,this.attributeToWatch,{configurable:!0,get:function(){return n.call(t.domElement)},set:function(e){i.call(t.domElement,e)}})}}},{key:"_getAttributeToWatch",value:function(){var e;if(this.isInputElement)e="value";else{var t=this.domElement.nodeType;t===Node.ELEMENT_NODE||t===Node.DOCUMENT_NODE||t===Node.DOCUMENT_FRAGMENT_NODE?e="textContent":t===Node.TEXT_NODE&&(e="nodeValue")}return e}},{key:"_historyTableAdd",value:function(){var e=0===this.historyTable.length;if(e||this.rawValue!==this._historyTableCurrentValueUsed()){var t=!0;if(!e){var i=this.historyTableIndex+1;i<this.historyTable.length&&this.rawValue===this.historyTable[i].value?t=!1:D.arrayTrim(this.historyTable,this.historyTableIndex+1)}if(this.historyTableIndex++,t){var n=D.getElementSelection(this.domElement);this.selectionStart=n.start,this.selectionEnd=n.end,this.historyTable.push({value:this.rawValue,start:this.selectionStart+1,end:this.selectionEnd+1}),1<this.historyTable.length&&(this.historyTable[this.historyTableIndex-1].start=this.selectionStart,this.historyTable[this.historyTableIndex-1].end=this.selectionEnd)}this.historyTable.length>this.settings.historySize&&this._historyTableForget()}}},{key:"_historyTableUndoOrRedo",value:function(e){var t;if(0<arguments.length&&void 0!==e&&!e?(t=this.historyTableIndex+1<this.historyTable.length)&&this.historyTableIndex++:(t=0<this.historyTableIndex)&&this.historyTableIndex--,t){var i=this.historyTable[this.historyTableIndex];this.set(i.value,null,!1),D.setElementSelection(this.domElement,i.start,i.end)}}},{key:"_historyTableUndo",value:function(){this._historyTableUndoOrRedo(!0)}},{key:"_historyTableRedo",value:function(){this._historyTableUndoOrRedo(!1)}},{key:"_historyTableForget",value:function(e){for(var t=0<arguments.length&&void 0!==e?e:1,i=[],n=0;n<t;n++)i.push(this.historyTable.shift()),this.historyTableIndex--,this.historyTableIndex<0&&(this.historyTableIndex=0);return 1===i.length?i[0]:i}},{key:"_historyTableCurrentValueUsed",value:function(){var e=this.historyTableIndex;return e<0&&(e=0),D.isUndefinedOrNullOrEmpty(this.historyTable[e])?"":this.historyTable[e].value}},{key:"_parseStyleRules",value:function(){var n=this;D.isUndefinedOrNullOrEmpty(this.settings.styleRules)||""===this.rawValue||(D.isUndefinedOrNullOrEmpty(this.settings.styleRules.positive)||(0<=this.rawValue?this._addCSSClass(this.settings.styleRules.positive):this._removeCSSClass(this.settings.styleRules.positive)),D.isUndefinedOrNullOrEmpty(this.settings.styleRules.negative)||(this.rawValue<0?this._addCSSClass(this.settings.styleRules.negative):this._removeCSSClass(this.settings.styleRules.negative)),D.isUndefinedOrNullOrEmpty(this.settings.styleRules.ranges)||0===this.settings.styleRules.ranges.length||this.settings.styleRules.ranges.forEach(function(e){n.rawValue>=e.min&&n.rawValue<e.max?n._addCSSClass(e.class):n._removeCSSClass(e.class)}),D.isUndefinedOrNullOrEmpty(this.settings.styleRules.userDefined)||0===this.settings.styleRules.userDefined.length||this.settings.styleRules.userDefined.forEach(function(e){if(D.isFunction(e.callback))if(D.isString(e.classes))e.callback(n.rawValue)?n._addCSSClass(e.classes):n._removeCSSClass(e.classes);else if(D.isArray(e.classes))if(2===e.classes.length)e.callback(n.rawValue)?(n._addCSSClass(e.classes[0]),n._removeCSSClass(e.classes[1])):(n._removeCSSClass(e.classes[0]),n._addCSSClass(e.classes[1]));else if(2<e.classes.length){var i=e.callback(n.rawValue);D.isArray(i)?e.classes.forEach(function(e,t){D.isInArray(t,i)?n._addCSSClass(e):n._removeCSSClass(e)}):D.isInt(i)?e.classes.forEach(function(e,t){t===i?n._addCSSClass(e):n._removeCSSClass(e)}):D.isNull(i)?e.classes.forEach(function(e){n._removeCSSClass(e)}):D.throwError("The callback result is not an array nor a valid array index, ".concat(b(i)," given."))}else D.throwError("The classes attribute is not valid for the `styleRules` option.");else D.isUndefinedOrNullOrEmpty(e.classes)?e.callback(n):D.throwError("The callback/classes structure is not valid for the `styleRules` option.");else D.warning("The given `styleRules` callback is not a function, ".concat("undefined"==typeof callback?"undefined":b(callback)," given."),n.settings.showWarnings)}))}},{key:"_addCSSClass",value:function(e){this.domElement.classList.add(e)}},{key:"_removeCSSClass",value:function(e){this.domElement.classList.remove(e)}},{key:"update",value:function(){for(var t=this,e=arguments.length,i=new Array(e),n=0;n<e;n++)i[n]=arguments[n];Array.isArray(i)&&Array.isArray(i[0])&&(i=i[0]);var a=D.cloneObject(this.settings),r=this.rawValue,s={};D.isUndefinedOrNullOrEmpty(i)||0===i.length?s=null:1<=i.length&&i.forEach(function(e){t.constructor._isPreDefinedOptionValid(e)&&(e=t.constructor._getOptionObject(e)),y(s,e)});try{this._setSettings(s,!0),this._setWritePermissions(),this._updateEventListeners(),this.set(r)}catch(e){return this._setSettings(a,!0),D.throwError("Unable to update the settings, those are invalid: [".concat(e,"]")),this}return this}},{key:"getSettings",value:function(){return this.settings}},{key:"set",value:function(e,t,i){var n,a=1<arguments.length&&void 0!==t?t:null,r=!(2<arguments.length&&void 0!==i)||i;if(D.isUndefined(e))return D.warning("You are trying to set an 'undefined' value ; an error could have occurred.",this.settings.showWarnings),this;if(D.isNull(a)||this._setSettings(a,!0),null===e&&this.settings.emptyInputBehavior!==I.options.emptyInputBehavior.null)return D.warning("You are trying to set the `null` value while the `emptyInputBehavior` option is set to ".concat(this.settings.emptyInputBehavior,". If you want to be able to set the `null` value, you need to change the 'emptyInputBehavior' option to `'null'`."),this.settings.showWarnings),this;if(null===e)return this._setElementAndRawValue(null,null,r),this._saveValueToPersistentStorage(),this;if(n=this.constructor._toNumericValue(e,this.settings),isNaN(Number(n)))return D.warning("The value you are trying to set results in `NaN`. The element value is set to the empty string instead.",this.settings.showWarnings),this.setValue("",r),this;if(""===n)switch(this.settings.emptyInputBehavior){case I.options.emptyInputBehavior.zero:n=0;break;case I.options.emptyInputBehavior.min:n=this.settings.minimumValue;break;case I.options.emptyInputBehavior.max:n=this.settings.maximumValue;break;default:D.isNumber(this.settings.emptyInputBehavior)&&(n=Number(this.settings.emptyInputBehavior))}if(""===n)return s=this.settings.emptyInputBehavior===I.options.emptyInputBehavior.always?this.settings.currencySymbol:"",this._setElementAndRawValue(s,"",r),this;var s,o=S(this.constructor._checkIfInRangeWithOverrideOption(n,this.settings),2),l=o[0],c=o[1];if(l&&c&&this.settings.valuesToStrings&&this._checkValuesToStrings(n))return this._setElementAndRawValue(this.settings.valuesToStrings[n],n,r),this._saveValueToPersistentStorage(),this;if(D.isZeroOrHasNoValue(n)&&(n="0"),l&&c){var u=this.constructor._roundRawValue(n,this.settings);return u=this._trimLeadingAndTrailingZeros(u.replace(this.settings.decimalCharacter,".")),n=this._getRawValueToFormat(n),n=this.isFocused?this.constructor._roundFormattedValueShownOnFocus(n,this.settings):(this.settings.divisorWhenUnfocused&&(n=(n/=this.settings.divisorWhenUnfocused).toString()),this.constructor._roundFormattedValueShownOnBlur(n,this.settings)),n=this.constructor._modifyNegativeSignAndDecimalCharacterForFormattedValue(n,this.settings),n=this.constructor._addGroupSeparators(n,this.settings,this.isFocused,this.rawValue,u),!this.isFocused&&this.settings.symbolWhenUnfocused&&(n="".concat(n).concat(this.settings.symbolWhenUnfocused)),(this.settings.decimalPlacesShownOnFocus||this.settings.divisorWhenUnfocused)&&this._saveValueToPersistentStorage(),this._setElementAndRawValue(n,u,r),this}return l||this._triggerEvent(I.events.minRangeExceeded,this.domElement),c||this._triggerEvent(I.events.maxRangeExceeded,this.domElement),D.throwError("The value [".concat(n,"] being set falls outside of the minimumValue [").concat(this.settings.minimumValue,"] and maximumValue [").concat(this.settings.maximumValue,"] range set for this element")),this._removeValueFromPersistentStorage(),this.setValue("",r),this}},{key:"setUnformatted",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;if(null===e||D.isUndefined(e))return this;D.isNull(i)||this._setSettings(i,!0);var n=this.constructor._removeBrackets(e,this.settings),a=this.constructor._stripAllNonNumberCharacters(n,this.settings,!0,this.isFocused);D.isNumber(a)||D.throwError("The value is not a valid one, it's not a numeric string nor a recognized currency.");var r=S(this.constructor._checkIfInRangeWithOverrideOption(a,this.settings),2),s=r[0],o=r[1];return s&&o?this.setValue(e):D.throwError("The value is out of the range limits [".concat(this.settings.minimumValue,", ").concat(this.settings.maximumValue,"].")),this}},{key:"setValue",value:function(e,t){var i=!(1<arguments.length&&void 0!==t)||t;return this._setElementAndRawValue(e,i),this}},{key:"_setRawValue",value:function(e,t){var i=!(1<arguments.length&&void 0!==t)||t;if(this.rawValue!==e){var n=this.rawValue;this.rawValue=e,!D.isNull(this.settings.rawValueDivisor)&&0!==this.settings.rawValueDivisor&&""!==e&&null!==e&&this._isUserManuallyEditingTheValue()&&(this.rawValue/=this.settings.rawValueDivisor),this._triggerEvent(I.events.rawValueModified,this.domElement,{oldRawValue:n,newRawValue:this.rawValue,isPristine:this.isPristine(!0),error:null,aNElement:this}),this._parseStyleRules(),i&&this._historyTableAdd()}}},{key:"_setElementValue",value:function(e,t){var i=!(1<arguments.length&&void 0!==t)||t,n=D.getElementValue(this.domElement);return e!==n&&(this.internalModification=!0,D.setElementValue(this.domElement,e),this.internalModification=!1,i&&this._triggerEvent(I.events.formatted,this.domElement,{oldValue:n,newValue:e,oldRawValue:this.rawValue,newRawValue:this.rawValue,isPristine:this.isPristine(!1),error:null,aNElement:this})),this}},{key:"_setElementAndRawValue",value:function(e,t,i){var n=1<arguments.length&&void 0!==t?t:null,a=!(2<arguments.length&&void 0!==i)||i;return D.isNull(n)?n=e:D.isBoolean(n)&&(a=n,n=e),this._setElementValue(e),this._setRawValue(n,a),this}},{key:"_getRawValueToFormat",value:function(e){return D.isNull(this.settings.rawValueDivisor)||0===this.settings.rawValueDivisor||""===e||null===e?e:e*this.settings.rawValueDivisor}},{key:"_checkValuesToStrings",value:function(e){return this.constructor._checkValuesToStringsArray(e,this.valuesToStringsKeys)}},{key:"_isUserManuallyEditingTheValue",value:function(){return this.isFocused&&this.isEditing||this.isDropEvent}},{key:"_executeCallback",value:function(e,t){!D.isNull(t)&&D.isFunction(t)&&t(e,this)}},{key:"_triggerEvent",value:function(e,t,i){var n=1<arguments.length&&void 0!==t?t:document,a=2<arguments.length&&void 0!==i?i:null;D.triggerEvent(e,n,a,this.settings.eventBubbles,this.settings.eventIsCancelable)}},{key:"get",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this.getNumericString(t)}},{key:"getNumericString",value:function(e){var t,i=0<arguments.length&&void 0!==e?e:null;return t=D.isNull(this.rawValue)?null:D.trimPaddedZerosFromDecimalPlaces(this.rawValue),this._executeCallback(t,i),t}},{key:"getFormatted",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;"value"in this.domElement||"textContent"in this.domElement||D.throwError("Unable to get the formatted string from the element.");var i=D.getElementValue(this.domElement);return this._executeCallback(i,t),i}},{key:"getNumber",value:function(e){var t,i=0<arguments.length&&void 0!==e?e:null;return t=null===this.rawValue?null:this.constructor._toLocale(this.getNumericString(),"number",this.settings),this._executeCallback(t,i),t}},{key:"getLocalized",value:function(e,t){var i,n,a=0<arguments.length&&void 0!==e?e:null,r=1<arguments.length&&void 0!==t?t:null;D.isFunction(a)&&D.isNull(r)&&(r=a,a=null),""!=(i=D.isEmptyString(this.rawValue)?"":""+Number(this.rawValue))&&0===Number(i)&&this.settings.leadingZero!==I.options.leadingZero.keep&&(i="0"),n=D.isNull(a)?this.settings.outputFormat:a;var s=this.constructor._toLocale(i,n,this.settings);return this._executeCallback(s,r),s}},{key:"reformat",value:function(){return this.set(this.rawValue),this}},{key:"unformat",value:function(){return this._setElementValue(this.getNumericString()),this}},{key:"unformatLocalized",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._setElementValue(this.getLocalized(t)),this}},{key:"isPristine",value:function(e){return 0<arguments.length&&void 0!==e&&!e?this.initialValueHtmlAttribute===this.getFormatted():this.initialValue===this.getNumericString()}},{key:"select",value:function(){return this.settings.selectNumberOnly?this.selectNumber():this._defaultSelectAll(),this}},{key:"_defaultSelectAll",value:function(){D.setElementSelection(this.domElement,0,D.getElementValue(this.domElement).length)}},{key:"selectNumber",value:function(){var e,t,i=D.getElementValue(this.domElement),n=i.length,a=this.settings.currencySymbol.length,r=this.settings.currencySymbolPlacement,s=D.isNegative(i,this.settings.negativeSignCharacter)?1:0,o=this.settings.suffixText.length;if(e=r===I.options.currencySymbolPlacement.suffix?0:this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.left&&1==s&&0<a?a+1:a,r===I.options.currencySymbolPlacement.prefix)t=n-o;else switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.left:t=n-(o+a);break;case I.options.negativePositiveSignPlacement.right:t=0<a?n-(a+s+o):n-(a+o);break;default:t=n-(a+o)}return D.setElementSelection(this.domElement,e,t),this}},{key:"selectInteger",value:function(){var e=0,t=0<=this.rawValue;this.settings.currencySymbolPlacement!==I.options.currencySymbolPlacement.prefix&&(this.settings.currencySymbolPlacement!==I.options.currencySymbolPlacement.suffix||this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.prefix&&this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none)||(this.settings.showPositiveSign&&t||!t&&this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix&&this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.left)&&(e+=1),this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix&&(e+=this.settings.currencySymbol.length);var i=D.getElementValue(this.domElement),n=i.indexOf(this.settings.decimalCharacter);return-1===n&&(n=this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix?i.length-this.settings.currencySymbol.length:i.length,t||this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.suffix&&this.settings.currencySymbolPlacement!==I.options.currencySymbolPlacement.suffix||(n-=1),n-=this.settings.suffixText.length),D.setElementSelection(this.domElement,e,n),this}},{key:"selectDecimal",value:function(){var e,t,i=D.getElementValue(this.domElement).indexOf(this.settings.decimalCharacter);return e=-1===i?i=0:(i+=1,t=this.isFocused?this.settings.decimalPlacesShownOnFocus:this.settings.decimalPlacesShownOnBlur,i+Number(t)),D.setElementSelection(this.domElement,i,e),this}},{key:"node",value:function(){return this.domElement}},{key:"parent",value:function(){return this.domElement.parentNode}},{key:"detach",value:function(e){var t,i=0<arguments.length&&void 0!==e?e:null;return t=D.isNull(i)?this.domElement:i.node(),this._removeFromLocalList(t),this}},{key:"attach",value:function(e,t){var i=!(1<arguments.length&&void 0!==t)||t;return this._addToLocalList(e.node()),i&&e.update(this.settings),this}},{key:"formatOther",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return this._formatOrUnformatOther(!0,e,i)}},{key:"unformatOther",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return this._formatOrUnformatOther(!1,e,i)}},{key:"_formatOrUnformatOther",value:function(e,t,i){var n,a,r=2<arguments.length&&void 0!==i?i:null;if(n=D.isNull(r)?this.settings:this._cloneAndMergeSettings(r),D.isElement(t)){var s=D.getElementValue(t);return a=e?I.format(s,n):I.unformat(s,n),D.setElementValue(t,a),null}return e?I.format(t,n):I.unformat(t,n)}},{key:"init",value:function(e,t){var n=this,a=!(1<arguments.length&&void 0!==t)||t,i=!1,r=[];if(D.isString(e)?r=v(document.querySelectorAll(e)):D.isElement(e)?(r.push(e),i=!0):D.isArray(e)?r=e:D.throwError("The given parameters to the 'init' function are invalid."),0===r.length)return D.warning("No valid DOM elements were given hence no AutoNumeric object were instantiated.",!0),[];var s=this._getLocalList(),o=[];return r.forEach(function(e){var t=n.settings.createLocalList;a&&(n.settings.createLocalList=!1);var i=new I(e,D.getElementValue(e),n.settings);a&&(i._setLocalList(s),n._addToLocalList(e,i),n.settings.createLocalList=t),o.push(i)}),i?o[0]:o}},{key:"clear",value:function(e){if(0<arguments.length&&void 0!==e&&e){var t={emptyInputBehavior:I.options.emptyInputBehavior.focus};this.set("",t)}else this.set("");return this}},{key:"remove",value:function(){this._removeValueFromPersistentStorage(),this._removeEventListeners(),this._removeWatcher(),this._removeFromLocalList(this.domElement),this.constructor._removeFromGlobalList(this)}},{key:"wipe",value:function(){this._setElementValue("",!1),this.remove()}},{key:"nuke",value:function(){this.remove(),this.domElement.parentNode.removeChild(this.domElement)}},{key:"form",value:function(e){if(0<arguments.length&&void 0!==e&&e||D.isUndefinedOrNullOrEmpty(this.parentForm)){var t=this._getParentForm();if(!D.isNull(t)&&t!==this.parentForm){var i=this._getFormAutoNumericChildren(this.parentForm);this.parentForm.dataset.anCount=i.length,this._hasFormHandlerFunction(t)?this._incrementParentFormCounter(t):(this._storeFormHandlerFunction(t),this._initializeFormCounterToOne(t))}this.parentForm=t}return this.parentForm}},{key:"_getFormAutoNumericChildren",value:function(e){var t=this;return v(e.querySelectorAll("input")).filter(function(e){return t.constructor.isManagedByAutoNumeric(e)})}},{key:"_getParentForm",value:function(){if("body"===this.domElement.tagName.toLowerCase())return null;var e,t=this.domElement;do{if(t=t.parentNode,D.isNull(t))return null;if("body"===(e=t.tagName?t.tagName.toLowerCase():""))break}while("form"!==e);return"form"===e?t:null}},{key:"formNumericString",value:function(){return this.constructor._serializeNumericString(this.form(),this.settings.serializeSpaces)}},{key:"formFormatted",value:function(){return this.constructor._serializeFormatted(this.form(),this.settings.serializeSpaces)}},{key:"formLocalized",value:function(e){var t,i=0<arguments.length&&void 0!==e?e:null;return t=D.isNull(i)?this.settings.outputFormat:i,this.constructor._serializeLocalized(this.form(),this.settings.serializeSpaces,t)}},{key:"formArrayNumericString",value:function(){return this.constructor._serializeNumericStringArray(this.form(),this.settings.serializeSpaces)}},{key:"formArrayFormatted",value:function(){return this.constructor._serializeFormattedArray(this.form(),this.settings.serializeSpaces)}},{key:"formArrayLocalized",value:function(e){var t,i=0<arguments.length&&void 0!==e?e:null;return t=D.isNull(i)?this.settings.outputFormat:i,this.constructor._serializeLocalizedArray(this.form(),this.settings.serializeSpaces,t)}},{key:"formJsonNumericString",value:function(){return JSON.stringify(this.formArrayNumericString())}},{key:"formJsonFormatted",value:function(){return JSON.stringify(this.formArrayFormatted())}},{key:"formJsonLocalized",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return JSON.stringify(this.formArrayLocalized(t))}},{key:"formUnformat",value:function(){return this.constructor._getChildANInputElement(this.form()).forEach(function(e){I.getAutoNumericElement(e).unformat()}),this}},{key:"formUnformatLocalized",value:function(){return this.constructor._getChildANInputElement(this.form()).forEach(function(e){I.getAutoNumericElement(e).unformatLocalized()}),this}},{key:"formReformat",value:function(){return this.constructor._getChildANInputElement(this.form()).forEach(function(e){I.getAutoNumericElement(e).reformat()}),this}},{key:"formSubmitNumericString",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return D.isNull(t)?(this.formUnformat(),this.form().submit(),this.formReformat()):D.isFunction(t)?t(this.formNumericString()):D.throwError("The given callback is not a function."),this}},{key:"formSubmitFormatted",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return D.isNull(t)?this.form().submit():D.isFunction(t)?t(this.formFormatted()):D.throwError("The given callback is not a function."),this}},{key:"formSubmitLocalized",value:function(e,t){var i=0<arguments.length&&void 0!==e?e:null,n=1<arguments.length&&void 0!==t?t:null;return D.isNull(n)?(this.formUnformatLocalized(),this.form().submit(),this.formReformat()):D.isFunction(n)?n(this.formLocalized(i)):D.throwError("The given callback is not a function."),this}},{key:"formSubmitArrayNumericString",value:function(e){return D.isFunction(e)?e(this.formArrayNumericString()):D.throwError("The given callback is not a function."),this}},{key:"formSubmitArrayFormatted",value:function(e){return D.isFunction(e)?e(this.formArrayFormatted()):D.throwError("The given callback is not a function."),this}},{key:"formSubmitArrayLocalized",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return D.isFunction(e)?e(this.formArrayLocalized(i)):D.throwError("The given callback is not a function."),this}},{key:"formSubmitJsonNumericString",value:function(e){return D.isFunction(e)?e(this.formJsonNumericString()):D.throwError("The given callback is not a function."),this}},{key:"formSubmitJsonFormatted",value:function(e){return D.isFunction(e)?e(this.formJsonFormatted()):D.throwError("The given callback is not a function."),this}},{key:"formSubmitJsonLocalized",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return D.isFunction(e)?e(this.formJsonLocalized(i)):D.throwError("The given callback is not a function."),this}},{key:"_createLocalList",value:function(){this.autoNumericLocalList=new Map,this._addToLocalList(this.domElement)}},{key:"_deleteLocalList",value:function(){delete this.autoNumericLocalList}},{key:"_setLocalList",value:function(e){this.autoNumericLocalList=e}},{key:"_getLocalList",value:function(){return this.autoNumericLocalList}},{key:"_hasLocalList",value:function(){return this.autoNumericLocalList instanceof Map&&0!==this.autoNumericLocalList.size}},{key:"_addToLocalList",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;D.isNull(i)&&(i=this),D.isUndefined(this.autoNumericLocalList)?D.throwError("The local list provided does not exists when trying to add an element. [".concat(this.autoNumericLocalList,"] given.")):this.autoNumericLocalList.set(e,i)}},{key:"_removeFromLocalList",value:function(e){D.isUndefined(this.autoNumericLocalList)?this.settings.createLocalList&&D.throwError("The local list provided does not exists when trying to remove an element. [".concat(this.autoNumericLocalList,"] given.")):this.autoNumericLocalList.delete(e)}},{key:"_mergeSettings",value:function(){for(var e=arguments.length,t=new Array(e),i=0;i<e;i++)t[i]=arguments[i];y.apply(void 0,[this.settings].concat(t))}},{key:"_cloneAndMergeSettings",value:function(){for(var e={},t=arguments.length,i=new Array(t),n=0;n<t;n++)i[n]=arguments[n];return y.apply(void 0,[e,this.settings].concat(i)),e}},{key:"_updatePredefinedOptions",value:function(e,t){var i=1<arguments.length&&void 0!==t?t:null;return D.isNull(i)?this.update(e):(this._mergeSettings(e,i),this.update(this.settings)),this}},{key:"french",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().French,t),this}},{key:"northAmerican",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().NorthAmerican,t),this}},{key:"british",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().British,t),this}},{key:"swiss",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().Swiss,t),this}},{key:"japanese",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().Japanese,t),this}},{key:"spanish",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().Spanish,t),this}},{key:"chinese",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().Chinese,t),this}},{key:"brazilian",value:function(e){var t=0<arguments.length&&void 0!==e?e:null;return this._updatePredefinedOptions(I.getPredefinedOptions().Brazilian,t),this}},{key:"_runCallbacksFoundInTheSettingsObject",value:function(){for(var e in this.settings)if(Object.prototype.hasOwnProperty.call(this.settings,e)){var t=this.settings[e];if("function"==typeof t)this.settings[e]=t(this,e);else{var i=this.domElement.getAttribute(e);i=D.camelize(i),"function"==typeof this.settings[i]&&(this.settings[e]=i(this,e))}}}},{key:"_setTrailingNegativeSignInfo",value:function(){this.isTrailingNegative=this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix&&this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.suffix||this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix&&(this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.left||this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.right)}},{key:"_modifyNegativeSignAndDecimalCharacterForRawValue",value:function(e){return"."!==this.settings.decimalCharacter&&(e=e.replace(this.settings.decimalCharacter,".")),"-"!==this.settings.negativeSignCharacter&&this.settings.isNegativeSignAllowed&&(e=e.replace(this.settings.negativeSignCharacter,"-")),e.match(/\d/)||(e+="0"),e}},{key:"_initialCaretPosition",value:function(e){D.isNull(this.settings.caretPositionOnFocus)&&this.settings.selectOnFocus===I.options.selectOnFocus.doNotSelect&&D.throwError("`_initialCaretPosition()` should never be called when the `caretPositionOnFocus` option is `null`.");var t=this.rawValue<0,i=D.isZeroOrHasNoValue(e),n=e.length,a=0,r=0,s=!1,o=0;this.settings.caretPositionOnFocus!==I.options.caretPositionOnFocus.start&&(a=(e=(e=(e=e.replace(this.settings.negativeSignCharacter,"")).replace(this.settings.positiveSignCharacter,"")).replace(this.settings.currencySymbol,"")).length,s=D.contains(e,this.settings.decimalCharacter),this.settings.caretPositionOnFocus!==I.options.caretPositionOnFocus.decimalLeft&&this.settings.caretPositionOnFocus!==I.options.caretPositionOnFocus.decimalRight||(o=s?(r=e.indexOf(this.settings.decimalCharacter),this.settings.decimalCharacter.length):(r=a,0)));var l="";t?l=this.settings.negativeSignCharacter:this.settings.showPositiveSign&&!i&&(l=this.settings.positiveSignCharacter);var c,u=l.length,h=this.settings.currencySymbol.length;if(this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix){if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.start)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.prefix:case I.options.negativePositiveSignPlacement.left:case I.options.negativePositiveSignPlacement.right:c=u+h;break;case I.options.negativePositiveSignPlacement.suffix:c=h}else c=h;else if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.end)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.prefix:case I.options.negativePositiveSignPlacement.left:case I.options.negativePositiveSignPlacement.right:c=n;break;case I.options.negativePositiveSignPlacement.suffix:c=h+a}else c=n;else if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.decimalLeft)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.prefix:case I.options.negativePositiveSignPlacement.left:case I.options.negativePositiveSignPlacement.right:c=u+h+r;break;case I.options.negativePositiveSignPlacement.suffix:c=h+r}else c=h+r;else if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.decimalRight)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.prefix:case I.options.negativePositiveSignPlacement.left:case I.options.negativePositiveSignPlacement.right:c=u+h+r+o;break;case I.options.negativePositiveSignPlacement.suffix:c=h+r+o}else c=h+r+o}else if(this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix)if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.start)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.suffix:case I.options.negativePositiveSignPlacement.right:case I.options.negativePositiveSignPlacement.left:c=0;break;case I.options.negativePositiveSignPlacement.prefix:c=u}else c=0;else if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.end)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.suffix:case I.options.negativePositiveSignPlacement.right:case I.options.negativePositiveSignPlacement.left:c=a;break;case I.options.negativePositiveSignPlacement.prefix:c=u+a}else c=a;else if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.decimalLeft)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.suffix:case I.options.negativePositiveSignPlacement.right:case I.options.negativePositiveSignPlacement.left:c=r;break;case I.options.negativePositiveSignPlacement.prefix:c=u+r}else c=r;else if(this.settings.caretPositionOnFocus===I.options.caretPositionOnFocus.decimalRight)if(this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.none&&(t||!t&&this.settings.showPositiveSign&&!i))switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.suffix:case I.options.negativePositiveSignPlacement.right:case I.options.negativePositiveSignPlacement.left:c=r+o;break;case I.options.negativePositiveSignPlacement.prefix:c=u+r+o}else c=r+o;return c}},{key:"_keepAnOriginalSettingsCopy",value:function(){this.originalDigitGroupSeparator=this.settings.digitGroupSeparator,this.originalCurrencySymbol=this.settings.currencySymbol,this.originalSuffixText=this.settings.suffixText}},{key:"_trimLeadingAndTrailingZeros",value:function(e){if(""===e||null===e)return e;if(this.settings.leadingZero!==I.options.leadingZero.keep){if(0===Number(e))return"0";e=e.replace(/^(-)?0+(?=\d)/g,"$1")}return D.contains(e,".")&&(e=e.replace(/(\.[0-9]*?)0+$/,"$1")),e.replace(/\.$/,"")}},{key:"_setPersistentStorageName",value:function(){this.settings.saveValueToSessionStorage&&(""===this.domElement.name||D.isUndefined(this.domElement.name)?this.rawValueStorageName="".concat(this.storageNamePrefix).concat(this.domElement.id):this.rawValueStorageName="".concat(this.storageNamePrefix).concat(decodeURIComponent(this.domElement.name)))}},{key:"_saveValueToPersistentStorage",value:function(){this.settings.saveValueToSessionStorage&&(this.sessionStorageAvailable?sessionStorage.setItem(this.rawValueStorageName,this.rawValue):document.cookie="".concat(this.rawValueStorageName,"=").concat(this.rawValue,"; expires= ; path=/"))}},{key:"_getValueFromPersistentStorage",value:function(){return this.settings.saveValueToSessionStorage?this.sessionStorageAvailable?sessionStorage.getItem(this.rawValueStorageName):this.constructor._readCookie(this.rawValueStorageName):(D.warning("`_getValueFromPersistentStorage()` is called but `settings.saveValueToSessionStorage` is false. There must be an error that needs fixing.",this.settings.showWarnings),null)}},{key:"_removeValueFromPersistentStorage",value:function(){if(this.settings.saveValueToSessionStorage)if(this.sessionStorageAvailable)sessionStorage.removeItem(this.rawValueStorageName);else{var e=new Date;e.setTime(e.getTime()-864e5);var t="; expires=".concat(e.toUTCString());document.cookie="".concat(this.rawValueStorageName,"='' ;").concat(t,"; path=/")}}},{key:"_getDefaultValue",value:function(e){var t=e.getAttribute("value");return D.isNull(t)?"":t}},{key:"_onFocusInAndMouseEnter",value:function(e){if(this.isEditing=!1,!this.formulaMode&&this.settings.unformatOnHover&&"mouseenter"===e.type&&e.altKey)this.constructor._unformatAltHovered(this);else if("focus"===e.type&&(this.isFocused=!0,this.rawValueOnFocus=this.rawValue),"focus"===e.type&&this.settings.unformatOnHover&&this.hoveredWithAlt&&this.constructor._reformatAltHovered(this),"focus"===e.type||"mouseenter"===e.type&&!this.isFocused){var t=null;this.settings.emptyInputBehavior===I.options.emptyInputBehavior.focus&&this.rawValue<0&&null!==this.settings.negativeBracketsTypeOnBlur&&this.settings.isNegativeSignAllowed&&(t=this.constructor._removeBrackets(D.getElementValue(this.domElement),this.settings));var i=this._getRawValueToFormat(this.rawValue);if(""!==i){var n=this.constructor._roundFormattedValueShownOnFocusOrBlur(i,this.settings,this.isFocused);t=this.settings.showOnlyNumbersOnFocus===I.options.showOnlyNumbersOnFocus.onlyNumbers?(this.settings.digitGroupSeparator="",this.settings.currencySymbol="",this.settings.suffixText="",n.replace(".",this.settings.decimalCharacter)):D.isNull(n)?"":this.constructor._addGroupSeparators(n.replace(".",this.settings.decimalCharacter),this.settings,this.isFocused,i)}D.isNull(t)?this.valueOnFocus="":this.valueOnFocus=t,this.lastVal=this.valueOnFocus;var a=this.constructor._isElementValueEmptyOrOnlyTheNegativeSign(this.valueOnFocus,this.settings),r=this.constructor._orderValueCurrencySymbolAndSuffixText(this.valueOnFocus,this.settings,!0),s=a&&""!==r&&this.settings.emptyInputBehavior===I.options.emptyInputBehavior.focus;s&&(t=r),D.isNull(t)||this._setElementValue(t),s&&r===this.settings.currencySymbol&&this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix&&D.setElementSelection(e.target,0)}}},{key:"_onFocus",value:function(){this.settings.isCancellable&&this._saveCancellableValue()}},{key:"_onFocusIn",value:function(e){this.settings.selectOnFocus?this.select():D.isNull(this.settings.caretPositionOnFocus)||D.setElementSelection(e.target,this._initialCaretPosition(D.getElementValue(this.domElement)))}},{key:"_enterFormulaMode",value:function(){this.settings.formulaMode&&(this.formulaMode=!0,D.setElementValue(this.domElement,"="),D.setElementSelection(this.domElement,1))}},{key:"_exitFormulaMode",value:function(){var e,t=D.getElementValue(this.domElement);t=t.replace(/^\s*=/,"");try{var i=new m(t,this.settings.decimalCharacter);e=(new s).evaluate(i)}catch(e){return this._triggerEvent(I.events.invalidFormula,this.domElement,{formula:t,aNElement:this}),this.reformat(),void(this.formulaMode=!1)}this._triggerEvent(I.events.validFormula,this.domElement,{formula:t,result:e,aNElement:this}),this.set(e),this.formulaMode=!1}},{key:"_acceptNonPrintableKeysInFormulaMode",value:function(){return this.eventKey===d.keyName.Backspace||this.eventKey===d.keyName.Delete||this.eventKey===d.keyName.LeftArrow||this.eventKey===d.keyName.RightArrow||this.eventKey===d.keyName.Home||this.eventKey===d.keyName.End}},{key:"_onKeydown",value:function(e){if(this.formatted=!1,this.isEditing=!0,this.formulaMode||this.isFocused||!this.settings.unformatOnHover||!e.altKey||this.domElement!==D.getHoveredElement()){if(this._updateEventKeyInfo(e),this.keydownEventCounter+=1,1===this.keydownEventCounter&&(this.initialValueOnFirstKeydown=D.getElementValue(e.target),this.initialRawValueOnFirstKeydown=this.rawValue),this.formulaMode){if(this.eventKey===d.keyName.Esc)return this.formulaMode=!1,void this.reformat();if(this.eventKey===d.keyName.Enter)return void this._exitFormulaMode();if(this._acceptNonPrintableKeysInFormulaMode())return}else if(this.eventKey===d.keyName.Equal)return void this._enterFormulaMode();if(this.domElement.readOnly||this.settings.readOnly||this.domElement.disabled)this.processed=!0;else{this.eventKey===d.keyName.Esc&&(e.preventDefault(),this.settings.isCancellable&&this.rawValue!==this.savedCancellableValue&&(this.set(this.savedCancellableValue),this._triggerEvent(I.events.native.input,e.target)),this.select());var t=D.getElementValue(e.target);this.eventKey===d.keyName.Enter&&this.rawValue!==this.rawValueOnFocus&&(this._triggerEvent(I.events.native.change,e.target),this.valueOnFocus=t,this.rawValueOnFocus=this.rawValue,this.settings.isCancellable&&this._saveCancellableValue()),this._updateInternalProperties(e),this._processNonPrintableKeysAndShortcuts(e)?this.processed=!0:this.eventKey!==d.keyName.Backspace&&this.eventKey!==d.keyName.Delete||(this._processCharacterDeletion(),this.processed=!0,this._formatValue(e),(t=D.getElementValue(e.target))!==this.lastVal&&this.throwInput&&(this._triggerEvent(I.events.native.input,e.target),e.preventDefault()),this.lastVal=t,this.throwInput=!0)}}else this.constructor._unformatAltHovered(this)}},{key:"_onKeypress",value:function(e){if(this.formulaMode){if(this._acceptNonPrintableKeysInFormulaMode())return;if(this.settings.formulaChars.test(this.eventKey))return;e.preventDefault()}else if(this.eventKey!==d.keyName.Insert){var t=this.processed;if(this._updateInternalProperties(e),!this._processNonPrintableKeysAndShortcuts(e))if(t)e.preventDefault();else{if(this._processCharacterInsertion()){this._formatValue(e);var i=D.getElementValue(e.target);if(i!==this.lastVal&&this.throwInput)this._triggerEvent(I.events.native.input,e.target),e.preventDefault();else{if((this.eventKey===this.settings.decimalCharacter||this.eventKey===this.settings.decimalCharacterAlternative)&&D.getElementSelection(e.target).start===D.getElementSelection(e.target).end&&D.getElementSelection(e.target).start===i.indexOf(this.settings.decimalCharacter)){var n=D.getElementSelection(e.target).start+1;D.setElementSelection(e.target,n)}e.preventDefault()}return this.lastVal=D.getElementValue(e.target),void(this.throwInput=!0)}e.preventDefault()}}}},{key:"_onKeyup",value:function(e){if(this.isEditing=!1,this.keydownEventCounter=0,!this.formulaMode)if(this.settings.isCancellable&&this.eventKey===d.keyName.Esc)e.preventDefault();else{if(this.eventKey===d.keyName.Z||this.eventKey===d.keyName.z){if(e.ctrlKey&&e.shiftKey)return e.preventDefault(),this._historyTableRedo(),void(this.onGoingRedo=!0);if(e.ctrlKey&&!e.shiftKey){if(!this.onGoingRedo)return e.preventDefault(),void this._historyTableUndo();this.onGoingRedo=!1}}if(this.onGoingRedo&&(e.ctrlKey||e.shiftKey)&&(this.onGoingRedo=!1),(e.ctrlKey||e.metaKey)&&this.eventKey===d.keyName.x){var t=D.getElementSelection(this.domElement).start,i=this.constructor._toNumericValue(D.getElementValue(e.target),this.settings);this.set(i),this._setCaretPosition(t)}if(this.eventKey===d.keyName.Alt&&this.settings.unformatOnHover&&this.hoveredWithAlt)this.constructor._reformatAltHovered(this);else if(!e.ctrlKey&&!e.metaKey||this.eventKey!==d.keyName.Backspace&&this.eventKey!==d.keyName.Delete){this._updateInternalProperties(e);var n=this._processNonPrintableKeysAndShortcuts(e);delete this.valuePartsBeforePaste;var a=D.getElementValue(e.target);if(!(n||""===a&&""===this.initialValueOnFirstKeydown)&&(a===this.settings.currencySymbol?this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix?D.setElementSelection(e.target,0):D.setElementSelection(e.target,this.settings.currencySymbol.length):this.eventKey===d.keyName.Tab&&D.setElementSelection(e.target,0,a.length),(a===this.settings.suffixText||""===this.rawValue&&""!==this.settings.currencySymbol&&""!==this.settings.suffixText)&&D.setElementSelection(e.target,0),null!==this.settings.decimalPlacesShownOnFocus&&this._saveValueToPersistentStorage(),this.formatted||this._formatValue(e),this._saveRawValueForAndroid(),a!==this.initialValueOnFirstKeydown&&this._triggerEvent(I.events.formatted,e.target,{oldValue:this.initialValueOnFirstKeydown,newValue:a,oldRawValue:this.initialRawValueOnFirstKeydown,newRawValue:this.rawValue,isPristine:this.isPristine(!1),error:null,aNElement:this}),1<this.historyTable.length)){var r=D.getElementSelection(this.domElement);this.selectionStart=r.start,this.selectionEnd=r.end,this.historyTable[this.historyTableIndex].start=this.selectionStart,this.historyTable[this.historyTableIndex].end=this.selectionEnd}}else{var s=D.getElementValue(e.target);this._setRawValue(this._formatOrUnformatOther(!1,s))}}}},{key:"_saveRawValueForAndroid",value:function(){if(this.eventKey===d.keyName.AndroidDefault){var e=this.constructor._stripAllNonNumberCharactersExceptCustomDecimalChar(this.getFormatted(),this.settings,!0,this.isFocused);e=this.constructor._convertToNumericString(e,this.settings),this._setRawValue(e)}}},{key:"_onFocusOutAndMouseLeave",value:function(e){if(this.isEditing=!1,"mouseleave"!==e.type||!this.formulaMode)if(this.settings.unformatOnHover&&"mouseleave"===e.type&&this.hoveredWithAlt)this.constructor._reformatAltHovered(this);else if("mouseleave"===e.type&&!this.isFocused||"blur"===e.type){"blur"===e.type&&this.formulaMode&&this._exitFormulaMode(),this._saveValueToPersistentStorage(),this.settings.showOnlyNumbersOnFocus===I.options.showOnlyNumbersOnFocus.onlyNumbers&&(this.settings.digitGroupSeparator=this.originalDigitGroupSeparator,this.settings.currencySymbol=this.originalCurrencySymbol,this.settings.suffixText=this.originalSuffixText);var t=this._getRawValueToFormat(this.rawValue),i=D.isNull(t),n=S(this.constructor._checkIfInRangeWithOverrideOption(t,this.settings),2),a=n[0],r=n[1],s=!1;if(""===t||i||(a||this._triggerEvent(I.events.minRangeExceeded,this.domElement),r||this._triggerEvent(I.events.maxRangeExceeded,this.domElement),this.settings.valuesToStrings&&this._checkValuesToStrings(t)&&(this._setElementValue(this.settings.valuesToStrings[t]),s=!0)),!s){var o;if(o=i||""===t?t:String(t),""===t||i){if(""===t)switch(this.settings.emptyInputBehavior){case I.options.emptyInputBehavior.zero:this._setRawValue("0"),o=this.constructor._roundValue("0",this.settings,0);break;case I.options.emptyInputBehavior.min:this._setRawValue(this.settings.minimumValue),o=this.constructor._roundFormattedValueShownOnFocusOrBlur(this.settings.minimumValue,this.settings,this.isFocused);break;case I.options.emptyInputBehavior.max:this._setRawValue(this.settings.maximumValue),o=this.constructor._roundFormattedValueShownOnFocusOrBlur(this.settings.maximumValue,this.settings,this.isFocused);break;default:D.isNumber(this.settings.emptyInputBehavior)&&(this._setRawValue(this.settings.emptyInputBehavior),o=this.constructor._roundFormattedValueShownOnFocusOrBlur(this.settings.emptyInputBehavior,this.settings,this.isFocused))}}else a&&r&&!this.constructor._isElementValueEmptyOrOnlyTheNegativeSign(t,this.settings)?(o=this._modifyNegativeSignAndDecimalCharacterForRawValue(o),this.settings.divisorWhenUnfocused&&!D.isNull(o)&&(o=(o/=this.settings.divisorWhenUnfocused).toString()),o=this.constructor._roundFormattedValueShownOnBlur(o,this.settings),o=this.constructor._modifyNegativeSignAndDecimalCharacterForFormattedValue(o,this.settings)):(a||this._triggerEvent(I.events.minRangeExceeded,this.domElement),r||this._triggerEvent(I.events.maxRangeExceeded,this.domElement));var l=this.constructor._orderValueCurrencySymbolAndSuffixText(o,this.settings,!1);this.constructor._isElementValueEmptyOrOnlyTheNegativeSign(o,this.settings)||i&&this.settings.emptyInputBehavior===I.options.emptyInputBehavior.null||(l=this.constructor._addGroupSeparators(o,this.settings,!1,t)),l===t&&""!==t&&this.settings.allowDecimalPadding!==I.options.allowDecimalPadding.never&&this.settings.allowDecimalPadding!==I.options.allowDecimalPadding.floats||(this.settings.symbolWhenUnfocused&&""!==t&&null!==t&&(l="".concat(l).concat(this.settings.symbolWhenUnfocused)),this._setElementValue(l))}"blur"===e.type&&this._onBlur(e)}}},{key:"_onPaste",value:function(e){if(e.preventDefault(),!(this.settings.readOnly||this.domElement.readOnly||this.domElement.disabled)){var t,i;window.clipboardData&&window.clipboardData.getData?t=window.clipboardData.getData("Text"):e.clipboardData&&e.clipboardData.getData?t=e.clipboardData.getData("text/plain"):D.throwError("Unable to retrieve the pasted value. Please use a modern browser (ie. Firefox or Chromium)."),i=e.target.tagName?e.target:e.explicitOriginalTarget;var n=D.getElementValue(i),a=i.selectionStart||0,r=i.selectionEnd||0,s=r-a;if(s===n.length){var o=this._preparePastedText(t),l=D.arabicToLatinNumbers(o,!1,!1,!1);return"."===l||""===l||"."!==l&&!D.isNumber(l)?(this.formatted=!0,void(this.settings.onInvalidPaste===I.options.onInvalidPaste.error&&D.throwError("The pasted value '".concat(t,"' is not a valid paste content.")))):(this.set(l),this.formatted=!0,void this._triggerEvent(I.events.native.input,i))}var c=D.isNegativeStrict(t,this.settings.negativeSignCharacter);c&&(t=t.slice(1,t.length));var u,h,m=this._preparePastedText(t);if("."!==(u="."===m?".":D.arabicToLatinNumbers(m,!1,!1,!1))&&(!D.isNumber(u)||""===u))return this.formatted=!0,void(this.settings.onInvalidPaste===I.options.onInvalidPaste.error&&D.throwError("The pasted value '".concat(t,"' is not a valid paste content.")));var g,d,v=D.isNegativeStrict(this.getNumericString(),this.settings.negativeSignCharacter);g=!(!c||v)&&(v=!0);var p=n.slice(0,a),f=n.slice(r,n.length);d=a!==r?this._preparePastedText(p+f):this._preparePastedText(n),v&&(d=D.setRawNegativeSign(d)),h=D.convertCharacterCountToIndexPosition(D.countNumberCharactersOnTheCaretLeftSide(n,a,this.settings.decimalCharacter)),g&&h++;var y=d.slice(0,h),S=d.slice(h,d.length),b=!1;"."===u&&(D.contains(y,".")&&(b=!0,y=y.replace(".","")),S=S.replace(".",""));var w=!1;switch(""===y&&"-"===S&&(y="-",w=!(S="")),this.settings.onInvalidPaste){case I.options.onInvalidPaste.truncate:case I.options.onInvalidPaste.replace:for(var P=D.parseStr(this.settings.minimumValue),O=D.parseStr(this.settings.maximumValue),k=d,N=0,E=y;N<u.length&&(d=(E+=u[N])+S,this.constructor._checkIfInRange(d,P,O));)k=d,N++;if(h+=N,w&&h++,this.settings.onInvalidPaste===I.options.onInvalidPaste.truncate){d=k,b&&h--;break}for(var _=h,C=k.length;N<u.length&&_<C;)if("."!==k[_]){if(d=D.replaceCharAt(k,_,u[N]),!this.constructor._checkIfInRange(d,P,O))break;k=d,N++,_++}else _++;h=_,b&&h--,d=k;break;case I.options.onInvalidPaste.error:case I.options.onInvalidPaste.ignore:case I.options.onInvalidPaste.clamp:default:if(d="".concat(y).concat(u).concat(S),a===r)h=D.convertCharacterCountToIndexPosition(D.countNumberCharactersOnTheCaretLeftSide(n,a,this.settings.decimalCharacter))+u.length;else if(""===S)h=D.convertCharacterCountToIndexPosition(D.countNumberCharactersOnTheCaretLeftSide(n,a,this.settings.decimalCharacter))+u.length,w&&h++;else{var F=D.convertCharacterCountToIndexPosition(D.countNumberCharactersOnTheCaretLeftSide(n,r,this.settings.decimalCharacter)),x=D.getElementValue(i).slice(a,r);h=F-s+D.countCharInText(this.settings.digitGroupSeparator,x)+u.length}g&&h++,b&&h--}if(D.isNumber(d)&&""!==d){var V=!1,T=!1;try{this.set(d),V=!0}catch(e){var A;switch(this.settings.onInvalidPaste){case I.options.onInvalidPaste.clamp:A=D.clampToRangeLimits(d,this.settings);try{this.set(A)}catch(e){D.throwError("Fatal error: Unable to set the clamped value '".concat(A,"'."))}V=T=!0,d=A;break;case I.options.onInvalidPaste.error:case I.options.onInvalidPaste.truncate:case I.options.onInvalidPaste.replace:D.throwError("The pasted value '".concat(t,"' results in a value '").concat(d,"' that is outside of the minimum [").concat(this.settings.minimumValue,"] and maximum [").concat(this.settings.maximumValue,"] value range."));case I.options.onInvalidPaste.ignore:default:return}}var L,B=D.getElementValue(i);if(V)switch(this.settings.onInvalidPaste){case I.options.onInvalidPaste.clamp:if(T){this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix?D.setElementSelection(i,B.length-this.settings.currencySymbol.length):D.setElementSelection(i,B.length);break}case I.options.onInvalidPaste.error:case I.options.onInvalidPaste.ignore:case I.options.onInvalidPaste.truncate:case I.options.onInvalidPaste.replace:default:L=D.findCaretPositionInFormattedNumber(d,h,B,this.settings.decimalCharacter),D.setElementSelection(i,L)}V&&n!==B&&this._triggerEvent(I.events.native.input,i)}else this.settings.onInvalidPaste===I.options.onInvalidPaste.error&&D.throwError("The pasted value '".concat(t,"' would result into an invalid content '").concat(d,"'."))}}},{key:"_onBlur",value:function(e){this.isFocused=!1,this.isEditing=!1,this.rawValue!==this.rawValueOnFocus&&this._triggerEvent(I.events.native.change,e.target),this.rawValueOnFocus=void 0}},{key:"_onWheel",value:function(e){this.formulaMode||this.settings.readOnly||this.domElement.readOnly||this.domElement.disabled||this.settings.modifyValueOnWheel&&(this.settings.wheelOn===I.options.wheelOn.focus?this.isFocused?e.shiftKey||this.wheelAction(e):e.shiftKey&&this.wheelAction(e):this.settings.wheelOn===I.options.wheelOn.hover?e.shiftKey?(e.preventDefault(),window.scrollBy(0,D.isNegativeStrict(String(e.deltaY))?-50:50)):this.wheelAction(e):D.throwError("Unknown `wheelOn` option."))}},{key:"wheelAction",value:function(e){this.isWheelEvent=!0;var t,i=e.target.selectionStart||0,n=e.target.selectionEnd||0,a=this.rawValue;if(D.isUndefinedOrNullOrEmpty(a)?0<this.settings.minimumValue||this.settings.maximumValue<0?D.isWheelUpEvent(e)?t=this.settings.minimumValue:D.isWheelDownEvent(e)?t=this.settings.maximumValue:D.throwError("The event is not a 'wheel' event."):t=0:t=a,t=+t,D.isNumber(this.settings.wheelStep)){var r=+this.settings.wheelStep;D.isWheelUpEvent(e)?t+=r:D.isWheelDownEvent(e)&&(t-=r)}else D.isWheelUpEvent(e)?t=D.addAndRoundToNearestAuto(t,this.settings.decimalPlacesRawValue):D.isWheelDownEvent(e)&&(t=D.subtractAndRoundToNearestAuto(t,this.settings.decimalPlacesRawValue));(t=D.clampToRangeLimits(t,this.settings))!==+a&&(this.set(t),this._triggerEvent(I.events.native.input,e.target)),e.preventDefault(),this._setSelection(i,n),this.isWheelEvent=!1}},{key:"_onDrop",value:function(e){if(!this.formulaMode){var t;this.isDropEvent=!0,e.preventDefault(),t=D.isIE11()?"text":"text/plain";var i=e.dataTransfer.getData(t),n=this.unformatOther(i);this.set(n),this.isDropEvent=!1}}},{key:"_onFormSubmit",value:function(){var t=this;return this._getFormAutoNumericChildren(this.parentForm).map(function(e){return t.constructor.getAutoNumericElement(e)}).forEach(function(e){return e._unformatOnSubmit()}),!0}},{key:"_onFormReset",value:function(){var i=this;this._getFormAutoNumericChildren(this.parentForm).map(function(e){return i.constructor.getAutoNumericElement(e)}).forEach(function(e){var t=i._getDefaultValue(e.node());setTimeout(function(){return e.set(t)},0)})}},{key:"_unformatOnSubmit",value:function(){this.settings.unformatOnSubmit&&this._setElementValue(this.rawValue)}},{key:"_onKeydownGlobal",value:function(e){if(D.character(e)===d.keyName.Alt){var t=D.getHoveredElement();if(I.isManagedByAutoNumeric(t)){var i=I.getAutoNumericElement(t);!i.formulaMode&&i.settings.unformatOnHover&&this.constructor._unformatAltHovered(i)}}}},{key:"_onKeyupGlobal",value:function(e){if(D.character(e)===d.keyName.Alt){var t=D.getHoveredElement();if(I.isManagedByAutoNumeric(t)){var i=I.getAutoNumericElement(t);if(i.formulaMode||!i.settings.unformatOnHover)return;this.constructor._reformatAltHovered(i)}}}},{key:"_isElementTagSupported",value:function(){return D.isElement(this.domElement)||D.throwError("The DOM element is not valid, ".concat(this.domElement," given.")),D.isInArray(this.domElement.tagName.toLowerCase(),this.allowedTagList)}},{key:"_isInputElement",value:function(){return"input"===this.domElement.tagName.toLowerCase()}},{key:"_isInputTypeSupported",value:function(){return"text"===this.domElement.type||"hidden"===this.domElement.type||"tel"===this.domElement.type||D.isUndefinedOrNullOrEmpty(this.domElement.type)}},{key:"_checkElement",value:function(){var e=this.domElement.tagName.toLowerCase();this._isElementTagSupported()||D.throwError("The <".concat(e,"> tag is not supported by autoNumeric")),this._isInputElement()?(this._isInputTypeSupported()||D.throwError('The input type "'.concat(this.domElement.type,'" is not supported by autoNumeric')),this.isInputElement=!0):(this.isInputElement=!1,this.isContentEditable=this.domElement.hasAttribute("contenteditable")&&"true"===this.domElement.getAttribute("contenteditable"))}},{key:"_formatDefaultValueOnPageLoad",value:function(e){var t,i=0<arguments.length&&void 0!==e?e:null,n=!0;if(D.isNull(i)?(t=D.getElementValue(this.domElement).trim(),this.domElement.setAttribute("value",t)):t=i,this.isInputElement||this.isContentEditable){var a=this.constructor._toNumericValue(t,this.settings);if(this.domElement.hasAttribute("value")&&""!==this.domElement.getAttribute("value")){if(null!==this.settings.defaultValueOverride&&this.settings.defaultValueOverride.toString()!==t||null===this.settings.defaultValueOverride&&""!==t&&t!==this.domElement.getAttribute("value")||""!==t&&"hidden"===this.domElement.getAttribute("type")&&!D.isNumber(a)){if(this.settings.saveValueToSessionStorage&&(null!==this.settings.decimalPlacesShownOnFocus||this.settings.divisorWhenUnfocused)&&this._setRawValue(this._getValueFromPersistentStorage()),!this.settings.saveValueToSessionStorage){var r=this.constructor._removeBrackets(t,this.settings);(this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.suffix||this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.prefix&&this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix)&&""!==this.settings.negativeSignCharacter&&D.isNegative(t,this.settings.negativeSignCharacter)?this._setRawValue("-".concat(this.constructor._stripAllNonNumberCharacters(r,this.settings,!0,this.isFocused))):this._setRawValue(this.constructor._stripAllNonNumberCharacters(r,this.settings,!0,this.isFocused))}n=!1}}else isNaN(Number(a))||1/0===a?D.throwError("The value [".concat(t,"] used in the input is not a valid value autoNumeric can work with.")):(this.set(a),n=!1);if(""===t)switch(this.settings.emptyInputBehavior){case I.options.emptyInputBehavior.focus:case I.options.emptyInputBehavior.null:case I.options.emptyInputBehavior.press:break;case I.options.emptyInputBehavior.always:this._setElementValue(this.settings.currencySymbol);break;case I.options.emptyInputBehavior.min:this.set(this.settings.minimumValue);break;case I.options.emptyInputBehavior.max:this.set(this.settings.maximumValue);break;case I.options.emptyInputBehavior.zero:this.set("0");break;default:this.set(this.settings.emptyInputBehavior)}else n&&t===this.domElement.getAttribute("value")&&this.set(t)}else null!==this.settings.defaultValueOverride&&this.settings.defaultValueOverride!==t||this.set(t)}},{key:"_calculateVMinAndVMaxIntegerSizes",value:function(){var e=S(this.settings.maximumValue.toString().split("."),1)[0],t=S(this.settings.minimumValue||0===this.settings.minimumValue?this.settings.minimumValue.toString().split("."):[],1)[0];e=e.replace(this.settings.negativeSignCharacter,""),t=t.replace(this.settings.negativeSignCharacter,""),this.settings.mIntPos=Math.max(e.length,1),this.settings.mIntNeg=Math.max(t.length,1)}},{key:"_calculateValuesToStringsKeys",value:function(){this.settings.valuesToStrings?this.valuesToStringsKeys=Object.keys(this.settings.valuesToStrings):this.valuesToStringsKeys=[]}},{key:"_transformOptionsValuesToDefaultTypes",value:function(){for(var e in this.settings)if(Object.prototype.hasOwnProperty.call(this.settings,e)){var t=this.settings[e];"true"!==t&&"false"!==t||(this.settings[e]="true"===t),"number"==typeof t&&(this.settings[e]=t.toString())}}},{key:"_setSettings",value:function(e,t){var i=1<arguments.length&&void 0!==t&&t;!i&&D.isNull(e)||this.constructor._convertOldOptionsToNewOnes(e),i?("decimalPlacesRawValue"in e&&(this.settings.originalDecimalPlacesRawValue=e.decimalPlacesRawValue),"decimalPlaces"in e&&(this.settings.originalDecimalPlaces=e.decimalPlaces),this.constructor._calculateDecimalPlacesOnUpdate(e,this.settings),this._mergeSettings(e)):(this.settings={},this._mergeSettings(this.constructor.getDefaultConfig(),this.domElement.dataset,e,{rawValue:this.defaultRawValue}),this.caretFix=!1,this.throwInput=!0,this.allowedTagList=d.allowedTagList,this.runOnce=!1,this.hoveredWithAlt=!1),this._transformOptionsValuesToDefaultTypes(),this._runCallbacksFoundInTheSettingsObject(),this.constructor._correctNegativePositiveSignPlacementOption(this.settings),this.constructor._correctCaretPositionOnFocusAndSelectOnFocusOptions(this.settings),this.constructor._setNegativePositiveSignPermissions(this.settings),i||(D.isNull(e)||!e.decimalPlaces?this.settings.originalDecimalPlaces=null:this.settings.originalDecimalPlaces=e.decimalPlaces,this.settings.originalDecimalPlacesRawValue=this.settings.decimalPlacesRawValue,this.constructor._calculateDecimalPlacesOnInit(this.settings)),this._calculateVMinAndVMaxIntegerSizes(),this._setTrailingNegativeSignInfo(),this.regex={},this.constructor._cachesUsualRegularExpressions(this.settings,this.regex),this.constructor._setBrackets(this.settings),this._calculateValuesToStringsKeys(),D.isEmptyObj(this.settings)&&D.throwError("Unable to set the settings, those are invalid ; an empty object was given."),this.constructor.validate(this.settings,!1,e),this._keepAnOriginalSettingsCopy()}},{key:"_preparePastedText",value:function(e){return this.constructor._stripAllNonNumberCharacters(e,this.settings,!0,this.isFocused)}},{key:"_updateInternalProperties",value:function(){this.selection=D.getElementSelection(this.domElement),this.processed=!1}},{key:"_updateEventKeyInfo",value:function(e){this.eventKey=D.character(e)}},{key:"_saveCancellableValue",value:function(){this.savedCancellableValue=this.rawValue}},{key:"_setSelection",value:function(e,t){e=Math.max(e,0),t=Math.min(t,D.getElementValue(this.domElement).length),this.selection={start:e,end:t,length:t-e},D.setElementSelection(this.domElement,e,t)}},{key:"_setCaretPosition",value:function(e){this._setSelection(e,e)}},{key:"_getLeftAndRightPartAroundTheSelection",value:function(){var e=D.getElementValue(this.domElement);return[e.substring(0,this.selection.start),e.substring(this.selection.end,e.length)]}},{key:"_getUnformattedLeftAndRightPartAroundTheSelection",value:function(){var e=S(this._getLeftAndRightPartAroundTheSelection(),2),t=e[0],i=e[1];if(""===t&&""===i)return["",""];var n=!0;return this.eventKey!==d.keyName.Hyphen&&this.eventKey!==d.keyName.Minus||0!==Number(t)||(n=!1),this.isTrailingNegative&&(D.isNegative(i,this.settings.negativeSignCharacter)&&!D.isNegative(t,this.settings.negativeSignCharacter)||""===i&&D.isNegative(t,this.settings.negativeSignCharacter,!0))&&(t=t.replace(this.settings.negativeSignCharacter,""),i=i.replace(this.settings.negativeSignCharacter,""),t=t.replace("-",""),i=i.replace("-",""),t="-".concat(t)),[t=I._stripAllNonNumberCharactersExceptCustomDecimalChar(t,this.settings,n,this.isFocused),i=I._stripAllNonNumberCharactersExceptCustomDecimalChar(i,this.settings,!1,this.isFocused)]}},{key:"_normalizeParts",value:function(e,t){var i=!0;this.eventKey!==d.keyName.Hyphen&&this.eventKey!==d.keyName.Minus||0!==Number(e)||(i=!1),this.isTrailingNegative&&D.isNegative(t,this.settings.negativeSignCharacter)&&!D.isNegative(e,this.settings.negativeSignCharacter)&&(e="-".concat(e),t=t.replace(this.settings.negativeSignCharacter,"")),e=I._stripAllNonNumberCharactersExceptCustomDecimalChar(e,this.settings,i,this.isFocused),t=I._stripAllNonNumberCharactersExceptCustomDecimalChar(t,this.settings,!1,this.isFocused),this.settings.leadingZero!==I.options.leadingZero.deny||this.eventKey!==d.keyName.num0&&this.eventKey!==d.keyName.numpad0||0!==Number(e)||D.contains(e,this.settings.decimalCharacter)||""===t||(e=e.substring(0,e.length-1));var n=e+t;if(this.settings.decimalCharacter){var a=n.match(new RegExp("^".concat(this.regex.aNegRegAutoStrip,"\\").concat(this.settings.decimalCharacter)));a&&(n=(e=e.replace(a[1],a[1]+"0"))+t)}return[e,t,n]}},{key:"_setValueParts",value:function(e,t,i){var n=2<arguments.length&&void 0!==i&&i,a=S(this._normalizeParts(e,t),3),r=a[0],s=a[1],o=a[2],l=S(I._checkIfInRangeWithOverrideOption(o,this.settings),2),c=l[0],u=l[1];if(c&&u){var h=I._truncateDecimalPlaces(o,this.settings,n,this.settings.decimalPlacesRawValue).replace(this.settings.decimalCharacter,".");if(""===h||h===this.settings.negativeSignCharacter){var m;switch(this.settings.emptyInputBehavior){case I.options.emptyInputBehavior.focus:case I.options.emptyInputBehavior.press:case I.options.emptyInputBehavior.always:m="";break;case I.options.emptyInputBehavior.min:m=this.settings.minimumValue;break;case I.options.emptyInputBehavior.max:m=this.settings.maximumValue;break;case I.options.emptyInputBehavior.zero:m="0";break;case I.options.emptyInputBehavior.null:m=null;break;default:m=this.settings.emptyInputBehavior}this._setRawValue(m)}else this._setRawValue(this._trimLeadingAndTrailingZeros(h));var g=I._truncateDecimalPlaces(o,this.settings,n,this.settings.decimalPlacesShownOnFocus),d=r.length;return d>g.length&&(d=g.length),1===d&&"0"===r&&this.settings.leadingZero===I.options.leadingZero.deny&&(d=""===s||"0"===r&&""!==s?1:0),this._setElementValue(g,!1),this._setCaretPosition(d),!0}return c?u||this._triggerEvent(I.events.maxRangeExceeded,this.domElement):this._triggerEvent(I.events.minRangeExceeded,this.domElement),!1}},{key:"_getSignPosition",value:function(){var e;if(this.settings.currencySymbol){var t=this.settings.currencySymbol.length,i=D.getElementValue(this.domElement);if(this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix)e=this.settings.negativeSignCharacter&&i&&i.charAt(0)===this.settings.negativeSignCharacter?[1,t+1]:[0,t];else{var n=i.length;e=[n-t,n]}}else e=[1e3,-1];return e}},{key:"_expandSelectionOnSign",value:function(){var e=S(this._getSignPosition(),2),t=e[0],i=e[1],n=this.selection;n.start<i&&n.end>t&&((n.start<t||n.end>i)&&D.getElementValue(this.domElement).substring(Math.max(n.start,t),Math.min(n.end,i)).match(/^\s*$/)?n.start<t?this._setSelection(n.start,t):this._setSelection(i,n.end):this._setSelection(Math.min(n.start,t),Math.max(n.end,i)))}},{key:"_checkPaste",value:function(){if(!this.formatted&&!D.isUndefined(this.valuePartsBeforePaste)){var e=this.valuePartsBeforePaste,t=S(this._getLeftAndRightPartAroundTheSelection(),2),i=t[0],n=t[1];delete this.valuePartsBeforePaste;var a=i.substr(0,e[0].length)+I._stripAllNonNumberCharactersExceptCustomDecimalChar(i.substr(e[0].length),this.settings,!0,this.isFocused);this._setValueParts(a,n,!0)||(this._setElementValue(e.join(""),!1),this._setCaretPosition(e[0].length))}}},{key:"_processNonPrintableKeysAndShortcuts",value:function(e){if((e.ctrlKey||e.metaKey)&&"keyup"===e.type&&!D.isUndefined(this.valuePartsBeforePaste)||e.shiftKey&&this.eventKey===d.keyName.Insert)return this._checkPaste(),!1;if(this.constructor._shouldSkipEventKey(this.eventKey))return!0;if((e.ctrlKey||e.metaKey)&&this.eventKey===d.keyName.a)return this.settings.selectNumberOnly&&(e.preventDefault(),this.selectNumber()),!0;if((e.ctrlKey||e.metaKey)&&(this.eventKey===d.keyName.c||this.eventKey===d.keyName.v||this.eventKey===d.keyName.x))return"keydown"===e.type&&this._expandSelectionOnSign(),this.eventKey!==d.keyName.v&&this.eventKey!==d.keyName.Insert||("keydown"===e.type||"keypress"===e.type?D.isUndefined(this.valuePartsBeforePaste)&&(this.valuePartsBeforePaste=this._getLeftAndRightPartAroundTheSelection()):this._checkPaste()),"keydown"===e.type||"keypress"===e.type||this.eventKey===d.keyName.c;if(e.ctrlKey||e.metaKey)return!(this.eventKey===d.keyName.Z||this.eventKey===d.keyName.z);if(this.eventKey!==d.keyName.LeftArrow&&this.eventKey!==d.keyName.RightArrow)return D.isInArray(this.eventKey,d.keyName._directionKeys);if("keydown"===e.type&&!e.shiftKey){var t=D.getElementValue(this.domElement);this.eventKey!==d.keyName.LeftArrow||t.charAt(this.selection.start-2)!==this.settings.digitGroupSeparator&&t.charAt(this.selection.start-2)!==this.settings.decimalCharacter?this.eventKey!==d.keyName.RightArrow||t.charAt(this.selection.start+1)!==this.settings.digitGroupSeparator&&t.charAt(this.selection.start+1)!==this.settings.decimalCharacter||this._setCaretPosition(this.selection.start+1):this._setCaretPosition(this.selection.start-1)}return!0}},{key:"_processCharacterDeletionIfTrailingNegativeSign",value:function(e){var t=S(e,2),i=t[0],n=t[1],a=D.getElementValue(this.domElement),r=D.isNegative(a,this.settings.negativeSignCharacter);if(this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix&&this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.suffix&&(this.eventKey===d.keyName.Backspace?(this.caretFix=this.selection.start>=a.indexOf(this.settings.suffixText)&&""!==this.settings.suffixText,"-"===a.charAt(this.selection.start-1)?i=i.substring(1):this.selection.start<=a.length-this.settings.suffixText.length&&(i=i.substring(0,i.length-1))):(this.caretFix=this.selection.start>=a.indexOf(this.settings.suffixText)&&""!==this.settings.suffixText,this.selection.start>=a.indexOf(this.settings.currencySymbol)+this.settings.currencySymbol.length&&(n=n.substring(1,n.length)),D.isNegative(i,this.settings.negativeSignCharacter)&&"-"===a.charAt(this.selection.start)&&(i=i.substring(1)))),this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix)switch(this.settings.negativePositiveSignPlacement){case I.options.negativePositiveSignPlacement.left:this.caretFix=this.selection.start>=a.indexOf(this.settings.negativeSignCharacter)+this.settings.negativeSignCharacter.length,this.eventKey===d.keyName.Backspace?this.selection.start===a.indexOf(this.settings.negativeSignCharacter)+this.settings.negativeSignCharacter.length&&r?i=i.substring(1):"-"!==i&&(this.selection.start<=a.indexOf(this.settings.negativeSignCharacter)||!r)&&(i=i.substring(0,i.length-1)):("-"===i[0]&&(n=n.substring(1)),this.selection.start===a.indexOf(this.settings.negativeSignCharacter)&&r&&(i=i.substring(1)));break;case I.options.negativePositiveSignPlacement.right:this.caretFix=this.selection.start>=a.indexOf(this.settings.negativeSignCharacter)+this.settings.negativeSignCharacter.length,this.eventKey===d.keyName.Backspace?this.selection.start===a.indexOf(this.settings.negativeSignCharacter)+this.settings.negativeSignCharacter.length?i=i.substring(1):"-"!==i&&this.selection.start<=a.indexOf(this.settings.negativeSignCharacter)-this.settings.currencySymbol.length?i=i.substring(0,i.length-1):""===i||r||(i=i.substring(0,i.length-1)):(this.caretFix=this.selection.start>=a.indexOf(this.settings.currencySymbol)&&""!==this.settings.currencySymbol,this.selection.start===a.indexOf(this.settings.negativeSignCharacter)&&(i=i.substring(1)),n=n.substring(1))}return[i,n]}},{key:"_processCharacterDeletion",value:function(){var e,t;if(this.selection.length){this._expandSelectionOnSign();var i=S(this._getUnformattedLeftAndRightPartAroundTheSelection(),2);e=i[0],t=i[1]}else{var n=S(this._getUnformattedLeftAndRightPartAroundTheSelection(),2);if(e=n[0],t=n[1],""===e&&""===t&&(this.throwInput=!1),this.isTrailingNegative&&D.isNegative(D.getElementValue(this.domElement),this.settings.negativeSignCharacter)){var a=S(this._processCharacterDeletionIfTrailingNegativeSign([e,t]),2);e=a[0],t=a[1]}else this.eventKey===d.keyName.Backspace?e=e.substring(0,e.length-1):t=t.substring(1,t.length)}this._setValueParts(e,t)}},{key:"_isDecimalCharacterInsertionAllowed",value:function(){return String(this.settings.decimalPlacesShownOnFocus)!==String(I.options.decimalPlacesShownOnFocus.none)&&String(this.settings.decimalPlaces)!==String(I.options.decimalPlaces.none)}},{key:"_processCharacterInsertion",value:function(){var e=S(this._getUnformattedLeftAndRightPartAroundTheSelection(),2),t=e[0],i=e[1];if(this.eventKey!==d.keyName.AndroidDefault&&(this.throwInput=!0),this.eventKey===this.settings.decimalCharacter||this.settings.decimalCharacterAlternative&&this.eventKey===this.settings.decimalCharacterAlternative){if(!this._isDecimalCharacterInsertionAllowed()||!this.settings.decimalCharacter)return!1;if(this.settings.alwaysAllowDecimalCharacter)t=t.replace(this.settings.decimalCharacter,""),i=i.replace(this.settings.decimalCharacter,"");else{if(D.contains(t,this.settings.decimalCharacter))return!0;if(0<i.indexOf(this.settings.decimalCharacter))return!0;0===i.indexOf(this.settings.decimalCharacter)&&(i=i.substr(1))}return this.settings.negativeSignCharacter&&D.contains(i,this.settings.negativeSignCharacter)&&(t="".concat(this.settings.negativeSignCharacter).concat(t),i=i.replace(this.settings.negativeSignCharacter,"")),this._setValueParts(t+this.settings.decimalCharacter,i),!0}if(("-"===this.eventKey||"+"===this.eventKey)&&this.settings.isNegativeSignAllowed)return""===t&&D.contains(i,"-")?i=i.replace("-",""):t=D.isNegativeStrict(t,"-")?t.replace("-",""):"".concat(this.settings.negativeSignCharacter).concat(t),this._setValueParts(t,i),!0;var n=Number(this.eventKey);return 0<=n&&n<=9?(this.settings.isNegativeSignAllowed&&""===t&&D.contains(i,"-")&&(t="-",i=i.substring(1,i.length)),this.settings.maximumValue<=0&&this.settings.minimumValue<this.settings.maximumValue&&!D.contains(D.getElementValue(this.domElement),this.settings.negativeSignCharacter)&&"0"!==this.eventKey&&(t="-".concat(t)),this._setValueParts("".concat(t).concat(this.eventKey),i),!0):this.throwInput=!1}},{key:"_formatValue",value:function(e){var t=D.getElementValue(this.domElement),i=S(this._getUnformattedLeftAndRightPartAroundTheSelection(),1)[0];if((""===this.settings.digitGroupSeparator||""!==this.settings.digitGroupSeparator&&!D.contains(t,this.settings.digitGroupSeparator))&&(""===this.settings.currencySymbol||""!==this.settings.currencySymbol&&!D.contains(t,this.settings.currencySymbol))){var n=S(t.split(this.settings.decimalCharacter),1)[0],a="";D.isNegative(n,this.settings.negativeSignCharacter)&&(a=this.settings.negativeSignCharacter,n=n.replace(this.settings.negativeSignCharacter,""),i=i.replace("-","")),""===a&&n.length>this.settings.mIntPos&&"0"===i.charAt(0)&&(i=i.slice(1)),a===this.settings.negativeSignCharacter&&n.length>this.settings.mIntNeg&&"0"===i.charAt(0)&&(i=i.slice(1)),this.isTrailingNegative||(i="".concat(a).concat(i))}var r=this.constructor._addGroupSeparators(t,this.settings,this.isFocused,this.rawValue),s=r.length;if(r){var o,l=i.split("");if((this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.suffix||this.settings.negativePositiveSignPlacement!==I.options.negativePositiveSignPlacement.prefix&&this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix)&&l[0]===this.settings.negativeSignCharacter&&!this.settings.isNegativeSignAllowed&&(l.shift(),(this.eventKey===d.keyName.Backspace||this.eventKey===d.keyName.Delete)&&this.caretFix&&((this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix&&this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.left||this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix&&this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.suffix)&&(l.push(this.settings.negativeSignCharacter),this.caretFix="keydown"===e.type),this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix&&this.settings.negativePositiveSignPlacement===I.options.negativePositiveSignPlacement.right))){var c=this.settings.currencySymbol.split(""),u=["\\","^","$",".","|","?","*","+","(",")","["],h=[];c.forEach(function(e,t){t=c[e],D.isInArray(t,u)?h.push("\\"+t):h.push(t)}),this.eventKey===d.keyName.Backspace&&"-"===this.settings.negativeSignCharacter&&h.push("-"),l.push(h.join("")),this.caretFix="keydown"===e.type}for(var m=0;m<l.length;m++)l[m].match("\\d")||(l[m]="\\"+l[m]);o=this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix?new RegExp("^.*?".concat(l.join(".*?"))):new RegExp("^.*".concat(this.settings.currencySymbol,".*").concat(l.join(".*?")));var g=r.match(o);g?(s=g[0].length,this.settings.showPositiveSign&&(0===s&&g.input.charAt(0)===this.settings.positiveSignCharacter&&(s=1===g.input.indexOf(this.settings.currencySymbol)?this.settings.currencySymbol.length+1:1),0===s&&g.input.charAt(this.settings.currencySymbol.length)===this.settings.positiveSignCharacter&&(s=this.settings.currencySymbol.length+1)),(0===s&&r.charAt(0)!==this.settings.negativeSignCharacter||1===s&&r.charAt(0)===this.settings.negativeSignCharacter)&&this.settings.currencySymbol&&this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.prefix&&(s=this.settings.currencySymbol.length+(D.isNegativeStrict(r,this.settings.negativeSignCharacter)?1:0))):(this.settings.currencySymbol&&this.settings.currencySymbolPlacement===I.options.currencySymbolPlacement.suffix&&(s-=this.settings.currencySymbol.length),this.settings.suffixText&&(s-=this.settings.suffixText.length))}r!==t&&(this._setElementValue(r,!1),this._setCaretPosition(s)),this.formatted=!0}}]),g(e,t),I;var e,t}();function w(e,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var i=document.createEvent("CustomEvent");return i.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),i}f.multiple=function(e){var i=1<arguments.length&&void 0!==arguments[1]?arguments[1]:null,t=2<arguments.length&&void 0!==arguments[2]?arguments[2]:null,n=[];if(D.isObject(i)&&(t=i,i=null),D.isString(e))e=v(document.querySelectorAll(e));else if(D.isObject(e)){Object.prototype.hasOwnProperty.call(e,"rootElement")||D.throwError("The object passed to the 'multiple' function is invalid ; no 'rootElement' attribute found.");var a=v(e.rootElement.querySelectorAll("input"));e=Object.prototype.hasOwnProperty.call(e,"exclude")?(Array.isArray(e.exclude)||D.throwError("The 'exclude' array passed to the 'multiple' function is invalid."),D.filterOut(a,e.exclude)):a}else D.isArray(e)||D.throwError("The given parameters to the 'multiple' function are invalid.");if(0===e.length){var r=!0;return!D.isNull(t)&&D.isBoolean(t.showWarnings)&&(r=t.showWarnings),D.warning("No valid DOM elements were given hence no AutoNumeric objects were instantiated.",r),[]}var s=D.isArray(i)&&1<=i.length,o=!1,l=!1;if(s){var c=b(Number(i[0]));(o="number"===c&&!isNaN(Number(i[0])))||"string"!==c&&!isNaN(c)&&"object"!==c||(l=!0)}var u,h=!1;if(D.isArray(t)&&1<=t.length){var m=b(t[0]);"string"!==m&&"object"!==m||(h=!0)}u=l?f.mergeOptions(i):h?f.mergeOptions(t):t;var g,d=D.isNumber(i);return o&&(g=i.length),e.forEach(function(e,t){d?n.push(new f(e,i,u)):o&&t<=g?n.push(new f(e,i[t],u)):n.push(new f(e,null,u))}),n},Array.from||(Array.from=function(e){return[].slice.call(e)}),"undefined"!=typeof window&&"function"!=typeof window.CustomEvent&&(w.prototype=window.Event.prototype,window.CustomEvent=w),f.events={initialized:"autoNumeric:initialized",invalidFormula:"autoNumeric:invalidFormula",formatted:"autoNumeric:formatted",rawValueModified:"autoNumeric:rawValueModified",minRangeExceeded:"autoNumeric:minExceeded",maxRangeExceeded:"autoNumeric:maxExceeded",native:{input:"input",change:"change"},validFormula:"autoNumeric:validFormula"},Object.freeze(f.events.native),Object.freeze(f.events),Object.defineProperty(f,"events",{configurable:!1,writable:!1}),f.options={allowDecimalPadding:{always:!0,never:!1,floats:"floats"},alwaysAllowDecimalCharacter:{alwaysAllow:!0,doNotAllow:!1},caretPositionOnFocus:{start:"start",end:"end",decimalLeft:"decimalLeft",decimalRight:"decimalRight",doNoForceCaretPosition:null},createLocalList:{createList:!0,doNotCreateList:!1},currencySymbol:{none:"",currencySign:"¤",austral:"₳",australCentavo:"¢",baht:"฿",cedi:"₵",cent:"¢",colon:"₡",cruzeiro:"₢",dollar:"$",dong:"₫",drachma:"₯",dram:"​֏",european:"₠",euro:"€",florin:"ƒ",franc:"₣",guarani:"₲",hryvnia:"₴",kip:"₭",att:"ອັດ",lepton:"Λ.",lira:"₺",liraOld:"₤",lari:"₾",mark:"ℳ",mill:"₥",naira:"₦",peseta:"₧",peso:"₱",pfennig:"₰",pound:"£",real:"R$",riel:"៛",ruble:"₽",rupee:"₹",rupeeOld:"₨",shekel:"₪",shekelAlt:"ש״ח‎‎",taka:"৳",tenge:"₸",togrog:"₮",won:"₩",yen:"¥"},currencySymbolPlacement:{prefix:"p",suffix:"s"},decimalCharacter:{comma:",",dot:".",middleDot:"·",arabicDecimalSeparator:"٫",decimalSeparatorKeySymbol:"⎖"},decimalCharacterAlternative:{none:null,comma:",",dot:"."},decimalPlaces:{none:0,one:1,two:2,three:3,four:4,five:5,six:6},decimalPlacesRawValue:{useDefault:null,none:0,one:1,two:2,three:3,four:4,five:5,six:6},decimalPlacesShownOnBlur:{useDefault:null,none:0,one:1,two:2,three:3,four:4,five:5,six:6},decimalPlacesShownOnFocus:{useDefault:null,none:0,one:1,two:2,three:3,four:4,five:5,six:6},defaultValueOverride:{doNotOverride:null},digitalGroupSpacing:{two:"2",twoScaled:"2s",three:"3",four:"4"},digitGroupSeparator:{comma:",",dot:".",normalSpace:" ",thinSpace:" ",narrowNoBreakSpace:" ",noBreakSpace:" ",noSeparator:"",apostrophe:"'",arabicThousandsSeparator:"٬",dotAbove:"˙",privateUseTwo:"’"},divisorWhenUnfocused:{none:null,percentage:100,permille:1e3,basisPoint:1e4},emptyInputBehavior:{focus:"focus",press:"press",always:"always",zero:"zero",min:"min",max:"max",null:"null"},eventBubbles:{bubbles:!0,doesNotBubble:!1},eventIsCancelable:{isCancelable:!0,isNotCancelable:!1},failOnUnknownOption:{fail:!0,ignore:!1},formatOnPageLoad:{format:!0,doNotFormat:!1},formulaMode:{enabled:!0,disabled:!1},historySize:{verySmall:5,small:10,medium:20,large:50,veryLarge:100,insane:Number.MAX_SAFE_INTEGER},isCancellable:{cancellable:!0,notCancellable:!1},leadingZero:{allow:"allow",deny:"deny",keep:"keep"},maximumValue:{tenTrillions:"10000000000000",oneBillion:"1000000000",zero:"0"},minimumValue:{tenTrillions:"-10000000000000",oneBillion:"-1000000000",zero:"0"},modifyValueOnWheel:{modifyValue:!0,doNothing:!1},negativeBracketsTypeOnBlur:{parentheses:"(,)",brackets:"[,]",chevrons:"<,>",curlyBraces:"{,}",angleBrackets:"〈,〉",japaneseQuotationMarks:"｢,｣",halfBrackets:"⸤,⸥",whiteSquareBrackets:"⟦,⟧",quotationMarks:"‹,›",guillemets:"«,»",none:null},negativePositiveSignPlacement:{prefix:"p",suffix:"s",left:"l",right:"r",none:null},negativeSignCharacter:{hyphen:"-",minus:"−",heavyMinus:"➖",fullWidthHyphen:"－",circledMinus:"⊖",squaredMinus:"⊟",triangleMinus:"⨺",plusMinus:"±",minusPlus:"∓",dotMinus:"∸",minusTilde:"≂",not:"¬"},noEventListeners:{noEvents:!0,addEvents:!1},onInvalidPaste:{error:"error",ignore:"ignore",clamp:"clamp",truncate:"truncate",replace:"replace"},outputFormat:{string:"string",number:"number",dot:".",negativeDot:"-.",comma:",",negativeComma:"-,",dotNegative:".-",commaNegative:",-",none:null},overrideMinMaxLimits:{ceiling:"ceiling",floor:"floor",ignore:"ignore",doNotOverride:null},positiveSignCharacter:{plus:"+",fullWidthPlus:"＋",heavyPlus:"➕",doublePlus:"⧺",triplePlus:"⧻",circledPlus:"⊕",squaredPlus:"⊞",trianglePlus:"⨹",plusMinus:"±",minusPlus:"∓",dotPlus:"∔",altHebrewPlus:"﬩",normalSpace:" ",thinSpace:" ",narrowNoBreakSpace:" ",noBreakSpace:" "},rawValueDivisor:{none:null,percentage:100,permille:1e3,basisPoint:1e4},readOnly:{readOnly:!0,readWrite:!1},roundingMethod:{halfUpSymmetric:"S",halfUpAsymmetric:"A",halfDownSymmetric:"s",halfDownAsymmetric:"a",halfEvenBankersRounding:"B",upRoundAwayFromZero:"U",downRoundTowardZero:"D",toCeilingTowardPositiveInfinity:"C",toFloorTowardNegativeInfinity:"F",toNearest05:"N05",toNearest05Alt:"CHF",upToNext05:"U05",downToNext05:"D05"},saveValueToSessionStorage:{save:!0,doNotSave:!1},selectNumberOnly:{selectNumbersOnly:!0,selectAll:!1},selectOnFocus:{select:!0,doNotSelect:!1},serializeSpaces:{plus:"+",percent:"%20"},showOnlyNumbersOnFocus:{onlyNumbers:!0,showAll:!1},showPositiveSign:{show:!0,hide:!1},showWarnings:{show:!0,hide:!1},styleRules:{none:null,positiveNegative:{positive:"autoNumeric-positive",negative:"autoNumeric-negative"},range0To100With4Steps:{ranges:[{min:0,max:25,class:"autoNumeric-red"},{min:25,max:50,class:"autoNumeric-orange"},{min:50,max:75,class:"autoNumeric-yellow"},{min:75,max:100,class:"autoNumeric-green"}]},evenOdd:{userDefined:[{callback:function(e){return e%2==0},classes:["autoNumeric-even","autoNumeric-odd"]}]},rangeSmallAndZero:{userDefined:[{callback:function(e){return-1<=e&&e<0?0:0===Number(e)?1:0<e&&e<=1?2:null},classes:["autoNumeric-small-negative","autoNumeric-zero","autoNumeric-small-positive"]}]}},suffixText:{none:"",percentage:"%",permille:"‰",basisPoint:"‱"},symbolWhenUnfocused:{none:null,percentage:"%",permille:"‰",basisPoint:"‱"},unformatOnHover:{unformat:!0,doNotUnformat:!1},unformatOnSubmit:{unformat:!0,keepCurrentValue:!1},valuesToStrings:{none:null,zeroDash:{0:"-"},oneAroundZero:{"-1":"Min",1:"Max"}},watchExternalChanges:{watch:!0,doNotWatch:!1},wheelOn:{focus:"focus",hover:"hover"},wheelStep:{progressive:"progressive"}},p=f.options,Object.getOwnPropertyNames(p).forEach(function(e){"valuesToStrings"===e?Object.getOwnPropertyNames(p.valuesToStrings).forEach(function(e){D.isIE11()||null===p.valuesToStrings[e]||Object.freeze(p.valuesToStrings[e])}):"styleRules"!==e&&(D.isIE11()||null===p[e]||Object.freeze(p[e]))}),Object.freeze(p),Object.defineProperty(f,"options",{configurable:!1,writable:!1}),f.defaultSettings={allowDecimalPadding:f.options.allowDecimalPadding.always,alwaysAllowDecimalCharacter:f.options.alwaysAllowDecimalCharacter.doNotAllow,caretPositionOnFocus:f.options.caretPositionOnFocus.doNoForceCaretPosition,createLocalList:f.options.createLocalList.createList,currencySymbol:f.options.currencySymbol.none,currencySymbolPlacement:f.options.currencySymbolPlacement.prefix,decimalCharacter:f.options.decimalCharacter.dot,decimalCharacterAlternative:f.options.decimalCharacterAlternative.none,decimalPlaces:f.options.decimalPlaces.two,decimalPlacesRawValue:f.options.decimalPlacesRawValue.useDefault,decimalPlacesShownOnBlur:f.options.decimalPlacesShownOnBlur.useDefault,decimalPlacesShownOnFocus:f.options.decimalPlacesShownOnFocus.useDefault,defaultValueOverride:f.options.defaultValueOverride.doNotOverride,digitalGroupSpacing:f.options.digitalGroupSpacing.three,digitGroupSeparator:f.options.digitGroupSeparator.comma,divisorWhenUnfocused:f.options.divisorWhenUnfocused.none,emptyInputBehavior:f.options.emptyInputBehavior.focus,eventBubbles:f.options.eventBubbles.bubbles,eventIsCancelable:f.options.eventIsCancelable.isCancelable,failOnUnknownOption:f.options.failOnUnknownOption.ignore,formatOnPageLoad:f.options.formatOnPageLoad.format,formulaMode:f.options.formulaMode.disabled,historySize:f.options.historySize.medium,isCancellable:f.options.isCancellable.cancellable,leadingZero:f.options.leadingZero.deny,maximumValue:f.options.maximumValue.tenTrillions,minimumValue:f.options.minimumValue.tenTrillions,modifyValueOnWheel:f.options.modifyValueOnWheel.modifyValue,negativeBracketsTypeOnBlur:f.options.negativeBracketsTypeOnBlur.none,negativePositiveSignPlacement:f.options.negativePositiveSignPlacement.none,negativeSignCharacter:f.options.negativeSignCharacter.hyphen,noEventListeners:f.options.noEventListeners.addEvents,onInvalidPaste:f.options.onInvalidPaste.error,outputFormat:f.options.outputFormat.none,overrideMinMaxLimits:f.options.overrideMinMaxLimits.doNotOverride,positiveSignCharacter:f.options.positiveSignCharacter.plus,rawValueDivisor:f.options.rawValueDivisor.none,readOnly:f.options.readOnly.readWrite,roundingMethod:f.options.roundingMethod.halfUpSymmetric,saveValueToSessionStorage:f.options.saveValueToSessionStorage.doNotSave,selectNumberOnly:f.options.selectNumberOnly.selectNumbersOnly,selectOnFocus:f.options.selectOnFocus.select,serializeSpaces:f.options.serializeSpaces.plus,showOnlyNumbersOnFocus:f.options.showOnlyNumbersOnFocus.showAll,showPositiveSign:f.options.showPositiveSign.hide,showWarnings:f.options.showWarnings.show,styleRules:f.options.styleRules.none,suffixText:f.options.suffixText.none,symbolWhenUnfocused:f.options.symbolWhenUnfocused.none,unformatOnHover:f.options.unformatOnHover.unformat,unformatOnSubmit:f.options.unformatOnSubmit.keepCurrentValue,valuesToStrings:f.options.valuesToStrings.none,watchExternalChanges:f.options.watchExternalChanges.doNotWatch,wheelOn:f.options.wheelOn.focus,wheelStep:f.options.wheelStep.progressive},Object.freeze(f.defaultSettings),Object.defineProperty(f,"defaultSettings",{configurable:!1,writable:!1});var P={digitGroupSeparator:f.options.digitGroupSeparator.dot,decimalCharacter:f.options.decimalCharacter.comma,decimalCharacterAlternative:f.options.decimalCharacterAlternative.dot,currencySymbol:" €",currencySymbolPlacement:f.options.currencySymbolPlacement.suffix,negativePositiveSignPlacement:f.options.negativePositiveSignPlacement.prefix},O={digitGroupSeparator:f.options.digitGroupSeparator.comma,decimalCharacter:f.options.decimalCharacter.dot,currencySymbol:f.options.currencySymbol.dollar,currencySymbolPlacement:f.options.currencySymbolPlacement.prefix,negativePositiveSignPlacement:f.options.negativePositiveSignPlacement.right},k={digitGroupSeparator:f.options.digitGroupSeparator.comma,decimalCharacter:f.options.decimalCharacter.dot,currencySymbol:f.options.currencySymbol.yen,currencySymbolPlacement:f.options.currencySymbolPlacement.prefix,negativePositiveSignPlacement:f.options.negativePositiveSignPlacement.right};D.cloneObject(P).formulaMode=f.options.formulaMode.enabled;var N=D.cloneObject(P);N.minimumValue=0;var E=D.cloneObject(P);E.maximumValue=0,E.negativePositiveSignPlacement=f.options.negativePositiveSignPlacement.prefix;var _=D.cloneObject(P);_.digitGroupSeparator=f.options.digitGroupSeparator.normalSpace;var C=D.cloneObject(_);C.minimumValue=0;var F=D.cloneObject(_);F.maximumValue=0,F.negativePositiveSignPlacement=f.options.negativePositiveSignPlacement.prefix;var x=D.cloneObject(P);x.currencySymbol=f.options.currencySymbol.none,x.suffixText=" ".concat(f.options.suffixText.percentage),x.wheelStep=1e-4,x.rawValueDivisor=f.options.rawValueDivisor.percentage;var V=D.cloneObject(x);V.minimumValue=0;var T=D.cloneObject(x);T.maximumValue=0,T.negativePositiveSignPlacement=f.options.negativePositiveSignPlacement.prefix;var A=D.cloneObject(x);A.decimalPlaces=3;var L=D.cloneObject(V);L.decimalPlaces=3;var B=D.cloneObject(T);B.decimalPlaces=3,D.cloneObject(O).formulaMode=f.options.formulaMode.enabled;var I=D.cloneObject(O);I.minimumValue=0;var M=D.cloneObject(O);M.maximumValue=0,M.negativePositiveSignPlacement=f.options.negativePositiveSignPlacement.prefix;var R=D.cloneObject(M);R.negativeBracketsTypeOnBlur=f.options.negativeBracketsTypeOnBlur.parentheses;var U=D.cloneObject(O);U.currencySymbol=f.options.currencySymbol.none,U.suffixText=f.options.suffixText.percentage,U.wheelStep=1e-4,U.rawValueDivisor=f.options.rawValueDivisor.percentage;var j=D.cloneObject(U);j.minimumValue=0;var z=D.cloneObject(U);z.maximumValue=0,z.negativePositiveSignPlacement=f.options.negativePositiveSignPlacement.prefix;var K=D.cloneObject(U);K.decimalPlaces=3;var G=D.cloneObject(j);G.decimalPlaces=3;var W=D.cloneObject(z);W.decimalPlaces=3;var H=D.cloneObject(P);H.currencySymbol=f.options.currencySymbol.lira,f.predefinedOptions={euro:P,euroPos:N,euroNeg:E,euroSpace:_,euroSpacePos:C,euroSpaceNeg:F,percentageEU2dec:x,percentageEU2decPos:V,percentageEU2decNeg:T,percentageEU3dec:A,percentageEU3decPos:L,percentageEU3decNeg:B,dollar:O,dollarPos:I,dollarNeg:M,dollarNegBrackets:R,percentageUS2dec:U,percentageUS2decPos:j,percentageUS2decNeg:z,percentageUS3dec:K,percentageUS3decPos:G,percentageUS3decNeg:W,French:P,Spanish:P,NorthAmerican:O,British:{digitGroupSeparator:f.options.digitGroupSeparator.comma,decimalCharacter:f.options.decimalCharacter.dot,currencySymbol:f.options.currencySymbol.pound,currencySymbolPlacement:f.options.currencySymbolPlacement.prefix,negativePositiveSignPlacement:f.options.negativePositiveSignPlacement.right},Swiss:{digitGroupSeparator:f.options.digitGroupSeparator.apostrophe,decimalCharacter:f.options.decimalCharacter.dot,currencySymbol:" CHF",currencySymbolPlacement:f.options.currencySymbolPlacement.suffix,negativePositiveSignPlacement:f.options.negativePositiveSignPlacement.prefix},Japanese:k,Chinese:k,Brazilian:{digitGroupSeparator:f.options.digitGroupSeparator.dot,decimalCharacter:f.options.decimalCharacter.comma,currencySymbol:f.options.currencySymbol.real,currencySymbolPlacement:f.options.currencySymbolPlacement.prefix,negativePositiveSignPlacement:f.options.negativePositiveSignPlacement.right},Turkish:H,dotDecimalCharCommaSeparator:{digitGroupSeparator:f.options.digitGroupSeparator.comma,decimalCharacter:f.options.decimalCharacter.dot},commaDecimalCharDotSeparator:{digitGroupSeparator:f.options.digitGroupSeparator.dot,decimalCharacter:f.options.decimalCharacter.comma,decimalCharacterAlternative:f.options.decimalCharacterAlternative.dot},integer:{decimalPlaces:0},integerPos:{minimumValue:f.options.minimumValue.zero,decimalPlaces:0},integerNeg:{maximumValue:f.options.maximumValue.zero,decimalPlaces:0},float:{allowDecimalPadding:f.options.allowDecimalPadding.never},floatPos:{allowDecimalPadding:f.options.allowDecimalPadding.never,minimumValue:f.options.minimumValue.zero,maximumValue:f.options.maximumValue.tenTrillions},floatNeg:{allowDecimalPadding:f.options.allowDecimalPadding.never,minimumValue:f.options.minimumValue.tenTrillions,maximumValue:f.options.maximumValue.zero},numeric:{digitGroupSeparator:f.options.digitGroupSeparator.noSeparator,decimalCharacter:f.options.decimalCharacter.dot,currencySymbol:f.options.currencySymbol.none},numericPos:{digitGroupSeparator:f.options.digitGroupSeparator.noSeparator,decimalCharacter:f.options.decimalCharacter.dot,currencySymbol:f.options.currencySymbol.none,minimumValue:f.options.minimumValue.zero,maximumValue:f.options.maximumValue.tenTrillions},numericNeg:{digitGroupSeparator:f.options.digitGroupSeparator.noSeparator,decimalCharacter:f.options.decimalCharacter.dot,currencySymbol:f.options.currencySymbol.none,minimumValue:f.options.minimumValue.tenTrillions,maximumValue:f.options.maximumValue.zero}},Object.getOwnPropertyNames(f.predefinedOptions).forEach(function(e){Object.freeze(f.predefinedOptions[e])}),Object.freeze(f.predefinedOptions),Object.defineProperty(f,"predefinedOptions",{configurable:!1,writable:!1}),t.default=f}],a.c=n,a.d=function(e,t,i){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(t,e){if(1&e&&(t=a(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(a.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)a.d(i,n,function(e){return t[e]}.bind(null,n));return i},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=0)).default;function a(e){if(n[e])return n[e].exports;var t=n[e]={i:e,l:!1,exports:{}};return i[e].call(t.exports,t,t.exports,a),t.l=!0,t.exports}var i,n});
//# sourceMappingURL=autoNumeric.min.js.map

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./node_modules/select2/dist/css/select2.min.css":
/*!***************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./node_modules/select2/dist/css/select2.min.css ***!
  \***************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".select2-container{box-sizing:border-box;display:inline-block;margin:0;position:relative;vertical-align:middle}.select2-container .select2-selection--single{box-sizing:border-box;cursor:pointer;display:block;height:28px;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-user-select:none}.select2-container .select2-selection--single .select2-selection__rendered{display:block;padding-left:8px;padding-right:20px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.select2-container .select2-selection--single .select2-selection__clear{position:relative}.select2-container[dir=\"rtl\"] .select2-selection--single .select2-selection__rendered{padding-right:8px;padding-left:20px}.select2-container .select2-selection--multiple{box-sizing:border-box;cursor:pointer;display:block;min-height:32px;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-user-select:none}.select2-container .select2-selection--multiple .select2-selection__rendered{display:inline-block;overflow:hidden;padding-left:8px;text-overflow:ellipsis;white-space:nowrap}.select2-container .select2-search--inline{float:left}.select2-container .select2-search--inline .select2-search__field{box-sizing:border-box;border:none;font-size:100%;margin-top:5px;padding:0}.select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button{-webkit-appearance:none}.select2-dropdown{background-color:white;border:1px solid #aaa;border-radius:4px;box-sizing:border-box;display:block;position:absolute;left:-100000px;width:100%;z-index:1051}.select2-results{display:block}.select2-results__options{list-style:none;margin:0;padding:0}.select2-results__option{padding:6px;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-user-select:none}.select2-results__option[aria-selected]{cursor:pointer}.select2-container--open .select2-dropdown{left:0}.select2-container--open .select2-dropdown--above{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--open .select2-dropdown--below{border-top:none;border-top-left-radius:0;border-top-right-radius:0}.select2-search--dropdown{display:block;padding:4px}.select2-search--dropdown .select2-search__field{padding:4px;width:100%;box-sizing:border-box}.select2-search--dropdown .select2-search__field::-webkit-search-cancel-button{-webkit-appearance:none}.select2-search--dropdown.select2-search--hide{display:none}.select2-close-mask{border:0;margin:0;padding:0;display:block;position:fixed;left:0;top:0;min-height:100%;min-width:100%;height:auto;width:auto;opacity:0;z-index:99;background-color:#fff;filter:alpha(opacity=0)}.select2-hidden-accessible{border:0 !important;clip:rect(0 0 0 0) !important;-webkit-clip-path:inset(50%) !important;clip-path:inset(50%) !important;height:1px !important;overflow:hidden !important;padding:0 !important;position:absolute !important;width:1px !important;white-space:nowrap !important}.select2-container--default .select2-selection--single{background-color:#fff;border:1px solid #aaa;border-radius:4px}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#444;line-height:28px}.select2-container--default .select2-selection--single .select2-selection__clear{cursor:pointer;float:right;font-weight:bold}.select2-container--default .select2-selection--single .select2-selection__placeholder{color:#999}.select2-container--default .select2-selection--single .select2-selection__arrow{height:26px;position:absolute;top:1px;right:1px;width:20px}.select2-container--default .select2-selection--single .select2-selection__arrow b{border-color:#888 transparent transparent transparent;border-style:solid;border-width:5px 4px 0 4px;height:0;left:50%;margin-left:-4px;margin-top:-2px;position:absolute;top:50%;width:0}.select2-container--default[dir=\"rtl\"] .select2-selection--single .select2-selection__clear{float:left}.select2-container--default[dir=\"rtl\"] .select2-selection--single .select2-selection__arrow{left:1px;right:auto}.select2-container--default.select2-container--disabled .select2-selection--single{background-color:#eee;cursor:default}.select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear{display:none}.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{border-color:transparent transparent #888 transparent;border-width:0 4px 5px 4px}.select2-container--default .select2-selection--multiple{background-color:white;border:1px solid #aaa;border-radius:4px;cursor:text}.select2-container--default .select2-selection--multiple .select2-selection__rendered{box-sizing:border-box;list-style:none;margin:0;padding:0 5px;width:100%}.select2-container--default .select2-selection--multiple .select2-selection__rendered li{list-style:none}.select2-container--default .select2-selection--multiple .select2-selection__clear{cursor:pointer;float:right;font-weight:bold;margin-top:5px;margin-right:10px;padding:1px}.select2-container--default .select2-selection--multiple .select2-selection__choice{background-color:#e4e4e4;border:1px solid #aaa;border-radius:4px;cursor:default;float:left;margin-right:5px;margin-top:5px;padding:0 5px}.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{color:#999;cursor:pointer;display:inline-block;font-weight:bold;margin-right:2px}.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover{color:#333}.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice,.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-search--inline{float:right}.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice{margin-left:5px;margin-right:auto}.select2-container--default[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice__remove{margin-left:2px;margin-right:auto}.select2-container--default.select2-container--focus .select2-selection--multiple{border:solid black 1px;outline:0}.select2-container--default.select2-container--disabled .select2-selection--multiple{background-color:#eee;cursor:default}.select2-container--default.select2-container--disabled .select2-selection__choice__remove{display:none}.select2-container--default.select2-container--open.select2-container--above .select2-selection--single,.select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple{border-top-left-radius:0;border-top-right-radius:0}.select2-container--default.select2-container--open.select2-container--below .select2-selection--single,.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple{border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--default .select2-search--dropdown .select2-search__field{border:1px solid #aaa}.select2-container--default .select2-search--inline .select2-search__field{background:transparent;border:none;outline:0;box-shadow:none;-webkit-appearance:textfield}.select2-container--default .select2-results>.select2-results__options{max-height:200px;overflow-y:auto}.select2-container--default .select2-results__option[role=group]{padding:0}.select2-container--default .select2-results__option[aria-disabled=true]{color:#999}.select2-container--default .select2-results__option[aria-selected=true]{background-color:#ddd}.select2-container--default .select2-results__option .select2-results__option{padding-left:1em}.select2-container--default .select2-results__option .select2-results__option .select2-results__group{padding-left:0}.select2-container--default .select2-results__option .select2-results__option .select2-results__option{margin-left:-1em;padding-left:2em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-2em;padding-left:3em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-3em;padding-left:4em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-4em;padding-left:5em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-5em;padding-left:6em}.select2-container--default .select2-results__option--highlighted[aria-selected]{background-color:#5897fb;color:white}.select2-container--default .select2-results__group{cursor:default;display:block;padding:6px}.select2-container--classic .select2-selection--single{background-color:#f7f7f7;border:1px solid #aaa;border-radius:4px;outline:0;background-image:-webkit-gradient(linear, left top, left bottom, color-stop(50%, #fff), to(#eee));background-image:linear-gradient(to bottom, #fff 50%, #eee 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)}.select2-container--classic .select2-selection--single:focus{border:1px solid #5897fb}.select2-container--classic .select2-selection--single .select2-selection__rendered{color:#444;line-height:28px}.select2-container--classic .select2-selection--single .select2-selection__clear{cursor:pointer;float:right;font-weight:bold;margin-right:10px}.select2-container--classic .select2-selection--single .select2-selection__placeholder{color:#999}.select2-container--classic .select2-selection--single .select2-selection__arrow{background-color:#ddd;border:none;border-left:1px solid #aaa;border-top-right-radius:4px;border-bottom-right-radius:4px;height:26px;position:absolute;top:1px;right:1px;width:20px;background-image:-webkit-gradient(linear, left top, left bottom, color-stop(50%, #eee), to(#ccc));background-image:linear-gradient(to bottom, #eee 50%, #ccc 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFCCCCCC', GradientType=0)}.select2-container--classic .select2-selection--single .select2-selection__arrow b{border-color:#888 transparent transparent transparent;border-style:solid;border-width:5px 4px 0 4px;height:0;left:50%;margin-left:-4px;margin-top:-2px;position:absolute;top:50%;width:0}.select2-container--classic[dir=\"rtl\"] .select2-selection--single .select2-selection__clear{float:left}.select2-container--classic[dir=\"rtl\"] .select2-selection--single .select2-selection__arrow{border:none;border-right:1px solid #aaa;border-radius:0;border-top-left-radius:4px;border-bottom-left-radius:4px;left:1px;right:auto}.select2-container--classic.select2-container--open .select2-selection--single{border:1px solid #5897fb}.select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow{background:transparent;border:none}.select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow b{border-color:transparent transparent #888 transparent;border-width:0 4px 5px 4px}.select2-container--classic.select2-container--open.select2-container--above .select2-selection--single{border-top:none;border-top-left-radius:0;border-top-right-radius:0;background-image:-webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(50%, #eee));background-image:linear-gradient(to bottom, #fff 0%, #eee 50%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)}.select2-container--classic.select2-container--open.select2-container--below .select2-selection--single{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0;background-image:-webkit-gradient(linear, left top, left bottom, color-stop(50%, #eee), to(#fff));background-image:linear-gradient(to bottom, #eee 50%, #fff 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFFFFFFF', GradientType=0)}.select2-container--classic .select2-selection--multiple{background-color:white;border:1px solid #aaa;border-radius:4px;cursor:text;outline:0}.select2-container--classic .select2-selection--multiple:focus{border:1px solid #5897fb}.select2-container--classic .select2-selection--multiple .select2-selection__rendered{list-style:none;margin:0;padding:0 5px}.select2-container--classic .select2-selection--multiple .select2-selection__clear{display:none}.select2-container--classic .select2-selection--multiple .select2-selection__choice{background-color:#e4e4e4;border:1px solid #aaa;border-radius:4px;cursor:default;float:left;margin-right:5px;margin-top:5px;padding:0 5px}.select2-container--classic .select2-selection--multiple .select2-selection__choice__remove{color:#888;cursor:pointer;display:inline-block;font-weight:bold;margin-right:2px}.select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover{color:#555}.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice{float:right;margin-left:5px;margin-right:auto}.select2-container--classic[dir=\"rtl\"] .select2-selection--multiple .select2-selection__choice__remove{margin-left:2px;margin-right:auto}.select2-container--classic.select2-container--open .select2-selection--multiple{border:1px solid #5897fb}.select2-container--classic.select2-container--open.select2-container--above .select2-selection--multiple{border-top:none;border-top-left-radius:0;border-top-right-radius:0}.select2-container--classic.select2-container--open.select2-container--below .select2-selection--multiple{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--classic .select2-search--dropdown .select2-search__field{border:1px solid #aaa;outline:0}.select2-container--classic .select2-search--inline .select2-search__field{outline:0;box-shadow:none}.select2-container--classic .select2-dropdown{background-color:#fff;border:1px solid transparent}.select2-container--classic .select2-dropdown--above{border-bottom:none}.select2-container--classic .select2-dropdown--below{border-top:none}.select2-container--classic .select2-results>.select2-results__options{max-height:200px;overflow-y:auto}.select2-container--classic .select2-results__option[role=group]{padding:0}.select2-container--classic .select2-results__option[aria-disabled=true]{color:grey}.select2-container--classic .select2-results__option--highlighted[aria-selected]{background-color:#3875d7;color:#fff}.select2-container--classic .select2-results__group{cursor:default;display:block;padding:6px}.select2-container--classic.select2-container--open .select2-dropdown{border-color:#5897fb}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/laravel-vue-pagination/dist/laravel-vue-pagination.common.js":
/*!***********************************************************************************!*\
  !*** ./node_modules/laravel-vue-pagination/dist/laravel-vue-pagination.common.js ***!
  \***********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports =
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "fb15");
/******/ })
/************************************************************************/
/******/ ({

/***/ "f6fd":
/***/ (function(module, exports) {

// document.currentScript polyfill by Adam Miller

// MIT license

(function(document){
  var currentScript = "currentScript",
      scripts = document.getElementsByTagName('script'); // Live NodeList collection

  // If browser needs currentScript polyfill, add get currentScript() to the document object
  if (!(currentScript in document)) {
    Object.defineProperty(document, currentScript, {
      get: function(){

        // IE 6-10 supports script readyState
        // IE 10+ support stack trace
        try { throw new Error(); }
        catch (err) {

          // Find the second match for the "at" string to get file src url from stack.
          // Specifically works with the format of stack traces in IE.
          var i, res = ((/.*at [^\(]*\((.*):.+:.+\)$/ig).exec(err.stack) || [false])[1];

          // For all scripts on the page, if src matches or if ready state is interactive, return the script tag
          for(i in scripts){
            if(scripts[i].src == res || scripts[i].readyState == "interactive"){
              return scripts[i];
            }
          }

          // If no match, return null
          return null;
        }
      }
    });
  }
})(document);


/***/ }),

/***/ "fb15":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);

// CONCATENATED MODULE: ./node_modules/@vue/cli-service/lib/commands/build/setPublicPath.js
// This file is imported into lib/wc client bundles.

if (typeof window !== 'undefined') {
  if (true) {
    __webpack_require__("f6fd")
  }

  var i
  if ((i = window.document.currentScript) && (i = i.src.match(/(.+\/)[^/]+\.js(\?.*)?$/))) {
    __webpack_require__.p = i[1] // eslint-disable-line
  }
}

// Indicate to webpack that this file can be concatenated
/* harmony default export */ var setPublicPath = (null);

// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js?{"cacheDirectory":"node_modules/.cache/vue-loader","cacheIdentifier":"604a59b1-vue-loader-template"}!./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/cache-loader/dist/cjs.js??ref--0-0!./node_modules/vue-loader/lib??vue-loader-options!./src/LaravelVuePagination.vue?vue&type=template&id=7f71b5a7&
var render = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('renderless-laravel-vue-pagination',{attrs:{"data":_vm.data,"limit":_vm.limit,"show-disabled":_vm.showDisabled,"size":_vm.size,"align":_vm.align},on:{"pagination-change-page":_vm.onPaginationChangePage},scopedSlots:_vm._u([{key:"default",fn:function(ref){
var data = ref.data;
var limit = ref.limit;
var showDisabled = ref.showDisabled;
var size = ref.size;
var align = ref.align;
var computed = ref.computed;
var prevButtonEvents = ref.prevButtonEvents;
var nextButtonEvents = ref.nextButtonEvents;
var pageButtonEvents = ref.pageButtonEvents;
return (computed.total > computed.perPage)?_c('ul',{staticClass:"pagination",class:{
            'pagination-sm': size == 'small',
            'pagination-lg': size == 'large',
            'justify-content-center': align == 'center',
            'justify-content-end': align == 'right'
        }},[(computed.prevPageUrl || showDisabled)?_c('li',{staticClass:"page-item pagination-prev-nav",class:{'disabled': !computed.prevPageUrl}},[_c('a',_vm._g({staticClass:"page-link",attrs:{"href":"#","aria-label":"Previous","tabindex":!computed.prevPageUrl && -1}},prevButtonEvents),[_vm._t("prev-nav",[_c('span',{attrs:{"aria-hidden":"true"}},[_vm._v("«")]),_c('span',{staticClass:"sr-only"},[_vm._v("Previous")])])],2)]):_vm._e(),_vm._l((computed.pageRange),function(page,key){return _c('li',{key:key,staticClass:"page-item pagination-page-nav",class:{ 'active': page == computed.currentPage }},[_c('a',_vm._g({staticClass:"page-link",attrs:{"href":"#"}},pageButtonEvents(page)),[_vm._v("\n                "+_vm._s(page)+"\n                "),(page == computed.currentPage)?_c('span',{staticClass:"sr-only"},[_vm._v("(current)")]):_vm._e()])])}),(computed.nextPageUrl || showDisabled)?_c('li',{staticClass:"page-item pagination-next-nav",class:{'disabled': !computed.nextPageUrl}},[_c('a',_vm._g({staticClass:"page-link",attrs:{"href":"#","aria-label":"Next","tabindex":!computed.nextPageUrl && -1}},nextButtonEvents),[_vm._t("next-nav",[_c('span',{attrs:{"aria-hidden":"true"}},[_vm._v("»")]),_c('span',{staticClass:"sr-only"},[_vm._v("Next")])])],2)]):_vm._e()],2):_vm._e()}}],null,true)})}
var staticRenderFns = []


// CONCATENATED MODULE: ./src/LaravelVuePagination.vue?vue&type=template&id=7f71b5a7&

// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js??ref--12-0!./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib!./node_modules/cache-loader/dist/cjs.js??ref--0-0!./node_modules/vue-loader/lib??vue-loader-options!./src/RenderlessLaravelVuePagination.vue?vue&type=script&lang=js&
/* harmony default export */ var RenderlessLaravelVuePaginationvue_type_script_lang_js_ = ({
  props: {
    data: {
      type: Object,
      default: function _default() {}
    },
    limit: {
      type: Number,
      default: 0
    },
    showDisabled: {
      type: Boolean,
      default: false
    },
    size: {
      type: String,
      default: 'default',
      validator: function validator(value) {
        return ['small', 'default', 'large'].indexOf(value) !== -1;
      }
    },
    align: {
      type: String,
      default: 'left',
      validator: function validator(value) {
        return ['left', 'center', 'right'].indexOf(value) !== -1;
      }
    }
  },
  computed: {
    isApiResource: function isApiResource() {
      return !!this.data.meta;
    },
    currentPage: function currentPage() {
      return this.isApiResource ? this.data.meta.current_page : this.data.current_page;
    },
    firstPageUrl: function firstPageUrl() {
      return this.isApiResource ? this.data.links.first : null;
    },
    from: function from() {
      return this.isApiResource ? this.data.meta.from : this.data.from;
    },
    lastPage: function lastPage() {
      return this.isApiResource ? this.data.meta.last_page : this.data.last_page;
    },
    lastPageUrl: function lastPageUrl() {
      return this.isApiResource ? this.data.links.last : null;
    },
    nextPageUrl: function nextPageUrl() {
      return this.isApiResource ? this.data.links.next : this.data.next_page_url;
    },
    perPage: function perPage() {
      return this.isApiResource ? this.data.meta.per_page : this.data.per_page;
    },
    prevPageUrl: function prevPageUrl() {
      return this.isApiResource ? this.data.links.prev : this.data.prev_page_url;
    },
    to: function to() {
      return this.isApiResource ? this.data.meta.to : this.data.to;
    },
    total: function total() {
      return this.isApiResource ? this.data.meta.total : this.data.total;
    },
    pageRange: function pageRange() {
      if (this.limit === -1) {
        return 0;
      }

      if (this.limit === 0) {
        return this.lastPage;
      }

      var current = this.currentPage;
      var last = this.lastPage;
      var delta = this.limit;
      var left = current - delta;
      var right = current + delta + 1;
      var range = [];
      var pages = [];
      var l;

      for (var i = 1; i <= last; i++) {
        if (i === 1 || i === last || i >= left && i < right) {
          range.push(i);
        }
      }

      range.forEach(function (i) {
        if (l) {
          if (i - l === 2) {
            pages.push(l + 1);
          } else if (i - l !== 1) {
            pages.push('...');
          }
        }

        pages.push(i);
        l = i;
      });
      return pages;
    }
  },
  methods: {
    previousPage: function previousPage() {
      this.selectPage(this.currentPage - 1);
    },
    nextPage: function nextPage() {
      this.selectPage(this.currentPage + 1);
    },
    selectPage: function selectPage(page) {
      if (page === '...') {
        return;
      }

      this.$emit('pagination-change-page', page);
    }
  },
  render: function render() {
    var _this = this;

    return this.$scopedSlots.default({
      data: this.data,
      limit: this.limit,
      showDisabled: this.showDisabled,
      size: this.size,
      align: this.align,
      computed: {
        isApiResource: this.isApiResource,
        currentPage: this.currentPage,
        firstPageUrl: this.firstPageUrl,
        from: this.from,
        lastPage: this.lastPage,
        lastPageUrl: this.lastPageUrl,
        nextPageUrl: this.nextPageUrl,
        perPage: this.perPage,
        prevPageUrl: this.prevPageUrl,
        to: this.to,
        total: this.total,
        pageRange: this.pageRange
      },
      prevButtonEvents: {
        click: function click(e) {
          e.preventDefault();

          _this.previousPage();
        }
      },
      nextButtonEvents: {
        click: function click(e) {
          e.preventDefault();

          _this.nextPage();
        }
      },
      pageButtonEvents: function pageButtonEvents(page) {
        return {
          click: function click(e) {
            e.preventDefault();

            _this.selectPage(page);
          }
        };
      }
    });
  }
});
// CONCATENATED MODULE: ./src/RenderlessLaravelVuePagination.vue?vue&type=script&lang=js&
 /* harmony default export */ var src_RenderlessLaravelVuePaginationvue_type_script_lang_js_ = (RenderlessLaravelVuePaginationvue_type_script_lang_js_); 
// CONCATENATED MODULE: ./node_modules/vue-loader/lib/runtime/componentNormalizer.js
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}

// CONCATENATED MODULE: ./src/RenderlessLaravelVuePagination.vue
var RenderlessLaravelVuePagination_render, RenderlessLaravelVuePagination_staticRenderFns




/* normalize component */

var component = normalizeComponent(
  src_RenderlessLaravelVuePaginationvue_type_script_lang_js_,
  RenderlessLaravelVuePagination_render,
  RenderlessLaravelVuePagination_staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var RenderlessLaravelVuePagination = (component.exports);
// CONCATENATED MODULE: ./node_modules/cache-loader/dist/cjs.js??ref--12-0!./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib!./node_modules/cache-loader/dist/cjs.js??ref--0-0!./node_modules/vue-loader/lib??vue-loader-options!./src/LaravelVuePagination.vue?vue&type=script&lang=js&
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ var LaravelVuePaginationvue_type_script_lang_js_ = ({
  props: {
    data: {
      type: Object,
      default: function _default() {}
    },
    limit: {
      type: Number,
      default: 0
    },
    showDisabled: {
      type: Boolean,
      default: false
    },
    size: {
      type: String,
      default: 'default',
      validator: function validator(value) {
        return ['small', 'default', 'large'].indexOf(value) !== -1;
      }
    },
    align: {
      type: String,
      default: 'left',
      validator: function validator(value) {
        return ['left', 'center', 'right'].indexOf(value) !== -1;
      }
    }
  },
  methods: {
    onPaginationChangePage: function onPaginationChangePage(page) {
      this.$emit('pagination-change-page', page);
    }
  },
  components: {
    RenderlessLaravelVuePagination: RenderlessLaravelVuePagination
  }
});
// CONCATENATED MODULE: ./src/LaravelVuePagination.vue?vue&type=script&lang=js&
 /* harmony default export */ var src_LaravelVuePaginationvue_type_script_lang_js_ = (LaravelVuePaginationvue_type_script_lang_js_); 
// CONCATENATED MODULE: ./src/LaravelVuePagination.vue





/* normalize component */

var LaravelVuePagination_component = normalizeComponent(
  src_LaravelVuePaginationvue_type_script_lang_js_,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var LaravelVuePagination = (LaravelVuePagination_component.exports);
// CONCATENATED MODULE: ./node_modules/@vue/cli-service/lib/commands/build/entry-lib.js


/* harmony default export */ var entry_lib = __webpack_exports__["default"] = (LaravelVuePagination);



/***/ })

/******/ })["default"];
//# sourceMappingURL=laravel-vue-pagination.common.js.map

/***/ }),

/***/ "./node_modules/select2/dist/css/select2.min.css":
/*!*******************************************************!*\
  !*** ./node_modules/select2/dist/css/select2.min.css ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../css-loader??ref--6-1!../../../postcss-loader/src??ref--6-2!./select2.min.css */ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./node_modules/select2/dist/css/select2.min.css");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/select2/dist/js/select2.full.js":
/*!******************************************************!*\
  !*** ./node_modules/select2/dist/js/select2.full.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var require;var require;/*!
 * Select2 4.0.11
 * https://select2.github.io
 *
 * Released under the MIT license
 * https://github.com/select2/select2/blob/master/LICENSE.md
 */
;(function (factory) {
  if (true) {
    // AMD. Register as an anonymous module.
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}
} (function (jQuery) {
  // This is needed so we can catch the AMD loader configuration and use it
  // The inner file should be wrapped (by `banner.start.js`) in a function that
  // returns the AMD loader references.
  var S2 =(function () {
  // Restore the Select2 AMD loader so it can be used
  // Needed mostly in the language files, where the loader is not inserted
  if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd) {
    var S2 = jQuery.fn.select2.amd;
  }
var S2;(function () { if (!S2 || !S2.requirejs) {
if (!S2) { S2 = {}; } else { require = S2; }
/**
 * @license almond 0.3.3 Copyright jQuery Foundation and other contributors.
 * Released under MIT license, http://github.com/requirejs/almond/LICENSE
 */
//Going sloppy to avoid 'use strict' string cost, but strict practices should
//be followed.
/*global setTimeout: false */

var requirejs, require, define;
(function (undef) {
    var main, req, makeMap, handlers,
        defined = {},
        waiting = {},
        config = {},
        defining = {},
        hasOwn = Object.prototype.hasOwnProperty,
        aps = [].slice,
        jsSuffixRegExp = /\.js$/;

    function hasProp(obj, prop) {
        return hasOwn.call(obj, prop);
    }

    /**
     * Given a relative module name, like ./something, normalize it to
     * a real name that can be mapped to a path.
     * @param {String} name the relative name
     * @param {String} baseName a real name that the name arg is relative
     * to.
     * @returns {String} normalized name
     */
    function normalize(name, baseName) {
        var nameParts, nameSegment, mapValue, foundMap, lastIndex,
            foundI, foundStarMap, starI, i, j, part, normalizedBaseParts,
            baseParts = baseName && baseName.split("/"),
            map = config.map,
            starMap = (map && map['*']) || {};

        //Adjust any relative paths.
        if (name) {
            name = name.split('/');
            lastIndex = name.length - 1;

            // If wanting node ID compatibility, strip .js from end
            // of IDs. Have to do this here, and not in nameToUrl
            // because node allows either .js or non .js to map
            // to same file.
            if (config.nodeIdCompat && jsSuffixRegExp.test(name[lastIndex])) {
                name[lastIndex] = name[lastIndex].replace(jsSuffixRegExp, '');
            }

            // Starts with a '.' so need the baseName
            if (name[0].charAt(0) === '.' && baseParts) {
                //Convert baseName to array, and lop off the last part,
                //so that . matches that 'directory' and not name of the baseName's
                //module. For instance, baseName of 'one/two/three', maps to
                //'one/two/three.js', but we want the directory, 'one/two' for
                //this normalization.
                normalizedBaseParts = baseParts.slice(0, baseParts.length - 1);
                name = normalizedBaseParts.concat(name);
            }

            //start trimDots
            for (i = 0; i < name.length; i++) {
                part = name[i];
                if (part === '.') {
                    name.splice(i, 1);
                    i -= 1;
                } else if (part === '..') {
                    // If at the start, or previous value is still ..,
                    // keep them so that when converted to a path it may
                    // still work when converted to a path, even though
                    // as an ID it is less than ideal. In larger point
                    // releases, may be better to just kick out an error.
                    if (i === 0 || (i === 1 && name[2] === '..') || name[i - 1] === '..') {
                        continue;
                    } else if (i > 0) {
                        name.splice(i - 1, 2);
                        i -= 2;
                    }
                }
            }
            //end trimDots

            name = name.join('/');
        }

        //Apply map config if available.
        if ((baseParts || starMap) && map) {
            nameParts = name.split('/');

            for (i = nameParts.length; i > 0; i -= 1) {
                nameSegment = nameParts.slice(0, i).join("/");

                if (baseParts) {
                    //Find the longest baseName segment match in the config.
                    //So, do joins on the biggest to smallest lengths of baseParts.
                    for (j = baseParts.length; j > 0; j -= 1) {
                        mapValue = map[baseParts.slice(0, j).join('/')];

                        //baseName segment has  config, find if it has one for
                        //this name.
                        if (mapValue) {
                            mapValue = mapValue[nameSegment];
                            if (mapValue) {
                                //Match, update name to the new value.
                                foundMap = mapValue;
                                foundI = i;
                                break;
                            }
                        }
                    }
                }

                if (foundMap) {
                    break;
                }

                //Check for a star map match, but just hold on to it,
                //if there is a shorter segment match later in a matching
                //config, then favor over this star map.
                if (!foundStarMap && starMap && starMap[nameSegment]) {
                    foundStarMap = starMap[nameSegment];
                    starI = i;
                }
            }

            if (!foundMap && foundStarMap) {
                foundMap = foundStarMap;
                foundI = starI;
            }

            if (foundMap) {
                nameParts.splice(0, foundI, foundMap);
                name = nameParts.join('/');
            }
        }

        return name;
    }

    function makeRequire(relName, forceSync) {
        return function () {
            //A version of a require function that passes a moduleName
            //value for items that may need to
            //look up paths relative to the moduleName
            var args = aps.call(arguments, 0);

            //If first arg is not require('string'), and there is only
            //one arg, it is the array form without a callback. Insert
            //a null so that the following concat is correct.
            if (typeof args[0] !== 'string' && args.length === 1) {
                args.push(null);
            }
            return req.apply(undef, args.concat([relName, forceSync]));
        };
    }

    function makeNormalize(relName) {
        return function (name) {
            return normalize(name, relName);
        };
    }

    function makeLoad(depName) {
        return function (value) {
            defined[depName] = value;
        };
    }

    function callDep(name) {
        if (hasProp(waiting, name)) {
            var args = waiting[name];
            delete waiting[name];
            defining[name] = true;
            main.apply(undef, args);
        }

        if (!hasProp(defined, name) && !hasProp(defining, name)) {
            throw new Error('No ' + name);
        }
        return defined[name];
    }

    //Turns a plugin!resource to [plugin, resource]
    //with the plugin being undefined if the name
    //did not have a plugin prefix.
    function splitPrefix(name) {
        var prefix,
            index = name ? name.indexOf('!') : -1;
        if (index > -1) {
            prefix = name.substring(0, index);
            name = name.substring(index + 1, name.length);
        }
        return [prefix, name];
    }

    //Creates a parts array for a relName where first part is plugin ID,
    //second part is resource ID. Assumes relName has already been normalized.
    function makeRelParts(relName) {
        return relName ? splitPrefix(relName) : [];
    }

    /**
     * Makes a name map, normalizing the name, and using a plugin
     * for normalization if necessary. Grabs a ref to plugin
     * too, as an optimization.
     */
    makeMap = function (name, relParts) {
        var plugin,
            parts = splitPrefix(name),
            prefix = parts[0],
            relResourceName = relParts[1];

        name = parts[1];

        if (prefix) {
            prefix = normalize(prefix, relResourceName);
            plugin = callDep(prefix);
        }

        //Normalize according
        if (prefix) {
            if (plugin && plugin.normalize) {
                name = plugin.normalize(name, makeNormalize(relResourceName));
            } else {
                name = normalize(name, relResourceName);
            }
        } else {
            name = normalize(name, relResourceName);
            parts = splitPrefix(name);
            prefix = parts[0];
            name = parts[1];
            if (prefix) {
                plugin = callDep(prefix);
            }
        }

        //Using ridiculous property names for space reasons
        return {
            f: prefix ? prefix + '!' + name : name, //fullName
            n: name,
            pr: prefix,
            p: plugin
        };
    };

    function makeConfig(name) {
        return function () {
            return (config && config.config && config.config[name]) || {};
        };
    }

    handlers = {
        require: function (name) {
            return makeRequire(name);
        },
        exports: function (name) {
            var e = defined[name];
            if (typeof e !== 'undefined') {
                return e;
            } else {
                return (defined[name] = {});
            }
        },
        module: function (name) {
            return {
                id: name,
                uri: '',
                exports: defined[name],
                config: makeConfig(name)
            };
        }
    };

    main = function (name, deps, callback, relName) {
        var cjsModule, depName, ret, map, i, relParts,
            args = [],
            callbackType = typeof callback,
            usingExports;

        //Use name if no relName
        relName = relName || name;
        relParts = makeRelParts(relName);

        //Call the callback to define the module, if necessary.
        if (callbackType === 'undefined' || callbackType === 'function') {
            //Pull out the defined dependencies and pass the ordered
            //values to the callback.
            //Default to [require, exports, module] if no deps
            deps = !deps.length && callback.length ? ['require', 'exports', 'module'] : deps;
            for (i = 0; i < deps.length; i += 1) {
                map = makeMap(deps[i], relParts);
                depName = map.f;

                //Fast path CommonJS standard dependencies.
                if (depName === "require") {
                    args[i] = handlers.require(name);
                } else if (depName === "exports") {
                    //CommonJS module spec 1.1
                    args[i] = handlers.exports(name);
                    usingExports = true;
                } else if (depName === "module") {
                    //CommonJS module spec 1.1
                    cjsModule = args[i] = handlers.module(name);
                } else if (hasProp(defined, depName) ||
                           hasProp(waiting, depName) ||
                           hasProp(defining, depName)) {
                    args[i] = callDep(depName);
                } else if (map.p) {
                    map.p.load(map.n, makeRequire(relName, true), makeLoad(depName), {});
                    args[i] = defined[depName];
                } else {
                    throw new Error(name + ' missing ' + depName);
                }
            }

            ret = callback ? callback.apply(defined[name], args) : undefined;

            if (name) {
                //If setting exports via "module" is in play,
                //favor that over return value and exports. After that,
                //favor a non-undefined return value over exports use.
                if (cjsModule && cjsModule.exports !== undef &&
                        cjsModule.exports !== defined[name]) {
                    defined[name] = cjsModule.exports;
                } else if (ret !== undef || !usingExports) {
                    //Use the return value from the function.
                    defined[name] = ret;
                }
            }
        } else if (name) {
            //May just be an object definition for the module. Only
            //worry about defining if have a module name.
            defined[name] = callback;
        }
    };

    requirejs = require = req = function (deps, callback, relName, forceSync, alt) {
        if (typeof deps === "string") {
            if (handlers[deps]) {
                //callback in this case is really relName
                return handlers[deps](callback);
            }
            //Just return the module wanted. In this scenario, the
            //deps arg is the module name, and second arg (if passed)
            //is just the relName.
            //Normalize module name, if it contains . or ..
            return callDep(makeMap(deps, makeRelParts(callback)).f);
        } else if (!deps.splice) {
            //deps is a config object, not an array.
            config = deps;
            if (config.deps) {
                req(config.deps, config.callback);
            }
            if (!callback) {
                return;
            }

            if (callback.splice) {
                //callback is an array, which means it is a dependency list.
                //Adjust args if there are dependencies
                deps = callback;
                callback = relName;
                relName = null;
            } else {
                deps = undef;
            }
        }

        //Support require(['a'])
        callback = callback || function () {};

        //If relName is a function, it is an errback handler,
        //so remove it.
        if (typeof relName === 'function') {
            relName = forceSync;
            forceSync = alt;
        }

        //Simulate async callback;
        if (forceSync) {
            main(undef, deps, callback, relName);
        } else {
            //Using a non-zero value because of concern for what old browsers
            //do, and latest browsers "upgrade" to 4 if lower value is used:
            //http://www.whatwg.org/specs/web-apps/current-work/multipage/timers.html#dom-windowtimers-settimeout:
            //If want a value immediately, use require('id') instead -- something
            //that works in almond on the global level, but not guaranteed and
            //unlikely to work in other AMD implementations.
            setTimeout(function () {
                main(undef, deps, callback, relName);
            }, 4);
        }

        return req;
    };

    /**
     * Just drops the config on the floor, but returns req in case
     * the config return value is used.
     */
    req.config = function (cfg) {
        return req(cfg);
    };

    /**
     * Expose module registry for debugging and tooling
     */
    requirejs._defined = defined;

    define = function (name, deps, callback) {
        if (typeof name !== 'string') {
            throw new Error('See almond README: incorrect module build, no module name');
        }

        //This module may not have dependencies
        if (!deps.splice) {
            //deps is not an array, so probably means
            //an object literal or factory function for
            //the value. Adjust args.
            callback = deps;
            deps = [];
        }

        if (!hasProp(defined, name) && !hasProp(waiting, name)) {
            waiting[name] = [name, deps, callback];
        }
    };

    define.amd = {
        jQuery: true
    };
}());

S2.requirejs = requirejs;S2.require = require;S2.define = define;
}
}());
S2.define("almond", function(){});

/* global jQuery:false, $:false */
S2.define('jquery',[],function () {
  var _$ = jQuery || $;

  if (_$ == null && console && console.error) {
    console.error(
      'Select2: An instance of jQuery or a jQuery-compatible library was not ' +
      'found. Make sure that you are including jQuery before Select2 on your ' +
      'web page.'
    );
  }

  return _$;
});

S2.define('select2/utils',[
  'jquery'
], function ($) {
  var Utils = {};

  Utils.Extend = function (ChildClass, SuperClass) {
    var __hasProp = {}.hasOwnProperty;

    function BaseConstructor () {
      this.constructor = ChildClass;
    }

    for (var key in SuperClass) {
      if (__hasProp.call(SuperClass, key)) {
        ChildClass[key] = SuperClass[key];
      }
    }

    BaseConstructor.prototype = SuperClass.prototype;
    ChildClass.prototype = new BaseConstructor();
    ChildClass.__super__ = SuperClass.prototype;

    return ChildClass;
  };

  function getMethods (theClass) {
    var proto = theClass.prototype;

    var methods = [];

    for (var methodName in proto) {
      var m = proto[methodName];

      if (typeof m !== 'function') {
        continue;
      }

      if (methodName === 'constructor') {
        continue;
      }

      methods.push(methodName);
    }

    return methods;
  }

  Utils.Decorate = function (SuperClass, DecoratorClass) {
    var decoratedMethods = getMethods(DecoratorClass);
    var superMethods = getMethods(SuperClass);

    function DecoratedClass () {
      var unshift = Array.prototype.unshift;

      var argCount = DecoratorClass.prototype.constructor.length;

      var calledConstructor = SuperClass.prototype.constructor;

      if (argCount > 0) {
        unshift.call(arguments, SuperClass.prototype.constructor);

        calledConstructor = DecoratorClass.prototype.constructor;
      }

      calledConstructor.apply(this, arguments);
    }

    DecoratorClass.displayName = SuperClass.displayName;

    function ctr () {
      this.constructor = DecoratedClass;
    }

    DecoratedClass.prototype = new ctr();

    for (var m = 0; m < superMethods.length; m++) {
      var superMethod = superMethods[m];

      DecoratedClass.prototype[superMethod] =
        SuperClass.prototype[superMethod];
    }

    var calledMethod = function (methodName) {
      // Stub out the original method if it's not decorating an actual method
      var originalMethod = function () {};

      if (methodName in DecoratedClass.prototype) {
        originalMethod = DecoratedClass.prototype[methodName];
      }

      var decoratedMethod = DecoratorClass.prototype[methodName];

      return function () {
        var unshift = Array.prototype.unshift;

        unshift.call(arguments, originalMethod);

        return decoratedMethod.apply(this, arguments);
      };
    };

    for (var d = 0; d < decoratedMethods.length; d++) {
      var decoratedMethod = decoratedMethods[d];

      DecoratedClass.prototype[decoratedMethod] = calledMethod(decoratedMethod);
    }

    return DecoratedClass;
  };

  var Observable = function () {
    this.listeners = {};
  };

  Observable.prototype.on = function (event, callback) {
    this.listeners = this.listeners || {};

    if (event in this.listeners) {
      this.listeners[event].push(callback);
    } else {
      this.listeners[event] = [callback];
    }
  };

  Observable.prototype.trigger = function (event) {
    var slice = Array.prototype.slice;
    var params = slice.call(arguments, 1);

    this.listeners = this.listeners || {};

    // Params should always come in as an array
    if (params == null) {
      params = [];
    }

    // If there are no arguments to the event, use a temporary object
    if (params.length === 0) {
      params.push({});
    }

    // Set the `_type` of the first object to the event
    params[0]._type = event;

    if (event in this.listeners) {
      this.invoke(this.listeners[event], slice.call(arguments, 1));
    }

    if ('*' in this.listeners) {
      this.invoke(this.listeners['*'], arguments);
    }
  };

  Observable.prototype.invoke = function (listeners, params) {
    for (var i = 0, len = listeners.length; i < len; i++) {
      listeners[i].apply(this, params);
    }
  };

  Utils.Observable = Observable;

  Utils.generateChars = function (length) {
    var chars = '';

    for (var i = 0; i < length; i++) {
      var randomChar = Math.floor(Math.random() * 36);
      chars += randomChar.toString(36);
    }

    return chars;
  };

  Utils.bind = function (func, context) {
    return function () {
      func.apply(context, arguments);
    };
  };

  Utils._convertData = function (data) {
    for (var originalKey in data) {
      var keys = originalKey.split('-');

      var dataLevel = data;

      if (keys.length === 1) {
        continue;
      }

      for (var k = 0; k < keys.length; k++) {
        var key = keys[k];

        // Lowercase the first letter
        // By default, dash-separated becomes camelCase
        key = key.substring(0, 1).toLowerCase() + key.substring(1);

        if (!(key in dataLevel)) {
          dataLevel[key] = {};
        }

        if (k == keys.length - 1) {
          dataLevel[key] = data[originalKey];
        }

        dataLevel = dataLevel[key];
      }

      delete data[originalKey];
    }

    return data;
  };

  Utils.hasScroll = function (index, el) {
    // Adapted from the function created by @ShadowScripter
    // and adapted by @BillBarry on the Stack Exchange Code Review website.
    // The original code can be found at
    // http://codereview.stackexchange.com/q/13338
    // and was designed to be used with the Sizzle selector engine.

    var $el = $(el);
    var overflowX = el.style.overflowX;
    var overflowY = el.style.overflowY;

    //Check both x and y declarations
    if (overflowX === overflowY &&
        (overflowY === 'hidden' || overflowY === 'visible')) {
      return false;
    }

    if (overflowX === 'scroll' || overflowY === 'scroll') {
      return true;
    }

    return ($el.innerHeight() < el.scrollHeight ||
      $el.innerWidth() < el.scrollWidth);
  };

  Utils.escapeMarkup = function (markup) {
    var replaceMap = {
      '\\': '&#92;',
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      '\'': '&#39;',
      '/': '&#47;'
    };

    // Do not try to escape the markup if it's not a string
    if (typeof markup !== 'string') {
      return markup;
    }

    return String(markup).replace(/[&<>"'\/\\]/g, function (match) {
      return replaceMap[match];
    });
  };

  // Append an array of jQuery nodes to a given element.
  Utils.appendMany = function ($element, $nodes) {
    // jQuery 1.7.x does not support $.fn.append() with an array
    // Fall back to a jQuery object collection using $.fn.add()
    if ($.fn.jquery.substr(0, 3) === '1.7') {
      var $jqNodes = $();

      $.map($nodes, function (node) {
        $jqNodes = $jqNodes.add(node);
      });

      $nodes = $jqNodes;
    }

    $element.append($nodes);
  };

  // Cache objects in Utils.__cache instead of $.data (see #4346)
  Utils.__cache = {};

  var id = 0;
  Utils.GetUniqueElementId = function (element) {
    // Get a unique element Id. If element has no id,
    // creates a new unique number, stores it in the id
    // attribute and returns the new id.
    // If an id already exists, it simply returns it.

    var select2Id = element.getAttribute('data-select2-id');
    if (select2Id == null) {
      // If element has id, use it.
      if (element.id) {
        select2Id = element.id;
        element.setAttribute('data-select2-id', select2Id);
      } else {
        element.setAttribute('data-select2-id', ++id);
        select2Id = id.toString();
      }
    }
    return select2Id;
  };

  Utils.StoreData = function (element, name, value) {
    // Stores an item in the cache for a specified element.
    // name is the cache key.
    var id = Utils.GetUniqueElementId(element);
    if (!Utils.__cache[id]) {
      Utils.__cache[id] = {};
    }

    Utils.__cache[id][name] = value;
  };

  Utils.GetData = function (element, name) {
    // Retrieves a value from the cache by its key (name)
    // name is optional. If no name specified, return
    // all cache items for the specified element.
    // and for a specified element.
    var id = Utils.GetUniqueElementId(element);
    if (name) {
      if (Utils.__cache[id]) {
        if (Utils.__cache[id][name] != null) {
          return Utils.__cache[id][name];
        }
        return $(element).data(name); // Fallback to HTML5 data attribs.
      }
      return $(element).data(name); // Fallback to HTML5 data attribs.
    } else {
      return Utils.__cache[id];
    }
  };

  Utils.RemoveData = function (element) {
    // Removes all cached items for a specified element.
    var id = Utils.GetUniqueElementId(element);
    if (Utils.__cache[id] != null) {
      delete Utils.__cache[id];
    }

    element.removeAttribute('data-select2-id');
  };

  return Utils;
});

S2.define('select2/results',[
  'jquery',
  './utils'
], function ($, Utils) {
  function Results ($element, options, dataAdapter) {
    this.$element = $element;
    this.data = dataAdapter;
    this.options = options;

    Results.__super__.constructor.call(this);
  }

  Utils.Extend(Results, Utils.Observable);

  Results.prototype.render = function () {
    var $results = $(
      '<ul class="select2-results__options" role="listbox"></ul>'
    );

    if (this.options.get('multiple')) {
      $results.attr('aria-multiselectable', 'true');
    }

    this.$results = $results;

    return $results;
  };

  Results.prototype.clear = function () {
    this.$results.empty();
  };

  Results.prototype.displayMessage = function (params) {
    var escapeMarkup = this.options.get('escapeMarkup');

    this.clear();
    this.hideLoading();

    var $message = $(
      '<li role="alert" aria-live="assertive"' +
      ' class="select2-results__option"></li>'
    );

    var message = this.options.get('translations').get(params.message);

    $message.append(
      escapeMarkup(
        message(params.args)
      )
    );

    $message[0].className += ' select2-results__message';

    this.$results.append($message);
  };

  Results.prototype.hideMessages = function () {
    this.$results.find('.select2-results__message').remove();
  };

  Results.prototype.append = function (data) {
    this.hideLoading();

    var $options = [];

    if (data.results == null || data.results.length === 0) {
      if (this.$results.children().length === 0) {
        this.trigger('results:message', {
          message: 'noResults'
        });
      }

      return;
    }

    data.results = this.sort(data.results);

    for (var d = 0; d < data.results.length; d++) {
      var item = data.results[d];

      var $option = this.option(item);

      $options.push($option);
    }

    this.$results.append($options);
  };

  Results.prototype.position = function ($results, $dropdown) {
    var $resultsContainer = $dropdown.find('.select2-results');
    $resultsContainer.append($results);
  };

  Results.prototype.sort = function (data) {
    var sorter = this.options.get('sorter');

    return sorter(data);
  };

  Results.prototype.highlightFirstItem = function () {
    var $options = this.$results
      .find('.select2-results__option[aria-selected]');

    var $selected = $options.filter('[aria-selected=true]');

    // Check if there are any selected options
    if ($selected.length > 0) {
      // If there are selected options, highlight the first
      $selected.first().trigger('mouseenter');
    } else {
      // If there are no selected options, highlight the first option
      // in the dropdown
      $options.first().trigger('mouseenter');
    }

    this.ensureHighlightVisible();
  };

  Results.prototype.setClasses = function () {
    var self = this;

    this.data.current(function (selected) {
      var selectedIds = $.map(selected, function (s) {
        return s.id.toString();
      });

      var $options = self.$results
        .find('.select2-results__option[aria-selected]');

      $options.each(function () {
        var $option = $(this);

        var item = Utils.GetData(this, 'data');

        // id needs to be converted to a string when comparing
        var id = '' + item.id;

        if ((item.element != null && item.element.selected) ||
            (item.element == null && $.inArray(id, selectedIds) > -1)) {
          $option.attr('aria-selected', 'true');
        } else {
          $option.attr('aria-selected', 'false');
        }
      });

    });
  };

  Results.prototype.showLoading = function (params) {
    this.hideLoading();

    var loadingMore = this.options.get('translations').get('searching');

    var loading = {
      disabled: true,
      loading: true,
      text: loadingMore(params)
    };
    var $loading = this.option(loading);
    $loading.className += ' loading-results';

    this.$results.prepend($loading);
  };

  Results.prototype.hideLoading = function () {
    this.$results.find('.loading-results').remove();
  };

  Results.prototype.option = function (data) {
    var option = document.createElement('li');
    option.className = 'select2-results__option';

    var attrs = {
      'role': 'option',
      'aria-selected': 'false'
    };

    var matches = window.Element.prototype.matches ||
      window.Element.prototype.msMatchesSelector ||
      window.Element.prototype.webkitMatchesSelector;

    if ((data.element != null && matches.call(data.element, ':disabled')) ||
        (data.element == null && data.disabled)) {
      delete attrs['aria-selected'];
      attrs['aria-disabled'] = 'true';
    }

    if (data.id == null) {
      delete attrs['aria-selected'];
    }

    if (data._resultId != null) {
      option.id = data._resultId;
    }

    if (data.title) {
      option.title = data.title;
    }

    if (data.children) {
      attrs.role = 'group';
      attrs['aria-label'] = data.text;
      delete attrs['aria-selected'];
    }

    for (var attr in attrs) {
      var val = attrs[attr];

      option.setAttribute(attr, val);
    }

    if (data.children) {
      var $option = $(option);

      var label = document.createElement('strong');
      label.className = 'select2-results__group';

      var $label = $(label);
      this.template(data, label);

      var $children = [];

      for (var c = 0; c < data.children.length; c++) {
        var child = data.children[c];

        var $child = this.option(child);

        $children.push($child);
      }

      var $childrenContainer = $('<ul></ul>', {
        'class': 'select2-results__options select2-results__options--nested'
      });

      $childrenContainer.append($children);

      $option.append(label);
      $option.append($childrenContainer);
    } else {
      this.template(data, option);
    }

    Utils.StoreData(option, 'data', data);

    return option;
  };

  Results.prototype.bind = function (container, $container) {
    var self = this;

    var id = container.id + '-results';

    this.$results.attr('id', id);

    container.on('results:all', function (params) {
      self.clear();
      self.append(params.data);

      if (container.isOpen()) {
        self.setClasses();
        self.highlightFirstItem();
      }
    });

    container.on('results:append', function (params) {
      self.append(params.data);

      if (container.isOpen()) {
        self.setClasses();
      }
    });

    container.on('query', function (params) {
      self.hideMessages();
      self.showLoading(params);
    });

    container.on('select', function () {
      if (!container.isOpen()) {
        return;
      }

      self.setClasses();

      if (self.options.get('scrollAfterSelect')) {
        self.highlightFirstItem();
      }
    });

    container.on('unselect', function () {
      if (!container.isOpen()) {
        return;
      }

      self.setClasses();

      if (self.options.get('scrollAfterSelect')) {
        self.highlightFirstItem();
      }
    });

    container.on('open', function () {
      // When the dropdown is open, aria-expended="true"
      self.$results.attr('aria-expanded', 'true');
      self.$results.attr('aria-hidden', 'false');

      self.setClasses();
      self.ensureHighlightVisible();
    });

    container.on('close', function () {
      // When the dropdown is closed, aria-expended="false"
      self.$results.attr('aria-expanded', 'false');
      self.$results.attr('aria-hidden', 'true');
      self.$results.removeAttr('aria-activedescendant');
    });

    container.on('results:toggle', function () {
      var $highlighted = self.getHighlightedResults();

      if ($highlighted.length === 0) {
        return;
      }

      $highlighted.trigger('mouseup');
    });

    container.on('results:select', function () {
      var $highlighted = self.getHighlightedResults();

      if ($highlighted.length === 0) {
        return;
      }

      var data = Utils.GetData($highlighted[0], 'data');

      if ($highlighted.attr('aria-selected') == 'true') {
        self.trigger('close', {});
      } else {
        self.trigger('select', {
          data: data
        });
      }
    });

    container.on('results:previous', function () {
      var $highlighted = self.getHighlightedResults();

      var $options = self.$results.find('[aria-selected]');

      var currentIndex = $options.index($highlighted);

      // If we are already at the top, don't move further
      // If no options, currentIndex will be -1
      if (currentIndex <= 0) {
        return;
      }

      var nextIndex = currentIndex - 1;

      // If none are highlighted, highlight the first
      if ($highlighted.length === 0) {
        nextIndex = 0;
      }

      var $next = $options.eq(nextIndex);

      $next.trigger('mouseenter');

      var currentOffset = self.$results.offset().top;
      var nextTop = $next.offset().top;
      var nextOffset = self.$results.scrollTop() + (nextTop - currentOffset);

      if (nextIndex === 0) {
        self.$results.scrollTop(0);
      } else if (nextTop - currentOffset < 0) {
        self.$results.scrollTop(nextOffset);
      }
    });

    container.on('results:next', function () {
      var $highlighted = self.getHighlightedResults();

      var $options = self.$results.find('[aria-selected]');

      var currentIndex = $options.index($highlighted);

      var nextIndex = currentIndex + 1;

      // If we are at the last option, stay there
      if (nextIndex >= $options.length) {
        return;
      }

      var $next = $options.eq(nextIndex);

      $next.trigger('mouseenter');

      var currentOffset = self.$results.offset().top +
        self.$results.outerHeight(false);
      var nextBottom = $next.offset().top + $next.outerHeight(false);
      var nextOffset = self.$results.scrollTop() + nextBottom - currentOffset;

      if (nextIndex === 0) {
        self.$results.scrollTop(0);
      } else if (nextBottom > currentOffset) {
        self.$results.scrollTop(nextOffset);
      }
    });

    container.on('results:focus', function (params) {
      params.element.addClass('select2-results__option--highlighted');
    });

    container.on('results:message', function (params) {
      self.displayMessage(params);
    });

    if ($.fn.mousewheel) {
      this.$results.on('mousewheel', function (e) {
        var top = self.$results.scrollTop();

        var bottom = self.$results.get(0).scrollHeight - top + e.deltaY;

        var isAtTop = e.deltaY > 0 && top - e.deltaY <= 0;
        var isAtBottom = e.deltaY < 0 && bottom <= self.$results.height();

        if (isAtTop) {
          self.$results.scrollTop(0);

          e.preventDefault();
          e.stopPropagation();
        } else if (isAtBottom) {
          self.$results.scrollTop(
            self.$results.get(0).scrollHeight - self.$results.height()
          );

          e.preventDefault();
          e.stopPropagation();
        }
      });
    }

    this.$results.on('mouseup', '.select2-results__option[aria-selected]',
      function (evt) {
      var $this = $(this);

      var data = Utils.GetData(this, 'data');

      if ($this.attr('aria-selected') === 'true') {
        if (self.options.get('multiple')) {
          self.trigger('unselect', {
            originalEvent: evt,
            data: data
          });
        } else {
          self.trigger('close', {});
        }

        return;
      }

      self.trigger('select', {
        originalEvent: evt,
        data: data
      });
    });

    this.$results.on('mouseenter', '.select2-results__option[aria-selected]',
      function (evt) {
      var data = Utils.GetData(this, 'data');

      self.getHighlightedResults()
          .removeClass('select2-results__option--highlighted');

      self.trigger('results:focus', {
        data: data,
        element: $(this)
      });
    });
  };

  Results.prototype.getHighlightedResults = function () {
    var $highlighted = this.$results
    .find('.select2-results__option--highlighted');

    return $highlighted;
  };

  Results.prototype.destroy = function () {
    this.$results.remove();
  };

  Results.prototype.ensureHighlightVisible = function () {
    var $highlighted = this.getHighlightedResults();

    if ($highlighted.length === 0) {
      return;
    }

    var $options = this.$results.find('[aria-selected]');

    var currentIndex = $options.index($highlighted);

    var currentOffset = this.$results.offset().top;
    var nextTop = $highlighted.offset().top;
    var nextOffset = this.$results.scrollTop() + (nextTop - currentOffset);

    var offsetDelta = nextTop - currentOffset;
    nextOffset -= $highlighted.outerHeight(false) * 2;

    if (currentIndex <= 2) {
      this.$results.scrollTop(0);
    } else if (offsetDelta > this.$results.outerHeight() || offsetDelta < 0) {
      this.$results.scrollTop(nextOffset);
    }
  };

  Results.prototype.template = function (result, container) {
    var template = this.options.get('templateResult');
    var escapeMarkup = this.options.get('escapeMarkup');

    var content = template(result, container);

    if (content == null) {
      container.style.display = 'none';
    } else if (typeof content === 'string') {
      container.innerHTML = escapeMarkup(content);
    } else {
      $(container).append(content);
    }
  };

  return Results;
});

S2.define('select2/keys',[

], function () {
  var KEYS = {
    BACKSPACE: 8,
    TAB: 9,
    ENTER: 13,
    SHIFT: 16,
    CTRL: 17,
    ALT: 18,
    ESC: 27,
    SPACE: 32,
    PAGE_UP: 33,
    PAGE_DOWN: 34,
    END: 35,
    HOME: 36,
    LEFT: 37,
    UP: 38,
    RIGHT: 39,
    DOWN: 40,
    DELETE: 46
  };

  return KEYS;
});

S2.define('select2/selection/base',[
  'jquery',
  '../utils',
  '../keys'
], function ($, Utils, KEYS) {
  function BaseSelection ($element, options) {
    this.$element = $element;
    this.options = options;

    BaseSelection.__super__.constructor.call(this);
  }

  Utils.Extend(BaseSelection, Utils.Observable);

  BaseSelection.prototype.render = function () {
    var $selection = $(
      '<span class="select2-selection" role="combobox" ' +
      ' aria-haspopup="true" aria-expanded="false">' +
      '</span>'
    );

    this._tabindex = 0;

    if (Utils.GetData(this.$element[0], 'old-tabindex') != null) {
      this._tabindex = Utils.GetData(this.$element[0], 'old-tabindex');
    } else if (this.$element.attr('tabindex') != null) {
      this._tabindex = this.$element.attr('tabindex');
    }

    $selection.attr('title', this.$element.attr('title'));
    $selection.attr('tabindex', this._tabindex);
    $selection.attr('aria-disabled', 'false');

    this.$selection = $selection;

    return $selection;
  };

  BaseSelection.prototype.bind = function (container, $container) {
    var self = this;

    var resultsId = container.id + '-results';

    this.container = container;

    this.$selection.on('focus', function (evt) {
      self.trigger('focus', evt);
    });

    this.$selection.on('blur', function (evt) {
      self._handleBlur(evt);
    });

    this.$selection.on('keydown', function (evt) {
      self.trigger('keypress', evt);

      if (evt.which === KEYS.SPACE) {
        evt.preventDefault();
      }
    });

    container.on('results:focus', function (params) {
      self.$selection.attr('aria-activedescendant', params.data._resultId);
    });

    container.on('selection:update', function (params) {
      self.update(params.data);
    });

    container.on('open', function () {
      // When the dropdown is open, aria-expanded="true"
      self.$selection.attr('aria-expanded', 'true');
      self.$selection.attr('aria-owns', resultsId);

      self._attachCloseHandler(container);
    });

    container.on('close', function () {
      // When the dropdown is closed, aria-expanded="false"
      self.$selection.attr('aria-expanded', 'false');
      self.$selection.removeAttr('aria-activedescendant');
      self.$selection.removeAttr('aria-owns');

      self.$selection.trigger('focus');

      self._detachCloseHandler(container);
    });

    container.on('enable', function () {
      self.$selection.attr('tabindex', self._tabindex);
      self.$selection.attr('aria-disabled', 'false');
    });

    container.on('disable', function () {
      self.$selection.attr('tabindex', '-1');
      self.$selection.attr('aria-disabled', 'true');
    });
  };

  BaseSelection.prototype._handleBlur = function (evt) {
    var self = this;

    // This needs to be delayed as the active element is the body when the tab
    // key is pressed, possibly along with others.
    window.setTimeout(function () {
      // Don't trigger `blur` if the focus is still in the selection
      if (
        (document.activeElement == self.$selection[0]) ||
        ($.contains(self.$selection[0], document.activeElement))
      ) {
        return;
      }

      self.trigger('blur', evt);
    }, 1);
  };

  BaseSelection.prototype._attachCloseHandler = function (container) {

    $(document.body).on('mousedown.select2.' + container.id, function (e) {
      var $target = $(e.target);

      var $select = $target.closest('.select2');

      var $all = $('.select2.select2-container--open');

      $all.each(function () {
        if (this == $select[0]) {
          return;
        }

        var $element = Utils.GetData(this, 'element');

        $element.select2('close');
      });
    });
  };

  BaseSelection.prototype._detachCloseHandler = function (container) {
    $(document.body).off('mousedown.select2.' + container.id);
  };

  BaseSelection.prototype.position = function ($selection, $container) {
    var $selectionContainer = $container.find('.selection');
    $selectionContainer.append($selection);
  };

  BaseSelection.prototype.destroy = function () {
    this._detachCloseHandler(this.container);
  };

  BaseSelection.prototype.update = function (data) {
    throw new Error('The `update` method must be defined in child classes.');
  };

  return BaseSelection;
});

S2.define('select2/selection/single',[
  'jquery',
  './base',
  '../utils',
  '../keys'
], function ($, BaseSelection, Utils, KEYS) {
  function SingleSelection () {
    SingleSelection.__super__.constructor.apply(this, arguments);
  }

  Utils.Extend(SingleSelection, BaseSelection);

  SingleSelection.prototype.render = function () {
    var $selection = SingleSelection.__super__.render.call(this);

    $selection.addClass('select2-selection--single');

    $selection.html(
      '<span class="select2-selection__rendered"></span>' +
      '<span class="select2-selection__arrow" role="presentation">' +
        '<b role="presentation"></b>' +
      '</span>'
    );

    return $selection;
  };

  SingleSelection.prototype.bind = function (container, $container) {
    var self = this;

    SingleSelection.__super__.bind.apply(this, arguments);

    var id = container.id + '-container';

    this.$selection.find('.select2-selection__rendered')
      .attr('id', id)
      .attr('role', 'textbox')
      .attr('aria-readonly', 'true');
    this.$selection.attr('aria-labelledby', id);

    this.$selection.on('mousedown', function (evt) {
      // Only respond to left clicks
      if (evt.which !== 1) {
        return;
      }

      self.trigger('toggle', {
        originalEvent: evt
      });
    });

    this.$selection.on('focus', function (evt) {
      // User focuses on the container
    });

    this.$selection.on('blur', function (evt) {
      // User exits the container
    });

    container.on('focus', function (evt) {
      if (!container.isOpen()) {
        self.$selection.trigger('focus');
      }
    });
  };

  SingleSelection.prototype.clear = function () {
    var $rendered = this.$selection.find('.select2-selection__rendered');
    $rendered.empty();
    $rendered.removeAttr('title'); // clear tooltip on empty
  };

  SingleSelection.prototype.display = function (data, container) {
    var template = this.options.get('templateSelection');
    var escapeMarkup = this.options.get('escapeMarkup');

    return escapeMarkup(template(data, container));
  };

  SingleSelection.prototype.selectionContainer = function () {
    return $('<span></span>');
  };

  SingleSelection.prototype.update = function (data) {
    if (data.length === 0) {
      this.clear();
      return;
    }

    var selection = data[0];

    var $rendered = this.$selection.find('.select2-selection__rendered');
    var formatted = this.display(selection, $rendered);

    $rendered.empty().append(formatted);

    var title = selection.title || selection.text;

    if (title) {
      $rendered.attr('title', title);
    } else {
      $rendered.removeAttr('title');
    }
  };

  return SingleSelection;
});

S2.define('select2/selection/multiple',[
  'jquery',
  './base',
  '../utils'
], function ($, BaseSelection, Utils) {
  function MultipleSelection ($element, options) {
    MultipleSelection.__super__.constructor.apply(this, arguments);
  }

  Utils.Extend(MultipleSelection, BaseSelection);

  MultipleSelection.prototype.render = function () {
    var $selection = MultipleSelection.__super__.render.call(this);

    $selection.addClass('select2-selection--multiple');

    $selection.html(
      '<ul class="select2-selection__rendered"></ul>'
    );

    return $selection;
  };

  MultipleSelection.prototype.bind = function (container, $container) {
    var self = this;

    MultipleSelection.__super__.bind.apply(this, arguments);

    this.$selection.on('click', function (evt) {
      self.trigger('toggle', {
        originalEvent: evt
      });
    });

    this.$selection.on(
      'click',
      '.select2-selection__choice__remove',
      function (evt) {
        // Ignore the event if it is disabled
        if (self.options.get('disabled')) {
          return;
        }

        var $remove = $(this);
        var $selection = $remove.parent();

        var data = Utils.GetData($selection[0], 'data');

        self.trigger('unselect', {
          originalEvent: evt,
          data: data
        });
      }
    );
  };

  MultipleSelection.prototype.clear = function () {
    var $rendered = this.$selection.find('.select2-selection__rendered');
    $rendered.empty();
    $rendered.removeAttr('title');
  };

  MultipleSelection.prototype.display = function (data, container) {
    var template = this.options.get('templateSelection');
    var escapeMarkup = this.options.get('escapeMarkup');

    return escapeMarkup(template(data, container));
  };

  MultipleSelection.prototype.selectionContainer = function () {
    var $container = $(
      '<li class="select2-selection__choice">' +
        '<span class="select2-selection__choice__remove" role="presentation">' +
          '&times;' +
        '</span>' +
      '</li>'
    );

    return $container;
  };

  MultipleSelection.prototype.update = function (data) {
    this.clear();

    if (data.length === 0) {
      return;
    }

    var $selections = [];

    for (var d = 0; d < data.length; d++) {
      var selection = data[d];

      var $selection = this.selectionContainer();
      var formatted = this.display(selection, $selection);

      $selection.append(formatted);

      var title = selection.title || selection.text;

      if (title) {
        $selection.attr('title', title);
      }

      Utils.StoreData($selection[0], 'data', selection);

      $selections.push($selection);
    }

    var $rendered = this.$selection.find('.select2-selection__rendered');

    Utils.appendMany($rendered, $selections);
  };

  return MultipleSelection;
});

S2.define('select2/selection/placeholder',[
  '../utils'
], function (Utils) {
  function Placeholder (decorated, $element, options) {
    this.placeholder = this.normalizePlaceholder(options.get('placeholder'));

    decorated.call(this, $element, options);
  }

  Placeholder.prototype.normalizePlaceholder = function (_, placeholder) {
    if (typeof placeholder === 'string') {
      placeholder = {
        id: '',
        text: placeholder
      };
    }

    return placeholder;
  };

  Placeholder.prototype.createPlaceholder = function (decorated, placeholder) {
    var $placeholder = this.selectionContainer();

    $placeholder.html(this.display(placeholder));
    $placeholder.addClass('select2-selection__placeholder')
                .removeClass('select2-selection__choice');

    return $placeholder;
  };

  Placeholder.prototype.update = function (decorated, data) {
    var singlePlaceholder = (
      data.length == 1 && data[0].id != this.placeholder.id
    );
    var multipleSelections = data.length > 1;

    if (multipleSelections || singlePlaceholder) {
      return decorated.call(this, data);
    }

    this.clear();

    var $placeholder = this.createPlaceholder(this.placeholder);

    this.$selection.find('.select2-selection__rendered').append($placeholder);
  };

  return Placeholder;
});

S2.define('select2/selection/allowClear',[
  'jquery',
  '../keys',
  '../utils'
], function ($, KEYS, Utils) {
  function AllowClear () { }

  AllowClear.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    if (this.placeholder == null) {
      if (this.options.get('debug') && window.console && console.error) {
        console.error(
          'Select2: The `allowClear` option should be used in combination ' +
          'with the `placeholder` option.'
        );
      }
    }

    this.$selection.on('mousedown', '.select2-selection__clear',
      function (evt) {
        self._handleClear(evt);
    });

    container.on('keypress', function (evt) {
      self._handleKeyboardClear(evt, container);
    });
  };

  AllowClear.prototype._handleClear = function (_, evt) {
    // Ignore the event if it is disabled
    if (this.options.get('disabled')) {
      return;
    }

    var $clear = this.$selection.find('.select2-selection__clear');

    // Ignore the event if nothing has been selected
    if ($clear.length === 0) {
      return;
    }

    evt.stopPropagation();

    var data = Utils.GetData($clear[0], 'data');

    var previousVal = this.$element.val();
    this.$element.val(this.placeholder.id);

    var unselectData = {
      data: data
    };
    this.trigger('clear', unselectData);
    if (unselectData.prevented) {
      this.$element.val(previousVal);
      return;
    }

    for (var d = 0; d < data.length; d++) {
      unselectData = {
        data: data[d]
      };

      // Trigger the `unselect` event, so people can prevent it from being
      // cleared.
      this.trigger('unselect', unselectData);

      // If the event was prevented, don't clear it out.
      if (unselectData.prevented) {
        this.$element.val(previousVal);
        return;
      }
    }

    this.$element.trigger('change');

    this.trigger('toggle', {});
  };

  AllowClear.prototype._handleKeyboardClear = function (_, evt, container) {
    if (container.isOpen()) {
      return;
    }

    if (evt.which == KEYS.DELETE || evt.which == KEYS.BACKSPACE) {
      this._handleClear(evt);
    }
  };

  AllowClear.prototype.update = function (decorated, data) {
    decorated.call(this, data);

    if (this.$selection.find('.select2-selection__placeholder').length > 0 ||
        data.length === 0) {
      return;
    }

    var removeAll = this.options.get('translations').get('removeAllItems');   

    var $remove = $(
      '<span class="select2-selection__clear" title="' + removeAll() +'">' +
        '&times;' +
      '</span>'
    );
    Utils.StoreData($remove[0], 'data', data);

    this.$selection.find('.select2-selection__rendered').prepend($remove);
  };

  return AllowClear;
});

S2.define('select2/selection/search',[
  'jquery',
  '../utils',
  '../keys'
], function ($, Utils, KEYS) {
  function Search (decorated, $element, options) {
    decorated.call(this, $element, options);
  }

  Search.prototype.render = function (decorated) {
    var $search = $(
      '<li class="select2-search select2-search--inline">' +
        '<input class="select2-search__field" type="search" tabindex="-1"' +
        ' autocomplete="off" autocorrect="off" autocapitalize="none"' +
        ' spellcheck="false" role="searchbox" aria-autocomplete="list" />' +
      '</li>'
    );

    this.$searchContainer = $search;
    this.$search = $search.find('input');

    var $rendered = decorated.call(this);

    this._transferTabIndex();

    return $rendered;
  };

  Search.prototype.bind = function (decorated, container, $container) {
    var self = this;

    var resultsId = container.id + '-results';

    decorated.call(this, container, $container);

    container.on('open', function () {
      self.$search.attr('aria-controls', resultsId);
      self.$search.trigger('focus');
    });

    container.on('close', function () {
      self.$search.val('');
      self.$search.removeAttr('aria-controls');
      self.$search.removeAttr('aria-activedescendant');
      self.$search.trigger('focus');
    });

    container.on('enable', function () {
      self.$search.prop('disabled', false);

      self._transferTabIndex();
    });

    container.on('disable', function () {
      self.$search.prop('disabled', true);
    });

    container.on('focus', function (evt) {
      self.$search.trigger('focus');
    });

    container.on('results:focus', function (params) {
      if (params.data._resultId) {
        self.$search.attr('aria-activedescendant', params.data._resultId);
      } else {
        self.$search.removeAttr('aria-activedescendant');
      }
    });

    this.$selection.on('focusin', '.select2-search--inline', function (evt) {
      self.trigger('focus', evt);
    });

    this.$selection.on('focusout', '.select2-search--inline', function (evt) {
      self._handleBlur(evt);
    });

    this.$selection.on('keydown', '.select2-search--inline', function (evt) {
      evt.stopPropagation();

      self.trigger('keypress', evt);

      self._keyUpPrevented = evt.isDefaultPrevented();

      var key = evt.which;

      if (key === KEYS.BACKSPACE && self.$search.val() === '') {
        var $previousChoice = self.$searchContainer
          .prev('.select2-selection__choice');

        if ($previousChoice.length > 0) {
          var item = Utils.GetData($previousChoice[0], 'data');

          self.searchRemoveChoice(item);

          evt.preventDefault();
        }
      }
    });

    this.$selection.on('click', '.select2-search--inline', function (evt) {
      if (self.$search.val()) {
        evt.stopPropagation();
      }
    });

    // Try to detect the IE version should the `documentMode` property that
    // is stored on the document. This is only implemented in IE and is
    // slightly cleaner than doing a user agent check.
    // This property is not available in Edge, but Edge also doesn't have
    // this bug.
    var msie = document.documentMode;
    var disableInputEvents = msie && msie <= 11;

    // Workaround for browsers which do not support the `input` event
    // This will prevent double-triggering of events for browsers which support
    // both the `keyup` and `input` events.
    this.$selection.on(
      'input.searchcheck',
      '.select2-search--inline',
      function (evt) {
        // IE will trigger the `input` event when a placeholder is used on a
        // search box. To get around this issue, we are forced to ignore all
        // `input` events in IE and keep using `keyup`.
        if (disableInputEvents) {
          self.$selection.off('input.search input.searchcheck');
          return;
        }

        // Unbind the duplicated `keyup` event
        self.$selection.off('keyup.search');
      }
    );

    this.$selection.on(
      'keyup.search input.search',
      '.select2-search--inline',
      function (evt) {
        // IE will trigger the `input` event when a placeholder is used on a
        // search box. To get around this issue, we are forced to ignore all
        // `input` events in IE and keep using `keyup`.
        if (disableInputEvents && evt.type === 'input') {
          self.$selection.off('input.search input.searchcheck');
          return;
        }

        var key = evt.which;

        // We can freely ignore events from modifier keys
        if (key == KEYS.SHIFT || key == KEYS.CTRL || key == KEYS.ALT) {
          return;
        }

        // Tabbing will be handled during the `keydown` phase
        if (key == KEYS.TAB) {
          return;
        }

        self.handleSearch(evt);
      }
    );
  };

  /**
   * This method will transfer the tabindex attribute from the rendered
   * selection to the search box. This allows for the search box to be used as
   * the primary focus instead of the selection container.
   *
   * @private
   */
  Search.prototype._transferTabIndex = function (decorated) {
    this.$search.attr('tabindex', this.$selection.attr('tabindex'));
    this.$selection.attr('tabindex', '-1');
  };

  Search.prototype.createPlaceholder = function (decorated, placeholder) {
    this.$search.attr('placeholder', placeholder.text);
  };

  Search.prototype.update = function (decorated, data) {
    var searchHadFocus = this.$search[0] == document.activeElement;

    this.$search.attr('placeholder', '');

    decorated.call(this, data);

    this.$selection.find('.select2-selection__rendered')
                   .append(this.$searchContainer);

    this.resizeSearch();
    if (searchHadFocus) {
      this.$search.trigger('focus');
    }
  };

  Search.prototype.handleSearch = function () {
    this.resizeSearch();

    if (!this._keyUpPrevented) {
      var input = this.$search.val();

      this.trigger('query', {
        term: input
      });
    }

    this._keyUpPrevented = false;
  };

  Search.prototype.searchRemoveChoice = function (decorated, item) {
    this.trigger('unselect', {
      data: item
    });

    this.$search.val(item.text);
    this.handleSearch();
  };

  Search.prototype.resizeSearch = function () {
    this.$search.css('width', '25px');

    var width = '';

    if (this.$search.attr('placeholder') !== '') {
      width = this.$selection.find('.select2-selection__rendered').width();
    } else {
      var minimumWidth = this.$search.val().length + 1;

      width = (minimumWidth * 0.75) + 'em';
    }

    this.$search.css('width', width);
  };

  return Search;
});

S2.define('select2/selection/eventRelay',[
  'jquery'
], function ($) {
  function EventRelay () { }

  EventRelay.prototype.bind = function (decorated, container, $container) {
    var self = this;
    var relayEvents = [
      'open', 'opening',
      'close', 'closing',
      'select', 'selecting',
      'unselect', 'unselecting',
      'clear', 'clearing'
    ];

    var preventableEvents = [
      'opening', 'closing', 'selecting', 'unselecting', 'clearing'
    ];

    decorated.call(this, container, $container);

    container.on('*', function (name, params) {
      // Ignore events that should not be relayed
      if ($.inArray(name, relayEvents) === -1) {
        return;
      }

      // The parameters should always be an object
      params = params || {};

      // Generate the jQuery event for the Select2 event
      var evt = $.Event('select2:' + name, {
        params: params
      });

      self.$element.trigger(evt);

      // Only handle preventable events if it was one
      if ($.inArray(name, preventableEvents) === -1) {
        return;
      }

      params.prevented = evt.isDefaultPrevented();
    });
  };

  return EventRelay;
});

S2.define('select2/translation',[
  'jquery',
  'require'
], function ($, require) {
  function Translation (dict) {
    this.dict = dict || {};
  }

  Translation.prototype.all = function () {
    return this.dict;
  };

  Translation.prototype.get = function (key) {
    return this.dict[key];
  };

  Translation.prototype.extend = function (translation) {
    this.dict = $.extend({}, translation.all(), this.dict);
  };

  // Static functions

  Translation._cache = {};

  Translation.loadPath = function (path) {
    if (!(path in Translation._cache)) {
      var translations = require(path);

      Translation._cache[path] = translations;
    }

    return new Translation(Translation._cache[path]);
  };

  return Translation;
});

S2.define('select2/diacritics',[

], function () {
  var diacritics = {
    '\u24B6': 'A',
    '\uFF21': 'A',
    '\u00C0': 'A',
    '\u00C1': 'A',
    '\u00C2': 'A',
    '\u1EA6': 'A',
    '\u1EA4': 'A',
    '\u1EAA': 'A',
    '\u1EA8': 'A',
    '\u00C3': 'A',
    '\u0100': 'A',
    '\u0102': 'A',
    '\u1EB0': 'A',
    '\u1EAE': 'A',
    '\u1EB4': 'A',
    '\u1EB2': 'A',
    '\u0226': 'A',
    '\u01E0': 'A',
    '\u00C4': 'A',
    '\u01DE': 'A',
    '\u1EA2': 'A',
    '\u00C5': 'A',
    '\u01FA': 'A',
    '\u01CD': 'A',
    '\u0200': 'A',
    '\u0202': 'A',
    '\u1EA0': 'A',
    '\u1EAC': 'A',
    '\u1EB6': 'A',
    '\u1E00': 'A',
    '\u0104': 'A',
    '\u023A': 'A',
    '\u2C6F': 'A',
    '\uA732': 'AA',
    '\u00C6': 'AE',
    '\u01FC': 'AE',
    '\u01E2': 'AE',
    '\uA734': 'AO',
    '\uA736': 'AU',
    '\uA738': 'AV',
    '\uA73A': 'AV',
    '\uA73C': 'AY',
    '\u24B7': 'B',
    '\uFF22': 'B',
    '\u1E02': 'B',
    '\u1E04': 'B',
    '\u1E06': 'B',
    '\u0243': 'B',
    '\u0182': 'B',
    '\u0181': 'B',
    '\u24B8': 'C',
    '\uFF23': 'C',
    '\u0106': 'C',
    '\u0108': 'C',
    '\u010A': 'C',
    '\u010C': 'C',
    '\u00C7': 'C',
    '\u1E08': 'C',
    '\u0187': 'C',
    '\u023B': 'C',
    '\uA73E': 'C',
    '\u24B9': 'D',
    '\uFF24': 'D',
    '\u1E0A': 'D',
    '\u010E': 'D',
    '\u1E0C': 'D',
    '\u1E10': 'D',
    '\u1E12': 'D',
    '\u1E0E': 'D',
    '\u0110': 'D',
    '\u018B': 'D',
    '\u018A': 'D',
    '\u0189': 'D',
    '\uA779': 'D',
    '\u01F1': 'DZ',
    '\u01C4': 'DZ',
    '\u01F2': 'Dz',
    '\u01C5': 'Dz',
    '\u24BA': 'E',
    '\uFF25': 'E',
    '\u00C8': 'E',
    '\u00C9': 'E',
    '\u00CA': 'E',
    '\u1EC0': 'E',
    '\u1EBE': 'E',
    '\u1EC4': 'E',
    '\u1EC2': 'E',
    '\u1EBC': 'E',
    '\u0112': 'E',
    '\u1E14': 'E',
    '\u1E16': 'E',
    '\u0114': 'E',
    '\u0116': 'E',
    '\u00CB': 'E',
    '\u1EBA': 'E',
    '\u011A': 'E',
    '\u0204': 'E',
    '\u0206': 'E',
    '\u1EB8': 'E',
    '\u1EC6': 'E',
    '\u0228': 'E',
    '\u1E1C': 'E',
    '\u0118': 'E',
    '\u1E18': 'E',
    '\u1E1A': 'E',
    '\u0190': 'E',
    '\u018E': 'E',
    '\u24BB': 'F',
    '\uFF26': 'F',
    '\u1E1E': 'F',
    '\u0191': 'F',
    '\uA77B': 'F',
    '\u24BC': 'G',
    '\uFF27': 'G',
    '\u01F4': 'G',
    '\u011C': 'G',
    '\u1E20': 'G',
    '\u011E': 'G',
    '\u0120': 'G',
    '\u01E6': 'G',
    '\u0122': 'G',
    '\u01E4': 'G',
    '\u0193': 'G',
    '\uA7A0': 'G',
    '\uA77D': 'G',
    '\uA77E': 'G',
    '\u24BD': 'H',
    '\uFF28': 'H',
    '\u0124': 'H',
    '\u1E22': 'H',
    '\u1E26': 'H',
    '\u021E': 'H',
    '\u1E24': 'H',
    '\u1E28': 'H',
    '\u1E2A': 'H',
    '\u0126': 'H',
    '\u2C67': 'H',
    '\u2C75': 'H',
    '\uA78D': 'H',
    '\u24BE': 'I',
    '\uFF29': 'I',
    '\u00CC': 'I',
    '\u00CD': 'I',
    '\u00CE': 'I',
    '\u0128': 'I',
    '\u012A': 'I',
    '\u012C': 'I',
    '\u0130': 'I',
    '\u00CF': 'I',
    '\u1E2E': 'I',
    '\u1EC8': 'I',
    '\u01CF': 'I',
    '\u0208': 'I',
    '\u020A': 'I',
    '\u1ECA': 'I',
    '\u012E': 'I',
    '\u1E2C': 'I',
    '\u0197': 'I',
    '\u24BF': 'J',
    '\uFF2A': 'J',
    '\u0134': 'J',
    '\u0248': 'J',
    '\u24C0': 'K',
    '\uFF2B': 'K',
    '\u1E30': 'K',
    '\u01E8': 'K',
    '\u1E32': 'K',
    '\u0136': 'K',
    '\u1E34': 'K',
    '\u0198': 'K',
    '\u2C69': 'K',
    '\uA740': 'K',
    '\uA742': 'K',
    '\uA744': 'K',
    '\uA7A2': 'K',
    '\u24C1': 'L',
    '\uFF2C': 'L',
    '\u013F': 'L',
    '\u0139': 'L',
    '\u013D': 'L',
    '\u1E36': 'L',
    '\u1E38': 'L',
    '\u013B': 'L',
    '\u1E3C': 'L',
    '\u1E3A': 'L',
    '\u0141': 'L',
    '\u023D': 'L',
    '\u2C62': 'L',
    '\u2C60': 'L',
    '\uA748': 'L',
    '\uA746': 'L',
    '\uA780': 'L',
    '\u01C7': 'LJ',
    '\u01C8': 'Lj',
    '\u24C2': 'M',
    '\uFF2D': 'M',
    '\u1E3E': 'M',
    '\u1E40': 'M',
    '\u1E42': 'M',
    '\u2C6E': 'M',
    '\u019C': 'M',
    '\u24C3': 'N',
    '\uFF2E': 'N',
    '\u01F8': 'N',
    '\u0143': 'N',
    '\u00D1': 'N',
    '\u1E44': 'N',
    '\u0147': 'N',
    '\u1E46': 'N',
    '\u0145': 'N',
    '\u1E4A': 'N',
    '\u1E48': 'N',
    '\u0220': 'N',
    '\u019D': 'N',
    '\uA790': 'N',
    '\uA7A4': 'N',
    '\u01CA': 'NJ',
    '\u01CB': 'Nj',
    '\u24C4': 'O',
    '\uFF2F': 'O',
    '\u00D2': 'O',
    '\u00D3': 'O',
    '\u00D4': 'O',
    '\u1ED2': 'O',
    '\u1ED0': 'O',
    '\u1ED6': 'O',
    '\u1ED4': 'O',
    '\u00D5': 'O',
    '\u1E4C': 'O',
    '\u022C': 'O',
    '\u1E4E': 'O',
    '\u014C': 'O',
    '\u1E50': 'O',
    '\u1E52': 'O',
    '\u014E': 'O',
    '\u022E': 'O',
    '\u0230': 'O',
    '\u00D6': 'O',
    '\u022A': 'O',
    '\u1ECE': 'O',
    '\u0150': 'O',
    '\u01D1': 'O',
    '\u020C': 'O',
    '\u020E': 'O',
    '\u01A0': 'O',
    '\u1EDC': 'O',
    '\u1EDA': 'O',
    '\u1EE0': 'O',
    '\u1EDE': 'O',
    '\u1EE2': 'O',
    '\u1ECC': 'O',
    '\u1ED8': 'O',
    '\u01EA': 'O',
    '\u01EC': 'O',
    '\u00D8': 'O',
    '\u01FE': 'O',
    '\u0186': 'O',
    '\u019F': 'O',
    '\uA74A': 'O',
    '\uA74C': 'O',
    '\u0152': 'OE',
    '\u01A2': 'OI',
    '\uA74E': 'OO',
    '\u0222': 'OU',
    '\u24C5': 'P',
    '\uFF30': 'P',
    '\u1E54': 'P',
    '\u1E56': 'P',
    '\u01A4': 'P',
    '\u2C63': 'P',
    '\uA750': 'P',
    '\uA752': 'P',
    '\uA754': 'P',
    '\u24C6': 'Q',
    '\uFF31': 'Q',
    '\uA756': 'Q',
    '\uA758': 'Q',
    '\u024A': 'Q',
    '\u24C7': 'R',
    '\uFF32': 'R',
    '\u0154': 'R',
    '\u1E58': 'R',
    '\u0158': 'R',
    '\u0210': 'R',
    '\u0212': 'R',
    '\u1E5A': 'R',
    '\u1E5C': 'R',
    '\u0156': 'R',
    '\u1E5E': 'R',
    '\u024C': 'R',
    '\u2C64': 'R',
    '\uA75A': 'R',
    '\uA7A6': 'R',
    '\uA782': 'R',
    '\u24C8': 'S',
    '\uFF33': 'S',
    '\u1E9E': 'S',
    '\u015A': 'S',
    '\u1E64': 'S',
    '\u015C': 'S',
    '\u1E60': 'S',
    '\u0160': 'S',
    '\u1E66': 'S',
    '\u1E62': 'S',
    '\u1E68': 'S',
    '\u0218': 'S',
    '\u015E': 'S',
    '\u2C7E': 'S',
    '\uA7A8': 'S',
    '\uA784': 'S',
    '\u24C9': 'T',
    '\uFF34': 'T',
    '\u1E6A': 'T',
    '\u0164': 'T',
    '\u1E6C': 'T',
    '\u021A': 'T',
    '\u0162': 'T',
    '\u1E70': 'T',
    '\u1E6E': 'T',
    '\u0166': 'T',
    '\u01AC': 'T',
    '\u01AE': 'T',
    '\u023E': 'T',
    '\uA786': 'T',
    '\uA728': 'TZ',
    '\u24CA': 'U',
    '\uFF35': 'U',
    '\u00D9': 'U',
    '\u00DA': 'U',
    '\u00DB': 'U',
    '\u0168': 'U',
    '\u1E78': 'U',
    '\u016A': 'U',
    '\u1E7A': 'U',
    '\u016C': 'U',
    '\u00DC': 'U',
    '\u01DB': 'U',
    '\u01D7': 'U',
    '\u01D5': 'U',
    '\u01D9': 'U',
    '\u1EE6': 'U',
    '\u016E': 'U',
    '\u0170': 'U',
    '\u01D3': 'U',
    '\u0214': 'U',
    '\u0216': 'U',
    '\u01AF': 'U',
    '\u1EEA': 'U',
    '\u1EE8': 'U',
    '\u1EEE': 'U',
    '\u1EEC': 'U',
    '\u1EF0': 'U',
    '\u1EE4': 'U',
    '\u1E72': 'U',
    '\u0172': 'U',
    '\u1E76': 'U',
    '\u1E74': 'U',
    '\u0244': 'U',
    '\u24CB': 'V',
    '\uFF36': 'V',
    '\u1E7C': 'V',
    '\u1E7E': 'V',
    '\u01B2': 'V',
    '\uA75E': 'V',
    '\u0245': 'V',
    '\uA760': 'VY',
    '\u24CC': 'W',
    '\uFF37': 'W',
    '\u1E80': 'W',
    '\u1E82': 'W',
    '\u0174': 'W',
    '\u1E86': 'W',
    '\u1E84': 'W',
    '\u1E88': 'W',
    '\u2C72': 'W',
    '\u24CD': 'X',
    '\uFF38': 'X',
    '\u1E8A': 'X',
    '\u1E8C': 'X',
    '\u24CE': 'Y',
    '\uFF39': 'Y',
    '\u1EF2': 'Y',
    '\u00DD': 'Y',
    '\u0176': 'Y',
    '\u1EF8': 'Y',
    '\u0232': 'Y',
    '\u1E8E': 'Y',
    '\u0178': 'Y',
    '\u1EF6': 'Y',
    '\u1EF4': 'Y',
    '\u01B3': 'Y',
    '\u024E': 'Y',
    '\u1EFE': 'Y',
    '\u24CF': 'Z',
    '\uFF3A': 'Z',
    '\u0179': 'Z',
    '\u1E90': 'Z',
    '\u017B': 'Z',
    '\u017D': 'Z',
    '\u1E92': 'Z',
    '\u1E94': 'Z',
    '\u01B5': 'Z',
    '\u0224': 'Z',
    '\u2C7F': 'Z',
    '\u2C6B': 'Z',
    '\uA762': 'Z',
    '\u24D0': 'a',
    '\uFF41': 'a',
    '\u1E9A': 'a',
    '\u00E0': 'a',
    '\u00E1': 'a',
    '\u00E2': 'a',
    '\u1EA7': 'a',
    '\u1EA5': 'a',
    '\u1EAB': 'a',
    '\u1EA9': 'a',
    '\u00E3': 'a',
    '\u0101': 'a',
    '\u0103': 'a',
    '\u1EB1': 'a',
    '\u1EAF': 'a',
    '\u1EB5': 'a',
    '\u1EB3': 'a',
    '\u0227': 'a',
    '\u01E1': 'a',
    '\u00E4': 'a',
    '\u01DF': 'a',
    '\u1EA3': 'a',
    '\u00E5': 'a',
    '\u01FB': 'a',
    '\u01CE': 'a',
    '\u0201': 'a',
    '\u0203': 'a',
    '\u1EA1': 'a',
    '\u1EAD': 'a',
    '\u1EB7': 'a',
    '\u1E01': 'a',
    '\u0105': 'a',
    '\u2C65': 'a',
    '\u0250': 'a',
    '\uA733': 'aa',
    '\u00E6': 'ae',
    '\u01FD': 'ae',
    '\u01E3': 'ae',
    '\uA735': 'ao',
    '\uA737': 'au',
    '\uA739': 'av',
    '\uA73B': 'av',
    '\uA73D': 'ay',
    '\u24D1': 'b',
    '\uFF42': 'b',
    '\u1E03': 'b',
    '\u1E05': 'b',
    '\u1E07': 'b',
    '\u0180': 'b',
    '\u0183': 'b',
    '\u0253': 'b',
    '\u24D2': 'c',
    '\uFF43': 'c',
    '\u0107': 'c',
    '\u0109': 'c',
    '\u010B': 'c',
    '\u010D': 'c',
    '\u00E7': 'c',
    '\u1E09': 'c',
    '\u0188': 'c',
    '\u023C': 'c',
    '\uA73F': 'c',
    '\u2184': 'c',
    '\u24D3': 'd',
    '\uFF44': 'd',
    '\u1E0B': 'd',
    '\u010F': 'd',
    '\u1E0D': 'd',
    '\u1E11': 'd',
    '\u1E13': 'd',
    '\u1E0F': 'd',
    '\u0111': 'd',
    '\u018C': 'd',
    '\u0256': 'd',
    '\u0257': 'd',
    '\uA77A': 'd',
    '\u01F3': 'dz',
    '\u01C6': 'dz',
    '\u24D4': 'e',
    '\uFF45': 'e',
    '\u00E8': 'e',
    '\u00E9': 'e',
    '\u00EA': 'e',
    '\u1EC1': 'e',
    '\u1EBF': 'e',
    '\u1EC5': 'e',
    '\u1EC3': 'e',
    '\u1EBD': 'e',
    '\u0113': 'e',
    '\u1E15': 'e',
    '\u1E17': 'e',
    '\u0115': 'e',
    '\u0117': 'e',
    '\u00EB': 'e',
    '\u1EBB': 'e',
    '\u011B': 'e',
    '\u0205': 'e',
    '\u0207': 'e',
    '\u1EB9': 'e',
    '\u1EC7': 'e',
    '\u0229': 'e',
    '\u1E1D': 'e',
    '\u0119': 'e',
    '\u1E19': 'e',
    '\u1E1B': 'e',
    '\u0247': 'e',
    '\u025B': 'e',
    '\u01DD': 'e',
    '\u24D5': 'f',
    '\uFF46': 'f',
    '\u1E1F': 'f',
    '\u0192': 'f',
    '\uA77C': 'f',
    '\u24D6': 'g',
    '\uFF47': 'g',
    '\u01F5': 'g',
    '\u011D': 'g',
    '\u1E21': 'g',
    '\u011F': 'g',
    '\u0121': 'g',
    '\u01E7': 'g',
    '\u0123': 'g',
    '\u01E5': 'g',
    '\u0260': 'g',
    '\uA7A1': 'g',
    '\u1D79': 'g',
    '\uA77F': 'g',
    '\u24D7': 'h',
    '\uFF48': 'h',
    '\u0125': 'h',
    '\u1E23': 'h',
    '\u1E27': 'h',
    '\u021F': 'h',
    '\u1E25': 'h',
    '\u1E29': 'h',
    '\u1E2B': 'h',
    '\u1E96': 'h',
    '\u0127': 'h',
    '\u2C68': 'h',
    '\u2C76': 'h',
    '\u0265': 'h',
    '\u0195': 'hv',
    '\u24D8': 'i',
    '\uFF49': 'i',
    '\u00EC': 'i',
    '\u00ED': 'i',
    '\u00EE': 'i',
    '\u0129': 'i',
    '\u012B': 'i',
    '\u012D': 'i',
    '\u00EF': 'i',
    '\u1E2F': 'i',
    '\u1EC9': 'i',
    '\u01D0': 'i',
    '\u0209': 'i',
    '\u020B': 'i',
    '\u1ECB': 'i',
    '\u012F': 'i',
    '\u1E2D': 'i',
    '\u0268': 'i',
    '\u0131': 'i',
    '\u24D9': 'j',
    '\uFF4A': 'j',
    '\u0135': 'j',
    '\u01F0': 'j',
    '\u0249': 'j',
    '\u24DA': 'k',
    '\uFF4B': 'k',
    '\u1E31': 'k',
    '\u01E9': 'k',
    '\u1E33': 'k',
    '\u0137': 'k',
    '\u1E35': 'k',
    '\u0199': 'k',
    '\u2C6A': 'k',
    '\uA741': 'k',
    '\uA743': 'k',
    '\uA745': 'k',
    '\uA7A3': 'k',
    '\u24DB': 'l',
    '\uFF4C': 'l',
    '\u0140': 'l',
    '\u013A': 'l',
    '\u013E': 'l',
    '\u1E37': 'l',
    '\u1E39': 'l',
    '\u013C': 'l',
    '\u1E3D': 'l',
    '\u1E3B': 'l',
    '\u017F': 'l',
    '\u0142': 'l',
    '\u019A': 'l',
    '\u026B': 'l',
    '\u2C61': 'l',
    '\uA749': 'l',
    '\uA781': 'l',
    '\uA747': 'l',
    '\u01C9': 'lj',
    '\u24DC': 'm',
    '\uFF4D': 'm',
    '\u1E3F': 'm',
    '\u1E41': 'm',
    '\u1E43': 'm',
    '\u0271': 'm',
    '\u026F': 'm',
    '\u24DD': 'n',
    '\uFF4E': 'n',
    '\u01F9': 'n',
    '\u0144': 'n',
    '\u00F1': 'n',
    '\u1E45': 'n',
    '\u0148': 'n',
    '\u1E47': 'n',
    '\u0146': 'n',
    '\u1E4B': 'n',
    '\u1E49': 'n',
    '\u019E': 'n',
    '\u0272': 'n',
    '\u0149': 'n',
    '\uA791': 'n',
    '\uA7A5': 'n',
    '\u01CC': 'nj',
    '\u24DE': 'o',
    '\uFF4F': 'o',
    '\u00F2': 'o',
    '\u00F3': 'o',
    '\u00F4': 'o',
    '\u1ED3': 'o',
    '\u1ED1': 'o',
    '\u1ED7': 'o',
    '\u1ED5': 'o',
    '\u00F5': 'o',
    '\u1E4D': 'o',
    '\u022D': 'o',
    '\u1E4F': 'o',
    '\u014D': 'o',
    '\u1E51': 'o',
    '\u1E53': 'o',
    '\u014F': 'o',
    '\u022F': 'o',
    '\u0231': 'o',
    '\u00F6': 'o',
    '\u022B': 'o',
    '\u1ECF': 'o',
    '\u0151': 'o',
    '\u01D2': 'o',
    '\u020D': 'o',
    '\u020F': 'o',
    '\u01A1': 'o',
    '\u1EDD': 'o',
    '\u1EDB': 'o',
    '\u1EE1': 'o',
    '\u1EDF': 'o',
    '\u1EE3': 'o',
    '\u1ECD': 'o',
    '\u1ED9': 'o',
    '\u01EB': 'o',
    '\u01ED': 'o',
    '\u00F8': 'o',
    '\u01FF': 'o',
    '\u0254': 'o',
    '\uA74B': 'o',
    '\uA74D': 'o',
    '\u0275': 'o',
    '\u0153': 'oe',
    '\u01A3': 'oi',
    '\u0223': 'ou',
    '\uA74F': 'oo',
    '\u24DF': 'p',
    '\uFF50': 'p',
    '\u1E55': 'p',
    '\u1E57': 'p',
    '\u01A5': 'p',
    '\u1D7D': 'p',
    '\uA751': 'p',
    '\uA753': 'p',
    '\uA755': 'p',
    '\u24E0': 'q',
    '\uFF51': 'q',
    '\u024B': 'q',
    '\uA757': 'q',
    '\uA759': 'q',
    '\u24E1': 'r',
    '\uFF52': 'r',
    '\u0155': 'r',
    '\u1E59': 'r',
    '\u0159': 'r',
    '\u0211': 'r',
    '\u0213': 'r',
    '\u1E5B': 'r',
    '\u1E5D': 'r',
    '\u0157': 'r',
    '\u1E5F': 'r',
    '\u024D': 'r',
    '\u027D': 'r',
    '\uA75B': 'r',
    '\uA7A7': 'r',
    '\uA783': 'r',
    '\u24E2': 's',
    '\uFF53': 's',
    '\u00DF': 's',
    '\u015B': 's',
    '\u1E65': 's',
    '\u015D': 's',
    '\u1E61': 's',
    '\u0161': 's',
    '\u1E67': 's',
    '\u1E63': 's',
    '\u1E69': 's',
    '\u0219': 's',
    '\u015F': 's',
    '\u023F': 's',
    '\uA7A9': 's',
    '\uA785': 's',
    '\u1E9B': 's',
    '\u24E3': 't',
    '\uFF54': 't',
    '\u1E6B': 't',
    '\u1E97': 't',
    '\u0165': 't',
    '\u1E6D': 't',
    '\u021B': 't',
    '\u0163': 't',
    '\u1E71': 't',
    '\u1E6F': 't',
    '\u0167': 't',
    '\u01AD': 't',
    '\u0288': 't',
    '\u2C66': 't',
    '\uA787': 't',
    '\uA729': 'tz',
    '\u24E4': 'u',
    '\uFF55': 'u',
    '\u00F9': 'u',
    '\u00FA': 'u',
    '\u00FB': 'u',
    '\u0169': 'u',
    '\u1E79': 'u',
    '\u016B': 'u',
    '\u1E7B': 'u',
    '\u016D': 'u',
    '\u00FC': 'u',
    '\u01DC': 'u',
    '\u01D8': 'u',
    '\u01D6': 'u',
    '\u01DA': 'u',
    '\u1EE7': 'u',
    '\u016F': 'u',
    '\u0171': 'u',
    '\u01D4': 'u',
    '\u0215': 'u',
    '\u0217': 'u',
    '\u01B0': 'u',
    '\u1EEB': 'u',
    '\u1EE9': 'u',
    '\u1EEF': 'u',
    '\u1EED': 'u',
    '\u1EF1': 'u',
    '\u1EE5': 'u',
    '\u1E73': 'u',
    '\u0173': 'u',
    '\u1E77': 'u',
    '\u1E75': 'u',
    '\u0289': 'u',
    '\u24E5': 'v',
    '\uFF56': 'v',
    '\u1E7D': 'v',
    '\u1E7F': 'v',
    '\u028B': 'v',
    '\uA75F': 'v',
    '\u028C': 'v',
    '\uA761': 'vy',
    '\u24E6': 'w',
    '\uFF57': 'w',
    '\u1E81': 'w',
    '\u1E83': 'w',
    '\u0175': 'w',
    '\u1E87': 'w',
    '\u1E85': 'w',
    '\u1E98': 'w',
    '\u1E89': 'w',
    '\u2C73': 'w',
    '\u24E7': 'x',
    '\uFF58': 'x',
    '\u1E8B': 'x',
    '\u1E8D': 'x',
    '\u24E8': 'y',
    '\uFF59': 'y',
    '\u1EF3': 'y',
    '\u00FD': 'y',
    '\u0177': 'y',
    '\u1EF9': 'y',
    '\u0233': 'y',
    '\u1E8F': 'y',
    '\u00FF': 'y',
    '\u1EF7': 'y',
    '\u1E99': 'y',
    '\u1EF5': 'y',
    '\u01B4': 'y',
    '\u024F': 'y',
    '\u1EFF': 'y',
    '\u24E9': 'z',
    '\uFF5A': 'z',
    '\u017A': 'z',
    '\u1E91': 'z',
    '\u017C': 'z',
    '\u017E': 'z',
    '\u1E93': 'z',
    '\u1E95': 'z',
    '\u01B6': 'z',
    '\u0225': 'z',
    '\u0240': 'z',
    '\u2C6C': 'z',
    '\uA763': 'z',
    '\u0386': '\u0391',
    '\u0388': '\u0395',
    '\u0389': '\u0397',
    '\u038A': '\u0399',
    '\u03AA': '\u0399',
    '\u038C': '\u039F',
    '\u038E': '\u03A5',
    '\u03AB': '\u03A5',
    '\u038F': '\u03A9',
    '\u03AC': '\u03B1',
    '\u03AD': '\u03B5',
    '\u03AE': '\u03B7',
    '\u03AF': '\u03B9',
    '\u03CA': '\u03B9',
    '\u0390': '\u03B9',
    '\u03CC': '\u03BF',
    '\u03CD': '\u03C5',
    '\u03CB': '\u03C5',
    '\u03B0': '\u03C5',
    '\u03CE': '\u03C9',
    '\u03C2': '\u03C3',
    '\u2019': '\''
  };

  return diacritics;
});

S2.define('select2/data/base',[
  '../utils'
], function (Utils) {
  function BaseAdapter ($element, options) {
    BaseAdapter.__super__.constructor.call(this);
  }

  Utils.Extend(BaseAdapter, Utils.Observable);

  BaseAdapter.prototype.current = function (callback) {
    throw new Error('The `current` method must be defined in child classes.');
  };

  BaseAdapter.prototype.query = function (params, callback) {
    throw new Error('The `query` method must be defined in child classes.');
  };

  BaseAdapter.prototype.bind = function (container, $container) {
    // Can be implemented in subclasses
  };

  BaseAdapter.prototype.destroy = function () {
    // Can be implemented in subclasses
  };

  BaseAdapter.prototype.generateResultId = function (container, data) {
    var id = container.id + '-result-';

    id += Utils.generateChars(4);

    if (data.id != null) {
      id += '-' + data.id.toString();
    } else {
      id += '-' + Utils.generateChars(4);
    }
    return id;
  };

  return BaseAdapter;
});

S2.define('select2/data/select',[
  './base',
  '../utils',
  'jquery'
], function (BaseAdapter, Utils, $) {
  function SelectAdapter ($element, options) {
    this.$element = $element;
    this.options = options;

    SelectAdapter.__super__.constructor.call(this);
  }

  Utils.Extend(SelectAdapter, BaseAdapter);

  SelectAdapter.prototype.current = function (callback) {
    var data = [];
    var self = this;

    this.$element.find(':selected').each(function () {
      var $option = $(this);

      var option = self.item($option);

      data.push(option);
    });

    callback(data);
  };

  SelectAdapter.prototype.select = function (data) {
    var self = this;

    data.selected = true;

    // If data.element is a DOM node, use it instead
    if ($(data.element).is('option')) {
      data.element.selected = true;

      this.$element.trigger('change');

      return;
    }

    if (this.$element.prop('multiple')) {
      this.current(function (currentData) {
        var val = [];

        data = [data];
        data.push.apply(data, currentData);

        for (var d = 0; d < data.length; d++) {
          var id = data[d].id;

          if ($.inArray(id, val) === -1) {
            val.push(id);
          }
        }

        self.$element.val(val);
        self.$element.trigger('change');
      });
    } else {
      var val = data.id;

      this.$element.val(val);
      this.$element.trigger('change');
    }
  };

  SelectAdapter.prototype.unselect = function (data) {
    var self = this;

    if (!this.$element.prop('multiple')) {
      return;
    }

    data.selected = false;

    if ($(data.element).is('option')) {
      data.element.selected = false;

      this.$element.trigger('change');

      return;
    }

    this.current(function (currentData) {
      var val = [];

      for (var d = 0; d < currentData.length; d++) {
        var id = currentData[d].id;

        if (id !== data.id && $.inArray(id, val) === -1) {
          val.push(id);
        }
      }

      self.$element.val(val);

      self.$element.trigger('change');
    });
  };

  SelectAdapter.prototype.bind = function (container, $container) {
    var self = this;

    this.container = container;

    container.on('select', function (params) {
      self.select(params.data);
    });

    container.on('unselect', function (params) {
      self.unselect(params.data);
    });
  };

  SelectAdapter.prototype.destroy = function () {
    // Remove anything added to child elements
    this.$element.find('*').each(function () {
      // Remove any custom data set by Select2
      Utils.RemoveData(this);
    });
  };

  SelectAdapter.prototype.query = function (params, callback) {
    var data = [];
    var self = this;

    var $options = this.$element.children();

    $options.each(function () {
      var $option = $(this);

      if (!$option.is('option') && !$option.is('optgroup')) {
        return;
      }

      var option = self.item($option);

      var matches = self.matches(params, option);

      if (matches !== null) {
        data.push(matches);
      }
    });

    callback({
      results: data
    });
  };

  SelectAdapter.prototype.addOptions = function ($options) {
    Utils.appendMany(this.$element, $options);
  };

  SelectAdapter.prototype.option = function (data) {
    var option;

    if (data.children) {
      option = document.createElement('optgroup');
      option.label = data.text;
    } else {
      option = document.createElement('option');

      if (option.textContent !== undefined) {
        option.textContent = data.text;
      } else {
        option.innerText = data.text;
      }
    }

    if (data.id !== undefined) {
      option.value = data.id;
    }

    if (data.disabled) {
      option.disabled = true;
    }

    if (data.selected) {
      option.selected = true;
    }

    if (data.title) {
      option.title = data.title;
    }

    var $option = $(option);

    var normalizedData = this._normalizeItem(data);
    normalizedData.element = option;

    // Override the option's data with the combined data
    Utils.StoreData(option, 'data', normalizedData);

    return $option;
  };

  SelectAdapter.prototype.item = function ($option) {
    var data = {};

    data = Utils.GetData($option[0], 'data');

    if (data != null) {
      return data;
    }

    if ($option.is('option')) {
      data = {
        id: $option.val(),
        text: $option.text(),
        disabled: $option.prop('disabled'),
        selected: $option.prop('selected'),
        title: $option.prop('title')
      };
    } else if ($option.is('optgroup')) {
      data = {
        text: $option.prop('label'),
        children: [],
        title: $option.prop('title')
      };

      var $children = $option.children('option');
      var children = [];

      for (var c = 0; c < $children.length; c++) {
        var $child = $($children[c]);

        var child = this.item($child);

        children.push(child);
      }

      data.children = children;
    }

    data = this._normalizeItem(data);
    data.element = $option[0];

    Utils.StoreData($option[0], 'data', data);

    return data;
  };

  SelectAdapter.prototype._normalizeItem = function (item) {
    if (item !== Object(item)) {
      item = {
        id: item,
        text: item
      };
    }

    item = $.extend({}, {
      text: ''
    }, item);

    var defaults = {
      selected: false,
      disabled: false
    };

    if (item.id != null) {
      item.id = item.id.toString();
    }

    if (item.text != null) {
      item.text = item.text.toString();
    }

    if (item._resultId == null && item.id && this.container != null) {
      item._resultId = this.generateResultId(this.container, item);
    }

    return $.extend({}, defaults, item);
  };

  SelectAdapter.prototype.matches = function (params, data) {
    var matcher = this.options.get('matcher');

    return matcher(params, data);
  };

  return SelectAdapter;
});

S2.define('select2/data/array',[
  './select',
  '../utils',
  'jquery'
], function (SelectAdapter, Utils, $) {
  function ArrayAdapter ($element, options) {
    this._dataToConvert = options.get('data') || [];

    ArrayAdapter.__super__.constructor.call(this, $element, options);
  }

  Utils.Extend(ArrayAdapter, SelectAdapter);

  ArrayAdapter.prototype.bind = function (container, $container) {
    ArrayAdapter.__super__.bind.call(this, container, $container);

    this.addOptions(this.convertToOptions(this._dataToConvert));
  };

  ArrayAdapter.prototype.select = function (data) {
    var $option = this.$element.find('option').filter(function (i, elm) {
      return elm.value == data.id.toString();
    });

    if ($option.length === 0) {
      $option = this.option(data);

      this.addOptions($option);
    }

    ArrayAdapter.__super__.select.call(this, data);
  };

  ArrayAdapter.prototype.convertToOptions = function (data) {
    var self = this;

    var $existing = this.$element.find('option');
    var existingIds = $existing.map(function () {
      return self.item($(this)).id;
    }).get();

    var $options = [];

    // Filter out all items except for the one passed in the argument
    function onlyItem (item) {
      return function () {
        return $(this).val() == item.id;
      };
    }

    for (var d = 0; d < data.length; d++) {
      var item = this._normalizeItem(data[d]);

      // Skip items which were pre-loaded, only merge the data
      if ($.inArray(item.id, existingIds) >= 0) {
        var $existingOption = $existing.filter(onlyItem(item));

        var existingData = this.item($existingOption);
        var newData = $.extend(true, {}, item, existingData);

        var $newOption = this.option(newData);

        $existingOption.replaceWith($newOption);

        continue;
      }

      var $option = this.option(item);

      if (item.children) {
        var $children = this.convertToOptions(item.children);

        Utils.appendMany($option, $children);
      }

      $options.push($option);
    }

    return $options;
  };

  return ArrayAdapter;
});

S2.define('select2/data/ajax',[
  './array',
  '../utils',
  'jquery'
], function (ArrayAdapter, Utils, $) {
  function AjaxAdapter ($element, options) {
    this.ajaxOptions = this._applyDefaults(options.get('ajax'));

    if (this.ajaxOptions.processResults != null) {
      this.processResults = this.ajaxOptions.processResults;
    }

    AjaxAdapter.__super__.constructor.call(this, $element, options);
  }

  Utils.Extend(AjaxAdapter, ArrayAdapter);

  AjaxAdapter.prototype._applyDefaults = function (options) {
    var defaults = {
      data: function (params) {
        return $.extend({}, params, {
          q: params.term
        });
      },
      transport: function (params, success, failure) {
        var $request = $.ajax(params);

        $request.then(success);
        $request.fail(failure);

        return $request;
      }
    };

    return $.extend({}, defaults, options, true);
  };

  AjaxAdapter.prototype.processResults = function (results) {
    return results;
  };

  AjaxAdapter.prototype.query = function (params, callback) {
    var matches = [];
    var self = this;

    if (this._request != null) {
      // JSONP requests cannot always be aborted
      if ($.isFunction(this._request.abort)) {
        this._request.abort();
      }

      this._request = null;
    }

    var options = $.extend({
      type: 'GET'
    }, this.ajaxOptions);

    if (typeof options.url === 'function') {
      options.url = options.url.call(this.$element, params);
    }

    if (typeof options.data === 'function') {
      options.data = options.data.call(this.$element, params);
    }

    function request () {
      var $request = options.transport(options, function (data) {
        var results = self.processResults(data, params);

        if (self.options.get('debug') && window.console && console.error) {
          // Check to make sure that the response included a `results` key.
          if (!results || !results.results || !$.isArray(results.results)) {
            console.error(
              'Select2: The AJAX results did not return an array in the ' +
              '`results` key of the response.'
            );
          }
        }

        callback(results);
      }, function () {
        // Attempt to detect if a request was aborted
        // Only works if the transport exposes a status property
        if ('status' in $request &&
            ($request.status === 0 || $request.status === '0')) {
          return;
        }

        self.trigger('results:message', {
          message: 'errorLoading'
        });
      });

      self._request = $request;
    }

    if (this.ajaxOptions.delay && params.term != null) {
      if (this._queryTimeout) {
        window.clearTimeout(this._queryTimeout);
      }

      this._queryTimeout = window.setTimeout(request, this.ajaxOptions.delay);
    } else {
      request();
    }
  };

  return AjaxAdapter;
});

S2.define('select2/data/tags',[
  'jquery'
], function ($) {
  function Tags (decorated, $element, options) {
    var tags = options.get('tags');

    var createTag = options.get('createTag');

    if (createTag !== undefined) {
      this.createTag = createTag;
    }

    var insertTag = options.get('insertTag');

    if (insertTag !== undefined) {
        this.insertTag = insertTag;
    }

    decorated.call(this, $element, options);

    if ($.isArray(tags)) {
      for (var t = 0; t < tags.length; t++) {
        var tag = tags[t];
        var item = this._normalizeItem(tag);

        var $option = this.option(item);

        this.$element.append($option);
      }
    }
  }

  Tags.prototype.query = function (decorated, params, callback) {
    var self = this;

    this._removeOldTags();

    if (params.term == null || params.page != null) {
      decorated.call(this, params, callback);
      return;
    }

    function wrapper (obj, child) {
      var data = obj.results;

      for (var i = 0; i < data.length; i++) {
        var option = data[i];

        var checkChildren = (
          option.children != null &&
          !wrapper({
            results: option.children
          }, true)
        );

        var optionText = (option.text || '').toUpperCase();
        var paramsTerm = (params.term || '').toUpperCase();

        var checkText = optionText === paramsTerm;

        if (checkText || checkChildren) {
          if (child) {
            return false;
          }

          obj.data = data;
          callback(obj);

          return;
        }
      }

      if (child) {
        return true;
      }

      var tag = self.createTag(params);

      if (tag != null) {
        var $option = self.option(tag);
        $option.attr('data-select2-tag', true);

        self.addOptions([$option]);

        self.insertTag(data, tag);
      }

      obj.results = data;

      callback(obj);
    }

    decorated.call(this, params, wrapper);
  };

  Tags.prototype.createTag = function (decorated, params) {
    var term = $.trim(params.term);

    if (term === '') {
      return null;
    }

    return {
      id: term,
      text: term
    };
  };

  Tags.prototype.insertTag = function (_, data, tag) {
    data.unshift(tag);
  };

  Tags.prototype._removeOldTags = function (_) {
    var $options = this.$element.find('option[data-select2-tag]');

    $options.each(function () {
      if (this.selected) {
        return;
      }

      $(this).remove();
    });
  };

  return Tags;
});

S2.define('select2/data/tokenizer',[
  'jquery'
], function ($) {
  function Tokenizer (decorated, $element, options) {
    var tokenizer = options.get('tokenizer');

    if (tokenizer !== undefined) {
      this.tokenizer = tokenizer;
    }

    decorated.call(this, $element, options);
  }

  Tokenizer.prototype.bind = function (decorated, container, $container) {
    decorated.call(this, container, $container);

    this.$search =  container.dropdown.$search || container.selection.$search ||
      $container.find('.select2-search__field');
  };

  Tokenizer.prototype.query = function (decorated, params, callback) {
    var self = this;

    function createAndSelect (data) {
      // Normalize the data object so we can use it for checks
      var item = self._normalizeItem(data);

      // Check if the data object already exists as a tag
      // Select it if it doesn't
      var $existingOptions = self.$element.find('option').filter(function () {
        return $(this).val() === item.id;
      });

      // If an existing option wasn't found for it, create the option
      if (!$existingOptions.length) {
        var $option = self.option(item);
        $option.attr('data-select2-tag', true);

        self._removeOldTags();
        self.addOptions([$option]);
      }

      // Select the item, now that we know there is an option for it
      select(item);
    }

    function select (data) {
      self.trigger('select', {
        data: data
      });
    }

    params.term = params.term || '';

    var tokenData = this.tokenizer(params, this.options, createAndSelect);

    if (tokenData.term !== params.term) {
      // Replace the search term if we have the search box
      if (this.$search.length) {
        this.$search.val(tokenData.term);
        this.$search.trigger('focus');
      }

      params.term = tokenData.term;
    }

    decorated.call(this, params, callback);
  };

  Tokenizer.prototype.tokenizer = function (_, params, options, callback) {
    var separators = options.get('tokenSeparators') || [];
    var term = params.term;
    var i = 0;

    var createTag = this.createTag || function (params) {
      return {
        id: params.term,
        text: params.term
      };
    };

    while (i < term.length) {
      var termChar = term[i];

      if ($.inArray(termChar, separators) === -1) {
        i++;

        continue;
      }

      var part = term.substr(0, i);
      var partParams = $.extend({}, params, {
        term: part
      });

      var data = createTag(partParams);

      if (data == null) {
        i++;
        continue;
      }

      callback(data);

      // Reset the term to not include the tokenized portion
      term = term.substr(i + 1) || '';
      i = 0;
    }

    return {
      term: term
    };
  };

  return Tokenizer;
});

S2.define('select2/data/minimumInputLength',[

], function () {
  function MinimumInputLength (decorated, $e, options) {
    this.minimumInputLength = options.get('minimumInputLength');

    decorated.call(this, $e, options);
  }

  MinimumInputLength.prototype.query = function (decorated, params, callback) {
    params.term = params.term || '';

    if (params.term.length < this.minimumInputLength) {
      this.trigger('results:message', {
        message: 'inputTooShort',
        args: {
          minimum: this.minimumInputLength,
          input: params.term,
          params: params
        }
      });

      return;
    }

    decorated.call(this, params, callback);
  };

  return MinimumInputLength;
});

S2.define('select2/data/maximumInputLength',[

], function () {
  function MaximumInputLength (decorated, $e, options) {
    this.maximumInputLength = options.get('maximumInputLength');

    decorated.call(this, $e, options);
  }

  MaximumInputLength.prototype.query = function (decorated, params, callback) {
    params.term = params.term || '';

    if (this.maximumInputLength > 0 &&
        params.term.length > this.maximumInputLength) {
      this.trigger('results:message', {
        message: 'inputTooLong',
        args: {
          maximum: this.maximumInputLength,
          input: params.term,
          params: params
        }
      });

      return;
    }

    decorated.call(this, params, callback);
  };

  return MaximumInputLength;
});

S2.define('select2/data/maximumSelectionLength',[

], function (){
  function MaximumSelectionLength (decorated, $e, options) {
    this.maximumSelectionLength = options.get('maximumSelectionLength');

    decorated.call(this, $e, options);
  }

  MaximumSelectionLength.prototype.bind =
    function (decorated, container, $container) {
      var self = this;

      decorated.call(this, container, $container);

      container.on('select', function () {
        self._checkIfMaximumSelected();
      });
  };

  MaximumSelectionLength.prototype.query =
    function (decorated, params, callback) {
      var self = this;

      this._checkIfMaximumSelected(function () {
        decorated.call(self, params, callback);
      });
  };

  MaximumSelectionLength.prototype._checkIfMaximumSelected =
    function (_, successCallback) {
      var self = this;

      this.current(function (currentData) {
        var count = currentData != null ? currentData.length : 0;
        if (self.maximumSelectionLength > 0 &&
          count >= self.maximumSelectionLength) {
          self.trigger('results:message', {
            message: 'maximumSelected',
            args: {
              maximum: self.maximumSelectionLength
            }
          });
          return;
        }

        if (successCallback) {
          successCallback();
        }
      });
  };

  return MaximumSelectionLength;
});

S2.define('select2/dropdown',[
  'jquery',
  './utils'
], function ($, Utils) {
  function Dropdown ($element, options) {
    this.$element = $element;
    this.options = options;

    Dropdown.__super__.constructor.call(this);
  }

  Utils.Extend(Dropdown, Utils.Observable);

  Dropdown.prototype.render = function () {
    var $dropdown = $(
      '<span class="select2-dropdown">' +
        '<span class="select2-results"></span>' +
      '</span>'
    );

    $dropdown.attr('dir', this.options.get('dir'));

    this.$dropdown = $dropdown;

    return $dropdown;
  };

  Dropdown.prototype.bind = function () {
    // Should be implemented in subclasses
  };

  Dropdown.prototype.position = function ($dropdown, $container) {
    // Should be implemented in subclasses
  };

  Dropdown.prototype.destroy = function () {
    // Remove the dropdown from the DOM
    this.$dropdown.remove();
  };

  return Dropdown;
});

S2.define('select2/dropdown/search',[
  'jquery',
  '../utils'
], function ($, Utils) {
  function Search () { }

  Search.prototype.render = function (decorated) {
    var $rendered = decorated.call(this);

    var $search = $(
      '<span class="select2-search select2-search--dropdown">' +
        '<input class="select2-search__field" type="search" tabindex="-1"' +
        ' autocomplete="off" autocorrect="off" autocapitalize="none"' +
        ' spellcheck="false" role="searchbox" aria-autocomplete="list" />' +
      '</span>'
    );

    this.$searchContainer = $search;
    this.$search = $search.find('input');

    $rendered.prepend($search);

    return $rendered;
  };

  Search.prototype.bind = function (decorated, container, $container) {
    var self = this;

    var resultsId = container.id + '-results';

    decorated.call(this, container, $container);

    this.$search.on('keydown', function (evt) {
      self.trigger('keypress', evt);

      self._keyUpPrevented = evt.isDefaultPrevented();
    });

    // Workaround for browsers which do not support the `input` event
    // This will prevent double-triggering of events for browsers which support
    // both the `keyup` and `input` events.
    this.$search.on('input', function (evt) {
      // Unbind the duplicated `keyup` event
      $(this).off('keyup');
    });

    this.$search.on('keyup input', function (evt) {
      self.handleSearch(evt);
    });

    container.on('open', function () {
      self.$search.attr('tabindex', 0);
      self.$search.attr('aria-controls', resultsId);

      self.$search.trigger('focus');

      window.setTimeout(function () {
        self.$search.trigger('focus');
      }, 0);
    });

    container.on('close', function () {
      self.$search.attr('tabindex', -1);
      self.$search.removeAttr('aria-controls');
      self.$search.removeAttr('aria-activedescendant');

      self.$search.val('');
      self.$search.trigger('blur');
    });

    container.on('focus', function () {
      if (!container.isOpen()) {
        self.$search.trigger('focus');
      }
    });

    container.on('results:all', function (params) {
      if (params.query.term == null || params.query.term === '') {
        var showSearch = self.showSearch(params);

        if (showSearch) {
          self.$searchContainer.removeClass('select2-search--hide');
        } else {
          self.$searchContainer.addClass('select2-search--hide');
        }
      }
    });

    container.on('results:focus', function (params) {
      if (params.data._resultId) {
        self.$search.attr('aria-activedescendant', params.data._resultId);
      } else {
        self.$search.removeAttr('aria-activedescendant');
      }
    });
  };

  Search.prototype.handleSearch = function (evt) {
    if (!this._keyUpPrevented) {
      var input = this.$search.val();

      this.trigger('query', {
        term: input
      });
    }

    this._keyUpPrevented = false;
  };

  Search.prototype.showSearch = function (_, params) {
    return true;
  };

  return Search;
});

S2.define('select2/dropdown/hidePlaceholder',[

], function () {
  function HidePlaceholder (decorated, $element, options, dataAdapter) {
    this.placeholder = this.normalizePlaceholder(options.get('placeholder'));

    decorated.call(this, $element, options, dataAdapter);
  }

  HidePlaceholder.prototype.append = function (decorated, data) {
    data.results = this.removePlaceholder(data.results);

    decorated.call(this, data);
  };

  HidePlaceholder.prototype.normalizePlaceholder = function (_, placeholder) {
    if (typeof placeholder === 'string') {
      placeholder = {
        id: '',
        text: placeholder
      };
    }

    return placeholder;
  };

  HidePlaceholder.prototype.removePlaceholder = function (_, data) {
    var modifiedData = data.slice(0);

    for (var d = data.length - 1; d >= 0; d--) {
      var item = data[d];

      if (this.placeholder.id === item.id) {
        modifiedData.splice(d, 1);
      }
    }

    return modifiedData;
  };

  return HidePlaceholder;
});

S2.define('select2/dropdown/infiniteScroll',[
  'jquery'
], function ($) {
  function InfiniteScroll (decorated, $element, options, dataAdapter) {
    this.lastParams = {};

    decorated.call(this, $element, options, dataAdapter);

    this.$loadingMore = this.createLoadingMore();
    this.loading = false;
  }

  InfiniteScroll.prototype.append = function (decorated, data) {
    this.$loadingMore.remove();
    this.loading = false;

    decorated.call(this, data);

    if (this.showLoadingMore(data)) {
      this.$results.append(this.$loadingMore);
      this.loadMoreIfNeeded();
    }
  };

  InfiniteScroll.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('query', function (params) {
      self.lastParams = params;
      self.loading = true;
    });

    container.on('query:append', function (params) {
      self.lastParams = params;
      self.loading = true;
    });

    this.$results.on('scroll', this.loadMoreIfNeeded.bind(this));
  };

  InfiniteScroll.prototype.loadMoreIfNeeded = function () {
    var isLoadMoreVisible = $.contains(
      document.documentElement,
      this.$loadingMore[0]
    );

    if (this.loading || !isLoadMoreVisible) {
      return;
    }

    var currentOffset = this.$results.offset().top +
      this.$results.outerHeight(false);
    var loadingMoreOffset = this.$loadingMore.offset().top +
      this.$loadingMore.outerHeight(false);

    if (currentOffset + 50 >= loadingMoreOffset) {
      this.loadMore();
    }
  };

  InfiniteScroll.prototype.loadMore = function () {
    this.loading = true;

    var params = $.extend({}, {page: 1}, this.lastParams);

    params.page++;

    this.trigger('query:append', params);
  };

  InfiniteScroll.prototype.showLoadingMore = function (_, data) {
    return data.pagination && data.pagination.more;
  };

  InfiniteScroll.prototype.createLoadingMore = function () {
    var $option = $(
      '<li ' +
      'class="select2-results__option select2-results__option--load-more"' +
      'role="option" aria-disabled="true"></li>'
    );

    var message = this.options.get('translations').get('loadingMore');

    $option.html(message(this.lastParams));

    return $option;
  };

  return InfiniteScroll;
});

S2.define('select2/dropdown/attachBody',[
  'jquery',
  '../utils'
], function ($, Utils) {
  function AttachBody (decorated, $element, options) {
    this.$dropdownParent = $(options.get('dropdownParent') || document.body);

    decorated.call(this, $element, options);
  }

  AttachBody.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('open', function () {
      self._showDropdown();
      self._attachPositioningHandler(container);

      // Must bind after the results handlers to ensure correct sizing
      self._bindContainerResultHandlers(container);
    });

    container.on('close', function () {
      self._hideDropdown();
      self._detachPositioningHandler(container);
    });

    this.$dropdownContainer.on('mousedown', function (evt) {
      evt.stopPropagation();
    });
  };

  AttachBody.prototype.destroy = function (decorated) {
    decorated.call(this);

    this.$dropdownContainer.remove();
  };

  AttachBody.prototype.position = function (decorated, $dropdown, $container) {
    // Clone all of the container classes
    $dropdown.attr('class', $container.attr('class'));

    $dropdown.removeClass('select2');
    $dropdown.addClass('select2-container--open');

    $dropdown.css({
      position: 'absolute',
      top: -999999
    });

    this.$container = $container;
  };

  AttachBody.prototype.render = function (decorated) {
    var $container = $('<span></span>');

    var $dropdown = decorated.call(this);
    $container.append($dropdown);

    this.$dropdownContainer = $container;

    return $container;
  };

  AttachBody.prototype._hideDropdown = function (decorated) {
    this.$dropdownContainer.detach();
  };

  AttachBody.prototype._bindContainerResultHandlers =
      function (decorated, container) {

    // These should only be bound once
    if (this._containerResultsHandlersBound) {
      return;
    }

    var self = this;

    container.on('results:all', function () {
      self._positionDropdown();
      self._resizeDropdown();
    });

    container.on('results:append', function () {
      self._positionDropdown();
      self._resizeDropdown();
    });

    container.on('results:message', function () {
      self._positionDropdown();
      self._resizeDropdown();
    });

    container.on('select', function () {
      self._positionDropdown();
      self._resizeDropdown();
    });

    container.on('unselect', function () {
      self._positionDropdown();
      self._resizeDropdown();
    });

    this._containerResultsHandlersBound = true;
  };

  AttachBody.prototype._attachPositioningHandler =
      function (decorated, container) {
    var self = this;

    var scrollEvent = 'scroll.select2.' + container.id;
    var resizeEvent = 'resize.select2.' + container.id;
    var orientationEvent = 'orientationchange.select2.' + container.id;

    var $watchers = this.$container.parents().filter(Utils.hasScroll);
    $watchers.each(function () {
      Utils.StoreData(this, 'select2-scroll-position', {
        x: $(this).scrollLeft(),
        y: $(this).scrollTop()
      });
    });

    $watchers.on(scrollEvent, function (ev) {
      var position = Utils.GetData(this, 'select2-scroll-position');
      $(this).scrollTop(position.y);
    });

    $(window).on(scrollEvent + ' ' + resizeEvent + ' ' + orientationEvent,
      function (e) {
      self._positionDropdown();
      self._resizeDropdown();
    });
  };

  AttachBody.prototype._detachPositioningHandler =
      function (decorated, container) {
    var scrollEvent = 'scroll.select2.' + container.id;
    var resizeEvent = 'resize.select2.' + container.id;
    var orientationEvent = 'orientationchange.select2.' + container.id;

    var $watchers = this.$container.parents().filter(Utils.hasScroll);
    $watchers.off(scrollEvent);

    $(window).off(scrollEvent + ' ' + resizeEvent + ' ' + orientationEvent);
  };

  AttachBody.prototype._positionDropdown = function () {
    var $window = $(window);

    var isCurrentlyAbove = this.$dropdown.hasClass('select2-dropdown--above');
    var isCurrentlyBelow = this.$dropdown.hasClass('select2-dropdown--below');

    var newDirection = null;

    var offset = this.$container.offset();

    offset.bottom = offset.top + this.$container.outerHeight(false);

    var container = {
      height: this.$container.outerHeight(false)
    };

    container.top = offset.top;
    container.bottom = offset.top + container.height;

    var dropdown = {
      height: this.$dropdown.outerHeight(false)
    };

    var viewport = {
      top: $window.scrollTop(),
      bottom: $window.scrollTop() + $window.height()
    };

    var enoughRoomAbove = viewport.top < (offset.top - dropdown.height);
    var enoughRoomBelow = viewport.bottom > (offset.bottom + dropdown.height);

    var css = {
      left: offset.left,
      top: container.bottom
    };

    // Determine what the parent element is to use for calculating the offset
    var $offsetParent = this.$dropdownParent;

    // For statically positioned elements, we need to get the element
    // that is determining the offset
    if ($offsetParent.css('position') === 'static') {
      $offsetParent = $offsetParent.offsetParent();
    }

    var parentOffset = {
      top: 0,
      left: 0
    };

    if ($.contains(document.body, $offsetParent[0])) {
      parentOffset = $offsetParent.offset();
    }

    css.top -= parentOffset.top;
    css.left -= parentOffset.left;

    if (!isCurrentlyAbove && !isCurrentlyBelow) {
      newDirection = 'below';
    }

    if (!enoughRoomBelow && enoughRoomAbove && !isCurrentlyAbove) {
      newDirection = 'above';
    } else if (!enoughRoomAbove && enoughRoomBelow && isCurrentlyAbove) {
      newDirection = 'below';
    }

    if (newDirection == 'above' ||
      (isCurrentlyAbove && newDirection !== 'below')) {
      css.top = container.top - parentOffset.top - dropdown.height;
    }

    if (newDirection != null) {
      this.$dropdown
        .removeClass('select2-dropdown--below select2-dropdown--above')
        .addClass('select2-dropdown--' + newDirection);
      this.$container
        .removeClass('select2-container--below select2-container--above')
        .addClass('select2-container--' + newDirection);
    }

    this.$dropdownContainer.css(css);
  };

  AttachBody.prototype._resizeDropdown = function () {
    var css = {
      width: this.$container.outerWidth(false) + 'px'
    };

    if (this.options.get('dropdownAutoWidth')) {
      css.minWidth = css.width;
      css.position = 'relative';
      css.width = 'auto';
    }

    this.$dropdown.css(css);
  };

  AttachBody.prototype._showDropdown = function (decorated) {
    this.$dropdownContainer.appendTo(this.$dropdownParent);

    this._positionDropdown();
    this._resizeDropdown();
  };

  return AttachBody;
});

S2.define('select2/dropdown/minimumResultsForSearch',[

], function () {
  function countResults (data) {
    var count = 0;

    for (var d = 0; d < data.length; d++) {
      var item = data[d];

      if (item.children) {
        count += countResults(item.children);
      } else {
        count++;
      }
    }

    return count;
  }

  function MinimumResultsForSearch (decorated, $element, options, dataAdapter) {
    this.minimumResultsForSearch = options.get('minimumResultsForSearch');

    if (this.minimumResultsForSearch < 0) {
      this.minimumResultsForSearch = Infinity;
    }

    decorated.call(this, $element, options, dataAdapter);
  }

  MinimumResultsForSearch.prototype.showSearch = function (decorated, params) {
    if (countResults(params.data.results) < this.minimumResultsForSearch) {
      return false;
    }

    return decorated.call(this, params);
  };

  return MinimumResultsForSearch;
});

S2.define('select2/dropdown/selectOnClose',[
  '../utils'
], function (Utils) {
  function SelectOnClose () { }

  SelectOnClose.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('close', function (params) {
      self._handleSelectOnClose(params);
    });
  };

  SelectOnClose.prototype._handleSelectOnClose = function (_, params) {
    if (params && params.originalSelect2Event != null) {
      var event = params.originalSelect2Event;

      // Don't select an item if the close event was triggered from a select or
      // unselect event
      if (event._type === 'select' || event._type === 'unselect') {
        return;
      }
    }

    var $highlightedResults = this.getHighlightedResults();

    // Only select highlighted results
    if ($highlightedResults.length < 1) {
      return;
    }

    var data = Utils.GetData($highlightedResults[0], 'data');

    // Don't re-select already selected resulte
    if (
      (data.element != null && data.element.selected) ||
      (data.element == null && data.selected)
    ) {
      return;
    }

    this.trigger('select', {
        data: data
    });
  };

  return SelectOnClose;
});

S2.define('select2/dropdown/closeOnSelect',[

], function () {
  function CloseOnSelect () { }

  CloseOnSelect.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('select', function (evt) {
      self._selectTriggered(evt);
    });

    container.on('unselect', function (evt) {
      self._selectTriggered(evt);
    });
  };

  CloseOnSelect.prototype._selectTriggered = function (_, evt) {
    var originalEvent = evt.originalEvent;

    // Don't close if the control key is being held
    if (originalEvent && (originalEvent.ctrlKey || originalEvent.metaKey)) {
      return;
    }

    this.trigger('close', {
      originalEvent: originalEvent,
      originalSelect2Event: evt
    });
  };

  return CloseOnSelect;
});

S2.define('select2/i18n/en',[],function () {
  // English
  return {
    errorLoading: function () {
      return 'The results could not be loaded.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Please delete ' + overChars + ' character';

      if (overChars != 1) {
        message += 's';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Please enter ' + remainingChars + ' or more characters';

      return message;
    },
    loadingMore: function () {
      return 'Loading more results…';
    },
    maximumSelected: function (args) {
      var message = 'You can only select ' + args.maximum + ' item';

      if (args.maximum != 1) {
        message += 's';
      }

      return message;
    },
    noResults: function () {
      return 'No results found';
    },
    searching: function () {
      return 'Searching…';
    },
    removeAllItems: function () {
      return 'Remove all items';
    }
  };
});

S2.define('select2/defaults',[
  'jquery',
  'require',

  './results',

  './selection/single',
  './selection/multiple',
  './selection/placeholder',
  './selection/allowClear',
  './selection/search',
  './selection/eventRelay',

  './utils',
  './translation',
  './diacritics',

  './data/select',
  './data/array',
  './data/ajax',
  './data/tags',
  './data/tokenizer',
  './data/minimumInputLength',
  './data/maximumInputLength',
  './data/maximumSelectionLength',

  './dropdown',
  './dropdown/search',
  './dropdown/hidePlaceholder',
  './dropdown/infiniteScroll',
  './dropdown/attachBody',
  './dropdown/minimumResultsForSearch',
  './dropdown/selectOnClose',
  './dropdown/closeOnSelect',

  './i18n/en'
], function ($, require,

             ResultsList,

             SingleSelection, MultipleSelection, Placeholder, AllowClear,
             SelectionSearch, EventRelay,

             Utils, Translation, DIACRITICS,

             SelectData, ArrayData, AjaxData, Tags, Tokenizer,
             MinimumInputLength, MaximumInputLength, MaximumSelectionLength,

             Dropdown, DropdownSearch, HidePlaceholder, InfiniteScroll,
             AttachBody, MinimumResultsForSearch, SelectOnClose, CloseOnSelect,

             EnglishTranslation) {
  function Defaults () {
    this.reset();
  }

  Defaults.prototype.apply = function (options) {
    options = $.extend(true, {}, this.defaults, options);

    if (options.dataAdapter == null) {
      if (options.ajax != null) {
        options.dataAdapter = AjaxData;
      } else if (options.data != null) {
        options.dataAdapter = ArrayData;
      } else {
        options.dataAdapter = SelectData;
      }

      if (options.minimumInputLength > 0) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          MinimumInputLength
        );
      }

      if (options.maximumInputLength > 0) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          MaximumInputLength
        );
      }

      if (options.maximumSelectionLength > 0) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          MaximumSelectionLength
        );
      }

      if (options.tags) {
        options.dataAdapter = Utils.Decorate(options.dataAdapter, Tags);
      }

      if (options.tokenSeparators != null || options.tokenizer != null) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          Tokenizer
        );
      }

      if (options.query != null) {
        var Query = require(options.amdBase + 'compat/query');

        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          Query
        );
      }

      if (options.initSelection != null) {
        var InitSelection = require(options.amdBase + 'compat/initSelection');

        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          InitSelection
        );
      }
    }

    if (options.resultsAdapter == null) {
      options.resultsAdapter = ResultsList;

      if (options.ajax != null) {
        options.resultsAdapter = Utils.Decorate(
          options.resultsAdapter,
          InfiniteScroll
        );
      }

      if (options.placeholder != null) {
        options.resultsAdapter = Utils.Decorate(
          options.resultsAdapter,
          HidePlaceholder
        );
      }

      if (options.selectOnClose) {
        options.resultsAdapter = Utils.Decorate(
          options.resultsAdapter,
          SelectOnClose
        );
      }
    }

    if (options.dropdownAdapter == null) {
      if (options.multiple) {
        options.dropdownAdapter = Dropdown;
      } else {
        var SearchableDropdown = Utils.Decorate(Dropdown, DropdownSearch);

        options.dropdownAdapter = SearchableDropdown;
      }

      if (options.minimumResultsForSearch !== 0) {
        options.dropdownAdapter = Utils.Decorate(
          options.dropdownAdapter,
          MinimumResultsForSearch
        );
      }

      if (options.closeOnSelect) {
        options.dropdownAdapter = Utils.Decorate(
          options.dropdownAdapter,
          CloseOnSelect
        );
      }

      if (
        options.dropdownCssClass != null ||
        options.dropdownCss != null ||
        options.adaptDropdownCssClass != null
      ) {
        var DropdownCSS = require(options.amdBase + 'compat/dropdownCss');

        options.dropdownAdapter = Utils.Decorate(
          options.dropdownAdapter,
          DropdownCSS
        );
      }

      options.dropdownAdapter = Utils.Decorate(
        options.dropdownAdapter,
        AttachBody
      );
    }

    if (options.selectionAdapter == null) {
      if (options.multiple) {
        options.selectionAdapter = MultipleSelection;
      } else {
        options.selectionAdapter = SingleSelection;
      }

      // Add the placeholder mixin if a placeholder was specified
      if (options.placeholder != null) {
        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          Placeholder
        );
      }

      if (options.allowClear) {
        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          AllowClear
        );
      }

      if (options.multiple) {
        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          SelectionSearch
        );
      }

      if (
        options.containerCssClass != null ||
        options.containerCss != null ||
        options.adaptContainerCssClass != null
      ) {
        var ContainerCSS = require(options.amdBase + 'compat/containerCss');

        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          ContainerCSS
        );
      }

      options.selectionAdapter = Utils.Decorate(
        options.selectionAdapter,
        EventRelay
      );
    }

    // If the defaults were not previously applied from an element, it is
    // possible for the language option to have not been resolved
    options.language = this._resolveLanguage(options.language);

    // Always fall back to English since it will always be complete
    options.language.push('en');

    var uniqueLanguages = [];

    for (var l = 0; l < options.language.length; l++) {
      var language = options.language[l];

      if (uniqueLanguages.indexOf(language) === -1) {
        uniqueLanguages.push(language);
      }
    }

    options.language = uniqueLanguages;

    options.translations = this._processTranslations(
      options.language,
      options.debug
    );

    return options;
  };

  Defaults.prototype.reset = function () {
    function stripDiacritics (text) {
      // Used 'uni range + named function' from http://jsperf.com/diacritics/18
      function match(a) {
        return DIACRITICS[a] || a;
      }

      return text.replace(/[^\u0000-\u007E]/g, match);
    }

    function matcher (params, data) {
      // Always return the object if there is nothing to compare
      if ($.trim(params.term) === '') {
        return data;
      }

      // Do a recursive check for options with children
      if (data.children && data.children.length > 0) {
        // Clone the data object if there are children
        // This is required as we modify the object to remove any non-matches
        var match = $.extend(true, {}, data);

        // Check each child of the option
        for (var c = data.children.length - 1; c >= 0; c--) {
          var child = data.children[c];

          var matches = matcher(params, child);

          // If there wasn't a match, remove the object in the array
          if (matches == null) {
            match.children.splice(c, 1);
          }
        }

        // If any children matched, return the new object
        if (match.children.length > 0) {
          return match;
        }

        // If there were no matching children, check just the plain object
        return matcher(params, match);
      }

      var original = stripDiacritics(data.text).toUpperCase();
      var term = stripDiacritics(params.term).toUpperCase();

      // Check if the text contains the term
      if (original.indexOf(term) > -1) {
        return data;
      }

      // If it doesn't contain the term, don't return anything
      return null;
    }

    this.defaults = {
      amdBase: './',
      amdLanguageBase: './i18n/',
      closeOnSelect: true,
      debug: false,
      dropdownAutoWidth: false,
      escapeMarkup: Utils.escapeMarkup,
      language: {},
      matcher: matcher,
      minimumInputLength: 0,
      maximumInputLength: 0,
      maximumSelectionLength: 0,
      minimumResultsForSearch: 0,
      selectOnClose: false,
      scrollAfterSelect: false,
      sorter: function (data) {
        return data;
      },
      templateResult: function (result) {
        return result.text;
      },
      templateSelection: function (selection) {
        return selection.text;
      },
      theme: 'default',
      width: 'resolve'
    };
  };

  Defaults.prototype.applyFromElement = function (options, $element) {
    var optionLanguage = options.language;
    var defaultLanguage = this.defaults.language;
    var elementLanguage = $element.prop('lang');
    var parentLanguage = $element.closest('[lang]').prop('lang');

    var languages = Array.prototype.concat.call(
      this._resolveLanguage(elementLanguage),
      this._resolveLanguage(optionLanguage),
      this._resolveLanguage(defaultLanguage),
      this._resolveLanguage(parentLanguage)
    );

    options.language = languages;

    return options;
  };

  Defaults.prototype._resolveLanguage = function (language) {
    if (!language) {
      return [];
    }

    if ($.isEmptyObject(language)) {
      return [];
    }

    if ($.isPlainObject(language)) {
      return [language];
    }

    var languages;

    if (!$.isArray(language)) {
      languages = [language];
    } else {
      languages = language;
    }

    var resolvedLanguages = [];

    for (var l = 0; l < languages.length; l++) {
      resolvedLanguages.push(languages[l]);

      if (typeof languages[l] === 'string' && languages[l].indexOf('-') > 0) {
        // Extract the region information if it is included
        var languageParts = languages[l].split('-');
        var baseLanguage = languageParts[0];

        resolvedLanguages.push(baseLanguage);
      }
    }

    return resolvedLanguages;
  };

  Defaults.prototype._processTranslations = function (languages, debug) {
    var translations = new Translation();

    for (var l = 0; l < languages.length; l++) {
      var languageData = new Translation();

      var language = languages[l];

      if (typeof language === 'string') {
        try {
          // Try to load it with the original name
          languageData = Translation.loadPath(language);
        } catch (e) {
          try {
            // If we couldn't load it, check if it wasn't the full path
            language = this.defaults.amdLanguageBase + language;
            languageData = Translation.loadPath(language);
          } catch (ex) {
            // The translation could not be loaded at all. Sometimes this is
            // because of a configuration problem, other times this can be
            // because of how Select2 helps load all possible translation files
            if (debug && window.console && console.warn) {
              console.warn(
                'Select2: The language file for "' + language + '" could ' +
                'not be automatically loaded. A fallback will be used instead.'
              );
            }
          }
        }
      } else if ($.isPlainObject(language)) {
        languageData = new Translation(language);
      } else {
        languageData = language;
      }

      translations.extend(languageData);
    }

    return translations;
  };

  Defaults.prototype.set = function (key, value) {
    var camelKey = $.camelCase(key);

    var data = {};
    data[camelKey] = value;

    var convertedData = Utils._convertData(data);

    $.extend(true, this.defaults, convertedData);
  };

  var defaults = new Defaults();

  return defaults;
});

S2.define('select2/options',[
  'require',
  'jquery',
  './defaults',
  './utils'
], function (require, $, Defaults, Utils) {
  function Options (options, $element) {
    this.options = options;

    if ($element != null) {
      this.fromElement($element);
    }

    if ($element != null) {
      this.options = Defaults.applyFromElement(this.options, $element);
    }

    this.options = Defaults.apply(this.options);

    if ($element && $element.is('input')) {
      var InputCompat = require(this.get('amdBase') + 'compat/inputData');

      this.options.dataAdapter = Utils.Decorate(
        this.options.dataAdapter,
        InputCompat
      );
    }
  }

  Options.prototype.fromElement = function ($e) {
    var excludedData = ['select2'];

    if (this.options.multiple == null) {
      this.options.multiple = $e.prop('multiple');
    }

    if (this.options.disabled == null) {
      this.options.disabled = $e.prop('disabled');
    }

    if (this.options.dir == null) {
      if ($e.prop('dir')) {
        this.options.dir = $e.prop('dir');
      } else if ($e.closest('[dir]').prop('dir')) {
        this.options.dir = $e.closest('[dir]').prop('dir');
      } else {
        this.options.dir = 'ltr';
      }
    }

    $e.prop('disabled', this.options.disabled);
    $e.prop('multiple', this.options.multiple);

    if (Utils.GetData($e[0], 'select2Tags')) {
      if (this.options.debug && window.console && console.warn) {
        console.warn(
          'Select2: The `data-select2-tags` attribute has been changed to ' +
          'use the `data-data` and `data-tags="true"` attributes and will be ' +
          'removed in future versions of Select2.'
        );
      }

      Utils.StoreData($e[0], 'data', Utils.GetData($e[0], 'select2Tags'));
      Utils.StoreData($e[0], 'tags', true);
    }

    if (Utils.GetData($e[0], 'ajaxUrl')) {
      if (this.options.debug && window.console && console.warn) {
        console.warn(
          'Select2: The `data-ajax-url` attribute has been changed to ' +
          '`data-ajax--url` and support for the old attribute will be removed' +
          ' in future versions of Select2.'
        );
      }

      $e.attr('ajax--url', Utils.GetData($e[0], 'ajaxUrl'));
      Utils.StoreData($e[0], 'ajax-Url', Utils.GetData($e[0], 'ajaxUrl'));
    }

    var dataset = {};

    function upperCaseLetter(_, letter) {
      return letter.toUpperCase();
    }

    // Pre-load all of the attributes which are prefixed with `data-`
    for (var attr = 0; attr < $e[0].attributes.length; attr++) {
      var attributeName = $e[0].attributes[attr].name;
      var prefix = 'data-';

      if (attributeName.substr(0, prefix.length) == prefix) {
        // Get the contents of the attribute after `data-`
        var dataName = attributeName.substring(prefix.length);

        // Get the data contents from the consistent source
        // This is more than likely the jQuery data helper
        var dataValue = Utils.GetData($e[0], dataName);

        // camelCase the attribute name to match the spec
        var camelDataName = dataName.replace(/-([a-z])/g, upperCaseLetter);

        // Store the data attribute contents into the dataset since
        dataset[camelDataName] = dataValue;
      }
    }

    // Prefer the element's `dataset` attribute if it exists
    // jQuery 1.x does not correctly handle data attributes with multiple dashes
    if ($.fn.jquery && $.fn.jquery.substr(0, 2) == '1.' && $e[0].dataset) {
      dataset = $.extend(true, {}, $e[0].dataset, dataset);
    }

    // Prefer our internal data cache if it exists
    var data = $.extend(true, {}, Utils.GetData($e[0]), dataset);

    data = Utils._convertData(data);

    for (var key in data) {
      if ($.inArray(key, excludedData) > -1) {
        continue;
      }

      if ($.isPlainObject(this.options[key])) {
        $.extend(this.options[key], data[key]);
      } else {
        this.options[key] = data[key];
      }
    }

    return this;
  };

  Options.prototype.get = function (key) {
    return this.options[key];
  };

  Options.prototype.set = function (key, val) {
    this.options[key] = val;
  };

  return Options;
});

S2.define('select2/core',[
  'jquery',
  './options',
  './utils',
  './keys'
], function ($, Options, Utils, KEYS) {
  var Select2 = function ($element, options) {
    if (Utils.GetData($element[0], 'select2') != null) {
      Utils.GetData($element[0], 'select2').destroy();
    }

    this.$element = $element;

    this.id = this._generateId($element);

    options = options || {};

    this.options = new Options(options, $element);

    Select2.__super__.constructor.call(this);

    // Set up the tabindex

    var tabindex = $element.attr('tabindex') || 0;
    Utils.StoreData($element[0], 'old-tabindex', tabindex);
    $element.attr('tabindex', '-1');

    // Set up containers and adapters

    var DataAdapter = this.options.get('dataAdapter');
    this.dataAdapter = new DataAdapter($element, this.options);

    var $container = this.render();

    this._placeContainer($container);

    var SelectionAdapter = this.options.get('selectionAdapter');
    this.selection = new SelectionAdapter($element, this.options);
    this.$selection = this.selection.render();

    this.selection.position(this.$selection, $container);

    var DropdownAdapter = this.options.get('dropdownAdapter');
    this.dropdown = new DropdownAdapter($element, this.options);
    this.$dropdown = this.dropdown.render();

    this.dropdown.position(this.$dropdown, $container);

    var ResultsAdapter = this.options.get('resultsAdapter');
    this.results = new ResultsAdapter($element, this.options, this.dataAdapter);
    this.$results = this.results.render();

    this.results.position(this.$results, this.$dropdown);

    // Bind events

    var self = this;

    // Bind the container to all of the adapters
    this._bindAdapters();

    // Register any DOM event handlers
    this._registerDomEvents();

    // Register any internal event handlers
    this._registerDataEvents();
    this._registerSelectionEvents();
    this._registerDropdownEvents();
    this._registerResultsEvents();
    this._registerEvents();

    // Set the initial state
    this.dataAdapter.current(function (initialData) {
      self.trigger('selection:update', {
        data: initialData
      });
    });

    // Hide the original select
    $element.addClass('select2-hidden-accessible');
    $element.attr('aria-hidden', 'true');

    // Synchronize any monitored attributes
    this._syncAttributes();

    Utils.StoreData($element[0], 'select2', this);

    // Ensure backwards compatibility with $element.data('select2').
    $element.data('select2', this);
  };

  Utils.Extend(Select2, Utils.Observable);

  Select2.prototype._generateId = function ($element) {
    var id = '';

    if ($element.attr('id') != null) {
      id = $element.attr('id');
    } else if ($element.attr('name') != null) {
      id = $element.attr('name') + '-' + Utils.generateChars(2);
    } else {
      id = Utils.generateChars(4);
    }

    id = id.replace(/(:|\.|\[|\]|,)/g, '');
    id = 'select2-' + id;

    return id;
  };

  Select2.prototype._placeContainer = function ($container) {
    $container.insertAfter(this.$element);

    var width = this._resolveWidth(this.$element, this.options.get('width'));

    if (width != null) {
      $container.css('width', width);
    }
  };

  Select2.prototype._resolveWidth = function ($element, method) {
    var WIDTH = /^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;

    if (method == 'resolve') {
      var styleWidth = this._resolveWidth($element, 'style');

      if (styleWidth != null) {
        return styleWidth;
      }

      return this._resolveWidth($element, 'element');
    }

    if (method == 'element') {
      var elementWidth = $element.outerWidth(false);

      if (elementWidth <= 0) {
        return 'auto';
      }

      return elementWidth + 'px';
    }

    if (method == 'style') {
      var style = $element.attr('style');

      if (typeof(style) !== 'string') {
        return null;
      }

      var attrs = style.split(';');

      for (var i = 0, l = attrs.length; i < l; i = i + 1) {
        var attr = attrs[i].replace(/\s/g, '');
        var matches = attr.match(WIDTH);

        if (matches !== null && matches.length >= 1) {
          return matches[1];
        }
      }

      return null;
    }

    if (method == 'computedstyle') {
      var computedStyle = window.getComputedStyle($element[0]);

      return computedStyle.width;
    }

    return method;
  };

  Select2.prototype._bindAdapters = function () {
    this.dataAdapter.bind(this, this.$container);
    this.selection.bind(this, this.$container);

    this.dropdown.bind(this, this.$container);
    this.results.bind(this, this.$container);
  };

  Select2.prototype._registerDomEvents = function () {
    var self = this;

    this.$element.on('change.select2', function () {
      self.dataAdapter.current(function (data) {
        self.trigger('selection:update', {
          data: data
        });
      });
    });

    this.$element.on('focus.select2', function (evt) {
      self.trigger('focus', evt);
    });

    this._syncA = Utils.bind(this._syncAttributes, this);
    this._syncS = Utils.bind(this._syncSubtree, this);

    if (this.$element[0].attachEvent) {
      this.$element[0].attachEvent('onpropertychange', this._syncA);
    }

    var observer = window.MutationObserver ||
      window.WebKitMutationObserver ||
      window.MozMutationObserver
    ;

    if (observer != null) {
      this._observer = new observer(function (mutations) {
        $.each(mutations, self._syncA);
        $.each(mutations, self._syncS);
      });
      this._observer.observe(this.$element[0], {
        attributes: true,
        childList: true,
        subtree: false
      });
    } else if (this.$element[0].addEventListener) {
      this.$element[0].addEventListener(
        'DOMAttrModified',
        self._syncA,
        false
      );
      this.$element[0].addEventListener(
        'DOMNodeInserted',
        self._syncS,
        false
      );
      this.$element[0].addEventListener(
        'DOMNodeRemoved',
        self._syncS,
        false
      );
    }
  };

  Select2.prototype._registerDataEvents = function () {
    var self = this;

    this.dataAdapter.on('*', function (name, params) {
      self.trigger(name, params);
    });
  };

  Select2.prototype._registerSelectionEvents = function () {
    var self = this;
    var nonRelayEvents = ['toggle', 'focus'];

    this.selection.on('toggle', function () {
      self.toggleDropdown();
    });

    this.selection.on('focus', function (params) {
      self.focus(params);
    });

    this.selection.on('*', function (name, params) {
      if ($.inArray(name, nonRelayEvents) !== -1) {
        return;
      }

      self.trigger(name, params);
    });
  };

  Select2.prototype._registerDropdownEvents = function () {
    var self = this;

    this.dropdown.on('*', function (name, params) {
      self.trigger(name, params);
    });
  };

  Select2.prototype._registerResultsEvents = function () {
    var self = this;

    this.results.on('*', function (name, params) {
      self.trigger(name, params);
    });
  };

  Select2.prototype._registerEvents = function () {
    var self = this;

    this.on('open', function () {
      self.$container.addClass('select2-container--open');
    });

    this.on('close', function () {
      self.$container.removeClass('select2-container--open');
    });

    this.on('enable', function () {
      self.$container.removeClass('select2-container--disabled');
    });

    this.on('disable', function () {
      self.$container.addClass('select2-container--disabled');
    });

    this.on('blur', function () {
      self.$container.removeClass('select2-container--focus');
    });

    this.on('query', function (params) {
      if (!self.isOpen()) {
        self.trigger('open', {});
      }

      this.dataAdapter.query(params, function (data) {
        self.trigger('results:all', {
          data: data,
          query: params
        });
      });
    });

    this.on('query:append', function (params) {
      this.dataAdapter.query(params, function (data) {
        self.trigger('results:append', {
          data: data,
          query: params
        });
      });
    });

    this.on('keypress', function (evt) {
      var key = evt.which;

      if (self.isOpen()) {
        if (key === KEYS.ESC || key === KEYS.TAB ||
            (key === KEYS.UP && evt.altKey)) {
          self.close();

          evt.preventDefault();
        } else if (key === KEYS.ENTER) {
          self.trigger('results:select', {});

          evt.preventDefault();
        } else if ((key === KEYS.SPACE && evt.ctrlKey)) {
          self.trigger('results:toggle', {});

          evt.preventDefault();
        } else if (key === KEYS.UP) {
          self.trigger('results:previous', {});

          evt.preventDefault();
        } else if (key === KEYS.DOWN) {
          self.trigger('results:next', {});

          evt.preventDefault();
        }
      } else {
        if (key === KEYS.ENTER || key === KEYS.SPACE ||
            (key === KEYS.DOWN && evt.altKey)) {
          self.open();

          evt.preventDefault();
        }
      }
    });
  };

  Select2.prototype._syncAttributes = function () {
    this.options.set('disabled', this.$element.prop('disabled'));

    if (this.options.get('disabled')) {
      if (this.isOpen()) {
        this.close();
      }

      this.trigger('disable', {});
    } else {
      this.trigger('enable', {});
    }
  };

  Select2.prototype._syncSubtree = function (evt, mutations) {
    var changed = false;
    var self = this;

    // Ignore any mutation events raised for elements that aren't options or
    // optgroups. This handles the case when the select element is destroyed
    if (
      evt && evt.target && (
        evt.target.nodeName !== 'OPTION' && evt.target.nodeName !== 'OPTGROUP'
      )
    ) {
      return;
    }

    if (!mutations) {
      // If mutation events aren't supported, then we can only assume that the
      // change affected the selections
      changed = true;
    } else if (mutations.addedNodes && mutations.addedNodes.length > 0) {
      for (var n = 0; n < mutations.addedNodes.length; n++) {
        var node = mutations.addedNodes[n];

        if (node.selected) {
          changed = true;
        }
      }
    } else if (mutations.removedNodes && mutations.removedNodes.length > 0) {
      changed = true;
    }

    // Only re-pull the data if we think there is a change
    if (changed) {
      this.dataAdapter.current(function (currentData) {
        self.trigger('selection:update', {
          data: currentData
        });
      });
    }
  };

  /**
   * Override the trigger method to automatically trigger pre-events when
   * there are events that can be prevented.
   */
  Select2.prototype.trigger = function (name, args) {
    var actualTrigger = Select2.__super__.trigger;
    var preTriggerMap = {
      'open': 'opening',
      'close': 'closing',
      'select': 'selecting',
      'unselect': 'unselecting',
      'clear': 'clearing'
    };

    if (args === undefined) {
      args = {};
    }

    if (name in preTriggerMap) {
      var preTriggerName = preTriggerMap[name];
      var preTriggerArgs = {
        prevented: false,
        name: name,
        args: args
      };

      actualTrigger.call(this, preTriggerName, preTriggerArgs);

      if (preTriggerArgs.prevented) {
        args.prevented = true;

        return;
      }
    }

    actualTrigger.call(this, name, args);
  };

  Select2.prototype.toggleDropdown = function () {
    if (this.options.get('disabled')) {
      return;
    }

    if (this.isOpen()) {
      this.close();
    } else {
      this.open();
    }
  };

  Select2.prototype.open = function () {
    if (this.isOpen()) {
      return;
    }

    this.trigger('query', {});
  };

  Select2.prototype.close = function () {
    if (!this.isOpen()) {
      return;
    }

    this.trigger('close', {});
  };

  Select2.prototype.isOpen = function () {
    return this.$container.hasClass('select2-container--open');
  };

  Select2.prototype.hasFocus = function () {
    return this.$container.hasClass('select2-container--focus');
  };

  Select2.prototype.focus = function (data) {
    // No need to re-trigger focus events if we are already focused
    if (this.hasFocus()) {
      return;
    }

    this.$container.addClass('select2-container--focus');
    this.trigger('focus', {});
  };

  Select2.prototype.enable = function (args) {
    if (this.options.get('debug') && window.console && console.warn) {
      console.warn(
        'Select2: The `select2("enable")` method has been deprecated and will' +
        ' be removed in later Select2 versions. Use $element.prop("disabled")' +
        ' instead.'
      );
    }

    if (args == null || args.length === 0) {
      args = [true];
    }

    var disabled = !args[0];

    this.$element.prop('disabled', disabled);
  };

  Select2.prototype.data = function () {
    if (this.options.get('debug') &&
        arguments.length > 0 && window.console && console.warn) {
      console.warn(
        'Select2: Data can no longer be set using `select2("data")`. You ' +
        'should consider setting the value instead using `$element.val()`.'
      );
    }

    var data = [];

    this.dataAdapter.current(function (currentData) {
      data = currentData;
    });

    return data;
  };

  Select2.prototype.val = function (args) {
    if (this.options.get('debug') && window.console && console.warn) {
      console.warn(
        'Select2: The `select2("val")` method has been deprecated and will be' +
        ' removed in later Select2 versions. Use $element.val() instead.'
      );
    }

    if (args == null || args.length === 0) {
      return this.$element.val();
    }

    var newVal = args[0];

    if ($.isArray(newVal)) {
      newVal = $.map(newVal, function (obj) {
        return obj.toString();
      });
    }

    this.$element.val(newVal).trigger('change');
  };

  Select2.prototype.destroy = function () {
    this.$container.remove();

    if (this.$element[0].detachEvent) {
      this.$element[0].detachEvent('onpropertychange', this._syncA);
    }

    if (this._observer != null) {
      this._observer.disconnect();
      this._observer = null;
    } else if (this.$element[0].removeEventListener) {
      this.$element[0]
        .removeEventListener('DOMAttrModified', this._syncA, false);
      this.$element[0]
        .removeEventListener('DOMNodeInserted', this._syncS, false);
      this.$element[0]
        .removeEventListener('DOMNodeRemoved', this._syncS, false);
    }

    this._syncA = null;
    this._syncS = null;

    this.$element.off('.select2');
    this.$element.attr('tabindex',
    Utils.GetData(this.$element[0], 'old-tabindex'));

    this.$element.removeClass('select2-hidden-accessible');
    this.$element.attr('aria-hidden', 'false');
    Utils.RemoveData(this.$element[0]);
    this.$element.removeData('select2');

    this.dataAdapter.destroy();
    this.selection.destroy();
    this.dropdown.destroy();
    this.results.destroy();

    this.dataAdapter = null;
    this.selection = null;
    this.dropdown = null;
    this.results = null;
  };

  Select2.prototype.render = function () {
    var $container = $(
      '<span class="select2 select2-container">' +
        '<span class="selection"></span>' +
        '<span class="dropdown-wrapper" aria-hidden="true"></span>' +
      '</span>'
    );

    $container.attr('dir', this.options.get('dir'));

    this.$container = $container;

    this.$container.addClass('select2-container--' + this.options.get('theme'));

    Utils.StoreData($container[0], 'element', this.$element);

    return $container;
  };

  return Select2;
});

S2.define('select2/compat/utils',[
  'jquery'
], function ($) {
  function syncCssClasses ($dest, $src, adapter) {
    var classes, replacements = [], adapted;

    classes = $.trim($dest.attr('class'));

    if (classes) {
      classes = '' + classes; // for IE which returns object

      $(classes.split(/\s+/)).each(function () {
        // Save all Select2 classes
        if (this.indexOf('select2-') === 0) {
          replacements.push(this);
        }
      });
    }

    classes = $.trim($src.attr('class'));

    if (classes) {
      classes = '' + classes; // for IE which returns object

      $(classes.split(/\s+/)).each(function () {
        // Only adapt non-Select2 classes
        if (this.indexOf('select2-') !== 0) {
          adapted = adapter(this);

          if (adapted != null) {
            replacements.push(adapted);
          }
        }
      });
    }

    $dest.attr('class', replacements.join(' '));
  }

  return {
    syncCssClasses: syncCssClasses
  };
});

S2.define('select2/compat/containerCss',[
  'jquery',
  './utils'
], function ($, CompatUtils) {
  // No-op CSS adapter that discards all classes by default
  function _containerAdapter (clazz) {
    return null;
  }

  function ContainerCSS () { }

  ContainerCSS.prototype.render = function (decorated) {
    var $container = decorated.call(this);

    var containerCssClass = this.options.get('containerCssClass') || '';

    if ($.isFunction(containerCssClass)) {
      containerCssClass = containerCssClass(this.$element);
    }

    var containerCssAdapter = this.options.get('adaptContainerCssClass');
    containerCssAdapter = containerCssAdapter || _containerAdapter;

    if (containerCssClass.indexOf(':all:') !== -1) {
      containerCssClass = containerCssClass.replace(':all:', '');

      var _cssAdapter = containerCssAdapter;

      containerCssAdapter = function (clazz) {
        var adapted = _cssAdapter(clazz);

        if (adapted != null) {
          // Append the old one along with the adapted one
          return adapted + ' ' + clazz;
        }

        return clazz;
      };
    }

    var containerCss = this.options.get('containerCss') || {};

    if ($.isFunction(containerCss)) {
      containerCss = containerCss(this.$element);
    }

    CompatUtils.syncCssClasses($container, this.$element, containerCssAdapter);

    $container.css(containerCss);
    $container.addClass(containerCssClass);

    return $container;
  };

  return ContainerCSS;
});

S2.define('select2/compat/dropdownCss',[
  'jquery',
  './utils'
], function ($, CompatUtils) {
  // No-op CSS adapter that discards all classes by default
  function _dropdownAdapter (clazz) {
    return null;
  }

  function DropdownCSS () { }

  DropdownCSS.prototype.render = function (decorated) {
    var $dropdown = decorated.call(this);

    var dropdownCssClass = this.options.get('dropdownCssClass') || '';

    if ($.isFunction(dropdownCssClass)) {
      dropdownCssClass = dropdownCssClass(this.$element);
    }

    var dropdownCssAdapter = this.options.get('adaptDropdownCssClass');
    dropdownCssAdapter = dropdownCssAdapter || _dropdownAdapter;

    if (dropdownCssClass.indexOf(':all:') !== -1) {
      dropdownCssClass = dropdownCssClass.replace(':all:', '');

      var _cssAdapter = dropdownCssAdapter;

      dropdownCssAdapter = function (clazz) {
        var adapted = _cssAdapter(clazz);

        if (adapted != null) {
          // Append the old one along with the adapted one
          return adapted + ' ' + clazz;
        }

        return clazz;
      };
    }

    var dropdownCss = this.options.get('dropdownCss') || {};

    if ($.isFunction(dropdownCss)) {
      dropdownCss = dropdownCss(this.$element);
    }

    CompatUtils.syncCssClasses($dropdown, this.$element, dropdownCssAdapter);

    $dropdown.css(dropdownCss);
    $dropdown.addClass(dropdownCssClass);

    return $dropdown;
  };

  return DropdownCSS;
});

S2.define('select2/compat/initSelection',[
  'jquery'
], function ($) {
  function InitSelection (decorated, $element, options) {
    if (options.get('debug') && window.console && console.warn) {
      console.warn(
        'Select2: The `initSelection` option has been deprecated in favor' +
        ' of a custom data adapter that overrides the `current` method. ' +
        'This method is now called multiple times instead of a single ' +
        'time when the instance is initialized. Support will be removed ' +
        'for the `initSelection` option in future versions of Select2'
      );
    }

    this.initSelection = options.get('initSelection');
    this._isInitialized = false;

    decorated.call(this, $element, options);
  }

  InitSelection.prototype.current = function (decorated, callback) {
    var self = this;

    if (this._isInitialized) {
      decorated.call(this, callback);

      return;
    }

    this.initSelection.call(null, this.$element, function (data) {
      self._isInitialized = true;

      if (!$.isArray(data)) {
        data = [data];
      }

      callback(data);
    });
  };

  return InitSelection;
});

S2.define('select2/compat/inputData',[
  'jquery',
  '../utils'
], function ($, Utils) {
  function InputData (decorated, $element, options) {
    this._currentData = [];
    this._valueSeparator = options.get('valueSeparator') || ',';

    if ($element.prop('type') === 'hidden') {
      if (options.get('debug') && console && console.warn) {
        console.warn(
          'Select2: Using a hidden input with Select2 is no longer ' +
          'supported and may stop working in the future. It is recommended ' +
          'to use a `<select>` element instead.'
        );
      }
    }

    decorated.call(this, $element, options);
  }

  InputData.prototype.current = function (_, callback) {
    function getSelected (data, selectedIds) {
      var selected = [];

      if (data.selected || $.inArray(data.id, selectedIds) !== -1) {
        data.selected = true;
        selected.push(data);
      } else {
        data.selected = false;
      }

      if (data.children) {
        selected.push.apply(selected, getSelected(data.children, selectedIds));
      }

      return selected;
    }

    var selected = [];

    for (var d = 0; d < this._currentData.length; d++) {
      var data = this._currentData[d];

      selected.push.apply(
        selected,
        getSelected(
          data,
          this.$element.val().split(
            this._valueSeparator
          )
        )
      );
    }

    callback(selected);
  };

  InputData.prototype.select = function (_, data) {
    if (!this.options.get('multiple')) {
      this.current(function (allData) {
        $.map(allData, function (data) {
          data.selected = false;
        });
      });

      this.$element.val(data.id);
      this.$element.trigger('change');
    } else {
      var value = this.$element.val();
      value += this._valueSeparator + data.id;

      this.$element.val(value);
      this.$element.trigger('change');
    }
  };

  InputData.prototype.unselect = function (_, data) {
    var self = this;

    data.selected = false;

    this.current(function (allData) {
      var values = [];

      for (var d = 0; d < allData.length; d++) {
        var item = allData[d];

        if (data.id == item.id) {
          continue;
        }

        values.push(item.id);
      }

      self.$element.val(values.join(self._valueSeparator));
      self.$element.trigger('change');
    });
  };

  InputData.prototype.query = function (_, params, callback) {
    var results = [];

    for (var d = 0; d < this._currentData.length; d++) {
      var data = this._currentData[d];

      var matches = this.matches(params, data);

      if (matches !== null) {
        results.push(matches);
      }
    }

    callback({
      results: results
    });
  };

  InputData.prototype.addOptions = function (_, $options) {
    var options = $.map($options, function ($option) {
      return Utils.GetData($option[0], 'data');
    });

    this._currentData.push.apply(this._currentData, options);
  };

  return InputData;
});

S2.define('select2/compat/matcher',[
  'jquery'
], function ($) {
  function oldMatcher (matcher) {
    function wrappedMatcher (params, data) {
      var match = $.extend(true, {}, data);

      if (params.term == null || $.trim(params.term) === '') {
        return match;
      }

      if (data.children) {
        for (var c = data.children.length - 1; c >= 0; c--) {
          var child = data.children[c];

          // Check if the child object matches
          // The old matcher returned a boolean true or false
          var doesMatch = matcher(params.term, child.text, child);

          // If the child didn't match, pop it off
          if (!doesMatch) {
            match.children.splice(c, 1);
          }
        }

        if (match.children.length > 0) {
          return match;
        }
      }

      if (matcher(params.term, data.text, data)) {
        return match;
      }

      return null;
    }

    return wrappedMatcher;
  }

  return oldMatcher;
});

S2.define('select2/compat/query',[

], function () {
  function Query (decorated, $element, options) {
    if (options.get('debug') && window.console && console.warn) {
      console.warn(
        'Select2: The `query` option has been deprecated in favor of a ' +
        'custom data adapter that overrides the `query` method. Support ' +
        'will be removed for the `query` option in future versions of ' +
        'Select2.'
      );
    }

    decorated.call(this, $element, options);
  }

  Query.prototype.query = function (_, params, callback) {
    params.callback = callback;

    var query = this.options.get('query');

    query.call(null, params);
  };

  return Query;
});

S2.define('select2/dropdown/attachContainer',[

], function () {
  function AttachContainer (decorated, $element, options) {
    decorated.call(this, $element, options);
  }

  AttachContainer.prototype.position =
    function (decorated, $dropdown, $container) {
    var $dropdownContainer = $container.find('.dropdown-wrapper');
    $dropdownContainer.append($dropdown);

    $dropdown.addClass('select2-dropdown--below');
    $container.addClass('select2-container--below');
  };

  return AttachContainer;
});

S2.define('select2/dropdown/stopPropagation',[

], function () {
  function StopPropagation () { }

  StopPropagation.prototype.bind = function (decorated, container, $container) {
    decorated.call(this, container, $container);

    var stoppedEvents = [
    'blur',
    'change',
    'click',
    'dblclick',
    'focus',
    'focusin',
    'focusout',
    'input',
    'keydown',
    'keyup',
    'keypress',
    'mousedown',
    'mouseenter',
    'mouseleave',
    'mousemove',
    'mouseover',
    'mouseup',
    'search',
    'touchend',
    'touchstart'
    ];

    this.$dropdown.on(stoppedEvents.join(' '), function (evt) {
      evt.stopPropagation();
    });
  };

  return StopPropagation;
});

S2.define('select2/selection/stopPropagation',[

], function () {
  function StopPropagation () { }

  StopPropagation.prototype.bind = function (decorated, container, $container) {
    decorated.call(this, container, $container);

    var stoppedEvents = [
      'blur',
      'change',
      'click',
      'dblclick',
      'focus',
      'focusin',
      'focusout',
      'input',
      'keydown',
      'keyup',
      'keypress',
      'mousedown',
      'mouseenter',
      'mouseleave',
      'mousemove',
      'mouseover',
      'mouseup',
      'search',
      'touchend',
      'touchstart'
    ];

    this.$selection.on(stoppedEvents.join(' '), function (evt) {
      evt.stopPropagation();
    });
  };

  return StopPropagation;
});

/*!
 * jQuery Mousewheel 3.1.13
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 */

(function (factory) {
    if ( typeof S2.define === 'function' && S2.define.amd ) {
        // AMD. Register as an anonymous module.
        S2.define('jquery-mousewheel',['jquery'], factory);
    } else if (true) {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {}
}(function ($) {

    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
                    ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice  = Array.prototype.slice,
        nullLowestDeltaTimeout, lowestDelta;

    if ( $.event.fixHooks ) {
        for ( var i = toFix.length; i; ) {
            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
        }
    }

    var special = $.event.special.mousewheel = {
        version: '3.1.12',

        setup: function() {
            if ( this.addEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.addEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = handler;
            }
            // Store the line height and page height for this particular element
            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
        },

        teardown: function() {
            if ( this.removeEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.removeEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = null;
            }
            // Clean up the data we added to the element
            $.removeData(this, 'mousewheel-line-height');
            $.removeData(this, 'mousewheel-page-height');
        },

        getLineHeight: function(elem) {
            var $elem = $(elem),
                $parent = $elem['offsetParent' in $.fn ? 'offsetParent' : 'parent']();
            if (!$parent.length) {
                $parent = $('body');
            }
            return parseInt($parent.css('fontSize'), 10) || parseInt($elem.css('fontSize'), 10) || 16;
        },

        getPageHeight: function(elem) {
            return $(elem).height();
        },

        settings: {
            adjustOldDeltas: true, // see shouldAdjustOldDeltas() below
            normalizeOffset: true  // calls getBoundingClientRect for each event
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },

        unmousewheel: function(fn) {
            return this.unbind('mousewheel', fn);
        }
    });


    function handler(event) {
        var orgEvent   = event || window.event,
            args       = slice.call(arguments, 1),
            delta      = 0,
            deltaX     = 0,
            deltaY     = 0,
            absDelta   = 0,
            offsetX    = 0,
            offsetY    = 0;
        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        // Old school scrollwheel delta
        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
            deltaX = deltaY * -1;
            deltaY = 0;
        }

        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
        delta = deltaY === 0 ? deltaX : deltaY;

        // New school wheel delta (wheel event)
        if ( 'deltaY' in orgEvent ) {
            deltaY = orgEvent.deltaY * -1;
            delta  = deltaY;
        }
        if ( 'deltaX' in orgEvent ) {
            deltaX = orgEvent.deltaX;
            if ( deltaY === 0 ) { delta  = deltaX * -1; }
        }

        // No change actually happened, no reason to go any further
        if ( deltaY === 0 && deltaX === 0 ) { return; }

        // Need to convert lines and pages to pixels if we aren't already in pixels
        // There are three delta modes:
        //   * deltaMode 0 is by pixels, nothing to do
        //   * deltaMode 1 is by lines
        //   * deltaMode 2 is by pages
        if ( orgEvent.deltaMode === 1 ) {
            var lineHeight = $.data(this, 'mousewheel-line-height');
            delta  *= lineHeight;
            deltaY *= lineHeight;
            deltaX *= lineHeight;
        } else if ( orgEvent.deltaMode === 2 ) {
            var pageHeight = $.data(this, 'mousewheel-page-height');
            delta  *= pageHeight;
            deltaY *= pageHeight;
            deltaX *= pageHeight;
        }

        // Store lowest absolute delta to normalize the delta values
        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

        if ( !lowestDelta || absDelta < lowestDelta ) {
            lowestDelta = absDelta;

            // Adjust older deltas if necessary
            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
                lowestDelta /= 40;
            }
        }

        // Adjust older deltas if necessary
        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
            // Divide all the things by 40!
            delta  /= 40;
            deltaX /= 40;
            deltaY /= 40;
        }

        // Get a whole, normalized value for the deltas
        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

        // Normalise offsetX and offsetY properties
        if ( special.settings.normalizeOffset && this.getBoundingClientRect ) {
            var boundingRect = this.getBoundingClientRect();
            offsetX = event.clientX - boundingRect.left;
            offsetY = event.clientY - boundingRect.top;
        }

        // Add information to the event object
        event.deltaX = deltaX;
        event.deltaY = deltaY;
        event.deltaFactor = lowestDelta;
        event.offsetX = offsetX;
        event.offsetY = offsetY;
        // Go ahead and set deltaMode to 0 since we converted to pixels
        // Although this is a little odd since we overwrite the deltaX/Y
        // properties with normalized deltas.
        event.deltaMode = 0;

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        // Clearout lowestDelta after sometime to better
        // handle multiple device types that give different
        // a different lowestDelta
        // Ex: trackpad = 3 and mouse wheel = 120
        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
        lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
        // If this is an older event and the delta is divisable by 120,
        // then we are assuming that the browser is treating this as an
        // older mouse wheel event and that we should divide the deltas
        // by 40 to try and get a more usable deltaFactor.
        // Side note, this actually impacts the reported scroll distance
        // in older browsers and can cause scrolling to be slower than native.
        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }

}));

S2.define('jquery.select2',[
  'jquery',
  'jquery-mousewheel',

  './select2/core',
  './select2/defaults',
  './select2/utils'
], function ($, _, Select2, Defaults, Utils) {
  if ($.fn.select2 == null) {
    // All methods that should return the element
    var thisMethods = ['open', 'close', 'destroy'];

    $.fn.select2 = function (options) {
      options = options || {};

      if (typeof options === 'object') {
        this.each(function () {
          var instanceOptions = $.extend(true, {}, options);

          var instance = new Select2($(this), instanceOptions);
        });

        return this;
      } else if (typeof options === 'string') {
        var ret;
        var args = Array.prototype.slice.call(arguments, 1);

        this.each(function () {
          var instance = Utils.GetData(this, 'select2');

          if (instance == null && window.console && console.error) {
            console.error(
              'The select2(\'' + options + '\') method was called on an ' +
              'element that is not using Select2.'
            );
          }

          ret = instance[options].apply(instance, args);
        });

        // Check if we should be returning `this`
        if ($.inArray(options, thisMethods) > -1) {
          return this;
        }

        return ret;
      } else {
        throw new Error('Invalid arguments for Select2: ' + options);
      }
    };
  }

  if ($.fn.select2.defaults == null) {
    $.fn.select2.defaults = Defaults;
  }

  return Select2;
});

  // Return the AMD loader configuration so it can be used outside of this file
  return {
    define: S2.define,
    require: S2.require
  };
}());

  // Autoload the jQuery bindings
  // We know that all of the modules exist above this, so we're safe
  var select2 = S2.require('jquery.select2');

  // Hold the AMD module references on the jQuery function that was just loaded
  // This allows Select2 to use the internal loader outside of this file, such
  // as in the language files.
  jQuery.fn.select2.amd = S2;

  // Return the Select2 instance for anyone who is importing it.
  return select2;
}));


/***/ }),

/***/ "./node_modules/v-select2-component/dist/Select2.esm.js":
/*!**************************************************************!*\
  !*** ./node_modules/v-select2-component/dist/Select2.esm.js ***!
  \**************************************************************/
/*! exports provided: default, install */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(global) {/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "install", function() { return s; });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var select2_dist_js_select2_full__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! select2/dist/js/select2.full */ "./node_modules/select2/dist/js/select2.full.js");
/* harmony import */ var select2_dist_js_select2_full__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(select2_dist_js_select2_full__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var select2_dist_css_select2_min_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! select2/dist/css/select2.min.css */ "./node_modules/select2/dist/css/select2.min.css");
/* harmony import */ var select2_dist_css_select2_min_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(select2_dist_css_select2_min_css__WEBPACK_IMPORTED_MODULE_2__);
function t(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function n(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),n.push.apply(n,r)}return n}function r(e){for(var r=1;r<arguments.length;r++){var i=null!=arguments[r]?arguments[r]:{};r%2?n(i,!0).forEach(function(n){t(e,n,i[n])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):n(i).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))})}return e}function i(e){return function(e){if(Array.isArray(e)){for(var t=0,n=new Array(e.length);t<e.length;t++)n[t]=e[t];return n}}(e)||function(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}var o=function(e,t,n,r,i,o,s,l,a,c){"boolean"!=typeof s&&(a=l,l=s,s=!1);var u,d="function"==typeof n?n.options:n;if(e&&e.render&&(d.render=e.render,d.staticRenderFns=e.staticRenderFns,d._compiled=!0,i&&(d.functional=!0)),r&&(d._scopeId=r),o?(u=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),t&&t.call(this,a(e)),e&&e._registeredComponents&&e._registeredComponents.add(o)},d._ssrRegister=u):t&&(u=s?function(){t.call(this,c(this.$root.$options.shadowRoot))}:function(e){t.call(this,l(e))}),u)if(d.functional){var f=d.render;d.render=function(e,t){return u.call(t),f(e,t)}}else{var p=d.beforeCreate;d.beforeCreate=p?[].concat(p,u):[u]}return n}({render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",[t("select",{staticClass:"form-control",attrs:{id:this.id,name:this.name,placeholder:this.placeholder,disabled:this.disabled,required:this.required}})])},staticRenderFns:[]},void 0,{name:"Select2",data:function(){return{select2:null}},model:{event:"change",prop:"value"},props:{id:{type:String,default:""},name:{type:String,default:""},placeholder:{type:String,default:""},options:{type:Array,default:function(){return[]}},disabled:{type:Boolean,default:!1},required:{type:Boolean,default:!1},settings:{type:Object,default:function(){}},value:null},watch:{options:function(e){this.setOption(e)},value:function(e){this.setValue(e)}},methods:{setOption:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.select2.empty(),this.select2.select2(r({},this.settings,{data:e})),this.setValue(this.value)},setValue:function(e){e instanceof Array?this.select2.val(i(e)):this.select2.val([e]),this.select2.trigger("change")}},mounted:function(){var t=this;this.select2=jquery__WEBPACK_IMPORTED_MODULE_0___default()(this.$el).find("select").select2(r({},this.settings,{data:this.options})).on("select2:select select2:unselect",function(e){t.$emit("change",t.select2.val()),t.$emit("select",e.params.data)}),this.setValue(this.value)},beforeDestroy:function(){this.select2.select2("destroy")}},void 0,!1,void 0,void 0,void 0);function s(e){s.installed||(s.installed=!0,e.component("MyComponent",o))}var l={install:s},a=null;"undefined"!=typeof window?a=window.Vue:"undefined"!=typeof global&&(a=global.Vue),a&&a.use(l);/* harmony default export */ __webpack_exports__["default"] = (o);

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./node_modules/vue-autonumeric/dist/vue-autonumeric.min.js":
/*!******************************************************************!*\
  !*** ./node_modules/vue-autonumeric/dist/vue-autonumeric.min.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(t,n){ true?module.exports=n(__webpack_require__(/*! AutoNumeric */ "./node_modules/AutoNumeric/dist/autoNumeric.min.js")):undefined}("undefined"!=typeof self?self:this,function(t){return function(t){function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}var e={};return n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:r})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},n.p="",n(n.s=10)}([function(t,n){var e=t.exports={version:"2.5.4"};"number"==typeof __e&&(__e=e)},function(t,n){var e=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=e)},function(t,n){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,n,e){t.exports=!e(4)(function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a})},function(t,n){t.exports=function(t){try{return!!t()}catch(t){return!0}}},function(t,n){var e={}.hasOwnProperty;t.exports=function(t,n){return e.call(t,n)}},function(t,n,e){var r=e(7),o=e(8);t.exports=function(t){return r(o(t))}},function(t,n,e){var r=e(32);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,n){t.exports=function(t){if(void 0==t)throw TypeError("Can't call method on  "+t);return t}},function(t,n){var e=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:e)(t)}},function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.VueAutonumeric=void 0;var r=e(11),o=function(t){return t&&t.__esModule?t:{default:t}}(r);"undefined"!=typeof window&&window.Vue&&Vue.component("vue-autonumeric",o.default),n.VueAutonumeric=o.default,n.default=o.default},function(t,n,e){var r=e(12)(e(13),null,null,null);t.exports=r.exports},function(t,n){t.exports=function(t,n,e,r){var o,i=t=t||{},u=typeof t.default;"object"!==u&&"function"!==u||(o=t,i=t.default);var f="function"==typeof i?i.options:i;if(n&&(f.render=n.render,f.staticRenderFns=n.staticRenderFns),e&&(f._scopeId=e),r){var c=Object.create(f.computed||null);Object.keys(r).forEach(function(t){var n=r[t];c[t]=function(){return n}}),f.computed=c}return{esModule:o,exports:i,options:f}}},function(t,n,e){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(n,"__esModule",{value:!0});var o=e(14),i=r(o),u=e(16),f=r(u),c=e(43),a=r(c),s={};n.default={name:"VueAutonumeric",render:function(t){var n="input"===this.tag,e=void 0;return e=n?{type:"text",placeholder:this.placeholder}:{contenteditable:this.hasContentEditable},t(this.tag,{attrs:e,ref:"autoNumericElement",on:{"autoNumeric:rawValueModified":this.updateVModel}})},props:{value:{required:!1,validator:function(t){return"number"==typeof t||"string"==typeof t||""===t||null===t}},options:{type:[Object,String,Array],required:!1,default:function(){return s}},resetOnOptions:{type:Boolean,required:!1,default:!0},placeholder:{type:String,required:!1},tag:{type:String,required:!1,default:"input"}},data:function(){return{anElement:null,initialOptions:null,hasContentEditable:!0}},created:function(){var t=this;if(Array.isArray(this.options)){var n={};this.options.forEach(function(e){t.initialOptions=t.manageOptionElement(e),n=(0,f.default)(n,t.initialOptions)}),this.initialOptions=n}else this.initialOptions=this.manageOptionElement(this.options);this.hasContentEditable=!this.initialOptions.readOnly},mounted:function(){this.anElement=new a.default(this.$refs.autoNumericElement,this.initialOptions),null!==this.value&&""!==this.value&&(this.anElement.set(this.value),this.updateVModel())},computed:{anInfo:function(){return{value:this.value,options:this.options}}},methods:{updateVModel:function(t){null!==this.anElement&&this.$emit("input",this.anElement.getNumber(),t)},manageOptionElement:function(t){var n=void 0;return"string"==typeof t||t instanceof String?void 0!==(n=a.default.getPredefinedOptions()[t])&&null!==n||(console.warn("The given pre-defined options ["+t+"] is not recognized by AutoNumeric.\nSwitching back to the default options."),n=s):n=t,n}},watch:{anInfo:function(t,n){if(n.options&&(0,i.default)(t.options)!==(0,i.default)(n.options)){this.resetOnOptions&&this.anElement.options.reset();var e=void 0;e=Array.isArray(t.options)?a.default.mergeOptions(t.options):a.default._getOptionObject(t.options),this.anElement.update(e)}void 0!==t.value&&this.anElement.getNumber()!==t.value&&t.value!==n.value&&this.anElement.set(t.value)}}}},function(t,n,e){t.exports={default:e(15),__esModule:!0}},function(t,n,e){var r=e(0),o=r.JSON||(r.JSON={stringify:JSON.stringify});t.exports=function(t){return o.stringify.apply(o,arguments)}},function(t,n,e){t.exports={default:e(17),__esModule:!0}},function(t,n,e){e(18),t.exports=e(0).Object.assign},function(t,n,e){var r=e(19);r(r.S+r.F,"Object",{assign:e(29)})},function(t,n,e){var r=e(1),o=e(0),i=e(20),u=e(22),f=e(5),c=function(t,n,e){var a,s,l,p=t&c.F,d=t&c.G,v=t&c.S,h=t&c.P,y=t&c.B,m=t&c.W,b=d?o:o[n]||(o[n]={}),O=b.prototype,x=d?r:v?r[n]:(r[n]||{}).prototype;d&&(e=n);for(a in e)(s=!p&&x&&void 0!==x[a])&&f(b,a)||(l=s?x[a]:e[a],b[a]=d&&"function"!=typeof x[a]?e[a]:y&&s?i(l,r):m&&x[a]==l?function(t){var n=function(n,e,r){if(this instanceof t){switch(arguments.length){case 0:return new t;case 1:return new t(n);case 2:return new t(n,e)}return new t(n,e,r)}return t.apply(this,arguments)};return n.prototype=t.prototype,n}(l):h&&"function"==typeof l?i(Function.call,l):l,h&&((b.virtual||(b.virtual={}))[a]=l,t&c.R&&O&&!O[a]&&u(O,a,l)))};c.F=1,c.G=2,c.S=4,c.P=8,c.B=16,c.W=32,c.U=64,c.R=128,t.exports=c},function(t,n,e){var r=e(21);t.exports=function(t,n,e){if(r(t),void 0===n)return t;switch(e){case 1:return function(e){return t.call(n,e)};case 2:return function(e,r){return t.call(n,e,r)};case 3:return function(e,r,o){return t.call(n,e,r,o)}}return function(){return t.apply(n,arguments)}}},function(t,n){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,n,e){var r=e(23),o=e(28);t.exports=e(3)?function(t,n,e){return r.f(t,n,o(1,e))}:function(t,n,e){return t[n]=e,t}},function(t,n,e){var r=e(24),o=e(25),i=e(27),u=Object.defineProperty;n.f=e(3)?Object.defineProperty:function(t,n,e){if(r(t),n=i(n,!0),r(e),o)try{return u(t,n,e)}catch(t){}if("get"in e||"set"in e)throw TypeError("Accessors not supported!");return"value"in e&&(t[n]=e.value),t}},function(t,n,e){var r=e(2);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,n,e){t.exports=!e(3)&&!e(4)(function(){return 7!=Object.defineProperty(e(26)("div"),"a",{get:function(){return 7}}).a})},function(t,n,e){var r=e(2),o=e(1).document,i=r(o)&&r(o.createElement);t.exports=function(t){return i?o.createElement(t):{}}},function(t,n,e){var r=e(2);t.exports=function(t,n){if(!r(t))return t;var e,o;if(n&&"function"==typeof(e=t.toString)&&!r(o=e.call(t)))return o;if("function"==typeof(e=t.valueOf)&&!r(o=e.call(t)))return o;if(!n&&"function"==typeof(e=t.toString)&&!r(o=e.call(t)))return o;throw TypeError("Can't convert object to primitive value")}},function(t,n){t.exports=function(t,n){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:n}}},function(t,n,e){"use strict";var r=e(30),o=e(40),i=e(41),u=e(42),f=e(7),c=Object.assign;t.exports=!c||e(4)(function(){var t={},n={},e=Symbol(),r="abcdefghijklmnopqrst";return t[e]=7,r.split("").forEach(function(t){n[t]=t}),7!=c({},t)[e]||Object.keys(c({},n)).join("")!=r})?function(t,n){for(var e=u(t),c=arguments.length,a=1,s=o.f,l=i.f;c>a;)for(var p,d=f(arguments[a++]),v=s?r(d).concat(s(d)):r(d),h=v.length,y=0;h>y;)l.call(d,p=v[y++])&&(e[p]=d[p]);return e}:c},function(t,n,e){var r=e(31),o=e(39);t.exports=Object.keys||function(t){return r(t,o)}},function(t,n,e){var r=e(5),o=e(6),i=e(33)(!1),u=e(36)("IE_PROTO");t.exports=function(t,n){var e,f=o(t),c=0,a=[];for(e in f)e!=u&&r(f,e)&&a.push(e);for(;n.length>c;)r(f,e=n[c++])&&(~i(a,e)||a.push(e));return a}},function(t,n){var e={}.toString;t.exports=function(t){return e.call(t).slice(8,-1)}},function(t,n,e){var r=e(6),o=e(34),i=e(35);t.exports=function(t){return function(n,e,u){var f,c=r(n),a=o(c.length),s=i(u,a);if(t&&e!=e){for(;a>s;)if((f=c[s++])!=f)return!0}else for(;a>s;s++)if((t||s in c)&&c[s]===e)return t||s||0;return!t&&-1}}},function(t,n,e){var r=e(9),o=Math.min;t.exports=function(t){return t>0?o(r(t),9007199254740991):0}},function(t,n,e){var r=e(9),o=Math.max,i=Math.min;t.exports=function(t,n){return t=r(t),t<0?o(t+n,0):i(t,n)}},function(t,n,e){var r=e(37)("keys"),o=e(38);t.exports=function(t){return r[t]||(r[t]=o(t))}},function(t,n,e){var r=e(1),o=r["__core-js_shared__"]||(r["__core-js_shared__"]={});t.exports=function(t){return o[t]||(o[t]={})}},function(t,n){var e=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++e+r).toString(36))}},function(t,n){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,n){n.f=Object.getOwnPropertySymbols},function(t,n){n.f={}.propertyIsEnumerable},function(t,n,e){var r=e(8);t.exports=function(t){return Object(r(t))}},function(n,e){n.exports=t}]).default});

/***/ })

}]);