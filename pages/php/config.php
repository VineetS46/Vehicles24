<?php
// session_start();
$conn = mysqli_connect("localhost", "vinit", "Vinit_46", "vehicle");
if($conn->connect_error)
    {
        echo mysqli_connect_error();
    }
?> 