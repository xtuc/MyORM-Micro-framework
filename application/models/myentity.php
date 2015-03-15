<?php

namespace ORM;

class myentity extends entity
{
    private $Entityspecificity_Interface;
    private $Entityfeaturerights_Interface;

    function __construct($id = null, $property = parent :: primary_key)
    {
    	parent :: __construct($id, $property);

        $this->get_Entityspecificity_Interface();
    }
    
    static function login($username, $userPassword)
    {
        $sql = new SQL\sql();
        $request = $sql->sql_query("SELECT ID_Entity FROM entity WHERE CEmail = '" . $username ."' OR Name = '". $username ."' LIMIT 1");
        $myentity = $sql->sql_fetch_object($request);

        if($myentity)
        {
            $myentity = new myentity($myentity->ID_Entity);

            if(!$myentity->isNew && password_verify($userPassword,$myentity->Password))
            {
                $_SESSION["ID_Entity"] = $myentity->ID_Entity;
                $_SESSION["mail"] = $myentity->CEmail;
                $_SESSION["time"] = time();
                $_SESSION["profilImg"] = $myentity->profilImg;

                $url = "http://10.32.195.206:27067/?";
                $url .= "cookie=" . $_COOKIE["PHPSESSID"];
                $url .= "&ID_Entity=" . urlencode($myentity->ID_Entity);
                $url .= "&publicID=" . urlencode($myentity->publicID);
                $url .= "&FirstName=" . urlencode($myentity->FirstName);
                $url .= "&LastName=" . urlencode($myentity->LastName);
                $url .= "&time=" . time();

                echo $url;

                file_get_contents($url);

                return true;
            }

        }

        return false;
    }
    
    public function __get( $property )
    {
        if (!is_null($this->Entityspecificity_Interface) && array_key_exists($property, $this->Entityspecificity_Interface))
        {
			return($this->Entityspecificity_Interface[$property]["Value"]);
        }
        elseif ( is_callable( array($this,'get_'.(string)$property) ) )
            return call_user_func( array($this,'get_'.(string)$property) );
        else
            trigger_error( "get for ".$property." doesn't exists", E_USER_ERROR );
    }

    public function __set( $property, $value )
    {
        if ( $property != "ID_Entity")
            if (!is_null($this->Entityspecificity_Interface) && array_key_exists($property, $this->Entityspecificity_Interface ))
            {
            	if (
                    !is_null($this->Entityspecificity_Interface[$property]["Entityspecificity_EntityRow"]) 
                    && $this->Entityspecificity_Interface[$property]["Entityspecificity_EntityRow"] != 0)
                {
					$this->Entityspecificity_Interface[$property]["Value"] = $value;
                    $id = $this->Entityspecificity_Interface[$property]["Entityspecificity_EntityRow"];
					$this->Entityspecificity_Entity[$id]->Value = $value;
                }
                else
                {
                    $row = new entityspecificity();
                    $row->Value = $value;
                    $row->ID_Specificity = $this->Entityspecificity_Interface[$property]["Specificity_ID"];
                    $this->Entityspecificity_Interface[$property]["Value"] = $value;
                    $this->Entityspecificity_Interface[$property]["LMD"] = date("Y-m-d H:i:s");
                    $this->Entityspecificity_Interface[$property]["Entityspecificity_EntityRow"] = count($this->Entityspecificity_Entity);
                    $this->add_Entityspecificity_Entity($row);
                }
            }
            elseif (method_exists("myentity", 'set_'.(string)$property))
            {

                /**
                 * La condition ne mene � rien, ca empeche le save() de ->Name par exemple
                 * Cela explique le fait que sur mon autre projet je n'arrive pas � save()
                 * NTel (je pense que tu te rapelles de cette merde) uniquement via myentity
                 * A l'�poque je n'avais pas vu ce passage.
                 *
                 *
                 */

                if (isset($this->structure[$property]))
                {
                	$this->isToSaveOrToUpdate=1;
                    $this->structure[$property][3]=1;
                }                 

                call_user_func( array($this,'set_'.(string)$property), $value);
            }
            elseif (method_exists($this, 'set_'.(string)$property))
            {
                /**
                 * La function existe dans le parent ($this)
                 * on l'appelle
                 */
                parent :: __set($property, $value);
            }

            else
                  trigger_error( "set for ".$property." doesn't exists", E_USER_ERROR );
        else {
            trigger_error( "cant set primary unique key ".$property, E_USER_ERROR );
        }
    }

    public function get_Entityspecificity_Entity()
    {
        if(is_null($this->Entityspecificity_Entity))
        {
            $this->Entityspecificity_Interface = array();

            /**
             * On charge les specificity en function de l'ID_EntityType
             */

            if(!is_null($this->ID_EntityType) && $this->ID_EntityType!='')
            {
                $query="SELECT specificity.*
            FROM entitytype
            INNER JOIN specificity ON entitytype.SpecificityBinValue & specificity.BinValue = specificity.BinValue
            WHERE entitytype.ID_EntityType = ".$this->ID_EntityType."
            ORDER BY specificity.BinValue";
                    $result=parent :: sql()->sql_query($query);
                    while($row = parent :: sql()->sql_fetch_object($result,"ORM\\specificity"))
                    {
                        $this->Entityspecificity_Interface[$row->Name]["Entityspecificity_EntityRow"] = NULL;
                        $this->Entityspecificity_Interface[$row->Name]["Value"] = NULL;
                        $this->Entityspecificity_Interface[$row->Name]["LMD"] = NULL;
                        $this->Entityspecificity_Interface[$row->Name]["Specificity_ID"] = $row->ID_Specificity;
                    }
            }
            else
            {
                /**
                 * Charger les spec par d�fault
                 */
                    $query="SELECT *
                    FROM specificity
                    WHERE BinValue = 0";

                    $result=parent :: sql()->sql_query($query);
                    while($row = parent :: sql()->sql_fetch_object($result,"ORM\\specificity"))
                    {
                        $this->Entityspecificity_Interface[$row->Name]["Entityspecificity_EntityRow"] = NULL;
                        $this->Entityspecificity_Interface[$row->Name]["Value"] = NULL;
                        $this->Entityspecificity_Interface[$row->Name]["LMD"] = NULL;
                        $this->Entityspecificity_Interface[$row->Name]["Specificity_ID"] = $row->ID_Specificity;
                    }
            }

            if(!is_null($this->ID_Entity) 
                && $this->ID_Entity != ""
                && !is_null($this->ID_EntityType) 
                && $this->ID_EntityType!='')
            {
                $query="SELECT entityspecificity.*
        FROM entitytype
        INNER JOIN specificity ON entitytype.SpecificityBinValue & specificity.BinValue = specificity.BinValue
        INNER JOIN entityspecificity ON specificity.ID_specificity = entityspecificity.ID_specificity
        WHERE entitytype.ID_EntityType = ".$this->ID_EntityType." AND entityspecificity.ID_Entity = ".$this->ID_Entity."
        ORDER BY specificity.BinValue";
    
                $result=parent :: sql()->sql_query($query);
    
                //Cas des valeurs sp�cifiques d�j� existante en base de donn�es
                while($row = parent :: sql()->sql_fetch_object($result,"ORM\\entityspecificity"))
                {
                    $this->add_Entityspecificity_Entity($row);
    
                    $this->Entityspecificity_Interface[$row->Parent_Specificity->Name]["Entityspecificity_EntityRow"] = count($this->Entityspecificity_Entity)-1;
                    $this->Entityspecificity_Interface[$row->Parent_Specificity->Name]["Value"] = $row->Value;
                    $this->Entityspecificity_Interface[$row->Parent_Specificity->Name]["LMD"] = $row->LMD;
                    $this->Entityspecificity_Interface[$row->Parent_Specificity->Name]["Specificity_ID"] = $row->ID_Specificity;
                }
    
                $query="SELECT specificity.*
        FROM entitytype
        INNER JOIN specificity ON entitytype.SpecificityBinValue & specificity.BinValue = specificity.BinValue
        LEFT JOIN entityspecificity ON specificity.ID_specificity = entityspecificity.ID_specificity
        WHERE entitytype.ID_EntityType = ".$this->ID_EntityType." AND ( entityspecificity.ID_Entity = ".$this->ID_Entity." OR entityspecificity.ID_Entity IS NULL ) AND entityspecificity.ID_Entityspecificity IS NULL
        ORDER BY specificity.BinValue";
    
                $result=parent :: sql()->sql_query($query);
                
                //Cas des valeurs possible par le gabary BinValue du Type mais pas encore existante.
                while($row = parent :: sql()->sql_fetch_object($result,"ORM\\specificity"))
                {
                    $this->Entityspecificity_Interface[$row->Name]["Entityspecificity_EntityRow"] = null;
                    $this->Entityspecificity_Interface[$row->Name]["Value"] = null;
                    $this->Entityspecificity_Interface[$row->Name]["LMD"] = null;
                    $this->Entityspecificity_Interface[$row->Name]["Specificity_ID"] = $row->ID_Specificity;
                }
            }
        }


        return ($this->Entityspecificity_Entity);
    }

    public function get_Entityspecificity_Interface()
    {
        $this->get_Entityspecificity_Entity();
        return $this->Entityspecificity_Interface;
    }
}

?>