<?php

// Report generator class (класс генератора отчётов)
class ReportGenerator{
    var $mark  = '';          // Report uniquie id
    var $disable_mark = false;// Disable mark check/add (single report on page)
    var $ajax_mode = 0;       // Report mode direct render / ajax load
    var $fields = 0;          // Columns array
    var $page  = 1;           // Report page
    var $size_limit = 0;      // Report row limit
    var $total_data = 0;      // Total rows
    var $sort_method= 0;      // Sort
    var $sort_default = '';   // Default sort
    var $r_link  = '';        // Base page link
    var $rowCallback = '';    // Callback function for row render

    var $column_conf=0;       // Report config array
    // NPC report generator config array, contain elements:
    // 'field_name'  =>array(
    // 'class'=>'',            - cell class (width, align)
    // 'sort'=>'sort',         - column sort type
    // 'text'=>'text',         - column header text
    // 'draw'=>'r_drawFunc',   - cell draw function name
    // 'sort_str'=>'`name`',   - sort require string
    // 'fields'=>'`name`');    - fields require for draw cell
    var $db=0;                // DB class for get data (filled in
    var $table = '';          // DB tables
    var $db_fields = '*';     // DB fields
    var $query_args = 0;      // Helper for expand query placeholders
    var $data_array = 0;      // Report data stored here
    // Init data for report (return false if no need create it)
    function Init(&$fields, $link, $report_mark, $limit, $def_sort)
    {
        global $ajaxmode;
        // Init data if need directly create report or upload in ajax mode
        if ($ajaxmode == 0 || $this->disable_mark || $report_mark==@$_REQUEST['mark'])
        {
//            echo $report_mark."<br />";
            $this->ajax_mode  = $ajaxmode;
            $this->mark       = $report_mark;  // This report mark
            $this->fields     =& $fields;      // Columns array
            $this->sort_default = $def_sort;   // Default sort
            $this->size_limit = $limit;        // Size limit (max row count)
            $this->total_data = -1;            // Total exist data
            $this->r_link     = $link;         // Base page link
            $this->data_array = 0;
            // In url exist page, sort for this report store it
            if ($this->disable_mark || $report_mark==@$_REQUEST['mark'])
            {
                $this->page        = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1; // Store page
                $this->sort_method = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : $def_sort; // Store sort method
                if ($this->page < 1) $this->page = 1;
                return true;
            }
            // No data for this report - set default
            $this->page   = 1;
            $this->offset = 0;
            $this->sort_method = $def_sort;
            return true;
        }
        return false;
    }
    // Add custom column config
    function addColumnConfig($name, $conf) {$this->column_conf[$name]=$conf;}
    // Get total data count in result
    function getTotalDataCount() {return $this->total_data;}
    // Disable report mark in link (single report on page)
    function disableMark() {$this->disable_mark = true;}
    // Report link generator (for pages, headers)
    function createLink($page, $sort)
    {
        $link = $this->r_link;
        if ($page > 1) $link.='&page='.$page;
        if ($sort!=$this->sort_default)
            $link.='&sort='.$sort;

        if (!$this->disable_mark) $link.='&mark='.$this->mark;
        return $link;
    }
    // Create reference to report
    function createHref($page, $sort, $text)
    {
        return '<a href="'.$this->createLink($page, $sort).'" onClick="return uploadFromHref(this, \''.$this->mark.'\');">'.$text.'</a>';
    }
    // Generate report
    function createReport($header)
    {
        global $bw_icon_mode;
        if (!$this->data_array || !$this->total_data || !$this->column_conf) return;
        $this->slicePage();
        $columns = count($this->fields);
        if ($this->ajax_mode==0)
            echo '<div class=reportContainer id="'.$this->mark.'">';

        echo '<table class=report width=500>';
        echo '<thead>';
        echo '<tr class=head><td colspan='.$columns.'>'.$header.'</td></tr>';
        echo '<tr>';
        foreach ($this->fields as $field)
        {
            $f =& $this->column_conf[$field];
            echo '<th>';
            if ($f['sort'] && $this->total_data > 1)
                echo $this->createHref($this->page, $f['sort'], $f['text']);
            else
                echo $f['text'];
            echo '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($this->data_array as &$data)
        {
            $cb = $this->rowCallback;
            $class = $cb ? $cb($data) : 0;
            $row_class = $class ? ' class='.$class : '';
            echo '<tr'.$row_class.'>';
            foreach ($this->fields as $field)
            {
                $f =& $this->column_conf[$field];
                echo $f['class']?'<td class='.$f['class'].'>' : '<td>';
                $f['draw']($data);
                echo '</td>';
            }
            echo '</tr>';
            unsetBwIconMode();
        }
        if ($this->size_limit && $this->total_data > $this->size_limit)
        {
            $totalPage = floor($this->total_data/$this->size_limit+0.9999);
            $page = $this->page;
            echo '<tr><td colspan='.$columns.' class=page>';
            for ($i=1;$i<=$totalPage;$i++)
            {
                if ($i!=$page) echo $this->createHref($i, $this->sort_method, $i).' ';
                else           echo '<b><i>'.$i.' </i></b>';
            }
            echo "</td></tr>";
        }
        echo '</tbody></table>';
        if ($this->ajax_mode==0)
        {
            echo '</div>';
            // Cache data
            $link = $this->createLink($this->page, $this->sort_method);
            echo "<script type=\"text/javascript\">ajaxCacheHtmlId('$this->mark','$link');</script>";
            $tabName = $this->total_data > 1 ? $header.' ('.$this->total_data.')' : $header;
            if (!$this->disable_mark) addTab($tabName, $this->mark);
        }
    }
	// Remove column if all data zero
	function remove_if_all_zero($fname, $field)
		{
			$set = 0;
			foreach($this->data_array as &$v) { if (!isset($v[$fname]) OR $v[$fname]) { $set = 1;break; } }
			if (!$set) { $this->remove_field($field); }
		}

	// Remove field
	function remove_field($name)
		{
			if ($id = array_search($name, $this->fields)) { unset($this->fields[$id]); }
		}

	// Expand placeholders func
	function expand_placeholders_callback($m)
		{
			if (!empty($m[2]))
				{
					$value = array_pop($this->query_args);
					switch ($m[3])
						{
             						case 'a':  return join(', ', $value);
             						case 'd':  return intval($value);
             						case 'u':  return sprintf('%u',$value);
             						case 'f':  return str_replace(',', '.', floatval($value));
            					}
            				return $value;
        			}
       			if (isset($m[1]) && strlen($block=$m[1]))
        			{
            				if (current($this->query_args) === DBSIMPLE_SKIP)
            					{
                					array_pop($this->query_args);
               	 					return '';
            					}
            				return $this->_do_placeholders($block);
        			}
        		return $m[0];
   		}

	function _do_placeholders($query)
		{
			$re = '{(?>\{( (?> (?>[^{}]+)  |  (?R) )* )\}) | (?>(\?) ( [duaf]? ))}sx';
        		return preg_replace_callback($re, array(&$this,'expand_placeholders_callback'), $query);
   		}

	function expand_placeholders($data)
		{
			$this->query_args = array_reverse($data);
			return $this->_do_placeholders(array_pop($this->query_args));
		}

	// Database depend requirest generator
	function do_requirest($where)
		{
			global $config;
			// нужно написать доп. функцию для определения языка, пока что будет русский
			// $locale = $config['locales_lang'];
			$locale = 8;
			$where_filter = $this->expand_placeholders(func_get_args());
			$tables  = $this->table;
			$fields  = $this->get_fields_requirest();
			$sort_str= $this->get_sort_requirest();
			if ($locale)
				{
            				$this->localise_requirest($locale, $tables, $fields, $sort_str);
				}
			$reqString = 'SELECT '.$fields.' FROM '.$tables.' WHERE '.$where_filter.$sort_str.$this->get_limit_requirest();
			echo "<br />".$reqString."<br />";
			if ($this->size_limit > 0)
				{
            				$this->data_array = $this->db->selectPage($this->total_data, $reqString);
					//$this->data_array = $this->db->select_page($reqString);
				}
        		else
        			{
            				$this->data_array = $this->db->select($reqString);
            				$this->total_data = count($this->data_array);
        			}
    		}

    // Manually slice on page
    function setManualPagenateMode() {if ($this->size_limit >=0) $this->size_limit =-$this->size_limit;}
    function slicePage()
    {
        if ($this->size_limit >=0) return;
        $this->total_data = count($this->data_array);
        $this->size_limit = -$this->size_limit;
        $this->data_array = array_slice($this->data_array,($this->page-1)*$this->size_limit, $this->size_limit);
    }

	// Localise fields requirement and sort
	function localise_requirest($locale, &$fields, &$sort) { return; }

	// Build fields list depend from config
	function get_fields_requirest()
		{
			if ($this->db_fields=='*') { return '*'; }
			$r = $this->db_fields;
			foreach($this->fields as $f)
				{
					if ($data = $this->column_conf[$f]['fields']) { $r.=', '.$data; }
				}
        		return join(',', array_unique(explode(',', $r)));
    		}

    function addFieldsRequirest($f)
    {
        if ($this->db_fields=='*')
            return;
        $this->db_fields.=', '.$f;
    }

	// Get sort requirest depend from config
	function get_sort_requirest()
		{
			if ($this->sort_method)
				{
					foreach($this->column_conf as $c)
						{
                					if ($this->sort_method==$c['sort']) { return ' ORDER BY '.$c['sort_str']; }
						}
				}
			else
				{
        				return '';
    				}
		}

	// Get limit requirest depend from page and page size
	function get_limit_requirest()
		{
			if ($this->size_limit > 0)
				{
            				return ' LIMIT '.(($this->page-1)*$this->size_limit).', '.$this->size_limit;
				}
			else
				{
        				return '';
				}
    		}
};

	//==============================================================================
	// Tabbed report functions
	//==============================================================================
	$tab_mode = 2; // disabled
	function create_report_tab()
		{
			global $tab_mode, $config, $ajaxmode;
			if(!$config['use_tab_mode'] || $ajaxmode) { return; }
			echo'<script type="text/javascript">report_hideHeaders()</script>';
			echo'<br><ul class=my_tabs id="report_tabs"></ul>';
			$tab_mode = 1; // First page select
		}

	function add_tab($header, $mark)
		{
			global $tab_mode;
			if ($tab_mode > 1) { return; }
			if (isset($_REQUEST['mark']))
				{
					$selected = $mark==$_REQUEST['mark'] ? 1 : 0;
				}
			else
				{
					$selected = $tab_mode?1:0;
				}
			echo '<script type="text/javascript">report_addTab("'.$header.'", "'.$mark.'", '.$selected.');</script>';
			$tab_mode = 0; // disable select page
		}

// Get some data
function getRefrenceItemLoot($entry)
{
  global $dDB;
  // Получаем рефренс лут
  return $dDB->select('-- CACHE: 1h
  SELECT `entry` AS ARRAY_KEY, `ChanceOrQuestChance`, `groupid`, `mincountOrRef`, `maxcount`, `lootcondition`, `condition_value1`, `condition_value2` FROM `reference_loot_template` WHERE `item`=?d', $entry);
}
function getFactionTemplates($entry)
{
  global $wDB;
  return $wDB->selectCol('-- CACHE: 1h
  SELECT `id` FROM `wowd_faction_template` WHERE `faction` = ?d', $entry);
}
function getPlayerSpells($guid)
{
  global $cDB;
  return $cDB->select('-- CACHE: 1h
  SELECT `spell` AS ARRAY_KEY FROM `character_spell` WHERE `guid` = ?d AND `disabled` = 0', $guid);
}

$gheroic = 0;
function getHeroicList()
{
  global $dDB, $gheroic;
  if (!$gheroic)
    $gheroic = $dDB->selectCol('-- CACHE: 1h
	  SELECT `difficulty_entry_1` AS ARRAY_KEY, `entry` FROM `creature_template` WHERE `difficulty_entry_1` <>  0');
  return $gheroic;
}

$gheroic1 = 0;
function getHeroicList1()
{
  global $dDB, $gheroic1;
  if (!$gheroic1)
    $gheroic1 = $dDB->selectCol('-- CACHE: 1h
	  SELECT `difficulty_entry_2` AS ARRAY_KEY, `entry` FROM `creature_template` WHERE `difficulty_entry_2` <>  0');
  return $gheroic1;
}

$gheroic2 = 0;
function getHeroicList2()
{
  global $dDB, $gheroic2;
  if (!$gheroic2)
    $gheroic2 = $dDB->selectCol('-- CACHE: 1h
	  SELECT `difficulty_entry_3` AS ARRAY_KEY, `entry` FROM `creature_template` WHERE `difficulty_entry_3` <>  0');
  return $gheroic2;
}
//==============================================================================
// Callback functions
//==============================================================================
function playerSpellCallback($data)
{
  $spells = getPlayerSpells($_REQUEST['guid']);
  if (isset($spells[$data['id']]))
    return 0;
  setBwIconMode();
  return 'notknow';
}

//==============================================================================
// Loot
//==============================================================================
function r_lootChance($data)
{
  if ($data['mincountOrRef'] < 0)
  {
    echo 'R'.($data['ChanceOrQuestChance']).'%';
  }
  else if ($data['ChanceOrQuestChance'] < 0)
    echo 'Q'.(-$data['ChanceOrQuestChance']).'%';
  else
    echo $data['ChanceOrQuestChance'].'%';
}
function r_lootRequire($data)
{
  global $lang;
  switch ($data['lootcondition']){
   case  1: // CONDITION_AURA - spell_id, effindex
     $spell = getSpell($data['condition_value1'], '`id`, `SpellIconID`');
     echo $lang['condition1']; show_spell($spell['id'], $spell['SpellIconID'], 'quest');
     break;
   case  2: // CONDITION_ITEM - item_id, count
     $item = getItem($data['condition_value1'], '`entry`, `displayid`');
     echo $lang['condition2'].text_show_item($item['entry'], $item['displayid'], 'quest');
     if ($data['condition_value2'] > 1) echo 'x'.$data['condition_value2'];
     break;
   case  3: // CONDITION_ITEM_EQUIPPED -  item_id, 0
     $item = getItem($data['condition_value1'], '`entry`, `displayid`');
     echo $lang['condition3'].text_show_item($item['entry'], $item['displayid'], 'quest');
     break;
   case  4: // CONDITION_AREAID - area_id  0, 1 (0: in (sub)area, 1: not in (sub)area)
     if ($data['condition_value2'] > 0 ) echo $lang['condition4_1'].getAreaName($data['condition_value1']);
     if ($data['condition_value2'] == 0) echo getAreaName($data['condition_value1']);
     break;
   case  5: // CONDITION_REPUTATION_RANK - faction_id, min_rank
     echo getFactionName($data['condition_value1']).'('.getReputationRankName($data['condition_value2']).')';
     break;
   case  6: // CONDITION_TEAM  player_team, 0      (469 - Alliance 67 - Horde)
     echo getFactionName($data['condition_value1']);
     break;
   case  7: // CONDITION_SKILL skill_id, skill_value
     echo $lang['condition7'].getSkillName($data['condition_value1']);
     if ($data['condition_value2'] > 1) echo ' ('.$data['condition_value2'].')';
     break;
   case  8: // CONDITION_QUESTREWARDED quest_id, 0
     echo $lang['condition8'].getQuestName($data['condition_value1']);
     break;
   case  9: // CONDITION_QUESTTAKEN quest_id     0,   for condition true while quest active.
     echo $lang['condition9'].getQuestName($data['condition_value1']);
     break;
   case 10: // CONDITION_AD_COMMISSION_AURA   0, 0    for condition true while one from AD сommission aura active
     echo $lang['condition10'];
     break;
   case 11: // CONDITION_NO_AURA  spell_id, effindex
     $spell = getSpell($data['condition_value1'], '`id`, `SpellIconID`');
     echo $lang['condition11']; show_spell($spell['id'], $spell['SpellIconID'], 'quest');
     break;
   case 12: // CONDITION_ACTIVE_GAME_EVENT  event_id
     echo $lang['condition12'].getGameEventName($data['condition_value1']);
     break;
   case 13: // CONDITION_AREA_FLAG  area_flag    area_flag_not
     if ($data['condition_value1'] > 0) echo $lang['condition13_1'].$data['condition_value1'];
     if ($data['condition_value2'] > 0) echo $lang['condition13_2'].$data['condition_value2'];
     break;
   case 14: // CONDITION_RACE_CLASS  race_mask    class_mask
     if ($data['condition_value1'] > 0) echo getAllowableRace($data['condition_value1']).'<br>';
     if ($data['condition_value2'] > 0) echo getAllowableClass($data['condition_value2']);
     break;
   case 15: // CONDITION_LEVEL  player_level     0, 1 or 2
     if ($data['condition_value1'] > 0) echo $data['condition_value1'];        
     if (($data['condition_value1'] > 0) && ($data['condition_value2'] == 0)) echo $lang['condition15_1'];
     if (($data['condition_value1'] > 0) && ($data['condition_value2'] == 1)) echo $lang['condition15_2'];
     if (($data['condition_value1'] > 0) && ($data['condition_value2'] == 2)) echo $lang['condition15_3'];
     break;
   case 16: // CONDITION_NOITEM  item_id      count
     $item = getItem($data['condition_value1'], '`entry`, `displayid`');
     echo $lang['condition16'].text_show_item($item['entry'], $item['displayid'], 'quest');
     if ($data['condition_value1'] > 1) echo 'x'.$data['condition_value2'];
     break;
   case 17: // CONDITION_SPELL  spell_id     0, 1 (0: has spell, 1: hasn't spell)
     $spell = getSpell($data['condition_value1'], '`id`, `SpellIconID`');
     if ($data['condition_value2'] > 0) { echo $lang['condition17_1']; show_spell($spell['id'], $spell['SpellIconID'], 'quest');}
     else { echo $lang['condition17_2']; show_spell($spell['id'], $spell['SpellIconID'], 'quest');}
     break;
   case 20: // CONDITION_ACHIEVEMENT  ach_id       0, 1 (0: has achievement, 1: hasn't achievement) for player
     if ($data['condition_value2'] > 0) echo $lang['condition20_1'].$data['condition_value1'];
     else echo $lang['condition20_2'].$data['condition_value1'];
     break;
   case 22: // CONDITION_QUEST_NONE  quest_id 
     if ($data['condition_value1'] > 0) echo $lang['condition22'].getQuestName($data['condition_value1']);
     break;
   case  23: // CONDITION_ITEM_WITH_BANK- item_id, count
     $item = getItem($data['condition_value1'], '`entry`, `displayid`');
     echo $lang['condition23'].text_show_item($item['entry'], $item['displayid'], 'quest');
     if ($data['condition_value2'] > 1) echo 'x'.$data['condition_value2'];
     break;
   case 24: // NOITEM_WITH_BANK  item_id      count
     $item = getItem($data['condition_value1'], '`entry`, `displayid`');
     echo $lang['condition24'].text_show_item($item['entry'], $item['displayid'], 'quest');
     if ($data['condition_value1'] > 1) echo 'x'.$data['condition_value2'];
     break;
   case 25: // CONDITION_NOT_ACTIVE_GAME_EVENT  event_id
     echo $lang['condition25'].getGameEventName($data['condition_value1']);
     break;
   case 26: // CONDITION_ACTIVE_HOLIDAY  holiday_id
     echo $lang['condition26'].getGameHolidayName($data['condition_value1']);
     break;
   case 27: // CONDITION_NOT_ACTIVE_HOLIDAY  holiday_id
     echo $lang['condition27'].getGameHolidayName($data['condition_value1']);
     break;
   case 28: // CONDITION_LEARNABLE_ABILITY  spell_id     0 or item_id
     $spell = getSpell($data['condition_value1'], '`id`, `SpellIconID`');
     if ($data['condition_value2'] > 0) { $item = getItem($data['condition_value2'], '`entry`, `displayid`'); echo $lang['condition28_1']; show_spell($spell['id'], $spell['SpellIconID'], 'quest'); echo $lang['condition28_2'].text_show_item($item['entry'], $item['displayid'], 'quest');}
     else {echo $lang['condition28_1']; show_spell($spell['id'], $spell['SpellIconID'], 'quest');}
     break;
   case  29: // CONDITION_SKILL_BELOW skill_id, skill_value
     echo $lang['condition29'].getSkillName($data['condition_value1']);
     if ($data['condition_value2'] > 1) echo ' ('.$data['condition_value2'].')';
     break;
  }
}

class LootReportGenerator extends ReportGenerator{
 function LootReportGenerator($type='')
 {
  global $dDB;
  $this->db = &$dDB;
  $this->db_fields = '*';
  switch ($type){
   default:   $this->table = '`creature_loot_template`'; break;
  }
 }
 function loadSubList($lootId, $table)
 {
  $fields= $this->db_fields;
  $rows = $this->db->select("SELECT $fields FROM $table
                             WHERE `entry` = ?d
                             GROUP BY  IF (`mincountOrRef` < 0, `mincountOrRef`, `item`)
                             ORDER BY `groupid`, `ChanceOrQuestChance`>0, ABS(`ChanceOrQuestChance`) DESC", $lootId);
  if (!$rows)
      return 0;
  foreach($rows as &$loot)
  {
    // Group chance
    if ($loot['ChanceOrQuestChance'] == 0)
    {
     $group = $loot['groupid'];
     $chance = 0; $n = 0;
     foreach($rows as &$g)
       if ($g['groupid'] == $group)
       {
          if ($g['ChanceOrQuestChance']>0) $chance+=$g['ChanceOrQuestChance'];
          else                             $n++;
       }
     $chance =  round((100 - $chance) / $n, 3);
     foreach($rows as &$g)
       if ($g['groupid'] == $group && $g['ChanceOrQuestChance']==0)
         $g['ChanceOrQuestChance'] =$chance;
    }
    if ($loot['mincountOrRef'] < 0)
    {
       // Получаем список
       $loot['item']     = $this->loadSubList(-$loot['mincountOrRef'], 'reference_loot_template');
       $loot['maxcount'] = $this->db->selectCell("SELECT count(*) FROM $table WHERE `entry` = ?d AND `mincountOrRef` = ?d", $lootId, $loot['mincountOrRef']);
    }
  }
  return $rows;
 }
 function getLootList($lootId)
 {
  $this->total_data = 0;
  $this->data_array = $this->loadSubList($lootId, $this->table);
 }
 function renderSubList($lootList)
 {
  global  $Quality, $lang;
  if (!$lootList)
     return;
  $curloot = -1;
  foreach ($lootList as $loot)
  {
    $gtext = "";
    if ($loot['groupid']!=$curloot)
    {
        echo "<tr><th colspan = 4>$lang[kill_kredit_group]&nbsp;$loot[groupid]</th></tr>";
        $curloot = $loot['groupid'];
    }
    echo "<tr>";
    if ($loot['mincountOrRef'] > 0)
    {
     if ($item = getItem($loot['item'],"`entry`, `Quality`, `name`, `displayid`"))
     {
       echo '<td class=i_ico>';r_itemIcon($item);echo '</td>';
       echo '<td class=left>';r_itemName($item);echo '</td>';
     }
     else
       echo "<td>-</td><td>$lang[item_not_found]&nbsp;$loot[item]</td>";
    }
    else // Используется список вещей (падает только одна вещь из списка)
    {
      echo "<td>".$loot['maxcount']."x</td>";
      echo "<td class=forsub>$gtext<table class=sublist><tbody>";
      $this->renderSubList($loot['item']);
      echo "</tbody></table></td>";
    }
    if ($loot['lootcondition']){echo '<td>'; r_lootRequire($loot); echo '</td>';}
    else echo '<td></td>';
         if ($loot['ChanceOrQuestChance'] < 0) echo "<td align=center>Q".(-$loot['ChanceOrQuestChance'])."%</td>";
    else if ($loot['ChanceOrQuestChance'] > 0) echo "<td align=center>".$loot['ChanceOrQuestChance']."%</td>";
    echo "</tr>";
  }
 }
 function createReport($header)
 {
  global $lang;
  if (!$this->data_array)
     return;
  if ($this->ajax_mode==0)
     echo '<div id="'.$this->mark.'">';
  echo '<table class=report width=500>';
  echo '<tbody>';
  echo '<tr><td colspan=4 class=head>'.$header.'</td></tr>';
  echo '<tr><th width=1%></th><th>'.$lang['item_name'].'</th><th></th><th>'.$lang['drop'].'%</th></tr>';
  $this->renderSubList($this->data_array);
  echo '</tbody></table>';
  if ($this->ajax_mode==0)
  {
    echo '</div>';
    // Cache data
    $link = $this->createLink($this->page, $this->sort_method);
    echo "<script type=\"text/javascript\">ajaxCacheHtmlId('$this->mark','$link');</script>";
  }
 }
}

	//=================================================================
	// Item report functions and methods
	//=================================================================
	function r_item_icon($data) {echo text_show_item($data['entry'], $data['displayid']);}
	function r_item_name($data)
		{
			global $Quality;
			echo '<a class="'.$Quality[$data['Quality']].'" href="?item='.$data['entry'].'">'.(@$data['name_loc']?$data['name_loc']:$data['name']).'</a>';
		}
	function r_item_level($data)   {echo $data['ItemLevel'];}
	function r_item_req_level($data){echo $data['RequiredLevel'];}
	function r_item_gem_prop($data) {echo ($data['GemProperties']?getGemProperties($data['GemProperties']):'n/a');}
	function r_item_armor($data)   {echo $data['armor'];}
	function r_item_block($data)   {echo $data['block'];}
	function r_item_DPS($data)     {echo $data['dps'] != 0 ? number_format($data['dps'], 2, '.', ''):'n/a';}
	function r_item_ammo_DPS($data) {echo $data['adps'] != 0 ? number_format($data['adps'], 2, '.', ''):'n/a';}
	function r_item_speed($data)   {echo number_format($data['delay']/1000.00, 2, '.', '');}
	function r_item_slots($data)   {echo $data['ContainerSlots'].' slot';}
	function r_item_desc($data)    {echo (@$data['description_loc']?$data['description_loc']:$data['description']);}
	function r_item_s_class($data)  {echo getSubclassName($data['class'], $data['subclass'], 0);}
	function r_item_inv_type($data) {echo getInventoryType($data['InventoryType'], 0);}
	function r_item_recipe($data)  {$ritem = getRecipeItem($data); echo ($ritem ? text_show_item($ritem['entry'], $ritem['displayid']):'-');}

	function r_item_spells($data)
		{
			global $UseorEquip;
			for ($i=1;$i<=5;$i++)
				{
					if ($id = $data['spellid_'.$i])
						{
							if ($desc = get_spell_details($id)) { echo '<a href="?spell='.$id.'">'.$UseorEquip[$data['spelltrigger_'.$i]].' '.$desc.'</a><br>'; }
  						}
				}
		}

	function r_item_rep_rank($data) { echo $data['RequiredReputationFaction']?get_reputation_rank_name($data['RequiredReputationRank']):'n/a'; }
	function r_item_flag($data)    { echo dechex($data['Flags']); }

	// Vendor
	function r_vendor_cost($data)
		{
    			$flags2 = get_item_flags2($data['entry']);
			if ($data['ExtendedCost']>0)
				{
					$cost = get_extend_cost($data['ExtendedCost']);
					if ($flags2&ITEM_FLAGS2_EXT_COST_REQUIRES_GOLD) { echo money($data['BuyPrice']).''.r_excost_cost($cost); } else { r_excost_cost($cost); }
				}
			else
				{
					echo money($data['BuyPrice']);
				}
		}

	function r_vendor_count($data) { echo $data['sold_count']?$data['sold_count']:'∞'; }
	function r_vendor_time($data)  { echo $data['incrtime']?get_time_text($data['incrtime']):'';} 

	// NPC report generator config
	$item_report = array(
	'ITEM_REPORT_ICON'       =>array('class'=>'i_ico','sort'=>'',        'text'=>'',                       'draw'=>'r_itemIcon',     'sort_str'=>'',                             'fields'=>'`displayid`'      ),
	'ITEM_REPORT_NAME'       =>array('class'=>'left', 'sort'=>'name',    'text'=>$lang['item_name'],       'draw'=>'r_itemName',     'sort_str'=>'`name`',                       'fields'=>'`Quality`, `name`'),
	'ITEM_REPORT_LEVEL'      =>array('class'=>'small','sort'=>'i_level', 'text'=>$lang['item_level'],      'draw'=>'r_itemLevel',    'sort_str'=>'`ItemLevel` DESC, `name`',     'fields'=>'`ItemLevel`'      ),
	'ITEM_REPORT_REQLEVEL'   =>array('class'=>'small','sort'=>'level',   'text'=>$lang['item_req_level'],  'draw'=>'r_itemReqLevel', 'sort_str'=>'`RequiredLevel` DESC, `name`', 'fields'=>'`RequiredLevel`'  ),
	'ITEM_REPORT_GEMPROPETY' =>array('class'=>'left', 'sort'=>'gem_prop','text'=>$lang['item_gem_details'],'draw'=>'r_itemGemProp',  'sort_str'=>'`GemProperties`',              'fields'=>'`GemProperties`'),
	'ITEM_REPORT_ARMOR'      =>array('class'=>'',     'sort'=>'armor',   'text'=>$lang['item_armor'],      'draw'=>'r_itemArmor',    'sort_str'=>'`armor` DESC',                 'fields'=>'`armor`'),
	'ITEM_REPORT_BLOCK'      =>array('class'=>'',     'sort'=>'block',   'text'=>$lang['item_block'],      'draw'=>'r_itemBlock',    'sort_str'=>'`block` DESC',                 'fields'=>'`block`'),
	'ITEM_REPORT_DPS'        =>array('class'=>'',     'sort'=>'dps',     'text'=>$lang['item_dps'],        'draw'=>'r_itemDPS',      'sort_str'=>'`dps` DESC',                   'fields'=>'(500*(`dmg_min1`+`dmg_max1`) / `delay`) AS `dps`'),
	'ITEM_REPORT_AMMO_DPS'   =>array('class'=>'',     'sort'=>'adps',    'text'=>$lang['item_dps'],        'draw'=>'r_itemAmmoDPS',  'sort_str'=>'`adps` DESC',                  'fields'=>'((`dmg_min1`+`dmg_max1`)/2) AS `adps`'),
	'ITEM_REPORT_SPEED'      =>array('class'=>'',     'sort'=>'speed',   'text'=>$lang['item_speed'],      'draw'=>'r_itemSpeed',    'sort_str'=>'`delay` DESC',                 'fields'=>'`delay`'),
	'ITEM_REPORT_NUM_SLOTS'  =>array('class'=>'',     'sort'=>'bag_slot','text'=>$lang['item_slot_num'],   'draw'=>'r_itemSlots',    'sort_str'=>'`ContainerSlots` DESC',        'fields'=>'`ContainerSlots`'),
	'ITEM_REPORT_DESCRIPTION'=>array('class'=>'left', 'sort'=>'desc',    'text'=>$lang['item_desc'],       'draw'=>'r_itemDesc',     'sort_str'=>'`description` DESC',           'fields'=>'`description`'),
	'ITEM_REPORT_SUBCLASS'   =>array('class'=>'',     'sort'=>'subclass','text'=>$lang['item_type'],       'draw'=>'r_itemSClass',   'sort_str'=>'`subclass` DESC',              'fields'=>'`class`, `subclass`'),
	'ITEM_REPORT_SLOTTYPE'   =>array('class'=>'',     'sort'=>'type',    'text'=>$lang['item_slot'],       'draw'=>'r_itemInvType',  'sort_str'=>'`InventoryType` DESC',         'fields'=>'`InventoryType`'),
	'ITEM_REPORT_RECIPE_ITEM'=>array('class'=>'i_ico','sort'=>'',        'text'=>'',                       'draw'=>'r_itemRecipe',   'sort_str'=>'',                             'fields'=>'`spellid_1`, `spellid_2`, `class`'),
	'ITEM_REPORT_SPELL'      =>array('class'=>'left', 'sort'=>'',        'text'=>$lang['item_spells'],     'draw'=>'r_itemSpells',   'sort_str'=>'', 'fields'=>'`spellid_1`, `spelltrigger_1`, `spellid_2`, `spelltrigger_2`, `spellid_3`, `spelltrigger_3`, `spellid_4`, `spelltrigger_4`, `spellid_5`, `spelltrigger_5`'),
	'ITEM_REPORT_REQREP_RANK'=>array('class'=>'',     'sort'=>'rep_rank','text'=>$lang['item_faction_rank'],'draw'=>'r_itemRepRank', 'sort_str'=>'`RequiredReputationRank` DESC', 'fields'=>'`RequiredReputationFaction`, `RequiredReputationRank`'),
	'ITEM_REPORT_FLAGS'      =>array('class'=>'',     'sort'=>'',        'text'=>'flag',                   'draw'=>'r_itemFlag',     'sort_str'=>'',                             'fields'=>'`Flags`'),
	// If set vendor class type
	'VENDOR_REPORT_COST'   =>array('class'=>'', 'sort'=>'cost',    'text'=>$lang['item_cost'],       'draw'=>'r_vendorCost',   'sort_str'=>'`ExtendedCost`, `BuyPrice`',   'fields'=>'`ExtendedCost`, `BuyPrice`'),
	'VENDOR_REPORT_COUNT'  =>array('class'=>'', 'sort'=>'count',   'text'=>$lang['item_count'],      'draw'=>'r_vendorCount',  'sort_str'=>'`sold_count`, `name`',         'fields'=>'`npc_vendor`.`maxcount` AS `sold_count`'),
	'VENDOR_REPORT_INCTIME'=>array('class'=>'', 'sort'=>'time',    'text'=>$lang['item_incrtime'],   'draw'=>'r_vendorTime',   'sort_str'=>'`incrtime`, `name`',           'fields'=>'`incrtime`'),
	// If set loot class type
	'LOOT_REPORT_CHANCE'=>array('class'=>'', 'sort'=>'chance', 'text'=>$lang['loot_chance'], 'draw'=>'r_lootChance', 'sort_str'=>'ABS(`ChanceOrQuestChance`) DESC, `name`', 'fields'=>'`ChanceOrQuestChance`, `mincountOrRef`'),
	'LOOT_REPORT_REQ'   =>array('class'=>'', 'sort'=>'',       'text'=>$lang['loot_require'],'draw'=>'r_lootRequire','sort_str'=>'', 'fields'=>'`lootcondition`, `condition_value1`, `condition_value2`'),
	);
	
	// Item localisation flags (for allow disable some fields localisation if need)
	define('ITEM_LOCALE_NAME', 0x01);
	define('ITEM_LOCALE_DESCRIPTION', 0x02);
	define('ITEM_LOCALE_ALL', ITEM_LOCALE_NAME | ITEM_LOCALE_DESCRIPTION);

	// Item report class
	class item_report_generator extends ReportGenerator
		{

			var $dolocale = ITEM_LOCALE_ALL;
			function item_report_generator($type='')
				{
					global $item_report, $_SESSION;
					$this->db = &selectdb("mangos");
					$this->column_conf =&$item_report;
					$this->db_fields = '`item_template`.`entry`';
					switch ($type)
						{
							case 'vendor' :   $this->table = '(`item_template` join `npc_vendor` ON `item_template`.`entry` = `npc_vendor`.`item`)'; break;
							case 'loot':      $this->table = '(`item_loot_template` right join `item_template` ON `item_template`.`entry` = `item_loot_template`.`entry`)'; break;
							case 'disenchant':$this->table = '(`disenchant_loot_template` right join `item_template` ON `item_template`.`DisenchantID` = `disenchant_loot_template`.`entry`)'; break;
							case 'milling':   $this->table = '(`milling_loot_template` right join `item_template` ON `item_template`.`entry` = `milling_loot_template`.`entry`)'; break;
							case 'prospect':  $this->table = '(`prospecting_loot_template` right join `item_template` ON `item_template`.`entry` = `prospecting_loot_template`.`entry`)'; break;
							default:          $this->table = '`item_template`'; break;
						}
				}

 			function disable_name_localisation() 
				{
					$this->dolocale &= ~ITEM_LOCALE_NAME;
				}

			function localise_requirest($locale, &$tables, &$fields, &$sort_str)
				{
					$tables .= ' LEFT JOIN `locales_item` ON `item_template`.`entry` = `locales_item`.`entry`';
					if ($this->dolocale & ITEM_LOCALE_NAME)
						{
							$fields  = str_replace('`name`','`name`, `locales_item`.`name_loc'.$locale.'` AS `name_loc`', $fields);
							$sort_str = str_replace('`name`', '`name_loc`, `name`', $sort_str);
						}
					if ($this->dolocale & ITEM_LOCALE_DESCRIPTION)
						{
							$fields  = str_replace('`description`','`description`, `locales_item`.`description_loc'.$locale."` AS `description_loc`", $fields);
							$sort_str = str_replace('`description` DESC', '`description_loc` DESC, `name` DESC', $sort_str);
						}
				}

			function vendor_item_list($entry)
				{
					$this->do_requirest('`npc_vendor`.`entry`=$entry');
					$this->remove_if_all_zero('sold_count', 'VENDOR_REPORT_COUNT');
					$this->remove_if_all_zero('incrtime',   'VENDOR_REPORT_INCTIME');
				}

			function use_spell($entry)
				{
					$this->do_requirest('(`spellid_1` =$entry OR `spellid_2` =$entry OR `spellid_3` =$entry OR `spellid_4` =$entry OR `spellid_5` =$entry) AND `spellid_1` <> 483');
				}

			function recipe_spell($entry)
				{
					$this->do_requirest('`spellid_1` = 483 AND `spellid_2` =$entry');
				}

			function socket_bonus($entry)
				{
					$this->do_requirest('`SocketBonus` =$entry');
				}

			function enchant_by_gems($entry)
				{
					selectdb("wcf");
					if ($list = db_assoc(db_query("SELECT `id` FROM ".DB_GEMPROPERTIES." WHERE `spellitemenchantement`='$entry'")))
						{
							reset($list);
							$item = current($list);
							// нужно фиксить
							$this->do_requirest('`GemProperties` IN ($list)');
						}
				}

			function require_reputation($entry)
				{
					$this->do_requirest('`RequiredReputationFaction` =$entry');
				}

			function loot_item($entry)
				{
					$ref_loot =& get_refrence_item_loot($entry);
					//$ref_loot = count($ref_loot)==0 ? DBSIMPLE_SKIP:array_keys($ref_loot);
					$ref_loot = count($ref_loot)==0 ? "" :array_keys($ref_loot);
					$this->do_requirest('(`item` = $entry  AND `mincountOrRef` > 0) { OR -`mincountOrRef` IN ($ref_loot) } GROUP BY `entry`');
					$this->remove_if_all_zero('lootcondition', 'LOOT_REPORT_REQ');
				}

		}

//=================================================================
// Spell trainer list report functions and methods
//=================================================================
function r_trainerCost($data)  {echo money($data['spellcost']);}
function r_trainerSpell($data)
{
  if ($spell = getSpell($data['spell']))
  {
     if (!r_spellCreate($spell))
        r_spellIcon($spell);
  }
}
function r_trainerNSpell($data)
{
  if ($spell = getSpell($data['spell']))
  {
     echo getSpellName($spell);
  }
}
function r_trainerSkill($data) {if ($data['reqskill']) echo getSkillName($data['reqskill']);}
function r_trainerValue($data) {if ($data['reqskill']) echo $data['reqskillvalue'];}
function r_trainerSkillReq($data){if ($data['reqskill']) echo getSkillName($data['reqskill']).' ('.$data['reqskillvalue'].')';}
function r_trainerLevel($data) {echo $data['reqlevel']?$data['reqlevel']:'';}

$train_report = array(
'TRAIN_REPORT_LEVEL'   =>array('class'=>'small','sort'=>'level','text'=>$lang['trainer_level'], 'draw'=>'r_trainerLevel', 'sort_str'=>'`reqlevel`, `reqskillvalue`', 'fields'=>'`reqlevel`' ),
'TRAIN_REPORT_ICON'    =>array('class'=>'i_ico', 'sort'=>'',     'text'=>'', 'draw'=>'r_trainerSpell', 'sort_str'=>'',               'fields'=>'`spell`' ),
'TRAIN_REPORT_NAME'    =>array('class'=>'left', 'sort'=>'spell',     'text'=>$lang['trainer_spell'], 'draw'=>'r_trainerNSpell', 'sort_str'=>'`spell`',               'fields'=>'`spell`' ),
'TRAIN_REPORT_COST'    =>array('class'=>'cost', 'sort'=>'cost', 'text'=>$lang['trainer_cost'],  'draw'=>'r_trainerCost',  'sort_str'=>'`spellcost`',    'fields'=>'`spellcost`'),
'TRAIN_REPORT_SKILL'   =>array('class'=>'small','sort'=>'skill','text'=>$lang['trainer_skill'], 'draw'=>'r_trainerSkill', 'sort_str'=>'`reqskill`',     'fields'=>'`reqskill`' ),
'TRAIN_REPORT_VALUE'   =>array('class'=>'small','sort'=>'value','text'=>$lang['trainer_value'], 'draw'=>'r_trainerValue', 'sort_str'=>'`reqskillvalue`','fields'=>'`reqskillvalue`'),
);

class NPCTrainerReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function NPCTrainerReportGenerator($type='')
 {
  global $train_report, $dDB;
  $this->db = &$dDB;
  $this->column_conf =&$train_report;
  $this->table = '`npc_trainer`';
  $this->db_fields = '`entry`';
 }
 function trainSpell($entry)
 {
  $this->do_requirest('`entry` = ?d', $entry);
  $this->remove_if_all_zero('reqlevel', 'TRAIN_REPORT_LEVEL');
  $this->remove_if_all_zero('reqskill', 'TRAIN_REPORT_SKILL');
  $this->remove_if_all_zero('reqskillvalue', 'TRAIN_REPORT_VALUE');
 }
}

//=================================================================
// Creature list report functions and methods
//=================================================================
function r_npcLvl($data)
{
  echo $data['maxlevel'];
  if ($data['rank'])
    echo '<br><div class=rank>'.getCreatureRank($data['rank']).'</div>';
}
function r_npcName($data)
{
  $h = getHeroicList();
  $h1 = getHeroicList1();
  $h2 = getHeroicList2();
  if (isset($h[$data['entry']]))
  {
    $heroic = getCreature($h[$data['entry']]);
	$data['name']=$heroic['name'].' (difficulty_1)';
	$data['name_loc']=$heroic['name'].' (difficulty_1)';
	$data['subname']=$heroic['subname'];
  }
  if (isset($h1[$data['entry']]))
  {
    $heroic = getCreature($h1[$data['entry']]);
	$data['name']=$heroic['name'].' (difficulty_2)';
	$data['name_loc']=$heroic['name'].' (difficulty_2)';
	$data['subname']=$heroic['subname'];
  }
  if (isset($h2[$data['entry']]))
  {
    $heroic = getCreature($h2[$data['entry']]);
	$data['name']=$heroic['name'].' (difficulty_3)';
	$data['name_loc']=$heroic['name'].' (difficulty_3)';
	$data['subname']=$heroic['subname'];
  }
  $name    = @$data['name_loc'] ? $data['name_loc'] : $data['name'];
  $subname = @$data['subname_loc'] ? $data['subname_loc'] : $data['subname'];
  echo '<a href="?npc='.$data['entry'].'">'.($name?$name:'no name').'</a>';
  if ($subname)
    echo '<br><div class=subname><a href="?s=n&subname='.$subname.'">&lt;'.$subname.'&gt;</a></div>';
}
function r_npcRName($data)
{
  $h = getHeroicList();
  $h1 = getHeroicList1();
  $h2 = getHeroicList2();
  if (isset($h[$data['entry']]))
  {
    $heroic = getCreature($h[$data['entry']]);
	$data['name']=$heroic['name'].' (difficulty_1)';
	$data['name_loc']=$heroic['name'].' (difficulty_1)';
	$data['subname']=$heroic['subname'];
  }
  if (isset($h1[$data['entry']]))
  {
    $heroic = getCreature($h1[$data['entry']]);
	$data['name']=$heroic['name'].' (difficulty_2)';
	$data['name_loc']=$heroic['name'].' (difficulty_2)';
	$data['subname']=$heroic['subname'];
  }
  if (isset($h2[$data['entry']]))
  {
    $heroic = getCreature($h2[$data['entry']]);
	$data['name']=$heroic['name'].' (difficulty_3)';
	$data['name_loc']=$heroic['name'].' (difficulty_3)';
	$data['subname']=$heroic['subname'];
  }
  $name    = @$data['name_loc'] ? $data['name_loc'] : $data['name'];
  $subname = @$data['subname_loc'] ? $data['subname_loc'] : $data['subname'];
  echo '<a href="?npc='.$data['entry'].'">'.($name?$name:'no name').'</a> <font size=-3>('.getLoyality($data['faction_A']).')</font>';
  if ($subname)
    echo '<br><div class=subname><a href="?s=n&subname='.$subname.'">&lt;'.$subname.'&gt;</a></div>';
}
function r_npcReact($data)  {echo getLoyality($data['faction_A']);}
function r_npcMap($data)
{
  global $lang;
  $h = getHeroicList();
  $h1 = getHeroicList1();
  $h2 = getHeroicList2();

  if (isset($h2[$data['entry']]))
    echo '<a href="?map&npc='.$h2[$data['entry']].'">'.$lang['map'].'</a>';
  else
  if (isset($h1[$data['entry']]))
    echo '<a href="?map&npc='.$h1[$data['entry']].'">'.$lang['map'].'</a>';
  else
  if (isset($h[$data['entry']]))
    echo '<a href="?map&npc='.$h[$data['entry']].'">'.$lang['map'].'</a>';
  else
    echo '<a href="?map&npc='.$data['entry'].'">'.$lang['map'].'</a>';
}
function r_npcRole($data)
{
  $flag = $data['npcflag'];
  if ($flag == 0) {return;}
  if ($flag&0x00000001) echo '<img src=images/map_points/gossip_icon.png>';
  if ($flag&0x00000002 && getNpcQuestrelation($data['entry'])) echo '<img src=images/map_points/available_quest_icon.gif>';
  if ($flag&0x00000002 && getNpcInvolvedrelation($data['entry'])) echo '<img src=images/map_points/active_quest_icon.gif>';
  if ($flag&0x00000070) echo '<img src=images/map_points/trainer_icon.gif>';
  if ($flag&0x00000F80) echo '<img src=images/map_points/vendor_icon.gif>';
//  if ($flag&0x00001000) echo '<img src=images/map_points/repair.gif>';
  if ($flag&0x00002000) echo '<img src=images/map_points/taxi_icon.gif>';
  if ($flag&0x00010000) echo '<img src=images/map_points/inn_icon.png>';
  if ($flag&0x00820000) echo '<img src=images/map_points/banker_icon.gif>';
  if ($flag&0x00100000) echo '<img src=images/map_points/battle_master_icon.gif>';
  if ($flag&0x00200000) echo '<img src=images/map_points/banker_icon.gif>';
  if ($flag&0x000C0000) echo '<img src=images/map_points/tabard_icon.gif>';
/*
define('UNIT_NPC_FLAG_SPIRITHEALER', 0x00004000);
define('UNIT_NPC_FLAG_SPIRITGUIDE', 0x00008000);
define('UNIT_NPC_FLAG_STABLEMASTER', 0x00400000);*/
}
function r_OnKillRep($data)
{
   $creature_rate1 = getCreatureRewRate($data['RewOnKillRepFaction1']);
   $creature_rate2 = getCreatureRewRate($data['RewOnKillRepFaction2']);
   if ($data['RewOnKillRepFaction1'])
  {
   echo ($data['RewOnKillRepValue1']>0?'+':'').$data['RewOnKillRepValue1']*$creature_rate1.' '.getFactionName($data['RewOnKillRepFaction1']).' ('.getReputationRankName($data['MaxStanding1']).')';
   $spillover=getRepSpillover($data['RewOnKillRepFaction1']);
   if ($spillover)
   foreach ($spillover as $faction)
   {
     if ($faction['faction1'])
      echo '<br>'.($data['RewOnKillRepValue1']>0?'+':'').$data['RewOnKillRepValue1']*$creature_rate1*$faction['rate_1'].' '.getFactionName($faction['faction1']).' ('.getReputationRankName($data['MaxStanding1']).')';
     if ($faction['faction2'])
      echo '<br>'.($data['RewOnKillRepValue1']>0?'+':'').$data['RewOnKillRepValue1']*$creature_rate1*$faction['rate_2'].' '.getFactionName($faction['faction2']).' ('.getReputationRankName($data['MaxStanding1']).')';
     if ($faction['faction3'])
      echo '<br>'.($data['RewOnKillRepValue1']>0?'+':'').$data['RewOnKillRepValue1']*$creature_rate1*$faction['rate_3'].' '.getFactionName($faction['faction3']).' ('.getReputationRankName($data['MaxStanding1']).')';
     if ($faction['faction4'])
      echo '<br>'.($data['RewOnKillRepValue1']>0?'+':'').$data['RewOnKillRepValue1']*$creature_rate1*$faction['rate_4'].' '.getFactionName($faction['faction4']).' ('.getReputationRankName($data['MaxStanding1']).')';
   }
  }
   if ($data['RewOnKillRepFaction2'])
  {
   if ($data['RewOnKillRepFaction1'] == 0)
   echo ($data['RewOnKillRepValue2']>0?'+':'').$data['RewOnKillRepValue2']*$creature_rate2.' '.getFactionName($data['RewOnKillRepFaction2']).' ('.getReputationRankName($data['MaxStanding2']).')';
   else
   echo '<br>'.($data['RewOnKillRepValue2']>0?'+':'').$data['RewOnKillRepValue2']*$creature_rate2.' '.getFactionName($data['RewOnKillRepFaction2']).' ('.getReputationRankName($data['MaxStanding2']).')';
   $spillover=getRepSpillover($data['RewOnKillRepFaction2']);
   if ($spillover)
   foreach ($spillover as $faction)
   {
     if ($faction['faction1'])
      echo '<br>'.($data['RewOnKillRepValue2']>0?'+':'').$data['RewOnKillRepValue2']*$creature_rate2*$faction['rate_1'].' '.getFactionName($faction['faction1']).' ('.getReputationRankName($data['MaxStanding2']).')';
     if ($faction['faction2'])
      echo '<br>'.($data['RewOnKillRepValue2']>0?'+':'').$data['RewOnKillRepValue2']*$creature_rate2*$faction['rate_2'].' '.getFactionName($faction['faction2']).' ('.getReputationRankName($data['MaxStanding2']).')';
     if ($faction['faction3'])
      echo '<br>'.($data['RewOnKillRepValue2']>0?'+':'').$data['RewOnKillRepValue2']*$creature_rate2*$faction['rate_3'].' '.getFactionName($faction['faction3']).' ('.getReputationRankName($data['MaxStanding2']).')';
     if ($faction['faction4'])
      echo '<br>'.($data['RewOnKillRepValue2']>0?'+':'').$data['RewOnKillRepValue2']*$creature_rate2*$faction['rate_4'].' '.getFactionName($faction['faction4']).' ('.getReputationRankName($data['MaxStanding2']).')';
   }
  }
}
// NPC report generator config
$npc_report = array(
'NPC_REPORT_LEVEL'   =>array('class'=>'small','sort'=>'level','text'=>$lang['creature_level'], 'draw'=>'r_npcLvl',  'sort_str'=>'`maxlevel` DESC, `name`', 'fields'=>'`maxlevel`, `rank`'),
'NPC_REPORT_RANK'    =>array('class'=>'small','sort'=>'rank', 'text'=>$lang['creature_level'], 'draw'=>'r_npcLvl',  'sort_str'=>'`rank` DESC, `maxlevel` DESC, `name`', 'fields'=>'`maxlevel`, `rank`'),
'NPC_REPORT_NAME'    =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['creature_name'],  'draw'=>'r_npcName', 'sort_str'=>'`name`',                  'fields'=>'`name`, `subname`' ),
'NPC_REPORT_RNAME'   =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['creature_name'],  'draw'=>'r_npcRName','sort_str'=>'`name`',                  'fields'=>'`name`, `subname`, `faction_A`' ),
'NPC_REPORT_REACTION'=>array('class'=>'small','sort'=>'',     'text'=>$lang['creature_react'], 'draw'=>'r_npcReact','sort_str'=>'',                        'fields'=>'`faction_A`'),
'NPC_REPORT_ROLE'    =>array('class'=>'',     'sort'=>'role', 'text'=>$lang['creature_role'],  'draw'=>'r_npcRole', 'sort_str'=>'`npcflag` DESC',          'fields'=>'`npcflag`'),
'NPC_REPORT_MAP'     =>array('class'=>'small','sort'=>'',     'text'=>$lang['map'],            'draw'=>'r_npcMap',  'sort_str'=>'',                        'fields'=>''),
// vendor
'VENDOR_REPORT_COST'   =>array('class'=>'',  'sort'=>'cost', 'text'=>$lang['item_cost'],      'draw'=>'r_vendorCost', 'sort_str'=>'`ExtendedCost`, `name`', 'fields'=>'`ExtendedCost`'),
'VENDOR_REPORT_COUNT'  =>array('class'=>'',  'sort'=>'count','text'=>$lang['item_count'],     'draw'=>'r_vendorCount','sort_str'=>'`sold_count`, `name`',   'fields'=>'`npc_vendor`.`maxcount` AS `sold_count`'),
'VENDOR_REPORT_INCTIME'=>array('class'=>'',  'sort'=>'time', 'text'=>$lang['item_incrtime'],  'draw'=>'r_vendorTime', 'sort_str'=>'`incrtime`, `name`',     'fields'=>'`incrtime`'),
// trainer
'TRAINER_REPORT_COST' =>array('class'=>'',    'sort'=>'scost', 'text'=>$lang['trainer_cost'], 'draw'=>'r_trainerCost', 'sort_str'=>'`spellcost`',                'fields'=>'`spellcost`'),
'TRAINER_REPORT_SPELL'=>array('class'=>'left','sort'=>'',      'text'=>$lang['trainer_spell'],'draw'=>'r_trainerSpell','sort_str'=>'',                           'fields'=>'`spell`'),
'TRAINER_REPORT_SKILL'=>array('class'=>'',    'sort'=>'skill', 'text'=>$lang['trainer_skill'],'draw'=>'r_trainerSkillReq','sort_str'=>'`reqskill`, `reqskillvalue`','fields'=>'`reqskill`, `reqskillvalue`'),
'TRAINER_REPORT_LEVEL'=>array('class'=>'',    'sort'=>'slevel','text'=>$lang['trainer_level'],'draw'=>'r_trainerLevel','sort_str'=>'`reqlevel`',                 'fields'=>'`reqlevel`'),
// loot
'LOOT_REPORT_CHANCE'=>array('class'=>'', 'sort'=>'chance', 'text'=>$lang['loot_chance'], 'draw'=>'r_lootChance', 'sort_str'=>'ABS(`ChanceOrQuestChance`) DESC, `name`', 'fields'=>'`ChanceOrQuestChance`, `mincountOrRef`'),
'LOOT_REPORT_REQ'   =>array('class'=>'', 'sort'=>'',       'text'=>$lang['loot_require'],'draw'=>'r_lootRequire','sort_str'=>'', 'fields'=>'`lootcondition`, `condition_value1`, `condition_value2`'),
// reputation
'ONKILL_REPUTATION' =>array('class'=>'left', 'sort'=>'rep','text'=>$lang['onkill_rep'],'draw'=>'r_OnKillRep','sort_str'=>'`RewOnKillRepValue1` DESC, `RewOnKillRepValue2` DESC', 'fields'=>'`RewOnKillRepFaction1`, `RewOnKillRepValue1`, `MaxStanding1`, `RewOnKillRepValue2`, `RewOnKillRepFaction2`, `MaxStanding2`'),
);

define('NPC_LOCALE_NAME',    0x01);
define('NPC_LOCALE_SUBNAME', 0x02);
define('NPC_LOCALE_ALL', NPC_LOCALE_NAME | NPC_LOCALE_SUBNAME);

// Creature report class
class CreatureReportGenerator extends ReportGenerator{
 var $dolocale = NPC_LOCALE_ALL;
 function CreatureReportGenerator($type = '')
 {
  global $npc_report, $dDB;
  $this->db = &$dDB;
  $this->column_conf =&$npc_report;
  $this->db_fields = '`creature_template`.`entry`';
  switch ($type) {
   case 'vendor': $this->table = '(`creature_template` join `npc_vendor` ON `creature_template`.`entry` = `npc_vendor`.`entry`)'; break;
   case 'trainer':$this->table = '(`creature_template` join `npc_trainer` ON `creature_template`.`entry` = `npc_trainer`.`entry`)'; break;
   case 'loot':   $this->table = '(`creature_template` join `creature_loot_template` ON `creature_template`.`lootid` = `creature_loot_template`.`entry`)'; break;
   case 'pick':   $this->table = '(`creature_template` join `pickpocketing_loot_template` ON `creature_template`.`pickpocketloot` = `pickpocketing_loot_template`.`entry`)'; break;
   case 'skin':   $this->table = '(`creature_template` join `skinning_loot_template` ON `creature_template`.`skinloot` = `skinning_loot_template`.`entry`)'; break;
   case 'position':$this->table ='(`creature_template` join `creature` ON `creature_template`.`entry` = `creature`.`id`)'; break;
   case 'reputation':$this->table ='(`creature_template` join `creature_onkill_reputation` ON `creature_template`.`entry` = `creature_onkill_reputation`.`creature_id`)'; break;
   default:       $this->table = '`creature_template`'; break;
  }
 }
 function disableNameLocalisation() {$this->dolocale &= ~NPC_LOCALE_NAME;}
 function disableSubnameLocalisation() {$this->dolocale &= ~NPC_LOCALE_SUBNAME;}
 function localiseRequirest($locale, &$tables, &$fields, &$sort_str)
 {
  $tables.=' LEFT JOIN `locales_creature` ON `creature_template`.`entry` = `locales_creature`.`entry`';
  if ($this->dolocale & NPC_LOCALE_NAME)
  {
   $fields   = str_replace('`name`','`name`, `locales_creature`.`name_loc'.$locale.'` AS `name_loc`', $fields);
   $sort_str = str_replace('`name`','`name_loc`, `name`', $sort_str);
  }
  if ($this->dolocale & NPC_LOCALE_SUBNAME)
  {
   $fields   = str_replace('`subname`','`subname`, `locales_creature`.`subname_loc'.$locale.'` AS `subname_loc`', $fields);
   $sort_str = str_replace('`subname`','`subname_loc`, `subname`', $sort_str);
  }
 }
 function castSpell($entry)
 {
    global $dDB;
    $rows_1 = $dDB->selectCol('SELECT `entry` FROM `creature_template` WHERE `spell1` = ?d OR `spell2` = ?d OR `spell3` = ?d OR `spell4` = ?d', $entry, $entry, $entry, $entry);
    $rows_2 = $dDB->selectCol('SELECT `creature_id` FROM `creature_ai_scripts` WHERE (`action1_type` = 11 AND `action1_param1`=?d) OR (`action2_type` = 11 AND `action2_param1`=?d) OR (`action3_type` = 11 AND `action3_param1`=?d)', $entry, $entry, $entry);
    $casters = array_unique(array_merge($rows_1, $rows_2));
    if (count($casters))
       $this->do_requirest('`creature_template`.`entry` in (?a)', $casters);
 }
 function inFaction($entry)
 {
  global $wDB;
  if ($templatesId =& getFactionTemplates($entry))
    $this->do_requirest('`faction_A` in (?a) OR `faction_H` in (?a)', $templatesId, $templatesId);
 }
 function soldItem($entry, $price)
 {
  $this->db_fields.=', '.$price.' AS `BuyPrice`';
  $this->do_requirest('`item` = ?d', $entry);
  $this->remove_if_all_zero('sold_count', 'VENDOR_REPORT_COUNT');
  $this->remove_if_all_zero('incrtime',   'VENDOR_REPORT_INCTIME');
 }
 function trainSpell($entry)
 {
  $this->do_requirest('`spell` = ?d', $entry);
  $this->remove_if_all_zero('reqskill', 'TRAINER_REPORT_SKILL');
 }
 function kreditGroup($entry)
 {
  $this->do_requirest('`KillCredit1` = ?d OR `KillCredit2` = ?d', $entry, $entry);
 }
 function lootItem($entry)
 {
  $ref_loot =& getRefrenceItemLoot($entry);
  $this->do_requirest('(`item` = ?d  AND `mincountOrRef` > 0) { OR -`mincountOrRef` IN (?a) } GROUP BY `entry`', $entry, count($ref_loot)==0 ? DBSIMPLE_SKIP:array_keys($ref_loot));
  $this->remove_if_all_zero('lootcondition', 'LOOT_REPORT_REQ');
 }
 // Position
 function onMap($entry)
 {
  $this->do_requirest('`map` = ?d GROUP BY `id`', $entry);
 }
 function onArea($area_data)
 {
  $this->setManualPagenateMode();
  $this->addFieldsRequirest('`map`, `position_x`, `position_y`, `position_z`');
  $this->do_requirest('`map` = ?d AND `position_x` > ?d AND `position_x` < ?d AND `position_y` > ?d AND `position_y` < ?d', $area_data[0], $area_data[5], $area_data[4], $area_data[3], $area_data[2]);
  $setId = array();
  foreach($this->data_array as $id=>$c)
  {
    $zone = getZoneFromPoint($c['map'], $c['position_x'], $c['position_y'], $c['position_z']);
    if ($zone!=$area_data[1] || isset($setId[$c['entry']]))
      unset($this->data_array[$id]);
    else
      $setId[$c['entry']] = 1;
  }
 }
 // Reputation
 function rewardFactionReputation($id)
 {
  $this->do_requirest('`RewOnKillRepFaction1` = ?d OR `RewOnKillRepFaction2` = ?d', $id, $id);
 }
 function rewardNpcFactionReputation($entry)
 {
  $this->do_requirest('`creature_id` = ?d', $entry);
 }
}

//=================================================================
// Gameobject list report functions and methods
//=================================================================
function r_objName($data)
{
  $name = @$data['name_loc'] ? $data['name_loc'] : $data['name'];
  echo '<a href="?object='.$data['entry'].'">'.($name?$name:'no name').'</a>';
}
function r_objType($data)  {echo getGameobjectType($data['type'], 0);}
function r_objMap($data)   {global $lang; echo '<a href="?map&obj='.$data['entry'].'">'.$lang['map'].'</a>';}

// GO report generator config
$go_report = array(
'GO_REPORT_NAME' =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['go_name'], 'draw'=>'r_objName', 'sort_str'=>'`name`', 'fields'=>'`name`' ),
'GO_REPORT_TYPE' =>array('class'=>'',     'sort'=>'type', 'text'=>$lang['go_type'], 'draw'=>'r_objType', 'sort_str'=>'`type`', 'fields'=>'`type`'),
'GO_REPORT_MAP'  =>array('class'=>'small','sort'=>'',     'text'=>$lang['map'],     'draw'=>'r_objMap',  'sort_str'=>'',       'fields'=>''),
// loot
'LOOT_REPORT_CHANCE'=>array('class'=>'', 'sort'=>'chance', 'text'=>$lang['loot_chance'], 'draw'=>'r_lootChance', 'sort_str'=>'ABS(`ChanceOrQuestChance`) DESC, `name`', 'fields'=>'`ChanceOrQuestChance`, `mincountOrRef`'),
'LOOT_REPORT_REQ'   =>array('class'=>'', 'sort'=>'',       'text'=>$lang['loot_require'],'draw'=>'r_lootRequire','sort_str'=>'', 'fields'=>'`lootcondition`, `condition_value1`, `condition_value2`'),
);

define('GO_LOCALE_NAME',    0x01);
define('GO_LOCALE_ALL', NPC_LOCALE_NAME);

// GO report class
class GameobjectReportGenerator extends ReportGenerator{
 var $dolocale = GO_LOCALE_ALL;
 function GameobjectReportGenerator($type = '')
 {
  global $go_report, $dDB;
  $this->db = &$dDB;
  $this->column_conf =&$go_report;
  $this->db_fields = '`gameobject_template`.`entry`';
  switch ($type) {
   case 'loot':
   $this->table =
   '(`gameobject_template`
       join
     `gameobject_loot_template`
     ON
     `gameobject_template`.`data1` = `gameobject_loot_template`.`entry` AND
     `gameobject_template`.`type` IN (3, 17, 25))';
   break;
   case 'position':$this->table ='(`gameobject_template` join `gameobject` ON `gameobject_template`.`entry` = `gameobject`.`id`)';break;
   default:       $this->table = '`gameobject_template`';break;
  }
 }
 function disableNameLocalisation() {$this->dolocale &= ~GO_LOCALE_NAME;}
 function localiseRequirest($locale, &$tables, &$fields, &$sort_str)
 {
  $tables.= ' LEFT JOIN `locales_gameobject` ON `gameobject_template`.`entry` = `locales_gameobject`.`entry`';
  if ($this->dolocale & GO_LOCALE_NAME)
  {
   $fields = str_replace('`name`',   '`name`, `locales_gameobject`.`name_loc'.$locale.'` AS `name_loc`', $fields);
   $sort_str= str_replace('`name`', '`name_loc`, `name`', $sort_str);
  }
  $fields = str_replace('`castbarcaption`','`castbarcaption`, `locales_gameobject`.`castbarcaption_loc'.$locale.'` AS `castbarcaption_loc`', $fields);
 }
 function castSpell($entry)
 {
   $this->do_requirest(
   '(`type` = ?d AND `data3`  = ?d) OR
    (`type` = ?d AND `data10` = ?d) OR
    (`type` = ?d AND `data1`  = ?d) OR
    (`type` = ?d AND `data0`  = ?d) OR
    (`type` = ?d AND (`data2` = ?d OR `data3` = ?d))',
    GAMEOBJECT_TYPE_TRAP, $entry,
    GAMEOBJECT_TYPE_GOOBER, $entry,
    GAMEOBJECT_TYPE_SUMMONING_RITUAL, $entry,
    GAMEOBJECT_TYPE_SPELLCASTER, $entry,
    GAMEOBJECT_TYPE_AURA_GENERATOR, $entry, $entry);
 }
 function inFaction($entry)
 {
  global $wDB;
  if ($templatesId =& getFactionTemplates($entry))
    $this->do_requirest('`faction` in (?a)', $templatesId);
 }
 function spellFocus($entry)
 {
  $this->do_requirest('`type` = ?d AND `data0` = ?d', GAMEOBJECT_TYPE_SPELL_FOCUS, $entry);
 }
 function lootItem($entry)
 {
  $ref_loot =& getRefrenceItemLoot($entry);
  $this->do_requirest('(`item` = ?d  AND `mincountOrRef` > 0) { OR -`mincountOrRef` IN (?a) } GROUP BY `entry`', $entry, count($ref_loot)==0 ? DBSIMPLE_SKIP:array_keys($ref_loot));
  $this->remove_if_all_zero('lootcondition', 'LOOT_REPORT_REQ');
 }
 // Position
 function onMap($entry)
 {
  $this->do_requirest('`map` = ?d GROUP BY `id`', $entry);
 }
 function onArea($area_data)
 {
  $this->setManualPagenateMode();
  $this->addFieldsRequirest('`map`, `position_x`, `position_y`, `position_z`');
  $this->do_requirest('`map` = ?d AND `position_x` > ?d AND `position_x` < ?d AND `position_y` > ?d AND `position_y` < ?d', $area_data[0], $area_data[5], $area_data[4], $area_data[3], $area_data[2]);
  $setId = array();
  foreach($this->data_array as $id=>$c)
  {
    $zone = getZoneFromPoint($c['map'], $c['position_x'], $c['position_y'], $c['position_z']);
    if ($zone!=$area_data[1] || isset($setId[$c['entry']]))
      unset($this->data_array[$id]);
    else
      $setId[$c['entry']] = 1;
  }
 }
}

//=================================================================
// Quest list report functions and methods
//=================================================================
function r_questLvl($data)    {echo $data['QuestLevel'];}
function r_questReqLvl($data) {echo $data['MinLevel'];}
function r_questName($data)
{
  global $lang;
  $name = @$data['Title_loc']?$data['Title_loc']:$data['Title'];
 if (getAllowableRace($data['RequiredRaces']) && ($data['RequiredRaces'] & 1101) && ($data['RequiredRaces'] !=1791))
     echo "<img width=22 height=22 src='images/player_info/factions_img/alliance.gif'>&nbsp;";
 if (getAllowableRace($data['RequiredRaces']) && ($data['RequiredRaces'] & 690) && ($data['RequiredRaces'] !=1791))
     echo "<img width=22 height=22 src='images/player_info/factions_img/horde.gif'>&nbsp;";
 echo '<a href="?quest='.$data['entry'].'">'.($name?$name:'no name').'</a><br>';
 if ($data['ZoneOrSort']>0)
    echo '<div class=areaname><a href="?s=q&ZoneID='.$data['ZoneOrSort'].'">'.getAreaName($data['ZoneOrSort']).'</a></div>';
 else
 if ($data['ZoneOrSort']<0 AND ((-$data['ZoneOrSort']) >= 374 OR (-$data['ZoneOrSort']) == 221 OR (-$data['ZoneOrSort']) == 241 OR ((-$data['ZoneOrSort']) >= 344 AND (-$data['ZoneOrSort']) < 371) or
    (-$data['ZoneOrSort']) == 284 OR (-$data['ZoneOrSort']) == 25 OR (-$data['ZoneOrSort']) == 41 OR (-$data['ZoneOrSort']) < 24))
    echo '<div class=areaname><a href="?s=q&SortID='.(-$data['ZoneOrSort']).'">'.getQuestSort(-$data['ZoneOrSort']).'</a></div>';
 if ($data['RequiredClasses'])
    echo '<div class=classqname>'.getQAllowableClass($data['RequiredClasses']).'</div>';
 if ($data['RequiredSkill'])
    echo '<div class=areaname><a href="?s=q&SkillID='.($data['RequiredSkill']).'">'.getSkillName($data['RequiredSkill'], 0).'('.$data['RequiredSkillValue'].')</a></div>';
 if ($data['SpecialFlags'] & QUEST_SPECIAL_FLAG_MONTHLY)
    echo '<div class=areaname><a href="?s=q&Sfm='.($data['SpecialFlags']).'">'.$lang['quest_type3'].'</a></div>';
 if ($data['QuestFlags'] & QUEST_FLAGS_WEEKLY)
    echo '<div class=areaname><a href="?s=q&Sfw='.($data['QuestFlags']).'">'.$lang['quest_type2'].'</a></div>';
 if ($data['QuestFlags'] & QUEST_FLAGS_DAILY)
    echo '<div class=areaname><a href="?s=q&Sfd='.($data['QuestFlags']).'">'.$lang['quest_type1'].'</a></div>';
 if (($data['SpecialFlags'] & QUEST_SPECIAL_FLAG_REPEATABLE) && (($data['SpecialFlags'] & QUEST_SPECIAL_FLAG_MONTHLY) ==0) && ($data['QuestFlags'] & (QUEST_FLAGS_DAILY | QUEST_FLAGS_WEEKLY))  == 0)
    echo '<div class=areaname><a href="?s=q&Sfr='.($data['SpecialFlags']).'">'.$lang['quest_type0'].'</a></div>';
}
function r_questGiver($data)
{
  global $dDB;
  // Search creature quest giver
  if ($src = $dDB->select(
   'SELECT `entry`, `name`, `subname`, `faction_A`
    FROM  `creature_template` left join `creature_questrelation` ON `creature_template`.`entry` = `creature_questrelation`.`id`
    WHERE `creature_questrelation`.`quest` = ?d', $data['entry']))
  {
    foreach ($src as $creature){localiseCreature($creature);r_npcRName($creature);}
    return;
  }
  // Search GO quest giver
  if ($src = $dDB->select(
  'SELECT `entry`, `name`
   FROM `gameobject_template` left join `gameobject_questrelation` ON `gameobject_template`.`entry` = `gameobject_questrelation`.`id`
   WHERE `gameobject_questrelation`.`quest` = ?d', $data['entry']))
  {
    foreach ($src as $go) {localiseGameobject($go); r_objName($go);}
    return;
  }
  // Search item quest giver
  if ($src = $dDB->select("SELECT `entry`, `name`, `Quality` FROM `item_template` WHERE `startquest` = ?d", $data['entry']))
  {
    foreach ($src as $item) {localiseItem($item);r_itemName($item);}
    return;
  }
  echo '---(?)---';
}
function r_questReward($quest)
{
  global $lang;
  if ($quest['RewItemId1'] OR $quest['RewItemId2'] OR $quest['RewItemId3'] OR $quest['RewItemId4'])
  {
//     echo $lang['Rew_item'].'<br>';
    if ($quest['RewItemId1']) echo text_show_item($quest['RewItemId1'], 0, 'quest');
    if ($quest['RewItemId2']) echo $lang['item_sel_and'].text_show_item($quest['RewItemId2'], 0, 'quest');
    if ($quest['RewItemId3']) echo $lang['item_sel_and'].text_show_item($quest['RewItemId3'], 0, 'quest');
    if ($quest['RewItemId4']) echo $lang['item_sel_and'].text_show_item($quest['RewItemId4'], 0, 'quest');
    echo '<br>';
  }
  if ($quest['RewChoiceItemId1'] OR $quest['RewChoiceItemId2'] OR $quest['RewChoiceItemId3'] OR
      $quest['RewChoiceItemId4'] OR $quest['RewChoiceItemId5'] OR $quest['RewChoiceItemId6'])
  {
    echo $lang['Rew_select_item'].'<br>';
    if ($quest['RewChoiceItemId1']) echo text_show_item($quest['RewChoiceItemId1'], 0, 'quest');
    if ($quest['RewChoiceItemId2']) echo $lang['item_sel_or'].text_show_item($quest['RewChoiceItemId2'], 0, 'quest');
    if ($quest['RewChoiceItemId3']) echo $lang['item_sel_or'].text_show_item($quest['RewChoiceItemId3'], 0, 'quest');
    if ($quest['RewChoiceItemId4']) echo $lang['item_sel_or'].text_show_item($quest['RewChoiceItemId4'], 0, 'quest');
    if ($quest['RewChoiceItemId5']) echo $lang['item_sel_or'].text_show_item($quest['RewChoiceItemId5'], 0, 'quest');
    if ($quest['RewChoiceItemId6']) echo $lang['item_sel_or'].text_show_item($quest['RewChoiceItemId6'], 0, 'quest');
    echo "<br>";
  }
  if ($quest['RewSpell'] AND $quest['RewSpellCast'])
  {
    show_spell($quest['RewSpell'], 0, 'quest');
    echo '<br>';
  }
  if (!$quest['RewSpell'] AND $quest['RewSpellCast'])
  {
    show_spell($quest['RewSpellCast'], 0, 'quest');
    echo '<br>';
  }
  for ($i = 1; $i <= 5; $i++) 
  { 
 switch (ABS($quest['RewRepValueId'.$i])): 
  case 1:  $RepValueId[$i] = 10;   break; 
  case 2:  $RepValueId[$i] = 25;   break; 
  case 3:  $RepValueId[$i] = 75;   break; 
  case 4:  $RepValueId[$i] = 150;  break; 
  case 5:  $RepValueId[$i] = 250;  break; 
  case 6:  $RepValueId[$i] = 350;  break; 
  case 7:  $RepValueId[$i] = 500;  break; 
  case 8:  $RepValueId[$i] = 1000; break; 
  case 9:  $RepValueId[$i] = 5;    break; 
  default: $RepValueId[$i] = 0; 
 endswitch; 

 $quest_rate[$i] = getRepRewRate($quest['RewRepFaction'.$i]);

 if ($quest['RewRepValueId'.$i] < 0) 
  $RepValueId[$i] = -$RepValueId[$i]; 

 if ($quest['RewRepValue'.$i] && $quest['RewRepValueId'.$i]) 
  $quest['RewRepValue'.$i] = $quest['RewRepValue'.$i]/100; 

 if (!$quest['RewRepValue'.$i] && $quest['RewRepValueId'.$i]) 
  $quest['RewRepValue'.$i] = $RepValueId[$i]; 

 $quest['RewRepValue'.$i]=$quest['RewRepValue'.$i]*$quest_rate[$i];
  }

 if ($quest['RewRepFaction1'] AND !$quest['RewRepFaction2'] AND
    !$quest['RewRepFaction3'] AND !$quest['RewRepFaction4'] AND
    !$quest['RewRepFaction5'])
 {
  $spillover=getRepSpillover($quest['RewRepFaction1']);
  if ($spillover)
   foreach ($spillover as $faction)
   {
     if ($faction['faction1'])
     {
     $quest['RewRepFaction2']=$faction['faction1'];
     $quest['RewRepValue2']=$quest['RewRepValue1']*$faction['rate_1'];
     }
     if ($faction['faction2'])
     {
     $quest['RewRepFaction3']=$faction['faction2'];
     $quest['RewRepValue3']=$quest['RewRepValue1']*$faction['rate_2'];
     }
     if ($faction['faction3'])
     {
     $quest['RewRepFaction4']=$faction['faction3'];
     $quest['RewRepValue4']=$quest['RewRepValue1']*$faction['rate_3'];
     }
     if ($faction['faction4'])
     {
     $quest['RewRepFaction5']=$faction['faction4'];
     $quest['RewRepValue5']=$quest['RewRepValue1']*$faction['rate_4'];
     }
   }
 }

  if ($quest['RewRepFaction1'] && $quest['RewRepValue1'])echo getFactionName($quest['RewRepFaction1']).': '.$quest['RewRepValue1'].'<br>';
  if ($quest['RewRepFaction2'] && $quest['RewRepValue2'])echo getFactionName($quest['RewRepFaction2']).': '.$quest['RewRepValue2'].'<br>';
  if ($quest['RewRepFaction3'] && $quest['RewRepValue3'])echo getFactionName($quest['RewRepFaction3']).': '.$quest['RewRepValue3'].'<br>';
  if ($quest['RewRepFaction4'] && $quest['RewRepValue4'])echo getFactionName($quest['RewRepFaction4']).': '.$quest['RewRepValue4'].'<br>';
  if ($quest['RewRepFaction5'] && $quest['RewRepValue5'])echo getFactionName($quest['RewRepFaction5']).': '.$quest['RewRepValue5'].'<br>';
  if ($quest['RewMoneyMaxLevel'])
    echo $lang['Rew_XP'].' '.getQuestXPValue($quest).' xp<br>';
  if ($quest['RewOrReqMoney'])
    echo $lang['Rew_money'].' '.money($quest['RewOrReqMoney'], 7).'<br>';
}

$quest_reward_fields =
'`RewXPId`, `RewChoiceItemId1`, `RewChoiceItemId2`, `RewChoiceItemId3`, `RewChoiceItemId4`, `RewChoiceItemId5`, `RewChoiceItemId6`,
 `RewChoiceItemCount1`, `RewChoiceItemCount2`, `RewChoiceItemCount3`, `RewChoiceItemCount4`, `RewChoiceItemCount5`, `RewChoiceItemCount6`,
 `RewItemId1`, `RewItemId2`, `RewItemId3`, `RewItemId4`, `RewItemCount1`, `RewItemCount2`, `RewItemCount3`, `RewItemCount4`,
 `RewRepFaction1`, `RewRepFaction2`, `RewRepFaction3`, `RewRepFaction4`, `RewRepFaction5`,
 `RewRepValue1`, `RewRepValue2`, `RewRepValue3`, `RewRepValue4`, `RewRepValue5`,
 `RewRepValueId1`, `RewRepValueId2`, `RewRepValueId3`, `RewRepValueId4`, `RewRepValueId5`,
 `RewOrReqMoney`, `RewMoneyMaxLevel`, `RewSpell`, `RewSpellCast`, `RewMailTemplateId`, `RewMailDelaySecs`';

$quest_report = array(
'QUEST_REPORT_LEVEL'   =>array('class'=>'small','sort'=>'level',  'text'=>$lang['quest_lvl'],     'draw'=>'r_questLvl',   'sort_str'=>'`QuestLevel` DESC',      'fields'=>'`QuestLevel`' ),
'QUEST_REPORT_REQLEVEL'=>array('class'=>'small','sort'=>'req_lvl','text'=>$lang['quest_reqlvl'],  'draw'=>'r_questReqLvl','sort_str'=>'`MinLevel` DESC',        'fields'=>'`MinLevel`' ),
'QUEST_REPORT_NAME'    =>array('class'=>'left', 'sort'=>'name',   'text'=>$lang['quest_name'],    'draw'=>'r_questName',  'sort_str'=>'`Title`',                'fields'=>'`Title`, `ZoneOrSort`, `RequiredSkill`, `RequiredSkillValue`, `RequiredClasses`, `RequiredRaces`, `QuestFlags`, `SpecialFlags`'),
'QUEST_REPORT_GIVER'   =>array('class'=>'left', 'sort'=>'',       'text'=>$lang['quest_giver'],   'draw'=>'r_questGiver', 'sort_str'=>'',                       'fields'=>''),
'QUEST_REPORT_REWARD'  =>array('class'=>'full', 'sort'=>'reward', 'text'=>$lang['quest_rewards'], 'draw'=>'r_questReward','sort_str'=>'`RewMoneyMaxLevel` DESC','fields'=>&$quest_reward_fields),
// loot
'LOOT_REPORT_CHANCE'=>array('class'=>'', 'sort'=>'chance', 'text'=>$lang['loot_chance'], 'draw'=>'r_lootChance', 'sort_str'=>'ABS(`ChanceOrQuestChance`) DESC, `Title`', 'fields'=>'`ChanceOrQuestChance`, `mincountOrRef`'),
'LOOT_REPORT_REQ'   =>array('class'=>'', 'sort'=>'',       'text'=>$lang['loot_require'],'draw'=>'r_lootRequire','sort_str'=>'', 'fields'=>'`lootcondition`, `condition_value1`, `condition_value2`'),
);

define('QUEST_LOCALE_NAME',    0x01);
define('QUEST_LOCALE_ALL', NPC_LOCALE_NAME);

// Quest report class
class QuestReportGenerator extends ReportGenerator{
 var $dolocale = QUEST_LOCALE_ALL;
 function QuestReportGenerator($type='')
 {
  global $quest_report, $dDB;
  $this->db = &$dDB;
  $this->column_conf =&$quest_report;
  switch ($type){
   case 'go_giver':  $this->table = '(`quest_template` join `gameobject_questrelation` ON `quest_template`.`entry` = `gameobject_questrelation`.`quest`)';break;
   case 'go_take':   $this->table = '(`quest_template` join `gameobject_involvedrelation` ON `quest_template`.`entry` = `gameobject_involvedrelation`.`quest`)';break;
   case 'npc_giver': $this->table = '(`quest_template` join `creature_questrelation` ON `quest_template`.`entry` = `creature_questrelation`.`quest`)';break;
   case 'npc_take':  $this->table = '(`quest_template` join `creature_involvedrelation` ON `quest_template`.`entry` = `creature_involvedrelation`.`quest`)';break;
   case 'mail_loot': $this->table = '(`quest_template` join `mail_loot_template` ON `quest_template`.`RewMailTemplateId` = `mail_loot_template`.`entry`)';break;
   default:          $this->table = '`quest_template`';break;
  }
  $this->db_fields = '`quest_template`.`entry`';
 }
 function disableNameLocalisation() {$this->dolocale &= ~GO_LOCALE_NAME;}
 function localiseRequirest($locale, &$tables, &$fields, &$sort_str)
 {
  $tables.= ' LEFT JOIN `locales_quest` ON `quest_template`.`entry` = `locales_quest`.`entry`';
  if ($this->dolocale & QUEST_LOCALE_NAME)
  {
   $fields = str_replace('`Title`', '`Title`, `locales_quest`.`Title_loc'.$locale.'` AS `Title_loc`', $fields);
   $sort_str = str_replace('`Title`', '`Title_loc`, `Title`', $sort_str);
  }
 }
 // Create quest givers/take list by entry
 function getGiveTakeList($entry)
 {
  $this->do_requirest('`id` = ?d', $entry);
 }
 // Create quest list require GO for comlete
 function requireGO($entry)
 {
  $this->do_requirest('`ReqCreatureOrGOId1`= ?d OR `ReqCreatureOrGOId2`= ?d OR `ReqCreatureOrGOId3`= ?d OR `ReqCreatureOrGOId4`= ?d', -$entry, -$entry, -$entry, -$entry);
 }
 // Create quest list require GO for comlete
 function requireCreature($entry)
 {
  $this->do_requirest('`ReqCreatureOrGOId1`= ?d OR `ReqCreatureOrGOId2`= ?d OR `ReqCreatureOrGOId3`= ?d OR `ReqCreatureOrGOId4`= ?d', $entry, $entry, $entry, $entry);
 }
 function oneQuest($entry)
 {
  $this->do_requirest('`quest_template`.`entry` = ?d', $entry);
 }
 // Create quest list require item for comlete
 function requireItem($entry, $giveQuest)
 {
  $this->do_requirest('(`ReqItemId1`= ?d OR `ReqItemId2`= ?d OR `ReqItemId3`= ?d OR `ReqItemId4`= ?d OR `ReqItemId5`= ?d OR `ReqItemId6`= ?d OR `ReqSourceId1`= ?d OR `ReqSourceId2`= ?d OR `ReqSourceId3`= ?d OR `ReqSourceId4`= ?d) AND `quest_template`.`entry` <> ?d', $entry, $entry, $entry, $entry, $entry, $entry, $entry, $entry, $entry, $entry, $giveQuest);
 }
 // Create quest list prowide item at take
 function provideItem($entry, $giveQuest)
 {
  $this->do_requirest('`SrcItemId` = ?d AND `quest_template`.`entry` <> ?d', $entry, $giveQuest);
 }
 // Create quest list reward item
 function rewardItem($entry)
 {
  $this->do_requirest('`RewItemId1`= ?d OR `RewItemId2`= ?d OR `RewItemId3`= ?d OR `RewItemId4`= ?d OR
  `RewChoiceItemId1`= ?d OR`RewChoiceItemId2`= ?d OR `RewChoiceItemId3`= ?d OR `RewChoiceItemId4`= ?d OR `RewChoiceItemId5`= ?d OR  `RewChoiceItemId6`= ?d',
  $entry, $entry, $entry, $entry, $entry, $entry, $entry, $entry, $entry, $entry);
 }
 // Create quest list cast/reward spell
 function rewardSpell($entry)
 {
  $this->do_requirest('`RewSpell` = ?d OR `RewSpellCast` = ?d', $entry, $entry);
 }
 // Return quest list where exist faction reputation reward
 function rewardReputation($entry)
 {
  $this->do_requirest('`RewRepFaction1`= ?d OR `RewRepFaction2`= ?d OR `RewRepFaction3`= ?d OR `RewRepFaction4`= ?d OR `RewRepFaction5`= ?d', $entry, $entry, $entry, $entry, $entry);
 }
 // Mail loot
 function lootItem($entry)
 {
  $ref_loot =& getRefrenceItemLoot($entry);
  $this->do_requirest('(`item` = ?d  AND `mincountOrRef` > 0) { OR -`mincountOrRef` IN (?a) } GROUP BY `entry`', $entry, count($ref_loot)==0 ? DBSIMPLE_SKIP:array_keys($ref_loot));
  $this->remove_if_all_zero('lootcondition', 'LOOT_REPORT_REQ');
 }

}

//=================================================================
// Spell list report functions and methods
//=================================================================
function r_spellLevel($data) {echo $data['spellLevel'];}
function r_spellIcon($data)  {show_spell($data['id'], $data['SpellIconID']);}
function r_spellName($data)
{
  echo '<a href="?spell='.$data['id'].'">'.$data['SpellName'].'</a>';
  if ($data['Rank'])
    echo '<div class=srank>'.$data['Rank'].'</div>';
}
function r_spellRecipe($data)
{
  r_spellName($data);
  if ($skilname = getSkillNameForSpell($data['id']))
    echo '<div class=srank>&lt;'.$skilname.'&gt;</div>';
}
function r_spellSkill($data)
{
  global $lang;
  r_spellName($data);
  if ($data['RequiresSpellFocus'])
    echo '<div class=reqfocus>'.sprintf($lang['spell_req_focus'], getSpellFocusName($data['RequiresSpellFocus'], 2)).'</div>';
  if ($data['TotemCategory_1'] OR $data['TotemCategory_2'])
  {
    $text= '';
    if ($data['TotemCategory_1']) $text = getTotemCategory($data['TotemCategory_1']);
    if ($data['TotemCategory_2']) $text.= ", ".getTotemCategory($data['TotemCategory_2']);
    echo '<div class=reqfocus>'.sprintf($lang['spell_req_totem'], $text).'</div>';
  }
}
function r_spellSchool($data){echo getSpellSchool($data['SchoolMask']);}
function r_spellReagents($data)
{
  echo '<table class=reagents><tr>';
  for ($i=1;$i<9;$i++)
    if ($data['Reagent_'.$i])
      echo '<td>'.text_show_item($data['Reagent_'.$i],0,'reagent').'<br>x'.$data['ReagentCount_'.$i].'</td>';
  echo "</tr></table>";
}
function r_spellCreate($data)
{
  if ($data['EffectItemType_1'] == 0 AND $data['EffectItemType_2'] == 0 AND $data['EffectItemType_3'] == 0)
    return 0;
  if ($data['EffectItemType_2'] == 0 AND $data['EffectItemType_3'] == 0)
    echo text_show_item($data['EffectItemType_1']);
  else
  {
    echo '<table class=reagents><tr>';
    for ($i=1;$i<4;$i++)
      if ($data['EffectItemType_'.$i])
        echo '<td>'.text_show_item($data['EffectItemType_'.$i], 0, "reagent").($data['EffectBasePoints_'.$i]>0?'<br>x&nbsp;'.($data['EffectBasePoints_'.$i]+1):'').'</td>';
    echo '</tr></table>';
  }
  return 1;
}
function r_spellEquiped($data)
{
 echo $data['EquippedItemClass'].'<br />';
 echo $data['EquippedItemSubClassMask'].'<br />';
 echo $data['EquippedItemInventoryTypeMask'].'<br />';
}
function r_skillLevel($data) {echo $data['min_value'];}
function r_skillIcon($data)
{
  if ($data['EffectItemType_1'] OR $data['EffectItemType_2'] OR $data['EffectItemType_3'])
    r_spellCreate($data);
  else
    r_spellIcon($data);
}
$reagents= '`Reagent_1`, `Reagent_2`, `Reagent_3`, `Reagent_4`, `Reagent_5`, `Reagent_6`, `Reagent_7`, `Reagent_8`,
`ReagentCount_1`, `ReagentCount_2`, `ReagentCount_3`, `ReagentCount_4`, `ReagentCount_5`, `ReagentCount_6`, `ReagentCount_7`, `ReagentCount_8`';
// Spell report generator config
$spell_report = array(
'SPELL_REPORT_LEVEL' =>array('class'=>'small','sort'=>'level', 'text'=>$lang['spell_level'],  'draw'=>'r_spellLevel',  'sort_str'=>'`spellLevel`',     'fields'=>'`spellLevel`' ),
'SPELL_REPORT_ICON'  =>array('class'=>'s_ico','sort'=>'icon',  'text'=>'',                    'draw'=>'r_spellIcon',   'sort_str'=>'`SpellIconID`',    'fields'=>'`SpellIconID`' ),
'SPELL_REPORT_NAME'  =>array('class'=>'left', 'sort'=>'name',  'text'=>$lang['spell_name'],   'draw'=>'r_spellName',   'sort_str'=>'`SpellName`, `id`','fields'=>'`SpellName`, `Rank`' ),
'SPELL_REPORT_RECIPE'=>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['spell_name'],    'draw'=>'r_spellRecipe', 'sort_str'=>'`SpellName`, `id`','fields'=>'`SpellName`, `Rank`, `RequiresSpellFocus`, `TotemCategory_1`, `TotemCategory_2`'),
'SPELL_REPORT_SCHOOL'=>array('class'=>'',     'sort'=>'school','text'=>$lang['spell_school'], 'draw'=>'r_spellSchool', 'sort_str'=>'`SchoolMask`',     'fields'=>'`SchoolMask`' ),
'SPELL_REPORT_REAGENTS'=>array('class'=>'reag','sort'=>'',     'text'=>$lang['spell_reagent'],'draw'=>'r_spellReagents','sort_str'=>'',                'fields'=>&$reagents),
'SPELL_REPORT_CREATE'=>array('class'=>'skill','sort'=>'',      'text'=>$lang['spell_create'], 'draw'=>'r_spellCreate', 'sort_str'=>'',                 'fields'=>'`EffectItemType_1`, `EffectItemType_2`, `EffectItemType_3`, `EffectBasePoints_1`, `EffectBasePoints_2`, `EffectBasePoints_3`'),
'SPELL_REPORT_EQUIP'=>array('class'=>'left',  'sort'=>'',      'text'=>'',                    'draw'=>'r_spellEquiped','sort_str'=>'',                 'fields'=>'`EquippedItemClass`, `EquippedItemSubClassMask`, `EquippedItemInventoryTypeMask`'),
// Skill
'SKILL_REPORT_LEVEL' =>array('class'=>'small','sort'=>'skill_lvl', 'text'=>$lang['spell_level'],'draw'=>'r_skillLevel', 'sort_str'=>'`min_value`, `spellLevel`, `SpellName`, `id`',  'fields'=>'`min_value`'),
'SKILL_REPORT_ICON'  =>array('class'=>'skill','sort'=>'skill',     'text'=>'',                  'draw'=>'r_skillIcon',  'sort_str'=>'`SpellIconID`',    'fields'=>'`SpellIconID`, `EffectItemType_1`, `EffectItemType_2`, `EffectItemType_3`, `EffectBasePoints_1`, `EffectBasePoints_2`, `EffectBasePoints_3`' ),
'SKILL_REPORT_NAME'  =>array('class'=>'left', 'sort'=>'skill_name','text'=>$lang['spell_name'], 'draw'=>'r_spellSkill', 'sort_str'=>'`SpellName`, `id`','fields'=>'`SpellName`, `Rank`, `RequiresSpellFocus`, `TotemCategory_1`, `TotemCategory_2`'),
);

// Spell report class
class SpellReportGenerator extends ReportGenerator{
 function SpellReportGenerator($type='')
 {
  global $spell_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$spell_report;
  switch ($type){
   case 'skill': $this->table = '(`wowd_spell` join `wowd_skill_line_ability` ON `wowd_skill_line_ability`.`spellId` =`wowd_spell`.`id`)';break;
   default:      $this->table = '`wowd_spell`';break;
  }
  $this->db_fields = '`wowd_spell`.`id`';
 }
 function summonGO($entry)
 {
  $effList = array(50, 76, 104, 105, 106, 107);
  $this->do_requirest(
  '(`EffectMiscValue_1` = ?d AND `Effect_1` IN (?a)) OR
   (`EffectMiscValue_2` = ?d AND `Effect_2` IN (?a)) OR
   (`EffectMiscValue_3` = ?d AND `Effect_3` IN (?a))', $entry, $effList, $entry, $effList, $entry, $effList);
 }
 function summonCreature($entry)
 {
  $effList = array(28, 56, 90, 93, 134);
  $this->do_requirest(
  '(`EffectMiscValue_1` = ?d AND `Effect_1` IN (?a)) OR
   (`EffectMiscValue_2` = ?d AND `Effect_2` IN (?a)) OR
   (`EffectMiscValue_3` = ?d AND `Effect_3` IN (?a))', $entry, $effList, $entry, $effList, $entry, $effList);
 }
 // List of spells use item as reagent
 function useRegent($entry)
 {
  $this->do_requirest('`Reagent_1` = ?d OR `Reagent_2`=?d OR `Reagent_3`=?d OR `Reagent_4`=?d OR `Reagent_5`=?d OR `Reagent_6`=?d OR `Reagent_7`=?d OR `Reagent_8`=?d', $entry, $entry, $entry, $entry, $entry, $entry, $entry, $entry);
  $create = 0;
  foreach($this->data_array as &$data)
    if ($data['EffectItemType_1'] OR $data['EffectItemType_2'] OR $data['EffectItemType_3'])
      $create = 1;
  if (!$create) $this->removeField('SPELL_REPORT_CREATE');
 }
 // List of spells create this item
 function createItem($entry)
 {
  $eff_list = array(107, 108, 109, 112);
  $this->do_requirest(
  '(`EffectItemType_1` = ?d AND EffectApplyAuraName_1 NOT IN (?a)) OR
   (`EffectItemType_2` = ?d AND EffectApplyAuraName_1 NOT IN (?a)) OR
   (`EffectItemType_3` = ?d AND EffectApplyAuraName_1 NOT IN (?a))', $entry, $eff_list, $entry, $eff_list, $entry, $eff_list);
 }
 // List os spells give faction reputation
 function giveReputation($entry)
 {
  $this->do_requirest(
  '(`EffectMiscValue_1` = ?d AND `Effect_1` = 103) OR
   (`EffectMiscValue_2` = ?d AND `Effect_2` = 103) OR
   (`EffectMiscValue_3` = ?d AND `Effect_3` = 103)', $entry, $entry, $entry);
 }
 function triggerFromSpells($entry)
 {
  $this->do_requirest(
  '`EffectTriggerSpell_1` = ?d OR
   `EffectTriggerSpell_2` = ?d OR
   `EffectTriggerSpell_3` = ?d', $entry, $entry, $entry);
 }
 function enchantFromSpells($entry)
 {
  $effList = array(53, 54, 92);
  $this->do_requirest(
  '(`EffectMiscValue_1` = ?d AND `Effect_1` IN (?a)) OR
   (`EffectMiscValue_2` = ?d AND `Effect_2` IN (?a)) OR
   (`EffectMiscValue_3` = ?d AND `Effect_3` IN (?a))', $entry, $effList, $entry, $effList, $entry, $effList);
 }
 function affectedBySpells($family, $maskA, $maskB, $maskC)
 {
  $this->do_requirest(
  '`SpellFamilyName` = ?d AND
   (
     (`EffectApplyAuraName_1` IN (107, 108) AND ( (`EffectSpellClassMaskA_1` & ?d) OR (`EffectSpellClassMaskA_2` & ?d) OR (`EffectSpellClassMaskA_3` & ?d) ) ) OR
     (`EffectApplyAuraName_2` IN (107, 108) AND ( (`EffectSpellClassMaskB_1` & ?d) OR (`EffectSpellClassMaskB_2` & ?d) OR (`EffectSpellClassMaskB_3` & ?d) ) ) OR
     (`EffectApplyAuraName_3` IN (107, 108) AND ( (`EffectSpellClassMaskC_1` & ?d) OR (`EffectSpellClassMaskC_2` & ?d) OR (`EffectSpellClassMaskC_3` & ?d) ) )
   )', $family, $maskA, $maskB, $maskC, $maskA, $maskB, $maskC, $maskA, $maskB, $maskC);
 }
 function castByCreature($creature)
 {
  global $wDB, $dDB;
  $spell_list = array();
  // By creature fields
  for ($i=1;$i<5;$i++) if ($creature['spell'.$i]) $spell_list[] = $creature['spell'.$i];
  // By event AI table
  for ($i=1;$i<=3;$i++)
    $spell_list = array_merge($spell_list, $dDB->selectCol('SELECT `action1_param'.$i.'` as `id` FROM `creature_ai_scripts` WHERE `creature_id` = ?d AND `action'.$i.'_type` = 11', $creature['entry']));
  if (count($spell_list))
    $this->do_requirest('`id` IN (?a)', array_unique($spell_list));
 }
 function doSkillList($skill)
 {
    if (isset($_REQUEST['guid']))
    {
       $spells = getPlayerSpells($_REQUEST['guid']);
       $this->rowCallback = 'playerSpellCallback';
    }
    $this->do_requirest('`skillId` = ?d', $skill);
 }
 function lootItem($entry)
 {
  global $dDB;
  $ref_loot =& getRefrenceItemLoot($entry);
  $spells = $dDB->select("SELECT `entry` AS ARRAY_KEY, `ChanceOrQuestChance`, `mincountOrRef` FROM `spell_loot_template` WHERE (`item` = ?d  AND `mincountOrRef` > 0) { OR -`mincountOrRef` IN (?a) }", $entry, count($ref_loot)==0 ? DBSIMPLE_SKIP:array_keys($ref_loot));
  if ($spells)
      $this->do_requirest('`id` IN (?a)', array_keys($spells));
 }
}

//=================================================================
// Glyph list report functions and methods
//=================================================================
function r_glyphId($data)   {echo $data['id'];}
function r_glyphName($data) {$spell=getSpell($data['SpellId']); echo $spell['SpellName'];}
function r_glyphIcon($data) {echo '<img src="'.getSpellIcon($data['iconId']).'">';}

$glyph_report = array(
'GLYPH_REPORT_ID'  =>array('class'=>'small','sort'=>'','text'=>$lang['glyph_id'  ], 'draw'=>'r_glyphId',  'sort_str'=>'', 'fields'=>'' ),
'GLYPH_REPORT_NAME'=>array('class'=>'left', 'sort'=>'','text'=>$lang['glyph_name'], 'draw'=>'r_glyphName','sort_str'=>'', 'fields'=>'`SpellId`' ),
'GLYPH_REPORT_ICON'=>array('class'=>'i_ico','sort'=>'','text'=>'',                  'draw'=>'r_glyphIcon','sort_str'=>'', 'fields'=>'`iconId`'),
);

class GlyphReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function GlyphReportGenerator($type='')
 {
  global $glyph_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$glyph_report;
  $this->table = '`wowd_glyphproperties`';
  $this->db_fields = '`id`';
 }
 function useSpell($entry)
 {
  $this->do_requirest('`SpellId` = ?d', $entry);
 }
}

//=================================================================
// Random Suffix list report functions and methods
//=================================================================
function r_rndSuffId($data)   {echo $data['id'];}
function r_rndSuffName($data) {echo '&nbsp;... '.$data['name'];}
function r_rndSuffDetail($data)
{
  for ($j=1;$j<=3;$j++)
    if ($data['EnchantID_'.$j])
      echo str_ireplace('$i', round($data['Prefix_'.$j]/100, 2).'%', getEnchantmentDesc($data['EnchantID_'.$j]))."<br>";
}

$rsuff_report = array(
'RSUFF_REPORT_ID'      =>array('class'=>'small','sort'=>'',     'text'=>$lang['rand_enchant_id'  ],   'draw'=>'r_rndSuffId',    'sort_str'=>'',       'fields'=>'' ),
'RSUFF_REPORT_NAME'    =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['rand_enchant_name'],   'draw'=>'r_rndSuffName',  'sort_str'=>'`name`', 'fields'=>'`name`' ),
'RSUFF_REPORT_ENCHANTS'=>array('class'=>'left', 'sort'=>'',     'text'=>$lang['rand_enchant_details'],'draw'=>'r_rndSuffDetail','sort_str'=>'',       'fields'=>'`Prefix_1`, `Prefix_2`, `Prefix_3`, `EnchantID_1`, `EnchantID_2`, `EnchantID_3`'),
);

class RandomSuffixReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function RandomSuffixReportGenerator($type='')
 {
  global $rsuff_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$rsuff_report;
  $this->table = '`wowd_item_random_suffix`';
  $this->db_fields = '`id`';
 }
 function enchantFrom($entry)
 {
  $this->do_requirest('`EnchantID_1` = ?d OR `EnchantID_2` = ?d OR `EnchantID_3` = ?d', $entry, $entry, $entry);
 }
}

//=================================================================
// Random Suffix list report functions and methods
//=================================================================
function r_rndPropId($data)   {echo $data['id'];}
function r_rndPropName($data) {echo '&nbsp;... '.$data['name'];}
function r_rndPropDetail($data)
{
  for ($j=1;$j<=5;$j++)
    if ($data['EnchantID_'.$j])
      echo getEnchantmentDesc($data['EnchantID_'.$j])."<br>";
}

$rprop_report = array(
'RPROP_REPORT_ID'      =>array('class'=>'small','sort'=>'',     'text'=>$lang['rand_enchant_id'  ],   'draw'=>'r_rndPropId',    'sort_str'=>'',       'fields'=>'' ),
'RPROP_REPORT_NAME'    =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['rand_enchant_name'],   'draw'=>'r_rndPropName',  'sort_str'=>'`name`', 'fields'=>'`name`' ),
'RPROP_REPORT_ENCHANTS'=>array('class'=>'left', 'sort'=>'',     'text'=>$lang['rand_enchant_details'],'draw'=>'r_rndPropDetail','sort_str'=>'',       'fields'=>'`EnchantID_1`, `EnchantID_2`, `EnchantID_3`, `EnchantID_4`, `EnchantID_5`'),
);

class RandomPropetyReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function RandomPropetyReportGenerator($type='')
 {
  global $rprop_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$rprop_report;
  $this->table = '`wowd_item_random_propety`';
  $this->db_fields = '`id`';
 }
 function enchantFrom($entry)
 {
  $this->do_requirest('`EnchantID_1` = ?d OR `EnchantID_2` = ?d OR `EnchantID_3` = ?d OR `EnchantID_4` = ?d OR `EnchantID_5` = ?d', $entry, $entry, $entry, $entry, $entry);
 }
}

//=================================================================
// Lock list report functions and methods
//=================================================================
function r_LockId($data)   {echo $data['id'];}
function r_LockKeys($data)
{
  for ($i=0;$i<8;$i++)
  {
    switch ($data['keytype_'.$i]){
     case 0: continue;
     case 1: echo text_show_item($data['key_'.$i], 0, 'cost').($data['reqskill_'.$i]?' ('.$data['reqskill_'.$i].')':'').'<br>';break;
     case 2: echo getLockType($data['key_'.$i]).($data['reqskill_'.$i]?' ('.$data['reqskill_'.$i].')':'').'<br>';break;
    }
  }
}
function r_LockProvide($data)
{
  global $lang, $dDB;
  if ($items = $dDB->select('SELECT `entry`, `Quality`, `displayid`, `name` FROM `item_template` WHERE `lockid` = ?d', $data['id']))
    foreach ($items as $i)
      show_item($i['entry'], $i['displayid'], 'sell');

  $data0 = array(GAMEOBJECT_TYPE_QUESTGIVER,GAMEOBJECT_TYPE_CHEST,GAMEOBJECT_TYPE_TRAP,GAMEOBJECT_TYPE_GOOBER,GAMEOBJECT_TYPE_CAMERA);
  $data1 = array(GAMEOBJECT_TYPE_DOOR, GAMEOBJECT_TYPE_BUTTON);
  if ($go_list = $dDB->select('SELECT `entry`,`name` FROM `gameobject_template` WHERE (`type` IN (?a) AND `data0` = ?d) OR (`type` IN (?a) AND `data1` = ?d)', $data0, $data['id'], $data1, $data['id']))
  foreach ($go_list as $go)
  {
    localiseGameobject($go);
    r_objName($go);echo '<br>';
  }
  if (count($items) + count($go_list) == 0)
     echo $lang['no_found'];
}

$lock_report = array(
'LOCK_REPORT_ID'  =>array('class'=>'small','sort'=>'', 'text'=>$lang['lock_id'],  'draw'=>'r_LockId',     'sort_str'=>'', 'fields'=>''),
'LOCK_REPORT_KEY' =>array('class'=>'',     'sort'=>'', 'text'=>$lang['lock_keys'],'draw'=>'r_LockKeys',   'sort_str'=>'', 'fields'=>''),
'LOCK_REPORT_HAVE'=>array('class'=>'',     'sort'=>'', 'text'=>$lang['locked_list'],'draw'=>'r_LockProvide','sort_str'=>'', 'fields'=>''),
);

class LockReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function LockReportGenerator($type='')
 {
  global $lock_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$lock_report;
  $this->table = '`wowd_lock`';
  $this->db_fields = '*';
 }
 function haveItemAsKey($entry)
 {
  $this->do_requirest(
  '(`keytype_0` = 1 AND `key_0` = ?d) OR
   (`keytype_1` = 1 AND `key_1` = ?d) OR
   (`keytype_2` = 1 AND `key_2` = ?d) OR
   (`keytype_3` = 1 AND `key_3` = ?d) OR
   (`keytype_4` = 1 AND `key_4` = ?d)', $entry, $entry, $entry, $entry, $entry);
 }
}

//=================================================================
// Extend cost list report functions and methods
//=================================================================
function r_excostId($data) {echo $data['id'];}
function r_excostCost($data, $side = 0)
{
  if ($side) $side = "images/honor_horde.png";
  else       $side = "images/honor_alliance.png";
  $str='<div class=ex_cost>';
  if ($data['reqhonorpoints']) $str.= $data['reqhonorpoints'].'x<img class=cost src='.$side.'>';
  if ($data['reqarenapoints']) $str.= $data['reqarenapoints'].'x<img class=cost src=images/arena_points.png>';
  for ($i=1;$i<6;$i++)
    if ($data['reqitem_'.$i]) $str.= $data['reqitemcount_'.$i].' x '.text_show_item($data['reqitem_'.$i], 0, 'cost');
  echo $str.'</div>';
}

function r_excostItem($data)
{
  global $lang, $dDB;
  if ($items = $dDB->selectCol("SELECT `item` FROM `npc_vendor` WHERE ExtendedCost = ?d GROUP BY `item`", $data['id']))
    foreach ($items as $itemid)
      show_item($itemid, 0, "sell");
  else
    echo $lang['no_found'];
}
$excost_report = array(
'EXCOST_REPORT_ID'  =>array('class'=>'small','sort'=>'id',   'text'=>$lang['excost_id'],   'draw'=>'r_excostId',  'sort_str'=>'`id`', 'fields'=>''),
'EXCOST_REPORT_COST'=>array('class'=>'small','sort'=>'cost', 'text'=>$lang['excost_cost'], 'draw'=>'r_excostCost','sort_str'=>'`reqitemcount_1`,`reqitemcount_2`, `reqitemcount_3`', 'fields'=>''),
'EXCOST_REPORT_ITEM'=>array('class'=>'',     'sort'=>'',     'text'=>$lang['excost_items'],'draw'=>'r_excostItem','sort_str'=>'',     'fields'=>''),
);

class ExCostReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function ExCostReportGenerator($type='')
 {
  global $excost_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$excost_report;
  $this->table = '`wowd_item_ex_cost`';
  $this->db_fields = '*';
 }
 function useItemAsCost($entry)
 {
  $this->do_requirest(
  '`reqitem_1` = ?d OR
   `reqitem_2` = ?d OR
   `reqitem_3` = ?d OR
   `reqitem_4` = ?d OR
   `reqitem_5` = ?d', $entry, $entry, $entry, $entry, $entry);
 }
}

	//=================================================================
	// Item set list report functions and methods
	//=================================================================
	function r_set_id($data)
		{
			echo $data['id'];
		}

	function r_set_name($data)
		{
			echo"<a href='?itemset=".$data['id']."'>".$data['name']."</a>";
		}
	function r_set_items($data)
		{
  			for($i=1;$i<18;$i++)
				{
					if ($set_item = $data['item_'.$i])
						{
							echo"&nbsp;".text_show_item($set_item)."&nbsp;";
						}
				}
		}

	function r_set_spells($data)
		{
			for($i=1; $i<9; $i++)
				{
					if ($spellID = $data['spell_'.$i])
						{
							echo"<a class='spell' href='?spell=".$spellID."'>(".$data['count_'.$i].") ".get_spell_details($spellID)."</a><br>";
						}
				}
		}

	function r_setClass($data){}
	function r_setLevel($data){}

$itemset_report = array(
'SET_REPORT_ID'   =>array('class'=>'small','sort'=>'id',   'text'=>$lang['set_id'],    'draw'=>'r_setId',    'sort_str'=>'`id`',  'fields'=>''),
'SET_REPORT_NAME' =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['set_name'],  'draw'=>'r_setName',  'sort_str'=>'`name`','fields'=>''),
'SET_REPORT_ITEM' =>array('class'=>'iset', 'sort'=>'',     'text'=>$lang['set_items'], 'draw'=>'r_setItems', 'sort_str'=>'',      'fields'=>''),
'SET_REPORT_SPELL'=>array('class'=>'',     'sort'=>'',     'text'=>$lang['set_spells'],'draw'=>'r_setSpells','sort_str'=>'',      'fields'=>''),
// Not supported yet
'SET_REPORT_CLASS'=>array('class'=>'',     'sort'=>'class','text'=>$lang['set_class'], 'draw'=>'r_setClass', 'sort_str'=>'',      'fields'=>''),
'SET_REPORT_LEVEL'=>array('class'=>'',     'sort'=>'level','text'=>$lang['set_level'], 'draw'=>'r_setLevel', 'sort_str'=>'',      'fields'=>''),
);

class ItemSetReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function ItemSetReportGenerator($type='')
 {
  global $itemset_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$itemset_report;
  $this->table = '`wowd_itemset`';
  $this->db_fields = '*';
 }
 function useSpell($entry)
 {
  $this->do_requirest(
  '`spell_1` = ?d OR `spell_2` = ?d OR `spell_3` = ?d OR `spell_4` = ?d OR
   `spell_5` = ?d OR `spell_6` = ?d OR `spell_7` = ?d OR `spell_8` = ?d', $entry, $entry, $entry, $entry, $entry,  $entry, $entry, $entry);
 }
}

//=================================================================
// Faction list report functions and methods
//=================================================================
function r_factionId($data)    {echo $data['id'];}
function r_factionName($data)  {echo '<a href="?faction='.$data['id'].'">'.$data['name'].'</a>';}
function r_factionDetail($data){echo $data['details'];}

$faction_report = array(
'FACTION_REPORT_ID'      =>array('class'=>'small','sort'=>'',     'text'=>$lang['faction_id'  ],   'draw'=>'r_factionId',    'sort_str'=>'',       'fields'=>'' ),
'FACTION_REPORT_NAME'    =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['faction_name'],   'draw'=>'r_factionName',  'sort_str'=>'`name`', 'fields'=>'`name`' ),
'FACTION_REPORT_DETAILS' =>array('class'=>'left', 'sort'=>'',     'text'=>$lang['faction_details'],'draw'=>'r_factionDetail','sort_str'=>'',       'fields'=>'`details`'),
);

class FactionReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function FactionReportGenerator($type='')
 {
  global $faction_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$faction_report;
  $this->table = '`wowd_faction`';
  $this->db_fields = '`id`';
 }
}

//=================================================================
// Enchants list report functions and methods
//=================================================================
function r_enchId($data) {echo $data['id'];}
function r_enchName($data) {echo '<a href="?enchant='.$data['id'].'">'.$data['description'].'</a>';}
function r_enchGem($data) { if ($data['GemID']) echo text_show_item($data['GemID']);}
$enchants_report = array(
'ENCH_REPORT_ID'   =>array('class'=>'small','sort'=>'id',   'text'=>$lang['enchant_id'],  'draw'=>'r_enchId',   'sort_str'=>'`id`',         'fields'=>''),
'ENCH_REPORT_NAME' =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['enchant_name'],'draw'=>'r_enchName', 'sort_str'=>'`description`','fields'=>'`description`'),
'ENCH_REPORT_GEM'  =>array('class'=>'small','sort'=>'',     'text'=>'',                   'draw'=>'r_enchGem',  'sort_str'=>'',             'fields'=>'`GemID`'),
);

class EnchantReportGenerator extends ReportGenerator{
 // Database depend requirest generator
 // Select only reuire for report fields from database
 function EnchantReportGenerator($type='')
 {
  global $enchants_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$enchants_report;
  $this->table = '`wowd_item_enchantment`';
  $this->db_fields = '`id`';
 }
 function useSpell($entry)
 {
  $this->do_requirest('`spellid_1` = ?d OR `spellid_2` = ?d OR `spellid_3` = ?d', $entry, $entry, $entry);
  $this->remove_if_all_zero('GemID', 'ENCH_REPORT_GEM');
 }
}

	//=================================================================
	// Talents list report functions and methods
	//=================================================================
	function r_talent_id($data)   { echo $data['TalentTab']; }
	function r_talent_name($data) { echo get_talent_name($data['TalentTab']); }
	$talent_report = array(
	'TALENT_REPORT_ID'   =>array('class'=>'small','sort'=>'', 'text'=>$lang['talent_id'],  'draw'=>'r_talentId',   'sort_str'=>'', 'fields'=>'`TalentTab`'),
	'TALENT_REPORT_NAME' =>array('class'=>'left', 'sort'=>'', 'text'=>$lang['talent_name'],'draw'=>'r_talentName', 'sort_str'=>'','fields'=>'`TalentTab`'),
	);

	class talent_report_generator extends ReportGenerator
		{
			// Database depend requirest generator
			// Select only reuire for report fields from database
			function Talent_report_generator($type='')
				{
					global $talent_report;
					$this->db = &selectdb("wcf");
					$this->column_conf =&$talent_report;
					$this->table = DB_TALENTS;
					$this->db_fields = '`TalentID`';
				}

			function use_spell($entry)
				{
					//$this->do_requirest('`Rank_1`=$entry OR `Rank_2`=$entry OR `Rank_3`=$entry OR `Rank_4`=$entry OR `Rank_5`=$entry');
					$this->do_requirest('`Rank_1` = ?d OR `Rank_2` = ?d OR `Rank_3` = ?d OR `Rank_4` = ?d OR `Rank_5` = ?d', $entry, $entry, $entry, $entry, $entry);
				}
		}

//=================================================================
// Zones list report functions and methods
//=================================================================
function r_zoneId($data) {echo $data['id'];}
function r_zoneName($data) {echo '<a href="?zone='.$data['id'].'">'.$data['name'].'</a>';}
$zone_report = array(
'ZONE_REPORT_ID'   =>array('class'=>'small','sort'=>'id',   'text'=>$lang['zone_id'],  'draw'=>'r_zoneId',   'sort_str'=>'`id`',  'fields'=>''),
'ZONE_REPORT_NAME' =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['zone_name'],'draw'=>'r_zoneName', 'sort_str'=>'`name`','fields'=>'`name`'),
);

class ZoneReportGenerator extends ReportGenerator{
 function ZoneReportGenerator($type='')
 {
  global $zone_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$zone_report;
  $this->table = '`wowd_zones`';
  $this->db_fields = '`id`';
 }
 function parentZone($entry)
 {
  $this->do_requirest('`id` = ?d', $entry);
 }
 function subZones($entry)
 {
  $this->do_requirest('`zone_id` = ?d', $entry);
 }
}

//=================================================================
// Areatrigger teleport list report functions and methods
//=================================================================
function r_atId($data) {echo $data['id'];}
function r_atName($data) {echo $data['name'];}
function r_atReq($data)
{
  global $lang;
  if ($data['required_level'])
    echo 'Req level: '.$data['required_level'].'<br>';

  if ($data['required_item'] OR $data['required_item2'])
  {
    echo 'Req items:<br>';
    if ($data['required_item'])  echo text_show_item($data['required_item'], 0, 'quest');
    if ($data['required_item2']) echo $lang['item_sel_and'].text_show_item($data['required_item2'], 0, 'quest');
    echo '<br>';
  }
  if ($data['heroic_key'] OR $data['heroic_key2'])
  {
    echo 'Heroic key:<br>';
    if ($data['heroic_key'])  echo text_show_item($data['heroic_key'], 0, 'quest');
    if ($data['heroic_key2']) echo $lang['item_sel_and'].text_show_item($data['heroic_key2'], 0, 'quest');
    echo '<br>';
  }

}
$at_report = array(
'AT_REPORT_ID'   =>array('class'=>'small','sort'=>'id',   'text'=>$lang['at_id'],  'draw'=>'r_atId',   'sort_str'=>'`id`',  'fields'=>''),
'AT_REPORT_NAME' =>array('class'=>'left', 'sort'=>'name', 'text'=>$lang['at_name'],'draw'=>'r_atName', 'sort_str'=>'`name`','fields'=>'`name`'),
'AT_REPORT_REQ'  =>array('class'=>'left', 'sort'=>'',     'text'=>$lang['at_req'], 'draw'=>'r_atReq',  'sort_str'=>'',      'fields'=>'`required_level`, `required_item`, `required_item2`, `heroic_key`, `heroic_key2`, `required_quest_done`, `required_quest_done_heroic`'),
);

class AreaTriggerReportGenerator extends ReportGenerator{
 function AreaTriggerReportGenerator($type='')
 {
  global $at_report, $wDB;
  $this->db = &$wDB;
  $this->column_conf =&$at_report;
  $this->table = '`areatrigger_teleport`';
  $this->db_fields = '*';
 }
 function onMap($entry)
 {
  $this->do_requirest('`target_map` = ?d', $entry);
 }
 function onArea($area_data)
 {
  $this->do_requirest('`target_map` = ?d AND `target_position_x` > ?d AND `target_position_x` < ?d AND `target_position_y` > ?d AND `target_position_y` < ?d', $area_data[0], $area_data[5], $area_data[4], $area_data[3], $area_data[2]);
 }
}

//=================================================================
// Players list report functions and methods
//=================================================================
function r_plGUID($data)  {echo $data['guid'];}
function r_plName($data)  {echo '<a href=?player='.$data['guid'].'>'.$data['name'].'</a>';}
function r_plRace($data)  {echo '<img src="'.getRaceImage($data['race'],$data['gender']).'">';}
function r_plClass($data) {echo '<img src="'.getClassImage($data['class']).'">';}
function r_plFaction($data){echo '<img src="'.getFactionImage($data['race']).'">';}
function r_plLevel($data) {echo $data['level'];}
function r_plPos($data)
{
   global $config;
   $map_name = getMapNameFromPoint($data['map'], $data['position_x'], $data['position_y'], $data['position_z']);
   $area_name = getAreaNameFromPoint($data['map'], $data['position_x'], $data['position_y'], $data['position_z']);
   $extra_name = "";
   if ($area_name)
   {
     $extra_name = "<br><font size=-2>".$map_name."</font>";
     $map_name = "&bdquo;".str_replace(' ','&nbsp;', $area_name)."&ldquo;";
   }
   else
     $map_name = "&bdquo;".str_replace(' ','&nbsp;',$map_name)."&ldquo;";

   if ($config['show_map_ptr'])
      $map_name = "<a href=\"?map&point=$data[map]:$data[position_x]:$data[position_y]:$data[position_z]\">".$map_name."</a>";
   echo $map_name.$extra_name;
}
function r_plGuildNote($data) {echo $data['pnote']."<br>".$data['offnote'];}
function r_plGuildRank($data)
{
   // Получаем названия рангов в гильдии
   $rank  = getGuildRankList($data['guildid']);
   echo @$rank[$data['rank']]['rname'];
}

function r_plItem($data){show_item_by_data(explode(' ',$data['item_data']));}

$pl_report = array(
'PL_REPORT_GUID'   =>array('class'=>'small', 'sort'=>'id',    'text'=>$lang['pl_guid'],   'draw'=>'r_plGUID',   'sort_str'=>'`id`',    'fields'=>''),
'PL_REPORT_NAME'   =>array('class'=>'player','sort'=>'name',  'text'=>$lang['pl_name'],   'draw'=>'r_plName',   'sort_str'=>'`name`',  'fields'=>'`name`'),
'PL_REPORT_RACE'   =>array('class'=>'i_ico', 'sort'=>'race',  'text'=>$lang['pl_race'],   'draw'=>'r_plRace',   'sort_str'=>'`race`',  'fields'=>'`race`, `gender`'),
'PL_REPORT_CLASS'  =>array('class'=>'i_ico', 'sort'=>'class', 'text'=>$lang['pl_class'],  'draw'=>'r_plClass',  'sort_str'=>'`class`', 'fields'=>'`class`'),
'PL_REPORT_FACTION'=>array('class'=>'i_ico', 'sort'=>'',      'text'=>'',                 'draw'=>'r_plFaction','sort_str'=>'',        'fields'=>'`race`'),
'PL_REPORT_LEVEL'  =>array('class'=>'small', 'sort'=>'level', 'text'=>$lang['pl_level'],  'draw'=>'r_plLevel',  'sort_str'=>'`level` DESC','fields'=>'`level`'),
'PL_REPORT_POS'    =>array('class'=>'zone',  'sort'=>'level', 'text'=>$lang['pl_pos'],    'draw'=>'r_plPos',    'sort_str'=>'', 'fields'=>'`map`, `position_x`, `position_y`, `position_z`'),
// Guild member info
'PL_REPORT_NOTE'   =>array('class'=>'',      'sort'=>'',      'text'=>$lang['pl_note'],   'draw'=>'r_plGuildNote','sort_str'=>'',       'fields'=>'`pnote`, `offnote`'),
'PL_REPORT_GRANK'  =>array('class'=>'rank',  'sort'=>'rank',  'text'=>$lang['pl_rank'],   'draw'=>'r_plGuildRank','sort_str'=>'`rank`', 'fields'=>'`guildid`,`rank`'),
// Item owner
'PL_REPORT_ITEM'   =>array('class'=>'i_ico', 'sort'=>'',      'text'=>'',                 'draw'=>'r_plItem'     ,'sort_str'=>'',       'fields'=>'`item_instance`.`data` AS `item_data`'),
);

class PlayerReportGenerator extends ReportGenerator{
 function PlayerReportGenerator($type='')
 {
  global $pl_report, $cDB;
  $this->db = &$cDB;
  $this->column_conf =&$pl_report;
  switch ($type){
   case 'guild': $this->table = '(`characters` join `guild_member` ON `guild_member`.`guid` = `characters`.`guid`)';break;
   case 'item':  $this->table = '(`characters` join `item_instance` ON `characters`.`guid` = `item_instance`.`owner_guid`)';break;
   default:      $this->table = '`characters`';break;
  }

  $this->db_fields = '`characters`.`guid`';
 }
 function online()
 {
  $this->do_requirest('`online` <> 0 AND NOT `extra_flags`&'.PLAYER_EXTRA_GM_INVISIBLE);
 }
 // Select guild members by guild guid
 function guildMembers($gguid)
 {
  $this->do_requirest('`guildid` = ?d', $gguid);
 }
 function itemOwner($id)
 {
  $this->do_requirest("(SUBSTRING_INDEX( SUBSTRING_INDEX(`item_instance`.`data` , ' ' , ?d) , ' ' , -1 )+0) = ?d", ITEM_FIELD_ENTRY + 1, $id);
 }
}
?>
