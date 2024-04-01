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
      <h1>PRODUK</h1>
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
              <h5 class="card-title"> Form Produk</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="function_produk.php" method="post">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama Produk</label>
                  <input type="text" class="form-control" name="nama_produk" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Kode Produk</label>
                  <input type="text" class="form-control" name="kd_produk" id="inputEmail4">
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Stok</label>
                  <input type="number" class="form-control" name="stok" id="inputPassword4" require>
                </div>
                <div class="col-12">
                  <label for="yourPassword" class="form-label">Harga</label>
                  <input type="number" name="harga" class="form-control" id="yourPassword" required>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-primary" name="tmbh_produk">Submit</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

        </div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="card-body">
                <h5 class="card-title">Data Produk</h5>
                <div class="text-end">
                  <a href="laporan_stok.php" target="_blank" type="button" class="btn btn-primary">Laporan Stok</a>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name produk</th>
                      <th scope="col">Kode produk</th>
                      <th scope="col">Stok</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <?php
                  $no = 1;
                  $tampil = mysqli_query($conn, "SELECT * FROM produk");
                  while ($data = mysqli_fetch_array($tampil)) {
                    $id = $data['id_produk'];
                    $nama = $data['nama_produk'];
                    $kd = $data['kd_produk'];
                    $stok = $data['stok'];
                    $harga = $data['harga'];
                  ?>
                    <tbody>
                      <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $nama ?></td>
                        <td><?= $kd ?></td>
                        <td><?= $stok ?></td>
                        <td><?= $harga ?></td>
                        <td>
                          <?php if (($_SESSION['level'] == "admin")) { ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $id ?>">
                              Edit
                            </button>
                            <a href="function_produk.php?hps_produk=<?= $id ?>" type="button" class="btn btn-danger">Hapus</a>
                          <?php } else { ?>
                            <a>Tidak memiliki akses</a>
                          <?php } ?>
                        </td>
                      </tr>
                    </tbody>
                    <!-- Vertically centered Modal -->

                    <div class="modal fade" id="edit<?= $id ?>" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Update Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form class="row g-3" action="function_produk.php" method="post">
                              <input type="hidden" name="id_produk" value="<?= $id ?>">
                              <div class="col-12">
                                <label for="inputNanme4" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" id="inputNanme4" value="<?= $nama ?>">
                              </div>
                              <div class="col-12">
                                <label for="inputEmail4" class="form-label">Kode Produk</label>
                                <input type="text" class="form-control" name="kd_produk" id="inputEmail4" value="<?= $kd ?>">
                              </div>
                              <div class="col-12">
                                <label for="inputPassword4" class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" id="inputPassword4" value="<?= $stok ?>">
                              </div>
                              <div class="col-12">
                                <label for="inputPassword4" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" id="inputPassword4" value="<?= $harga ?>">
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="update_produk">Save changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div><!-- End Vertically centered Modal-->
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php
  require_once('layout/js.php');
  ?>

</body>

</html>