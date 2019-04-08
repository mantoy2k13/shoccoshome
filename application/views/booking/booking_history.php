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
            <?php $bPage = $this->uri->segment(3); ?>
				<div class="pic-head bg-greyish">                
                    <div class="row">
                        <div class="col-md-12">
                            <i class="fa fa-book f-25 text-blue"></i> Booking History 
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>booking/booking_history/1" class="p-nav b-700 f-14 <?=($bPage==1) ? 'active' : '';?>">Pending</a>
                            <a href="<?=base_url();?>booking/booking_history/2" class="p-nav b-700 f-14 <?=($bPage==2) ? 'active' : '';?>">Approved</a>
                            <a href="<?=base_url();?>booking/booking_history/3" class="p-nav b-700 f-14 <?=($bPage==3) ? 'active' : '';?>">Completed</a>
                            <a href="<?=base_url();?>booking/booking_request/1" class="btn bg-blue-a btn-xs pull-right text-white"><i class="fa fa-history"></i> Booking Request</a>
                            <a href="javascript:;" class="btn bg-orange btn-xs pull-right text-white m-r-5" data-toggle="modal" data-target="#booking_modal"><i class="fa fa-search"></i> Find a home</a>
                        </div>
                    </div>
                </div>

				<div class="row form-group m-t-20">
                <?php if($booking_history){ foreach($booking_history as $bl){ extract($bl);?>
					<div class="col-md-6">
						<div class="card bg-grey friend-card">
							<div class="card-body">
								<div class="friend-img">
                                    <?php if($user_img) { ?>
                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                    <?php }else{ ?>
                                        <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                    <?php } ?>
								</div>
								<div class="options27">
									<span class="btn bg-orange pull-right btn-xs text-white dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</span>
									<div class="dropdown-menu" aria-labelledby="f-menu">
										<a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">Booking Info</a>
										<a onclick="cancelBook(<?=$book_id;?>)" class="dropdown-item" href="javascript:;">Cancel Booking</a>
										<a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
									</div>
								</div>
								<p class="text-head"><a href="<?=base_url();?>account/view_bio/<?=$id?>"><?=($fullname) ? $fullname : "No Name";?></a> </p>
                                <p class="text-desc"> <?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></p>
                                <p class="f-14">Email: <span class="b-700 text-black"><?=$email;?></span></p>
								<p class="text-desc">
									<span class="badge badge-danger f-12 m-t-10"><i class="fa fa-check"></i> Waiting for approval</span>
								</p>
							</div>
						</div>
					</div>
                <?php } } else{ ?>
                    <div class="col-md-12">
                        <div class="alert alert-info f-15">
                            <strong><i class="fa fa-check"></i> Empty!</strong> You have no <?=($bPage==1) ? 'Pending' : ($bPage==2) ? 'approved' : 'completed';?> booking request.</i>
                        </div>
                    </div>
                <?php } ?>
				</div>
			</div>
			<!-- Close Main Content -->
		</div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('booking/booking_modal');?>
    <?php $this->load->view('common/footer');?>
	<?php $this->load->view('mail/pop-ups/inst_msg');?>
    <script>
        var cancelBook = (bid)=>{
            swal({
                title: "Cancel?",
                text: "This booking will be deleted permamently.",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, cancel it!",
                closeOnConfirm: false,
                confirmButtonColor: "#f77506",
                showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    url: base_url + "booking/cancel_booking/"+bid,
                    success: function(res){
                        if(res==1){
                            swal({title: "Cancelled!", text: 'Booking was cancelled sucessfully!', type: 
                                "success"}, function(){ location.reload(); });
                        } else{
                            swal("Failed",'A problem occured please try again.', 'error');
                        }
                    }
                }); 
            });
        }
    </script>
  </body>

</html>
