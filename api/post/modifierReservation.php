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

$requets->time_on = $data->time_on;
$requets->time_out = $data->time_out;
$requets->id_reservation = $data->id_reservation;
$requets->jour = $data->jour;



$id_cre = $requets->recupererIdCreneau();

$requets->id_cr = $id_cre['id_cr'];


if ($requets->modifierReservation()) {
    echo json_encode(
        array(
            'message' => 'modification est effectuer'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'modification no effectuer'
        )
    );
}