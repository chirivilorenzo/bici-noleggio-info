<?php
//genera un nuovo rfid per l'utente che ha bloccato la sua carta
//richiamata da HTML/Admin/visualizzaCarteBloccate.php

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!isset($_SESSION)) session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["idCliente"])) {
        $idCliente = $_POST["idCliente"];
        
        $classeDB = new CDatabase();
        $classeDB->connessione();
        $numTesseraNuova = generateRandomString();

        $query = "UPDATE cliente SET num_tessera = ? WHERE ID = ?";

        if ($classeDB->aggiorna($query, $numTesseraNuova, $idCliente)) {
            echo json_encode(array("status" => "success", "message" => "Numero tessera aggiornato con successo", "num_tessera" => $numTesseraNuova));
        } else {
            echo json_encode(array("status" => "error", "message" => "Errore durante l'aggiornamento del numero tessera."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "ID cliente non fornito."));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Metodo di richiesta non supportato."));
}
