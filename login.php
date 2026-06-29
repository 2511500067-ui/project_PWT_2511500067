<?php
ob_start();
session_start();
require_once("config/koneksi.php");

if (isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index2.html"><b>Reservasi </b>HOTEL</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="Username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="Password" name="Password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="Submit" name="Login" value="Login" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                        <div>
                </form>
                <div>
                    <!-- /.login-card-body -->
                </div>
            </div>
            <!-- /.login-box -->

            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
<?php
$Username = $_POST['Username'] ?? '';
$Password = $_POST['Password'] ?? '';

if (isset($_POST['Login'])) {

    $query = mysqli_query($koneksi,
        "SELECT * FROM users WHERE Username='$Username'");

    $userquary = mysqli_fetch_array($query);

    if ($userquary) {

        if ($Password == $userquary['Password']) {

            $_SESSION['Username'] = $userquary['Username'];

            header("Location: index.php");
            exit;

        } else {
            echo "<script>alert('Password salah');</script>";
        }

    } else {
        echo "<script>alert('Username tidak ditemukan');</script>";
    }
}
?>