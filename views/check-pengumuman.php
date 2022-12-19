<?php error_reporting(~E_NOTICE & ~E_DEPRECATED);
if (!isset($_SESSION[''])) {
  session_start();
}
$baseURL = "http://$_SERVER[HTTP_HOST]/pdam-kab-kupang/";
require_once("../controller/db_connect.php");
$check_alternatif = mysqli_query($conn, "SELECT * FROM alternatif JOIN users ON alternatif.id_user=users.id_user ORDER BY users.username ASC");
foreach ($check_alternatif as $row_cekal) {
  $id_alternatif[] = $row_cekal['id_alternatif'];
}
$selected = (array) $id_alternatif;

$xc_kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
$count_kriteria = mysqli_num_rows($xc_kriteria);

require_once("ngitung.php");
