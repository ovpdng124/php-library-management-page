<?php

class Database
{
    private static
        $dsn = "mysql:host=localhost;dbname=lib_management",
        $username = 'root',
        $pass = '123123',
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"),
        $connection = null;
    public function __construct()
    {
    }

    static function getConnectDB()
    {
        try {
            self::$connection = new PDO(self::$dsn, self::$username, self::$pass, self::$options);
            return self::$connection;
        } catch
        (PDOException $e) {
            echo "ERROR PDO: CONNECT ERROR";
            file_put_contents('PDOErrorLog.txt', $e->getMessage(),8);
        }
    }
    static function closeDB(){
        self::$connection = null;
    }
}
