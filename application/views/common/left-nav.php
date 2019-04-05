<!-- Get Messages to count -->
<?php   $cntMsg            = $this->Mail_model->count_mail();
        $get_all_pet_color = $this->Pet_model->get_all_pet_color();
        $categories        = $this->Pet_model->get_all_pet_cat();
?>

<div class="col-md-3 m-t-10 p-r-0">
    <div class="left-menu">
        <a href="<?=base_url();?>home/homepage" class="btn left-menu-btn <?=($is_page=="homepage") ? "active" : ''; ?>"><i class="fa fa-chart-line f-25 text-blue"></i> Dashboard</a>
        <!-- <a href="<?=base_url();?>home/people_near_me" onclick="getNearPeople()" class="btn left-menu-btn <?=($is_page=="people_near_me") ? "active" : ''; ?>"><i class="fa fa-map-marker-alt f-25 text-blue"></i> Who's near me?</a> -->
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
        <?php 
            $page = array('mail', 'sents', 'drafts');
            if(!(in_array($is_page,$page))){ ?>
            <form action="<?=base_url();?>pet/search_pets" method="GET">
                <div class="row">
                    <div class="col-md-12 m-t-10">
                        <p class="text-center b-700 text-blue m-b-0 f-15 text-center">Search</p>
                        <label class="text-black m-b-0 f-15">Keywords:</label>
                        <div class="inner-addon right-addon">
                            <img class="s-icon" src="<?=base_url();?>assets/img/search_icon.png" alt="Search icon">
                            <input name="keywords" value="<?=(isset($_GET['keywords'])) ? $_GET['keywords'] : ''; ?>" type="text" class="form-control f-15" placeholder="Keywords" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="text-black m-b-0 f-15 m-t-10">Category:</label>
                        <select name="cat_id" class="form-control f-15 selCategory" onchange="setBreeds()">
                            <option value="">Select Category</option>
                            <?php 
                            foreach($categories as $cat){ ?>
                                <option value="<?= $cat['cat_id']; ?>" <?=(isset($_GET['cat_id'])) ? (($_GET['cat_id']==$cat['cat_id']) ? 'selected' : '' ) : ''; ?>> <?= $cat['cat_name'] ?> </option>
                            <?php } ?>
                        </select>
                        <div class="m-t-10">
                            <label class="text-black m-b-0 f-15">Breed:</label>
                            <select name="breed_id" class="form-control f-15 selBreed">
                                <option value="">-</option>
                            </select>
                        </div>
                        <div class="m-t-10">
                            <label class="text-black m-b-0 f-15">Gender:</label>
                            <select name="gender" class="form-control f-15">
                                <option value="">Select Gender</option>
                                <option value="Male" <?=(isset($_GET['gender'])) ? (($_GET['gender']=='Male') ? 'selected' : '' ) : ''; ?>>Male</option>
                                <option value="Female" <?=(isset($_GET['gender'])) ? (($_GET['gender']=='Female') ? 'selected' : '' ) : ''; ?>>Female</option>
                            </select>
                        </div>
                        <div class="m-t-10">
                            <label class="text-black m-b-0 f-15">Color:</label>
                            <select name="color_id" class="form-control f-15">
                                <option value="">Select Color</option>
                                <?php foreach($get_all_pet_color as $col){ extract($col); ?>
                                    <option value="<?= $color_id ?>" <?=(isset($_GET['color_id'])) ? (($_GET['color_id']==$color_id) ? 'selected' : '' ) : ''; ?>> <?= $color_name ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    
                        <div class="m-t-10">
                            <label class="text-black m-b-0 f-15">Located:</label>
                            <select name="located" class="form-control f-15">
                                <option value="">Select Location</option>
                                <option value="At Home" <?=(isset($_GET['located'])) ? (($_GET['located']=='Male') ? 'At Home' : '' ) : ''; ?>>At Home</option>
                                <option value="At Shelter" <?=(isset($_GET['gender'])) ? (($_GET['gender']=='Male') ? 'At Shelter' : '' ) : ''; ?>>At Shelter</option>
                            </select>
                        </div>
                        <div class="m-t-10">
                            <label class="text-black m-b-0 f-15">Chip Number:</label>
                            <input name="chip_no" type="text" class="form-control" value="<?=(isset($_GET['chip_no'])) ? $_GET['chip_no'] : ''; ?>" placeholder="Chip Number">
                        </div>
                        <div class="m-t-10">
                            <label class="text-black m-b-0 f-15">Collar Tag:</label>
                            <input name="collar_tag" type="text" class="form-control" value="<?=(isset($_GET['collar_tag'])) ? $_GET['collar_tag'] : ''; ?>" placeholder="Collar Tag">
                        </div>
                        <div class="m-t-10">
                            <label class="text-black m-b-0 f-15">Zip Code:</label>
                            <input name="zip_code" type="text" class="form-control" value="<?=(isset($_GET['zip_code'])) ? $_GET['zip_code'] : ''; ?>" placeholder="Zip Code">
                        </div>
                            
                        <div class="text-center m-t-10">
                            <button type="submit" class="btn bg-orange text-white col-md-12"><i class="fa fa-search"></i> Search Pets</button>
                        </div>
                    </div>
                </div>
            </form>    
        <?php } ?>

        <?php if($is_page=="mail" || $is_page=="sents" || $is_page=="drafts"){?>
            <a href="<?=base_url();?>mail/mail" class="btn left-menu-btn <?=($is_page=="mail") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Inbox  
                <span class="inbCnt"><?=($cntMsg!=0) ? '<span class="badge badge-danger cntFrndReq pull-right m-t-5">'.$cntMsg.'</span>' : '';?></span>
            </a>
            <a href="<?=base_url();?>mail/sents" class="btn left-menu-btn <?=($is_page=="sents") ? "active" : ''; ?>"><i class="fa fa-paper-plane f-25 text-blue"></i> Sent</a>
            <a href="<?=base_url();?>mail/drafts" class="btn left-menu-btn <?=($is_page=="drafts") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Drafts</a>
        <?php } ?>
    </div>
</div>