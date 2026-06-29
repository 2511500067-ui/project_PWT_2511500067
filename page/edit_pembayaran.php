<?php
include "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Pembayaran</h1>
            </div>
        </div>
    </div>
</div>

<?php

$Id = $_GET['Id'];

$edit = mysqli_fetch_array(mysqli_query($koneksi,
"SELECT * FROM pembayaran WHERE Id_bayar='$Id'"));

if(isset($_POST['tambah'])){

    $Id_reservasi = $_POST['Id_reservasi'];
    $Tanggal_bayar = $_POST['Tanggal_bayar'];
    $Metode_bayar = $_POST['Metode_bayar'];

    // Ambil harga kamar berdasarkan reservasi
    $harga = mysqli_fetch_array(mysqli_query($koneksi,"
        SELECT tipe_kamar.Harga
        FROM reservasi
        JOIN kamar
        ON reservasi.Id_kamar=kamar.Id_kamar
        JOIN tipe_kamar
        ON kamar.Id_tipe=tipe_kamar.Id_tipe
        WHERE reservasi.Id_reservasi='$Id_reservasi'
    "));

    $Total_bayar = $harga['Harga'];

    $update = mysqli_query($koneksi,"
        UPDATE pembayaran
        SET

        Id_reservasi='$Id_reservasi',
        Tanggal_bayar='$Tanggal_bayar',
        Total_bayar='$Total_bayar',
        Metode_bayar='$Metode_bayar'

        WHERE Id_bayar='$Id'
    ");

    if($update){

        echo '<div class="alert alert-info alert-dismissible">

        <button type="button" class="close" data-dismiss="alert">X</button>

        <h5><i class="icon fas fa-info"></i>Info</h5>

        <h4>Berhasil Di Simpan</h4>

        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=pembayaran">';

    }else{

        echo '<div class="alert alert-warning alert-dismissible">

        <button type="button" class="close" data-dismiss="alert">X</button>

        <h5><i class="icon fas fa-info"></i>Info</h5>

        <h4>Gagal Di Simpan</h4>

        </div>';

    }

}

                    ?>

                <section class="content">
                    <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                    <div class="card-body p-2">
                    <form method="POST" action="">
                    <div class="form-group">

                    <label>Id Bayar</label>
                    <input type="text"
                    class="form-control"
                    value="<?= $edit['Id_bayar']; ?>"
                    disabled>

                    </div>
                    <div class="form-group">
                    <label>Id Reservasi</label>
                    <select name="Id_reservasi"
                    class="form-control">
                    <?php
                    $query=mysqli_query($koneksi,"
                    SELECT reservasi.Id_reservasi,
                    tamu.Nama_tamu
                    FROM reservasi
                    JOIN tamu
                    ON reservasi.Id_tamu=tamu.Id_tamu");

                    while($data=mysqli_fetch_array($query)){

                    $selected = ($data['Id_reservasi']==$edit['Id_reservasi']) ? 'selected' : '';

                    ?>

                    <option
                    value="<?= $data['Id_reservasi']; ?>"
                    <?= $selected; ?>>

                    <?= $data['Id_reservasi']; ?> -
                    <?= $data['Nama_tamu']; ?>

                    </option>

                    <?php } ?>

                    </select>

                    </div>

                    <div class="form-group">

                    <label>Tanggal Bayar</label>

                    <input
                    type="date"
                    name="Tanggal_bayar"
                    value="<?= $edit['Tanggal_bayar']; ?>"
                    class="form-control">

                    </div>

                    <div class="form-group">
                    <label>Total Bayar</label>
                    <input
                    type="text"
                    class="form-control"
                    value="<?= "Rp".number_format($edit['Total_bayar'],0,',','.'); ?>"
                    readonly>
                    </div>

                    <div class="form-group">
                    <label>Metode Bayar</label>
                    <select
                    name="Metode_bayar"
                    class="form-control">
                    <option value="Cash"
                    <?= ($edit['Metode_bayar']=="Cash") ? "selected" : ""; ?>>
                    Cash

                    </option>
                    <option value="Transfer"
                    <?= ($edit['Metode_bayar']=="Transfer") ? "selected" : ""; ?>>
                    Transfer

                    </option>
                    <option value="Debit"
                    <?= ($edit['Metode_bayar']=="Debit") ? "selected" : ""; ?>>
                    Debit

                    </option>
                    </select>
                    </div>
                    <div class="card-footer">
                    <input
                    type="submit"
                    name="tambah"
                    class="btn btn-primary"
                    value="Simpan">

                    <a
                    href="index.php?page=pembayaran"
                    class="btn btn-danger">
                    Batal

                    </a>

                    </div>

                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    </section>