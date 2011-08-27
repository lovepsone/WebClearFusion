<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: change_lang.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	if($config['change_lang'] == 'on')
		{
			echo"<select size='1' name='lang_list' onchange=\"document.location.href='index.php?lang='+this.value;\">
             			<option selected>$txt[change_lang]</option>
             			<option value='ru'>ru</option>
             			<option value='en'>en</option>
			</select>";
  		}
?>
