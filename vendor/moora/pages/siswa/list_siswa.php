        <h3><i class="fa fa-angle-right"></i> List Siswa</h3>
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table" style="padding: 15px;">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="myDataTables">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Jen kelamin</th>
                    <th>Tanggal Lahir</th>
          <?php
          $sqlNamakriteria = "SELECT * FROM kriteria ORDER BY id_kriteria ASC";
          $resultNamaKriteria = mysqli_query($conn, $sqlNamakriteria);
              while ($hasilNamaKriteria = mysqli_fetch_assoc($resultNamaKriteria)) {
          ?>
                    <th><?=$hasilNamaKriteria['kriteria']?></th>
          <?php
          }
          ?>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
          <?php
          $sql = "SELECT * FROM tabel_siswa";
          $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
                  <tr class="gradeX">
                    <td><?=$row['nama']?></td>
                    <td><?=$row['jenis_kelamin']?></td>
                    <td><?=$row['ttl']?></td>
                    <td><?=$row['nilai_raport']?></td>
                    <td><?=$row['presensi_kehadiran']?></td>
                      <td><?=$row['pekerjan_orang_tua']?></td>
                        <td><?=$row['penghasilan_orang_tua']?></td>
                         <td><?=$row['jumlah_tanggungan']?></td> 
                           <td><?=$row['kondisi_keluarga']?></td> 
                    <td class="hidden-phone">
                        <a href="index.php?module=update_siswa&id_siswa=<?=$row['id_siswa']?>"><button type="button" class="btn btn-warning"><i class="fa fa-cog"></i> Update</button></a>

                       <a href="index.php?module=hapus_siswa&id_siswa=<?=$row['id_siswa']?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></a> 

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