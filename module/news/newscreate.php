<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: newscreate.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$w_connect = mysql_connect($config['whostname'], $config['wusername'], $config['wpassword']);
	mysql_select_db($config['wdbName'], $w_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	echo"<tr><td width= '100%'>";

	require $modules['adminmenu'][0];
   	require "include/tinymce.php";
   	echo $edit_script;

	// форма создания новостей
	echo"<form method='post'>";
	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	
        echo"<tr><td width='10%' height='30' align='right' valign='middle'>$txt[admin_teme_news]</td>";
	echo"<td width='1%' height='30' >&nbsp;</td>";
        echo"<td width='89%' height='30' align='left' valign='middle'><input name='modul' value='newscreate' type=hidden><input type='text' name='tema' size='40'></td></tr>";

        echo"<tr><td width='100' height='30' align='right' valign='middle'>$txt[admin_typ_news]</td>";
	echo"<td width='10' height='30' >&nbsp;</td>";
        echo"<td width='510' height='30' align='left' valign='middle'><input name='cmd' value='create' type=hidden>";

        echo"<select name=cat>
             <option value=0 selected>$txt[typ_news_0]</option>
             <option value=1>$txt[typ_news_1]</option>
             <option value=2>$txt[typ_news_2]</option>
             <option value=3>$txt[typ_news_3]</option>
             <option value=4>$txt[typ_news_4]</option>
             <option value=5>$txt[typ_news_5]</option>
             <option value=6>$txt[typ_news_6]</option></select>";
	echo"</td></tr></table>";

	echo"<textarea name='news'></textarea>";
	echo"<br><center><input type='submit' value='$txt[menu_admin_news_create]'/></center></form>";

    	if ($_POST['cmd'] == create)
		{	// на до бы придумать что - то другое. кусок кода мне не нравится
        		if ($_POST['tema'] <> '') $nt = addslashes($_POST['tema']);
	    		//else $nt = $txt['typ_news_".(int)$_POST['сat']."'];

			$nt = addslashes($_POST['tema']);
			$addQuery = 'insert into `wcf_news` (`title`,`text`,`cat`) values ("'.$nt.'","'.text_optimazer($_POST['news']).'",'.((int)$_POST['cat']).')';
       			mysql_query($addQuery) or trigger_error(mysql_error());

        		echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=newscreate';//--> </script>";
		}

	echo"</td></tr></table>";
?>