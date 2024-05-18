<?php

//prendere dal db tutte le info dell'utente e visualizzarle
//poi mettere delle input type per far modificare queste informazioni
//password mettere 2 input (psw vecchia e nuova)
//num carta visualizzare solo ultime 4 cifre (se è nel db)

//dividere le cose in diverse sezioni
//- sezione 1 -> nome e cognome
//- sezione 2 -> email, password e numero carta
//- sezione 3 -> dati dell'indirizzo

include("../PHP/classi/CDatabase.php");
header("Content-Type: application/json");

if (!isset($_SESSION)) session_start();

if (isset($_SESSION["idCliente"])){
    $classeDB = new CDatabase();
    $classeDB->connessione();

    //inserire le info del db dentro ai div



}
else{
    echo json_encode(array("status"=> "error", "code"=> 405, "message"=> "non puoi visualizzare questa pagina"));
}
?>

<html>
    <head>
        <title>Profilo utente</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </head>
    <body>
        <div id="sezione1"></div>
        <div id="sezione2"></div>
        <div id="sezione3"></div>
    </body>
</html>