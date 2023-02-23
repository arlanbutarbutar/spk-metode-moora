<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Data Diri</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Prasyarat</a>
    </li>
  </ul>

<?php
$id_siswa = $_GET['id_siswa'];
$sql = "SELECT * FROM tabel_siswa WHERE id_siswa = $id_siswa";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<form class="form-horizontal style-form" method="POST" action="siswa/aksi_edit.php?id_siswa=<?=$id_siswa?>">
  <!-- Tab panes -->
  <div class="tab-content" style="background-color: white;padding: 20px;">
    <div id="home" class="tab-pane active">
      <h3>Data Diri</h3>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Nama </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="nama" value="<?=$row['nama']?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
          <div class="col-sm-10">
            <div class="form-check-inline">
              <label class="form-check-label" for="radio1">
              <?php
                if($row['jenis_kelamin']=='L'){
                    echo "<input type='radio' class='form-check-input' id='radio1' name='jenis_kelamin' value='L' checked> Laki - Laki";
                }else {
                    echo "<input type='radio' class='form-check-input' id='radio1' name='jenis_kelamin' value='L' > Laki - Laki";
                }
              ?>
                
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label" for="radio2">
              <?php
                if($row['jenis_kelamin']=='P'){
                    echo "<input type='radio' class='form-check-input' id='radio2' name='jenis_kelamin' value='P' checked> Perempuan";
                }else {
                    echo "<input type='radio' class='form-check-input' id='radio2' name='jenis_kelamin' value='P' > Perempuan";
                }
              ?>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Tanggal Lahir </label>
          <div class="col-sm-10">
              <input type="date" name="ttl" value="<?=$row['ttl']?>">
          </div>
        </div>      
    </div>
    <div id="menu1" class=" tab-pane fade">
      <h3>Prasyarat</h3>
      <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Nilai Raport </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="nilai_raport" value="<?=$row['nilai_raport']?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Presensi Kehadiran </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="presensi_kehadiran" value="<?=$row['presensi_kehadiran']?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Pekerjaan Orang Tua </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="pekerjan_orang_tua" value="<?=$row['pekerjan_orang_tua']?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Penghasilan Orang Tua</label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="penghasilan_orang_tua" value="<?=$row['penghasilan_orang_tua']?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Jumlah Tanggungan </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="jumlah_tanggungan"  value="<?=$row['jumlah_tanggungan']?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Kondisi Keluarga </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="kondisi_keluarga"  value="<?=$row['kondisi_keluarga']?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12" style="text-align: center;">
            <button type="submit" class="btn btn-theme03">Masukan</button>
            <button type="reset" class="btn btn-theme04">Reset</button>
          </div>
        </div>
      
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>

  </form>