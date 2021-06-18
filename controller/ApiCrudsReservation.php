<?php


class ApiCrudsReservation
{


    function recupererCreneau()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-control-Allow-Methods:GET');


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
    }


    function afficherReservation()
    {

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-control-Allow-Methods:POST');

        $obj = new Database;
        $conn = $obj->connect();

        $requets = new Requets($conn);
        // inserte dand la table de client
        $data = json_decode(file_get_contents("php://input"));

        $requets->reference = $data->reference;
        echo var_dump($requets->reference);

        $allReservations = $requets->getReservations();

        echo  var_dump($allReservations);
    }

    function modifierReservations()
    {

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-control-Allow-Methods:PUT');

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
    }

    function suppReservation()
    {

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-control-Allow-Methods:PUT');


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
    }
}