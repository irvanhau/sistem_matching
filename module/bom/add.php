<?php
include_once('db/bom.php');

$bom = new bom;

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    if ($_POST['button'] == 'Add') :
        $bom_id = $_POST['bom_id'];
        $bom_name = $_POST['bom_name'];
        $bom_file = $_FILES['bom_file'];

        $namaSementara = $bom_file['tmp_name'];

        $dirUpload = "upload/bom/";

        $namaFileUpload = $dirUpload . $bom_name . '.xlsx';

        move_uploaded_file($namaSementara, $namaFileUpload);

        if ($bom->insertData($bom_name, $bom_id, $namaFileUpload)) :
            echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=bom&action=list&active=all_user'
            alert('Berhasil Tambah BOM');
            </script>";
        endif;
    endif;
endif;

$name = "";
$email = "";
$password = "";
?>

<form action="<?php echo BASE_URL . "index.php?module=bom&action=add" ?>" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- <div class="form-login">
                    <label class="form-label">Alamat</label>
                    <input type="text" required name="alamat" value="<?php echo $alamat; ?>" class="form-control">
                </div> -->

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">ID BOM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="bom_id">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nama BOM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="bom_name">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">File BOM</label>
                    <div class="col-sm-10">
                        <input type="file" name="bom_file">
                    </div>
                </div>

                <br>
                <input type="submit" name="button" value="Add" class="btn btn-primary">
                <a href="<?php echo BASE_URL . "index.php?module=bom&action=list&active=all_bom" ?>" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</form>