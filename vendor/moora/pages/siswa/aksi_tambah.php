<?php
// mengambil data koneksi
include "../../controller/koneksi.php";
// mengambil data dari form sebelumnya
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$ttl = $_POST['ttl'];
$nr = $_POST['nilai_raport'];
$pk = $_POST['presensi_kehadiran'];
$pt = $_POST['pekerjan_orang_tua'];
$pot = $_POST['penghasilan_orang_tua'];
$jt = $_POST['jumlah_tanggungan'];
$kk = $_POST['kondisi_keluarga'];




// sql
$tambah = "INSERT INTO tabel_siswa (nama, jenis_kelamin, ttl,nilai_raport,presensi_kehadiran,pekerjan_orang_tua,penghasilan_orang_tua,jumlah_tanggungan,kondisi_keluarga)
VALUES ('$nama', '$jenis_kelamin', '$ttl','$nr','$pk','$pt','$pot','$jt','$kk')";

if ($conn->query($tambah) == TRUE) {
	//mengambil id siswa terkahir yang baru saja dimasukan
	$sqlIdakhir = "SELECT id_siswa FROM tabel_siswa ORDER BY id_siswa DESC limit 1";
          $resultIdakhir = mysqli_query($conn, $sqlIdakhir);
              $hasil = mysqli_fetch_assoc($resultIdakhir);
              	$id_siswa = $hasil['id_siswa'];
              	

              	
              	//insert data to table nilai.
              	$sNR = "INSERT INTO tabel_nilai (id_kriteria, id_siswa, nilai)
						VALUES ('1', '$id_siswa', '$nr')";
				$conn->query($sNR);

				$sPK = "INSERT INTO tabel_nilai (id_kriteria, id_siswa, nilai)
						VALUES ('2', '$id_siswa', '$pk')";
				$conn->query($sPK);

				$sPT = "INSERT INTO tabel_nilai (id_kriteria, id_siswa, nilai)
						VALUES ('3', '$id_siswa', '$pt')";
				$conn->query($sPT);

				$sPOT = "INSERT INTO tabel_nilai (id_kriteria, id_siswa, nilai)
						VALUES ('4', '$id_siswa', '$pot')";
				$conn->query($sPOT);

				$sJT = "INSERT INTO tabel_nilai (id_kriteria, id_siswa, nilai)
						VALUES ('5', '$id_siswa', '$jt')";
				$conn->query($sJT);
				$sKK = "INSERT INTO tabel_nilai (id_kriteria, id_siswa, nilai)
						VALUES ('5', '$id_siswa', '$kk')";
				$conn->query($sKK);


				echo "<script>alert('Input berhasil');window.location = '../index.php?module=list_siswa';</script>";
}

// eksekusi sql

// if ($koneksi->query($sql) === TRUE) {
//     echo "<script>alert('Input berhasil');window.location = '../../index.php?module=list_kriteria';</script>";
// } else {
//     echo "Error: " . $sql . "<br>" . $koneksi->error;
// }

?>