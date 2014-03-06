<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: color_var.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

$__BBCODE__[] = 
array(
"description"		=>	WCF::getLocale('bbcodes', 6),
"value"			=>	"color",
"bbcode_start"		=>	"[color=#000000]",
"bbcode_end"		=>	"[/color]",
"usage"			=>	"[color=#".WCF::getLocale('bbcodes', 8)."]".WCF::getLocale('bbcodes', 7)."[/color]",
"onclick"		=>	"return overlay(this, 'bbcode_color_map_".$TextAreaName."', 'rightbottom');",
"onmouseover"		=>	"",
"onmouseout"		=>	"",
"html_start"		=>	"<div id='bbcode_color_map_".$TextAreaName."' class='tbl1 bbcode-popup' style='display:none;border:1px solid black;position:absolute;width:220px;height:160px' onclick=\"overlayclose('bbcode_color_map_".$TextAreaName."');\">",
"includejscript"	=>	"color_js.js",
"calljscript"		=>	"ColorMap('".$TextAreaName."', '".$InputFormName."');",
"wcf"			=>	"",
"html_middle"		=>	"",
"html_end"		=>	"</div>",
);
?>