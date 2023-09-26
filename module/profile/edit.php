<?php
include_once('db/user.php');
include_once('db/koneksi.php');

$user = new user;

$user->detailData($user_id);


if($_SERVER['REQUEST_METHOD'] == "POST") :
    // echo $_FILES['profile_image']['name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $profile_image = $_FILES['profile_image'];
    if($user->updateProfile($user_id,$name,$email,$profile_image)):
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=profile&action=view&active=profile'
            alert('Berhasil Edit Profile');
            </script>";
    endif;
endif
?>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <h4>Edit Profile Page</h4>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="<?= $user->name ?>" id="name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" value="<?=$user->email?>" id="email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="profile_image" id="profile_image">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                        <div class="col-sm-10">
                            <img id="showImage" src="
                            <?=
                    (!empty($user->profile_image)) ? 'upload/admin_images/'.$user->profile_image : 'upload/no_image.jpg'
                    ?>
                    " class="rounded avatar-lg" width="250" height="250" alt="Card Image cap">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $("#profile_image").change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>