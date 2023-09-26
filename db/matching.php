<?php
include_once('koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class matching extends koneksi{
    
    function showPartData($id){
        $sql = "SELECT * FROM part_list WHERE id=:id";
        $data= $this->koneksi->prepare($sql);
        $data->bindParam(':id',$id);
        $data->execute();
        return $data;   
    }

    function showBomData($id){
        $sql = "SELECT * FROM bom WHERE id=:id";
        $data= $this->koneksi->prepare($sql);
        $data->bindParam(':id',$id);
        $data->execute();
        return $data;   
    }

    function arrayPartList($partFile){
        $part_list = [];

        $reader = new Xlsx();
        $spreadsheet_pl = $reader->load($partFile);

        $sheetDataPl = $spreadsheet_pl->getActiveSheet()->toArray();

        unset($sheetDataPl[0]);

        foreach ($sheetDataPl as $pl) {
            array_push($part_list, [
                'item' => $pl[0], 'part_num' => $pl[1], 'qty' => $pl[2], 'spec' => $pl[3]
            ]);
        }

        return $part_list;
    }

    function arrayBom($partFile){
        $bom = [];

        $reader = new Xlsx();
        $spreadsheet_bom = $reader->load($partFile);

        $sheetDataBom = $spreadsheet_bom->getActiveSheet()->toArray();

        unset($sheetDataBom[0]);

        foreach ($sheetDataBom as $b) {
            $qty = round($b[1],3);
            array_push($bom, [
                'part_num' => $b[0], 'qty' => $qty, 'spec' => substr($b[2], 0, -1)
            ]);
        }
        return $bom;
    }

    function writeExcel($bom, $bomRow, $part_list, $styleArray, $headerArray){
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
                if ($bom[$b]['part_num'] == $part_list[$k]['part_num'] || preg_match('/' . preg_quote($bom[$b]['spec'],'/') . '/i', $part_list[$k]['spec'])) {
                    $sheet->setCellValueByColumnAndRow(6, $k + 5, $bom[$b]['part_num']);
                    $sheet->setCellValueByColumnAndRow(7, $k + 5, $bom[$b]['qty']);
                    $sheet->setCellValueByColumnAndRow(8, $k + 5, $bom[$b]['spec']);
                }
            }
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save("hasil/matching.xlsx");
    }

    function dataExcel(){
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

        return $dataExcel;
    }

    function exportExcel($bomRow, $styleArray, $headerArray){
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

        for ($de = 0; $de < count($dataExcel); $de++) {
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
            if ($dataExcel[$de]['bom_part_num'] != null || $dataExcel[$de]['bom_part_num'] != null) {
                if ($dataExcel[$de]['bom_part_num'] == $dataExcel[$de]['pl_part_num']) {
                    $sheet->setCellValueByColumnAndRow(9, $de + 5, "Ok");
                }else{
                    $sheet->setCellValueByColumnAndRow(9, $de + 5, "False");
                }

            } else {
                $sheet->setCellValueByColumnAndRow(9, $de + 5, "False");
            }

            // MATCHING QUANTITY

            if ($dataExcel[$de]['bom_qty'] != null || $dataExcel[$de]['bom_qty'] != null) {
                if (preg_match('/' . $dataExcel[$de]['bom_qty'] . '/i', $dataExcel[$de]['pl_qty'])) {
                    $sheet->setCellValueByColumnAndRow(10, $de + 5, "Ok");
                }else{
                    $sheet->setCellValueByColumnAndRow(10, $de + 5, "False");
                }
            } else {
                $sheet->setCellValueByColumnAndRow(10, $de + 5, "False");
                // echo "False";
            }

            // MATCHING SPEC

            if ($dataExcel[$de]['bom_spec'] == $dataExcel[$de]['pl_spec']) {
                $sheet->setCellValueByColumnAndRow(11, $de + 5, "Ok");
            } else {
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

    function saveData($user_id,$part_id,$bom_id){
        $sql = "INSERT INTO matching_detail(user_id,bom_id,part_id) VALUES(:user_id,:bom_id,:part_id)";
        $data = $this->koneksi->prepare($sql);
        $data->bindParam(':user_id',$user_id);
        $data->bindParam(':bom_id',$bom_id);
        $data->bindParam(':part_id',$part_id);
        $data->execute();
    }
}