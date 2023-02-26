<?php
$id_sub_kriteria = $_GET['id_sub_kriteria'];
$sql = "SELECT * FROM kriteria INNER JOIN tabel_sub_kriteria ON kriteria.id_kriteria = tabel_sub_kriteria.id_kriteria";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Update Sub Kriteria</h4>
              <form class="form-horizontal style-form" method="POST" action="sub_kriteria/aksi_update.php?id_sub_kriteria=<?=$row['id_sub_kriteria']?>">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">ID Kriteria</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control round-form" name="id_kriteria" value="<?=$row['id_kriteria']?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Sub Kriteria</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control round-form" name="sub_kriteria" value="<?=$row['sub_kriteria']?>" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nilai Sub</label>
                  <div class="col-sm-10">
                    <input type="number" name="nilai_sub" class="form-control round-form" min="0" step="0.001" value="<?=$row['nilai_sub']?>" required>
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