<?php

include("../PHP/classi/CDatabase.php");
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $classeDB = new CDatabase();
    $classeDB->connessione();

    $query = "SELECT * FROM bici";
    $result = $classeDB->seleziona($query);

    if($result != "errore" && $result != "vuoto"){
        $bici = array();
        foreach($result as $elemento){
            $bici[] = $elemento;
        }
        echo json_encode($bici);
    }
}