<div class="modal fade" style="" id="share-your-story" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1"> Share Your Story </h4>
        <a class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">Close <i class="fas fa-times-circle"></i></span>
        </a>
      </div>
      <div class="modal-body">
        <!-- insert form here -->
        <iframe onload="javascript:parent.scrollTo(0,0);" height="564" style="width:100%;border:none" src="<?php echo $sharestory;?>" title="Share Your Story"></iframe>
        <!-- insert form above this line -->
      </div>
    </div>
  </div>
</div>


<div class="modal fade" style="" id="share-this" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2"> Share This With A Friend </h4>
        <a class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">Close <i class="fas fa-times-circle"></i></span>
        </a>
      </div>
      <div class="modal-body">
        <!-- insert form here -->
        <!-- insert form above this line -->
      </div>
    </div>
  </div>
</div>


<div class="modal fade" style="" id="contact-us" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel3"> Contact Us </h4>
        <a class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">Close <i class="fas fa-times-circle"></i></span>
        </a>
      </div>
      <div class="modal-body">
        <!-- insert form here -->
        <iframe onload="javascript:parent.scrollTo(0,0);" height="859" style="width:100%;border:none" src="<?php echo $contactus;?>" title="How Can We Help?"></iframe>
        <!-- insert form above this line -->
      </div>
    </div>
  </div>
</div>


<div class="modal fade" style="" id="giving" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"><br /><br />
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel4"><i class="fas fa-calendar-plus"></i> Online Giving</h4>
        <a class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">Close <i class="fas fa-times-circle"></i></span>
        </a>
      </div>
      <div class="modal-body" >
        <iframe id="givinglink" name="give" src="https://faithlife.com/thursday-church-j/give?embed=true&ssi=0" style="width:800px;height:800px"></iframe>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" style="" id="prayer-request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel5">Prayer Request</h4>
        <a class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">Close <i class="fas fa-times-circle"></i></span>
        </a>
        
      </div>
      <div class="modal-body" style="height:90%;width:100%;">
        <!-- insert form here -->
        <iframe onload="javascript:parent.scrollTo(0,0);" height="694" style="width:100%;border:none" src="<?php echo $prayerrequests; ?>" title="Prayer Request"></iframe>
        <!-- insert form above this line -->
      </div>
    </div>
  </div>
</div>


<div class="modal fade" style="" id="tech-support" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel6">Technical Support Request </h4>
        <a class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">Close <i class="fas fa-times-circle"></i></span>
        </a>
      </div>
      <div class="modal-body" style="height:90%;width:100%;">
        <!-- insert form here -->
        <iframe onload="javascript:parent.scrollTo(0,0);" height="529" style="width:100%;border:none" src="<?php echo $techsupport;?>" title="Technical Support Request"></iframe>
        <!-- insert form above this line -->
      </div>
    </div>
  </div>
</div>


<div class="modal fade" style="" id="news-bar-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel7">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel7" style="height:90%;width:100%;"><?php echo $page->notificationtitle; ?></h4>
        <a class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">Close <i class="fas fa-times-circle"></i></span>
        </a>
      </div>
      <div class="modal-body">
        <?php echo $page->notificationdetails;?>
        <!--a href="<?php //echo $page->notificationurl;?>" class="btn btn-outline-light"><?php //echo $page->notificationbtn;?></a-->
      </div>
    </div>
  </div>
</div>