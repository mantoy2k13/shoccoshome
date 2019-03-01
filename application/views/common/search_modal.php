<?php   
        $get_all_pet_color = $this->Pet_model->get_all_pet_color();
        $categories        = $this->Pet_model->get_all_pet_cat();
?>
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xxl" role="document">
      <form action="<?=base_url()?>pet/search_pets">
        <div class="modal-content custSearchModal bg-orange-l">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-blue">Advance Search</h2>
                    <span class="cust-mod-close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times text-white"></i>
                    </span>
                </div>
                <div class="col-md-12 text-center">
                    <div class="inner-addon right-addon">
                        <img class="s-icon" src="<?=base_url();?>assets/img/search_icon.png" alt="Search icon">
                        <input type="text" name="keywords" class="form-control" placeholder="Keywords" value="<?=(isset($_GET['keywords'])) ? $_GET['keywords'] : ''; ?>" />
                    </div>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-md-2">
                    <label class="mb-0 text-black v-a-m">Category: </label>
                </div>
                <div class="col-md-4">
                    <select name="cat_id" class="form-control selCategory2" onchange="setBreeds2()">
                        <option value="">Select Category</option>
                        <?php foreach($categories as $cat){ ?>
                            <option value="<?= $cat->cat_id ?>" <?=(isset($_GET['cat_id'])) ? (($_GET['cat_id']==$cat->cat_id) ? 'selected' : '' ) : ''; ?>> <?= $cat->cat_name ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="m-b-0 text-black v-a-m">Breed: </label>
                </div>
                <div class="col-md-4">
                    <select name="breed_id" class="form-control selBreed2">
                        <option value="">-</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-2">
                    <label class="m-b-0 text-black v-a-m">Color</label>
                </div>
                <div class="col-md-4">
                    <select name="color_id" class="form-control">
                        <option value="">Select Color</option>
                        <?php foreach($get_all_pet_color as $show_all_pet_color){ ?>
                            <option value="<?= $show_all_pet_color->color_id ?>" <?=(isset($_GET['color_id'])) ? (($_GET['color_id']==$show_all_pet_color->color_id) ? 'selected' : '' ) : ''; ?>> <?= $show_all_pet_color->color_name ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="m-b-0 text-black v-a-m">Located: </label>
                </div>
                <div class="col-md-4">
                    <select name="located" class="form-control f-15">
                        <option value="">Select Location</option>
                        <option value="At Home" <?=(isset($_GET['located'])) ? (($_GET['located']=='Male') ? 'At Home' : '' ) : ''; ?>>At Home</option>
                        <option value="At Shelter" <?=(isset($_GET['gender'])) ? (($_GET['gender']=='Male') ? 'At Shelter' : '' ) : ''; ?>>At Shelter</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-2">
                    <label class="m-b-0 text-black v-a-m">Gender: </label>
                </div>
                <div class="col-md-4">
                    <select name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male" <?=(isset($_GET['gender'])) ? (($_GET['gender']=='Male') ? 'selected' : '' ) : ''; ?>>Male</option>
                        <option value="Female" <?=(isset($_GET['gender'])) ? (($_GET['gender']=='Female') ? 'selected' : '' ) : ''; ?>>Female</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="m-b-0 text-black v-a-m">Chip Number </label>
                </div>
                <div class="col-md-4">
                    <input name="chip_no" type="text" class="form-control" value="<?=(isset($_GET['chip_no'])) ? $_GET['chip_no'] : ''; ?>" placeholder="Chip Number">
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-2">
                    <label class="m-b-0 text-black v-a-m">Collar Tag </label>
                </div>
                <div class="col-md-4">
                    <input name="collar_tag" type="text" class="form-control" value="<?=(isset($_GET['collar_tag'])) ? $_GET['collar_tag'] : ''; ?>" placeholder="Collar Tag">
                </div>
                <div class="col-md-2">
                    <label class="m-b-0 text-black v-a-m">Zip/Postal Code </label>
                </div>
                <div class="col-md-4">
                    <input name="zip_code" type="text" class="form-control" value="<?=(isset($_GET['zip_code'])) ? $_GET['zip_code'] : ''; ?>" placeholder="Zip Code">
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn bg-orange sub-btn"><i class="fa fa-search"></i> Search pets</button>
                </div>
            </div>
        </div>
      </form>  
  </div>
</div>
