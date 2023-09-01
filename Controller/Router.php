<?php

/**
 *
 */
class Router
{
    /**
     * @var array of Route classes
     */
    private array $routes;

    /**
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return void the function determining which route has to be shown, shows a not found page if a route is not found
     */
    public function display()
    {
        $currentRoute = $_SERVER['REQUEST_URI'];
        $urlRoute = explode('?', $currentRoute)[0];
        $found = false;
        foreach ($this->routes as $route) {
            if (in_array($urlRoute, $route->getPath())) {
                echo $route->getView()->renderView($route->getDataSource());
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "<h2>ERROR 404 ROUTE '{$urlRoute}' NOT FOUND 🥺🥺🥺</h2> </br>";
        }

    }
}