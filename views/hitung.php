<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Hitung";
$_SESSION["page-url"] = "hitung";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION["message-success"])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION["message-success"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-info"])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION["message-info"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-warning"])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION["message-warning"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-danger"])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION["message-danger"] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="data-main">
                  <h2>Jumlah Siswa Diterima</h2>
                  <form action="" method="POST">
                    <div class="form-group">
                      <label class="control-label">Jumlah Siswa Diterima</label>
                      <div class="col-sm-2 d-flex">
                        <input type="number" min="1" class="form-control" name="jsiswa" value="1" id="nilai" max="<?= $count_siswa ?>" required>
                        <input type="hidden" name="siswa-all" value="<?= $count_siswa ?>">
                        <button type="submit" name="hitung-semua" class="btn btn-primary text-white">Semua</button>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="hitung" class="btn btn-primary text-white">Hitung</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                  </form>
                  <?php
                  if (isset($_SESSION['data']['jsiswa'])) {
                    echo "
                    <hr>
                    <h2>Perhitungan</h2>";
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
                    echo "<tr><th>Nama Siswa</th><th>Nilai Raport</th><th>Presensi Kehadiran</th><th>Pekerjaan Orang Tua</th><th>Penghasilan Orang Tua</th><th>Jumlah Tanggungan</th><th>Kondisi Keluarga</th></tr>";
                    foreach ($alternatif as $id_siswa => $row) {
                      echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td></tr>";
                    }
                    echo "</table><br>";

                    // Proses Pengambilan Nilai dan Merubah Nilai ke Angka
                    $data_nilai = mysqli_query($conn, "SELECT * FROM tabel_nilai ORDER BY id_siswa,id_kriteria");
                    //-- menyiapkan variable penampung berupa array
                    $sample = array();
                    $nilai = array();
                    foreach ($data_nilai as $data) {
                      $sample[$data['id_siswa']][$data['id_kriteria']] = $data['nilai'];
                      $nilai[$data['id_siswa']][$data['id_kriteria']] = array($data['nilai']);
                      $nilai_kuadrat[$data['id_siswa']][$data['id_kriteria']] = pow($data['nilai'], 2); //kuadratkan nilai
                    }

                    // Menampilkan Nilai ke Angka
                    echo "Konversi Nilai ke Angka<br>================================<br>";
                    // Menampilkan data nilai
                    foreach ($nilai as $id_siswa => $data_kriteria) {
                      foreach ($data_kriteria as $id_kriteria => $nilai_kriteria) {
                        echo $nilai_kriteria[0] . " | ";
                      }
                      echo "<br>";
                    }
                    echo "<br>";

                    // Menampilkan Nilai Dikuadratkan
                    echo "Konversi Nilai Dikuadratkan<br>================================<br>";
                    //Cetak hasil
                    foreach ($nilai_kuadrat as $id_siswa => $kriteria) {
                      foreach ($kriteria as $id_kriteria => $nilai_kuadrat) {
                        echo $nilai_kuadrat . " | ";
                      }
                      echo "<br>";
                    }
                    echo "<br>";

                    // Proses Normalisasi Matrix
                    //-- inisialisasi nilai normalisasi dengan nilai dari $nilai
                    $normal = $sample;
                    foreach ($kriteria as $id_kriteria => $k) {
                      //-- inisialisasi nilai pembagi tiap kriteria
                      $pembagi = 0;
                      foreach ($alternatif as $id_siswa => $a) {
                        $pembagi += pow($sample[$id_siswa][$id_kriteria], 2);
                      }
                      foreach ($alternatif as $id_alternatif => $a) {
                        $normal[$id_alternatif][$id_kriteria] /= sqrt($pembagi);
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
                    echo "
                    <form action='' method='post'>
                      <div class='form-group'>
                        <button type='submit' name='reset-hitung' class='btn btn-primary text-white'>Reset</button>
                        <a href='hasil' class='btn btn-secondary'>Hasil</a>
                        <a href='cetak?date=" . $tanggal . "' class='btn btn-secondary'>Cetak</a>
                      </div>
                    </form>";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>