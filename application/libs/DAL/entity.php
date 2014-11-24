<?php
namespace ORM;
		
	/*
	*
	* -----------------------------------------------------------------------------------
	* ORM version : 1.3
	* Class Name : entity
	* Generator : ORMGEN by PLATEL Renaud generated on Xtuc-PC
	* Date Generated : 16.11.2014 17h
	* File name : entity.php
	* Table : ORM_test_unit.entity 
	* -----------------------------------------------------------------------------------
	*/
	
class entity extends CommonORM
{
	
	// **********************
	// Variables
	// **********************
	
	private $ID_entity; // PK
	private $ID_EntityType;
	private $FB_ID;
	private $Country;
	private $FirstName;
	private $LastName;
	private $Sex;
	private $CDate;
	private $ID_C;
	private $CEmail;
	private $LocationLatt;
	private $LocationLong;
	private $LocationName;
	private $BinValue;
	private $Version;
	private $LMD;
	private $ID_LMD;
	private $NTel;
	private $Password;
	
	// **********************
	// Parents object for this class (Keys)
	// **********************
	
	protected $Parent_EntityType;
	
	// **********************
	// Childs array of object for this class (Foreign Keys)
	// **********************
	
	protected $Offer_Entity;
	protected $Entityspecificity_Entity;
	protected $Entityrelationentity_Entity;
	protected $Entityrelationentity_Parent_Entity;
	
	// **********************
	// Interface to control the variable of this class and the update flag
	// **********************
	
	protected $Database; // Database for this object
	public $isNew; // Memory for insert
	protected $isToSaveOrToUpdate; // Memory for update
	//Memory array of fields for update
	protected $structure = array(
		'ID_entity' => array('ID_entity', 'int', '2', '0', ''),
		'ID_EntityType' => array('ID_EntityType', 'int', '0', '0', ''),
		'FB_ID' => array('FB_ID', 'varchar', '1', '0', ''),
		'Country' => array('Country', 'varchar', '1', '0', ''),
		'FirstName' => array('FirstName', 'varchar', '1', '0', ''),
		'LastName' => array('LastName', 'varchar', '1', '0', ''),
		'Sex' => array('Sex', 'enum', '1', '0', ''),
		'CDate' => array('CDate', 'datetime', '1', '0', ''),
		'ID_C' => array('ID_C', 'int', '1', '0', ''),
		'CEmail' => array('CEmail', 'varchar', '1', '0', ''),
		'LocationLatt' => array('LocationLatt', 'varchar', '1', '0', ''),
		'LocationLong' => array('LocationLong', 'varchar', '0', '0', ''),
		'LocationName' => array('LocationName', 'varchar', '0', '0', ''),
		'BinValue' => array('BinValue', 'int', '1', '0', ''),
		'Version' => array('Version', 'int', '1', '0', ''),
		'LMD' => array('LMD', 'timestamp', '1', '0', ''),
		'ID_LMD' => array('ID_LMD', 'int', '1', '0', ''),
		'NTel' => array('NTel', 'varchar', '1', '0', ''),
		'Password' => array('Password', 'varchar', '1', '0', ''),
		'Parent_EntityType' => array('Parent_EntityType', 'ParentObject', '1', '0', ''),
		'Offer_Entity' => array('Offer_Entity', 'ChildObject', '1', '0', ''),
		'Entityspecificity_Entity' => array('Entityspecificity_Entity', 'ChildObject', '1', '0', ''),
		'Entityrelationentity_Entity' => array('Entityrelationentity_Entity', 'ChildObject', '1', '0', ''),
		'Entityrelationentity_Parent_Entity' => array('Entityrelationentity_Parent_Entity', 'ChildObject', '1', '0', '')
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
		
		if($id != 0)
		{
			$this->structure['ID_entity'][4] = $id;
			$query = parent::makequery('SELECT', $this->Database, 'entity', $this->structure);
			$result=$sql->sql_query($query);
	
			if ($sql->sql_num_rows($result)==1)
			{
				$row = $sql->sql_fetch_object($result);
	
				$this->ID_entity = $row->ID_entity;
				$this->ID_EntityType = $row->ID_EntityType;
				$this->FB_ID = $row->FB_ID;
				$this->Country = $row->Country;
				$this->FirstName = $row->FirstName;
				$this->LastName = $row->LastName;
				$this->Sex = $row->Sex;
				$this->CDate = $row->CDate;
				$this->ID_C = $row->ID_C;
				$this->CEmail = $row->CEmail;
				$this->LocationLatt = $row->LocationLatt;
				$this->LocationLong = $row->LocationLong;
				$this->LocationName = $row->LocationName;
				$this->BinValue = $row->BinValue;
				$this->Version = $row->Version;
				$this->LMD = $row->LMD;
				$this->ID_LMD = $row->ID_LMD;
				$this->NTel = $row->NTel;
				$this->Password = $row->Password;
				$this->isToSaveOrToUpdate=0;
			}
			else
			{
				$this->ID_entity = $id;
				$this->isNew=1;
				$this->isToSaveOrToUpdate=1;
			}
		}
	
	    if (is_null($this->ID_entity))
	    {
	        $this->isNew=1;
			$this->isToSaveOrToUpdate=1;
	    }
		else
	    {
	    	$this->structure['ID_entity'][4] = $this->ID_entity;
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
	
	public function get_ID_entity()
	{
		return stripslashes($this->ID_entity);
	}
	
	public function set_ID_entity($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_entity = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_entity = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_ID_EntityType()
	{
		return stripslashes($this->ID_EntityType);
	}
	
	public function set_ID_EntityType($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_EntityType = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_EntityType = addslashes($valeur);
				}
		}
		
		if (trim($this->ID_EntityType)=='')
		{
			$this->ID_EntityType = null;
			$this->Parent_EntityType = null;
		}
		
		if (!is_null($this->Parent_EntityType))
			$this->get_Parent_EntityType(1);
		return TRUE;
	}
	
	public function get_FB_ID()
	{
		return stripslashes($this->FB_ID);
	}
	
	public function set_FB_ID($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->FB_ID = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->FB_ID = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Country()
	{
		return stripslashes($this->Country);
	}
	
	public function set_Country($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Country = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->Country = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_FirstName()
	{
		return stripslashes($this->FirstName);
	}
	
	public function set_FirstName($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->FirstName = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->FirstName = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_LastName()
	{
		return stripslashes($this->LastName);
	}
	
	public function set_LastName($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->LastName = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->LastName = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Sex()
	{
		return stripslashes($this->Sex);
	}
	
	public function set_Sex($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Sex = NULL;
		}
		else
		{
			$this->Sex = addslashes($valeur);
		}
		
		return TRUE;
	}
	
	public function get_CDate()
	{
		return stripslashes($this->CDate);
	}
	
	public function set_CDate($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->CDate = NULL;
		}
		else
		{
			$this->CDate = addslashes($valeur);
		}
		
		return TRUE;
	}
	
	public function get_ID_C()
	{
		return stripslashes($this->ID_C);
	}
	
	public function set_ID_C($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_C = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_C = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_CEmail()
	{
		return stripslashes($this->CEmail);
	}
	
	public function set_CEmail($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->CEmail = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->CEmail = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_LocationLatt()
	{
		return stripslashes($this->LocationLatt);
	}
	
	public function set_LocationLatt($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->LocationLatt = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->LocationLatt = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_LocationLong()
	{
		return stripslashes($this->LocationLong);
	}
	
	public function set_LocationLong($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->LocationLong = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->LocationLong = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_LocationName()
	{
		return stripslashes($this->LocationName);
	}
	
	public function set_LocationName($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->LocationName = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->LocationName = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_BinValue()
	{
		return stripslashes($this->BinValue);
	}
	
	public function set_BinValue($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->BinValue = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->BinValue = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Version()
	{
		return stripslashes($this->Version);
	}
	
	public function set_Version($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Version = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->Version = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_LMD()
	{
		return stripslashes($this->LMD);
	}
	
	public function set_LMD($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->LMD = NULL;
		}
		else
		{
			$this->LMD = addslashes($valeur);
		}
		
		return TRUE;
	}
	
	public function get_ID_LMD()
	{
		return stripslashes($this->ID_LMD);
	}
	
	public function set_ID_LMD($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_LMD = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_LMD = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_NTel()
	{
		return stripslashes($this->NTel);
	}
	
	public function set_NTel($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->NTel = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->NTel = addslashes($valeur);
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
	
	public function get_Parent_EntityType($forced = 0)
	{
		
		$this->Parent_EntityType = new entitytype($this->ID_EntityType);

		return $this->Parent_EntityType;
	}
	
	public function set_Parent_EntityType($entitytype)
	{
		$this->ID_EntityType=$entitytype->ID_EntityType;
		$this->structure["ID_EntityType"][3]=1;
		$this->isToSaveOrToUpdate=1;
		$this->Parent_EntityType=$entitytype;
		return ($entitytype);
	}
			
	// **********************
	// Specific get & set method for childs objets
	// **********************
	
	public function get_Offer_Entity()
	{
		global $sql;
		
		if ((is_null($this->Offer_Entity))&&(!is_null($this->ID_entity)))
		{
			$query="SELECT * FROM `offer` WHERE ID_Entity = ".$this->ID_entity." ORDER BY ID_Offer";
			$result=$sql->sql_query($query);
			while($row = $sql->sql_fetch_object($result,"ORM\offer"))
			{
				$this->add_Offer_Entity($row);
			}
		}
		return ($this->Offer_Entity);
	}
	
	public function set_Offer_Entity($offers)
	{
		if (count($this->Offer_Entity)==0)
			foreach ($offers as $var)
				add_Offer_Entity($var);
		else
			trigger_error( "Can set Offer_Entity cause actual Offer_Entity is not empty", E_USER_ERROR );
		return ($offers);
	}
	
	public function add_Offer_Entity(offer $offer)
	{
		if ($offer->ID_Entity!=$this->ID_entity)
			$offer->ID_Entity=$this->ID_entity;
		$count=count($this->Offer_Entity);
		while (isset($this->Offer_Entity[$count]))
			$count++;
		$this->Offer_Entity[$count]=$offer;
	}
	
	public function remove_Offer_Entity(offer $removeoffer)
	{
		foreach ($this->Offer_Entity as $var)
		{
			if ($removeoffer == $var)
			{
				$var->delete();
				$this->offer = null;
			}
		}
	}
	
	private function save_Offer_Entity($transaction = null)
	{
		foreach ($this->Offer_Entity as $offer)
		{
			if ($offer->ID_Entity!=$this->ID_entity)
				$offer->ID_Entity=$this->ID_entity;
			$offer->save($transaction);
		}
	}
	
	public function delete_Offer_Entity($transaction = null)
	{
		global $sql;
		if (isset($this->Offer_Entity))
			foreach ($this->Offer_Entity as $offer)
			{
				$offer->delete($transaction);
			}
		
		$query = "DELETE FROM `offer` WHERE ID_Entity = ".$this->ID_entity;
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
		
		$this->Offer_Entity= null;
	}
	
	public function get_Entityspecificity_Entity()
	{
		global $sql;
		
		if ((is_null($this->Entityspecificity_Entity))&&(!is_null($this->ID_entity)))
		{
			$query="SELECT * FROM `entityspecificity` WHERE ID_Entity = ".$this->ID_entity." ORDER BY ID_EntitySpecificity";
			$result=$sql->sql_query($query);
			while($row = $sql->sql_fetch_object($result,"ORM\entityspecificity"))
			{
				$this->add_Entityspecificity_Entity($row);
			}
		}
		return ($this->Entityspecificity_Entity);
	}
	
	public function set_Entityspecificity_Entity($entityspecificitys)
	{
		if (count($this->Entityspecificity_Entity)==0)
			foreach ($entityspecificitys as $var)
				add_Entityspecificity_Entity($var);
		else
			trigger_error( "Can set Entityspecificity_Entity cause actual Entityspecificity_Entity is not empty", E_USER_ERROR );
		return ($entityspecificitys);
	}
	
	public function add_Entityspecificity_Entity(entityspecificity $entityspecificity)
	{
		if ($entityspecificity->ID_Entity!=$this->ID_entity)
			$entityspecificity->ID_Entity=$this->ID_entity;
		$count=count($this->Entityspecificity_Entity);
		while (isset($this->Entityspecificity_Entity[$count]))
			$count++;
		$this->Entityspecificity_Entity[$count]=$entityspecificity;
	}
	
	public function remove_Entityspecificity_Entity(entityspecificity $removeentityspecificity)
	{
		foreach ($this->Entityspecificity_Entity as $var)
		{
			if ($removeentityspecificity == $var)
			{
				$var->delete();
				$this->entityspecificity = null;
			}
		}
	}
	
	private function save_Entityspecificity_Entity($transaction = null)
	{
		foreach ($this->Entityspecificity_Entity as $entityspecificity)
		{
			if ($entityspecificity->ID_Entity!=$this->ID_entity)
				$entityspecificity->ID_Entity=$this->ID_entity;
			$entityspecificity->save($transaction);
		}
	}
	
	public function delete_Entityspecificity_Entity($transaction = null)
	{
		global $sql;
		if (isset($this->Entityspecificity_Entity))
			foreach ($this->Entityspecificity_Entity as $entityspecificity)
			{
				$entityspecificity->delete($transaction);
			}
		
		$query = "DELETE FROM `entityspecificity` WHERE ID_Entity = ".$this->ID_entity;
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
		
		$this->Entityspecificity_Entity= null;
	}
	
	public function get_Entityrelationentity_Entity()
	{
		global $sql;
		
		if ((is_null($this->Entityrelationentity_Entity))&&(!is_null($this->ID_entity)))
		{
			$query="SELECT * FROM `entityrelationentity` WHERE ID_Entity = ".$this->ID_entity." ORDER BY ID_EntityRelationEntity";
			$result=$sql->sql_query($query);
			while($row = $sql->sql_fetch_object($result,"ORM\entityrelationentity"))
			{
				$this->add_Entityrelationentity_Entity($row);
			}
		}
		return ($this->Entityrelationentity_Entity);
	}
	
	public function set_Entityrelationentity_Entity($entityrelationentitys)
	{
		if (count($this->Entityrelationentity_Entity)==0)
			foreach ($entityrelationentitys as $var)
				add_Entityrelationentity_Entity($var);
		else
			trigger_error( "Can set Entityrelationentity_Entity cause actual Entityrelationentity_Entity is not empty", E_USER_ERROR );
		return ($entityrelationentitys);
	}
	
	public function add_Entityrelationentity_Entity(entityrelationentity $entityrelationentity)
	{
		if ($entityrelationentity->ID_Entity!=$this->ID_entity)
			$entityrelationentity->ID_Entity=$this->ID_entity;
		$count=count($this->Entityrelationentity_Entity);
		while (isset($this->Entityrelationentity_Entity[$count]))
			$count++;
		$this->Entityrelationentity_Entity[$count]=$entityrelationentity;
	}
	
	public function remove_Entityrelationentity_Entity(entityrelationentity $removeentityrelationentity)
	{
		foreach ($this->Entityrelationentity_Entity as $var)
		{
			if ($removeentityrelationentity == $var)
			{
				$var->delete();
				$this->entityrelationentity = null;
			}
		}
	}
	
	private function save_Entityrelationentity_Entity($transaction = null)
	{
		foreach ($this->Entityrelationentity_Entity as $entityrelationentity)
		{
			if ($entityrelationentity->ID_Entity!=$this->ID_entity)
				$entityrelationentity->ID_Entity=$this->ID_entity;
			$entityrelationentity->save($transaction);
		}
	}
	
	public function delete_Entityrelationentity_Entity($transaction = null)
	{
		global $sql;
		if (isset($this->Entityrelationentity_Entity))
			foreach ($this->Entityrelationentity_Entity as $entityrelationentity)
			{
				$entityrelationentity->delete($transaction);
			}
		
		$query = "DELETE FROM `entityrelationentity` WHERE ID_Entity = ".$this->ID_entity;
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
		
		$this->Entityrelationentity_Entity= null;
	}
	
	public function get_Entityrelationentity_Parent_Entity()
	{
		global $sql;
		
		if ((is_null($this->Entityrelationentity_Parent_Entity))&&(!is_null($this->ID_entity)))
		{
			$query="SELECT * FROM `entityrelationentity` WHERE ID_Parent_Entity = ".$this->ID_entity." ORDER BY ID_EntityRelationEntity";
			$result=$sql->sql_query($query);
			while($row = $sql->sql_fetch_object($result,"ORM\entityrelationentity"))
			{
				$this->add_Entityrelationentity_Parent_Entity($row);
			}
		}
		return ($this->Entityrelationentity_Parent_Entity);
	}
	
	public function set_Entityrelationentity_Parent_Entity($entityrelationentitys)
	{
		if (count($this->Entityrelationentity_Parent_Entity)==0)
			foreach ($entityrelationentitys as $var)
				add_Entityrelationentity_Parent_Entity($var);
		else
			trigger_error( "Can set Entityrelationentity_Parent_Entity cause actual Entityrelationentity_Parent_Entity is not empty", E_USER_ERROR );
		return ($entityrelationentitys);
	}
	
	public function add_Entityrelationentity_Parent_Entity(entityrelationentity $entityrelationentity)
	{
		if ($entityrelationentity->ID_Parent_Entity!=$this->ID_entity)
			$entityrelationentity->ID_Parent_Entity=$this->ID_entity;
		$count=count($this->Entityrelationentity_Parent_Entity);
		while (isset($this->Entityrelationentity_Parent_Entity[$count]))
			$count++;
		$this->Entityrelationentity_Parent_Entity[$count]=$entityrelationentity;
	}
	
	public function remove_Entityrelationentity_Parent_Entity(entityrelationentity $removeentityrelationentity)
	{
		foreach ($this->Entityrelationentity_Parent_Entity as $var)
		{
			if ($removeentityrelationentity == $var)
			{
				$var->delete();
				$this->entityrelationentity = null;
			}
		}
	}
	
	private function save_Entityrelationentity_Parent_Entity($transaction = null)
	{
		foreach ($this->Entityrelationentity_Parent_Entity as $entityrelationentity)
		{
			if ($entityrelationentity->ID_Parent_Entity!=$this->ID_entity)
				$entityrelationentity->ID_Parent_Entity=$this->ID_entity;
			$entityrelationentity->save($transaction);
		}
	}
	
	public function delete_Entityrelationentity_Parent_Entity($transaction = null)
	{
		global $sql;
		if (isset($this->Entityrelationentity_Parent_Entity))
			foreach ($this->Entityrelationentity_Parent_Entity as $entityrelationentity)
			{
				$entityrelationentity->delete($transaction);
			}
		
		$query = "DELETE FROM `entityrelationentity` WHERE ID_Parent_Entity = ".$this->ID_entity;
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
		
		$this->Entityrelationentity_Parent_Entity= null;
	}
	
	// **********************
	// DELETE
	// **********************
	
	public function delete($transaction = null)
	{
		global $sql;
		$thistransaction = "Off";
		$return = null;
		
		if ((isset($this->ID_entity))&&($this->ID_entity!=0))
		{
			if (is_null($transaction))
			{
				$thistransaction="On";
				$transaction = "On";
				if ($sql->TransactionMode == 1)
					$sql->sql_starttransaction();
			}
			if ((count($this->get_Offer_Entity())!=0)&&(CASCADE))
				$this->delete_Offer_Entity($transaction);
			if ((count($this->get_Entityspecificity_Entity())!=0)&&(CASCADE))
				$this->delete_Entityspecificity_Entity($transaction);
			if ((count($this->get_Entityrelationentity_Entity())!=0)&&(CASCADE))
				$this->delete_Entityrelationentity_Entity($transaction);
			if ((count($this->get_Entityrelationentity_Parent_Entity())!=0)&&(CASCADE))
				$this->delete_Entityrelationentity_Parent_Entity($transaction);
			if (($transaction=="On"))
			{
				
				$query = parent::makequery('DELETE', $this->Database, 'entity', $this->structure);
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
		
		if ((is_null($this->ID_entity))||($this->ID_entity==0))
		{
			$this->isToSaveOrToUpdate=1;
			$this->isNew=1;
		}
		
		if (!is_null($this->Parent_EntityType))
			$this->ID_EntityType = $this->Parent_EntityType->save($transaction);	
		
		if ($this->isToSaveOrToUpdate==1)
		{
	
			if ((isset($this->ID_entity))&&($this->ID_entity!="0")&&($this->isNew!=1))
			{
				$query = parent::makequery('UPDATE', $this->Database, 'entity', $this->structure);
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
				$query = parent::makequery('INSERT', $this->Database, 'entity', $this->structure);
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
					$this->ID_entity=$sql->sql_insert_id();
				$this->isNew=0;
			}
		}
	
		if (!is_null($this->Offer_Entity))
			$this->save_Offer_Entity($transaction);
		
		if (!is_null($this->Entityspecificity_Entity))
			$this->save_Entityspecificity_Entity($transaction);
		
		if (!is_null($this->Entityrelationentity_Entity))
			$this->save_Entityrelationentity_Entity($transaction);
		
		if (!is_null($this->Entityrelationentity_Parent_Entity))
			$this->save_Entityrelationentity_Parent_Entity($transaction);
		
		$this->isToSaveOrToUpdate=0;
		foreach ($this->structure as $field)
			if(isset($field[0]))
			{
				$this->structure[$field[0]][3]=0;
			}
	
		return $this->ID_entity;
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
		$this->ID_entity = null;
		$this->isToSaveOrToUpdate = 1;
		foreach ($this->struture as $field)
			if (($field[1] == 'ChildObject')&&(!is_null($this->{$field[0]})))
				foreach ($this->{$field[0]} as &$childvar)
					$childvar = clone $childvar;
	}
	
	private function loadallchildarray()
	{
			$this->get_Offer_Entity();
		
			$this->get_Entityspecificity_Entity();
		
			$this->get_Entityrelationentity_Entity();
		
			$this->get_Entityrelationentity_Parent_Entity();
		}
		
	//endofclass
}
	?>
	