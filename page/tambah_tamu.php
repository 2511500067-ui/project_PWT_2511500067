<?php
include "config/koneksi.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Data Tambah Tamu </h1>
            </div>
        </div>
    </div>
</div>

<?php
$allSuccess = true; 
//kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(Id_tamu) FROM tamu") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode && $datakode[0] != null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "T-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "T-001";
}

$_SESSION['KODE'] = $hasilkode;


if (isset($_POST['tambah'])) {

    $Id_tamu   = $_POST['Id_tamu'];
    $Nama_tamu     = $_POST['Nama_tamu'];
    $No_hp  = $_POST['No_hp'];
    $Email    = $_POST['Email'];

    $inserttamu = mysqli_query($koneksi, "INSERT INTO tamu (Id_tamu, Nama_tamu, No_hp, Email) VALUES ('$Id_tamu', '$Nama_tamu',
    '$No_hp', '$Email')");

    if (!$inserttamu) {
        echo "Gagal insert ke tabel Tamu: " . mysqli_error($koneksi);
        die;
    }
    
    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=tamu">';
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
                        <label>Id Tamu</label>
                        <input type="text" name="Id_tamu" value="<?= $hasilkode ?>" class="form-control" readonly>
                    </div>
                        <div class="form-group">
                            <label>Nama Tamu:</label>
                            <input name="Nama_tamu" class="form-control" placeholder=" MasukanNama Tamu" required>
                        </div>
                    <div class="form-group">
                        <label>Nomor Hp</label>
                        <input name="No_hp" class="form-control" placeholder="Masukan Nomor Hp" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="Email" class="form-control" placeholder="Masukan Email" required>
                    </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                </form>

            </div>
        </div>
    </div>
</div>