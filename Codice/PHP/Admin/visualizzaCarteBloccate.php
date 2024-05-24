<html>
    <head>
        <title>Riepilogo Cliente</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="../../CSS/style_riepilogo.css">
        <script>
            $("document").ready(function(){
                $("#back").click(function(){
                    window.location.href = "../../HTML/Admin/menuAdmin.html";
                });
            });

            function generaNuovoRFID(idCliente) {
                $.post("../../AJAX/generaNuovoRfid.php", { idCliente: idCliente }, function(response) {
                    if (response.status === "success") {
                        alert("Numero tessera aggiornato con successo: " + response.num_tessera);
                        location.reload(); 
                    } else {
                        alert("Errore: " + response.message);
                    }
                }, "json").fail(function(jqXHR, textStatus, errorThrown) {
                    alert("Errore nella richiesta AJAX: " + textStatus + " - " + errorThrown);
                });
            }

        </script>
    </head>
    <body>
    <div class="container">
        <div class="table-container">
            <?php
            include("../classi/CDatabase.php");

            if(!isset($_SESSION)) session_start();

            if(isset($_SESSION["idAdmin"])){
                $classeDB = new CDatabase();
                $classeDB->connessione();

                $tabella = "<table><th>ID</th><th>Nome</th><th>Cognome</th><th>Email</th><th>Bottone rigenera</th>";
                $result = $classeDB->seleziona("SELECT * FROM cliente WHERE num_tessera = ''" );
                if($result == "vuoto"){
                    echo "Nessun utente ha bloccato la tessera RFID";
                }
                else{
                    foreach($result as $cliente){
                        $tabella .= "<tr>";
                        $tabella .= "<td>" . $cliente["ID"] . "</td>";
                        $tabella .= "<td>" . $cliente["nome"] . "</td>";
                        $tabella .= "<td>" . $cliente["cognome"] . "</td>";
                        $tabella .= "<td>" . $cliente["email"] . "</td>";
                        $tabella .= "<td><button onclick='generaNuovoRFID({$cliente["ID"]})'>Rigenera</button></td>";
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