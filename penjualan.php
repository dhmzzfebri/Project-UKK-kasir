<?php
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
  header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kasir-Toserbada</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php
  require_once('layout/css.php');
  ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <?php
    require_once('layout/navbar.php');
    ?>

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php
  require_once('layout/sidebar.php');
  ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>PELANGGAN</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> Pilih Pelanggan</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="function_transaksi.php" method="post">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Pelanggan</label>
                  <select class="form-select" name="id_plg" id="validationDefault04" required>
                    <?php
                    $tampil = mysqli_query($conn, "SELECT * FROM pelanggan order by id_plg DESC");
                    while ($data = mysqli_fetch_array($tampil)) {
                      $id = $data['id_plg'];
                      $nama = $data['nama_plg'];
                      $alamat = $data['alamat'];
                    ?>
                      <option value="<?= $id ?>"><?= $nama ?> - <?= $alamat ?></option>
                      </option>
                    <?php } ?>
                  </select>
                  <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary" name="tambah_pesanan">
                      Tambah
                    </button>
                  </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

        </div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="card-body">
                <h5 class="card-title">Data Transaksi</h5>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Name Pelanggan</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <?php
                  $no = 1;
                  $tampil = mysqli_query($conn, "SELECT * FROM penjualan p,pelanggan pl where p.id_plg=pl.id_plg order by tanggal DESC");
                  while ($data = mysqli_fetch_array($tampil)) {
                    $id = $data['id_penjualan'];
                    $nama = $data['nama_plg'];
                    $alamat = $data['alamat'];
                    $tanggal = $data['tanggal'];
                  ?>
                    <tbody>
                      <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $tanggal ?></td>
                        <td><?= $nama ?></td>
                        <td><?= $alamat ?></td>
                        <td>
                          <a href="nota.php?id_psn=<?= $id ?>" type="button" class="btn btn-warning" ">
                          detail
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
            </div>
              <!-- End Default Table Example -->
            </div>
          </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  require_once('layout/footer.php');
  ?>
  <!-- End Footer -->

  <a href=" #" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php
    require_once('layout/js.php');
    ?>

</body>

</html>