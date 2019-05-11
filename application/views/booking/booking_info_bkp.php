<!-- Modal -->  
<div class="modal fade msgModalCustom" id="booking_info" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?=base_url();?>booking/select_and_book" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-paw"></i> Booking Info 
                    <span id="bookStatus"></span></p>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12 bio-head text-center">
                            <div class="book-info-img">
                                <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image" id="userImg">
                            </div>
                            <p class="f-30 b-700 m-b-0 text-black-l" id="userName">MJ</p>
                            <p class="f-15 text-black-l" id="userAdd">  123 mandaue, 6014, CA, United States</p>
                            <p class="f-15 m-b-0 text-black-l" id="userAdd"><span class="badge badge-success f-13" id="dateBooked">Date Booked: 12/12/12</span></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="date_from">Date From: </label>
                            <input type="date" disabled class="form-control" id="dateFrom">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="time_start">Time Start: </label>
                            <input type="time" disabled class="form-control" id="timeStart">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="date_to">Date To: </label>
                            <input type="date" disabled class="form-control" id="dateTo">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="time_end">Time End: </label>
                            <input type="time" disabled class="form-control" id="timeEnd">
                        </div>
                        <div class="col-lg-12 m-t-10">
                            <label for="time_end">Short Message: </label>
                            <textarea id="sMsg" class="form-control" cols="20" rows="3" placeholder="Short Message" disabled></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center b-700 f-20 text-orange m-t-10"><label for="time_end">Pets Requested</label></div>
                    </div>
                    <div class="row myPets">

                    </div>
                </div>
                <div class="modal-footer" id="bookFooterButton">
                    <button type="button" data-dismiss="modal" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i> Approve</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i> Disapprove</button>
                </div>
            </div>
        </form>
    </div>
</div>