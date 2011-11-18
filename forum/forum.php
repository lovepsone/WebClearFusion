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
	$result = mysql_query("SELECT * FROM ".DB_FORUMS."");

	opentable();
   	echo"<tr><th width='4%'></th>";
	echo"<th width='60%' class='forum-caption'>".$txt['forum_column_section']."</th>";
	echo"<th width='21%' class='forum-caption'>".$txt['forum_column_last_post']."</th>";
	echo"<th width='5%' class='forum-caption'>".$txt['forum_column_so']."</th>";
	echo"<th width='10%' class='forum-caption'>".$txt['forum_column_posts']."</th></tr>";

	while($section = mysql_fetch_array($result))
		{
			if ($section['forum_sections'] == '0')
				{
          				echo"<tr><td width='100%' colspan='5' align='left' class='tbl'>&nbsp;&nbsp;".$section['forum_name']."<br><hr></td></tr>";

					$tm_result = mysql_query("SELECT * FROM ".DB_FORUMS."
									LEFT JOIN ".DB_FORUMS_THREADS." ON ".DB_FORUMS_THREADS.".`thread_lastpostid`=".DB_FORUMS.".`forum_lastpostid`
									LEFT JOIN ".DB_USERS." ON ".DB_USERS.".`user_id`=".DB_FORUMS_THREADS.".`thread_lastuser`
									LEFT JOIN ".DB_FORUMS_POSTS." ON ".DB_FORUMS_POSTS.".`post_id`=".DB_FORUMS_THREADS.".`thread_lastpostid`
									WHERE `forum_sections`='".$section['forum_id']."'");

					while ($tm_section = mysql_fetch_array($tm_result))
						{
							echo"<tr><td width='4%' align='left' class='tbl1'></td>";
							echo"<td width='59%' align='left' class='tbl1'>&nbsp;&nbsp;<a href='index.php?modul=thread&id=$tm_section[forum_id]'><b>".$tm_section['forum_name']."</b></a><br>&nbsp;&nbsp;<span class='small'>".$tm_section['forum_description']."</span></td>";
							echo"<td width='21%' align='left' class='tbl1'>&nbsp;&nbsp;<a href='index.php?modul=post&id=$tm_section[thread_id]&forum_id=$tm_section[forum_id]'><b>".substr($tm_section['thread_subject'],0,30)."...</b></a><br>&nbsp;&nbsp;".$txt['forum_from']."&nbsp;".ucfirst(strtolower($tm_section['user_name']))."<br>&nbsp;&nbsp;".$tm_section['post_date']."</td>";
							echo"<td width='5%' align='center'class='tbl2'>".$tm_section['forum_threadcount']."</td>";
							echo"<td width='11%' align='center' class='tbl2'>".$tm_section['forum_postcount']."</td></tr>";	
						}	
				}	
		}
	closetable();
?>