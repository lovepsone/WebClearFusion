<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: theme.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	define("THEME_BULLET", "<span class='bullet'>&middot;</span>");

	function RenderPage($license = false)
	{
		global $main_style;
		//Header
		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td class='sub-header-left'></td>\n";
		echo "<td class='sub-header'>".WCF::$ST->ShowsubLinks(" ".THEME_BULLET." ", "white")."</td>\n";
		echo "<td align='right' class='sub-header'></td>\n";
		echo "<td class='sub-header-right'></td>\n";
		echo "</tr>\n</table>\n";

		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td class='full-header'>\n".WCF::$ST->ShowBanners()."</td>\n";
		echo "</tr>\n</table>\n";
	
		//Content
		echo "<table cellpadding='0' cellspacing='0' width='100%' class='$main_style'>\n<tr>\n";
		if (LEFT)
		{
			echo "<td class='side-border-left' valign='top'>".LEFT."</td>";
		}
		echo "<td class='main-bg' valign='top'>".U_CENTER.CONTENT.L_CENTER."</td>";
		if (RIGHT)
		{
			echo "<td class='side-border-right' valign='top'>".RIGHT."</td>";
		}
		echo "</tr>\n</table>\n";
	
		//Footer
		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td class='sub-header-left'></td>\n";
		echo "<td align='left' class='sub-header'>".WCF::$ST->ShowsubDate()."</td>\n";
		echo "<td align='right' class='sub-header'></td>\n";
		echo "<td class='sub-header-right'></td>\n";
		echo "</tr>\n</table>\n";
		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td align='center' class='main-footer'><div style='text-align:center'>Copyright &copy; 2014</div>";
		if (!$license)
		{
			echo "<br /><br />\n".WCF::$ST->ShowCopyright();
		}
		echo "</td>\n";
		echo "</tr>\n</table>\n";
	}

	function opentable($title)
	{

		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td class='capmain-left'></td>\n";
		echo "<td class='capmain'>".$title."</td>\n";
		echo "<td class='capmain-right'></td>\n";
		echo "</tr>\n</table>\n";
		echo "<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>\n<tr>\n";
		echo "<td class='main-body'>\n";
	}

	function closetable()
	{
		echo "</td>\n";
		echo "</tr><tr>\n";
		echo "<td style='height:5px;background-color:#f6a504;'></td>\n";
		echo "</tr>\n</table>\n";
	}

	function openside($title)
	{
		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td class='scapmain-left'></td>\n";
		echo "<td class='scapmain'>".$title."</td>\n";
		echo "<td class='scapmain-right'></td>\n";
		echo "</tr>\n</table>\n";
		echo "<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>\n<tr>\n";
		echo "<td class='side-body'>\n";
	}

	function closeside()
	{	
		echo "</td>\n</tr>\n</table>\n";

	}
?>
