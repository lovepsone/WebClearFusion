<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2014 lovepsone
+--------------------------------------------------------+
| Filename: index.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "../maincore.php";
	if (!ADMINISTRATOR) { WCF::Redirect(BASEDIR.WCF::$cfgSetting['opening_page']); }
	require_once THEMES."templates/AminHeader.php";

	if (!isset($_GET['page']) || !WCF::isNum($_GET['page'])) $_GET['page'] = 1;

	$Page = array();
	$Page = WCF::getAdminPage();
	$loc = "";
	switch ($_GET['page'])
	{
	  case 1: $loc = "adminc"; break;
	  case 2: $loc = "adminu"; break;
	  case 3: $loc = "admins"; break;
	  case 4: $loc = "admint"; break;
	}

	opentable(WCF::getLocale('admin', 0));
	echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
	for ($i = 1; $i < 5; $i++)
	{
		$class = ($_GET['page'] == $i ? "tbl1" : "tbl2");
		echo "<td align='center' width='20%' class='$class'><span class='small'>\n";
		echo ($_GET['page'] == $i ? "<strong>".WCF::getLocale('adminHead', $i-1)."</strong>" : "<a href='index.php?page=$i'>".WCF::getLocale('adminHead', $i-1)."</a>")."</span></td>\n";
	}
	echo "</tr>\n<tr>\n<td colspan='5' class='tbl'>\n";

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	$counter = 0; $columns = 4;
	for ($i = 0; $i < count($Page[$_GET['page']]); $i++)
	{
		if ($counter != 0 && ($counter % $columns == 0)) { echo "</tr>\n<tr>\n"; }
		echo "<td align='center' width='20%' class='tbl'>";
		echo "<span class='small'><a href='".ADMIN.$Page[$_GET['page']][$i]['file']."'><img src='".ADMIN."images/".$Page[$_GET['page']][$i]['img']."' style='border:0px;' /></a><br />\n".WCF::getLocale($loc, $i)."</span>";
		echo "</td>\n";
		$counter++;
	}

	echo "</tr>\n</table>\n";
	echo "</td>\n</tr>\n</table>\n";
	closetable();

	require_once THEMES."templates/footer.php";
?>