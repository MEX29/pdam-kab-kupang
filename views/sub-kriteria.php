<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Sub Kriteria";
$_SESSION['page-url'] = "sub-kriteria";
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
            <div class="col-lg-12">
              <div class="card card-rounded mt-3">
                <div class="card-body">
                  <div class="table-responsive  mt-1">
                    <table class="table select-table text-center">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Kriteria</th>
                          <th>Sub kriteria</th>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php $no = 1;
                        if (mysqli_num_rows($kriteria) == 0) { ?>
                          <tr>
                            <td colspan="2">Belum ada data kriteria</td>
                          </tr>
                          <?php } else if (mysqli_num_rows($kriteria) > 0) {
                          while ($row = mysqli_fetch_assoc($kriteria)) { ?>
                            <tr>
                              <td><?= $no; ?></td>
                              <td><?= $row['nama_kriteria'] ?></td>
                              <td>
                                <button type="button" class="btn btn-link btn-sm p-0 m-0" data-bs-toggle="modal" data-bs-target="#kriteria<?= $row['id_kriteria'] ?>">
                                  Tambah
                                </button>
                                <div class="modal fade" id="kriteria<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Kriteria <?= $row['nama_kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="sub-kriteria" class="form-label">Sub Kriteria</label>
                                            <input type="text" name="sub-kriteria" class="form-control" id="sub-kriteria" placeholder="Sub Kriteria">
                                          </div>
                                          <div class="mb-3">
                                            <label for="nilai" class="form-label">Nilai</label>
                                            <input type="text" name="nilai" class="form-control" id="nilai" placeholder="Nilai">
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                                          <utton type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</utton>
                                          <button type="submit" name="tambah-sub-kriteria" class="btn btn-primary">Simpan</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <?php $id_kriteria = $row['id_kriteria'];
                                $sub_kriteria = mysqli_query($conn, "SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria'");
                                if (mysqli_num_rows($sub_kriteria) > 0) {
                                  while ($row_sk = mysqli_fetch_assoc($sub_kriteria)) { ?>
                                    <div class="d-flex flex-nowrap justify-content-center mt-1">
                                      <p>
                                        <?= $row_sk['sub_kriteria'] . " (" . $row_sk['nilai_sub'] . ")" ?>
                                      </p>
                                      <form action="" method="post">
                                        <input type="hidden" name="id-sub-kriteria" value="<?= $row_sk['id_sub_kriteria'] ?>">
                                        <button type="submit" name="hapus-sub-kriteria" class="btn btn-link text-danger btn-sm m-0 p-0"><i class="mdi mdi-delete"></i></button>
                                      </form>
                                    </div>
                                <?php }
                                } ?>
                              </td>
                            </tr>
                        <?php $no++;
                          }
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