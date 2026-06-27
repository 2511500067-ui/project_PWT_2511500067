<?php
include "config/koneksi.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Data Tambah kamar </h1>
            </div>
        </div>
    </div>
</div>

<?php
$allSuccess = true; 
//kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(Id_kamar) FROM kamar") or die(mysqli_error($koneksi));
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

    $Id_kamar       = $_POST['Id_kamar'];
    $Nomor_kamar    = $_POST['Nomor_kamar'];
    $Id_tipe        = $_POST['Id_tipe'];
    $Status_kamar   = $_POST['Status_kamar'];

    $insertkamar    = mysqli_query($koneksi, "INSERT INTO kamar (Id_kamar, Nomor_kamar, Id_tipe, Status_kamar) 
    VALUES ('$Id_kamar', '$Nomor_kamar', '$Id_tipe', '$Status_kamar')");

    if (!$insertkamar) {
        echo "Gagal insert ke tabel Kamar: " . mysqli_error($koneksi);
        die;
    }
    
    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kamar">';
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
                        <label>Id Kamar</label>
                        <input type="text" name="Id_kamar" value="<?= $hasilkode ?>" class="form-control" readonly>
                    </div>
                        <div class="form-group">
                            <label>Nomor Kamar:</label>
                            <select name="Nomor_kamar" class="form-control"  required>
                                <option value="">Pilih Nomor Kamar</option>
                                <option value="101">101</option>
                                <option value="102">102</option>
                                <option value="103">103</option>
                                <!-- Tambahkan opsi nomor kamar lainnya sesuai kebutuhan -->
                            </select> 
                        </div>
                    <div class="form-group">
                        <label>Id Tipe</label>
                        <select name="Id_tipe" class="form-control" required>
                            <option value="">Pilih Id Tipe</option>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM tipe_kamar");
                            while ($data = mysqli_fetch_array($query)) {
                                echo "<option value='" . $data['Id_tipe'] . "'>" . $data['Nama_tipe'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Kamar</label>
                        <select name="Status_kamar" class="form-control" required>
                            <option value="">Pilih Status Kamar</option>
                            <option value="Available">Available</option>
                            <option value="Occupied">Occupied</option>
                            <option value="Reserved">Reserved</option>
                            <option value="Cleaning">Cleaning</option> 
                            <option value="Maintenance">Maintenance</option>
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