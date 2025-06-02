<?php
use Models\CrudModel;
use Core\Database;

require_once '../../../Models/CrudModel.php';
require_once '../../../Core/Database.php';

// ob_start();

$data = CrudModel::readAll("Articles");
// Set CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');

$output = fopen('php://output', 'w');

// Fetch column names dynamically
$columns = array_keys($data[0]); // Get column names from first row
fputcsv($output, $columns);

// Write row data
foreach ($data as $row) {
    fputcsv($output, $row);
}

fclose($output);

// ob_end_flush();

?>