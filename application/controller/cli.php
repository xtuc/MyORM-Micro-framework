<?php

class cli{

	function __construct()
	{
		if(!CLI)
		{
			exit("Only CLI");
		}
	}

	function index()
	{
		echo "USAGE : cli {resetDAL}\n";
	}

	function resetDAL()
	{
		if ($handle = opendir(DAL)) {

		    while (false !== ($entry = readdir($handle))) {
		    	if(preg_match("/([A-Za-z0-9.]*).php/i", $entry))
		    	{
		    		echo "Remove $entry\n";
		    		unlink(DAL . $entry);
		    	}
		    }

		    closedir($handle);
		}
	}
}

?>