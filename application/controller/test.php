<?php

class test extends Controller {

	var $writableDirs = array(
		"application/SQL",
		DAL,
	);

	function __construct()
	{
		if(!CLI)
		{
			echo "<pre>";			
		}
	}

	function index()
	{
		/**
		 * Test writable dirs
		 */

		echo "---------- Write test ---------- \n";

		$i = 0;
		while(isset($this->writableDirs[$i]))
		{
			if(is_writable($this->writableDirs[$i]))
			{
				echo "[OK] " . $this->writableDirs[$i] . "\n";
			}
			else
			{
				exit("[FAIL] " . $this->writableDirs[$i] . "\n");
			}

			$i++;
		}
	}
}

?>