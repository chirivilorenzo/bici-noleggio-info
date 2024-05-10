<?php
include("classi/CDatabase.php");
header("Content-Type: application/json");

if(!isset($_SESSION)) session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $query = "SELECT * FROM cliente WHERE email = ? AND password = ?";

        $classeDB = new CDatabase();
        $classeDB->connessione();
        
        $result = $classeDB->seleziona($query, $email, $password);

        if($result != "errore" && $result != "vuoto"){
            $_SESSION["idCliente"] = $result[0]["ID"];
            echo json_encode(array("status"=> "success", "code" => 200));
        }
        else if($result == "vuoto"){
            echo json_encode(array("status"=>"error", "code" => 404, "message"=> "Utente non trovato"));
        }
        else if($result == "errore"){
            echo json_encode(array("status"=> "error", "code" => 500, "message"=> "Errore nella selezione del db"));
        }
        else{
            echo json_encode(array("status"=> "error", "code" => 500, "message"=> "Errore generale"));
        }
    }
    else{
        echo json_encode(array("status"=> "error", "code" => 400, "message"=> "Parametri mancanti: email o password"));
    }
}
else{
    echo json_encode(array("status"=> "error", "code" => 405, "message"=> "Metodo HTTP non consentito"));
}
