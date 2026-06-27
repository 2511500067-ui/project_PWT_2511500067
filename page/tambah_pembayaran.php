<?php
include "config/koneksi.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Tambah Data Pembayaran</h1>
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
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "P-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "P-001";
}

$_SESSION['KODE'] = $hasilkode;

if (isset($_POST['tambah'])) {

    $Id_bayar = $_POST['Id_bayar'];
    $Id_reservasi = $_POST['Id_reservasi'];
    $Total_bayar = $_POST['Total_bayar'];
    $Metode_bayar = $_POST['Metode_bayar'];

    $insertpembayaran = mysqli_query($koneksi, "INSERT INTO pembayaran (Id_bayar, Id_reservasi, Total_bayar, Metode_bayar)
    VALUES ('$Id_bayar', '$Id_reservasi', '$Total_bayar', '$Metode_bayar')");

    if (!$insertpembayaran) {
        echo "Gagal insert ke tabel Pembayaran: " . mysqli_error($koneksi);
        die;
    }

    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=pembayaran">';
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
                        <label>Id Pembayaran</label>
                        <input type="text" name="Id_bayar" value="<?= $hasilkode ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Id Reservasi</label>
                        <select name="Id_reservasi" id="Id_reservasi" class="form-control" required>
                            <option value="">Pilih Id Reservasi</option>
                            <?php $reservasiQuery = mysqli_query($koneksi, "SELECT * FROM reservasi");
                            while ($reservasi = mysqli_fetch_array($reservasiQuery)) {
                                $totalBayar = 0;
                                $reservasiId = $reservasi['Id_reservasi']; // Ambil data reservasi terkait untuk menghitung total bayar 

                                $detailReservasiQuery = mysqli_query($koneksi, "SELECT * FROM reservasi WHERE Id_reservasi='$reservasiId'");
                                while ($detailReservasi = mysqli_fetch_array($detailReservasiQuery)) {
                                    $totalBayar += $detailReservasi['Total_bayar'];
                                }
                                echo "<option value='" . $reservasi['Id_reservasi'] .
                                    "' data-total='" . $totalBayar . "'>" . $reservasi['Id_reservasi'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="form-group">
                            <label>Total Bayar</label>
                            <input type="number" name="Total_bayar" id="Total_bayar" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Metode Bayar</label>
                            <select name="Metode_bayar" class="form-control" required>
                                <option value="">Pilih Metode Bayar</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                </form>
                <script>
                    document.getElementById('Id_reservasi').addEventListener('change', function() {
                        var total = this.options[this.selectedIndex].getAttribute('data-total');
                        document.getElementById('Total_bayar').value = total || '';
                    });
                </script>
            </div>
        </div>
    </div>
</div>