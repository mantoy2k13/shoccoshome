function request_friends(uid, type, email){
    console.log(email);
    switch(type){
        case 1:
            var title="Add Friend?";
            var text="Friend request will be sent to this user";
            var btn="Add Friend";
        break;
        case 2:
            var title="Remove Request?";
            var text="Friend request will be removed.";
            var btn="Remove Request";
        break;
        case 3:
            var title="Unfriend?";
            var text="Unfriend this user?";
            var btn="Unfriend";
        break;
    }

    swal({
        title: title,
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: btn,
        closeOnConfirm: false,
        confirmButtonColor: "#1684e1"
    },
    function(){
        $.ajax({
            url: base_url + "friends/request_friends/"+uid+"/"+type,
            success: function(res){
                if(res){
                    switch(type){
                        case 1:
                        $('.options'+uid).html(''+
                            '<span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Request Sent</span>'+
                            '<div class="dropdown-menu" aria-labelledby="f-menu">'+
                                '<a onclick="request_friends('+uid+',2,\''+email+'\')" class="dropdown-item" href="javascript:;">Remove Request</a>'+
                                '<a class="dropdown-item" href="'+base_url+'account/view_bio/'+uid+'">View Profile</a>'+
                                '<a onclick="instMsg('+uid+',\''+email+'\')" class="dropdown-item" href="javascript:;">Send Message</a>'+
                            '</div>'
                        );
                        swal("Sent", "Friend Request Sent", 'success');
                        break;

                        case 2:
                        $('.options'+uid).html(''+
                            '<span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Add Friend</span>'+
                            '<div class="dropdown-menu" aria-labelledby="f-menu">'+
                                '<a onclick="request_friends('+uid+',1,\''+email+'\')" class="dropdown-item" href="javascript:;">Add Friend</a>'+
                                '<a class="dropdown-item" href="'+base_url+'account/view_bio/'+uid+'">View Profile</a>'+
                                '<a onclick="instMsg('+uid+',\''+email+'\')" class="dropdown-item" href="javascript:;">Send Message</a>'+
                            '</div>'
                        );
                        swal("Remove", "Friend Request Remove", 'success');
                        break;

                        case 3:
                        $('.options'+uid).html(''+
                            '<span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Add Friend</span>'+
                            '<div class="dropdown-menu" aria-labelledby="f-menu">'+
                                '<a onclick="request_friends('+uid+',1,\''+email+'\')" class="dropdown-item" href="javascript:;">Add Friend</a>'+
                                '<a class="dropdown-item" href="'+base_url+'account/view_bio/'+uid+'">View Profile</a>'+
                                '<a onclick="instMsg('+uid+',\''+email+'\')" class="dropdown-item" href="javascript:;">Send Message</a>'+
                            '</div>'
                        );
                        swal("Unfriend", "Unfriend success", 'success');
                        break;
                    }
                    
                } else{
                    swal("Failed", "There was a problem adding as a friend", 'warning');
                }
            }
        }); 
    });
}

function process_request(rid, uid, type, email){
    switch(type){
        case 1:
            var title="Confirm?";
            var text="Confirm friend request?";
            var btn="Confirm";
        break;
        case 2:
            var title="Remove Request?";
            var text="Friend request will be removed.";
            var btn="Remove Request";
        break;
    }

    swal({
        title: title,
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: btn,
        closeOnConfirm: false,
        confirmButtonColor: "#1684e1"
    },
    function(){
        $.ajax({
            url: base_url + "friends/process_request/"+rid+"/"+uid+"/"+type,
            success: function(res){
                if(res){
                    switch(type){
                        case 1:
                        $('.options'+uid).html(''+
                            '<span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Friends</span>'+
                            '<div class="dropdown-menu" aria-labelledby="f-menu">'+
                                '<a onclick="request_friends('+uid+',3,\''+email+'\')" class="dropdown-item" href="javascript:;">Unfriend</a>'+
                                '<a class="dropdown-item" href="'+base_url+'account/view_bio/'+uid+'">View Profile</a>'+
                                '<a onclick="instMsg('+uid+',\''+email+'\')" class="dropdown-item" href="javascript:;">Send Message</a>'+
                            '</div>'
                        );
                        swal("Confirm", "Friend successfully confirm", 'success');
                        break;

                        case 2:
                        $('.options'+uid).html(''+
                            '<span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Add Friend</span>'+
                            '<div class="dropdown-menu" aria-labelledby="f-menu">'+
                                '<a onclick="request_friends('+uid+',1,\''+email+'\')" class="dropdown-item" href="javascript:;">Add Friend</a>'+
                                '<a class="dropdown-item" href="'+base_url+'account/view_bio/'+uid+'">View Profile</a>'+
                                '<a onclick="instMsg('+uid+',\''+email+'\')" class="dropdown-item" href="javascript:;">Send Message</a>'+
                            '</div>'
                        );
                        swal("Remove", "Friend Request Remove", 'success');
                        break;
                    }
                    
                } else{
                    swal("Failed", "There was a problem adding as a friend", 'warning');
                }
            }
        }); 
    });
}