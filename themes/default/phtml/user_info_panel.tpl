{* Smarty *}

{if !isset($smarty.session.user_id) || ($smarty.session.ip != $smarty.server.REMOTE_ADDR)}

	<form name='loginform' method='post' action='{$smarty.const.WCF_SELF}'>
	<tr><td colspan='2' align='center'>{#menu_auth_title#}<br><br></td></tr>
  	<tr><td colspan='2' align='center'>{#menu_auth_account#}<br><input type='text' name='auth_name' class='textbox'></td></tr>
 	<tr><td colspan='2' align='center'>{#menu_auth_pass#}<br><input type='password' name='auth_pass' class='textbox'></td></tr>

	{*Проверка на каптча*}
	{if $kcaptcha_enable_auth == 1} 
		{*<tr><td colspan='2' align='center'><br><img id='siimage' style='border: 1px solid #000' src='".S_KCAPTCHA."securimage_show.php?sid=".md5(uniqid())."'/><br>";
		<object type='application/x-shockwave-flash' data='".S_KCAPTCHA."securimage_play.swf?bgcol=#ffffff&amp;icon_file=".S_KCAPTCHA."images/audio_icon.png&amp;audio_file=".S_KCAPTCHA."securimage_play.php' height='16' width='16'>";
		<param name='movie' value='".S_KCAPTCHA."securimage/securimage_play.swf?bgcol=#ffffff&amp;icon_file=".S_KCAPTCHA."securimage/images/audio_icon.png&amp;audio_file=".S_KCAPTCHA."securimage/securimage_play.php' /></object>";
		<a href='#' onclick='document.getElementById('siimage').src = '".S_KCAPTCHA."securimage_show.php?sid=' + Math.random(); this.blur(); return false'>";
		<img src='".S_KCAPTCHA."images/refresh.png' height='16' width='16' onclick='this.blur()'/></a></td></tr>
   		<tr><td colspan='2' align='center'><br><input type='text' name='kapcha_code' class='textbox'></td></tr>*}
	{/if}

	<tr><td colspan='2' align='center'><br><input type='submit' class='button' value='{#menu_auth_enter#}'></td></tr>
     	<tr><td height='30' colspan='2' align='left' valign='middle'>
		<img src='{$smarty.const.IMAGES}admin.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='{$smarty.const.BASEDIR}register.php'>{#menu_auth_reg#}</a>
	</td></tr>

     	{if $pass_remember == 'on' }
     		<tr><td height='30' colspan='2' align='left' valign='middle'>
			<img src='{$smarty.const.IMAGES}mail.png' align='absmiddle'>&nbsp;&nbsp;&nbsp;<a href='{$smarty.const.BASEDIR}index.php'>{#menu_auth_remember_pass#}</a>
		</td></tr>
	{/if}

	</form>

{elseif isset($smarty.session.user_id) || ($smarty.session.ip == $smarty.server.REMOTE_ADDR)}

	<tr><td align='left'>{#menu_auth_greeting#}&nbsp;{ucfirst(strtolower($smarty.session.user_name))}</td></tr>
	<tr><td align='right' valign='top' class='avatar'>{avatar_img($data.user_avatar)}</td></tr>
  	<tr><td align='left'>{#menu_auth_ip#}</td></tr>
  	<tr><td align='left'>{$smarty.server.REMOTE_ADDR}</td></tr>
	<tr><td width='100%'><hr></td></tr>

	{if $gm_lvl}
		<tr><td align='right'><a href='{$smarty.const.ADMIN}administration.php?contet'>{#menu_auth_admin#}</a></td></tr>
	{/if}

	<tr><td align='right'><a href='{$smarty.const.BASEDIR}setuser.php?action=logout'>{#menu_auth_exit#}</a>

{/if}