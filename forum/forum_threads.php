<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: forum_threads.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$forum_id = addslashes($_GET["id"]);

	if (isset($_GET['id']))
		{
			selectdb(wcf);
			$result = mysql_query("SELECT `wcf_forums_threads`.*, `wcf_users`.* FROM `wcf_forums_threads`, `wcf_users` WHERE `forum_id`='$forum_id' AND `wcf_forums_threads`.`user_id`=`wcf_users`.`user_id`");

			echo"<table width='100%' border='0' cellspacing='0' cellpadding='5' class='report'>";

   			echo"<tr><th width='4%' class='head'></th>";
			echo"<th width='57%'>$txt[forum_column_top_aut]</th>";
			echo"<th width='21%'>$txt[forum_column_last_post]</th>";
			echo"<th width='5%'>$txt[forum_column_replies]</th>";
			echo"<th width='10%'>$txt[forum_column_views]</th></tr>";
			echo"<tr><th width='100%' colspan='5' align='left' style='text-align: left;' class='head'><a href='index.php?modul=thread&create'>$txt[forum_create_theme]</a></th></tr>";

			while($topics = mysql_fetch_array($result))
				{
					echo"<tr><td width='4%' align='left' style='text-align: left;' class='page'></td>";
          				echo"<td align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;<a href='index.php?modul=post&id=$topics[thread_id]&forum_id=$forum_id'>".$topics['thread_name']."</a><br>&nbsp;&nbsp;".ucfirst(strtolower($topics['user_name']))."</td>";
					echo"<td width='21%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;</td>";
					echo"<td width='5%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;</td>";
					echo"<td width='11%' align='left' style='text-align: left;' class='page'>&nbsp;&nbsp;</td></tr>";
				}
			echo"</table>";
		}

	if (isset($_GET['create']))
		{
			require "include/tinymce.php";
   			echo $edit_script;

			echo"<form method='post'>";
			echo"<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>";
	
       			echo"<tr><td width='15%' height='30' align='right' valign='middle'>$txt[forum_create_name_theme]</td>";
			echo"<td width='1%' height='30' >&nbsp;</td>";
        		echo"<td width='84%' height='30' align='left' valign='middle'><input name='cmd' value='themeadd' type=hidden><input type='text' name='name_tema' size='40'></td></tr>";

       			echo"<tr><td width='15%' height='30' align='right' valign='middle'>$txt[forum_create_descript_theme]</td>";
			echo"<td width='1%' height='30' >&nbsp;</td>";
        		echo"<td width='84%' height='30' align='left' valign='middle'><input name='modul' value='create' type=hidden><input type='text' name='description' size='40'></td></tr></table>";

			echo"<textarea name='topics'></textarea>";
			echo"<br><center><input type='submit' value='$txt[forum_create_theme]'/></center></form>";

    			if ($_POST['cmd'] == themeadd)
				{
					/*$nt = addslashes($_POST['name_tema']);

					echo $nt;
					$addnews = mysql_query("insert into `wcf_news` (`title`,`text`,`cat`) values ('".$nt."','".text_optimazer($_POST['news'])."','".(int)$_POST['cat']."')") or trigger_error(mysql_error());

					if($addnews == true) { echo"$txt[admin_news_add_successfully]"; } else { echo"$txt[menu_auth_error]"; }

        				echo"<script type='text/javascript'> <!-- window.status = ''; window.location = 'index.php?modul=section&create';//--> </script>";
					ReturnAdminNewsadd(10);*/
				}
		}
?>