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

#####################################
# WebClearFusion configuration file #
#####################################
$WCFConfig = array();
$WCFConfig['mysql'] = array();
$WCFConfig['settings'] = array();

##############################################################################################
# MySQL Database Configuration
#    $WCFConfig['mysql']['hostname']
#    $WCFConfig['mysql']['username']
#    $WCFConfig['mysql']['password']
#    $WCFConfig['mysql']['dbname']
#    $WCFConfig['mysql']['charset']
#    $WCFConfig['mysql']['prefix']
#
#        Database connection settings for different databases
#        Default:
#                host: localhost
#                user: root
#                pass: 
#                charset: UTF8
#		 prefix: wcf_
##############################################################################################

$WCFConfig['mysql']['hostname'] = '127.0.0.1';
$WCFConfig['mysql']['username'] = 'mangos';
$WCFConfig['mysql']['password'] = 'mangos';
$WCFConfig['mysql']['dbname'] 	= 'wcf';
$WCFConfig['mysql']['charset']  = 'UTF8';
$WCFConfig['mysql']['prefix']  	= 'wcf_';

##############################################################################################
# WebClearFusion configuration
#
#    useDebug
#        Debug log module enabled/disabled
#        Default: false (Disabled)
#                 true  (Enabled)
#
#    logLevel
#        Logging level
#        Default: 2 (Full debug)
#                 1 (Errors only)
#
#    configVersion
#        Configuration file version. This option must not be changed (only by commits)!
#        Default: DDMMYYYYNN (day, month, year, changes count)
#
#    encoding
#        Coding site
#        Default: UTF8 (Recommended)
#		  cp1251
#
#    defaultLocale
#        Site default locale
#        Default: Russian
##############################################################################################

$WCFConfig['settings']['useDebug']  	= true;
$WCFConfig['settings']['logLevel']  	= 3;
$WCFConfig['settings']['configVersion'] = '291120122';
$WCFConfig['settings']['encoding'] 	= 'UTF8';
$WCFConfig['settings']['defaultLocale'] = 'russian';


$WCFConfig['title']['copyright'] 	= 'WebClearFusion v 1.0.10 from LovePSone 2010-2011';
$WCFConfig['title']['revision_admin'] 	= ' 1.00.00';
?>