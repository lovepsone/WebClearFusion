/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: LoadTooltips.js
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

$(document).ready(function(){ $("a, input").tooltip({
	track: true,
	delay: 100,
	showBody: "::",
	showURL: false,
	opacity: 0.85
});});
