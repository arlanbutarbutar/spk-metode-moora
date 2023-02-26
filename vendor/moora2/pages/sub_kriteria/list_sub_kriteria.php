        <h3><i class="fa fa-angle-right"></i> List Kriteria</h3>
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table" style="padding: 15px;">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="myDataTables">
                <thead>

                  <tr>
                    <th>No</th>
                     <th>Kriteria</th>
                    <th>Sub Kriteria</th>
                    <th>Nilai Sub</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php


          $sql = "SELECT * FROM kriteria INNER JOIN tabel_sub_kriteria ON kriteria.id_kriteria = tabel_sub_kriteria.id_kriteria";
          $result = mysqli_query($conn, $sql);
           $i=1;
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
                  <tr class="gradeX">
                    <td> <?= $i;  ?></td>
                    <td><?=$row['kriteria']?></td>
                    <td><?=$row['sub_kriteria']?></td>
                    <td><?=$row['nilai_sub']?></td>
                    <td class="hidden-phone">
                        <a href="index.php?module=update_sub_kriteria&id_sub_kriteria=<?=$row['id_sub_kriteria']?>"><button type="button" class="btn btn-warning"><i class="fa fa-cog"></i>Ubah</button></a>
                        <a href="index.php?module=hapus_sub_kriteria&id_sub_kriteria=<?=$row['id_sub_kriteria']?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></a>
                    </td>
                  </tr>
          <?php
               $i++;  }
          ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->