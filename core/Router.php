<?php

class Router
{
    /**
     * Holds the registered routes.
     *
     * @var Route[]
     */
    private $routes = [];

    /**
     * Requested route (URL).
     *
     * @var string
     */
    private $action;

    /**
     * Register a new route.
     *
     * @param $routes List of Routes
     */
    public function __construct($routes = [])
    {
        $this->routes = $routes;
        $this->action = $_SERVER['REQUEST_URI'];
    }

    /**
     * Launch the router and match the current request to a route.
     */
    public function launch()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $scriptName = $_SERVER['SCRIPT_NAME'];

        // Determine the base path of the application (e.g., /task1)
        $basePath = dirname($scriptName);

        // Remove the base path from the request URI
        if (strpos($requestUri, $basePath) === 0) {
            $requestUri = substr($requestUri, strlen($basePath));
        }

        $requestUri = trim($requestUri, '/');

        // Removing subfolder from URL and correct root route
        $action = trim($requestUri, '/');
        $action = trim(explode('?', $action)[0], '/');

        $selectedRoute = null;
        $params = [];

        foreach ($this->routes as $route) {
            if (preg_match("%^{$route->endpoint}$%", $action, $matches) === 1) {
                $selectedRoute = $route;
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                break;
            }
        }

        if (is_null($selectedRoute) || !is_callable($selectedRoute->view)) {
            exit(Viewer::error(404));
        }

        exit(call_user_func($selectedRoute->view, array_merge($params, $_GET)));
    }
}
