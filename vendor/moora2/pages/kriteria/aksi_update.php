<?php
include "../../controller/koneksi.php";
$id_kriteria = $_GET['id_kriteria'];
$kode_kriteria = $_POST['kode_kriteria'];
$kriteria = $_POST['kriteria'];
$type = $_POST['type'];
$bobot = $_POST['bobot'];
$sql = "UPDATE kriteria SET kode_kriteria='$kode_kriteria',kriteria='$kriteria',type='$type',bobot='$bobot' WHERE id_kriteria=$id_kriteria";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('UPDATE berhasil');window.location = '../index.php?module=list_kriteria';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>