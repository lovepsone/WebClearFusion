<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: theme.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once BASEDIR."include/functions_theme.php";
	//==========================================
	// Функция генерирует страницу
	function render_page($license = false)
		{
	
			global $config, $txt;

			echo"<table cellpadding='0' cellspacing='0' width='100%'>";
			echo"<tr><td class='full-header' align='center'><img src='".THEMES."/".$config['theme']."/img/baners.png' alt='".$config['servername']."' style='border: 0;' /></td></tr>";
			echo"</table>";
	
			echo"<table cellpadding='0' cellspacing='0' width='100%'><tr>";
			if (LEFT) { echo"<td class='side-border-left' valign='top'>".LEFT."</td>"; }
			echo"<td class='main-bg' valign='top'>".U_CENTER.CONTENT.L_CENTER."</td>";
			if (RIGHT) { echo"<td class='side-border-right' valign='top'>".RIGHT."</td>";}
			echo"</tr></table>";
	
			echo"<br><br>";
			echo"<div class='copyright'><hr width='90%'><font size=-1>".$config['copyright']."</font></div><br>";

			if($config['change_lang'] == 'on')
				{
					echo"<select size='1' name='lang_list' onchange=\"document.location.href='index.php?lang='+this.value;\">
             					<option selected>".$txt['change_lang']."</option>
             					<option value='russian'>Russian</option>
             					<option value='english'>English</option>
						</select>";
  				}
		}

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
			echo"</tr></table><br>";
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
			echo"</tr></table><br>";
		}
