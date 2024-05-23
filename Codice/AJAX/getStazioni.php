<?php
//restituisce un json con tutte le stazioni nel db
//richiamata da
// - HTML/Admin/modificaSlot.html
// - HTML/Admin/modificaStazione.html
// - HTML/Cliente/menuCliente.html
// - HTML/index.html

include("../PHP/classi/CDatabase.php");
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