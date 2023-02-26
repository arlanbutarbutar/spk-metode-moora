<?php
$sql = "DELETE FROM tabel_siswa WHERE id_siswa='$_GET[id_siswa]'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('HAPUS berhasil');window.location = 'index.php?module=list_siswa';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>