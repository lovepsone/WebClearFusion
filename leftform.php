<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: leftform.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	reset($modules);
   	while (list($menu1, $menu2) = each($modules))
		{
         		if (($menu2[2]  < 0) and ($menu2[4]  == 1))
				{
               				$MenuForAll = $MenuForAll."<tr><td align='left' valign='middle'><a href='index.php?modul=".$menu1."' target=_self>".$txt[$menu2[1]]."</a></td></tr>";
              			}
         		elseif (($menu2[2] == 0) and isset($_SESSION['gnom']) and ($menu2[4]  == 1))
				{
               				$MenuPlayers = $MenuPlayers."<tr><td align='left' valign='middle'><a href='index.php?modul=".$menu1."' target=_self>".$txt[$menu2[1]]."</a></td></tr>";
              			}
         		elseif (($menu2[2]  > 0) and isset($_SESSION['gnom']) and ($_SESSION['gnom'] > 1) and ($menu2[4]  == 1))
				{
               				$MenuAdmin = $MenuAdmin."<tr><td align='left' valign='middle'><a href='index.php?modul=".$menu1."' target=_self>".$txt[$menu2[1]]."</a></td></tr>";
              			}
        	}

	if ($MenuForAll.$MenuPlayers.$MenuAdmin <> '')
		{
       			echo"<table width='200' border='0' cellspacing='0' cellpadding='3' class='panel-left'>";
       			if ($MenuForAll <> '')
				{
					echo"<tr><td width='100%' valign='middle'><a href='index.php'>$txt[home]</a></td></tr>";
           				echo"<tr><td align='left' valign='middle'><hr></td></tr>";
           				echo $MenuForAll;
           			}

       			if ($MenuPlayers <> '')
				{
           				echo"<tr><td align='left' valign='middle'><hr></td></tr>";
           				echo $MenuPlayers;
           			}

       			if ($MenuAdmin <> '')
				{
           				echo"<tr><td align='left' valign='middle'><hr></td></tr>";
           				echo $MenuAdmin;
           			}
       			echo"</table>";
      		}
?>
