
<div class="modal fade msgModalCustom font-baloo" id="user_info" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?=base_url();?>booking/select_and_book" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-calendar-alt"></i> Schedule Info</p>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-4 bio-head text-center">
                            <div class="userImages">
                                <img class="zoomable" id="user_img_info">
                            </div>
                        </div>
                        <div class="col-md-8 bio-head text-left">
                            <p class="f-30 b-700 m-b-0 text-orange-d" id="fullname_info"></p>
                            <p class="f-15 text-black-l m-b-0" id="address_info"></p>
                            <p class="f-15 text-black-l m-b-0 font-san-serif" id="schedule_info"></p>
                            <p class="f-15 text-black-l font-san-serif" id="book_type_info"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="time_end">I can watch this pets: </label>
                            <input type="text" disabled class="form-control" placeholder="Pet Categories" id="cat_list_info">
                        </div>
                        <div class="col-lg-12 m-t-10 book_note_wrapper"></div>
                        <div class="col-md-12 m-t-10">
                            <p class="f-15 text-black-l">
                                <span class="font-san-serif" id="smoke_info"></span>
                                <span class="badge badge-info font-san-serif" id="home_info"></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="user_footer_btn">
                    <a href="javascript:;" class="btn btn-success btn-sm"><i class="fa fa-phone"></i> Contact Fred</a>
                    <a href="javascript:;" class="btn btn-info btn-sm"><i class="fa fa-user"></i> View Profile</a>
                </div>
            </div>
        </form>
    </div>
</div>