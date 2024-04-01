<?php
require_once('koneksi.php');
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE username='$username'";
    $hasil = mysqli_query($conn, $query);

    if (mysqli_num_rows($hasil) > 0) {
        $data = mysqli_fetch_assoc($hasil);
        $hash = $data['password'];
        if (password_verify($password, $hash)) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $data['level'];
            header('location:index.php');
        } else {
            echo "<script>alert('password salah');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username dan password salah');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
}


if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $user = $_POST['username'];
    $password = $_POST['password'];
    $pass_encrp = password_hash($password, PASSWORD_DEFAULT);
    $level = $_POST['level'];
    $cek_user = "SELECT * FROM user WHERE username = '$user'";
    $hasil = mysqli_query($conn, $cek_user);
    if (mysqli_num_rows($hasil) > 0) {
        echo "<script>alert('Username sudah terDAFTAR');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        $query = "INSERT INTO user (username,password,nama,level) VALUES ('$user','$pass_encrp','$nama','$level')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('BERHASIL menambah Petugas Baru');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('GAGAL menambah Petugas Baru');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }
}



if (isset($_POST['update_user'])) {
    $id = $_POST['id_user'];
    $nama = $_POST['nama'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $pass_encrp = password_hash($pass, PASSWORD_DEFAULT);
    $level = $_POST['level'];
    $query = "UPDATE user SET nama='$nama',username='$user',password='$pass_encrp',level='$level' WHERE id_user='$id' ";
    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('BERHASIL Update Petugas');
        window.location.href='user.php';
        </script> ";
    } else {
        echo " <script>
        alert('GAGAL Update Petugas');
        window.location.href='user.php';
        </script> ";
    }
}

if (isset($_GET['hps_user'])) {
    $id = $_GET['hps_user'];
    $query = "DELETE FROM user WHERE id_user ='$id' ";
    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('BERHASIL meghapus Petugas ');
        window.location.href='user.php';
        </script> ";
    } else {
        echo " <script>
        alert('GAGAL menghapus Petugas');
        window.location.href='user.php';
        </script> ";
    }
}
