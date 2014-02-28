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
		global $_SESSION, $_SERVER;
		//http://phpguru.com.ua/posts.php?id=19 //http://habrahabr.ru/post/13726/
		ob_start();
		if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']))
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
		else if (isset($_SESSION['user_id']) || ($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']))
		{
		
			echo THEME_BULLET." <a href='#' class='white'>".WCF::getLocale('auth', 6)."</a>";
			echo THEME_BULLET." <a href='".WCF::$cfgSetting['opening_page']."?action=logout' class='white'>".WCF::getLocale('auth', 7)."</a>";
		}
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}


/*
function render_comments($c_data, $c_info){
	global $locale;
	opentable($locale['c100']);
	if (!empty($c_data)){
		echo "<div class='comments floatfix'>\n";
			$c_makepagenav = '';
			if ($c_info['c_makepagenav'] !== FALSE) { 
			echo $c_makepagenav = "<div style='text-align:center;margin-bottom:5px;'>".$c_info['c_makepagenav']."</div>\n"; 
		}
			foreach($c_data as $data) {
			echo "<div class='tbl2'>\n";
			if ($data['edit_dell'] !== FALSE) { 
				echo "<div style='float:right' class='comment_actions'>".$data['edit_dell']."\n</div>\n";
			}
			echo "<a href='".FUSION_REQUEST."#c".$data['comment_id']."' id='c".$data['comment_id']."' name='c".$data['comment_id']."'>#".$data['i']."</a> |\n";
			echo "<span class='comment-name'>".$data['comment_name']."</span>\n";
			echo "<span class='small'>".$data['comment_datestamp']."</span>\n";
			echo "</div>\n<div class='tbl1 comment_message'>".$data['comment_message']."</div>\n";
		}
		echo $c_makepagenav;
		if ($c_info['admin_link'] !== FALSE) {
			echo "<div style='float:right' class='comment_admin'>".$c_info['admin_link']."</div>\n";
		}
		echo "</div>\n";
	} else {
		echo $locale['c101']."\n";
	}
	closetable();   
}
*/
	function RenderNews($subject, $news, $info)
	{
		echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
		echo "<td class='capmain-left'></td>\n";
		echo "<td class='capmain'>".$subject."</td>\n";
		echo "<td class='capmain-right'></td>\n";
		echo "</tr>\n</table>\n";
		echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
		echo "<td class='main-body middle-border'>".$info['cat_image'].$news."</td>\n";
		echo "</tr>\n<tr>\n";
		echo "<td align='center' class='news-footer middle-border'>\n";
		//echo newsposter($info," &middot;").newscat($info," &middot;").newsopts($info,"&middot;").itemoptions("N",$info['news_id']);
		echo "</td>\n";
		echo "</tr><tr>\n";
		echo "<td style='height:5px;background-color:#f6a504;'></td>\n";
		echo "</tr>\n</table>\n";
	}
/*
function render_article($subject, $article, $info) {
	
	echo "<table width='100%' cellpadding='0' cellspacing='0'>\n<tr>\n";
	echo "<td class='capmain-left'></td>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "<td class='capmain-right'></td>\n";
	echo "</tr>\n</table>\n";
	echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
	echo "<td class='main-body middle-border'>".($info['article_breaks'] == "y" ? nl2br($article) : $article)."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td align='center' class='news-footer'>\n";
	echo articleposter($info," &middot;").articlecat($info," &middot;").articleopts($info,"&middot;").itemoptions("A",$info['article_id']);
	echo "</td>\n</tr>\n</table>\n";

}
*/
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
