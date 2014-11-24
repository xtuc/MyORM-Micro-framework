<?php
	namespace ORM;
		
	/*
	*
	* -----------------------------------------------------------------------------------
	* Class Name : Users
	* Generator : ORMGEN by PLATEL Renaud generated on Xtuc-PC
	* Date Generated : 16.11.2014 13h
	* File name : Users.php
	* Table : ORM_test_unit.Users 
	* -----------------------------------------------------------------------------------
	*/
	
	class Users extends CommonORM
	{
	
	// **********************
	// Variables
	// **********************
	
	private $ID_User; // PK
	private $ID_Users_type;
	private $Username;
	private $Password;
	
	// **********************
	// Parents object for this class (Keys)
	// **********************
	
	protected $Parent_Users_type;
	
	// **********************
	// Childs array of object for this class (Foreign Keys)
	// **********************
	
	
	// **********************
	// Interface to control the variable of this class and the update flag
	// **********************
	
	protected $Database; // Database for this object
	public $isNew; // Memory for insert
	protected $isToSaveOrToUpdate; // Memory for update
	//Memory array of fields for update
	protected $structure = array(
		'ID_User' => array('ID_User', 'int', '2', '0', ''),
		'ID_Users_type' => array('ID_Users_type', 'int', '1', '0', ''),
		'Username' => array('Username', 'varchar', '1', '0', ''),
		'Password' => array('Password', 'varchar', '1', '0', ''),
		'Parent_Users_type' => array('Parent_Users_type', 'ParentObject', '1', '0', '')
	);
	
	// **********************
	// Constructor
	// **********************
	function __construct ($id = null, $database = null)
	{
		global $sql;

		if (is_null($database))
		{
		    $this->Database = $sql->Database;
		}
		else
		{
		    $this->Database = $database;
		}
		
		$this->isToSaveOrToUpdate=0;
		$this->isNew=0;
		
		if(!is_null($id) && is_numeric($id))
		{
			$this->structure['ID_User'][4] = $id;
			$query = parent::makequery('SELECT', $this->Database, 'Users', $this->structure);
			$result=$sql->sql_query($query);
	
			if ($sql->sql_num_rows($result)==1)
			{
				$row = $sql->sql_fetch_object($result);
	
				$this->ID_User = $row->ID_User;
				$this->ID_Users_type = $row->ID_Users_type;
				$this->Username = $row->Username;
				$this->Password = $row->Password;
				$this->isToSaveOrToUpdate=0;
			}
			else
			{
				$this->ID_User = $id;
				$this->isNew=1;
				$this->isToSaveOrToUpdate=1;
			}
		}
	
	    if (is_null($this->ID_User))
	    {
	        $this->isNew=1;
			$this->isToSaveOrToUpdate=1;
	    }
		else
	    {
	    	$this->structure['ID_User'][4] = $this->ID_User;
	    }
	}
	
	
	// **********************
	// Generic get & set method for this class
	// **********************
	
	public function __get( $property )
	{
	    if ( is_callable( array($this,'get_'.(string)$property) ) )
	        return call_user_func( array($this,'get_'.(string)$property) );
	    else
	        trigger_error( "get for ".$property." doesn't exists", E_USER_ERROR );
	}
	
	public function __set( $property, $value )
	{
		if ( is_callable( array($this,'set_'.(string)$property) ) )
		{
			if ( $value != call_user_func( array($this,'get_'.(string)$property) ) )
			{
				call_user_func( array($this,'set_'.(string)$property), $value );
				$this->isToSaveOrToUpdate=1;
				$this->structure[$property][3]=1;
				$this->structure[$property][4] = $value;
				if (method_exists(get_class($this),'set_Version'))
                    if ($this->structure['Version'][3]==0)
                    {
                        $this->Version=$this->Version+1;
                        $this->structure['Version'][3]=1;
                        $this->structure['Version'][4]=$this->Version;
                    }
                if (method_exists(get_class($this),'set_LMD'))
                {
                    $this->LMD = date('Y-m-d H:i:s');
                    $this->structure['LMD'][3]=1;
                    $this->structure['LMD'][4]=$this->LMD;
                }
                if ($this->isNew==1)
                {
                    if (method_exists(get_class($this),'set_CDate'))
                    {
                        $this->CDate = date('Y-m-d H:i:s');
                        $this->structure['CDate'][3]=1;
                        $this->structure['CDate'][4]=$this->CDate;
                    }
                }
			}
		}
		else
		{
			trigger_error( "set for ".$property." doesn't exists", E_USER_ERROR );
		}
	}
	
	// **********************
	// Specific get & set method for this class
	// **********************
	
	public function get_isNew()
	{
		return intval($this->isNew);
	}
	
	public function get_ID_User()
	{
		return stripslashes($this->ID_User);
	}
	
	public function set_ID_User($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_User = NULL;
		}
		else
		{
			if(is_int($valeur))
				{
					$this->ID_User = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_ID_Users_type()
	{
		return stripslashes($this->ID_Users_type);
	}
	
	public function set_ID_Users_type($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_Users_type = NULL;
		}
		else
		{
			if(is_int($valeur))
				{
					$this->ID_Users_type = addslashes($valeur);
				}
		}
		
		if (trim($this->ID_Users_type)=='')
		{
			$this->ID_Users_type = null;
			$this->Parent_Users_type = null;
		}
		
		if (!is_null($this->Parent_Users_type))
			$this->get_Parent_Users_type(1);
		return TRUE;
	}
	
	public function get_Username()
	{
		return stripslashes($this->Username);
	}
	
	public function set_Username($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Username = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->Username = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Password()
	{
		return stripslashes($this->Password);
	}
	
	public function set_Password($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Password = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->Password = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	// **********************
	// Specific get & set method for parents objects
	// **********************
	
	public function get_Parent_Users_type($forced = 0)
	{
		if ($forced == 1)
			$this->Parent_Users_type=new Users_type($this->ID_Users_type);
		if ((is_null($this->Parent_Users_type))&&(!is_null($this->ID_Users_type)))
			$this->Parent_Users_type=new Users_type($this->ID_Users_type);
		return $this->Parent_Users_type;
	}
	
	public function set_Parent_Users_type($Users_type)
	{
		$this->ID_Users_type=$Users_type->ID_Users_type;
		$this->structure["ID_Users_type"][3]=1;
		$this->isToSaveOrToUpdate=1;
		$this->Parent_Users_type=$Users_type;
		return ($Users_type);
	}
	
	// **********************
	// Specific get & set method for childs objets
	// **********************
	
	// **********************
	// DELETE
	// **********************
	
	public function delete($transaction = null)
	{
		global $sql;
		$thistransaction = "Off";
		$return = null;
		
		if ((isset($this->ID_User))&&($this->ID_User!=0))
		{
			if (is_null($transaction))
			{
				$thistransaction="On";
				$transaction = "On";
				if ($sql->TransactionMode == 1)
					$sql->sql_starttransaction();
			}
			if (($transaction=="On"))
			{
				
				$query = parent::makequery('DELETE', $this->Database, 'Users', $this->structure);
				$sql->sql_query($query);
				if ($sql->sql_error())
				{
					$erreur=$sql->sql_error()."<br>".$query;
					if ($sql->TransactionMode == 1)
					{
						$sql->sql_rollbacktransaction();
					}
					trigger_error($erreur,E_USER_ERROR);
				}
				else
					$return = $sql->sql_affected_rows();
			}
			if (($sql->TransactionMode == 1)&&($thistransaction=="On"))
			{
				$sql->sql_committransaction();
			}
			return $return;
		}
		foreach ($this->structure as $field)
			unset($this->$field[0]);	
	}
	
	// **********************
	// SAVE (INSERT or UPDATE)
	// **********************
	
	public function save($transaction = null)
	{
		global $sql;
		
		$thistransaction = "Off";
		
		if ((is_null($this->ID_User))||($this->ID_User==0))
		{
			$this->isToSaveOrToUpdate=1;
			$this->isNew=1;
		}
		
		if (!is_null($this->Parent_Users_type))
			$this->ID_Users_type = $this->Parent_Users_type->save($transaction);	
		
		if ($this->isToSaveOrToUpdate==1)
		{
	
			if ((isset($this->ID_User))&&($this->ID_User!="0")&&($this->isNew!=1))
			{
				$query = parent::makequery('UPDATE', $this->Database, 'Users', $this->structure);
				$result=$sql->sql_query($query);
				if ($sql->sql_error())
				{
					$erreur=$sql->sql_error()."<br>".$query;
					if ($transaction=="On")
					{
						$sql->sql_rollbacktransaction();
					}
					trigger_error($erreur,E_USER_ERROR);
				}
			}
			else
			{
				$query = parent::makequery('INSERT', $this->Database, 'Users', $this->structure);
				$sql->sql_query($query);
				if ($sql->sql_error())
				{
					$erreur=$sql->sql_error()."<br>".$query;
					if ($transaction=="On")
					{
						$sql->sql_rollbacktransaction();
					}
					trigger_error($erreur,E_USER_ERROR);
				}
				else
					$this->ID_User=$sql->sql_insert_id();
				$this->isNew=0;
			}
		}
	
		$this->isToSaveOrToUpdate=0;
		foreach ($this->structure as $field)
			if(isset($field[0]))
			{
				$this->structure[$field[0]][3]=0;
			}
	
		return $this->ID_User;
	}
	
	public function __toString()
	{
		$this->loadallchildarray();
		$return = "<p>Object ".__CLASS__." (<br>";
		foreach ($this->struture as $field)
			if ($field[1] == 'ChildObject')
			{
				//$i=0;
				//if (!is_null($this->{$field[0]}))
				//	foreach ($this->{$field[0]} as &$childvar)
				//	{
				//		$return .= $field[0]."[$i] => ".$this->{$field[0]}[$i]."<br>";
				//		$i++;
				//	}
			}
			else
				$return .= $field[0]." => ".$this->{$field[0]}."<br>";
		$return .= ")</p>";
		return $return;
	}
	
	public function __clone()
	{
		$this->loadallchildarray();
		$this->ID_User = null;
		$this->isToSaveOrToUpdate = 1;
		foreach ($this->struture as $field)
			if (($field[1] == 'ChildObject')&&(!is_null($this->{$field[0]})))
				foreach ($this->{$field[0]} as &$childvar)
					$childvar = clone $childvar;
	}
	
	private function loadallchildarray()
	{}
			
	function __destruct()
	{
		//$this->save();		
	}
		
	//endofclass
}
	?>
	