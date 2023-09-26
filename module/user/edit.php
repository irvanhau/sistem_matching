<?php
include_once('db/user.php');

$obj = new user;

if (!$obj->detailData($_GET['user_id'])) die("Error : id mahasiswa tidak ada");
if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $id = $_GET['user_id'];
    if ($obj->updateData($id, $name, $email, $role)) :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=user&action=list&active=all_user'
            alert('Berhasil Edit User');
            </script>";
    endif;
endif;
?>

<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= $obj->name ?>" class="form-control" name="name">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" value="<?= $obj->email ?>" class="form-control" name="email">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role" class="form-control">
                            <option <?= $obj->role == 0 ? "selected" : "" ?> value="0">Admin</option>
                            <option <?= $obj->role == 1 ? "selected" : "" ?> value="1">User</option>
                            <option <?= $obj->role == 2 ? "selected" : "" ?> value="2">Guest</option>
                        </select>
                    </div>
                </div>

                <br>
                <input type="submit" name="button" value="Edit" class="btn btn-primary">
                <a href="<?php echo BASE_URL . "index.php?module=user&action=list&active=all_user" ?>" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</form>