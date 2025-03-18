<?php
session_start();
require 'config.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $vehicleId = $_GET['id'];

    // Fetch vehicle details
    $vehicleResult = mysqli_query($conn, "SELECT * FROM sell_vehicle WHERE id = '$vehicleId'");
    if (!$vehicleResult) {
        echo json_encode(['error' => 'Error fetching vehicle details: ' . mysqli_error($conn)]);
        exit;
    }
    $vehicle = mysqli_fetch_assoc($vehicleResult);

    if ($vehicle) {
        // Fetch seller details
        $sellerId = $vehicle['seller_id'];
        $sellerResult = mysqli_query($conn, "SELECT fullname, username, email, phonenumber, gender,address FROM tb_user WHERE id = '$sellerId'");
        if (!$sellerResult) {
            echo json_encode(['error' => 'Error fetching seller details: ' . mysqli_error($conn)]);
            exit;
        }
        $seller = mysqli_fetch_assoc($sellerResult);

        echo json_encode(['vehicle' => $vehicle, 'seller' => $seller]);
    } else {
        echo json_encode(['error' => 'Vehicle not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>