<?php
if (!isset($_SESSION['data-user'])) {
  function daftar($data)
  {
    global $conn;
    $takeID = mysqli_query($conn, "SELECT * FROM users ORDER BY id_user DESC LIMIT 1");
    if (mysqli_num_rows($takeID) > 0) {
      $row = mysqli_fetch_assoc($takeID);
      $id_user = $row['id_user'] + 1;
    } else if (mysqli_num_rows($takeID) > 0) {
      $id_user = 1;
    }
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $checkMail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkMail) > 0) {
      $_SESSION['message-danger'] = "Maaf, akun yang kamu masukan sudah terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(id_user,username,email,password) VALUES('$id_user','$username','$email','$password')");
    mysqli_query($conn, "INSERT INTO pegawai(id_user) VALUES('$id_user')");
    return mysqli_affected_rows($conn);
  }
  function masuk($data)
  {
    global $conn;
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION['message-danger'] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if ($row['id_status'] == 2) {
        $_SESSION['message-danger'] = "Maaf, akun anda belum diaktifkan oleh admin.";
        $_SESSION['time-message'] = time();
        return false;
      } else if ($row['id_status'] == 1) {
        if (password_verify($password, $row['password'])) {
          $_SESSION['data-user'] = [
            'id' => $row['id_user'],
            'role' => $row['id_role'],
            'username' => $row['username'],
            'email' => $row['email'],
          ];
        } else {
          $_SESSION['message-danger'] = "Maaf, kata sandi yang anda masukan salah.";
          $_SESSION['time-message'] = time();
          return false;
        }
      }
    }
  }
}
if (isset($_SESSION['data-user'])) {
  if ($_SESSION['data-user']['role'] == 1) {
    function add_user($data)
    {
      global $conn;
    }
    function ubah_user($data)
    {
      global $conn, $time;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      $status = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['status']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE users SET id_status='$status', updated_at='$updated_at' WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function hapus_user($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      mysqli_query($conn, "DELETE FROM pegawai WHERE id_user='$id_user'");
      mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
  }

  if ($_SESSION['data-user']['role'] <= 2) {
    function ubah_pegawai($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
    }
    function hapus_pegawai($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      mysqli_query($conn, "DELETE FROM pegawai WHERE id_user='$id_user'");
      mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function add_kriteria($data)
    {
      global $conn;
      $checkKode = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY kode_kriteria DESC LIMIT 1");
      if (mysqli_num_rows($checkKode) > 0) {
        $row = mysqli_fetch_assoc($checkKode);
        $kode = preg_replace("/[^0-9]/", "", $row['kode_kriteria']);
        $kode = $kode + 1;
        $kode_kriteria = "C" . $kode;
      } else if (mysqli_num_rows($checkKode) == 0) {
        $kode_kriteria = "C1";
      }
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $checkNama = mysqli_query($conn, "SELECT * FROM kriteria WHERE nama_kriteria='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama kriteria sudah ada. Silakan masukan nama kriteria yang lain.";
        $_SESSION['time-message'] = time();
        return false;
      }
      $bobot = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bobot']))));
      mysqli_query($conn, "INSERT INTO kriteria(kode_kriteria,nama_kriteria,bobot) VALUES('$kode_kriteria','$nama','$bobot')");
      return mysqli_affected_rows($conn);
    }
    function ubah_kriteria($data)
    {
      global $conn, $time;
      $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
      if ($nama != $namaOld) {
        $checkNama = mysqli_query($conn, "SELECT * FROM kriteria WHERE nama_kriteria='$nama'");
        if (mysqli_num_rows($checkNama) > 0) {
          $_SESSION['message-danger'] = "Maaf, nama kriteria sudah ada. Silakan masukan nama kriteria yang lain.";
          $_SESSION['time-message'] = time();
          return false;
        }
      }
      $bobot = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bobot']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE kriteria SET nama_kriteria='$nama', bobot='$bobot', updated_at='$updated_at' WHERE id_kriteria='$id_kriteria'");
      return mysqli_affected_rows($conn);
    }
    function hapus_kriteria($data)
    {
      global $conn;
      $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
      $checkID = mysqli_query($conn, "SELECT * FROM nilai_alternatif WHERE id_kriteria='$id_kriteria'");
      if (mysqli_num_rows($checkID) > 0) {
        mysqli_query($conn, "DELETE FROM nilai_alternatif WHERE id_kriteria='$id_kriteria'");
      }
      mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
      return mysqli_affected_rows($conn);
    }
    function add_alternatif($data)
    {
      global $conn;
      $checkID = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id_alternatif DESC LIMIT 1");
      if (mysqli_num_rows($checkID) > 0) {
        $row = mysqli_fetch_assoc($checkID);
        $id_alternatif = $row['id_alternatif'] + 1;
      } else if (mysqli_num_rows($checkID) == 0) {
        $id_alternatif = 1;
      }
      $checkKode = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY kode_alternatif DESC LIMIT 1");
      if (mysqli_num_rows($checkKode) > 0) {
        $row = mysqli_fetch_assoc($checkKode);
        $kode = preg_replace("/[^0-9]/", "", $row['kode_alternatif']);
        $kode = $kode + 1;
        $kode_alternatif = "A" . $kode;
      } else if (mysqli_num_rows($checkKode) == 0) {
        $kode_alternatif = "A1";
      }
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      $checkUser = mysqli_query($conn, "SELECT * FROM alternatif WHERE id_user='$id_user'");
      if (mysqli_num_rows($checkUser) > 0) {
        $_SESSION['message-danger'] = "Maaf, alternatif sudah ada. Silakan masukan nama pegawai yang lain sebagai alternatif.";
        $_SESSION['time-message'] = time();
        return false;
      }
      mysqli_query($conn, "INSERT INTO alternatif(id_alternatif,kode_alternatif,id_user) VALUES('$id_alternatif','$kode_alternatif','$id_user')");
      $loop_kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
      while ($row_kri = mysqli_fetch_assoc($loop_kriteria)) {
        $id_kriteria = $row_kri['id_kriteria'];
        mysqli_query($conn, "INSERT INTO nilai_alternatif(id_kriteria,id_alternatif) VALUES('$id_kriteria','$id_alternatif')");
      }
      return mysqli_affected_rows($conn);
    }
    function ubah_alternatif($data)
    {
      global $conn, $time;
      $id_alternatif = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-alternatif']))));
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      $checkUser = mysqli_query($conn, "SELECT * FROM alternatif WHERE id_user='$id_user'");
      if (mysqli_num_rows($checkUser) > 0) {
        $_SESSION['message-danger'] = "Maaf, alternatif sudah ada. Silakan masukan nama pegawai yang lain sebagai alternatif.";
        $_SESSION['time-message'] = time();
        return false;
      }
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE alternatif SET id_user='$id_user', updated_at='$updated_at' WHERE id_alternatif='$id_alternatif'");
      return mysqli_affected_rows($conn);
    }
    function hapus_alternatif($data)
    {
      global $conn;
      $id_alternatif = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-alternatif']))));
      mysqli_query($conn, "DELETE FROM nilai_alternatif WHERE id_alternatif='$id_alternatif'");
      mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif='$id_alternatif'");
      return mysqli_affected_rows($conn);
    }
    function ubah_nilai($data)
    {
      global $conn;
      $nilai = $data['nilai'];
      $id_nilai = $data['id-nilai'];
      mysqli_query($conn, "UPDATE nilai_alternatif SET nilai='$nilai' WHERE id_nilai_alternatif='$id_nilai'");
      return mysqli_affected_rows($conn);
    }
    function pengangkatan($data)
    {
      global $conn, $time;
      $total = $data['total'];
      $username = $data['username'];
      $count = count($username);
      $updated_at = date("Y-m-d " . $time);
      for ($x = 0; $x < $count; $x++) {
        if ($total[$x] >= 75) {
          $sql = "UPDATE pegawai JOIN users ON pegawai.id_user=users.id_user SET pegawai.id_status='2', users.updated_at='$updated_at' WHERE users.username='$username[$x]'";
          mysqli_query($conn, $sql);
        } else if ($total[$x] < 75) {
          $sql = "UPDATE pegawai JOIN users ON pegawai.id_user=users.id_user SET pegawai.id_status='1', users.updated_at='$updated_at' WHERE users.username='$username[$x]'";
          mysqli_query($conn, $sql);
        }
      }
      return mysqli_affected_rows($conn);
    }
    function tambah_sub_kriteria($data)
    {
      global $conn;
      $id_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kriteria']))));
      $sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['sub-kriteria']))));
      $nilai=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nilai']))));
      mysqli_query($conn, "INSERT INTO sub_kriteria(id_kriteria,sub_kriteria,nilai_sub) VALUES('$id_kriteria','$sub_kriteria','$nilai')");
      return mysqli_affected_rows($conn);
    }
    function hapus_sub_kriteria($data)
    {
      global $conn;
      $id_sub_kriteria = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-sub-kriteria']))));
      mysqli_query($conn, "DELETE FROM sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria'");
      return mysqli_affected_rows($conn);
    }
    // if ($_SESSION['data-user']['role'] == 2) {
    // }
  }

  if ($_SESSION['data-user']['role'] <= 3) {
    function ubah_password($data)
    {
      global $conn, $idUser;
      $passwordOld_check = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['passwordOld-check']))));
      $passwordOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['passwordOld']))));
      $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
      $re_password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['re-password']))));
      if (password_verify($passwordOld, $passwordOld_check)) {
        if (password_verify($password, $passwordOld_check)) {
          $_SESSION['message-danger'] = "Maaf, kata sandi baru yang anda masukan sama dengan kata sandi yang lama.";
          $_SESSION['time-message'] = time();
          return false;
        } else {
          if ($password != $re_password) {
            $_SESSION['message-danger'] = "Maaf, kata sandi baru yang anda masukan tidak sama.";
            $_SESSION['time-message'] = time();
            return false;
          }
          if (strlen($password) < 8) {
            $_SESSION['message-danger'] = "Maaf, kata sandi baru yang anda masukan minimal harus 8 karakter.";
            $_SESSION['time-message'] = time();
            return false;
          }
          $password = password_hash($password, PASSWORD_DEFAULT);
          mysqli_query($conn, "UPDATE users SET password='$password' WHERE id_user='$idUser'");
          return mysqli_affected_rows($conn);
        }
      } else {
        $_SESSION['message-danger'] = "Maaf, kata sandi lama yang anda masukan salah.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
    if ($_SESSION['data-user']['role'] == 3) {
      function berkas()
      {
        $namaFile = $_FILES["berkas"]["name"];
        $ukuranFile = $_FILES["berkas"]["size"];
        $error = $_FILES["berkas"]["error"];
        $tmpName = $_FILES["berkas"]["tmp_name"];
        if ($error === 4) {
          $_SESSION['message-danger'] = "Pilih file terlebih dahulu!";
          $_SESSION['time-message'] = time();
          return false;
        }
        $ekstensiGambarValid = ['pdf'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
          $_SESSION['message-danger'] = "Maaf, file kamu bukan pdf!";
          $_SESSION['time-message'] = time();
          return false;
        }
        if ($ukuranFile > 2000000) {
          $_SESSION['message-danger'] = "Maaf, ukuran file terlalu besar! (2 MB)";
          $_SESSION['time-message'] = time();
          return false;
        }
        $namaFile_encrypt = crc32($namaFile);
        $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
        move_uploaded_file($tmpName, '../assets/doc/berkas/' . $encrypt);
        return $encrypt;
      }
      function ubah_profile($data)
      {
        global $conn, $idUser, $time;
        $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
        $pangkat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pangkat']))));
        $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
        $berkasOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['berkasOld']))));
        if (!empty($_FILES['berkas'])) {
          $berkas = berkas();
          if (!$berkas) {
            return false;
          } else {
            unlink('../assets/doc/berkas/' . $berkasOld);
          }
        } else {
          $berkas = $berkasOld;
        }
        $updated_at = date("Y-m-d " . $time);
        mysqli_query($conn, "UPDATE users SET username='$username', updated_at='$updated_at' WHERE id_user='$idUser'");
        mysqli_query($conn, "UPDATE pegawai SET pangkat='$pangkat', telp='$telp', berkas='$berkas' WHERE id_user='$idUser'");
        return mysqli_affected_rows($conn);
      }
    }
  }
}
