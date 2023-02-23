<?php require_once("../controller/script.php"); ?>

<div class="row">

  <!-- Tab panes -->
  <div class="col-md-12 mt-3">
    <h2>BEASISWA PROGRAM INDONESIA PINTAR</h2>
    <div class="col-10">
      <div class="card border-0 rounded-0">
        <div class="card-body">
          <h3>Sistem Pendukung Keputusan Seleksi Beasiswa Metode MOORA</h3>
          <p>Sistem Pendukung Keputusan digunakan dalam memilih calon penerima beasiswa berbasis web menggunakan metode Multi Objective Optimization On The Basis Of Ratio Analysis yang dapat membantu staf tata usaha mengambil keputusan seleksi calon penerima beasiswa program indonesia pintar sehingga memberikan keputusan penerima tidak salah sasaran.</p>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="../assets/datatable/datatables.js"></script>
<script>
  $(document).ready(function() {
    $("#datatable").DataTable();
  });
</script>
<script>
  (function() {
    function scrollH(e) {
      e.preventDefault();
      e = window.event || e;
      let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
      document.querySelector(".table-responsive").scrollLeft -= (delta * 40);
    }
    if (document.querySelector(".table-responsive").addEventListener) {
      document.querySelector(".table-responsive").addEventListener("mousewheel", scrollH, false);
      document.querySelector(".table-responsive").addEventListener("DOMMouseScroll", scrollH, false);
    }
  })();
</script>