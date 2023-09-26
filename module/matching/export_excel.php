<?php
include_once('db/matching.php');
require 'vendor/autoload.php';


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

$part_id = $_GET['part_id'];
$bom_id = $_GET['bom_id'];

$match = new matching;

$partData = $match->showPartData($part_id);
$partRow = $partData->fetch(PDO::FETCH_ASSOC);

$bomData = $match->showBomData($bom_id);
$bomRow = $bomData->fetch(PDO::FETCH_ASSOC);

$part_list = $match->arrayPartList($partRow['name_file']);
$bom = $match->arrayBom($bomRow['name_file']);

$match->writeExcel($bom, $bomRow, $part_list, $styleArray, $headerArray);
$match->exportExcel($bomRow, $styleArray, $headerArray);
