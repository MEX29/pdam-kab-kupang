<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Kelola Akun";
$_SESSION['page-url'] = "profile";
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
          <?php if (mysqli_num_rows($profile) > 0) {
            while ($row = mysqli_fetch_assoc($profile)) { ?>
              <div class="row flex-row-reverse">
                <?php if ($_SESSION['data-user']['role'] == 3) { ?>
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h2>Lengkapi Profil</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="username" class="form-label">Nama Lengkap</label>
                            <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control" id="username" placeholder="Nama" required>
                          </div>
                          <div class="mb-3">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <input type="text" name="pangkat" value="<?= $row['pangkat'] ?>" class="form-control" id="pangkat" placeholder="Pangkat" required>
                          </div>
                          <div class="mb-3">
                            <label for="telp" class="form-label">Telp</label>
                            <input type="number" name="telp" value="<?= $row['telp'] ?>" class="form-control" id="telp" placeholder="Telp" required>
                          </div>
                          <div class="mb-3">
                            <label for="berkas" class="form-label">Berkas</label>
                            <input class="form-control" type="file" name="berkas" id="berkas" required>
                            <input type="hidden" name="berkasOld" value="<?= $row['berkas'] ?>">
                          </div>
                          <button type="submit" name="ubah-profile" class="btn btn-primary">Simpan</button>
                        </form>
                      </div>
                    </div>
                    <div class="card mt-3">
                      <div class="card-body text-center">
                        <h2>Ubah Password</h2>
                        <form action="" method="POST">
                          <div class="mb-3">
                            <label for="sandi-lama" class="form-label">Kata Sandi saat ini</label>
                            <input type="password" name="passwordOld" class="form-control" id="sandi-lama" placeholder="" required>
                          </div>
                          <div class="mb-3">
                            <label for="sandi-baru" class="form-label">Kata Sandi baru</label>
                            <input type="password" name="password" class="form-control" id="sandi-baru" placeholder="" required>
                          </div>
                          <div class="mb-3">
                            <label for="ulangi-sandi" class="form-label">ulangi Kata Sandi</label>
                            <input type="password" name="re-password" class="form-control" id="ulangi-sandi" placeholder="" required>
                          </div>
                          <input type="hidden" name="passwordOld-check" value="<?= $row['password'] ?>">
                          <button type="submit" name="ubah-password" class="btn btn-primary">Simpan</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="card">
                      <div class="card-body">
                        <h2>Profil Akun</h2>
                        <div class="table-responsive">
                          <table class="table table-borderless table-sm">
                            <tbody>
                              <tr>
                                <th scope="row">Nama</th>
                                <td>:</td>
                                <td class="w-75"><?= $row['username'] ?></td>
                              </tr>
                              <tr>
                                <th scope="row">Email</th>
                                <td>:</td>
                                <td class="w-75"><?= $row['email'] ?></td>
                              </tr>
                              <tr>
                                <th scope="row">Pangkat</th>
                                <td>:</td>
                                <td class="w-75"><?= $row['pangkat'] ?></td>
                              </tr>
                              <tr>
                                <th scope="row">Telp</th>
                                <td>:</td>
                                <td class="w-75"><?= $row['telp'] ?></td>
                              </tr>
                              <tr>
                                <th scope="row">Berkas</th>
                                <td>:</td>
                              </tr>
                            </tbody>
                          </table>
                          <embed src="../assets/doc/berkas/<?= $row['berkas'] ?>" type="application/pdf" width="100%" height="600px" />
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } else if ($_SESSION['data-user']['role'] <= 2) { ?>
                  <div class="col-lg-8"></div>
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <h2>Ubah Password</h2>
                        <form action="" method="POST">
                          <div class="mb-3">
                            <label for="sandi-lama" class="form-label">Kata Sandi saat ini</label>
                            <input type="password" name="passwordOld" class="form-control" id="sandi-lama" placeholder="" required>
                          </div>
                          <div class="mb-3">
                            <label for="sandi-baru" class="form-label">Kata Sandi baru</label>
                            <input type="password" name="password" class="form-control" id="sandi-baru" placeholder="" required>
                          </div>
                          <div class="mb-3">
                            <label for="ulangi-sandi" class="form-label">ulangi Kata Sandi</label>
                            <input type="password" name="re-password" class="form-control" id="ulangi-sandi" placeholder="" required>
                          </div>
                          <input type="hidden" name="passwordOld-check" value="<?= $row['password'] ?>">
                          <button type="submit" name="ubah-password" class="btn btn-primary">Simpan</button>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
          <?php }
          } ?>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>