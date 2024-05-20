function loginCliente(){

    let email = $("#email").val();
    let password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "../AJAX/loginCliente.php",
        data: {email: email, password: password},
        success: function(response){
            if(response["status"] == "success"){
                window.location.href = "../HTML/menuCliente.html";
            }
            else if(response["status"] == "error"){
                alert(response["code"] + ": " + response["message"]);
            }
            else{
                alert("si è verificato un errore inaspettato");
            }
        },
        error: function(xhr, status, error){
            // Gestione degli errori di comunicazione AJAX
            console.error("Errore AJAX:", status, error);
        }
    });
}

function loginAdmin(){

    let email = $("#email").val();
    let password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "../AJAX/loginAdmin.php",
        data: {email: email, password: password},
        success: function(response){
            if(response["status"] == "success"){
                window.location.href = "../HTML/paginaAdmin.html";
            }
            else if(response["status"] == "error"){
                alert(response["code"] + ": " + response["message"]);
            }
            else{
                alert("si è verificato un errore inaspettato");
            }
        },
        error: function(xhr, status, error){
            // Gestione degli errori di comunicazione AJAX
            console.error("Errore AJAX:", status, error);
        }
    });
}