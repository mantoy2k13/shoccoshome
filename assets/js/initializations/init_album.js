var add_album = ()=>{
    clearErrAlbum();
    $('#album_id').val('');
    $('#album_name').val('');
    $('#album_desc').val('');
    $('#title').html('<i class="fa fa-image"></i> Create New Album');
    $('#addAlbum').modal('show'); 
}

var update_album = (album_id)=>{
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    $.ajax({
        url: base_url+'album/get_album_details/'+album_id,
        dataType:'JSON',
        success:function(res){
            clearErrAlbum()
            $('#album_id').val(res['album_id']);
            $('#album_name').val(res['album_name']);
            $('#album_desc').val(res['album_desc']);
            $('#title').html('<i class="fa fa-edit"></i> Update Album');
            $('#mLoader').html('');
            $('#addAlbum').modal('show');
        }
    });
}

var addNewAlbum = ()=>{
    if(!$('#album_name').val()){
        $('.petErrorAlbum').html(setErrorAlbum('Please enter album name.'))
    } else{
        swal({
            title: "Save Album?",
            text: "All changes made will be save.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, save it!",
            closeOnConfirm: false,
            confirmButtonColor: "#f77506",
            showLoaderOnConfirm: true
        },
        function(){
            $.ajax({
                url: base_url+'album/save_album',
                type: 'POST',
                data: $('#albumForm').serialize(),
                success: (res)=>{
                    if(res==1){
                        swal({
                            title: "Album Saved!",
                            text: "Your album was successfully saved. Click ok to view all albums.",
                            type: "success",
                        },
                        function(){ location.reload(); });
                    } else{
                        swal('Oops!', 'A problem occured. Please refresh your page and try again.', 'error');
                    }   
                }
            });
        });
    }
 }
 
 var delete_album = (album_id)=> {
    swal({
        title: "Delete Album?",
        text: "Are you sure you want to delete this Album? This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
     ()=>{
        $.ajax({
            url: base_url+"album/delete_album/"+album_id,
            success: (res)=>{
                if(res==1){
                    $('#myAlbums'+album_id).fadeOut('slow').remove();
                    var cntAlbum = $('.myAlbums').length;
                    if(cntAlbum==0){
                        $('#albMsg').html(''+
                            '<div class="alert alert-success alert-dismissible f-15" role="alert">'+
                                '<strong><i class="fa fa-check"></i> Empty!</strong> You have no albums added.'+
                            '</div>'
                        );
                        $('#albPagi').remove();
                    }
                    swal('Deleted!', 'Album was successfully deleted!', 'success');
                }else{
                    swal('Failed!', 'A problem deleting your album. Please try again!', 'error');
                }
            }
        });
    });
}

var addPhotoAlbum = (album_id)=>{
    var cntImg = $('.selFromAlbumBox:checked').length;
    if(cntImg>0){
        swal({
            title: "Add to albums?",
            text: "All selected images will be added to this album.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, add it!",
            closeOnConfirm: false,
            confirmButtonColor: "#f77506",
            showLoaderOnConfirm: true
        },
        function(){
            $.ajax({
                url: base_url+'pictures/addPhotoAlbum/'+album_id,
                type: 'POST',
                data: $('#addPhotoForm').serialize(),
                success: (res)=>{
                    if(res==1){
                        swal({
                            title: "Photos Saved!",
                            text: "Added to albums successfully. Click ok to refresh.",
                            type: "success",
                        },
                        function(){ location.reload(); });
                    } else{
                        swal('Oops!', 'A problem occured. Please refresh your page and try again.', 'error');
                    }   
                }
            });
        });
    } else{
        swal('Oops', "Please check atleast 1 image to add.", 'warning');
    }
}

function setErrorAlbum(msg){
    var setMsg = '';
    setMsg += '<div class="alert alert-danger f-15 alert-dismissible" role="alert">';
    setMsg += '<strong><i class="fa fa-times"></i> Oops!</strong> '+msg+'.';
    setMsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    setMsg += '<span aria-hidden="true">&times;</span>';
    setMsg += '</button>';
    setMsg += '</div>';
    return setMsg;
}

function clearErrAlbum(){
    $('.petErrorAlbum').html('');
}




