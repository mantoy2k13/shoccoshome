<!-- Modal -->  
<div class="modal fade msgModalCustom font-baloo" id="instMsg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?=base_url();?>mail/send_message" method="POST" id="sendMsgForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-edit"></i> Write Message</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Email" id="instEmail" readonly>
                            <input type="hidden" name="mail_to[]" id="instMailTo">
                            <input type="hidden" name="parent_id" value="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-t-10">
                            <label for="subject">Subject:</label>
                            <input type="text" class="form-control" placeholder="Subject" name="subject" id="instMsgSubject">
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <label for="message">Message:</label>
                            <textarea name="message" class="form-control" cols="30" rows="5" placeholder="Write a message..." id="instMsgContent"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="sendMessage(1)" class="btn btn-info"><i class="fa fa-paper-plane"></i> Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>