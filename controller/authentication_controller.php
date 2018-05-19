<?php

require  __DIR__ . '/../service/authentication_service.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $serviceAuthen = new AuthenticationService();
    $result = $serviceAuthen->login($username, $password);
}

echo $result;