            <?php
            include "config/koneksi.php";



            $tamu = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tamu"));
            $kamar = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kamar"));
            $reservasi = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM reservasi"));
            $pembayaran = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM pembayaran"));
            ?>

            <div class="content">
            <div class="container-fluid">
                <div class="card mt-3">
                <div class="card-body">
                    <h4>Selamat Datang</h4>
                    <p>
                    </p>
                </div>
            </div>

            <div class="row">

            <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
            <div class="inner">
            <h3><?= $tamu; ?></h3>
            <p>Data Tamu</p>
            </div>
            <div class="icon">
            <i class="fas fa-users"></i>
            </div>
            </div>
            </div>

            <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
            <div class="inner">
            <h3><?= $kamar; ?></h3>
            <p>Data Kamar</p>
            </div>
            <div class="icon">
            <i class="fas fa-bed"></i>
            </div>
            </div>
            </div>

            <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
            <div class="inner">
            <h3><?= $reservasi; ?></h3>
            <p>Reservasi</p>
            </div>
            <div class="icon">
            <i class="fas fa-book"></i>
            </div>
            </div>
            </div>

            <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
            <div class="inner">
            <h3><?= $pembayaran; ?></h3>
            <p>Pembayaran</p>
            </div>
            <div class="icon">
            <i class="fas fa-money-bill"></i>
            </div>
            </div>
            </div>

            </div>

            </div>
            </div>