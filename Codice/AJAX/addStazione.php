<?php

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["nome"]) && isset($_POST["latitudine"]) && isset($_POST["longitudine"]) && isset($_POST["slot"]) && isset($_POST["numDisponibili"])){
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $nome = $_POST["nome"];
        $latitudine = $_POST["latitudine"];
        $longitudine = $_POST["longitudine"];
        $numDisponibili = (int)$_POST["numDisponibili"];
        $slot = (int)$_POST["slot"];


        $query = "INSERT INTO stazione (nome, latitudine, longitudine, num_bici_disp, num_slot_tot) VALUES (?, ?, ?, ?, ?)";
        if($classeDB->inserisci($query, $nome, $latitudine, $longitudine, $numDisponibili, $slot)){
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