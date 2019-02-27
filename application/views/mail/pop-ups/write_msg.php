<!-- Modal -->  
<div class="modal fade msgModalCustom" id="writeMsg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?=base_url();?>mail/send_message" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-edit"></i> Write Message</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if($my_friends){ ?>
                                <label for="message_to">Choose Friends:</label>
                                <select class="multipleSelect form-control" multiple name="mail_to[]" required>
                                    <?php foreach($my_friends as $frnd){ extract($frnd); ?>
                                        <option value="<?=$id;?>"><?=($fullname) ? $fullname : "No Name";?></a> (<?=$email;?>)</option>
                                </select>
                                <input type="hidden" class="form-control" name="parent_id" value="0">
                            <?php } } else { ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong><i class="fa fa-check"></i> Empty!</strong> You have no friends to send messages.
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-t-10">
                            <label for="subject">Subject:</label>
                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <label for="message">Message:</label>
                            <textarea name="message" class="form-control" cols="30" rows="5" placeholder="Write a message..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <?php if($my_friends){ ?>
                    <button type="submit" class="btn btn-info"><i class="fa fa-paper-plane"></i> Send</button>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</div>