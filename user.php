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
      <h1>PETUGAS</h1>
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
              <h5 class="card-title"> Form Petugas</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="function_login.php" method="post">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="inputEmail4" required>
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="inputPassword4" required>
                </div>
                <div class="col-12">
                  <label for="validationDefault04" class="form-label">Level</label>
                  <select class="form-select" name="level" id="validationDefault04" required>
                    <option selected disabled value="">...</option>
                    <option value="admin">Admin</option>
                    </option>
                    <option value="kasir">Kasir</option>
                    </option>
                  </select>
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-primary" name="register">Submit</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

        </div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="card-body">
                <h5 class="card-title">Data Petugas</h5>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name Petugas</th>
                      <th scope="col">Username</th>
                      <th scope="col">Level</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <?php
                  $no = 1;
                  $tampil = mysqli_query($conn, "SELECT * FROM user");
                  while ($data = mysqli_fetch_array($tampil)) {
                    $id = $data['id_user'];
                    $nama = $data['nama'];
                    $username = $data['username'];
                    $level = $data['level'];
                  ?>
                    <tbody>
                      <tr>
                        <td scope="row"><?= $no++ ?></td>
                        <td><?= $nama ?></td>
                        <td><?= $username ?></td>
                        <td><?= $level ?></td>
                        <td>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $id ?>">
                            Edit
                          </button>
                          <a href="function_login.php?hps_user=<?= $id ?>" type="button" class="btn btn-danger">Hapus</a>
                        </td>
                      </tr>
                    </tbody>
                    <!-- Vertically centered Modal -->
                    <div class="modal fade" id="edit<?= $id ?>" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Update Petugas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form class="row g-3" action="function_login.php" method="post" novalidate>
                              <input type="hidden" name="id_user" value="<?= $id ?>">
                              <div class="col-12">
                                <label for="inputNanme4" class="form-label">Nama Petugas</label>
                                <input type="text" class="form-control" name="nama" id="inputNanme4" value="<?= $nama ?>">
                              </div>
                              <div class="col-12">
                                <label for="inputEmail4" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="inputEmail4" value="<?= $username ?>">
                              </div>
                              <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="yourPassword"  required>
                              </div>
                              <div class="col-12">
                                <label for="validationDefault04" class="form-label">Level</label>
                                <select class="form-select" name="level" id="validationDefault04" required>
                                  <option value="Kasir" <?php if ($level == 'petugas') echo 'selected'; ?>>Kasir</option>
                                  <option value="Admin" <?php if ($level == 'admin') echo 'selected'; ?>>Admin</option>
                                </select>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="update_user">Save changes</button>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Vertically centered Modal-->
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