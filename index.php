<?php
ob_start();
session_start();

include_once("db/koneksi.php");
include_once("function/helper.php");

$page = isset($_GET['page']) ? $_GET['page'] : false;
$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
$name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : false;
$role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : false;

if ($user_id) {
    $module = isset($_GET['module']) ? $_GET['module'] : false;
    $action = isset($_GET['action']) ? $_GET['action'] : false;
    $mode = isset($_GET['mode']) ? $_GET['mode'] : false;
}

// echo $role;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Matching | Dashboard</title>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL . "asset/logo.png" ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="asset/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="asset/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="asset/plugins/summernote/summernote-bs4.min.css">

    <!-- DataTables -->
    <link href="asset/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="asset/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
</head>

<body>
    <div class=" wrapper">

        <?php
        // Navbar
        include('body/header.php');

        // Main Sidebar Container
        include('body/sidebar.php');
        ?>

        <div class="content-wrapper" style="min-height: 1302.12px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div id="profile-content">
                    <?php
                    $file = "module/$module/$action.php";
                    if (file_exists($file)) {
                        include_once($file);
                    } else {
                        echo "<h3>Maaf, halaman tersebut tidak ditemukan</h3>";
                    }
                    ?>
                </div>
            </section>
        </div>

        <?=
        // FOOTER
        include('body/footer.php');
        ?>
    </div>


    <!-- jQuery -->
    <script src="asset/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="asset/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="asset/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="asset/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="asset/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="asset/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="asset/plugins/moment/moment.min.js"></script>
    <script src="asset/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="asset/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="asset/dist/js/adminlte.js"></script>

    <!-- Required datatable js -->
    <script src="asset/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="asset/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="asset/datatables.init.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
</body>

</html>