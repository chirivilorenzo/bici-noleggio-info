<?php
//restituisce tutte le bici noleggiate da più di un giorno
//richiamata da HTML/Admin/visualizzaStatistiche.html

include("../PHP/classi/CDatabase.php");
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $classeDB = new CDatabase();
    $classeDB->connessione();

    $query = "SELECT *
    FROM operazione o
    WHERE o.tipo = 'noleggio'
      AND o.data_ora < NOW() - INTERVAL 1 DAY
      AND NOT EXISTS (
        SELECT 1
        FROM operazione o2
        WHERE o2.tipo = 'deposito'
          AND o2.idBici = o.idBici
          AND o2.data_ora > o.data_ora
      );";
    $result = $classeDB->seleziona($query);

    if($result != "errore" && $result != "vuoto"){
        $bici = array();
        foreach($result as $elemento){
            $bici[] = $elemento;
        }
        echo json_encode($bici);
    }
}