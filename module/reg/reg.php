<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: reg.php
| Author: lovepsone, Êîò_ÄàWIN÷è
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$er = 0;

	$r_connect = mysql_connect($config['rhostname'], $config['rusername'], $config['rpassword']);
	mysql_select_db($config['rdbName'], $r_connect);
	mysql_query("SET NAMES '".$config['encoding']."'");

	$rip = 'no';   
	$query = "SELECT `ip` FROM `ip_banned` WHERE `ip`='".$_SERVER['REMOTE_ADDR']."' LIMIT 1";
	$res = mysql_query($query);

	if ($row = mysql_fetch_assoc($res)) $rip  = $row['ip'];
	if ($rip == $_SERVER['REMOTE_ADDR'])
		{
   			echo $txt['main_ban_ip'];
   			return;
   		}

	if ($config['reg_ip_limit'] > 0)
		{	
			$r_connect = mysql_connect($config['rhostname'], $config['rusername'], $config['rpassword']);
			mysql_select_db($config['rdbName'], $r_connect);
			mysql_query("SET NAMES '".$config['encoding']."'");

   			$query = "SELECT COUNT(`id`) AS kol FROM `account` WHERE `last_ip`='".$_SERVER['REMOTE_ADDR']."'";
   			$resk = mysql_query($query);   
   			$rowk = mysql_fetch_assoc($resk);
   			$ripk  = $rowk['kol'];
  			if ($ripk >= $config['reg_ip_limit'])
				{
      					echo $txt['reg_no'];
      					return;
      				}
  		}


	if (isset($_POST['reg']) AND ($_POST['reg'] == '1'))
		{
   			$er = 0;
   			$er_txt = '';

   			if (!mb_eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$_POST['email']))
				{
       					$er = 1;
       					$er_txt = $txt['reg_warning_mail'];
       				}

   			if (($_POST['pass1'] == $_POST['new_acc']) OR ($_POST['pass1'] != $_POST['pass2']))
				{
      					$er = 1;
      					$er_txt = $txt['reg_warning_pass'];
      				}


   			if (($_POST['pass1'] == '') OR ($_POST['pass2'] == '') OR ($_POST['new_acc'] == '') OR ($_POST['email'] == ''))
				{
      					$er = 1;
      					$er_txt = $txt['reg_warning_field'];
      				}

   			if ($er == 0)
				{

					$r_connect = mysql_connect($config['rhostname'], $config['rusername'], $config['rpassword']);
					mysql_select_db($config['rdbName'], $r_connect);
					mysql_query("SET NAMES '".$config['encoding']."'");

      					$query1 = 'select count(`username`) as kol from `account` where `username` = "'.strtoupper($_POST['new_acc']).'"';
      					$res1 = mysql_query($query1);
      					$row1 = mysql_fetch_assoc($res1);

      					if ($row1['kol'] > 0)
						{
         						$er = 1;
  	 						$er_txt = $txt['reg_warning_account'];
	 					}
      				}

   			if ($er == 0)
				{

					$r_connect = mysql_connect($config['rhostname'], $config['rusername'], $config['rpassword']);
					mysql_select_db($config['rdbName'], $r_connect);
					mysql_query("SET NAMES '".$config['encoding']."'");

      	 				mysql_query("INSERT INTO `account` (`username`,`sha_pass_hash`,`email`,`last_ip`,`locked`,`expansion`) VALUES (UPPER('".$_POST['new_acc']."'),SHA1(CONCAT(UPPER('".$_POST['new_acc']."'),':',UPPER('".$_POST['pass1']."'))),'".$_POST['email']."','".$_SERVER['REMOTE_ADDR']."','0','".$def_exp_acc."')");
								
       					echo"<img src='images/yes.png'> <b>$txt[reg_account_successfully]</b><br><br><hr><div align='center'><a href='index.php'>$txt[main_home]</a></div>";
       					$query2 = "SELECT * FROM `account` WHERE `username`='".strtoupper($_POST['new_acc'])."' AND sha_pass_hash ='".SHA1(strtoupper($_POST['new_acc']).':'.strtoupper($_POST['pass1']))."'";
       					$res2 = mysql_query($query2);

       					if ($row2 = mysql_fetch_assoc($res2))
						{
          						$_SESSION['user_id'] = $row2['id'];
          						$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
          						$_SESSION['kito'] = strtoupper($_POST['new_acc']);
          						$_SESSION['slovo'] = strtoupper(SHA1(strtoupper($_POST['new_acc']).':'.strtoupper($_POST['pass1'])));
          						$_SESSION['gnom'] = $row2['gmlevel'];
          						$_SESSION['modul'] = 'news';				  
          						$log_account   =  $_SESSION['user_id'];
          						$log_character =  0;
          						$log_mode      =  1;
          						$log_email     =  $_POST['email'];
          						$log_resultat  =  '';
          						$log_note      =  $_SESSION['kito'];
          						$log_old_data  =  '';
          						require('include/logs.php');					  
         					}
       					ReturnMainForm(40);
       					return;
      				}	
   			if ($er == 1)
				{

      					echo"<table width='400' border='0' cellspacing='0' cellpadding='0'>";
      					echo"<tr><td height='25' align='center' valign='middle' class='errtitle'><b>$txt[reg_error]</b></td></tr>";
      					echo"<tr><td height='45' align='center' valign='middle'  class='errtab'><b>$er_txt</b></td></tr></table>";     
      				}
   		}

	if ($er == 0)
		{
   			echo"<table width='500' border='0' cellspacing='0' cellpadding='0'>";
   			echo"<tr><td height='25' colspan='3' align='center' valign='middle' class='tabletitle'><b>$txt[reg]</b></td></tr>";
   			echo"<tr><td width='50' height='40' class='tableleft'>&nbsp;</td>";
   			echo"<td width='400' height='40' class='tablecenter'><div align='justify'>$txt[reg_txt]<br/></div></td>";
   			echo"<td width='50' height='40' class='tableright'>&nbsp;</td></tr></table>"; 
   		}
	// form begin
	echo"<br>";
	echo"<form method='post' action='index.php?modul=reg'><input name='reg' value='1' type=hidden>";
	echo"<table width='500' border='0' align='center' cellpadding='0' cellspacing='0'>";

	// account name
	echo"<tr><td width='130' height='30' align='right' valign='middle'>$txt[reg_account]</td>";
	echo"<td width='10' height='30'>&nbsp;</td>";
	echo"<td width='150' height='30' align='left' valign='middle'><span class='logininput'><input type='text' name='new_acc'";
	if (isset($_POST['new_acc']) AND ($_POST['new_acc'] != '')) echo" value='".$_POST['new_acc']."'></span></td>";
	echo"</tr>";

	// password 1 
	echo"<tr><td width='130' height='30' align='right' valign='middle'>$txt[reg_pass]</td>";
	echo"<td width='10' height='30'>&nbsp;</td>";
	echo"<td width='150' height='30' align='left' valign='middle'><span class='logininput'><input type='password' name='pass1'></span></td></tr>";

	// password 2
	echo"<tr><td width='130' height='30' align='right' valign='middle'>$txt[reg_confirm_pass]</td>";
	echo"<td height='30'>&nbsp;</td>";
	echo"<td width='150' height='30' align='left' valign='middle'><span class='logininput'><input type='password' name='pass2'></span></td></tr>";

	// email
	echo"<tr><td width='130' height='30' align='right' valign='middle'>$txt[reg_mail]</td>";
	echo"<td width='10' height='30'>&nbsp;</td>";
	echo"<td width='150' height='30' align='left' valign='middle'><span class='logininput'><input type='text' name='email' ";
	if (isset($_POST['email']) AND ($_POST['email'] != '')) echo" value='".$_POST['email']."'/></span></td>";
	echo"</tr>";

	// submit key
	echo"<tr><td width='130' height='40' align='left' valign='bottom'>&nbsp;</td>";
	echo"<td width='10' height='40' valign='bottom'>&nbsp;</td>";
	echo"<td width='150' height='40' align='left' valign='bottom'><span class='logininput'><input type='submit' value='$txt[reg_add]' ></span></td></tr>";

	// end form
	echo"</table></form>";
?>