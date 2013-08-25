<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: class.debug.php
| Author: lovepsone, Shadez 
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

Class WCFDebug
{
	//===========================
	// Log config
	//===========================
	private $config;
	private $file = '';
	    
	//===========================
	// Initializes debugger
	//===========================
	public function WCFDebug($config, $file = false)
	{
		if($config['useDebug'] == false)
		{
			return;
		}
		$this->config = $config;
		$this->file = BASEDIR."cache/_debug/tmp.dbg";
		if($file)
		{
			$this->file = $file;
		}
	}
	    
	public function writeLog($logtext)
	{
		if($this->config['useDebug'] == false || $this->config['logLevel'] < 2)
		{
			return;
		}
		$args = func_get_args();
		$debug_log = self::AddStyle('debug');
		$debug_log .= call_user_func_array('sprintf', $args);
		$debug_log .= "<br />\n";
		self::__writeFile($debug_log);
	 	return;
	}
	    
	public function writeError($errorText)
	{
		if($this->config['useDebug'] == false)
		{
			return;
		}
		$args = func_get_args();
		$error_log = self::AddStyle('error');
		$error_log .= call_user_func_array('sprintf', $args);
		$error_log .= "<br />\n";
		self::__writeFile($error_log);
		return;
	}
	    
	public function writeSql($sqlText)
	{
		if($this->config['useDebug'] == false || $this->config['logLevel'] < 3)
		{
			return;
		}
		$args = func_get_args();
		$error_log = self::AddStyle('sql');
		$error_log .= call_user_func_array('sprintf', $args);
		$error_log .= "<br />\n";
		self::__writeFile($error_log);
		return;
	}
	    
	private function AddStyle($type)
	{
		if($this->config['useDebug'] == false)
		{
			return;
		}
		switch($type)
		{
			case 'debug': $log = sprintf('<strong>DEBUG</strong> [%s]: ', date('d-m-Y H:i:s')); break;
	            	case 'error': $log = sprintf('<strong>ERROR</strong> [%s]: ', date('d-m-Y H:i:s')); break;
	            	case 'sql': $log = sprintf('<strong>SQL</strong> [%s]: ', date('d-m-Y H:i:s')); break;
	        }
	        return $log;
	}
	    
	private function __writeFile($data)
	{
		@file_put_contents($this->file, $data, FILE_APPEND);
	}
}
?>