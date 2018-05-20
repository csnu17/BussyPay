<?php

require __DIR__ . '/../service/bus_information_service.php';

$busInformationService = new BusInformationService();

// Get bus by id.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $busInformationService->getBusById($id);
} else { // Get all buses.
    $result = $busInformationService->getAllBuses();    
}

echo $result;