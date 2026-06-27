<?php
include "config/koneksi.php"
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pemabayaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $Id = $_GET['Id'];
        $query = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE Id_pembayaran='$Id'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=pembayaran">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_pembayaran" class="btn btn-primary btn-sm">Tambah Pembayaran</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Id Pembayaran</th>
                            <th style="text-align: center;">Id Reservasi</th>
                            <th style="text-align: center;">Total Bayar</th>
                            <th style="text-align: center;">Metode Pembayaran</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM pembayaran");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr style="text-align: center;">
                                <td><?= $no; ?></td>
                                <td><?= $result['Id_pembayaran']; ?></td>
                                <td><?= $result['Id_reservasi']; ?></td>
                                <td><?= $result['Total_bayar']; ?></td>
                                <td><?= $result['Metode_pembayaran']; ?></td>
                                <td>
                                    <a href="index.php?page=pembayaran&action=hapus&Id=<?= $result['Id_pembayaran']; ?>" title ="">
                                            <span class=" badge badge-danger">Hapus</span></a>
                                    <a href="index.php?page=edit_pembayaran&Id=<?= $result['Id_pembayaran']; ?>" title="">
                                        <span class="badge badge-warning">Edit</span></a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>