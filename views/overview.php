<?php require_once("../controller/script.php"); ?>
<div class="container m-0 p-0">
  <div class="row">
    <?php if ($_SESSION['data-user']['role'] == 3) {
      if (mysqli_num_rows($profile_pegawai) > 0) { ?>
        <div class="col-md-12">
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
          </svg>
          <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
              <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
              Perhatian! Segera melengkapi profile kamu sekarang sebelum dilakukan pengangkatan sebagai pegawai tetap di PDAM Kabupaten Kupang. Lengkapi profile kamu <a href="profile" class="text-decoration-none">disini</a>.
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="col-md-12">
        <div class="card mt-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="../assets/images/banner.jpg" class="img-fluid rounded-start" alt="">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h1>PDAM Kabupaten Kupang</h1>
                <p class="card-text">Pengangkatan pegawai tidak tetap menjadi pegawai tetap dengan menggunakan Metode SMART (Simple Multi Attribute Rating Technique) dalam upaya untuk mendapatkan keputusan yang tepat dan akurat sesuai kriteria pada PDAM Kabupaten Kupang.</p>
                <p class="card-text mt-3">Status kamu saat ini: <strong><?php foreach ($status_pegawai as $row_status) {
                                                                          echo $row_status['status_pegawai'];
                                                                        } ?></strong></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>