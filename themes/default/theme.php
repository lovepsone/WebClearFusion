<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: skin.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $code_page; ?>" />
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="<?php echo $cssfile; ?>" type=text/css rel=stylesheet>
<link href="images/favicon.ico" rel="icon" type="image/ico">
<title><?php echo $namesite; ?></title>
</head><body>
<div align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="299" height="25" background="<?php echo $themedir; ?>lt.jpg">&nbsp;</td>
    <td height="25" colspan="2" background="<?php echo $themedir; ?>t.jpg">&nbsp;</td>
	<td width="25" height="25" background="<?php echo $themedir; ?>rt.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td width="299" align="left" valign="top" background="<?php echo $themedir; ?>l.jpg"><table width="299" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="299" height="172" align="left" valign="top" background="<?php echo $themedir; ?>ll.jpg">&nbsp;</td>
      </tr>      
    </table><br><div align="center"><?php require "panel.php"; ?></div>	</td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><div align="right">&nbsp;</div><br><?php /*require "mainform.php";*/ ?></td>
	<td width="150" align="left" valign="top" background=""><?php /*require "rules.php";*/ ?><br><?php /*require "menu.php";*/ ?><br><?php /*require "links.php";*/ ?></td>
    <td width="25" background="<?php echo $themedir; ?>r.jpg"></td>
  </tr>

  <tr>
    <td align="center" valign="top" background="<?php echo $themedir; ?>l.jpg">&nbsp;</td>
    <td height="30" colspan="2" align="center" valign="bottom" bgcolor="#FFFFFF"><?php /*require "toolbar.php";*/ ?></td>
    <td height="30" background="<?php echo $themedir; ?>r.jpg"></td>
  </tr>
  <tr>
    <td width="299" height="30" background="<?php echo $themedir; ?>lb.jpg"></td>
    <td height="30" background="<?php echo $themedir; ?>b.jpg"></td>
    <td height="30" background="<?php echo $themedir; ?>b.jpg"></td>
    <td width="25" height="30" background="<?php echo $themedir; ?>rb.jpg"></td>
  </tr>
</table>
</div>
</body></html>
