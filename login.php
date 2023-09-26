<?php
include_once('db/login.php');
include_once('function/helper.php');
session_start();


$login = new login;
$button = isset($_GET['button']) ? $_GET['button'] : "";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Match | Login</title>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL . "asset/logo.png" ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="d-flex justify-content-center align-items-center">
            <img src="<?php echo BASE_URL . "asset/logo.png" ?>" width="400px" alt="Logo">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <form action="<?php echo $_SERVER['REQUEST_URI'] . "?button=login" ?>" method="post">
                    <div class="input-group mb-3">
                        <input required type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            </div>
                        </div>
                    </div>
                    <button type="submit" value="login" class="btn btn-primary btn-block">Sign In</button>
                </form>
                <!-- <a href="<?php echo BASE_URL . "login.php?button=forgot_password" ?>" class="btn btn-danger btn-block">Forgot Password</a> -->
                <button onclick="modalForgot()" class="btn btn-danger btn-block">Forgot Password</button>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="asset/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <!-- <script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="asset/dist/js/adminlte.min.js"></script>
    <!-- Sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
</body>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Forgot Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <form action="<?php echo $_SERVER['REQUEST_URI'] . "?button=forgot_password" ?>" method="post">
                        <div class="input-group mb-3">
                            <input required type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <button class="btn btn-success">Kirim Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function modalForgot() {
    $("#myModal").modal("toggle")
}
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    if($button == "login") :
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = $login->prosesLogin($email, $password);

    $row = $data->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $row['password'])) {

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_role'] = $row['role'];

        echo "<script>
        Swal.fire({
            type: 'success',
            text: \"Berhasil Login\"
        }).then((result)=>{
            if(result.value){
                window.location.href = '" . BASE_URL . "index.php?module=matching&action=match'
            }
        })
    </script>";
    } else {
        echo "<script>
        Swal.fire({
        title : 'Gagal Login',
        text : 'Email atau Password Salah',
        type : 'error'
        }).then((result)=>{
            if(result.value){
                window.location.href = '" . BASE_URL . "login.php'
            }
        })
        </script>";
    }
    elseif ($button == "forgot_password") :
        $email = $_POST['email'];
        $data = $login->prosesForgotPassword($email);
        if ($data) :
            echo "<script>
                    Swal.fire({
                    type: 'success',
                    title: 'Berhasil Di Reset',
                    text:  'Password Baru adalah 123456789'
                }).then((result)=>{
                    if(result.value){
                        window.location.href = '" . BASE_URL . "login.php'
                    }
                })
            </script>";
        endif;
    endif;
endif;
?>