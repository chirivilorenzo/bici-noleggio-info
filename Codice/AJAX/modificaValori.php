<?php

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if (!isset($_SESSION)) session_start();

if (isset($_SESSION["idCliente"])) {
    $idCliente = $_SESSION["idCliente"];
    $classeDB = new CDatabase();
    $classeDB->connessione();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];
            if ($classeDB->aggiorna("UPDATE cliente SET nome = ? WHERE ID = ?", $nome, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update nome."));
            }
        } else if (isset($_POST["cognome"])) {
            $cognome = $_POST["cognome"];
            if ($classeDB->aggiorna("UPDATE cliente SET cognome = ? WHERE ID = ?", $cognome, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update cognome."));
            }
        } else if (isset($_POST["email"])) {
            $email = $_POST["email"];
            if ($classeDB->aggiorna("UPDATE cliente SET email = ? WHERE ID = ?", $email, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update email."));
            }
        } else if (isset($_POST["pswVecchia"]) && isset($_POST["pswNuova"])) {
            $pswVecchia = $_POST["pswVecchia"];
            $pswNuova = $_POST["pswNuova"];

            if ($classeDB->seleziona("SELECT password FROM cliente WHERE ID = ?", $idCliente)[0]["password"] == $pswVecchia) {
                if ($classeDB->aggiorna("UPDATE cliente SET password = ? WHERE ID = ?", $pswNuova, $idCliente)) {
                    echo json_encode(array("status" => "success", "code" => 200));
                } else {
                    http_response_code(500);
                    echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update password."));
                }
            } else {
                http_response_code(403);
                echo json_encode(array("status" => "error", "code" => 403, "message" => "Old password is incorrect."));
            }
        } else if (isset($_POST["numCarta"])) {
            $numCarta = $_POST["numCarta"];
            if ($classeDB->aggiorna("UPDATE cliente SET num_carta_credito = ? WHERE ID = ?", $numCarta, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update numCarta."));
            }
        } else if (isset($_POST["via"])) {
            $via = $_POST["via"];
            if ($classeDB->aggiorna("UPDATE cliente as c JOIN indirizzo as i ON i.ID = c.idIndirizzo SET i.via = ? WHERE c.ID = ?", $via, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update via."));
            }
        } else if (isset($_POST["citta"])) {
            $citta = $_POST["citta"];
            if ($classeDB->aggiorna("UPDATE cliente as c JOIN indirizzo as i ON i.ID = c.idIndirizzo SET i.citta = ? WHERE c.ID = ?", $citta, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update citta."));
            }
        } else if (isset($_POST["cap"])) {
            $cap = $_POST["cap"];
            if ($classeDB->aggiorna("UPDATE cliente as c JOIN indirizzo as i ON i.ID = c.idIndirizzo SET i.cap = ? WHERE c.ID = ?", $cap, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update cap."));
            }
        } else if (isset($_POST["numCivico"])) {
            $numCivico = $_POST["numCivico"];
            if ($classeDB->aggiorna("UPDATE cliente as c JOIN indirizzo as i ON i.ID = c.idIndirizzo SET i.num_civico = ? WHERE c.ID = ?", $numCivico, $idCliente)) {
                echo json_encode(array("status" => "success", "code" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "error", "code" => 500, "message" => "Failed to update numCivico."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("status" => "error", "code" => 400, "message" => "No valid fields provided for update."));
        }
    } else {
        http_response_code(405);
        echo json_encode(array("status" => "error", "code" => 405, "message" => "Invalid request method."));
    }
} else {
    http_response_code(401);
    echo json_encode(array("status" => "error", "code" => 401, "message" => "User not authenticated."));
}
?>
