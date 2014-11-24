<?php

use ORM\ORM;
/**
 * Class bdd
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class bdd extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/bdd (which is the default page btw)
     */
    public function index()
    {    
    	
    }
    
    /**
     * PAGE: get
     * This method handles what happens when you move to http://yourproject/bdd/get (which is the default page btw)
     */
    public function get($table = NULL, $ID = 0)
    {        
    	$ID = intval($ID);
    	
    	if(class_exists("ORM\\" . $table))
    	{
$syntax = "\$result = new ORM\\$table($ID);
	\$result->LoadAllParents();
	\$result->LoadAllChilds();";

			$time_start = microtime(true);
     		eval($syntax);
     		$time_end = microtime(true);
     		$time = $time_end - $time_start;    

     		if(isset($GLOBALS["sqlStats"]))
     		{
     			$sqlSyntax = $GLOBALS["sqlStats"];
     			unset($GLOBALS["sqlStats"]);
     		}
     		else 
     		{
     			$sqlSyntax = NULL;
     		}
     		
     		if(file_exists(DAL . $table . "_v".ORM::version.".php"))
     		{
     			$DALlinecounter = round(count(file(DAL . $table . "_v".ORM::version.".php")) / 2);
     		}
     		else 
     		{
     			$DALlinecounter = 0;
     		}     		
     		
     		$this->render("bdd/get", array(
     				"DALlength" => $DALlinecounter,
     				"get" => $table,
     				"result" => $result,
     				"syntax" => $syntax,
     				"SQLsyntax" => $sqlSyntax,
     				"microtime" => round($time, 5, PHP_ROUND_HALF_DOWN)
     		));
    	}    
    	else 
    	{
    		exit("Table $table doesn't exists");
    	}			
    }
    
    /**
     * PAGE: set
     * This method handles what happens when you move to http://yourproject/bdd/set (which is the default page btw)
     */
    public function set($table = NULL, $ID = 0)
    {
    	$ID = intval($ID);
    	$needsave = FALSE;
    	
    	if(class_exists("ORM\\" . $table))
    	{
$syntax = "\$result = new ORM\\$table($ID);
";
			eval($syntax);
			
			if(isset($_POST))
			{
				foreach($_POST as $key=>$value)
				{
					if(key_exists($key, $result->structure))
					{
						$needsave = TRUE;
	$syntax .= "	\$result->$key = '$value';
";
					}
				}
			}
			
			if($needsave)
			{
				$syntax	.= "	\$result->save();";
			}
			
			eval($syntax);
			
			/**
			 * Générate form
			 */
			$structure = array();
			
			foreach($result->structure as $array)
			{
				if(!is_array($result->$array[0]) && $array[1] != "ChildObject" && $array[1] != "ParentObject") {
					$structure[$array[0]] = $result->$array[0];
				}
			}
			
			reset($structure); //Safety - sets pointer to top of array
			$firstKey = key($structure); // Returns the first key of it
			unset($structure[$firstKey]);

			$sqlSyntax = NULL;
			
			if(isset($GLOBALS["sqlStats"]))
			{
				foreach($GLOBALS["sqlStats"] as $stat)
				{
					if(!preg_match("/SELECT/", $stat))
					{
						$sqlSyntax[] = $stat;
					}
				}
				
				unset($GLOBALS["sqlStats"]);
			}

			$this->render("bdd/set", array(
					"SQLsyntax" => $sqlSyntax,
					"syntax" => $syntax,
					"structure" => $structure
			));

    	}    
    	else 
    	{
    		exit("Table $table doesn't exists");
    	}
    }
}
