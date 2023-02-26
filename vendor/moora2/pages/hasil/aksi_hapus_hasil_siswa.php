<?php

$sql = "DELETE FROM tabel_hasil WHERE nama='$_GET[nama]'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('HAPUS berhasil');window.location = 'index.php?module=list_detail_siswa&&tanggal=$_GET[tanggal]';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>