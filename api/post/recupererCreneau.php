<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-control-Allow-Methods:GET');

include_once '../../config/Database.php';
include_once '../../model/Requets.php';

$obj = new Database;
$conn = $obj->connect();

$requets = new Requets($conn);
// inserte dand la table de client
$data = json_decode(file_get_contents("php://input"));

$requets->jour = $data->jour;

// recuperer les creneau disponibles

$result = $requets->checkCreneau();

// recuperer le nombres des lignes dans la tables creneau

$creneauDisponibles = array();
// stoker les id creneau disponible dans idCreneau

$i = 0;
while ($row = $result->fetch()) {

    $creneauDisponibles[$i]['time_on'] = $row['time_on'];
    $creneauDisponibles[$i]['time_out'] = $row['time_out'];
    $i++;
}
// recupere les creneau disponibles
echo var_dump($creneauDisponibles);