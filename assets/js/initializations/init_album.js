function update_album(album_id, album_name, album_desc){
    $('#albumform').attr('action', base_url+ 'album/update_album/' +album_id);
    $('#album_name').val(album_name);
    $('#album_desc').val(album_desc);
    $('#title').html('<i class="fa fa-edit"></i> Update Album');
    $('#addAlbum').modal('show');
}