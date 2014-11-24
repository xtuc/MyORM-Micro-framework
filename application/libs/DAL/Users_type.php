<?php
	namespace ORM;
		
	/*
	*
	* -----------------------------------------------------------------------------------
	* Class Name : Users_type
	* Generator : ORMGEN by PLATEL Renaud generated on Xtuc-PC
	* Date Generated : 16.11.2014 13h
	* File name : Users_type.php
	* Table : ORM_test_unit.Users_type 
	* -----------------------------------------------------------------------------------
	*/
	
	class Users_type extends CommonORM
	{
	
	// **********************
	// Variables
	// **********************
	
	private $ID_Users_type; // PK
	private $Value;
	
	// **********************
	// Parents object for this class (Keys)
	// **********************
	
	
	// **********************
	// Childs array of object for this class (Foreign Keys)
	// **********************
	
	protected $Users_Users_type;
	
	// **********************
	// Interface to control the variable of this class and the update flag
	// **********************
	
	protected $Database; // Database for this object
	public $isNew; // Memory for insert
	protected $isToSaveOrToUpdate; // Memory for update
	//Memory array of fields for update
	protected $structure = array(
		'ID_Users_type' => array('ID_Users_type', 'int', '2', '0', ''),
		'Value' => array('Value', 'varchar', '1', '0', ''),
		'Users_Users_type' => array('Users_Users_type', 'ChildObject', '1', '0', '')
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
			$this->structure['ID_Users_type'][4] = $id;
			$query = parent::makequery('SELECT', $this->Database, 'Users_type', $this->structure);
			$result=$sql->sql_query($query);
	
			if ($sql->sql_num_rows($result)==1)
			{
				$row = $sql->sql_fetch_object($result);
	
				$this->ID_Users_type = $row->ID_Users_type;
				$this->Value = $row->Value;
				$this->isToSaveOrToUpdate=0;
			}
			else
			{
				$this->ID_Users_type = $id;
				$this->isNew=1;
				$this->isToSaveOrToUpdate=1;
			}
		}
	
	    if (is_null($this->ID_Users_type))
	    {
	        $this->isNew=1;
			$this->isToSaveOrToUpdate=1;
	    }
		else
	    {
	    	$this->structure['ID_Users_type'][4] = $this->ID_Users_type;
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
		
		return TRUE;
	}
	
	public function get_Value()
	{
		return stripslashes($this->Value);
	}
	
	public function set_Value($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Value = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->Value = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	// **********************
	// Specific get & set method for parents objects
	// **********************
	
	// **********************
	// Specific get & set method for childs objets
	// **********************
	
	public function get_Users_Users_type()
	{
		global $sql;
		
		if ((is_null($this->Users_Users_type))&&(!is_null($this->ID_Users_type)))
		{
			$query="SELECT * FROM `Users` WHERE ID_Users_type = ".$this->ID_Users_type." ORDER BY ID_User";
			$result=$sql->sql_query($query);
			while($row = $sql->sql_fetch_object($result,"ORM\Users"))
			{
				$this->add_Users_Users_type($row);
			}
		}
		return ($this->Users_Users_type);
	}
	
	public function set_Users_Users_type($Userss)
	{
		if (count($this->Users_Users_type)==0)
			foreach ($Userss as $var)
				add_Users_Users_type($var);
		else
			trigger_error( "Can set Users_Users_type cause actual Users_Users_type is not empty", E_USER_ERROR );
		return ($Userss);
	}
	
	public function add_Users_Users_type(Users $Users)
	{
		if ($Users->ID_Users_type!=$this->ID_Users_type)
			$Users->ID_Users_type=$this->ID_Users_type;
		$count=count($this->Users_Users_type);
		while (isset($this->Users_Users_type[$count]))
			$count++;
		$this->Users_Users_type[$count]=$Users;
	}
	
	public function remove_Users_Users_type(Users $removeUsers)
	{
		foreach ($this->Users_Users_type as $var)
		{
			if ($removeUsers == $var)
			{
				$var->delete();
				$this->Users = null;
			}
		}
	}
	
	private function save_Users_Users_type($transaction = null)
	{
		foreach ($this->Users_Users_type as $Users)
		{
			if ($Users->ID_Users_type!=$this->ID_Users_type)
				$Users->ID_Users_type=$this->ID_Users_type;
			$Users->save($transaction);
		}
	}
	
	public function delete_Users_Users_type($transaction = null)
	{
		global $sql;
		if (isset($this->Users_Users_type))
			foreach ($this->Users_Users_type as $Users)
			{
				$Users->delete($transaction);
			}
		
		$query = "DELETE FROM `Users` WHERE ID_Users_type = ".$this->ID_Users_type;
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
			return $sql->sql_affected_rows();
		
		$this->Users_Users_type= null;
	}
	
	// **********************
	// DELETE
	// **********************
	
	public function delete($transaction = null)
	{
		global $sql;
		$thistransaction = "Off";
		$return = null;
		
		if ((isset($this->ID_Users_type))&&($this->ID_Users_type!=0))
		{
			if (is_null($transaction))
			{
				$thistransaction="On";
				$transaction = "On";
				if ($sql->TransactionMode == 1)
					$sql->sql_starttransaction();
			}
			if ((count($this->get_Users_Users_type())!=0)&&(CASCADE))
				$this->delete_Users_Users_type($transaction);
			if (($transaction=="On"))
			{
				
				$query = parent::makequery('DELETE', $this->Database, 'Users_type', $this->structure);
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
		
		if ((is_null($this->ID_Users_type))||($this->ID_Users_type==0))
		{
			$this->isToSaveOrToUpdate=1;
			$this->isNew=1;
		}
		
		if ($this->isToSaveOrToUpdate==1)
		{
	
			if ((isset($this->ID_Users_type))&&($this->ID_Users_type!="0")&&($this->isNew!=1))
			{
				$query = parent::makequery('UPDATE', $this->Database, 'Users_type', $this->structure);
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
				$query = parent::makequery('INSERT', $this->Database, 'Users_type', $this->structure);
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
					$this->ID_Users_type=$sql->sql_insert_id();
				$this->isNew=0;
			}
		}
	
		if (!is_null($this->Users_Users_type))
			$this->save_Users_Users_type($transaction);
		
		$this->isToSaveOrToUpdate=0;
		foreach ($this->structure as $field)
			if(isset($field[0]))
			{
				$this->structure[$field[0]][3]=0;
			}
	
		return $this->ID_Users_type;
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
		$this->ID_Users_type = null;
		$this->isToSaveOrToUpdate = 1;
		foreach ($this->struture as $field)
			if (($field[1] == 'ChildObject')&&(!is_null($this->{$field[0]})))
				foreach ($this->{$field[0]} as &$childvar)
					$childvar = clone $childvar;
	}
	
	private function loadallchildarray()
	{
			$this->get_Users_Users_type();
		}
			
	function __destruct()
	{
		//$this->save();		
	}
		
	//endofclass
}
	?>
	