<?php
include "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pembayaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {

        $Id = $_GET['Id'];

        $query = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE Id_bayar='$Id'");

        if ($query) {

            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus
            </div>';

            echo '<meta http-equiv="refresh" content="1;url=index.php?page=pembayaran">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-body">

                <a href="index.php?page=tambah_pembayaran" class="btn btn-primary btn-sm">
                    Tambah Pembayaran
                </a>

                <table class="table table-striped">

                    <thead>

                        <tr style="text-align:center;">

                            <th>No</th>
                            <th>Id Bayar</th>
                            <th>Id Reservasi</th>
                            <th>Nama Tamu</th>
                            <th>No Kamar</th>
                            <th>Tanggal Bayar</th>
                            <th>Metode Bayar</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <?php

                    $no = 0;

                    $query = mysqli_query($koneksi, "

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

                    ");

                    while($result=mysqli_fetch_array($query)){

                    $no++;

                    ?>

                    <tbody>

                        <tr style="text-align:center;">

                            <td><?= $no; ?></td>

                            <td><?= $result['Id_bayar']; ?></td>

                            <td><?= $result['Id_reservasi']; ?></td>

                            <td><?= $result['Nama_tamu']; ?></td>

                            <td><?= $result['Nomor_kamar']; ?></td>

                            <td><?= $result['Tanggal_bayar']; ?></td>

                            <td><?= $result['Metode_bayar']; ?></td>

                            <td>

                                <?= "Rp" . number_format($result['Total_bayar'],0,',','.'); ?>

                            </td>

                            <td>

                                <a href="index.php?page=pembayaran&action=hapus&Id=<?= $result['Id_bayar']; ?>">

                                    <span class="badge badge-danger">

                                        Hapus

                                    </span>

                                </a>

                                <a href="index.php?page=edit_pembayaran&Id=<?= $result['Id_bayar']; ?>">

                                    <span class="badge badge-warning">

                                        Edit

                                    </span>

                                </a>

                            </td>

                        </tr>

                    </tbody>

                    <?php } ?>

                </table>

            </div>

        </div>

    </div>

</div>