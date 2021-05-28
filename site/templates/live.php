<?php include("./includes/head.php");?>



<?php if($live) { ?>

<script>

    var live_streaming = true;

    var need_countdown = false;

</script>

<?php }else{ ?>

<script>

     var live_streaming = false;

     var need_countdown = true;

</script>

<?php } ?>



  <div class="container mg-t-lg mg-b-lg serif" id="live-page">

    <div class="row mg-t-xs">

      <div class="col-md-12 col-lg-7" id="section-video">

        <div class="video-holder" id="video-holder">

          <div class="fluid-width-video-wrapper">

            <img src="//thursdaychurch.github.io/assets/images/watch/live/offline_image_16x9.jpg" width="100%" />

          </div>

        </div>

        <div class="countdown-block" id="countdown-block">

          <div class="countdown-holder pull-left">

            <div id="defaultCountdown">

              

            </div>

          </div>

          <div class="next-service-outer pull-left">

            <div class="next-service" id="next-service">

            </div>

          </div>

          <div class="clearfix"></div>

        </div>

        <div class="takeaway-block " id="takeaway-block"></div>

        <div class="live-sermon-info mg-t-md ">

          <div class="pull-right hidden-xs hidden-sm hidden-md mg-b-sm"><a href="javascript:void(0);" class=" mg-r-sm2" id="expand"><i class="fa-lg  icon-maximize-4"></i></a>

          <a href="javascript:void(0);" class="size-control-disabled" id="contract"><i class="fa-lg icon-minimize-1"></i></a>

        </div>

        <div id="live-message-details">

          <h2>

          

          </h2>

          <p>

            

          </p>

          <h4>

          

          </h4>

          <p>

            

          </p>

        </div>

      </div>

      <div class="text-muted mg-b-sm2 hide" id="live-message-body">

        <p>

          

        </p>

      </div>

      <div class=" mg-b-lg  " id="review-questions-click-holder">

        <a href="{{ site.url }}/watch/" id="review-questions-click" class="btn btn-left btn-sm-xs btn-default mg-r-sm "><i class="icon-document-1"></i> View Recent sermons</a>

        <a href="javascript:void(0)" target="_blank" class="btn btn-left btn-sm-xs btn-default mg-r-sm"><i class="icon-right-2"></i> Connect</a>

      </div>

      <div id="review-content" class="hide mg-b-lg">

        <div id="message-id" class="hide">31003</div>

        <div class="mg-b-sm"><h4>Review Questions</h4></div>

      </div>

    </div>

    <div class="col-md-12 col-lg-5 page-section live-sidebar " id="section-sidebar">

      <ul class="nav nav-tabs nav-justified">

        <li class="active "><a href="#chat-tab" data-toggle="tab">Chat</a></li>

        <li class=" "><a href="#notes-tab" data-toggle="tab">Notes</a></li>

        <li class=" "><a href="#response-tab" data-toggle="tab">Schedule</a></li>

        <li class=" "><a href="#bible-tab" data-toggle="tab">Bible</a></li>

      </ul>

      <div class="tab-content" id="tabbed-content">

        <div class="tab-pane active" id="chat-tab">

          <p>Chat unavailable</p>

        </div>

        <div class="tab-pane " id="notes-tab">

          <textarea name="editor1" rows="25">

          

          </textarea>

          <a href="#notes-Modal">Email Study Notes</a>

        </div>

        <div class="tab-pane" id="response-tab">

          <div class="service-times">

            <h3 class="text-muted" id="service-times">

            

            </h3>

          </div>

        </div>

        <div class="tab-pane" id="bible-tab">

          

        </div>

      </div>

    </div>

  </div>



<div class="row mg-t-md">

  <div class="col-sm-4 text-center mg-b-md">

    <div class="icon-heart fa-3x teal mg-b-md"></div>

    <p style="padding:0px 16px;">Give to Thursday Church and take part in helping us reach every man, woman and child with the Gospel of Jesus Christ.<br><strong>Text any amount to 716.333.5511</strong></p>

    <a href="/giving/one-time/" target="_blank" class="btn btn-left btn-default"><i class="icon-right-4"></i> Give Now</a>

  </div>

  <div class="col-sm-4 text-center mg-b-md">

    <div class="icon-group fa-3x teal mg-b-md"></div>

    <p style="padding:0px 16px;">Come join other people like you who want to grow in faith and learn more about what it means to follow Jesus.</p>

    <a href="/connect/small-groups/" target="_blank" class="btn btn-left btn-default"><i class="icon-right-4"></i> Join A Small Group</a>

  </div>

  <div class="col-sm-4 text-center mg-b-md">

    <div class="icon-location-pin-4 fa-3x teal mg-b-md"></div>

    <p style="padding:0px 16px;">Ready to join us in person? The

      Chapel is one church with multiple locations. We'd love to have you join

    us for a Sunday service!</p>

    <a href="/about/im-new/" target="_blank" class="btn btn-left btn-default"><i class="icon-right-4"></i> Find A Location</a>

  </div>

</div>

<div class="row">

  <div class="col-md-12 text-center text-muted mg-t-sm">

    <span class="mg-b-xs"><strong><a class="mg-l-xs  inline-popup-link" href="#tech-support-popup">Having trouble viewing this?</a></strong></span>

    <div class="visible-xs"><br></div><span class="mg-b-xs mg-l-md"><strong><a class=" inline-popup-link" href="#prayer-request-popup">Need prayer?</a></strong></span>

  </div>

</div>

</div>

<?php include("./includes/foot.php");?>