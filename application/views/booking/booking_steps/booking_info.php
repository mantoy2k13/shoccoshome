<!-- Views Users -->
<div class="modal fade hide font-baloo" id="view_users" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p class="modal-title view_users_title f-20 text-black"></p>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="table-resp-custom m-t-10 col-md-12 view_user_dates">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade hide msgModalCustom font-baloo" id="user_info" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <p class="f-15 text-black-l font-san-serif" id="book_type_info"></p>
                        </div>
                        <div class="col-md-8 bio-head text-left">
                            <p class="f-30 b-700 m-b-0 text-orange-d" id="fullname_info"></p>
                            <p class="f-15 text-black-l m-b-0" id="address_info"></p>
                            <p class="f-15 text-black-l m-b-0 font-san-serif" id="schedule_info"></p>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="cat_list_info" id="cat-text">I can watch this pets: </label>
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

<!-- Views Users -->
<div class="modal fade hide font-baloo" id="rad-loc-settings" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p class="modal-title f-20 text-black"><i class="fa fa-map-marker"></i> Radius and Location Settings</p>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <form action="<?=base_url();?>home/set_radius_length" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-black m-b-0 f-15">Enter your location:</label>
                                    <input id="complete_address" name="complete_address" type="text" class="form-control" placeholder="Enter your address here.." required>
                                    <input id="user_lat" name="user_lat" type="hidden">
                                    <input id="user_lng" name="user_lng" type="hidden">
                                </div>
                                <div class="m-t-10 col-md-12">
                                    <label class="text-black m-b-0 f-15">Radius Value:</label>
                                    <input name="length_value" value="<?=(isset($_SESSION['length_value'])) ? $_SESSION['length_value'] : '50'; ?>" type="text" class="form-control f-15 decimalOnly" placeholder="Length Value" required/>
                                </div>
                                <div class="m-t-10 col-md-12">
                                    <label class="text-black m-b-0 f-15">Radius Length type:</label>
                                    <select name="length_type" class="form-control f-15">
                                        <option value="km" <?=(isset($_SESSION['length_type']) && ($_SESSION['length_type']=='km')) ? 'selected' : ''; ?>>Kilometers</option>
                                        <option value="m" <?=(isset($_SESSION['length_type']) && ($_SESSION['length_type']=='m')) ? 'selected' : ''; ?>>Meters</option>
                                        <option value="mi" <?=(isset($_SESSION['length_type']) && ($_SESSION['length_type']=='mi')) ? 'selected' : ''; ?>>Miles</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Apply</a>
            </div>
        </div>
    </div>
</div>