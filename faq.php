<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: faq.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	if (!isset($_GET['cat_id']) || !isnum($_GET['cat_id']))
		{
			opentable();
			$result = WCF::$DB->db_query("SELECT `faq_cat_id`, `faq_cat_name`, `faq_cat_description` FROM ".DB_FAQ_CATS." ORDER BY `faq_cat_name`");
			$rows = WCF::$DB->db_num_rows($result);
			if ($rows)
				{
					$columns = 2; $i = 0;
					echo"<tr>";

					while($data = WCF::$DB->db_array($result))
						{
							if ($i != 0 && ($i % $columns == 0)) { echo"</tr><tr>"; }

							$num = WCF::$DB->db_count("(faq_id)", DB_FAQS, "faq_cat_id='".$data['faq_cat_id']."'");

							echo"<td valign='top' align='center'><a href='".WCF_SELF."?cat_id=".$data['faq_cat_id']."'><b>".$data['faq_cat_name']."</b></a> <span class='small2'>($num)</span>";
							if ($data['faq_cat_description'])
								{
									echo"<br /><span class='small2'>".$data['faq_cat_description']."</span>";
								}
							echo"</td>";
							$i++;
						}
					echo"</tr>";
				}
			else
				{
					echo"<div style='text-align:center'><br />".$txt['faq_cats_errors']."<br /><br /></div>";
				}
			closetable();
		}
	else
		{
			if ($data = WCF::$DB->db_assoc(WCF::$DB->db_query("SELECT `faq_cat_name` FROM ".DB_FAQ_CATS." WHERE `faq_cat_id`='".$_GET['cat_id']."'")))
				{
					opentable();
					echo"<tr><td class='tbl2'><a href='".WCF_SELF."'>".$txt['faq_name']."</a> &gt;";
					echo"<a href='".WCF_SELF."?cat_id=".$_GET['cat_id']."'>".$data['faq_cat_name']."</a></td>";
					echo"</tr>";

					$rows = WCF::$DB->db_count("(faq_id)", DB_FAQS, "faq_cat_id='".$_GET['cat_id']."'");
					if ($rows)
						{
							$i = 0; $ii = 1; $columns = 4; $faq_content = "";
							echo"<tr>";

							$result = WCF::$DB->db_query("SELECT `faq_id`, `faq_question`, `faq_answer` FROM ".DB_FAQS." WHERE `faq_cat_id`='".$_GET['cat_id']."' ORDER BY `faq_question`");
							$numrows = WCF::$DB->db_num_rows($result);

							while ($data = WCF::$DB->db_array($result))
								{
									if ($i != 0 && ($i % $columns == 0)) { echo"</tr><tr>"; }
									echo"<td class='tbl1' width='25%'><a href='#faq_".$data['faq_id']."'>".$data['faq_question']."</a></td>";
									$faq_content .= "<div class='".($ii % 2 == 0 ? "tbl1" : "tbl2")."' style='display:block; padding:10px 5px'>";
									$faq_content .= "<a id='faq_".$data['faq_id']."'></a><strong>".$data['faq_question']."</strong><br />".nl2br(stripslashes($data['faq_answer']));
									$faq_content .= "<br style='clear:both' /><a href='#content'><span class='small'>".$txt['faq_up']."</span></a><br />";
									$faq_content .= "</div>";
									$i++; $ii++;
								}
							echo"</tr>";
							echo"<div style='margin:5px'></div>";
							echo"<div class='tbl-border' style='padding:1px'>".$faq_content."</div>";

							closetable();
						}
					else
						{
							echo $txt['faq_data_notise']."";
							closetable();
						}
				}
			else
				{
					redirect(WCF_SELF);
				}
		}

	require_once THEMES."templates/footer.php";
?>