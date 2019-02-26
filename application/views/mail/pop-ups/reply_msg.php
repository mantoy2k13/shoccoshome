<!-- Modal -->  
<div class="modal fade msgModalCustom" id="replyMsg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?=base_url();?>mail/send_message" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-edit"></i> Reply Message</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="message_to">Reply To:</label>
                            <input type="text" class="form-control" placeholder="From" id="replyTo" readonly>
                            <input type="hidden" class="form-control" id="mail_to" name="mail_to[]" readonly>
                            <input type="hidden" class="form-control" id="parent_id" name="parent_id" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-t-10">
                            <label for="message_to">Subject:</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject" id="replySubject">
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <div class="msg-quote">
                                <span class="pull-right"><i class="fa fa-quote-right"></i></span>
                                <label id="qSub"></label>
                                <p id="qDate" class="date"></p>
                                <p id="qContent"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <label for="message">Message:</label>
                            <textarea name="message" class="form-control" cols="30" rows="5" placeholder="Write message..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="replyBtn" type="submit" class="btn btn-info"><i class="fa fa-reply"></i> Reply</button>
                    <button id="backBtn" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>