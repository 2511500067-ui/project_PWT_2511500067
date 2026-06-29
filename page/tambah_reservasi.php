<?php
include "config/koneksi.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Tambah Data Reservasi </h1>
            </div>
        </div>
    </div>
</div>

<?php
$allSuccess = true; 
//kode otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(Id_reservasi) FROM reservasi") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode && $datakode[0] != null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "R-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "R-001";
}

$_SESSION['KODE'] = $hasilkode;

if (isset($_POST['tambah'])) {

    $Id_reservasi   = $_POST['Id_reservasi'];
    $Id_tamu = $_POST['Id_tamu'];
    $Id_kamar = $_POST['Id_kamar'];
    $Check_in     = $_POST['Check_in'];
    $Check_out = $_POST['Check_out'];
    $Status    = $_POST['Status'];
    
    $insertreservasi = mysqli_query($koneksi, "INSERT INTO reservasi (Id_reservasi, Id_tamu, Id_kamar, Check_in, Check_out, Status)
    VALUES ('$Id_reservasi', '$Id_tamu', '$Id_kamar', '$Check_in','$Check_out', '$Status')");

    if (!$insertreservasi) {
        echo "Gagal insert ke tabel Reservasi: " . mysqli_error($koneksi);
        die;
    }
            mysqli_query($koneksi,"
        UPDATE kamar
        SET Status_kamar='Reserved'
        WHERE Id_kamar='$Id_kamar'
        ");

    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=reservasi">';
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
                        <label>Id Reservasi</label>
                        <input type="text" name="Id_reservasi" value="<?= $hasilkode ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                          <label>Nama Tamu</label>
                        <select name="Id_tamu" class="form-control" required>
                         <option value="">-- Pilih Tamu --</option>
                        <?php
                           $tamu = mysqli_query($koneksi, "SELECT * FROM tamu");
                        while($t = mysqli_fetch_array($tamu)){
                                ?>
                          <option value="<?= $t['Id_tamu']; ?>">
                       <?= $t['Nama_tamu']; ?>
                            </option>
                            <?php } ?>
                         </select>
                        </div>
                        <div class="form-group">
                         <label>Kamar</label>
                        <select name="Id_kamar" class="form-control" required>
                        <option value="">-- Pilih Kamar --</option>
                           <?php
                          $kamar = mysqli_query($koneksi,"
                            SELECT *
                            FROM kamar
                            WHERE Status_kamar='Cleaning'
                            ");
                         while($k = mysqli_fetch_array($kamar)){
                         ?>
                       <option value="<?= $k['Id_kamar']; ?>">
                       <?= $k['Id_kamar']; ?>
                       </option>
                       <?php } ?>
                   </select>
                    </div>
                        <div class="form-group">
                            <label>Check In:</label>
                            <input name="Check_in" type="time" class="form-control" placeholder=" Masukan Check In" required>
                        </div>
                    <div class="form-group">
                        <label>Check Out:</label>
                        <input name="Check_out" type="time" class="form-control" placeholder=" Masukan Check Out" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="Status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Checked In">Checked In</option>
                            <option value="Checked Out">Checked Out</option>
                            <option value="Cancelled">Cancelled</option>
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