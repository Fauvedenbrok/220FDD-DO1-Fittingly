<?php

require_once __DIR__ . '/Core/Database.php';
// Fetch data from the table
$db = new Database();
$pdo = $db->getConnection();

$query = "SELECT * FROM Products";
$stmt = $pdo->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll();

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

if (!empty($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // Fallback if no referer is available
    header("Location: index.php"); // Change 'index.php' to your default page
    exit;
}

?>