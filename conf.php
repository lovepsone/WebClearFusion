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

$config =array (
//==================================================================
// ���� ���� (mangos)
//==================================================================
'hostname' => '127.0.0.1',
'username' => 'mangos',
'password' => 'mangos',
'dbName' => 'mangos',

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
// ���� ���������� (characters)
//==================================================================
'chostname' => '127.0.0.1',
'cusername' => 'mangos',
'cpassword' => 'mangos',
'cdbName' =>'characters',

'encoding'=> 'utf8',
'admin'=>'3',

//==================================================================
// ������� � �������� wcf (����������� ������)
//==================================================================
'copyright'=>'WebClearFusion v 0.4.50 from LovePSone 2010-2011',
'revision'=>'wcf_revision_nr = [126]',
'rev_admin'=>' 0.01.20',
);

define("DB_PREFIX", "wcf_");
?>