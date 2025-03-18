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

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    echo json_encode(['success' => false, 'error' => 'Username not set in session']);
    exit;
}

$username = $_SESSION['username'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];

$sql = "UPDATE tb_user SET fullname = '$fullname', address = '$address' WHERE username = '$username'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>