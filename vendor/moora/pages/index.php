<?php
session_start();
include "../controller/koneksi.php";

if(empty($_SESSION['id_role'])){
    echo "Anda harus login terlebih dahulu');window.location = '../login.html';</script>";
}else{
    echo "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>SPK - SMPN Satu Atap Nunanamat</title>

  <!-- Favicons -->
  <link href="../assets/img/logo.png" rel="icon">
  <link href="../assets/img/logo.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="../assets/lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/style-responsive.css" rel="stylesheet">
  <script src="../assets/lib/chart-master/Chart.js"></script>
  <!-- Data table source -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<!-- end of header -->

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="" class="logo"><b>SISTEM PENDUKUNG<span> KEPUTUSAN</span></b></a>
      <!--logo end-->
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="../auth/logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <?php
      

            if($_SESSION['id_role']==3){
        ?>
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="index.php?module=home"><img src="logo.PNG" class="img-circle" width="80"></a></p>
          <h5 class="centered">Kepala Sekolah</h5>
          <li class="mt">
            <a class="" href="index.php?module=home">
              <i class="fa fa-home"></i>
              <span>Home</span>
              </a>
          </li>
          <li class="">
            <a class="" href="index.php?module=list_hasil">
              <i class="fa fa-list"></i>
              <span>Hasil</span>
              </a>
          </li>
        </ul>
        <?php
           }else if ($_SESSION['id_role']==2){
        ?>
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="index.php?module=home"><img src="img/ui-epan.png" class="img-circle" width="80"></a></p>
          <h5 class="centered">Admin</h5>
          <li class="mt">
            <a class="" href="index.php?module=home">
              <i class="fa fa-home"></i>
              <span>Home</span>
              </a>
          </li>         
          <li class="">
            <a class="" href="index.php?module=list_kriteria">
              <i class="fa fa-file"></i>
              <span>Kriteria</span>
              </a>
               <ul class="sub">
              <li><a href="index.php?module=list_kriteria">List Kriteria</a></li>
              <li><a href="index.php?module=tambah_kriteria">Tambah Kriteria</a></li> 
            </ul>
          </li>
          <li class="">
            <a class="" href="index.php?module=list_kriteria">
              <i class="fa fa-file"></i>
              <span>Sub Kriteria</span>
              </a>
               <ul class="sub">
              <li><a href="index.php?module=list_sub_kriteria">List Sub Kriteria</a></li>
              <li><a href="index.php?module=tambah_sub_kriteria">Tambah Sub Kriteria</a></li>
              
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Siswa</span>
              </a>
            <ul class="sub">
              <li><a href="index.php?module=list_siswa">List Siswa</a></li>
              <li><a href="index.php?module=tambah_siswa">Tambah Siswa</a></li>
              <li><a href="index.php?module=hapus_semua_siswa">Hapus Data Siswa</a></li>
            </ul>
          </li>
          <li class="">
            <a class="" href="index.php?module=list_hasil">
              <i class="fa fa-list"></i>
              <span>Hasil</span>
              </a>
          </li>
          <li class="">
            <a class="" href="index.php?module=hitung">
              <i class="fa fa-calculator"></i>
              <span>Hitung</span>
              </a>
          </li>
        </ul>
        <?php }else{
         ?>
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="index.php?module=home"><img src="img/ui-epan.png" class="img-circle" width="80"></a></p>
          <h5 class="centered">Admin</h5>
          <li class="mt">
            <a class="" href="index.php?module=home">
              <i class="fa fa-home"></i>
              <span>Home</span>
              </a>
          </li>
          <li class="">
            <a class="" href="index.php?module=list_kriteria">
              <i class="fa fa-file"></i>
              <span>Kelola Pengguna</span>
              </a>
               <ul class="sub">
              <li><a href="index.php?module=list_pengguna">Daftar Pengguna</a></li>
              <li><a href="index.php?module=tambah_pengguna">Tambah Pengguna</a></li>
              
            </ul>
          </li>
          
         
          <li class="">
            <a class="" href="index.php?module=list_kriteria">
              <i class="fa fa-file"></i>
              <span>Kriteria</span>
              </a>
               <ul class="sub">
              <li><a href="index.php?module=list_kriteria">List Kriteria</a></li>
              <li><a href="index.php?module=tambah_kriteria">Tambah Kriteria</a></li>
              
            </ul>
          </li>
          <li class="">
            <a class="" href="index.php?module=list_kriteria">
              <i class="fa fa-file"></i>
              <span>Sub Kriteria</span>
              </a>
               <ul class="sub">
              <li><a href="index.php?module=list_sub_kriteria">List Sub Kriteria</a></li>
              <li><a href="index.php?module=tambah_sub_kriteria">Tambah Sub Kriteria</a></li>
              
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Siswa</span>
              </a>
            <ul class="sub">
              <li><a href="index.php?module=list_siswa">List Siswa</a></li>
              <li><a href="index.php?module=tambah_siswa">Tambah Siswa</a></li>
           <!--   <li><a href="index.php?module=hapus_semua_siswa">Hapus Data Siswa</a></li> -->
            </ul>
          </li>
          <li class="">
            <a class="" href="index.php?module=list_hasil">
              <i class="fa fa-list"></i>
              <span>Hasil</span>
              </a>
          </li>
          <li class="">
            <a class="" href="index.php?module=hitung">
              <i class="fa fa-calculator"></i>
              <span>Hitung</span>
              </a>
          </li>
        </ul>
        <?php
            }
        ?>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 main-chart" style="padding-left: 50px;padding-right: 50px;">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>BEASISWA PROGRAM INDONESIA PINTAR</h3>
            </div>
            <?php

            if ($_GET['module'] == 'home') {
                include "home/home.php";
            } elseif ($_GET['module'] == 'list_pengguna') {
                include "pengguna/list_pengguna.php";
            } elseif ($_GET['module'] == 'tambah_pengguna') {
                include "pengguna/tambah_pengguna.php";
            } elseif ($_GET['module'] == 'update_pengguna') {
              include "pengguna/update_pengguna.php";
            }elseif ($_GET['module'] == 'hapus_pengguna') {
              include "pengguna/aksi_hapus.php";
            }elseif ($_GET['module'] == 'hapus_semua_pengguna') {
              include "pengguna/aksi_hapus_semua.php";

            } elseif ($_GET['module'] == 'list_kriteria') {
                include "kriteria/list_kriteria.php";
            } elseif ($_GET['module'] == 'tambah_kriteria') {
                include "kriteria/tambah_kriteria.php";
             } elseif ($_GET['module'] == 'update_kriteria') {
              include "kriteria/update_kriteria.php";
            }elseif ($_GET['module'] == 'hapus_kriteria') {
              include "kriteria/aksi_hapus.php";

            }elseif ($_GET['module'] == 'list_sub_kriteria') {
                include "sub_kriteria/list_sub_kriteria.php";
            } elseif ($_GET['module'] == 'tambah_sub_kriteria') {
                include "sub_kriteria/tambah_sub_kriteria.php";

             } elseif ($_GET['module'] == 'update_sub_kriteria') {
              include "sub_kriteria/update_kriteria.php";

            }elseif ($_GET['module'] == 'hapus_sub_kriteria') {
              include "sub_kriteria/aksi_hapus.php";

              
            } elseif ($_GET['module'] == 'list_siswa') {
                include "siswa/list_siswa.php";
            } elseif ($_GET['module'] == 'tambah_siswa') {
                include "siswa/tambah_siswa.php";
            } elseif ($_GET['module'] == 'update_siswa') {
              include "siswa/update_siswa.php";
            }elseif ($_GET['module'] == 'hapus_siswa') {
              include "siswa/aksi_hapus.php";
            }elseif ($_GET['module'] == 'hapus_semua_siswa') {
              include "siswa/aksi_hapus_semua.php";
              
            }elseif ($_GET['module'] == 'list_hasil') {
              include "hasil/list_hasil.php";
            }elseif ($_GET['module'] == 'hitung') {
              include "hasil/hitung.php";  
            }elseif ($_GET['module'] == 'list_detail_siswa') {
              include "hasil/list_siswa.php";
            }elseif ($_GET['module'] == 'hapus_hasil') {
              include "hasil/aksi_hapus.php";
            }elseif ($_GET['module'] == 'hapus_hasil_siswa') {
              include "hasil/aksi_hapus_hasil_siswa.php";
            }

            //default
             else {
                 include "home/home.php";
            }
            ?>
          </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->


    <!--footer start-->
    <footer class="site-footer" style="margin-top: 40vh;">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>SMP Negert Satu Atap</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with netmedia framecode template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="../index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="../assets/lib/jquery/jquery.min.js"></script>

  <script src="../assets/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="../assets/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../assets/lib/jquery.scrollTo.min.js"></script>
  <script src="../assets/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="../assets/lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="../assets/lib/common-scripts.js"></script>
  <script type="text/javascript" src="../assets/lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="../assets/lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="../assets/lib/sparkline-chart.js"></script>
  <script src="../assets/lib/zabuto_calendar.js"></script>
  <!-- data table source -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
    $('#myDataTables').DataTable();
      } );
  </script>
  <!-- other script -->
<!--   <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Dashio!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
        // (string | optional) the image to display on the left
        image: 'img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script> -->
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>
