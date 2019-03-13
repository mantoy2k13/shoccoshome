$(document).ready(function(){
    var alertMsg = $('#getAlertval').val();
    if(alertMsg!=0){
        switch(alertMsg){
            case 'Sent':
                var title = "Message Sent!";
                var msg = "Message was sent successfully!";
                var type = 'success';
            break;
            case 'Updated':
                var title = "Updated!";
                var msg = "Message was updated successfully!";
                var type = 'success';
            break;
            case 'Error':
                var title = "Error!";
                var msg = "A problem occured. Please try again!";
                var type = 'warning';
            break;
        }

        setAlertMsg(title, msg, type);
    }

    writeMsg = (type)=> {
        if(!type){
            swal('Oops!', 'You cannot compose message if you have no friends in your list. You can search an user and send them messages directly. You can add them as a friend too.', 'warning');
        } else{
            $('#writeMsg').modal('show');
        }
    }
});

function setAlertMsg(title, msg, type){
    swal(title, msg, type);
}

function delMsg(mid, type){
    var mWrapper = $('.mail-wrapper').length;
    swal({
        title: "Delete Message?",
        text: "This message will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url + "mail/delete_message/"+mid+"/"+type,
            success: function(res){
                if(res){
                    $('#mailInbox'+mid).fadeOut(300, function(){ $(this).remove();});
                    $('#readMsg').modal('hide');
                    swal("Deleted!", "Your message was successfully deleted.", 'success');
                    if(mWrapper == 1){
                        $('#emptyMsg').html(''+
                            '<div class="row">'+
                                '<div class="col-md-12 m-t-10">'+
                                    '<div class="alert alert-warning f-15" role="alert">'+
                                        '<strong><i class="fa fa-check"></i> Empty!</strong> You have no new messages.'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                        );
                    }
                } else{
                    swal("Failed", "There was a problem deleting your message", 'warning');
                }
            }
        }); 
    });
}

function readMsg(mid,type){
    $.ajax({
        url: base_url + "mail/view_message/"+mid+"/"+type,
        dataType: 'json',
        success: function(res){
            if(res){
                $.ajax({ url: base_url + "mail/cntUnrMsg", 
                    success: function(cnt){
                        if(cnt!=0){
                            $('.mainCntM').html('<span class="badge bg-red">'+cnt+'</span>');
                            $('.mainCnt').html('<span class="badge bg-red cust-badge">'+cnt+'</span>');
                            $('.inbCnt').html('<span class="badge badge-danger cntFrndReq pull-right m-t-5">'+cnt+'</span>');
                        } else{
                            $('.mainCntM').html('');
                            $('.mainCnt').html('');
                            $('.inbCnt').html('');
                        }
                    }
                });

                if(res[0]['parent_id']){
                   $.ajax({ url: base_url + "mail/view_message/"+res[0]['parent_id']+"/"+type, 
                        dataType: 'json',
                        success: function(pRes){
                           if(pRes){
                               $('#msg-read-quote').html(''+
                                '<div class="row m-t-10">'+
                                    '<div class="col-md-12">'+
                                       '<div class="msg-quote">'+
                                            '<span class="pull-right"><i class="fa fa-quote-right"></i></span>'+
                                            '<label>'+pRes[0]['subject']+'</label>'+
                                            '<p class="date">'+dateFormat(new Date(pRes[0]['date_send']), "dd mmm yyyy, hh:MM TT")+'</p>'+
                                            '<p>'+pRes[0]['message']+'</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                               )
                           }
                        }
                    }); 
                }

                if(res[0]['is_read']==false){
                    $('#mailInbox'+mid).removeClass('active');
                    $('.readIcon'+mid).html('<i class="fa fa-envelope-open text-blue"></i>');
                }

                /* Set Buttons */
                $('#saveBtn').remove();
                $('#cancelBtn').remove();
                $('#editBtn').remove();
                $('#readForm').removeAttr('action');
                
                /* Set Values */
                $('#msgFrom').val(res[0]['fullname']+' ('+res[0]['email']+')');
                $('#msgDate').val(dateFormat(new Date(res[0]['date_send']), "dd mmm yyyy, hh:MM TT"));
                $('#msgSubject').val(res[0]['subject']);
                $('#msgContent').val(res[0]['message']);
                $('#drftBtn').attr('onClick','moveToDrafts('+mid+')');
                $('#modDelBtn').attr('onClick','delMsg('+mid+')');
                $('#replyBtn').attr('onClick','replyMsg('+mid+')');
                $('#readMsg').modal('show');
                $('#replyMsg').modal('hide');

            } else{
                swal("Failed", "There was a problem viewing your message", 'warning');
            }
        }
    });
}

function readMsg2(mid,type){
    $.ajax({
        url: base_url + "mail/view_message/"+mid+"/"+type,
        dataType: 'json',
        success: function(res){
            if(res){    
                if(res[0]['parent_id']){
                    $.ajax({ url: base_url + "mail/view_message/"+res[0]['parent_id']+"/"+type, 
                         dataType: 'json',
                         success: function(pRes){
                            if(pRes){
                                $('#msg-read-quote').html(''+
                                 '<div class="row m-t-10">'+
                                     '<div class="col-md-12">'+
                                        '<div class="msg-quote">'+
                                             '<span class="pull-right"><i class="fa fa-quote-right"></i></span>'+
                                             '<label>'+pRes[0]['subject']+'</label>'+
                                             '<p class="date">'+dateFormat(new Date(pRes[0]['date_send']), "dd mmm yyyy, hh:MM TT")+'</p>'+
                                             '<p>'+pRes[0]['message']+'</p>'+
                                         '</div>'+
                                     '</div>'+
                                 '</div>'
                                )
                            }
                         }
                     }); 
                }    
               
                if(type==2){
                    $('#saveBtn').hide();
                    $('#cancelBtn').hide();
                    $('#readForm').attr('action', base_url+'mail/update_message/'+mid);
                    $('#drftBtn').remove();
                    $('#replyBtn').remove();
                }

                if(type==3){
                    $('#drftBtn').remove();
                    $('#replyBtn').remove();
                    $('#saveBtn').remove();
                    $('#cancelBtn').remove();
                    $('#editBtn').remove();
                    $('#readForm').removeAttr('action');
                }
                
                /* Set Values */
                $('#editBtn').show();
                $('#modDelBtn').show();

                $('#msgFrom').val(res[0]['fullname']+' ('+res[0]['email']+')');
                $('#msgDate').val(dateFormat(new Date(res[0]['date_send']), "dd mmm yyyy, hh:MM TT"));
                $('#msgSubject').val(res[0]['subject']);
                $('#msgContent').val(res[0]['message']);
                $('#modDelBtn').attr('onClick','delMsg('+mid+')');
                $('#readMsg').modal('show');
            } else{
                swal("Failed", "There was a problem viewing your message", 'warning');
            }
        }
    });
}

function edit_msg(type){
    if(type==1){
        $('#saveBtn').show();
        $('#cancelBtn').show();
        $('#editBtn').hide();
        $('#modDelBtn').hide();

        $('#msgContent').removeAttr('readonly');
        $('#msgSubject').removeAttr('readonly');
    } else{
        $('#saveBtn').hide();
        $('#cancelBtn').hide();
        $('#editBtn').show();
        $('#modDelBtn').show();

        $('#msgContent').attr('readonly','true');
        $('#msgSubject').attr('readonly','true');
    }
}

function replyMsg(mid){
    $.ajax({
        url: base_url + "mail/view_message/"+mid+"/"+2,
        dataType: 'json',
        success: function(res){
            if(res){                
                $('#replyTo').val(res[0]['fullname']+' ('+res[0]['email']+')');
                $('#mail_to').val(res[0]['id']);
                $('#replySubject').val(res[0]['subject']);
                $('#replyContent').val(res[0]['message']);
                $('#parent_id').val(mid);
                $('#qSub').html(res[0]['subject']);
                $('#qContent').html(res[0]['message']);
                $('#qDate').html(dateFormat(new Date(res[0]['date_send']), "dd mmm yyyy, hh:MM TT"));
                $('#backBtn').attr('onClick','readMsg('+mid+')');
                $('#replyMsg').modal('show');
                $('#readMsg').modal('hide');
            } else{
                swal("Failed", "There was a problem viewing your message", 'warning');
            }
        }
    });
}

function moveToDrafts(mid){
    var mWrapper = $('.mail-wrapper').length;
    swal({
        title: "Move to Drafts?",
        text: "This message will moved to drafts.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, move it!",
        closeOnConfirm: false,
        confirmButtonColor: "#f77506",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url + "mail/move_to_drafts/"+mid,
            success: function(res){
                if(res){
                    $('#mailInbox'+mid).fadeOut(300, function(){ $(this).remove();});
                    swal("Moved!", "Your message was successfully moved to drafts.", 'success');
                    $('#readMsg').modal('hide');
                    if(mWrapper == 1){
                        $('#emptyMsg').html(''+
                            '<div class="row">'+
                                '<div class="col-md-12 m-t-10">'+
                                    '<div class="alert alert-warning f-15" role="alert">'+
                                        '<strong><i class="fa fa-check"></i> Empty!</strong> You have no new messages.'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                        );
                    }
                } else{
                    swal("Failed", "There was a problem deleting your message", 'warning');
                }
            }
        }); 
    });
}