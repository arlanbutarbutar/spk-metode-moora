<?php
if (!isset($_SESSION["data-user"])) {
  function masuk($data)
  {
    global $conn;
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION["message-danger"] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($password, $row["password"])) {
        $_SESSION["data-user"] = [
          "id" => $row["id_user"],
          "role" => $row["id_role"],
          "email" => $row["email"],
          "username" => $row["username"],
        ];
      } else {
        $_SESSION["message-danger"] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
  }
}

if (isset($_SESSION["data-user"])) {
  function edit_profile($data)
  {
    global $conn, $idUser;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  function add_user($data)
  {
    global $conn;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["password"]))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");
    return mysqli_affected_rows($conn);
  }
  function edit_user($data)
  {
    global $conn, $time;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["id-user"]))));
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["username"]))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["email"]))));
    $emailOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["emailOld"]))));
    if ($email != $emailOld) {
      $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE users SET username='$username', email='$email', updated_at='$updated_at' WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function delete_user($data)
  {
    global $conn;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["id-user"]))));
    mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function tambah_kriteria($data)
  {
    global $conn;
    $kode_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kode-kriteria']))));
    $kode_kriteria = strtoupper($kode_kriteria);
    $checkKode = mysqli_query($conn, "SELECT * FROM kriteria WHERE kode_kriteria LIKE '%$kode_kriteria%'");
    if (mysqli_num_rows($checkKode) > 0) {
      $_SESSION["message-danger"] = "Maaf, kode kriteria sudah ada.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kriteria']))));
    $type = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['type']))));
    $bobot = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bobot']))));
    mysqli_query($conn, "INSERT INTO kriteria(kode_kriteria,kriteria,type,bobot) VALUES('$kode_kriteria','$kriteria','$type','$bobot')");
    return mysqli_affected_rows($conn);
  }
  function ubah_kriteria($data)
  {
    global $conn;
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    $kode_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kode-kriteria']))));
    $kode_kriteria = strtoupper($kode_kriteria);
    $kode_kriteriaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kode-kriteriaOld']))));
    if ($kode_kriteria != $kode_kriteriaOld) {
      $checkKode = mysqli_query($conn, "SELECT * FROM kriteria WHERE kode_kriteria LIKE '%$kode_kriteria%'");
      if (mysqli_num_rows($checkKode) > 0) {
        $_SESSION["message-danger"] = "Maaf, kode kriteria sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    $kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kriteria']))));
    $type = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['type']))));
    $bobot = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bobot']))));
    mysqli_query($conn, "UPDATE kriteria SET kode_kriteria='$kode_kriteria', kriteria='$kriteria', type='$type', bobot='$bobot' WHERE id_kriteria='$id_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function hapus_kriteria($data)
  {
    global $conn;
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function tambah_sub_kriteria($data)
  {
    global $conn;
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    $sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['sub-kriteria']))));
    $nilai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nilai']))));
    mysqli_query($conn, "INSERT INTO tabel_sub_kriteria(id_kriteria,sub_kriteria,nilai_sub) VALUES('$id_kriteria','$sub_kriteria','$nilai')");
    return mysqli_affected_rows($conn);
  }
  function ubah_sub_kriteria($data)
  {
    global $conn;
    $id_sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-kriteria']))));
    $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
    $sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['sub-kriteria']))));
    $nilai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nilai']))));
    mysqli_query($conn, "UPDATE tabel_sub_kriteria SET id_kriteria='$id_kriteria', sub_kriteria='$sub_kriteria', nilai_sub='$nilai' WHERE id_sub_kriteria='$id_sub_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function hapus_sub_kriteria($data)
  {
    global $conn;
    $id_sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-kriteria']))));
    mysqli_query($conn, "DELETE FROM tabel_sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function tambah_siswa($data)
  {
    global $conn;
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $checkNama = mysqli_query($conn, "SELECT * FROM tabel_siswa WHERE nama='$nama'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION["message-danger"] = "Maaf, nama siswa sudah ada.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $jk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jk']))));
    $ttl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ttl']))));
    $nilai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nilai']))));
    $presensi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['presensi']))));
    $pekerjaan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pekerjaan']))));
    $penghasilan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['penghasilan']))));
    $tanggungan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tanggungan']))));
    $kondisi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kondisi']))));
    mysqli_query($conn, "INSERT INTO tabel_siswa(nama,jenis_kelamin,ttl,nilai_raport,presensi_kehadiran,pekerjan_orang_tua,penghasilan_orang_tua,jumlah_tanggungan,kondisi_keluarga) VALUES('$nama','$jk','$ttl','$nilai','$presensi','$pekerjaan','$penghasilan','$tanggungan','$kondisi')");
    return mysqli_affected_rows($conn);
  }
  function ubah_siswa($data)
  {
    global $conn;
    $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-siswa']))));
    $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
    $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
    if ($nama != $namaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM tabel_siswa WHERE nama='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION["message-danger"] = "Maaf, nama siswa sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    $jk = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jk']))));
    $ttl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ttl']))));
    $nilai = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nilai']))));
    $presensi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['presensi']))));
    $pekerjaan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pekerjaan']))));
    $penghasilan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['penghasilan']))));
    $tanggungan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tanggungan']))));
    $kondisi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kondisi']))));
    mysqli_query($conn, "UPDATE tabel_siswa SET nama='$nama', jenis_kelamin='$jk', ttl='$ttl', nilai_raport='$nilai', presensi_kehadiran='$presensi', pekerjan_orang_tua='$pekerjaan', penghasilan_orang_tua='$penghasilan', jumlah_tanggungan='$tanggungan', kondisi_keluarga='$kondisi' WHERE id_siswa='$id_siswa'");
    return mysqli_affected_rows($conn);
  }
  function hapus_siswa($data)
  {
    global $conn;
    $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-siswa']))));
    mysqli_query($conn, "DELETE FROM tabel_siswa WHERE id_siswa='$id_siswa'");
    return mysqli_affected_rows($conn);
  }
  function hapus_hasil($data)
  {
    global $conn;
    $tanggal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tanggal']))));
    mysqli_query($conn, "DELETE FROM tabel_hasil WHERE tanggal='$tanggal'");
    return mysqli_affected_rows($conn);
  }
  function hapus_detail_hasil($data)
  {
    global $conn;
    $id_hasil = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-hasil']))));
    mysqli_query($conn, "DELETE FROM tabel_hasil WHERE id_hasil='$id_hasil'");
    return mysqli_affected_rows($conn);
  }
}
