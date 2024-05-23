<?php
//inserisce nel db una nuova bici
//richiamata da HTML/Admin/modificaBici.html

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["rfid"]) && isset($_POST["disponibile"]) && isset($_POST["gps"]) && isset($_POST["kmPercorsi"])){
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $rfid = $_POST["rfid"];
        $disponibile = (int)$_POST["disponibile"];
        $gps = $_POST["gps"];
        $kmPercorsi = (int)$_POST["kmPercorsi"];


        $query = "INSERT INTO bici (disponibile, RFID, gps, km_percorsi) VALUES (?, ?, ?, ?)";
        if($classeDB->inserisci($query, $disponibile, $rfid, $gps, $kmPercorsi)){
            echo json_encode(array("status" => "success", "code" => 200));
        }
        else{
            http_response_code(500);
            echo json_encode(array("status" => "error", "message" => "Errore durante l'esecuzione della query di eliminazione.", "code" => 500));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("status" => "error", "message" => "Parametri mancanti.", "code" => 400));
    }
}
else{
    http_response_code(405);
    echo json_encode(array("status" => "error", "message" => "Metodo di richiesta non valido.", "code" => 405));
}