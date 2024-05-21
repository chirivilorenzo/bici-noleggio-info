<?php
include("classi/CDatabase.php");

if(!isset($_SESSION)) session_start();

if(isset($_SESSION["idCliente"])){
    $classeDB = new CDatabase();
    $classeDB->connessione();

    $tabella = "<table><th>tipo</th><th>data e ora</th><th>distanza percorsa</th>";
    $result = $classeDB->seleziona("SELECT * FROM operazione WHERE idCliente = ?", $_SESSION["idCliente"]);
    foreach($result as $operazione){
        if($operazione["distanza_percorsa"] == null) $operazione["distanza_percorsa"] = "NULL";
        $tabella .= "<tr>";
        $tabella .= "<td>" . $operazione["tipo"] . "</td>";
        $tabella .= "<td>" . $operazione["data_ora"] . "</td>";
        $tabella .= "<td>" . $operazione["distanza_percorsa"] . "</td>";
        $tabella .= "</tr>";
    }

    $tabella .= "</table>";
    echo $tabella;
}
else{
    header("Location: ../HTML/index.html");
}
?>

<html>
    <head>
        <title>Riepilogo Cliente</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="../JS/logout.js"></script>
        <script>
            $("document").ready(function(){
                $("#logout").click(function(){
                    if (confirm("Sei sicuro di voler effettuare il logout?"))
                        logout();
                });

                $("#back").click(function(){
                    window.location.href = "../HTML/menuCliente.html";
                });
            });
        </script>
    </head>
    <body>
        <button id="back">Indietro</button>
        <button id="logout">Logout</button>
    </body>
</html>