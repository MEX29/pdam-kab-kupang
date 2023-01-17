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

<head>
  <?php require_once("../resources/dash-header.php") ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

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
              <form action="" method="post" id="form">
                <?php if (mysqli_num_rows($nilai_kriteria) > 0) {
                  while ($row = mysqli_fetch_assoc($nilai_kriteria)) { ?>
                    <div class="mb-3">
                      <label for="nilai" class="form-label"><strong><?= $row['username'] ?></strong></label>
                      <?php $no = 1;
                      foreach ($select_sub_kriteria as $row_ssk) : ?>
                        <div class="row mb-3">
                          <div class="col-lg-2 m-auto"><?= $row_ssk['sub_kriteria'] ?></div>
                          <div class="col-lg-1">
                            <input type="number" name="angka[]" value="<?= $row['nilai'] ?>" class="form-control p-2" id="nilai<?= $no; ?>" placeholder="Nilai" max="<?= $row_ssk['nilai_sub'] ?>" required>
                            <div id="error<?= $no; ?>"></div>
                            <script>
                              $(document).ready(function() {
                                $("#nilai<?= $no; ?>").on("input", function() {
                                  if ($(this).val().length > 2) {
                                    $(this).val($(this).val().slice(0, 2));
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Gagal',
                                      text: "Nilai tidak boleh lebih dari 2 digit.",
                                    })
                                  }else if($(this).val() > <?= $row_ssk['nilai_sub'] ?>) {
                                    $(this).val($(this).val().slice(0, 2));
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Gagal',
                                      text: "Nilai tidak boleh lebih dari <?= $row_ssk['nilai_sub'] ?>.",
                                    })
                                  } else {
                                    $("#error<?= $no; ?>").text("");
                                  }
                                });
                              });
                            </script>
                          </div>
                          <div class="col-lg-9"></div>
                        </div>
                      <?php $no++;
                      endforeach; ?>
                      <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-1">
                          <input type="number" name="nilai" id="hasil" class="form-control p-1" readonly required>
                        </div>
                        <div class="col-lg-1">
                          <button type="button" id="hitung" class="btn btn-primary btn-sm rounded-0" style="margin-left: -10px;">Hitung</button>
                        </div>
                        <script>
                          // ambil semua elemen input dengan nama "angka"
                          const angkaInputs = document.querySelectorAll("[name='angka[]']");

                          // ambil elemen input dengan nama "nilai"
                          const nilaiInput = document.querySelector("[name='nilai']");

                          // ambil tombol dengan id "hitung"
                          const hitungButton = document.getElementById("hitung");

                          // tambahkan event "click" pada tombol "hitung"
                          hitungButton.addEventListener("click", function() {
                            // inisialisasi variabel total dengan nilai 0
                            let total = 0;

                            // lakukan looping untuk setiap elemen input dengan nama "angka"
                            angkaInputs.forEach(function(angkaInput) {
                              // tambahkan nilai dari elemen input tersebut ke variabel total
                              total += parseInt(angkaInput.value);
                            });

                            if (total > 100) {
                              Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: "Jumlah nilai tidak boleh melebihi batas maksimum yaitu 100.",
                              })
                            }

                            // tampilkan total nilai pada elemen input dengan nama "nilai"
                            nilaiInput.value = total;
                          });
                        </script>

                      </div>
                      <input type="hidden" name="id-nilai" value="<?= $row['id_nilai_alternatif'] ?>">
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