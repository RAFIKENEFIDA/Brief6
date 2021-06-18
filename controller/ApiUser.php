<?php

class ApiUser
{

    function creatUser()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-control-Allow-Methods:POST');

        $obj = new Database;
        $conn = $obj->connect();

        $requets = new Requets($conn);
        // inserte dand la table de client
        $data = json_decode(file_get_contents("php://input"));


        $requets->nom = $data->nom;
        $requets->prenom = $data->prenom;
        $requets->date_naissance = $data->date_naissance;


        if ($requets->create()) {
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

        // inserte refrence du client

        $data_client =  $requets->GenerateReference();



        $requets->id_user = $data_client['id_user'];
        $requets->prenom = $data_client['prenom'];


        $requets->reference = $requets->prenom .  $requets->id_user;
        echo var_dump($requets->id_user);
        echo var_dump($requets->prenom);

        echo var_dump($requets->reference);

        if ($requets->InsertReference()) {
            echo json_encode(
                array(
                    'message' => 'reference inserte'
                )
            );
        } else {
            echo json_encode(
                array(
                    'message' => 'reference no inserer'
                )
            );
        }
    }

    function inserteReservation()
    {


        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-control-Allow-Methods:POST');

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
    }
}