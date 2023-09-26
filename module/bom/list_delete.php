<?php
include_once('db/bom.php');

$bom = new bom;

$button = isset($_GET['button']) ? $_GET['button'] : "";

if ($button == 'Restore') :
    if ($bom->restoreData($_GET['bom_id'])) :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=bom&action=list_delete&active=delete_bom'
            alert('Berhasil Restore Data BOM');
            </script>";
    else :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=bom&action=list_delete&active=delete_bom'
            alert('Gagal Hapus Data BOM');
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
                    <h4 class="mb-sm-0">BOM</h4>
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
                                $data = $bom->showDeleteData();
                                // var_dump($data->fetch(PDO::FETCH_ASSOC));
                                while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['bom_id'] ?></td>
                                        <td><?= $row['bom_name'] ?></td>
                                        <td><?= $bom->showDetailData($row['id'])->rowCount() ?></td>
                                        <td><?= $row['input_date'] ?></td>
                                        <td>
                                            <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=bom&action=detail&active=delete_bom&bom_id=$row[id]'><i class='fas fa-eye'></i></a>" ?>
                                            <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=bom&action=list_delete&button=Restore&bom_id=$row[id]'>Restore</a>" ?>
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
