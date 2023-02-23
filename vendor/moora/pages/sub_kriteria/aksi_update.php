<?php
include "../../controller/koneksi.php";
$id_sub_kriteria = $_GET['id_sub_kriteria'];
$id_kriteria = $_POST['id_kriteria'];
$sub_kriteria = $_POST['sub_kriteria'];
$nilai_sub = $_POST['nilai_sub'];
$sql = "UPDATE tabel_sub_kriteria SET id_kriteria='$kode_kriteria',sub_kriteria='$sub_kriteria',nilai_sub='$nilai_sub' WHERE`tabel_sub_kriteria`.`id_sub_kriteria` =$id_sub_kriteria";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('UPDATE berhasil');window.location = '../index.php?module=list_sub_kriteria';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
