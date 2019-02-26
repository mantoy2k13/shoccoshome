<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xxl" role="document">
    <div class="modal-content custSearchModal bg-orange-l">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-blue">Search</h2>
                <span class="cust-mod-close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times text-white"></i>
                </span>
            </div>
            <div class="col-md-12 text-center">
                <div class="inner-addon right-addon">
                    <img class="s-icon" src="<?=base_url();?>assets/img/search_icon.png" alt="Search icon">
                    <input type="text" class="form-control" placeholder="Search" />
                </div>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-md-1">
                <label class="m-b-0 text-black v-a-m">Pet: </label>
            </div>
            <div class="col-md-4">
                <select class="form-control">
                    <option value="Select Pet">Select Pet</option>
                    <option value="Tiger">Tiger</option>
                    <option value="Smokey">Smokey</option>
                    <option value="Oreo">Oreo</option>
                    <option value="Sassy">Sassy</option>
                    <option value="Simba">Simba</option>
                    <option value="Oliver">Oliver</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="m-b-0 text-black v-a-m">Age From: </label>
            </div>
            <div class="col-md-2">
                <select class="form-control">
                    <?php for($i=1;$i<=100;$i++){?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-md-1 text-center">
                <label class="m-b-0 text-black v-a-m"><b>To</b></label>
            </div>
            <div class="col-md-2">
                <select class="form-control">
                    <?php for($i=1;$i<=100;$i++){?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-1">
                <label class="m-b-0 text-black v-a-m">Status: </label>
            </div>
            <div class="col-md-4">
                <select class="form-control">
                    <option value="Host">Host</option>
                    <option value="Guest">Guest</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="m-b-0 text-black v-a-m">Members Rating: </label>
            </div>
            <div class="col-md-5">
                <select class="form-control">
                    <?php for($i=1;$i<=100;$i++){?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-1">
                <label class="m-b-0 text-black v-a-m">Gender: </label>
            </div>
            <div class="col-md-4">
                <select class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="m-b-0 text-black v-a-m">City Lookup: </label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" placeholder="City lookup" />
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-1">
                <label class="m-b-0 text-black v-a-m">Country: </label>
            </div>
            <div class="col-md-4">
                <select class="crs-country form-control" data-region-id="one">
                    <option value="Select Country">Select Country</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="m-b-0 text-black v-a-m">New Member Within: </label>
            </div>
            <div class="col-md-3">
                <select class="form-control">
                    <?php for($i=1;$i<=100;$i++){?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-md-1">
                <label class="m-b-0 text-black v-a-m">Days </label>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-1">
                <label class="m-b-0 text-black v-a-m">State: </label>
            </div>
            <div class="col-md-4">
                <select name="state" class="form-control" id="one"></select>
            </div>
            <div class="col-md-3">
                <label class="m-b-0 text-black v-a-m">Last Online Within: </label>
            </div>
            <div class="col-md-3">
                <select class="form-control">
                    <?php for($i=1;$i<=100;$i++){?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-md-1">
                <label class="m-b-0 text-black v-a-m">Days </label>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-12">
                <label class="m-b-0 text-black b-700 v-a-m">Include Members: </label>
            </div>
            <div class="col-md-2">
                <label class="m-b-0 text-black v-a-m">Online: </label>
            </div>
            <div class="col-md-1">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="m-b-0 text-black v-a-m">With Photo: </label>
            </div>
            <div class="col-md-1">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="m-b-0 text-black v-a-m">With Video: </label>
            </div>
            <div class="col-md-1">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="col-md-2">
                <label class="m-b-0 text-black v-a-m">Certified 100% Real: </label>
            </div>
            <div class="col-md-1">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn bg-orange sub-btn">Perform Search</button>
            </div>
        </div>
    </div>
  </div>
</div>
