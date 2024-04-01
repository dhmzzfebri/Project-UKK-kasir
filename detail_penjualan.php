<?php
require_once('koneksi.php');
if (isset($_GET['id_psn'])) {
  $id_psn = $_GET['id_psn'];
  $tampil = mysqli_query($conn, "SELECT * FROM penjualan p, pelanggan plgn WHERE p.id_plg=plgn.id_plg AND p.id_penjualan='$id_psn'");
  if (mysqli_num_rows($tampil) > 0) {
    $data = mysqli_fetch_array($tampil);
    $nama_plg = $data['nama_plg'];
    $tanggal = $data['tanggal'];
  } else {
    $nama_plg = "";
    $tanggal = $data['tanggal'];
  }
} else {
  header("location: penjualan.php");
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
      <h1>TRANSAKSI</h1>
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
              <div class="card-body">
                <h5 class="card-title">Data Pesanan</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tmbh">
                  Tambah Produk
                </button>
                <div class="modal fade" id="tmbh" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Pilih Produk:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <?php
                        ?>
                        <form class="row g-3" action="function_transaksi.php" method="post">
                          <input type="hidden" name="id_produk" value="<?= $id ?>">
                          <div class="col-12">
                            <label for="validationDefault04" class="form-label">Nama Produk</label>
                            <select class="form-select" name="id_produk" id="validationDefault04" required>
                              <?php
                              $tampil = mysqli_query($conn, "SELECT * FROM produk ");
                              while ($data = mysqli_fetch_array($tampil)) {
                                $id = $data['id_produk'];
                                $nama = $data['nama_produk'];
                                $stok = $data['stok'];
                              ?>
                                <option value="<?= $id ?>"><?= $nama ?> [<?= $stok ?>]</option>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-12">
                            <label for="inputPassword4" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="inputPassword4">
                            <input type="hidden" value="<?= $id_psn ?>" name="id_psn">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="tmbh_prdk_pesanan">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div><!-- End Vertically centered Modal-->
                <div class="text-end">
                  <a>Nama Pelanggan: <?= $nama_plg ?></a>
                  <br>
                  <a>Tanggal: <?= $tanggal ?></a>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Kode produk</th>
                      <th scope="col">Name produk</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Sub Total</th>
                    </tr>
                  </thead>
                  <?php
                  $no = 1;
                  $totalharga = 0;
                  $tampil = mysqli_query($conn, "SELECT dp.*, pr.*, pj.total_bayar, pj.bayar FROM detail_penjualan dp INNER JOIN produk pr ON dp.id_produk = pr.id_produk INNER JOIN penjualan pj ON dp.kd_penjualan = pj.id_penjualan
                  WHERE dp.kd_penjualan = '$id_psn'");
                  while ($data = mysqli_fetch_array($tampil)) {
                    $id_detail = $data['id_detail'];
                    $id_psn = $data['kd_penjualan'];
                    $kd_produk = $data['kd_produk'];
                    $jumlah = $data['jumlah'];
                    $harga = $data['harga'];
                    $nama_produk = $data['nama_produk'];
                    $subtotal = $jumlah * $harga;
                    $totalharga += $subtotal;
                    // $totalharga = $data['total_harga'];
                  ?>
                    <tbody>
                      <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $kd_produk ?></td>
                        <td><?= $nama_produk ?></td>
                        <td><?= $jumlah ?></td>
                        <td><?= $harga ?></td>
                        <td><?= $subtotal ?></td>
                        <td>
                          <a href="function_transaksi.php?batal_psn=<?= $id_detail ?>" type="button" class="btn btn-warning">batal</a>
                        </td>
                      </tr>
                    </tbody>

                  <?php } ?>
                </table>
                <form class="row g-3" action="function_transaksi.php" method="post">
                  <input type="hidden" name="id_psn" value="<?= $id_psn ?>">
                  <div class="col-3">
                    <label for="inputNanme4" class="form-label">Total_harga</label>
                    <input type="text" class="form-control" id="inputNanme4" name="totalharga" value="<?= $totalharga ?>">
                  </div>
                  <div class="col-3">
                    <label for="inputEmail4" class="form-label">Bayar</label>
                    <input type="text" class="form-control" name="bayar" id="inputEmail4" value="0" ">
                  </div>
                  <div class=" modal-footer">
                    <button type="submit" class="btn btn-primary" name="hitung_bayar">Bayar</button>
                  </div>
                </form>
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