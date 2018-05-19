<?php

require __DIR__ . '/../service/user_information_service.php';

$userInformationService = new UserServiceInformation();

$result = $userInformationService->getAllUsers();

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $result = $userInformationService->getUserByUsername($username);
}

echo $result;