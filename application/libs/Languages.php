<?php

/**
 * Class Languages.php
 */

/*
 * Classe louche pour chargé les traductions .xml
 */

class Config {

    private static $_singleton;
    private $xml;

    static function getInstance() {
        if(is_null (self::$_singleton) ) {
                self::$_singleton = new self;
        }
        return self::$_singleton;
    } 
    function open($xml_file) {
    	$this->xml = simplexml_load_file("https://raw.githubusercontent.com/xtuc/drivot-trads/master/Traductions/". $xml_file);
        //$this->xml = simplexml_load_file(libs . "Traductions/". $xml_file);
        return $this;
    }
    public function getConfig($path=null) {
        if (!is_object($this->xml)) {
            return false;
        }
        if (!$path) {
            return $this->xml;
        }
        $xml = $this->xml->xpath($path);
        if (is_array($xml)) {
            if (count($xml) == 1) {
                return (string)$xml[0];
            }
            if (count($xml) == 0) {
                return false;
            }
        }
        return $xml;
    }
}

class Languages
{
    /* Constantes */
    const default_lang = "en";

    /* Variables */
    private $lang;
    private $translates;

    function __construct()
    {
    	if(isset($_SESSION["lang"]))
    	{
    		$this->lang = $_SESSION["lang"];
    	}
    	else 
    	{
    		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
    		{
    			$navigator_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    		}
    		else 
    		{
    			$navigator_lang = self::default_lang;
    		}    		
    		 
    		if(is_file("https://raw.githubusercontent.com/xtuc/drivot-trads/master/Traductions/". $navigator_lang . ".xml"))
    		{
    			$this->lang = $navigator_lang;
    		}
    		else
    		{
    			$this->lang = self::default_lang;
    		}
    		
    		$this->lang = "en";
    	}
    	
        try {
            $this->loadLang();  
        } catch (Exception $e) {
            exit("Application error");
        }

    }
    
    public function GetLang()
    {
    	return $this->lang;
    }

    function loadLang()
    {
        $this->translates = Config::getInstance()
                            ->open($this->lang . '.xml');
    }
    
    function GettradObject()
    {
    	return $this->translates->getConfig();
    }

    function trad($key)
    {
        if(isset($this->translates))
        {
            if($this->translates->getConfig('/'. $this->lang. "/" . $key) !== NULL)
            {
                return $this->translates->getConfig('/'. $this->lang. "/" . $key);
            }
            else
            {
                return $this->translates->getConfig('/'. $this->lang. "/APPLICATION_ERROR");
            }
        }
        else
        {
            exit("Application error");
        }
    }
}

?>