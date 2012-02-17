<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: include_ajax_tooltip.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$str = isset($_REQUEST['tip']) ? @$_REQUEST['tip'] : "";
	$tip = substr($str,0,1);
	$entry = intval(substr($str,1,10));
	switch ($tip)
		{
			// Показ вещи
			case "i":
			if (substr($str,1,1) == 'g')
				{
					$entry = intval(substr($str,2,10));
					if ($item_data = get_item_data($entry))
						{
							if ($item = get_item($item_data[ITEM_FIELD_ENTRY])) { no_border_item_table($item, $item_data); }
						}
	 				else
						{
							echo "Error item guid $entry";
						}
 				}

			elseif ($item = get_item($entry))
				{
					no_border_item_table($item,0,0);
				}
			else
				{
					echo "Error item $entry";
				}
			break;
}
?>
