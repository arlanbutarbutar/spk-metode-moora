<?php
$sql = "DELETE FROM kriteria WHERE id_kriteria='$_GET[id_kriteria]'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('HAPUS berhasil');window.location = 'index.php?module=list_kriteria';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>