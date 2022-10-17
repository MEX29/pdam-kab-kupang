<?php require_once('../controller/script.php');
if ($_SESSION['page-url'] == "users") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "users.username LIKE '%$data%' OR users.id_user!='$idUser' AND users.email LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' AND $quer ORDER BY users.id_user DESC LIMIT 100";
    $users = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($users) == 0) { ?>
    <tr>
      <td colspan="9">Belum ada data pengguna</td>
    </tr>
    <?php } else if (mysqli_num_rows($users) > 0) {
    while ($row = mysqli_fetch_assoc($users)) { ?>
      <tr>
        <td>
          <div class="d-flex">
            <img src="../assets/images/user.png" alt="">
            <div class="my-auto">
              <h6><?= $row['username'] ?></h6>
              <p><?= $row['roles'] ?></p>
            </div>
          </div>
        </td>
        <td><?= $row['email'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_user'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Role <?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="role" class="form-label">Role</label>
                      <select name="role" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Pilih Role</option>
                        <?php foreach ($users_role as $row_role) : ?>
                          <option value="<?= $row_role['id_role'] ?>"><?= $row_role['roles'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-user" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['username'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="submit" name="hapus-user" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php }
  }
}
if ($_SESSION['page-url'] == "pegawai") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "users.username LIKE '%$data%' OR users.email LIKE '%$data%' OR status_pegawai.status_pegawai LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM users JOIN pegawai ON users.id_user=pegawai.id_user JOIN status_pegawai ON pegawai.id_status=status_pegawai.id_status WHERE $quer ORDER BY users.id_user DESC LIMIT 100";
    $pegawai = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($pegawai) == 0) { ?>
    <tr>
      <td colspan="9">Belum ada data pegawai</td>
    </tr>
    <?php } else if (mysqli_num_rows($pegawai) > 0) {
    while ($row = mysqli_fetch_assoc($pegawai)) { ?>
      <tr>
        <td>
          <div class="d-flex">
            <img src="../assets/images/user.png" alt="">
            <div class="my-auto">
              <h6><?= $row['username'] ?></h6>
              <p><?= $row['status_pegawai'] ?></p>
            </div>
          </div>
        </td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['jabatan'] ?></td>
        <td><?= $row['pangkat'] ?></td>
        <td><?= $row['telp'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <!-- <form action="" method="post">
            <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
            <button type="submit" name="check-smart" class="btn btn-success btn-sm">
              <i class="mdi mdi-contact-mail"></i>
            </button>
          </form> -->
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['username'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="submit" name="hapus-user" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php }
  }
}
if ($_SESSION['page-url'] == "kriteria") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "kriteria.kode_kriteria LIKE '%$data%' OR kriteria.nama_kriteria LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM kriteria WHERE $quer ORDER BY kriteria.id_kriteria DESC LIMIT 100";
    $kriteria = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($kriteria) == 0) { ?>
    <tr>
      <td colspan="7">Belum ada data kriteria</td>
    </tr>
    <?php } else if (mysqli_num_rows($kriteria) > 0) {
    while ($row = mysqli_fetch_assoc($kriteria)) { ?>
      <tr>
        <td><?= $row['kode_kriteria'] ?></td>
        <td><?= $row['nama_kriteria'] ?></td>
        <td><?= $row['bobot'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_kriteria'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_kriteria'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="nama-kriteria" class="form-label">Nama Kriteria</label>
                      <input type="text" name="nama" value="<?= $row['nama_kriteria'] ?>" class="form-control" id="nama-kriteria" placeholder="Nama Kriteria">
                    </div>
                    <div class="mb-3">
                      <label for="bobot" class="form-label">Bobot</label>
                      <input type="number" name="bobot" value="<?= $row['bobot'] ?>" class="form-control" id="bobot" placeholder="Bobot">
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_kriteria'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-kriteria" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_kriteria'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_kriteria'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['nama_kriteria'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_kriteria'] ?>">
                    <button type="submit" name="hapus-kriteria" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php }
  }
}
if ($_SESSION['page-url'] == "alternatif") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "users.username LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM alternatif JOIN users ON alternatif.id_user=users.id_user WHERE $quer ORDER BY users.username ASC LIMIT 100";
    $alternatif = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($alternatif) == 0) { ?>
    <tr>
      <td colspan="6">Belum ada data alternatif</td>
    </tr>
    <?php } else if (mysqli_num_rows($alternatif) > 0) {
    while ($row = mysqli_fetch_assoc($alternatif)) { ?>
      <tr>
        <td><?= $row['kode_alternatif'] ?></td>
        <td><?= $row['username'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_alternatif'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_alternatif'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['kode_alternatif'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Alternatif</label>
                      <select name="id-user" class="form-select" id="nama" aria-label="Default select example" required>
                        <option selected value="">Pilih Pegawai</option>
                        <?php foreach ($select_users as $row_user) : ?>
                          <option value="<?= $row_user['id_user'] ?>"><?= $row_user['username'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-alternatif" value="<?= $row['id_alternatif'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-alternatif" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_alternatif'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_alternatif'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['kode_alternatif'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus alternatif dari <?= $row['username'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-alternatif" value="<?= $row['id_alternatif'] ?>">
                    <button type="submit" name="hapus-alternatif" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
<?php }
  }
} ?>