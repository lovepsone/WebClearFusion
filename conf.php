<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: conf.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

$config = array(
//==================================================================
// ���� ����� (WCF)
//==================================================================
'whostname' => '127.0.0.1',
'wusername' => 'mangos',
'wpassword' => 'mangos',
'wdbName' => 'wcf',

//==================================================================
// ���� ����� (realmd)
//==================================================================
'rhostname' => '127.0.0.1',
'rusername' => 'mangos',
'rpassword' => 'mangos',
'rdbName' =>'realmd',

//==================================================================
// ���� ���� (mangos_r1)
//==================================================================
'hostname_r1' => '127.0.0.1',
'username_r1' => 'mangos',
'password_r1' => 'mangos',
'dbName_r1' => 'mangos',

//==================================================================
// ���� ���������� (characters_1)
//==================================================================
'chostname_r1' => '127.0.0.1',
'cusername_r1' => 'mangos',
'cpassword_r1' => 'mangos',
'cdbName_r1' => 'characters',

//==================================================================
// ���� ���� (mangos_r2)
//==================================================================
'hostname_r2' => '127.0.0.1',
'username_r2' => 'mangos',
'password_r2' => 'mangos',
'dbName_r2' => 'mangos2',

//==================================================================
// ���� ���������� (characters_r2)
//==================================================================
'chostname_r2' => '127.0.0.1',
'cusername_r2' => 'mangos',
'cpassword_r2' => 'mangos',
'cdbName_r2' => 'characters2',

'encoding' => 'utf8',
'use_tab_mode' => '1',          // Tabbed report mode (cswowd)
'talent_calc_max_level' => '80',
'errors_reporting' => '1',

//==================================================================
// ��� wcf: 0-�������, 1-��������� World of Warcraft LK(mangos)
// 2-��������� World of Warcraft LK(trynity)(���� �� ��������������) 
//==================================================================
'type_content' => '1',

//==================================================================
// ������� � �������� wcf (����������� ������)
//==================================================================
'copyright'=>'WebClearFusion v 0.4.63 from LovePSone 2010-2011',
'revision'=>'wcf_revision_nr = [271]',
'rev_admin'=>' 0.02.00',
'rev_acp'=>' 0.02.00',
);

define("DB_PREFIX", "wcf_");
?>