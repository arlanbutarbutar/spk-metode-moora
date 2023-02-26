<?php
// mengambil data koneksi
include "../../controller/koneksi.php";
// mengambil data dari form sebelumnya
$kode_kriteria = $_POST['kode_kriteria'];
$kriteria = $_POST['kriteria'];
$type = $_POST['type'];
$bobot = $_POST['bobot'];
// sql
$sql = "INSERT INTO kriteria (kode_kriteria,kriteria, type, bobot)
VALUES ('$kode_kriteria','$kriteria', '$type', '$bobot')";
// eksekusi sql
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Input berhasil');window.location = '../index.php?module=list_kriteria';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>