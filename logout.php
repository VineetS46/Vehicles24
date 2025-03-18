<?php
require 'config.php';
$_SESSION = [];
session_unset();
session_destroy();
echo '<script>    
 localStorage.removeItem("user1");
 location.replace("http://13.50.5.64/home/login1.php")
 </script>';


?>