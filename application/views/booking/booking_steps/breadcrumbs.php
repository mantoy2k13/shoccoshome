<div class="col-md-12 m-t-20 text-center">
<!-- <?=$is_page;?> -->
    <div class="breadcrumb flat">
        <a href="<?=base_url();?>booking/booking_as_host" class="<?=($is_page=='booking_as_host') ? 'active' : '';?>">
            <i class="fa fa-<?=($is_page=='booking_as_host') ? 'edit' : 'check';?>"></i> Step 1: Set your dates
        </a>
        <?php if($is_page=='choose_user_calendar' || $is_page=='book_this_user'){ ?>
            <a href="<?=base_url();?>booking/choose_user_calendar" class="<?=($is_page=='choose_user_calendar') ? 'active' : '';?>"><i class="fa fa-<?=($is_page=='choose_user_calendar') ? 'edit' : 'check';?>"></i> Step 2: Choose a user</a>
        <?php } ?>
        <?php if($is_page=='book_this_user'){ ?>
            <a href="javascript:;" class="<?=($is_page=='book_this_user') ? 'active' : '';?>"><i class="fa fa-<?=($is_page=='book_this_user') ? 'edit' : 'check';?>"></i> Step 3: Fill up book form</a>
        <?php } ?>
        <!-- <a href="javascript:;"><i class="fa fa-user"></i> Step 2: Choose a user</a>
        <a href="javascript:;"><i class="fa fa-edit"></i> Step 3: Fill up book form</a>
        <a href="javascript:;"><i class="fa fa-list"></i> Final: Review and edit info</a> -->
    </div>
</div>