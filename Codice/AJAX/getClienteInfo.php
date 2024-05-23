<?php
//restituisce un json contenente tutte le info di quell'utente dal db
//richiamata da JS/profiloCliente.js

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if (!isset($_SESSION)) session_start();

if (isset($_SESSION["idCliente"])){
    $classeDB = new CDatabase();
    $classeDB->connessione();

    $query = "SELECT * FROM cliente JOIN indirizzo ON indirizzo.ID = cliente.idIndirizzo WHERE cliente.ID = ?";
    $result = $classeDB->seleziona($query, $_SESSION["idCliente"]);

    if($result != "errore" && $result != "vuoto"){
        $cliente = array();
        foreach($result as $elemento){
            if($elemento["num_carta_credito"] != null){
                $elemento["num_carta_credito"] = "**** **** **** " . substr($elemento["num_carta_credito"], -4);
            }
            $cliente[] = $elemento;
        }
        echo json_encode($cliente);
    }
}
else{
    http_response_code(405);
    echo json_encode(array("status"=> "error", "code"=> 405, "message"=> "non puoi visualizzare questa pagina"));
}