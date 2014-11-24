<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct()
    {
    	
    }

    public function render($view, $data_array = array())
    {
        // load Twig, the template engine
        // @see http://twig.sensiolabs.org
        $twig_loader = new Twig_Loader_Filesystem(PATH_VIEWS);
        $twig = new Twig_Environment($twig_loader, array(
        		'debug' => true
        ));
        $twig->addExtension(new Twig_Extension_Debug());
        
        if(isset($_SESSION))
        {
        	$data_array["SESSION"] = $_SESSION;
        }
        
        if(isset($_GET))
        {
        	$data_array["GET"] = $_GET;
        }
        
        if(isset($GLOBALS["languages"]))
        {
        	$data_array["trads"] = $GLOBALS["languages"]->GettradObject();
        }
        
        // render a view while passing the to-be-rendered data
        echo $twig->render($view . PATH_VIEW_FILE_TYPE, $data_array);
    }
}
