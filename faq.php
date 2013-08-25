<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: faq.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	if (!isset($_GET['cat_id']) || !WCF::isnum($_GET['cat_id']))
	{
		opentable();
		$rows = WCF::$DB->select(' -- CACHE: 180
				SELECT `faq_cat_id`, `faq_cat_name`, `faq_cat_description` FROM ?_faq_cats ORDER BY `faq_cat_name`');

		if ($rows != null)
		{
			$columns = 2; $i = 0;
			echo"<tr>";

			foreach ($rows as $numRow => $data)
			{
				if ($i != 0 && ($i % $columns == 0)) { echo"</tr><tr>"; }

  				$rowsCount = WCF::$DB->select(' -- CACHE: 180
						SELECT count(`faq_id`) FROM ?_faqs WHERE faq_cat_id = ?d', $data['faq_cat_id']);

				foreach ($rowsCount as $numRows => $num) {}

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
			echo"<div style='text-align:center'><br />".WCF::$locale['faq_cats_errors']."<br /><br /></div>";
		}
		closetable();
	}
	else
	{
		if (($data = WCF::$DB->selectRow('SELECT `faq_cat_name` FROM ?_faq_cats WHERE `faq_cat_id`= ?d', $_GET['cat_id'])) != null)
		{
			opentable();
			echo"<tr><td class='tbl2'><a href='".WCF_SELF."'>".WCF::$locale['faq_name']."</a> &gt;";
			echo"<a href='".WCF_SELF."?cat_id=".$_GET['cat_id']."'>".$data['faq_cat_name']."</a></td>";
			echo"</tr>";

			$rowsCount = WCF::$DB->select(' -- CACHE: 180
					SELECT count(`faq_id`) FROM ?_faqs WHERE faq_cat_id = ?d', $_GET['cat_id']);

			foreach ($rowsCount as $numRows => $num) {}

			if ($num)
			{
				$i = 0; $ii = 1; $columns = 4; $faq_content = "";
				echo"<tr>";

				$rows = WCF::$DB->select(' -- CACHE: 180
					SELECT `faq_id`, `faq_question`, `faq_answer` FROM ?_faqs WHERE `faq_cat_id`= ?d ORDER BY `faq_question`', $_GET['cat_id']);
				$numrows = count($rows);

				foreach ($rows as $numRow => $data)
				{
					if ($i != 0 && ($i % $columns == 0)) { echo"</tr><tr>"; }
					echo"<td class='tbl1' width='25%'><a href='#faq_".$data['faq_id']."'>".$data['faq_question']."</a></td>";
					$faq_content .= "<div class='".($ii % 2 == 0 ? "tbl1" : "tbl2")."' style='display:block; padding:10px 5px'>";
					$faq_content .= "<a id='faq_".$data['faq_id']."'></a><strong>".$data['faq_question']."</strong><br />".nl2br(stripslashes($data['faq_answer']));
					$faq_content .= "<br style='clear:both' /><a href='#content'><span class='small'>".WCF::$locale['faq_up']."</span></a><br />";
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
				echo WCF::$locale['faq_data_notise']."";
				closetable();
			}
		}
		else
		{
			WCF::redirect(WCF_SELF);
		}
	}

	require_once THEMES."templates/footer.php";
?>