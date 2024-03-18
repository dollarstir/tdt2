<?php

class Path {
    // Dynamically determine the application root directory
    static function root($path = "") {
        $rootPath = realpath(dirname(__FILE__) . '/..'); // Adjusted to get the parent directory of the current file
        return $rootPath . '/' . ltrim($path, "/");
    }

    // Dynamically rebase URLs to include the application root directory
    static function rebase($path = "") {
        $scriptName = $_SERVER['SCRIPT_NAME']; // E.g., /task1/index.php
        $scriptDirectory = dirname($scriptName); // E.g., /task1
        
        // Handle fully qualified URLs differently
        if(strpos($path, 'http') === 0 || strpos($path, 'www.') === 0) {
            return $path;
        }

        // Construct the rebased path
        $rebasedPath = rtrim($scriptDirectory, '/') . '/' . ltrim($path, '/');
        return $rebasedPath;
    }
}
