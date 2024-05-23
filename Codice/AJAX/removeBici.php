<?php
//rimuove una certa bici dal db (tramite id in post)
//richiamata da HTML/Admin/modificaBici.html

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"])) {
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $id = $_POST["id"];

        $query = "DELETE FROM bici WHERE ID = ?";
        if ($classeDB->elimina($query, $id)) {
            echo json_encode(array("status" => "success", "code" => 200));
        } else {
            echo json_encode(array("status" => "error", "message" => "Errore durante l'esecuzione della query di eliminazione.", "code" => 500));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Parametro 'id' mancante.", "code" => 400));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Metodo di richiesta non valido.", "code" => 405));
}