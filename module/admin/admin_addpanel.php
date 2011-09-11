<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: admin_crtpanel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$w_connect = mysql_connect($config['whostname'], $config['wusername'], $config['wpassword']);
	mysql_select_db($config['wdbName'], $w_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

	$patch = "panels/name/name_files_panel.php";
	$name = "name panel";
	require $modules['adminmenu'][0];

       	echo"<form method='post'>";
	echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";

        echo"<tr><td width='20%' height='30' align='right' valign='middle'>$txt[admin_panels_name]&nbsp;</td>";
        echo"<td width='80%' height='30' align='left' valign='middle'><input name='modul' value='adminaddpanel' type=hidden><input type='text' name='panel_add_name' size='60' value='$name'></td></tr>";

        echo"<tr><td width='20%' height='30' align='right' valign='middle' title = '$txt[admin_panels_patch_title]'>$txt[admin_panels_url]&nbsp;</td>";
	echo"<td width='80%' height='30' align='left' valign='middle'><input name='modul' value='adminaddpanel' type=hidden><input type='text' name='panel_add_url' size='60' value='$patch'></td></tr>";

        echo"<tr><td width='20%' height='30' align='right' valign='middle'>$txt[admin_panels_position]&nbsp;</td>";
	echo"<td width='80%' height='30' align='left' valign='middle'><input name='cmd' value='addpanel' type=hidden>";

        echo"<select name=panel_add_position>
             	<option value=0 selected>$txt[admin_panels_center]</option>
             	<option value=1>$txt[admin_panels_left]</option>
             	<option value=2>$txt[admin_panels_right]</option></select>";
	echo"</td></tr></table>";

	echo"<br><center><input type='submit' value='$txt[menu_admin_add_panel]'/></center></form>";

   	if ($_POST['cmd'] == addpanel)
		{
			$panel_add = mysql_query("INSERT INTO `wcf_panels` (`panel_name`,`panel_url`,`panel_position`) VALUES ('".$_POST['panel_add_name']."','".$_POST['panel_add_url']."','".(int)$_POST['panel_add_position']."')") or trigger_error(mysql_error());

			if($panel_add == true) { echo"$txt[admin_panels_add_success]"; } else { echo"$txt[admin_panels_choose_unsuccess]"; }

        		echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=adminaddpanel';//--> </script>";
			ReturnAdminAddpanel(10);
       		}
?>
