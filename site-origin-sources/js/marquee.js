/**
 * Minified by jsDelivr using Terser v5.3.0.
 * Original file: /npm/dynamic-marquee@1.3.2/dist/dynamic-marquee.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports):"function"==typeof define&&define.amd?define(["exports"],e):e((t="undefined"!=typeof globalThis?globalThis:t||self).dynamicMarquee={})}(this,(function(t){"use strict";function e(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){for(var i=0;i<e.length;i++){var n=e[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}function n(t,e,n){return e&&i(t.prototype,e),n&&i(t,n),t}var s="right",r="down";function o(t,e){return t[e===s?"offsetWidth":"offsetHeight"]}function a(t){window.setTimeout((function(){return t()}),0)}function h(t){try{return t()}catch(t){a((function(){throw t}))}}function u(t){if("string"==typeof t||"number"==typeof t){var e=document.createElement("div");return e.textContent=t+"",e}return t}var f=6e4,l=function(){function t(i,n){e(this,t);var s=document.createElement("div");s.style.display="block",s.style.position="absolute",s.style.margin="0",s.style.padding="0",s.style.whiteSpace="nowrap",s.style.willChange="auto",s.appendChild(i),this._$container=s,this._$el=i,this._direction=n,this._transitionState=null}return n(t,[{key:"getSize",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=t.inverse,i=void 0!==e&&e,n=this._direction;return i&&(n=n===s?r:s),o(this._$container,n)}},{key:"setOffset",value:function(t,e,i){var n=this._transitionState,r=!n||n.rate!==e;if(n&&!i&&(performance.now()-n.time<5e4&&!r))return;(i||r)&&(this._direction===s?this._$container.style.transform="translateX(".concat(t,"px)"):this._$container.style.transform="translateY(".concat(t,"px)"),this._$container.style.transition="",this._$container.offsetLeft);var o=t+e/1e3*f;this._direction===s?this._$container.style.transform="translateX(".concat(o,"px)"):this._$container.style.transform="translateY(".concat(o,"px)"),e&&(this._$container.style.transition="transform ".concat(f,"ms linear")),this._transitionState={time:performance.now(),rate:e}}},{key:"enableAnimationHint",value:function(t){this._$container.style.willChange=t?"transform":"auto"}},{key:"remove",value:function(){this._$container.remove()}},{key:"getContainer",value:function(){return this._$container}},{key:"getOriginalEl",value:function(){return this._$el}}]),t}(),m=function(){function t(i){e(this,t),this._size=i}return n(t,[{key:"getSize",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=t.inverse,i=void 0!==e&&e;if(i)throw new Error("Inverse not supported on virtual item.");return this._size}},{key:"setOffset",value:function(){}},{key:"enableAnimationHint",value:function(){}},{key:"remove",value:function(){}}]),t}(),c=function(){function t(i){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},o=n.rate,a=void 0===o?-25:o,h=n.upDown,u=void 0!==h&&h;e(this,t),this._rendering=!1,this._waitingForItem=!0,this._nextItemImmediatelyFollowsPrevious=!1,this._rate=a,this._lastEffectiveRate=a,this._justReversedRate=!1,this._windowWidth=window.innerWidth,this._windowHeight=window.innerHeight,this._direction=u?r:s,this._onItemRequired=[],this._onItemRemoved=[],this._onAllItemsRemoved=[],this._leftItemOffset=0,this._containerSize=0,this._items=[],this._pendingItem=null;var f=document.createElement("div");f.style.position="relative",f.style.display="inline-block",this._$container=f,this._containerSizeInverse=null,this._direction===s?f.style.width="100%":f.style.height="100%",this._updateContainerSize(),i.appendChild(f),this._scheduleRender()}return n(t,[{key:"onItemRequired",value:function(t){this._onItemRequired.push(t)}},{key:"onItemRemoved",value:function(t){this._onItemRemoved.push(t)}},{key:"onAllItemsRemoved",value:function(t){this._onAllItemsRemoved.push(t)}},{key:"getNumItems",value:function(){return this._items.filter((function(t){return t.item instanceof l})).length}},{key:"setRate",value:function(t){!t!=!this._rate&&(this._enableAnimationHint(!!t),t&&this._scheduleRender()),t*this._lastEffectiveRate<0&&(this._justReversedRate=!0,this._waitingForItem=!1),this._rate=t,t&&(this._lastEffectiveRate=t)}},{key:"getRate",value:function(){return this._rate}},{key:"clear",value:function(){var t=this;this._items.forEach((function(e){var i=e.item;return t._removeItem(i)})),this._items=[],this._waitingForItem=!0,this._updateContainerSize()}},{key:"isWaitingForItem",value:function(){return this._waitingForItem}},{key:"appendItem",value:function(t){if(!this._waitingForItem)throw new Error("No room for item.");if(t=u(t),this._items.some((function(e){var i=e.item;return i instanceof l&&i.getOriginalEl()===t})))throw new Error("Item already exists.");this._waitingForItem=!1,this._pendingItem=new l(t,this._direction),this._pendingItem.enableAnimationHint(!!this._rate),this._rendering?this._render(0):this._scheduleRender()}},{key:"_removeItem",value:function(t){var e=this,i=t.item;a((function(){i.remove(),i instanceof l&&e._onItemRemoved.forEach((function(t){h((function(){return t(i.getOriginalEl())}))}))}))}},{key:"_updateContainerSize",value:function(){var t=this._items.reduce((function(t,e){var i=e.item;if(i instanceof m)return t;var n=i.getSize({inverse:!0});return n>t?n:t}),0);this._containerSizeInverse!==t&&(this._containerSizeInverse=t,this._direction===s?this._$container.style.height="".concat(t,"px"):this._$container.style.width="".concat(t,"px"))}},{key:"_enableAnimationHint",value:function(t){this._items.forEach((function(e){return e.item.enableAnimationHint(t)}))}},{key:"_scheduleRender",value:function(){var t=this;this._requestAnimationID||(this._lastUpdateTime=performance.now(),this._requestAnimationID=window.requestAnimationFrame((function(){return t._onRequestAnimationFrame()})))}},{key:"_onRequestAnimationFrame",value:function(){var t=this;if(this._requestAnimationID=null,this._items.length||this._pendingItem){var e=performance.now()-this._lastUpdateTime;this._rate&&this._scheduleRender(),this._rendering=!0;var i=this._rate*(e/1e3);this._containerSize=o(this._$container,this._direction),h((function(){return t._render(i)})),this._rendering=!1}}},{key:"_render",value:function(t){var e=this;this._leftItemOffset+=t;var i=this._containerSize;if(this._rate<0)for(;this._items.length;){var n=this._items[0].item.getSize();if(this._leftItemOffset+n>0)break;this._removeItem(this._items[0]),this._items.shift(),this._leftItemOffset+=n}var s=[],r=this._leftItemOffset;for(this._items.some((function(t,n){var o=t.item;return r>=i&&e._rate>0?(e._items.splice(n).forEach((function(t){return e._removeItem(t)})),!0):(s.push(r),r+=o.getSize(),!1)})),this._pendingItem&&(this._$container.appendChild(this._pendingItem.getContainer()),this._rate<=0?(this._nextItemImmediatelyFollowsPrevious||(this._items.push({item:new m(Math.max(0,i-r)),offset:r}),s.push(r),r=i),this._items.push({item:this._pendingItem,offset:r}),s.push(r),r+=this._pendingItem.getSize()):(!this._nextItemImmediatelyFollowsPrevious&&this._items.length&&this._leftItemOffset>0&&(this._items.unshift({item:new m(this._leftItemOffset),offset:0}),s.unshift(0),this._leftItemOffset=0),this._leftItemOffset-=this._pendingItem.getSize(),s.unshift(this._leftItemOffset),this._items.unshift({item:this._pendingItem,offset:this._leftItemOffset})),this._pendingItem=null);this._items.length&&this._items[0].item instanceof m;)s.shift(),this._items.shift(),this._leftItemOffset=s[0]||0;for(;this._items.length&&this._items[this._items.length-1].item instanceof m;)s.pop(),this._items.pop();var o=window.innerWidth,u=window.innerHeight,f=o!==this._windowWidth||u!==this._windowHeight;this._windowWidth=o,this._windowHeight=u,s.forEach((function(i,n){var s=e._items[n],r=Math.abs(s.offset+t-i)>=1;s.item.setOffset(i,e._rate,f||r),s.offset=i})),this._updateContainerSize(),this._items.length||(this._leftItemOffset=0,a((function(){e._onAllItemsRemoved.forEach((function(t){h((function(){return t()}))}))}))),this._nextItemImmediatelyFollowsPrevious=!1;var l,c=this._justReversedRate;(this._justReversedRate=!1,!this._waitingForItem&&(this._rate<=0&&r<=i||this._rate>0&&this._leftItemOffset>=0))&&(this._waitingForItem=!0,this._nextItemImmediatelyFollowsPrevious=!c,this._onItemRequired.some((function(t){return h((function(){return!!(l=t({immediatelyFollowsPrevious:e._nextItemImmediatelyFollowsPrevious}))}))})),l&&this.appendItem(l),this._nextItemImmediatelyFollowsPrevious=!1)}}]),t}(),_=function(t,e){var i,n={startString1:0,startString2:0,length:0},s=(i={},t.forEach((function(t,e){i[t]=i[t]||[],i[t].push(e)})),i),r=[];return e.forEach((function(t,e){var i,o=[];(s[t]||[]).forEach((function(t){(i=(t&&r[t-1]||0)+1)>n.length&&(n.length=i,n.startString1=t-i+1,n.startString2=e-i+1),o[t]=i})),r=o})),n};t.Marquee=c,t.loop=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[],i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,n=-1,s=e.slice(),r=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1,e=(n+t)%s.length;return{builder:s[e],index:e}},o=function(e){if(s.length&&t.isWaitingForItem()){var o=r(),a=o.builder,h=o.index;n=h;var f=u(a());if(e&&i){var l=u(i()),m=document.createElement("div");l.style.display="inline",f.style.display="inline",t.getRate()<=0?(m.appendChild(l),m.appendChild(f)):(m.appendChild(f),m.appendChild(l)),f=m}t.appendItem(f)}};return t.onItemRequired((function(t){var e=t.immediatelyFollowsPrevious;return o(e)})),o(),{update:function(t){var e,i,r,a,h,u;e=s.map((function(t,e){var i=s.indexOf(t);return i<e?i:e})),i=t.map((function(t,e){return s.indexOf(t)})),r=_(e,i),a=r.startString1,h=r.startString2,u=r.length,n=n>=a&&n<a+u?n+(h-a):-1,s=t.slice(),o(!1)}}},Object.defineProperty(t,"__esModule",{value:!0})}));
//# sourceMappingURL=/sm/84f472eef292683aff9b33850c33476190c8af7cad6bc8cb7999dc5b161f04bc.map