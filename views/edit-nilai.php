<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_SESSION['kriteria'])) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Ubah Nilai " . $_SESSION['kriteria']['nama'];
$_SESSION['page-url'] = "edit-nilai";
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
          <div class="row">
            <div class="col-md-12">
              <h2 class="mb-3">Nilai <?= $_SESSION['kriteria']['nama'] ?></h2>
              <form action="" method="post">
                <?php if (mysqli_num_rows($nilai_kriteria) > 0) {
                  while ($row = mysqli_fetch_assoc($nilai_kriteria)) { ?>
                    <div class="mb-3">
                      <label for="nilai" class="form-label"><?= $row['username'] ?></label>
                      <!-- <input type="number" name="nilai[]" value="<?= $row['nilai'] ?>" class="form-control" id="nilai" placeholder="Nilai" required> -->
                      <select name="nilai[]" class="form-select" aria-label="Pilih Penilaian">
                        <?php if ($row['nilai'] >= 5 && $row['nilai'] < 20) { ?>
                          <option value="5">Sangat Kurang baik</option>
                          <option value="20">Kurang baik</option>
                          <option value="50">Cukup Baik</option>
                          <option value="80">Baik</option>
                          <option value="100">Sangat Baik</option>
                        <?php } else if ($row['nilai'] >= 20 && $row['nilai'] < 50) { ?>
                          <option value="20">Kurang baik</option>
                          <option value="5">Sangat Kurang baik</option>
                          <option value="50">Cukup Baik</option>
                          <option value="80">Baik</option>
                          <option value="100">Sangat Baik</option>
                        <?php } else if ($row['nilai'] >= 50 && $row['nilai'] < 80) { ?>
                          <option value="50">Cukup Baik</option>
                          <option value="5">Sangat Kurang baik</option>
                          <option value="20">Kurang baik</option>
                          <option value="80">Baik</option>
                          <option value="100">Sangat Baik</option>
                        <?php } else if ($row['nilai'] >= 80 && $row['nilai'] < 100) { ?>
                          <option value="80">Baik</option>
                          <option value="5">Sangat Kurang baik</option>
                          <option value="20">Kurang baik</option>
                          <option value="50">Cukup Baik</option>
                          <option value="100">Sangat Baik</option>
                        <?php } else if ($row['nilai'] == 100) { ?>
                          <option value="100">Sangat Baik</option>
                          <option value="5">Sangat Kurang baik</option>
                          <option value="20">Kurang baik</option>
                          <option value="50">Cukup Baik</option>
                          <option value="80">Baik</option>
                        <?php } else if ($row['nilai'] == 0) { ?>
                          <option selected value="">Pilih Penilaian</option>
                          <option value="5">Sangat Kurang baik</option>
                          <option value="20">Kurang baik</option>
                          <option value="50">Cukup Baik</option>
                          <option value="80">Baik</option>
                          <option value="100">Sangat Baik</option>
                        <?php } ?>
                      </select>
                      <input type="hidden" name="id-nilai[]" value="<?= $row['id_nilai_alternatif'] ?>">
                    </div>
                <?php }
                } ?>
                <button type="submit" name="ubah-nilai" class="btn btn-warning">Ubah</button>
                <a href="nilai-alternatif" class="btn btn-secondary" style="margin-left: 10px;">Kembali</a>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>