function caricaInformazioni(){

    //prende tutto
    $.ajax({
        type: "POST",
        url: "../AJAX/getClienteInfo.php",
        success: function(response){
            response.forEach(gestisciCaricamenti);
        }
    });
}

function gestisciCaricamenti(elemento){
    caricaNomeCognome(elemento["nome"], elemento["cognome"]);
    caricaEmailPswCarta(elemento["email"], elemento["num_carta_credito"]);
    caricaIndirizzo(elemento["via"], elemento["citta"], elemento["cap"], elemento["num_civico"]);
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