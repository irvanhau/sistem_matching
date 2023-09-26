<?php
include_once('db/user.php');
include_once('db/koneksi.php');

$user = new user;

$button = isset($_GET['button']) ? $_GET['button'] : "";

if($button == 'Delete'):
    if($user->deleteData($_GET['user_id'])):
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=user&action=list&active=all_user'
            alert('Berhasil Hapus User');
            </script>";
    else:
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=user&action=list&active=all_user'
            alert('Gagal Hapus User');
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
                    <h4 class="mb-sm-0">User</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo BASE_URL .  "index.php?module=user&action=add&active=all_user"; ?>" class="btn btn-success mb-3">Tambah User</a>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>ID User</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    $data = $user->showData();
                                    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                    ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td>
                                                <?php
                                                    switch ($row['role']) {
                                                        case 0:
                                                            echo "Admin";
                                                            break;
                                                        case 1:
                                                            echo "User";
                                                            break;
                                                        case 2:
                                                            echo "Guest";
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=user&action=edit&user_id=$row[id]&active=all_user'><i class='fas fa-pencil'></i></a>" ?>
                                                <?= "<a class='btn btn-danger' href='" . BASE_URL . "index.php?module=user&action=list&button=Delete&user_id=$row[id]'><i class='fas fa-trash'></i></a>" ?>
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