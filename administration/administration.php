<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: administration.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	require_once THEMES."templates/admin_header.php";

	opentable();
	echo"<th colspan='4'>".WCF::$locale['menu_auth_admin']." - v".WCF::$cfgTitle['revision_admin']."</th>";
	echo"<tr><td align='center' colspan='5'><table><tr>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?contet'>".WCF::$locale['menu_admin_content']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?users'>".WCF::$locale['menu_admin_users']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?system'>".WCF::$locale['menu_admin_system']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?plants'>".WCF::$locale['menu_admin_plants']."</a></strong></span></td>";
	echo"<td align='center' width='20%'><span class='small'><strong><a href='".WCF_SELF."?module'>".WCF::$locale['menu_admin_module']."</a></strong></span></td>";
	echo"</tr></table><br><hr></td></tr>";
	
	if(empty($_SERVER["QUERY_STRING"]))
		WCF::redirect(WCF_SELF.'?contet');

	$category = $_SERVER["QUERY_STRING"];
	$NumbStr = 0;
	if (isset($_GET[$category]) && isset($AdminSettingList[$category]))
	{
		for ($i = 1; $i < ceil(count($AdminSettingList[$category])/3) + 1; $i++)
		{
			"<tr>";
			for ($j = 1; $j <4; $j++)
			{
				if (isset($AdminSettingList[$category][$j + $NumbStr]))
				{
					echo"<td width='25%' align='center'><a href='".ADMIN.$AdminSettingList[$category][$j + $NumbStr]['file']."'>";
					echo"<img src='".ADMIN."images/".$AdminSettingList[$category][$j + $NumbStr]['img']."' align='absmiddle'>";
					echo"<br>".WCF::$locale[$AdminSettingList[$category][$j + $NumbStr]['txt']]."</td>";
				}		
				if ($j == 3)
					$NumbStr = $NumbStr + $j;
			}
			echo "</tr>";
		}
	}

	closetable();

	require_once THEMES."templates/footer.php";
?>
