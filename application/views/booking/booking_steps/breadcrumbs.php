<div class="col-md-12 m-t-10 text-center">
<?php $book_type = $this->uri->segment(3); ?> 
    <div class="breadcrumb flat">
        <a href="<?=base_url();?>booking/<?=($book_type==2)?'become_a_host':'become_a_guest';?>" class="<?=($is_page=='become_a_host' || $is_page=='become_a_guest') ? 'active' : '';?>">
            <i class="fa fa-<?=($is_page=='become_a_host' || $is_page=='become_a_guest') ? 'edit' : 'check';?>"></i> Step 1: Set your dates
        </a>
        <?php if($is_page=='choose_user_calendar' || $is_page=='book_user' || $is_page=='booking_summary'){ ?>
            <a href="<?=base_url();?>booking/choose_user_calendar/<?=$book_type;?>" class="<?=($is_page=='choose_user_calendar') ? 'active' : '';?>"><i class="fa fa-<?=($is_page=='choose_user_calendar') ? 'edit' : 'check';?>"></i> Step 2: Choose a user</a>
        <?php } ?>
        <?php if($is_page=='book_user' || $is_page=='booking_summary'){ ?>
            <?php $url = $book ? base_url().'booking/book_user/'.$book_type.'/'.$book['book_to'] : 'javascript:;';?>
            <a href="<?=$url;?>" class="<?=($is_page=='book_user') ? 'active' : '';?>"><i class="fa fa-<?=($is_page=='book_user') ? 'edit' : 'check';?>"></i> Step 3: Fill up book form</a>
        <?php } ?>
        <?php if($is_page=='booking_summary'){ ?>
            <a href="javascript:;" class="<?=($is_page=='booking_summary') ? 'active' : '';?>"><i class="fa fa-check"></i> Finish: Booking Summary</a>
        <?php } ?>
    </div>
</div>