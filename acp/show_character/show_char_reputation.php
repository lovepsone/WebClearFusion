<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_char_reputation.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

//==============================================================================
// Скрипт предназначен для вывода репутации игрока
//==============================================================================

	// Сортируем по возрастанию
	function rcmp($a, $b)
		{
			if (isset($a['childs']))
				{
					return isset($b['childs']) ? strcmp($a['name'], $b['name']) : 1;
				}
			else
				{
					return !isset($b['childs']) ? strcmp($a['name'], $b['name']) : -1;
				}
		}

	define('FACTION_FLAG_VISIBLE', 0x01);         // makes visible in client (set or can be set at interaction with target of this faction)
	define('FACTION_FLAG_AT_WAR', 0x02);          // enable AtWar-button in client. player controlled (except opposition team always war state), Flag only set on initial creation
	define('FACTION_FLAG_HIDDEN', 0x04);          // hidden faction from reputation pane in client (player can gain reputation, but this update not sent to client)
	define('FACTION_FLAG_INVISIBLE_FORCED', 0x08);// always overwrite FACTION_FLAG_VISIBLE and hide faction in rep.list, used for hide opposite team factions
	define('FACTION_FLAG_PEACE_FORCED', 0x10);    // always overwrite FACTION_FLAG_AT_WAR, used for prevent war with own team factions
	define('FACTION_FLAG_INACTIVE', 0x20);        // player controlled, state
	define('FACTION_FLAG_RIVAL', 0x40);           // flag for the two competing outland factions

	function dump_rep($depth, $tree, &$rep)
		{
			$pre='';
			if ($depth != 0)
    				{
					for ($i=0;$i<$depth;$i++)
						{
							$pre .= '&nbsp;&nbsp;&nbsp;';
						}
				}
			uasort($tree, 'rcmp');
			foreach($tree as $id=>$t)
				{
					if ($t['details'])
						{
							$tip = "<table class=skilltip><tr class=top><td>".$t['name']."</td></tr><tr><td>".$t['details']."</td></tr></table>";
							echo"<tr ".add_tooltip($tip, 'STICKY, false, BORDER, false').">";
						}
					else echo"<tr>";

					if (isset($t['childs']))
      						{
							echo"<td class='teamreputation' colspan='3'><a id='no_tip' href='?faction=".$t['id']."'>".$pre.$t['name']."</a></td></tr>";
							dump_rep($depth+1, $t['childs'], $rep);
      						}
					else
						{
							$rep_data = get_reputation_data_from_reputation($rep[$id]['standing']);
							echo"<td class='reputation'><a id='no_tip' href='?faction=".$id."'>".$pre.$t['name']."</a></td>";
							echo"<td class='rep_value'>".$rep_data['rank_name']."</td>";
							echo'<td class=rep_bar><div class=rep_bar><b class=rep'.$rep_data['rank'].' style="width: '.intval($rep_data['rep']/$rep_data['max']*100).'%;"></b><span>'.$rep_data['rep'].'/'.$rep_data['max'].'</span></div></td>';
							echo"</tr>";
						}
    				}
		}

	function show_player_reputation($guid, $class, $race)
		{
			global $txt, $game_text, $_SESSION;

			// Load player reputation
			$repdata = array();
			$rep_tree = array();
			selectdb("characters_r".$_SESSION['realmd_id']);
			$result = db_query("SELECT `faction` AS ARRAY_KEY, `standing`, `flags` FROM `character_reputation` WHERE `guid`='".$guid."'");

			if(!$result)
				{
					echo "Error select";
					return;
				}
			else
				{
					$reputation = array();
					while ($data = db_array($result))
						{
							$reputation[$data['ARRAY_KEY']] = array("standing" => $data['standing'], "flags" => $data['flags']);
						}
				}

			// Load reputation tree
			foreach($reputation as $id=>$r)
				{
					$rep=&$reputation[$id];

					// Skip hidden
					if (!($rep['flags']&FACTION_FLAG_VISIBLE) OR $rep['flags']&(FACTION_FLAG_HIDDEN|FACTION_FLAG_INVISIBLE_FORCED)) { continue; }

					// Upload faction if not set
					if (!isset($rep_tree[$id])) { $rep_tree[$id] = get_faction($id); }

					// Correct reputation amount
					$rep['standing']+= get_base_reputation_for_faction($rep_tree[$id], $race, $class);

					// Insert faction in tree if exist parent
					while($tid = $rep_tree[$id]['team'])
						{
							// Load parent faction data if not loaded
							if (!isset($rep_tree[$tid])) { $rep_tree[$tid] = get_faction($tid); }

							// Insert child if not inserted
							if (!isset($rep_tree[$tid]['childs'][$id])) { $rep_tree[$tid]['childs'][$id] =& $rep_tree[$id]; }
							$id = $tid;
						}
				}

			// Remove inserted as childs nodes
			foreach($rep_tree as $id=>$r)
				{
					if ($r['team']) { unset($rep_tree[$id]); }
				}

			if (empty($rep_tree))
				{
					echo "Error";
					return;
				}

			echo"<tr><td><table class='report' cellSpacing='0' cellPadding='0'>";
			echo"<tr><TD class='head' colspan='3'>".$txt['modul_acp_show_reputation']."</td></tr>";
			dump_rep(0, $rep_tree, $reputation);
			echo"</table></td></tr>";
		}
?>