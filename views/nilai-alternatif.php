<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Nilai Alternatif";
$_SESSION['page-url'] = "nilai-alternatif";
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
            <div class="col-md-12">
              <div class="card card-rounded mt-3">
                <div class="card-body">
                  <div class="table-responsive  mt-1">
                    <table class="table select-table text-center">
                      <thead>
                        <tr>
                          <th scope="col" rowspan="2">Kriteria</th>
                          <th colspan="<?= $count_alternatif ?>">Alternatif</th>
                        <tr>
                          <?php foreach ($take_user_alternatif as $row_useal) : ?>
                            <th><?= $row_useal['username'] ?></th>
                          <?php endforeach; ?>
                          <th scope="col" rowspan="2" colspan="1">Aksi</th>
                        </tr>
                        </tr>
                      </thead>
                      <tbody id="search-page">
                        <?php if (mysqli_num_rows($nilai_alternatif) == 0) { ?>
                          <tr>
                            <td colspan="100">Belum ada data nilai alternatif</td>
                          </tr>
                          <?php } else if (mysqli_num_rows($nilai_alternatif) > 0) {
                          while ($row = mysqli_fetch_assoc($nilai_alternatif)) { ?>
                            <tr>
                              <td><?= $row['nama_kriteria']; ?></td>
                              <?php foreach ($take_user_alternatif as $row_useal) {
                                $id_useal = $row_useal['id_user'];
                                $id_kriteria = $row['id_kriteria'];
                                $xw = mysqli_query($conn, "SELECT * FROM users JOIN alternatif ON users.id_user=alternatif.id_user JOIN nilai_alternatif ON alternatif.id_alternatif=nilai_alternatif.id_alternatif WHERE users.id_user='$id_useal' AND nilai_alternatif.id_kriteria='$id_kriteria' ORDER BY users.username ASC");
                                if (mysqli_num_rows($xw) > 0) {
                                  $xy = mysqli_fetch_assoc($xw); ?>
                                  <td>
                                    <?php $nilai = $xy['nilai'];
                                    if ($nilai >= 5 && $nilai < 20) {
                                      echo "Sangat Kurang baik";
                                    } else if ($nilai >= 20 && $nilai < 50) {
                                      echo "Kurang baik";
                                    } else if ($nilai >= 50 && $nilai < 80) {
                                      echo "Cukup baik";
                                    } else if ($nilai >= 80 && $nilai < 100) {
                                      echo "baik";
                                    } else if ($nilai == 100) {
                                      echo "Sangat baik";
                                    } else if ($nilai == 0) {
                                      echo "-";
                                    }
                                    ?>
                                  </td>
                              <?php }
                              } ?>
                              <td>
                                <form action="" method="post">
                                  <input type="hidden" name="id-kriteria" value="<?= $row['id_kriteria'] ?>">
                                  <input type="hidden" name="nama-kriteria" value="<?= $row['nama_kriteria'] ?>">
                                  <button type="submit" name="check-nilai" class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-table-edit"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>