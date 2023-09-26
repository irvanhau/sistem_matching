<?php
include_once('db/bom.php');

$active = $_GET['active'];

$bom = new bom;

$button = isset($_GET['button']) ? $_GET['button'] : "";

$bom_id = isset($_GET['bom_id']) ? $_GET['bom_id'] : "";

// if ($button == 'Delete') :
//     if ($user->deleteData($_GET['user_id'])) :
//         echo "<script>
//             window.location.href = '" . BASE_URL . "index.php?module=user&action=list&active=all_user'
//             alert('Berhasil Hapus User');
//             </script>";
//     else :
//         echo "<script>
//             window.location.href = '" . BASE_URL . "index.php?module=user&action=list&active=all_user'
//             alert('Gagal Hapus User');
//             </script>";
//     endif;
// endif;

?>


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Detail BOM</h4>
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
                                    <th>Part Number</th>
                                    <th>Qty</th>
                                    <th>Specification</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                $data = $bom->showDetailData($bom_id);
                                // var_dump($data->fetch(PDO::FETCH_ASSOC));
                                while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['part_number'] ?></td>
                                        <td><?= $row['qty'] ?></td>
                                        <td><?= $row['specification'] ?></td>
                                    </tr>
                                <?php $no += 1;
                                }
                                $data->closeCursor(); ?>


                            </tbody>
                        </table>
                        <?php if ($active == 'delete_bom') { ?>
                            <a href="<?php echo BASE_URL . "index.php?module=bom&action=list_delete&active=delete_bom"; ?>" class="btn btn-danger">Kembali</a>
                        <?php } else { ?>
                            <a href="<?php echo BASE_URL . "index.php?module=bom&action=list&active=all_bom"; ?>" class="btn btn-danger">Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>