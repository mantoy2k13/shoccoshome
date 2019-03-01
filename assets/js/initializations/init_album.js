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
                var type  = 'warning';
            break;
            case 'Error':
                var title = "Oops!!";
                var msg   = "Your Album was successfully Deleted!";
                var type  = 'warning';
            break;
          
        }

        getAlbumAlert(title, msg, type);
    }
});

function getAlbumAlert(title, msg, type){
    swal(title, msg, type);
}

function update_album(album_id, album_name, album_desc){
    $('#albumform').attr('action', base_url+ 'album/update_album/' +album_id);
    $('#album_name').val(album_name);
    $('#album_desc').val(album_desc);
    $('#title').html('<i class="fa fa-edit"></i> Update Album');
    $('#addAlbum').modal('show');
}


function delete_album(album_id){
    swal({
        title: "Delete Album?",
        text: "Are you sure you want to delete this Pet? This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641"
    },
    function(){
        window.location.href = base_url+"album/delete_album/"+album_id;
    });
}