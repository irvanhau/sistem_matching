<?php
include_once('db/user.php');
include_once('db/koneksi.php');

$user = new user;

$user->detailData($user_id);
?>


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">
                <div class="card"><br><br>
                    <center>
                        <img class="rounded-circle " src="
                        <?=
                        ($user->profile_image != null) ? 'upload/admin_images/' . $user->profile_image : 'upload/no_image.jpg'
                        ?>
                        " width="250" height="250" alt="Card image cap">
                    </center>
                    <div class="card-body">
                        <h4 class="card-title">Name : <?= $user->name ?></h4>
                        <br>
                        <h4 class="card-title">User Email : <?= $user->email ?></h4>
                        <br>
                        <h4 class="card-title">User Role : <?= $user->role == 1 ? "Admin" : "User" ?></h4>
                        <br>
                        <a href="index.php?module=profile&action=edit&active=profile" class="btn btn-info btn-rounded mt-3">Edit Profile</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>