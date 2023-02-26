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
    $id_role = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
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
    mysqli_query($conn, "INSERT INTO users(id_role,username,email,password) VALUES('$id_role','$username','$email','$password')");
    return mysqli_affected_rows($conn);
  }
  function edit_user($data)
  {
    global $conn, $time;
    $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data["id-user"]))));
    $id_role = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-role']))));
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
    mysqli_query($conn, "UPDATE users SET id_role='$id_role', username='$username', email='$email' WHERE id_user='$id_user'");
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
    $create_id = mysqli_query($conn, "SELECT * FROM tabel_siswa ORDER BY id_siswa DESC LIMIT 1");
    if (mysqli_num_rows($create_id) > 0) {
      $row = mysqli_fetch_assoc($create_id);
      $id_siswa = $row['id_siswa'] + 1;
    } else {
      $id_siswa = 1;
    }
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
    $takeNilai = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$nilai'");
    if (mysqli_num_rows($takeNilai) > 0) {
      $row = mysqli_fetch_assoc($takeNilai);
      $nilai_sub1 = $row['nilai_sub'];
    }
    $presensi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['presensi']))));
    $takePresensi = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$presensi'");
    if (mysqli_num_rows($takePresensi) > 0) {
      $row = mysqli_fetch_assoc($takePresensi);
      $nilai_sub2 = $row['nilai_sub'];
    }
    $pekerjaan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pekerjaan']))));
    $takePekerjaan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$pekerjaan'");
    if (mysqli_num_rows($takePekerjaan) > 0) {
      $row = mysqli_fetch_assoc($takePekerjaan);
      $nilai_sub3 = $row['nilai_sub'];
    }
    $penghasilan = $data['penghasilan'];
    $takePenghasilan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$penghasilan'");
    if (mysqli_num_rows($takePenghasilan) > 0) {
      $row = mysqli_fetch_assoc($takePenghasilan);
      $nilai_sub4 = $row['nilai_sub'];
    }
    $tanggungan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tanggungan']))));
    $takeTanggungan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$tanggungan'");
    if (mysqli_num_rows($takeTanggungan) > 0) {
      $row = mysqli_fetch_assoc($takeTanggungan);
      $nilai_sub5 = $row['nilai_sub'];
    }
    $kondisi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kondisi']))));
    $takeKondisi = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$kondisi'");
    if (mysqli_num_rows($takeKondisi) > 0) {
      $row = mysqli_fetch_assoc($takeKondisi);
      $nilai_sub6 = $row['nilai_sub'];
    }
    mysqli_query($conn, "INSERT INTO tabel_siswa(id_siswa,nama,jenis_kelamin,ttl,nilai_raport,presensi_kehadiran,pekerjan_orang_tua,penghasilan_orang_tua,jumlah_tanggungan,kondisi_keluarga) VALUES('$id_siswa','$nama','$jk','$ttl','$nilai','$presensi','$pekerjaan','$penghasilan','$tanggungan','$kondisi')");
    mysqli_query($conn, "INSERT INTO tabel_nilai(id_kriteria,id_siswa,nilai) VALUES('1','$id_siswa','$nilai_sub1')");
    mysqli_query($conn, "INSERT INTO tabel_nilai(id_kriteria,id_siswa,nilai) VALUES('2','$id_siswa','$nilai_sub2')");
    mysqli_query($conn, "INSERT INTO tabel_nilai(id_kriteria,id_siswa,nilai) VALUES('3','$id_siswa','$nilai_sub3')");
    mysqli_query($conn, "INSERT INTO tabel_nilai(id_kriteria,id_siswa,nilai) VALUES('4','$id_siswa','$nilai_sub4')");
    mysqli_query($conn, "INSERT INTO tabel_nilai(id_kriteria,id_siswa,nilai) VALUES('5','$id_siswa','$nilai_sub5')");
    mysqli_query($conn, "INSERT INTO tabel_nilai(id_kriteria,id_siswa,nilai) VALUES('6','$id_siswa','$nilai_sub6')");
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
    $takeNilai = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$nilai'");
    if (mysqli_num_rows($takeNilai) > 0) {
      $row = mysqli_fetch_assoc($takeNilai);
      $nilai_sub1 = $row['nilai_sub'];
    }
    $presensi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['presensi']))));
    $takePresensi = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$presensi'");
    if (mysqli_num_rows($takePresensi) > 0) {
      $row = mysqli_fetch_assoc($takePresensi);
      $nilai_sub2 = $row['nilai_sub'];
    }
    $pekerjaan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pekerjaan']))));
    $takePekerjaan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$pekerjaan'");
    if (mysqli_num_rows($takePekerjaan) > 0) {
      $row = mysqli_fetch_assoc($takePekerjaan);
      $nilai_sub3 = $row['nilai_sub'];
    }
    $penghasilan = $data['penghasilan'];
    $takePenghasilan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$penghasilan'");
    if (mysqli_num_rows($takePenghasilan) > 0) {
      $row = mysqli_fetch_assoc($takePenghasilan);
      $nilai_sub4 = $row['nilai_sub'];
    }
    $tanggungan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tanggungan']))));
    $takeTanggungan = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$tanggungan'");
    if (mysqli_num_rows($takeTanggungan) > 0) {
      $row = mysqli_fetch_assoc($takeTanggungan);
      $nilai_sub5 = $row['nilai_sub'];
    }
    $kondisi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['kondisi']))));
    $takeKondisi = mysqli_query($conn, "SELECT * FROM tabel_sub_kriteria WHERE sub_kriteria='$kondisi'");
    if (mysqli_num_rows($takeKondisi) > 0) {
      $row = mysqli_fetch_assoc($takeKondisi);
      $nilai_sub6 = $row['nilai_sub'];
    }
    mysqli_query($conn, "UPDATE tabel_nilai SET nilai='$nilai_sub1' WHERE id_kriteria='1' AND id_siswa='$id_siswa'");
    mysqli_query($conn, "UPDATE tabel_nilai SET nilai='$nilai_sub2' WHERE id_kriteria='2' AND id_siswa='$id_siswa'");
    mysqli_query($conn, "UPDATE tabel_nilai SET nilai='$nilai_sub3' WHERE id_kriteria='3' AND id_siswa='$id_siswa'");
    mysqli_query($conn, "UPDATE tabel_nilai SET nilai='$nilai_sub4' WHERE id_kriteria='4' AND id_siswa='$id_siswa'");
    mysqli_query($conn, "UPDATE tabel_nilai SET nilai='$nilai_sub5' WHERE id_kriteria='5' AND id_siswa='$id_siswa'");
    mysqli_query($conn, "UPDATE tabel_nilai SET nilai='$nilai_sub6' WHERE id_kriteria='6' AND id_siswa='$id_siswa'");
    mysqli_query($conn, "UPDATE tabel_siswa SET nama='$nama', jenis_kelamin='$jk', ttl='$ttl', nilai_raport='$nilai', presensi_kehadiran='$presensi', pekerjan_orang_tua='$pekerjaan', penghasilan_orang_tua='$penghasilan', jumlah_tanggungan='$tanggungan', kondisi_keluarga='$kondisi' WHERE id_siswa='$id_siswa'");
    return mysqli_affected_rows($conn);
  }
  function hapus_siswa($data)
  {
    global $conn;
    $id_siswa = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-siswa']))));
    mysqli_query($conn, "DELETE FROM tabel_nilai WHERE id_siswa='$id_siswa'");
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
