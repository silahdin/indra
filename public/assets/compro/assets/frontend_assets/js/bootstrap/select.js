!function(e,t){"function"==typeof define&&define.amd?define(["jquery"],function(e){return t(e)}):"object"==typeof exports?module.exports=t(require("jquery")):t(jQuery)}(0,function(e){!function(y){"use strict";function $(e){return y.each([{re:/[\xC0-\xC6]/g,ch:"A"},{re:/[\xE0-\xE6]/g,ch:"a"},{re:/[\xC8-\xCB]/g,ch:"E"},{re:/[\xE8-\xEB]/g,ch:"e"},{re:/[\xCC-\xCF]/g,ch:"I"},{re:/[\xEC-\xEF]/g,ch:"i"},{re:/[\xD2-\xD6]/g,ch:"O"},{re:/[\xF2-\xF6]/g,ch:"o"},{re:/[\xD9-\xDC]/g,ch:"U"},{re:/[\xF9-\xFC]/g,ch:"u"},{re:/[\xC7-\xE7]/g,ch:"c"},{re:/[\xD1]/g,ch:"N"},{re:/[\xF1]/g,ch:"n"}],function(){e=e.replace(this.re,this.ch)}),e}function r(e){var t={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},i="(?:"+Object.keys(t).join("|")+")",n=new RegExp(i),s=new RegExp(i,"g"),o=null==e?"":""+e;return n.test(o)?o.replace(s,function(e){return t[e]}):o}function t(e,t){var o=arguments,a=e,l=t;[].shift.apply(o);var r,i=this.each(function(){var e=y(this);if(e.is("select")){var t=e.data("selectpicker"),i="object"==typeof a&&a;if(t){if(i)for(var n in i)i.hasOwnProperty(n)&&(t.options[n]=i[n])}else{var s=y.extend({},c.DEFAULTS,y.fn.selectpicker.defaults||{},e.data(),i);s.template=y.extend({},c.DEFAULTS.template,y.fn.selectpicker.defaults?y.fn.selectpicker.defaults.template:{},e.data().template,i.template),e.data("selectpicker",t=new c(this,s,l))}"string"==typeof a&&(r=t[a]instanceof Function?t[a].apply(t,o):t.options[a])}});return void 0!==r?r:i}var e,d,i,l,n,h,s;String.prototype.includes||(l={}.toString,n=function(){try{var e={},t=Object.defineProperty,i=t(e,e,e)&&t}catch(e){}return i}(),h="".indexOf,s=function(e){if(null==this)throw new TypeError;var t=String(this);if(e&&"[object RegExp]"==l.call(e))throw new TypeError;var i=t.length,n=String(e),s=n.length,o=1<arguments.length?arguments[1]:void 0,a=o?Number(o):0;return a!=a&&(a=0),!(i<s+Math.min(Math.max(a,0),i))&&-1!=h.call(t,n,a)},n?n(String.prototype,"includes",{value:s,configurable:!0,writable:!0}):String.prototype.includes=s),String.prototype.startsWith||(e=function(){try{var e={},t=Object.defineProperty,i=t(e,e,e)&&t}catch(e){}return i}(),d={}.toString,i=function(e){if(null==this)throw new TypeError;var t=String(this);if(e&&"[object RegExp]"==d.call(e))throw new TypeError;var i=t.length,n=String(e),s=n.length,o=1<arguments.length?arguments[1]:void 0,a=o?Number(o):0;a!=a&&(a=0);var l=Math.min(Math.max(a,0),i);if(i<s+l)return!1;for(var r=-1;++r<s;)if(t.charCodeAt(l+r)!=n.charCodeAt(r))return!1;return!0},e?e(String.prototype,"startsWith",{value:i,configurable:!0,writable:!0}):String.prototype.startsWith=i),Object.keys||(Object.keys=function(e,t,i){for(t in i=[],e)i.hasOwnProperty.call(e,t)&&i.push(t);return i}),y.fn.triggerNative=function(e){var t,i=this[0];i.dispatchEvent?("function"==typeof Event?t=new Event(e,{bubbles:!0}):(t=document.createEvent("Event")).initEvent(e,!0,!1),i.dispatchEvent(t)):(i.fireEvent&&((t=document.createEventObject()).eventType=e,i.fireEvent("on"+e,t)),this.trigger(e))},y.expr[":"].icontains=function(e,t,i){var n=y(e);return(n.data("tokens")||n.text()).toUpperCase().includes(i[3].toUpperCase())},y.expr[":"].ibegins=function(e,t,i){var n=y(e);return(n.data("tokens")||n.text()).toUpperCase().startsWith(i[3].toUpperCase())},y.expr[":"].aicontains=function(e,t,i){var n=y(e);return(n.data("tokens")||n.data("normalizedText")||n.text()).toUpperCase().includes(i[3].toUpperCase())},y.expr[":"].aibegins=function(e,t,i){var n=y(e);return(n.data("tokens")||n.data("normalizedText")||n.text()).toUpperCase().startsWith(i[3].toUpperCase())};var c=function(e,t,i){i&&(i.stopPropagation(),i.preventDefault()),this.$element=y(e),this.$newElement=null,this.$button=null,this.$menu=null,this.$lis=null,this.options=t,null===this.options.title&&(this.options.title=this.$element.attr("title")),this.val=c.prototype.val,this.render=c.prototype.render,this.refresh=c.prototype.refresh,this.setStyle=c.prototype.setStyle,this.selectAll=c.prototype.selectAll,this.deselectAll=c.prototype.deselectAll,this.destroy=c.prototype.destroy,this.remove=c.prototype.remove,this.show=c.prototype.show,this.hide=c.prototype.hide,this.init()};c.VERSION="1.10.0",c.DEFAULTS={noneSelectedText:"Nothing selected",noneResultsText:"No results matched {0}",countSelectedText:function(e,t){return 1==e?"{0} item selected":"{0} items selected"},maxOptionsText:function(e,t){return[1==e?"Limit reached ({n} item max)":"Limit reached ({n} items max)",1==t?"Group limit reached ({n} item max)":"Group limit reached ({n} items max)"]},selectAllText:"Select All",deselectAllText:"Deselect All",doneButton:!1,doneButtonText:"Close",multipleSeparator:", ",styleBase:"btn",style:"btn-default",size:"auto",title:null,selectedTextFormat:"values",width:!1,container:!1,hideDisabled:!1,showSubtext:!1,showIcon:!0,showContent:!0,dropupAuto:!0,header:!1,liveSearch:!1,liveSearchPlaceholder:null,liveSearchNormalize:!1,liveSearchStyle:"contains",actionsBox:!1,iconBase:"glyphicon",tickIcon:"glyphicon-ok",showTick:!1,template:{caret:'<span class="caret"></span>'},maxOptions:!1,mobile:!1,selectOnTab:!1,dropdownAlignRight:!1},c.prototype={constructor:c,init:function(){var t=this,e=this.$element.attr("id");this.$element.addClass("bs-select-hidden"),this.liObj={},this.multiple=this.$element.prop("multiple"),this.autofocus=this.$element.prop("autofocus"),this.$newElement=this.createView(),this.$element.after(this.$newElement).appendTo(this.$newElement),this.$button=this.$newElement.children("button"),this.$menu=this.$newElement.children(".dropdown-menu"),this.$menuInner=this.$menu.children(".inner"),this.$searchbox=this.$menu.find("input"),this.$element.removeClass("bs-select-hidden"),this.options.dropdownAlignRight&&this.$menu.addClass("dropdown-menu-right"),void 0!==e&&(this.$button.attr("data-id",e),y('label[for="'+e+'"]').click(function(e){e.preventDefault(),t.$button.focus()})),this.checkDisabled(),this.clickListener(),this.options.liveSearch&&this.liveSearchListener(),this.render(),this.setStyle(),this.setWidth(),this.options.container&&this.selectPosition(),this.$menu.data("this",this),this.$newElement.data("this",this),this.options.mobile&&this.mobile(),this.$newElement.on({"hide.bs.dropdown":function(e){t.$element.trigger("hide.bs.select",e)},"hidden.bs.dropdown":function(e){t.$element.trigger("hidden.bs.select",e)},"show.bs.dropdown":function(e){t.$element.trigger("show.bs.select",e)},"shown.bs.dropdown":function(e){t.$element.trigger("shown.bs.select",e)}}),t.$element[0].hasAttribute("required")&&this.$element.on("invalid",function(){t.$button.addClass("bs-invalid").focus(),t.$element.on({"focus.bs.select":function(){t.$button.focus(),t.$element.off("focus.bs.select")},"shown.bs.select":function(){t.$element.val(t.$element.val()).off("shown.bs.select")},"rendered.bs.select":function(){this.validity.valid&&t.$button.removeClass("bs-invalid"),t.$element.off("rendered.bs.select")}})}),setTimeout(function(){t.$element.trigger("loaded.bs.select")})},createDropdown:function(){var e=this.multiple||this.options.showTick?" show-tick":"",t=this.$element.parent().hasClass("input-group")?" input-group-btn":"",i=this.autofocus?" autofocus":"",n=this.options.header?'<div class="popover-title"><button type="button" class="close" aria-hidden="true">&times;</button>'+this.options.header+"</div>":"",s=this.options.liveSearch?'<div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"'+(null===this.options.liveSearchPlaceholder?"":' placeholder="'+r(this.options.liveSearchPlaceholder)+'"')+"></div>":"",o=this.multiple&&this.options.actionsBox?'<div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block"><button type="button" class="actions-btn bs-select-all btn btn-default">'+this.options.selectAllText+'</button><button type="button" class="actions-btn bs-deselect-all btn btn-default">'+this.options.deselectAllText+"</button></div></div>":"",a=this.multiple&&this.options.doneButton?'<div class="bs-donebutton"><div class="btn-group btn-block"><button type="button" class="btn btn-sm btn-default">'+this.options.doneButtonText+"</button></div></div>":"",l='<div class="btn-group bootstrap-select'+e+t+'"><button type="button" class="'+this.options.styleBase+' dropdown-toggle" data-toggle="dropdown"'+i+'><span class="filter-option pull-left"></span>&nbsp;<span class="bs-caret">'+this.options.template.caret+'</span></button><div class="dropdown-menu open">'+n+s+o+'<ul class="dropdown-menu inner" role="menu"></ul>'+a+"</div></div>";return y(l)},createView:function(){var e=this.createDropdown(),t=this.createLi();return e.find("ul")[0].innerHTML=t,e},reloadLi:function(){this.destroyLi();var e=this.createLi();this.$menuInner[0].innerHTML=e},destroyLi:function(){this.$menu.find("li").remove()},createLi:function(){var u=this,m=[],f=0,e=document.createElement("option"),v=-1,b=function(e,t,i,n){return"<li"+(void 0!==i&""!==i?' class="'+i+'"':"")+(void 0!==t&null!==t?' data-original-index="'+t+'"':"")+(void 0!==n&null!==n?'data-optgroup="'+n+'"':"")+">"+e+"</li>"},g=function(e,t,i,n){return'<a tabindex="0"'+(void 0!==t?' class="'+t+'"':"")+(void 0!==i?' style="'+i+'"':"")+(u.options.liveSearchNormalize?' data-normalized-text="'+$(r(e))+'"':"")+(void 0!==n||null!==n?' data-tokens="'+n+'"':"")+">"+e+'<span class="'+u.options.iconBase+" "+u.options.tickIcon+' check-mark"></span></a>'};if(this.options.title&&!this.multiple&&(v--,!this.$element.find(".bs-title-option").length)){var t=this.$element[0];e.className="bs-title-option",e.appendChild(document.createTextNode(this.options.title)),e.value="",t.insertBefore(e,t.firstChild),void 0===y(t.options[t.selectedIndex]).attr("selected")&&(e.selected=!0)}return this.$element.find("option").each(function(e){var t=y(this);if(v++,!t.hasClass("bs-title-option")){var i=this.className||"",n=this.style.cssText,s=t.data("content")?t.data("content"):t.html(),o=t.data("tokens")?t.data("tokens"):null,a=void 0!==t.data("subtext")?'<small class="text-muted">'+t.data("subtext")+"</small>":"",l=void 0!==t.data("icon")?'<span class="'+u.options.iconBase+" "+t.data("icon")+'"></span> ':"",r="OPTGROUP"===this.parentNode.tagName,d=this.disabled||r&&this.parentNode.disabled;if(""!==l&&d&&(l="<span>"+l+"</span>"),u.options.hideDisabled&&d&&!r)return void v--;if(t.data("content")||(s=l+'<span class="text">'+s+a+"</span>"),r&&!0!==t.data("divider")){var h=" "+this.parentNode.className||"";if(0===t.index()){f+=1;var c=this.parentNode.label,p=void 0!==t.parent().data("subtext")?'<small class="text-muted">'+t.parent().data("subtext")+"</small>":"";c=(t.parent().data("icon")?'<span class="'+u.options.iconBase+" "+t.parent().data("icon")+'"></span> ':"")+'<span class="text">'+c+p+"</span>",0!==e&&0<m.length&&(v++,m.push(b("",null,"divider",f+"div"))),v++,m.push(b(c,null,"dropdown-header"+h,f))}if(u.options.hideDisabled&&d)return void v--;m.push(b(g(s,"opt "+i+h,n,o),e,"",f))}else!0===t.data("divider")?m.push(b("",e,"divider")):!0===t.data("hidden")?m.push(b(g(s,i,n,o),e,"hidden is-hidden")):(this.previousElementSibling&&"OPTGROUP"===this.previousElementSibling.tagName&&(v++,m.push(b("",null,"divider",f+"div"))),m.push(b(g(s,i,n,o),e)));u.liObj[e]=v}}),this.multiple||0!==this.$element.find("option:selected").length||this.options.title||this.$element.find("option").eq(0).prop("selected",!0).attr("selected","selected"),m.join("")},findLis:function(){return null==this.$lis&&(this.$lis=this.$menu.find("li")),this.$lis},render:function(e){var t,n=this;!1!==e&&this.$element.find("option").each(function(e){var t=n.findLis().eq(n.liObj[e]);n.setDisabled(e,this.disabled||"OPTGROUP"===this.parentNode.tagName&&this.parentNode.disabled,t),n.setSelected(e,this.selected,t)}),this.tabIndex();var i=this.$element.find("option").map(function(){if(this.selected){if(n.options.hideDisabled&&(this.disabled||"OPTGROUP"===this.parentNode.tagName&&this.parentNode.disabled))return;var e,t=y(this),i=t.data("icon")&&n.options.showIcon?'<i class="'+n.options.iconBase+" "+t.data("icon")+'"></i> ':"";return e=n.options.showSubtext&&t.data("subtext")&&!n.multiple?' <small class="text-muted">'+t.data("subtext")+"</small>":"",void 0!==t.attr("title")?t.attr("title"):t.data("content")&&n.options.showContent?t.data("content"):i+t.html()+e}}).toArray(),s=this.multiple?i.join(this.options.multipleSeparator):i[0];if(this.multiple&&-1<this.options.selectedTextFormat.indexOf("count")){var o=this.options.selectedTextFormat.split(">");if(1<o.length&&i.length>o[1]||1==o.length&&2<=i.length){t=this.options.hideDisabled?", [disabled]":"";var a=this.$element.find("option").not('[data-divider="true"], [data-hidden="true"]'+t).length;s=("function"==typeof this.options.countSelectedText?this.options.countSelectedText(i.length,a):this.options.countSelectedText).replace("{0}",i.length.toString()).replace("{1}",a.toString())}}null==this.options.title&&(this.options.title=this.$element.attr("title")),"static"==this.options.selectedTextFormat&&(s=this.options.title),s||(s=void 0!==this.options.title?this.options.title:this.options.noneSelectedText),this.$button.attr("title",y.trim(s.replace(/<[^>]*>?/g,""))),this.$button.children(".filter-option").html(s),this.$element.trigger("rendered.bs.select")},setStyle:function(e,t){this.$element.attr("class")&&this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device|bs-select-hidden|validate\[.*\]/gi,""));var i=e||this.options.style;"add"==t?this.$button.addClass(i):"remove"==t?this.$button.removeClass(i):(this.$button.removeClass(this.options.style),this.$button.addClass(i))},liHeight:function(e){if(e||!1!==this.options.size&&!this.sizeInfo){var t=document.createElement("div"),i=document.createElement("div"),n=document.createElement("ul"),s=document.createElement("li"),o=document.createElement("li"),a=document.createElement("a"),l=document.createElement("span"),r=this.options.header&&0<this.$menu.find(".popover-title").length?this.$menu.find(".popover-title")[0].cloneNode(!0):null,d=this.options.liveSearch?document.createElement("div"):null,h=this.options.actionsBox&&this.multiple&&0<this.$menu.find(".bs-actionsbox").length?this.$menu.find(".bs-actionsbox")[0].cloneNode(!0):null,c=this.options.doneButton&&this.multiple&&0<this.$menu.find(".bs-donebutton").length?this.$menu.find(".bs-donebutton")[0].cloneNode(!0):null;if(l.className="text",t.className=this.$menu[0].parentNode.className+" open",i.className="dropdown-menu open",n.className="dropdown-menu inner",s.className="divider",l.appendChild(document.createTextNode("Inner text")),a.appendChild(l),o.appendChild(a),n.appendChild(o),n.appendChild(s),r&&i.appendChild(r),d){var p=document.createElement("span");d.className="bs-searchbox",p.className="form-control",d.appendChild(p),i.appendChild(d)}h&&i.appendChild(h),i.appendChild(n),c&&i.appendChild(c),t.appendChild(i),document.body.appendChild(t);var u=a.offsetHeight,m=r?r.offsetHeight:0,f=d?d.offsetHeight:0,v=h?h.offsetHeight:0,b=c?c.offsetHeight:0,g=y(s).outerHeight(!0),$="function"==typeof getComputedStyle&&getComputedStyle(i),x=$?null:y(i),w=parseInt($?$.paddingTop:x.css("paddingTop"))+parseInt($?$.paddingBottom:x.css("paddingBottom"))+parseInt($?$.borderTopWidth:x.css("borderTopWidth"))+parseInt($?$.borderBottomWidth:x.css("borderBottomWidth")),C=w+parseInt($?$.marginTop:x.css("marginTop"))+parseInt($?$.marginBottom:x.css("marginBottom"))+2;document.body.removeChild(t),this.sizeInfo={liHeight:u,headerHeight:m,searchHeight:f,actionsHeight:v,doneButtonHeight:b,dividerHeight:g,menuPadding:w,menuExtras:C}}},setSize:function(){if(this.findLis(),this.liHeight(),this.options.header&&this.$menu.css("padding-top",0),!1!==this.options.size){var o,a,l,r,d=this,h=this.$menu,c=this.$menuInner,e=y(window),t=this.$newElement[0].offsetHeight,p=this.sizeInfo.liHeight,u=this.sizeInfo.headerHeight,m=this.sizeInfo.searchHeight,f=this.sizeInfo.actionsHeight,v=this.sizeInfo.doneButtonHeight,i=this.sizeInfo.dividerHeight,b=this.sizeInfo.menuPadding,g=this.sizeInfo.menuExtras,n=this.options.hideDisabled?".disabled":"",$=function(){l=d.$newElement.offset().top-e.scrollTop(),r=e.height()-l-t};if($(),"auto"===this.options.size){var s=function(){var e,t=function(t,i){return function(e){return i?e.classList?e.classList.contains(t):y(e).hasClass(t):!(e.classList?e.classList.contains(t):y(e).hasClass(t))}},i=d.$menuInner[0].getElementsByTagName("li"),n=Array.prototype.filter?Array.prototype.filter.call(i,t("hidden",!1)):d.$lis.not(".hidden"),s=Array.prototype.filter?Array.prototype.filter.call(n,t("dropdown-header",!0)):n.filter(".dropdown-header");$(),o=r-g,d.options.container?(h.data("height")||h.data("height",h.height()),a=h.data("height")):a=h.height(),d.options.dropupAuto&&d.$newElement.toggleClass("dropup",r<l&&o-g<a),d.$newElement.hasClass("dropup")&&(o=l-g),e=3<n.length+s.length?3*p+g-2:0,h.css({"max-height":o+"px",overflow:"hidden","min-height":e+u+m+f+v+"px"}),c.css({"max-height":o-u-m-f-v-b+"px","overflow-y":"auto","min-height":Math.max(e-b,0)+"px"})};s(),this.$searchbox.off("input.getSize propertychange.getSize").on("input.getSize propertychange.getSize",s),e.off("resize.getSize scroll.getSize").on("resize.getSize scroll.getSize",s)}else if(this.options.size&&"auto"!=this.options.size&&this.$lis.not(n).length>this.options.size){var x=this.$lis.not(".divider").not(n).children().slice(0,this.options.size).last().parent().index(),w=this.$lis.slice(0,x+1).filter(".divider").length;o=p*this.options.size+w*i+b,d.options.container?(h.data("height")||h.data("height",h.height()),a=h.data("height")):a=h.height(),d.options.dropupAuto&&this.$newElement.toggleClass("dropup",r<l&&o-g<a),h.css({"max-height":o+u+m+f+v+"px",overflow:"hidden","min-height":""}),c.css({"max-height":o-b+"px","overflow-y":"auto","min-height":""})}}},setWidth:function(){if("auto"===this.options.width){this.$menu.css("min-width","0");var e=this.$menu.parent().clone().appendTo("body"),t=this.options.container?this.$newElement.clone().appendTo("body"):e,i=e.children(".dropdown-menu").outerWidth(),n=t.css("width","auto").children("button").outerWidth();e.remove(),t.remove(),this.$newElement.css("width",Math.max(i,n)+"px")}else"fit"===this.options.width?(this.$menu.css("min-width",""),this.$newElement.css("width","").addClass("fit-width")):this.options.width?(this.$menu.css("min-width",""),this.$newElement.css("width",this.options.width)):(this.$menu.css("min-width",""),this.$newElement.css("width",""));this.$newElement.hasClass("fit-width")&&"fit"!==this.options.width&&this.$newElement.removeClass("fit-width")},selectPosition:function(){this.$bsContainer=y('<div class="bs-container" />');var t,i,n=this,s=function(e){n.$bsContainer.addClass(e.attr("class").replace(/form-control|fit-width/gi,"")).toggleClass("dropup",e.hasClass("dropup")),t=e.offset(),i=e.hasClass("dropup")?0:e[0].offsetHeight,n.$bsContainer.css({top:t.top+i,left:t.left,width:e[0].offsetWidth})};this.$button.on("click",function(){var e=y(this);n.isDisabled()||(s(n.$newElement),n.$bsContainer.appendTo(n.options.container).toggleClass("open",!e.hasClass("open")).append(n.$menu))}),y(window).on("resize scroll",function(){s(n.$newElement)}),this.$element.on("hide.bs.select",function(){n.$menu.data("height",n.$menu.height()),n.$bsContainer.detach()})},setSelected:function(e,t,i){i||(i=this.findLis().eq(this.liObj[e])),i.toggleClass("selected",t)},setDisabled:function(e,t,i){i||(i=this.findLis().eq(this.liObj[e])),t?i.addClass("disabled").children("a").attr("href","#").attr("tabindex",-1):i.removeClass("disabled").children("a").removeAttr("href").attr("tabindex",0)},isDisabled:function(){return this.$element[0].disabled},checkDisabled:function(){var e=this;this.isDisabled()?(this.$newElement.addClass("disabled"),this.$button.addClass("disabled").attr("tabindex",-1)):(this.$button.hasClass("disabled")&&(this.$newElement.removeClass("disabled"),this.$button.removeClass("disabled")),-1!=this.$button.attr("tabindex")||this.$element.data("tabindex")||this.$button.removeAttr("tabindex")),this.$button.click(function(){return!e.isDisabled()})},tabIndex:function(){this.$element.data("tabindex")!==this.$element.attr("tabindex")&&-98!==this.$element.attr("tabindex")&&"-98"!==this.$element.attr("tabindex")&&(this.$element.data("tabindex",this.$element.attr("tabindex")),this.$button.attr("tabindex",this.$element.data("tabindex"))),this.$element.attr("tabindex",-98)},clickListener:function(){var g=this,t=y(document);this.$newElement.on("touchstart.dropdown",".dropdown-menu",function(e){e.stopPropagation()}),t.data("spaceSelect",!1),this.$button.on("keyup",function(e){/(32)/.test(e.keyCode.toString(10))&&t.data("spaceSelect")&&(e.preventDefault(),t.data("spaceSelect",!1))}),this.$button.on("click",function(){g.setSize()}),this.$element.on("shown.bs.select",function(){if(g.options.liveSearch||g.multiple){if(!g.multiple){var e=g.liObj[g.$element[0].selectedIndex];if("number"!=typeof e||!1===g.options.size)return;var t=g.$lis.eq(e)[0].offsetTop-g.$menuInner[0].offsetTop;t=t-g.$menuInner[0].offsetHeight/2+g.sizeInfo.liHeight/2,g.$menuInner[0].scrollTop=t}}else g.$menuInner.find(".selected a").focus()}),this.$menuInner.on("click","li a",function(e){var t=y(this),i=t.parent().data("originalIndex"),n=g.$element.val(),s=g.$element.prop("selectedIndex");if(g.multiple&&e.stopPropagation(),e.preventDefault(),!g.isDisabled()&&!t.parent().hasClass("disabled")){var o=g.$element.find("option"),a=o.eq(i),l=a.prop("selected"),r=a.parent("optgroup"),d=g.options.maxOptions,h=r.data("maxOptions")||!1;if(g.multiple){if(a.prop("selected",!l),g.setSelected(i,!l),t.blur(),!1!==d||!1!==h){var c=d<o.filter(":selected").length,p=h<r.find("option:selected").length;if(d&&c||h&&p)if(d&&1==d)o.prop("selected",!1),a.prop("selected",!0),g.$menuInner.find(".selected").removeClass("selected"),g.setSelected(i,!0);else if(h&&1==h){r.find("option:selected").prop("selected",!1),a.prop("selected",!0);var u=t.parent().data("optgroup");g.$menuInner.find('[data-optgroup="'+u+'"]').removeClass("selected"),g.setSelected(i,!0)}else{var m="function"==typeof g.options.maxOptionsText?g.options.maxOptionsText(d,h):g.options.maxOptionsText,f=m[0].replace("{n}",d),v=m[1].replace("{n}",h),b=y('<div class="notify"></div>');m[2]&&(f=f.replace("{var}",m[2][1<d?0:1]),v=v.replace("{var}",m[2][1<h?0:1])),a.prop("selected",!1),g.$menu.append(b),d&&c&&(b.append(y("<div>"+f+"</div>")),g.$element.trigger("maxReached.bs.select")),h&&p&&(b.append(y("<div>"+v+"</div>")),g.$element.trigger("maxReachedGrp.bs.select")),setTimeout(function(){g.setSelected(i,!1)},10),b.delay(750).fadeOut(300,function(){y(this).remove()})}}}else o.prop("selected",!1),a.prop("selected",!0),g.$menuInner.find(".selected").removeClass("selected"),g.setSelected(i,!0);g.multiple?g.options.liveSearch&&g.$searchbox.focus():g.$button.focus(),(n!=g.$element.val()&&g.multiple||s!=g.$element.prop("selectedIndex")&&!g.multiple)&&g.$element.trigger("changed.bs.select",[i,a.prop("selected"),l]).triggerNative("change")}}),this.$menu.on("click","li.disabled a, .popover-title, .popover-title :not(.close)",function(e){e.currentTarget==this&&(e.preventDefault(),e.stopPropagation(),g.options.liveSearch&&!y(e.target).hasClass("close")?g.$searchbox.focus():g.$button.focus())}),this.$menuInner.on("click",".divider, .dropdown-header",function(e){e.preventDefault(),e.stopPropagation(),g.options.liveSearch?g.$searchbox.focus():g.$button.focus()}),this.$menu.on("click",".popover-title .close",function(){g.$button.click()}),this.$searchbox.on("click",function(e){e.stopPropagation()}),this.$menu.on("click",".actions-btn",function(e){g.options.liveSearch?g.$searchbox.focus():g.$button.focus(),e.preventDefault(),e.stopPropagation(),y(this).hasClass("bs-select-all")?g.selectAll():g.deselectAll()}),this.$element.change(function(){g.render(!1)})},liveSearchListener:function(){var n=this,t=y('<li class="no-results"></li>');this.$button.on("click.dropdown.data-api touchstart.dropdown.data-api",function(){n.$menuInner.find(".active").removeClass("active"),n.$searchbox.val()&&(n.$searchbox.val(""),n.$lis.not(".is-hidden").removeClass("hidden"),t.parent().length&&t.remove()),n.multiple||n.$menuInner.find(".selected").addClass("active"),setTimeout(function(){n.$searchbox.focus()},10)}),this.$searchbox.on("click.dropdown.data-api focus.dropdown.data-api touchend.dropdown.data-api",function(e){e.stopPropagation()}),this.$searchbox.on("input propertychange",function(){if(n.$searchbox.val()){var e=n.$lis.not(".is-hidden").removeClass("hidden").children("a");(e=n.options.liveSearchNormalize?e.not(":a"+n._searchStyle()+'("'+$(n.$searchbox.val())+'")'):e.not(":"+n._searchStyle()+'("'+n.$searchbox.val()+'")')).parent().addClass("hidden"),n.$lis.filter(".dropdown-header").each(function(){var e=y(this),t=e.data("optgroup");0===n.$lis.filter("[data-optgroup="+t+"]").not(e).not(".hidden").length&&(e.addClass("hidden"),n.$lis.filter("[data-optgroup="+t+"div]").addClass("hidden"))});var i=n.$lis.not(".hidden");i.each(function(e){var t=y(this);t.hasClass("divider")&&(t.index()===i.first().index()||t.index()===i.last().index()||i.eq(e+1).hasClass("divider"))&&t.addClass("hidden")}),n.$lis.not(".hidden, .no-results").length?t.parent().length&&t.remove():(t.parent().length&&t.remove(),t.html(n.options.noneResultsText.replace("{0}",'"'+r(n.$searchbox.val())+'"')).show(),n.$menuInner.append(t))}else n.$lis.not(".is-hidden").removeClass("hidden"),t.parent().length&&t.remove();n.$lis.filter(".active").removeClass("active"),n.$searchbox.val()&&n.$lis.not(".hidden, .divider, .dropdown-header").eq(0).addClass("active").children("a").focus(),y(this).focus()})},_searchStyle:function(){return{begins:"ibegins",startsWith:"ibegins"}[this.options.liveSearchStyle]||"icontains"},val:function(e){return void 0!==e?(this.$element.val(e),this.render(),this.$element):this.$element.val()},changeAll:function(e){void 0===e&&(e=!0),this.findLis();for(var t=this.$element.find("option"),i=this.$lis.not(".divider, .dropdown-header, .disabled, .hidden").toggleClass("selected",e),n=i.length,s=[],o=0;o<n;o++){var a=i[o].getAttribute("data-original-index");s[s.length]=t.eq(a)[0]}y(s).prop("selected",e),this.render(!1),this.$element.trigger("changed.bs.select").triggerNative("change")},selectAll:function(){return this.changeAll(!0)},deselectAll:function(){return this.changeAll(!1)},toggle:function(e){(e=e||window.event)&&e.stopPropagation(),this.$button.trigger("click")},keydown:function(e){var t,i,n,s,o,a,l,r,d,h=y(this),c=h.is("input")?h.parent().parent():h.parent(),p=c.data("this"),u=":not(.disabled, .hidden, .dropdown-header, .divider)",m={32:" ",48:"0",49:"1",50:"2",51:"3",52:"4",53:"5",54:"6",55:"7",56:"8",57:"9",59:";",65:"a",66:"b",67:"c",68:"d",69:"e",70:"f",71:"g",72:"h",73:"i",74:"j",75:"k",76:"l",77:"m",78:"n",79:"o",80:"p",81:"q",82:"r",83:"s",84:"t",85:"u",86:"v",87:"w",88:"x",89:"y",90:"z",96:"0",97:"1",98:"2",99:"3",100:"4",101:"5",102:"6",103:"7",104:"8",105:"9"};if(p.options.liveSearch&&(c=h.parent().parent()),p.options.container&&(c=p.$menu),t=y("[role=menu] li",c),!(d=p.$newElement.hasClass("open"))&&(48<=e.keyCode&&e.keyCode<=57||96<=e.keyCode&&e.keyCode<=105||65<=e.keyCode&&e.keyCode<=90)&&(p.options.container?p.$button.trigger("click"):(p.setSize(),p.$menu.parent().addClass("open"),d=!0),p.$searchbox.focus()),p.options.liveSearch&&(/(^9$|27)/.test(e.keyCode.toString(10))&&d&&0===p.$menu.find(".active").length&&(e.preventDefault(),p.$menu.parent().removeClass("open"),p.options.container&&p.$newElement.removeClass("open"),p.$button.focus()),t=y("[role=menu] li"+u,c),h.val()||/(38|40)/.test(e.keyCode.toString(10))||0===t.filter(".active").length&&(t=p.$menuInner.find("li"),t=p.options.liveSearchNormalize?t.filter(":a"+p._searchStyle()+"("+$(m[e.keyCode])+")"):t.filter(":"+p._searchStyle()+"("+m[e.keyCode]+")"))),t.length){if(/(38|40)/.test(e.keyCode.toString(10)))i=t.index(t.find("a").filter(":focus").parent()),s=t.filter(u).first().index(),o=t.filter(u).last().index(),n=t.eq(i).nextAll(u).eq(0).index(),a=t.eq(i).prevAll(u).eq(0).index(),l=t.eq(n).prevAll(u).eq(0).index(),p.options.liveSearch&&(t.each(function(e){y(this).hasClass("disabled")||y(this).data("index",e)}),i=t.index(t.filter(".active")),s=t.first().data("index"),o=t.last().data("index"),n=t.eq(i).nextAll().eq(0).data("index"),a=t.eq(i).prevAll().eq(0).data("index"),l=t.eq(n).prevAll().eq(0).data("index")),r=h.data("prevIndex"),38==e.keyCode?(p.options.liveSearch&&i--,i!=l&&a<i&&(i=a),i<s&&(i=s),i==r&&(i=o)):40==e.keyCode&&(p.options.liveSearch&&i++,-1==i&&(i=0),i!=l&&i<n&&(i=n),o<i&&(i=o),i==r&&(i=s)),h.data("prevIndex",i),p.options.liveSearch?(e.preventDefault(),h.hasClass("dropdown-toggle")||(t.removeClass("active").eq(i).addClass("active").children("a").focus(),h.focus())):t.eq(i).children("a").focus();else if(!h.is("input")){var f,v=[];t.each(function(){y(this).hasClass("disabled")||y.trim(y(this).children("a").text().toLowerCase()).substring(0,1)==m[e.keyCode]&&v.push(y(this).index())}),f=y(document).data("keycount"),f++,y(document).data("keycount",f),y.trim(y(":focus").text().toLowerCase()).substring(0,1)!=m[e.keyCode]?(f=1,y(document).data("keycount",f)):f>=v.length&&(y(document).data("keycount",0),f>v.length&&(f=1)),t.eq(v[f-1]).children("a").focus()}if((/(13|32)/.test(e.keyCode.toString(10))||/(^9$)/.test(e.keyCode.toString(10))&&p.options.selectOnTab)&&d){if(/(32)/.test(e.keyCode.toString(10))||e.preventDefault(),p.options.liveSearch)/(32)/.test(e.keyCode.toString(10))||(p.$menuInner.find(".active a").click(),h.focus());else{var b=y(":focus");b.click(),b.focus(),e.preventDefault(),y(document).data("spaceSelect",!0)}y(document).data("keycount",0)}(/(^9$|27)/.test(e.keyCode.toString(10))&&d&&(p.multiple||p.options.liveSearch)||/(27)/.test(e.keyCode.toString(10))&&!d)&&(p.$menu.parent().removeClass("open"),p.options.container&&p.$newElement.removeClass("open"),p.$button.focus())}},mobile:function(){this.$element.addClass("mobile-device")},refresh:function(){this.$lis=null,this.liObj={},this.reloadLi(),this.render(),this.checkDisabled(),this.liHeight(!0),this.setStyle(),this.setWidth(),this.$lis&&this.$searchbox.trigger("propertychange"),this.$element.trigger("refreshed.bs.select")},hide:function(){this.$newElement.hide()},show:function(){this.$newElement.show()},remove:function(){this.$newElement.remove(),this.$element.remove()},destroy:function(){this.$newElement.before(this.$element).remove(),this.$bsContainer?this.$bsContainer.remove():this.$menu.remove(),this.$element.off(".bs.select").removeData("selectpicker").removeClass("bs-select-hidden selectpicker")}};var o=y.fn.selectpicker;y.fn.selectpicker=t,y.fn.selectpicker.Constructor=c,y.fn.selectpicker.noConflict=function(){return y.fn.selectpicker=o,this},y(document).data("keycount",0).on("keydown.bs.select",'.bootstrap-select [data-toggle=dropdown], .bootstrap-select [role="menu"], .bs-searchbox input',c.prototype.keydown).on("focusin.modal",'.bootstrap-select [data-toggle=dropdown], .bootstrap-select [role="menu"], .bs-searchbox input',function(e){e.stopPropagation()}),y(window).on("load.bs.select.data-api",function(){y(".selectpicker").each(function(){var e=y(this);t.call(e,e.data())})})}(e)});