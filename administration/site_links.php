<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
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
			selectdb("wcf");
			$result = db_query("SELECT * FROM ".DB_NAVIGATION_LINKS." ORDER BY `link_order`");
			while ($data = db_array($result))
				{
					$result2 = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET link_order='$i' WHERE link_id='".$data['link_id']."'");
					$i++;
				}
			redirect(WCF_SELF);
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "moveup") && (isset($_GET['link_id']) && isnum($_GET['link_id'])))
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT `link_id` FROM ".DB_NAVIGATION_LINKS." WHERE `link_order`='".intval($_GET['order'])."'"));
			$result = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET `link_order`=link_order+1 WHERE `link_id`='".$data['link_id']."'");
			$result = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET `link_order`=link_order-1 WHERE `link_id`='".$_GET['link_id']."'");
			redirect(WCF_SELF);
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "movedown") && (isset($_GET['link_id']) && isnum($_GET['link_id'])))
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT `link_id` FROM ".DB_NAVIGATION_LINKS." WHERE `link_order`='".intval($_GET['order'])."'"));
			$result = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET `link_order`=link_order-1 WHERE `link_id`='".$data['link_id']."'");
			$result = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET `link_order`=link_order+1 WHERE `link_id`='".$_GET['link_id']."'");
			redirect(WCF_SELF);
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['link_id']) && isnum($_GET['link_id'])))
		{
			selectdb("wcf");
			$data = db_assoc(db_query("SELECT `link_order` FROM ".DB_NAVIGATION_LINKS." WHERE `link_id`='".$_GET['link_id']."'"));
			$result = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET `link_order`=link_order-1 WHERE `link_order`>'".$data['link_order']."'");
			$result = db_query("DELETE FROM ".DB_NAVIGATION_LINKS." WHERE `link_id`='".$_GET['link_id']."'");
			redirect(WCF_SELF."?status=del");
		}
	else
		{
			if (isset($_POST['savelink']))
					{
						selectdb("wcf");
						$link_name = stripinput($_POST['link_name']);
						$link_url = stripinput($_POST['link_url']);
						$link_visibility = isnum($_POST['link_visibility']) ? $_POST['link_visibility'] : "-1";
						$link_position = isset($_POST['link_position']) ? $_POST['link_position'] : "1";
						$link_order = isnum($_POST['link_order']) ? $_POST['link_order'] : "";
		
						if ($link_name && $link_url)
							{
								if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['link_id']) && isnum($_GET['link_id'])))
									{
										$old_link_order = db_result(db_query("SELECT `link_order` FROM ".DB_NAVIGATION_LINKS." WHERE `link_id`='".$_GET['link_id']."'"), 0);
		
										if ($link_order > $old_link_order)
											{
												$result = dbquery("UPDATE ".DB_NAVIGATION_LINKS." SET `link_order`=link_order-1 WHERE `link_order`>'$old_link_order' AND `link_order`<='$link_order'");
											}
										elseif ($link_order < $old_link_order)
											{
												$result = dbquery("UPDATE ".DB_NAVIGATION_LINKS." SET `link_order`=link_order+1 WHERE `link_order`<'$old_link_order' AND `link_order`>='$link_order'");
											}
		
										$result = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET `link_name`='$link_name', `link_url`='$link_url', `link_visibility`='$link_visibility', `link_position`='$link_position', `link_order`='$link_order' WHERE `link_id`='".$_GET['link_id']."'");
										redirect(WCF_SELF."?status=su");
									}
								else
									{
										if (!$link_order) { $link_order = db_result(db_query("SELECT MAX(`link_order`) FROM ".DB_NAVIGATION_LINKS.""), 0) + 1; }
		
										$result = db_query("UPDATE ".DB_NAVIGATION_LINKS." SET link_order=link_order+1 WHERE link_order>='$link_order'");
										$result = db_query("INSERT INTO ".DB_NAVIGATION_LINKS." (`link_name`, `link_url`, `link_visibility`, `link_position`, `link_order`) VALUES ('".$link_name."', '".$link_url."', '".$link_visibility."', '".$link_position."', '".$link_order."')");
										redirect(WCF_SELF."?status=sn");
									}
							}
						else
							{
								redirect(WCF_SELF);
							}
					}

			if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['link_id']) && isnum($_GET['link_id'])))
					{
						selectdb("wcf");
						$result = db_query("SELECT * FROM ".DB_NAVIGATION_LINKS." WHERE `link_id`='".$_GET['link_id']."'");
		
						if (db_num_rows($result))
							{
								$data = db_assoc($result);
								$link_name = $data['link_name'];
								$link_url = $data['link_url'];
								$link_order = $data['link_order'];
								$link_visibility = $data['link_visibility'];
								$txt_page = $txt['admin_slinks_title_edit'];
								$formaction = WCF_SELF."?action=edit&link_id=".$_GET['link_id'];
							}
						else
							{
								redirect(WCF_SELF);
							}
					} 
			else
				{
					$link_name = "";
					$link_url = "";
					$link_order = "";
					$link_visibility = "";
					$txt_page = $txt['admin_slinks_title_add'];
					$formaction = WCF_SELF;
				}
			opentable();
			//echo"<form name='layoutform' method='post' action='".$formaction."'>";
			echo"<form method='post'>";
			echo"<tr><td align='center' colspan='2' class='small'><h4>".$txt_page."</h4></td></tr>";
			echo"<tr><td align='right' width='50%' class='small'>".$txt['admin_slinks_name']."</td>";
			echo"<td align='left'><input type='text' name='link_name' value='".$link_name."' maxlength='100' class='textbox' style='width:240px;' /></td></tr>";
			echo"<tr><td align='right' width='50%' class='small'>".$txt['admin_slinks_url']."</td>";
			echo"<td align='left'><input type='text' name='link_url' value='".$link_url."' maxlength='200' class='textbox' style='width:240px;' /></td></tr>";
			echo"<tr><td align='right' width='50%' class='small'>".$txt['admin_slinks_show']."</td>";
			echo"<td align='left' class='small'><select name='link_visibility' class='textbox' style='width:150px;'>".access($link_visibility)."</select>";
			echo $txt['admin_slinks_order']."<input type='text' name='link_order'  value='".$link_order."' maxlength='3' class='textbox' style='width:40px;' /></td></tr>";
			echo"<tr><td align='center' colspan='2'><hr><input type='submit' name='savelink' value='".$txt['admin_slinks_save']."' class='button' /></td></tr>";
			echo"</form>";
			closetable();
		
			opentable();
			echo"<tr><td align='center' colspan='5' class='small'><h4>".$txt['admin_slinks_current_url']."</h4></td></tr>";
			echo"<tr><td width='25%' class='small'><strong>".$txt['admin_slinks_name_url']."</strong></td>";
			echo"<td align='center' width='25%' class='small' style='white-space:nowrap'><strong>".$txt['admin_slinks_show_url']."</strong></td>";
			echo"<td align='center' colspan='2' width='25%' class='small' style='white-space:nowrap'><strong>".$txt['admin_slinks_order_url']."</strong></td>";
			echo"<td align='center' width='25%' class='small' style='white-space:nowrap'><strong>".$txt['admin_slinks_settings_url']."</strong></td></tr>";
			echo"<tr><td colspan='5'><hr></td></tr>";

			selectdb("wcf");
			$result = db_query("SELECT * FROM ".DB_NAVIGATION_LINKS." ORDER BY `link_order`");
			if (db_num_rows($result))
				{
					$i = 0; $k = 1;
		
					while($data = db_array($result))
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
		
							if (db_num_rows($result) != 1)
								{
									$up = $data['link_order'] - 1;
									$down = $data['link_order'] + 1;
		
									if ($k == 1)
										{
											echo"<a href='".WCF_SELF."?action=movedown&order=$down&link_id=".$data['link_id']."'>".$txt['down']."</a>";
										}
									elseif ($k < db_num_rows($result))
										{
											echo"<a href='".WCF_SELF."?action=moveup&order=$up&link_id=".$data['link_id']."'>".$txt['up']."</a>";
											echo"<a href='".WCF_SELF."?action=movedown&order=$down&link_id=".$data['link_id']."'>".$txt['down']."</a>";
										}
									else
										{
											echo"<a href='".WCF_SELF."?action=moveup&order=$up&link_id=".$data['link_id']."'>".$txt['up']."</a>";
										}
								}
							$k++;
							echo"</td>";
							echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'><a href='".WCF_SELF."?action=edit&link_id=".$data['link_id']."'>".$txt['admin_slinks_edit_url']."</a> -";
							echo"<a href='".WCF_SELF."?action=delete&link_id=".$data['link_id']."' onclick=\"return confirm('".$txt['admin_slinks_del_url_n_y']."');\">".$txt['admin_slinks_del_url']."</a></td>";
							echo"</tr>";
							$i++;
						}
				}
			else
				{
					echo"<tr><td align='center' colspan='5' class='small'>".$txt['admin_slinks_no_url']."</td></tr>";
				}
			if (db_num_rows($result)) { echo"<div style='text-align:center;margin-top:5px'>[ <a href='".WCF_SELF."?action=refresh'>".$txt['admin_slinks_refresh']."</a> ]</div>"; }
			closetable();
		}

	require_once THEMES."templates/footer.php";
?>
