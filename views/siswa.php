<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Siswa";
$_SESSION["page-url"] = "siswa";
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
                                        <input type="text" class="form-control round-form" name="nama" required>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Jenis Kelamin</label>
                                      <div class="col-sm-10">
                                        <div class="form-check-inline">
                                          <label class="form-check-label" for="radio1">
                                            <input type="radio" class="form-check-input" id="radio1" name="jk" value="L" checked> Laki - Laki
                                          </label>
                                        </div>
                                        <div class="form-check-inline">
                                          <label class="form-check-label" for="radio2">
                                            <input type="radio" class="form-check-input" id="radio2" name="jk" value="P"> Perempuan
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Tanggal Lahir</label>
                                      <div class="col-sm-10">
                                        <input type="date" name="ttl" class="form-control" required>
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
                                          <option value="">Nilai Raport</option>
                                          <?php while ($d = mysqli_fetch_assoc($nilai_raport)) { ?>
                                            <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Presensi Kehadiran</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="presensi" required>
                                          <option value="">Presensi Kehadiran</option>
                                          <?php while ($d = mysqli_fetch_assoc($presensi_kehadiran)) { ?>
                                            <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Pekerjaan Orang Tua</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="pekerjaan" required>
                                          <option value="">Pekerjaan Orang Tua</option>
                                          <?php while ($d = mysqli_fetch_assoc($pekerjaan_ortu)) { ?>
                                            <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Penghasilan Orang Tua</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="penghasilan" required>
                                          <option value="">Penghasilan Orang Tua</option>
                                          <?php while ($d = mysqli_fetch_assoc($penghasilan_ortu)) { ?>
                                            <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Jumlah Tanggungan</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="tanggungan" required>
                                          <option value="">Jumlah Tanggungan</option>
                                          <?php while ($d = mysqli_fetch_assoc($jumlah_tanggungan)) { ?>
                                            <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Kondisi Keluarga</label>
                                      <div class="col-sm-10">
                                        <select class="form-control" name="kondisi" required>
                                          <option value="">Kondisi Keluarga</option>
                                          <?php while ($d = mysqli_fetch_assoc($kondisi_keluarga)) { ?>
                                            <option value="<?= $d['sub_kriteria'] ?>"><?= $d['sub_kriteria']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <button type="submit" name="tambah-siswa" class="btn btn-primary text-white">Tambah</button>
                                </div>
                              </div>
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
                                  <th>Nama</th>
                                  <th>Jen kelamin</th>
                                  <th>Tanggal Lahir</th>
                                  <?php while ($row_kriteria = mysqli_fetch_assoc($kriteria)) { ?>
                                    <th><?= $row_kriteria['kriteria'] ?></th>
                                  <?php } ?>
                                  <th>Aksi</th>
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
                                      <td class="text-center">
                                        <a style="cursor: pointer;" onclick="window.location.href='ubah-siswa?data=<?= $row['nama'] ?>&id=<?= $row['id_siswa'] ?>'" class="btn btn-warning p-2 text-white"><i class="bi bi-pencil-square"></i> Ubah</a>
                                        <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_siswa'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                        <div class="modal fade" id="hapus<?= $row['id_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <form action="" method="post">
                                                <input type="hidden" name="id-siswa" value="<?= $row['id_siswa'] ?>">
                                                <div class="modal-body">
                                                  <p>Anda yakin ingin menghapus siswa ini?</p>
                                                </div>
                                                <div class="modal-footer justify-content-center border-top-0">
                                                  <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                                  <button type="submit" name="hapus-siswa" class="btn btn-danger p-2 text-white">Hapus</button>
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