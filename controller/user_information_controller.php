<?php

require __DIR__ . '/../service/user_information_service.php';

$userInformationService = new UserServiceInformation();

// Search user by first name, last name, email, or phone
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $result = $userInformationService->search($keyword);
}

else { // Get all users.
    $result = $userInformationService->getAllUsers();    
}

echo $result;