<?php
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
    header('login.php');
}

function getTanggalHariIni($format = 'Y-m-d')
{
    return date($format);
}

$tanggal_hari_ini = getTanggalHariIni();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan stok</title>
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

        button {
            font-size: 20px;
            margin-top: 30px;
            width: 100px;
            background-color: blue;
            color: #f2f2f2;

        }

        a {
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
<h1>Data laporan stok produk</h1>
<p>Nama Petugas: <?= $_SESSION['nama'] ?></p>
<p>Role: <?= $_SESSION['level'] ?></p>
<p>Tanggal: <?= $tanggal_hari_ini ?></p>

<body>

    <table>
        <thead>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga </th>
            <th>Stok</th>
        </thead>
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM produk");
        while ($data = mysqli_fetch_array($tampil)) {
            $kd_produk = $data['kd_produk'];
            $stok = $data['stok'];
            $harga = $data['harga'];
            $nama_produk = $data['nama_produk'];

        ?>
            <tbody>
                <td><?= $kd_produk ?></td>
                <td><?= $nama_produk ?></td>
                <td><?= $harga ?></td>
                <td><?= $stok ?></td>
            </tbody>
        <?php } ?>
    </table>
    <button class="print-button" onclick="printPage()">Cetak</button>
    <br>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>

</html>