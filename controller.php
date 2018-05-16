<?php

include 'service/user_information_service.php';
include 'helper/database_connection.php';
include 'service/authentication_service.php';

// $userInformationService = new UserServiceInformation();

// $result = $userInformationService->getAllUsers();

// if (isset($_GET['username'])) {
//     $username = $_GET['username'];
//     $result = $userInformationService->getUserByUsername($username);
// }

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $serviceAuthen = new AuthenticationService();
    $result = $serviceAuthen->login($username, $password);
}

if (is_null($result)) {
    exit();
}

echo json_encode($result);