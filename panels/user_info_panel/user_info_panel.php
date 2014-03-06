<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: user_info_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if (MEMBER)
	{
		openside($USER['Name']);
		echo THEME_BULLET." <a href='".BASEDIR."news.php' class='side'>".WCF::getLocale('auth', 6)."</a><br />\n";
		echo THEME_BULLET." <a href='".BASEDIR."news.php' class='side'>".WCF::getLocale('auth', 10)."</a><br />\n";

		if (ADMINISTRATOR)
		{
			echo THEME_BULLET." <a href='".ADMIN."index.php' class='side'>".WCF::getLocale('auth', 9)."</a><br />\n";
		}

		echo THEME_BULLET." <a href='".WCF::$cfgSetting['opening_page']."?action=logout' class='side'>".WCF::getLocale('auth', 7)."</a>\n";
		closeside();
	}
	else
	{
		openside(WCF::getLocale('auth', 0));
		echo "<div style='text-align:center'>\n";
		echo "<form name='loginform' method='post'>\n";
		echo WCF::getLocale('auth', 2)."<br />\n<input type='text' name='auth_name' class='textbox' style='width:100px' /><br />\n";
		echo WCF::getLocale('auth', 3)."<br />\n<input type='password' name='auth_pass' class='textbox' style='width:100px' /><br />\n";
		echo "<input type='submit' name='login' value='".WCF::getLocale('auth', 4)."' class='button' /><br />\n";
		echo "</form>\n<br />\n";
		echo "<a href='#' class='side'>".WCF::getLocale('auth', 5)."</a><br /><br />\n";
		echo "</div>\n";
		closeside();
	}

?>