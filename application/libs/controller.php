<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{    
    public function render($view, $data_array = array())
    {
        // load Twig, the template engine
        // @see http://twig.sensiolabs.org
        $twig_loader = new Twig_Loader_Filesystem(PATH_VIEWS);
        $twig = new Twig_Environment($twig_loader, array(
        		'debug' => true
        ));
        $twig->addExtension(new Twig_Extension_Debug());
        
        if(isset($_SESSION) && is_array($data_array))
        {
        	$data_array["SESSION"] = $_SESSION;
        }
        
        if(isset($_GET))
        {
        	$data_array["GET"] = $_GET;
        }
        
        // render a view while passing the to-be-rendered data
        echo $twig->render($view . PATH_VIEW_FILE_TYPE, $data_array);
    }
}
