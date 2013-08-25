<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: site_links.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	if (isset($_GET['action']) && $_GET['action'] == "refresh")
	{
		$i = 1;
		$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT * FROM ?_navigation_links ORDER BY `link_order`');
		foreach ($rows as $numRow=>$data)
		{
			WCF::$DB->query('UPDATE ?_navigation_links SET link_order = ?d WHERE link_id = ?d', $i, $data['link_id']);
			$i++;
		}
		WCF::redirect(WCF_SELF);
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "moveup") && (isset($_GET['link_id']) && WCF::isnum($_GET['link_id'])))
	{
			$data = WCF::$DB->selectRow(' -- CACHE: 180
				SELECT `link_id` FROM ?_navigation_links WHERE `link_order`= ?d', intval($_GET['order']));
			WCF::$DB->query('UPDATE ?_navigation_links SET `link_order`=link_order+1 WHERE `link_id`= ?d', $data['link_id']);
			WCF::$DB->query('UPDATE ?_navigation_links SET `link_order`=link_order-1 WHERE `link_id`= ?d', $_GET['link_id']);
			WCF::redirect(WCF_SELF);
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "movedown") && (isset($_GET['link_id']) && WCF::isnum($_GET['link_id'])))
	{
			$data = WCF::$DB->selectRow(' -- CACHE: 180
				SELECT `link_id` FROM ?_navigation_links WHERE `link_order`= ?d', intval($_GET['order']));
			WCF::$DB->query('UPDATE ?_navigation_links SET `link_order`=link_order-1 WHERE `link_id`= ?d', $data['link_id']);
			WCF::$DB->query('UPDATE ?_navigation_links SET `link_order`=link_order+1 WHERE `link_id`= ?d', $_GET['link_id']);
			WCF::redirect(WCF_SELF);
	}
	elseif ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['link_id']) && WCF::isnum($_GET['link_id'])))
	{
		$data = WCF::$DB->selectRow(' -- CACHE: 180
				SELECT `link_order` FROM ?_navigation_links WHERE `link_id`= ?d', $_GET['link_id']);
		WCF::$DB->query('UPDATE ?_navigation_links SET `link_order`=link_order-1 WHERE `link_order`> ?d', $data['link_order']);
		WCF::$DB->query('DELETE FROM ?_navigation_links WHERE `link_id`= ?d', $_GET['link_id']);
		WCF::redirect(WCF_SELF."?status=del");
	}
	else
	{
		if (isset($_POST['savelink']))
		{
			$link_name = WCF::$TF->stripinput($_POST['link_name']);
			$link_url = WCF::$TF->stripinput($_POST['link_url']);
			$link_visibility = WCF::isnum($_POST['link_visibility']) ? $_POST['link_visibility'] : "-1";
			$link_position = isset($_POST['link_position']) ? $_POST['link_position'] : "1";
			$link_order = WCF::isnum($_POST['link_order']) ? $_POST['link_order'] : "";
		
			if ($link_name && $link_url)
			{
				if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['link_id']) && WCF::isnum($_GET['link_id'])))
				{
					$old_link_order = WCF::$DB->selectCell('SELECT `link_order` FROM ?_navigation_links WHERE `link_id`= ?d', $_GET['link_id']);
		
					if ($link_order > $old_link_order)
					{
						WCF::$DB->query('UPDATE ?_navigation_links SET `link_order`=link_order-1 WHERE `link_order`> ?d AND `link_order`<= ?d', $old_link_order, $link_order);
					}
					elseif ($link_order < $old_link_order)
					{
						WCF::$DB->query('UPDATE ?_navigation_links SET `link_order`=link_order+1 WHERE `link_order`< ?d AND `link_order`>= ?d', $old_link_order, $link_order);
					}
		
					WCF::$DB->query('UPDATE ?_navigation_links SET `link_name`= ?, `link_url`= ?, `link_visibility`= ?d, `link_position`= ?d, `link_order`= ?d WHERE `link_id`= ?d', $link_name, $link_url, $link_visibility, $link_position, $link_order, $_GET['link_id']);
					WCF::redirect(WCF_SELF."?status=su");
				}
				else
				{
					if (!$link_order)
					{
						$link_order = selectCell(' -- CACHE: 180
								SELECT MAX(`link_order`) FROM ?_navigation_links');
						$link_order++;
					}

					WCF::$DB->query('UPDATE ?_navigation_links SET link_order=link_order+1 WHERE link_order >= ?d', $link_order);
					WCF::$DB->query('INSERT INTO ?_navigation_links (`link_name`, `link_url`, `link_visibility`, `link_position`, `link_order`) VALUES (?, ?, ?d, ?d, ?d)', $link_name, $link_url, $link_visibility, $link_position, $link_order);
					WCF::redirect(WCF_SELF."?status=sn");
				}
			}
			else
			{
				WCF::redirect(WCF_SELF);
			}
		}

		if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['link_id']) && WCF::isnum($_GET['link_id'])))
		{
			$data = WCF::$DB->selectRow(' -- CACHE: 180
				SELECT * FROM ?_navigation_links WHERE `link_id`= ?d', $_GET['link_id']);
		
			if ($data != null)
			{
				$link_name = $data['link_name'];
				$link_url = $data['link_url'];
				$link_order = $data['link_order'];
				$link_visibility = $data['link_visibility'];
				$txt_page = WCF::$locale['admin_slinks_title_edit'];
				$formaction = WCF_SELF."?action=edit&link_id=".$_GET['link_id'];
			}
			else
			{
				WCF::redirect(WCF_SELF);
			}
		} 
		else
		{
			$link_name = "";
			$link_url = "";
			$link_order = "";
			$link_visibility = "";
			$txt_page = WCF::$locale['admin_slinks_title_add'];
			$formaction = WCF_SELF;
		}
		opentable();
		//echo"<form name='layoutform' method='post' action='".$formaction."'>";
		echo"<form method='post'>";
		echo"<tr><td align='center' colspan='2' class='small'><h4>".$txt_page."</h4></td></tr>";
		echo"<tr><td align='right' width='50%' class='small'>".WCF::$locale['admin_slinks_name']."</td>";
		echo"<td align='left'><input type='text' name='link_name' value='".$link_name."' maxlength='100' class='textbox' style='width:240px;' /></td></tr>";
		echo"<tr><td align='right' width='50%' class='small'>".WCF::$locale['admin_slinks_url']."</td>";
		echo"<td align='left'><input type='text' name='link_url' value='".$link_url."' maxlength='200' class='textbox' style='width:240px;' /></td></tr>";
		echo"<tr><td align='right' width='50%' class='small'>".WCF::$locale['admin_slinks_show']."</td>";
		echo"<td align='left' class='small'><select name='link_visibility' class='textbox' style='width:150px;'>".access($link_visibility)."</select>";
		echo WCF::$locale['admin_slinks_order']."<input type='text' name='link_order'  value='".$link_order."' maxlength='3' class='textbox' style='width:40px;' /></td></tr>";
		echo"<tr><td align='center' colspan='2'><hr><input type='submit' name='savelink' value='".WCF::$locale['admin_slinks_save']."' class='button' /></td></tr>";
		echo"</form>";
		closetable();
		
		opentable();
		echo"<tr><td align='center' colspan='5' class='small'><h4>".WCF::$locale['admin_slinks_current_url']."</h4></td></tr>";
		echo"<tr><td width='25%' class='small'><strong>".WCF::$locale['admin_slinks_name_url']."</strong></td>";
		echo"<td align='center' width='25%' class='small' style='white-space:nowrap'><strong>".WCF::$locale['admin_slinks_show_url']."</strong></td>";
		echo"<td align='center' colspan='2' width='25%' class='small' style='white-space:nowrap'><strong>".WCF::$locale['admin_slinks_order_url']."</strong></td>";
		echo"<td align='center' width='25%' class='small' style='white-space:nowrap'><strong>".WCF::$locale['admin_slinks_settings_url']."</strong></td></tr>";
		echo"<tr><td colspan='5'><hr></td></tr>";

		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT * FROM ?_navigation_links WHERE `link_position`= 1 OR `link_position`= 2 ORDER BY `link_order`');

		if ($rows != null)
		{
			$i = 0; $k = 1;
		
			foreach ($rows as $numRow => $data)
			{
				echo"<tr><td class='tbl1'>";
		
				if ($data['link_name'] != "---" && $data['link_url'] == "---")
				{
					echo"<strong>".$data['link_name']."</strong>";
				}
				else if ($data['link_name'] == "---" && $data['link_url'] == "---")
				{
					echo"<hr />";
				}
				else
				{
					if (strstr($data['link_url'], "http://") || strstr($data['link_url'], "https://"))
					{
						echo"<a href='".$data['link_url']."'>".$data['link_name']."</a>";
					}
					else
					{
						echo"<a href='".BASEDIR.$data['link_url']."'>".$data['link_name']."</a>";
					}
				}
				echo"</td>";
		
				echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".display_access_form($data['link_visibility'])."</td>";
				echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".$data['link_order']."</td>";
				echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";
		
				if (count($rows) != 1)
				{
					$up = $data['link_order'] - 1;
					$down = $data['link_order'] + 1;
		
					if ($k == 1)
					{
						echo"<a href='".WCF_SELF."?action=movedown&order=$down&link_id=".$data['link_id']."'>".WCF::$locale['down']."</a>";
					}
					elseif ($k < count($rows))
					{
						echo"<a href='".WCF_SELF."?action=moveup&order=$up&link_id=".$data['link_id']."'>".WCF::$locale['up']."</a>";
						echo"<a href='".WCF_SELF."?action=movedown&order=$down&link_id=".$data['link_id']."'>".WCF::$locale['down']."</a>";
					}
					else
					{
						echo"<a href='".WCF_SELF."?action=moveup&order=$up&link_id=".$data['link_id']."'>".WCF::$locale['up']."</a>";
					}
				}
				$k++;
				echo"</td>";
				echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'><a href='".WCF_SELF."?action=edit&link_id=".$data['link_id']."'>".WCF::$locale['admin_slinks_edit_url']."</a> -";
				echo"<a href='".WCF_SELF."?action=delete&link_id=".$data['link_id']."' onclick=\"return confirm('".WCF::$locale['admin_slinks_del_url_n_y']."');\">".WCF::$locale['admin_slinks_del_url']."</a></td>";
				echo"</tr>";
				$i++;
			}
		}
		else
		{
			echo"<tr><td align='center' colspan='5' class='small'>".WCF::$locale['admin_slinks_no_url']."</td></tr>";
		}
		if ($rows != null) { echo"<div style='text-align:center;margin-top:5px'>[ <a href='".WCF_SELF."?action=refresh'>".WCF::$locale['admin_slinks_refresh']."</a> ]</div>"; }
		closetable();
	}

	require_once THEMES."templates/footer.php";
?>
