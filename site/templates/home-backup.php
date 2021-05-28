<?php
/**
* Home template
*
*/
include("./includes/head-4.php");
?>

<div class='section section-gray'>
  <div class='container pd-t-lg pd-b-lg'>
    <div class="row">
      <?php echo $page->body;?>
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
        else if( !empty($block->thumbnail) > 0)
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
  $recent_message = $pages->get("has_parent='/messages/', template=media, sort=-media_date, youtube_id!=''");
  $pID = $recent_message->parent->id;
  $recent_series = $pages->get("id=".$pID."");
  if( !empty($recent_series->homepage_background)> 0 || $recent_series->homepage_background_cdn != '')
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
  $countDown = !empty($messages);
  foreach($messages as $m) {
  if( $m->id == $recent_message->id )
  {
  $series_part_number = $countDown;
  }
  $countDown--;
  }
  }
  $speakers = '';
  if( !empty($recent_message->media_speaker) )
  {
  $speakerTotal = !empty($recent_message->media_speaker);
  $s = 0;
  foreach($recent_message->media_speaker as $speaker) {
  $speakers .= $speaker->title;
  $s++;
  if( $speakerTotal != $s ) $speakers .= ", ";
  }
  }
  $seriesTitle = $recent_series->title;
  if($recent_series->series_standalone_year == 1 ) $seriesTitle = '';
  $data .= "<section class='current-message bg-cover' style='background: #490b4d url(\"".$series_bg."\") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover;height:auto;'>
    <div class='container'>
      <div class='row serif'>
        <div class='col-md-8 col-lg-6 col-xl-5 bg-white my-5 px-5 py-5'>
          <h5 class='font-90'>LATEST MESSAGE</h5>
          <h1 class='my-3'>".$seriesTitle."";
          if( $series_part_number != '') $data .= " (Part ".$series_part_number.")";
          $data .= "</h2>
          
          <h3>".$recent_message->title."</h3>
          <p>".$recent_message->media_date."";
            if($speakers != '')  $data .= " &middot; ".$speakers;
          $data .= "</p>
          <a class='mt-2 btn btn-outline-dark' href='".$recent_message->url."'>Watch Now</a>
        </div>
      </div>
    </div>
  </div></section>";
  $cache->save($data);
  }
  echo $data;
  ?>
  <div class='section ' style='background-color:#efefef;'>
    <div class="container pd-t-md pd-b-lg ">
      <h1>Service Times </h1>
      <div class="row multi-columns-row ">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 first-in-row ">
          <div style='background-color:#ffffff;padding-bottom:10px;' class='serif serif-md'>
            <img src='' class='img-responsive img-full-width' />
            <div style='padding:10px 20px;'>
              <h3 style='margin-top:0px;padding-top:6px;padding-bottom:6px;'>
              Vincennes
              </h3>
              <p>Pastor Debbie Salters</p>
              <p>Thursday 6:45pm<br />Sunday 10:45am</p>
              <ul class="fa-ul">
                <li>218 Main St</li>
                <li>Vincennes, IN 47591</li>
                <li>812.882.2737</li>
              </ul>
              <div class='clearfix'></div>
              <div class='mg-t-md mg-b-sm'><a href='https://goo.gl/maps/SptKwMV1cgzbSdNJ8' target="_blank" class='mt-2 btn btn-outline-dark'><i class='icon-right-4'></i> Get Directions</a></div>
            </div>
          </div>
        </div>
        <!--div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="display: none;">
        <div style='background-color:#ffffff;padding-bottom:10px;' class='serif serif-md'>
          <img src='' class=' img-responsive img-full-width' />
          <div style='padding:10px 20px;'>
            <h3 style='margin-top:0px;padding-top:6px;padding-bottom:6px;'>
            Bicknell
            </h3>
            <p>Thursday 6:45pm</p>
            <ul class="fa-ul">
              <li>114 South Main St</li>
              <li>Bicknell, IN 47512</li>
              <li>812.502.2124</li>
            </ul>
            <div class='clearfix'></div>
            <div class='mg-t-md mg-b-sm'><a href='#' class='btn btn-left btn-default'><i class='icon-right-4'></i> Get Directions</a></div>
          </div>
        </div>
      </div-->
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <div style='background-color:#ffffff;padding-bottom:10px;' class='serif serif-md'>
          <img src='' class=' img-responsive img-full-width' />
          <div style='padding:10px 20px;'>
            <h3 style='margin-top:0px;padding-top:6px;padding-bottom:6px;'>
            French (Creole)
            </h3>
            <p>Pastor Ace Alexis<br /></p>
            <p>Sunday 12:30pm</p>
            <ul class="fa-ul">
              <li>218 Main St</li>
              <li>Vincennes, IN 47591</li>
              <li>812.882.2737</li>
            </ul>
            <div class='clearfix'></div>
            <div class='mg-t-md mg-b-sm'><a href='https://goo.gl/maps/SptKwMV1cgzbSdNJ8' target="_blank" class='mt-2 btn btn-outline-dark'><i class='icon-right-4'></i> Get Directions</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class='clearfix clear'></div>
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
else if( !empty($featured_story->featured_image) > 0 )
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
  $data .= "<div class='col-sm-6  col-xs-8 ".$story_pos." text-white'>
    <h5 class='mg-b-none'>STORIES</h5>
    <h4 class='mg-b-sm'>".$featured_story->person_name."</h4>";
    if($featured_story->featured_quote != '') {
    $data .=" <p class='hidden-xs home-quote'>&ldquo;".$featured_story->featured_quote."&rdquo;</p>";
    }
    else
    {
    $data .=" <p class='hidden-xs home-quote' style='min-height:140px;'></p>";
    }
    $data .=" <a class='mt-2 btn btn-outline-light' href='".$featured_story->url."'>".$storyBtnTitle."</a>
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
    <h1>News &amp Announcements</h1>
  </div>
</div>
<div class="row">
  <?php
  if(!$data = $cache->get("home_blog", 86400)) {
  $featured_posts = $pages->find("parent=/blog/, template=post, home_featured=1, limit=3, sort=-date");
  foreach ( $featured_posts as $block)
  {
  $data .= '<div class="col-xs-12 col-sm-4 col-md-4"> <div class="home-content-block">';
    $thumb = $pages->get('/blog/')->images->first()->size(640,293)->url;
    if( !empty($block->thumbnail) > 0)
    {
    $thumb = $block->thumbnail->size(640,293)->url;
    }
    elseif( !empty($block->header_image) > 0 )
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
    $description = truncate(strip_tags($block->body), 500);
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
<!-- end template -->
<?php include("./includes/foot-4.php");?>