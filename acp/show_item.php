<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_item.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/acp_header.php";

	if (!isset($_SESSION['user_id']) || ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) || !isset($_SESSION['realmd_id'])) { redirect(BASEDIR); }

	$ajaxmode = 0;
	$str = isset($_REQUEST['item']) ? @$_REQUEST['item'] : "";

	if (substr($str,0,1) == 'g')
		{
			$item_data = get_item_data(intval(substr($str,1,10)));
			$entry = $item_data[ITEM_FIELD_ENTRY];
		}
	else
		{
    			$item_data = 0;
    			$entry = intval($str);
		}
	$page  = isset($_REQUEST['page']) ? intval(@$_REQUEST['page']) : "";
	//$mark  = @$_REQUEST['mark'];

	$item = get_item($entry);
	opentable();

	if (!$item)
		{
			//RenderError("$txt[item_not_found]");
		}
	else
		{
  			$baseLink = "?item=".$str;
  			if ($ajaxmode == 0)
  				{
   					$icon = get_item_icon($item['displayid']);
   					echo"<tr><td valign='top' align='right' width='20%'>";
   					echo"<br><a id='no_tip' href='?item=".$entry."'><img height='64' width='64' border='0' src='".$icon."'></a></td>";
   					echo"<td>";generate_item_table($item,$item_data,0);echo"</td></tr>";

					if ($item['minMoneyLoot']) { echo"<b>".$txt['modul_acp_show_money']."</b>&nbsp;".money($item['minMoneyLoot']); }
					if (($item['maxMoneyLoot']) && ($item['maxMoneyLoot'] > $item['minMoneyLoot'])) { echo"&nbsp;-&nbsp;".money($item['maxMoneyLoot']); }

					if ($item['BuyPrice']) { echo "<br>".$txt['modul_acp_show_buy_price'].":&nbsp;".money($item['BuyPrice']); }

					//********************************************************************************
					// ≈сли часть набора - выводим весь набор
					//********************************************************************************
					if ($item['itemset'])
						{
							$set = get_item_set($item['itemset']);
							$setkey = array_keys($set);
							echo"<tr><td colspan='5'><br><table class='report' border='1'>";

							if ($set)
								{
									echo"<tr><td class='head'>".$txt['modul_acp_show_this_item_part_of_set']."&nbsp;-&nbsp;";r_set_name($set); echo"</td></tr>";
									echo"<tr><td class='set'>";r_set_items($set);echo"</td></tr>";
									echo"<tr><td class='left'>";r_set_spells($set);echo"</td></tr>";
								}
							else
								{
									echo"<tr><td>Unknown SET = $item[itemset]</td></tr>";
								}
							echo"</table></td></tr>";
   						}
				}
		}

	closetable();

	require_once THEMES."templates/footer.php";
?>


