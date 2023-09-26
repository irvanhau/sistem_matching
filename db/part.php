<?php
include_once('koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class part extends koneksi{
    function showData(){
        $sql = "SELECT * FROM part_list WHERE deleted_at IS NULL";
        $data= $this->koneksi->prepare($sql);
        $data->execute();
        return $data;
    }

    function showDetailData($id){
        $sql = "SELECT * FROM part_list_detail WHERE part_id=:id";
        $data=$this->koneksi->prepare($sql);
        $data->bindParam(":id",$id);
        $data->execute();
        return $data;
    }

    function showDeleteData(){
        $sql = "SELECT * FROM part_list WHERE deleted_at IS NOT NULL";
        $data = $this->koneksi->prepare($sql);
        $data->execute();
        return $data;
    }

    function insertData($part_name,$part_id,$part_file){
        $input_date = date('Y-m-d');
        $now = date('Y-m-d H:i:s');

        $part = [];

        $reader = new Xlsx();
        $spreadsheet_part = $reader->load($part_file);
        $sheetDataPart = $spreadsheet_part->getActiveSheet()->toArray();
        unset($sheetDataPart[0]);

        foreach ($sheetDataPart as $b) {
            array_push($part, [
                'item' => $b[0], 'part_num' => $b[1], 'qty' => $b[2], 'spec'=> $b[3]
            ]);
        }

        for ($p = 0; $p < count($part); $p++) {
            if($part[$p]['part_num'] == "" || $part[$p]['part_num'] == "-"){
                unset($part[$p]);
            }
        }

        $part = array_values($part);

        // var_dump($part[6]);
        try {
            $sql = "INSERT INTO part_list(part_id,part_name,name_file,input_date,created_at) VALUES(:part_id,:part_name,:name_file,:input_date,:created_at)";
            $data = $this->koneksi->prepare($sql);
            $data->bindParam(':part_id', $part_id);
            $data->bindParam(':part_name', $part_name);
            $data->bindParam(':name_file', $part_file);
            $data->bindParam(':input_date', $input_date);
            $data->bindParam(':created_at', $now);
            $data->execute();

            $id = $this->koneksi->lastInsertId();

            for ($i = 0; $i < count($part); $i++) {
                $item = $part[$i]['item'];
                $partNum = $part[$i]['part_num'];
                $qty = $part[$i]['qty'];
                $spec = $part[$i]['spec'];

                $sql2 = "INSERT INTO part_list_detail(part_id,item_name,part_number,qty,specification) VALUES(:part_id,:item_name,:part_number,:qty,:spec)";
                $data2 = $this->koneksi->prepare($sql2);
                $data2->bindParam(':part_id', $id);
                $data2->bindParam(':item_name', $item);
                $data2->bindParam(':part_number', $partNum);
                $data2->bindParam(':qty', $qty);
                $data2->bindParam(':spec', $spec);
                $data2->execute();
            }

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function deleteData($id){
        $delete = date('Y-m-d H:i:s');
        try{
            $sql = "UPDATE part_list SET deleted_at=:deleted_at WHERE id=:id";
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

    function restoreData($id){
        $delete = null;
        try{
            $sql = "UPDATE part_list SET deleted_at=:deleted_at WHERE id=:id";
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