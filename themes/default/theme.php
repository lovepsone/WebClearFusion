<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: teme.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//==========================================
	// Функции открытия и закрытия таблиц,панелей
	function opentable()
		{
			echo"<table cellpadding='0' cellspacing='0' width='100%'><tr>";
			echo"<td class='capmain-top-left'></td><td class='capmain-top'></td><td class='capmain-top-right'></td>\n";
			echo"</tr></table>";

			echo"<table cellpadding='0' cellspacing='0' width='100%'>";
			echo"<tr><td class='capmain-side-left'><td class='main-body'>";
			echo"<table cellpadding='0' cellspacing='0' style='width:100%'>";
		}

	function closetable()
		{
			echo"</table></td><td class='capmain-side-right'></tr></table>";
			echo"<table cellpadding='0' cellspacing='0' width='100%'><tr>";
			echo"<td class='capmain-foot-left'></td><td class='capmain-foot'></td><td class='capmain-foot-right'></td>\n";
			echo"</tr></table>";
		}

	function openside()
		{
			echo"<table cellpadding='0' cellspacing='0' width='100%'><tr>";
			echo"<td class='scapmain-top-left'></td><td class='scapmain-top'></td><td class='scapmain-top-right'></td>\n";
			echo"</tr></table>";

			echo"<table cellpadding='0' cellspacing='0' width='100%'>";
			echo"<tr><td class='scapmain-side-left'><td class='scapmain-body'>";
			echo"<table cellpadding='0' cellspacing='0' style='width:100%'>";
		}

	function closeside()
		{
			echo"</table></td><td class='scapmain-side-right'></tr></table>";
			echo"<table cellpadding='0' cellspacing='0' width='100%'><tr>";
			echo"<td class='scapmain-foot-left'></td><td class='scapmain-foot'></td><td class='scapmain-foot-right'></td>";
			echo"</tr></table>";
		}

	//==========================================
	//Содержание
	echo"<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Frameset//EN' 'http://www.w3.org/TR/html4/frameset.dtd'>";
	echo"<head><link rel='SHORTCUT ICON' href='images/favicon.ico'>";
	echo"<title>".$config['servername']."</title>";
	echo"<LINK href='".THEMES."/default/style.css' type=text/css rel=stylesheet>";
	echo"<LINK href='administration/administration.css' type=text/css rel=stylesheet>";
	echo"<META http-equiv='content-type' content='text/html; charset=$code_page' /></HEAD>";
	echo"<body>";

	echo"<table cellpadding='0' cellspacing='0' width='100%'>";
	echo"<tr><td class='full-header' align='center'><img src='".THEMES."/default/img/baners.png' alt='".$config['servername']."' style='border: 0;' /></td></tr>";
	echo"</table>";

	echo"<table cellpadding='0' cellspacing='0' width='100%'><tr>";
	echo"<td class='side-border-left' valign='top'>";
	require "panels/panels_l.php";
	echo"</td>";

	echo "<td class='main-bg' valign='top'>";
	require "panels/panels_c.php";
	echo"</td>";

	echo"<td class='side-border-right' valign='top'>";
	require "panels/panels_r.php";
	echo"</td>";
	echo"</tr></table>";

	echo"<br><br>";
	echo"<div class='copyright'><hr width='90%'><font size=-1>".$config['copyright']."</font></div><br>";

	if($config['change_lang'] == 'on')
		{
			echo"<select size='1' name='lang_list' onchange=\"document.location.href='index.php?lang='+this.value;\">
             			<option selected>".$txt['change_lang']."</option>
             			<option value='ru'>ru</option>
             			<option value='en'>en</option>
			</select>";
  		}
	echo"</body>";