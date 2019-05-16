<!-- Get Messages to count -->
<?php $cntMsg = $this->Mail_model->count_mail();?>

<div class="col-md-3 m-t-10 p-r-0">
    <div class="left-menu">
        <p class="m-b-5">Menus</p>
        <a href="<?=base_url();?>home/homepage" class="btn left-menu-btn <?=($is_page=="homepagea") ? "active" : ''; ?>"><i class="fa fa-newspaper f-25 text-blue"></i> My Newsfeeds</a>
        <a href="<?=base_url();?>home/homepage" class="btn left-menu-btn <?=($is_page=="homepagea") ? "active" : ''; ?>"><i class="fa fa-calendar-alt f-25 text-blue"></i> My Calendar</a>
        <a href="<?=base_url();?>home/homepage" class="btn left-menu-btn <?=($is_page=="homepagea") ? "active" : ''; ?>"><i class="fa fa-map-marker f-25 text-blue"></i> My Map</a>
        
        <?php if($is_page=="mail" || $is_page=="sents" || $is_page=="drafts"){?>
            <p class="m-b-5 m-t-10">My Mail</p>
            <a href="<?=base_url();?>mail/mail" class="btn left-menu-btn <?=($is_page=="mail") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Inbox  
                <span class="inbCnt"><?=($cntMsg!=0) ? '<span class="badge badge-danger cntFrndReq pull-right m-t-5">'.$cntMsg.'</span>' : '';?></span>
            </a>
            <a href="<?=base_url();?>mail/sents" class="btn left-menu-btn <?=($is_page=="sents") ? "active" : ''; ?>"><i class="fa fa-paper-plane f-25 text-blue"></i> Sent</a>
            <a href="<?=base_url();?>mail/drafts" class="btn left-menu-btn <?=($is_page=="drafts") ? "active" : ''; ?>"><i class="fa fa-inbox f-25 text-blue"></i> Drafts</a>
        <?php } ?>        
    </div>
</div>