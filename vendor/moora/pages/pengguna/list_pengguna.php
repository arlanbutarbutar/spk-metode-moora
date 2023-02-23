        <h3><i class="fa fa-angle-right"></i> Daftar Pengguna</h3>
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table" style="padding: 15px;">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="myDataTables">
                <thead>
                  <tr>
                   <th>Id user</th>
                    <th>Username</th>
                     <th>Role</th>
                     <th>Email</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php
          $result = mysqli_query($conn, "SELECT id_user,username,users_role.nama_role, email FROM users INNER JOIN users_role ON users.id_role = users_role.id_role");

          $i=1;
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
                  <tr class="pengguna">
                    <td>
                       <?= $i;  ?>
                      
                    </td>
                    <td><?=$row['username']?></td>
                    <td><?=$row['nama_role']?></td>
                    <td><?=$row['email']?></td>
                
                 
                    <td class="hidden-phone">
                        <a href="index.php?module=update_pengguna&id_user=<?=$row['id_user']?>"><button type="button" class="btn btn-warning"><i class="fa fa-cog"></i> Update</button></a>
                        <a href="index.php?module=hapus_pengguna&id_user=<?=$row['id_user']?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></a>
                    </td>
                  </tr>
          <?php
             $i++; }
          ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->