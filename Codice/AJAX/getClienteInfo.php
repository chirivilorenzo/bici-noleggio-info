<?php

//prendere dal db tutte le info dell'utente e visualizzarle
//poi mettere delle input type per far modificare queste informazioni
//password mettere 2 input (psw vecchia e nuova)
//num carta visualizzare solo ultime 4 cifre (se è nel db)

//dividere le cose in diverse sezioni
//- sezione 1 -> nome e cognome
//- sezione 2 -> email, password e numero carta
//- sezione 3 -> dati dell'indirizzo

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
            $cliente[] = $elemento;
        }
        echo json_encode($cliente);
    }
}
else{
    http_response_code(405);
    echo json_encode(array("status"=> "error", "code"=> 405, "message"=> "non puoi visualizzare questa pagina"));
}