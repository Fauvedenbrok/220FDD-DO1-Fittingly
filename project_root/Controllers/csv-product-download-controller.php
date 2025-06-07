<?php
use Models\CrudModel;
use Core\Database;

require_once '../Models/CrudModel.php';
require_once '../Core/Database.php';

/**
 * Downloads all articles from the database as a CSV file.
 *
 * This script fetches all records from the "Articles" table and outputs them as a CSV file
 * with appropriate headers for download.
 *
 * @package Controllers
 */

// Fetch all article data from the database
$data = CrudModel::readAll("Articles");

// Set HTTP headers to indicate a CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');

// Open output stream for writing CSV data
$output = fopen('php://output', 'w');

/**
 * Write the column headers to the CSV file.
 * @var array $columns The column names, dynamically fetched from the first row of data.
 */
$columns = array_keys($data[0]); // Get column names from first row
fputcsv($output, $columns);

/**
 * Write each row of article data to the CSV file.
 * @var array $row An associative array representing a single article.
 */
foreach ($data as $row) {
    fputcsv($output, $row);
}

// Close the output stream
fclose($output);



?>