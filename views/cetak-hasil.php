<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: " . $_SESSION['page-url']);
  exit();
}
$_SESSION['page-name'] = "Cetak Hasil";
$_SESSION['page-url'] = "cetak-hasil";

$selected = $_SESSION['selected'];
$xc_kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
$count_kriteria = mysqli_num_rows($xc_kriteria);
require_once("ngitung.php");
$bobot_kriteria = get_bobot_kriteria();
$normal_kriteria = get_normal_kriteria($bobot_kriteria);
$data = get_hasil_analisa('', $selected);
$terbobot = get_terbobot($data, $normal_kriteria);
$total = get_total($terbobot);
$rank = get_rank($total);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Perhitungan Pegawai Tetap PDAM Kab Kupang.xls");
?>

<center>
  <h3>Data Perhitungan Pengangkatan Pegawai Tetap PDAM Kab. Kupang</h3>
</center>
<table border="1">
  <thead>
    <tr align="center">
      <th scope="col" rowspan="2">Rank</th>
      <th scope="col" rowspan="2">Nama Pegawai</th>
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