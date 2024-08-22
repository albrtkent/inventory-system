<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/barang.php';
 
$database = new Database();
$db = $database->getConnection();
 
$data = new Barang($db);
 
$data->id = isset($_GET['id']) ? $_GET['id'] : die();
$data->readOne();
if($data->nama!=null){
    $data_arr = array(
        "id" =>  $data->id,
        "nama" => $data->nama,
        "jenis" => $data->jenis,
        "kodebarang" => $data->kodebarang,
        "lokasi" => $data->lokasi,
        "pic" => $data->pic,
        "kondisi" => $data->kondisi
 
    );
    http_response_code(200);
    echo json_encode($data_arr);
}
 
else{
    http_response_code(404);
    echo json_encode(array("message" => "Data does not exist."));
}
?>