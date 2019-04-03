$(document).ready(function() {
    $('#datatable').DataTable( {
        order: [[ 0, 'desc' ]]
    } );
} );

var bookAppr = (bid, status,ut)=>{
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
            url: base_url + "booking/bookng_approvals/"+bid+'/'+status,
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

var bookingInfo=(bid, type, bStatus)=>{
    $('.myPets').html('');
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    $.ajax({
        url: base_url + "booking/get_booking_info/"+bid+'/'+type,
        dataType: "JSON",
        success: function(res){
            if(res){
                console.log(res)
                var pet_list = JSON.parse(res['pet_list']);
                var bdf = JSON.parse(res['book_date_from']);
                var bdt = JSON.parse(res['book_date_to']);

                //Image, Address and User Fullname
                if(res['user_img']){ $('#userImg').attr('src', base_url+'assets/img/pictures/usr'+res['id']+'/'+res['user_img']);
                }else{ $('#userImg').attr('src', base_url+'assets/img/pictures/default.png'); }
                $('#userName').html(res['fullname']);
                $('#userAdd').html(res['street']+' '+res['city']+', '+res['zip_code']+', '+res['state']+', '+res['country']);

                //Date and message
                $('#dateBooked').html('Date Booked: '+dateFormat(new Date(res['book_date']), "dd mmm yyyy, hh:MM TT"));
                $('#dateFrom').val(bdf[0]); $('#dateTo').val(bdt[0]);
                $('#timeStart').val(bdf[1]); $('#timeEnd').val(bdt[1]);
                $('#sMsg').val(res['message']);

                //Book Status
                $('#bookStatus').html((res['book_status']==1) ? '<span class="badge f-12 bg-orange text-white"><i class="fa fa-history"></i> Waiting for approval</span>' : ((res['book_status']==2) ? '<span class="badge f-12 badge-danger"><i class="fa fa-times"></i> Cancelled</span>' : ((res['book_status']==3) ? '<span class="badge f-12 badge-danger"><i class="fa fa-thumbs-down"></i> Disapproved</span>' : ((res['book_status']==4) ? '<span class="badge f-12 badge-info"><i class="fa fa-thumbs-up"></i> Approve</span>' : ((res['book_status']==5) ? '<span class="badge f-12 badge-success"><i class="fa fa-check"></i> Completed</span>' : '')))));
                // Pet Data
                if((pet_list.length)!=0){
                    var ci=0;
                    $.each(pet_list, (index, pid)=> {
                        $.ajax({
                            url: base_url+'pet/get_pet_details_ajax/'+pid,
                            dataType: 'JSON',
                            success: (p)=>{
                                if(p.length!=0){
                                    $.each(p, (ind, pd)=> {
                                        var imgPet = (pd['primary_pic']) ? '<img src="'+base_url+'assets/img/pictures/usr'+pd['user_id']+'/'+pd['primary_pic']+'" alt="Pet Image">' : '<img src="'+base_url+'assets/img/pictures/default_pet.png" alt="Pet Image">';
                                        $('.myPets').append('<div class="col-md-4">'+
                                            '<div class="card bg-grey friend-card">'+
                                                '<div class="card-body">'+
                                                    '<div class="pet-bio-img">'+imgPet+
                                                    '</div>'+
                                                    '<p class="text-blue f-20 b-700"><a href="'+base_url+'pet/pet_details/'+pd['pet_id']+'" target="_blank">'+pd['pet_name']+'</a> </p>'+
                                                    '<p class="b-700 f-14">Breed: <span class="b-700 text-black">'+pd['breed_name']+'</span></p>'+
                                                    '<p class="b-700 f-14">Cat: <span class="b-700 text-black">'+pd['cat_name']+'</span></p>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>')
                                    });
                                } else{
                                    $('.myPets').html('<div class="col-md-12">'+
                                        '<div class="alert alert-info">'+
                                            '<strong><i class="fa fa-check"></i> Empty!</strong> There are no pets found. Maybe user removed all the pets.'+
                                        '</div>'+
                                    '</div>');
                                }
                            }
                        });
                    ci++; });
                } else{
                    $('.myPets').append('<div class="col-md-12">'+
                        '<div class="alert alert-info">'+
                            '<strong>Empty!</strong> There are no pets found.'+
                        '</div>'+
                    '</div>');
                }

                // Buttons
                if(bStatus==1 && type==1){
                    $('#bookFooterButton').html(''+
                        '<button onclick="bookAppr('+bid+', 2)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Cancel Booking</button>'+
                        '<button onclick="editBookingInfo('+bid+', \''+res['user_type']+'\')" type="button" class="btn btn-info btn-sm"><i class="fa fa-pen"></i> Edit Booking</button>'
                    );
                } 

                if(bStatus==1 && type==2){
                    $('#bookFooterButton').html(''+
                        '<button onclick="bookAppr('+bid+', 4)" type="button" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i> Approve</button>'+
                        '<button onclick="bookAppr('+bid+', 3)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i> Disapprove</button>'
                    );
                } 

                if(bStatus==3 && type==2){
                    $('#bookFooterButton').html(''+
                        '<button onclick="bookAppr('+bid+', 1)" type="button" class="btn btn-success btn-sm"><i class="fa fa-history"></i> Mark as pending</button>'
                    );
                } 

                if(bStatus==4 && type==1){
                    $('#bookFooterButton').html(''+
                        '<button onclick="bookAppr('+bid+', 5)" type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Complete Booking</button>'+
                        '<button onclick="editBookingInfo('+bid+', \''+res['user_type']+'\')" type="button" class="btn btn-info btn-sm"><i class="fa fa-pen"></i> Edit Booking</button>'
                    );
                } 

                if(bStatus==4 && type==2){
                    $('#bookFooterButton').html(''+
                        '<button onclick="bookAppr('+bid+', 5)" type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Complete Booking</button>'
                    );
                } 

                if(bStatus==2 || bStatus==5 || (bStatus==5 && type==1)){
                    $('#bookFooterButton').html(''+
                        '<button data-dismiss="modal" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Close</button>'
                    );
                } 

                $('#mLoader').html('');
                $('#booking_info').modal('show');
            } else{
                swal("Failed",'A problem occured please try again.', 'error');
            }
        }
    }); 
}

var editBookingInfo=(bid, type)=>{
    var t = (type=='guest') ? 1 : 2;
    $('#booking_info').modal('hide');
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    $.ajax({
        url: base_url + "booking/get_booking_info/"+bid+'/'+t,
        dataType: "JSON",
        success: function(res){
            console.log(res)
            if(res){
                if(t==1){
                    var pet_list = JSON.parse(res['pet_list']);
                    var bdf = JSON.parse(res['book_date_from']);
                    var bdt = JSON.parse(res['book_date_to']);
                    var ad = JSON.parse(res['sitter_availability']);

                    $('#bookToWrapper').html(''+
                        '<div class="col-lg-6 col-md-6 col-sm-12">'+
                            '<label for="bookTo">Book To: </label>'+
                            '<input type="text" class="form-control" value="'+res['fullname']+'" id="bookTo" disabled>'+
                        '</div>'+
                        '<div class="col-lg-3 col-md-6 col-sm-12">'+
                            '<label for="aDateFrom">Available From: </label>'+
                            '<input type="date" class="form-control" value="'+ad[0]+'" disabled>'+
                        '</div>'+
                        '<div class="col-lg-3 col-md-6 col-sm-12">'+
                            '<label for="aDateTo">Available To: </label>'+
                            '<input type="date" class="form-control" value="'+ad[1]+'" disabled>'+
                        '</div>'
                    );

                    $('#editdateFrom').val(bdf[0]); $('#editdateTo').val(bdt[0]);
                    $('#edittimeStart').val(bdf[1]); $('#edittimeEnd').val(bdt[1]);
                    $('#editsMsg').val(res['message']);
                    var uid = (res['user_type']=='guest') ? res['user_id'] : res['book_user_id'];
                    var lblTxt = (res['user_type']=='guest') ? 'Choose your pet from pet list' : 'Choose Pets';
                    $.ajax({
                        url: base_url + "booking/get_user_pets_ajax/"+uid,
                        dataType: "JSON",
                        success: function(pets){
                            var opt = '', sel;
                            if(pets){
                            $.each(pets, (ind, pd)=> {
                                    sel = (pet_list.includes(pd['pet_id'].toString())) ? 'selected' : '';
                                    opt+='<option value="'+pd['pet_id']+'" '+sel+'>'+pd['pet_name']+' ('+pd['cat_name']+')</option>';
                                }); 
                            } else{
                                opt+='<option value="">No pets available </option>';
                            }
                            
                            $('#pet_list_info').html(''+
                                '<label for="pet_list" id="lblTxt">'+lblTxt+'</label>'+
                                '<select id="editpetList" name="pet_list[]" class="multipleSelect form-control" multiple>'+opt+'</select>'
                            );
                            $('.multipleSelect').fastselect();
                        }
                    });
                    
                    $('#saveBtnBook').attr('onclick', 'checkDateTime('+bid+', 1)');
                    $('#mLoader').html('');
                    $('#edit_booking_info').modal('show');
                } else{
                    var pl = JSON.parse(res['pet_list']);
                    var bdf = JSON.parse(res['book_date_from']);
                    var bdt = JSON.parse(res['book_date_to']);
                    $.ajax({
                        url: base_url + "booking/get_single_pet_ajax/"+pl[0],
                        dataType: "JSON",
                        success: function(ps){
                            ndf = JSON.parse(ps['ns_date_from']);
                            ndt = JSON.parse(ps['ns_date_to']);
                            $('#bookToWrapper').html(''+
                                '<div class="col-lg-12">'+
                                    '<label for="bookTo">Book To: </label>'+
                                    '<input type="text" class="form-control" value="'+res['fullname']+'" disabled>'+
                                '</div>'+
                                '<div class="col-lg-3 col-md-6 col-sm-12 m-t-10">'+
                                    '<label for="aDateFrom">Available From: </label>'+
                                    '<input type="date" class="form-control" value="'+ndf[0]+'" disabled>'+
                                '</div>'+
                                '<div class="col-lg-3 col-md-6 col-sm-12 m-t-10">'+
                                    '<label for="aDateFrom">Time Start: </label>'+
                                    '<input type="time" class="form-control" value="'+ndf[1]+'" disabled>'+
                                '</div>'+
                                '<div class="col-lg-3 col-md-6 col-sm-12 m-t-10">'+
                                    '<label for="aDateTo">Available To: </label>'+
                                    '<input type="date" class="form-control" value="'+ndt[0]+'" disabled>'+
                                '</div>'+
                                '<div class="col-lg-3 col-md-6 col-sm-12 m-t-10">'+
                                    '<label for="aDateFrom">Time End: </label>'+
                                    '<input type="time" class="form-control" value="'+ndt[1]+'" disabled>'+
                                '</div>'
                            );
                            $('#editdateFrom').val(bdf[0]); $('#editdateTo').val(bdt[0]);
                            $('#edittimeStart').val(bdf[1]); $('#edittimeEnd').val(bdt[1]);
                            $('#editsMsg').val(res['message']);
                            var uid = (res['user_type']=='guest') ? res['user_id'] : res['book_user_id'];
                            var lblTxt = (res['user_type']=='guest') ? 'Choose your pet from pet list' : 'Choose Pets';
                            $.ajax({
                                url: base_url + "booking/get_user_pets_ajax/"+uid,
                                dataType: "JSON",
                                success: function(pets){
                                    var opt = '', sel;
                                    if(pets){
                                    $.each(pets, (ind, pd)=> {
                                            sel = (pl.includes(pd['pet_id'].toString())) ? 'selected' : '';
                                            opt+='<option value="'+pd['pet_id']+'" '+sel+'>'+pd['pet_name']+' ('+pd['cat_name']+')</option>';
                                        }); 
                                    } else{
                                        opt+='<option value="">No pets available </option>';
                                    }
                                    
                                    $('#pet_list_info').html(''+
                                        '<label for="pet_list" id="lblTxt">'+lblTxt+'</label>'+
                                        '<select id="editpetList" name="pet_list[]" class="multipleSelect form-control" multiple>'+opt+'</select>'
                                    );
                                    $('.multipleSelect').fastselect();
                                }
                            });
                            
                            $('#saveBtnBook').attr('onclick', 'checkDateTime('+bid+', 2)');
                            $('#mLoader').html('');
                            $('#edit_booking_info').modal('show');
                        }   
                    });
                }
            }
        }
    });
}

var checkDateTime = (bid, type)=>{
    var curr_date   = $('#curr_date').val();
    var date_from   = $('#editdateFrom').val();
    var date_to     = $('#editdateTo').val();
    var time_start  = $('#edittimeStart').val();
    var time_end    = $('#edittimeEnd').val();
    var editpetList = $('#editpetList').val();
    var odf         = $('#aDateFrom').val();
    var odt         = $('#aDateTo').val();

    if(date_from && date_to && time_start && time_end && editpetList){
        var date_today = new Date(curr_date);
        var given_date_from = new Date(date_from);
        var given_date_to = new Date(date_to);
        var origDateFrom = new Date(odf);
        var origDateTo = new Date(odt);

        if(given_date_from < date_today){
            $('.setTimeMsg').html(setMsg('Date From must be equal or greater than the date today'));
            $('#editdateFrom').focus();
        } else if(given_date_to < date_today){
            $('.setTimeMsg').html(setMsg('Date To must be equal or greater than the date today'));
            $('#editdateTo').focus();
        } else if(given_date_from < origDateFrom || given_date_from > origDateTo){
            $('.setTimeMsg').html(setMsg('Date From must be equal or less than the date of user\'s schedule.'));
            $('#editdateFrom').focus();
        } else if(given_date_to > origDateTo || given_date_to < origDateFrom){
            $('.setTimeMsg').html(setMsg('Date To must be equal or less than the date of user\'s schedule.'));
            $('#editdateTo').focus();
        } else if(given_date_to < given_date_from){
            $('.setTimeMsg').html(setMsg('Date From must be equal or less than the date to'));
            $('#editdateTo').focus();
        } else{
            swal({
                title: "Continue?",
                text: "Make sure you have to complete and data and check dates. Continue?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, continue!",
                closeOnConfirm: false,
                confirmButtonColor: "#f77506",
                showLoaderOnConfirm: true
            },
            function(){
                var url = (type==1) ? 'booking/update_book_user/'+bid : 'booking/update_book_pet_user/'+bid;
                $.ajax({
                    url: base_url + url,
                    method: 'POST',
                    data: $('#edit_booking_info_form').serialize(),
                    success: (res)=>{
                        if(res==1){
                            swal({title: "Success!", text: 'Booking data was successfully updated', type: 
                            "success"}, function(){ location.reload(); });
                        } else{
                            swal('Failed!', 'A problem occured please try again.', 'error');
                        }
                    }
                });
            });
        }
    } else{
        $('.setTimeMsg').html(setMsg('Please fill all fields to proceed'));
    }
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