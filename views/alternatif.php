<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Alternatif";
$_SESSION['page-url'] = "alternatif";
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
                  <h2 class="mb-3">Tambah Alternatif</h2>
                  <form action="" method="post">
                    <div class="mb-3">
                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Alternatif</label>
                        <select name="id-user" class="form-select" id="nama" aria-label="Default select example" required>
                          <option selected value="">Pilih Pegawai</option>
                          <?php foreach ($select_users as $row_user) : ?>
                            <option value="<?= $row_user['id_user'] ?>"><?= $row_user['username'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <button type="submit" name="add-alternatif" class="btn btn-primary">Tambah</button>
                    </div>
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
                          <th class="text-dark">Kode Alternatif</th>
                          <th class="text-dark">Nama Alternatif</th>
                          <th class="text-dark">Tgl Dibuat</th>
                          <th class="text-dark">Tgl Diubah</th>
                          <th class="text-dark" colspan="2">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($alternatif) == 0) { ?>
                          <tr>
                            <td class="text-dark" colspan="6">Belum ada data alternatif</td>
                          </tr>
                          <?php } else if (mysqli_num_rows($alternatif) > 0) {
                          while ($row = mysqli_fetch_assoc($alternatif)) { ?>
                            <tr>
                              <td class="text-dark"><?= $row['kode_alternatif'] ?></td>
                              <td class="text-dark"><?= $row['username'] ?></td>
                              <td>
                                <div class="badge badge-opacity-success text-dark">
                                  <?php $dateCreate = date_create($row['created_at']);
                                  echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td>
                                <div class="badge badge-opacity-warning text-dark">
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
                        } ?>
                      </tbody>
                    </table>
                    <?php if ($total_role4 > $data_role4) { ?>
                      <div class="d-flex justify-content-between mt-4 flex-wrap">
                        <p class="text-muted">Showing 1 to <?= $data_role4 ?> of <?= $total_role4 ?> entries</p>
                        <nav class="ml-auto">
                          <ul class="pagination separated pagination-info">
                            <?php if (isset($page_role4)) {
                              if (isset($total_page_role4)) {
                                if ($page_role4 > 1) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role4 - 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-left"></i></a>
                                  </li>
                                  <?php endif;
                                for ($i = 1; $i <= $total_page_role4; $i++) : if ($i <= 4) : if ($i == $page_role4) : ?>
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
                                if ($total_page_role4 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role4 > 4) {
                                                                                  echo $page_role4;
                                                                                } else if ($page_role4 <= 4) {
                                                                                  echo '5';
                                                                                } ?>/" class="btn btn-<?php if ($page_role4 <= 4) {
                                                                                                        echo 'outline-';
                                                                                                      } ?>primary btn-sm rounded-0"><?php if ($page_role4 > 4) {
                                                                                                                                      echo $page_role4;
                                                                                                                                    } else if ($page_role4 <= 4) {
                                                                                                                                      echo '5';
                                                                                                                                    } ?></a>
                                  </li>
                                <?php endif;
                                if ($page_role4 < $total_page_role4 && $total_page_role4 >= 4) : ?>
                                  <li class="page-item">
                                    <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role4 + 1; ?>/" class="btn btn-primary btn-sm rounded-0"><i class="icon-arrow-right"></i></a>
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