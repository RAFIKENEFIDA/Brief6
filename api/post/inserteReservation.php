<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-control-Allow-Methods:POST');


include_once '../../config/Database.php';
include_once '../../models/Requets.php';

$obj = new Database;
$conn = $obj->connect();

$requets = new Requets($conn);
// inserte dand la table de client
$data = json_decode(file_get_contents("php://input"));

$requets->time_on = $data->time_on;
$requets->time_out = $data->time_out;
$requets->id_user = $data->id_user;
$requets->jour = $data->jour;

$result = $requets->recupererIdCreneau();
$requets->id_cr = $result['id_cr'];

if ($requets->insertReservation()) {
    echo json_encode(
        array(
            'message' => 'donnees client sont inserer'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'donnees client ne sont pas inserer'
        )
    );
}