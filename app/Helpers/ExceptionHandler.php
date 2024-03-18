<?php

class ExceptionHandler {

public static function setUpErrorHandler() : void {
    set_error_handler(function ($severity, $message, $file, $line) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
}

public static function handleException(Throwable $th,$other='') : void {
    $mess = [
        "message" => $th->getMessage(),
        "line" => $th->getLine(),
        "code" => $th->getCode(),
        'file' => $th->getFile(),
        'date' => date('Y-m-d H:i:s'),
        'other' => $other,
    ];
    self::logger(json_encode($mess));
}

public static function logger(String $message) : void {
    $fullpath = __DIR__.'/log.txt';

    $fp = fopen($fullpath, 'a+'); // Opens file in append mode  
    fwrite($fp, $message . "\n"); // Append a newline character at the end of the message
    fclose($fp);  
}

}
