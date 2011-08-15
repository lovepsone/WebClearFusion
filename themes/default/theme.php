<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: teme.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require "include/functions.php";
?>
<LINK href="themes/<?php echo $theme; ?>/style.css" type=text/css rel=stylesheet>
<TABLE class=foundation cellSpacing=0 cellPadding=0>
  <TBODY>
  <TR>
    <TD class=lefttitle></TD>
    <TD align=center>
          <table class=sitetitle cellSpacing=0 cellPadding=0>
          <tbody>
           <tr>
            <td class=ugverhfon>&nbsp;</td>
            <td class=topfon>&nbsp;</td>
            <td class=fonmenu><?php  echo $config['servername']; ?></td>
            <td class=topfon>&nbsp;</td>
            <td class=ugverhfon2>&nbsp;</td>
           </tr>
          </tbody>
          </table>
    </TD>
    <TD class=righttitle></TD>
  </TR>
  <TR>
    <TD class=leftmenu>
      <TABLE class=mainmenu>
       <TBODY>
       <TR><TD class=top></TD></TR>
       <TR>
        <TD class=body>
         <!--<?php  echo $lang['search_database']; ?><br> -->
          <FORM style="DISPLAY: inline" method=get>
           <input name="s" type="hidden" value="all">
           <INPUT class=ls_search alt="all" name=name style="width: 190px;"><br />
          </form>
<?php
   // Получаем данные для левого меню (сначала из кэша)
   $left_menu_file = "left_menu_".$config['lang'].".js";
   if (checkUseCacheJs($left_menu_file, 60*60*24))
   {
     include("site_menu.php");
     echo 'var leftmenu = '.php2js($menu).';';
     echo 'generateLeftMenu("leftmenu");';
     flushJsCache($left_menu_file);
   }
?>