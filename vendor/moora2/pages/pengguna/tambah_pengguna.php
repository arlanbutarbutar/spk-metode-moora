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
        $data = mysqli_query($conn, "select * from users_role");
    
   

 ?>


<form class="form-horizontal style-form" method="POST" action="pengguna/aksi_tambah.php">
  <!-- Tab panes -->
  <div class="tab-content" style="background-color: white;padding: 20px;">
    <div id="home" class="tab-pane active">
      <h3>Data Pengguna</h3>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Username </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="username">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Role </label>
          <div class="col-sm-10">
             <select class="form-control" name="id_role">
                    <option >--Pengguna--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data)){ ?>
                        <option ><?= $d['id_role']." ".$d['nama_role']; ?></option>
                    <?php } ?>
                </select>
          </div>
        </div> 
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Email </label>
          <div class="col-sm-10">
              <textarea class="form-control"  id="comment" name="email"></textarea>
          </div>
        </div> 
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Password </label>
          <div class="col-sm-10">
              <textarea class="form-control"  id="comment" name="password"></textarea>
          </div>
        </div>      
    </div>
    <div class="form-group">
          <div class="col-sm-12" style="text-align: center;">
            <button type="submit" class="btn btn-theme03">Masukan</button>
            <button type="reset" class="btn btn-theme04">Reset</button>
          </div>
        </div>
   
  </div>

  </form>