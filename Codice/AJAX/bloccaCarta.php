<?php
//blocca la carta per quell'utente (setta il suo RFID a null)
//richiamata da HTML/Cliente/profiloCliente.html

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if(!isset($_SESSION)) session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(isset($_SESSION["idCliente"])){
        //blocca la carta dell'utente
        //devo rimuovere rfid dall'utente (settarlo su null)
        //poi fare i controlli nelle pagine per vedere se null fare cose
        //in questo modo l'rfid vecchio non potrà più essere utilizzato perché non esiste nel db
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $query = "UPDATE cliente SET num_tessera = null WHERE ID = ?";
        if($classeDB->aggiorna($query, $_SESSION["idCliente"])){
            echo json_encode(array("status"=> "success", "code"=> 200));
        }
    }
    else{
        echo json_encode(array("status"=> "error"));
    }
}
else{
    echo json_encode(array("status"=> "error"));
}