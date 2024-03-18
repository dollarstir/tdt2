<?php

class DbModel
{
    public $conn;

    public function __construct()
    {
        try {

         
            $this->conn  = new PDO('mysql:host='.Config::get("DB_HOST").';dbname='.Config::get("DB_NAME").'', ''.Config::get("DB_USER").'', ''.Config::get("DB_PASS").'');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<h1 style="color:red;">ERROR: Failed to connect  Database</h1>';
        }
    }

}

