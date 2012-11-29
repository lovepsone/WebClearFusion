<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
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
			selectdb("wcf");
			$i = 1;
			$result = WCF::$DB->db_query("SELECT `panel_id` FROM ".DB_PANELS." WHERE `panel_side`='1' ORDER BY `panel_order`");

			while ($data = WCF::$DB->db_array($result))
				{
					$result2 = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`='$i' WHERE `panel_id`='".$data['panel_id']."'");
					$i++;
				}
			$i = 1;

			$result = WCF::$DB->db_query("SELECT `panel_id` FROM ".DB_PANELS." WHERE `panel_side`='2' ORDER BY `panel_order`");

			while ($data = WCF::$DB->db_array($result))
				{
					$result2 = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`='$i' WHERE `panel_id`='".$data['panel_id']."'");
					$i++;
				}
			$i = 1;
			$result = WCF::$DB->db_query("SELECT `panel_id` FROM ".DB_PANELS." WHERE `panel_side`='3' ORDER BY `panel_order`");

			while ($data = WCF::$DB->db_array($result))
				{
					$result2 = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`='$i' WHERE `panel_id`='".$data['panel_id']."'");
					$i++;
				}
			$i = 1;
			$result = WCF::$DB->db_query("SELECT `panel_id` FROM ".DB_PANELS." WHERE `panel_side`='4' ORDER BY `panel_order`");

			while ($data = WCF::$DB->db_array($result))
				{
					$result2 = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`='$i' WHERE `panel_id`='".$data['panel_id']."'");
					$i++;
				}
		}

	if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$data = WCF::$DB->db_assoc(WCF::$DB->db_query("SELECT * FROM ".DB_PANELS." WHERE `panel_id`='".$_GET['panel_id']."'"));
			$result = WCF::$DB->db_query("DELETE FROM ".DB_PANELS." WHERE `panel_id`='".$_GET['panel_id']."'");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order-1 WHERE `panel_side`='".$data['panel_side']."' AND `panel_order`>='".$data['panel_order']."'");
			redirect(WCF_SELF);
		}
	if ((isset($_GET['action']) && $_GET['action'] == "setstatus") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_status`='".intval($_GET['status'])."' WHERE `panel_id`='".$_GET['panel_id']."'");
		}
	if ((isset($_GET['action']) && $_GET['action'] == "mup") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$data = WCF::$DB->db_assoc(WCF::$DB->db_query("SELECT `panel_id` FROM ".DB_PANELS." WHERE `panel_side`='".intval($_GET['panel_side'])."' AND `panel_order`='".intval($_GET['order'])."'"));
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order+1 WHERE `panel_id`='".$data['panel_id']."'");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order-1 WHERE `panel_id`='".$_GET['panel_id']."'");
			redirect(WCF_SELF);
		}
	if ((isset($_GET['action']) && $_GET['action'] == "mdown") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$data = WCF::$DB->db_assoc(WCF::$DB->db_query("SELECT `panel_id` FROM ".DB_PANELS." WHERE `panel_side`='".intval($_GET['panel_side'])."' AND `panel_order`='".intval($_GET['order'])."'"));
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order-1 WHERE `panel_id`='".$data['panel_id']."'");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order+1 WHERE `panel_id`='".$_GET['panel_id']."'");
			redirect(WCF_SELF);
		}
	if ((isset($_GET['action']) && $_GET['action'] == "mleft") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$result = WCF::$DB->db_query("SELECT `panel_order` FROM ".DB_PANELS." WHERE `panel_side`='1' ORDER BY `panel_order` DESC LIMIT 1");
			if (WCF::$DB->db_num_rows($result) != 0) { $data = WCF::$DB->db_assoc($result); $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_side`='1', `panel_order`='$neworder' WHERE `panel_id`='".$_GET['panel_id']."'");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order-1 WHERE `panel_side`='4' AND `panel_order`>='".intval($_GET['order'])."'");
			redirect(WCF_SELF);
		}
	if ((isset($_GET['action']) && $_GET['action'] == "mright") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$result = WCF::$DB->db_query("SELECT `panel_order` FROM ".DB_PANELS." WHERE `panel_side`='4' ORDER BY `panel_order` DESC LIMIT 1");
			if (WCF::$DB->db_num_rows($result) != 0) { $data = WCF::$DB->db_assoc($result); $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_side`='4', `panel_order`='$neworder' WHERE `panel_id`='".$_GET['panel_id']."'");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order-1 WHERE `panel_side`='1' AND `panel_order`>='".intval($_GET['order'])."'");
			redirect(WCF_SELF);
		}
	if ((isset($_GET['action']) && $_GET['action'] == "mupper") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$result = WCF::$DB->db_query("SELECT `panel_order` FROM ".DB_PANELS." WHERE `panel_side`='2' ORDER BY `panel_order` DESC LIMIT 1");
			if (WCF::$DB->db_num_rows($result) != 0) { $data = WCF::$DB->db_assoc($result); $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_side`='2', `panel_order`='$neworder' WHERE `panel_id`='".$_GET['panel_id']."'");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order-1 WHERE `panel_side`='3' AND `panel_order`>='".intval($_GET['order'])."'");
			redirect(WCF_SELF);
		}
	if ((isset($_GET['action']) && $_GET['action'] == "mlower") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
		{
			selectdb("wcf");
			$result = WCF::$DB->db_query("SELECT `panel_order` FROM ".DB_PANELS." WHERE `panel_side`='3' ORDER BY `panel_order` DESC LIMIT 1");
			if (WCF::$DB->db_num_rows($result) != 0) { $data = WCF::$DB->db_assoc($result); $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_side`='3', `panel_order`='$neworder' WHERE `panel_id`='".$_GET['panel_id']."'");
			$result = WCF::$DB->db_query("UPDATE ".DB_PANELS." SET `panel_order`=panel_order-1 WHERE `panel_side`='2' AND `panel_order`>='".intval($_GET['order'])."'");
			redirect(WCF_SELF);
		}

	opentable();
	echo"<tr><td colspan='7' align='center' class='small'><h3>".$txt['admin_panel_control']."</h3></td></tr>";

	echo"<tr><td class='tbl2'><strong>".$txt['admin_panel_name']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' colspan='2' style='white-space:nowrap'><strong>".$txt['admin_panel_place']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".$txt['admin_panel_position']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".$txt['admin_panel_type']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".$txt['admin_panel_show']."</strong></td>";
	echo"<td align='center' width='1%' class='tbl2' style='white-space:nowrap'><strong>".$txt['admin_panel_options']."</strong></td>";
	echo"</tr>";

	$ps = 1; $i = 1; $k = 0;
	selectdb("wcf");
	$result = WCF::$DB->db_query("SELECT * FROM ".DB_PANELS." ORDER BY `panel_side`,`panel_order`");
	while ($data = WCF::$DB->db_array($result))
		{
			$numrows = WCF::$DB->db_count("(panel_id)", DB_PANELS, "panel_side='".$data['panel_side']."'");
			if ($ps != $data['panel_side']) { $ps = $data['panel_side']; $i = 1; }

			if ($numrows != 1)
				{
					$up = $data['panel_order'] - 1;
					$down = $data['panel_order'] + 1;

					if ($i == 1)
						{
							$up_down = " <a href='".WCF_SELF."?action=mdown&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$down'>".$txt['down']."</a>";
						}
					else if ($i < $numrows)
						{
							$up_down = " <a href='".WCF_SELF."?action=mup&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$up'>".$txt['up']."</a>";
							$up_down .= " <a href='".WCF_SELF."?action=mdown&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$down'>".$txt['down']."</a>";
						}
					else
						{
							$up_down = " <a href='".WCF_SELF."?action=mup&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."&order=$up'>".$txt['up']."</a>";
						}
				}
			else
				{
					$up_down = "";
				}

			echo"<tr><td class='tbl1'>".$data['panel_filename']."</td>";
			echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";

			if ($data['panel_side'] == 1) { echo $txt['left']; }
			elseif ($data['panel_side'] == 2) { echo $txt['center']; }
			elseif ($data['panel_side'] == 3) { echo $txt['center_footer']; }
			elseif ($data['panel_side'] == 4) { echo $txt['right']; }

			echo"</td><td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";

			if ($data['panel_side'] == 1)
				{
					echo"<a href='".WCF_SELF."?action=mright&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".$txt['right']."</a>";
				}
			elseif ($data['panel_side'] == 2)
				{
					echo"<a href='".WCF_SELF."?action=mlower&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".$txt['down']."</a>";
				}
			elseif ($data['panel_side'] == 3)
				{
					echo"<a href='".WCF_SELF."?action=mupper&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".$txt['up']."</a>";
				}
			elseif ($data['panel_side'] == 4)
				{
					echo"<a href='".WCF_SELF."?action=mleft&panel_id=".$data['panel_id']."&order=".$data['panel_order']."'>".$txt['left']."</a>";
				}

			echo"</td><td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".$data['panel_order']."$up_down</td>";
			echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".($data['panel_type'] == "file" ? $txt['file'] : $txt['php'])."</td>";
			echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".display_access_form($data['panel_access'])."</td>";
			echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";

			echo"[<a href='panel_editor.php?action=edit&panel_id=".$data['panel_id']."&panel_side=1'>".$txt['admin_panel_edit']."</a>]";

			if ($data['panel_status'] == 0)
				{
					echo"[<a href='".WCF_SELF."?action=setstatus&status=1&panel_id=".$data['panel_id']."'>".$txt['admin_panel_switch_on']."</a>]";
				}
			else
				{
					echo"[<a href='".WCF_SELF."?action=setstatus&status=0&panel_id=".$data['panel_id']."'>".$txt['admin_panel_switch_off']."</a>]";
				}
			echo"[<a href='".WCF_SELF."?action=delete&panel_id=".$data['panel_id']."&panel_side=".$data['panel_side']."' onclick=\"return confirm('".$txt['admin_panel_del_n_y']."');\">".$txt['admin_panel_del']."</a>]";
			echo"</td></tr>";
			$i++; $k++;
		}

		echo"<div style='text-align:center;margin-top:5px'>[ <a href='panel_editor.php'>".$txt['admin_panel_add']."</a> ]";
		echo"[ <a href='".WCF_SELF."?action=refresh'>".$txt['admin_panel_refresh']."</a> ]</div>";

	closetable();

	require_once THEMES."templates/footer.php";
?>