<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: panels.php
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
				SELECT `panel_id` FROM ?_panels WHERE `panel_side`= 1 ORDER BY `panel_order`');

		foreach ($rows as $numRow => $data)
		{
			WCF::$DB->query('UPDATE ?_panels SET `panel_order`= ?d WHERE `panel_id`= ?d', $i, $data['panel_id']);
			$i++;
		}
		$i = 1;

		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT `panel_id` FROM ?_panels WHERE `panel_side`=2 ORDER BY `panel_order`');

		foreach ($rows as $numRow => $data)
		{
			WCF::$DB->query('UPDATE ?_panels SET `panel_order`= ?d WHERE `panel_id`= ?d', $i, $data['panel_id']);
			$i++;
		}
		$i = 1;

		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT `panel_id` FROM ?_panels WHERE `panel_side`=3 ORDER BY `panel_order`');

		foreach ($rows as $numRow => $data)
		{
			WCF::$DB->query('UPDATE ?_panels SET `panel_order`= ?d WHERE `panel_id`= ?d', $i, $data['panel_id']);
			$i++;
		}
		$i = 1;

		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT `panel_id` FROM ?_panels WHERE `panel_side`=4 ORDER BY `panel_order`');

		foreach ($rows as $numRow => $data)
		{
			WCF::$DB->query('UPDATE ?_panels SET `panel_order`= ?d WHERE `panel_id`= ?d', $i, $data['panel_id']);
			$i++;
		}
	}
	if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT * FROM ?_panels WHERE `panel_id`= ?d', $_GET['panel_id']);
		WCF::$DB->query('DELETE FROM ?_panels WHERE `panel_id`= ?d', $_GET['panel_id']);
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order-1 WHERE `panel_side`= ?d AND `panel_order`>= ?d', $data['panel_side'], $data['panel_order']);
		WCF::redirect(WCF_SELF);
	}
	if ((isset($_GET['action']) && $_GET['action'] == "setstatus") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		WCF::$DB->query('UPDATE ?_panels SET `panel_status`= ?d WHERE `panel_id`= ?d', intval($_GET['status']), $_GET['panel_id']);
	}
	if ((isset($_GET['action']) && $_GET['action'] == "mup") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT `panel_id` FROM ?_panels WHERE `panel_side`= ?d AND `panel_order`= ?d', intval($_GET['panel_side']), intval($_GET['order']));
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order+1 WHERE `panel_id`= ?d', $data['panel_id']);
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order-1 WHERE `panel_id`= ?d', $_GET['panel_id']);
		WCF::redirect(WCF_SELF);
	}
	if ((isset($_GET['action']) && $_GET['action'] == "mdown") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT `panel_id` FROM ?_panels WHERE `panel_side`= ?d AND `panel_order`= ?d', intval($_GET['panel_side']), intval($_GET['order']));
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order-1 WHERE `panel_id`= ?d', $data['panel_id']);
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order+1 WHERE `panel_id`= ?d', $_GET['panel_id']);
		WCF::redirect(WCF_SELF);
	}
	if ((isset($_GET['action']) && $_GET['action'] == "mleft") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT `panel_order` FROM ?_panels WHERE `panel_side`= 1 ORDER BY `panel_order` DESC LIMIT 1');
		if ($data != null) { $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }

		WCF::$DB->query('UPDATE ?_panels SET `panel_side`=1, `panel_order`= ?d WHERE `panel_id`= ?d', $neworder, $_GET['panel_id']);
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order-1 WHERE `panel_side`=4 AND `panel_order`>= ?d', intval($_GET['order']));
		WCF::redirect(WCF_SELF);
	}
	if ((isset($_GET['action']) && $_GET['action'] == "mright") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT `panel_order` FROM ?_panels WHERE `panel_side`=4 ORDER BY `panel_order` DESC LIMIT 1');
		if ($data != null) { $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
		WCF::$DB->query('UPDATE ?_panels SET `panel_side`=4, `panel_order`= ?d WHERE `panel_id`= ?d', $neworder, $_GET['panel_id']);
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order-1 WHERE `panel_side`=1 AND `panel_order`>= ?d', intval($_GET['order']));
		WCF::redirect(WCF_SELF);
	}
	if ((isset($_GET['action']) && $_GET['action'] == "mupper") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT `panel_order` FROM ?_panels WHERE `panel_side`=2 ORDER BY `panel_order` DESC LIMIT 1');
		if ($data != null) { $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
		WCF::$DB->query('UPDATE ?_panels SET `panel_side`=2, `panel_order`= ?d WHERE `panel_id`= ?d', $neworder, $_GET['panel_id']);
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order-1 WHERE `panel_side`=3 AND `panel_order`>= ?d', intval($_GET['order']));
		WCF::redirect(WCF_SELF);
	}
	if ((isset($_GET['action']) && $_GET['action'] == "mlower") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
	{
		$data = WCF::$DB->selectRow('SELECT `panel_order` FROM ?_panels WHERE `panel_side`=3 ORDER BY `panel_order` DESC LIMIT 1');
		if ($data != null) { $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
		WCF::$DB->query('UPDATE ?_panels SET `panel_side`=3, `panel_order`= ?d WHERE `panel_id`= ?d', $neworder, $_GET['panel_id']);
		WCF::$DB->query('UPDATE ?_panels SET `panel_order`=panel_order-1 WHERE `panel_side`=2 AND `panel_order`>= ?d', intval($_GET['order']));
		WCF::redirect(WCF_SELF);
	}

	opentable();
	echo"<tr><td colspan='7' align='center' class='small'><h3>".WCF::$locale['admin_panel_control']."</h3></td></tr>";

	echo"<tr><td class='tbl2'><strong>".WCF::$locale['admin_panel_name']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' colspan='2' style='white-space:nowrap'><strong>".WCF::$locale['admin_panel_place']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".WCF::$locale['admin_panel_position']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".WCF::$locale['admin_panel_type']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".WCF::$locale['admin_panel_show']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".WCF::$locale['admin_panel_options']."</strong></td>";
	echo"</tr>";

	$ps = 1; $i = 1; $k = 0;

	$rows = WCF::$DB->select(' -- CACHE: 180
			SELECT * FROM ?_panels ORDER BY `panel_side`,`panel_order`');

	foreach ($rows as $numRow => $data)
	{
		$rowsCount = WCF::$DB->select(' -- CACHE: 180
			SELECT count(panel_id)  as number FROM ?_panels WHERE panel_side= ?d', $data['panel_side']);
		foreach ($rowsCount as $num=>$numrows) {}

		if ($ps != $data['panel_side'])
		{
			$ps = $data['panel_side'];
			$i = 1;
		}

		if ($numrows != 1)
		{
			$up = $data['panel_order'] - 1;
			$down = $data['panel_order'] + 1;

			if ($i == 1)
			{
				$up_down = " <a href='".WCF_SELF."?action=mdown&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$down'>".WCF::$locale['down']."</a>";
			}
			else if ($i < $numrows)
			{
				$up_down = " <a href='".WCF_SELF."?action=mup&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$up'>".WCF::$locale['up']."</a>";
				$up_down .= " <a href='".WCF_SELF."?action=mdown&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$down'>".WCF::$locale['down']."</a>";
			}
			else
			{
				$up_down = " <a href='".WCF_SELF."?action=mup&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$up'>".WCF::$locale['up']."</a>";
			}
		}
		else
		{
			$up_down = "";
		}

		echo"<tr><td class='tbl1'>".$data['panel_filename']."</td>";
		echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";

		if ($data['panel_side'] == 1) { echo WCF::$locale['left']; }
		elseif ($data['panel_side'] == 2) { echo WCF::$locale['center']; }
		elseif ($data['panel_side'] == 3) { echo WCF::$locale['center_footer']; }
		elseif ($data['panel_side'] == 4) { echo WCF::$locale['right']; }

		echo"</td><td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";

		if ($data['panel_side'] == 1)
		{
			echo"<a href='".WCF_SELF."?action=mright&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".WCF::$locale['right']."</a>";
		}
		elseif ($data['panel_side'] == 2)
		{
			echo"<a href='".WCF_SELF."?action=mlower&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".WCF::$locale['down']."</a>";
		}
		elseif ($data['panel_side'] == 3)
		{
			echo"<a href='".WCF_SELF."?action=mupper&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".WCF::$locale['up']."</a>";
		}
		elseif ($data['panel_side'] == 4)
		{
			echo"<a href='".WCF_SELF."?action=mleft&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".WCF::$locale['left']."</a>";
		}

		echo"</td><td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".$data['panel_order']."$up_down</td>";
		echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".($data['panel_type'] == "file" ? WCF::$locale['file'] : WCF::$locale['php'])."</td>";
		echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".display_access_form($data['panel_access'])."</td>";
		echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";

		echo"[<a href='panel_editor.php?action=edit&panel_id=".$data['panel_id']."&panel_side=1'>".WCF::$locale['admin_panel_edit']."</a>]";

		if ($data['panel_status'] == 0)
		{
			echo"[<a href='".WCF_SELF."?action=setstatus&status=1&panel_id=".$data['panel_id']."'>".WCF::$locale['admin_panel_switch_on']."</a>]";
		}
		else
		{
			echo"[<a href='".WCF_SELF."?action=setstatus&status=0&panel_id=".$data['panel_id']."'>".WCF::$locale['admin_panel_switch_off']."</a>]";
		}
		echo"[<a href='".WCF_SELF."?action=delete&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."' onclick=\"return confirm('".WCF::$locale['admin_panel_del_n_y']."');\">".WCF::$locale['admin_panel_del']."</a>]";
		echo"</td></tr>";
		$i++; $k++;
	}

	echo"<div style='text-align:center;margin-top:5px'>[ <a href='panel_editor.php'>".WCF::$locale['admin_panel_add']."</a> ]";
	echo"[ <a href='".WCF_SELF."?action=refresh'>".WCF::$locale['admin_panel_refresh']."</a> ]</div>";

	closetable();

	require_once THEMES."templates/footer.php";
?>