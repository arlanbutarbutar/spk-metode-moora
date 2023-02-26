<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Data Pengguna</a>
    </li>
    
  </ul>

<?php
$id_user = $_GET['id_user'];
$sql = "SELECT * FROM users WHERE id_user = $id_user";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

  // $data = mysqli_query($conn, "select users.id_role, users_role.nama_role FROM users INNER JOIN users_role ON users.id_role = users_role.id_role");
 $data = mysqli_query($conn, "select * from users_role");
       
?>

<form class="form-horizontal style-form" method="POST" action="pengguna/aksi_edit.php?id_user=<?=$id_user?>">
  <!-- Tab panes -->
  <div class="tab-content" style="background-color: white;padding: 20px;">
    <div id="home" class="tab-pane active">
      <h3>Data Diri</h3>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Username </label>
          <div class="col-sm-10">
            <input type="text" class="form-control round-form" name="username" value="<?=$row['username']?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Role </label>
          <div class="col-sm-10">
            <select class="form-control" name="id_role" id="id_role">
                    <option value="">--Pengguna--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->
                    <?php while($d = mysqli_fetch_assoc($data)){ ?>
                        <option value=""><?php echo $d['id_role']." . ".$d['nama_role']; ?></option>
                    <?php } ?>
                </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Email </label>
          <div class="col-sm-10">
               <input type="text" class="form-control round-form" name="email" value="<?=$row['email']?>">
          </div>
        </div>   
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Password </label>
          <div class="col-sm-10">
             <input type="text" class="form-control round-form" name="password" value="<?=$row['password']?>">
          </div>
        </div>    
    </div>
     <div class="form-group">
          <div class="col-sm-12" style="text-align: center;">
            <button type="submit" class="btn btn-theme03">Ubah</button>
            <button type="reset" class="btn btn-theme04">Reset</button>
          </div>
        </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>

  </form>