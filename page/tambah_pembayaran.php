<?php
include "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Pembayaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
$allSuccess = true;

//kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(Id_bayar) FROM pembayaran") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] != null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int)$nilaikode;
    $kode = $kode + 1;
    $hasilkode = "P-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "P-001";
}

$_SESSION['KODE'] = $hasilkode;

if(isset($_POST['tambah'])){

    $Id_bayar = $_POST['Id_bayar'];
    $Id_reservasi = $_POST['Id_reservasi'];
    $Tanggal_bayar = $_POST['Tanggal_bayar'];
    $Metode_bayar = $_POST['Metode_bayar'];

        // Cek apakah reservasi sudah pernah dibayar
    $cek = mysqli_query($koneksi,"
    SELECT *
    FROM pembayaran
    WHERE Id_reservasi='$Id_reservasi'
    ");

    if(mysqli_num_rows($cek)>0){

        echo '
        <div class="alert alert-warning">
            Reservasi sudah dibayar.
        </div>';

        $allSuccess = false;
    }
        if($allSuccess){
    //Ambil harga kamar berdasarkan reservasi
    $harga = mysqli_fetch_array(mysqli_query($koneksi,"
        SELECT tipe_kamar.Harga
        FROM reservasi
        JOIN kamar ON reservasi.Id_kamar = kamar.Id_kamar
        JOIN tipe_kamar ON kamar.Id_tipe = tipe_kamar.Id_tipe
        WHERE reservasi.Id_reservasi='$Id_reservasi'
    "));

    $Total_bayar = $harga['Harga'];

    $insert = mysqli_query($koneksi,"
        INSERT INTO pembayaran
        (
            Id_bayar,
            Id_reservasi,
            Tanggal_bayar,
            Total_bayar,
            Metode_bayar
        )
        VALUES
        (
            '$Id_bayar',
            '$Id_reservasi',
            '$Tanggal_bayar',
            '$Total_bayar',
            '$Metode_bayar'
        )
    ");

    if($insert){
     } echo '
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Disimpan</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=pembayaran">';
    }else{

    

        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Gagal Disimpan</h4>
            '.mysqli_error($koneksi).'
        </div>';

    }

}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST" action="">

<div class="form-group">
<label>Id Bayar</label>
<input type="text" name="Id_bayar" value="<?= $hasilkode ?>" class="form-control" readonly>
</div>

<div class="form-group">
<label>Id Reservasi</label>
<select name="Id_reservasi" class="form-control" required>

<option value="">Pilih Reservasi</option>

<?php

$reservasi = mysqli_query($koneksi,"
SELECT
reservasi.Id_reservasi,
tamu.Nama_tamu
FROM reservasi
JOIN tamu
ON reservasi.Id_tamu=tamu.Id_tamu
WHERE reservasi.Id_reservasi NOT IN
(
SELECT Id_reservasi
FROM pembayaran
)
");
while($r=mysqli_fetch_array($reservasi)){

?>

<option value="<?= $r['Id_reservasi']; ?>">

<?= $r['Id_reservasi']; ?> - <?= $r['Nama_tamu']; ?>

</option>

<?php } ?>

</select>
</div>

<div class="form-group">
<label>Tanggal Bayar</label>
<<input
type="date"name="Tanggal_bayar"class="form-control"value="<?= date('Y-m-d'); ?>"required>
</div>

<div class="form-group">
<label>Metode Bayar</label>

<select name="Metode_bayar" class="form-control" required>

<option value="">Pilih Metode Bayar</option>
<option value="Cash">Cash</option>
<option value="Transfer">Transfer</option>
<option value="Debit">Debit</option>

</select>

</div>

<div class="card-footer">

<input type="submit"
class="btn btn-primary"
name="tambah"
value="Simpan">

<a href="index.php?page=pembayaran"
class="btn btn-danger">

Batal

</a>

</div>

</form>

</div>
</div>
</div>
</div>