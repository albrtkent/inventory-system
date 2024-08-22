<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/barang.php';

$database = new Database();
$db = $database->getConnection();

$data = new Barang($db);
// query products
$stmt = $data->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // products array
    $data_arr = array();
    $data_arr["records"] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        // "description" => html_entity_decode($description),
 
        $data_item = array(
            "id" => $id,
            "nama" => $nama,
            "jenis" =>$jenis,
            "kodebarang" => $kodebarang,
            "lokasi" => $lokasi,
            "pic" => $pic,
            "kondisi" => $kondisi
        );

        array_push($data_arr["records"], $data_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($data_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Data does not exist."));
}