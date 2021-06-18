<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-control-Allow-Methods:PUT');


include_once '../../config/Database.php';
include_once '../../models/Requets.php';

$obj = new Database;
$conn = $obj->connect();

$requets = new Requets($conn);
// inserte dand la table de client
$data = json_decode(file_get_contents("php://input"));
$requets->id_reservation = $data->id_reservation;

if ($requets->suppReservation()) {
    echo json_encode(
        array(
            'message' => 'suppression est effectuer'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'suppression no effectuer'
        )
    );
}