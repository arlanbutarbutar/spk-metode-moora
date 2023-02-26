<?php
$sql = "DELETE FROM users WHERE id_user='$_GET[id_user]'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('HAPUS berhasil');window.location = 'index.php?module=list_pengguna';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>