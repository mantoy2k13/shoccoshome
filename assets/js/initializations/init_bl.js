var bookAppr = (bid, status)=>{
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
                                $('#instMsg').modal('show')
                            } else if(status==4){
                                $('#instEmail').val($('#userEmail').val());
                                $('#instMailTo').val($('#userID').val());
                                $('#instMsgSubject').val('Booking Request Approved');
                                $('#instMsgContent').val('Dear Ma\'am/Sir,\n\nThank you for booking as a sitter for your pets. \n\n [ Write or modify this message.. ]');
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
var rebookAgain = (bid)=>{
    swal({
        title: "Re-book User?",
        text: "You are going to re-book this user again and wait for their approvals. Continue?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Re-book!",
        closeOnConfirm: false,
        confirmButtonColor: "#f77506",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url + "booking/re_book_user/"+bid,
            success: function(res){
                if(res==1){
                    swal({title: "Success!", text: 'User was sucessfully re-book!', type: 
                        "success"}, function(){ location.reload(); });
                } else{
                    swal("Failed",'A problem occured please try again.', 'error');
                }
            }
        }); 
    });
}
var bookingInfo=(bid,type)=>{
    $('.myPets').html('');
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    $.ajax({
        url: base_url + "booking/get_booking_info/"+bid+'/'+type,
        dataType: "JSON",
        success: function(res){
            if(res){
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
                if(pet_list){
                    $.each(pet_list, (index, pid)=> {
                        $.ajax({
                            url: base_url+'pet/get_pet_details_ajax/'+pid,
                            dataType: 'JSON',
                            success: (p)=>{
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
                            }
                        });
                    });
                } else{
                    if(pet_list){
                        $.each(pet_list, (index, pid)=> {
                            $.ajax({
                                url: base_url+'pet/get_pet_details_ajax/'+pid,
                                dataType: 'JSON',
                                success: (p)=>{
                                    $.each(p, (ind, pd)=> {
                                        console.log(pd);
                                        var imgPet = (pd['primary_pic']) ? '<img src="'+base_url+'assets/img/pictures/usr'+pd['user_id']+'/'+pd['primary_pic']+'" alt="Pet Image">' : '<img src="'+base_url+'assets/img/pictures/default_pet.png" alt="Pet Image">';
                                        $('<div class="col-md-4">'+
                                            '<div class="card bg-grey friend-card">'+
                                                '<div class="card-body">'+
                                                    '<div class="pet-bio-img">'+imgPet+
                                                    '</div>'+
                                                    '<p class="text-blue f-20 b-700"><a href="'+base_url+'pet/pet_details/'+pd['pet_id']+'" target="_blank">'+pd['pet_name']+'</a> </p>'+
                                                    '<p class="b-700 f-14">Breed: <span class="b-700 text-black">'+pd['breed_name']+'</span></p>'+
                                                    '<p class="b-700 f-14">Cat: <span class="b-700 text-black">'+pd['cat_name']+'</span></p>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>').insertAfter('.myPets');
                                    });
                                }
                            });
                        });
                    } else{
                        $('<div class="col-md-12">'+
                            '<div class="alert alert-info">'+
                                '<strong>Empty!</strong> There are no pets found.'+
                            '</div>'+
                        '</div>').insertAfter('.myPets');
                    }
                }
                $('#mLoader').html('');
                $('#booking_info').modal('show');
            } else{
                swal("Failed",'A problem occured please try again.', 'error');
            }
        }
    }); 
}