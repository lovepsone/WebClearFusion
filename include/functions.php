<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: functions.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function get_locale($locale)
		{
  			switch ($locale):
      			case 0:
      			$locale = "English";
      			break;
  
    			case 1:
      			$locale = "Korean";
      			break;
    
    			case 2:
      			$locale = "French";
      			break;

    			case 3:
      			$locale = "German";
      			break;
      
    			case 4:
      			$locale = "Chinese";
      			break;
      
    			case 5:
      			$locale = "Taiwanese";
     			break;
      
    			case 6:
      			$locale = "Spanish";
      			break;
      
    			case 7:
      			$locale = "Spanish Mexico";
      			break;
      
    			case 8:
      			$locale = "Russian";
      			break;

  			endswitch;

			return $locale;
		}

	function get_expansion($typ)
    		{
    			switch ($typ):

        		case 0:
            		$typ = "World of Warcraft";
            		break;

        		case 1:
            		$typ = "The Burning Crusade";
            		break;

        		case 2:
           	 	$typ = "Wrath of the Lich King";
            		break;

    			endswitch;
    			return $typ;
    		}

	function get_gold($gold)
    		{
		    	$g = floor($gold / (100 * 100));
		    	$gold = $gold - $g * 100 * 100;
		    	$s = floor($gold / 100);
		    	$gold = $gold - $s * 100;
		    	$c = floor($gold);
    			return sprintf("<b>%d<img src='".IMAGES."gold.png'>&nbsp;%02d<img src='".IMAGES."silver.png'>&nbsp;%02d<img src='".IMAGES."copper.png'></b>", $g, $s, $c);
    		}

	function get_player_faction($race)
		{
			selectdb(wcf);
 			$result = db_query("SELECT `id` AS ARRAY_KEY, `team` FROM ".DB_CHR_RACES."");
			$data = array();
			while ($mas_data = db_array($result))
				{
					$data[$mas_data['ARRAY_KEY']] = $mas_data['team'];
				}
 			return isset($data[$race]) ? $data[$race] : 2;
		}

	function get_faction_image($race)
		{
			$faction = get_player_faction($race);
 			if ($faction == 0) return "<img width='20' src='".IMAGES_PI."factions_img/alliance.gif'>";
 			if ($faction == 1) return "<img width='20' src='".IMAGES_PI."factions_img/horde.gif'>";
 			return 0;
		}

	function get_race_image($race, $genderid)
		{
 			return IMAGES_PI."race_img/".$race."_".$genderid.".gif";
		}

	function get_class_image($class)
		{
 			return IMAGES_PI."class_img/".$class.".gif";
		}

	function get_class_names()
		{
			selectdb(wcf);
 			$result = db_query("SELECT `id` AS ARRAY_KEY, `name` FROM ".DB_CHR_CLASSES."");
			$data = array();
			while ($mas_data = db_array($result))
				{
					$data[$mas_data['ARRAY_KEY']] = $mas_data['name'];
				}
 			return $data;
		}

	function get_classes($class)
		{
  			$l = get_class_names();
  			return isset($l[$class]) ? $l[$class] : 'class_'.$class;
		}

	//======================================================================================================
	function validate_text($text)
		{
			$letter = array("'",'"'     ,"<"   ,">"   ,">"   ,"\r","\n"  );
			$values = array("`",'&quot;',"&lt;","&gt;","&gt;",""  ,"<br>");
			return str_replace($letter, $values, $text);
		}

	function add_tooltip($text, $extra='')
		{
			if ($text=='') return '';
			return 'onmouseover="Tip(\''.validate_text($text).'\''.($extra?','.$extra:'').');"';
		}
?>