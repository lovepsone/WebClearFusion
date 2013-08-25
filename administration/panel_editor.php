<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: panel_editor.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	$temp = opendir(PANELS); $panel_list = array();
	while ($folder = readdir($temp))
	{
		if ((!in_array($folder, array(".","..")) && strstr($folder, "_panel")))
		{
			$rows = WCF::$DB->select('SELECT * FROM ?_panels WHERE `panel_filename`= ?', $folder);

			if (is_dir(PANELS.$folder) && $rows == null)
			{
				$panel_list[] = $folder;
			}
		}
	}
	closedir($temp);

	if (count($panel_list) != 0) 
	{
		sort($panel_list);
		array_unshift($panel_list, "none");
	}
	else
	{
		$panel_list[] = "none";
		sort($panel_list);
	}

	// ищем панели типа wc
	for ($i=1;$i <= count($modules);$i++)
	{
		$patch = $modules[$module_list[$i]]."/panels/";
		$temp = opendir($patch);
		while ($folder = readdir($temp))
		{
			if ((!in_array($folder, array(".","..")) && strstr($folder, "_panel_wc")))
			{
				$rows = WCF::$DB->select('SELECT * FROM ?_panels WHERE `panel_filename`= ?', $folder);

				if (is_dir($patch.$folder) && $rows == null)
				{
					$panel_list[] .= $folder;
				}
			}
		}
		closedir($temp); sort($panel_list);
	}

	if (isset($_POST['save']))
	{
		if ($_POST['panel_filename'] == "none")
		{
			WCF::redirect(WCF_SELF);
		}
		else
		{
			$panel_filename = WCF::$TF->stripinput($_POST['panel_filename']);
			$panel_type = "file";
		}

		$panel_side = WCF::isnum($_POST['panel_side']) ? $_POST['panel_side'] : "1";
		$panel_access =  WCF::isnum($_POST['panel_access']) ? $_POST['panel_access'] : "0";

		if (isset($_GET['panel_id']) &&  WCF::isnum($_GET['panel_id']))
		{
			WCF::$DB->query('UPDATE ?_panels SET `panel_filename`= ?, `panel_access`= ?, WHERE panel_id= ?d', $panel_filename, $panel_access, $_GET['panel_id']);
		}
		else
		{
			$data = WCF::$DB->selectRow('SELECT `panel_order` FROM ?_panels WHERE `panel_side`= ?d ORDER BY `panel_order` DESC LIMIT 1', $panel_side);
			if (db_num_rows($result) != 0) { $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
			WCF::$DB->query('INSERT INTO ?_panels (`panel_filename`,`panel_type`,`panel_access`,`panel_side`,`panel_order`)
										VALUES (?, ?, ?d, ?d, ?d)', $panel_filename, $panel_type, $panel_access, $panel_side, $neworder);
			WCF::redirect(WCF_SELF);
		}
	}
	else
	{
		if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id'])))
		{
			$data = WCF::$DB->selectRow('SELECT * FROM ?_panels WHERE `panel_id`= ?d', $_GET['panel_id']);
			if ($data != null)
			{	
				$panel_filename = $data['panel_filename'];
				$panel_type = $data['panel_type'];
				$panel_side = $data['panel_side'];
				$panel_access = $data['panel_access'];
				$txt_page = WCF::$locale['admin_paneledit_t_edit'];
			}
			else
			{
				WCF::redirect(WCF_SELF);
			}
		}
		if (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id']))
		{
			$action = WCF_SELF."?panel_id=".$_GET['panel_id'];
		}
		else
		{
			$panel_filename = "";
			$panel_type = "";
			$panel_side = "";
			$panel_access = "";
			$txt_page = WCF::$locale['admin_paneledit_t_add'];
			$action = WCF_SELF;
		}

		opentable();
		echo"<form name='editform' method='post' action='$action'>";
		echo"<tr><td align='center' class='small' colspan='2'>".$txt_page."</td></tr>";
		
		if (isset($_GET['panel_id']) && WCF::isnum($_GET['panel_id']))
		{
			if ($panel_type == "file")
			{
				echo"<tr><td width='50%' align='right' class='small'>".WCF::$locale['file']."</td>";
				echo"<td width='50%' align='left'><select name='panel_filename' class='textbox' style='width:200px;'>";
		
				for ($i=0;$i < count($panel_list);$i++)
				{
					echo"<option".($panel_filename == $panel_list[$i] ? " selected='selected'" : "").">".$panel_list[$i]."</option>";
				}
				echo"</select></td></tr>";
			}
		}
		else
		{
			echo"<tr><td width='50%' align='right' class='small'>".WCF::$locale['admin_paneledit_name']."</td>";
			echo"<td width='50%' align='left'><select name='panel_filename' class='textbox' style='width:200px;'>";
		
			for ($i=0;$i < count($panel_list);$i++)
			{
				echo"<option".($panel_filename == $panel_list[$i] ? " selected='selected'" : "").">".$panel_list[$i]."</option>";
			}
			echo"</select></td></tr>";
		}
		
		if (!isset($_GET['panel_id']) || !WCF::isnum($_GET['panel_id']))
		{
			echo"<tr><td width='50%' align='right' class='small'>".WCF::$locale['admin_paneledit_position']."</td>";
			echo"<td width='50%' align='left'><select name='panel_side' class='textbox' style='width:150px;' onchange=\"showopts(this.options[this.selectedIndex].value);\">";
			echo"<option value='1'".($panel_side == "1" ? " selected='selected'" : "").">".WCF::$locale['left']."</option>";
			echo"<option value='2'".($panel_side == "2" ? " selected='selected'" : "").">".WCF::$locale['center']."</option>";
			echo"<option value='3'".($panel_side == "3" ? " selected='selected'" : "").">".WCF::$locale['center_footer']."</option>";
			echo"<option value='4'".($panel_side == "4" ? " selected='selected'" : "").">".WCF::$locale['right']."</option>";
			echo"</select></td></tr>";
		}
		echo"<tr><td width='50%' align='right' class='small'>".WCF::$locale['admin_paneledit_show']."</td>";
		echo"<td width='50%' align='left'><select name='panel_access' class='textbox' style='width:150px;'>".access($panel_access)."</select></td></tr>";
		echo"<tr><td align='center' class='small' colspan='2'><input type='submit' name='save' value='".WCF::$locale['admin_paneledit_save']."' class='button' /></td></tr></form>";
		closetable();
	}

	echo"<script type='text/javascript'>
		function showopts(panelside)
			{
				var panelopts = document.getElementById('panelopts');
				var paneldisplay = document.getElementById('panel_display');
				if (panelside == 1 || panelside == 4)
					{
						panelopts.style.display = 'none';
						paneldisplay.checked = false;
					}
				else
					{
						panelopts.style.display = 'block';
					}
			}
	</script>";

	require_once THEMES."templates/footer.php";
?>
