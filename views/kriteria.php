<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Kriteria";
$_SESSION['page-url'] = "kriteria";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION['message-success'])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-info'])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-warning'])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-danger'])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger'] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row flex-row-reverse">
            <div class="col-lg-4">
              <div class="card card-rounded mt-3">
                <div class="card-body text-center">
                  <h2 class="mb-3">Tambah Kriteria</h2>
                  <form action="" method="post">
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Kriteria</label>
                      <input type="text" name="nama" value="<?php if (isset($_POST['nama'])) {
                                                              echo $_POST['nama'];
                                                            } ?>" class="form-control" id="nama" placeholder="Nama Kriteria">
                    </div>
                    <div class="mb-3">
                      <label for="bobot" class="form-label">Bobot</label>
                      <input type="number" name="bobot" value="<?php if (isset($_POST['bobot'])) {
                                                              echo $_POST['bobot'];
                                                            } ?>" class="form-control" id="bobot" placeholder="Bobot">
                    </div>
                    <button type="submit" name="add-kriteria" class="btn btn-primary">Tambah Kriteria</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card card-rounded mt-3">
                <div class="card-body">
                  <div class="table-responsive  mt-1">
                    <table class="table select-table text-center">
                      <thead>
                        <tr>
                          <th class="text-dark">Kode Kriteria</th>
                          <th class="text-dark">Nama Kriteria</th>
                          <th class="text-dark">Bobot</th>
                          <th class="text-dark">Tgl Dibuat</th>
                          <th class="text-dark">Tgl Diubah</th>
                          <th class="text-dark" colspan="2">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($kriteria) == 0) { ?>
                          <tr>
                            <td colspan="7">Belum ada data kriteria</td>
                          </tr>
                          <?php } else if (mysqli_num_rows($kriteria) > 0) {
                          while ($row = mysqli_fetch_assoc($kriteria)) { ?>
                            <tr>
                              <td class="text-dark"><?= $row['kode_kriteria'] ?></td>
                              <td class="text-dark"><?= $row['nama_kriteria'] ?></td>
                              <td class="text-dark"><?= $row['bobot'] ?></td>
                              <td class="text-dark">
                                <div class="badge badge-opacity-success text-dark">
                                  <?php $dateCreate = date_create($row['created_at']);
                                  echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td class="text-dark">
                                <div class="badge badge-opacity-warning text-dark">
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
                        } ?>
                      </tbody>
                    </table>
                    <?php if ($total_role3 > $data_role3) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role3 ?> of <?= $total_role3 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role3)) {
                              if (isset($total_page_role3)) {
                                if ($page_role3 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role3; $i++) : if ($i <= 4) : if ($i == $page_role3) : ?>
                                      <li class="page-item active">
                                        <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-primary btn-sm rounded-0"><?= $i; ?></a>
                                      </li>
                                    <?php else : ?>
                                      <li class="page-item">
                                        <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-outline-primary btn-sm rounded-0"><?= $i ?></a>
                                      </li>
                                  <?php endif;
                                  endif;
                                endfor;
                                if ($total_page_role3 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role3 > 4) {
                                                                                  echo $page_role3;
                                                                                } else if ($page_role3 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role3 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role3 > 4) {
                                                                                                                                      echo $page_role3;
                                                                                                                                    } else if ($page_role3 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role3 < $total_page_role3 && $total_page_role3 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
                                  </li>
                            <?php endif;
                              }
                            } ?>
                          </ul>
                        </nav>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>