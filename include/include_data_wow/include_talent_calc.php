<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_talent_calc.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function generate_character_bild($guid, $class, $spec)
		{
			global $_SESSION, $talentTabId;

			selectdb("wcf");
			$tab_set = db_assoc(db_query("SELECT `id` FROM ".DB_TALENT_TAB." WHERE `class_mask` & 1<<($class-1) ORDER BY `tab`"));
			reset($tab_set);
			$tab_set = current($tab_set);
			if (!$tab_set) { return; }

			$bild = "";
			$result = db_query("SELECT `TalentID`, `TalentTab` AS ARRAY_KEY_1, `Row` AS ARRAY_KEY_2, `Col` AS ARRAY_KEY_3, `Rank_1`, `Rank_2`, `Rank_3`, `Rank_4`, `Rank_5` FROM ".DB_TALENTS." WHERE `TalentTab` IN ($tab_set) ORDER BY `TalentTab`, `Row`, `Col`");
			while ($data = db_array($result))
				{
					$tinfo['ARRAY_KEY_1']['ARRAY_KEY_2']['ARRAY_KEY_2'] = array(
									"TalentID" => $data['TalentID'],
									"Rank_1" => $data['Rank_1'],
									"Rank_2" => $data['Rank_2'],
									"Rank_3" => $data['Rank_3'],
									"Rank_4" => $data['Rank_4'],
									"Rank_5" => $data['Rank_5'],
					);
				}
			$points = array(0, 0, 0);
			$total  = 0;
			$max = 0;
			$name = "Undefined";

			selectdb("characters_r".$_SESSION['realmd_id']);
			//$tab = $tab_set;
			foreach($tab_set as $i=>$tab)
			//for ($i=0; $i<=2; $i++)
				{
					foreach($tinfo[$tab] as $row=>$rows)
						{
							foreach($rows as $col=>$data)
								{
									$rank = db_assoc(db_query("SELECT `current_rank`  FROM `character_talent` WHERE `guid`='$guid' and `spec`='$spec' AND `talent_id`='".$data['TalentID']."'"));
							if ($rank) echo"1"; else echo"2";
									if (isset($rank)) { ++$rank; } else { $rank = 0; }
									$bild .= $rank;
									$points[$i]+=$rank;
									$total+=$rank;
								}
						}
					if ($points[$i] > $max) { $max = $points[$i]; $name = get_talent_name($tab); }
				}
			return array('calc_bild'=>$bild, 'points'=>$points, 'total'=>$total, 'name'=>$name);
		}

	function include_talent_script($class, $petId, $maxLevel, $header, $ver = "335")
		{
			global $game_text, $config;
			//$tab_set = 0;
  			$class_mask = array(1 => 1, 2 => 2, 3 => 4, 4 => 8, 5 => 16, 6 => 32, 7 => 64, 8 => 128, 9 => 256, 11 => 1024);
			// Create tabs list
			if ($class)
				{
					// For players
					selectdb("wcf");
					$result = db_query("SELECT `id` FROM ".DB_TALENT_TAB." WHERE `class_mask`='".$class_mask[$class]."' ORDER BY `tab`");
					$tab_set_count = 3; $i=0;

					while ($data = db_assoc($result))
						{
							$tab_set[$i] = $data['id'];
							$i++;
						}

				}
			elseif ($petId >= 0)
				{
					// For pets (need get pet_talent_type from creature_family)
					selectdb("wcf");
					$talent_type = db_assoc(db_query("SELECT `pet_talent_type` FROM ".DB_CREATURE_FAMILY." WHERE `category`='$petId'"));
					reset($talent_type);
					$talent_type = current($talent_type);

					if (isset($talent_type) && $talent_type >= 0)
						{
							selectdb("wcf");				
							$result = db_query("SELECT `id` FROM ".DB_TALENT_TAB." WHERE `pet_mask` & 1<<$talent_type ORDER BY `tab`");
							$tab_set_count = 1; $i=0;

							while ($data = db_assoc($result))
								{
									$tab_set[$i] = $data['id'];
									$i++;
								}
						}
				}
			if (!$tab_set) { return; }

			// Создаём кэш для калькулятора (если его нет или устарел)
			$data_file = "tc_".$class.$petId."_".$config['lang']."_".$ver.".js";

			if (checkUseCacheJs($data_file, 60*60*24))
				{
					// Подготаливаем данные для скрипта
					$tab_name = array();                  // Имена веток талантов
					$tid_to_tab = array();                // Преборазователь TalentId => TabId
					$tabs = array();                      // Тут уже будут данные для JS скрипта
					$spell_desc = array();                // Тут хранятся описания спеллов
					$t_row  = 0;                          // Максимум строк
					$t_col  = 0;                          // Максимум колонок

					  // Стрелки зависимосей описаны тут
					$arrows = array(
					   '0_1' =>array('img'=>'right',     'x'=>-14,'y'=>12),
					   '0_-1'=>array('img'=>'left',      'x'=> 40,'y'=>12),
					   '1_-1'=>array('img'=>'down-left', 'x'=> 14,'y'=>-40),
					   '1_0' =>array('img'=>'down-1',    'x'=> 13,'y'=>-12),
					   '2_0' =>array('img'=>'down-2',    'x'=> 13,'y'=>-70),
					   '2_1' =>array('img'=>'down2-right','x'=>-13,'y'=>-94),
					   '2_-1'=>array('img'=>'down2-left','x'=>14,'y'=>-94),
					   '3_0' =>array('img'=>'down-3',    'x'=> 13,'y'=>-128),
					   '4_0' =>array('img'=>'down-4',    'x'=> 13,'y'=>-188),
					   '1_1' =>array('img'=>'down-right','x'=>-13,'y'=>-40)
					  );

					// Получаем данные о ветках из базы и переводим их в нужный формат
					if ($class)
						{
							$ppr = 5;
							$talents = array();
							selectdb("wcf");
							for ($i=0; $i<$tab_set_count; $i++)
								{
									$result = db_query("SELECT `TalentID` AS ARRAY_KEY, `TalentTab`, `Row`, `Col`, `Rank_1`, `Rank_2`, `Rank_3`, `Rank_4`, `Rank_5`, `DependsOn`, `DependsOnRank` FROM ".DB_TALENTS." WHERE `TalentTab`='".$tab_set[$i]."'");

									while ($data = db_array($result))
										{
											$talents[$data['ARRAY_KEY']] = array(
												"TalentTab" => $data['TalentTab'],
												"Row" => $data['Row'],
												"Col" => $data['Col'],
												"Rank_1" => $data['Rank_1'],
												"Rank_2" => $data['Rank_2'],
												"Rank_3" => $data['Rank_3'],
												"Rank_4" => $data['Rank_4'],
												"Rank_5" => $data['Rank_5'],
												"DependsOn" => $data['DependsOn'],
												"DependsOnRank" => $data['DependsOnRank']
											);
										}
								}
  						}
					elseif ($petId >= 0)
						{
							$ppr = 3;
							$petMask1 = 0;
							$petMask2 = 0;
							if ($petId < 32) { $petMask1=1<<($petId   ); } else { $petMask2=1<<($petId-32); }
							selectdb("wcf");
							for ($i=0; $i<$tab_set_count; $i++)
								{
									$result = db_query("SELECT `TalentID` AS ARRAY_KEY, `TalentTab`, `Row`, `Col`, `Rank_1`, `Rank_2`, `Rank_3`, `Rank_4`, `Rank_5`, `DependsOn`, `DependsOnRank`
												FROM ".DB_TALENTS." WHERE `TalentTab`='".$tab_set[$i]."'");

									while ($data = db_array($result))
										{
											$talents[$data['ARRAY_KEY']] = array(
												"TalentTab" => $data['TalentTab'],
												"Row" => $data['Row'],
												"Col" => $data['Col'],
												"Rank_1" => $data['Rank_1'],
												"Rank_2" => $data['Rank_2'],
												"Rank_3" => $data['Rank_3'],
												"Rank_4" => $data['Rank_4'],
												"Rank_5" => $data['Rank_5'],
												"DependsOn" => $data['DependsOn'],
												"DependsOnRank" => $data['DependsOnRank']
												);
										}
								}
						}

					// Заполняем преборазователь TalentId => TabId и Имена веток талантов
					for ($i=0; $i<$tab_set_count; $i++)
						{
							$tid_to_tab[$tab_set[$i]] = $i;
							$tab_name[$i] = get_talent_name($tab_set[$i]);
						}

					foreach($talents as $id=>$t)
						{
							$tabId  = $tid_to_tab[$t['TalentTab']];
							$row    = $t['Row'];
							$col    = $t['Col'];
							$spells = array();
							$icon   = 0;
							$max    = 0;
							
							if ($t_row <= $row) { $t_row = $row+1; }
							if ($t_col <= $col) { $t_col = $col+1; }

							for ($i=1;$i<6;$i++)
								{
									$spellid = $t['Rank_'.$i];
									if ($spellid == 0) { continue; }
									$max = $i;
									$spells[$i-1] = $spellid;
									$spell  = get_spell($spellid);
									if ($icon == 0) $icon = get_spell_icon_name($spell['SpellIconID']);
									$name = $spell['SpellName'];
									$spell_desc[$spellid] = array('name'=>$name, 'desc'=>get_spell_desc($spell));
								}
							$tabs[$tabId.'_'.$row.'_'.$col] = array('id'=>$id, 'spells'=>$spells, 'icon'=>$icon, 'max'=>$max);

							if ($t['DependsOn'] && isset($talents[$t['DependsOn']]))
								{
									$d = $talents[$t['DependsOn']];
									$dx = $t['Row']-$d['Row'];
									$dy = $t['Col']-$d['Col'];
									$a = $arrows[$dx."_".$dy];

									$tabs[$tabId.'_'.$row.'_'.$col]['depend'] = array(
									   'id'=>$tid_to_tab[$d['TalentTab']]."_".$d['Row']."_".$d['Col'],
									   'rank'=>$t['DependsOnRank'],
									   'img'=>$a['img'],
									   'x'=>intval($a['x']),
									   'y'=>intval($a['y']));
								}
							else { $depend = 0; }
  						}
				  	echo'
					  var tc_showclass ="'.($class?$class:$tab_set[0]).'";
					  var tc_name = '.php2js($tab_name).';
					  var tc_tabs = '.$tab_set_count.';
					  var tc_row = '.$t_row.';
					  var tc_col = '.$t_col.';
					  var tc_tab = '.php2js($tabs).';
					  var tc_point_per_row = '.$ppr.';
					  var tc_spell_desc = '.php2js($spell_desc).';
					  var lang_rank = "'.$game_text['talent_rank'].'";
					  var lang_next_rank = "'.$game_text['talent_next_rank'].'";
					  var lang_req_points = "'.$game_text['talent_req_points'].'";';
					flushJsCache($data_file);
				}
			echo'
			 <script type="text/javascript" id = "talent_calc">
			 var tc_maxlevel = '.$maxLevel.';
			 var lang_header = \''.$header.'\';
			 </script>
			 <script type="text/javascript" src="'.INCLUDES.'js/talent_calc_base.js"></script>';
		}
?>
