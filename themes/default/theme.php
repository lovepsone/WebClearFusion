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
		echo "<td align='right' class='sub-header'>".RenderAuth()."</td>\n";
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

	function RenderAuth()
	{
		global $USER, $_SERVER;
		ob_start();
		if (GUEST)
		{
			echo "<div id='slider' style='margin-top: 10px'><div id='slider-in'><form name='loginform' action='".WCF_SELF."' method='post'>";
			echo "<p style='padding-bottom: 2px; color: #555; text-decoration: none;'>".WCF::getLocale('auth', 2)."</p>";
			echo "<input type='text' name='auth_name' id='login' class='textbox'>";
			echo "<p style='padding-bottom: 2px; color: #555; text-decoration: none;'>".WCF::getLocale('auth', 3)."</p>";
			echo "<input type='password' name='auth_pass' class='textbox'>";
			echo "<input type='submit' name='btnsubmit' value='".WCF::getLocale('auth', 4)."' style='width: 100px; height: 25px; margin-top: -50px' class='button'>";
			echo "</form></div>";
		
			echo "<div id='open-div-auth'><a href='' id='open-button-auth' class='white'>".WCF::getLocale('auth', 0)."</a> | <a href='#' class='white'>".WCF::getLocale('auth', 5)."</a></div>";
			echo "<div id='close-div-auth' style='display:none'><a href='#' id='close-button-auth' class='side'>".WCF::getLocale('auth', 1)."</a></div>";
			echo "</div>";
		}
		else
		{
		
			echo THEME_BULLET." <a href='#' class='white'>".WCF::getLocale('auth', 6)."</a>";
			echo THEME_BULLET." <a href='".WCF::$cfgSetting['opening_page']."?action=logout' class='white'>".WCF::getLocale('auth', 7)."</a>";
		}
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
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
