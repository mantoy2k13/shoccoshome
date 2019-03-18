<header class="masthead mainpage-banner text-white text-center">	
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="cust-slider-img" src="<?=base_url();?>assets/img/frontpage/slider/slider1.jpg" alt="Slide Image1">
            </div>
            <div class="carousel-item">
                <img class="cust-slider-img" src="<?=base_url();?>assets/img/frontpage/slider/slider2.jpg" alt="Slide Image2">
            </div>
            <div class="carousel-item">
                <img class="cust-slider-img" src="<?=base_url();?>assets/img/frontpage/slider/slider3.jpg" alt="Slide Image3">
            </div>
            <div class="slide__overlay"></div>
                <div class="banner-form">
                    <p>
                    <span>AMAZING <br>SERVICES</span> <br><br>
                        WE LOVE PETS! WE OFFER ALL <br>
                        THE BEST QUALITY PRODUCTS FOR <br>
                        YOUR BEST FRIEND
                        <br>
                    </p>
                    <form action="javascript:;" method="POST">
                        <div class="search-form">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="zipcode">Choose the location</label>
                                    <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="zipcode">Choose the option</label>
                                    <select class="form-control" onchange="getHostGuest(this);" required>
                                        <option value="Be a Guest">Be a Guest</option>
                                        <option value="Be a Host">Be a Host</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="guest-list col-md-12">
                                    <label for="message_to">Choose your pet from pet list</label>
                                    <select class="multipleSelect form-control" multiple required>
                                    
                                        <?php if($my_pets){ 
                                            foreach($my_pets as $pets){ extract($pets); ?>
                                                <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                            <?php }} else { ?>
                                                <option value="">My pet is</option>
                                                <?php if($this->session->userdata('user_email')){?>
                                                    <option value="">You have no pets added.</option>
                                                <?php } else { ?>
                                                    <option value="">Please login to view your pets.</option>
                                                <?php } ?>
                                            <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 host-list mainpage-list">
                                    <label for="message_to">Choose your pet</label><br />
                                    <select class="multipleSelect form-control" multiple required>
                                        <?php foreach($categories as $cat){ extract($cat); ?>
                                            <option value="<?=$cat_id;?>"><?=($cat_name) ? $cat_name : "No Name";?></option>
                                        <?php } ?>
                                    </select>
                                   
                                </div>
                            </div>
                            
                            <div class="row form-group text-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-orange sub-btn m-t-10"><i class="fa fa-search"></i> Find a Home</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>
</header>