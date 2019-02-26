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
			<div class="panel panel-orange">
				<div class="panel-heading" style="padding:15px;">
                    <span class="b-700 text-white"><i class="fa fa-pen"></i> Create New Post</span>
                </div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<label for="message_to">Message to:</label>
							<select class="form-control" name="message_to">
								<option value="Lee Gee">Lee Gee</option>
								<option value="Thomas Wood">Thomas Wood</option>
							</select>
                        </div>
                        <div class="col-md-6">
							<label for="subject">Subject:</label>
							<input type="text" class="form-control" placeholder="Subject">
						</div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-12">
							<label for="message">Message:</label>
							<textarea name="message" class="form-control" cols="30" rows="5" placeholder="Write a message..."></textarea>
						</div>
					</div>
 
					<div class="row text-center">
						<div class="col-md-12">
							<button type="submit" class="btn bg-orange sub-btn">Send</button>
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
