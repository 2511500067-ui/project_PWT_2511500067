<?php
include "config/koneksi.php"
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Tamu</h1>
            </div>
        </div>
    </div>
</div>

    <?php
    $Id = $_GET['kd'];
    $edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tamu WHERE Id_tamu='$Id'"));

    if(isset($_POST['tambah'])){
        $Id_tamu = $_POST['Id_tamu'];
        $Nama_tamu = $_POST['Nama_tamu'];
        $No_hp = $_POST['No_hp'];
        $Email = $_POST['Email'];

        $insert = mysqli_query($koneksi, "UPDATE tamu SET Nama_tamu='$Nama_tamu', No_hp='$No_hp', Email='$Email' WHERE Id_tamu='$Id_tamu'");
        if ($insert) {
            echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Di Simpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=tamu">';
        } else {
            echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
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
                            <label for="Id_tamu">Id Tamu:</label>
                            <input type="text" name="Id_tamu" value="<?= $edit['Id_tamu']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Nama_tamu">Nama Tamu:</label>
                            <input type="text" name="Nama_tamu" id="Nama_tamu" value="<?= $edit['Nama_tamu']; ?>" placeholder="Masukkan Nama Tamu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="No_hp">Nomor Hp:</label>
                            <input type="text" name="No_hp" id="No_hp" value="<?= $edit['No_hp']; ?>" placeholder="Masukkan Nomor Hp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" name="Email" id="Email" value="<?= $edit['Email']; ?>" placeholder="Masukkan Email" class="form-control">
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="tambah" class="btn btn-primary" value="Simpan">
                            <a href="index.php?page=tamu" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>