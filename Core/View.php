<?php

namespace Core;

use App\Helpers\ViewHelper;

/**
 * View
 */

class View
{
 
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

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);
        }

        // check if arguments were passed from controller
        // translate passed arguments
        if (!empty($args)) {
            $translated = self::formatArguments($args);
            $args = ['userData' => $args, 'dataLabel' => $translated];
        }
       
        //renders View
        echo $twig->render($template, $args);
    }

    /**
     * Call for formatting of arguments passed from the controller
     *
     * @param array $args Array of data from the controller
     * @return array $helper Array of data formatted by ViewHelper
     */
    private static function formatArguments($args)
    {
        $helper = new ViewHelper;
        return  $helper->translate($args);
    }
}
