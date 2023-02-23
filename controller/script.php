<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");
if (isset($_SESSION["time-message"])) {
  if ((time() - $_SESSION["time-message"]) > 2) {
    if (isset($_SESSION["message-success"])) {
      unset($_SESSION["message-success"]);
    }
    if (isset($_SESSION["message-info"])) {
      unset($_SESSION["message-info"]);
    }
    if (isset($_SESSION["message-warning"])) {
      unset($_SESSION["message-warning"]);
    }
    if (isset($_SESSION["message-danger"])) {
      unset($_SESSION["message-danger"]);
    }
    if (isset($_SESSION["message-dark"])) {
      unset($_SESSION["message-dark"]);
    }
    unset($_SESSION["time-alert"]);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/spk-metode-moora/";

if (!isset($_SESSION["data-user"])) {
  if (isset($_POST["masuk"])) {
    if (masuk($_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["data-user"])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION["data-user"]["id"]))));

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST["ubah-profile"])) {
    if (edit_profile($_POST) > 0) {
      $_SESSION["message-success"] = "Profil akun anda berhasil di ubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $users_role = mysqli_query($conn, "SELECT * FROM users_role");
  $users = mysqli_query($conn, "SELECT users.*, users_role.nama_role FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' ORDER BY users.id_user DESC");
  if (isset($_POST["tambah-user"])) {
    if (add_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-user"])) {
    if (edit_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["usernameOld"] . " berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-user"])) {
    if (delete_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
  if (isset($_POST["tambah-kriteria"])) {
    if (tambah_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menambahkan kriteria.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-kriteria"])) {
    if (ubah_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil mengubah kriteria";
      $_SESSION["time-message"] = time();
      header("Location: kriteria");
      exit();
    } else {
      $_SESSION["message-warning"] = "Tidak ada data yang diubah";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-kriteria"])) {
    if (hapus_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menghapus kriteria";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $sub_kriteria = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria JOIN kriteria ON tabel_sub_kriteria.id_kriteria=kriteria.id_kriteria");
  if (isset($_POST["tambah-sub-kriteria"])) {
    if (tambah_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menambahkan sub kriteria.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-sub-kriteria"])) {
    if (ubah_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil mengubah sub kriteria";
      $_SESSION["time-message"] = time();
      header("Location: sub-kriteria");
      exit();
    } else {
      $_SESSION["message-warning"] = "Tidak ada data yang diubah";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-sub-kriteria"])) {
    if (hapus_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menghapus sub kriteria";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $nilai_raport = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='1'");
  $presensi_kehadiran = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='2'");
  $pekerjaan_ortu = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='3'");
  $penghasilan_ortu = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='4'");
  $jumlah_tanggungan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='5'");
  $kondisi_keluarga = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE id_kriteria='6'");
  $siswa = mysqli_query($conn, "SELECT * FROM tabel_siswa");
  if (isset($_POST["tambah-siswa"])) {
    if (tambah_siswa($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menambahkan data siswa.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-siswa"])) {
    if (ubah_siswa($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil mengubah data siswa";
      $_SESSION["time-message"] = time();
      header("Location: siswa");
      exit();
    } else {
      $_SESSION["message-warning"] = "Tidak ada data yang diubah";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-siswa"])) {
    if (hapus_siswa($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menghapus data siswa";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $hasil = mysqli_query($conn, "SELECT tanggal,count(nama) as Jsiswa FROM tabel_hasil GROUP BY tanggal ORDER BY id_hasil DESC");
  if (isset($_POST["hapus-hasil"])) {
    if (hapus_hasil($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menghapus data hasil";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $count_siswa = mysqli_query($conn, "SELECT * FROM tabel_siswa");
  $count_siswa = mysqli_num_rows($count_siswa);
  if (isset($_POST["hitung"])) {
    $jsiswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['jsiswa']))));
    $_SESSION['data'] = [
      'jsiswa' => $jsiswa,
    ];
    header("Location: action-hitung");
    exit;
  }
  if (isset($_POST["hitung-semua"])) {
    $siswa_all = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['siswa-all']))));
    $_SESSION['data'] = [
      'jsiswa' => $siswa_all,
    ];
    header("Location: action-hitung");
    exit;
  }
  if (isset($_POST["hapus-detail-hasil"])) {
    if (hapus_detail_hasil($_POST) > 0) {
      $_SESSION["message-success"] = "Berhasil menghapus hasil dari " . $_POST['nama'];
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
}
