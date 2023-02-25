<?php 

    //sesuaikan dengan database, username, dan password kalian masing-masing
    $servername     = "localhost";
    $database       = "spk_metode_moora"; 
    $username       = "root";
    $password       = "";

    // membuat koneksi
    $conn   = mysqli_connect($servername, $username, $password, $database);

    //jika jurusan sudah diset maka masukkan datanya ke dalam variabel $cari
    
     

        //ambil data dari database, dimana pencarian sesuai dengan variabel cari
        $data = mysqli_query($conn, "SELECT * FROM `tabel_sub_kriteria` WHERE `id_kriteria`=1");
        $data1 = mysqli_query($conn, "SELECT * FROM `tabel_sub_kriteria` WHERE `id_kriteria`=2");
             $data2 = mysqli_query($conn, "SELECT * FROM `tabel_sub_kriteria` WHERE `id_kriteria`=3");
              $data3 = mysqli_query($conn, "SELECT * FROM `tabel_sub_kriteria` WHERE `id_kriteria`=4");
                 $data4 = mysqli_query($conn, "SELECT * FROM `tabel_sub_kriteria` WHERE `id_kriteria`=5");
                    $data5 = mysqli_query($conn, "SELECT * FROM `tabel_sub_kriteria` WHERE `id_kriteria`=6");
   

 ?>

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Data Diri</a>
    </li>
   <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Prasyarat</a>
    </li>
  </ul>
<form class="form-horizontal style-form" method="POST" action="siswa/aksi_tambah.php">
  <!-- Tab panes -->
  <div class="tab-content" style="background-color: white;padding: 20px;">
    <div id="home" class="tab-pane active">
      <h3>Data Diri</h3>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Nama </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="nama">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
          <div class="col-sm-10">
            <div class="form-check-inline">
              <label class="form-check-label" for="radio1">
                <input type="radio" class="form-check-input" id="radio1" name="jenis_kelamin" value="L" checked> Laki - Laki
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label" for="radio2">
                <input type="radio" class="form-check-input" id="radio2" name="jenis_kelamin" value="P"> Perempuan
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Tanggal Lahir </label>
          <div class="col-sm-10">
            <input type="date"  name="ttl">
          </div>
        </div>     
    </div>
    <div id="menu1" class=" tab-pane fade">
      <h3>Prasyarat</h3>
      <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Nilai Raport </label>

              <div class="col-sm-10">
             <select class="form-control" name="nilai_raport">
                    <option >--Nilai Raport--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data)){ ?>
                        <option ><?=$d['sub_kriteria']; ?></option>
                    <?php } ?>
                </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Presensi Kehadiran </label>
           <div class="col-sm-10">
             <select class="form-control" name="presensi_kehadiran">
                    <option >--Presensi Kehadiran--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data1)){ ?>
                        <option ><?=$d['sub_kriteria']; ?></option>
                    <?php } ?>
                </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Pekerjaan Orang Tua </label>
          <div class="col-sm-10">
             <select class="form-control" name="pekerjan_orang_tua">
                    <option >--Pekerjaan Orang Tua--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data2)){ ?>
                        <option ><?=$d['sub_kriteria']; ?></option>
                    <?php } ?>
                </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Penghasilan Orang Tua</label>
          <div class="col-sm-10">
             <select class="form-control" name="penghasilan_orang_tua">
                    <option >--Penghasilan Orang Tua--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data3)){ ?>
                        <option ><?=$d['sub_kriteria']; ?></option>
                    <?php } ?>
                </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Jumlah Tanggungan </label>
          <div class="col-sm-10">
             <select class="form-control" name="jumlah_tanggungan">
                    <option >--Jumlah Tanggungan--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data4)){ ?>
                        <option ><?=$d['sub_kriteria']; ?></option>
                    <?php } ?>
                </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Kondisi Keluarga </label>
          <div class="col-sm-10">
             <select class="form-control" name="kondisi_keluarga">
                    <option >--Kondisi Keluarga--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data5)){ ?>
                        <option ><?=$d['sub_kriteria']; ?></option>
                    <?php } ?>
                </select>
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