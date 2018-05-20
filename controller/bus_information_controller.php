<?php

require __DIR__ . '/../service/bus_information_service.php';

$busInformationService = new BusInformationService();

// Get bus by id.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $busInformationService->getBusById($id);
}

// Search bus by bus name, source, or destination.
else if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $result = $busInformationService->search($keyword);
}

else { // Get all buses.
    $result = $busInformationService->getAllBuses();    
}

echo $result;