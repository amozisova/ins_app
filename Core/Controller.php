<?php

namespace Core;

/**
 * Base controller
 */
abstract class Controller
{
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     * 
     * @param array $route_params  Parameters from the route
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. badge
     * Action methods need to be named with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name Method name
     * @param array $args Arguments passed to the method
     * @return void
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], $args);
        } else {
            throw new \Exception("Method $method not found in controller". get_class($this));
        }
    }

    /**
     * Redirect to a different page
     *
     * @param string $url  The relative URL
     * @return void
     */
    public function redirect($url)
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }

}
