<?php

require 'loader/autoloader.php';


$router = new Router([

  
    new Route(
        '/',
        function ($context) {
           
            return Viewer::view('app/View/index.php', $context);
        }
    ),
    new Route(
        '/login',
        function ($context) {
           
            return Viewer::view('app/View/Auth/login.php', $context);
        }
    ), 
    new Route(
        '/actions',
        function ($context) {
           
            return Viewer::view('app/Model/actions.php', $context);
        }
    ),

]);

$router->launch();