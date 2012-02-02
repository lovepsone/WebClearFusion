<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: player_info_generator.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//===========================================================================
	// Вспомогательные функции
	//===========================================================================

	// Данная функция показывает ауры из базы
	function show_player_auras_from_db($guid)
		{
			global $_SESSION;
			selectdb(characters_r.$_SESSION['realmd_id']);

 			$buffs  = db_query("SELECT `spell` FROM `character_aura` WHERE `guid`='".$guid."' GROUP BY `spell`");

			while ($aura = db_array($buffs))
				{
					echo"<br>";
     					show_spell($aura['spell'], 0, 'aura');
				}
		}
?>
