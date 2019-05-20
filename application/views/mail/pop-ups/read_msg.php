<!-- Modal -->  
<div class="modal fade msgModalCustom font-baloo" id="readMsg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="readForm" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-edit"></i> Read Message</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="message_to">From:</label>
                            <input type="text" class="form-control" placeholder="From" id="msgFrom" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="message_to">Date Sent:</label>
                            <input type="text" class="form-control" placeholder="Date Send" id="msgDate" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-t-10">
                            <label for="message_to">Subject:</label>
                            <input type="text" class="form-control" placeholder="Subject" name="subject" id="msgSubject" readonly>
                            <input type="hidden" name="mail_id" id="redMid">
                        </div>
                    </div>
                    <div id="msg-read-quote"></div>               
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <label for="message">Message:</label>
                            <textarea name="message" id="msgContent" class="form-control" cols="30" rows="5" placeholder="Message..." readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="replyBtn" type="button" class="btn btn-info"><i class="fa fa-reply"></i> Reply</button>
                    <button id="drftBtn" type="button" class="btn btn-success" ><i class="fa fa-inbox"></i> Move to Drafts</button>
                    <button id="editBtn" onclick="edit_msg(1)" type="button" class="btn btn-success text-white"><i class="fa fa-edit"></i> Edit Message</button>
                    <button id="saveBtn" onclick="editMessage()" type="button" class="btn btn-info"><i class="fa fa-save"></i> Save Changes</button>
                    <button id="cancelBtn" onclick="edit_msg(2)" type="button" class="btn btn-danger text-white"><i class="fa fa-times"></i> Cancel</button>
                    <button id="modDelBtn" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>