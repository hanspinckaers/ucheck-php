/* 
** Copyright (c) 2011 by Hans Pinckaers 
**
** This work is licensed under the Creative Commons 
** Attribution-NonCommercial-ShareAlike 3.0 Unported License. 
** To view a copy of this license, visit 
** http://creativecommons.org/licenses/by-nc-sa/3.0/ 
**
** ucheck-php: https://github.com/HansPinckaers/ucheck-php
** ucheck-node: https://github.com/HansPinckaers/ucheck-node
**
*/

(function(){this.MooTools={version:"1.3",build:"a3eed692dd85050d80168ec2c708efe901bb7db3"};var H=this.typeOf=function(a){if(a==null){return"null"}if(a.$family){return a.$family()}if(a.nodeName){if(a.nodeType==1){return"element"}if(a.nodeType==3){return(/\S/).test(a.nodeValue)?"textnode":"whitespace"}}else{if(typeof a.length=="number"){if(a.callee){return"arguments"}if("item" in a){return"collection"}}}return typeof a};var i=this.instanceOf=function(a,c){if(a==null){return false}var b=a.$constructor||a.constructor;while(b){if(b===c){return true}b=b.parent}return a instanceof c};var G=this.Function;var w=true;for(var x in {toString:1}){w=null}if(w){w=["hasOwnProperty","valueOf","isPrototypeOf","propertyIsEnumerable","toLocaleString","toString","constructor"]}G.prototype.overloadSetter=function(a){var b=this;return function(d,e){if(d==null){return this}if(a||typeof d!="string"){for(var c in d){b.call(this,c,d[c])}if(w){for(var f=w.length;f--;){c=w[f];if(d.hasOwnProperty(c)){b.call(this,c,d[c])}}}}else{b.call(this,d,e)}return this}};G.prototype.overloadGetter=function(a){var b=this;return function(d){var c,e;if(a||typeof d!="string"){c=d}else{if(arguments.length>1){c=arguments}}if(c){e={};for(var f=0;f<c.length;f++){e[c[f]]=b.call(this,c[f])}}else{e=b.call(this,d)}return e}};G.prototype.extend=function(b,a){this[b]=a}.overloadSetter();G.prototype.implement=function(b,a){this.prototype[b]=a}.overloadSetter();var z=Array.prototype.slice;G.from=function(a){return(H(a)=="function")?a:function(){return a}};Array.from=function(a){if(a==null){return[]}return(C.isEnumerable(a)&&typeof a!="string")?(H(a)=="array")?a:z.call(a):[a]};Number.from=function(a){var b=parseFloat(a);return isFinite(b)?b:null};String.from=function(a){return a+""};G.implement({hide:function(){this.$hidden=true;return this},protect:function(){this.$protected=true;return this}});var C=this.Type=function(a,b){if(a){var c=a.toLowerCase();var d=function(e){return(H(e)==c)};C["is"+a]=d;if(b!=null){b.prototype.$family=(function(){return c}).hide();b.type=d}}if(b==null){return null}b.extend(this);b.$constructor=C;b.prototype.$constructor=b;return b};var y=Object.prototype.toString;C.isEnumerable=function(a){return(a!=null&&typeof a.length=="number"&&y.call(a)!="[object Function]")};var K={};var I=function(b){var a=H(b.prototype);return K[a]||(K[a]=[])};var E=function(c,e){if(e&&e.$hidden){return this}var d=I(this);for(var b=0;b<d.length;b++){var f=d[b];if(H(f)=="type"){E.call(f,c,e)}else{f.call(this,c,e)}}var a=this.prototype[c];if(a==null||!a.$protected){this.prototype[c]=e}if(this[c]==null&&H(e)=="function"){u.call(this,c,function(g){return e.apply(g,z.call(arguments,1))})}return this};var u=function(c,a){if(a&&a.$hidden){return this}var b=this[c];if(b==null||!b.$protected){this[c]=a}return this};C.implement({implement:E.overloadSetter(),extend:u.overloadSetter(),alias:function(b,a){E.call(this,b,this.prototype[a])}.overloadSetter(),mirror:function(a){I(this).push(a);return this}});new C("Type",C);var J=function(k,f,h){var j=(f!=Object),b=f.prototype;if(j){f=new C(k,f)}for(var e=0,g=h.length;e<g;e++){var a=h[e],c=f[a],d=b[a];if(c){c.protect()}if(j&&d){delete b[a];b[a]=d.protect()}}if(j){f.implement(b)}return J};J("String",String,["charAt","charCodeAt","concat","indexOf","lastIndexOf","match","quote","replace","search","slice","split","substr","substring","toLowerCase","toUpperCase"])("Array",Array,["pop","push","reverse","shift","sort","splice","unshift","concat","join","slice","indexOf","lastIndexOf","filter","forEach","every","map","some","reduce","reduceRight"])("Number",Number,["toExponential","toFixed","toLocaleString","toPrecision"])("Function",G,["apply","call","bind"])("RegExp",RegExp,["exec","test"])("Object",Object,["create","defineProperty","defineProperties","keys","getPrototypeOf","getOwnPropertyDescriptor","getOwnPropertyNames","preventExtensions","isExtensible","seal","isSealed","freeze","isFrozen"])("Date",Date,["now"]);Object.extend=u.overloadSetter();Date.extend("now",function(){return +(new Date)});new C("Boolean",Boolean);Number.prototype.$family=function(){return isFinite(this)?"number":"null"}.hide();Number.extend("random",function(a,b){return Math.floor(Math.random()*(b-a+1)+a)});Object.extend("forEach",function(d,b,a){for(var c in d){if(d.hasOwnProperty(c)){b.call(a,d[c],c,d)}}});Object.each=Object.forEach;Array.implement({forEach:function(b,a){for(var c=0,d=this.length;c<d;c++){if(c in this){b.call(a,this[c],c,this)}}},each:function(b,a){Array.forEach(this,b,a);return this}});var v=function(a){switch(H(a)){case"array":return a.clone();case"object":return Object.clone(a);default:return a}};Array.implement("clone",function(){var b=this.length,a=new Array(b);while(b--){a[b]=v(this[b])}return a});var L=function(b,c,a){switch(H(a)){case"object":if(H(b[c])=="object"){Object.merge(b[c],a)}else{b[c]=Object.clone(a)}break;case"array":b[c]=a.clone();break;default:b[c]=a}return b};Object.extend({merge:function(g,b,c){if(H(b)=="string"){return L(g,b,c)}for(var a=1,d=arguments.length;a<d;a++){var f=arguments[a];for(var e in f){L(g,e,f[e])}}return g},clone:function(c){var a={};for(var b in c){a[b]=v(c[b])}return a},append:function(e){for(var a=1,c=arguments.length;a<c;a++){var d=arguments[a]||{};for(var b in d){e[b]=d[b]}}return e}});["Object","WhiteSpace","TextNode","Collection","Arguments"].each(function(a){new C(a)});var D=Date.now();String.extend("uniqueID",function(){return(D++).toString(36)});var F=this.Hash=new C("Hash",function(b){if(H(b)=="hash"){b=Object.clone(b.getClean())}for(var a in b){this[a]=b[a]}return this});F.implement({forEach:function(b,a){Object.forEach(this,b,a)},getClean:function(){var a={};for(var b in this){if(this.hasOwnProperty(b)){a[b]=this[b]}}return a},getLength:function(){var a=0;for(var b in this){if(this.hasOwnProperty(b)){a++}}return a}});F.alias("each","forEach");Object.type=C.isObject;var A=this.Native=function(a){return new C(a.name,a.initialize)};A.type=C.type;A.implement=function(a,c){for(var b=0;b<a.length;b++){a[b].implement(c)}return A};var B=Array.type;Array.type=function(a){return i(a,Array)||B(a)};this.$A=function(a){return Array.from(a).slice()};this.$arguments=function(a){return function(){return arguments[a]}};this.$chk=function(a){return !!(a||a===0)};this.$clear=function(a){clearTimeout(a);clearInterval(a);return null};this.$defined=function(a){return(a!=null)};this.$each=function(b,c,a){var d=H(b);((d=="arguments"||d=="collection"||d=="array"||d=="elements")?Array:Object).each(b,c,a)};this.$empty=function(){};this.$extend=function(a,b){return Object.append(a,b)};this.$H=function(a){return new F(a)};this.$merge=function(){var a=Array.slice(arguments);a.unshift({});return Object.merge.apply(null,a)};this.$lambda=G.from;this.$mixin=Object.merge;this.$random=Number.random;this.$splat=Array.from;this.$time=Date.now;this.$type=function(b){var a=H(b);if(a=="elements"){return"array"}return(a=="null")?false:a};this.$unlink=function(a){switch(H(a)){case"object":return Object.clone(a);case"array":return Array.clone(a);case"hash":return new F(a);default:return a}}})();Array.implement({invoke:function(d){var c=Array.slice(arguments,1);return this.map(function(a){return a[d].apply(a,c)})},every:function(h,g){for(var e=0,f=this.length;e<f;e++){if((e in this)&&!h.call(g,this[e],e,this)){return false}}return true},filter:function(i,h){var j=[];for(var f=0,g=this.length;f<g;f++){if((f in this)&&i.call(h,this[f],f,this)){j.push(this[f])}}return j},clean:function(){return this.filter(function(b){return b!=null})},indexOf:function(h,g){var f=this.length;for(var e=(g<0)?Math.max(0,f+g):g||0;e<f;e++){if(this[e]===h){return e}}return -1},map:function(i,h){var j=[];for(var f=0,g=this.length;f<g;f++){if(f in this){j[f]=i.call(h,this[f],f,this)}}return j},some:function(h,g){for(var e=0,f=this.length;e<f;e++){if((e in this)&&h.call(g,this[e],e,this)){return true}}return false},associate:function(h){var g={},e=Math.min(this.length,h.length);for(var f=0;f<e;f++){g[h[f]]=this[f]}return g},link:function(j){var g={};for(var h=0,f=this.length;h<f;h++){for(var i in j){if(j[i](this[h])){g[i]=this[h];delete j[i];break}}}return g},contains:function(d,c){return this.indexOf(d,c)!=-1},append:function(b){this.push.apply(this,b);return this},getLast:function(){return(this.length)?this[this.length-1]:null},getRandom:function(){return(this.length)?this[Number.random(0,this.length-1)]:null},include:function(b){if(!this.contains(b)){this.push(b)}return this},combine:function(f){for(var d=0,e=f.length;d<e;d++){this.include(f[d])}return this},erase:function(c){for(var d=this.length;d--;){if(this[d]===c){this.splice(d,1)}}return this},empty:function(){this.length=0;return this},flatten:function(){var g=[];for(var e=0,f=this.length;e<f;e++){var h=typeOf(this[e]);if(h=="null"){continue}g=g.concat((h=="array"||h=="collection"||h=="arguments"||instanceOf(this[e],Array))?Array.flatten(this[e]):this[e])}return g},pick:function(){for(var c=0,d=this.length;c<d;c++){if(this[c]!=null){return this[c]}}return null},hexToRgb:function(c){if(this.length!=3){return null}var d=this.map(function(a){if(a.length==1){a+=a}return a.toInt(16)});return(c)?d:"rgb("+d+")"},rgbToHex:function(g){if(this.length<3){return null}if(this.length==4&&this[3]==0&&!g){return"transparent"}var e=[];for(var f=0;f<3;f++){var h=(this[f]-0).toString(16);e.push((h.length==1)?"0"+h:h)}return(g)?e:"#"+e.join("")}});Array.alias("extend","append");var $pick=function(){return Array.from(arguments).pick()};String.implement({test:function(d,c){return((typeOf(d)=="regexp")?d:new RegExp(""+d,c)).test(this)},contains:function(d,c){return(c)?(c+this+c).indexOf(c+d+c)>-1:this.indexOf(d)>-1},trim:function(){return this.replace(/^\s+|\s+$/g,"")},clean:function(){return this.replace(/\s+/g," ").trim()},camelCase:function(){return this.replace(/-\D/g,function(b){return b.charAt(1).toUpperCase()})},hyphenate:function(){return this.replace(/[A-Z]/g,function(b){return("-"+b.charAt(0).toLowerCase())})},capitalize:function(){return this.replace(/\b[a-z]/g,function(b){return b.toUpperCase()})},escapeRegExp:function(){return this.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1")},toInt:function(b){return parseInt(this,b||10)},toFloat:function(){return parseFloat(this)},hexToRgb:function(c){var d=this.match(/^#?(\w{1,2})(\w{1,2})(\w{1,2})$/);return(d)?d.slice(1).hexToRgb(c):null},rgbToHex:function(c){var d=this.match(/\d{1,3}/g);return(d)?d.rgbToHex(c):null},substitute:function(d,c){return this.replace(c||(/\\?\{([^{}]+)\}/g),function(a,b){if(a.charAt(0)=="\\"){return a.slice(1)}return(d[b]!=null)?d[b]:""})}});Number.implement({limit:function(c,d){return Math.min(d,Math.max(c,this))},round:function(b){b=Math.pow(10,b||0).toFixed(b<0?-b:0);return Math.round(this*b)/b},times:function(d,f){for(var e=0;e<this;e++){d.call(f,e,this)}},toFloat:function(){return parseFloat(this)},toInt:function(b){return parseInt(this,b||10)}});Number.alias("each","times");(function(c){var d={};c.each(function(a){if(!Number[a]){d[a]=function(){return Math[a].apply(null,[this].concat(Array.from(arguments)))}}});Number.implement(d)})(["abs","acos","asin","atan","atan2","ceil","cos","exp","floor","log","max","min","pow","sin","sqrt","tan"]);Function.extend({attempt:function(){for(var d=0,e=arguments.length;d<e;d++){try{return arguments[d]()}catch(f){}}return null}});Function.implement({attempt:function(e,f){try{return this.apply(f,Array.from(e))}catch(d){}return null},bind:function(f){var e=this,d=(arguments.length>1)?Array.slice(arguments,1):null;return function(){if(!d&&!arguments.length){return e.call(f)}if(d&&arguments.length){return e.apply(f,d.concat(Array.from(arguments)))}return e.apply(f,d||arguments)}},pass:function(d,f){var e=this;if(d!=null){d=Array.from(d)}return function(){return e.apply(f,d||arguments)}},delay:function(d,f,e){return setTimeout(this.pass(e,f),d)},periodical:function(f,d,e){return setInterval(this.pass(e,d),f)}});delete Function.prototype.bind;Function.implement({create:function(c){var d=this;c=c||{};return function(b){var f=c.arguments;f=(f!=null)?Array.from(f):Array.slice(arguments,(c.event)?1:0);if(c.event){f=[b||window.event].extend(f)}var a=function(){return d.apply(c.bind||null,f)};if(c.delay){return setTimeout(a,c.delay)}if(c.periodical){return setInterval(a,c.periodical)}if(c.attempt){return Function.attempt(a)}return a()}},bind:function(f,d){var e=this;if(d!=null){d=Array.from(d)}return function(){return e.apply(f,d||arguments)}},bindWithEvent:function(f,d){var e=this;if(d!=null){d=Array.from(d)}return function(a){return e.apply(f,(d==null)?arguments:[a].concat(d))}},run:function(d,c){return this.apply(c,Array.from(d))}});var $try=Function.attempt;Object.extend({subset:function(l,i){var j={};for(var k=0,h=i.length;k<h;k++){var g=i[k];j[g]=l[g]}return j},map:function(g,i,h){var j={};for(var f in g){if(g.hasOwnProperty(f)){j[f]=i.call(h,g[f],f,g)}}return j},filter:function(f,h,g){var e={};Object.each(f,function(a,b){if(h.call(g,a,b,f)){e[b]=a}});return e},every:function(f,h,g){for(var e in f){if(f.hasOwnProperty(e)&&!h.call(g,f[e],e)){return false}}return true},some:function(f,h,g){for(var e in f){if(f.hasOwnProperty(e)&&h.call(g,f[e],e)){return true}}return false},keys:function(e){var f=[];for(var d in e){if(e.hasOwnProperty(d)){f.push(d)}}return f},values:function(d){var e=[];for(var f in d){if(d.hasOwnProperty(f)){e.push(d[f])}}return e},getLength:function(b){return Object.keys(b).length},keyOf:function(e,f){for(var d in e){if(e.hasOwnProperty(d)&&e[d]===f){return d}}return null},contains:function(d,c){return Object.keyOf(d,c)!=null},toQueryString:function(e,d){var f=[];Object.each(e,function(a,b){if(d){b=d+"["+b+"]"}var c;switch(typeOf(a)){case"object":c=Object.toQueryString(a,b);break;case"array":var h={};a.each(function(g,i){h[i]=g});c=Object.toQueryString(h,b);break;default:c=b+"="+encodeURIComponent(a)}if(a!=null){f.push(c)}});return f.join("&")}});Hash.implement({has:Object.prototype.hasOwnProperty,keyOf:function(b){return Object.keyOf(this,b)},hasValue:function(b){return Object.contains(this,b)},extend:function(b){Hash.each(b||{},function(d,a){Hash.set(this,a,d)},this);return this},combine:function(b){Hash.each(b||{},function(d,a){Hash.include(this,a,d)},this);return this},erase:function(b){if(this.hasOwnProperty(b)){delete this[b]}return this},get:function(b){return(this.hasOwnProperty(b))?this[b]:null},set:function(d,c){if(!this[d]||this.hasOwnProperty(d)){this[d]=c}return this},empty:function(){Hash.each(this,function(c,d){delete this[d]},this);return this},include:function(d,c){if(this[d]==null){this[d]=c}return this},map:function(d,c){return new Hash(Object.map(this,d,c))},filter:function(d,c){return new Hash(Object.filter(this,d,c))},every:function(d,c){return Object.every(this,d,c)},some:function(d,c){return Object.some(this,d,c)},getKeys:function(){return Object.keys(this)},getValues:function(){return Object.values(this)},toQueryString:function(b){return Object.toQueryString(this,b)}});Hash.extend=Object.append;Hash.alias({indexOf:"keyOf",contains:"hasValue"});(function(){var t=this.document;var v=t.window=this;var C=1;this.$uid=(v.ActiveXObject)?function(a){return(a.uid||(a.uid=[C++]))[0]}:function(a){return a.uid||(a.uid=C++)};$uid(v);$uid(t);var D=navigator.userAgent.toLowerCase(),B=navigator.platform.toLowerCase(),u=D.match(/(opera|ie|firefox|chrome|version)[\s\/:]([\w\d\.]+)?.*?(safari|version[\s\/:]([\w\d\.]+)|$)/)||[null,"unknown",0],y=u[1]=="ie"&&t.documentMode;var e=this.Browser={extend:Function.prototype.extend,name:(u[1]=="version")?u[3]:u[1],version:y||parseFloat((u[1]=="opera"&&u[4])?u[4]:u[2]),Platform:{name:D.match(/ip(?:ad|od|hone)/)?"ios":(D.match(/(?:webos|android)/)||B.match(/mac|win|linux/)||["other"])[0]},Features:{xpath:!!(t.evaluate),air:!!(v.runtime),query:!!(t.querySelector),json:!!(v.JSON)},Plugins:{}};e[e.name]=true;e[e.name+parseInt(e.version,10)]=true;e.Platform[e.Platform.name]=true;e.Request=(function(){var a=function(){return new XMLHttpRequest()};var b=function(){return new ActiveXObject("MSXML2.XMLHTTP")};var c=function(){return new ActiveXObject("Microsoft.XMLHTTP")};return Function.attempt(function(){a();return a},function(){b();return b},function(){c();return c})})();e.Features.xhr=!!(e.Request);var w=(Function.attempt(function(){return navigator.plugins["Shockwave Flash"].description},function(){return new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version")})||"0 r0").match(/\d+/g);e.Plugins.Flash={version:Number(w[0]||"0."+w[1])||0,build:Number(w[2])||0};e.exec=function(a){if(!a){return a}if(v.execScript){v.execScript(a)}else{var b=t.createElement("script");b.setAttribute("type","text/javascript");b.text=a;t.head.appendChild(b);t.head.removeChild(b)}return a};String.implement("stripScripts",function(b){var c="";var a=this.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi,function(f,d){c+=d+"\n";return""});if(b===true){e.exec(c)}else{if(typeOf(b)=="function"){b(c,a)}}return a});e.extend({Document:this.Document,Window:this.Window,Element:this.Element,Event:this.Event});this.Window=this.$constructor=new Type("Window",function(){});this.$family=Function.from("window").hide();Window.mirror(function(b,a){v[b]=a});this.Document=t.$constructor=new Type("Document",function(){});t.$family=Function.from("document").hide();Document.mirror(function(b,a){t[b]=a});t.html=t.documentElement;t.head=t.getElementsByTagName("head")[0];if(t.execCommand){try{t.execCommand("BackgroundImageCache",false,true)}catch(x){}}if(this.attachEvent&&!this.addEventListener){var A=function(){this.detachEvent("onunload",A);t.head=t.html=t.window=null};this.attachEvent("onunload",A)}var r=Array.from;try{r(t.html.childNodes)}catch(x){Array.from=function(b){if(typeof b!="string"&&Type.isEnumerable(b)&&typeOf(b)!="array"){var c=b.length,a=new Array(c);while(c--){a[c]=b[c]}return a}return r(b)};var s=Array.prototype,q=s.slice;["pop","push","reverse","shift","sort","splice","unshift","concat","join","slice"].each(function(b){var a=s[b];Array[b]=function(c){return a.apply(Array.from(c),q.call(arguments,1))}})}if(e.Platform.ios){e.Platform.ipod=true}e.Engine={};var z=function(a,b){e.Engine.name=a;e.Engine[a+b]=true;e.Engine.version=b};if(e.ie){e.Engine.trident=true;switch(e.version){case 6:z("trident",4);break;case 7:z("trident",5);break;case 8:z("trident",6)}}if(e.firefox){e.Engine.gecko=true;if(e.version>=3){z("gecko",19)}else{z("gecko",18)}}if(e.safari||e.chrome){e.Engine.webkit=true;switch(e.version){case 2:z("webkit",419);break;case 3:z("webkit",420);break;case 4:z("webkit",525)}}if(e.opera){e.Engine.presto=true;if(e.version>=9.6){z("presto",960)}else{if(e.version>=9.5){z("presto",950)}else{z("presto",925)}}}if(e.name=="unknown"){switch((D.match(/(?:webkit|khtml|gecko)/)||[])[0]){case"webkit":case"khtml":e.Engine.webkit=true;break;case"gecko":e.Engine.gecko=true}}this.$exec=e.exec})();var Event=new Type("Event",function(H,z){if(!z){z=window}var t=z.document;H=H||z.event;if(H.$extended){return H}this.$extended=true;var u=H.type,x=H.target||H.srcElement,v={},F={};while(x&&x.nodeType==3){x=x.parentNode}if(u.indexOf("key")!=-1){var G=H.which||H.keyCode;var r=Object.keyOf(Event.Keys,G);if(u=="keydown"){var E=G-111;if(E>0&&E<13){r="f"+E}}if(!r){r=String.fromCharCode(G).toLowerCase()}}else{if(u.test(/click|mouse|menu/i)){t=(!t.compatMode||t.compatMode=="CSS1Compat")?t.html:t.body;v={x:(H.pageX!=null)?H.pageX:H.clientX+t.scrollLeft,y:(H.pageY!=null)?H.pageY:H.clientY+t.scrollTop};F={x:(H.pageX!=null)?H.pageX-z.pageXOffset:H.clientX,y:(H.pageY!=null)?H.pageY-z.pageYOffset:H.clientY};if(u.test(/DOMMouseScroll|mousewheel/)){var w=(H.wheelDelta)?H.wheelDelta/120:-(H.detail||0)/3}var A=(H.which==3)||(H.button==2),s=null;if(u.test(/over|out/)){s=H.relatedTarget||H[(u=="mouseover"?"from":"to")+"Element"];var y=function(){while(s&&s.nodeType==3){s=s.parentNode}return true};var B=(Browser.firefox2)?y.attempt():y();s=(B)?s:null}}else{if(u.test(/gesture|touch/i)){this.rotation=H.rotation;this.scale=H.scale;this.targetTouches=H.targetTouches;this.changedTouches=H.changedTouches;var C=this.touches=H.touches;if(C&&C[0]){var D=C[0];v={x:D.pageX,y:D.pageY};F={x:D.clientX,y:D.clientY}}}}}return Object.append(this,{event:H,type:u,page:v,client:F,rightClick:A,wheel:w,relatedTarget:document.id(s),target:document.id(x),code:G,key:r,shift:H.shiftKey,control:H.ctrlKey,alt:H.altKey,meta:H.metaKey})});Event.Keys={enter:13,up:38,down:40,left:37,right:39,esc:27,space:32,backspace:8,tab:9,"delete":46};Event.Keys=new Hash(Event.Keys);Event.implement({stop:function(){return this.stopPropagation().preventDefault()},stopPropagation:function(){if(this.event.stopPropagation){this.event.stopPropagation()}else{this.event.cancelBubble=true}return this},preventDefault:function(){if(this.event.preventDefault){this.event.preventDefault()}else{this.event.returnValue=false}return this}});(function(){var h=this.Class=new Type("Class",function(a){if(instanceOf(a,Function)){a={initialize:a}}var b=function(){j(this);if(b.$prototyping){return this}this.$caller=null;var c=(this.initialize)?this.initialize.apply(this,arguments):this;this.$caller=this.caller=null;return c}.extend(this).implement(a);b.$constructor=h;b.prototype.$constructor=b;b.prototype.parent=l;return b});var l=function(){if(!this.$caller){throw new Error('The method "parent" cannot be called.')}var c=this.$caller.$name,b=this.$caller.$owner.parent,a=(b)?b.prototype[c]:null;if(!a){throw new Error('The method "'+c+'" has no parent.')}return a.apply(this,arguments)};var j=function(d){for(var c in d){var a=d[c];switch(typeOf(a)){case"object":var b=function(){};b.prototype=a;d[c]=j(new b);break;case"array":d[c]=a.clone();break}}return d};var g=function(d,c,a){if(a.$origin){a=a.$origin}var b=function(){if(a.$protected&&this.$caller==null){throw new Error('The method "'+c+'" cannot be called.')}var f=this.caller,e=this.$caller;this.caller=e;this.$caller=b;var n=a.apply(this,arguments);this.$caller=e;this.caller=f;return n}.extend({$owner:d,$origin:a,$name:c});return b};var i=function(b,a,c){if(h.Mutators.hasOwnProperty(b)){a=h.Mutators[b].call(this,a);if(a==null){return this}}if(typeOf(a)=="function"){if(a.$hidden){return this}this.prototype[b]=(c)?a:g(this,b,a)}else{Object.merge(this.prototype,b,a)}return this};var k=function(b){b.$prototyping=true;var a=new b;delete b.$prototyping;return a};h.implement("implement",i.overloadSetter());h.Mutators={Extends:function(a){this.parent=a;this.prototype=k(a)},Implements:function(a){Array.from(a).each(function(b){var d=new b;for(var c in d){i.call(this,c,d[c],true)}},this)}}})();(function(){this.Chain=new Class({$chain:[],chain:function(){this.$chain.append(Array.flatten(arguments));return this},callChain:function(){return(this.$chain.length)?this.$chain.shift().apply(this,arguments):false},clearChain:function(){this.$chain.empty();return this}});var b=function(a){return a.replace(/^on([A-Z])/,function(f,e){return e.toLowerCase()})};this.Events=new Class({$events:{},addEvent:function(e,f,a){e=b(e);if(f==$empty){return this}this.$events[e]=(this.$events[e]||[]).include(f);if(a){f.internal=true}return this},addEvents:function(a){for(var d in a){this.addEvent(d,a[d])}return this},fireEvent:function(f,h,a){f=b(f);var g=this.$events[f];if(!g){return this}h=Array.from(h);g.each(function(c){if(a){c.delay(a,this,h)}else{c.apply(this,h)}},this);return this},removeEvent:function(f,g){f=b(f);var h=this.$events[f];if(h&&!g.internal){var a=h.indexOf(g);if(a!=-1){delete h[a]}}return this},removeEvents:function(g){var f;if(typeOf(g)=="object"){for(f in g){this.removeEvent(f,g[f])}return this}if(g){g=b(g)}for(f in this.$events){if(g&&g!=f){continue}var h=this.$events[f];for(var a=h.length;a--;){this.removeEvent(f,h[a])}}return this}});this.Options=new Class({setOptions:function(){var a=this.options=Object.merge.apply(null,[{},this.options].append(arguments));if(!this.addEvent){return this}for(var d in a){if(typeOf(a[d])!="function"||!(/^on[A-Z]/).test(d)){continue}this.addEvent(d,a[d]);delete a[d]}return this}})})();(function(){var r,o,q,v,B={},z={},p=/\\/g;var x=function(a,b){if(a==null){return null}if(a.Slick===true){return a}a=(""+a).replace(/^\s+|\s+$/g,"");v=!!b;var c=(v)?z:B;if(c[a]){return c[a]}r={Slick:true,expressions:[],raw:a,reverse:function(){return x(this.raw,true)}};o=-1;while(a!=(a=a.replace(s,A))){}r.length=r.expressions.length;return c[a]=(v)?u(r):r};var t=function(a){if(a==="!"){return" "}else{if(a===" "){return"!"}else{if((/^!/).test(a)){return a.replace(/^!/,"")}else{return"!"+a}}}};var u=function(a){var d=a.expressions;for(var f=0;f<d.length;f++){var b=d[f];var e={parts:[],tag:"*",combinator:t(b[0].combinator)};for(var g=0;g<b.length;g++){var c=b[g];if(!c.reverseCombinator){c.reverseCombinator=" "}c.combinator=c.reverseCombinator;delete c.reverseCombinator}b.reverse().push(e)}return a};var w=function(a){return a.replace(/[-[\]{}()*+?.\\^$|,#\s]/g,"\\$&")};var s=new RegExp("^(?:\\s*(,)\\s*|\\s*(<combinator>+)\\s*|(\\s+)|(<unicode>+|\\*)|\\#(<unicode>+)|\\.(<unicode>+)|\\[\\s*(<unicode1>+)(?:\\s*([*^$!~|]?=)(?:\\s*(?:([\"']?)(.*?)\\9)))?\\s*\\](?!\\])|:+(<unicode>+)(?:\\((?:(?:([\"'])([^\\12]*)\\12)|((?:\\([^)]+\\)|[^()]*)+))\\))?)".replace(/<combinator>/,"["+w(">+~`!@$%^&={}\\;</")+"]").replace(/<unicode>/g,"(?:[\\w\\u00a1-\\uFFFF-]|\\\\[^\\s0-9a-f])").replace(/<unicode1>/g,"(?:[:\\w\\u00a1-\\uFFFF-]|\\\\[^\\s0-9a-f])"));function A(c,k,l,a,n,m,I,H,J,b,h,g,f,K,d){if(k||o===-1){r.expressions[++o]=[];q=-1;if(k){return""}}if(l||a||q===-1){l=l||" ";var j=r.expressions[o];if(v&&j[q]){j[q].reverseCombinator=t(l)}j[++q]={combinator:l,tag:"*"}}var L=r.expressions[o][q];if(n){L.tag=n.replace(p,"")}else{if(m){L.id=m.replace(p,"")}else{if(I){I=I.replace(p,"");if(!L.classList){L.classList=[]}if(!L.classes){L.classes=[]}L.classList.push(I);L.classes.push({value:I,regexp:new RegExp("(^|\\s)"+w(I)+"(\\s|$)")})}else{if(g){d=d||K;d=d?d.replace(p,""):null;if(!L.pseudos){L.pseudos=[]}L.pseudos.push({key:g.replace(p,""),value:d})}else{if(H){H=H.replace(p,"");h=(h||"").replace(p,"");var i,e;switch(J){case"^=":e=new RegExp("^"+w(h));break;case"$=":e=new RegExp(w(h)+"$");break;case"~=":e=new RegExp("(^|\\s)"+w(h)+"(\\s|$)");break;case"|=":e=new RegExp("^"+w(h)+"(-|$)");break;case"=":i=function(C){return h==C};break;case"*=":i=function(C){return C&&C.indexOf(h)>-1};break;case"!=":i=function(C){return h!=C};break;default:i=function(C){return !!C}}if(h==""&&(/^[*$^]=$/).test(J)){i=function(){return false}}if(!i){i=function(C){return C&&e.test(C)}}if(!L.attributes){L.attributes=[]}L.attributes.push({key:H,operator:J,value:h,test:i})}}}}}return""}var y=(this.Slick||{});y.parse=function(a){return x(a)};y.escapeRegExp=w;if(!this.Slick){this.Slick=y}}).apply((typeof exports!="undefined")?exports:this);(function(){var c={};c.isNativeCode=function(a){return(/\{\s*\[native code\]\s*\}/).test(""+a)};c.isXML=function(a){return(!!a.xmlVersion)||(!!a.xml)||(Object.prototype.toString.call(a)==="[object XMLDocument]")||(a.nodeType===9&&a.documentElement.nodeName!=="HTML")};c.setDocument=function(e){if(e.nodeType===9){}else{if(e.ownerDocument){e=e.ownerDocument}else{if(e.navigator){e=e.document}else{return}}}if(this.document===e){return}this.document=e;var d=this.root=e.documentElement;this.isXMLDocument=this.isXML(e);this.brokenStarGEBTN=this.starSelectsClosedQSA=this.idGetsName=this.brokenMixedCaseQSA=this.brokenGEBCN=this.brokenCheckedQSA=this.brokenEmptyAttributeQSA=this.isHTMLDocument=false;var s,r,b,h;var g,t;var a=e.createElement("div");d.appendChild(a);try{t="slick_getbyid_test";a.innerHTML='<a id="'+t+'"></a>';this.isHTMLDocument=!!e.getElementById(t)}catch(f){}if(this.isHTMLDocument){a.style.display="none";a.appendChild(e.createComment(""));r=(a.getElementsByTagName("*").length>0);try{a.innerHTML="foo</foo>";g=a.getElementsByTagName("*");s=(g&&g.length&&g[0].nodeName.charAt(0)=="/")}catch(f){}this.brokenStarGEBTN=r||s;if(a.querySelectorAll){try{a.innerHTML="foo</foo>";g=a.querySelectorAll("*");this.starSelectsClosedQSA=(g&&g.length&&g[0].nodeName.charAt(0)=="/")}catch(f){}}try{t="slick_id_gets_name";a.innerHTML='<a name="'+t+'"></a><b id="'+t+'"></b>';this.idGetsName=e.getElementById(t)===a.firstChild}catch(f){}try{a.innerHTML='<a class="MiXedCaSe"></a>';this.brokenMixedCaseQSA=!a.querySelectorAll(".MiXedCaSe").length}catch(f){}try{a.innerHTML='<a class="f"></a><a class="b"></a>';a.getElementsByClassName("b").length;a.firstChild.className="b";h=(a.getElementsByClassName("b").length!=2)}catch(f){}try{a.innerHTML='<a class="a"></a><a class="f b a"></a>';b=(a.getElementsByClassName("a").length!=2)}catch(f){}this.brokenGEBCN=h||b;try{a.innerHTML='<select><option selected="selected">a</option></select>';this.brokenCheckedQSA=(a.querySelectorAll(":checked").length==0)}catch(f){}try{a.innerHTML='<a class=""></a>';this.brokenEmptyAttributeQSA=(a.querySelectorAll('[class*=""]').length!=0)}catch(f){}}d.removeChild(a);a=null;this.hasAttribute=(d&&this.isNativeCode(d.hasAttribute))?function(o,p){return o.hasAttribute(p)}:function(o,p){o=o.getAttributeNode(p);return !!(o&&(o.specified||o.nodeValue))};this.contains=(d&&this.isNativeCode(d.contains))?function(p,o){return p.contains(o)}:(d&&d.compareDocumentPosition)?function(p,o){return p===o||!!(p.compareDocumentPosition(o)&16)}:function(p,o){if(o){do{if(o===p){return true}}while((o=o.parentNode))}return false};this.documentSorter=(d.compareDocumentPosition)?function(o,p){if(!o.compareDocumentPosition||!p.compareDocumentPosition){return 0}return o.compareDocumentPosition(p)&4?-1:o===p?0:1}:("sourceIndex" in d)?function(o,p){if(!o.sourceIndex||!p.sourceIndex){return 0}return o.sourceIndex-p.sourceIndex}:(e.createRange)?function(o,q){if(!o.ownerDocument||!q.ownerDocument){return 0}var p=o.ownerDocument.createRange(),v=q.ownerDocument.createRange();p.setStart(o,0);p.setEnd(o,0);v.setStart(q,0);v.setEnd(q,0);return p.compareBoundaryPoints(Range.START_TO_END,v)}:null;this.getUID=(this.isHTMLDocument)?this.getUIDHTML:this.getUIDXML};c.search=function(ac,g,O,X){var L=this.found=(X)?null:(O||[]);if(!ac){return L}if(ac.navigator){ac=ac.document}else{if(!ac.nodeType){return L}}var R,Q;var aa=this.uniques={};if(this.document!==(ac.ownerDocument||ac)){this.setDocument(ac)}var e=!!(O&&O.length);if(e){for(Q=L.length;Q--;){this.uniques[this.getUID(L[Q])]=true}}if(typeof g=="string"){for(Q=this.overrides.length;Q--;){var P=this.overrides[Q];if(P.regexp.test(g)){var N=P.method.call(ac,g,L,X);if(N===false){continue}if(N===true){return L}return N}}R=this.Slick.parse(g);if(!R.length){return L}}else{if(g==null){return L}else{if(g.Slick){R=g}else{if(this.contains(ac.documentElement||ac,g)){(L)?L.push(g):L=g;return L}else{return L}}}}this.posNTH={};this.posNTHLast={};this.posNTHType={};this.posNTHTypeLast={};this.push=(!e&&(X||(R.length==1&&R.expressions[0].length==1)))?this.pushArray:this.pushUID;if(L==null){L=[]}var T,W,Z;var V,a,b,d,M,S,Y;var U,ab,ad,h,f=R.expressions;search:for(Q=0;(ab=f[Q]);Q++){for(T=0;(ad=ab[T]);T++){V="combinator:"+ad.combinator;if(!this[V]){continue search}a=(this.isXMLDocument)?ad.tag:ad.tag.toUpperCase();b=ad.id;d=ad.classList;M=ad.classes;S=ad.attributes;Y=ad.pseudos;h=(T===(ab.length-1));this.bitUniques={};if(h){this.uniques=aa;this.found=L}else{this.uniques={};this.found=[]}if(T===0){this[V](ac,a,b,M,S,Y,d);if(X&&h&&L.length){break search}}else{if(X&&h){for(W=0,Z=U.length;W<Z;W++){this[V](U[W],a,b,M,S,Y,d);if(L.length){break search}}}else{for(W=0,Z=U.length;W<Z;W++){this[V](U[W],a,b,M,S,Y,d)}}}U=this.found}}if(e||(R.expressions.length>1)){this.sort(L)}return(X)?(L[0]||null):L};c.uidx=1;c.uidk="slick:uniqueid";c.getUIDXML=function(a){var b=a.getAttribute(this.uidk);if(!b){b=this.uidx++;a.setAttribute(this.uidk,b)}return b};c.getUIDHTML=function(a){return a.uniqueNumber||(a.uniqueNumber=this.uidx++)};c.sort=function(a){if(!this.documentSorter){return a}a.sort(this.documentSorter);return a};c.cacheNTH={};c.matchNTH=/^([+-]?\d*)?([a-z]+)?([+-]\d+)?$/;c.parseNTHArgument=function(a){var d=a.match(this.matchNTH);if(!d){return false}var b=d[2]||false;var e=d[1]||1;if(e=="-"){e=-1}var f=+d[3]||0;d=(b=="n")?{a:e,b:f}:(b=="odd")?{a:2,b:1}:(b=="even")?{a:2,b:0}:{a:0,b:e};return(this.cacheNTH[a]=d)};c.createNTHPseudo=function(a,d,e,b){return function(x,z){var h=this.getUID(x);if(!this[e][h]){var A=x.parentNode;if(!A){return false}var y=A[a],w=1;if(b){var B=x.nodeName;do{if(y.nodeName!==B){continue}this[e][this.getUID(y)]=w++}while((y=y[d]))}else{do{if(y.nodeType!==1){continue}this[e][this.getUID(y)]=w++}while((y=y[d]))}}z=z||"n";var g=this.cacheNTH[z]||this.parseNTHArgument(z);if(!g){return false}var C=g.a,D=g.b,f=this[e][h];if(C==0){return D==f}if(C>0){if(f<D){return false}}else{if(D<f){return false}}return((f-D)%C)==0}};c.pushArray=function(d,g,a,e,f,b){if(this.matchSelector(d,g,a,e,f,b)){this.found.push(d)}};c.pushUID=function(b,h,g,d,f,a){var e=this.getUID(b);if(!this.uniques[e]&&this.matchSelector(b,h,g,d,f,a)){this.uniques[e]=true;this.found.push(b)}};c.matchNode=function(h,g){var d=this.Slick.parse(g);if(!d){return true}if(d.length==1&&d.expressions[0].length==1){var f=d.expressions[0][0];return this.matchSelector(h,(this.isXMLDocument)?f.tag:f.tag.toUpperCase(),f.id,f.classes,f.attributes,f.pseudos)}var e=this.search(this.document,d);for(var b=0,a;a=e[b++];){if(a===h){return true}}return false};c.matchPseudo=function(a,f,b){var e="pseudo:"+f;if(this[e]){return this[e](a,b)}var d=this.getAttribute(a,f);return(b)?b==d:!!d};c.matchSelector=function(h,a,s,g,f,d){if(a){if(a=="*"){if(h.nodeName<"@"){return false}}else{if(h.nodeName!=a){return false}}}if(s&&h.getAttribute("id")!=s){return false}var e,r,b;if(g){for(e=g.length;e--;){b=("className" in h)?h.className:h.getAttribute("class");if(!(b&&g[e].regexp.test(b))){return false}}}if(f){for(e=f.length;e--;){r=f[e];if(r.operator?!r.test(this.getAttribute(h,r.key)):!this.hasAttribute(h,r.key)){return false}}}if(d){for(e=d.length;e--;){r=d[e];if(!this.matchPseudo(h,r.key,r.value)){return false}}}return true};var i={" ":function(h,a,u,g,f,d,s){var e,b,t;if(this.isHTMLDocument){getById:if(u){b=this.document.getElementById(u);if((!b&&h.all)||(this.idGetsName&&b&&b.getAttributeNode("id").nodeValue!=u)){t=h.all[u];if(!t){return}if(!t[0]){t=[t]}for(e=0;b=t[e++];){if(b.getAttributeNode("id").nodeValue==u){this.push(b,a,null,g,f,d);break}}return}if(!b){if(this.contains(this.document.documentElement,h)){return}else{break getById}}else{if(this.document!==h&&!this.contains(h,b)){return}}this.push(b,a,null,g,f,d);return}getByClass:if(g&&h.getElementsByClassName&&!this.brokenGEBCN){t=h.getElementsByClassName(s.join(" "));if(!(t&&t.length)){break getByClass}for(e=0;b=t[e++];){this.push(b,a,u,null,f,d)}return}}getByTag:{t=h.getElementsByTagName(a);if(!(t&&t.length)){break getByTag}if(!this.brokenStarGEBTN){a=null}for(e=0;b=t[e++];){this.push(b,a,u,g,f,d)}}},">":function(d,g,a,e,f,b){if((d=d.firstChild)){do{if(d.nodeType===1){this.push(d,g,a,e,f,b)}}while((d=d.nextSibling))}},"+":function(d,g,a,e,f,b){while((d=d.nextSibling)){if(d.nodeType===1){this.push(d,g,a,e,f,b);break}}},"^":function(d,g,a,e,f,b){d=d.firstChild;if(d){if(d.nodeType===1){this.push(d,g,a,e,f,b)}else{this["combinator:+"](d,g,a,e,f,b)}}},"~":function(b,h,g,d,f,a){while((b=b.nextSibling)){if(b.nodeType!==1){continue}var e=this.getUID(b);if(this.bitUniques[e]){break}this.bitUniques[e]=true;this.push(b,h,g,d,f,a)}},"++":function(d,g,a,e,f,b){this["combinator:+"](d,g,a,e,f,b);this["combinator:!+"](d,g,a,e,f,b)},"~~":function(d,g,a,e,f,b){this["combinator:~"](d,g,a,e,f,b);this["combinator:!~"](d,g,a,e,f,b)},"!":function(d,g,a,e,f,b){while((d=d.parentNode)){if(d!==this.document){this.push(d,g,a,e,f,b)}}},"!>":function(d,g,a,e,f,b){d=d.parentNode;if(d!==this.document){this.push(d,g,a,e,f,b)}},"!+":function(d,g,a,e,f,b){while((d=d.previousSibling)){if(d.nodeType===1){this.push(d,g,a,e,f,b);break}}},"!^":function(d,g,a,e,f,b){d=d.lastChild;if(d){if(d.nodeType===1){this.push(d,g,a,e,f,b)}else{this["combinator:!+"](d,g,a,e,f,b)}}},"!~":function(b,h,g,d,f,a){while((b=b.previousSibling)){if(b.nodeType!==1){continue}var e=this.getUID(b);if(this.bitUniques[e]){break}this.bitUniques[e]=true;this.push(b,h,g,d,f,a)}}};for(var j in i){c["combinator:"+j]=i[j]}var k={empty:function(b){var a=b.firstChild;return !(a&&a.nodeType==1)&&!(b.innerText||b.textContent||"").length},not:function(b,a){return !this.matchNode(b,a)},contains:function(b,a){return(b.innerText||b.textContent||"").indexOf(a)>-1},"first-child":function(a){while((a=a.previousSibling)){if(a.nodeType===1){return false}}return true},"last-child":function(a){while((a=a.nextSibling)){if(a.nodeType===1){return false}}return true},"only-child":function(a){var b=a;while((b=b.previousSibling)){if(b.nodeType===1){return false}}var d=a;while((d=d.nextSibling)){if(d.nodeType===1){return false}}return true},"nth-child":c.createNTHPseudo("firstChild","nextSibling","posNTH"),"nth-last-child":c.createNTHPseudo("lastChild","previousSibling","posNTHLast"),"nth-of-type":c.createNTHPseudo("firstChild","nextSibling","posNTHType",true),"nth-last-of-type":c.createNTHPseudo("lastChild","previousSibling","posNTHTypeLast",true),index:function(a,b){return this["pseudo:nth-child"](a,""+b+1)},even:function(a,b){return this["pseudo:nth-child"](a,"2n")},odd:function(a,b){return this["pseudo:nth-child"](a,"2n+1")},"first-of-type":function(b){var a=b.nodeName;while((b=b.previousSibling)){if(b.nodeName===a){return false}}return true},"last-of-type":function(b){var a=b.nodeName;while((b=b.nextSibling)){if(b.nodeName===a){return false}}return true},"only-of-type":function(b){var d=b,a=b.nodeName;while((d=d.previousSibling)){if(d.nodeName===a){return false}}var e=b;while((e=e.nextSibling)){if(e.nodeName===a){return false}}return true},enabled:function(a){return(a.disabled===false)},disabled:function(a){return(a.disabled===true)},checked:function(a){return a.checked||a.selected},focus:function(a){return this.isHTMLDocument&&this.document.activeElement===a&&(a.href||a.type||this.hasAttribute(a,"tabindex"))},root:function(a){return(a===this.root)},selected:function(a){return a.selected}};for(var n in k){c["pseudo:"+n]=k[n]}c.attributeGetters={"class":function(){return("className" in this)?this.className:this.getAttribute("class")},"for":function(){return("htmlFor" in this)?this.htmlFor:this.getAttribute("for")},href:function(){return("href" in this)?this.getAttribute("href",2):this.getAttribute("href")},style:function(){return(this.style)?this.style.cssText:this.getAttribute("style")}};c.getAttribute=function(b,e){var a=this.attributeGetters[e];if(a){return a.call(b)}var d=b.getAttributeNode(e);return d?d.nodeValue:null};c.overrides=[];c.override=function(b,a){this.overrides.push({regexp:b,method:a})};var l=/\[.*[*$^]=(?:["']{2})?\]/;c.override(/./,function(f,q,g){if(!this.querySelectorAll||this.nodeType!=9||!c.isHTMLDocument||c.brokenMixedCaseQSA||(c.brokenCheckedQSA&&f.indexOf(":checked")>-1)||(c.brokenEmptyAttributeQSA&&l.test(f))||m.disableQSA){return false}var e,a;try{if(g){return this.querySelector(f)||null}else{e=this.querySelectorAll(f)}}catch(d){return false}var b,h=!!(q.length);if(c.starSelectsClosedQSA){for(b=0;a=e[b++];){if(a.nodeName>"@"&&(!h||!c.uniques[c.getUIDHTML(a)])){q.push(a)}}}else{for(b=0;a=e[b++];){if(!h||!c.uniques[c.getUIDHTML(a)]){q.push(a)}}}if(h){c.sort(q)}return true});c.override(/^[\w-]+$|^\*$/,function(f,q,g){var e=f;if(e=="*"&&c.brokenStarGEBTN){return false}var d=this.getElementsByTagName(e);if(g){return d[0]||null}var b,a,h=!!(q.length);for(b=0;a=d[b++];){if(!h||!c.uniques[c.getUID(a)]){q.push(a)}}if(h){c.sort(q)}return true});c.override(/^\.[\w-]+$/,function(d,a,f){if(!c.isHTMLDocument||(!this.getElementsByClassName&&this.querySelectorAll)){return false}var s,h,g,r=!!(a&&a.length),b=d.substring(1);if(this.getElementsByClassName&&!c.brokenGEBCN){s=this.getElementsByClassName(b);if(f){return s[0]||null}for(g=0;h=s[g++];){if(!r||!c.uniques[c.getUIDHTML(h)]){a.push(h)}}}else{var e=new RegExp("(^|\\s)"+m.escapeRegExp(b)+"(\\s|$)");s=this.getElementsByTagName("*");for(g=0;h=s[g++];){b=h.className;if(!b||!e.test(b)){continue}if(f){return h}if(!r||!c.uniques[c.getUIDHTML(h)]){a.push(h)}}}if(r){c.sort(a)}return(f)?null:true});c.override(/^#[\w-]+$/,function(b,e,d){if(!c.isHTMLDocument||this.nodeType!=9){return false}var a=b.substring(1),f=this.getElementById(a);if(!f){return e}if(c.idGetsName&&f.getAttributeNode("id").nodeValue!=a){return false}if(d){return f||null}var g=!!(e.length);if(!g||!c.uniques[c.getUIDHTML(f)]){e.push(f)}if(g){c.sort(e)}return true});if(typeof document!="undefined"){c.setDocument(document)}var m=c.Slick=(this.Slick||{});m.version="0.9dev";m.search=function(b,a,d){return c.search(b,a,d)};m.find=function(b,a){return c.search(b,a,null,true)};m.contains=function(b,a){c.setDocument(b);return c.contains(b,a)};m.getAttribute=function(a,b){return c.getAttribute(a,b)};m.match=function(a,b){if(!(a&&b)){return false}if(!b||b===a){return true}if(typeof b!="string"){return false}c.setDocument(a);return c.matchNode(a,b)};m.defineAttributeGetter=function(b,a){c.attributeGetters[b]=a;return this};m.lookupAttributeGetter=function(a){return c.attributeGetters[a]};m.definePseudo=function(b,a){c["pseudo:"+b]=function(d,e){return a.call(d,e)};return this};m.lookupPseudo=function(b){var a=c["pseudo:"+b];if(a){return function(d){return a.call(this,d)}}return null};m.override=function(a,b){c.override(a,b);return this};m.isXML=c.isXML;m.uidOf=function(a){return c.getUIDHTML(a)};if(!this.Slick){this.Slick=m}}).apply((typeof exports!="undefined")?exports:this);var Element=function(i,l){var k=Element.Constructors[i];if(k){return k(l)}if(typeof i!="string"){return document.id(i).set(l)}if(!l){l={}}if(!i.test(/^[\w-]+$/)){var n=Slick.parse(i).expressions[0][0];i=(n.tag=="*")?"div":n.tag;if(n.id&&l.id==null){l.id=n.id}var o=n.attributes;if(o){for(var m=0,p=o.length;m<p;m++){var j=o[m];if(j.value!=null&&j.operator=="="&&l[j.key]==null){l[j.key]=j.value}}}if(n.classList&&l["class"]==null){l["class"]=n.classList.join(" ")}}return document.newElement(i,l)};if(Browser.Element){Element.prototype=Browser.Element.prototype}new Type("Element",Element).mirror(function(d){if(Array.prototype[d]){return}var c={};c[d]=function(){var b=[],l=arguments,a=true;for(var i=0,m=this.length;i<m;i++){var k=this[i],n=b[i]=k[d].apply(k,l);a=(a&&typeOf(n)=="element")}return(a)?new Elements(b):b};Elements.implement(c)});if(!Browser.Element){Element.parent=Object;Element.Prototype={"$family":Function.from("element").hide()};Element.mirror(function(d,c){Element.Prototype[d]=c})}Element.Constructors={};Element.Constructors=new Hash;var IFrame=new Type("IFrame",function(){var h=Array.link(arguments,{properties:Type.isObject,iframe:function(a){return(a!=null)}});var j=h.properties||{},f;if(h.iframe){f=document.id(h.iframe)}var i=j.onload||function(){};delete j.onload;j.id=j.name=[j.id,j.name,f?(f.id||f.name):"IFrame_"+String.uniqueID()].pick();f=new Element(f||"iframe",j);var g=function(){i.call(f.contentWindow)};if(window.frames[j.id]){g()}else{f.addListener("load",g)}return f});var Elements=this.Elements=function(g){if(g&&g.length){var h={},i;for(var j=0;i=g[j++];){var f=Slick.uidOf(i);if(!h[f]){h[f]=true;this.push(i)}}}};Elements.prototype={length:0};Elements.parent=Array;new Type("Elements",Elements).implement({filter:function(d,c){if(!d){return this}return new Elements(Array.filter(this,(typeOf(d)=="string")?function(a){return a.match(d)}:d,c))}.protect(),push:function(){var g=this.length;for(var e=0,f=arguments.length;e<f;e++){var h=document.id(arguments[e]);if(h){this[g++]=h}}return(this.length=g)}.protect(),concat:function(){var e=new Elements(this);for(var h=0,f=arguments.length;h<f;h++){var g=arguments[h];if(Type.isEnumerable(g)){e.append(g)}else{e.push(g)}}return e}.protect(),append:function(f){for(var d=0,e=f.length;d<e;d++){this.push(f[d])}return this}.protect(),empty:function(){while(this.length){delete this[--this.length]}return this}.protect()});(function(){var i=Array.prototype.splice,e={"0":0,"1":1,length:2};i.call(e,1,1);if(e[1]==1){Elements.implement("splice",function(){var a=this.length;i.apply(this,arguments);while(a>=this.length){delete this[a--]}return this}.protect())}Elements.implement(Array.prototype);Array.mirror(Elements);var j;try{var h=document.createElement("<input name=x>");j=(h.name=="x")}catch(l){}var k=function(a){return(""+a).replace(/&/g,"&amp;").replace(/"/g,"&quot;")};Document.implement({newElement:function(b,a){if(a&&a.checked!=null){a.defaultChecked=a.checked}if(j&&a){b="<"+b;if(a.name){b+=' name="'+k(a.name)+'"'}if(a.type){b+=' type="'+k(a.type)+'"'}b+=">";delete a.name;delete a.type}return this.id(this.createElement(b)).set(a)}})})();Document.implement({newTextNode:function(b){return this.createTextNode(b)},getDocument:function(){return this},getWindow:function(){return this.window},id:(function(){var b={string:function(e,f,a){e=Slick.find(a,"#"+e.replace(/(\W)/g,"\\$1"));return(e)?b.element(e,f):null},element:function(a,d){$uid(a);if(!d&&!a.$family&&!(/^object|embed$/i).test(a.tagName)){Object.append(a,Element.Prototype)}return a},object:function(f,e,a){if(f.toElement){return b.element(f.toElement(a),e)}return null}};b.textnode=b.whitespace=b.window=b.document=function(a){return a};return function(h,f,g){if(h&&h.$family&&h.uid){return h}var a=typeOf(h);return(b[a])?b[a](h,f,g||document):null}})()});if(window.$==null){Window.implement("$",function(d,c){return document.id(d,c,this.document)})}Window.implement({getDocument:function(){return this.document},getWindow:function(){return this}});[Document,Element].invoke("implement",{getElements:function(b){return Slick.search(this,b,new Elements)},getElement:function(b){return document.id(Slick.find(this,b))}});(function(f,i,g){this.Selectors={};var h=this.Selectors.Pseudo=new Hash();var j=function(){for(var a in h){if(h.hasOwnProperty(a)){Slick.definePseudo(a,h[a]);delete h[a]}}};Slick.search=function(b,a,c){j();return f.call(this,b,a,c)};Slick.find=function(b,a){j();return i.call(this,b,a)};Slick.match=function(a,b){j();return g.call(this,a,b)}})(Slick.search,Slick.find,Slick.match);if(window.$$==null){Window.implement("$$",function(h){var i=new Elements;if(arguments.length==1&&typeof h=="string"){return Slick.search(this.document,h,i)}var l=Array.flatten(arguments);for(var k=0,g=l.length;k<g;k++){var j=l[k];switch(typeOf(j)){case"element":i.push(j);break;case"string":Slick.search(this.document,j,i)}}return i})}if(window.$$==null){Window.implement("$$",function(b){if(arguments.length==1){if(typeof b=="string"){return Slick.search(this.document,b,new Elements)}else{if(Type.isEnumerable(b)){return new Elements(b)}}}return new Elements(arguments)})}(function(){var s={},u={};var q={input:"checked",option:"selected",textarea:"value"};var y=function(a){return(u[a]||(u[a]={}))};var t=function(a){if(a.removeEvents){a.removeEvents()}if(a.clearAttributes){a.clearAttributes()}var b=a.uid;if(b!=null){delete s[b];delete u[b]}return a};var o=["defaultValue","accessKey","cellPadding","cellSpacing","colSpan","frameBorder","maxLength","readOnly","rowSpan","tabIndex","useMap"];var z=["compact","nowrap","ismap","declare","noshade","checked","disabled","readOnly","multiple","selected","noresize","defer"];var w={html:"innerHTML","class":"className","for":"htmlFor",text:(function(){var a=document.createElement("div");return(a.innerText==null)?"textContent":"innerText"})()};var p=["type"];var v=["value","defaultValue"];var r=/^(?:href|src|usemap)$/i;z=z.associate(z);o=o.associate(o.map(String.toLowerCase));p=p.associate(p);Object.append(w,v.associate(v));var A={before:function(b,c){var a=c.parentNode;if(a){a.insertBefore(b,c)}},after:function(b,c){var a=c.parentNode;if(a){a.insertBefore(b,c.nextSibling)}},bottom:function(a,b){b.appendChild(a)},top:function(a,b){b.insertBefore(a,b.firstChild)}};A.inside=A.bottom;Object.each(A,function(b,a){a=a.capitalize();var c={};c["inject"+a]=function(d){b(this,document.id(d,true));return this};c["grab"+a]=function(d){b(document.id(d,true),this);return this};Element.implement(c)});var B=function(a,b){if(!a){return b}a=Slick.parse(a);var c=a.expressions;for(var d=c.length;d--;){c[d][0].combinator=b}return a};Element.implement({set:function(a,b){var c=Element.Properties[a];(c&&c.set)?c.set.call(this,b):this.setProperty(a,b)}.overloadSetter(),get:function(a){var b=Element.Properties[a];return(b&&b.get)?b.get.apply(this):this.getProperty(a)}.overloadGetter(),erase:function(a){var b=Element.Properties[a];(b&&b.erase)?b.erase.apply(this):this.removeProperty(a);return this},setProperty:function(b,a){b=o[b]||b;if(a==null){return this.removeProperty(b)}var c=w[b];(c)?this[c]=a:(z[b])?this[b]=!!a:this.setAttribute(b,""+a);return this},setProperties:function(b){for(var a in b){this.setProperty(a,b[a])}return this},getProperty:function(a){a=o[a]||a;var b=w[a]||p[a];return(b)?this[b]:(z[a])?!!this[a]:(r.test(a)?this.getAttribute(a,2):(b=this.getAttributeNode(a))?b.nodeValue:null)||null},getProperties:function(){var a=Array.from(arguments);return a.map(this.getProperty,this).associate(a)},removeProperty:function(a){a=o[a]||a;var b=w[a];(b)?this[b]="":(z[a])?this[a]=false:this.removeAttribute(a);return this},removeProperties:function(){Array.each(arguments,this.removeProperty,this);return this},hasClass:function(a){return this.className.clean().contains(a," ")},addClass:function(a){if(!this.hasClass(a)){this.className=(this.className+" "+a).clean()}return this},removeClass:function(a){this.className=this.className.replace(new RegExp("(^|\\s)"+a+"(?:\\s|$)"),"$1");return this},toggleClass:function(b,a){if(a==null){a=!this.hasClass(b)}return(a)?this.addClass(b):this.removeClass(b)},adopt:function(){var c=this,f,a=Array.flatten(arguments),b=a.length;if(b>1){c=f=document.createDocumentFragment()}for(var d=0;d<b;d++){var e=document.id(a[d],true);if(e){c.appendChild(e)}}if(f){this.appendChild(f)}return this},appendText:function(a,b){return this.grab(this.getDocument().newTextNode(a),b)},grab:function(a,b){A[b||"bottom"](document.id(a,true),this);return this},inject:function(a,b){A[b||"bottom"](this,document.id(a,true));return this},replaces:function(a){a=document.id(a,true);a.parentNode.replaceChild(this,a);return this},wraps:function(a,b){a=document.id(a,true);return this.replaces(a).grab(a,b)},getPrevious:function(a){return document.id(Slick.find(this,B(a,"!~")))},getAllPrevious:function(a){return Slick.search(this,B(a,"!~"),new Elements)},getNext:function(a){return document.id(Slick.find(this,B(a,"~")))},getAllNext:function(a){return Slick.search(this,B(a,"~"),new Elements)},getFirst:function(a){return document.id(Slick.search(this,B(a,">"))[0])},getLast:function(a){return document.id(Slick.search(this,B(a,">")).getLast())},getParent:function(a){return document.id(Slick.find(this,B(a,"!")))},getParents:function(a){return Slick.search(this,B(a,"!"),new Elements)},getSiblings:function(a){return Slick.search(this,B(a,"~~"),new Elements)},getChildren:function(a){return Slick.search(this,B(a,">"),new Elements)},getWindow:function(){return this.ownerDocument.window},getDocument:function(){return this.ownerDocument},getElementById:function(a){return document.id(Slick.find(this,"#"+(""+a).replace(/(\W)/g,"\\$1")))},getSelected:function(){this.selectedIndex;return new Elements(Array.from(this.options).filter(function(a){return a.selected}))},toQueryString:function(){var a=[];this.getElements("input, select, textarea").each(function(c){var d=c.type;if(!c.name||c.disabled||d=="submit"||d=="reset"||d=="file"||d=="image"){return}var b=(c.get("tag")=="select")?c.getSelected().map(function(e){return document.id(e).get("value")}):((d=="radio"||d=="checkbox")&&!c.checked)?null:c.get("value");Array.from(b).each(function(e){if(typeof e!="undefined"){a.push(encodeURIComponent(c.name)+"="+encodeURIComponent(e))}})});return a.join("&")},clone:function(a,c){a=a!==false;var g=this.cloneNode(a);var h=function(G,H){if(!c){G.removeAttribute("id")}if(Browser.ie){G.clearAttributes();G.mergeAttributes(H);G.removeAttribute("uid");if(G.options){var n=G.options,F=H.options;for(var l=n.length;l--;){n[l].selected=F[l].selected}}}var m=q[H.tagName.toLowerCase()];if(m&&H[m]){G[m]=H[m]}};var k;if(a){var d=g.getElementsByTagName("*"),b=this.getElementsByTagName("*");for(k=d.length;k--;){h(d[k],b[k])}}h(g,this);if(Browser.ie){var i=this.getElementsByTagName("object"),j=g.getElementsByTagName("object"),e=i.length,f=j.length;for(k=0;k<e&&k<f;k++){j[k].outerHTML=i[k].outerHTML}}return document.id(g)},destroy:function(){var a=t(this).getElementsByTagName("*");Array.each(a,t);Element.dispose(this);return null},empty:function(){Array.from(this.childNodes).each(Element.dispose);return this},dispose:function(){return(this.parentNode)?this.parentNode.removeChild(this):this},match:function(a){return !a||Slick.match(this,a)}});var x={contains:function(a){return Slick.contains(this,a)}};if(!document.contains){Document.implement(x)}if(!document.createElement("div").contains){Element.implement(x)}Element.implement("hasChild",function(a){return this!==a&&this.contains(a)});[Element,Window,Document].invoke("implement",{addListener:function(a,b){if(a=="unload"){var d=b,c=this;b=function(){c.removeListener("unload",b);d()}}else{s[this.uid]=this}if(this.addEventListener){this.addEventListener(a,b,false)}else{this.attachEvent("on"+a,b)}return this},removeListener:function(a,b){if(this.removeEventListener){this.removeEventListener(a,b,false)}else{this.detachEvent("on"+a,b)}return this},retrieve:function(c,d){var a=y(this.uid),b=a[c];if(d!=null&&b==null){b=a[c]=d}return b!=null?b:null},store:function(b,c){var a=y(this.uid);a[b]=c;return this},eliminate:function(b){var a=y(this.uid);delete a[b];return this}});if(window.attachEvent&&!window.addEventListener){window.addListener("unload",function(){Object.each(s,t);if(window.CollectGarbage){CollectGarbage()}})}})();Element.Properties={};Element.Properties=new Hash;Element.Properties.style={set:function(b){this.style.cssText=b},get:function(){return this.style.cssText},erase:function(){this.style.cssText=""}};Element.Properties.tag={get:function(){return this.tagName.toLowerCase()}};(function(b){if(b!=null){Element.Properties.maxlength=Element.Properties.maxLength={get:function(){var a=this.getAttribute("maxLength");return a==b?null:a}}}})(document.createElement("input").getAttribute("maxLength"));Element.Properties.html=(function(){var h=Function.attempt(function(){var a=document.createElement("table");a.innerHTML="<tr><td></td></tr>"});var g=document.createElement("div");var f={table:[1,"<table>","</table>"],select:[1,"<select>","</select>"],tbody:[2,"<table><tbody>","</tbody></table>"],tr:[3,"<table><tbody><tr>","</tr></tbody></table>"]};f.thead=f.tfoot=f.tbody;var e={set:function(){var c=Array.flatten(arguments).join("");var b=(!h&&f[this.get("tag")]);if(b){var a=g;a.innerHTML=b[1]+c+b[2];for(var d=b[0];d--;){a=a.firstChild}this.empty().adopt(a.childNodes)}else{this.innerHTML=c}}};e.erase=e.set;return e})();(function(){var j=document.html;Element.Properties.styles={set:function(a){this.setStyles(a)}};var h=(j.style.opacity!=null);var i=/alpha\(opacity=([\d.]+)\)/i;var f=function(b,c){if(!b.currentStyle||!b.currentStyle.hasLayout){b.style.zoom=1}if(h){b.style.opacity=c}else{c=(c==1)?"":"alpha(opacity="+c*100+")";var a=b.style.filter||b.getComputedStyle("filter")||"";b.style.filter=a.test(i)?a.replace(i,c):a+c}};Element.Properties.opacity={set:function(a){var b=this.style.visibility;if(a==0&&b!="hidden"){this.style.visibility="hidden"}else{if(a!=0&&b!="visible"){this.style.visibility="visible"}}f(this,a)},get:(h)?function(){var a=this.style.opacity||this.getComputedStyle("opacity");return(a=="")?1:a}:function(){var b,a=(this.style.filter||this.getComputedStyle("filter"));if(a){b=a.match(i)}return(b==null||a==null)?1:(b[1]/100)}};var g=(j.style.cssFloat==null)?"styleFloat":"cssFloat";Element.implement({getComputedStyle:function(a){if(this.currentStyle){return this.currentStyle[a.camelCase()]}var b=Element.getDocument(this).defaultView,c=b?b.getComputedStyle(this,null):null;return(c)?c.getPropertyValue((a==g)?"float":a.hyphenate()):null},setOpacity:function(a){f(this,a);return this},getOpacity:function(){return this.get("opacity")},setStyle:function(b,c){switch(b){case"opacity":return this.set("opacity",parseFloat(c));case"float":b=g}b=b.camelCase();if(typeOf(c)!="string"){var a=(Element.Styles[b]||"@").split(" ");c=Array.from(c).map(function(d,e){if(!a[e]){return""}return(typeOf(d)=="number")?a[e].replace("@",Math.round(d)):d}).join(" ")}else{if(c==String(Number(c))){c=Math.round(c)}}this.style[b]=c;return this},getStyle:function(a){switch(a){case"opacity":return this.get("opacity");case"float":a=g}a=a.camelCase();var n=this.style[a];if(!n||a=="zIndex"){n=[];for(var b in Element.ShortStyles){if(a!=b){continue}for(var c in Element.ShortStyles[b]){n.push(this.getStyle(c))}return n.join(" ")}n=this.getComputedStyle(a)}if(n){n=String(n);var e=n.match(/rgba?\([\d\s,]+\)/);if(e){n=n.replace(e[0],e[0].rgbToHex())}}if(Browser.opera||(Browser.ie&&isNaN(parseFloat(n)))){if(a.test(/^(height|width)$/)){var m=(a=="width")?["left","right"]:["top","bottom"],d=0;m.each(function(k){d+=this.getStyle("border-"+k+"-width").toInt()+this.getStyle("padding-"+k).toInt()},this);return this["offset"+a.capitalize()]-d+"px"}if(Browser.opera&&String(n).indexOf("px")!=-1){return n}if(a.test(/(border(.+)Width|margin|padding)/)){return"0px"}}return n},setStyles:function(a){for(var b in a){this.setStyle(b,a[b])}return this},getStyles:function(){var a={};Array.flatten(arguments).each(function(b){a[b]=this.getStyle(b)},this);return a}});Element.Styles={left:"@px",top:"@px",bottom:"@px",right:"@px",width:"@px",height:"@px",maxWidth:"@px",maxHeight:"@px",minWidth:"@px",minHeight:"@px",backgroundColor:"rgb(@, @, @)",backgroundPosition:"@px @px",color:"rgb(@, @, @)",fontSize:"@px",letterSpacing:"@px",lineHeight:"@px",clip:"rect(@px @px @px @px)",margin:"@px @px @px @px",padding:"@px @px @px @px",border:"@px @ rgb(@, @, @) @px @ rgb(@, @, @) @px @ rgb(@, @, @)",borderWidth:"@px @px @px @px",borderStyle:"@ @ @ @",borderColor:"rgb(@, @, @) rgb(@, @, @) rgb(@, @, @) rgb(@, @, @)",zIndex:"@",zoom:"@",fontWeight:"@",textIndent:"@px",opacity:"@"};Element.Styles=new Hash(Element.Styles);Element.ShortStyles={margin:{},padding:{},border:{},borderWidth:{},borderStyle:{},borderColor:{}};["Top","Right","Bottom","Left"].each(function(a){var b=Element.ShortStyles;var m=Element.Styles;["margin","padding"].each(function(k){var l=k+a;b[k][l]=m[l]="@px"});var c="border"+a;b.border[c]=m[c]="@px @ rgb(@, @, @)";var d=c+"Width",n=c+"Style",e=c+"Color";b[c]={};b.borderWidth[d]=b[c][d]=m[d]="@px";b.borderStyle[n]=b[c][n]=m[n]="@";b.borderColor[e]=b[c][e]=m[e]="rgb(@, @, @)"})})();(function(){Element.Properties.events={set:function(a){this.addEvents(a)}};[Element,Window,Document].invoke("implement",{addEvent:function(n,l){var b=this.retrieve("events",{});if(!b[n]){b[n]={keys:[],values:[]}}if(b[n].keys.contains(l)){return this}b[n].keys.push(l);var m=n,r=Element.Events[n],p=l,a=this;if(r){if(r.onAdd){r.onAdd.call(this,l)}if(r.condition){p=function(e){if(r.condition.call(this,e)){return l.call(this,e)}return true}}m=r.base||m}var o=function(){return l.call(a)};var q=Element.NativeEvents[m];if(q){if(q==2){o=function(e){e=new Event(e,a.getWindow());if(p.call(a,e)===false){e.stop()}}}this.addListener(m,o)}b[n].values.push(o);return this},removeEvent:function(k,l){var m=this.retrieve("events");if(!m||!m[k]){return this}var a=m[k];var n=a.keys.indexOf(l);if(n==-1){return this}var b=a.values[n];delete a.keys[n];delete a.values[n];var j=Element.Events[k];if(j){if(j.onRemove){j.onRemove.call(this,l)}k=j.base||k}return(Element.NativeEvents[k])?this.removeListener(k,b):this},addEvents:function(b){for(var a in b){this.addEvent(a,b[a])}return this},removeEvents:function(f){var a;if(typeOf(f)=="object"){for(a in f){this.removeEvent(a,f[a])}return this}var b=this.retrieve("events");if(!b){return this}if(!f){for(a in b){this.removeEvents(a)}this.eliminate("events")}else{if(b[f]){b[f].keys.each(function(e){this.removeEvent(f,e)},this);delete b[f]}}return this},fireEvent:function(a,g,h){var b=this.retrieve("events");if(!b||!b[a]){return this}g=Array.from(g);b[a].keys.each(function(e){if(h){e.delay(h,this,g)}else{e.apply(this,g)}},this);return this},cloneEvents:function(a,b){a=document.id(a);var g=a.retrieve("events");if(!g){return this}if(!b){for(var h in g){this.cloneEvents(a,h)}}else{if(g[b]){g[b].keys.each(function(e){this.addEvent(b,e)},this)}}return this}});try{if(typeof HTMLElement!="undefined"){HTMLElement.prototype.fireEvent=Element.prototype.fireEvent}}catch(c){}Element.NativeEvents={click:2,dblclick:2,mouseup:2,mousedown:2,contextmenu:2,mousewheel:2,DOMMouseScroll:2,mouseover:2,mouseout:2,mousemove:2,selectstart:2,selectend:2,keydown:2,keypress:2,keyup:2,orientationchange:2,touchstart:2,touchmove:2,touchend:2,touchcancel:2,gesturestart:2,gesturechange:2,gestureend:2,focus:2,blur:2,change:2,reset:2,select:2,submit:2,load:2,unload:1,beforeunload:2,resize:1,move:1,DOMContentLoaded:1,readystatechange:1,error:1,abort:1,scroll:1};var d=function(b){var a=b.relatedTarget;if(a==null){return true}if(!a){return false}return(a!=this&&a.prefix!="xul"&&typeOf(this)!="document"&&!this.contains(a))};Element.Events={mouseenter:{base:"mouseover",condition:d},mouseleave:{base:"mouseout",condition:d},mousewheel:{base:(Browser.firefox)?"DOMMouseScroll":"mousewheel"}};Element.Events=new Hash(Element.Events)})();(function(){Element.implement({scrollTo:function(b,a){if(h(this)){this.getWindow().scrollTo(b,a)}else{this.scrollLeft=b;this.scrollTop=a}return this},getSize:function(){if(h(this)){return this.getWindow().getSize()}return{x:this.offsetWidth,y:this.offsetHeight}},getScrollSize:function(){if(h(this)){return this.getWindow().getScrollSize()}return{x:this.scrollWidth,y:this.scrollHeight}},getScroll:function(){if(h(this)){return this.getWindow().getScroll()}return{x:this.scrollLeft,y:this.scrollTop}},getScrolls:function(){var a=this.parentNode,b={x:0,y:0};while(a&&!h(a)){b.x+=a.scrollLeft;b.y+=a.scrollTop;a=a.parentNode}return b},getOffsetParent:function(){var a=this;if(h(a)){return null}if(!Browser.ie){return a.offsetParent}while((a=a.parentNode)){if(m(a,"position")!="static"||h(a)){return a}}return null},getOffsets:function(){if(this.getBoundingClientRect&&!Browser.Platform.ios){var a=this.getBoundingClientRect(),d=document.id(this.getDocument().documentElement),b=d.getScroll(),g=this.getScrolls(),p=(m(this,"position")=="fixed");return{x:a.left.toInt()+g.x+((p)?0:b.x)-d.clientLeft,y:a.top.toInt()+g.y+((p)?0:b.y)-d.clientTop}}var e=this,f={x:0,y:0};if(h(this)){return f}while(e&&!h(e)){f.x+=e.offsetLeft;f.y+=e.offsetTop;if(Browser.firefox){if(!k(e)){f.x+=n(e);f.y+=j(e)}var c=e.parentNode;if(c&&m(c,"overflow")!="visible"){f.x+=n(c);f.y+=j(c)}}else{if(e!=this&&Browser.safari){f.x+=n(e);f.y+=j(e)}}e=e.offsetParent}if(Browser.firefox&&!k(this)){f.x-=n(this);f.y-=j(this)}return f},getPosition:function(b){if(h(this)){return{x:0,y:0}}var a=this.getOffsets(),d=this.getScrolls();var e={x:a.x-d.x,y:a.y-d.y};if(b&&(b=document.id(b))){var c=b.getPosition();return{x:e.x-c.x-n(b),y:e.y-c.y-j(b)}}return e},getCoordinates:function(b){if(h(this)){return this.getWindow().getCoordinates()}var d=this.getPosition(b),c=this.getSize();var a={left:d.x,top:d.y,width:c.x,height:c.y};a.right=a.left+a.width;a.bottom=a.top+a.height;return a},computePosition:function(a){return{left:a.x-l(this,"margin-left"),top:a.y-l(this,"margin-top")}},setPosition:function(a){return this.setStyles(this.computePosition(a))}});[Document,Window].invoke("implement",{getSize:function(){var a=i(this);return{x:a.clientWidth,y:a.clientHeight}},getScroll:function(){var a=this.getWindow(),b=i(this);return{x:a.pageXOffset||b.scrollLeft,y:a.pageYOffset||b.scrollTop}},getScrollSize:function(){var a=i(this),b=this.getSize(),c=this.getDocument().body;return{x:Math.max(a.scrollWidth,c.scrollWidth,b.x),y:Math.max(a.scrollHeight,c.scrollHeight,b.y)}},getPosition:function(){return{x:0,y:0}},getCoordinates:function(){var a=this.getSize();return{top:0,left:0,bottom:a.y,right:a.x,height:a.y,width:a.x}}});var m=Element.getComputedStyle;function l(b,a){return m(b,a).toInt()||0}function k(a){return m(a,"-moz-box-sizing")=="border-box"}function j(a){return l(a,"border-top-width")}function n(a){return l(a,"border-left-width")}function h(a){return(/^(?:body|html)$/i).test(a.tagName)}function i(b){var a=b.getDocument();return(!a.compatMode||a.compatMode=="CSS1Compat")?a.html:a.body}})();Element.alias({position:"setPosition"});[Window,Document,Element].invoke("implement",{getHeight:function(){return this.getSize().y},getWidth:function(){return this.getSize().x},getScrollTop:function(){return this.getScroll().y},getScrollLeft:function(){return this.getScroll().x},getScrollHeight:function(){return this.getScrollSize().y},getScrollWidth:function(){return this.getScrollSize().x},getTop:function(){return this.getPosition().y},getLeft:function(){return this.getPosition().x}});(function(){var j=this.Fx=new Class({Implements:[Chain,Events,Options],options:{fps:50,unit:false,duration:500,link:"ignore"},initialize:function(a){this.subject=this.subject||this;this.setOptions(a)},getTransition:function(){return function(a){return -(Math.cos(Math.PI*a)-1)/2}},step:function(){var b=Date.now();if(b<this.time+this.options.duration){var a=this.transition((b-this.time)/this.options.duration);this.set(this.compute(this.from,this.to,a))}else{this.set(this.compute(this.from,this.to,1));this.complete()}},set:function(a){return a},compute:function(a,b,c){return j.compute(a,b,c)},check:function(){if(!this.timer){return true}switch(this.options.link){case"cancel":this.cancel();return true;case"chain":this.chain(this.caller.pass(arguments,this));return false}return false},start:function(a,b){if(!this.check(a,b)){return this}var c=this.options.duration;this.options.duration=j.Durations[c]||c.toInt();this.from=a;this.to=b;this.time=0;this.transition=this.getTransition();this.startTimer();this.onStart();return this},complete:function(){if(this.stopTimer()){this.onComplete()}return this},cancel:function(){if(this.stopTimer()){this.onCancel()}return this},onStart:function(){this.fireEvent("start",this.subject)},onComplete:function(){this.fireEvent("complete",this.subject);if(!this.callChain()){this.fireEvent("chainComplete",this.subject)}},onCancel:function(){this.fireEvent("cancel",this.subject).clearChain()},pause:function(){this.stopTimer();return this},resume:function(){this.startTimer();return this},stopTimer:function(){if(!this.timer){return false}this.time=Date.now()-this.time;this.timer=i(this);return true},startTimer:function(){if(this.timer){return false}this.time=Date.now()-this.time;this.timer=g(this);return true}});j.compute=function(a,b,c){return(b-a)*c+a};j.Durations={"short":250,normal:500,"long":1000};var k={},l={};var h=function(){for(var a=this.length;a--;){if(this[a]){this[a].step()}}};var g=function(c){var a=c.options.fps,b=k[a]||(k[a]=[]);b.push(c);if(!l[a]){l[a]=h.periodical(Math.round(1000/a),b)}return true};var i=function(c){var a=c.options.fps,b=k[a]||[];b.erase(c);if(!b.length&&l[a]){l[a]=clearInterval(l[a])}return false}})();Fx.CSS=new Class({Extends:Fx,prepare:function(h,g,e){e=Array.from(e);if(e[1]==null){e[1]=e[0];e[0]=h.getStyle(g)}var f=e.map(this.parse);return{from:f[0],to:f[1]}},parse:function(b){b=Function.from(b)();b=(typeof b=="string")?b.split(" "):Array.from(b);return b.map(function(d){d=String(d);var a=false;Object.each(Fx.CSS.Parsers,function(c,g){if(a){return}var h=c.parse(d);if(h||h===0){a={value:h,parser:c}}});a=a||{value:d,parser:Fx.CSS.Parsers.String};return a})},compute:function(g,h,e){var f=[];(Math.min(g.length,h.length)).times(function(a){f.push({value:g[a].parser.compute(g[a].value,h[a].value,e),parser:g[a].parser})});f.$family=Function.from("fx:css:value");return f},serve:function(f,d){if(typeOf(f)!="fx:css:value"){f=this.parse(f)}var e=[];f.each(function(a){e=e.concat(a.parser.serve(a.value,d))});return e},render:function(f,g,h,e){f.setStyle(g,this.serve(h,e))},search:function(d){if(Fx.CSS.Cache[d]){return Fx.CSS.Cache[d]}var c={};Array.each(document.styleSheets,function(b,g){var h=b.href;if(h&&h.contains("://")&&!h.contains(document.domain)){return}var a=b.rules||b.cssRules;Array.each(a,function(e,i){if(!e.style){return}var f=(e.selectorText)?e.selectorText.replace(/^\w+/,function(j){return j.toLowerCase()}):null;if(!f||!f.test("^"+d+"$")){return}Element.Styles.each(function(j,l){if(!e.style[l]||Element.ShortStyles[l]){return}j=String(e.style[l]);c[l]=(j.test(/^rgb/))?j.rgbToHex():j})})});return Fx.CSS.Cache[d]=c}});Fx.CSS.Cache={};Fx.CSS.Parsers={Color:{parse:function(b){if(b.match(/^#[0-9a-f]{3,6}$/i)){return b.hexToRgb(true)}return((b=b.match(/(\d+),\s*(\d+),\s*(\d+)/)))?[b[1],b[2],b[3]]:false},compute:function(f,d,e){return f.map(function(a,b){return Math.round(Fx.compute(f[b],d[b],e))})},serve:function(b){return b.map(Number)}},Number:{parse:parseFloat,compute:Fx.compute,serve:function(c,d){return(d)?c+d:c}},String:{parse:Function.from(false),compute:function(c,d){return d},serve:function(b){return b}}};Fx.CSS.Parsers=new Hash(Fx.CSS.Parsers);Fx.Tween=new Class({Extends:Fx.CSS,initialize:function(c,d){this.element=this.subject=document.id(c);this.parent(d)},set:function(c,d){if(arguments.length==1){d=c;c=this.property||this.options.property}this.render(this.element,c,d,this.options.unit);return this},start:function(j,h,i){if(!this.check(j,h,i)){return this}var f=Array.flatten(arguments);this.property=this.options.property||f.shift();var g=this.prepare(this.element,this.property,f);return this.parent(g.from,g.to)}});Element.Properties.tween={set:function(b){this.get("tween").cancel().setOptions(b);return this},get:function(){var b=this.retrieve("tween");if(!b){b=new Fx.Tween(this,{link:"cancel"});this.store("tween",b)}return b}};Element.implement({tween:function(e,f,d){this.get("tween").start(arguments);return this},fade:function(j){var h=this.get("tween"),i="opacity",g;j=[j,"toggle"].pick();switch(j){case"in":h.start(i,1);break;case"out":h.start(i,0);break;case"show":h.set(i,1);break;case"hide":h.set(i,0);break;case"toggle":var f=this.retrieve("fade:flag",this.get("opacity")==1);h.start(i,(f)?0:1);this.store("fade:flag",!f);g=true;break;default:h.start(i,arguments)}if(!g){this.eliminate("fade:flag")}return this},highlight:function(f,e){if(!e){e=this.retrieve("highlight:original",this.getStyle("background-color"));e=(e=="transparent")?"#fff":e}var d=this.get("tween");d.start("background-color",f||"#ffff88",e).chain(function(){this.setStyle("background-color",this.retrieve("highlight:original"));d.callChain()}.bind(this));return this}});Fx.Morph=new Class({Extends:Fx.CSS,initialize:function(c,d){this.element=this.subject=document.id(c);this.parent(d)},set:function(d){if(typeof d=="string"){d=this.search(d)}for(var c in d){this.render(this.element,c,d[c],this.options.unit)}return this},compute:function(h,i,j){var g={};for(var f in h){g[f]=this.parent(h[f],i[f],j)}return g},start:function(f){if(!this.check(f)){return this}if(typeof f=="string"){f=this.search(f)}var h={},i={};for(var j in f){var g=this.prepare(this.element,j,f[j]);h[j]=g.from;i[j]=g.to}return this.parent(h,i)}});Element.Properties.morph={set:function(b){this.get("morph").cancel().setOptions(b);return this},get:function(){var b=this.retrieve("morph");if(!b){b=new Fx.Morph(this,{link:"cancel"});this.store("morph",b)}return b}};Element.implement({morph:function(b){this.get("morph").start(b);return this}});Fx.implement({getTransition:function(){var d=this.options.transition||Fx.Transitions.Sine.easeInOut;if(typeof d=="string"){var c=d.split(":");d=Fx.Transitions;d=d[c[0]]||d[c[0].capitalize()];if(c[1]){d=d["ease"+c[1].capitalize()+(c[2]?c[2].capitalize():"")]}}return d}});Fx.Transition=function(c,d){d=Array.from(d);return Object.append(c,{easeIn:function(a){return c(a,d)},easeOut:function(a){return 1-c(1-a,d)},easeInOut:function(a){return(a<=0.5)?c(2*a,d)/2:(2-c(2*(1-a),d))/2}})};Fx.Transitions={linear:function(b){return b}};Fx.Transitions=new Hash(Fx.Transitions);Fx.Transitions.extend=function(d){for(var c in d){Fx.Transitions[c]=new Fx.Transition(d[c])}};Fx.Transitions.extend({Pow:function(c,d){return Math.pow(c,d&&d[0]||6)},Expo:function(b){return Math.pow(2,8*(b-1))},Circ:function(b){return 1-Math.sin(Math.acos(b))},Sine:function(b){return 1-Math.sin((1-b)*Math.PI/2)},Back:function(c,d){d=d&&d[0]||1.618;return Math.pow(c,2)*((d+1)*c-d)},Bounce:function(a){var b;for(var g=0,h=1;1;g+=h,h/=2){if(a>=(7-4*g)/11){b=h*h-Math.pow((11-6*g-11*a)/4,2);break}}return b},Elastic:function(c,d){return Math.pow(2,10*--c)*Math.cos(20*c*Math.PI*(d&&d[0]||1)/3)}});["Quad","Cubic","Quart","Quint"].each(function(c,d){Fx.Transitions[c]=new Fx.Transition(function(a){return Math.pow(a,[d+2])})});(function(){var e=("onprogress" in new Browser.Request);var f=this.Request=new Class({Implements:[Chain,Events,Options],options:{url:"",data:"",headers:{"X-Requested-With":"XMLHttpRequest",Accept:"text/javascript, text/html, application/xml, text/xml, */*"},async:true,format:false,method:"post",link:"ignore",isSuccess:null,emulation:true,urlEncoded:true,encoding:"utf-8",evalScripts:false,evalResponse:false,timeout:0,noCache:false},initialize:function(a){this.xhr=new Browser.Request();this.setOptions(a);this.headers=this.options.headers},onStateChange:function(){var a=this.xhr;if(a.readyState!=4||!this.running){return}this.running=false;this.status=0;Function.attempt(function(){var b=a.status;this.status=(b==1223)?204:b}.bind(this));a.onreadystatechange=function(){};clearTimeout(this.timer);this.response={text:this.xhr.responseText||"",xml:this.xhr.responseXML};if(this.options.isSuccess.call(this,this.status)){this.success(this.response.text,this.response.xml)}else{this.failure()}},isSuccess:function(){var a=this.status;return(a>=200&&a<300)},isRunning:function(){return !!this.running},processScripts:function(a){if(this.options.evalResponse||(/(ecma|java)script/).test(this.getHeader("Content-type"))){return Browser.exec(a)}return a.stripScripts(this.options.evalScripts)},success:function(a,b){this.onSuccess(this.processScripts(a),b)},onSuccess:function(){this.fireEvent("complete",arguments).fireEvent("success",arguments).callChain()},failure:function(){this.onFailure()},onFailure:function(){this.fireEvent("complete").fireEvent("failure",this.xhr)},loadstart:function(a){this.fireEvent("loadstart",[a,this.xhr])},progress:function(a){this.fireEvent("progress",[a,this.xhr])},timeout:function(){this.fireEvent("timeout",this.xhr)},setHeader:function(b,a){this.headers[b]=a;return this},getHeader:function(a){return Function.attempt(function(){return this.xhr.getResponseHeader(a)}.bind(this))},check:function(){if(!this.running){return true}switch(this.options.link){case"cancel":this.cancel();return true;case"chain":this.chain(this.caller.pass(arguments,this));return false}return false},send:function(a){if(!this.check(a)){return this}this.options.isSuccess=this.options.isSuccess||this.isSuccess;this.running=true;var o=typeOf(a);if(o=="string"||o=="element"){a={data:a}}var s=this.options;a=Object.append({data:s.data,url:s.url,method:s.method},a);var q=a.data,u=String(a.url),v=a.method.toLowerCase();switch(typeOf(q)){case"element":q=document.id(q).toQueryString();break;case"object":case"hash":q=Object.toQueryString(q)}if(this.options.format){var c="format="+this.options.format;q=(q)?c+"&"+q:c}if(this.options.emulation&&!["get","post"].contains(v)){var p="_method="+v;q=(q)?p+"&"+q:p;v="post"}if(this.options.urlEncoded&&["post","put"].contains(v)){var t=(this.options.encoding)?"; charset="+this.options.encoding:"";this.headers["Content-type"]="application/x-www-form-urlencoded"+t}if(!u){u=document.location.pathname}var r=u.lastIndexOf("/");if(r>-1&&(r=u.indexOf("#"))>-1){u=u.substr(0,r)}if(this.options.noCache){u+=(u.contains("?")?"&":"?")+String.uniqueID()}if(q&&v=="get"){u+=(u.contains("?")?"&":"?")+q;q=null}var b=this.xhr;if(e){b.onloadstart=this.loadstart.bind(this);b.onprogress=this.progress.bind(this)}b.open(v.toUpperCase(),u,this.options.async,this.options.user,this.options.password);if(this.options.user&&"withCredentials" in b){b.withCredentials=true}b.onreadystatechange=this.onStateChange.bind(this);Object.each(this.headers,function(h,i){try{b.setRequestHeader(i,h)}catch(g){this.fireEvent("exception",[i,h])}},this);this.fireEvent("request");b.send(q);if(!this.options.async){this.onStateChange()}if(this.options.timeout){this.timer=this.timeout.delay(this.options.timeout,this)}return this},cancel:function(){if(!this.running){return this}this.running=false;var a=this.xhr;a.abort();clearTimeout(this.timer);a.onreadystatechange=a.onprogress=a.onloadstart=function(){};this.xhr=new Browser.Request();this.fireEvent("cancel");return this}});var d={};["get","post","put","delete","GET","POST","PUT","DELETE"].each(function(a){d[a]=function(b){return this.send({data:b,method:a})}});f.implement(d);Element.Properties.send={set:function(b){var a=this.get("send").cancel();a.setOptions(b);return this},get:function(){var a=this.retrieve("send");if(!a){a=new f({data:this,link:"cancel",method:this.get("method")||"post",url:this.get("action")});this.store("send",a)}return a}};Element.implement({send:function(b){var a=this.get("send");a.send({data:this,url:b||a.options.url});return this}})})();Request.HTML=new Class({Extends:Request,options:{update:false,append:false,evalScripts:true,filter:false,headers:{Accept:"text/html, application/xml, text/xml, */*"}},success:function(h){var i=this.options,f=this.response;f.html=h.stripScripts(function(a){f.javascript=a});var j=f.html.match(/<body[^>]*>([\s\S]*?)<\/body>/i);if(j){f.html=j[1]}var g=new Element("div").set("html",f.html);f.tree=g.childNodes;f.elements=g.getElements("*");if(i.filter){f.tree=f.elements.filter(i.filter)}if(i.update){document.id(i.update).empty().set("html",f.html)}else{if(i.append){document.id(i.append).adopt(g.getChildren())}}if(i.evalScripts){Browser.exec(f.javascript)}this.onSuccess(f.tree,f.elements,f.html,f.javascript)}});Element.Properties.load={set:function(d){var c=this.get("load").cancel();c.setOptions(d);return this},get:function(){var b=this.retrieve("load");if(!b){b=new Request.HTML({data:this,link:"cancel",update:this,method:"get"});this.store("load",b)}return b}};Element.implement({load:function(){this.get("load").send(Array.link(arguments,{data:Type.isObject,url:Type.isString}));return this}});if(!this.JSON){this.JSON={}}JSON=new Hash({stringify:JSON.stringify,parse:JSON.parse});Object.append(JSON,{$specialChars:{"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},$replaceChars:function(b){return JSON.$specialChars[b]||"\\u00"+Math.floor(b.charCodeAt()/16).toString(16)+(b.charCodeAt()%16).toString(16)},encode:function(c){switch(typeOf(c)){case"string":return'"'+c.replace(/[\x00-\x1f\\"]/g,JSON.$replaceChars)+'"';case"array":return"["+String(c.map(JSON.encode).clean())+"]";case"object":case"hash":var d=[];Object.each(c,function(a,b){var f=JSON.encode(a);if(f){d.push(JSON.encode(b)+":"+f)}});return"{"+d+"}";case"number":case"boolean":return String(c);case"null":return"null"}return null},decode:function(string,secure){if(typeOf(string)!="string"||!string.length){return null}if(secure&&!(/^[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]*$/).test(string.replace(/\\./g,"@").replace(/"[^"\\\n\r]*"/g,""))){return null}return eval("("+string+")")}});Request.JSON=new Class({Extends:Request,options:{secure:true},initialize:function(b){this.parent(b);Object.append(this.headers,{Accept:"application/json","X-Request":"JSON"})},success:function(f){var d=this.options.secure;var e=this.response.json=Function.attempt(function(){return JSON.decode(f,d)});if(e==null){this.onFailure()}else{this.onSuccess(e,f)}}});var Cookie=new Class({Implements:Options,options:{path:"/",domain:false,duration:false,secure:false,document:document,encode:true},initialize:function(c,d){this.key=c;this.setOptions(d)},write:function(c){if(this.options.encode){c=encodeURIComponent(c)}if(this.options.domain){c+="; domain="+this.options.domain}if(this.options.path){c+="; path="+this.options.path}if(this.options.duration){var d=new Date();d.setTime(d.getTime()+this.options.duration*24*60*60*1000);c+="; expires="+d.toGMTString()}if(this.options.secure){c+="; secure"}this.options.document.cookie=this.key+"="+c;return this},read:function(){var b=this.options.document.cookie.match("(?:^|;)\\s*"+this.key.escapeRegExp()+"=([^;]*)");return(b)?decodeURIComponent(b[1]):null},dispose:function(){new Cookie(this.key,Object.merge({},this.options,{duration:-1})).write("");return this}});Cookie.write=function(d,f,e){return new Cookie(d,e).write(f)};Cookie.read=function(b){return new Cookie(b).read()};Cookie.dispose=function(c,d){return new Cookie(c,d).dispose()};(function(r,p){var o,u,v=[],x,y,e=true;try{e=r.frameElement!=null}catch(s){}var t=function(){clearTimeout(y);if(o){return}Browser.loaded=o=true;p.removeListener("DOMContentLoaded",t).removeListener("readystatechange",z);p.fireEvent("domready");r.fireEvent("domready")};var z=function(){for(var a=v.length;a--;){if(v[a]()){t();return true}}return false};var q=function(){clearTimeout(y);if(!z()){y=setTimeout(q,10)}};p.addListener("DOMContentLoaded",t);var w=p.createElement("div");if(w.doScroll&&!e){v.push(function(){try{w.doScroll();return true}catch(a){}return false});x=true}if(p.readyState){v.push(function(){var a=p.readyState;return(a=="loaded"||a=="complete")})}if("onreadystatechange" in p){p.addListener("readystatechange",z)}else{x=true}if(x){q()}Element.Events.domready={onAdd:function(a){if(o){a.call(this)}}};Element.Events.load={base:"load",onAdd:function(a){if(u&&this==r){a.call(this)}},condition:function(){if(this==r){t();delete Element.Events.load}return true}};r.addEvent("load",function(){u=true})})(window,document);(function(){var id=0;var Swiff=this.Swiff=new Class({Implements:Options,options:{id:null,height:1,width:1,container:null,properties:{},params:{quality:"high",allowScriptAccess:"always",wMode:"window",swLiveConnect:true},callBacks:{},vars:{}},toElement:function(){return this.object},initialize:function(path,options){this.instance="Swiff_"+id++;this.setOptions(options);options=this.options;var id=this.id=options.id||this.instance;var container=document.id(options.container);Swiff.CallBacks[this.instance]={};var params=options.params,vars=options.vars,callBacks=options.callBacks;var properties=Object.append({height:options.height,width:options.width},options.properties);var self=this;for(var callBack in callBacks){Swiff.CallBacks[this.instance][callBack]=(function(option){return function(){return option.apply(self.object,arguments)}})(callBacks[callBack]);vars[callBack]="Swiff.CallBacks."+this.instance+"."+callBack}params.flashVars=Object.toQueryString(vars);if(Browser.ie){properties.classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000";params.movie=path}else{properties.type="application/x-shockwave-flash"}properties.data=path;var build='<object id="'+id+'"';for(var property in properties){build+=" "+property+'="'+properties[property]+'"'}build+=">";for(var param in params){if(params[param]){build+='<param name="'+param+'" value="'+params[param]+'" />'}}build+="</object>";this.object=((container)?container.empty():new Element("div")).set("html",build).firstChild},replaces:function(element){element=document.id(element,true);element.parentNode.replaceChild(this.toElement(),element);return this},inject:function(element){document.id(element,true).appendChild(this.toElement());return this},remote:function(){return Swiff.remote.apply(Swiff,[this.toElement()].extend(arguments))}});Swiff.CallBacks={};Swiff.remote=function(obj,fn){var rs=obj.CallFunction('<invoke name="'+fn+'" returntype="javascript">'+__flash__argumentsToXML(arguments,2)+"</invoke>");return eval(rs)}})();

function getDocHeight() {
    var D = document;
    return Math.max(
        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
        Math.max(D.body.clientHeight, D.documentElement.clientHeight)
    );
}

function getDocWidth() {
    var D = document;
    return Math.max(
        Math.max(D.body.scrollWidth, D.documentElement.scrollWidth),
        Math.max(D.body.offsetWidth, D.documentElement.offsetWidth),
        Math.max(D.body.clientWidth, D.documentElement.clientWidth)
    );
}

var cijfersIndexesPerStudie = {};
var cijfersTrs = [];

var inschrijvingenIndexesPerStudie = {};
var inschrijvingenTrs = [];

var studies = [];
var year = "11";

var inschrijvenLoopbanen = [];
var inschrijvenPerLoopbaan = {};
var inschrijven = [];

var loopbaanSelected = "Alles";

var studieSelected = "Alles";

function display_voortgang(id)
{
	var el = $("hidden_"+id);
	
	if (el.getStyle('display') == 'none')
	{
	el.setStyle('display', 'block');
	} else {
	el.setStyle('display', 'none');	
	}
}

function check_filter(id)
{
	if(id=="cijfers")
	{
		cijfersTrs = $$("#" + id + " tr");
		 
		cijfersTrs.each(function (value, index){
			var studie = value.get("rel");
			
			if(studie)
			{
				if(!studies.contains(studie))
				{
					studies.push(studie);
				}
								
				if(!cijfersIndexesPerStudie[studie])
				{
					cijfersIndexesPerStudie[studie] = [];
				}
				
				cijfersIndexesPerStudie[studie].push(index);
			}
			
			
		}.bind(this));
		
	} else {
	
		inschrijvingenTrs = $$("#" + id + " tr");
				 
		inschrijvingenTrs.each(function (value, index){
			var studie = value.get("rel");
			
			if(studie)
			{
				if(!studies.contains(studie))
				{
					studies.push(studie);
				}
				
				if(!inschrijvingenIndexesPerStudie[studie])
				{
					inschrijvingenIndexesPerStudie[studie] = [];
				}
				
				inschrijvingenIndexesPerStudie[studie].push(index);
			}
			
			
		}.bind(this));
	

	}
	
	build_filter();
}

function build_filter()
{
	
	if(studies.length == 1)
	{
		$('filter_studies').setStyle("display", "none");
	} else {
		$('filter_studies').setStyle("display", "");
	}
	
	var filter_studies = $('filter_studies_keuze');
	var filter_inschrijven = $('eigen_studies_keuze');
	
	filter_studies.empty();
	filter_inschrijven.empty();
	
	var allesEl = new Element("a", 
	{
	    html: "Alles",
	    href: "#!",
	    'class': 'selectable'
	});
	
	allesEl.addEvent('click', function(){
		filter('Alles');
	});
	
	if(studieSelected == "Alles")
	{
		allesEl.addClass('selected');
	}
	
	allesEl.inject(filter_studies);
	
	studies.each(function (value, index){
	
		filter_studies.appendText(' | ');
		if(index != 0) filter_inschrijven.appendText(' | ');
		
		var el = new Element("a", 
		{
		    html: value,
		    href: "#!",
		    id: value,
		    'class': 'selectable'
		});
		
		el.addEvent('click', function()
		{
			filter(value);
		});
		
		if(studieSelected == value)
		{
			el.addClass('selected');
		}
		
		el.inject(filter_studies);
		
		var el2 = el.clone();
		el2.removeEvents("click");
				
		el2.addEvent("click", function(){
			laadstudie(value, year);		
		});
		
		el2.inject(filter_inschrijven);
	});

}

function filter(studie)
{
	var filter = $$('#filter_studies_keuze a');
	
	filter.each(function(value, index){
		if(value.get("html") == studie)
		{
			value.addClass('selected');
		} else {
			value.removeClass('selected');
		}
	})


	//console.log(inschrijvingenIndexesPerStudie);
	//console.log(cijfersIndexesPerStudie);

	studieSelected = studie;
	
	Object.each(cijfersIndexesPerStudie, function(value, index)
	{
		if(index != studie && studie != "Alles")
		{
		
			value.each(function(value, index){
				cijfersTrs[value].addClass('hidden');

				cijfersTrs[value].removeClass('shown');
			});		
		
		} else {
		
			value.each(function(value, index){
				cijfersTrs[value].removeClass('hidden');
				
				cijfersTrs[value].addClass('shown');
				
			});	
		}
	});
		
	Object.each(inschrijvingenIndexesPerStudie, function(value, index)
	{
		if(index != studie && studie != "Alles")
		{
		
			value.each(function(value, index){
				inschrijvingenTrs[value].addClass('hidden');				
				inschrijvingenTrs[value].removeClass('shown');	
				
			});		
		
		} else {
		
			value.each(function(value, index){
				inschrijvingenTrs[value].removeClass('hidden');	
				inschrijvingenTrs[value].addClass('shown');				
			
			});	
		}
	});
}

function filter_loopbanen(loopbaan)
{
	var filter = $$('#loopbaan_keuze a');
	
	filter.each(function(value, index){
		if(value.get("html") == loopbaan)
		{
			value.addClass('selected');
		} else {
			value.removeClass('selected');
		}
	});

	loopbaanSelected = loopbaan;

	Object.each(inschrijvenPerLoopbaan, function(value, index)
	{
		if(index != loopbaan && loopbaan != "Alles")
		{
		
			value.each(function(value, index){
				inschrijven[value].addClass('hidden');

				inschrijven[value].removeClass('shown');
			});		
		
		} else {
		
			value.each(function(value, index){
				inschrijven[value].removeClass('hidden');
				
				inschrijven[value].addClass('shown');
				
			});	
		}
	});
	

}

function laadstudie(value, yr)
{
	if(value){
		$("studies").value = value;
	}
	
	if(!yr)
	{
		yr = year;
	}
		
    if ($("studies").value && $("studies").value != "")
    {
        //$("loading").setStyle("display", "block");        
        $("studies").setAttribute("disabled", true);
        $("onderdelen").setStyle("opacity", 0.5);
                
        var a = new Request(
        {
            url: "vakken.php",
            method: "get",
            onSuccess: function (b, c)
            {
                $("onderdelen").set("html", b);
                
                //$("loading").setStyle("display", "none");
                
                $("studies").removeAttribute("disabled");
                
                $("onderdelen").setStyle("opacity", 1);
                
                searchTags = new LLSearch(
                {
                    inputID: "input_filter_zoek",
                    listID: "onderdelen",
                    listType: "tr",
                    searchTerm: "title"
                });
                
                inschrijvenLoopbanen = [];
				inschrijvenPerLoopbaan = {};
				inschrijven = [];
					
                $$("#inschrijven td.loopbaan").each(function(value, index){
                	
                	var loopbaan = value.get("text");
                	
                	//console.log(loopbaan);
                	
                	if(!inschrijvenLoopbanen.contains(loopbaan))
                	{
                		inschrijvenLoopbanen.push(loopbaan);
                		
                		if(!inschrijvenPerLoopbaan[loopbaan])
                		{
	                		inschrijvenPerLoopbaan[loopbaan] = [];
                		}
                	}
                	
					inschrijvenPerLoopbaan[loopbaan].push(index);

					inschrijven.push(value.getParent()); 
  				});

                
                var filter = $('loopbaan_keuze');
				filter.empty();
			
    					
				var allesEl = new Element("a", 
				{
				    html: "Alles",
				    href: "#!",
				    'class': 'selectable selected'
				});
				
				allesEl.addEvent("click", function()
				{
					filter_loopbanen('Alles');
				});
				
				if(studieSelected == "Alles")
				{
					allesEl.addClass('selected');
				}
				
				allesEl.inject(filter);
				
				inschrijvenLoopbanen.each(function (value, index){
				
					filter.appendText(' | ');					
					
					var el = new Element("a", 
					{
					    html: value,
					    href: "#!",
					    id: value,
					    'class': 'selectable'
					});
					
					el.addEvent("click", function()
					{
						filter_loopbanen(value);
					});
					
					if(studieSelected == value)
					{
						el.addClass('selected');
					}
					
					el.inject(filter);
                	
                	$("background").setStyle("height", getDocHeight());
                	$("background").setStyle("width", getDocWidth());
                	
                	
                });
                
                //$("search_rows").setStyle("display", "block")
            }
            
            
        }).send("q=" + $("studies").value + "&year="+yr)
        
        //console.log(year);
    }
}

function display_inschrijven()
{
	$('inschrijven').setStyle('display', 'block');
		
	var b = $('inschrijven');
	
	$("popup").setStyle("display", "block");
	b.inject($('popup'));
	
	$("background").setStyle("display", "block");
	$("popup").setStyle("top", window.getScroll().y + 25);
	
	$("sluiten_help").setStyle("top", window.getScroll().y + 25);
	$("sluiten_help").setStyle("display", "block");
	
	laadstudie(studies[0], year);
		
	$("background").setStyle("display", "block");
	
	$("sluiten_help").setStyle("top", window.getScroll().y + 25);
	$("sluiten_help").setStyle("display", "block");
	
	$("background").setStyle("position", "absolute");
	$("background").setStyle("height", getDocHeight());
	$("background").setStyle("width", getDocWidth());
}

function display_detail(el, id)
{
	if($("detail_"+id)) return;
	
		
	//console.log(id);
    
    var tr = new Element("tr", {
    });

	var td = new Element("td", {
		html: "Detail laden, 10 seconden <img src='ajax-loader.gif' class='loading' />",
		colspan : "5",
		id : "detail_"+id,
		styles: {
			"margin-top" : "1em", //zorgt voor lelijke animatie!
			"text-align" : "left",
			"border-top" : "1px #efefef solid",
			"border-bottom" : "1px #efefef solid",
			"background-color" : "#f5f5f5",
			"padding-bottom": "1.5em",
			width : "670px"
		}
	});
        
    td.inject(tr);
        
    //console.log($(el).getChildren());   
    $(el).getChildren()[4].set("html","<span> </span>");
    
    tr.inject($(el), "after");
        
    //td.tween('height','100px');
    
    $(el).getChildren()[0].setStyle("padding-bottom", "0px");
    
    var a = new Request(
    {
        url: "details.php",
        method: "get",
        onSuccess: function (d, e)
        {
            $("detail_"+id).set("html", d);
            
            //td.setStyle('height','auto');
            
            $("background").setStyle("height", getDocHeight());
            $("background").setStyle("width", getDocWidth());
            
        }
        

    }).send("q=" + id + "&year="+year);
}

function load_year(yr)
{
	var filter = $$('#filter_year_keuze a');
	
	filter.each(function(value, index){
		if(value.get("rel") == yr)
		{
			value.addClass('selected');
		} else {
			value.removeClass('selected');
		}
	})
	
	var filter2 = $$('#filter_year_keuze_inschrijven a');
	
	filter2.each(function(value, index){
		if(value.get("rel") == yr)
		{
			value.addClass('selected');
		} else {
			value.removeClass('selected');
		}
	})

	year = yr;

	$("inschrijvingen").set('html', $("inschrijvingen_laden").get("html"));
	
	var myRequest = new Request({url: 'full_inschrijvingen.php?year='+yr, evalScripts:true, method: 'get', onSuccess: function(responseText, responseXML) {
		$("inschrijvingen").set('html',responseText);	
		
		check_filter("inschrijvingen");
		
	}}).send();
	
	
}

function load_year_and_studie(yr)
{
	var filter = $$('#filter_year_keuze_inschrijven a');
	
	filter.each(function(value, index){
		if(value.get("rel") == yr)
		{
			value.addClass('selected');
		} else {
			value.removeClass('selected');
		}
	})

	year = yr;

	load_year(year);
	
	laadstudie($("studies").value,year);
}


function display(a)
{
    var b = $(a);
    
    $("popup").setStyle("display", "block");
    $("popup").set("html", b.innerHTML);
    $("background").setStyle("display", "block");
    $("popup").setStyle("top", window.getScroll().y + 25);
    
    $("sluiten_help").setStyle("top", window.getScroll().y + 25);
    $("sluiten_help").setStyle("display", "block");
    
    $("background").setStyle("position", "absolute");
    $("background").setStyle("height", getDocHeight());
    $("background").setStyle("width", getDocWidth());
   //$("studies").setStyle("visibility", "hidden");
}

function hide()
{

	//console.log($('inschrijven').getStyle("display"));

	if($('inschrijven').getStyle("display") == "block")
	{
		$('inschrijven').setStyle('display', 'none');
		$('inschrijven').inject($(document.body));
		
		//console.log($(document.body));
		
	}

    $("popup").setStyle("display", "none");
        $("sluiten_help").setStyle("display", "none");
    
    $("popup").set("html", "");
    $("background").setStyle("display", "none");

    
}

function displayUitschrijven()
{
    var d = new Array;
    var g = new Element("div", {});
    var e = new Element("h1", {
        html: "Uitschrijven?"
    });
    
    e.inject(g);
    
    var b = new Element("table", {
        border: "0",
        cellspacing: "0",
        cellpadding: "0"
    });
    
    var a = false;
    
        $$("#inschrijvingen colgroup").each(function(value, index){
		if(index == 0){
    		value.clone().inject(b);
		}
    })

    
    $$("#inschrijvingen tr").each(function (k, i)
    {
        if (i == 0)
        {
            k.clone().inject(b)
        }
        var h = k.getElement("input");
        if (h && h.checked)
        {
            var j = $(h.getParent("tr")).clone();
            j.inject(b);
            a = true
        }
    });
    
    
    if (!a)
    {
        return
    }

    var f = new Element("a", {
        html: "Uitschrijven",
        href: "#!",
        onclick: "uitschrijven()",
        "class": "uitschrijven_link",
        styles: {
            "position": "relative",
            "top" : "7px",
            "height":  "3em"
        }
    });

    b.inject(g);
    f.inject(g);
    display(g);
    
    $("popup").getElements("input").each(function (h)
    {
        h.setStyle("display", "none");
        h.checked = true;
    })
}

function uitschrijven()
{
    var string = "";
    $$("#popup tr").each(function (el, index)
    {
        var input = el.getElement("input");
        if (input && input.checked)
        {
            string += input.name + ","
        }
    });
    var image = new Element("img", {
        src: "ajax-loader.gif",
        styles: {
            top: "6px",
            position: "relative"
        }
    });
    var text = new Element("span", {
        html: "Uitschrijven +/- 5 secondes",
        styles: {
            display: "block",
            "position": "relative",
            "top" : "0.5em"
        }
    });
    
    $$("#popup tr input").destroy();
    $$("#popup a").destroy();
    
    image.inject(text);
    text.inject("popup");
    
    var jsonRequest = new Request(
    {
        url: "uitschrijven.php",
        method: "get",
        onSuccess: function (responseText)
        {
            var myObject = eval("(" + responseText + ")");
            var arr = $A(myObject.respons);
            $$("#popup tr").each(function (ele, index)
            {
                if (index != 0)
                {
                    var el = ele.getChildren("td")[1];
                    var html = "";
                    if (typeOf(arr) == "array")
                    {
                        html = el.get("html") + "<br /><br />" + arr[index - 1]
                    }
                    else
                    {
                        html = el.get("html") + "<br /><br />" + arr
                    }
                    el.set("html", html)
                }
            });
            image.destroy();
            text.destroy();
            
            //sluitlink.inject("popup");
            
            load_year(year);
        }
    }).send("q=" + string + "&year=" + year)
    
    //console.log("q=" + string + "&year=" + year);
}

function inschrijven_detail(z, b, c, a)
{
    $("row_detail_"+b).setStyle("background-color", "#ff8b00");
    
    $$("#row_detail_" + b + " td").setStyle("color", "white");
    $$("#row_detail_" + b + " td").setStyle("border-color", "#d29645");

    $$("#row_detail_"+ b + " td a").destroy();
	
	var tr_loading = new Element("tr", {
		
	});	
	
	var td_loading = new Element("td", {
		colspan : "4",
		html : "<span>Inschrijven, 10 seconden <img src='ajax-loader.gif' class='loading' /></span>",
		styles: {
			'padding-top': '3px'
		}
	});
	
	td_loading.inject(tr_loading);
	tr_loading.inject("row_detail_"+b, "after");

		
    var aRequest = new Request(
    {
        url: "raw/inschrijven_op_id.php",
        method: "get",
        onSuccess: function (d, e)
        {
           	td_loading.set("html", d);
           	
           	$("row_detail_"+b).setStyle("background-color", "green");
           	
           	$$("#row_detail_" + b + " td").setStyle("color", "white");
           	$$("#row_detail_" + b + " td").setStyle("border-color", "#49b83c");
           	
           	td_loading.setStyle("padding-top", "10px");
           	load_year(year);
        }
    }).send("nummer=" + c + "&q=" + z + "&aantal_check=" + a + "&year="+year);
//        
}

//
//
//

var LLSearch = new Class(
{
    Implements: [Options, Events],
    options: {
        inputID: "",
        listID: "",
        inResultsClass: "LLS_inresults",
        listType: "li",
        preventClick: true,
        reFocus: true,
        currentSelection: "LLS_current_selection",
        searchTerm: "",
        searchTermLi: ""
    },
    initialize: function (a)
    {
        this.setOptions(a);
        this.inputName = $(this.options.inputID);
        this.inputName.addEvent("keyup", function ()
        {
            this.filterList()
        }.bind(this));
        if (this.options.listType == "tr")
        {
            this.searchElements = $$("#" + this.options.listID + " > tbody > " + this.options.listType)
        }
        else
        {
            this.searchElements = $$("#" + this.options.listID + " " + this.options.listType)
        }
        this.searchStrings = new Array;
        this.searchElements.each(function (c, b)
        {
            var d = c.get("text").toLowerCase();
            this.searchStrings[b] = d.substring(0, d.length - 7) + " " + c.getElements("span.usis_id").get("text")
        }.bind(this));
        this.currentLiveSearch = "";
        this.searchEvents = [];
        this.filterList()
    },
    getInputValue: function ()
    {
        this.searchEvents.currentText = this.inputName.get("value").toLowerCase()
    },
    filterList: function ()
    {
        this.getInputValue();
        this.searchStrings.each(function (b, a)
        {
            if (a == 0)
            {
                return
            }
            if (b == "" || b.contains(this.searchEvents.currentText))
            {
                var c = this.searchElements[a];
                if (this.options.listType == "tr" && c)
                {
                    c.setStyle("display", "")
                }
                else
                {
                    c.setStyle("display", "block")
                }
            }
            else
            {
                var c = this.searchElements[a];
                c.setStyle("display", "none")
            }
        }.bind(this))
    }
});

/*
---

script: Tips.js

name: Tips

description: Class for creating nice tips that follow the mouse cursor when hovering an element.

license: MIT-style license

authors:
  - Valerio Proietti
  - Christoph Pojer
  - Luis Merino

requires:
  - Core/Options
  - Core/Events
  - Core/Element.Event
  - Core/Element.Style
  - Core/Element.Dimensions
  - /MooTools.More

provides: [Tips]

...
*/

(function(){

var read = function(option, element){
	return (option) ? (typeOf(option) == 'function' ? option(element) : element.get(option)) : '';
};

this.Tips = new Class({

	Implements: [Events, Options],

	options: {/*
		onAttach: function(element){},
		onDetach: function(element){},
		onBound: function(coords){},*/
		onShow: function(){
			this.tip.setStyle('display', 'block');
		},
		onHide: function(){
			this.tip.setStyle('display', 'none');
		},
		title: 'title',
		text: function(element){
			return element.get('rel') || element.get('href');
		},
		showDelay: 0,
		hideDelay: 0,
		className: 'tip-wrap',
		offset: {x: 0, y: 24},
		windowPadding: {x:0, y:0},
		fixed: false
	},

	initialize: function(){
		var params = Array.link(arguments, {
			options: Type.isObject,
			elements: function(obj){
				return obj != null;
			}
		});
		this.setOptions(params.options);
		if (params.elements) this.attach(params.elements);
		this.container = new Element('div', {'class': 'tip'});


	},

	toElement: function(){
		if (this.tip) return this.tip;

		this.tip = new Element('div', {
			'class': this.options.className,
			styles: {
				position: 'absolute',
				top: 0,
				left: 0
			}
		}).adopt(
			new Element('div', {'class': 'tip-top'}),
			this.container,
			new Element('div', {'class': 'tip-bottom'})
		);
		
		this.tip.setStyle("background-color", "black");
		this.tip.setStyle("opacity", 0.8);
		
		return this.tip;
	},

	attach: function(elements){
		$$(elements).each(function(element){
			var title = read(this.options.title, element),
				text = read(this.options.text, element);

			element.set('title', '').store('tip:native', title).retrieve('tip:title', title);
			element.retrieve('tip:text', text);
			this.fireEvent('attach', [element]);

			var events = ['enter', 'leave'];
			if (!this.options.fixed) events.push('move');

			events.each(function(value){
				var event = element.retrieve('tip:' + value);
				if (!event) event = function(event){
					this['element' + value.capitalize()].apply(this, [event, element]);
				}.bind(this);

				element.store('tip:' + value, event).addEvent('mouse' + value, event);
			}, this);
		}, this);

		return this;
	},

	detach: function(elements){
		$$(elements).each(function(element){
			['enter', 'leave', 'move'].each(function(value){
				element.removeEvent('mouse' + value, element.retrieve('tip:' + value)).eliminate('tip:' + value);
			});

			this.fireEvent('detach', [element]);

			if (this.options.title == 'title'){ // This is necessary to check if we can revert the title
				var original = element.retrieve('tip:native');
				if (original) element.set('title', original);
			}
		}, this);

		return this;
	},

	elementEnter: function(event, element){
		clearTimeout(this.timer);
		this.timer = (function(){
			this.container.empty();

			['title', 'text'].each(function(value){
				var content = element.retrieve('tip:' + value);
				var div = this['_' + value + 'Element'] = new Element('div', {
						'class': 'tip-' + value
					}).inject(this.container);
				if (content) this.fill(div, content);
			}, this);
			this.show(element);
			this.position((this.options.fixed) ? {page: element.getPosition()} : event);
		}).delay(this.options.showDelay, this);
	},

	elementLeave: function(event, element){
		clearTimeout(this.timer);
		this.timer = this.hide.delay(this.options.hideDelay, this, element);
		this.fireForParent(event, element);
	},

	setTitle: function(title){
		if (this._titleElement){
			this._titleElement.empty();
			this.fill(this._titleElement, title);
		}
		return this;
	},

	setText: function(text){
		if (this._textElement){
			this._textElement.empty();
			this.fill(this._textElement, text);
		}
		return this;
	},

	fireForParent: function(event, element){
		element = element.getParent();
		if (!element || element == document.body) return;
		if (element.retrieve('tip:enter')) element.fireEvent('mouseenter', event);
		else this.fireForParent(event, element);
	},

	elementMove: function(event, element){
		this.position(event);
	},

	position: function(event){
		if (!this.tip) document.id(this);

		var size = window.getSize(), scroll = window.getScroll(),
			tip = {x: this.tip.offsetWidth, y: this.tip.offsetHeight},
			props = {x: 'left', y: 'top'},
			bounds = {y: false, x2: false, y2: false, x: false},
			obj = {};

		for (var z in props){
			obj[props[z]] = event.page[z] + this.options.offset[z];
			if (obj[props[z]] < 0) bounds[z] = true;
			if ((obj[props[z]] + tip[z] - scroll[z]) > size[z] - this.options.windowPadding[z]){
				obj[props[z]] = event.page[z] - this.options.offset[z] - tip[z];
				bounds[z+'2'] = true;
			}
		}

		this.fireEvent('bound', bounds);
		this.tip.setStyles(obj);
	},

	fill: function(element, contents){
		if (typeof contents == 'string') element.set('html', contents);
		else element.adopt(contents);
	},

	show: function(element){
		if (!this.tip) document.id(this);
		if (!this.tip.getParent()) this.tip.inject(document.body);
		this.fireEvent('show', [this.tip, element]);
	},

	hide: function(element){
		if (!this.tip) document.id(this);
		this.fireEvent('hide', [this.tip, element]);
	}

});

}).call(this);


