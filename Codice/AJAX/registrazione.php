<?php
include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["via"]) && isset($_POST["citta"]) && isset($_POST["cap"]) && isset($_POST["num_civico"])) {

        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        $via = $_POST["via"];
        $citta = $_POST["citta"];
        $cap = $_POST["cap"];
        $num_civico = $_POST["num_civico"];

        $classeDB = new CDatabase();
        $classeDB->connessione();

        // Creazione numero tessera
        $num_tessera = md5($email . $password);
        $num_tessera = substr($num_tessera, 0, 8);

        try {
            $classeDB->iniziaTransazione();

            // Controllo se l'indirizzo esiste già
            $query = "SELECT * FROM indirizzo WHERE via = ? AND citta = ? AND cap = ? AND num_civico = ?";
            $result = $classeDB->seleziona($query, $via, $citta, $cap, $num_civico);

            if ($result != "errore" && $result != "vuoto") {
                $idIndirizzo = $result[0]["ID"];
            } else if ($result == "vuoto") {
                // Indirizzo non esiste, quindi lo aggiungiamo
                $query = "INSERT INTO indirizzo (via, citta, cap, num_civico) VALUES (?, ?, ?, ?)";
                if (!$classeDB->inserisci($query, $via, $citta, $cap, $num_civico)) {
                    throw new Exception("Errore nell'inserimento dell'indirizzo nel db");
                }
                $idIndirizzo = $classeDB->getLastID();
            } else {
                throw new Exception("Errore nella selezione dell'indirizzo dal db");
            }

            // Inserimento cliente
            $query = "INSERT INTO cliente (nome, cognome, email, password, num_tessera, idIndirizzo) VALUES (?, ?, ?, ?, ?, ?)";
            if (!$classeDB->inserisci($query, $nome, $cognome, $email, $password, $num_tessera, $idIndirizzo)) {
                throw new Exception("Errore nell'inserimento del cliente nel db");
            }

            $classeDB->commit();
            echo json_encode(array("status" => "success", "code" => 200));

        } catch (Exception $e) {
            $classeDB->rollback();
            http_response_code(500);
            echo json_encode(array("status" => "error", "code" => 500, "message" => $e->getMessage()));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "error", "code" => 400, "message" => "Parametri mancanti"));
    }
} else {
    http_response_code(405);
    echo json_encode(array("status" => "error", "code" => 405, "message" => "Metodo HTTP non consentito"));
}
