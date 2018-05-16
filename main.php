<?php

include 'service/user_information_service.php';
include 'helper/database_connection.php';

$userInformationService = new UserServiceInformation();
$result = $userInformationService->getAllUsers();
echo json_encode($result);