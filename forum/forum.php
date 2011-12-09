<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: forum.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	selectdb(wcf);
	$result = mysql_query("SELECT f.*, f2.`forum_name` AS `forum_sections_name`, u.`user_id`, u.`user_name`,
					t.`thread_id`, t.`thread_lastuser`, t.`thread_lastpostid`, t.`thread_subject`,
					p.`post_id`, p.`post_id`, p.`post_date`
					FROM ".DB_FORUMS." f
					LEFT JOIN ".DB_FORUMS." f2 ON f.`forum_sections` = f2.`forum_id`
					LEFT JOIN ".DB_FORUMS_THREADS." t ON t.`thread_lastpostid`=f.`forum_lastpostid`
					LEFT JOIN ".DB_USERS." u ON u.`user_id`=t.`thread_lastuser`
					LEFT JOIN ".DB_FORUMS_POSTS." p ON p.`post_id`=t.`thread_lastpostid`
					WHERE f.`forum_sections`!='0' GROUP BY f.`forum_id` ORDER BY f2.`forum_order` ASC, f.`forum_order` ASC");
	$current_cat = "";
	opentable();

	if (db_num_rows($result) != 0)
		{
   			echo"<tr><th width='4%'></th>";
			echo"<th width='60%' class='forum-caption'>".$txt['forum_column_section']."</th>";
			echo"<th width='21%' class='forum-caption'>".$txt['forum_column_last_post']."</th>";
			echo"<th width='5%' class='forum-caption'>".$txt['forum_column_so']."</th>";
			echo"<th width='10%' class='forum-caption'>".$txt['forum_column_posts']."</th></tr>";

			while ($data = db_array($result))
				{
					if ($data['forum_sections_name'] != $current_cat)
						{
							$current_cat = $data['forum_sections_name'];
          						echo"<tr><td width='100%' colspan='5' align='left' class='tbl'>".$data['forum_sections_name']."<br><hr></td></tr>";
						}

					echo"<tr><td width='4%' align='left' class='tbl1'></td>";
					echo"<td width='59%' align='left' class='tbl1'><a href='index.php?modul=thread&id=".$data['forum_id']."'><b>".$data['forum_name']."</b></a>";
					echo"<br><span class='small'>".$data['forum_description']."</span></td>";

					echo"<td width='21%' align='left' class='tbl1'><a href='index.php?modul=post&id=".$data['thread_id']."&forum_id=".$data['forum_id']."'><b>".substring($data['thread_subject'],0,30)."...</b></a>";
					echo"<br>&nbsp;&nbsp;".$txt['forum_from']."&nbsp;".ucfirst(strtolower($data['user_name']))."<br>&nbsp;&nbsp;".$data['post_date']."</td>";

					echo"<td width='5%' align='center'class='tbl2'>".$data['forum_threadcount']."</td>";
					echo"<td width='11%' align='center' class='tbl2'>".$data['forum_postcount']."</td></tr>";	
				}
		}
	else
		{
			echo"<tr><td width='100%' align='center' class='tbl1'>".$txt['forum_no_partitions']."</td></tr>";
		}	
	closetable();
?>