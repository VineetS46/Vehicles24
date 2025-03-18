<?php
require 'config.php';
$_SESSION = [];
session_unset();
session_destroy();
echo '<script>    
 localStorage.removeItem("user1");
 location.replace("http://13.50.5.64/Vehicles24/login1.php")
 </script>';


?>