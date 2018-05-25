<?php

require __DIR__ . '/../service/bus_information_service.php';

$busInformationService = new BusInformationService();

// Search bus by bus id, bus name, source, or destination.
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $result = $busInformationService->search($keyword);
}

else { // Get all buses.
    $result = $busInformationService->getAllBuses();    
}

echo $result;