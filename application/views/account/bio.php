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
          <?php foreach($view_bio as $bio){ extract($bio); ?>
            <?php 
                if($fullname){
                    $getName = $fullname;
                }else{
                    $explodeResultArrayname = explode("@", $email);
                    $getName = ucfirst($explodeResultArrayname[0]);
                }
            ?>
		  <div class="col-md-9 m-t-10 bio-wrapper-info p-l-0">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 bio-head">
                                <div class="bio-img">
                                    <?php if($user_img) { ?>
                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                    <?php }else{ ?>
                                        <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                    <?php } ?>
                                </div>
                                <a href="<?=base_url();?>account/account" class="btn bg-orange text-white pull-right btn-sm"><i class="fa fa-edit"></i> Edit Bio</a>
                                <p class="f-30 b-700 text-orange-d m-b-0"><?=$getName;?></p>
                                <p class="f-25 b-700 text-blue m-b-0"><?=($occupation)?$occupation:'No Occupation';?></p>
                                <p class="f-20 m-b-0 text-black-l"> <?php if($street&&$city&&$zip_code&&$state&&$country){ ?> <?=$street.' '.$city.', '.$zip_code.', '.$state.', '.$country;?><?php } else { echo 'No Address'; }?></p>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <div class="prof-desc">
                                    <div class="row">
                                        <div class="container">
                                            <p class="text-black"><?=($bio)?nl2br($bio):"No Description";?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-20">
                                    <div class="col-md-12">
                                        <div class="pic-head bg-greyish">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <i class="fa fa-paw f-25 text-blue"></i> Pets
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-10 bio-pet-grp">
                                            <?php $my_pets = $this->Account_model->get_my_pets($id);?>
                                            <?php if($my_pets){foreach($my_pets as $pets){ extract($pets); ?>
                                                <div class="col-md-6">
                                                    <div class="card bg-grey friend-card">
                                                        <div class="card-body">
                                                            <div class="pet-bio-img">
                                                                <?php if($primary_pic) { ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$primary_pic;?>" alt="Pet Image">
                                                                <?php }else{ ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/default_pet.png" alt="Default Pet Image">
                                                                <?php } ?>
                                                            </div>
                                                            <button class="btn btn-info btn-xs pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i></button>
                                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/add_new_pet/<?=$pet_id;?>">Edit Pet</a>
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>">Pet Details</a>
                                                            </div>
                                                            <p class="text-blue f-20 b-700"><a href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>"><?=$pet_name;?></a> </p>
                                                            <p class="f-15 text-black"><?=$description;?></p>
                                                            <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$breed_name;?> (<?=$cat_name;?>)</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } } else { ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> You have no pets added. Click <a href="<?=base_url();?>pet/add_new_pet">here</a> to add new pets.
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="profile-info-wrapper">
                            <p class="f-20 b-700 text-blue">Contact Info</p>
                            <p class="f-15"><span class="text-black b-700">Name</span><br>
                                <?=$getName;?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Email</span><br><?=$email;?></p>
                            <p class="f-15"><span class="text-black b-700">Mobile</span><br>
                                <?=($mobile_number)?$mobile_number:"No Number";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Gender</span><br>
                                <?=($gender)?$gender:"No Gender";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Occupation</span><br>
                                <?=($occupation)?$occupation:"No Occupation";?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-md-6">
                        <form onchange="$('.setTimeMsg').html('');" id="setTimeForm">
                            <p class="f-20 b-700 text-orange-d m-b-0">As a sitter availability</p>
                            <div class="row m-t-10">
                                <div class="col-md-12 setTimeMsg">
                                    
                                </div>
                            </div>
                            
                            <?php if($sitter_availability){ 
                                $aDate = json_decode($sitter_availability);
                                $get_date_from = $aDate[0]; $today = date('Y-m-d');
                                $date_from = ($get_date_from < $today) ? $today : $get_date_from;
                                $get_date_to = $aDate[1];
                                $date_to = date('Y-m-d', strtotime($get_date_to . ' +1 day'));
                            } else{ 
                                $get_date_to = '';
                                $date_from = '';
                                $date_to = '';  
                            } ?>
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <label for="date_from">Date From: </label>
                                    <input type="hidden" id="curr_date" value="<?=date('Y-m-d');?>">
                                    <input type="date" class="form-control" name="date_from" id="date_from" value="<?=$date_from;?>">
                                </div>
                                <div class="col-md-12">
                                    <label for="date_to">Date To: </label>
                                    <input type="date" class="form-control" name="date_to" id="date_to" value="<?=$get_date_to;?>">
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <button type="button" onclick="checkDateTime()" class="btn bg-orange text-white col-md-12"><i class="fa fa-check"></i> Save Time</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p class="f-20 b-700 text-orange-d m-b-0">Your Availability Calendar</p>
                        <input type="hidden" id="a_date_from" value="<?=$date_from;?>">
                        <input type="hidden" id="a_date_to" value="<?=$date_to;?>">
                        <div class="m-t-20" id='availability'></div>
                    </div>
                </div>
            </div>
          <?php } ?>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('availability');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                header: {
                    left: 'month',
                    center: 'title',
                    right: 'prev,next today'
                },
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                eventLimit: false, // allow "more" link when too many events
                events: [
                    {
                        title: 'Avalable',
                        start: $('#a_date_from').val(),
                        end: $('#a_date_to').val(),
                        color: '#00f9f0',
                        rendering: 'background'
                    }
                ],
            });
            
            calendar.render();
        });

        var checkDateTime = ()=>{
            var curr_date  = $('#curr_date').val();
            var date_from  = $('#date_from').val();
            var date_to    = $('#date_to').val();
            
            if(date_from && date_to){
                var date_today = new Date(curr_date);
                var given_date_from = new Date(date_from);
                var given_date_to = new Date(date_to);

                if(given_date_from < date_today){
                    $('.setTimeMsg').html(setMsg('Date From must be equal or greater than the date today'));
                    $('#date_from').focus();
                } else if(given_date_to < date_today){
                    $('.setTimeMsg').html(setMsg('Date To must be equal or greater than the date today'));
                    $('#date_to').focus();
                } else{
                    $.ajax({
                        url: base_url+'account/set_sitter_time',
                        method: 'POST',
                        data: { date_from: date_from, date_to:date_to },
                        success: (res)=>{
                            if(res==1){
                                swal({title: "Success!", text: "Set time availability successful.", type: 
                                "success"},
                                    function(){ 
                                        location.reload();
                                    }
                                );
                            } else{
                                swal('Failed!', 'A problem occured please try again.', 'error');
                            }
                        }
                    });
                }
            } else{
                $('.setTimeMsg').html(setMsg('Please set all dates to proceed'));
            }
        }

        function setMsg(msg){
            var setMsg = '';
            setMsg += '<div class="alert alert-danger f-15 alert-dismissible" role="alert">';
            setMsg += '<strong><i class="fa fa-times"></i> Oops!</strong> '+msg+'.';
            setMsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            setMsg += '<span aria-hidden="true">&times;</span>';
            setMsg += '</button>';
            setMsg += '</div>';
            return setMsg;
        }

    </script>
  </body>

</html>
