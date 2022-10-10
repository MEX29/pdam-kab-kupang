<?php if (!isset($_SESSION[''])) {
  session_start();
}
require_once("db_connect.php");
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

$baseURL = "http://127.0.0.1:1010/apps/pdam-kab-kupang/";
// $baseURL = "https://2c5b-180-249-165-143.ngrok.io/apps/siperta/";

if (!isset($_SESSION['data-user'])) {
  if (isset($_POST['daftar'])) {
    if (daftar($_POST) > 0) {
      $_SESSION['message-success'] = "Akun kamu berhasil didaftarkan, silakan masuk untuk mulai berbelanja.";
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
  
}
