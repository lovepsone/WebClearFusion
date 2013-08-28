<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: stats_szone_online_panel.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	@include(BASEDIR.'panels/stats_szone_online_panel/text.php');

	openside();
	$somepage = file_get_contents('http://forum.szone-online.so/');
	$somepage = stristr($somepage, '<div class="info round-top info-hide">');
	$somepage = str_replace('class="info round-top info-hide"', 'style="font-size: 10px; color: #0000ff;"', $somepage);
	$somepage = str_replace('<ul>', '', $somepage);
	$somepage = str_replace('</ul>', '', $somepage);
	$somepage = str_replace('<li>', '<tr><td>', $somepage);
	$somepage = str_replace('</li>', '</td></tr>', $somepage);
	$pos = strpos($somepage,'</div>');
	echo"<tr><td style='font-size: 13px; color: #000080;'><b>".$TxtSZone['szone']."</b></td></tr>";
	for ($i = 0; $i < $pos; $i++)
		echo $somepage[$i];
       	closeside();
?>
