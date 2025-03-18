<?php
// Database connection details
$servername = "localhost";
$username   = "vinit";
$password   = vinit;
$dbname     = "vehicle";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session to get the logged-in user's ID
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $VehicleType = $_POST['VehicleType'];
    $Brand = $_POST['Brand'];
    $Model = $_POST['Model'];
    $Year  = $_POST['Year'];
    $Kms = $_POST['Kms'];
    $state = $_POST['state'];
    $fuel  = $_POST['fuel'];
    // $price = $_POST['price'];
    // $seller_id = $_SESSION['id']; // Assuming the user's ID is stored in the session
    $user = $_SESSION['username']; // Assuming the username is stored in the session

    // Handle file upload
    $imageName = "";
    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];
        $uploadPath= "upload/" . $imageName; 
        move_uploaded_file($imageTmp, $uploadPath);
    }

    // Insert into database
    $sql = "INSERT INTO sell_vehicle (VehicleType, Brand, Model, Year, Kms, state, fuel,image,user)
            VALUES ('$VehicleType', '$Brand', '$Model', '$Year', '$Kms', '$state', '$fuel', '$imageName', '$seller_id', '$user')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Vehicle added successfully!'); window.location.href='../sell.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='../sell.html';</script>";
    }
}

$conn->close();
?>