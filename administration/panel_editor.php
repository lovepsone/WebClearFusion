<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: panel_editor.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	selectdb("wcf");
	$temp = opendir(PANELS); $panel_list = array();
	while ($folder = readdir($temp))
		{
			if ((!in_array($folder, array(".","..")) && strstr($folder, "_panel")))
				{
					$result = db_query("SELECT * FROM ".DB_PANELS." WHERE `panel_filename`='".$folder."'");

					if (is_dir(PANELS.$folder) && db_num_rows($result) == 0)
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

	if (isset($_POST['save']))
		{
			if ($_POST['panel_filename'] == "none")
				{
					redirect(WCF_SELF);
				}
			else
				{
					$panel_filename = stripinput($_POST['panel_filename']);
					$panel_type = "file";
				}

			$panel_side = isnum($_POST['panel_side']) ? $_POST['panel_side'] : "1";
			$panel_access = isnum($_POST['panel_access']) ? $_POST['panel_access'] : "0";

			if (isset($_GET['panel_id']) && isnum($_GET['panel_id']))
				{
					selectdb("wcf");
					$result = db_query("UPDATE ".DB_PANELS." SET `panel_filename`='".$panel_filename."', `panel_access`='".$panel_access."', WHERE panel_id='".$_GET['panel_id']."'");
				}
			else
				{
					selectdb("wcf");
					$result = db_query("SELECT `panel_order` FROM ".DB_PANELS." WHERE `panel_side`='".$panel_side."' ORDER BY `panel_order` DESC LIMIT 1");
					if (db_num_rows($result) != 0) { $data = db_assoc($result); $neworder = $data['panel_order'] + 1; } else { $neworder = 1; }
					$result = db_query("INSERT INTO ".DB_PANELS." (`panel_filename`,`panel_type`,`panel_access`,`panel_side`,`panel_order`)
										VALUES ('".$panel_filename."','".$panel_type."','".$panel_access."', '".$panel_side."', '".$neworder."')");
					redirect(WCF_SELF);
				}
		}
	else
		{
			if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['panel_id']) && isnum($_GET['panel_id'])))
				{
					selectdb("wcf");
					$result = db_query("SELECT * FROM ".DB_PANELS." WHERE `panel_id`='".$_GET['panel_id']."'");
					if (db_num_rows($result))
						{
							$data = db_assoc($result);
							$panel_filename = $data['panel_filename'];
							$panel_type = $data['panel_type'];
							$panel_side = $data['panel_side'];
							$panel_access = $data['panel_access'];
							$txt_page = $txt['admin_paneledit_t_edit'];
						}
					else
						{
							redirect(WCF_SELF);
						}
				}
			if (isset($_GET['panel_id']) && isnum($_GET['panel_id']))
				{
					$action = WCF_SELF."?panel_id=".$_GET['panel_id'];
				}
			else
				{
					$panel_filename = "";
					$panel_type = "";
					$panel_side = "";
					$panel_access = "";
					$txt_page = $txt['admin_paneledit_t_add'];
					$action = WCF_SELF;
				}

			opentable();
			echo"<form name='editform' method='post' action='$action'>";
			echo"<tr><td align='center' class='small' colspan='2'>".$txt_page."</td></tr>";
		
			if (isset($_GET['panel_id']) && isnum($_GET['panel_id']))
				{
					if ($panel_type == "file")
						{
							echo"<tr><td width='50%' align='right' class='small'>".$txt['file']."</td>";
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
					echo"<tr><td width='50%' align='right' class='small'>".$txt['admin_paneledit_name']."</td>";
					echo"<td width='50%' align='left'><select name='panel_filename' class='textbox' style='width:200px;'>";
		
					for ($i=0;$i < count($panel_list);$i++)
						{
							echo"<option".($panel_filename == $panel_list[$i] ? " selected='selected'" : "").">".$panel_list[$i]."</option>";
						}
					echo"</select></td></tr>";
				}
		
			if (!isset($_GET['panel_id']) || !isnum($_GET['panel_id']))
				{
					echo"<tr><td width='50%' align='right' class='small'>".$txt['admin_paneledit_position']."</td>";
					echo"<td width='50%' align='left'><select name='panel_side' class='textbox' style='width:150px;' onchange=\"showopts(this.options[this.selectedIndex].value);\">";
					echo"<option value='1'".($panel_side == "1" ? " selected='selected'" : "").">".$txt['left']."</option>";
					echo"<option value='2'".($panel_side == "2" ? " selected='selected'" : "").">".$txt['center']."</option>";
					echo"<option value='3'".($panel_side == "3" ? " selected='selected'" : "").">".$txt['center_footer']."</option>";
					echo"<option value='4'".($panel_side == "4" ? " selected='selected'" : "").">".$txt['right']."</option>";
					echo"</select></td></tr>";
				}
			echo"<tr><td width='50%' align='right' class='small'>".$txt['admin_paneledit_show']."</td>";
			echo"<td width='50%' align='left'><select name='panel_access' class='textbox' style='width:150px;'>".access($panel_access)."</select></td></tr>";
			echo"<tr><td align='center' class='small' colspan='2'><input type='submit' name='save' value='".$txt['admin_paneledit_save']."' class='button' /></td></tr></form>";
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
