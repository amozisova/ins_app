<?php

namespace Core;

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
    public static function renderTemplate(string $template, array $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);   
        }

        echo $twig->render($template, $args);
    }
}
