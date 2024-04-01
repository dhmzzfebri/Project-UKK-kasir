<?php
require_once('koneksi.php');
if(!isset($_SESSION['username'])){
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
              <h5 class="card-title"> Form Pelanggan</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="function_pelanggan.php" method="post">
                <div class="col-12">
                  <label for="yourPassword" class="form-label">Nama Pelanggan</label>
                  <input type="text" name="nama_plg" class="form-control" id="yourPassword" required>
                  
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Alamat</label>
                  <input type="text" class="form-control" name="alamat" id="inputEmail4">
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">No Telpon</label>
                  <input type="number" class="form-control" name="no_tlp" id="inputPassword4" require>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-primary" name="tmbh_plg">Submit</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

        </div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <div class="card-body">
              <h5 class="card-title">Data Pelanggan</h5>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name Pelanggan</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">No telpon</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <?php
                  $no=1;
                  $tampil = mysqli_query($conn,"SELECT * FROM pelanggan");
                  while ($data = mysqli_fetch_array($tampil)){
                    $id = $data['id_plg'];
                    $nama = $data['nama_plg'];
                    $alamat = $data['alamat'];
                    $no_tlp = $data['no_tlp'];
                  ?>
                  <tbody>
                    <tr>
                      <th scope="row"><?=$no++?></th>
                      <td><?=$nama?></td>
                      <td><?=$alamat?></td>
                      <td><?=$no_tlp?></td>
                      <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?=$id?>">
                          Edit
                        </button>
                        <a href="function_pelanggan.php?hps_plg=<?=$id?>" type="button" class="btn btn-danger">Hapus</a>
                      </td>
                    </tr>
                  </tbody>
                  <!-- Vertically centered Modal -->
                  
                  <div class="modal fade" id="edit<?=$id?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Update Pelanggan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form class="row g-3" action="function_pelanggan.php" method="post">
                          <input type="hidden" name="id_plg" value="<?=$id?>">
                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_plg" id="inputNanme4"  value="<?=$nama?>">
                          </div>
                          <div class="col-12">
                            <label for="inputEmail4" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="inputEmail4"  value="<?=$alamat?>">
                          </div>
                          <div class="col-12">
                            <label for="inputPassword4" class="form-label">No Telpon</label>
                            <input type="number" class="form-control" name="no_tlp" id="inputPassword4"  value="<?=$no_tlp?>">
                          </div>
                          <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="update_plg">Save changes</button>
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