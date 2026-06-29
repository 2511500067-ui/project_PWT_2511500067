<?php
include "config/koneksi.php"
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Reservasi</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $Id = $_GET['Id'];
        $query = mysqli_query($koneksi, "DELETE FROM reservasi WHERE Id_reservasi='$Id'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=reservasi">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_reservasi" class="btn btn-primary btn-sm">Tambah Reservasi</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Id Reservasi</th>
                            <th style="text-align: center;">Id Tamu</th>
                            <th style="text-align: center;">Check-in</th>
                            <th style="text-align: center;">Check-out</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM reservasi");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr style="text-align: center;">
                                <td><?= $no; ?></td>
                                <td><?= $result['Id_reservasi']; ?></td>
                                <td><?= $result['Id_tamu']; ?></td>
                                <td><?= $result['Check_in']; ?></td>
                                <td><?= $result['Check_out']; ?></td>
                                <td><?= $result['Status']; ?></td>
                                <td>
                                    <a href="index.php?page=reservasi&action=hapus&Id=<?= $result['Id_reservasi']; ?>" title ="">
                                            <span class=" badge badge-danger">Hapus</span></a>
                                    <a href="index.php?page=edit_reservasi&Id=<?= $result['Id_reservasi']; ?>" title="">
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