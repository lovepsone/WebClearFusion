<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: admin_setpanel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	selectdb(wcf);
	require $modules['adminmenu'][0];

	$panels_sql = mysql_query("SELECT * FROM `wcf_panels`") or trigger_error(mysql_error());

	echo"<form method='post'>";
	echo"<table width='90%' border='0' cellspacing='0' cellpadding='5' class='report'>";
   	echo"<tr><th class='head'>$txt[admin_panels_choice]</th>";
	echo"<th>$txt[admin_panels_name]</th>";
	echo"<th>$txt[admin_panels_url]</th>";
	echo"<th>$txt[admin_panels_position]</th></tr>";

	if (mysql_num_rows($panels_sql) > 0 )
		{
   			while ($panels = mysql_fetch_array($panels_sql))
				{
					if($panels['panel_position'] == '0') { $panel_position = $txt[admin_panels_center]; } else if($panels['panel_position'] == '1') { $panel_position = $txt[admin_panels_left]; } else { $panel_position = $txt[admin_panels_right];}

          				echo"<tr><td align='left' class='page'><input name=panel_id type=radio value='".$panels['panel_id']."'></td>";
          				echo"<td align='left' class='page'>".$panels['panel_name']."</td>";
          				echo"<td align='left' class='page'>".$panels['panel_url']."</td>";
          				echo"<td align='left' class='page'>$panel_position</td></tr>";
          				$kol++;
          			}

    		}

	echo"<tr><td colspan='4' align='center' class='page'><input action='index.php' name='change' value='adminsetpanel' type=hidden><input type='submit' value='$txt[admin_panels_change]'></td></tr></table></form>";

	if ( isset($_POST['change']) )
		{
   			if (isset($_POST['panel_id']) AND ($_POST['panel_id'] > 0))
				{
       					$panel_sql = mysql_query("SELECT * FROM `wcf_panels` where `panel_id` = ".$_POST['panel_id'].' limit 1') or trigger_error(mysql_error());
	   				$panel = mysql_fetch_assoc($panel_sql);

       					echo"<form method='post'>";
					echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";

             				echo"<tr><td width='20%' height='30' align='right' valign='middle'>$txt[admin_panels_name]&nbsp;</td>";
             				echo"<td width='80%' height='30' align='left' valign='middle'><input name='modul' value='adminsetpanel' type=hidden><input type='text' name='panel_set_name' size='60' value='".$panel['panel_name']."'></td></tr>";

             				echo"<tr><td width='20%' height='30' align='right' valign='middle'>$txt[admin_panels_url]&nbsp;</td>";
             				echo"<td width='80%' height='30' align='left' valign='middle'><input name='modul' value='adminsetpanel' type=hidden><input type='text' name='panel_set_url' size='60' value='".$panel['panel_url']."'></td></tr>";

        				echo"<tr><td width='20%' height='30' align='right' valign='middle'>$txt[admin_panels_position]&nbsp;</td>";
					echo"<td width='80%' height='30' align='left' valign='middle'><input name='cmd' value='change' type=hidden><input name='panel_set_id' value='".$panel['panel_id']."' type=hidden>";
        				echo"<select name=panel_set_position>
             					<option value=0 selected>$txt[admin_panels_center]</option>
             					<option value=1>$txt[admin_panels_left]</option>
             					<option value=2>$txt[admin_panels_right]</option></select>";
					echo"</td></tr></table>";

       					echo"<br><center><input type='submit' value='$txt[admin_panels_change]'/></center></form>";
      				}
		}
   	if ($_POST['cmd'] == change)
		{
			$panel_update = "UPDATE `wcf_panels` SET `panel_name`='".$_POST['panel_set_name']."',`panel_url`='".$_POST['panel_set_url']."',`panel_position`='".(int)$_POST['panel_set_position']."' WHERE `panel_id`='".(int)$_POST['panel_set_id']."'";
	   		mysql_query($panel_update) or trigger_error(mysql_error());

			if(mysql_query($panel_update) == true) { echo"$txt[admin_panels_choose_success]"; } else { echo"$txt[admin_panels_choose_unsuccess]"; }

        		echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=adminsetpanel';//--> </script>";
			ReturnAdminPanel(10);
       		}
?>