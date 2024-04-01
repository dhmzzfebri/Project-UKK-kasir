<?php
require_once('koneksi.php');

if (isset($_POST['tmbh_produk'])) {
    $nama = $_POST['nama_produk'];
    $kd = $_POST['kd_produk'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $cek_produk = "SELECT * FROM produk WHERE kd_produk = '$kd'";
    $hasil = mysqli_query($conn, $cek_produk);
    if (mysqli_num_rows($hasil) > 0) {
        echo " <script>
        alert('Produk Sudah Terdaftar');
        window.location.href='produk.php';
        </script> ";
    } else {
        $query = "INSERT INTO produk (nama_produk,kd_produk,stok,harga) VALUES ('$nama','$kd','$stok','$harga')";
        if (mysqli_query($conn, $query)) {
            echo " <script>
            alert('BERHASIL menambah produk Baru');
            window.location.href='produk.php';
            </script> ";
        } else {
            echo " <script>
            alert('GAGAL menambah produk Baru');
            window.location.href='produk.php';
            </script> ";
        };
    }
}
if (isset($_POST['update_produk'])) {
    $id = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $kd = $_POST['kd_produk'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $query = "UPDATE produk SET nama_produk='$nama',kd_produk='$kd',stok='$stok',harga='$harga' WHERE id_produk='$id' ";
    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('BERHASIL Update produk');
        window.location.href='produk.php';
        </script> ";
    } else {
        echo " <script>
        alert('GAGAL  Update produk');
        window.location.href='produk.php';
        </script> ";
    }
}

if (isset($_GET['hps_produk'])) {
    $id = $_GET['hps_produk'];
    $query = "DELETE FROM produk WHERE id_produk ='$id' ";
    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('BERHASIL meghapus produk ');
        window.location.href='produk.php';
        </script> ";
    } else {
        echo " <script>
        alert('GAGAL menghapus produk');
        window.location.href='produk.php';
        </script> ";
    }
}
