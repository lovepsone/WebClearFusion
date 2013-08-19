<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2013 lovepsone
+--------------------------------------------------------+
| Filename: class.templating.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class Templating
{
	private $_path;
	private $_template;
	private $_var = array();

	public function Templating($path)
	{
	  $this->_path = $path;
	}

	public function set($name, $value)
	{
		$this->_var[$name] = $value;
	}

	public function __get($name)
	{
		if (isset($this->_var[$name]))
			return $this->_var[$name];
		return '';
	}

	public function display($template, $strip = true)
	{
		$this->_template = $this->_path.$template;
		if (!file_exists($this->_template))
			die($this->_template . ' template does not exist!');

		ob_start();
		include($this->_template);
		echo ($strip) ? $this->_strip(ob_get_clean()) : ob_get_clean();
	}

	private function _strip($data)
	{
		$lit = array("\\t", "\\n", "\\n\\r", "\\r\\n", "  ");
		$sp = array('', '', '', '', '');
		return str_replace($lit, $sp, $data);
	}

	public function xss($data)
	{
		if (is_array($data))
		{
			$escaped = array();

			foreach ($data as $key => $value)
				$escaped[$key] = $this->xss($value);

			return $escaped;
		}
		return htmlspecialchars($data, ENT_QUOTES);
	}
}
?>