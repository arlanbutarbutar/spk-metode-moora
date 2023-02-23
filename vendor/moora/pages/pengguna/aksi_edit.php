<?php
// mengambil data koneksi
require_once "../../controller/koneksi.php";
// mengambil data dari form sebelumnya
$id_role = $_POST['id_role'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$id_user = $_GET['id_user'];

  //mengambil id siswa terkahir yang baru saja dimasukan
                
                
                $sqlPengguna = "UPDATE users SET id_role='$id_role', username='$username',email='$email',password='$password' WHERE id_user ='$id_user' ";
                $conn->query($sqlPengguna);

        echo "<script>alert('Input berhasil');window.location = 'index.php?module=list_pengguna';</script>";


// eksekusi sql

// if ($koneksi->query($sql) === TRUE) {
//     echo "<script>alert('Input berhasil');window.location = '../../index.php?module=list_kriteria';</script>";
// } else {
//     echo "Error: " . $sql . "<br>" . $koneksi->error;
// }

?>