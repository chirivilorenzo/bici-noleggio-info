<html>
    <head>
        <title>Riepilogo Cliente</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="../../CSS/style_riepilogo.css">
        <script>
            $("document").ready(function(){
                $("#back").click(function(){
                    window.location.href = "../../HTML/Cliente/menuCliente.html";
                });
            });
        </script>
    </head>
    <body>
    <div class="container">
        <div class="table-container">
            <?php
            include("../classi/CDatabase.php");

            if(!isset($_SESSION)) session_start();

            if(isset($_SESSION["idCliente"])){
                $classeDB = new CDatabase();
                $classeDB->connessione();

                $tabella = "<table><th>Tipo</th><th>Data e ora</th><th>Distanza percorsa</th>";
                $result = $classeDB->seleziona("SELECT * FROM operazione WHERE idCliente = ?", $_SESSION["idCliente"]);
                if($result == "vuoto"){
                    echo "Nessuna operazione per questo utente";
                }
                else{
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
            }
            else{
                header("Location: ../../HTML/index.html");
            }
            ?>
        </div>
        <div class="button-container">
            <button id="back">Indietro</button>
        </div>
    </div>
</body>
</html>
</html>