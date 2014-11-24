<?php

namespace ORM;

class myentity extends entity
{

    public $Entityspecificity_Interface = array();

    function __construct($id = null)
    {
        parent :: __construct($id);
        $this->get_Entityspecificity_Interface();
        // Les trucs a rajouter.
    }
    
public function __get( $property )
    {
        if (array_key_exists($property, $this->Entityspecificity_Interface))
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
            if (array_key_exists($property, $this->Entityspecificity_Interface ))
            {
                if (!is_null($this->Entityspecificity_Interface[$property]["Entityspecificity_EntityRow"]))
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
                    $this->add_Entityspecificity_Entity($row);
                }
            }
            elseif ( is_callable( array($this,'set_'.(string)$property) ) )
            {
                if (isset($this->structure[$property]) && array_key_exists($property, $this->structure[$property] ))
                {
                	$this->isToSaveOrToUpdate=1;
                	$this->structure[$property][3]=1;
                }
                call_user_func( array($this,'set_'.(string)$property), $value );
            }

            else
                  trigger_error( "set for ".$property." doesn't exists", E_USER_ERROR );
        else
            trigger_error( "cant set primary unique key ".$property, E_USER_ERROR );
    }

    public function get_Entityspecificity_Entity()
    {
        //On charge uniquement les specificitys prévues par le type d'entité. (Le gabarie est entitytype.SpecificityBinValue)
        if (empty($this->Entityspecificity_Entity) && (is_null($this->Entityspecificity_Entity))&&(!is_null($this->ID_Entity)))
        {
            $query="SELECT entityspecificity.*
    FROM entitytype
    INNER JOIN specificity ON entitytype.SpecificityBinValue & specificity.BinValue = specificity.BinValue
    INNER JOIN entityspecificity ON specificity.ID_specificity = entityspecificity.ID_specificity
    WHERE entitytype.ID_EntityType = ".$this->ID_EntityType." AND entityspecificity.ID_Entity = ".$this->ID_Entity."
    ORDER BY specificity.BinValue";
            $result=$this->sql->sql_query($query);

            while($row = $this->sql->sql_fetch_object($result,"ORM\\entityspecificity"))
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
            $result=$this->sql->sql_query($query);
            while($row = $this->sql->sql_fetch_object($result,"ORM\\specificity"))
            {
				$this->Entityspecificity_Interface[$row->Name]["Entityspecificity_EntityRow"] = null;
				$this->Entityspecificity_Interface[$row->Name]["Value"] = null;
				$this->Entityspecificity_Interface[$row->Name]["LMD"] = null;
				$this->Entityspecificity_Interface[$row->Name]["Specificity_ID"] = $row->ID_Specificity;
            }
        }
        return ($this->Entityspecificity_Entity);
    }

    public function get_Entityspecificity_Interface()
    {
        $this->get_Entityspecificity_Entity();
        return $this->Entityspecificity_Interface;
    }

    public function save($transaction = NULL)
    {
        parent::save($transaction);
        $this->Entityspecificity_Entity = null;
    }
}
?>