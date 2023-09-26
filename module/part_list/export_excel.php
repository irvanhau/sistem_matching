<?php
require 'vendor/autoload.php';

$excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $excel->getActiveSheet();

$column_header = ["Item Name","Part Number", "Quantity", "Specification"];

$j = 1;
foreach ($column_header as $x_value) {
    $sheet->setCellValueByColumnAndRow($j, 1, $x_value);
    $j = $j + 1;
}

ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="part-list.xlsx');
header('Cache-Control: max-age=0');

$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($excel);
exit($xlsxWriter->save('php://output'));
