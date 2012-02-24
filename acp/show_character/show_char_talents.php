<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_char_talents.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function show_player_talents($guid, $class, $level, $spec)
		{
			global $lang;
			$bild = generate_character_bild($guid, $class, $spec);
			$calc = array('none', 'warrior', 'paladin', 'hunter', 'rogue', 'priest', 'FUTURE_1', 'shaman', 'mage', 'warlock', 'FUTURE_2', 'druid');
			echo"<div id='talent' align='center'>";
			echo"<a href='?talent=".$calc[$class]."' id='talent_bild_link'>".$lang['player_talent_calc']."</a><br>";
			include_talent_script($class, -1, $level, get_classes($class));
			echo'<script type="text/javascript">tc_bildFromStr("'.$bild['calc_bild'].'");</script>';
			echo'<script type="text/javascript">tc_renderTree("talent");</script></div>';
		}
?>