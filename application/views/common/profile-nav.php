<div class="row">
    <div class="col-md-3 p-r-0">
        <div class="prof-info text-center">
            <p class="text-blue b-700">
             <?php 
                if($user_logindata->fullname){
                    echo $user_logindata->fullname;
                }else{
                    $c_email=$user_logindata->email;
                    $explodeResultArrayname = explode("@", $c_email);
                    echo ucfirst($explodeResultArrayname[0]);
                }
             ?>
            </p>
            <p><?= $user_logindata->email; ?><br>
            <i class="fa fa-map-marker-alt text-blue"></i>
            <?php 
                if($user_logindata->country){
                    echo $user_logindata->country. ', ' .$user_logindata->state. ' '.$user_logindata->city;
                }else{
                    echo "<a href='".base_url()."account/account#target_address'>Set Your Address</a>";
                }
            ?>
            </p>
        </div>
    </div>
    <div class="col-md-9 p-l-0">
    <?php if($is_page=="friends" || $is_page=="friend_request" || $is_page=="mail" || $is_page=="sents" || $is_page=="drafts" || $is_page=="bio" || $is_page=="view_bio") {?>
        <form action="<?=base_url();?>friends/search_friends" method="get">
            <div class="input-group mb-3">
                <input name="keywords" type="search" class="form-control cust-search-btn" placeholder="Search friend's name or email..." required value="<?=isset($_GET['keywords']) ? $_GET['keywords'] : "";?>">
                <div class="input-group-append">
                    <button class="btn bg-orange post-btn" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <div class="input-group mb-3">
            <input type="search" class="form-control cust-search-btn" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn bg-orange post-btn" data-toggle="modal" data-target="#searchModal" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    <?php } ?>
        <div class="main-wrapper">
            <div class="btn-nav">
                <div class="row m-auto">
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>home/homepage" class="home-menu btn-menu"><i class="fa fa-home f-40 text-blue <?=($is_page=="homepage") ? 'active' : ''; ?>"></i></a>
                    </div>
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>home/my_pets" class="btn-menu btn bg-blue <?=($is_page=="my_pets" || $is_page=="pet_details" || $is_page=="add_pet") ? 'active' : ''; ?>">My Pets</a>
                    </div>
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>home/booking" class="btn-menu btn bg-blue <?=($is_page=="booking" || $is_page=="booking_list") ? 'active' : ''; ?>">Booking</a>
                    </div>
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>account/bio" class="btn-menu btn bg-blue <?=($is_page=="bio" || $is_page=="view_bio") ? 'active' : ''; ?>">Bio</a>
                    </div>
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>friends/friend_list" class="btn-menu btn bg-blue <?=($is_page=="friends" || $is_page=="friend_request") ? 'active' : ''; ?>">Friends</a>
                    </div>
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>mail/mail" class="btn-menu btn bg-blue <?=($is_page=="mail" || $is_page=="drafts" || $is_page=="sents") ? 'active' : ''; ?>">Mail</a>
                    </div>
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>account/account" class="btn-menu btn bg-blue <?=($is_page=="account") ? 'active' : ''; ?>">Account</a>
                    </div>
                    <div class="col-md-8r">
                        <a href="<?=base_url();?>home/pictures" class="btn-menu btn bg-blue <?=($is_page=="pictures") ? 'active' : ''; ?>">Pictures</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>