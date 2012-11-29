<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: class.mysql.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

class WCFMYsql
{
	public static $db_connect = null;
	public static $ip_connect = null;
	public static $userdb_connect = null;
	public static $pw_connect = null;
	public static $encoding_connect = null;

	public static $connection = null;
	public static $selection = null;

	public function WCFMYsql($db, $ip, $userdb, $pw, $encoding)
	{
		self::$db_connect = $db;
		self::$ip_connect = $ip;
		self::$userdb_connect = $userdb;
		self::$pw_connect = $pw;
		self::$encoding_connect = $encoding;

 		$this->connection = @mysql_connect(self::$ip_connect, self::$userdb_connect, self::$pw_connect);
 		$this->selection = @mysql_select_db(self::$db_connect, $this->connection);
		@mysql_query("SET NAMES '".self::$encoding_connect."'");

		if (!$this->connection)
		{
			die("<strong>Unable to establish connection to MySQL</strong><br />".mysql_errno()." : ".mysql_error());
		}
		elseif (!$this->selection)
		{
			die("<strong>Unable to select MySQL database</strong>".mysql_errno()." : ".mysql_error());
		}
		
	}

	public function db_query($query)
	{
		$result = @mysql_query($query);
		if (!$result)
		{
			WCF::Log()->writeSql('Query[%s] is not successfully completed',$query);
			return false;
		}
		else 
		{
			WCF::Log()->writeSql('Query[%s] is successful completed',$query);
			return $result;
		}
	}

	public function db_assoc($query)
	{
		$result = @mysql_fetch_assoc($query);
		if (!$result) 
		{
			// log line
			return false;
		}
		else
		{
			return $result;
		}
	}

	public function db_array($query)
	{
		$result = @mysql_fetch_array($query);
		if (!$result) 
		{
			// log line
			return false;
		}
		else
		{
			return $result;
		}
	}

	public function db_num_rows($query)
	{
		$result = @mysql_num_rows($query);
		return $result;
	}

	public function db_result($query, $row)
	{
		$result = @mysql_result($query, $row);
		if (!$result)
		{
			// log line
			return false;
		}
		else
		{
			return $result;
		}
	}

	public function db_count($field, $table, $conditions = "")
		{
			global $config;
			$cond = ($conditions ? " WHERE ".$conditions : "");
			$result = @mysql_query("SELECT Count".$field." FROM ".$table.$cond);

			if (!$result)
			{
				// log line
				return false;
			}
			else
			{
				$rows = mysql_result($result, 0);
				return $rows;
			}
		}
}
?>