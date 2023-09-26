<?php
include_once('db/part.php');

$part = new part;

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    if ($_POST['button'] == 'Add') :
        $part_id = $_POST['part_id'];
        $part_name = $_POST['part_name'];
        $part_file = $_FILES['part_file'];

        $namaSementara = $part_file['tmp_name'];

        $dirUpload = "upload/part_list/";

        $namaFileUpload = $dirUpload . str_replace(" ","-",$part_name) . '.xlsx';

        move_uploaded_file($namaSementara, $namaFileUpload);

        // echo $namaFileUpload;

        if ($part->insertData($part_name, $part_id, $namaFileUpload)) :
            echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=part_list&action=list&active=all_part'
            alert('Berhasil Tambah Part List');
            </script>";
        endif;
    endif;
endif;

$name = "";
$email = "";
$password = "";
?>

<form action="<?php echo BASE_URL . "index.php?module=part_list&action=add" ?>" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- <div class="form-login">
                    <label class="form-label">Alamat</label>
                    <input type="text" required name="alamat" value="<?php echo $alamat; ?>" class="form-control">
                </div> -->

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">ID Part</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="part_id">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nama Part</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="part_name">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">File Part</label>
                    <div class="col-sm-10">
                        <input type="file" name="part_file">
                    </div>
                </div>

                <br>
                <input type="submit" name="button" value="Add" class="btn btn-primary">
                <a href="<?php echo BASE_URL . "index.php?module=part_list&action=list&active=all_part" ?>" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</form>