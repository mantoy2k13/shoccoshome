<!-- Modal -->  
<div class="modal fade msgModalCustom" id="edit_booking_info" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="edit_booking_info_form" method="POST" onchange="$('.setTimeMsg').html('');">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-pen"></i> Edit Booking Info 
                    <span id="bookStatus"></span></p>
                </div>
                <div class="modal-body">
                <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                    <!-- Init Dates -->
                    <input type="hidden" value="<?=date('Y-m-d');?>" id="curr_date">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <p class="text-orange f-16 b-700 m-b-0">User Time</p>
                        </div>
                    </div>
                    <div class="form-group row" id="bookToWrapper">
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <p class="text-orange f-16 b-700 m-b-0">Your Request Time</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="date_from">Date From: </label>
                            <input type="date" name="date_from" class="form-control" id="editdateFrom">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="time_start">Time Start: </label>
                            <input type="time" name="time_start" class="form-control" id="edittimeStart">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="date_to">Date To: </label>
                            <input type="date" name="date_to" class="form-control" id="editdateTo">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="time_end">Time End: </label>
                            <input type="time" name="time_end" class="form-control" id="edittimeEnd">
                        </div>
                        <div class="col-md-12 m-t-10" id="pet_list_info">
                            <label for="pet_list" id="lblTxt">Choose</label>
                            <select id="editpetList" name="pet_list[]" class="multipleSelect form-control" multiple>
                                
                            </select>
                        </div>
                        <div class="col-lg-12 m-t-10">
                            <label for="time_end">Short Message: </label>
                            <textarea id="editsMsg" name="message" class="form-control" cols="20" rows="3" placeholder="Short Message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveBtnBook" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>