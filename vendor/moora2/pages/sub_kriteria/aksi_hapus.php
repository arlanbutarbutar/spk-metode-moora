<?php
$sql = "DELETE FROM tabel_sub_kriteria WHERE id_sub_kriteria='$_GET[id_sub_kriteria]'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('HAPUS berhasil');window.location = 'index.php?module=list_sub_kriteria';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>