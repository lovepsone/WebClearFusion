<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: forumedit.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	if (isset($_POST['save_sections']))
	{
		$sections_name = trim(WCF::$TF->stripinput($_POST['sections_name']));
		if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['forum_id']) && WCF::isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "sections"))
		{
					WCF::$DB->query('UPDATE ?_forums SET `forum_name`= ? WHERE `forum_id`= ?d', $sections_name, $_GET['forum_id']);
					WCF::redirect(WCF_SELF."?status=savecu");
		}
		else
		{
			if ($sections_name)
			{
				$sections_order = WCF::isnum($_POST['sections_order']) ? $_POST['sections_order'] : "";
				if(!$sections_order)
				{
					$sections_order = WCF::$DB->selectRow('SELECT MAX(forum_order) FROM ?_forums WHERE `forum_sections`= 0') + 1;
				}
				WCF::$DB->query('UPDATE ?_forums SET forum_order=forum_order+1 WHERE `forum_sections`= 0 AND `forum_order`>= ?d', $sections_order);
				WCF::$DB->query('INSERT INTO ?_forums (`forum_sections`, `forum_order`, `forum_name`) VALUES (0, ?d, ?)', $sections_order, $sections_name);
				WCF::redirect(WCF_SELF."?status=savecn");
			}
		}
	}
	elseif (isset($_POST['save_forum']))
	{
		$forum_name = trim(WCF::$TF->stripinput($_POST['forum_name']));
		$forum_description = trim(WCF::$TF->stripinput($_POST['forum_description']));
		$forum_sections = WCF::isnum($_POST['forum_sections']) ? $_POST['forum_sections'] : 0;

		if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['forum_id']) && WCF::isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "forum"))
		{
			WCF::$DB->query('UPDATE ?_forums SET  `forum_sections`= ?d, `forum_name`= ?, `forum_description`= ? WHERE `forum_id`= ?d', $forum_sections, $forum_name, $forum_description, $_GET['forum_id']);
			WCF::redirect(WCF_SELF."?status=savefu");
		}
		else
		{
			if ($forum_name)
			{
				$forum_order = WCF::isnum($_POST['forum_order']) ? $_POST['forum_order'] : "";
				if(!$forum_order)
				{
					$forum_order = WCF::$DB->selectRow('SELECT MAX(forum_order) FROM ?_forums WHERE `forum_sections`= ?d', $forum_sections) + 1;
				}
				WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order+1 WHERE `forum_sections`= ?d AND `forum_order`>= ?d', $forum_sections, $forum_order);
				WCF::$DB->query('INSERT INTO ?_forums (`forum_sections`, `forum_order`, `forum_name`, `forum_description`) VALUES (?d, ?d, ?, ?)', $forum_sections, $forum_order, $forum_name, $forum_description);
				WCF::redirect(WCF_SELF."?status=savefn");
			}
			else
			{
				WCF::redirect(WCF_SELF);
			}
		}
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "mu") && (isset($_GET['forum_id']) && WCF::isnum($_GET['forum_id'])) && (isset($_GET['order']) && WCF::isnum($_GET['order'])))
	{
		if (isset($_GET['type']) && $_GET['type'] == "sections")
		{
			$data = WCF::$DB->selectRow('SELECT `forum_id` FROM ?_forums WHERE `forum_sections`= 0 AND `forum_order`= ?d', $_GET['order']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order+1 WHERE `forum_id`= ?d', $data['forum_id']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order-1 WHERE `forum_id`= ?d', $_GET['forum_id']);
		}
		elseif ((isset($_GET['type']) && $_GET['type'] == "forum") && (isset($_GET['sections']) && WCF::isnum($_GET['sections'])))
		{
			$data =  WCF::$DB->selectRow('SELECT `forum_id` FROM ?_forums WHERE `forum_sections`= ?d AND `forum_order`= ?d', $_GET['sections'], $_GET['order']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order+1 WHERE `forum_id`= ?d', $data['forum_id']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order-1 WHERE `forum_id`= ?d', $_GET['forum_id']);
		}
		WCF::redirect(WCF_SELF);
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "md") && (isset($_GET['forum_id']) && WCF::isnum($_GET['forum_id'])) && (isset($_GET['order']) && WCF::isnum($_GET['order'])))
	{
		if (isset($_GET['type']) && $_GET['type'] == "sections")
		{
			$data = WCF::$DB->selectRow('SELECT `forum_id` FROM ?_forums WHERE `forum_sections`= 0 AND `forum_order`= ?d', $_GET['order']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order-1 WHERE `forum_id`= ?d', $data['forum_id']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order+1 WHERE `forum_id`= ?d', $_GET['forum_id']);
		}
		elseif ((isset($_GET['type']) && $_GET['type'] == "forum") && (isset($_GET['sections']) && WCF::isnum($_GET['sections'])))
		{
			$data = WCF::$DB->selectRow('SELECT `forum_id` FROM ?_forums WHERE `forum_sections`= ?d AND `forum_order`= ?d', $_GET['sections'], $_GET['order']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order-1 WHERE `forum_id`= ?d', $data['forum_id']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order+1 WHERE `forum_id`= ?d', $_GET['forum_id']);
		}
		WCF::redirect(WCF_SELF);
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['forum_id']) && WCF::isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "sections"))
	{
  		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT count(`forum_id`) as number FROM ?_forums WHERE forum_sections= ?d', $_GET['forum_id']);
		foreach ($rows as $numRow=>$Count) {}

		if (!$Count)
		{
			$data = WCF::$DB->selectRow('SELECT forum_order FROM ?_forums WHERE forum_id= ?d', $_GET['forum_id']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order-1 WHERE `forum_sections`=0 AND `forum_order`> ?d', $data['forum_order']);
			WCF::$DB->query('DELETE FROM ?_forums WHERE `forum_id`= ?d', $_GET['forum_id']);
			WCF::redirect(WCF_SELF."?status=delcy");
		}
		else
		{
			WCF::redirect(WCF_SELF."?status=delcn");
		}
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['forum_id']) && WCF::isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "forum"))
	{
  		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT count(`thread_id`) as number FROM ?_forums_threads WHERE forum_id = ?d', $_GET['forum_id']);
		foreach ($rows as $numRow=>$Count) {}

		if (!$Count)
		{
			$data = WCF::$DB->selectRow('SELECT `forum_sections` FROM ?_forums WHERE `forum_id`= ?d', $_GET['forum_id']);
			WCF::$DB->query('UPDATE ?_forums SET `forum_order`=forum_order-1 WHERE `forum_sections`= ?d AND `forum_order`> ?d', $data['forum_sections'], $data['forum_order']);
			WCF::$DB->query('DELETE FROM ?_forums WHERE `forum_id`= ?d', $_GET['forum_id']);
			WCF::redirect(WCF_SELF."?status=delfy");
		}
		else
		{
			WCF::redirect(WCF_SELF."?status=delfn");
		}
	}
	else
	{
		if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['forum_id']) && WCF::isnum($_GET['forum_id'])))
		{
			if (isset($_GET['type']) && $_GET['type'] == "sections")
			{
				$data = WCF::$DB->selectRow('SELECT forum_name FROM ?_forums WHERE `forum_id`= ?d', $_GET['forum_id']);
				if ($data != null)
				{
					$sections_title = WCF::$locale['admin_forumedit_edit_f_s'];
					$sections_name = $data['forum_name'];
				}
				else
				{
					WCF::redirect(WCF_SELF);
				}
			}
			elseif (isset($_GET['type']) && $_GET['type'] == "forum")
			{
				$data = WCF::$DB->selectRow('SELECT * FROM ?_forums WHERE `forum_id`= ?d', $_GET['forum_id']);
				if ($data != null)
				{
					$forum_title = WCF::$locale['admin_forumedit_edit_f_f'];
					$forum_name = $data['forum_name'];
					$forum_description = $data['forum_description'];
				}
				else
				{
					WCF::redirect(WCF_SELF);
				}
			}
		}
		else
		{
			$sections_name = "";
			$sections_title = WCF::$locale['admin_forumedit_add_f_s'];
			$forum_name = "";
			$forum_description = "";
			$forum_title = WCF::$locale['admin_forumedit_add_f_f'];
		}
		//======================================================
		// 1-я форма связана с разделами
		if (!isset($_GET['type']) || $_GET['type'] != "forum" && $_GET['action'] != "delete")
		{
			opentable();
			echo"<form method='post'>";
			echo"<tr><td align='center' colspan='2' class='small'>".$sections_title."</td></tr>";
			echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_forumedit_name_f_s']."&nbsp;</td>";
			echo"<td width='50%' align='left' class='small2'><input type='text' name='sections_name' value='".$sections_name."' class='textbox' style='width:230px;'/></td></tr>";
			echo"<tr><td width='50%' align='right' class='small2'>";
		
			if (!isset($_GET['action']) || $_GET['action'] != "edit")
			{
				echo WCF::$locale['admin_forumedit_order_f_s']."&nbsp;</td>";
				echo"<td width='50%' align='left' class='small2'><input type='text' name='sections_order' class='textbox' style='width:45px;' />";
			}
			echo"</td></tr>";
			echo"<tr><td align='center' colspan='2'><input type='submit' name='save_sections' value='".WCF::$locale['admin_forumedit_savesect']."' class='button' /></td></tr>";
			echo"</form>";
			closetable();
		}
		
		//======================================================
		// 2-я форма связан с форумами
		if (!isset($_GET['type']) || $_GET['type'] != "sections" && $_GET['action'] != "delete")
		{
			$forum_opts = "";
			$rows2 = WCF::$DB->select(' -- CACHE: 180
					SELECT * FROM ?_forums WHERE `forum_sections`=0 ORDER BY `forum_order`');
		
			if ($rows2 != null)
			{
				foreach ($rows2 as $numRow=>$data2)
				{
					$forum_opts .= "<option value='".$data2['forum_id']."'>".$data2['forum_name']."</option>";
				}
		
				opentable();
				echo"<form method='post'>";
				echo"<tr><td align='center' colspan='2' class='small'>".$forum_title."</td></tr>";
		
				echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_forumedit_name_f_f']."&nbsp;</td>";
				echo"<td width='50%' align='left' class='small2'><input type='text' name='forum_name' value='".$forum_name."' class='textbox' style='width:230px;'/></td></tr>";
		
				echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_forumedit_descript_f_f']."&nbsp;</td>";
				echo"<td width='50%' align='left' class='small2'><input type='text' name='forum_description' value='".$forum_description."' class='textbox' style='width:230px;'/></td></tr>";
		
				echo"<tr><td width='50%' align='right' class='small2'>".WCF::$locale['admin_forumedit_sections']."&nbsp;</td>";
				echo"<td width='50%' align='left' class='small2'><select name='forum_sections' class='textbox' style='width:230px;'>".$forum_opts."</select></td></tr>";
		
				echo"<tr><td width='50%' align='right' class='small2'>";
		
				if (!isset($_GET['action']) || $_GET['action'] != "edit")
				{
					echo WCF::$locale['admin_forumedit_order_f_s']."&nbsp;</td>";
					echo"<td width='50%' align='left' class='small2'><input type='text' name='forum_order' class='textbox' style='width:45px;' />";
				}
				echo"</td></tr>";
		
				echo"<tr><td align='center' colspan='2'><input type='submit' name='save_forum' value='".WCF::$locale['admin_forumedit_savesect']."' class='button' /></td></tr>";
				echo"</form>";
				closetable();
			}
		}
		
		//======================================================
		// 3-я форма связана с позициями разделов и форумов
		$i = 1; $k = 1;
		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT * FROM ?_forums WHERE `forum_sections`=0 ORDER BY `forum_order`');

		if ($rows != null)
		{
			opentable();
		   	echo"<tr><th width='60%' class='forum-caption'>".WCF::$locale['admin_forumedit_cat_or_forum']."</th>";
			echo"<th width='5%' class='forum-caption'></th>";
			echo"<th width='21%' class='forum-caption'>".WCF::$locale['admin_forumedit_order']."</th>";
			echo"<th width='10%' class='forum-caption'>".WCF::$locale['admin_forumedit_options']."</th></tr>";
		
			$i = 1;
			foreach ($rows as $numRow=>$data)
			{
				echo"<tr><td colspan='4'><hr></td></tr>";
				echo"<tr><td width='60%' class='small'><strong>".$data['forum_name']."</strong></td>";
				echo"<td align='center' width='5%' class='small'>".$data['forum_order']."</td>";
				echo"<td align='center' width='21%' class='small'>";
		
				if (count($rows) != 1)
				{
					$up = $data['forum_order'] - 1;
					$down = $data['forum_order'] + 1;
		
					if ($i == 1)
					{
						echo"<a href='".WCF_SELF."?type=sections&action=md&order=".$down."&forum_id=".$data['forum_id']."'>".WCF::$locale['down']."</a>";
					}
					elseif ($i < count($rows))
					{
						echo"<a href='".WCF_SELF."?type=sections&action=mu&order=$up&forum_id=".$data['forum_id']."'>".WCF::$locale['up']."</a>";
						echo"<a href='".WCF_SELF."?type=sections&action=md&order=$down&forum_id=".$data['forum_id']."'>".WCF::$locale['down']."</a>";
					}
					else
					{
						echo"<a href='".WCF_SELF."?type=sections&action=mu&order=$up&forum_id=".$data['forum_id']."'>".WCF::$locale['up']."</a>";
					}
				}
				$i++;
				echo"</td>";
		
				echo"<td align='center' width='1%' class='small' style='white-space:nowrap'>";
				echo"<a href='".WCF_SELF."?type=sections&action=edit&forum_id=".$data['forum_id']."'>".WCF::$locale['admin_forumedit_edit']."</a> ::";
				echo"<a href='".WCF_SELF."?type=sections&action=delete&forum_id=".$data['forum_id']."'>".WCF::$locale['admin_forumedit_del']."</a></td></tr>";
				echo"<tr><td colspan='4'><hr></td></tr>";
		
				$rows2 = WCF::$DB->select(' -- CACHE: 180
					SELECT * FROM ?_forums WHERE `forum_sections`= ?d ORDER BY `forum_order`', $data['forum_id']);
		
				if ($rows2 != null)
				{
					$k = 1;
					foreach ($rows2 as $numRow=>$data2)
					{
						echo"<tr><td class='tbl1' width='60%'><span class='alt'>".$data2['forum_name']."</span>";
						echo"[<a href='".WCF_SELF."?action=prune&forum_id=".$data2['forum_id']."'>".WCF::$locale['admin_forumedit_cleaning']."</a>]<br>";
						echo ($data2['forum_description'] ? "<span class='small2'>".$data2['forum_description']."</span>" : "")."</td>";
						echo"<td align='center' width='5%' class='tbl2'>".$data2['forum_order']."</td>";
						echo"<td align='center' width='21%' class='tbl1'>";
		
						if (count($rows2) != 1)
						{
							$up = $data2['forum_order'] - 1;
							$down = $data2['forum_order'] + 1;
		
							if ($k == 1)
							{
								echo"<a href='".WCF_SELF."?type=forum&action=md&order=$down&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".WCF::$locale['down']."</a>";
							}
							elseif ($k < count($rows2))
							{
								echo"<a href='".WCF_SELF."?type=forum&action=mu&order=$up&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".WCF::$locale['up']."</a>";
								echo"<a href='".WCF_SELF."?type=forum&action=md&order=$down&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".WCF::$locale['down']."</a>";
							}
							else
							{
								echo"<a href='".WCF_SELF."?type=forum&action=mu&order=$up&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".WCF::$locale['up']."</a>";
							}
						}
						$k++;
						echo"</td>";
						echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";
						echo"<a href='".WCF_SELF."?type=forum&action=edit&forum_id=".$data2['forum_id']."'>".WCF::$locale['admin_forumedit_edit']."</a> ::";
						echo"<a href='".WCF_SELF."?type=forum&action=delete&forum_id=".$data2['forum_id']."'>".WCF::$locale['admin_forumedit_del']."</a></td>";
						echo"</tr>";
					}
				}
			}
			closetable();
		}
	}

require_once THEMES."templates/footer.php";
?>
