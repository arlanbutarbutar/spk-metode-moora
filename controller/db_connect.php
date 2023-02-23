
<?php 
$conn=mysqli_connect("localhost","root","","spk_metode_moora");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
