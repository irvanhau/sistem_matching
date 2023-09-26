<?php
include_once('db/part.php');

$part = new part;

$button = isset($_GET['button']) ? $_GET['button'] : "";

if ($button == 'Delete') :
    if ($part->deleteData($_GET['part_id'])) :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=part_list&action=list&active=all_part'
            alert('Berhasil Hapus Data Part List');
            </script>";
    else :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=part_list&action=list&active=all_part'
            alert('Gagal Hapus Data Part List');
            </script>";
    endif;
endif;

?>


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Part List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if($role == 0||$role == 1){ ?> 
                        <a href="<?php echo BASE_URL .  "index.php?module=part_list&action=add&active=all_part"; ?>" class="btn btn-success mb-3">Tambah Part</a>
                        <a href="<?php echo BASE_URL .  "index.php?module=part_list&action=export_excel&active=all_part"; ?>" class="btn btn-info mb-3">Download Template Part List</a>
                        <?php } ?>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>ID BOM</th>
                                    <th>Nama BOM</th>
                                    <th>Total Data</th>
                                    <th>Tanggal Input</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                $data = $part->showData();
                                while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['part_id'] ?></td>
                                        <td><?= $row['part_name'] ?></td>
                                        <td><?= $part->showDetailData($row['id'])->rowCount() ?></td>
                                        <td><?= $row['input_date'] ?></td>
                                        <td>
                                            <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=part_list&action=detail&active=all_part&part_id=$row[id]'><i class='fas fa-eye'></i></a>" ?>
                                            <?php if($role == 0||$role == 1){ ?>
                                            <?= "<a class='btn btn-danger' href='" . BASE_URL . "index.php?module=part_list&action=list&button=Delete&part_id=$row[id]'><i class='fas fa-trash'></i></a>" ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php $no += 1;
                                }
                                $data->closeCursor(); ?>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
