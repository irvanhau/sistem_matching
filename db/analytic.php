<?php
include_once('db/koneksi.php');

class analytic extends koneksi{
    function showAnalyticTable(){
        $sql = 'SELECT md.id,u.name,b.bom_id,b.bom_name,pl.part_id,pl.part_name
                FROM matching_detail AS md
                LEFT JOIN user AS u ON u.id=md.user_id
                LEFT JOIN part_list AS pl ON pl.id=md.part_id
                LEFT JOIN bom AS b ON b.id=md.bom_id
                ORDER BY md.id DESC
                LIMIT 10';
        $data = $this->koneksi->prepare($sql);
        $data->execute();
        return $data;
    }
}