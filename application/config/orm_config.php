<?php
namespace ORM;

define("BLL", app . "models/");
define("DAL", libs . "DAL/");

define('SQL', 'sql');

//if u define SQL2, it will for database update delete insert, load (select will be for SQL constant)
define('SQL2', 'sql');

/* ORM configuration */
define('AUTOGENERATE', true);
define('ALWAYSAUTOGENERATE', false);
// if will able the Generator to make the missing class in DAL/class if on true
// so you can use this option, and delete DAL/ repertory after a database structure modification.

define('MYAUTOLOAD', true);
// if will load your specific class if exists in BLL/myclass

define('RELATION', 'relation'); // FK or RelationTableName or EMPTY ''
// define DAL will work for relation between object
// if FK based on database foreign key.
// if RELATION based on a RelationTableName table (if exists).
/*CREATE TABLE IF NOT EXISTS `relation` (
  `TABLE_SCHEMA` varchar(50) NOT NULL,
  `TABLE_NAME` varchar(50) NOT NULL,
  `COLUMN_NAME` varchar(50) NOT NULL,
  `REFERENCED_TABLE_SCHEMA` varchar(50) NOT NULL,
  `REFERENCED_TABLE_NAME` varchar(50) NOT NULL DEFAULT '',
  `REFERENCED_COLUMN_NAME` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;*/
// if '' no relation in DAL.

define('CASCADE', true);
// cascade delete able ?

$intotheset = "if (method_exists(get_class($"."this),'set_Version'))
                    if ($"."this->structure['Version'][3]==0)
                    {
                        $"."this->Version=$"."this->Version+1;
                        $"."this->structure['Version'][3]=1;
                        $"."this->structure['Version'][4]=$"."this->Version;
                    }
                if (method_exists(get_class($"."this),'set_LMD'))
                {
                    $"."this->LMD = date('Y-m-d H:i:s');
                    $"."this->structure['LMD'][3]=1;
                    $"."this->structure['LMD'][4]=$"."this->LMD;
                }
                if (method_exists(get_class($"."this),'set_ID_LM'))
                {
                    $"."this->LMD = date('Y-m-d H:i:s');
                    $"."this->structure['ID_LM'][3]=1;
                    if(isset(\$_SESSION[\"ID_Entity\"]))
                    {
                        \$this->structure['ID_LM'][4]=\$_SESSION[\"ID_Entity\"];
                    }
                    else
                    {
                        \$this->structure['ID_LM'][4]=0;
                    }
                }
                if ($"."this->isNew==1)
                {
                    if (method_exists(get_class($"."this),'set_CDate'))
                    {
                        $"."this->CDate = date('Y-m-d H:i:s');
                        $"."this->structure['CDate'][3]=1;
                        $"."this->structure['CDate'][4]=$"."this->CDate;
                    }
                    if (method_exists(get_class($"."this),'set_ID_C'))
                    {
                        $"."this->ID_C = date('Y-m-d H:i:s');
                        $"."this->structure['ID_C'][3]=1;
                        if(isset(\$_SESSION[\"ID_Entity\"]))
                        {
                            \$this->structure['ID_C'][4]=\$_SESSION[\"ID_Entity\"];
                        }
                        else
                        {
                            \$this->structure['ID_C'][4]=0;
                        }
                    }
                }
";

define('INTOTHESET', $intotheset);
?>