<?php
include_once('db/user.php');
include_once('db/koneksi.php');

$user = new user;

$button = isset($_GET['button']) ? $_GET['button'] : "";

if ($button == 'Restore') :
    if ($user->restoreData($_GET['user_id'])) :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=user&action=list_delete&active=delete_user'
            alert('Berhasil Restore User');
            </script>";
    else :
        echo "<script>
            window.location.href = '" . BASE_URL . "index.php?module=user&action=list_delete&active=delete_user'
            alert('Gagal Restore User');
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
                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                $data = $user->showDeleteData();
                                while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['role'] ? "Admin" : "User" ?></td>
                                        <td>
                                            <?= "<a class='btn btn-info' href='" . BASE_URL . "index.php?module=user&action=list_delete&active=list_delete&button=Restore&user_id=$row[id]'>Restore</a>" ?>
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
