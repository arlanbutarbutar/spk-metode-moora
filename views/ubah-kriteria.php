<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_GET['data'])) {
  header("Location: kriteria");
  exit;
} else {
  $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id']))));
  $kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['data']))));
  $_SESSION["page-name"] = "Ubah Kriteria " . $kriteria;
  $_SESSION["page-url"] = "ubah-kriteria?data=" . $kriteria . "&id=" . $id_kriteria;
  $sql = "SELECT * FROM kriteria WHERE id_kriteria = $id_kriteria";
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
                      <label class="col-sm-2 col-sm-2 control-label">Kode Kriteria</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control round-form" name="kode-kriteria" value="<?= $row['kode_kriteria'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Kriteria</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control round-form" name="kriteria" value="<?= $row['kriteria'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Type Kriteria</label>
                      <div class="col-sm-4">
                        <div class="form-check-inline">
                          <label class="form-check-label" for="radio1">
                            <?php
                            if ($row['type'] === 'benefit') {
                            ?>
                              <input type="radio" class="form-check-input" id="radio1" name="type" value="benefit" checked> Benefit
                              <input type="radio" class="form-check-input" id="radio1" name="type" value="cost"> Cost
                            <?php
                            } else {
                            ?>
                              <input type="radio" class="form-check-input" id="radio1" name="type" value="benefit"> Benefit
                              <input type="radio" class="form-check-input" id="radio1" name="type" value="cost" checked> Cost
                            <?php
                            }
                            ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Bobot Kriteria</label>
                      <div class="col-sm-4">
                        <input type="number" name="bobot" class="form-control round-form" min="0" step="0.0001" value="<?= $row['bobot'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                      <input type="hidden" name="kode-kriteriaOld" value="<?= $row['kode_kriteria'] ?>">
                      <a href="kriteria" class="btn btn-secondary">Kembali</a>
                      <button type="submit" name="ubah-kriteria" class="btn btn-warning">Ubah</button>
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