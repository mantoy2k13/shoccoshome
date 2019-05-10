<div class="col-md-12 m-t-20  text-center">
    <p class="f-20 b-700 text-blue m-b-0">Become a Host</p>
</div>
<div class="col-md-12 m-t-10 text-center">
<!-- <?=$is_page;?> -->
    <div class="breadcrumb flat">
        <a href="<?=base_url();?>booking/booking_as_host" class="<?=($is_page=='booking_as_host') ? 'active' : '';?>">
            <i class="fa fa-<?=($is_page=='booking_as_host') ? 'edit' : 'check';?>"></i> Step 1: Set your dates
        </a>
        <?php if($is_page=='choose_user_calendar' || $is_page=='book_this_user' || $is_page=='booking_summary'){ ?>
            <a href="<?=base_url();?>booking/choose_user_calendar" class="<?=($is_page=='choose_user_calendar') ? 'active' : '';?>"><i class="fa fa-<?=($is_page=='choose_user_calendar') ? 'edit' : 'check';?>"></i> Step 2: Choose a user</a>
        <?php } ?>
        <?php if($is_page=='book_this_user' || $is_page=='booking_summary'){ ?>
            <?php $url = $book ? base_url().'booking/update_book_user/'.$book['book_id'].'/'.$book['book_to'].'/1' : 'javascript:;';?>
            <a href="<?=$url;?>" class="<?=($is_page=='book_this_user') ? 'active' : '';?>"><i class="fa fa-<?=($is_page=='book_this_user') ? 'edit' : 'check';?>"></i> Step 3: Fill up book form</a>
        <?php } ?>
        <?php if($is_page=='booking_summary'){ ?>
            <a href="javascript:;" class="<?=($is_page=='booking_summary') ? 'active' : '';?>"><i class="fa fa-check"></i> Finish: Booking Summary</a>
        <?php } ?>
    </div>
</div>