<?php
session_start();
$host = "localhost";
$user = "vinit";
$pass = "Vinit_46";
$db = "vehicle";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$vehicleId = $_POST['vehicleId'];
$year = $_POST['year'];
$price = $_POST['price'];
$kms = $_POST['kms'];

$sql = "UPDATE sell_vehicle SET Year = '$year', price = '$price', Kms = '$kms' WHERE id = '$vehicleId'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>