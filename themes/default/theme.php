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

	//==========================================
	// Загаловок\Title
	echo"<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Frameset//EN' 'http://www.w3.org/TR/html4/frameset.dtd'>";
	echo"<head><link rel='SHORTCUT ICON' href='images/favicon.ico'>";
	echo"<title>".$config['servername']."</title>";
	echo"<LINK href='$cssfile' type=text/css rel=stylesheet>";
	echo"<LINK href='$csswcffile' type=text/css rel=stylesheet>";
	echo"<LINK href='administration/administration.css' type=text/css rel=stylesheet>";
	echo"<META http-equiv='content-type' content='text/html; charset=$code_page' /></HEAD>";
	echo"<body>";

	//==========================================
	// Основной контент\Main content
	echo"<table class='foundation' cellSpacing='0' cellPadding='0'>";

		//==========================================
		// Верхний колонтитул\Header
  		echo"<tbody><tr><td class='lefttitle'></td>";
		echo"<td align='center'>";
          		echo"<table class='sitetitle' cellSpacing='0' cellPadding='0'><tbody><tr>
            			<td class='ugverhfon'>&nbsp;</td>
            			<td class='topfon'>&nbsp;</td>
            			<td class='fonmenu'><a href='".$config['urlserver']."'>".$config['servername']."</a></td>
            			<td class='topfon'>&nbsp;</td>
            			<td class='ugverhfon2'>&nbsp;</td>";
           		echo"</tr></tbody></table>";
    		echo"</td><td class='righttitle'></td></tr>";

		echo"<tr><td><table class='mainmenu'><tr><td width='225' class='left-top'>&nbsp;</td></tr></table></td>";
		echo"<td align='center'></td>";
		echo"<td><table class='mainmenu'><tr><td width='225' class='right-top'>&nbsp;</td></tr></table></td></tr>";

		//================================================================
		// Тело. Левая часть\The body. The left part
  		echo"<tr><td class='leftmenu'>";
      			echo"<table class='mainmenu'><tbody>";
			echo"<tr><td class=left-body>";

				require "panels/panels_l.php";

			echo"</td></tr>";
			echo"<tr><td class=left-bottom></td></tr></tbody></table></td>";

		//================================================================
		// Тело. Центральная часть часть\The body. The central part of the
  		echo"<td class='mybody'>";
    			echo"<table class='mainbody' cellSpacing='0' cellPadding='0'><tbody>";

    			echo"<tr><td class='bodytopleft'></td><td class='bodytop'></td><td class='bodytopright'></td></tr>";

			echo"<tr><td class='bodyleft'></td><td class='body'><center>";
			require "panels/panels_c.php";
			echo"</center></td><td class='bodyright'></td></tr>";

			echo"<tr><td class='bodybottomleft'></td><td class='bodybottom'></td><td class='bodybottomright'></td></tr>";

			echo"</tbody></table>";
  		echo"</td>";

		//================================================================
		// Тело. Правая часть\The body. The right part
  		echo"<td class='rightmenu'>";
      			echo"<table class='mainmenu'><tbody>";
       			echo"<tr><td class='right-body'>";

			require "panels/panels_r.php";

			echo"</td></tr>";
        		echo"<tr><td class='right-bottom'></td></tr></tbody></table>";
		echo"</td></tr>";

	echo"</tbody></table>";

	//==========================================
	// Hижний колонтитул\footer
	echo"<br><hr width='90%'><center><font size=-1>".$config['copyright']."</font></center><br>";

	if($config['change_lang'] == 'on')
		{
			echo"<select size='1' name='lang_list' onchange=\"document.location.href='index.php?lang='+this.value;\">
             			<option selected>".$txt['change_lang']."</option>
             			<option value='ru'>ru</option>
             			<option value='en'>en</option>
			</select>";
  		}
	echo"</body>";