
<?php


// define db connection
// define('dbhost', 'localhost');
// define('dbuser', 'root');
// define('dbpass', '');
// define('dbname', 'car');


spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../core/' .$class. '.php';
   
    if (!file_exists($path)){
        $path = __DIR__ . '/../app/View/' .$class. '.php';
    }
    if (!file_exists($path)){
        $path = __DIR__ . '/../app/Controller/' .$class. '.php';
    }
    if (!file_exists($path)){
        $path = __DIR__ . '/../app/Model/' .$class. '.php';
    }
    if (!file_exists($path)){
        $path = __DIR__ . '/../app/Helpers/' .$class. '.php';
    }
    require $path;
});
Config::init();