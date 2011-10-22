<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: tinymce.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$advanced_script = '<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script><script type="text/javascript">
	tinyMCE.init(
		{
			// General options
			mode : "textareas",
			theme : "advanced",
			language : "ru",
			width : "100%",
			height : "300",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : false,

			// Example content CSS (should be your site CSS)
			content_css : "js/tiny_mce/tiny_mce.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "js/tiny_mce/lists/template_list.js",
			external_link_list_url : "js/tiny_mce/lists/link_list.js",
			external_image_list_url : "js/tiny_mce/lists/image_list.js",
			media_external_list_url : "js/tiny_mce/lists/media_list.js",

			// skin options
			skin : "o2k7",
			skin_variant : "silver",
		}
	);</script>';

	$simple_script = '<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script><script type="text/javascript">
	tinyMCE.init(
		{
			// General options
			mode : "textareas",
			theme : "simple",
			language : "ru",
			width : "60%",
			height : "150",

			// Example content CSS (should be your site CSS)
			content_css : "js/tiny_mce/tiny_mce.css",

			// skin options
			skin : "o2k7",
			skin_variant : "silver",
		}
	);</script>';
?>