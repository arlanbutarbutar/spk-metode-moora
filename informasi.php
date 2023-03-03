<?php require_once("controller/script.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>SPK | INFORMASI BEASISWA</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/lib/flaticon/font/flaticon.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="assets/css/bootstrap1.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="assets/css/style1.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="index.html" class="navbar-brand ms-lg-5">
      <h1 class="m-0 text-uppercase text-dark">BEASISWA PIP</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-0">
        <a href="./" class="nav-item nav-link">Beranda</a>
        <a href="informasi" class="nav-item nav-link">Informasi</a>
        <a href="auth/" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Login <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <!-- Hero Start -->
  <div class="container-fluid bg-primary py-5 mb-5" style="background-image: url('assets/img/header-spk-moora.jpg');">
    <div class="container py-5">
      <div class="row justify-content-start">
        <div class="col-lg-8 text-center text-lg-start">
          <h3 class="display-1 mb-lg-4" style="color: white">Informasi Penerima Beasiswa</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Data Penerima Beasiswa -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-5">
        <div class="table-responsive">
          <table class="table table-striped table-hover text-center display" id="datatable">
            <thead>
              <tr>
                <th scope="col">#Rank</th>
                <th scope="col">Nama</th>
                <th scope="col">Tgl</th>
                <th scope="col">Nilai Raport</th>
                <th scope="col">Presensi Kehadiran</th>
                <th scope="col">Pekerjaan Orang Tua</th>
                <th scope="col">Penghasilan Orang Tua</th>
                <th scope="col">Jumlah Tanggungan</th>
                <th scope="col">Kondisi Keluarga</th>
                <th scope="col">Nilai</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $rank = 1;
              if (mysqli_num_rows($view_siswa) > 0) {
                while ($row = mysqli_fetch_assoc($view_siswa)) { ?>
                  <tr>
                    <th scope="row"><?= $rank ?></th>
                    <td><?= $row['nama'] ?></td>
                    <td>
                      <?php $dateCreate = date_create($row["tanggal"]);
                      echo date_format($dateCreate, "d M Y - h:i:s"); ?>
                    </td>
                    <td><?= $row['nilai_raport'] ?></td>
                    <td><?= $row['presensi_kehadiran'] ?></td>
                    <td><?= $row['pekerjan_orang_tua'] ?></td>
                    <td><?= $row['penghasilan_orang_tua'] ?></td>
                    <td><?= $row['jumlah_tanggungan'] ?></td>
                    <td><?= $row['kondisi_keluarga'] ?></td>
                    <td><?= $row['nilai'] ?></td>
                    <td><?= $row['status'] ?></td>
                  </tr>
              <?php $rank++;
                }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript Libraries -->
  <script src="<?= $baseURL; ?>assets/js/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $baseURL; ?>assets/datatable/datatables.js"></script>
  <script>
    $(document).ready(function() {
      $("#datatable").DataTable();
    });
  </script>
  <script>
    (function() {
      function scrollH(e) {
        e.preventDefault();
        e = window.event || e;
        let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
        document.querySelector(".table-responsive").scrollLeft -= (delta * 40);
      }
      if (document.querySelector(".table-responsive").addEventListener) {
        document.querySelector(".table-responsive").addEventListener("mousewheel", scrollH, false);
        document.querySelector(".table-responsive").addEventListener("DOMMouseScroll", scrollH, false);
      }
    })();
  </script>
</body>

</html>