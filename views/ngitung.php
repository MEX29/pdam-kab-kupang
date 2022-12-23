<?php
if (isset($_SESSION['data-user'])) {
  require_once("../controller/db_connect.php");
} else {
  require_once("controller/db_connect.php");
}
// Normaslisasi Kriteria
$xc_kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
$kriteria_cv = mysqli_query($conn, "SELECT id_kriteria, nama_kriteria, bobot FROM kriteria ORDER BY id_kriteria");
$KRITERIA = array();
foreach ($kriteria_cv as $row_cv) {
  $id_kriteria = $row_cv['id_kriteria'];
  $KRITERIA[$id_kriteria] = array(
    'nama_kriteria' => $row_cv['nama_kriteria'],
    'bobot' => $row_cv['bobot'],
  );
}
function get_bobot_kriteria()
{
  global $KRITERIA;
  $arr = array();
  foreach ($KRITERIA as $key => $val) {
    $arr[$key] = $val['bobot'];
  }
  return $arr;
}
function get_normal_kriteria($bobot_kriteria)
{
  $arr = array();
  $sum = array_sum($bobot_kriteria);
  foreach ($bobot_kriteria as $key => $val) {
    $arr[$key] = ($sum == 0) ? 0 : $val / $sum;
  }
  return $arr;
}

// Alternatif
$alternatif_al = mysqli_query($conn, "SELECT alternatif.id_alternatif, alternatif.updated_at, users.username FROM alternatif JOIN users ON alternatif.id_user=users.id_user ORDER BY alternatif.id_alternatif");
$ALTERNATIF = array();
foreach ($alternatif_al as $row_al) {
  $id_alternatif = $row_al['id_alternatif'];
  $ALTERNATIF[$id_alternatif] = $row_al['username'];
  $DATES[$id_alternatif] = $row_al['updated_at'];
}
function get_hasil_analisa($search = '', $alternatif = array())
{
  global $conn;
  $where = $alternatif ? " nilai_alternatif.id_alternatif IN ('" . implode("','", $alternatif) . "')" : '';
  $rows = mysqli_query($conn, "SELECT alternatif.id_alternatif, kriteria.id_kriteria, nilai_alternatif.nilai FROM alternatif
        	JOIN nilai_alternatif ON nilai_alternatif.id_alternatif=alternatif.id_alternatif
        	JOIN kriteria ON nilai_alternatif.id_kriteria=kriteria.id_kriteria
        	JOIN users ON alternatif.id_user=users.id_user 
          WHERE $where
          ORDER BY alternatif.id_alternatif, kriteria.id_kriteria
        ");
  $data = array();
  foreach ($rows as $row) {
    $id_kriteria = $row['id_kriteria'];
    $id_alternatif = $row['id_alternatif'];
    $data[$id_alternatif][$id_kriteria] = $row['nilai'];
  }
  return $data;
}

// Normalisasi Terbobot
function get_terbobot($data, $normal_kriteria)
{
  $arr = array();
  foreach ($data as $key => $val) {
    foreach ($val as $k => $v) {
      $arr[$key][$k] = $v * $normal_kriteria[$k];
    }
  }
  return $arr;
}
function get_total($terbobot)
{
  $arr = array();
  foreach ($terbobot as $key => $val) {
    foreach ($val as $k => $v) {
      $arr[$key] += $v;
    }
  }
  return $arr;
}
function get_rank($array)
{
  $data = $array;
  arsort($data);
  $no = 1;
  $new = array();
  foreach ($data as $key => $value) {
    $new[$key] = $no++;
  }
  return $new;
}
