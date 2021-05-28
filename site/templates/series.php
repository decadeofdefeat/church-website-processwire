<?php
/**
* Series template
*
*/

include("./includes/head-4.php");
if($page->url == '/messages/')
{
// full list of series
$out = "<div class='section ' style='background-color:#efefef;'>
  <div class='container pd-t-lg pd-b-lg' >";
    $out .= "<div class='row multi-columns-row'>";
      $series_all = $pages->get(1008)->find("template=series, sort=series_date_start");
      $num = 0;
      foreach($series_all as $se)
      {
      $se->of(false);
      $se->sort_field = $num;
      $se->save();
      $num++;
      }
      ?>
      <!-- Begin pagination -->
      <?php
      $series_list = $pages->get('/messages/')->find("template=series, children.count>0,  limit=0, sort=-series_date_end");
      $first_series = $series_list->first();
      $generic_img = $page->images->first()->size(640, 360)->url;
      $pagination = $series_list->renderPager(array(
      'nextItemLabel' => "Next &raquo;",
      'previousItemLabel' => "&laquo; Previous",
      'numPageLinks' => 4,
    'listMarkup' => "<ul class='pagination justify-content-center'>{out}</ul>",
    'itemMarkup' => "<li class='page-item {class}'>{out}</li>",
    'linkMarkup' => "<a href='{url}' class='page-link'>{out}</a>",
    'currentItemClass' => 'active',
    'separatorItemLabel' => "<a href='#'>&hellip;</a>"
    ));
    ?>
    <!-- End pagination -->
    <?php
    $first = true;
    $seriesNum = 0;
    foreach($series_list as $s)
    {
    $firstClass = '';
    if( $seriesNum == 0)  $firstClass = ' first-in-row ';
    $out .= "<div class='col-12 col-sm-6 col-md-4 col-lg-4 ".$firstClass."'>".PHP_EOL;
      $out .= "<div class='sermon-series serif serif-md mb-4'>".PHP_EOL;
        $viewTitle = "View Series";
        $viewLink = $s->url;
        if( $s->special_standalone == 1 ){
        $viewTitle = "View Message";
        $viewLink = $s->children->first()->url;
        }
        if($s->thumbnail_cdn != '')
        {
        $thumb = $s->thumbnail_cdn;
        }
        else if(count($s->series_wide_graphic) > 0)
        {
        $thumb = $s->series_wide_graphic->size(640, 360)->url;
        }
        else
        {
        $thumb = $generic_img;
        }
        $out .= "<a href='".$viewLink."' class='bg-cover clickable-background fill-landscape' style='background: url({$thumb});''></a>";
        $out .= "<div style='padding:10px 20px;'>";
          $out .= "<h3 style='margin-top:0px;padding-top:6px;padding-bottom:0px;'><a href='".$viewLink."'>{$s->title}</a></h3>";
          if( $first && $input->pageNum == 1 && $s->series_standalone_year != 1)
          {
          $out .= "<p class='text-muted mg-b-sm'>Current Series</p>";
          }
          else
          {
          $out .= "<p class='text-muted mg-b-sm'>{$s->series_date_start}";
            if( $s->series_date_start != $s->series_date_end)
            $out .=  "- {$s->series_date_end}";
          $out .= "</p>";
          }
          //$out .= truncate($s->body, 260);
          //$out .= $s->body;
          $btn_top_margin = ' mg-t-sm ';
            if($s->body == '') $btn_top_margin  = ' mg-t-md ';
          $out .= "<div class='".$btn_top_margin." mg-b-sm'><a class='btn btn-default btn-left' href='".$viewLink."'> ".$viewTitle."</a></div>";
        $out .= "</div>";
      $out .= "</div></div>".PHP_EOL;
      $first = false;
      $seriesNum++;
      }
    $out .= "</div>"; // end row and multi-columns-row
    $out .= "<div class='clearfix clear'></div>";
    $out .= "<div class='row mt-4'><div class='col-md-12'>";
      $out .= $pagination;
    $out .= "</div></div>";
  $out .= "</div></div>"; // end container and section
  $searchPage = wire('pages')->get('template=media-search');
  $searchQuery = htmlentities(wire('input')->whitelist('q'), ENT_QUOTES, "UTF-8");
  if($searchQuery == '') $searchQuery = '';
  $out .= "<div class='container' style='display: none;'> <div class='row mg-t-lg mg-b-lg'><div class='col-md-8 offset-md-2 mg-b-sm2'>";
    $out .= "<h3 class='text-center mb-4'>Search All Media</h3>";
    $out .= "<div id='search-content-form' class='search-series'>
      <form  id='search-content' action='".$searchPage->url."' method='get'>
        <div class='input-container'>
          <input class='form-control input-transparent' id='search-media-input' placeholder='What are you looking for?' type='text' name='q' value='".$searchQuery."' >
        </div>
        <a id='search_content_query_btn' class='icon-zoom-2'></a>
      </form>
    </div> </div> ";
  $out .= "</div>";
  /*
  $out .= "<div class='row'>";
    $old_series_list = $pages->get('/series/')->find("template=series,title!='Stand Alone Messages', series_date_start<2010/01/01, sort=-series_date_start");
    $out .= "<div class='col-md-12 marg-top-4'><h4>Older Series</h4><hr>";
      $last_series = $old_series_list->last();
      foreach($old_series_list as $s)
      {
      $out .= "<strong><a href='{$s->url}'>{$s->title}</a></strong>";
      if( $s != $last_series ) $out .= ', ';
      }
    $out .= "</div>";
    */
    ?>
    <?php  ob_start(); ?>
    $(document).ready(function(){
    var moreTagsShow = false;
    $('#more-tags').on('click', function(){
    if( !moreTagsShow )
    {
    $('#more-tags').html("<i class='icon-minus-2'></i> Less");
    $('#hidden-tags').css("display","inline");
    moreTagsShow = true;
    }
    else
    {
    $('#more-tags').html("<i class='icon-plus-2'></i> More");
    $('#hidden-tags').css("display","none");
    moreTagsShow = false;
    }
    });
    });
    <?php $additionalJS = ob_get_clean();
    }
    else
    {
    $out = "<div class='section ' >
      <div class='container mg-t-lg mg-b-lg serif' >
        <div class='row '>";
          if($page->numChildren) {
          if( $page->series_standalone_year != 1 )
          $messages = $pages->find("parent=$page, template=media,sort=media_date");
          else
          $messages = $pages->find("parent=$page,template=media,sort=-media_date");
          if( $page->series_standalone_year != 1 )
          {
          //    $out .= "<div class='col-md-7 '><h1>{$page->title}</h1>".$page->body."</div>";
          $out .= "<div class='col-md-4 col-md-offset-1 series-sidebar'>";
          $out .= "</div>";
          }
          else
          {
          $out .= "<div class='col-md-7 '><h1>{$page->title}</h1></div>";
          $out .= "<div class='col-md-4 col-md-offset-1   text-right'>";
            $out .="<div class='back-event-page pull-right'>";
              $out .='<a href="/messages" class="btn btn-default" >View All Series</a>';
            $out .='</div>';
          $out .= "</div>";
          }
        $out .= "</div>"; //end row
        $out .= "<div class='row '><div class='col-md-12 '><hr class='mg-t-md mg-b-none'></div></div>";
        $iterator = 1;
        $tt = count($messages);
        $countDown = count($messages);
        foreach($messages as $m) {
        $datestr = date("Y-m-d", strtotime($m->media_date));
        $speakers = '';
        if( count($m->media_speaker) )
        {
        $speakerTotal = count($m->media_speaker);
        $s = 0;
        foreach($m->media_speaker as $speaker) {
        $speakers .= "<!--a href='".$speaker->url."'-->".$speaker->title."<!--/a-->";
        $s++;
        if( $speakerTotal  != $s ) $speakers .= ", ";
        }
        }
        $out .= "<div class='item-and-audio-holder'  >";
          $out .= "<div class='row mg-b-md2 mg-t-md2'>";
            if($m->media_thumbnail != '')
            {
            $thumb = $m->media_thumbnail;
            }
            else if($m->parent->thumbnail_cdn != '')
            {
            $thumb = $m->parent->thumbnail_cdn;
            }
            else if(count( $m->parent->series_wide_graphic) > 0)
            {
            $thumb =  $m->parent->series_wide_graphic->size(640, 360)->url;
            }
            else
            {
            $thumb = $generic_img;
            }
            $out .= "<div class='col-sm-4 col-md-3 col-md-offset-1 text-center' >";
              $out .= "<a href='{$m->url}'><img src='{$thumb}' class='img-responsive img-full-width mg-b-md'></a>";
              $out .= "<a href='{$m->url}' class='hidden-xs btn btn-left btn-default'><i class='icon-right-4'></i> View Message</a>";
            $out .= "</div>";
            $out .= "<div class='col-sm-8  col-md-7 sermon-item-info' >
              <!--a href='{$m->url}'-->
              <h3 class='mg-t-none' >{$m->title}</h3><!--/a-->";
              if( $page->series_standalone_year != 1 )
              {
              $out .= "<h4>Part ".$iterator." &middot; ".$m->media_date;
              }
              else
              {
              $out .= "<h4>".$m->media_date;
              }
              if($speakers != '') $out .= " &middot; ".$speakers;
              if( $m->media_closed_captioning != '') $out .= "  &middot; <i class='icon-cc'></i>";
              $out .= "</h4>";
              $out .= "<div class='serif-sm'>".$m->body;
              $out .= "</div></div></div>";
              if($tt != $iterator)
              $out .= "<div class='row'><div class='col-md-12'><hr></div></div>";
              $countDown--;
              $iterator++;
            $out .= "</div>";
            }
          $out .= "</div></div></div>";
          }
          }
          echo $out;
          include("./includes/foot-4.php");
          ?>