<?php
/*
 * Class manage sql
 */
class sql
{
	/* Paramaters for this connection */
	private $Server;
	private $User;
	private $Password;
	private $Ressource; // Object/Ressourse for SQL
	private $Connection_Type; // should be PDO driver name
	private $Charset; // charset
	
	public $Database;
	public $TransactionMode; // 1 for InnoDB(MySQL)/MsSQL in transaction mode, 0 for MyISAM(MySQL) 
	public $Debug; // 1 to display all executed request 
	
	function sql($server, $user, $password, $database, $connectiontype = "mysql", $transactionmode = 0, $debug = 0, $charset = 'UTF8' )
	{
		if (class_exists('PDO'))
		{
			$this->Server = $server;
			$this->User = $user;
			$this->Password = $password;
			$this->Database = $database;
			$this->Connection_Type = $connectiontype;
			$this->Charset = $charset;
			$this->TransactionMode = $transactionmode;
			$this->Debug = $debug;
			
			$this->sql_connect();
		}
		else 
		{
			trigger_error("Could not find driver");
		}
	}
	
	function get_Database()
	{
		return $this->Database;
	}
	
	function set_Datebase($Value)
	{
		$this->Datebase = $Value;
		$this->sql_query("USE `".$Value."`");
		return $Value;
	}
	
	function get_Connection_Type()
	{
		return $this->Connection_Type;
	}
	
	function get_Charset()
	{
		return $this->Charset;
	}
	
	/**
	 * PDO::exec
	 * @return mixed PDO exec return
	 */
	function sql_query($query)
	{
		if ($this->Debug == 1)
			echo "<p>".$query."</p>";
		
		try {
				if(substr($query, 0, 6) == "SELECT" || substr($query, 0, 4) == "SHOW")
				{					
					$Results = $this->Ressource->query($query);
				}
				else 
				{
					$Results = $this->Ressource->exec($query);
				}

			
		} catch (PDOException $Exception) {
			$this->sql_error($Exception);
		}
		
		/**
		 * DEMO ONLY
		 */
		global $sqlStats;
		
		if(empty($sqlStats) || !is_array($sqlStats))
		{
			$sqlStats = array();
		}
		
		$sqlStats[] = $query;
		
		return $Results;
	}
	
	/**
	 * @return row / field Value
	 */
	function sql_result($statement,$rowid,$field)
	{
		$statement->execute();
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $rows[$rowid][$field];
	}
	

	/**
	 * @return rows count
	 */
	function sql_num_rows($statement)
	{	
		if (method_exists($statement,rowCount))
		{
			return $statement->rowCount();
		}
		else
		{
			return NULL;
		}
	}
	
	/**
	 * @return fields count
	 */
	function sql_num_fields($statement)
	{
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		
		return count($row);
	}
	
	/**
	 * @deprecated
	 * @return NULL
	 */
	function sql_close()
	{
		/**
		 * Close PDO transaction
		 */
	}
	
	/**
	 * @name PDO class statement fetch
	 * @return mixed SQL results
	 */
	function sql_fetch_object($statement, $class = null)
	{				
		if(is_null($class))
		{
			$Result = $statement->fetchObject();
		}
		else 
		{			
			if(class_exists($class))
			{				
				$Result = $statement->fetchObject($class);				
			}
			else 
			{		
				$Result = NULL;		
				
				trigger_error($class . " isn't callable");
			}	
		}

		return $Result;
	}
	
	/**
	 * @name PDO statement 
	 * @return count delete or update rows
	 */
	function sql_affected_rows($statement)
	{
		return $statement->rowCount();
	}
	
	/**
	 * @name PDO statement
	 * @offset column
	 * @return count delete or update rows
	 */
	function sql_field_name($statement,$offset)
	{
		$valeur = $statement->getColumnMeta ( $offset );
		return $valeur["name"];
	}
	
	/**
	 * @return last ID insert
	 */
	function sql_insert_id()
	{
		return $this->Ressource->lastInsertId();
	}
	
	/**
	 * @name SQL list tables in BDD
	 * @return mixed
	 */
	function sql_list_tables()
	{
		$results = $this->sql_query("SHOW tables");				
		$results = $this->sql_fetch_array($results);
		
		return $results;
	}
	
	/**
	 * 
	 * @name Exists table in BDD
	 * @return boolean
	 */
	function sql_table_exists($tablename)
	{		
		$stmt = $this->sql_query("SHOW tables LIKE '".$tablename."'");
		
		if($this->sql_num_rows($stmt) === 0)
		{
			return FALSE;
		}
		elseif($this->sql_affected_rows($stmt) < 1)
		{
			exit("Ma solution ne marche pas SQL::sql_table_exists");
		}
		else 
		{
			return TRUE;
		}
	}
	
	/**
	 *
	 * @name table
	 * @return name of primarykey if any (mysql)
	 */
	function sql_primary_key($tablename)
	{
		$Result = $this->sql_query("SHOW COLUMNS FROM `".$tablename."`");
		
		while ($row = $this->sql_fetch_object($Result))
		{
			if(trim($row->Key)=='PRI')
			{
				return $row->Field;
			}
		}
		
		return null;
	}
	
	/**
	 * @name PDO error handler
	 * @return Error Trigger
	 */
	function sql_error($PDOerror = NULL)
	{
		if(!is_null($PDOerror))
		{
			trigger_error("<p>PDO error : ". $PDOerror->getMessage( ) ."</p>", E_USER_WARNING); //warning for DAL
		}
		else 
		{
			return;
		}
		
	}
	
	/**
	 * @name PDO standart statement fetch
	 * @return array of SQL results
	 */
	function sql_fetch_row($statement = NULL)
	{		
		try {
			return $statement->fetch();
		} catch (PDOException $e) {
			echo "SQL::sql_fetch_row error : " . $e->getMessage();
				
			return NULL;
		}
	}
	
	/**
	 * @name PDO standart statement fetch
	 * @return array of SQL results
	 */
	function sql_fetch_array($statement = NULL)
	{
		try {
			$statement->execute();
			return $statement->fetchall();
		} catch (PDOException $e) {
			echo "SQL::sql_fetch_array error : " . $e->getMessage();
				
			return NULL;
		}
	}
	
	/**
	 * @name PDO connection
	 * @return PDOStatement
	 */
	private function sql_connect()
	{
		$charset = "SET NAMES ".$this->Charset;
		
		$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => $charset,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);
		
		try {
			$DSN = $this->Connection_Type.':host='. $this->Server .';dbname='. $this->Database;
			$this->Ressource = new PDO($DSN, $this->User, $this->Password, $options);
    		
		} catch (PDOException $e) {
			echo 'Could not connect : <br>' . $e->getMessage();
		}
	}
	
	/**
	 * @name PDO begin transaction
	 * @return boolean
	 */
	function sql_starttransaction()
	{
		if($this->Ressource->beginTransaction())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * @name PDO rollBack last transaction
	 * @return boolean
	 */
	function sql_rollbacktransaction()
	{
		if($this->Ressource->rollBack())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * @name PDO commit changes
	 * @return boolean
	 */
	function sql_committransaction()
	{
		if($this->Ressource->commit())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	 * @name Quote PDO
	 * @param unknown $val
	 * @return quoted string
	 */
	function quote($val)
	{
		return $this->Ressource->quote($val);
	}
	
	/**
	 * Get SQL stats
	 * @return multitype:number
	 */
	public function GetStats()
	{
		return $this->stats;
	}
}
?>