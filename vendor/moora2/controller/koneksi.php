<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "spk_metode_moora";

// create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>
