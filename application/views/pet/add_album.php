<!-- Modal -->  
<div class="modal fade msgModalCustom" id="addAlbum" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?=base_url();?>mail/send_message" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> Create New Album</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 m-t-10">
                            <label for="album_name">Album Name:</label>
                            <input type="text" class="form-control" placeholder="Album Name" name="album_name">
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <label for="album_desc">Description:</label>
                            <textarea name="album_desc" class="form-control" cols="30" rows="5" placeholder="Your album description here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>