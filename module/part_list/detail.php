<?php
include_once('db/part.php');

$active = $_GET['active'];
$part = new part;
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
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Nama Item</th>
                                    <th>Part Number</th>
                                    <th>Quantity</th>
                                    <th>Spesifikasi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                $data = $part->showDetailData($_GET['part_id']);
                                while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['item_name'] ?></td>
                                        <td><?= $row['part_number'] ?></td>
                                        <td><?= $row['qty'] ?></td>
                                        <td><?= $row['specification'] ?></td>
                                    </tr>
                                <?php $no += 1;
                                }
                                $data->closeCursor(); ?>

                            </tbody>
                        </table>
                        <?php if($active == 'delete_part'){?>
                            <a href="<?php echo BASE_URL . "index.php?module=part_list&action=list_delete&active=delete_part"; ?>" class="btn btn-danger">Kembali</a>
                        <?php } else { ?>
                            <a href="<?php echo BASE_URL . "index.php?module=part_list&action=list&active=all_part"; ?>" class="btn btn-danger">Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>