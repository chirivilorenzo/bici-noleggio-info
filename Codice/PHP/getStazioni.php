<?php

include("classi/CDatabase.php");
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $classeDB = new CDatabase();
    $classeDB->connessione();

    $query = "SELECT * FROM stazione";
    $result = $classeDB->seleziona($query);

    if($result != "errore" && $result != "vuoto"){
        $stazioni = array();
        foreach($result as $elemento){
            $stazioni[] = $elemento;
        }
        echo json_encode($stazioni);
    }
}