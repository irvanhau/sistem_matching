<?php
// session_start();
$module = isset($_GET['module']) ? $_GET['module'] : false;
$action = isset($_GET['action']) ? $_GET['action'] : false;
$mode = isset($_GET['mode']) ? $_GET['mode'] : false;
$active = isset($_GET['active']) ? $_GET['active'] : false;

$style = "menu-is-opening menu-open";

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="index.php?module=matching&action=match" class="d-block">
                    <img src="<?php echo BASE_URL . "asset/logo.jpg" ?>" alt="Logo">
                    Sistem Informasi Matching
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php?module=matching&action=match" class="nav-link <?= $module == 'matching' ? 'active' : '' ?>">
                        <p>Matching</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?module=grafik&action=view" class="nav-link <?= $module == 'grafik' ? 'active' : '' ?>">
                        <p>Graphic</p>
                    </a>
                </li>

                <li class="nav-header">Master Data</li>

                <?php
                if ($role == 0) {
                ?>

                    <li class="nav-item <?= $module == 'user' ? $style : '' ?>">
                        <a href="#" class="nav-link">
                            <p>
                                User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: <?= $module == 'user' ? 'block' : 'none' ?>;">
                            <li class="nav-item">
                                <a href="<?php echo BASE_URL . "index.php?module=user&action=list&active=all_user"; ?>" class="nav-link <?= $active == 'all_user' ? 'active' : '' ?>">
                                    <p>All Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo BASE_URL . "index.php?module=user&action=list_delete&active=delete_user"; ?>" class="nav-link <?= $active == 'delete_user' ? 'active' : '' ?>">
                                    <p>Deleted Data</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } ?>
                <li class="nav-item <?= $module == 'bom' ? $style : '' ?>">
                    <a href="#" class="nav-link">
                        <p>
                            BOM
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: <?= $module == 'bom' ? 'block' : 'none' ?>;">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL . "index.php?module=bom&action=list&active=all_bom"; ?>" class="nav-link <?= $active == 'all_bom' ? 'active' : '' ?>">
                                <p>All Data</p>
                            </a>
                        </li>
                        <?php
                        if ($role == 0 || $role == 1) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo BASE_URL . "index.php?module=bom&action=list_delete&active=delete_bom"; ?>" class="nav-link <?= $active == 'delete_bom' ? 'active' : '' ?>">
                                    <p>Deleted Data</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if ($role == 1) { ?>
                    <li class="nav-item <?= $module == 'part_list' ? $style : '' ?>">
                        <a href="#" class="nav-link">
                            <p>
                                Part List
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: <?= $module == 'part_list' ? 'block' : 'none' ?>;">
                            <li class="nav-item">
                                <a href="<?php echo BASE_URL . "index.php?module=part_list&action=list&active=all_part"; ?>" class="nav-link <?= $active == 'all_part' ? 'active' : '' ?>">
                                    <p>All Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo BASE_URL . "index.php?module=part_list&action=list_delete&active=delete_part"; ?>" class="nav-link <?= $active == 'delete_part' ? 'active' : '' ?>">
                                    <p>Deleted Data</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($role == 2) { ?>
                    <li class="nav-item <?= $module == 'part_list' ? $style : '' ?>">
                        <a href="#" class="nav-link">
                            <p>
                                Part List
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: <?= $module == 'part_list' ? 'block' : 'none' ?>;">
                            <li class="nav-item">
                                <a href="<?php echo BASE_URL . "index.php?module=part_list&action=list&active=all_part"; ?>" class="nav-link <?= $active == 'all_part' ? 'active' : '' ?>">
                                    <p>All Data</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                        <?php } ?>

                        <hr>
                        <li class="nav-item">
                            <a href="index.php?module=profile&action=view" class="nav-link <?= $module == 'profile' ? 'active' : '' ?>">
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="logout.php" class="nav-link btn-danger">
                                <p>Logout</p>
                            </a>
                        </li>
                        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>