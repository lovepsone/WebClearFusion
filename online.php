<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: online.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	selectdb(realmd);
	$result_r = db_query("SELECT * FROM `realmlist`");

	if (!isset($_GET['realm_id']) && !isnum($_GET['realm_id']))
		{
			redirect(WCF_SELF."?realm_id=".$config['defult_realmd_id']);
		}
	elseif (isset($_GET['realm_id']) && isnum($_GET['realm_id']))
		{
			$realm_id = addslashes($_GET["realm_id"]);
			opentable();
			if ($config['namber_realmd'] > 1)
				{
					echo"<tr><td align='center' colspan='6'><div class='jsmenu' align='center'><ul>";
					while ($data_r = db_array($result_r)) { echo"<li style='border-left: 1px solid #202020;'><a href='".WCF_SELF."?realm_id=".$data_r['id']."'>".ucfirst(strtolower($data_r['name']))."</a></li>"; }
					echo"</ul></div></td></tr>";
				}

			$result = db_query("SELECT `address`, `port` FROM `realmlist` WHERE `id`='$realm_id'");
			$data = db_assoc($result);
			$fp = @fsockopen($data['address'], $data['port'], $errno, $errstr, 1);

			echo"<tr><td align='center' colspan='6'>";
			if ($fp) { echo"<img src='".IMAGES."online.gif' align='absmiddle' alt='online'>"; } else { echo"<img src='".IMAGES."offline.gif' align='absmiddle' alt='ofline'>"; }
			echo"</td></tr>";

			selectdb(characters_r.$realm_id);
			$result1 = db_query("SELECT * FROM `saved_variables`");

			if ($data1 = db_assoc($result1))
				{
					$ap_date = date("H:i:s d.m.Y", $data1['NextArenaPointDistributionTime']);
					$daily_quest_date = date("H:i:s d.m.Y", $data1['NextDailyQuestResetTime']);
					$weekly_quest_date = date("H:i:s d.m.Y", $data1['NextWeeklyQuestResetTime']);
					$monthly_quest_date = date("H:i:s d.m.Y", $data1['NextMonthlyQuestResetTime']);

					echo"<tr><td align='center' colspan='6' class='tbl'>".$txt['modul_online_timers']."</td></tr>";
					echo"<tr><td colspan='6'><table width='100%'>";
					echo"<tr><td align='right' class='tbl1'>".$txt['modul_online_points_arena']."</td>";
					echo"<td align='left' class='tbl1'>".$ap_date."</td></tr>";
					echo"<tr><td align='right' class='tbl1'>".$txt['modul_online_daily_quests']."</td>";
					echo"<td align='left' class='tbl1'>".$daily_quest_date."</td></tr>";
					echo"<tr><td align='right' class='tbl1'>".$txt['modul_online_weekly_quests']."</td>";
					echo"<td align='left' class='tbl1'>".$weekly_quest_date."</td></tr>";
					echo"<tr><td align='right' class='tbl1'>".$txt['modul_online_monthly_quests']."</td>";
					echo"<td align='left' class='tbl1'>".$monthly_quest_date."</td></tr>";
					echo"</td></tr></table>";
				}

			$result2 = db_query("SELECT count(`guid`) as kol FROM `characters` WHERE `online` = 1");
			$kolzap = mysql_fetch_array($result2);

			if ($kolzap['kol'] > $config['page_online'])
    				{
    					$page_len_online = $config['page_online'];
    					if (!isset($_GET['page']) or ($_GET['page'] == '')) { $start_rec_online = 0; } else { $start_rec_online = ((int) $_GET['page'] - 1)*$config['page_online']; }
    				}
			else
    				{
    					$page_len_online = $kolzap['kol'];
					$start_rec_online = 0;
    				}
			$result3 = db_query("SELECT * FROM `characters` WHERE `online` = 1 ORDER BY `name` LIMIT ".$start_rec_online.",".$page_len_online);

			if (db_num_rows($result3))
				{
					$online = db_num_rows($result3);
					echo"<tr><td align='center' colspan='6' class='tbl1'>".$online." ".$txt['modul_online']."</td></tr>";
					echo"<tr><td width='1%' class='tbl'>".$txt['modul_online_level']."</td>";
					echo"<td width='1%' class='tbl'></td>";
					echo"<td align='center' class='tbl'>".$txt['modul_online_name']."</td>";
					echo"<td width='1%' align='right' class='tbl'>".$txt['modul_online_race']."</td>";
					echo"<td width='1%' align='right' class='tbl'>".$txt['modul_online_class']."</td>";
					echo"<td width='1%' align='right' class='tbl'>".$txt['modul_online_position']."</td></tr>";

					while ($data3 = db_array($result3))
						{
							echo"<tr><td width='1%' align='center' class='tbl1'>".$data3['level']."</td>";
							echo"<td width='1%' class='tbl1'>".get_faction_image($data3['race'])."</td>";
							echo"<td align='center' class='tbl1'>".$data3['name']."</td>";
							echo"<td width='1%' class='tbl1'><img width='20' src='".get_race_image($data3['race'],$data3['gender'])."'></td>";
							echo"<td width='1%' class='tbl1'><img width='20' src='".get_class_image($data3['class'])."'></td>";
							echo"<td width='1%' class='tbl1'>".$zones[$data3['zone']]."</td></tr>";
						}
					if ($kolzap['kol'] > $config['page_online'])
						{
							$page_counter = ceil($kolzap['kol'] / $config['page_online']);
					    		if (!isset($_GET['page']) OR ($_GET['page'] == '') OR ($_GET['page'] == '_')) { $tp3 = 1; } else { $tp3 = (int)$_GET['page']; }
					    		echo"<tr><th height='40' colspan='6' align='center'>".show_page(WCF_SELF.'?realm_id='.$realm_id.'&page=', $tp3, $page_counter)."</th></tr>";
					    }
				}
			else
				{
					echo"<tr><td align='center' colspan='6' class='tbl1'>".$txt['modul_online_no_char']."</td></tr>";
				}
			closetable();
		}
	require_once THEMES."templates/footer.php";
?>