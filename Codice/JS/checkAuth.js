function checkAuth(){
    $.ajax({
        url: "../../AJAX/checkAuth.php",
        type: 'POST',
        success: function(response){
            if(response["status"] != 'success'){
                window.location.href = "../../HTML/index.html";
            }
        },
        error: function(xhr, status, error){
            alert('Errore durante la richiesta AJAX:', error);
            window.location.href = "../../HTML/index.html";
        }
    });
}