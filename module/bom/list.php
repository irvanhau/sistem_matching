<?php
include_once('db/bom.php');

$bom = new bom;

$button = isset($_GET['button']) ? $_GET['button'] : "";

if ($button == 'Delete') :
    if ($bom->deleteData($_GET['bom_id'])) :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=bom&action=list&active=all_bom'
            alert('Berhasil Hapus Data BOM');
            </script>";
    else :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=bom&action=list&active=all_bom'
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
                        <?php
                            if($role == 1){
                        ?>
                        <a href="<?php echo BASE_URL .  "index.php?module=bom&action=add&active=all_bom"; ?>" class="btn btn-success mb-3">Tambah BOM</a>
                        <?php }
                            if($role == 0 || $role == 1){
                        ?>
                        <a href="<?php echo BASE_URL .  "index.php?module=bom&action=export_excel&active=all_bom"; ?>" class="btn btn-info mb-3">Download Template BOM</a>
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
                                $data = $bom->showData();
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
                                            <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=bom&action=detail&active=all_bom&bom_id=$row[id]'><i class='fas fa-eye'></i></a>" ?>
                                            <?php if($role == 0||$role == 1){ ?>
                                            <?= "<a class='btn btn-danger' href='" . BASE_URL . "index.php?module=bom&action=list&button=Delete&bom_id=$row[id]'><i class='fas fa-trash'></i></a>" ?>
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

<div class="modal fade" id="modal-show">
    <div class="modal-dialog bs-example-modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="header"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('project_order.create')}}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group">
                        <label>Customer</label>
                        <select class="form-control" name="customer_id" id="customer_id">
                            <option value="">--- Pilih Customer ---</option>
                            @foreach ($customer as $item)
                            <option value="{{$item->customer_id}}">{{$item->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Proyek</label>
                        <input type="text" name="project_name" id="project_name" class="form-control">
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-outline-info">Submit</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>