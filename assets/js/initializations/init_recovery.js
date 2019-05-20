var base_url = $('#base_url').val();

var recoverPassword=()=>{
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    var email = $('#recovery_email').val();
    if(email){
        $.ajax({
            url: base_url+'account/send_password_recovery',
            type: 'POST',
            data: { email:email },
            success: (res)=>{
                if(res==1){
                    $('#error-msg').html(''+
                        '<div class="log-alert log-success">'+
                            '<strong><i class="fa fa-check"></i> Email Sent! </strong> Please check your email for new password.'+
                        '</div>'
                    ); 
                    $('#mLoader').html('');

                } else{
                    $('#error-msg').html(''+
                        '<div class="log-alert log-danger">'+
                            '<strong><i class="fa fa-times"></i> Oops! </strong> Email address not found.'+
                            '<span class="closebtn" onclick="$(this).parent().remove()">×</span>'+
                        '</div>'
                    ); 
                    $('#mLoader').html('');
                }
            }
        });
    }else{
        $('#error-msg').html(''+
            '<div class="log-alert log-danger">'+
                '<strong><i class="fa fa-times"></i> Oops! </strong> Please enter email address.'+
                '<span class="closebtn" onclick="$(this).parent().remove()">×</span>'+
            '</div>'
        ); 
        $('#mLoader').html('');
    }
}