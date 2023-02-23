        <h3><i class="fa fa-angle-right"></i> List Kriteria</h3>
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table" style="padding: 15px;">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="myDataTables">
                <thead>
                  <tr>
                     <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php
          $sql = "SELECT * FROM kriteria";
          $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
                  <tr class="gradeX">
                    <td><?=$row['kode_kriteria']?></td>
                    <td><?=$row['kriteria']?></td>
                    <td><?=$row['type']?></td>
                    <td><?=$row['bobot']?></td>
                    <td class="hidden-phone">
                        <a href="index.php?module=update_kriteria&id_kriteria=<?=$row['id_kriteria']?>"><button type="button" class="btn btn-warning"><i class="fa fa-cog"></i>Ubah</button></a>
                         <a href="index.php?module=hapus_kriteria&id_kriteria=<?=$row['id_kriteria']?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></a>
                    </td>
                  </tr>
          <?php
              }
          ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->