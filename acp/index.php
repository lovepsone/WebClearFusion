<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: index.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/acp_header.php";

	selectdb(characters_r.$_SESSION['realmd_id']);
	$result = db_query("SELECT * FROM `characters` WHERE `account`='".$_SESSION['user_id']."'");

	opentable();
	if (db_num_rows($result))
		{
			echo"<tr><td width='1%' class='tbl1'>".$txt['modul_acp_level']."</td>";
			echo"<td width='1%' class='tbl1'></td>";
			echo"<td width='20%' align='center' class='tbl1'>".$txt['modul_acp_name']."</td>";
			echo"<td width='1%' align='right' class='tbl1'>".$txt['modul_acp_race']."</td>";
			echo"<td width='1%' align='right' class='tbl1'>".$txt['modul_acp_class']."</td>";
			echo"<td align='center' class='tbl1'>".$txt['modul_acp_money']."</td>";
			echo"<td align='center' class='tbl1'>".$txt['modul_acp_position']."</td>";
			echo"<td align='right' class='tbl1'></td>";
			echo"<td align='right' class='tbl1'>".$txt['modul_acp_game_status']."</td></tr>";

			while ($data = db_array($result))
				{
					echo"<tr><td width='1%' align='center' class='tbl1'>".$data['level']."</td>";
					echo"<td width='1%' class='tbl1'>".get_faction_image($data['race'])."</td>";
					echo"<td width='20%' align='center' class='tbl1'>".$data['name']."</td>";
					echo"<td width='1%' class='tbl1'><img width='20' src='".get_race_image($data['race'],$data['gender'])."'></td>";
					echo"<td width='1%' class='tbl1'><img width='20' src='".get_class_image($data['class'])."'></td>";
					echo"<td align='right' class='tbl1'>".get_gold($data['money'])."</td>";
					echo"<td align='right' class='tbl1'>".$zones[$data['zone']]."</td>";
					echo"<td align='right' class='tbl1'><a href='".WCF_SELF."' class='small2'>".$txt['modul_acp_revive']."</a></td>";
					echo"<td align='right' class='tbl1'>";
					if ($data['online'] == 0) { echo $txt['modul_acp_game_off']; } else { echo $txt['modul_acp_game_on']; }
					echo"</td></tr>";	
				}
		}
	else
		{
			echo"<tr><td align='center' class='small'>".$txt['modul_acp_no_char']."</td></tr>";
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>