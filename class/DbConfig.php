<?php
/**
 * File: ConnectDb.php
 * Organization: TOO SMART APP
 * Author: Marlen Bissaliyev
 * Date: 30/05/2020
 * Time: 4:11 PM
 */

// Singleton to connect db.
class DbConfig {
    // Hold the class instance.
    private static $instance = null;
    private $conn;
//
//    private $host = 'localhost';
//    private $user = 'root';
//    private $pass = '';
//    private $name = 'ost';

    private  $name = 'data';
    private $host = 'localhost:3306';
    private $user = 'root';
    private $pass = '';
    private $enc = 'charset=utf8';
    private $opt  = array(
        PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        // you may wish to set other options as well
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

    // The db connection is established in the private constructor.
    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->name}", $this->user,$this->pass, $this->opt);
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new DbConfig();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

?>