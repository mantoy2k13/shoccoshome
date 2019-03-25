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
          <div class="row">
            <div class="col-md-12">
              <div class="container bg-ornge-rd">
                  Dashboard
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-lg-6">
                  Dashboard 
              </div>
               <div class="col-lg-6">
                    <div id='displayAvailtycalendar'></div>
              </div>
          </div>
            <div class="row f-list-wrap">
            <div class="col-md-6">

              <?php
              // print_r($get_all_users_data);
              foreach($get_all_users_data as $show_all_user_data){

              $userid=$show_all_user_data->id;
              $pettotalcat_show=$this->Pet_model->userwisecatlist($userid);
              //echo "<pre>";
              //print_r($pettotalcat_show);

              $showcatcount='';

              if($pettotalcat_show){
              foreach($pettotalcat_show as $catcountshow){
              $cat_name=$catcountshow->cat_name;
              $cat_count=$catcountshow->cat_count;
              $showcatcount.='<a href="javascript:;" class="btn bg-orange btn-round"> '.$cat_name.' ('.$cat_count.')</a>';
              }
              }else{
              $showcatcount.='<a href="javascript:;" class="btn bg-orange btn-round"> No Pet Data </a>';
              }

              //echo $pettotalcat_show['cat_id'];
              ?>

            <div class="card bg-grey friend-card">
            <div class="card-body">
              <div class="friend-img">
                <?php
                $user_img=$show_all_user_data->user_img;
                if($user_img) { ?>
                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$userid;?>/<?=$show_all_user_data->user_img;?>" alt="Profile Image Big">
                <?php }else{ ?>
                  <img src="<?=base_url();?>assets/img/pictures/default_pet.png" alt="Pet Image">
                <?php } ?>
              </div>
              <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Friends</span>
              <div class="dropdown-menu" aria-labelledby="f-menu">
              <a class="dropdown-item" href="javascript:;">Block</a>
              <a class="dropdown-item" href="javascript:;">Unfriend</a>
              </div>
              <p class="text-head">
                <a href="javascript:;">
                <?php 
                if($show_all_user_data->fullname){
                echo $show_all_user_data->fullname;
                }else{
                $c_email=$show_all_user_data->email;
                $explodeResultArrayname = explode("@", $c_email);
                echo ucfirst($explodeResultArrayname[0]);
                }
                ?>
                </a> 
              </p>
              <p class="text-desc">
                <?= $show_all_user_data->address ? $show_all_user_data->address : 'No data' ?>
              </p>

            <div>
              
            <p class="text-desc">
               <?= $showcatcount; ?>
            </p>
            </div>

            </div>
            </div>

            <?php } ?>
            </div>

              <div class="col-md-6">
              <?php 
                  if($get_date){
                    $date=json_decode($get_date[0]['sitter_availability']);
                    $date_from = $date[0];
                    $get_date_to = $date[1];
                    $date_to = date('Y-m-d', strtotime($get_date_to . ' +1 day'));
                  }
                  else{
                    $get_date_to = '';
                    $date_from = '';
                    $date_to = '';
                  }
                  
                ?>
                <input type="hidden" id="a_date_from" value="<?=$date_from;?>">
                <input type="hidden" id="a_date_to" value="<?=$date_to;?>">
                  
              </div>
            </div>
          </div> <!-- Close Main Content -->
        </div>
        </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
   
    <script>
          document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('displayAvailtycalendar');
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
    </script>
  </body>

</html>
