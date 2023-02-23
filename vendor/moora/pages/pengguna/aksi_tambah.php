<?php
// mengambil data koneksi
include "../../controller/koneksi.php";

// mengambil data dari form sebelumnya
$username = $_POST['username'];
$id_role = $_POST['id_role'];
$email = $_POST['email'];
$password = $_POST['password'];




// sql
$sql = "INSERT INTO users (id_role,username,password,email) VALUES ('$id_role', '$username', '$email','$password')";
mysqli_query($conn,$sql);
	echo "<script>alert('Input berhasil');window.location = '../index.php?module=list_pengguna';</script>";
/**
if ($conn->query($sql) === TRUE) {
	//mengambil id siswa terkahir yang baru saja dimasukan
	$sqlIdakhir = "SELECT id_user FROM users ORDER BY id_user DESC limit 1";
          $resultIdakhir = mysqli_query($conn, $sqlIdakhir);
              $hasil = mysqli_fetch_assoc($resultIdakhir);
              	$id_user = $hasil['id_user'];
              	
              	

			
				echo "<script>alert('Input berhasil');window.location = 'index.php?module=list_pengguna';</script>";
}
**/

// eksekusi sql

// if ($koneksi->query($sql) === TRUE) {
//     echo "<script>alert('Input berhasil');window.location = '../../index.php?module=list_kriteria';</script>";
// } else {
//     echo "Error: " . $sql . "<br>" . $koneksi->error;
// }

?>