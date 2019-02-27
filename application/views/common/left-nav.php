<!-- Get Messages to count -->
<?php $cntMsg=$this->Mail_model->count_mail();?>

<div class="col-md-3 m-t-10 p-r-0">
    <div class="left-menu">
        <a href="<?=base_url();?>home/news_feed" class="btn left-menu-btn <?=($is_page && $is_page=="news_feed") ? "active" : ''; ?>"><i class="fa fa-newspaper f-25 text-blue"></i> News Feed</a>
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
        <?php 
            $page = array('mail', 'sents', 'drafts');
            if(!(in_array($is_page,$page))){ ?>
            <div class="row">
                <div class="col-md-12 m-t-10 text-center">
                    <p class="text-center text-blue m-b-0 f-15">Search</p>
                    <div class="inner-addon right-addon">
                        <img class="s-icon" src="<?=base_url();?>assets/img/search_icon.png" alt="Search icon">
                        <input type="text" id="leftSearchInput" class="form-control f-15" placeholder="Search" />
                    </div>
                </div>
                <div class="col-md-12">

                        <label class="text-black m-b-0 f-15">Pet:</label>
                        <select class="form-control f-15">
                            <option value="Select Pet">Select Pet</option>
                            <option value="Bird">Bird</option>
                            <option value="Cat">Cat</option>
                            <option value="Dog">Dog</option>
                            <option value="Fish">Fish</option>
                            <option value="Horse">Horse</option>
                            <option value="Other">Other</option>
                            <option value="Reptile/Amphibian">Reptile/Amphibian</option>
                            <option value="Small/Animal">Small/Animal</option>
                        </select>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">Breed:</label>
                        <select class="form-control f-15">
                            <option value="Host">Select Breed</option>
                           
                        </select>
                    </div>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">Sex:</label>
                        <select class="form-control f-15">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">Color:</label>
                        <select class="form-control f-15">
                            <option value="Host">Select Color:</option>
                        </select>
                    </div>
                
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">Located:</label>
                        <select class="form-control f-15">
                            <option value="athome">At Home</option>
                            <option value="atshelter">At Shelter</option>
                        </select>
                    </div>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">Chip Number:</label>
                        <input type="text" class="form-control" name="chipnumber" value="">
                    </div>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">Collar Tag</label>
                        <input type="text" class="form-control" name="collartag" value="" placeholder="Collar Tag">
                    </div>
                  
                            <div class="m-t-10">
                                <label for="" class="text-black m-b-0 f-15">Country</label>
                                <select name="country" id="country_id" class="form-control">
                                    <option value="Select Country">Select Country</option>
                                </select>
                            </div>
                            <div class="m-t-10">
                                <label for="" class="text-black m-b-0 f-15">State</label>
                                <select name="state"  class="form-control">
                                    <option value="Select State"><?=@$get_single_pet_data[0]->state; ?></option>
                                </select>
                            </div>
                       
                       
                            <div class="m-t-10">
                                <label class="text-black m-b-0 f-15" >City</label>
                                <input required name="city" value="<?php echo ($user_logindata) ? $user_logindata->city : '';?>" type="text" class="form-control" placeholder="City">
                              </div> 
                            <div class="m-t-10">
                                <label class="text-black m-b-0 f-15">Street</label>
                                <input  name="street" value="<?php echo ($user_logindata) ? $user_logindata->street : '';?>" type="text" class="form-control" placeholder="Street">
                            </div>
                            <div class="m-t-10">
                                <label class="text-black m-b-0 f-15">Zip/Postal Code</label>
                                <input  name="zip_code" value="<?php echo ($user_logindata) ? $user_logindata->zip_code : '';?>" type="text" class="form-control" placeholder="Zip/Postal Code">
                            </div>
                             
                        
                    <div class="text-center m-t-10">
                        <button type="submit" class="btn bg-orange text-white col-md-12">Perform Search</button>
                    </div>
                </div>
                <div class="left-search-grp col-md-12">
                  
                    
                    <!--  
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">New Member Within:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control f-15">
                                  
                                </select>
                            </div>
                            <div class="col-md-4 text-left"><span class="v-a-m text-black f-15">Days</span></div>
                        </div>
                    </div>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">Last Online Within:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control f-15">
                                  
                                </select>
                            </div>
                            <div class="col-md-4 text-left"><span class="v-a-m text-black f-15">Days</span></div>
                        </div>
                    </div>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15">City Lookup:</label>
                        <input type="text" class="form-control f-15" placeholder="City Lookup">
                    </div>
                    <div class="m-t-10">
                        <label class="text-black m-b-0 f-15 b-700">Include Members:</label>
                    </div>
                    <div class="on-off-menu">
                        <div class="row">
                            <div class="col-md-8"><span class="v-a-m text-black f-15">Online</span></div>
                            <div class="col-md-4">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"><span class="v-a-m text-black f-15">With Photo</span></div>
                            <div class="col-md-4">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"><span class="v-a-m text-black f-15">With Video</span></div>
                            <div class="col-md-4">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"><span class="v-a-m text-black f-15">Certified 100% Real</span></div>
                            <div class="col-md-4">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                -->
                    
                </div>
            </div>
        <?php } ?>

        <?php if($is_page=="mail" || $is_page=="sents" || $is_page=="drafts"){?>
            <a href="<?=base_url();?>mail/mail" class="btn left-menu-btn <?=($is_page && $is_page=="mail") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Inbox  
                <span class="inbCnt"><?=($cntMsg!=0) ? '<span class="badge badge-danger cntFrndReq pull-right m-t-5">'.$cntMsg.'</span>' : '';?></span>
            </a>
            <a href="<?=base_url();?>mail/sents" class="btn left-menu-btn <?=($is_page && $is_page=="sents") ? "active" : ''; ?>"><i class="fa fa-paper-plane f-25 text-blue"></i> Sent</a>
            <a href="<?=base_url();?>mail/drafts" class="btn left-menu-btn <?=($is_page && $is_page=="drafts") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Drafts</a>
        <?php } ?>
    </div>
</div>