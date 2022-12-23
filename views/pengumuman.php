<?php require_once("check-pengumuman.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Pengumuman";
$_SESSION['page-url'] = "pengumuman";
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
            <div class="col-sm-12">
              <?php
              $bobot_kriteria = get_bobot_kriteria();
              $normal_kriteria = get_normal_kriteria($bobot_kriteria);
              $data = get_hasil_analisa('', $selected);
              $terbobot = get_terbobot($data, $normal_kriteria);
              $total = get_total($terbobot);
              $rank = get_rank($total);
              ?>
              <div class="card border-0">
                <div class="card-body table-responsive">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col" rowspan="2">Rank</th>
                        <th scope="col" rowspan="2">Nama Pegawai</th>
                        <th scope="col" rowspan="2">Tanggal</th>
                        <th colspan="<?= $count_kriteria ?>">Kriteria</th>
                      <tr>
                        <?php foreach ($xc_kriteria as $row_xc) : ?>
                          <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                        <?php endforeach; ?>
                        <th scope="col" rowspan="1">Total</th>
                        <th scope="col" rowspan="1">Status</th>
                      </tr>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($rank as $key => $val) : ?>
                        <tr align="center">
                          <td><?= $rank[$key] ?></td>
                          <th><?= $ALTERNATIF[$key] ?></th>
                          <th><?php $dateCreate = date_create($DATES[$key]);
                              echo date_format($dateCreate, "l, d M Y"); ?></th>
                          <?php foreach ($terbobot[$key] as $k => $v) : ?>
                            <td><?= round($v, 2) ?></td>
                          <?php endforeach ?>
                          <td><?= round($total[$key], 2) ?></td>
                          <td><?php $nilai = round($total[$key], 2);
                              if ($nilai >= 75) {
                                echo "Pegawai Tetap";
                              } else {
                                echo "Pegawai Tidak Tetap";
                              } ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>