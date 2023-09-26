<?php
include_once('koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class bom extends koneksi{
    function showData(){
        $sql = "SELECT * FROM bom WHERE deleted_at IS NULL";
        $data = $this->koneksi->prepare($sql);
        $data->execute();
        return $data;
    }

    function showDeleteData(){
        $sql = "SELECT * FROM bom WHERE deleted_at IS NOT NULL";
        $data = $this->koneksi->prepare($sql);
        $data->execute();
        return $data;
    }

    function showDetailData($id){
        $sql = "SELECT * FROM bom_detail WHERE bom_id=:id";
        $data = $this->koneksi->prepare($sql);
        $data->bindParam(':id',$id);
        $data->execute();
        return $data;
    }

    function insertData($bom_name,$bom_id,$bom_file){
        $input_date = date('Y-m-d');
        $now = date('Y-m-d H:i:s');
        $bom = [];
        $reader = new Xlsx();
        $spreadsheet_bom = $reader->load($bom_file);
        $sheetDataBom = $spreadsheet_bom->getActiveSheet()->toArray();
        unset($sheetDataBom[0]);
        foreach ($sheetDataBom as $b) {
            $qty = round($b[1],3);
            array_push($bom, [
                'part_num' => $b[0], 'qty' => $qty, 'spec' => substr($b[2], 0, -1)
            ]);
        }
        try{
            $sql = "INSERT INTO bom(bom_id,bom_name,name_file,input_date,created_at) VALUES(:bom_id,:bom_name,:name_file,:input_date,:created_at)";
            $data= $this->koneksi->prepare($sql);
            $data->bindParam(':bom_id',$bom_id);
            $data->bindParam(':bom_name',$bom_name);
            $data->bindParam(':name_file',$bom_file);
            $data->bindParam(':input_date',$input_date);
            $data->bindParam(':created_at',$now);
            $data->execute();

            $id = $this->koneksi->lastInsertId();
            for($i=0;$i<count($bom);$i++){
                $partNum = $bom[$i]['part_num'];
                $qty = $bom[$i]['qty'];
                $spec = $bom[$i]['spec'];

                $sql2 = "INSERT INTO bom_detail(bom_id,part_number,qty,specification) VALUES(:bom_id,:part_number,:qty,:spec)";
                $data2 = $this->koneksi->prepare($sql2);
                $data2->bindParam(':bom_id',$id);
                $data2->bindParam(':part_number',$partNum);
                $data2->bindParam(':qty',$qty);
                $data2->bindParam(':spec',$spec);
                $data2->execute();
            }
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function deleteData($id){
        $delete = date('Y-m-d H:i:s');
        try{
            $sql = "UPDATE bom SET deleted_at=:deleted_at WHERE id=:id";
            $data= $this->koneksi->prepare($sql);
            $data->bindParam(":deleted_at",$delete);
            $data->bindParam(":id",$id);
            $data->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function restoreData($id){
        $delete = null;
        try{
            $sql = "UPDATE bom SET deleted_at=:deleted_at WHERE id=:id";
            $data= $this->koneksi->prepare($sql);
            $data->bindParam(':deleted_at',$delete);
            $data->bindParam(':id',$id);
            $data->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}