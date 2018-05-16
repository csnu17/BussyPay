<?php

include 'service/user_information_service.php';
include 'helper/database_connection.php';

$userInformationService = new UserServiceInformation();

// $result = $userInformationService->getAllUsers();

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $result = $userInformationService->getUserByUsername($username);
}

if (is_null($result)) {
    exit();
}

echo json_encode($result);