<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pw2024_tubes_233040020";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
