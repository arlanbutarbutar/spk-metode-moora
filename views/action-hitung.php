<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_SESSION['data'])) {
  header("Location: hitung");
  exit;
} else {
  // Proses Pengambilan Kriteria Dari DB
  $data_kriteria = mysqli_query($conn, "SELECT * FROM kriteria JOIN tabel_sub_kriteria ON kriteria.id_kriteria=tabel_sub_kriteria.id_kriteria");
  //-- menyiapkan variable penampung berupa array
  $kriteria = array();
  //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
  foreach ($data_kriteria as $row) {
    $kriteria[$row['id_kriteria']] = array(
      $row['kriteria'],
      $row['type'],
      $row['bobot'],
      $row['nilai_sub'],
    );
  }

  //Menampilkan Data Kriteria
  echo "Data Kriteria<br>================================<br>";
  echo "<table border='1'>";
  echo "<tr><th>Nama Kriteria</th><th>Tipe Kriteria</th><th>Bobot Kriteria</th></tr>";
  foreach ($kriteria as $id_kriteria => $data) {
    echo "<tr>";
    echo "<td>" . $data[0] . "</td>";
    echo "<td>" . $data[1] . "</td>";
    echo "<td>" . $data[2] . "</td>";
    echo "</tr>";
  }
  echo "</table><br>";

  // Proses Pengambilan Nilai
  $data_siswa = mysqli_query($conn, "SELECT * FROM tabel_siswa");
  //-- menyiapkan variable penampung berupa array
  $alternatif = array();
  //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
  foreach ($data_siswa as $row) {
    $alternatif[$row['id_siswa']] = array(
      $row['nama'],
      $row['jenis_kelamin'],
      $row['ttl'],
      $row['nilai_raport'],
      $row['presensi_kehadiran'],
      $row['pekerjan_orang_tua'],
      $row['penghasilan_orang_tua'],
      $row['jumlah_tanggungan'],
      $row['kondisi_keluarga'],
    );
  }

  //Menampilkan Nilai Alternatif
  echo "Nilai Alternatif<br>================================<br>";
  echo "<table border='1'>";
  echo "<tr><th>Nama Siswa</th><th>Jenis Kelamin</th><th>TTL</th><th>Nilai Raport</th><th>Presensi Kehadiran</th><th>Pekerjaan Orang Tua</th><th>Penghasilan Orang Tua</th><th>Jumlah Tanggungan</th><th>Kondisi Keluarga</th></tr>";
  foreach ($alternatif as $id_siswa => $row) {
    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</td><td>" . $row[8] . "</td></tr>";
  }
  echo "</table><br>";

  // Proses Pengambilan Nilai dan Merubah Nilai ke Angka
  $data_nilai = mysqli_query($conn, "SELECT * FROM tabel_nilai ORDER BY id_siswa,id_kriteria");
  //-- menyiapkan variable penampung berupa array
  $nilai = array();
  //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
  foreach ($data_nilai as $row) {
    if (!isset($nilai[$row['id_siswa']])) {
      $nilai[$row['id_siswa']] = array();
    } else {
      $nilai[$row['id_siswa']][$row['id_kriteria']] = array(
        $row['nilai'],
      );
    }
  }

  // Proses Normalisasi Matrix
  //-- inisialisasi nilai normalisasi dengan nilai dari $nilai
  $normal = array();
  foreach ($nilai as $id_siswa => $kriteria) {
    $normal[$id_siswa] = array();
    foreach ($kriteria as $id_kriteria => $nilai_kriteria) {
      $normal[$id_siswa][$id_kriteria] = $nilai_kriteria[0];
    }
  }

  // Menampilkan Normalisasi Matrix
  echo "Normalisasi Matrix<br>================================<br>";
  foreach ($normal as $id_normal => $value) {
    foreach ($kriteria as $id_kriteria => $value) {
      echo $normal[$id_normal][$id_kriteria] . " | ";
    }
    echo "<br>";
  }
  echo "<br>";

  // Menghitung Nilai Optimasi
  $optimasi = array();
  foreach ($normal as $id_siswa => $kriteria) {
    $optimasi[$id_siswa] = 1;
    foreach ($kriteria as $nilai_kriteria) {
      $optimasi[$id_siswa] *= $nilai_kriteria;
    }
    $optimasi[$id_siswa] = pow($optimasi[$id_siswa], 1 / count($kriteria));
  }

  // Menampilkan Nilai Optimasi
  echo "Nilai Optimasi<br>================================<br>";
  echo "<table border='1'>";
  echo "<tr><tr><th>Alternatif</th><th>ID</th><th>Optimasi</th></tr></tr>";
  foreach ($optimasi as $id_optimasi => $value) {
    echo "<tr>";
    echo "<td>" . $alternatif[$id_optimasi][0] . "</td>";
    echo "<td>" . $id_optimasi . "</td>";
    echo "<td>" . $optimasi[$id_optimasi] . "</td>";
    echo "</tr>";
  }
  echo "</table><br>";

  // Merangking
  //--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
  arsort($optimasi);
  //-- mendapatkan key/index item array yang pertama
  $index = key($optimasi);

  // Menampilkan Hasil Akhir
  echo "Nilai Optimasi Urut<br>================================<br>";
  echo "<table border='1'>";
  echo "<tr><tr><th>Alternatif</th><th>ID</th><th>Optimasi</th></tr></tr>";
  foreach ($optimasi as $id_optimasi => $value) {
    echo "<tr>";
    echo "<td>" . $alternatif[$id_optimasi][0] . "</td>";
    echo "<td>" . $id_optimasi . "</td>";
    echo "<td>" . $optimasi[$id_optimasi] . "</td>";
    echo "</tr>";
  }
  echo "</table><br>";

  echo "Hasil 3 Tertinggi<br>================================<br>";
  $rank = 1;
  $terima = $_SESSION['data']['jsiswa'];
  $tanggal =  date("Y-m-d h:i:s");
  echo "<table border='1'>";
  echo "<tr><tr><th>Alternatif</th><th>ID</th><th>Optimasi</th></tr></tr>";
  foreach ($optimasi as $id_optimasi => $value) {
    echo "<tr>";
    echo "<td>" . $alternatif[$id_optimasi][0] . "</td>";
    echo "<td>" . $id_optimasi . "</td>";
    echo "<td>" . $optimasi[$id_optimasi] . "</td>";
    echo "</tr>";

    // Insert data ke database tabel_hasil
    $nama_simpan = $alternatif[$id_optimasi][0];
    if ($rank <= $terima) {
      $sqlInput = "INSERT INTO tabel_hasil (nama, nilai,tanggal,status) VALUES ('$nama_simpan','$optimasi[$id_optimasi]','$tanggal','rekomendasi')";
      $conn->query($sqlInput);
    } else {
      $sqlInput = "INSERT INTO tabel_hasil (nama, nilai,tanggal,status) VALUES ('$nama_simpan','$optimasi[$id_optimasi]','$tanggal','tidak rekomendasi')";
      $conn->query($sqlInput);
    }
    $rank++;
  }
  echo "</table><br>";

  // $_SESSION["message-success"] = "Berhasil menghitung";
  // $_SESSION["time-message"] = time();
  // header("Location: hasil");
  // exit();

}
