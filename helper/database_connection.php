<?php

class DatabaseConnection {

    private static $dsn = 'mysql:dbname=bussypay;host=localhost';
    private static $user = 'root';
    private static $pass = 'root';
    private static $con = null;

    public static function getInstance() {
        if (DatabaseConnection::$con === null) {
            DatabaseConnection::$con = new PDO(
                DatabaseConnection::$dsn,
                DatabaseConnection::$user,
                DatabaseConnection::$pass
            );
            return DatabaseConnection::$con;
        }

        return DatabaseConnection::$con;
    }

}
