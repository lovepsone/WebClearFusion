<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: include_simple_cacher.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function checkUseCacheJs($filename, $time)
		{
			$script_start_time = time();                 // Текущее время
			$cachetime = @filemtime(BASEDIR.'cache/'.$filename); // Время создания/изменения файла кэша (0 если файла нет)
			if ($script_start_time - $cachetime < $time) // Проверяем устарел ли кэш
				{
					// Всё норм подключаем скрипт из кэша
					echo'<script type="text/javascript" src="'.BASEDIR.'cache/'.$filename.'"></script>';
					return 0;
				}
			// Данных в кэше нет или устарели, начинаем кэшировать вывод
			ob_start();
			return 1;
		}

	function flushJsCache($filename)
		{
			// Скидываем скэшированые данные в файл
			$open = @fopen(BASEDIR."cache/".$filename, "w");
			if (!$open)
				{
					mkdir(BASEDIR."cache", 0700);
					$open=fopen(BASEDIR."cache/".$filename, "w");
				}
			flock($open, LOCK_EX);            // Блокируем файл
			rewind($open);                    // Установка позиции в начало файла
			fwrite($open, ob_get_contents()); // Записываем данные
			fclose($open);                    // Закрываем файл
			ob_end_clean();
			echo'<script type="text/javascript" src="'.BASEDIR.'cache/'.$filename.'"></script>';
		}

	function checkUseCacheHtml($filename, $time)
		{
			$script_start_time = time();                 // Текущее время
			$cachetime = @filemtime('cache/'.$filename); // Время создания/изменения файла кэша (0 если файла нет)
			if ($script_start_time - $cachetime < $time) // Проверяем устарел ли кэш
				{
					// Всё норм подключаем скрипт из кэша
					include ('cache/'.$filename);
					return 0;
				}
			// Данных в кэше нет или устарели, начинаем кэшировать вывод
			ob_start();
			return 1;
		}

	function flushHtmlCache($filename)
		{
			// Скидываем скэшированые данные в файл
			$open=@fopen("cache/".$filename, "w");
			if (!$open)
				{
					mkdir("cache", 0700);
					$open=fopen("cache/".$filename, "w");
				}
			flock($open, LOCK_EX);            // Блокируем файл
			rewind($open);                    // Установка позиции в начало файла
			fwrite($open, ob_get_contents()); // Записываем данные
			fclose($open);                    // Закрываем файл
			ob_end_clean();
			include ('cache/'.$filename);
		}
?>