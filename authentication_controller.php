<?php

include 'helper/database_connection.php';
include 'service/authentication_service.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $serviceAuthen = new AuthenticationService();
    $result = $serviceAuthen->login($username, $password);
}

echo json_encode($result);