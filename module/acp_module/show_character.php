<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_character.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "include/show_maincore.php";
	require_once $modules['acp_module']."templates/acp_header.php";

	if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) || !isset($_SESSION['realmd_id'])) { redirect(BASEDIR); }

	$config['show_player_3d'] = 1;
	$guid = intval(@$_REQUEST['player']);
	$tab  = (isset($_REQUEST['tab']) ? @$_REQUEST['tab'] : "");
	$char = get_character($guid);
	$char_stats = get_character_stats($guid);
	opentable();

	if ($char)
		{
 			$char_data = explode(' ',$char['equipmentCache']);
 			//$powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
	 		$genderId =$char['gender'];
	 		$class =$char['class'];
	 		$race =$char['race'];

 			echo"<ul class='my_tabs'><center>";
 			echo"<li><a onclick='return uploadFromHref(this, \"reportContainer\");' href='".WCF_SELF."?player=".$guid."'>".$txt['modul_acp_char']."</a></li>";
 			echo"<li><a onclick='return uploadFromHref(this, \"reportContainer\");' href='".WCF_SELF."?player=".$guid."&tab=talents'>".$txt['modul_acp_char_talents']."</a></li>";
 			echo"<li><a onclick='return uploadFromHref(this, \"reportContainer\");' href='".WCF_SELF."?player=".$guid."&tab=skill'>".$txt['modul_acp_char_skill']."</a></li>";
 			echo"<li><a onclick='return uploadFromHref(this, \"reportContainer\");' href='".WCF_SELF."?player=".$guid."&tab=achievements'>".$txt['modul_acp_char_achievements']."</a></li>";
 			echo"<li><a onclick='return uploadFromHref(this, \"reportContainer\");' href='".WCF_SELF."?player=".$guid."&tab=reputation'>".$txt['modul_acp_char_reputation']."</a></li>";
 			echo"<li><a onclick='return uploadFromHref(this, \"reportContainer\");' href='".WCF_SELF."?player=".$guid."&tab=quests'>".$txt['modul_acp_char_quests']."</a></li>";
 			echo"</center></ul>";
		}

 	if ($tab == "")
 		{
  			require_once $modules['acp_module']."show_character/show_char_equip.php";
  			show_player_equip($guid, $char, $char_data, $char_stats);
 		}
	if ($tab == "talents")
		{
  			require_once $modules['acp_module']."show_character/show_char_talents.php";
			show_player_talents($guid, $class, $char['level'], $char['activeSpec']);
		}

 	if ($tab == "skill")
 		{
  			require_once $modules['acp_module']."show_character/show_char_skill.php";
  			show_player_skills($guid);
 		}
	if ($tab == "reputation")
		{
			require_once $modules['acp_module']."show_character/show_char_reputation.php";
			show_player_reputation($guid, $class, $race);
		}

	closetable();

	require_once THEMES."templates/footer.php";
?>
