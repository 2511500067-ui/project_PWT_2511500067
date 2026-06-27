<?php
include "config/koneksi.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Tambah Data Tipe Kamar </h1>
            </div>
        </div>
    </div>
</div>

<?php
$allSuccess = true;
//kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(Id_tipe) FROM tipe_kamar") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode && $datakode[0] != null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "K-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "K-001";
}

$_SESSION['KODE'] = $hasilkode;

if (isset($_POST['tambah'])) {

    $Id_tipe   = $_POST['Id_tipe'];
    $Nama_tipe = $_POST['Nama_tipe'];
    $Harga    = $_POST['Harga'];
    $Kapasitas = $_POST['Kapasitas'];

    $inserttipekamar = mysqli_query($koneksi, "INSERT INTO tipe_kamar (Id_tipe, Nama_tipe, Harga, Kapasitas)
    VALUES ('$Id_tipe', '$Nama_tipe', '$Harga', '$Kapasitas')");

    if (!$inserttipekamar) {
        echo "Gagal insert ke tabel Tipe Kamar: " . mysqli_error($koneksi);
        die;
    }

    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=tipe_kamar">';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal menyimpan sebagian atau seluruh data detail.</h4>
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
                        <label>Id Tipe Kamar</label>
                        <input type="text" name="Id_tipe" value="<?= $hasilkode ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Tipe Kamar</label>
                        <select  name="Nama_tipe" class="form-control" required>
                            <option value="">Pilih Tipe Kamar</option>
                            <option value="Single">Single</option>
                            <option value="Double">Double</option>
                            <option value="Triple">Triple</option>
                            <option value="Family">Family</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <select name="Harga" class="form-control" required>
                            <option value="">Pilih Harga</option>
                            <option value="100000">S 100.000</option>
                            <option value="200000">D 200.000</option>
                            <option value="300000">T 300.000</option>
                            <option value="400000">F 400.000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kapasitas</label>
                        <select name="Kapasitas" class="form-control" required>
                            <option value="">Pilih Kapasitas</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">8</option>
                        </select>
                    </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
        </form>

    </div>
</div>
</div>
</div>