<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_SESSION['data'])) {
  header("Location: hitung");
  exit;
} else {
  // Proses Pengambilan Kriteria Dari DB
  $sql = 'SELECT * FROM kriteria';
  $result = $conn->query($sql);
  //-- menyiapkan variable penampung berupa array
  $kriteria = array();
  //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
  foreach ($result as $row) {
    $kriteria[$row['id_kriteria']] = array($row['kriteria'], $row['type'], $row['bobot']);
  }

  // Menampilan Kriteria
  print_r($kriteria);
  echo "<br><br> Tampilan Kriteria<br><br>";
  foreach ($kriteria as $id_kriteria => $value) {
    echo $kriteria[$id_kriteria][0] . " " . $kriteria[$id_kriteria][1] . " = " . $kriteria[$id_kriteria][2] . "<br>";
  }

  // Proses Pengambilan Nilai
  $sql = 'SELECT * FROM tabel_siswa';
  $result = $conn->query($sql);
  //-- menyiapkan variable penampung berupa array
  $alternatif = array();
  //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
  foreach ($result as $row) {
    $alternatif[$row['id_siswa']] = array(
      $row['nama'],
      $row['jenis_kelamin'],
      $row['ttl'],
      $row['nilai_raport'],
      $row['presensi_kehadiran'],
      $row['pekerjan_orang_tua'],
      $row['penghasilan_orang_tua'],
      $row['jumlah_tanggungan'],
      $row['kondisi_keluarga']
    );
  }

  //Menampilkan Nilai Alternatif
  echo "<br> INPUTAN ALTERNATIF <br>===================<br>";
  foreach ($alternatif as $id_siswa => $value) {
    for ($i = 0; $i <= 7; $i++) {
      echo $alternatif[$id_siswa][$i] . " ";
    }
    echo "<br>";
  }

  // Proses Merubah Nilai Ke Angka
  //-- query untuk mendapatkan semua data sample penilaian di tabel moo_nilai
  $sql = 'SELECT * FROM tabel_nilai ORDER BY id_siswa,id_kriteria';
  $result = $conn->query($sql);
  //-- menyiapkan variable penampung berupa array
  $sample = array();
  //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
  foreach ($result as $row) {
    //-- jika array $sample[$row['id_alternatif']] belum ada maka buat baru
    //-- $row['id_alternatif'] adalah id kandidat/alternatif
    if (!isset($sample[$row['id_siswa']])) {
      $sample[$row['id_siswa']] = array();
    }
    $sample[$row['id_siswa']][$row['id_kriteria']] = $row['nilai'];
  }

  // Menampilan Perubahan Nilai Ke Angka
  echo "<br> KONVERSI NILAI ANGKA <br>==================<br>";
  foreach ($sample as $id_sample => $value) {
    foreach ($kriteria as $id_kriteria => $value) {
      echo $sample[$id_sample][$id_kriteria] . " ";
    }
    echo "<br>";
  }

  // Proses Normalisasi Matrix
  //-- inisialisasi nilai normalisasi dengan nilai dari $sample
  $normal = $sample;
  foreach ($kriteria as $id_kriteria => $k) {
    //-- inisialisasi nilai pembagi tiap kriteria
    $pembagi = 0;
    foreach ($alternatif as $id_siswa => $a) {
      $pembagi += pow($sample[$id_siswa][$id_kriteria], 2);
    }
    foreach ($alternatif as $id_alternatif => $a) {
      $normal[$id_alternatif][$id_kriteria] = sqrt($pembagi);
    }
  }

  // Menampilkan Normalisasi Matrix
  echo "<br> NORMALISASI MATRIX <br>==================<br>";
  foreach ($normal as $id_normal => $value) {
    foreach ($kriteria as $id_kriteria => $value) {
      echo $normal[$id_normal][$id_kriteria] . " | ";
    }
    echo "<br>";
  }

  // Menghitung Nilai Optimasi
  $optimasi = array();
  foreach ($alternatif as $id_siswa => $a) {
    $optimasi[$id_siswa] = 0;
    foreach ($kriteria as $id_kriteria => $k) {
      $optimasi[$id_siswa] += $normal[$id_siswa][$id_kriteria] * ($k[1] == 'benefit' ? 1 : -1) * $k[2];
    }
  }

  // Menampilkan Nilai Optimasi
  echo "<br> NILAI OPTIMASI <br>==================<br>";
  foreach ($optimasi as $id_optimasi => $value) {
    echo $alternatif[$id_optimasi][0] . $id_optimasi . "<br>" . $optimasi[$id_optimasi];
    echo "<br>=======<br>";
  }

  // Merangking
  //--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
  arsort($optimasi);
  //-- mendapatkan key/index item array yang pertama
  $index = key($optimasi);

  // Menampilkan Hasil Akhir
  echo "<br> NILAI OPTIMASI URUT <br>==================<br>";
  foreach ($optimasi as $id_optimasi => $value) {
    echo $alternatif[$id_optimasi][0] . $id_optimasi . "<br>" . $optimasi[$id_optimasi];
    echo "<br>=======<br>";
  }

  echo "<br> HASIL 3 TERTINGGI <br>==================<br>";
  $rank = 1;
  $terima = $_SESSION['data']['jsiswa'];
  $tanggal =  date("Y-m-d h:i:s");
  foreach ($optimasi as $id_optimasi => $value) {
    echo $alternatif[$id_optimasi][0] . $id_optimasi . "<br>" . $optimasi[$id_optimasi];
    $nama_simpan = $alternatif[$id_optimasi][0];
    if ($rank <= $terima) {
      $sqlInput = "INSERT INTO tabel_hasil (nama, nilai,tanggal,status) VALUES ('$nama_simpan','$optimasi[$id_optimasi]','$tanggal','rekomendasi')";
      $conn->query($sqlInput);
    } else {
      $sqlInput = "INSERT INTO tabel_hasil (nama, nilai,tanggal,status) VALUES ('$nama_simpan','$optimasi[$id_optimasi]','$tanggal','tidak rekomendasi')";
      $conn->query($sqlInput);
    }
    echo "<br>=======<br>";
    $rank++;
  }

  $_SESSION["message-success"] = "Berhasil menghitung";
  $_SESSION["time-message"] = time();
  header("Location: hasil");
  exit();
}
