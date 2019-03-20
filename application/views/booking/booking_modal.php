<!-- Modal -->  
<div class="modal fade msgModalCustom" id="booking_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?=base_url();?>booking/select_and_book" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-search"></i> Find a Home for your pets</p>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="zipcode">Enter your Zip Code</label>
                            <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" required onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="user_type">Select your type</label>
                            <select name="user_type" class="form-control" onchange="getHostGuest(this);" required>
                                <option value="guest">Be a Guest</option>
                                <option value="host">Be a Host</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="guest-list col-md-12">
                            <label for="pet_list">Choose your pet from pet list</label>
                            <?php if($this->session->userdata('user_email')){?>
                                <select id="petList" name="pet_list[]" class="multipleSelect form-control" multiple>
                                <?php if($my_pets){ 
                                    foreach($my_pets as $pets){ extract($pets); ?>
                                        <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                    <?php } } else { ?>
                                        <?php if($this->session->userdata('user_email')){?>
                                            <option value="">You have no pets added.</option>
                                        <?php } else { ?>
                                            <option value="">Please login to view your pets.</option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            <?php } else { ?>
                                <select class="form-control">
                                    <option value="">Sign In or Sign Up now</option>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="col-md-12 host-list mainpage-list">
                            <label for="pet_cat">Choose your category</label><br />
                            <?php if($this->session->userdata('user_email')){?>
                                <select id="petCat" name="pet_cat[]" class="multipleSelect form-control" multiple>
                                    <?php foreach($categories as $cat){ extract($cat); ?>
                                        <option value="<?=$cat_id;?>"><?=($cat_name) ? $cat_name : "No Name";?></option>
                                    <?php } ?>
                                </select>
                            <?php } else { ?>
                                <select class="form-control">
                                    <option value="">Sign In or Sign Up now</option>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Find a home</button>
                </div>
            </div>
        </form>
    </div>
</div>