<?php
require_once('koneksi.php');

if(isset($_POST['tmbh_plg'])){
    $nama = $_POST['nama_plg'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $query = "INSERT INTO pelanggan (nama_plg,alamat,no_tlp) VALUES ('$nama','$alamat','$no_tlp')";
    if(mysqli_query($conn,$query)){
        echo" <script>
        alert('BERHASIL menambah pelanggan Baru');
        window.location.href='pelanggan.php';
        </script> ";

    }else {
        echo" <script>
        alert('GAGAL menambah pelanggan Baru');
        window.location.href='pelanggan.php';
        </script> ";
    }
}
if(isset($_POST['update_plg'])){
    $id = $_POST['id_plg'];
    $nama = $_POST['nama_plg'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $query = "UPDATE pelanggan SET nama_plg='$nama',alamat='$alamat',no_tlp='$no_tlp' WHERE id_plg='$id' ";
    if(mysqli_query($conn,$query)){
        echo" <script>
        alert('BERHASIL Update pelanggan');
        window.location.href='pelanggan.php';
        </script> ";

    }else {
        echo" <script>
        alert('GAGAL Update pelanggan');
        window.location.href='pelanggan.php';
        </script> ";
    }
}

if(isset($_GET['hps_plg'])){
    $id=$_GET['hps_plg'];
    $query="DELETE FROM pelanggan WHERE id_plg ='$id' ";
    if(mysqli_query($conn,$query)){
        echo" <script>
        alert('BERHASIL meghapus pelanggan ');
        window.location.href='pelanggan.php';
        </script> ";

    }else {
        echo" <script>
        alert('GAGAL menghapus pelanggan');
        window.location.href='pelanggan.php';
        </script> ";
    }
}
?>