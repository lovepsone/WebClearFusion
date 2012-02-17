//
// Custom project scripts
//
function $() {
	var elements = new Array();
	for (var i = 0; i < arguments.length; i++) {
		var element = arguments[i];
		if (typeof element == 'string')
			element = document.getElementById(element);
		if (arguments.length == 1)
			return element;
		elements.push(element);
	}
	return elements;
}

function getElementsByClass(searchClass,node,tag)
{
	var classElements = new Array();
	if ( node == null )
		node = document;
	if ( tag == null )
		tag = '*';
	var els = node.getElementsByTagName(tag);
	var pattern = new RegExp("(^|\\s)" + searchClass + "(\\s|$)");
	for (i = 0; i < els.length; i++)
		if ( pattern.test(els[i].className) )
			classElements.push(els[i]);
	return classElements;
}

function getBody(){
	return document.body||document.documentElement||(document.getElementsByTagName ? document.getElementsByTagName("body")[0] : null);
}

function getPageRect(){
	var b = document.body || document.documentElement,
	sTop = window.pageYOffset || b.scrollTop,
	sLeft = window.pageXOffset || b.scrollLeft,
	sWidth=  b.clientWidth || window.innerWidth,
	sHeight= b.clientHeight || window.innerHeight,
	oWidth=  b.scrollWidth || b.offsetWidth,
	oHeight= b.scrollHeight || b.offsetHeight;
	return {top: sTop, left: sLeft, width: sWidth, height: sHeight, scrollX: oWidth, scrollY: oHeight};
}

function getBounds(e)
{
	var left = e.offsetLeft, top = e.offsetTop, width = e.offsetWidth, height = e.offsetHeight;
	while (e = e.offsetParent){
		left += e.offsetLeft;
		top += e.offsetTop;
	}
	return {left: left, top: top, width: width, height: height};
}

function insertElement(parent, tag, id)
{
	if(parent.insertAdjacentHTML)
	{
		parent.insertAdjacentHTML("afterBegin", '<'+tag+ ' id="'+id+'"></'+tag+'>');
		return document.getElementById(id);
	}
	else if(document.createElement && parent.appendChild)
	{
		var el = document.createElement(tag);
		el.id = id;
		parent.appendChild(el);
		return el;
	}
	return 0;
}
function addEvent(el, sEvt, PFnc)
{
	if(el)
	{
		if(el.addEventListener)
			el.addEventListener(sEvt, PFnc, false);
		else
			el.attachEvent("on" + sEvt, PFnc);
	}
}
function addLoadEvent(func)
{
	var oldonload = window.onload;
	if (typeof window.onload != 'function')
		window.onload = func;
	else
		window.onload = function(){oldonload();func();}
}
function removeEvent(el, sEvt, PFnc)
{
	if(el)
	{
		if(el.removeEventListener)
			el.removeEventListener(sEvt, PFnc, false);
		else
			el.detachEvent("on" + sEvt, PFnc);
	}
}
function ChangeCssProperty(myclass, element, value)
{
	var CSSRules = document.styleSheets[0].rules || document.styleSheets[0].cssRules;
	for (var i = 0; i < CSSRules.length; i++)
		if (CSSRules[i].selectorText.toLowerCase() == myclass.toLowerCase())
			CSSRules[i].style[element] = value;
}
function getOpaSettings()
{
	var p = null;
	var s = document.body.style;
	if (typeof s.opacity == 'string') p = 'opacity';
	else if (typeof s.MozOpacity == 'string') p =  'MozOpacity';
	else if (typeof s.KhtmlOpacity == 'string') p =  'KhtmlOpacity';
	else if (document.body.filters && navigator.appVersion.match(/MSIE ([\d.]+);/)[1]>=5.5) p='filter';
	return p;
}
function setOpacity(oElem, nOpacity)
{
	var p = getOpaSettings();
	if (p=='filter')
		setOpacity = new Function('oElem', 'nOpacity', 'if (nOpacity >= 100) {oElem.style.filter = ""; return;} var oAlpha = oElem.filters["DXImageTransform.Microsoft.alpha"] || oElem.filters.alpha; if (oAlpha) oAlpha.opacity = nOpacity;else {oElem.style.zoom = 1;oElem.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity="+nOpacity+")";}');
	else if (p)
		setOpacity = new Function('oElem', 'nOpacity', 'oElem.style.'+p+' = nOpacity/100;');
	else
		setOpacity = new Function(oElem, nOpacity);
	return setOpacity(oElem, nOpacity);
}
function getOpacity(oElem)
{
	var p = getOpaSettings();
	if (p=='filter')
		getOpacity = new Function('oElem', 'var m = oElem.style.filter.match(/alpha\(opacity=(.+)\)/i); return m ? parseFloat(m[1]) : 1;');
	else if (p)
		getOpacity = new Function('oElem', 'var v = oElem.style.'+p+'; return v*100;');
	else
		getOpacity = new Function(oElem);
	return getOpacity(oElem);
}
Number.prototype.Timer = function(s, iT, bUrge){
	this.EndTimer();
	if(!this.value || bUrge)
		this.value = window.setTimeout(s, iT);
}
Number.prototype.EndTimer = function(){
	if(this.value){
		window.clearTimeout(this.value);
		this.value = 0;
	}
}
function parseURL(url)
{
	// Example "https://www.example.com:8080/some/path/index.html?p=1&q=2&r=3#some-hash"
	var patern =
	// #0 URL
	"^" +
	// #1 PROTOCOL, "https"
	"(?:([^:/\\?#]*):)?" +
	// #2 HOST, "www.example.com",
	"(?://([^:/\\?#]*))" +
	// #3 PORT, "8080"
	"(?::([^/\\?#]*))?" +
	// #4 PATH, "/some/path/index.html"
	"(?:([^\\?#]*))" +
	// #5 QUERY, "p=1&q=2&r=3"
	"(?:\\?([^#]*))?" +
	// #6 FRAGMENT, "some-hash"
	"(?:#(.*))?" + "$";
	return RegExp(patern).exec(url);
}

//
// Link event add function
//
function parseHref(element)
{
	var tip={'item':'i', 'spell':'s', 'enchant':'e', 'npc':'c', 'faction':'f'};
	var ext={'jpg':1, 'jpeg':1, 'png':1};
	var c = element.getElementsByTagName("a");
	for (var i = 0; i < c.length; i++)
	{
		var a = c[i];
		var url = parseURL(a.href);
		if (!url) continue;
		// Parse file
		if (!url[4]) continue;
		var e = url[4].split('.');
		if (e.length > 1 && ext[e[e.length-1]]) a.onclick = showLightbox;
		// Parse params
		if (!url[5]) continue;
		var p=url[5].split('&');
		var r=p[0].split('=');
		// Add tooltip event
		if (p.length==1&&tip[r[0]]&&r[1]&&!a.id) {a.id=tip[r[0]]+r[1]; a.onmouseover = tt_hrefTip;}
		// Add light box event
		else if(r[0]=='map' && !a.onclick) a.onclick = showAjaxBox;
	}
}
//
// Upload data as HTML in obj.innerHTML via ajax functions
//
function ajaxCacheHtml(element, url) {
	my_AJAX.addCache(element.innerHTML, 'ajax.php'+url);
}

function ajaxCacheHtmlId(elementId, url) {
	ajaxCacheHtml(document.getElementById(elementId), url);
}
function uploadFromHref(link, elementId) {
	var url = link.href.substring(link.href.indexOf('?'), link.href.length);
	uploadHtmlToId(url, elementId);
	return false;
}
function uploadHtmlToId(url, elementId) {
	uploadHtml(url, $(elementId));
}
function uploadHtml(url, element)
{
	var obj = element;
	function callback(text) {
		obj.innerHTML = text;
		execHTMLScripts(obj);
		parseHref(obj);
	}
	my_AJAX.GETupload('ajax.php'+url, callback);
}
//
// Report tabs support functions
//
function report_setSelect(tab, selected)
{
	var l = tab.id.split(':');
	var element = $(l[1]);
	if (!element) return;
	element.style.display = selected ? "block" : "none";
	tab.className = selected ? 'selected' : '';
}
function report_selectTab(page)
{
	var tab = $('report_tabs');
	if (!tab) return;
	var els = tab.getElementsByTagName('li');
	for (i = 0; i < els.length; i++)
		report_setSelect(els[i], els[i].id == page.id)
}
function report_hideHeaders()
{
	ChangeCssProperty('TABLE.report TR.head', 'display', 'none');
}
function report_addTab(name, elementId, selected)
{
	var tab = $('report_tabs');
	if (!tab) return;
	tab.innerHTML += '<li id="t:' + elementId + '" onClick="report_selectTab(this);"><a>' + name + '</a></li>';
	report_setSelect($('t:' + elementId), selected);
}
//
// Debug layer
//
var debugDiv = 0;
document.write('<div id=debug></div>');
function outDebug(text)
{
	var debugDiv = $('debug');
	if (!debugDiv)
	{
		debugDiv = document.createElement('div');
		document.body.appendChild(debugDiv);
		debugDiv.style.position = 'fixed';
		debugDiv.style.border = '1px solid';
		debugDiv.style.background = '#EEE';
		debugDiv.style.top = 0;
		debugDiv.style.left = 0;
		debugDiv.style.width = '800px';
	}
	debugDiv.innerHTML=text + '<br>';
}