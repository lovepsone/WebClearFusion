<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: talent.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "maincore.php";
	require_once THEMES."templates/header.php";

	//==============================================================================
	// Скрипт предназначен для вывода талантов игрока
	//==============================================================================

	$talent = (isset($_REQUEST['talent']) ? strtolower(@$_REQUEST['talent']) : "");
	if (isset($_REQUEST['pet'])) { $pid = intval($_REQUEST['pet']); } else { $pid = -1; }
	$bild  = (isset($_REQUEST['bild']) ? @$_REQUEST['bild'] : "");
	$cid = 0;
	$link = '?talent';
	$header = '';

	opentable();
	echo"<div align='center'>";

	$cname = array(1=>'warrior',2=>'paladin',3=>'hunter',4=>'rogue',5=>'priest',6=>'death_knight',7=>'shaman',8=>'mage',9=>'warlock',11=>'druid');

	foreach($cname as $c=>$name)
		{
			echo '<a href="?talent='.$name.'" '.add_tooltip(get_classes($c)).'><img class=item src="'.get_class_image($c).'"></a>&nbsp;';
			if ($talent==$name)
				{
					$header = get_classes($c);
					$link.="=".$name;
					$cid = $c;
				}
		}
	echo"<br>";

	selectdb("wcf");
	$result = db_query("SELECT `id`, `category` FROM ".DB_CREATURE_FAMILY." WHERE `category` <> -1 ORDER BY `name`");
	while ($data = db_array($result))
		{
			$f = $data['id'];
			$c = $data['category'];
			echo '<a href="?talent&pet='.$c.'" '.add_tooltip(get_creature_family($f,0)).'><img class=item src="'.get_family_image($f).'"></a>&nbsp;';
			if ($pid==$c)
				{
					$header = get_creature_family($f);
					$link.="&pet=".$c;
				}
		}
	echo"</div><br>";



	if ($cid OR $pid >= 0)
		{
			echo"<div id='talent' align='center'>";
			include_talent_script($cid, $pid, $config['talent_calc_max_level'], $header);
			if ($bild) echo'<script type="text/javascript">tc_bildFromStr("'.$bild.'");</script>';
			echo'<script type="text/javascript">tc_renderTree("talent");</script></div>';
		}

	echo'<div class=faq><center>';
	echo'<a href="'.$link.'" id=talent_bild_link>Bild link</a> | <a href="#" onclick="return tc_resetBild();">Reset talents</a>';
	echo'</center></div>';
	closetable();

	require_once THEMES."templates/footer.php";
?>
