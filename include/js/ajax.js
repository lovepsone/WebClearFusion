//
// Cross browser ajax upload class
//
var my_AJAX = new function (){
	var cache = new Array();
	//
	// Cross browser ajax object creation
	//
	this.getXmlHttp = function (){
		var xmlhttp = null;
		if (typeof XMLHttpRequest != "undefined")
			xmlhttp = new XMLHttpRequest();
		if (xmlhttp) return xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e1) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {}
		}
		return xmlhttp;
	}
	//
	// Upload data
	//
	this.upload = function(mode, url, oncomplete) {
		if (this.isCached(url)){
			oncomplete(this.getCache(url));
			return;
		}
		var ajax = this.getXmlHttp();
		if (!ajax) return 0;
		// Open url
		if (mode == "GET") {
			ajax.open(mode, url);
		} else {
			ajax.open(mode, url);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		}
		// Progress handler
		var self = this;
		ajax.onreadystatechange = function() {
		switch (ajax.readyState) {
			case 1: break;
			case 2: break;
			case 3: break;
			case 4:
				self.addCache(ajax.responseText, url);
				ajax.onreadystatechange = function() {};
				oncomplete(ajax.responseText);
				break;
			}
		};
		// Begin
		ajax.send(null);
	};
	this.GETupload = function(url, oncomplete) {
		this.upload('GET', url, oncomplete);
	};
	this.POSTupload = function(url, oncomplete) {
		this.upload('POST', url, oncomplete);
	};
	//
	// Cache functions
	//
	this.addCache = function(text, key) {
		cache[key] = text;
	};
	this.getCache = function(key) {
		return cache[key];
	};
	this.isCached = function(url) {
		return cache[url] ? true : false;
	};
}

//
// HTML added in innerHTML can contain java script code
// Need upload it and use
var scr_includes = new Array();
function execHTMLScripts(node)
{
	parseScript(node.getElementsByTagName('script'), 0);
}
function parseScript(list, n)
{
	if (list.length<=n)
		return;
	var script = list[n++];
	var id = script.src ? script.src : script.id;
	if (id && !scr_includes[id])
	{
		scr_includes[id] = true;
		var s = document.createElement('script');
		document.getElementsByTagName('head')[0].appendChild(s);
		s.id  = script.id;
		s.text= script.text;
		// in IE onload event not work, but work onreadystatechange
		if (script.src){
			s.onload			 = function(){this.onload = this.onreadystatechange = function(){}; parseScript(list, n);}
			s.onreadystatechange = function(){if (this.readyState == 'loaded' || this.readyState == 'complete') this.onload();}
			s.src = script.src;
			return;
		}
	}
	else if (!id)
		eval(script.text);
	parseScript(list, n);
}