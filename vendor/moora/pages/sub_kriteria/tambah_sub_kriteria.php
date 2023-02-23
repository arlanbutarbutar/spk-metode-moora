<?php 


    //sesuaikan dengan database, username, dan password kalian masing-masing
    $servername     = "localhost";
    $database       = "db_moora"; 
    $username       = "root";
    $password       = "";

    // membuat koneksi
    $conn   = mysqli_connect($servername, $username, $password, $database);

    //jika jurusan sudah diset maka masukkan datanya ke dalam variabel $cari
    
     

        //ambil data dari database, dimana pencarian sesuai dengan variabel cari
             $data = mysqli_query($conn, "select * from kriteria");
   

 ?>

            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Tambah Sub Kriteria</h4>
              <form class="form-horizontal style-form" method="POST" action="sub_kriteria/aksi_tambah.php">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">ID Kriteria</label>
                   <div class="col-sm-10">
             <select class="form-control" name="id_kriteria">
                    <option >--Kriteria--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data)){ ?>
                        <option ><?= $d['id_kriteria'].".".$d['kriteria']; ?></option>
                    <?php } ?>
                </select>
          </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Sub Kriteria</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control round-form" name="sub_kriteria">
                  </div>
                </div><div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nilai Sub Kriteria</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control round-form" name="nilai_sub_kriteria">
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-12" style="text-align: center;">
                    <button type="submit" class="btn btn-theme03">Masukan</button>
                    <button type="reset" class="btn btn-theme04">Reset</button>
                  </div>
                </div>
              </form>
            </div>