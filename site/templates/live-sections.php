<?php include("./includes/head.php");?>
<script> var live_streaming = false; var need_countdown = true; </script>
<div class="container mg-t-lg mg-b-lg serif" id="live-page">
  <div class="row header-area" style="display: none;">
    <div class="col-lg-8 col-md-7 ">
      <h1>TC Live</h1>
      <h3 class="text-muted" id="service-times">Thursdays 6:45pm &amp; Sundays at 10:45am </h3>
    </div>
    <div class="col-lg-4 col-md-5 ">
      <div class="clearfix clear"></div>
    </div>
  </div>
  <div class="row mg-t-xs">
    <div class="col-md-12 col-lg-7" id="section-video">
      <div class="video-holder" id="video-holder">
        <img src="/site/assets/files/1369/offline_image_16x9-1.jpg" width="100%">
      </div>
      <div class="countdown-block" id="countdown-block">
        <div class="countdown-holder pull-left">
          <div id="defaultCountdown"></div>
        </div>
        <div class="next-service-outer pull-right">
          <div class="next-service" id="next-service">
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="takeaway-block " id="takeaway-block"></div>
      <div class="live-sermon-info mg-t-md ">
        <div class="pull-right hidden-xs hidden-sm hidden-md mg-b-sm">
          <a href="javascript:void(0);" class=" mg-r-sm2" id="expand"><i class="fa-lg  icon-maximize-4"></i></a>
          <a href="javascript:void(0);" class="size-control-disabled" id="contract"><i class="fa-lg icon-minimize-1"></i></a>
        </div>
        <div id="live-message-details">
          
        </div>
      </div>
      <div class="text-muted mg-b-sm2" id="live-message-body">
      SHARE THIS MESSAGE: <?php echo $modules->MarkupSocialShareButtons->render();?>
      </div>
      <div class=" mg-b-lg  " id="review-questions-click-holder">
        <a href="#" id="review-questions-click" class="btn btn-left btn-sm-xs btn-default mg-r-sm "><i class="icon-document-1"></i> View Review Questions &amp; Daily Readings</a>
        <a href="#" id="connect-card" class="btn btn-left btn-sm-xs btn-default mg-r-sm"><i class="icon-right-2"></i> Connect</a>
      </div>

      <div id="review-content" class="hide mg-b-lg">
        <div id="message-id" class="hide">31003</div>
        <div class="mg-b-sm"><h4>Review Questions</h4></div>

    </div>
  </div>
  <div class="col-md-12 col-lg-5 page-section live-sidebar " id="section-sidebar">
    <?php if( !empty($page->tabbed_content) > 0 ){
   // print "<h1 style='margin-bottom:30px;'>{$section->title}</h1>";
    $t = new TemplateFile(wire('config')->paths->templates .'markup/groups/tabbed_content.php');
    $t->set('content', $page->tabbed_content);
    $out = $t->render();
    echo $out;
    }
    ?>
  </div>
</div>
</div>
<div class="row mg-t-md">
<div class="col-sm-4 text-center mg-b-md">
  <div class="icon-heart fa-3x teal mg-b-md"></div>
  <p style="padding:0px 16px;">Give to Thursday Church and take part in helping us reach every man, woman and child with the Gospel of Jesus Christ.<br><strong>Text any amount to 316.477.3223</strong></p>
  <a href="/give/" target="_blank" class="btn btn-left btn-default"><i class="icon-right-4"></i> Give Now</a>
</div>
<div class="col-sm-4 text-center mg-b-md">
  <div class="icon-group fa-3x teal mg-b-md"></div>
  <p style="padding:0px 16px;">Come join other people like you who want to grow in faith and learn more about what it means to follow Jesus.</p>
  <a href="/ministries/life-groups/" target="_blank" class="btn btn-left btn-default"><i class="icon-right-4"></i> Find a LIFE Group</a>
</div>
<div class="col-sm-4 text-center mg-b-md">
  <div class="icon-location-pin-4 fa-3x teal mg-b-md"></div>
  <p style="padding:0px 16px;">Ready to join us in person? The
    Chapel is one church with multiple locations. We'd love to have you join
  us for a Sunday service!</p>
  <a href="/locations/" target="_blank" class="btn btn-left btn-default"><i class="icon-right-4"></i> Find a Location</a>
</div>
</div>

</div>


<?php include("./includes/foot.php");?>