<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_spell_table.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function no_border_spell_table($spell)
		{
			echo"<table class=spell><tbody>";
			$name = $spell['SpellName'];
			if ($spell['Rank'])
				{
					echo"<tr><td class=Name>".$name."</td><td class=Rank align=right>".$spell['Rank']."</td></tr>";
				}
			else
				{
					echo"<tr><td class=Name colspan=2>".$name."</td></tr>";
				}
			$cost = get_spell_cost_text($spell);

			if ($cost or $spell['rangeIndex']>1)
				{
					echo"<tr><td>";
					if ($cost) { echo $cost."</td><td align=right>"; }
					if ($spell['rangeIndex'] > 0 AND $range = get_range($spell['rangeIndex']) AND $range!=0) { echo $range." yds range"; }
					echo"</td></tr>";
				}

			// Заполняем поле времени каста
			$cast_time = "";
			if (($spell['Attributes'  ] & 0x404) == 0x404)
				{
					$cast_time = "Next melee";
				}
			elseif ($spell['AttributesEx'] & 0x044)
				{
					$cast_time = "Chanelled";
				}
			else
				{
					$cast_time = get_cast_time_text($spell);
				}

			// Заполняем поле кулдауна
			$cooldown = get_spell_cooldown($spell);
			if ($cooldown)
				{
					$cooldown = get_time_text($cooldown/1000)." cooldown";
				}
			else
				{
					$cooldown = "";
				}

			if ($cast_time OR $cooldown) { echo"<tr><td>".$cast_time."</td><td align=right>".$cooldown."</td></tr>"; }

			// Тотем категория
			if ($spell['TotemCategory_1'] OR $spell['TotemCategory_2'])
				{
					echo"<tr><td colspan=2 class=tool> Tools: ";
					if ($spell['TotemCategory_1']) { echo get_totem_category($spell['TotemCategory_1']); }
					if ($spell['TotemCategory_2']) { echo", ".get_totem_category($spell['TotemCategory_2']); }
					echo"</td></tr>";
				}

			$itemClass = $spell['EquippedItemClass'];
			// Требования мили или рангед оружия
			if ($spell['Attributes'] & 0x2)
				{
					echo"<tr><td colspan=2>Requires Ranged Weapon</td></tr>";
				}
			elseif ($spell['Attributes'] & 0x4)
				{
					echo"<tr><td colspan=2>Requires Melee Weapon</td></tr>";
				}
			elseif ($itemClass == 2)  // Требует оружия
				{
					echo"<tr><td colSpan=2 class=req>";
					if ($itemSubClass = $spell['EquippedItemSubClassMask'])
						{
							echo get_subclass_list($itemClass, $itemSubClass);
						}
					else
						{
							echo get_class_name($itemClass);
						}
					echo"</td></tr>";
				}
			$reqForm = get_allowable_form($spell['Stances'], 0);
			if ($reqForm) { echo"<tr><td colspan=2>Requires: ".$reqForm."</td></tr>"; }

			$notreqForm = get_allowable_form($spell['StancesNot'], 0);
			if ($notreqForm) { echo"<tr><td class=SpellErr colspan=2>Not cast in: ".$notreqForm."</td></tr>"; }

			echo"<tr><td colspan=2 class=SpellDesc><a href=\"?spell=$spell[id]\">".get_spell_desc($spell)."</a></td></tr>";
			echo"</tbody></table>";
		}

	function generate_spell_table($spell)
		{
			echo"<table class='border' cellspacing='0' cellpadding='0'><tbody>";
			echo"<tr><td class='btopl'></td><td class='btop'></td><td class='btopr'></td></tr>";
			echo"<tr><td class='bl'></td><td class='bbody'>";
			no_border_spell_table($spell);
			echo"</td><td class='br'></td></tr>";
			echo"<tr><td class='bbottoml'></td><td class='bbottom'></td><td class='bbottomr'></td></tr>";
			echo"</tbody></table>";
		}

	// Вывод tooltip спелла (то что выводится в подсказке ауры на игроке)
	function generate_spell_buff_table($spell)
		{
			echo"<table class=border cellspacing=0 cellpadding=0><tbody>";
			echo"<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
			echo"<tr><td class=bl></td><td class=bbody>";

			echo"<table class=spell><tbody>";
			$name = $spell['SpellName'];
			echo"<tr><td class=Name>".$name."</td></tr>";
			echo"<tr><td colSpan=2 class=SpellDesc><a href=\"?spell=$spell[id]\">".get_spell_buff($spell)."</a></td></tr>";
			echo"</tbody></table>";

			echo"</td><td class=br></td></tr>";
			echo"<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
			echo"</tbody></table>";
		}
?>