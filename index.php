<?php require './inc/functions.php';
    if (!isset($_SESSION['userid'])) redirect_js('login');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 01 Air Upas - Perangkat Ajar Biologi</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/css/iconly/bold.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="assets/js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <h4>SMKN 01 Air Upas</h4>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <?php include 'inc/partials/sidebar.php'; ?>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <?php
                $module = (isset($_GET['m'])) ? $_GET['m'] : false ;

                if($module){
                    $module_file = "module/$module/index.php";
                    if (file_exists($module_file)) {
                        include $module_file;
                    }else{
                        include "inc/partials/page404.php";
                    }
                } else {
                    include "inc/partials/homepage.php";
                }
            ?>

        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>