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
                  <hr>
                  <h2>Data Siswa</h2>
                  <div class="table-responsive">
                    <table class="display table table-bordered table-striped table-sm" id="datatable">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Jen kelamin</th>
                          <th>Tanggal Lahir</th>
                          <?php while ($row_kriteria = mysqli_fetch_assoc($kriteria)) { ?>
                            <th><?= $row_kriteria['kriteria'] ?></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($siswa) > 0) {
                          while ($row = mysqli_fetch_assoc($siswa)) { ?>
                            <tr>
                              <td><?= $row['nama'] ?></td>
                              <td><?= $row['jenis_kelamin'] ?></td>
                              <td><?= $row['ttl'] ?></td>
                              <td><?= $row['nilai_raport'] ?></td>
                              <td><?= $row['presensi_kehadiran'] ?></td>
                              <td><?= $row['pekerjan_orang_tua'] ?></td>
                              <td><?= $row['penghasilan_orang_tua'] ?></td>
                              <td><?= $row['jumlah_tanggungan'] ?></td>
                              <td><?= $row['kondisi_keluarga'] ?></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>