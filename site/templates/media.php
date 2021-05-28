<?php
/**
* Media template
*
*/
$type = $_GET['type'];


$media_date = date('Y-m-d', strtotime( $page->media_date ));
include("./includes/head-4.php");
//$expanded = $bitly->expand( 'http://thecha.pl/11FxTrE'  );
//$newURL = preg_replace('/\s+/', '', $newURL);
$series_part_number = '';
if( $page->rootParent == '/messages/' && $page->parent->series_standalone_year == 0)
{
//$countDown = $page->parent->numChildren;
$messages_series = $pages->find("template=media, sort=-media_date, parent=$page->parent");
$countDown = count($messages_series);
foreach($messages_series as $m) {
if( $m->id == $page->id )
{
$series_part_number = $countDown;
}
$countDown--;
}
}
//echo "<div id='main-content'>";
  // echo "<div class='container mg-t-lg mg-b-lg serif'>";
    // echo "<div class='row'>";
      ?>
      <section class="main-feature">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div id="zone-feature">
                <div class="message-card">
                  <div class="btn-group btn-group-justified message-buttons-mobile">
                    <?php if($type == 'full') { ?>
                    <a class="btn btn-primary" href="?type=message">Message Only</a>
                    <a class="btn btn-default active" href="?type=full">Full Service</a>
                    <?php } else { ?>
                    <a class="btn btn-default active" href="?type=message">Message Only</a>
                    <a class="btn btn-primary" href="?type=full">Full Service</a>
                    <?php } ?>
                  </div>
                  <div class="message-details">
                    <div class="message-details-title">
                      <h3><?php //echo "$page->title";?></h3>
                      <ul class="list-inline">
                        <li><strong>
                          <?php
                          $speakers = '';
                          if( count($page->media_speaker) )
                          {
                          $speakerTotal = count($page->media_speaker);
                          $s = 0;
                          foreach($page->media_speaker as $speaker) {
                          $speakers .= "<!--a href='".$speaker->url."'-->".$speaker->title."<!--/a-->";
                          $s++;
                          if( $speakerTotal != $s ) $speakers .= ", ";
                          }
                          }
                          ?>
                        </strong></li>
                        <li>
                          <?php
                          if($speakers != '') echo $speakers." - ";
                          echo $page->media_date;
                          ?>
                        </li>
                      </ul>
                    </div>
                    <?php ?>
                    <?php if($type == 'full') { ?>
                    <div class="message-details-info" id="full-service">
                      <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $page->full_service;?>" allowfullscreen></iframe>
                    </div>
                    <?php } else { ?>
                    <div class="message-details-info" id="message-only">
                      <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $page->youtube_id;?>" allowfullscreen></iframe>
                    </div>
                    <?php } ?>
                    <div class="content">
                      <div class="content-item">
                        <div class="item-share">
                          <p>Share this Message: <!-- ShareThis BEGIN --><span class="sharethis-inline-share-buttons"></span><!-- ShareThis END --></p>
                        </div>
                      </div>
                    </div>
                    <!-- The Modal -->
                    <div id="shareModal" class="share-modal" style="display: none;">
                      <div class="share-modal-content">
                        <div class="share-modal-header">
                          <h4>Share via:</h4>
                        </div>
                        <div class="share-modal-body">
                          <div class="sharethis-inline-share-buttons"></div>
                        </div>
                      </div>
                    </div>
                    <!--div class="message-other-messages">
                  </div-->
                </div>
                <div class="message-sidebar">
                  <div class="btn-group btn-group-justified message-buttons-desktop">
                    <?php if($_GET['type'] == 'full') { ?>
                    <a class="btn btn-default" href="?type=message">Message Only</a>
                    <a class="btn btn-default active" href="?type=full">Full Service</a>
                    <?php } else { ?>
                    <a class="btn btn-default active" href="?type=message">Message Only</a>
                    <a class="btn btn-default" href="?type=full">Full Service</a>
                    <?php } ?>
                  </div>
					<?php if($page->Study_Notes !="") {;?>
                  <div class="panel panel-default">
                    <div class="panel-heading">Related Downloads</div>
                    <div class="list-group">

                      <a href="/site/assets/files/<?php echo $page->id; ?>/<?php echo $page->Study_Notes; ?>" class="list-group-item" target="_blank"><i class="fa fa-fw fa-file-text-o"></i> Study Notes</a>
                    </div>
                  </div>
					<?php } ?>
                  <!-- more From series-->
                  <?php
                  if( $page->parent->template == 'series' && $page->parent->series_standalone_year != 1 )
                  {
                  $other_messages =  $pages->find("parent=$page->parent, sort=media_date, template=media");
                  $mediaMatches = new PageArray();
                  $mediaMatches->import($other_messages);
                  if(count($other_messages) > 1)
                  {
                  echo "<div class=\"panel panel-default\">
                    <div class=\"panel-heading\">More From This Series</div>";
                    echo ' <ol>';
                      $partNumber = 1;
                      foreach ($mediaMatches as $m) {
                      // echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
                        if($m->media_thumbnail != '') {
                        $thumb = $m->media_thumbnail;
                        }else if(count($m->parent->series_wide_graphic) > 0){
                        $thumb = $m->parent->series_wide_graphic->size(640, 360)->url;
                        }
                        else
                        {
                        $thumb = $pages->get(1008)->images->first()->size(640, 360)->url;
                        }
                        //  echo " <a href='{$m->url}' class='related-thumb'><img src='{$thumb}'  />";
                          if( $m->id == $page->id){
                          //        echo "<div class='watching-now'><span>Watching Now</span></div>";
                          }
                          echo "<!--/a-->
                          <li><a href='{$m->url}'>{$m->title}</a> ". date("M j, Y", strtotime($m->media_date))."</li>";
                          //echo "<!--span class='bold-link' style='font-size:16px;'>Part ".$partNumber." - ". date("M j, Y", strtotime($m->media_date))."</span-->" ;
                          echo '<!--/div-->';
                          $partNumber++;
                          }
                        echo '</div>';
                        }
                        }
                        ?>
                        <!-- More from series end -->
                      </div>
                    </div>
                  </div>
                  <script>
                  // Get the modals
                  var shareModal = document.getElementById('shareModal');
                  // Get the buttons that opens the modals
                  var shareButton = document.getElementById('shareButton');
                  // When the user clicks the button, open the modal
                  shareButton.onclick = function() {
                  if (navigator.share) {
                  navigator.share({
                  title: '<?php echo $page->title;?>',
                  text: '<?php echo $page->body;?>',
                  url: '<?php echo $page->url(true); ?>?type=<?php echo $type;?>',
                  })
                  } else {
                  shareModal.style.display = "block";
                  }
                  }
                  // When the user clicks anywhere outside of the modals, close them
                  window.onclick = function(event) {
                  if (event.target == shareModal ) {
                  shareModal.style.display = "none";
                  }
                  }
                  
                  //----------------------------------------
                  // Breadcrumbs
                  //----------------------------------------
                  $('.breadcrumbs li a').each(function(){
                  var breadWidth = $(this).width();
                  if($(this).parent('li').hasClass('active') || $(this).parent('li').hasClass('first')){
                  
                  } else {
                  $(this).css('width', 75 + 'px');
                  $(this).mouseover(function(){
                  $(this).css('width', breadWidth + 'px');
                  });
                  $(this).mouseout(function(){
                  $(this).css('width', 75 + 'px');
                  });
                  }
                  
                  });
                  </script>
                  
                  
                  
                  
                  <?php include("./includes/foot-4.php");?>