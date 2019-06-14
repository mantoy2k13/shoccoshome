<!-- Search Modal -->
<?php 
  $page = array('mainpage', 'about', 'contact', 'friends', 'friend_request', 'mail', 'sents', 'drafts', 'bio', 'view_bio');
  if(!(in_array($is_page,$page))){ ?>
  <?php $this->load->view('common/search_modal');?>
<?php } ?>
<footer class="footer text-center font-baloo">
      <div class="container">
        <div class="row">
          <div class="col-md-3 mb-5 mb-lg-0">
            <p class="lead mb-0">
				<img class="img-responsive" src="<?=base_url();?>assets/img/logo.png" alt="Navbar Logo">
			</p>
          </div>
          <div class="col-md-3 text-left foot-links">
            <p class="lead mb-0"><a href="<?=base_url();?>home/about">About</a></p>
            <p class="lead mb-0"><a href="<?=base_url();?>home/user_agreement">User Agreement</a> </p>
            <p class="lead mb-0"><a href="<?=base_url();?>home/terms_and_conditions">Terms and Conditions</a> </p>
            <p class="lead mb-0"><a href="<?=base_url();?>home/policy">Privacy Policy</a> </p>
		  </div>
		  <div class="col-md-3 text-left">
            <p class="lead mb-0"><i class="fa fa-phone text-orange"></i> <a href="tel:000000" class="text-white">(000) 000-0000 </a></p>
            <p class="lead mb-0"><i class="fa fa-envelope text-orange"></i> <a href="mailto:site@email.com" class="text-white">Email: site@email.com </a></p>
            <p class="lead mb-0"><i class="fa fa-home text-orange"></i> 5042 Wilshire Blvd Los Angeles 90036 </p>
		  </div>
		  <div class="col-md-3 mb-5 mb-lg-0 font-baloo">
            <h4 class="text-uppercase mb-4 font-baloo">Follow Us</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn bg-orange btn-outline-light btn-social text-center rounded-circle" href="javascript:;">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn bg-orange btn-outline-light btn-social text-center rounded-circle" href="javascript:;">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn bg-orange btn-outline-light btn-social text-center rounded-circle" href="javascript:;">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn bg-orange btn-outline-light btn-social text-center rounded-circle" href="javascript:;">
                  <i class="fab fa-pinterest"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn bg-orange btn-outline-light btn-social text-center rounded-circle" href="javascript:;">
                  <i class="fab fa-google-plus-g"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container font-baloo">
        <small>Copyright &copy; <?=date('Y');?> - Designed by TBL Tech Nerds</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <?php if($this->session->userdata('user_email')){ $is_complete = $this->Account_model->is_complete();
        if(!$is_complete['is_complete']){ ?>
        <!-- Welcome Modal -->
        <div class="modal fade welcomeModal font-baloo" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-baloo" id="exampleModalLongTitle">Hi! Welcome to Shocco's Home!</h5>
                </div>
                <div class="modal-body">
                        You can not add your pets if profile is not completed. Adding of pets needs your profile address. Do you want to update your profile now? <br>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" onclick="compLater()" class="btn btn-danger">Maybe, Later</a>
                    <a href="<?=base_url();?>account/account" class="btn btn-primary">Yes, Update it!</a>
                </div>
                </div>
            </div>
        </div>
    <?php } } ?>

    <!-- JS Files -->
    <?php $this->load->view('common/js'); ?>