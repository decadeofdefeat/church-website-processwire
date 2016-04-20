<?php
/**
 * Home template
 *
 */
include("./includes/head.inc");
?>

<div id='bar-green'>


</div>

<div class='section section-gray'>
  <div class='container pd-t-lg pd-b-lg'>
    <div class="row">

        <?php
            $cache = $modules->get("MarkupCache");
            if(!$data = $cache->get("home_top3", 2592000)) {
                 foreach ($page->home_block as $block)
                 {
                   if( $block->hide_me != 1 )
                   {


                    $data .= '<div class="col-xs-12 col-sm-4 col-md-4"> <div class="home-content-block">';

                    if( $block->cdn_image != '' )
                        $home_top_img = $block->cdn_image;
                    else if( count($block->thumbnail) > 0)
                        $home_top_img = $block->thumbnail->url;

                    $data .= "<a href='".$block->link."'><img src='".$home_top_img."' alt='".$block->title."' class='img-responsive img-full-width'/></a>";
                    $data .= "<div class='home-para-block'>";
                    $data .= "<h3><a href='".$block->link."'>".$block->title."</a></h3>";
                    $data .= $block->body."</div> </div></div>";
                  }
                }
                $cache->save($data);
            }
            echo $data;
        ?>

    </div>
  </div>
</div>


 <?php

            if(!$data = $cache->get("home_recent_message", 5000)) {

                $currentDate = date("Y-m-d");
                $recent_message = $pages->get("has_parent='/sermons/', template=media, sort=-media_date, youtube_id!=''");
                $pID = $recent_message->parent->id;
                $recent_series = $pages->get("id=".$pID."");
                if( count($recent_series->homepage_background)> 0 || $recent_series->homepage_background_cdn != '')
                {
                  if( $recent_series->homepage_background_cdn != '')
                  {
                     $series_bg = $recent_series->homepage_background_cdn;
                  }
                  else
                  {
                     $series_bg = $recent_series->homepage_background->url;
                  }

                  if(  $recent_series->homepage_transparent_logo_cdn != '' )
                  {
                    $series_logo = $recent_series->homepage_transparent_logo_cdn;
                  }
                  else
                  {
                     $series_logo = $recent_series->homepage_transparent_logo->first()->url;
                  }


                }
                $series_part_number = '';
                if( $recent_series->series_standalone_year == 0 )
                {
                  $messages = $pages->find("template=media, sort=-media_date, parent=$recent_series");
                  $countDown = count($messages);

                  foreach($messages as $m) {

                    if( $m->id == $recent_message->id )
                    {
                        $series_part_number = $countDown;
                    }
                    $countDown--;
                  }
                }

                $speakers = '';
                if( count($recent_message->media_speaker) )
                {

                  $speakerTotal = count($recent_message->media_speaker);
                  $s = 0;
                  foreach($recent_message->media_speaker as $speaker) {
                       $speakers .= $speaker->title;
                       $s++;
                       if( $speakerTotal != $s ) $speakers .= ", ";
                  }

                }

                $seriesTitle = $recent_series->title;
                if($recent_series->series_standalone_year == 1 ) $seriesTitle = '';


                $data .= "<div class='section section-series' style='background: #565656 url(\"".$series_bg."\") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover;height:auto;'>

  <div class='container pd-t-lg pd-b-lg'>
    <div class=\"row center-row-series\">
       <div class='col-xs-12 col-sm-6 col-md-6 center-col-series' id='current-series-graphic'>
          <div class='series-img-holder'>
            <img src='".$series_logo."' alt='".$recent_message->title."' class='img-responsive'/>
          </div>
       </div>
        <div class='col-xs-12 col-sm-6 col-md-6 center-col-series' style='padding:0px 40px;'>
            <!-- recent message goes here -->
            <h4>RECENT MESSAGE</h4>
            <h2>".$recent_message->title."</h2>
            <h3>".$seriesTitle."";
             if( $series_part_number != '') $data .= " (Part ".$series_part_number.")";
            $data .= "</h3>
            <p>".$recent_message->media_date."";
            if($speakers != '')  $data .= " &middot; ".$speakers;
            $data .= "</p>
            <a class='btn btn-default btn-clear btn-left mg-t-sm' href='".$recent_message->url."'>Watch Now</a>
                     </div>
                  </div>
                </div>

              </div>";
                $cache->save($data);
            }
            echo $data;
        ?>






<div class='section section-locations' >
  <div class='container pd-t-lg pd-b-lg'>

    <?php

    $lp_times = 'Sundays: 9:15am &amp; 11:15am';
    $cp_times = 'Sundays: 9am &amp; 11am';
    $ck_times = 'Sundays: 9:15am';
    $home_service_times = 'Service Times';

    ?>

    <div class="row">
       <div class='col-md-12 pd-b-md text-center'>
           <h1>Locations &amp;<span class='hidden-sm hidden-md hidden-lg'><br/></span> <?php echo $home_service_times;?></h1>
      </div>
    </div>

    <div class='row'>

            <div class="col-xs-12 col-sm-4 col-md-4 ">

            <div class='pd-xs'>
              <a href='#'><img src='/site/assets/files/1/map1.jpg' class='img-responsive img-full-width'/></a>

              <h3>Fairhaven Campus</h3>
             <p class='campus-times'><?php echo $ck_times;?></p>

               <ul class="fa-ul">
                <li><a href='http://thecha.pl/1CZyBlH' target="_blank"><i class="fa-li icon-location-pin-1"></i>
                                 345 Belt Circle<br/>
                                 Fairhaven, NY 14225</a></li>
                <li><i class="fa-li icon-call-2"></i>716.555.1234</li>
              </ul>
               <div class=' mg-t-sm2'><a href='#' class='btn btn-default btn-left '><i class='icon-right-4 icon-fw'></i> Campus Info</a></div>
            </div>

        </div>

         <div class="col-xs-12 col-sm-4 col-md-4">
             <div class='pd-xs'>
            <a href='#'><img src='/site/assets/files/1/map2.jpg'   class='img-responsive img-full-width'/></a>

            <h3>Gilroy Campus</h3>
           <p class='campus-times'><?php echo $cp_times;?></p>

           <ul class="fa-ul">

                <li><a href='http://google.com' target="_blank"><i class="fa-li icon-location-pin-1"></i>123 Fake Street<br/>
            Gilroy, NY, 14068</a></li>
              <li><i class="fa-li icon-call-2"></i>716.555.2636</li>
            </ul>
            <div class='mg-t-sm2'><a href='#' class='btn btn-default btn-left  '><i class='icon-right-4 icon-fw'></i> Campus Info</a></div>
            </div>
        </div>

         <div class="col-xs-12 col-sm-4 col-md-4">
           <div class='pd-xs'>
            <a href='#'><img src='/site/assets/files/1/map3.jpg'  class='img-responsive img-full-width'/></a>

             <h3>Meadowville Campus</h3>
           <p class='campus-times'><?php echo $lp_times;?></p>

             <ul class="fa-ul">
               <li><a href="http://google.com" target="_blank"><i class="fa-li icon-location-pin-1"></i>124 Brody Drive<br/>
            Meadowville, NY 14094</a></li>
              <li><i class="fa-li icon-call-2"></i>716.555.4050</li>
            </ul>
             <div class=' mg-t-sm2'><a href='#' class='btn btn-default btn-left'><i class='icon-right-4 icon-fw'></i> Campus Info</a></div>
            </div>
        </div>

    </div>





  </div>
</div>



<?php


  if(!$data = $cache->get("home_story", 86400)) {

    $featured_story = $pages->get("parent=/stories/, template=story-detail, home_featured=1, limit=1, sort=-created");
    $nameAry = explode(" ", $featured_story->person_name);

    if( $featured_story->featured_image_cdn != '' )
    {
       $featured_story_img = $featured_story->featured_image_cdn;
    }
    else if( count($featured_story->featured_image) > 0 )
    {
      $featured_story_img = $featured_story->featured_image->url;
    }
    else
    {
      $featured_story_img = $featured_story->header_image->url;
    }

    $storyBtnTitle = "Read ".$nameAry[0]."'s Story";
    if($featured_story->story_custom_button != '')  $storyBtnTitle  = $featured_story->story_custom_button;

    $data .= "<div class='section section-featured-story' style='background: #565656 url(\"".$featured_story_img."\") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover;height:auto;' >
      <div class='container pd-t-lg pd-b-lg'>
        <div class='row'>";
          $story_pos = '';
         if($featured_story->featured_quote_left != 1) $story_pos = "col-sm-offset-6 col-xs-offset-4";
          $data .= "<div class='col-sm-6  col-xs-8 ".$story_pos."'>
               <h5 class='mg-b-none'>STORIES</h5>
               <h4 class='mg-b-sm'>".$featured_story->person_name."</h4>";
              if($featured_story->featured_quote != '') {
                  $data .=" <p class='hidden-xs home-quote'>&ldquo;".$featured_story->featured_quote."&rdquo;</p>";
              }
              else
              {
                 $data .=" <p class='hidden-xs home-quote' style='min-height:140px;'></p>";
              }
               $data .=" <a class='btn btn-default btn-clear btn-left mg-t-sm' href='".$featured_story->url."'>".$storyBtnTitle."</a>
               </div>
            </div>
          </div>

    </div>";

    $cache->save($data);
  }
  echo $data;
?>




<div class='section section-gray'>



  <div class='container pd-t-lg pd-b-lg'>

    <div class='row'>
      <div class='col-md-12 text-center pd-b-md'>
          <h1>Recent Blog Posts</h1>
      </div>
    </div>

    <div class="row">


      <?php
            if(!$data = $cache->get("home_blog", 86400)) {
                $featured_posts = $pages->find("parent=/blog/, template=post, home_featured=1, limit=3, sort=-date");
                 foreach ( $featured_posts as $block)
                 {
                    $data .= '<div class="col-xs-12 col-sm-4 col-md-4"> <div class="home-content-block">';

                    $thumb = $pages->get('/blog')->images->first()->size(640,293)->url;

                    if( count($block->thumbnail) > 0)
                    {
                      $thumb = $block->thumbnail->size(640,293)->url;
                    }
                    elseif( count($block->header_image) > 0 )
                    {
                      $thumb = $block->header_image->size(640,293)->url;
                    }

                    $description = '';
                    if( $block->summary != '')
                    {
                        $description = $block->summary;
                    }
                    else
                    {
                        $description = truncate(strip_tags($block->body), 120);
                    }

                    $data .= " <a href='".$block->url."'><img src='".$thumb."' alt='".$block->title."'  class='img-responsive img-full-width'/></a>
                    <div class='home-para-block'><a href='".$block->url."'><h3>".$block->title."</h3></a>".$description."</div></div></div>";

                }
                $cache->save($data);
            }
            echo $data;
        ?>

    </div>
  </div>
</div>


<?php
include("./includes/foot.inc");

