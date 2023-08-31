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
        echo $urlRoute . "</br>";
        foreach ($this->routes as $route){
            if(in_array($urlRoute,$route->getPath())){
                echo $route->getView()->renderView("");
                break;
            }
        }
    }


}