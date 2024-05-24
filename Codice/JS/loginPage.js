function loginCliente() {
    let email = $("#email").val();
    let password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "../../AJAX/loginCliente.php",
        data: { email: email, password: password },
        success: function(response) {
            if (response["status"] === "success") {
                window.location.href = "../../HTML/Cliente/menuCliente.html";
            } else if (response["status"] === "error") {
                alert(response["code"] + ": " + response["message"]);
            } else {
                alert("Si è verificato un errore inaspettato.");
            }
        },
        error: function(xhr, status, error) {
            if (xhr.status === 404) {
                alert("Errore " + xhr.status + ": " + xhr.responseText);
            } else if (xhr.status === 400) {
                alert("Errore " + xhr.status + ": Parametri mancanti.");
            } else if (xhr.status === 405) {
                alert("Errore " + xhr.status + ": Metodo HTTP non consentito.");
            } else if (xhr.status === 500) {
                alert("Errore " + xhr.status + ": Errore generale del server.");
            } else {
                alert("Errore " + xhr.status + ": " + xhr.statusText);
            }
        }
    }).fail(function() {
        alert("Errore di connessione. Riprova.");
    });
}


function loginAdmin() {
    let email = $("#email").val();
    let password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "../../AJAX/loginAdmin.php",
        data: { email: email, password: password },
        success: function(response) {
            if (response["status"] === "success") {
                window.location.href = "../../HTML/Admin/menuAdmin.html";
            } else if (response["status"] === "error") {
                alert(response["code"] + ": " + response["message"]);
            } else {
                alert("Si è verificato un errore inaspettato.");
            }
        },
        error: function(xhr, status, error) {
            if (xhr.status === 404) {
                alert("Errore " + xhr.status + ": " + xhr.responseText);
            } else if (xhr.status === 400) {
                alert("Errore " + xhr.status + ": Parametri mancanti.");
            } else if (xhr.status === 405) {
                alert("Errore " + xhr.status + ": Metodo HTTP non consentito.");
            } else if (xhr.status === 500) {
                alert("Errore " + xhr.status + ": Errore generale del server.");
            } else {
                alert("Errore " + xhr.status + ": " + xhr.statusText);
            }
        }
    }).fail(function() {
        alert("Errore di connessione. Riprova.");
    });
}
