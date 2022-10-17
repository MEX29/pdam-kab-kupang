<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Pengangkatan";
$_SESSION['page-url'] = "pengangkatan";
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
              <h2>Pilih Alternatif</h2>
              <form action="" method="post">
                <?php foreach ($check_alternatif as $row_cekal) : ?>
                  <div class="form-check">
                    <input class="form-check-input" style="margin-left: 5px;" type="checkbox" name="id-alternatif[]" value="<?= $row_cekal['id_alternatif'] ?>" id="<?= $row_cekal['username'] ?>">
                    <label class="form-check-label" for="<?= $row_cekal['username'] ?>">
                      <?= $row_cekal['username'] ?>
                    </label>
                  </div>
                <?php endforeach; ?>
                <button type="submit" name="perhitungan" class="btn btn-primary">Perhitungan</button>
              </form>
            </div>
            <?php if (isset($_POST['perhitungan'])) {
              $bobot_kriteria = get_bobot_kriteria();
              $normal_kriteria = get_normal_kriteria($bobot_kriteria);
              $data = get_hasil_analisa('', $selected);
              $terbobot = get_terbobot($data, $normal_kriteria);
              $total = get_total($terbobot);
              $rank = get_rank($total);
            ?>
              <div class="col-md-12 mt-5">
                <h4>Normaslisasi Kriteria</h4>
                <hr>
                <div class="card border-0">
                  <div class="card-body table-responsive">
                    <table class="table text-center">
                      <thead>
                        <tr>
                          <th scope="col"></th>
                          <?php foreach ($xc_kriteria as $row_xc) : ?>
                            <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                          <?php endforeach; ?>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Bobot</th>
                          <?php $total_bobot = 0;
                          foreach ($xc_kriteria as $row_xc) : ?>
                            <td><?= $row_xc['bobot'] ?></td>
                          <?php $total_bobot += $row_xc['bobot'];
                          endforeach; ?>
                          <td><?= $total_bobot; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Bobot Normal</th>
                          <?php foreach ($normal_kriteria as $key => $val) : ?>
                            <td><?= round($val, 2) ?></td>
                          <?php endforeach ?>
                          <td><?= array_sum($normal_kriteria) ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-12 mt-3">
                <h4>Alternatif</h4>
                <hr>
                <div class="card border-0">
                  <div class="card-body table-responsive">
                    <table class="table text-center">
                      <thead>
                        <tr>
                          <th scope="col"></th>
                          <?php foreach ($xc_kriteria as $row_xc) : ?>
                            <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data as $key => $val) : ?>
                          <tr>
                            <th><?= $ALTERNATIF[$key] ?></th>
                            <?php foreach ($val as $k => $v) : ?>
                              <td><?= $v ?></td>
                            <?php endforeach ?>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-12 mt-3">
                <h4>Normalisasi Terbobot</h4>
                <hr>
                <div class="card border-0">
                  <div class="card-body table-responsive">
                    <table class="table text-center">
                      <thead>
                        <tr>
                          <th></th>
                          <?php foreach ($xc_kriteria as $row_xc) : ?>
                            <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                          <?php endforeach; ?>
                          <th>Total</th>
                          <th>Rank</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rank as $key => $val) : ?>
                          <tr>
                            <th><?= $ALTERNATIF[$key] ?></th>
                            <?php foreach ($terbobot[$key] as $k => $v) : ?>
                              <td><?= round($v, 2) ?></td>
                            <?php endforeach ?>
                            <td><?= round($total[$key], 2) ?></td>
                            <td><?= $rank[$key] ?></td>
                          </tr>
                        <?php
                          $_SESSION['selected'] = $selected;
                          mysqli_query($conn, "UPDATE alternatif SET total='$total[$key]', rank='$rank[$key]' WHERE id_alternatif='$key'");
                        endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col md-12 mt-3">
                <div class="d-flex">
                  <div>
                    <a style="cursor: pointer;" onclick="window.open('cetak-hasil', '_blank')" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cetak hasil perhitungan akhir ke excel">
                      <i class="mdi mdi-file-excel" style="font-size: 20px;"></i>
                    </a>
                  </div>
                  <div style="margin-left: 10px;">
                    <form action="" method="post">
                      <?php foreach ($rank as $key => $val) : ?>
                        <input type="hidden" name="total[]" value="<?= round($total[$key], 4) ?>">
                        <input type="hidden" name="username[]" value="<?= $ALTERNATIF[$key] ?>">
                      <?php endforeach ?>
                      <button type="submit" name="pengangkatan" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lakukan otomatisasi pengakatan dari pegawai tidak tetap ke pegawai tetap dengan satu kali klik saja.">
                        <i class="mdi mdi-account-check" style="font-size: 20px;"></i>
                      </button>
                    </form>
                  </div>
                  <div style="margin-left: 10px;">
                    <a style="cursor: pointer;" onclick="window.location.href='pengangkatan'" class="btn btn-secondary btn-sm">
                      <i class="mdi mdi-reload" style="font-size: 20px;"></i>
                    </a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>