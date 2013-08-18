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
   	require_once INCLUDES."tinymce.php";
   	echo $advanced_script;

	if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['faq_cat_id']) && isnum($_GET['faq_cat_id'])) && (isset($_GET['t']) && $_GET['t'] == "cat"))
		{
			selectdb("wcf");
			$result = db_count("(faq_cat_id)", DB_FAQS, "faq_cat_id='".$_GET['faq_cat_id']."'");

			if (!empty($result))
				{
					redirect(WCF_SELF."&status=delcn");
				}
			else
				{
					$result = db_query("DELETE FROM ".DB_FAQ_CATS." WHERE `faq_cat_id`='".$_GET['faq_cat_id']."'");
					redirect(WCF_SELF."?status=delcy");
				}
		}
	elseif ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['faq_id']) && isnum($_GET['faq_id'])) && (isset($_GET['t']) && $_GET['t'] == "faq"))
		{
			selectdb("wcf");
			$faq_count = db_count("(faq_id)", DB_FAQS, "faq_id='".$_GET['faq_id']."'");
			$result = db_query("DELETE FROM ".DB_FAQS." WHERE `faq_id`='".$_GET['faq_id']."'");
			if ($faq_count)
				{
					redirect(WCF_SELF."?faq_cat_id=".intval($_GET['faq_cat_id'])."&status=del");
				}
			else
				{
					redirect(WCF_SELF."?status=del");
				}
		}
	elseif (isset($_POST['save_cat']))
		{
			selectdb("wcf");
			$faq_cat_name = stripinput($_POST['faq_cat_name']);
			$faq_cat_description = stripinput($_POST['faq_cat_description']);

			if ($faq_cat_name)
				{
					if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['faq_cat_id']) && isnum($_GET['faq_cat_id'])) && (isset($_GET['t']) && $_GET['t'] == "cat"))
						{
							$result = db_query("UPDATE ".DB_FAQ_CATS." SET `faq_cat_name`='$faq_cat_name', `faq_cat_description`='$faq_cat_description' WHERE `faq_cat_id`='".$_GET['faq_cat_id']."'");
							redirect(WCF_SELF."?status=scu");
						}
					else
						{
							$result = db_query("INSERT INTO ".DB_FAQ_CATS." (`faq_cat_name`, `faq_cat_description`) VALUES('$faq_cat_name', '$faq_cat_description')");
							redirect(WCF_SELF."?status=scn");
						}
				}
			else
				{
					redirect(WCF_SELF);
				}
		}
	elseif (isset($_POST['save_faq']))
		{
			selectdb("wcf");
			$faq_cat = intval($_POST['faq_cat']);
			$faq_question = stripinput($_POST['faq_question']);
			$faq_answer = addslash($_POST['faq_answer']);

			if ($faq_question && $faq_answer)
				{
					if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['faq_id']) && isnum($_GET['faq_id'])) && (isset($_GET['t']) && $_GET['t'] == "faq"))
						{
							$result = db_query("UPDATE ".DB_FAQS." SET `faq_cat_id`='$faq_cat', `faq_question`='$faq_question', `faq_answer`='$faq_answer' WHERE `faq_id`='".$_GET['faq_id']."'");
							redirect(WCF_SELF."?faq_cat_id=$faq_cat&status=su");
						}
					else
						{
							$result = db_query("INSERT INTO ".DB_FAQS." (`faq_cat_id`, `faq_question`, `faq_answer`) VALUES ('$faq_cat', '$faq_question', '$faq_answer')");
							redirect(WCF_SELF."?faq_cat_id=$faq_cat&status=sn");
						}
				}
			else
				{
					redirect(WCF_SELF);
				}
		}
	elseif (isset($_GET['action']) && $_GET['action'] == "edit")
		{
			selectdb("wcf");
			if ((isset($_GET['faq_cat_id']) && isnum($_GET['faq_cat_id'])) && (isset($_GET['t']) && $_GET['t'] == "cat"))
				{
					$result = db_query("SELECT `faq_cat_id`, `faq_cat_name`, `faq_cat_description` FROM ".DB_FAQ_CATS." WHERE `faq_cat_id`='".$_GET['faq_cat_id']."'");
					if (db_num_rows($result))
						{
							$data = db_assoc($result);
							$faq_cat_id = $data['faq_cat_id'];
							$faq_cat_name = $data['faq_cat_name'];
							$faq_cat_description = $data['faq_cat_description'];
							$faq_cat_title = $txt['admin_faq_edit_cats'];
							$faq_cat_action = WCF_SELF."?action=edit&faq_cat_id=".$data['faq_cat_id']."&t=cat";
							// --------------------- //
							$faq_question = "";
							$faq_answer = "";
							$faq_title = $txt['admin_faq_add_cats'];
							$faq_action = WCF_SELF;
						}
					else
						{
							redirect(WCF_SELF);
						}
				}
			elseif ((isset($_GET['faq_id']) && isnum($_GET['faq_id'])) && (isset($_GET['t']) && $_GET['t'] == "faq"))
				{
					$result = db_query("SELECT `faq_id`, `faq_question`, `faq_answer` FROM ".DB_FAQS." WHERE `faq_id`='".$_GET['faq_id']."'");
					if (db_num_rows($result))
						{
							$data = db_assoc($result);
							$faq_cat_name = "";
							$faq_cat_description = "";
							$faq_cat_title = $txt['420'];
							$faq_cat_action = WCF_SELF;
							// --------------------- //
							$faq_id = $data['faq_id'];
							$faq_question = $data['faq_question'];
							$faq_answer = stripslashes($data['faq_answer']);
							$faq_title = $txt['501'];
							$faq_action = WCF_SELF."?action=edit&faq_id=".$data['faq_id']."&t=faq";
						}
					else
						{
							redirect(WCF_SELF);
						}
				}
		}
	else
		{
			$faq_cat_name = "";
			$faq_cat_description = "";
			$faq_cat_title = $txt['admin_faq_add_cats'];
			$faq_cat_action = WCF_SELF;
			$faq_question = "";
			$faq_answer = "";
			$faq_title = $txt['admin_faq_add'];
			$faq_action = WCF_SELF;
		}

	if (!isset($_GET['t']) || $_GET['t'] != "faq")
		{
			opentable();
			echo"<form name='add_faq_cat' method='post' action='".$faq_cat_action."'>";
			echo"<tr><td align='center' colspan='2' class='small'>".$faq_cat_title."</td></tr>";

			echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_faq_name_cats']."&nbsp;</td>";
			echo"<td align='left'><input type='text' name='faq_cat_name' value='".$faq_cat_name."' class='textbox' style='width:210px' /></td></tr>";

			echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_faq_description']."&nbsp;</td>";
			echo"<td align='left'><input type='text' name='faq_cat_description' value='".$faq_cat_description."' class='textbox' style='width:250px;' /></td></tr>";

			echo"<tr><td align='center' colspan='2'><input type='submit' name='save_cat' value='".$txt['admin_faq_save']."' class='button' /></td></tr>";
			echo"</form>";
			closetable();
		}

	if (!isset($_GET['t']) || $_GET['t'] != "cat")
		{
			selectdb("wcf");
			$cat_opts = ""; $sel = "";
			$result2 = db_query("SELECT `faq_cat_id`, `faq_cat_name` FROM ".DB_FAQ_CATS." ORDER BY `faq_cat_name`");
			if (db_num_rows($result2) != 0)
				{
					while ($data2 = db_array($result2))
						{
							if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['faq_cat_id']) && isnum($_GET['faq_cat_id'])) && $_GET['t'] == "faq")
								{
									$sel = ($data2['faq_cat_id'] == $_GET['faq_cat_id'] ? " selected" : "");
								}
							$cat_opts .= "<option value='".$data2['faq_cat_id']."'$sel>".$data2['faq_cat_name']."</option>";
						}

					opentable();
					echo"<form name='inputform' method='post' action='".$faq_action."'>";
					echo"<tr><td align='center' colspan='2' class='small'>".$faq_title."</td></tr>";

					echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_faq_choice_cats']."&nbsp;</td>";
					echo"<td align='left'><select name='faq_cat' class='textbox' style='width:250px;'>".$cat_opts."</select></td></tr>";

					echo"<tr><td width='50%' align='right' class='small2'>".$txt['admin_faq_question']."&nbsp;</td>";
					echo"<td align='left'><input type='text' name='faq_question' value='".$faq_question."' class='textbox' style='width:330px' /></td></tr>";

					echo"<tr><td align='center' colspan='2' class='small2'>".$txt['admin_faq_reply']."</td></tr>";
					echo"<td align='center' colspan='2'><textarea name='faq_answer' class='textbox'>".phpentities(stripslashes($faq_answer))."</textarea></td></tr>";

					echo"<tr><td align='center' colspan='2'><br />";
					echo"<input type='submit' name='save_faq' value='".$txt['admin_faq_save']."' class='button' /></td>";
					echo"</tr></form>";
					closetable();
				}
		}

	opentable(); selectdb("wcf");
	$result = db_query("SELECT `faq_cat_id`, `faq_cat_name` FROM ".DB_FAQ_CATS." ORDER BY `faq_cat_name`");

	if (db_num_rows($result) != 0)
		{
			echo"<tr><th width='50%' class='forum-caption'>".$txt['admin_faq_cast_quest']."</th>";
			echo"<th width='50%' class='forum-caption'>".$txt['admin_faq_option']."</th></tr>";
			echo"<tr><td colspan='2' height='1'></td></tr>";

			while ($data = db_array($result))
				{
					if (!isset($_GET['faq_cat_id']) || !isnum($_GET['faq_cat_id'])) { $_GET['faq_cat_id'] = 0; }
					if ($data['faq_cat_id'] == $_GET['faq_cat_id']) { $p_img = "off"; $div = ""; } else { $p_img = "on"; $div = "style='display:none'"; }

					echo"<tr><td colspan='2'><hr></td></tr>";
					echo"<tr><td class='small' align='center'><b>".$data['faq_cat_name']."</b></td>";
					echo"<td class='small' align='center' style='font-weight:normal;'>";
					echo"<a href='".WCF_SELF."?action=edit&faq_cat_id=".$data['faq_cat_id']."&t=cat'><b>".$txt['admin_faq_change']."</b></a> -";
					echo"<a href='".WCF_SELF."?action=delete&faq_cat_id=".$data['faq_cat_id']."&t=cat' onclick=\"return confirm('".$txt['admin_faq_del_cats']."');\"><b>".$txt['admin_faq_del']."</b></a></td>";
					echo"</tr>";

					$result2 = db_query("SELECT `faq_id`, `faq_question`, `faq_answer` FROM ".DB_FAQS." WHERE `faq_cat_id`='".$data['faq_cat_id']."' ORDER BY `faq_id`");
					if (db_num_rows($result2) != 0)
						{
							echo"<tr><td colspan='2'>";
							echo"<div id='box_".$data['faq_cat_id']."'".$div.">";

							while ($data2 = db_array($result2))
								{
									echo"<tr><td class='alt' align='center'><strong>".$data2['faq_question']."</strong></td>";
									echo"<td align='center' class='alt' width='80'>";
									echo"<a href='".WCF_SELF."?action=edit&faq_cat_id=".$data['faq_cat_id']."&faq_id=".$data2['faq_id']."&t=faq'>".$txt['admin_faq_change']."</a> -";
									echo"<a href='".WCF_SELF."?action=delete&faq_cat_id=".$data['faq_cat_id']."&faq_id=".$data2['faq_id']."&t=faq' onclick=\"return confirm('".$txt['admin_faq_del_q']."');\">".$txt['admin_faq_del']."</a></td>";
									echo"</tr><tr>";
									echo"<td colspan='2' align='center' class='small2'>".trimlink(stripinput($data2['faq_answer']), 80)."</td></tr>";
								}

							echo"</div></td></tr>";
						}
					else
						{
							echo"<tr><td colspan='2'>";
							echo"<div id='box_".$data['faq_cat_id']."' style='display:none'>";
							echo"<tr><td class='alt' align='center'>".$txt['admin_faq_no_create']."</td></tr>";
							echo"</div></td></tr>";
						}
				}
		}
	else
		{
			echo"<div style='text-align:center'>".$txt['admin_faq_no_cats']."<br /></div>";
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>