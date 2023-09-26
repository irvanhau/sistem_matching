<?php
ob_start();
include_once('db/matching.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

// STYLE ARRAY

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

$part_id = '2';
$bom_id = '1';

$match = new matching;

$partData = $match->showPartData($part_id);
$partRow = $partData->fetch(PDO::FETCH_ASSOC);

$bomData = $match->showBomData($bom_id);
$bomRow = $bomData->fetch(PDO::FETCH_ASSOC);

$part_list = $match->arrayPartList($partRow['name_file']);
$bom = $match->arrayBom($bomRow['name_file']);

writeExcel($bom,$bomRow,$part_list,$styleArray,$headerArray);
exportExcel($bomRow,$styleArray,$headerArray);

// WRITE EXCEL
function writeExcel($bom,$bomRow,$part_list,$styleArray,$headerArray){

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    // STYLE ARRAY
    $sheet->getStyle('A1:K' . count($bom) + 4)->applyFromArray($styleArray);
    $sheet->getStyle('A1:K3')->applyFromArray($headerArray);

    // SIZE FONT
    $sheet->getStyle('A1:K1')->getFont()->setSize(20);
    $sheet->getStyle('A2:K2')->getFont()->setSize(14);

    $sheet->mergeCells('A1:K1');
    $sheet->setCellValueByColumnAndRow(1, 1, "BOM MATCHING SHEET");

    $sheet->mergeCells('A2:K2');
    $sheet->setCellValueByColumnAndRow(1, 2, "Model " . $bomRow['bom_name']);

    $sheet->mergeCells('A3:E3');
    $sheet->setCellValueByColumnAndRow(1, 3, "Part List");

    $sheet->mergeCells('F3:H3');
    $sheet->setCellValueByColumnAndRow(6, 3, "BOM");

    $sheet->mergeCells('I3:K3');
    $sheet->setCellValueByColumnAndRow(9, 3, "Matching Result");

    $column_header = ["No", "Item", "P/N", "Qty", "Spec", "P/N", "Qty", "Spec", "P/N", "Qty", "Spec"];
    $j = 1;
    foreach ($column_header as $x_value) {
        $sheet->setCellValueByColumnAndRow($j, 4, $x_value);
        $j = $j + 1;
    }

    for ($k = 0; $k < count($part_list); $k++) {

        $row_pl = $part_list[$k];
        $j_pl = 2;

        foreach ($row_pl as $x_value_pl) {
            $sheet->setCellValueByColumnAndRow(1, $k + 5, $k + 1);
            $sheet->setCellValueByColumnAndRow($j_pl, $k + 5, $x_value_pl);
            $j_pl += 1;
        }

        for ($b = 0; $b < count($bom); $b++) {
            if (preg_match('/' . $bom[$b]['part_num'] . '/i', $part_list[$k]['part_num'])) {
                $sheet->setCellValueByColumnAndRow(6, $k + 5, $bom[$b]['part_num']);
                $sheet->setCellValueByColumnAndRow(7, $k + 5, $bom[$b]['qty']);
                $sheet->setCellValueByColumnAndRow(8, $k + 5, $bom[$b]['spec']);
            }
        }
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save("hasil/matching.xlsx");
}

function exportExcel($bomRow,$styleArray,$headerArray){
    $dataExcel = [];
    $path = "hasil/matching.xlsx";
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $data = $reader->load($path);
    $activeData = $data->getActiveSheet()->toArray();
    
    unset($activeData[0]);
    unset($activeData[1]);
    unset($activeData[2]);
    unset($activeData[3]);
    
    foreach ($activeData as $ad) {
        // var_dump($ad[1]);
        array_push($dataExcel, [
            'item_name' => $ad[1], 
            'pl_part_num' => $ad[2], 
            'pl_qty' => $ad[3], 
            'pl_spec' => $ad[4],
            'bom_part_num' => $ad[5], 
            'bom_qty' => $ad[6], 
            'bom_spec' => $ad[7]
        ]);
    }


    
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        // STYLE ARRAY
        $sheet->getStyle('A1:K' . count($dataExcel) + 4)->applyFromArray($styleArray);
        $sheet->getStyle('A1:K3')->applyFromArray($headerArray);

        // SIZE FONT
        $sheet->getStyle('A1:K1')->getFont()->setSize(20);
        $sheet->getStyle('A2:K2')->getFont()->setSize(14);

        $sheet->mergeCells('A1:K1');
        $sheet->setCellValueByColumnAndRow(1, 1, "BOM MATCHING SHEET");

        $sheet->mergeCells('A2:K2');
        $sheet->setCellValueByColumnAndRow(1, 2, "Model " . $bomRow['bom_name']);

        $sheet->mergeCells('A3:E3');
        $sheet->setCellValueByColumnAndRow(1, 3, "Part List");

        $sheet->mergeCells('F3:H3');
        $sheet->setCellValueByColumnAndRow(6, 3, "BOM");

        $sheet->mergeCells('I3:K3');
        $sheet->setCellValueByColumnAndRow(9, 3, "Matching Result");

        $column_header = ["No", "Item", "P/N", "Qty", "Spec", "P/N", "Qty", "Spec", "P/N", "Qty", "Spec"];
        $j = 1;
        foreach ($column_header as $x_value) {
            $sheet->setCellValueByColumnAndRow($j, 4, $x_value);
            $j = $j + 1;
        }

        for($de = 0; $de < count($dataExcel); $de++) {
            // echo $dataExcel[0]['item_name'];
            $sheet->setCellValueByColumnAndRow(1, $de + 5, $de + 1);
            $sheet->setCellValueByColumnAndRow(2, $de + 5, $dataExcel[$de]['item_name']);
            $sheet->setCellValueByColumnAndRow(3, $de + 5, $dataExcel[$de]['pl_part_num']);
            $sheet->setCellValueByColumnAndRow(4, $de + 5, $dataExcel[$de]['pl_qty']);
            $sheet->setCellValueByColumnAndRow(5, $de + 5, $dataExcel[$de]['pl_spec']);
            $sheet->setCellValueByColumnAndRow(6, $de + 5, $dataExcel[$de]['bom_part_num']);
            $sheet->setCellValueByColumnAndRow(7, $de + 5, $dataExcel[$de]['bom_qty']);
            $sheet->setCellValueByColumnAndRow(8, $de + 5, $dataExcel[$de]['bom_spec']);

            // MATCHING PART NUMBER
            if($dataExcel[$de]['bom_part_num'] != null || $dataExcel[$de]['bom_part_num'] != null){
                if (preg_match('/' . $dataExcel[$de]['bom_part_num'] . '/i', $dataExcel[$de]['pl_part_num'])) {
                    // echo "Ok";
                    $sheet->setCellValueByColumnAndRow(9, $de + 5, "Ok");
                }
            }else{
                $sheet->setCellValueByColumnAndRow(9, $de + 5, "False");
                // echo "False";
            }

            // MATCHING QUANTITY

            if($dataExcel[$de]['bom_qty'] != null || $dataExcel[$de]['bom_qty'] != null){
                if (preg_match('/' . $dataExcel[$de]['bom_qty'] . '/i', $dataExcel[$de]['pl_qty'])) {
                    // echo "Ok";
                    $sheet->setCellValueByColumnAndRow(10, $de + 5, "Ok");
                }
            }else{
                $sheet->setCellValueByColumnAndRow(10, $de + 5, "False");
                // echo "False";
            }

            // MATCHING SPEC

            if ($dataExcel[$de]['bom_spec'] == $dataExcel[$de]['pl_spec']) {
                $sheet->setCellValueByColumnAndRow(11, $de + 5, "Ok");
            }else{
                $sheet->setCellValueByColumnAndRow(11, $de + 5, "False");
            }

        }
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ResultMatching.xlsx');
        header('Cache-Control: max-age=0');

        $xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        exit($xlsxWriter->save('php://output'));
}
 
