<?php
//modifica il numero degli slot totali di una certa stazione (preso id in post)
//richiamata da HTML/Admin/modificaSlot.html

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["id"]) && isset($_POST["num"])){
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $id = $_POST["id"];
        $num = $_POST["num"];

        $query = "UPDATE stazione SET num_slot_tot = ? WHERE ID = ?";
        if($classeDB->aggiorna($query, $num, $id)){
            echo json_encode(array("status" => "success", "code" => 200));
        }
        else{
            http_response_code(500);
            echo json_encode(array("status" => "error", "message" => "Errore durante l'esecuzione della query di eliminazione.", "code" => 500));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("status" => "error", "message" => "Parametro 'id' mancante.", "code" => 400));
    }
}
else{
    http_response_code(405);
    echo json_encode(array("status" => "error", "message" => "Metodo di richiesta non valido.", "code" => 405));
}