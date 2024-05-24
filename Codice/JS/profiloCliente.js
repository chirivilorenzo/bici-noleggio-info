$("document").ready(function(){

    $("#nome").click(function(){
        modificaNome();
    });

    $("#cognome").click(function(){
        modificaCognome();
    });

    $("#email").click(function(){
        modificaEmail();
    });

    $("#password").click(function(){
        modificaPassword();
    });

    $("#numCarta").click(function(){
        modificaNumCarta();
    });
    
    $("#via").click(function(){
        modificaVia();
    });

    $("#citta").click(function(){
        modificaCitta();
    });

    $("#cap").click(function(){
        modificaCap();
    });

    $("#numCivico").click(function(){
        modificaNumCivico();
    });

    $("#bloccaCarta").click(function(){
        bloccaCarta();
    });

    function mostraSezione(sezioneId) {
        $(".sezione").hide(); // Nascondi tutte le sezioni
        $(sezioneId).show();  // Mostra la sezione selezionata
    }

    $("#sezione1").show();

    // Gestione dei click sui pulsanti di navigazione
    $("#btn-sezione1").click(function() {
        mostraSezione("#sezione1");
    });
    $("#btn-sezione2").click(function() {
        mostraSezione("#sezione2");
    });
    $("#btn-sezione3").click(function() {
        mostraSezione("#sezione3");
    });
    $("#btn-sezione4").click(function() {
        mostraSezione("#sezione4");
    });

    caricaInformazioni();

    // Funzione per svuotare i campi di input
    function svuotaInput() {
        $('input[type="text"], input[type="password"]').val('');
    }

    function modificaNome(){
        let nome = $("#input-nome").val();

        $.post("../../AJAX/modificaValori.php", {nome: nome}, function(data){
            if(data["status"] == "success"){
                alert("nome modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaCognome(){
        let cognome = $("#input-cognome").val();

        $.post("../../AJAX/modificaValori.php", {cognome: cognome}, function(data){
            if(data["status"] == "success"){
                alert("cognome modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaEmail(){
        let email = $("#input-email").val();

        $.post("../../AJAX/modificaValori.php", {email: email}, function(data){
            if(data["status"] == "success"){
                alert("email modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaPassword(){
        let pswVecchia = $("#db-password").val();
        let pswNuova = $("#input-password").val();

        $.post("../../AJAX/modificaValori.php", {pswVecchia: pswVecchia, pswNuova: pswNuova}, function(data){
            if(data["status"] == "success"){
                alert("password modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaNumCarta(){
        let numCarta = $("#input-numCarta").val();

        $.post("../../AJAX/modificaValori.php", {numCarta: numCarta}, function(data){
            if(data["status"] == "success"){
                alert("numero carta modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaVia(){
        let via = $("#input-via").val();

        $.post("../../AJAX/modificaValori.php", {via: via}, function(data){
            if(data["status"] == "success"){
                alert("via modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaCitta(){
        let citta = $("#input-citta").val();

        $.post("../../AJAX/modificaValori.php", {citta: citta}, function(data){
            if(data["status"] == "success"){
                alert("citta modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaCap(){
        let cap = $("#input-cap").val();

        $.post("../../AJAX/modificaValori.php", {cap: cap}, function(data){
            if(data["status"] == "success"){
                alert("cap modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function modificaNumCivico(){
        let numCivico = $("#input-numCivico").val();

        $.post("../../AJAX/modificaValori.php", {numCivico: numCivico}, function(data){
            if(data["status"] == "success"){
                alert("numero civico modificato con successo");
                caricaInformazioni();
                svuotaInput(); // Svuota i campi di input
            }
        });
    }

    function caricaInformazioni(){
        //prende tutto
        $.ajax({
            type: "POST",
            url: "../../AJAX/getClienteInfo.php",
            success: function(response){
                response.forEach(gestisciCaricamenti);
            }
        });
    }

    function gestisciCaricamenti(elemento){
        caricaNomeCognome(elemento["nome"], elemento["cognome"]);
        caricaEmailPswCarta(elemento["email"], elemento["num_carta_credito"]);
        caricaIndirizzo(elemento["via"], elemento["citta"], elemento["cap"], elemento["num_civico"]);
        caricaRFID(elemento["num_tessera"]);
    }

    function caricaNomeCognome(nome, cognome){
        $("#db-nome").text(nome);
        $("#db-cognome").text(cognome);
    }

    function caricaEmailPswCarta(email, numCarta){
        $("#db-email").text(email);

        if(numCarta == null){
            $("#db-numCarta").text("Nessuna carta salvata");
        }
        else{
            $("#db-numCarta").text(numCarta);
        }
    }

    function caricaIndirizzo(via, citta, cap, num_civico){
        $("#db-via").text(via);
        $("#db-citta").text(citta);
        $("#db-cap").text(cap);
        $("#db-numCivico").text(num_civico);
    }

    function caricaRFID(numRFID){
        if(numRFID == ""){
            $("#db-cartaRFID").text("carta già bloccata. L'admin provvederà a generarti un nuovo RFID e inviarti la carta");
        }
        else{
            $("#db-cartaRFID").text("Tessera attiva");
        }
    }

    function bloccaCarta(){
        if($("#db-cartaRFID").text() == "Tessera attiva"){
            $.post("../../AJAX/bloccaCarta.php", {}, function(data) {
                if(data["status"] == "success"){
                    alert("carta bloccata con successo. L'admin provvederà a fornirtene una nuova");
                    location.reload();
                }
                else{
                    alert("Errore durante la richiesta. Riprova.");
                }
            }).fail(function(){
                alert("Errore di connessione. Riprova.");
            });
        }
        else{
            alert("carta già bloccata");
        }
    }
});
