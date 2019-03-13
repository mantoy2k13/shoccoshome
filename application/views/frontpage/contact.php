<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

  <body id="page-top">

    <!-- Navigation -->
    <?php $this->load->view('common/main-nav');?>

    <!-- Banner -->
    <?php $this->load->view('frontpage/banner');?>

    <!-- Portfolio Grid Section -->
    <section class="content">

	  <div class="row m-t-10">
        
          <!-- Main Content -->
		  <div class="col-md-12 m-t-10 p-l-0">
                <div class="row">
                    <div class="col-md-5">
                        <img class="full-width mb-3" src="<?=base_url();?>assets/img/frontpage/about.jpg" alt="Contact Image">
                    </div>
                    <div class="col-md-7">
                       <h2 class="text-blue">Contact Us</h2>
                       <p class="font-baloo m-t-10">
                          We will update this content soon..
                       </p>
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
