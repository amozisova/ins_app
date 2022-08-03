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

    /**
     * Render a view template
     *
     * @param string $template The template
     * @param array $args Data passed into the view template
     * @return void
     */
    public static function renderTemplate(string $template, array $args = [])
    {
        static $twig = null;
        print "<pre>";
        print_r($args);
print "</pre>";
      

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);
        }

        // check if arguments were passed from controller
        // formate passed arguments
        if (!empty($args)) {
            $translated = self::formatArguments($args);
            $args = ['userData' => $args, 'translated' => $translated];
        }
       
        //renders View
        echo $twig->render($template, $args);
    }

    /**
     * Call for formatting of arguments passed from the controller
     *
     * @param array $args Array of data from the controller
     * @return array
     */
    private static function formatArguments($args)
    {
        $helper = new ViewHelper;
        return  $helper->translate($args);
    }
}
