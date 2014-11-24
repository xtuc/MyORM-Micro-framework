<?php
namespace ORM;
		
	/*
	*
	* -----------------------------------------------------------------------------------
	* ORM version : 1.3
	* Class Name : categories_sub
	* Generator : ORMGEN by PLATEL Renaud generated on Xtuc-PC
	* Date Generated : 16.11.2014 17h
	* File name : categories_sub.php
	* Table : ORM_test_unit.categories_sub 
	* -----------------------------------------------------------------------------------
	*/
	
class categories_sub extends CommonORM
{
	
	// **********************
	// Variables
	// **********************
	
	private $ID_SubCategory; // PK
	private $ID_ParentCategory;
	private $Value;
	
	// **********************
	// Parents object for this class (Keys)
	// **********************
	
	protected $Parent_ParentCategory;
	
	// **********************
	// Childs array of object for this class (Foreign Keys)
	// **********************
	
	protected $Offer_SubCategory;
	
	// **********************
	// Interface to control the variable of this class and the update flag
	// **********************
	
	protected $Database; // Database for this object
	public $isNew; // Memory for insert
	protected $isToSaveOrToUpdate; // Memory for update
	//Memory array of fields for update
	protected $structure = array(
		'ID_SubCategory' => array('ID_SubCategory', 'int', '2', '0', ''),
		'ID_ParentCategory' => array('ID_ParentCategory', 'int', '0', '0', ''),
		'Value' => array('Value', 'varchar', '0', '0', ''),
		'Parent_ParentCategory' => array('Parent_ParentCategory', 'ParentObject', '1', '0', ''),
		'Offer_SubCategory' => array('Offer_SubCategory', 'ChildObject', '1', '0', '')
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
			$this->structure['ID_SubCategory'][4] = $id;
			$query = parent::makequery('SELECT', $this->Database, 'categories_sub', $this->structure);
			$result=$sql->sql_query($query);
	
			if ($sql->sql_num_rows($result)==1)
			{
				$row = $sql->sql_fetch_object($result);
	
				$this->ID_SubCategory = $row->ID_SubCategory;
				$this->ID_ParentCategory = $row->ID_ParentCategory;
				$this->Value = $row->Value;
				$this->isToSaveOrToUpdate=0;
			}
			else
			{
				$this->ID_SubCategory = $id;
				$this->isNew=1;
				$this->isToSaveOrToUpdate=1;
			}
		}
	
	    if (is_null($this->ID_SubCategory))
	    {
	        $this->isNew=1;
			$this->isToSaveOrToUpdate=1;
	    }
		else
	    {
	    	$this->structure['ID_SubCategory'][4] = $this->ID_SubCategory;
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
		
		return TRUE;
	}
	
	public function get_ID_ParentCategory()
	{
		return stripslashes($this->ID_ParentCategory);
	}
	
	public function set_ID_ParentCategory($valeur = null)
	{
		if(is_null($valeur))
		{
			$this->ID_ParentCategory = NULL;
		}
		else
		{
			if(is_numeric($valeur))
				{
					$this->ID_ParentCategory = addslashes($valeur);
				}
		}
		
		if (trim($this->ID_ParentCategory)=='')
		{
			$this->ID_ParentCategory = null;
			$this->Parent_ParentCategory = null;
		}
		
		if (!is_null($this->Parent_ParentCategory))
			$this->get_Parent_ParentCategory(1);
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
	
	public function get_Parent_ParentCategory($forced = 0)
	{
		
		$this->Parent_ParentCategory = new categories($this->ID_ParentCategory);

		return $this->Parent_ParentCategory;
	}
	
	public function set_Parent_ParentCategory($categories)
	{
		$this->ID_ParentCategory=$categories->ID_Category;
		$this->structure["ID_ParentCategory"][3]=1;
		$this->isToSaveOrToUpdate=1;
		$this->Parent_ParentCategory=$categories;
		return ($categories);
	}
			
	// **********************
	// Specific get & set method for childs objets
	// **********************
	
	public function get_Offer_SubCategory()
	{
		global $sql;
		
		if ((is_null($this->Offer_SubCategory))&&(!is_null($this->ID_SubCategory)))
		{
			$query="SELECT * FROM `offer` WHERE ID_SubCategory = ".$this->ID_SubCategory." ORDER BY ID_Offer";
			$result=$sql->sql_query($query);
			while($row = $sql->sql_fetch_object($result,"ORM\offer"))
			{
				$this->add_Offer_SubCategory($row);
			}
		}
		return ($this->Offer_SubCategory);
	}
	
	public function set_Offer_SubCategory($offers)
	{
		if (count($this->Offer_SubCategory)==0)
			foreach ($offers as $var)
				add_Offer_SubCategory($var);
		else
			trigger_error( "Can set Offer_SubCategory cause actual Offer_SubCategory is not empty", E_USER_ERROR );
		return ($offers);
	}
	
	public function add_Offer_SubCategory(offer $offer)
	{
		if ($offer->ID_SubCategory!=$this->ID_SubCategory)
			$offer->ID_SubCategory=$this->ID_SubCategory;
		$count=count($this->Offer_SubCategory);
		while (isset($this->Offer_SubCategory[$count]))
			$count++;
		$this->Offer_SubCategory[$count]=$offer;
	}
	
	public function remove_Offer_SubCategory(offer $removeoffer)
	{
		foreach ($this->Offer_SubCategory as $var)
		{
			if ($removeoffer == $var)
			{
				$var->delete();
				$this->offer = null;
			}
		}
	}
	
	private function save_Offer_SubCategory($transaction = null)
	{
		foreach ($this->Offer_SubCategory as $offer)
		{
			if ($offer->ID_SubCategory!=$this->ID_SubCategory)
				$offer->ID_SubCategory=$this->ID_SubCategory;
			$offer->save($transaction);
		}
	}
	
	public function delete_Offer_SubCategory($transaction = null)
	{
		global $sql;
		if (isset($this->Offer_SubCategory))
			foreach ($this->Offer_SubCategory as $offer)
			{
				$offer->delete($transaction);
			}
		
		$query = "DELETE FROM `offer` WHERE ID_SubCategory = ".$this->ID_SubCategory;
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
		
		$this->Offer_SubCategory= null;
	}
	
	// **********************
	// DELETE
	// **********************
	
	public function delete($transaction = null)
	{
		global $sql;
		$thistransaction = "Off";
		$return = null;
		
		if ((isset($this->ID_SubCategory))&&($this->ID_SubCategory!=0))
		{
			if (is_null($transaction))
			{
				$thistransaction="On";
				$transaction = "On";
				if ($sql->TransactionMode == 1)
					$sql->sql_starttransaction();
			}
			if ((count($this->get_Offer_SubCategory())!=0)&&(CASCADE))
				$this->delete_Offer_SubCategory($transaction);
			if (($transaction=="On"))
			{
				
				$query = parent::makequery('DELETE', $this->Database, 'categories_sub', $this->structure);
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
		
		if ((is_null($this->ID_SubCategory))||($this->ID_SubCategory==0))
		{
			$this->isToSaveOrToUpdate=1;
			$this->isNew=1;
		}
		
		if (!is_null($this->Parent_ParentCategory))
			$this->ID_ParentCategory = $this->Parent_ParentCategory->save($transaction);	
		
		if ($this->isToSaveOrToUpdate==1)
		{
	
			if ((isset($this->ID_SubCategory))&&($this->ID_SubCategory!="0")&&($this->isNew!=1))
			{
				$query = parent::makequery('UPDATE', $this->Database, 'categories_sub', $this->structure);
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
				$query = parent::makequery('INSERT', $this->Database, 'categories_sub', $this->structure);
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
					$this->ID_SubCategory=$sql->sql_insert_id();
				$this->isNew=0;
			}
		}
	
		if (!is_null($this->Offer_SubCategory))
			$this->save_Offer_SubCategory($transaction);
		
		$this->isToSaveOrToUpdate=0;
		foreach ($this->structure as $field)
			if(isset($field[0]))
			{
				$this->structure[$field[0]][3]=0;
			}
	
		return $this->ID_SubCategory;
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
		$this->ID_SubCategory = null;
		$this->isToSaveOrToUpdate = 1;
		foreach ($this->struture as $field)
			if (($field[1] == 'ChildObject')&&(!is_null($this->{$field[0]})))
				foreach ($this->{$field[0]} as &$childvar)
					$childvar = clone $childvar;
	}
	
	private function loadallchildarray()
	{
			$this->get_Offer_SubCategory();
		}
		
	//endofclass
}
	?>
	