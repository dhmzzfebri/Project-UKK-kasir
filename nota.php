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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir-Toserbada</title>
    <style>
        .print-button {
            display: block;
        }

        /* Tombol cetak disembunyikan saat dicetak */
        @media print {
            .print-button {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        button{
            font-size: 20px;
        }

        a{
            font-size: 20px;
        }
        p {
            font-weight: bold;
        }

        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        h3 {
            margin-top: 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .td1 {
            text-align: right;
        }

        #thx {
            text-align: center;
            font-weight: bold;
            font-family: 'Oswald', sans-serif;
        }
    </style>
</head>
<h1>TOSERBADA</h1>
<h4>Nama Pelanggan: <?= $nama_plg ?></h4>
<p>Tanggal transaksi: <?= $tanggal ?></p>

<body>

    <table>
        <thead>
            <th>Nama produk</th>
            <th>id produk</th>
            <th>harga satuan</th>
            <th>jumlah</th>
            <th>subtotal</th>
        </thead>
        <?php
        $totalharga=0;
        $id_psn = $_GET['id_psn'];
        $tampil = mysqli_query($conn, "SELECT dp.*, pr.*, pj.total_bayar, pj.bayar FROM detail_penjualan dp INNER JOIN produk pr ON dp.id_produk = pr.id_produk INNER JOIN penjualan pj ON dp.kd_penjualan = pj.id_penjualan
        WHERE dp.kd_penjualan = '$id_psn'");
        while ($data = mysqli_fetch_array($tampil)) {
            $id_detail = $data['id_detail'];
            $id_psn = $data['kd_penjualan'];
            $id_produk = $data['id_produk'];
            $jumlah = $data['jumlah'];
            $harga = $data['harga'];
            $nama_produk = $data['nama_produk'];
            $subtotal = $jumlah * $harga;
            $totalharga = $data['total_bayar'];
            $bayar = $data['bayar'];
            $kembalian = $bayar - $totalharga;

        ?>
            <tbody>
                <td><?= $nama_produk ?></td>
                <td><?= $id_produk ?></td>
                <td><?= $harga ?></td>
                <td><?= $jumlah ?></td>
                <td><?= $subtotal ?></td>
            </tbody>
        <?php } ?>
    </table>
    <p>Total Harga: Rp. <?= number_format($totalharga) ?></p>
    <p>Jumlah Bayar: Rp. <?= number_format($bayar, 0, ',', '.') ?></p>
    <p>Kembalian: Rp. <?= number_format($kembalian, 0, ',', '.') ?></p> <br>
    <h3 id="thx">Terima kasih atas pesanannya !</h3><br>
    <button class="print-button" style="width: 100px;" onclick="printPage()">Cetak</button>
    <br>
    <a class="print-button" href="penjualan.php">selesai</a>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>

</html>