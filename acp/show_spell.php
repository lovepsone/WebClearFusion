<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_spell.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/acp_header.php";

	$entry = isset($_REQUEST['spell']) ? intval(@$_REQUEST['spell']) : "";
	$page  = isset($_REQUEST['page']) ? intval(@$_REQUEST['page']) : "";
	$mark  = isset($_REQUEST['mark']) ? @$_REQUEST['mark'] : "";

	$spell = get_spell($entry);
	$ajaxmode = 0;
	opentable();

	if (!$spell)
		{
			//RenderError($lang['spell_not_found']);
		}
	else
		{
			$baseLink = '?spell='.$entry;
			if ($ajaxmode == 0)
				{
					$icon = get_spell_icon($spell['SpellIconID']);
					echo"<tr><td valign='top' align='right' width=35%>";
					echo"<br><a href=\"#\"><img border=0 src='$icon' width=64></a></td>";
					echo"<td>";generate_spell_table($spell);echo"</td></tr>";

					if ($spell['ToolTip'] && $spell['ToolTip']!=$spell['Description'])
						{
							echo"<tr>";
							echo"<td valign=top align=right>";
							if ($spell['activeIconID'] && $spell['SpellIconID']!=$spell['activeIconID'])
								{
									$buff_icon = get_spell_icon($spell['activeIconID']);
									echo"<br><a href=\"#\"><img border=0 src='$buff_icon' width=64></a>";
								}
							echo"</td>";
							echo"<td>";generate_spell_buff_table($spell);echo"</td>";
							echo"</tr>";
						}

					//********************************************************************************
					// Вывод данных по спеллу
					//********************************************************************************
					create_spell_details($spell);
				}
		}
	closetable();

	require_once THEMES."templates/footer.php";
?>


