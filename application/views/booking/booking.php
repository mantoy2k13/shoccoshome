<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

  <body id="page-top">

    <!-- Navigation -->
    <?php $this->load->view('common/main-nav');?>

    <!-- Banner -->
    <?php $this->load->view('common/banner');?>

    <!-- Portfolio Grid Section -->
    <section class="content">
      <!-- 2nd Navbar -->
      <?php $this->load->view('common/profile-nav');?>

	  <div class="row m-t-10">
          <!-- Left Navbar -->
          <?php $this->load->view('common/left-nav');?>
        
          <!-- Main Content -->
		  <div class="col-md-9 m-t-10 p-l-0">
			<div class="panel panel-default bg-gray">
				<div class="panel-heading pointed"><a href="javascript:;" class="btn bg-orange post-btn"> Create New Post</a></div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<label for="">Choose the location</label>
							<input type="text" class="form-control" placeholder="Zip Code">
						</div>
						<div class="col-md-4">
							<label for="">Choose the option</label>
							<select class="form-control" onchange="getHostGuest(this);">
								<option value="Be a Guest">Be a Guest</option>
								<option value="Be a Host">Be a Host</option>
							</select>
						</div>
						<div class="col-md-4">
							<div class="guest-list">
								<label for="">Choose your pet from pet list</label>
								<select class="form-control" required>
									<?php if($my_pets){ 
										echo '<option value="">My pet is</option>';
										foreach($my_pets as $pets){ extract($pets); ?>
											<option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
										<?php }} else { ?>
											<option value="">No pets lists</option>
										<?php } ?>
								</select>
							</div>
							<div class="host-list">
								<label for="">Choose your pet</label>
								<?php foreach($categories as $cat){ ?>
									<div class="custom-control custom-checkbox m-b-5">
										<input type="checkbox" class="custom-control-input" id="<?=$cat->cat_id;?>" name="example1">
										<label class="custom-control-label" for="<?=$cat->cat_id;?>"><?=$cat->cat_name;?></label>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
 
					<div class="row text-center">
						<div class="col-md-12">
							<button type="submit" class="btn bg-orange sub-btn"><i class="fa fa-search"></i> Find a Home</button>
						</div>
					</div>
				</div>
			</div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>

</html>
