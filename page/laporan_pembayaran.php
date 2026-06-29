<?php
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembayaran</title>

    <style>

        body{
            font-family: Arial;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:8px;
            text-align:center;
        }

        h2{
            text-align:center;
        }

    </style>

</head>

<body>

<h2>LAPORAN PEMBAYARAN HOTEL</h2>

<table>

<tr>

<th>No</th>
<th>Id Bayar</th>
<th>Nama Tamu</th>
<th>No Kamar</th>
<th>Tanggal Bayar</th>
<th>Metode</th>
<th>Total Bayar</th>

</tr>

<?php

$no=1;

$query=mysqli_query($koneksi,"
SELECT
pembayaran.*,
tamu.Nama_tamu,
kamar.Nomor_kamar
FROM pembayaran
JOIN reservasi
ON pembayaran.Id_reservasi=reservasi.Id_reservasi
JOIN tamu
ON reservasi.Id_tamu=tamu.Id_tamu
JOIN kamar
ON reservasi.Id_kamar=kamar.Id_kamar
ORDER BY pembayaran.Id_bayar ASC
");

while($data=mysqli_fetch_array($query)){

?>

<tr>

<td><?= $no++; ?></td>
<td><?= $data['Id_bayar']; ?></td>
<td><?= $data['Nama_tamu']; ?></td>
<td><?= $data['Nomor_kamar']; ?></td>
<td><?= $data['Tanggal_bayar']; ?></td>
<td><?= $data['Metode_bayar']; ?></td>
<td><?= "Rp ".number_format($data['Total_bayar'],0,',','.'); ?></td>

</tr>

<?php } ?>

</table>

<script>

window.print();

</script>

</body>
</html>