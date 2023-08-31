<?php

class Router
{
    private array $routes;

    /**
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function display()
    {
        $currentRoute = $_SERVER['REQUEST_URI'];
        $urlRoute = explode('?', $currentRoute)[0];
        $found = false;
        foreach ($this->routes as $route) {
            if (in_array($urlRoute, $route->getPath())) {
                echo $route->getView()->renderView($route->dataSource);
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "<h2>ERROR 404 ROUTE '{$urlRoute}' NOT FOUND 🥺🥺🥺</h2> </br>";
        }

    }
}