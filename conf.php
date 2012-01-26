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
// База сайта (WCF)
//==================================================================
'whostname' => '127.0.0.1',
'wusername' => 'mangos',
'wpassword' => 'mangos',
'wdbName' => 'wcf',

//==================================================================
// База реалм (realmd)
//==================================================================
'rhostname' => '127.0.0.1',
'rusername' => 'mangos',
'rpassword' => 'mangos',
'rdbName' =>'realmd',

//==================================================================
// База мира (mangos)
//==================================================================
'hostname' => $realms[$_SESSION['realmd']]['hostname'],
'username' => $realms[$_SESSION['realmd']]['username'],
'password' => $realms[$_SESSION['realmd']]['password'],
'dbName' => $realms[$_SESSION['realmd']]['dbName'],

//==================================================================
// База персанажей (characters)
//==================================================================
'chostname' => $realms[$_SESSION['realmd']]['chostname'],
'cusername' => $realms[$_SESSION['realmd']]['cusername'],
'cpassword' => $realms[$_SESSION['realmd']]['cpassword'],
'cdbName' => $realms[$_SESSION['realmd']]['cdbName'],

'encoding'=> 'utf8',
'admin'=>'3',

//==================================================================
// Ревизия и копирайт wcf (запрещается менять)
//==================================================================
'copyright'=>'WebClearFusion v 0.4.60 from LovePSone 2010-2011',
'revision'=>'wcf_revision_nr = [142]',
'rev_admin'=>' 0.01.80',
);

define("DB_PREFIX", "wcf_");
?>