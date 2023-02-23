<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Kriteria";
$_SESSION["page-url"] = "kriteria";
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
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Tambah Data
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <form action="" method="POST">
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode Kriteria</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control round-form" name="kode-kriteria" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Kriteria</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control round-form" name="kriteria" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Type Kriteria</label>
                              <div class="col-sm-4">
                                <div class="form-check-inline">
                                  <label class="form-check-label" for="radio1">
                                    <input type="radio" class="form-check-input" id="radio1" name="type" value="benefit" checked> Benefit
                                  </label>
                                </div>
                                <div class="form-check-inline">
                                  <label class="form-check-label" for="radio2">
                                    <input type="radio" class="form-check-input" id="radio2" name="type" value="cost"> Cost
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Bobot Kriteria</label>
                              <div class="col-sm-4">
                                <input type="number" name="bobot" class="form-control round-form" min="0" step="0.001" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <button type="submit" name="tambah-kriteria" class="btn btn-primary text-white">Tambah</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          List Data
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <div class="table-responsive">
                            <table class="display table table-bordered table-striped table-sm" id="datatable">
                              <thead>
                                <tr>
                                  <th class="text-center">Kode Kriteria</th>
                                  <th class="text-center">Nama Kriteria</th>
                                  <th class="text-center">Tipe</th>
                                  <th class="text-center">Bobot</th>
                                  <th class="text-center">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (mysqli_num_rows($kriteria) > 0) {
                                  while ($row = mysqli_fetch_assoc($kriteria)) { ?>
                                    <tr>
                                      <td><?= $row['kode_kriteria'] ?></td>
                                      <td><?= $row['kriteria'] ?></td>
                                      <td><?= $row['type'] ?></td>
                                      <td><?= $row['bobot'] ?></td>
                                      <td class="text-center">
                                        <a style="cursor: pointer;" onclick="window.location.href='ubah-kriteria?data=<?= $row['kriteria'] ?>&id=<?= $row['id_kriteria'] ?>'" class="btn btn-warning p-2 text-white"><i class="bi bi-pencil-square"></i> Ubah</a>
                                        <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_kriteria'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                        <div class="modal fade" id="hapus<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?= $row['kriteria'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <form action="" method="post">
                                                <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                                                <div class="modal-body">
                                                  <p>Anda yakin ingin menghapus kriteria ini?</p>
                                                </div>
                                                <div class="modal-footer justify-content-center border-top-0">
                                                  <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                                  <button type="submit" name="hapus-kriteria" class="btn btn-danger p-2 text-white">Hapus</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
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
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>