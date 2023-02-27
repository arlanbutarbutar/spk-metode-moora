<?php require_once("../controller/script.php");
if (isset($_GET['date'])) {
  $date = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['date']))));
  $date = str_replace("%20", " ", $date);
  $data_hasil = mysqli_query($conn, "SELECT * FROM tabel_hasil WHERE tanggal='$date'");
  if (mysqli_num_rows($data_hasil) == 0) {
    $_SESSION["message-success"] = "Data Hasil Perhitungan Masih kosong.";
    $_SESSION["time-message"] = time();
    header("Location: " . $_SESSION['page-url']);
    exit();
  } else {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Hasil Perhitungan.xls"); ?>
    <center>
      <h3>Data Hasil Perhitungan Ranking Penerima Beasiswa Program Indonesia Pintar</h3>
    </center>
    <table border="1">
      <thead>
        <tr>
          <th class="min-w-125px">Rank</th>
          <th class="min-w-125px">Nama</th>
          <th class="min-w-125px">Nilai</th>
          <th class="min-w-125px">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $rank = 1;
        while ($row = mysqli_fetch_assoc($data_hasil)) { ?>
          <tr>
            <td><?= $rank ?></td>
            <th><?= $row['nama'] ?></th>
            <td><?= $row['nilai'] ?></td>
            <td><?= $row['status'] ?></td>
          <?php $rank++;
        } ?>
      </tbody>
    </table>
<?php }
} else {
  header("Location: " . $_SESSION['page-url']);
  exit();
} ?>