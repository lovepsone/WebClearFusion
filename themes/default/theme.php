<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: theme.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//==========================================
	// Функция генерирует страницу
	function render_page($license = false)
	{
		echo"<table cellpadding='0' cellspacing='0' width='100%'>";
		echo"<tr>".AddMenu()."</tr>";
		echo"<tr><td class='full-header' align='center'>".WCF::$FW->showbanners()."</td></tr>";
		echo"</table>";

		echo"<table cellpadding='0' cellspacing='0' width='100%'><tr>";
		if (LEFT) { echo"<td class='side-border-left' valign='top'>".LEFT."</td>"; }
		echo"<td class='main-bg' valign='top'>".U_CENTER.CONTENT.L_CENTER."</td>";
		if (RIGHT) { echo"<td class='side-border-right' valign='top'>".RIGHT."</td>";}
		echo"</tr></table>";

		echo"<br><br>";
		echo"<div class='copyright'><hr width='90%'><font size=-1>".WCF::$cfgTitle['copyright']."</font></div><br>";
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

	function openside($title = '')
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

	function AddMenu()
	{
		$rows = WCF::$DB->select(' -- CACHE: 180
			SELECT * FROM ?_navigation_links WHERE link_position = 1 ORDER BY link_order ASC');

		if ($rows != null)
		{
			echo"<td id='menu' width='100%'><ul>";
			foreach ($rows as $numRow => $data)
			{
				if (check_user($data['link_visibility']) && $data['link_url'] != "---" && $data['link_name'] != "---")
					echo"<li><a href='".BASEDIR.$data['link_url']."'><span>".$data['link_name']."</span></a></li>";
			}
			echo"</ul></td>";
		}
		else
			echo WCF::$locale['no_links'];
			
	}
?>