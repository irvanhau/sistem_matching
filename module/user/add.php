<?php
include_once('db/user.php');

$obj = new user;

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    if ($_POST['button'] == 'Add') :
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        if ($obj->insertData($name, $email, $password,$role)) :
            echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=user&action=list&active=all_user'
            alert('Berhasil Tambah User');
            </script>";
        endif;
    endif;
endif;

$name = "";
$email = "";
$password = "";

?>

<form action="<?php echo BASE_URL . "index.php?module=user&action=add" ?>" method="POST">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- <div class="form-login">
                    <label class="form-label">Alamat</label>
                    <input type="text" required name="alamat" value="<?php echo $alamat; ?>" class="form-control">
                </div> -->

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role">
                            <option value="0">Admin</option>
                            <option value="1">User</option>
                            <option value="2">Guest</option>
                        </select>
                    </div>
                </div>

                <br>
                <input type="submit" name="button" value="Add" class="btn btn-primary">
                <a href="<?php echo BASE_URL . "index.php?module=user&action=list&active=all_user" ?>" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</form>