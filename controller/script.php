<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
if (!isset($_SESSION[''])) {
  session_start();
}
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");

if (isset($_SESSION['time-message'])) {
  if ((time() - $_SESSION['time-message']) > 2) {
    if (isset($_SESSION['message-success'])) {
      unset($_SESSION['message-success']);
    }
    if (isset($_SESSION['message-info'])) {
      unset($_SESSION['message-info']);
    }
    if (isset($_SESSION['message-warning'])) {
      unset($_SESSION['message-warning']);
    }
    if (isset($_SESSION['message-danger'])) {
      unset($_SESSION['message-danger']);
    }
    if (isset($_SESSION['message-dark'])) {
      unset($_SESSION['message-dark']);
    }
    unset($_SESSION['time-alert']);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/pdam-kab-kupang/";

if (!isset($_SESSION['data-user'])) {
  if (isset($_POST['daftar'])) {
    if (daftar($_POST) > 0) {
      $_SESSION['message-success'] = "Akun kamu berhasil didaftarkan.";
      $_SESSION['time-message'] = time();
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST['masuk'])) {
    if (masuk($_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION['data-user'])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['id']))));

  if ($_SESSION['data-user']['role'] == 1) {
    $users_role = mysqli_query($conn, "SELECT * FROM users_role");
    $status_pegawai = mysqli_query($conn, "SELECT * FROM status_pegawai");

    $data_role1 = 25;
    $result_role1 = mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser'");
    $total_role1 = mysqli_num_rows($result_role1);
    $total_page_role1 = ceil($total_role1 / $data_role1);
    $page_role1 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role1 = ($page_role1 > 1) ? ($page_role1 * $data_role1) - $data_role1 : 0;
    $users = mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' ORDER BY users.id_user DESC LIMIT $awal_data_role1, $data_role1");
    if (isset($_POST['ubah-user'])) {
      if (ubah_user($_POST) > 0) {
        $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['hapus-user'])) {
      if (hapus_user($_POST) > 0) {
        $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
  }

  if ($_SESSION['data-user']['role'] <= 2) {
    $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");

    $data_role2 = 25;
    $result_role2 = mysqli_query($conn, "SELECT * FROM users JOIN pegawai ON users.id_user=pegawai.id_user JOIN status_pegawai ON pegawai.id_status=status_pegawai.id_status");
    $total_role2 = mysqli_num_rows($result_role2);
    $total_page_role2 = ceil($total_role2 / $data_role2);
    $page_role2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role2 = ($page_role2 > 1) ? ($page_role2 * $data_role2) - $data_role2 : 0;
    $pegawai = mysqli_query($conn, "SELECT * FROM users JOIN pegawai ON users.id_user=pegawai.id_user JOIN status_pegawai ON pegawai.id_status=status_pegawai.id_status ORDER BY users.id_user DESC LIMIT $awal_data_role2, $data_role2");
    if (isset($_POST['check-smart'])) {
      $_SESSION['check-smart-id'] = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['check-smart']))));
      header("Location: check-with-smart");
      exit();
    }

    $data_role3 = 25;
    $result_role3 = mysqli_query($conn, "SELECT * FROM kriteria");
    $total_role3 = mysqli_num_rows($result_role3);
    $total_page_role3 = ceil($total_role3 / $data_role3);
    $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
    $kriteria = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria DESC LIMIT $awal_data_role3, $data_role3");
    if (isset($_POST['add-kriteria'])) {
      if (add_kriteria($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil menambahkan kriteria baru.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['ubah-kriteria'])) {
      if (ubah_kriteria($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil mengubah kriteria " . $_POST['namaOld'] . ".";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['hapus-kriteria'])) {
      if (hapus_kriteria($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil menghapus kriteria " . $_POST['namaOld'] . ".";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }

    $data_role4 = 25;
    $result_role4 = mysqli_query($conn, "SELECT * FROM alternatif JOIN users ON alternatif.id_user=users.id_user");
    $total_role4 = mysqli_num_rows($result_role4);
    $total_page_role4 = ceil($total_role4 / $data_role4);
    $page_role4 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role4 = ($page_role4 > 1) ? ($page_role4 * $data_role4) - $data_role4 : 0;
    $alternatif = mysqli_query($conn, "SELECT * FROM alternatif JOIN users ON alternatif.id_user=users.id_user ORDER BY users.username ASC LIMIT $awal_data_role4, $data_role4");
    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE id_role='3'");
    if (isset($_POST['add-alternatif'])) {
      if (add_alternatif($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil menambahkan alternatif baru.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['ubah-alternatif'])) {
      if (ubah_alternatif($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil mengubah alternatif.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['hapus-alternatif'])) {
      if (hapus_alternatif($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil menghapus alternatif.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }

    $nilai_alternatif = mysqli_query($conn, "SELECT DISTINCT kriteria.id_kriteria, kriteria.nama_kriteria FROM nilai_alternatif JOIN alternatif ON nilai_alternatif.id_alternatif=alternatif.id_alternatif JOIN kriteria ON nilai_alternatif.id_kriteria=kriteria.id_kriteria JOIN users ON alternatif.id_user=users.id_user ORDER BY kriteria.id_kriteria ASC");
    $count_alternatif = mysqli_query($conn, "SELECT * FROM alternatif");
    $count_alternatif = mysqli_num_rows($count_alternatif);
    $take_user_alternatif = mysqli_query($conn, "SELECT 
      DISTINCT alternatif.id_user, users.username 
      FROM alternatif 
      JOIN users ON alternatif.id_user=users.id_user 
      JOIN nilai_alternatif ON alternatif.id_alternatif=nilai_alternatif.id_alternatif 
      ORDER BY users.username ASC
    ");
    if (isset($_POST['check-nilai'])) {
      $_SESSION['kriteria'] = [
        'id' => htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-kriteria'])))),
        'user' => htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-user'])))),
        'nama' => htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['nama-kriteria'])))),
      ];
      header("Location: edit-nilai");
      exit();
    }
    if (isset($_SESSION['kriteria'])) {
      $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['kriteria']['id']))));
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['kriteria']['user']))));
      $select_sub_kriteria=mysqli_query($conn, "SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria'");
      $nilai_kriteria = mysqli_query($conn, "SELECT * FROM nilai_alternatif JOIN alternatif ON nilai_alternatif.id_alternatif=alternatif.id_alternatif JOIN users ON alternatif.id_user=users.id_user WHERE users.id_user='$id_user' AND nilai_alternatif.id_kriteria='$id_kriteria' ORDER BY users.username ASC");
      if (isset($_POST['ubah-nilai'])) {
        if (ubah_nilai($_POST) > 0) {
          $_SESSION['message-success'] = "Berhasil mengubah nilai " . $_SESSION['kriteria']['nama'] . ".";
          $_SESSION['time-message'] = time();
          header("Location: nilai-alternatif");
          exit();
        }else{
          $_SESSION['message-success'] = "Berhasil mengubah nilai " . $_SESSION['kriteria']['nama'] . ".";
          $_SESSION['time-message'] = time();
          header("Location: nilai-alternatif");
          exit();
        }
      }
    }

    $check_alternatif = mysqli_query($conn, "SELECT * FROM alternatif JOIN users ON alternatif.id_user=users.id_user ORDER BY users.username ASC");
    if (isset($_POST['perhitungan'])) {
      $selected = (array) $_POST['id-alternatif'];
      $success = false;
      if (count($selected) < 2) {
        $_SESSION['message-danger'] = "Maaf, anda harus memilih minimal 2 alternatif untuk melakukan perhitungan.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      } else {
        $success = true;
      }

      require_once("ngitung.php");
    }
    if (isset($_POST['pengangkatan'])) {
      if (pengangkatan($_POST) > 0) {
        $_SESSION['message-success'] = "Status pengakatan dari pegawai tidak tetap ke pegawai tetap berhasil.";
        $_SESSION['time-message'] = time();
        header("Location: pegawai");
        exit();
      }
    }
    if (isset($_POST['tambah-sub-kriteria'])) {
      if (tambah_sub_kriteria($_POST) > 0) {
        $_SESSION['message-success'] = "Sub kriteria berhasil di tambahkan.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }
    if (isset($_POST['hapus-sub-kriteria'])) {
      if (hapus_sub_kriteria($_POST) > 0) {
        $_SESSION['message-success'] = "Sub kriteria berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: " . $_SESSION['page-url']);
        exit();
      }
    }

    // if ($_SESSION['data-user']['role'] == 2) {
    // }
  }

  if ($_SESSION['data-user']['role'] <= 3) {
    if (isset($_POST['ubah-password'])) {
      if (ubah_password($_POST) > 0) {
        $_SESSION['message-success'] = "Kata sandi berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: ../auth/signout");
        exit();
      }
    }
    if ($_SESSION['data-user']['role'] == 3) {
      $profile_pegawai = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_user='$idUser' AND berkas='' OR berkas='-' OR pangkat='-' OR pangkat='' OR telp='+62' OR telp=''");
      $status_pegawai = mysqli_query($conn, "SELECT * FROM pegawai JOIN status_pegawai ON pegawai.id_status=status_pegawai.id_status WHERE pegawai.id_user='$idUser'");
      $profile = mysqli_query($conn, "SELECT * FROM users JOIN pegawai ON users.id_user=pegawai.id_user JOIN status_pegawai ON pegawai.id_status=status_pegawai.id_status WHERE users.id_user='$idUser'");
      if (isset($_POST['ubah-profile'])) {
        if (ubah_profile($_POST) > 0) {
          $_SESSION['message-success'] = "Profil akun anda berhasil di ubah.";
          $_SESSION['time-message'] = time();
          header("Location: " . $_SESSION['page-url']);
          exit();
        }
      }
    }
  }
}
