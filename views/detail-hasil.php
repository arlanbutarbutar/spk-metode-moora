<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_GET['data'])) {
  header("Location: hasil");
  exit();
} else {
  $tanggal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['data']))));
  $detail_hasil = mysqli_query($conn, "SELECT * FROM tabel_hasil WHERE tanggal='$tanggal'");
  $_SESSION["page-name"] = "Detail Hasil";
  $_SESSION["page-url"] = "detail-hasil?data=" . $tanggal;
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
                  <div class="table-responsive">
                    <table class="display table table-bordered table-striped table-sm" id="datatable">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Nilai</th>
                          <th>Status</th>
                          <?php if ($_SESSION['id_role'] == '1') { ?>
                            <th>Aksi</th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($detail_hasil) > 0) {
                          while ($row = mysqli_fetch_assoc($detail_hasil)) { ?>
                            <tr>
                              <td><?= $row['nama'] ?></td>
                              <td><?php echo number_format($row['nilai'], 2) ?></td>
                              <td><?= $row['status'] ?></td>
                              <?php if ($_SESSION['id_role'] == '1') { ?>
                                <td>
                                  <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_hasil'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                  <div class="modal fade" id="hapus<?= $row['id_hasil'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama'] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                          <input type="hidden" name="id-hasil" value="<?= $row['id_hasil'] ?>">
                                          <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                                          <div class="modal-body text-center">
                                            <p>Anda yakin ingin menghapus hasil dari <?= $row['nama'] ?>?</p>
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="hapus-detail-hasil" class="btn btn-danger p-2 text-white">Hapus</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              <?php } ?>
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