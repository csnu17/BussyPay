<?php

class DatabaseConnection {

    private static $dsn = 'mysql:dbname=bussypay;host=localhost';
    private static $user = 'root';
    private static $pass = 'root';
    private static $con = null;

    public static function getInstance(): PDO {
        if (DatabaseConnection::$con === null) {
            $otp = array(
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            DatabaseConnection::$con = new PDO(
                DatabaseConnection::$dsn,
                DatabaseConnection::$user,
                DatabaseConnection::$pass,
                $otp  
            );
            return DatabaseConnection::$con;
        }

        return DatabaseConnection::$con;
    }

}
