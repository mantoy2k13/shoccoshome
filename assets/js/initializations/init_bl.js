$(document).ready(function() {
    $('#datatable').DataTable( {
        order: [[ 0, 'desc' ]]
    } );
} );

var bookAppr = (bid, status, ut)=>{
    swal({
        title: (status==2) ? 'Cancel?' : ((status==3) ? 'Disapprove?' : ((status==4) ? 'Approve?' : ((status==5) ? 'Complete Booking?' : ((status==1) ? 'Mark as pending?' : 'No Command')))),
        text: (status==2) ? 'This booking will be cancelled. Continue?' : ((status==3) ? 'You are going to refuse or reject this booking. Continue?' : ((status==4) ? 'You are going to approve this booking. Continue?' : ((status==5) ? 'The booking process will be completed. Continue?' : ((status==1) ? 'This booking will be mark as pending again!':'')))),
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Continue",
        closeOnConfirm: false,
        confirmButtonColor: "#f77506",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url + "booking/booking_approvals/"+bid+'/'+status,
            success: function(res){
                if(res==1){
                    swal({title: (status==2) ? 'Cancelled' : ((status==3) ? 'Disapproved' : ((status==4) ? 'Approved' : ((status==5) ? 'Completed' : ((status==1) ? 'Mark as pending!' : 'No Command')))),
                        text: (status==2) ? 'Booking was cancelled!' : ((status==3) ? 'The booking was disapproved!' : ((status==4) ? 'The booking was successfully approved!' : ((status==5) ? 'The booking is now finally completed!' : ((status==1) ? 'Booking request was marked as pending!' : 'No command')))),
                        type: "success"}, function(){ 
                            if(status==3){
                                $('#instEmail').val($('#userEmail').val());
                                $('#instMailTo').val($('#userID').val());
                                $('#instMsgSubject').val('Reason for disapproving');
                                $('#instMsgContent').val('Dear Ma\'am/Sir,\n\nSorry for disapproving your request for now. \n\n[ State your reason here.. ]');
                                $('#booking_info').modal('hide');
                                $('#instMsg').modal('show')
                            } else if(status==4){
                                $('#instEmail').val($('#userEmail').val());
                                $('#instMailTo').val($('#userID').val());
                                $('#instMsgSubject').val('Booking Request Approved');
                                var appMsg = (ut=='guest') ? 'Dear Ma\'am/Sir,\n\nThank you for booking as a sitter for your pets. \n\n [ Write or modify this message.. ]' : 'Dear Ma\'am/Sir,\n\nThank you for booking as a sitter for my pets. \n\n [ Write or modify this message.. ]';
                                $('#instMsgContent').val(appMsg);
                                $('#booking_info').modal('hide');
                                $('#instMsg').modal('show');
                            } else{ location.reload(); }
                        });
                } else{
                    swal("Failed",'A problem occured please try again.', 'error');
                }
            }
        }); 
    });
}

var setMsg = (msg)=>{
    var setMsg = '';
    setMsg += '<div class="alert alert-danger f-15 alert-dismissible" role="alert">';
    setMsg += '<strong><i class="fa fa-times"></i> Oops!</strong> '+msg+'.';
    setMsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    setMsg += '<span aria-hidden="true">&times;</span>';
    setMsg += '</button>';
    setMsg += '</div>';
    return setMsg;
}