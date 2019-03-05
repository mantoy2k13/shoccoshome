$(document).ready(function(){
    var alertMsg = $('#getAlbumAlert').val();
    if(alertMsg!=0){
        switch(alertMsg){
            case 'Added':
                var title = "Added Album!";
                var msg   = "Your Album was successfully added!";
                var type  = 'success';
            break;
            case 'Updated':
                var title = "Album Updated!";
                var msg   = "Your Album was successfully Updated!.";
                var type  = 'success';
            break;
            case 'Deleted':
                var title = "Album Deleted!";
                var msg   = "Your Album was successfully Deleted!";
                var type  = 'success';
            break;
            case 'Error':
                var title = "Oops!!";
                var msg   = "A problem occured. Please try again!";
                var type  = 'warning';
            break;
          
        }

        getAlbumAlert(title, msg, type);
    }

    add_album = ()=>{
        $('#albumform').attr('action', base_url+ 'album/add_album');
         $('#album_name').val('');
         $('#album_desc').val('');
         $('#title').html('<i class="fa fa-image"></i> Create New Album');
         $('#addAlbum').modal('show'); 
     }
 
    //  update_album = (album_id, album_name, album_desc) => {
    //      $('#albumform').attr('action', base_url+ 'album/update_album/' +album_id);
    //      $('#album_name').val(album_name);
    //      $('#album_desc').val(album_desc);
    //      $('#title').html('<i class="fa fa-edit"></i> Update Album');
    //      $('#addAlbum').modal('show');
    //  }
 
     delete_album = (album_id)=> {
         swal({
             title: "Delete Album?",
             text: "Are you sure you want to delete this Album? This will not be recovered.",
             type: "warning",
             showCancelButton: true,
             confirmButtonClass: "btn-danger",
             confirmButtonText: "Yes, delete it!",
             closeOnConfirm: false,
             confirmButtonColor: "#e11641",
             showLoaderOnConfirm: true
         },
         ()=>{
             window.location.href = base_url+"album/delete_album/"+album_id;
         });
     }

});

const getAlbumAlert = (title, msg, type)=> {
    swal(title, msg, type);
}

$(document).on('click', '.update_album', function(event){
    
    var album_id = $(this).attr('id');
    $.ajax({
        url: base_url+'album/getalbum',
        method:'POST',
        data:{album_id:album_id},
        dataType:'json',
        success:function(data){
            $('#albumform').attr('action', base_url+ 'album/update_album/' +album_id);
            $('#album_name').val(data[0].album_name);
            $('#album_desc').val(data[0].album_desc);
            $('#title').html('<i class="fa fa-edit"></i> Update Album');
            $('#addAlbum').modal('show');
        }
    });
});




