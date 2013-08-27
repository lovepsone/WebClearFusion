<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: class.debug.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

Class Debug
{
	private $cfg;
	private $file = '';

	//===========================
	// Initializes debugger
	//===========================
	public function Debug($conf, $file = false)
	{
		if($this->cfg['useDebug'] == false)
		{
			return;
		}
		$this->cfg = $conf;
		$this->file = BASEDIR.'cache/tmp.dbg';
		if($file)
		{
			$this->file = $file;
		}
	}
	    
	public function writeLog($logtext)
	{
		if($this->cfg['useDebug'] == false || $this->cfg['logLevel'] < 2)
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
		if($this->cfg['useDebug'] == false)
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
	    
	public function writeRows($sqlText)
	{
		if($this->cfg['useDebug'] == false || $this->cfg['logLevel'] < 2)
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
		if($this->cfg['useDebug'] == false)
		{
			return;
		}
		switch($type)
		{
			case 'debug':
				$l = sprintf('<strong>DEBUG</strong> [%s]: ', date('d-m-Y H:i:s'));
				break;
	            	case 'error':
				$l = sprintf('<strong>ERROR</strong> [%s]: ', date('d-m-Y H:i:s'));
				break;
	            	case 'sql':
				$l = sprintf('<strong>SQL</strong> [%s]: ', date('d-m-Y H:i:s'));
				break;
	        }
	        return $l;
	}
	    
	private function __writeFile($data)
	{
		@file_put_contents($this->file, $data, FILE_APPEND);
	}
}
?>