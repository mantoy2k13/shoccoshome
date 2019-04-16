<!-- Get Messages to count -->
<?php   $cntMsg            = $this->Mail_model->count_mail();
        $get_all_pet_color = $this->Pet_model->get_all_pet_color();
        $categories        = $this->Pet_model->get_all_pet_cat();
        $my_pets           = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
?>

<div class="col-md-3 m-t-10 p-r-0">
    <div class="left-menu">
        <a href="<?=base_url();?>home/homepage" class="btn left-menu-btn <?=($is_page=="homepage") ? "active" : ''; ?>"><i class="fa fa-chart-line f-25 text-blue"></i> Dashboard</a>
        <a href="javascript:;" onclick="getNearPeople()" class="btn left-menu-btn <?=($is_page=="people_near_me") ? "active" : ''; ?>"><i class="fa fa-map-marker-alt f-25 text-blue"></i> Who's near me?</a>
        <?php 
            $page = array('mail', 'sents', 'drafts');
            if(!(in_array($is_page,$page))){ ?>
            <a href="<?=base_url();?>mail/mail" class="btn left-menu-btn"><i class="fa fa-envelope f-25 text-blue"></i> Messenger
                <span class="lMsgCnt"><?=($cntMsg!=0) ? '<span class="badge badge-danger cntFrndReq pull-right m-t-5">'.$cntMsg.'</span>' : '';?></span>
            </a>
        <?php } ?>
        <?php $cntReq=$this->Friends_model->count_friend_request(); if($cntReq!=0){ ?>
            <a href="<?=base_url();?>friends/friend_request" class="btn left-menu-btn"><i class="fa fa-users f-25 text-blue"></i> Friend Request <span class="badge badge-danger cntFrndReq pull-right m-t-5"><?=$cntReq;?></span></a>
        <?php } ?>
        <?php $cntMgb=$this->Booking_model->count_mgb(); if($cntMgb!=0){ ?>
            <a href="<?=base_url();?>booking/booking_list/2" class="btn left-menu-btn <?=($is_page=="booking_list") ? "active" : ''; ?>"><i class="fa fa-history f-25 text-blue"></i> Booking Request <span class="badge badge-danger pull-right m-t-5"><?=$cntMgb;?></span></a>
        <?php } ?>
        <?php $cntba=$this->Booking_model->count_ba(); if($cntba!=0){ ?>
            <a href="<?=base_url();?>booking/booking_list/1" class="btn left-menu-btn <?=($is_page=="booking_list") ? "active" : ''; ?>"><i class="fa fa-thumbs-up f-25 text-blue"></i> Booking Approved <span class="badge badge-info pull-right m-t-5"><?=$cntba;?></span></a>
        <?php } ?>
        <?php if($is_page=="mail" || $is_page=="sents" || $is_page=="drafts"){?>
            <a href="<?=base_url();?>mail/mail" class="btn left-menu-btn <?=($is_page=="mail") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Inbox  
                <span class="inbCnt"><?=($cntMsg!=0) ? '<span class="badge badge-danger cntFrndReq pull-right m-t-5">'.$cntMsg.'</span>' : '';?></span>
            </a>
            <a href="<?=base_url();?>mail/sents" class="btn left-menu-btn <?=($is_page=="sents") ? "active" : ''; ?>"><i class="fa fa-paper-plane f-25 text-blue"></i> Sent</a>
            <a href="<?=base_url();?>mail/drafts" class="btn left-menu-btn <?=($is_page=="drafts") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Drafts</a>
        <?php } ?>
        <?php if($is_page=="people_near_me"){?>
            <form action="<?=base_url();?>home/people_near_me" method="POST">
                <div class="row">
                    <div class="col-md-12 m-t-10">
                        <p class="text-center b-700 text-blue m-b-0 f-15 text-center">Length Settings</p>
                        <label class="text-black m-b-0 f-15">Value:</label>
                        <input name="length_value" value="<?=(isset($_SESSION['length_value'])) ? $_SESSION['length_value'] : '50'; ?>" type="text" class="form-control f-15 decimalOnly" placeholder="Length Value" required/>
                    </div>
                    <div class="col-md-12 m-t-10">
                        <label class="text-black m-b-0 f-15">Length:</label>
                        <select name="length" class="form-control f-15">
                            <option value="km" <?=(($_SESSION['length']=='km')) ? 'selected' : ''; ?>>Kilometers</option>
                            <option value="m" <?=(($_SESSION['length']=='m')) ? 'selected' : ''; ?>>Meters</option>
                            <option value="mi" <?=(($_SESSION['length']=='mi')) ? 'selected' : ''; ?>>Miles</option>
                        </select>
                    </div>
                    <div class="col-md-12 m-t-10">
                        <div class="text-center m-t-10">
                            <button type="submit" class="btn bg-orange text-white col-md-12"><i class="fa fa-search"></i> Search Distance</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
        <?php 
            $page = array('');
            if(!(in_array($is_page,$page))){ ?>
            <form action="<?=base_url();?>booking/select_and_book" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <div class="m-t-10">
                            <p class="text-center b-700 text-blue m-t-20 f-15 text-center">Booking</p>
                            <label for="zipcode" class="f-15">Enter your Zip Code</label>
                            <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" required onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" value="<?=isset($_POST['zipcode']) ? $_POST['zipcode'] : '';?>" required>
                        </div>
                        <div class="m-t-10">
                            <label for="user_type" class="f-15">Select your type</label>
                            <select name="user_type" class="form-control" onchange="getHostGuest(this);">
                                <option value="guest">Be a Guest</option>
                                <option value="host">Be a Host</option>
                            </select>
                        </div>
                        <div class="m-t-10 guest-list">
                            <label for="pet_list" class="f-15">Choose your pet from pet list</label>
                            <select name="pet_list[]" class="multipleSelect form-control petList" multiple required>
                                <?php if($my_pets){ foreach($my_pets as $pets){ extract($pets); ?>
                                    <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                <?php } } else { ?>
                                    <option value="">You have no pets added.</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="m-t-10 host-list mainpage-list">
                            <label for="pet_cat" class="f-15">Choose your category</label><br />
                            <select name="pet_cat[]" class="multipleSelect form-control petCat" multiple>
                                <?php foreach($categories as $cat){ extract($cat); ?>
                                    <option value="<?=$cat_id;?>"><?=($cat_name) ? $cat_name : "No Name";?></option>
                                <?php } ?>
                            </select>
                        </div>
                            
                        <div class="text-center m-t-10">
                            <button type="submit" class="btn bg-orange text-white col-md-12"><i class="fa fa-search"></i> Find a home</button>
                        </div>
                    </div>
                </div>
            </form>    
        <?php } ?>

        
    </div>
</div>