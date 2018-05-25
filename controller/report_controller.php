<?php

require __DIR__ . '/../service/report_service.php';

$reportService = new ReportService();
echo $reportService->generateCSVfile();