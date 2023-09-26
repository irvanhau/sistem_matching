<?php
include_once('db/part.php');
include_once('db/bom.php');

$bom = new bom;
$part = new part;

$error = isset($_GET['error']) ? $_GET['error'] : ""
?>


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Matching BOM & Part List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?php echo BASE_URL . "index.php?module=matching&action=execute" ?>">

                        <?php 
                        if($error){
                        ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> <?=$error?> </h5>
                            </div>
                        <?php } ?>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Part List</label>
                                <div class="col-sm-10">
                                    <select require class="form-control" name="part_id">
                                        <option value="">Pilih Part:</option>
                                        <?php
                                        $dataPart = $part->showData();
                                        while ($rowPart = $dataPart->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <option value="<?= $rowPart['id'] ?>"><?= $rowPart['part_name'] ?></option>
                                        <?php $no += 1;
                                        }
                                        $dataPart->closeCursor(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">BOM</label>
                                <div class="col-sm-10">
                                    <select require class="form-control" name="bom_id">
                                        <option value="">Pilih Bom:</option>
                                        <?php
                                        $dataBom = $bom->showData();
                                        while ($rowBom = $dataBom->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <option value="<?= $rowBom['id'] ?>"><?= $rowBom['bom_name'] ?></option>
                                        <?php $no += 1;
                                        }
                                        $dataBom->closeCursor(); ?>
                                    </select>
                                </div>
                            </div>

                            <input type="submit" value="Execute" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>