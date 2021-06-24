<?php require './inc/functions.php';
    if (isset($_SESSION['userid'])) redirect_js('index');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perangkat Ajar SMKN 01 Air Upas</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
<!-- Perancangan perangkat ajar mata pelajaran biologi tentang ekosistem kelas X pada SMKN 01 Air Upas Berbasis Web -->
    <div class="pt-5" style="background-color: #2d499d; min-height: 100vh;">
        <div class="row" style="--bs-gutter-x: 0;">
            <div class="col-10 col-sm-8 col-md-5 col-lg-3 mx-auto">
                <div class="card border mt-5">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h3>Login</h3>
                            <p>Perangkat Ajar Mata Pelajaran Biologi Tentang Ekosistem Kelas X SMKN 01 Air Upas</p>
                        </div>

                        <div class="alert-container" style="width: 99%; margin: auto;"></div>

                        <form id="login-form" method="POST">
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" class="form-control" placeholder="Username" id="username" name="username" autocomplete="off" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="password" class="form-control" placeholder="Password "id="password" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" id="btn-login" class="btn btn-primary btn-block shadow-sm mt-3">Log in</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>