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

$requets->reference = $data->reference;
echo var_dump($requets->reference);

$allReservations = $requets->getReservations();

echo  var_dump($allReservations);