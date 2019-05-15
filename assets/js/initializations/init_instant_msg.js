function sendMessage(type){ // 1 Write, 2 Reply, 
    var msgData = (type==1) ? $('#sendMsgForm').serialize() : $('#replyMsgForm').serialize();
    swal({
        title: "Send Message?",
        text: "Click send to proceed and Cancel to close.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Send Now!",
        closeOnConfirm: false,
        confirmButtonColor: "#f77506",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url + "mail/send_message",
            type: "POST",
            data: msgData,
            success: function(res){
                if(res==1){
                    $('#replyMsg').modal('hide'); 
                    $('#writeMsg').modal('hide');
                    $('#instMsg').modal('hide');
                    swal('Message Sent!', 'Message was successfully sent to the user.', 'success');
                } else{
                    swal('Failed!', 'A problem occured please try again.', 'error');
                }
            }
        }); 
    });
}