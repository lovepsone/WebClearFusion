<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: forumedit.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/



	if ((isset($_GET['type']) && $_GET['type'] == "sections") & (isset($_GET['action']) && $_GET['action'] == "mu") & isset($_GET['order']) & isset($_GET['forum_id']))
		{
			selectdb(wcf);
  			$data = db_array(mysql_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='0' AND `forum_order`='".$_GET['order']."'"));
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$data['forum_id']."'");
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$_GET['forum_id']."'");
		}
	elseif ((isset($_GET['type']) && $_GET['type'] == "sections") & (isset($_GET['action']) && $_GET['action'] == "md") & isset($_GET['order']) & isset($_GET['forum_id']))
		{
			selectdb(wcf);
			$data = db_array(mysql_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='0' AND `forum_order`='".$_GET['order']."'"));
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$data['forum_id']."'");
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$_GET['forum_id']."'");
		}
	elseif ((isset($_GET['type']) && $_GET['type'] == "forum") & (isset($_GET['action']) && $_GET['action'] == "mu") & isset($_GET['order']) & isset($_GET['forum_id']) & isset($_GET['sections']))
		{
			selectdb(wcf);
			$data = db_array(mysql_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='".$_GET['sections']."' AND `forum_order`='".$_GET['order']."'"));
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$data['forum_id']."'");
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$_GET['forum_id']."'");
		}
	elseif ((isset($_GET['type']) && $_GET['type'] == "forum") & (isset($_GET['action']) && $_GET['action'] == "md") & isset($_GET['order']) & isset($_GET['forum_id']) & isset($_GET['sections']))
		{
			selectdb(wcf);
			$data = db_array(mysql_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='".$_GET['sections']."' AND `forum_order`='".$_GET['order']."'"));
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$data['forum_id']."'");
			$result = mysql_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$_GET['forum_id']."'");
		}
	//======================================================
	// 1-я форма

	//======================================================
	// 2-я форма

	//======================================================
	// 3-я форма
	$sect_link = "index.php?modul=forumedit&type=sections";
	$forum_link = "index.php?modul=forumedit&type=forum";
	$i = 1; $k = 1;

	selectdb(wcf);
	$result = mysql_query("SELECT * FROM ".DB_FORUMS." WHERE `forum_sections`='0' ORDER BY `forum_order`") or trigger_error(mysql_error());

	opentable();

	if (db_num_rows($result) != 0)
		{
   			echo"<tr><th width='60%' class='forum-caption'>".$txt['admin_forumedit_cat_or_forum']."</th>";
			echo"<th width='5%' class='forum-caption'></th>";
			echo"<th width='21%' class='forum-caption'>".$txt['admin_forumedit_order']."</th>";
			echo"<th width='10%' class='forum-caption'>".$txt['admin_forumedit_options']."</th></tr>";

			$i = 1;
			while ($data = db_array($result))
				{
					echo"<tr><td colspan='4'><hr></td></tr>";
					echo"<tr><td width='60%' class='small'><strong>".$data['forum_name']."</strong></td>";
					echo"<td align='center' width='5%' class='small'>".$data['forum_order']."</td>";
					echo"<td align='center' width='21%' class='small'>";

					if (db_num_rows($result) != 1)
						{
							$up = $data['forum_order'] - 1;
							$down = $data['forum_order'] + 1;

							if ($i == 1)
								{
									echo"<a href='".$sect_link."&action=md&order=".$down."&forum_id=".$data['forum_id']."'>".$txt['down']."</a>";
								}
							elseif ($i < db_num_rows($result))
								{
									echo"<a href='".$sect_link."&action=mu&order=$up&forum_id=".$data['forum_id']."'>".$txt['up']."</a>";
									echo"<a href='".$sect_link."&action=md&order=$down&forum_id=".$data['forum_id']."'>".$txt['down']."</a>";
								}
							else
								{
									echo"<a href='".$sect_link."&action=mu&order=$up&forum_id=".$data['forum_id']."'>".$txt['up']."</a>";
								}
						}
					$i++;
					echo"</td>";

					echo"<td align='center' width='1%' class='small' style='white-space:nowrap'>";
					echo"<a href='".$aidlink."&amp;action=edit&amp;forum_id=".$data['forum_id']."'>".$txt['menu_admin_news_edit']."</a> ::";
					echo"<a href='".$aidlink."&amp;action=delete&amp;forum_id=".$data['forum_id']."'>".$txt['menu_admin_news_del']."</a></td></tr>";
					echo"<tr><td colspan='4'><hr></td></tr>";

					$result2 = mysql_query("SELECT * FROM ".DB_FORUMS." WHERE `forum_sections`='".$data['forum_id']."' ORDER BY `forum_order`");

					if (db_num_rows($result2))
						{
							$k = 1;
							while ($data2 = db_array($result2))
								{
									echo"<tr><td class='tbl1' width='60%'><span class='alt'>".$data2['forum_name']."</span>";
									echo"[<a href='$aidlink&amp;action=prune&amp;forum_id=".$data2['forum_id']."'>".$txt['admin_forumedit_cleaning']."</a>]<br>";
									echo ($data2['forum_description'] ? "<span class='small2'>".$data2['forum_description']."</span>" : "")."</td>";
									echo"<td align='center' width='5%' class='tbl2'>".$data2['forum_order']."</td>";
									echo"<td align='center' width='21%' class='tbl1'>";

									if (db_num_rows($result2) != 1)
										{
											$up = $data2['forum_order'] - 1;
											$down = $data2['forum_order'] + 1;

											if ($k == 1)
												{
													echo"<a href='".$forum_link."&action=md&order=$down&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['down']."</a>";
												}
											elseif ($k < db_num_rows($result2))
												{
													echo"<a href='".$forum_link."&action=mu&order=$up&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['up']."</a>";
													echo"<a href='".$forum_link."&action=md&order=$down&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['down']."</a>";
												}
											else
												{
													echo"<a href='".$forum_link."&action=mu&order=$up&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['up']."</a>";
												}
										}
									$k++;
									echo"</td>";
									echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";
									echo"<a href='$aidlink&amp;action=edit&amp;forum_id=".$data2['forum_id']."'>".$txt['menu_admin_news_edit']."</a> ::";
									echo"<a href='$aidlink&amp;action=delete&amp;forum_id=".$data2['forum_id']."'>".$txt['menu_admin_news_del']."</a></td>";
									echo"</tr>";
								}
						}
				}
		}
	closetable();
?>