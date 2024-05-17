<?php

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

date_default_timezone_set('Europe/Rome');

function aggiorna($classeDB, $query, $param){
    return $classeDB->aggiorna($query, $param);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["idStazione"]) && isset($_POST["idBici"]) && isset($_POST["idCliente"])) {

        $classeDB = new CDatabase();
        $classeDB->connessione();

        $idStazione = $_POST["idStazione"];
        $idBici = $_POST["idBici"];
        $idCliente = $_POST["idCliente"];

        try {
            // Inizia la transazione
            $classeDB->iniziaTransazione();

            // Verifica il numero di bici disponibili in quella stazione
            $query = "SELECT num_bici_disp FROM stazione WHERE ID = ?";
            $result = $classeDB->seleziona($query, $idStazione);

            if ($result && $result[0]["num_bici_disp"] > 0) {
                // Aggiorna il numero di bici disponibili nella stazione
                if (!aggiorna($classeDB, "UPDATE stazione SET num_bici_disp = num_bici_disp - 1 WHERE ID = ?", $idStazione)) {
                    throw new Exception("Errore nell'aggiornare le bici disponibili nella stazione");
                }

                // Aggiorna il flag di disponibilità della bici
                if (!aggiorna($classeDB, "UPDATE bici SET disponibile = False WHERE ID = ?", $idBici)) {
                    throw new Exception("Errore nell'aggiornare il flag nella bici");
                }

                // Inserisce il noleggio nella tabella operazione
                $query = "INSERT INTO operazione (tipo, data_ora, idCliente, idBici, idStazione) VALUES (?, ?, ?, ?, ?)";
                $dataOra = (new DateTime())->format('Y-m-d H:i:s');

                if (!$classeDB->inserisci($query, "noleggio", $dataOra, $idCliente, $idBici, $idStazione)) {
                    throw new Exception("Errore nell'inserimento dell'operazione");
                }

                // Commit della transazione
                $classeDB->commit();
                echo json_encode(array("status" => "success", "code" => 200, "message"=> "gg"));
            } else {
                throw new Exception("Le bici nella stazione sono esaurite o la stazione non esiste", 404);
            }
        } catch (Exception $e) {
            // Rollback della transazione
            $classeDB->rollback();
            $code = $e->getCode() ?: 500;
            http_response_code($code);
            echo json_encode(array("status" => "error", "code" => $code, "message" => $e->getMessage()));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "error", "code" => 400, "message" => "Manca una o più variabili"));
    }
} else {
    http_response_code(405);
    echo json_encode(array("status" => "error", "code" => 405, "message" => "Method Not Allowed"));
}
