<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php if ($_SESSION['data-user']['role'] == 1) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
    <?php }
    if ($_SESSION['data-user']['role'] <= 2) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pegawai'">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
          <span class="menu-title">Pegawai</span>
        </a>
      </li>
    <?php }
    if ($_SESSION['data-user']['role'] == 1) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='kriteria'">
          <i class="mdi mdi-playlist-plus menu-icon"></i>
          <span class="menu-title">Kriteria</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='sub-kriteria'">
          <i class="mdi mdi-playlist-plus menu-icon"></i>
          <span class="menu-title">Sub Kriteria</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='alternatif'">
          <i class="mdi mdi-playlist-plus menu-icon"></i>
          <span class="menu-title">Alternatif</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='nilai-alternatif'">
          <i class="mdi mdi-sort-numeric menu-icon"></i>
          <span class="menu-title">Nilai Alternatif</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pengangkatan'">
          <i class="mdi mdi-cube menu-icon"></i>
          <span class="menu-title">Pengangkatan</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>