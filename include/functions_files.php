<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: functions_files.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	//=============================================================================================
	// Функция создает список файлов и папок и хранит в массиве
	// Вы можете отфильтровать расширения путем добавления их в $extfilter как:
	// $ext_filter = "gif|jpg"
	function makefilelist($folder, $filter, $sort = true, $type = "files", $ext_filter = "")
		{
			$res = array();
			$filter = explode("|", $filter);

			if ($type == "files" && !empty($ext_filter))
				{
					$ext_filter = explode("|", strtolower($ext_filter));
				}
			$temp = opendir($folder);

			while ($file = readdir($temp))
				{
					if ($type == "files" && !in_array($file, $filter))
						{
							if (!empty($ext_filter))
								{
									if (!in_array(substr(strtolower(stristr($file, '.')), +1), $ext_filter) && !is_dir($folder.$file))
										{
											$res[] = $file;
										}
								}
							else
								{
									if (!is_dir($folder.$file))
										{
											$res[] = $file;
										}
								}
						}
					elseif ($type == "folders" && !in_array($file, $filter))
						{
							if (is_dir($folder.$file))
								{
									$res[] = $file;
								}
						}
				}
			closedir($temp);

			if ($sort)
				{
					sort($res);
				}
			return $res;
		}
	//=============================================================================================
	// Функция создает список выбораиз массива, создонного функцияй makefilelist()
	function makefileopts($files, $selected = "")
		{
			$res = "";
			for ($i = 0; $i < count($files); $i++)
				{
					$sel = ($selected == $files[$i] ? " selected='selected'" : "");
					$res .= "<option value='".$files[$i]."'$sel>".$files[$i]."</option>\n";
				}
			return $res;
		}
?>