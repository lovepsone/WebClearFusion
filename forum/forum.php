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

//=========================================================================
// Заметки
// Придумать функцию, дя замены substr($tm_section['thread_subject'],0,30) 
//=========================================================================

	selectdb(wcf);
	$result = mysql_query("SELECT * FROM ".DB_FORUMS." GROUP BY `forum_id` ORDER BY `forum_order` ASC, `forum_order` ASC");

	opentable();
   	echo"<tr><th width='4%'></th>";
	echo"<th width='60%' class='forum-caption'>".$txt['forum_column_section']."</th>";
	echo"<th width='21%' class='forum-caption'>".$txt['forum_column_last_post']."</th>";
	echo"<th width='5%' class='forum-caption'>".$txt['forum_column_so']."</th>";
	echo"<th width='10%' class='forum-caption'>".$txt['forum_column_posts']."</th></tr>";

	while($data = db_array($result))
		{
			if ($data['forum_sections'] == '0')
				{
          				echo"<tr><td width='100%' colspan='5' align='left' class='tbl'>&nbsp;&nbsp;".$data['forum_name']."<br><hr></td></tr>";

					$result_ = mysql_query("SELECT * FROM ".DB_FORUMS."
									LEFT JOIN ".DB_FORUMS_THREADS." ON ".DB_FORUMS_THREADS.".`thread_lastpostid`=".DB_FORUMS.".`forum_lastpostid`
									LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_FORUMS_THREADS.".`thread_lastuser`
									LEFT JOIN ".DB_FORUMS_POSTS." ON ".DB_FORUMS_POSTS.".`post_id`=".DB_FORUMS_THREADS.".`thread_lastpostid`
									WHERE `forum_sections`='".$data['forum_id']."'");

					while ($data = db_array($result_))
						{
							echo"<tr><td width='4%' align='left' class='tbl1'></td>";
							echo"<td width='59%' align='left' class='tbl1'>&nbsp;&nbsp;<a href='index.php?modul=thread&id=$data[forum_id]'><b>".$data['forum_name']."</b></a><br>&nbsp;&nbsp;<span class='small'>".$data['forum_description']."</span></td>";
							echo"<td width='21%' align='left' class='tbl1'>&nbsp;&nbsp;<a href='index.php?modul=post&id=$data[thread_id]&forum_id=$data[forum_id]'><b>".substr($data['thread_subject'],0,30)."...</b></a><br>&nbsp;&nbsp;".$txt['forum_from']."&nbsp;".ucfirst(strtolower($data['user_name']))."<br>&nbsp;&nbsp;".$data['post_date']."</td>";
							echo"<td width='5%' align='center'class='tbl2'>".$data['forum_threadcount']."</td>";
							echo"<td width='11%' align='center' class='tbl2'>".$data['forum_postcount']."</td></tr>";	
						}	
				}	
		}
	closetable();
?>