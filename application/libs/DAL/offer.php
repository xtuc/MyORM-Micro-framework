<?php
namespace ORM;
		
	/*
	*
	* -----------------------------------------------------------------------------------
	* ORM version : 1.3
	* Class Name : offer
	* Generator : ORMGEN by PLATEL Renaud generated on Xtuc-PC
	* Date Generated : 16.11.2014 17h
	* File name : offer.php
	* Table : ORM_test_unit.offer 
	* -----------------------------------------------------------------------------------
	*/
	
class offer extends CommonORM
{
	
	// **********************
	// Variables
	// **********************
	
	private $ID_Offer; // PK
	private $ID_Entity;
	private $ID_SubCategory;
	private $ID_Plan;
	private $ID_Discount_coupon;
	private $Title;
	private $Description;
	private $Price;
	private $Coverpic;
	private $Keywords;
	private $CDate;
	private $Active;
	
	// **********************
	// Parents object for this class (Keys)
	// **********************
	
	protected $Parent_Entity;
	protected $Parent_SubCategory;
	
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
		'ID_Offer' => array('ID_Offer', 'int', '2', '0', ''),
		'ID_Entity' => array('ID_Entity', 'int', '0', '0', ''),
		'ID_SubCategory' => array('ID_SubCategory', 'int', '0', '0', ''),
		'ID_Plan' => array('ID_Plan', 'int', '0', '0', ''),
		'ID_Discount_coupon' => array('ID_Discount_coupon', 'int', '0', '0', ''),
		'Title' => array('Title', 'varchar', '0', '0', ''),
		'Description' => array('Description', 'text', '0', '0', ''),
		'Price' => array('Price', 'int', '0', '0', ''),
		'Coverpic' => array('Coverpic', 'varchar', '0', '0', ''),
		'Keywords' => array('Keywords', 'varchar', '0', '0', ''),
		'CDate' => array('CDate', 'timestamp', '0', '0', ''),
		'Active' => array('Active', 'int', '0', '0', ''),
		'Parent_Entity' => array('Parent_Entity', 'ParentObject', '1', '0', ''),
		'Parent_SubCategory' => array('Parent_SubCategory', 'ParentObject', '1', '0', '')
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
			$this->structure['ID_Offer'][4] = $id;
			$query = parent::makequery('SELECT', $this->Database, 'offer', $this->structure);
			$result=$sql->sql_query($query);
	
			if ($sql->sql_num_rows($result)==1)
			{
				$row = $sql->sql_fetch_object($result);
	
				$this->ID_Offer = $row->ID_Offer;
				$this->ID_Entity = $row->ID_Entity;
				$this->ID_SubCategory = $row->ID_SubCategory;
				$this->ID_Plan = $row->ID_Plan;
				$this->ID_Discount_coupon = $row->ID_Discount_coupon;
				$this->Title = $row->Title;
				$this->Description = $row->Description;
				$this->Price = $row->Price;
				$this->Coverpic = $row->Coverpic;
				$this->Keywords = $row->Keywords;
				$this->CDate = $row->CDate;
				$this->Active = $row->Active;
				$this->isToSaveOrToUpdate=0;
			}
			else
			{
				$this->ID_Offer = $id;
				$this->isNew=1;
				$this->isToSaveOrToUpdate=1;
			}
		}
	
	    if (is_null($this->ID_Offer))
	    {
	        $this->isNew=1;
			$this->isToSaveOrToUpdate=1;
	    }
		else
	    {
	    	$this->structure['ID_Offer'][4] = $this->ID_Offer;
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
	
	public function get_ID_Offer()
	{
		return stripslashes($this->ID_Offer);
	}
	
	public function set_ID_Offer($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_Offer = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_Offer = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_ID_Entity()
	{
		return stripslashes($this->ID_Entity);
	}
	
	public function set_ID_Entity($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_Entity = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_Entity = addslashes($valeur);
				}
		}
		
		if (trim($this->ID_Entity)=='')
		{
			$this->ID_Entity = null;
			$this->Parent_Entity = null;
		}
		
		if (!is_null($this->Parent_Entity))
			$this->get_Parent_Entity(1);
		return TRUE;
	}
	
	public function get_ID_SubCategory()
	{
		return stripslashes($this->ID_SubCategory);
	}
	
	public function set_ID_SubCategory($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_SubCategory = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_SubCategory = addslashes($valeur);
				}
		}
		
		if (trim($this->ID_SubCategory)=='')
		{
			$this->ID_SubCategory = null;
			$this->Parent_SubCategory = null;
		}
		
		if (!is_null($this->Parent_SubCategory))
			$this->get_Parent_SubCategory(1);
		return TRUE;
	}
	
	public function get_ID_Plan()
	{
		return stripslashes($this->ID_Plan);
	}
	
	public function set_ID_Plan($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_Plan = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_Plan = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_ID_Discount_coupon()
	{
		return stripslashes($this->ID_Discount_coupon);
	}
	
	public function set_ID_Discount_coupon($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_Discount_coupon = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_Discount_coupon = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Title()
	{
		return stripslashes($this->Title);
	}
	
	public function set_Title($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Title = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->Title = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Description()
	{
		return stripslashes($this->Description);
	}
	
	public function set_Description($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Description = NULL;
		}
		else
		{
			$this->Description = addslashes($valeur);
		}
		
		return TRUE;
	}
	
	public function get_Price()
	{
		return stripslashes($this->Price);
	}
	
	public function set_Price($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Price = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->Price = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Coverpic()
	{
		return stripslashes($this->Coverpic);
	}
	
	public function set_Coverpic($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Coverpic = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->Coverpic = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	public function get_Keywords()
	{
		return stripslashes($this->Keywords);
	}
	
	public function set_Keywords($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Keywords = NULL;
		}
		else
		{
			if(is_string($valeur))
				{
					$this->Keywords = addslashes($valeur);
				}
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
	
	public function get_Active()
	{
		return stripslashes($this->Active);
	}
	
	public function set_Active($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->Active = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->Active = addslashes($valeur);
				}
		}
		
		return TRUE;
	}
	
	// **********************
	// Specific get & set method for parents objects
	// **********************
	
	public function get_Parent_Entity($forced = 0)
	{
		
		$this->Parent_Entity = new entity($this->ID_Entity);

		return $this->Parent_Entity;
	}
	
	public function set_Parent_Entity($entity)
	{
		$this->ID_Entity=$entity->ID_Entity;
		$this->structure["ID_Entity"][3]=1;
		$this->isToSaveOrToUpdate=1;
		$this->Parent_Entity=$entity;
		return ($entity);
	}
			
	public function get_Parent_SubCategory($forced = 0)
	{
		
		$this->Parent_SubCategory = new categories_sub($this->ID_SubCategory);

		return $this->Parent_SubCategory;
	}
	
	public function set_Parent_SubCategory($categories_sub)
	{
		$this->ID_SubCategory=$categories_sub->ID_SubCategory;
		$this->structure["ID_SubCategory"][3]=1;
		$this->isToSaveOrToUpdate=1;
		$this->Parent_SubCategory=$categories_sub;
		return ($categories_sub);
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
		
		if ((isset($this->ID_Offer))&&($this->ID_Offer!=0))
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
				
				$query = parent::makequery('DELETE', $this->Database, 'offer', $this->structure);
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
		
		if ((is_null($this->ID_Offer))||($this->ID_Offer==0))
		{
			$this->isToSaveOrToUpdate=1;
			$this->isNew=1;
		}
		
		if (!is_null($this->Parent_Entity))
			$this->ID_Entity = $this->Parent_Entity->save($transaction);	
		
		if (!is_null($this->Parent_SubCategory))
			$this->ID_SubCategory = $this->Parent_SubCategory->save($transaction);	
		
		if ($this->isToSaveOrToUpdate==1)
		{
	
			if ((isset($this->ID_Offer))&&($this->ID_Offer!="0")&&($this->isNew!=1))
			{
				$query = parent::makequery('UPDATE', $this->Database, 'offer', $this->structure);
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
				$query = parent::makequery('INSERT', $this->Database, 'offer', $this->structure);
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
					$this->ID_Offer=$sql->sql_insert_id();
				$this->isNew=0;
			}
		}
	
		$this->isToSaveOrToUpdate=0;
		foreach ($this->structure as $field)
			if(isset($field[0]))
			{
				$this->structure[$field[0]][3]=0;
			}
	
		return $this->ID_Offer;
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
		$this->ID_Offer = null;
		$this->isToSaveOrToUpdate = 1;
		foreach ($this->struture as $field)
			if (($field[1] == 'ChildObject')&&(!is_null($this->{$field[0]})))
				foreach ($this->{$field[0]} as &$childvar)
					$childvar = clone $childvar;
	}
	
	private function loadallchildarray()
	{}
		
	//endofclass
}
	?>
	