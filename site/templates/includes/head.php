<?php
$homepage = $pages->get("/");

require_once("functions.php"); // include our shared functions
$live = false;
if($config->live) $live = true;
$liveHome = false;
if( $live == true &&  $page->template == 'home')
{
$liveHome = true;
}
// page is short by DEFAULT
$shortHeader = ' top-short-header ';
$topStyle = '';
$curveDown = '';
// or you can force it if need be
if($page->short_header == 1)
{
$shortHeader = ' top-short-header ';
}
// if header image exists, then its not a short header (simple, right?)
if(  !empty($page->header_image) > 0  || !empty($page->series_wide_graphic) > 0 || !empty($page->series_banner_graphic) > 0  )
{
$shortHeader = '';
}
if($page->template == 'home')
{
$shortHeader = '';
$top_images = $page->home_topimage_rotation->getRandom();
$top_imgURL = $top_images->header_image->url;
$topStyle = '  background: #490b4d url("'.$top_imgURL.'") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; ';
if($live)  $topStyle .= " background-position:center 20px;";
}
if(!empty($page->header_image) > 0 || $page->template == 'series' || $page->template == 'media_archive' && $page->short_header == 0 ){
if( !empty($page->series_wide_graphic) > 0)
{
$top_imgURL = $page->series_wide_graphic->url;
}
if( !empty($page->series_banner_graphic) > 0)
{
$top_imgURL = $page->series_banner_graphic->url;
}
if( !empty($page->header_image) > 0 )
{
$top_imgURL = $page->header_image->url;
}
if( $page->header_img_cdn != '' )
{
$top_imgURL = $page->header_img_cdn;
}
$topStyle .= ' background: #490b4d url("'.$top_imgURL.'") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; ';
if($live &&  $page->template == 'home')  $topStyle .= " background-position:center 20px;";
}
$repositionHeaderImage = 0;
if( $shortHeader == '' && $page->header_img_mobile_offset != '' ){
$repositionHeaderImage = $page->header_img_mobile_offset;
}
if($page->template == 'home'){
if( isset($top_images) && $top_images->header_img_mobile_offset != '') {
$repositionHeaderImage = $top_images->header_img_mobile_offset;
}
}
?>
<!DOCTYPE html>
<!--[if lt IE 9]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if !IE] -->
<html lang='en'>
  <!-- <![endif] -->
  <head>
    <title><?php echo $page->get("headline|title"); ?></title>
    <?php $bodyText = wire("page")->summary;
    if($bodyText == ''){
    $bodyText = strip_tags(truncate(wire("page")->body, 200));
    $bodyText = str_replace(array("\r", "\n"), " ", $bodyText);
    $bodyText = str_replace('"', "&quot;", $bodyText);
    $bodyText = str_replace("    ", " ", $bodyText);
    }
    ?>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="<?php  echo $bodyText; ?>">
    <meta name="author" content="thursdaychurch.org">
    <?php $td = $config->urls->templates;
    $rp = $config->ssl_rootName;
    ?>
    <!--link href='//fonts.googleapis.com/css?family=Noticia+Text:400,400italic,700,700italic|Open+Sans:100,200,300,400,600,700,800,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'-->
    <!-- styles -->
    <!--link rel="stylesheet" href="<?php //echo AIOM::CSS(array('css/bootstrap.css','css/site-helpers.css', 'css/icon-font.css','css/site.css', 'css/events.css')); ?>"-->
    <link rel="stylesheet" href="/site/templates/css/icon-font.css">
    <link rel="stylesheet" href="/site/templates/css/bootstrap.css"-->
    <link rel="stylesheet" href="/site/templates/css/audioplayer.css">
    <link rel="stylesheet" href="/site/templates/css/site-helpers.css">
    <link rel="stylesheet" href="/site/templates/css/events.css">
    <link rel="stylesheet" href="/site/templates/css/site.css">
    <link rel="stylesheet" href="/site/templates/css/style.css">
	<script src="https://kit.fontawesome.com/6fed92b3c4.js" crossorigin="anonymous"></script>

    
    <?php
    $js_top_array = array( 'js/plugins/modernizr/modernizr.min.js',
    'js/plugins/jquery/jquery.min.js' )
    ?>
    <script src="<?php echo AIOM::JS( $js_top_array ); ?>"></script>
    <!--[if lt IE 9]>
    <script type='text/javascript' src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]>
    <style type="text/css">.gradient,.gradient:after {filter: none; } </style>
    <![endif]-->
    <style>
    .top-home{<?php echo $topStyle;?>}<?php if( $repositionHeaderImage != 0 ){ $vpos = "0"; if($live &&  wire('page')->template == 'home') $vpos = "40";?>@media screen and (max-width: 480px) {.top-home{ background-position: <?php echo $repositionHeaderImage;?>px <?php echo $vpos;?>px !important;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}} <?php } ?>
    </style>
    <script src="https://cdn.jsdelivr.net/sharer.js/latest/sharer.min.js"></script>
  </head>
  <body >
    <div id='wrapper' class='page-id-<?php echo $page->id;?> template-<?php echo $page->template;?>  <?php if($live  &&  $page->template == 'home') echo " streaming-live ";?>'>
      <div class='header <?php echo $curveDown;?>  ' id='chapel-header-bar'>

        <div id='search-area'>
          <div class='container'>
            <div class='row'>
              <div class='col-md-8 col-md-offset-2'>
                <div class="searchTop">
                  <?php
                  $searchPage = $pages->get('template=search');
                  $searchQuery = htmlentities($input->whitelist('q'), ENT_QUOTES, "UTF-8");
                  if($searchQuery == '') $searchQuery = '';
                  ?>
                  <form id="search-form-top" class='clearfix' action='<?php echo $searchPage->url; ?>' method='get'>
                    <input class="clear-click" id='search-site-input' placeholder='Search the site' type='text' name='q' value='<?php echo $searchQuery; ?>'>
                    <a id="search_query_btn" href="javascript:void(0);" class="icon-right-4"></a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id='floating-bar-nav' >

          <?php if($live){?>
          <div id='top-bar-live'>
            <div class='container  pd-t-sm pd-b-sm'>
              <div class='row'>
                <div class='col-md-12'>
                  <i id='live-btn-icon' class='icon-fw icon-video-camera-1'></i> We are streaming live.  <a id='live-btn'  href='/live/' title="Live" >Watch Now!</a>
                </div></div></div>
              </div>
              <?php } ?>

              <?php if($page->isnotification == '1'){?>
        <div id='top-news-bar'>
          <div class='container  pd-t-sm pd-b-sm'>
            <div class='row'>
              <div class='col-md-12'>
                <a id='live-btn button w-icon' href="#news-bar-modal" data-toggle="modal"><i class="flaticon stroke wireless"></i> <?php echo $page->notificationtitle; ?></a><br />
              </div>
            </div>
          </div>
        </div>
    <?php } ?>
              <div id='top-quick-menu' class='<?php if($page->isnotification == '1') echo "has-top-live"; if($live &&  $page->template == 'home') echo "has-top-live";?>'>
                <div class='container'>
                  <div class='row'>
                    <div class='col-lg-12'>
                      <div class="logo pull-left">
                        <a href="/" class="crosspoint_logo" title='Thursday Church'>
                          <img id="logo-mark"  src='/site/templates/css/img/logo-red.svg'>
                        </a>
                      </div>
                      <div class="top-nav-right pull-right">
                        <a id='menu-btn' title="Menu" ><span id='menu-btn-icon' class='icon-fw icon-menu-3'></span> Menu</a>
                        <a id="events-btn" href="/events/" title="Events"><span class="icon-fw icon-calendar-1"></span><span class="hidden-xs"> Events</span></a>
                        <a id="give-btn" class="hidden-xs" href="/give/" title="Giving"><span class="icon-fw icon-heart"></span> Giving</a>
                        <a id='search-btn' title="Search" ><span id='menu-search-btn-icon' class='icon-fw icon-zoom-2'></span><span class='hidden-xs'> Search</span></a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id='nav-main-menu' class='nav-content-holder <?php if($live &&  $page->template == 'home') echo "has-top-live";?>' >
                <div class='nav-top-border'></div>
                <div class='container'>
                  <div class='row'>
                    <div class='col-md-12'>
                      <ul id="nav-pullout">
                        <li id="nav_about" class='dropdown'><a href='#' id='about-nav' >Who We Are</a>
                        <ul>
                          <li><a href='/about/' style="color: white;">About Us </a></li>
                          <li ><a href='/about/staff/' style="color: white;">Meet The Team  </a></li>
                          <li ><a href='/about/beliefs/' style="color: white;">What We Believe </a></li>
                          <li ><a href='/about/contact/' style="color: white;">Contact Us </a></li>
                        </ul>
                      </li>
                      <li id="nav_locations" class='dropdown'><a href='#' id='locations-nav' >Locations</a>
                      <ul>
                        <li><a href='/locations/vincennes/' style="color: white;">Vincennes </a></li>
                        <li><a href='/locations/bicknell/' style="color: white;">Bicknell  </a></li>
                        <li><a href='/locations/french-creole/' style="color: white;">French (Creole) </a></li>
                      </ul>
                    </li>
                    <li id="nav_connect" class='dropdown'><a href='#' >Ministries</a>
                    <ul>
                      <li ><a href='/ministries/kids/' style="color: white;">Kids </a></li>
                      <li ><a href='/ministries/students/' style="color: white;">Students </a></li>
                      <li ><a href='/ministries/life-groups/' style="color: white;">LIFE Groups </a></li>
                      <li ><a href='/ministries/global-missions/' style="color: white;">Global Missions </a></li>
                      <li ><a href='/ministries/celebrate-recovery/' style="color: white;">Celebrate Recovery </a></li>
                      <li ><a href='/ministries/mobile-food-pantry/' style="color: white;">Mobile Food Pantry </a></li>
                      <li ><a href='/ministries/3d-groups/' style="color: white;">3D Groups </a></li>
                    </ul>
                  </li>
                  <li id="nav_connect" class='dropdown'><a href='#' >Events</a>
                  <ul>
                    <li ><a href='/events/' style="color: white;">Events </a></li>
                    <li ><a href='/serve/' style="color: white;">Serve </a></li>
                  </ul>
                </li>
                <li id="nav_outreach" class='dropdown'><a href='#' >Give</a>
                <ul>
                  <!--li ><a href='/give/why-we-give/' style="color: white;">Why We Give </a></li-->
                  <li ><a href='/give/' style="color: white;">Give Now </a></li>
                </ul>
              </li>
              <li id="nav_resources" class='dropdown'><a href='#' >Watch</a>
              <ul>
                <li ><a href='/sermons/' style="color: white;">Sermons </a></li>
                <li ><a href='/live/' style="color: white;">Live </a></li>
                <!--li ><a href='/stories/' >Stories </a></li-->
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id='top-area' class='top-home <?php echo $shortHeader;?> <?php if($liveHome) echo "has-top-live";?>' >
    <div class='top-cover-gradient-fromtop gradient'></div>
    <div class='top-cover-gradient-frombot gradient '></div>
    <?php if( $page->header_title && $page->header_title != ''){?>
    <div class='container  header-banner <?php if( $page->header_description == '' &&  $page->template != 'campus') echo ' no-subtitle '; ?>  <?php if( $page->template == 'campus') echo ' header-campus ';?>  <?php if($liveHome) echo " has-top-live";?>'>
      <div class='row center-row'>
        <div class='col-lg-12 center-col  '>
          <h1><?php echo $page->header_title;?></h1>
          <?php if( $page->header_description != '' || $page->template == 'campus') {?>
          <div class='row'>
            <div class='col-lg-10 col-lg-offset-1'>
              <?php if( $page->header_description != '') {?>
              <h2><?php echo $page->header_description;?></h2>
              <?php } ?>
              <?php if( $page->template == 'campus') {?>
              <h3>SERVICE TIMES</h3>
              <p class='campus-times'><?php echo $page->service_times;?></p>
              <p class='campus-address'><?php echo $page->address;?></p>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
    </div> <!-- end top-area -->
    </div> <!-- end header -->
    <div id='main' role='main'>
      <div id='bar-green'></div>
              <?php if($page->short_header == 1) { ?>
      <!-- Begin Breadcrumbs -->
      <ul class="breadcrumb">
        <?php
        // Display breadcrumbs in a Google-friendly aria-compliant microdata format
        $count = 0; // count link depth
        foreach($page->parents() as $item) {
        $count++;
        // output parent pages, links and schema breadcrumb info
        echo'<li><a href="' . $item->url . '" content="' . $count . '">' . $item->title . '</a></li>';
        }
        // output the current page as the last item
        $count = $count+1;
        echo'<li>' . $page->title . '</li>';
        
      echo'</ul>';
      }
      ?>
      