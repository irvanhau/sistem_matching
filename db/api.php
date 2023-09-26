<?php
$koneksi = mysqli_connect('localhost:3308','root','','sistem_match');

// $bom_id = isset($_GET['bom_id']) ? " where m.bom_id = $_GET[bom_id]" : "";
$bom_id = $_GET['bom_id'];

if($bom_id > 0 && isset($bom_id)){
    $where = " where m.bom_id = $bom_id";
}else{
    $where = "";
}

$group_by = " group by u.name";
$sql = "
select u.name,count(m.user_id) as countUser
from matching_detail as m
left join user as u on m.user_id = u.id
left join bom as b on m.bom_id = b.id" . $where . $group_by;

$query = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));

$array = array();
while($data = mysqli_fetch_assoc($query)) $array[] = $data;
echo json_encode($array);