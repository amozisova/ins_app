<?php

namespace Core;
use App\Helpers\ViewHelper;
/**
 * View
 */

class View
{
    /**
     * Render a view file
     *
     *@param string $view  The view file
     *@param array $args  Data passed into the view
     *
     *@return void
     */

    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP); //extracting array elements into individual variables

        $file = "../App/Views/$view"; // relative to the Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
    public static function renderTemplate(string $template, array $args=[])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);   
        }

       //  $singleArr=self::returnSingleArray($args);
      //   print_r($singleArr);
        //$userData=$args;
       
        //if(!empty($args))
     if(array_key_exists('user',$args) ) {
    $translated=self::translateData($args);
      
    $args=['userData'=> $args, 'translated' => $translated];

}


       

        print("<pre>".print_r($args,true)."</pre>");
   
       // print_r($translated);
        echo $twig->render($template, $args);
    }

    /*private static function prepareArguments($userData) {
        array_push($args, $translated, $singleArr);
    
    }*/

    private static function translateData($userData) {
        $helper=new ViewHelper;
        return $helper->translate($userData);
    
    }

    private static function returnSingleArray($userData) {
        $helper=new ViewHelper;
        return $helper->multipleToSingle($userData);
    
    }


}
