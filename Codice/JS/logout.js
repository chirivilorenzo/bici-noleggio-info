function logout() {
    $.post("../AJAX/logout.php", {}, function(data) {
        if(data.success){
            window.location.href = "index.html";
        }
        else{
            alert("Errore durante il logout. Riprova.");
        }
    }).fail(function(){
        alert("Errore di connessione. Riprova.");
    });
}