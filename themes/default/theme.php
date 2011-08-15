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
		 <!-- Шапка -->
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
		<!-- Тело -->
		<!-- Левая часть сайта -->
  		<TR>
    			<TD class=leftmenu>
      				<TABLE class=mainmenu>
       					<TBODY>
       						<TR><TD class=left-top></TD></TR>
       						<TR><TD class=left-body><?php include(""); ?></TD></TR>
        					<TR><TD class=left-bottom></TD></TR>
       					</TBODY>
      				</TABLE>
    			</TD>

    			<TD class=mybody>
			<!-- Центральная часть сайта -->
    				<TABLE class=mainbody cellSpacing=0 cellPadding=0>
    					<TBODY>
    						<TR>
        						<TD class=bodytopleft></TD>
        						<TD class=bodytop></TD>
        						<TD class=bodytopright></TD>
						</TR>
						<TR>
        						<TD class=bodyleft></TD>
        						<TD class=body><center><?php include("");?></center></TD>
        						<TD class=bodyright></TD></TR>
						<TR>
        						<TD class=bodybottomleft></TD>
        						<TD class=bodybottom></TD>
        						<TD class=bodybottomright></TD>
						</TR>
					</TBODY>
				</TABLE>
			<!-- -->
  			</TD>
			<!-- Правая часть сайта -->
  			<TD class=rightmenu>
      				<TABLE class=mainmenu>
       					<TBODY>
       						<TR><TD class=right-top></TD></TR>
       						<TR><TD class=right-body><?php include(""); ?></TD></TR>
        					<TR><TD class=right-bottom></TD></TR>
       					</TBODY>
      				</TABLE>
			</TD>
  		</TR>
  	</TBODY>
	</TABLE>