<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_GET['data'])) {
  header("Location: siswa");
  exit;
} else {
  $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id']))));
  $siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['data']))));
  $_SESSION["page-name"] = "Ubah Siswa " . $siswa;
  $_SESSION["page-url"] = "ubah-siswa?data=" . $siswa . "&id=" . $id_siswa;
  $sql = "SELECT * FROM tabel_siswa WHERE id_siswa = $id_siswa";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
}
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
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="btn btn-link nav-link active" data-bs-toggle="collapse" href="#data-diri" role="button" aria-expanded="false" aria-controls="data-diri">Data Diri</a>
                    </li>
                    <li class="nav-item">
                      <a class="btn btn-link nav-link active" data-bs-toggle="collapse" href="#prasyarat" role="button" aria-expanded="false" aria-controls="prasyarat">Prasyarat</a>
                    </li>
                  </ul>
                  <form action="" method="POST">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="collapse multi-collapse show" id="data-diri">
                          <div class="card card-body shadow-none rounded-0">
                            <div class="form-group">
                              <label class="control-label">Nama</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control round-form" name="nama" value="<?= $row['nama'] ?>" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Jenis Kelamin</label>
                              <div class="col-sm-10">
                                <div class="form-check-inline">
                                  <label class="form-check-label" for="radio1">
                                    <input type="radio" class="form-check-input" id="radio1" name="jk" value="L" <?php if ($row['jenis_kelamin'] == "L") {
                                                                                                                    echo "checked";
                                                                                                                  } ?>> Laki - Laki
                                  </label>
                                </div>
                                <div class="form-check-inline">
                                  <label class="form-check-label" for="radio2">
                                    <input type="radio" class="form-check-input" id="radio2" name="jk" value="P" <?php if ($row['jenis_kelamin'] == "P") {
                                                                                                                    echo "checked";
                                                                                                                  } ?>> Perempuan
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Tanggal Lahir</label>
                              <div class="col-sm-10">
                                <input type="date" name="ttl" value="<?= $row['ttl'] ?>" class="form-control" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="collapse multi-collapse show" id="prasyarat">
                          <div class="card card-body shadow-none rounded-0">
                            <div class="form-group">
                              <label class="control-label">Nilai Raport</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="nilai" required>
                                  <option value="<?= $row['nilai_raport'] ?>"><?= $row['nilai_raport'] ?></option>
                                  <?php $value = $row['nilai_raport'];
                                  $nilai_raport = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='1' AND sub_kriteria!='$value'");
                                  while ($d = mysqli_fetch_assoc($nilai_raport)) { ?>
                                    <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Presensi Kehadiran</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="presensi" required>
                                  <option value="<?= $row['presensi_kehadiran'] ?>"><?= $row['presensi_kehadiran'] ?></option>
                                  <?php $value = $row['presensi_kehadiran'];
                                  $presensi_kehadiran = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='2' AND sub_kriteria!='$value'");
                                  while ($d = mysqli_fetch_assoc($presensi_kehadiran)) { ?>
                                    <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Pekerjaan Orang Tua</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="pekerjaan" required>
                                  <option value="<?= $row['pekerjan_orang_tua'] ?>"><?= $row['pekerjan_orang_tua'] ?></option>
                                  <?php $value = $row['pekerjan_orang_tua'];
                                  $pekerjaan_ortu = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='3' AND sub_kriteria!='$value'");
                                  while ($d = mysqli_fetch_assoc($pekerjaan_ortu)) { ?>
                                    <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Penghasilan Orang Tua</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="penghasilan" required>
                                  <option value="<?= $row['penghasilan_orang_tua'] ?>"><?= $row['penghasilan_orang_tua'] ?></option>
                                  <?php $value = $row['penghasilan_orang_tua'];
                                  $penghasilan_ortu = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='4' AND sub_kriteria!='$value'");
                                  while ($d = mysqli_fetch_assoc($penghasilan_ortu)) { ?>
                                    <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Jumlah Tanggungan</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="tanggungan" required>
                                  <option value="<?= $row['jumlah_tanggungan'] ?>"><?= $row['jumlah_tanggungan'] ?></option>
                                  <?php $value = $row['jumlah_tanggungan'];
                                  $jumlah_tanggungan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='5' AND sub_kriteria!='$value'");
                                  while ($d = mysqli_fetch_assoc($jumlah_tanggungan)) { ?>
                                    <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Kondisi Keluarga</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="kondisi" required>
                                  <option value="<?= $row['kondisi_keluarga'] ?>"><?= $row['kondisi_keluarga'] ?></option>
                                  <?php $value = $row['kondisi_keluarga'];
                                  $kondisi_keluarga = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='6' AND sub_kriteria!='$value'");
                                  while ($d = mysqli_fetch_assoc($kondisi_keluarga)) { ?>
                                    <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group mt-3" style="text-align: right;">
                            <input type="hidden" name="id-siswa" value="<?= $row['id_siswa'] ?>">
                            <input type="hidden" name="namaOld" value="<?= $row['nama'] ?>">
                            <button type="submit" name="ubah-siswa" class="btn btn-warning">Ubah</button>
                            <a href="siswa" class="btn btn-secondary">Kembali</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>