<?php
// mengambil data koneksi
include "../../controller/koneksi.php";
// mengambil data dari form sebelumnya
$id_kriteria = $_POST['id_kriteria'];
$sub_kriteria = $_POST['sub_kriteria'];
$nilai_sub_kriteria = $_POST['nilai_sub_kriteria'];
// sql
$sql = "INSERT INTO tabel_sub_kriteria (id_kriteria, sub_kriteria, nilai_sub)
VALUES ('$id_kriteria', '$sub_kriteria', '$nilai_sub_kriteria')";
// eksekusi sql
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Input berhasil');window.location = '../index.php?module=list_sub_kriteria';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>