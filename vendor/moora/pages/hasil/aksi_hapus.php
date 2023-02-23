<?php

$sql = "DELETE FROM tabel_hasil WHERE tanggal='$_GET[tanggal]'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('HAPUS berhasil');window.location = 'index.php?module=list_siswa';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>