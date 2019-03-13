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
                        <img class="full-width mb-3" src="<?=base_url();?>assets/img/frontpage/slider/slider1.jpg" alt="About Image"><br>
                        <img class="full-width mb-3" src="<?=base_url();?>assets/img/frontpage/slider/slider2.jpg" alt="About Image2">
                    </div>

                    <div class="col-md-7">
                       <h2 class="text-blue">Biography</h2>
                       <p class="font-baloo m-t-10">
                        In May of 2017 we rescued a 10 year old Shih Tzu, called Shocco, who has become the love of our lives....we could not imagine a life without our little fur baby! ❤️🐶<br><br>

                        We are both in our fifties and have no kids and we used to be able to travel and go out whenever we wanted to but now we are more restricted and have to plan our lives around our baby.<br><br>

                        We still like to travel and be able to do things like we used to, but in order to do so we would like to know that Shocco has a good time too and that he is well taken care of in an environment that feels like home. Also, that he is with other pets that he will get along with and won't harm him.<br>
                       </p>
                       <p class="font-baloo">
                        We would not want to leave him at a dog hotel, not knowing what other kind of dogs that would be there and how he would be treated, and he would most likely be locked up alone in a room at night.<br><br>

                        That's when we came up with the idea of being able to find and connect with people that are willing to take care of each other's pets.<br><br>

                        You find a good match and then you contact each other to see if your pets will get along and that you will agree on how you want things done.<br><br>

                        If you like each other's services you can always buy a gift, in form of a gift card, as a token of your appreciation but there is no obligation or other costs involved, just a friendly way of exchanging services when in need.<br><br>
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
