<?php

use ORM\ORM;
use ORM\SQL\SQL;

/**
 * ORM __autoloader
 */

class ORMAutoloader {
	
	public function __construct()
	{ }
	
	public static function autoload($classname)
	{
		if(strstr($classname, "ORM\\"))
		{
			$classname = str_replace("ORM\\", "", $classname);
			
			if(file_exists(BLL . "$classname.php")) /* File exists dans le dossier BLL ? */
			{
				require BLL . "$classname.php";
			}
			elseif(file_exists(DAL . $classname . "_v". ORM::version .".php")) /* File exists dans le dossier DAL ? */
			{
				require DAL . $classname . "_v". ORM::version .".php";
			}
			else
			{
				$sql = new sql();

				if(AUTOGENERATE && $sql->sql_table_exists($classname)) /* Check si il peut etre g�n�rer et siil existe */
				{
					$ORM = new ORM();
					$content = $ORM->classgenerator($classname);
					
					if(ALWAYSAUTOGENERATE)
					{
						$content = str_replace("<?php", "", $content);
						$content = str_replace("?>", "", $content);
					
						eval($content);
					}
					else 
					{
						if($ORM->saveclasstofile($classname ."_v" . ORM::version .".php", $content, DAL))
						{
							require(DAL . $classname ."_v". ORM::version .".php");
						}
					}
				}
			}
		}
	}
	
	public static function RegisterAutoloader()
	{
		require libs . "ORM/SQL/sql.php";
		require libs . "ORM/Common.php";
		require libs . "ORM/Exception/Exception.php";
		require libs . "ORM/Exception/DALException.php";
		require libs . "ORM/ORM.php";

		if (version_compare(phpversion(), '5.3.0', '>=')) {
			spl_autoload_register(array(__CLASS__, 'autoload'), true, FALSE);
		} else {
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}
	}
	
}
