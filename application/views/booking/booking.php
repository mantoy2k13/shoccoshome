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
								<option value="guest">Be a Guest</option>
								<option value="host">Be a Host</option>
							</select>
						</div>
						<div class="col-md-4">
							<div class="guest-list">
								<label for="">Choose your pet from pet list</label>
								<select class="multipleSelect form-control" multiple required>
									<?php if($my_pets){ 
										foreach($my_pets as $pets){ extract($pets); ?>
											<option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
										<?php }} else { ?>
											<option value="">No pets lists</option>
										<?php } ?>
								</select>
							</div>
							<div class="host-list">
								<label for="">Choose your pet</label>
								<select class="multipleSelect form-control" multiple  required>
									<?php foreach($categories as $cat){ extract($cat); ?>
										<option value="<?=$cat_id?>"><?=$cat_name;?></option>
									<?php } ?>
								</select>
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
