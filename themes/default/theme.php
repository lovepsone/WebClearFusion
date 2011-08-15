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
	<LINK href="<?php echo $cssfile; ?>" type=text/css rel=stylesheet>
	<TABLE class=foundation cellSpacing=0 cellPadding=0>
  	<TBODY>
		 <!-- иряър -->
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

<?php
     include("site_menu.php");
?>