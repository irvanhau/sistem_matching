<?php
include_once('db/matching.php');

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];

$headerArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ]
];

$part_id = $_POST['part_id'];
$bom_id = $_POST['bom_id'];

$match = new matching;

if ($part_id == "" || $bom_id == "") {
    $error = "BOM / Part List Tidak Boleh Kosong";
    header('location:' . BASE_URL . 'index.php?module=matching&action=match&error=' . $error);
}

$partData = $match->showPartData($part_id);
$partRow = $partData->fetch(PDO::FETCH_ASSOC);

$bomData = $match->showBomData($bom_id);
$bomRow = $bomData->fetch(PDO::FETCH_ASSOC);

$part_list = $match->arrayPartList($partRow['name_file']);
$bom = $match->arrayBom($bomRow['name_file']);

$match->writeExcel($bom,$bomRow,$part_list,$styleArray,$headerArray);
$data = $match->dataExcel();

$match->saveData($user_id,$part_id,$bom_id);

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
                        <a target="_blank" href="<?php echo BASE_URL . "index.php?module=matching&action=export_excel&part_id=$part_id&bom_id=$bom_id" ?>" class="btn btn-success mb-3">Export Excel</a>
                        <a href="<?php echo BASE_URL . "index.php?module=matching&action=match" ?>" class="btn btn-danger mb-3">Kembali</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td colspan="5" class="text-center font-weight-bold">Part List</td>
                                    <td colspan="3" class="text-center font-weight-bold">BOM</td>
                                    <td colspan="3" class="text-center font-weight-bold">Match Result</td>
                                </tr>
                                <tr class="text-center font-weight-bold">
                                    <td>No</td>
                                    <td>Item Name</td>
                                    <td>Part Number</td>
                                    <td>Qty</td>
                                    <td>Specification</td>
                                    <td>Part Number</td>
                                    <td>Qty</td>
                                    <td>Specification</td>
                                    <td>Part Number</td>
                                    <td>Qty</td>
                                    <td>Specification</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                for ($i = 0; $i < count($data); $i++) {
                                ?>
                                    <tr>
                                        <td><?= $no + $i ?></td>
                                        <td><?= $data[$i]['item_name'] ?></td>
                                        <td><?= $data[$i]['pl_part_num'] ?></td>
                                        <td><?= $data[$i]['pl_qty'] ?></td>
                                        <td><?= $data[$i]['pl_spec'] ?></td>
                                        <td><?= $data[$i]['bom_part_num'] ?></td>
                                        <td><?= $data[$i]['bom_qty'] ?></td>
                                        <td><?= $data[$i]['bom_spec'] ?></td>

                                        
                                        
                                        <!-- MATCHING PART NUMBER -->
                                        <td>
                                            <?php
                                            if (isset($data[$i]['bom_part_num'])) {
                                                if (preg_match('/' . $data[$i]['bom_part_num'] . '/i', $data[$i]['pl_part_num'])) {
                                                    echo "OK";
                                                } else {
                                                    echo "False";
                                                }
                                            } else {
                                                echo "False";
                                            }
                                            ?>
                                        </td>

                                        <!-- MATCHING QUANTITY -->
                                        <td>
                                            <?php
                                            if (isset($data[$i]['bom_qty'])) {
                                                if (preg_match('/' . $data[$i]['bom_qty'] . '/i', $data[$i]['pl_qty'])) {
                                                    echo "OK";
                                                } else {
                                                    echo "False";
                                                }
                                            } else {
                                                echo "False";
                                            }
                                            ?>
                                        </td>

                                        <!-- MATCHING SPECIFICATION -->
                                        <td>
                                            <?php
                                            if (isset($data[$i]['bom_spec'])) {
                                                if ($data[$i]['bom_spec'] == $data[$i]['pl_spec']) {
                                                    echo "OK";
                                                } else {
                                                    echo "False";
                                                }
                                            } else {
                                                echo "False";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>