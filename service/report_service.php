<?php

require __DIR__ . '/../helper/database_connection.php';

class ReportService {

    function generateCSVfile(): string {
        $con = DatabaseConnection::getInstance();

        $sql = "SELECT transactions.transaction_number, transactions.amount, transactions.transaction_date, 
                        users.first_name, users.last_name, buses.bus_name,buses.source, buses.terminal, transaction_status.status FROM transactions 
                        INNER JOIN users ON transactions.user_id = users.id 
                        INNER JOIN transaction_status ON transactions.status = transaction_status.id 
                        INNER JOIN buses ON transactions.bus_id = buses.id 
                        ORDER BY transactions.id DESC";

        $stmt = $con->prepare($sql);
        $stmt->execute();

        // Create directory for .csv files if needed.
        $filelocation = '../reports/';

        if (!file_exists($filelocation)) {
            mkdir($filelocation, 0777, true);
        }

	    $filename = 'export-' . date('Y-m-d H.i.s') . '.csv';
	    $file_export  =  $filelocation . $filename;
        $data = fopen($file_export, 'w');

        // Support utf-8
        fprintf($data, "\xEF\xBB\xBF");

        $csv_fields = array();

        // Create CSV column.
        $csv_fields[] = 'Transaction ID';
        $csv_fields[] = 'Amount';
        $csv_fields[] = 'Date';
        $csv_fields[] = 'First name';
        $csv_fields[] = 'Last name';
        $csv_fields[] = 'Bus name';
        $csv_fields[] = 'Source';
        $csv_fields[] = 'Destination';
        $csv_fields[] = 'Status';

	    fputcsv($data, $csv_fields);

        // Insert data in each row.
        while ($row = $stmt->fetch()) {
            fputcsv($data, $row);
        }

        // Close writing file operation.
        fclose($data);

        return json_encode(array('code' => 200, 'message' => 'Exported .csv file successfully.'));
    }

}