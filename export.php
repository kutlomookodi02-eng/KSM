<?php
$conn = new mysqli('localhost', 'root', '', 'KSM');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="inventory_report.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Product Name', 'Size', 'Colour', 'Price', 'Quantity Available', 'Quantity Sold', 'Created At'));

$query = "SELECT * FROM management";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
exit();
?>