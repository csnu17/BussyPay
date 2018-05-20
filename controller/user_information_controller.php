<?php

require __DIR__ . '/../service/user_information_service.php';

$userInformationService = new UserServiceInformation();

// Get user by username.
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $result = $userInformationService->getUserByUsername($username);
}

// Search user by first name, last name, email, or phone
else if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $result = $userInformationService->search($keyword);
}

else { // Get all users.
    $result = $userInformationService->getAllUsers();    
}

echo $result;