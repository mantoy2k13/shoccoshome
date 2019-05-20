$('#welcomeModal').modal({
    backdrop: 'static',
    keyboard: false
});

function compLater(){
    $.ajax({ url: base_url + "account/compLater/",
        success: function(res){
            if(res){
                $('#welcomeModal').modal('hide');
            }
        }
    }); 
}