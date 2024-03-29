<!DOCTYPE html>
<html lang="en">
  <?php $date_today = date("d M Y");?>
  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

  <body id="page-top">

    <!-- Navigation -->
    <?php $this->load->view('common/main-nav');?>

    <!-- Banner -->
    <?php $this->load->view('common/banner');?>

    <!-- Portfolio Grid Section -->
    <section class="content font-baloo">
      <!-- 2nd Navbar -->
      <?php $this->load->view('common/profile-nav');?>

	  <div class="row m-t-10">
          <!-- Left Navbar -->
          <?php $this->load->view('common/left-nav');?>
        
          <!-- Main Content -->
		  <div class="col-md-9 m-t-10 p-l-0">
                <div class="pic-head bg-greyish" id="messages">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="javascript:;" class="btn btn-rounded btn-sm text-white bg-orange-l pull-left" onclick=writeMsg(<?=($my_friends) ? 1 : 0; ?>)><i class="fa fa-plus"></i> Compose</a>
                            <a href="<?=base_url()?>mail/mail" title="Refresh Page" class="btn btn-circle btn-sm text-white bg-black-l pull-right refreshBtn"><i class="fa fa-redo-alt"></i></a>
                        </div>
                    </div>
                </div>
                <?php if($get_mails){ foreach($get_mails as $mails){ extract($mails); ?>
                    <?php 
                        if($fullname){ $getName = $fullname; }
                        else{
                            $explodeResultArrayname = explode("@", $email);
                            $getName = ucfirst($explodeResultArrayname[0]);
                        }
                    ?>
                    <div id="emptyMsg"></div>
                    <div id="mailInbox<?=$mail_id;?>" class="mail-wrapper <?=($is_read) ? '' : 'active';?>">
                        <div class="row">
                            <div class="col-md-3 mail-user">
                                <p class="f-15">
                                    <span class="readIcon<?=$mail_id;?>">
                                        <?=($is_read) ? '<i class="fa fa-envelope-open text-blue"></i> ' : '<i class="fa fa-envelope text-blue"></i> ';?>
                                    </span> 
                                    <a class="text-blue" href="<?=base_url();?>account/view_bio/<?=$user_id;?>" title="View <?=$fullname;?>'s profile'">
                                    <?=$getName;?> (<?=$email;?>)</a>
                                </p>
                            </div>
                            <div class="col-md-7" onclick="readMsg(<?=$mail_id;?>, 1)" title="Click to view Message">
                                <p class="f-15"><span class="text-black b-700"><?=$subject ? $subject : 'No Subject';?></span> - <?=$message;?> <i class="f-12"> (<?=$this->Account_model->relative_date(strtotime($date_send));?>)</i></p>
                            </div>
                            <div class="col-md-2 text-right">
                                <a class="delMsgBtn" onclick="delMsg(<?=$mail_id;?>)" href="javascript:;"><i class="fa fa-trash text-blue"></i></a>
                            </div>
                        </div>
                    </div>
                        
                <?php }?> 
                <div class="row m-t-20">
                    <div class="col-md-12">
                        <nav class="text-center">
                            <?=$links;?>
                        </nav>
                    </div>
                </div>
                <?php } else{ ?>
                    <div class="row">
                        <div class="col-md-12 m-t-10">
                            <div class="alert alert-warning alert-dismissible f-15" role="alert">
                                <strong><i class="fa fa-check"></i> Empty!</strong> You have no new messages.
                            </div>
                        </div>
                    </div>
                    
               <?php } ?>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Write, Reply and Read Message Modal -->
    <?php $this->load->view('mail/pop-ups/write_msg');?>
    <?php $this->load->view('mail/pop-ups/read_msg');?>
    <?php $this->load->view('mail/pop-ups/reply_msg');?>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
  </body>
</html>
