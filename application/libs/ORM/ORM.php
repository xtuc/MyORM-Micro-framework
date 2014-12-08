<?php 

namespace ORM;

use ORM\SQL\SQL;

class ORM {
	
	/**
	 * Version à deux caracteres sinon l'__autoloader ne marche pas
	 */
	const version = 1.5;
	
	protected $localmode = 0;
	protected $ScreenError = 1;
	protected $sql;
	
	function __construct()
	{}
	
	public function saveclasstofile($filename,$filecontent,$directory)
	{
		if (!file_exists($directory))
		mkdir($directory);
		$handle = fopen($directory.$filename, "w");
		
		if(fwrite ( $handle , $filecontent ))
		{
			fclose($handle);
			
			return TRUE;
		}
		else 
		{
			fclose($handle);
			
			return FALSE;
		}
	}
	
	function classgenerator($table)
	{		
		$sqlconnect = new SQL();

		$select = "sql";
		if (defined(SQL2))
			$save = "sql";
		else
			$save = "sql";
	
		$relation = RELATION;
		$cascade = CASCADE;
	
		$intotheset = INTOTHESET;
		$interface = array();	
		$parents_func = array();
		$class = $table;
		$keychar="";
		$thisvarinparent ="";
		$key = "";
		$childobject  ="";
		
		$table_relation_exists = ($sqlconnect->sql_table_exists($relation)) ? TRUE : FALSE;
	
$c = "<?php
namespace ORM;
		
use ORM\SQL\SQL;
use ORM\Exception\DALException;
		
	/*
	*
	* -----------------------------------------------------------------------------------
	* ORM version : ". self::version ."
	* Class Name : $class
	* Generator : ORMGEN by PLATEL Renaud generated on ". gethostname() ."
	* Date Generated : ".date("d.m.Y H")."h
	* File name : $class.php
	* Table : ".$sqlconnect->get_Database().".$table 
	* -----------------------------------------------------------------------------------
	*/
	
class $class extends Common
{
	
	// **********************
	// Variables
	// **********************
	";
	
		/**
		 * Generate variables
		 */

				$result = $sqlconnect->sql_query("SHOW COLUMNS FROM $table");
				while ($row = $sqlconnect->sql_fetch_object($result))
				{
					$col = $row->Field;
					if (strpos($row->Type,"("))
					$type=substr($row->Type,0,strpos($row->Type,"("));
					else
					$type=$row->Type;
					if ($row->Null == "NO")
					$isnull = 0;
					else
					$isnull = 1;
	
					if($row->Key == "MUL")
					{
						$c.= "
	private $$col; // MUL
	const $col = '$col';";
						if ($type!="int")
						$keychar =1;
						$key = $col;
						$isnull = 2;
					}
					else if($row->Key == "PRI")
					{
						$c.= "
	private $$col; // PRI
	const $col = '$col'; // PRI
	const primary_key = '$col'; // PRI";
						if ($type!="int")
						$keychar =1;
						$key = $col;
						$isnull = 2;
					}
					else
					{
						$c.= "
	private $$col;
	const $col = '$col';";
					}
					$interface[$col] = array($col, $type, $isnull, 0);
				}
	
	if ($relation!="")
	{
				$c.="
	
	// **********************
	// Parents object for this class (Keys)
	// **********************
	";
				/* Relations for relation table of your database or foreign keys */
				if ($table_relation_exists)
				{
					$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE TABLE_NAME = '".$table."'";
					$result = $sqlconnect->sql_query($sql);
					$i=0;
					
					while ($row = $sqlconnect->sql_fetch_object($result))
					{					
						$parentvar="Parent".str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
						$interface[$parentvar] = array($parentvar, "ParentObject", 1, 0);
						$thisvarinparent[$i]=$row->COLUMN_NAME;
						$i++;
						$c.= "
	protected $$parentvar;";
					}
				}
				elseif ($relation=='FK')
				{
					$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '".$table."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."' AND REFERENCED_COLUMN_NAME IS NOT NULL";
	
					$result = $sqlconnect->sql_query($sql);
					$i=0;
					while ($row = $sqlconnect->sql_fetch_object($result))
					{
						$parentvar="Parent".str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
						$interface[$parentvar] = array($parentvar, "ParentObject", 1, 0);
						$thisvarinparent[$i]=$row->COLUMN_NAME;
						$i++;
						$c.= "
	protected $".$parentvar.";";
					}
				}
	}		
	
	if ($relation!="")
	{
				$c.="
	
	// **********************
	// Childs array of object for this class (Foreign Keys)
	// **********************
	";
	
				/* Relations for relation table of your database or foreign keys */
				if ($table_relation_exists)
				{
					$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE REFERENCED_TABLE_NAME = '".$table."'";
					$result = $sqlconnect->sql_query($sql);
					
					while ($row = $sqlconnect->sql_fetch_object($result))
					{
						$childvar=ucfirst($row->TABLE_NAME).str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
						$interface[$childvar] = array($childvar, "ChildObject", 1, 0);
						$c.= "
	protected $$childvar;";
					}
				}
				elseif ($relation=='FK')
				{
					$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."'";
					$result = $sqlconnect->sql_query($sql);
					while ($row = $sqlconnect->sql_fetch_object($result))
					{
						$childvar=ucfirst($row->TABLE_NAME).str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
						$interface[$childvar] = array($childvar, "ChildObject", 1, 0);
						$c.= "
	protected $$childvar;";
					}
				}
	}
	
				$c.= "
	
	// **********************
	// Interface to control the variable of this class and the update flag
	// **********************
	
	protected \$Database; // Database for this object
	public \$isNew = 0; // Memory for insert
	protected \$isToSaveOrToUpdate = 0; // Memory for update
	//Memory array of fields for update
	protected \$structure = array(
		";
			foreach($interface as $colomName=>$colomArray)
			{
			$c .= "'$colomName' => array('". $colomArray[0] ."', '". $colomArray[1] ."', '". $colomArray[2] ."', '". $colomArray[3] ."', '')";
				
				if(end($interface) !== $colomArray)
				{
		$c .= ",
		";
				}
			}
	$c .= "
	);
	
	// **********************
	// Constructor
	// **********************
	function __construct (\$val = null, \$property = self::primary_key, \$database = null)
	{
		if (is_null(\$database))
		{
		    \$this->Database = parent::sql()->Database;
		}
		else
		{
		    \$this->Database = \$database;
		}

		\$query = parent::sql()->sql_query(\"SELECT * FROM `$class` WHERE `\$property` = \". parent::sql()->quote(\$val) .\" LIMIT 1\");

		if(parent::sql()->sql_num_rows(\$query) != 0)
		{
			while(\$row = parent::sql()->sql_fetch_object(\$query))
            {
                ";
			foreach($interface as $colomName=>$colomArray)
			{
				if($colomArray[1] != "ChildObject" && $colomArray[1] != "ParentObject")
				{
				$c .= "\$this->$colomName = \$row->$colomName;
				\$this->structure['$colomName'][3]=1;
				\$this->structure['$colomName'][4] = \$row->$colomName;
				";
				}
			}
	$c .= "
            }
		}
		else
		{
			\$this->isNew=1;
			\$this->isToSaveOrToUpdate=1;
		}

		\$this->structure[\$property][4] = \$val;
	}
	";
	
	$c.="
	
	// **********************
	// Generic get & set method for this class
	// **********************
	
	";
	
	$c.="public function __get( \$property )
	{
	    if ( is_callable( array($"."this,'get_'.(string)$"."property) ) )
	        return call_user_func( array($"."this,'get_'.(string)$"."property) );
	    else
	        throw new DALException(\"get for \".$"."property.\" doesn't exists\");
	}
	
	public function __set( $"."property, $"."value )
	{
		if ( is_callable( array($"."this,'set_'.(string)$"."property) ) )
		{
			if ( $"."value != call_user_func( array($"."this,'get_'.(string)$"."property) ) )
			{
				call_user_func( array($"."this,'set_'.(string)$"."property), $"."value );
				$"."this->isToSaveOrToUpdate=1;
				$"."this->structure[\$property][3]=1;
				$"."this->structure[\$property][4] = \$value;";
				if (trim($intotheset)!="")
			$c.="
				".trim($intotheset);
			$c.="
			}
		}
		else
		{
			throw new DALException( \"set for \".$"."property.\" doesn't exists\");
		}
	}

	public function __isset(\$property = NULL)
    {
        if ( is_callable( array($"."this,'get_'.(string)$"."property) ) ) {
	        \$return = call_user_func( array($"."this,'get_'.(string)$"."property) );

	       	if(empty(\$return) || is_null(\$return))
		    {
		    	return FALSE;
		    }
		    else
		    {
		    	return TRUE;
		    }
	    }
	    else {
	        throw new DALException(\"get for \".$"."property.\" doesn't exists\");
	    }
    }

    public function __unset(\$property)
    {
        if ( is_callable( array(\$this,'set_'.(string)$"."property) ) )
	        return call_user_func( array($"."this,'set_'.(string)$"."property), NULL );
	    else
	        throw new DALException(\"set for \".$"."property.\" doesn't exists\");
    }
	
	// **********************
	// Specific get & set method for this class
	// **********************
	
	public function get_isNew()
	{
		return intval(\$this->isNew);
	}
					
	public function get_structure()
	{
		return \$this->structure;		
	}
	
	";
	
	
	$sql="SHOW COLUMNS FROM `".$table."`";
	
	$result = $sqlconnect->sql_query($sql);
	while ($row = $sqlconnect->sql_fetch_object($result))
	{
		$col=$row->Field;
		$c.="public function get_".$col."()
	{
		return stripslashes($"."this->".$col.");
	}
	
	";
	
			$c.="public function set_".$col."(\$valeur = null)
	{
		if(is_null(\$valeur))
		{
			\$this->$col = NULL;
		}
		else
		{
			";
			
			if(isset($interface[$col]))
			{
				switch($interface[$col][1])
				{
					case "int":
		$c .= "if(is_numeric(\$valeur) && \$valeur >= 0)
				{
					\$this->$col = addslashes(\$valeur);
				}
				else
				{
					throw new DALException('$class::$col must be a valid integer');
				}";
						break;
					case "varchar":
		$c .= "if(is_string(\$valeur))
				{
					\$this->$col = addslashes(\$valeur);
				}
				else
				{
					throw new DALException('$class::$col must be a valid string');
				}";
						break;
					default:
		$c .= "\$this->$col = addslashes(\$valeur);";
						break;
				}
			}
			
		$c .= "
		}
		";
	
			if (is_array($thisvarinparent))
			{
				if (in_array($col, $thisvarinparent))
				{
					$varname="Parent".str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $col )));
	
					$c.="
		if (trim($"."this->".$col.")=='')
		{
			$"."this->".$col." = null;
			$"."this->".$varname." = null;
		}
		
		if (!is_null($"."this->".$varname."))
			$"."this->get_".ucfirst($varname)."(1);";
	
				}
			}
			$c.="
		return TRUE;
	}
	
	";
	}
	
	if ($relation!="")
	{
	$c.="// **********************
	// Specific get & set method for parents objects
	// **********************
	
	";
	
	if ($table_relation_exists)
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE TABLE_NAME = '".$table."'";
	}
	else
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '".$table."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."' AND REFERENCED_COLUMN_NAME IS NOT NULL";
	}
	
	$result = $sqlconnect->sql_query($sql);
	
	if ($sqlconnect->sql_num_rows($result) !== 0)
	{	
		while ($row = $sqlconnect->sql_fetch_object($result))
		{
				$varname=str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
				$parenttable=$row->REFERENCED_TABLE_NAME;
				$parentcolumn=$row->REFERENCED_COLUMN_NAME;
				$childcolumn=$row->COLUMN_NAME;
				$childobject = $row->REFERENCED_TABLE_NAME;
				
			$parents_func[] = "get_Parent".ucfirst($varname)."";
			
	$c.= "public function get_Parent".ucfirst($varname)."(\$forced = 0)
	{
		
		\$this->Parent".$varname." = new $childobject($"."this->".$childcolumn.");

		return $"."this->Parent".$varname.";
	}
	
	public function set_Parent".ucfirst($varname)."($"."$childobject)
	{
		\$this->$childcolumn=$".$childobject."->".$parentcolumn.";
		\$this->structure[\"$childcolumn\"][3]=1;
		\$this->isToSaveOrToUpdate=1;
		\$this->Parent$varname=$$childobject;
		return ($".$childobject.");
	}
			
	";
		}
		}
	}
	
	if ($relation!="")
	{
	$c.="// **********************
	// Specific get & set method for childs objets
	// **********************
	";
	
	if ($table_relation_exists)
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."'";
	}
	else
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."'";
	}
	$result = $sqlconnect->sql_query($sql);
	if ($sqlconnect->sql_num_rows($result)>0)
	{
	while ($row = $sqlconnect->sql_fetch_object($result))
	{
		$varname=ucfirst($row->TABLE_NAME).str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
		
		$childtable=$row->TABLE_NAME;
		$childobject=$row->TABLE_NAME;
		$childcolumn=$row->COLUMN_NAME;
	
		$col = $sqlconnect->sql_primary_key($childtable);
		if (is_null($col))
		{
			$orderby="";
		}
		else
		{
			$orderby=" ORDER BY ".$col;
		}
	
		if ($keychar==1)
		{
			$querydelete = "\"DELETE FROM `$childtable` WHERE $childcolumn = '\".$"."this->$key".".\"'\"";
			$query="\"SELECT * FROM `$childtable` WHERE $childcolumn = '\".$"."this->$key".".\"'";
			if ($orderby!="") $query.=$orderby."\""; else $query.= "\"";
		}
		else
		{
			$query="\"SELECT * FROM `$childtable` WHERE $childcolumn = \".$"."this->$key";
			if ($orderby!="") $query.=".\"".$orderby."\"";
			$querydelete = "\"DELETE FROM `$childtable` WHERE $childcolumn = \".$"."this->$key";
		}
	
		$c.="
	public function get_".ucfirst($varname)."()
	{
		global $"."$select;
		
		if ((is_null($"."this->".$varname."))&&(!is_null($"."this->$key)))
		{
			$"."query=".$query.";
			$"."result=parent::sql(SQL::read)->sql_query($"."query);
			while($"."row = parent::sql(SQL::read)->sql_fetch_object(\$result,'ORM\\$childobject'))
			{
				$"."this->add_".ucfirst($varname)."($"."row);
			}
		}
		return ($"."this->".$varname.");
	}
	
	public function set_".ucfirst($varname)."($".$childobject."s)
	{
		if (count($"."this->".$varname.")==0)
			foreach ($".$childobject."s as $"."var)
				add_".ucfirst($varname)."($"."var);
		else
			throw new DALException( \"Can set ".$varname." cause actual ".$varname." is not empty\");
		return ($".$childobject."s);
	}
	
	public function add_".ucfirst($varname)."(".$childobject." $".$childobject.")
	{
		if ($".$childobject."->$childcolumn!=$"."this->$key)
			$".$childobject."->$childcolumn=$"."this->$key;
		$"."count=count($"."this->".$varname.");
		while (isset($"."this->".$varname."[$"."count]))
			$"."count++;
		$"."this->".$varname."[$"."count]=$".$childobject.";
	}
	
	public function remove_".ucfirst($varname)."(".$childobject." $"."remove".$childobject.")
	{
		foreach ($"."this->".ucfirst($varname)." as $"."var)
		{
			if ($"."remove".$childobject." == $"."var)
			{
				$"."var->delete();
				$"."this->".$childobject." = null;
			}
		}
	}
	
	protected function save_".ucfirst($varname)."($"."transaction = null)
	{
		foreach ($"."this->$varname as $"."$childobject)
		{
			if ($".$childobject."->$childcolumn!=$"."this->$key)
				$".$childobject."->$childcolumn=$"."this->$key;
			$".$childobject."->save($"."transaction);
		}
	}
	
	public function delete_".ucfirst($varname)."($"."transaction = null)
	{
		global $"."$save;
		if (isset($"."this->$varname))
			foreach ($"."this->$varname as $"."$childobject)
			{
				$".$childobject."->delete($"."transaction);
			}
		
		$"."query = ".$querydelete.";
		parent::sql(SQL::write)->sql_query($"."query);
		if (parent::sql(SQL::write)->sql_error())
		{
			$"."erreur=parent::sql(SQL::write)->sql_error().\"<br>\".$"."query;
			if ($"."transaction==\"On\")
			{
				parent::sql(SQL::write)->sql_rollbacktransaction();
			}
			throw new DALException($"."erreur);
		}
		else
			return parent::sql(SQL::write)->sql_affected_rows();
		
		$"."this->".ucfirst($varname)."= null;
	}
	";
	}
	}
	}
	
	/* delete, cascade for childs arrays*/
	$c.="
	// **********************
	// DELETE
	// **********************
	
	public function delete($"."transaction = null)
	{
		global $"."$save;
		$"."thistransaction = \"Off\";
		$"."return = null;
		
		if ((isset($"."this->$key))&&($"."this->$key!=0))
		{
			if (is_null($"."transaction))
			{
				$"."thistransaction=\"On\";
				$"."transaction = \"On\";
				if (parent::sql(SQL::write)->TransactionMode == 1)
					parent::sql(SQL::write)->sql_starttransaction();
			}
	";
	
	if ($table_relation_exists)
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."'";
	}
	else
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."'";
	}
	$result = $sqlconnect->sql_query($sql);
	
	if ($sqlconnect->sql_num_rows($result)>0)
	{
	while ($row = $sqlconnect->sql_fetch_object($result))
	{
		$varname=ucfirst($row->TABLE_NAME).str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
		$childtable=$row->TABLE_NAME;
		$childobject= $row->TABLE_NAME;
		$childcolumn=$row->COLUMN_NAME;
	
		$c.="		if ((count($"."this->get_".$varname."())!=0)&&(CASCADE))
				$"."this->delete_".$varname."($"."transaction);
	";
	}
	}
	
	$c.= "		if (($"."transaction==\"On\"))
			{
				";
	
	$c .= "
				$"."query = parent::makequery('DELETE', $"."this->Database, '".$class."', $"."this->structure);
				parent::sql(SQL::write)->sql_query($"."query);
				if (parent::sql(SQL::write)->sql_error())
				{
					$"."erreur=parent::sql(SQL::write)->sql_error().\"<br>\".$"."query;
					if (parent::sql(SQL::write)->TransactionMode == 1)
					{
						parent::sql(SQL::write)->sql_rollbacktransaction();
					}
					throw new DALException($"."erreur);
				}
				else
					$"."return = parent::sql(SQL::write)->sql_affected_rows();
			}
			if ((parent::sql(SQL::write)->TransactionMode == 1)&&($"."thistransaction==\"On\"))
			{
				parent::sql(SQL::write)->sql_committransaction();
			}
			return $"."return;
		}
		foreach ($"."this->structure as $"."field)
			unset($"."this->$"."field[0]);	
	}
	";
	
	$c.="
	// **********************
	// SAVE (INSERT or UPDATE)
	// **********************
	
	public function save(\$transaction = null)
	{		
		\$thistransaction = \"Off\";
		
		if ((is_null($"."this->".$key."))||($"."this->".$key."==0))
		{
			$"."this->isToSaveOrToUpdate=1;
			$"."this->isNew=1;
		}
		";
	/* Parents save if some changes */
	if ($table_relation_exists)
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE TABLE_NAME = '".$table."'";
	}
	else
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '".$table."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."' AND REFERENCED_COLUMN_NAME IS NOT NULL";
	}
	$result = $sqlconnect->sql_query($sql);
	if ($sqlconnect->sql_num_rows($result)>0)
	{
	while ($row = $sqlconnect->sql_fetch_object($result))
	{
		$varname=str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
		$parenttable=$row->REFERENCED_TABLE_NAME;
		$parentcolumn=$row->REFERENCED_COLUMN_NAME;
		$childcolumn=$row->COLUMN_NAME;
		$childobject = $row->REFERENCED_TABLE_NAME;
	
		$c.="
		if (!is_null($"."this->"."Parent".$varname."))
			$"."this->$childcolumn = $"."this->"."Parent".$varname."->save($"."transaction);	
		";
	}
	}
	$c.="
		if ($"."this->isToSaveOrToUpdate==1)
		{
	
			if ((isset($"."this->$key))&&($"."this->$key!=\"0\")&&($"."this->isNew!=1))
			{
				\$query = parent::makequery('UPDATE', $"."this->Database, '".$class."', \$this->structure);
				\$result=parent::sql(SQL::write)->sql_query($"."query);
			}
			else
			{
				\$query = parent::makequery('INSERT', $"."this->Database, '".$class."', $"."this->structure);
				parent::sql(SQL::write)->sql_query($"."query);
				\$this->$key=parent::sql(SQL::write)->sql_insert_id();
				\$this->isNew=0;
			}
		}
	";
	
	if ($table_relation_exists)
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."'";
	}
	else
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."'";
	}
	$result = $sqlconnect->sql_query($sql);
	if ($sqlconnect->sql_num_rows($result)>0)
	{
	while ($row = $sqlconnect->sql_fetch_object($result))
	{
		$varname=ucfirst($row->TABLE_NAME).str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
		$childtable=$row->TABLE_NAME;
		$childobject= $row->TABLE_NAME;
		$childcolumn=$row->COLUMN_NAME;
	
		$c.="
		if (!is_null($"."this->".$varname."))
			$"."this->save_".$varname."($"."transaction);
		";
	
	}
	}
	
	$c.= "
		$"."this->isToSaveOrToUpdate=0;
		foreach ($"."this->structure as $"."field)
			if(isset($"."field[0]))
			{
				$"."this->structure[$"."field[0]][3]=0;
			}
	
		return $"."this->$key;
	}

	public function last_insert(\$property = self::primary_key)
	{
		\$query = parent::sql()->sql_query(\"SELECT \$property AS last FROM `$class` ORDER BY \".self::primary_key.\" DESC LIMIT 1\");
		\$last = parent::sql()->sql_fetch_row(\$query);

		return \$last[\"last\"];
	}
	
	public function __toString()
	{
		$"."this->LoadAllChilds();
		$"."return = \"<p>Object \".__CLASS__.\" (<br>\";
		foreach ($"."this->struture as $"."field)
			if ($"."field[1] == 'ChildObject')
			{
				//$"."i=0;
				//if (!is_null($"."this->{"."$"."field[0]}))
				//	foreach ($"."this->{"."$"."field[0]} as &$"."childvar)
				//	{
				//		$"."return .= $"."field[0].\"[$"."i] => \".$"."this->{"."$"."field[0]}[$"."i].\"<br>\";
				//		$"."i++;
				//	}
			}
			else
				$"."return .= $"."field[0].\" => \".$"."this->{"."$"."field[0]}.\"<br>\";
		$"."return .= \")</p>\";
		return $"."return;
	}
	
	public function __toJson()
	{
		$"."return = \"{\";
		foreach ($"."this->struture as $"."field)
		{
			if ( ($"."field[1] == 'ChildObject') && (!is_null($"."this->{"."$"."field[0]})) )
			{
				$"."return .= '\"'.$"."field[0].'\":';
				$"."return .= \"[\";
				$"."i=0;
				foreach ($"."this->{"."$"."field[0]} as &$"."childvar)
				{
					$"."return .= $"."childvar->__toJson();
					$"."return .= \",\";
					$"."i++;
				}
				$"."return = substr($"."return, 0, -1);
				$"."return .= \"],\";
			}
			else
			{
				/*
				if ( is_callable( array($"."this,'get_'.(string)$"."field[0]) ) )
	  				call_user_func( array($"."this,'get_'.(string)$"."field[0]) );
	  			*/
				if ($"."this->{"."$"."field[0]}==\"\")
				{
					if ($"."field[2]==1)
					{
						$"."return .= '\"'.$"."field[0].'\":null,';
					}
					else
					{
						$"."return .= '\"'.$"."field[0].'\":\"\",';
					}
				}
				else
				{
					if (($"."field[1]!='date')&&($"."field[1]!='datetime')&&($"."field[1]!='char')&&($"."field[1]!='varchar')&&($"."field[1]!='tinyblob')&&($"."field[1]!='tinytext')&&($"."field[1]!='blob')&&($"."field[1]!='text')&&($"."field[1]!='mediumblob')&&($"."field[1]!='mediumtext')&&($"."field[1]!='longblob')&&($"."field[1]!='longtext')&&($"."field[1]!='time')&&($"."field[1]!='enum'))
					{
						$"."return .= '\"'.$"."field[0].'\":'.$"."this->{"."$"."field[0]}.',';
					}
					else
					{
						$"."return .= '\"'.$"."field[0].'\":\"'.$"."this->{"."$"."field[0]}.'\",';
					}
				}
			}
		}
		$"."return = substr($"."return,0,-1);
		$"."return .= \"}\";
		return $"."return;
	}
	
	public function __clone()
	{
		\$this->LoadAllChilds();
		\$this->$key = null;
		\$this->isToSaveOrToUpdate = 1;
		foreach ($"."this->struture as $"."field)
			if (($"."field[1] == 'ChildObject')&&(!is_null($"."this->{"."$"."field[0]})))
				foreach ($"."this->{"."$"."field[0]} as &$"."childvar)
					$"."childvar = clone $"."childvar;
	}
							
	public function LoadAllParents()
	{
";
		foreach($parents_func as $func)
		{
		$c .= "		\$this->$func();";
		}
$c .= "
	}
	
	public function LoadAllChilds()
	{";
	if ($table_relation_exists)
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME ,REFERENCED_COLUMN_NAME FROM ".$relation." WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."'";
	}
	else
	{
		$sql="SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = '".$table."' AND REFERENCED_COLUMN_NAME = '".$key."' AND TABLE_SCHEMA = '".$sqlconnect->get_Database()."'";
	}
	$result = $sqlconnect->sql_query($sql);
	
	if ($sqlconnect->sql_num_rows($result)>0)
	{
		while ($row = $sqlconnect->sql_fetch_object($result))
		{
			$varname=ucfirst($row->TABLE_NAME).str_replace ( "Id" , "" , str_replace ( "id" , "" , str_replace ( "ID" , "" , $row->COLUMN_NAME )));
			$childtable=$row->TABLE_NAME;
			$childobject= $row->TABLE_NAME;
			$childcolumn=$row->COLUMN_NAME;
		
			$c.="
			\$this->get_".$varname."();";
		}
	}
	$c.="}
		
	//endofclass
}
	?>
	";
		return $c;
	}
	
}
?>
