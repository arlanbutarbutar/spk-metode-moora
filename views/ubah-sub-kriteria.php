<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_GET['data'])) {
  header("Location: sub-kriteria");
  exit;
} else {
  $id_sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id']))));
  $sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['data']))));
  $_SESSION["page-name"] = "Ubah Kriteria " . $sub_kriteria;
  $_SESSION["page-url"] = "ubah-sub-kriteria?data=" . $sub_kriteria . "&id=" . $id_sub_kriteria;
  $sql = "SELECT * FROM tabel_sub_kriteria JOIN kriteria ON tabel_sub_kriteria.id_kriteria=kriteria.id_kriteria WHERE tabel_sub_kriteria.id_sub_kriteria = $id_sub_kriteria";
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
                  <form action="" method="POST">
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Kriteria</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="id-kriteria" required>
                          <option value="<?= $row['id_kriteria'] ?>"><?= $row['kriteria'] ?></option>
                          <?php $id_kriteria = $row['id_kriteria'];
                          $kriteria = mysqli_query($conn, "SELECT * FROM kriteria WHERE id_kriteria!='$id_kriteria'");
                          while ($row_kriteria = mysqli_fetch_assoc($kriteria)) { ?>
                            <option value="<?= $row_kriteria['id_kriteria'] ?>"><?= $row_kriteria['kriteria'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Sub Kriteria</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control round-form" name="sub-kriteria" value="<?= $row['sub_kriteria'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nilai Sub</label>
                      <div class="col-sm-4">
                        <input type="number" name="nilai" class="form-control round-form" min="0" step="0.001" value="<?= $row['nilai_sub'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="id-sub-kriteria" value="<?= $row['id_sub_kriteria'] ?>">
                      <a href="sub-kriteria" class="btn btn-secondary">Kembali</a>
                      <button type="submit" name="ubah-sub-kriteria" class="btn btn-warning">Ubah</button>
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