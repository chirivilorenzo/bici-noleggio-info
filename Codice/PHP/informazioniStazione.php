<html>
    <head>
        <link rel="stylesheet" href="../CSS/style_informazioniStazione.css">
    </head>
    <body>
    <div class="container">
        <div class="table-container">
            <?php
            include("../PHP/classi/CDatabase.php");
            if(!isset($_SESSION)) session_start();

            if(isset($_GET["id"])){
                $id = $_GET["id"];

                //visualizza tutte le info di quella stazione
                $classeDB = new CDatabase();
                $classeDB->connessione();

                $query = "SELECT * FROM stazione WHERE ID = ?";
                $result = $classeDB->seleziona($query, $id);

                if($result != "errore" && $result != "vuoto"){
                    $stringa = "<table>
                    <th>Nome</th>
                    <th>Latitudine</th>
                    <th>Longitudine</th>
                    <th>bici disponibili</th>
                    <th>slot totali</th><tr>";
                    $stringa .= "<td>" . $result[0]["nome"] . "</td>";
                    $stringa .= "<td>" . $result[0]["latitudine"] . "</td>";
                    $stringa .= "<td>" . $result[0]["longitudine"] . "</td>";
                    $stringa .= "<td>" . $result[0]["num_bici_disp"] . "</td>";
                    $stringa .= "<td>" . $result[0]["num_slot_tot"] . "</td>";
                    $stringa .= "</tr></table>";
                    echo $stringa;
                }
            }
            else{
                echo "parametro get non valido o non trovato";
            }
            ?>
        </div>
        <div class="button-container">
            <?php
                if(isset($_SESSION["idCliente"])){
                    echo "<a href='../HTML/menuCliente.html'>Indietro</a>";
                }
                else{
                    echo "<a href='../HTML/index.html'>Indietro</a>";
                }
            ?>
        </div>
    </div>
</body>
</html>
</html>