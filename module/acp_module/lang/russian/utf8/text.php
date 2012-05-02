<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: text.ru.utf8.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	require_once "zone_names.php";
	require_once "game_text.php";

$txt['menu_acp_info_acc']			='Учётная запись:';
$txt['menu_acp_info_type_acc']			='Тип учётной записи:';
$txt['menu_acp_info_access']			='Права доступа:';
$txt['menu_acp_info_reg_mail']			='Регистрационный E-mail:';
$txt['menu_acp_info_lang']			='Язык клиента:';
$txt['menu_acp_info_online']			='игровой статус:';
$txt['menu_acp_info_game_on']			='В игре';
$txt['menu_acp_info_game_off']			='В не игры';
$txt['menu_acp_info_date_reg']			='Дата регистрации:';
$txt['menu_acp_info_date_game']			='Дата последнего посещения:';
$txt['menu_acp_info_last_ip']			='Последний IP-адрес:';
$txt['menu_acp_info_linking_ip']		='Привязка к IP-адресу:';
$txt['menu_acp_info_linking_ip_on']		='Включена';
$txt['menu_acp_info_linking_ip_off']		='<font color=green>Выключена</font>';
$txt['menu_acp_info_game_realm']		='Игровой реалм:';

$txt['modul_setuser_logout']			='Вы успешно вышли из Учетной записи!';
$txt['modul_setuser_login']			='Вы успешно вошли в Управление учетной записи!';
$txt['modul_setuser_out_acp']			='Вы успешно вышли из Управления учетной записи!';
$txt['modul_setuser_ban_acc']			='Ваша Учетная запись забанена Администрацияй по причине:';
$txt['modul_setuser_ban_ip']			='Ваша IP-Адрес забанен Администрацияй по причине:';

$txt['modul_online_timers']			='Таймеры:';
$txt['modul_online_points_arena']		='Дата начисления очков арены:';
$txt['modul_online_daily_quests']		='Дата сброса ежедневных заданий:';
$txt['modul_online_weekly_quests']		='Дата сброса еженедельных заданий:';
$txt['modul_online_monthly_quests']		='Дата сброса ежемесячных заданий:';
$txt['modul_online']				='онлайн';
$txt['modul_online_no_char']			='Нет игроков со статусом <b>Онлайн</b>';
$txt['modul_online_level']			='Уровень';
$txt['modul_online_name']			='Имя';
$txt['modul_online_race']			='Раса';
$txt['modul_online_class']			='Класс';
$txt['modul_online_position']			='Позиция';

$txt['admin_panel_acp_control']			='Управление панелями';
$txt['admin_panel_acp_name']			='Название панели';
$txt['admin_panel_acp_place']			='Место';
$txt['admin_panel_acp_position']		='Положение';
$txt['admin_panel_acp_type']			='Тип';
$txt['admin_panel_acp_show']			='Доступ';
$txt['admin_panel_acp_options']			='Опции';
$txt['admin_panel_acp_edit']			='Редактировать';
$txt['admin_panel_acp_switch_off']		='ВЫКЛ';
$txt['admin_panel_acp_switch_on']		='ВКЛ';
$txt['admin_panel_acp_del']			='Удалить';
$txt['admin_panel_acp_del_n_y']			='Удалить эту панель?';
$txt['admin_panel_acp_add']			='Добавить новую панель';
$txt['admin_panel_acp_refresh']			='Обновить порядок панелей';

#ACP
$txt['modul_acp_game_on']			='<font color=green>В игре</font>';
$txt['modul_acp_game_off']			='Вне игры';
$txt['modul_acp_revive']			='Просмотреть персонажа';
$txt['modul_acp_level']			='Уровень';
$txt['modul_acp_name']				='Имя';
$txt['modul_acp_race']				='Раса';
$txt['modul_acp_class']			='Класс';
$txt['modul_acp_money']			='Деньги';
$txt['modul_acp_position']			='Позиция';
$txt['modul_acp_game_status']			='Игравой статус';
$txt['modul_acp_no_char']			='На вашей учетной записи не созданы персонажи';

$txt['modul_acp_char']				='Персонаж';
$txt['modul_acp_char_talents']			='Таланты';
$txt['modul_acp_char_skill']			='Умения';
$txt['modul_acp_char_achievements']		='Достижения';
$txt['modul_acp_char_reputation']		='Репутация';
$txt['modul_acp_char_quests']			='Квесты';
$txt['modul_acp_char_page_base']		='Основные';
$txt['modul_acp_char_page_defence']		='Защита';
$txt['modul_acp_char_page_melee']		='Ближний бой';
$txt['modul_acp_char_page_ranged']		='Дальний бой';
$txt['modul_acp_char_armor']			='Броня:';
$txt['modul_acp_char_defence']			='Защита';
$txt['modul_acp_char_dodge']			='Уклонение:';
$txt['modul_acp_char_parry']			='Парирование:';
$txt['modul_acp_char_block']			='Блок:';
$txt['modul_acp_char_recilence']		='Устойчивость:';
$txt['modul_acp_char_ach_total']		='Обзор';
$txt['modul_acp_char_ach_complete'] 		='Всего выполнено:';
$txt['modul_acp_char_ach_last']     		='Последние выполненные:';
$txt['modul_acp_char_skill']     		='Навыки персонажа';
$txt['modul_acp_show_reputation']  		='Репутация персонажа';
$txt['modul_acp_show_reqirement']     		='Требование';
$txt['modul_acp_show_horde']     		='Орда';
$txt['modul_acp_show_alliance']     		='Альянс';
$txt['modul_acp_show_no_sell_price'] 		='Не для продажи';
$txt['modul_acp_show_sell_price'] 		='Цена продажи';
$txt['modul_acp_show_money'] 			='Деньги:';
$txt['modul_acp_show_buy_price'] 		='Цена выкупа';
$txt['modul_acp_show_this_item_part_of_set'] 	='Этот предмет часть комплекта';

$txt['modul_acp_show_detail_info'] 		='Подробная информация';

$txt['modul_acp_outh'] 			='Выйти из АСР';
?>