<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
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
			$sections_name = trim(stripinput($_POST['sections_name']));
			if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['forum_id']) && isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "sections"))
				{
					selectdb("wcf");
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_name`='$sections_name' WHERE `forum_id`='".$_GET['forum_id']."'");
					redirect(WCF_SELF."?status=savecu");
				}
			else
				{
					if ($sections_name)
						{
							selectdb("wcf");
							$sections_order = isnum($_POST['sections_order']) ? $_POST['sections_order'] : "";
							if(!$sections_order)
								{
									$sections_order = db_result(db_query("SELECT MAX(forum_order) FROM ".DB_FORUMS." WHERE `forum_sections`='0'"),0)+1;
								}
							$result = db_query("UPDATE ".DB_FORUMS." SET forum_order=forum_order+1 WHERE `forum_sections`='0' AND `forum_order`>='$sections_order'");
							$result = db_query("INSERT INTO ".DB_FORUMS." (`forum_sections`, `forum_order`, `forum_name`) VALUES ('0', '$sections_order', '$sections_name')");
							redirect(WCF_SELF."?status=savecn");
						}
				}
		}
	elseif (isset($_POST['save_forum']))
		{
			selectdb("wcf");
			$forum_name = trim(stripinput($_POST['forum_name']));
			$forum_description = trim(stripinput($_POST['forum_description']));
			$forum_sections = isnum($_POST['forum_sections']) ? $_POST['forum_sections'] : 0;

			if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['forum_id']) && isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "forum"))
				{
					$result = db_query("UPDATE ".DB_FORUMS." SET  `forum_sections`='$forum_sections', `forum_name`='$forum_name', `forum_description`='$forum_description' WHERE `forum_id`='".$_GET['forum_id']."'");
					redirect(WCF_SELF."?status=savefu");
				}
			else
				{
					if ($forum_name)
						{
							$forum_order = isnum($_POST['forum_order']) ? $_POST['forum_order'] : "";
							if(!$forum_order)
								{
									$forum_order = db_result(db_query("SELECT MAX(forum_order) FROM ".DB_FORUMS." WHERE `forum_sections`='$forum_sections'"),0)+1;
								}
							$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_sections`='$forum_sections' AND `forum_order`>='$forum_order'");
							$result = db_query("INSERT INTO ".DB_FORUMS." (`forum_sections`, `forum_order`, `forum_name`, `forum_description`) VALUES ('$forum_sections', '$forum_order', '$forum_name', '$forum_description')");
							redirect(WCF_SELF."?status=savefn");
						}
					else
						{
							redirect(WCF_SELF);
						}
				}
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "mu") && (isset($_GET['forum_id']) && isnum($_GET['forum_id'])) && (isset($_GET['order']) && isnum($_GET['order'])))
		{
			selectdb("wcf");
			if (isset($_GET['type']) && $_GET['type'] == "sections")
				{
					$data = db_array(db_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='0' AND `forum_order`='".$_GET['order']."'"));
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$data['forum_id']."'");
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$_GET['forum_id']."'");
				}
			elseif ((isset($_GET['type']) && $_GET['type'] == "forum") && (isset($_GET['sections']) && isnum($_GET['sections'])))
				{
					$data = db_array(db_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='".$_GET['sections']."' AND `forum_order`='".$_GET['order']."'"));
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$data['forum_id']."'");
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$_GET['forum_id']."'");
				}
			redirect(WCF_SELF);
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "md") && (isset($_GET['forum_id']) && isnum($_GET['forum_id'])) && (isset($_GET['order']) && isnum($_GET['order'])))
		{
			selectdb("wcf");
			if (isset($_GET['type']) && $_GET['type'] == "sections")
				{
					$data = db_array(db_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='0' AND `forum_order`='".$_GET['order']."'"));
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$data['forum_id']."'");
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$_GET['forum_id']."'");
				}
			elseif ((isset($_GET['type']) && $_GET['type'] == "forum") && (isset($_GET['sections']) && isnum($_GET['sections'])))
				{
					$data = db_array(db_query("SELECT `forum_id` FROM ".DB_FORUMS." WHERE `forum_sections`='".$_GET['sections']."' AND `forum_order`='".$_GET['order']."'"));
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_id`='".$data['forum_id']."'");
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order+1 WHERE `forum_id`='".$_GET['forum_id']."'");
				}
			redirect(WCF_SELF);
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['forum_id']) && isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "sections"))
		{
			selectdb("wcf");
			if (!db_count("(forum_id)", DB_FORUMS, "forum_sections='".$_GET['forum_id']."'"))
				{
					$data = db_array(db_query("SELECT forum_order FROM ".DB_FORUMS." WHERE forum_id='".$_GET['forum_id']."'"));
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_sections`='0' AND `forum_order`>'".$data['forum_order']."'");
					$result = db_query("DELETE FROM ".DB_FORUMS." WHERE `forum_id`='".$_GET['forum_id']."'");
					redirect(WCF_SELF."?status=delcy");
				}
			else
				{
					redirect(WCF_SELF."?status=delcn");
				}
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['forum_id']) && isnum($_GET['forum_id'])) && (isset($_GET['type']) && $_GET['type'] == "forum"))
		{
			selectdb("wcf");
			if (!db_count("(thread_id)", DB_FORUMS_THREADS, "forum_id='".$_GET['forum_id']."'"))
				{
					$data = db_array(db_query("SELECT `forum_sections` FROM ".DB_FORUMS." WHERE `forum_id`='".$_GET['forum_id']."'"));
					$result = db_query("UPDATE ".DB_FORUMS." SET `forum_order`=forum_order-1 WHERE `forum_sections`='".$data['forum_sections']."' AND `forum_order`>'".$data['forum_order']."'");
					$result = db_query("DELETE FROM ".DB_FORUMS." WHERE `forum_id`='".$_GET['forum_id']."'");
					redirect(WCF_SELF."?status=delfy");
				}
			else
				{
					redirect(WCF_SELF."?status=delfn");
				}
		}
	else
		{
			selectdb("wcf");
			if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['forum_id']) && isnum($_GET['forum_id'])))
				{
					if (isset($_GET['type']) && $_GET['type'] == "sections")
						{
							$result = db_query("SELECT * FROM ".DB_FORUMS." WHERE `forum_id`='".$_GET['forum_id']."'");
							if (db_num_rows($result))
								{
									$data = db_array($result);
									$sections_title = $txt['admin_forumedit_edit_f_s'];
									$sections_name = $data['forum_name'];
								}
							else
								{
									redirect(WCF_SELF);
								}
						}
					elseif (isset($_GET['type']) && $_GET['type'] == "forum")
						{
							$result = db_query("SELECT * FROM ".DB_FORUMS." WHERE `forum_id`='".$_GET['forum_id']."'");
							if (db_num_rows($result))
								{
									$data = db_array($result);
									$forum_title = $txt['admin_forumedit_edit_f_f'];
									$forum_name = $data['forum_name'];
									$forum_description = $data['forum_description'];
								}
							else
								{
									redirect(WCF_SELF);
								}
						}
				}
			else
				{
					$sections_name = "";
					$sections_title = $txt['admin_forumedit_add_f_s'];
					$forum_name = "";
					$forum_description = "";
					$forum_title = $txt['admin_forumedit_add_f_f'];
				}
			//======================================================
			// 1-я форма связана с разделами
			if (!isset($_GET['type']) || $_GET['type'] != "forum" && $_GET['action'] != "delete")
				{
					opentable();
					echo"<form method='post'>";
					echo"<tr><td align='center' colspan='2' class='small'>".$sections_title."</td></tr>";
					echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_forumedit_name_f_s']."&nbsp;</td>";
					echo"<td width='50%' align='left' class='small2'><input type='text' name='sections_name' value='".$sections_name."' class='textbox' style='width:230px;'/></td></tr>";
					echo"<tr><td width='50%' align='right' class='small2'>";
		
					if (!isset($_GET['action']) || $_GET['action'] != "edit")
							{
								echo $txt['admin_forumedit_order_f_s']."&nbsp;</td>";
								echo"<td width='50%' align='left' class='small2'><input type='text' name='sections_order' class='textbox' style='width:45px;' />";
							}
					echo"</td></tr>";
					echo"<tr><td align='center' colspan='2'><input type='submit' name='save_sections' value='".$txt['admin_forumedit_savesect']."' class='button' /></td></tr>";
					echo"</form>";
					closetable();
				}
		
			//======================================================
			// 2-я форма связан с форумами
			if (!isset($_GET['type']) || $_GET['type'] != "sections" && $_GET['action'] != "delete")
				{
					$forum_opts = "";
		
					selectdb("wcf");
					$result2 = db_query("SELECT * FROM ".DB_FORUMS." WHERE `forum_sections`='0' ORDER BY `forum_order`");
		
					if (db_num_rows($result2))
						{
							while ($data2 = db_array($result2))
								{
									$forum_opts .= "<option value='".$data2['forum_id']."'>".$data2['forum_name']."</option>";
								}
		
							opentable();
							echo"<form method='post'>";
							echo"<tr><td align='center' colspan='2' class='small'>".$forum_title."</td></tr>";
		
							echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_forumedit_name_f_f']."&nbsp;</td>";
							echo"<td width='50%' align='left' class='small2'><input type='text' name='forum_name' value='".$forum_name."' class='textbox' style='width:230px;'/></td></tr>";
		
							echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_forumedit_descript_f_f']."&nbsp;</td>";
							echo"<td width='50%' align='left' class='small2'><input type='text' name='forum_description' value='".$forum_description."' class='textbox' style='width:230px;'/></td></tr>";
		
							echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_forumedit_sections']."&nbsp;</td>";
							echo"<td width='50%' align='left' class='small2'><select name='forum_sections' class='textbox' style='width:230px;'>".$forum_opts."</select></td></tr>";
		
							echo"<tr><td width='50%' align='right' class='small2'>";
		
							if (!isset($_GET['action']) || $_GET['action'] != "edit")
								{
									echo $txt['admin_forumedit_order_f_s']."&nbsp;</td>";
									echo"<td width='50%' align='left' class='small2'><input type='text' name='forum_order' class='textbox' style='width:45px;' />";
								}
							echo"</td></tr>";
		
							echo"<tr><td align='center' colspan='2'><input type='submit' name='save_forum' value='".$txt['admin_forumedit_savesect']."' class='button' /></td></tr>";
		
							echo"</form>";
							closetable();
						}
				}
		
			//======================================================
			// 3-я форма связана с позициями разделов и форумов
			$i = 1; $k = 1;
		
			selectdb("wcf");
			$result = db_query("SELECT * FROM ".DB_FORUMS." WHERE `forum_sections`='0' ORDER BY `forum_order`");
		
		
			if (db_num_rows($result) != 0)
				{
					opentable();
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
											echo"<a href='".WCF_SELF."?type=sections&action=md&order=".$down."&forum_id=".$data['forum_id']."'>".$txt['down']."</a>";
										}
									elseif ($i < db_num_rows($result))
										{
											echo"<a href='".WCF_SELF."?type=sections&action=mu&order=$up&forum_id=".$data['forum_id']."'>".$txt['up']."</a>";
											echo"<a href='".WCF_SELF."?type=sections&action=md&order=$down&forum_id=".$data['forum_id']."'>".$txt['down']."</a>";
										}
									else
										{
											echo"<a href='".WCF_SELF."?type=sections&action=mu&order=$up&forum_id=".$data['forum_id']."'>".$txt['up']."</a>";
										}
								}
							$i++;
							echo"</td>";
		
							echo"<td align='center' width='1%' class='small' style='white-space:nowrap'>";
							echo"<a href='".WCF_SELF."?type=sections&action=edit&forum_id=".$data['forum_id']."'>".$txt['admin_forumedit_edit']."</a> ::";
							echo"<a href='".WCF_SELF."?type=sections&action=delete&forum_id=".$data['forum_id']."'>".$txt['admin_forumedit_del']."</a></td></tr>";
							echo"<tr><td colspan='4'><hr></td></tr>";
		
							$result2 = db_query("SELECT * FROM ".DB_FORUMS." WHERE `forum_sections`='".$data['forum_id']."' ORDER BY `forum_order`");
		
							if (db_num_rows($result2))
								{
									$k = 1;
									while ($data2 = db_array($result2))
										{
											echo"<tr><td class='tbl1' width='60%'><span class='alt'>".$data2['forum_name']."</span>";
											echo"[<a href='".WCF_SELF."?action=prune&forum_id=".$data2['forum_id']."'>".$txt['admin_forumedit_cleaning']."</a>]<br>";
											echo ($data2['forum_description'] ? "<span class='small2'>".$data2['forum_description']."</span>" : "")."</td>";
											echo"<td align='center' width='5%' class='tbl2'>".$data2['forum_order']."</td>";
											echo"<td align='center' width='21%' class='tbl1'>";
		
											if (db_num_rows($result2) != 1)
												{
													$up = $data2['forum_order'] - 1;
													$down = $data2['forum_order'] + 1;
		
													if ($k == 1)
														{
															echo"<a href='".WCF_SELF."?type=forum&action=md&order=$down&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['down']."</a>";
														}
													elseif ($k < db_num_rows($result2))
														{
															echo"<a href='".WCF_SELF."?type=forum&action=mu&order=$up&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['up']."</a>";
															echo"<a href='".WCF_SELF."?type=forum&action=md&order=$down&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['down']."</a>";
														}
													else
														{
															echo"<a href='".WCF_SELF."?type=forum&action=mu&order=$up&forum_id=".$data2['forum_id']."&sections=".$data2['forum_sections']."'>".$txt['up']."</a>";
														}
												}
											$k++;
											echo"</td>";
											echo"<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>";
											echo"<a href='".WCF_SELF."?type=forum&action=edit&forum_id=".$data2['forum_id']."'>".$txt['admin_forumedit_edit']."</a> ::";
											echo"<a href='".WCF_SELF."?type=forum&action=delete&forum_id=".$data2['forum_id']."'>".$txt['admin_forumedit_del']."</a></td>";
											echo"</tr>";
										}
								}
						}
					closetable();
				}
		}

require_once THEMES."templates/footer.php";
?>
