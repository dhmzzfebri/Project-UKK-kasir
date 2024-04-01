<?php
require_once('koneksi.php');


if (isset($_POST['tambah_pesanan'])) {
    $id_plg = $_POST['id_plg'];
    $query = "INSERT INTO penjualan (id_plg) VALUES ('$id_plg') ";
    if (mysqli_query($conn, $query)) {
        $id_pesanan = mysqli_insert_id($conn);
        echo " <script>
            alert('berhasil menambahkan pesanan');
            window.location.href='detail_penjualan.php?id_psn=$id_pesanan';
        </script> ";
    } else {
        echo "gagal menambah pesanan";
    };
}
if (isset($_GET['batal_psn'])) {
    $id = $_GET['batal_psn'];
    $query_detail = mysqli_query($conn, "SELECT * FROM detail_penjualan WHERE id_detail='$id' ");
    $data_detail = mysqli_fetch_array($query_detail);
    $id_produk = $data_detail['id_produk'];
    $jumlah = $data_detail['jumlah'];
    $id_psn = $data_detail['kd_penjualan'];

    $query_hitung_stok = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
    $data_stok = mysqli_fetch_array($query_hitung_stok);
    $stok_sekarang = $data_stok['stok'];
    $update_stok = $stok_sekarang + $jumlah;
    $update = mysqli_query($conn, "UPDATE produk SET stok='$update_stok' WHERE id_produk ='$id_produk' ");

    $query = "DELETE FROM detail_penjualan WHERE id_detail='$id'";
    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('berhasil menghapus produk pesanan');
        window.location.href='detail_penjualan.php?id_psn=$id_psn ';
    </script> ";
    } else {
        echo " <script>
        alert('Gagal menghapus');
        window.location.href='detail_penjualan.php?id_psn=$id_psn ';
    </script> ";
    }
}

if (isset($_POST['tmbh_prdk_pesanan'])) {
    $id_produk = $_POST['id_produk'];
    $id_psn = $_POST['id_psn'];
    $jumlah = $_POST['jumlah'];

    $query_hitung_stok = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
    $data_stok = mysqli_fetch_array($query_hitung_stok);
    $stok_sekarang = $data_stok['stok'];
    $harga = $data_stok['harga'];

    if ($stok_sekarang >= $jumlah) {
        $sisa_stok = $stok_sekarang - $jumlah;
        $subtotal = $jumlah * $harga;
        $insert_detail = "INSERT INTO detail_penjualan (kd_penjualan,id_produk,jumlah,sub_total)  VALUES ('$id_psn','$id_produk','$jumlah',$subtotal)";
        $update_stok = "UPDATE produk SET stok='$sisa_stok' WHERE id_produk='$id_produk' ";
        $insert_result = mysqli_query($conn, $insert_detail);
        $update_result = mysqli_query($conn, $update_stok);
        if ($insert_result && $update_result) {
            echo " <script>
            alert('Barang pesanan BERHASIL di tambahkan');
            window.location.href='detail_penjualan.php?id_psn=$id_psn ';
            </script> ";
        } else {
            echo " <script>
            alert('Barang pesanan GAGAL di tambahkan');
            window.location.href='detail_penjualan.php?id_psn=$id_psn ';
            </script> ";
        };
    } else {
        echo " <script>
        alert('Stok produk tidak Memncukupi');
        window.location.href='detail_penjualan.php?id_psn=$id_psn ';
        </script> ";
    }
}

if (isset($_POST['hitung_bayar'])) {
    $id_psn = $_POST['id_psn'];
    $bayar = $_POST['bayar'];
    $totalharga = $_POST['totalharga'];
    $query = mysqli_query($conn, "SELECT SUM(sub_total) AS total_subtotal FROM detail_penjualan WHERE kd_penjualan='$id_psn'");
    $data = mysqli_fetch_assoc($query);
    $total_subtotal = $data['total_subtotal'];
    $kembalian = $bayar - $total_subtotal;
    if ($bayar < $total_subtotal) {
        echo "<script> alert('Uang Kurang! Tolong masukan uang yang pas'); </script>";
        echo "<script> window.location.href = 'detail_penjualan.php?id_psn=$id_psn'; </script>";
    } else {
        $update_stok = "UPDATE penjualan SET total_bayar='$totalharga', bayar='$bayar' WHERE id_penjualan='$id_psn'";
        $update_result = mysqli_query($conn, $update_stok);
        echo "<script> alert('Pembayaran berhasil!'); </script>";
        echo "<script> window.location.href = 'nota.php?id_psn=$id_psn'; </script>";
    }
}
