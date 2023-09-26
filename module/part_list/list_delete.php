<?php
include_once('db/part.php');

$part = new part;

$button = isset($_GET['button']) ? $_GET['button'] : "";

if ($button == 'Restore') :
    if ($part->restoreData($_GET['part_id'])) :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=part_list&action=list_delete&active=delete_part'
            alert('Berhasil Restore Data Part List');
            </script>";
    else :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=part_list&action=list_delete&active=delete_part'
            alert('Gagal Restore Data Part List');
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
                                $data = $part->showDeleteData();
                                while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['part_id'] ?></td>
                                        <td><?= $row['part_name'] ?></td>
                                        <td><?= $part->showDetailData($row['id'])->rowCount() ?></td>
                                        <td><?= $row['input_date'] ?></td>
                                        <td>
                                            <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=part_list&action=detail&active=delete_part&part_id=$row[id]'><i class='fas fa-eye'></i></a>" ?>
                                            <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=part_list&action=list_delete&button=Restore&part_id=$row[id]'>Restore</a>" ?>
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