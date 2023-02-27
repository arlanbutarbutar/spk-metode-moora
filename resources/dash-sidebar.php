<nav class="sidebar sidebar-offcanvas shadow" style="background-color: rgb(3, 164, 237);" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php if ($_SESSION['id_role'] != 2) { ?>
      <li class="nav-item nav-category">Kelola Pengguna</li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item nav-category">Data SPK</li>
    <?php if ($_SESSION['id_role'] == 2) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kriteria'">
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
          <span class="menu-title">Kriteria</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='sub-kriteria'">
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
          <span class="menu-title">Sub Kriteria</span>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='siswa'">
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        <span class="menu-title">Siswa</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='hasil'">
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        <span class="menu-title">Hasil</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='hitung'">
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        <span class="menu-title">Hitung</span>
      </a>
    </li>
    <li class="nav-item nav-category"></li>
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='../auth/signout'">
        <i class="mdi mdi-logout-variant menu-icon"></i>
        <span class="menu-title">Keluar</span>
      </a>
    </li>
  </ul>
</nav>