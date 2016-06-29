<?php


$homepage = wire('pages')->get("/");

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once("./includes/functions.inc"); // include our shared functions


$live = false;
if(wire('config')->live) $live = true;

$liveHome = false;

if( $live == true &&  wire('page')->template == 'home')
{
  $liveHome = true;
}


// page is short by DEFAULT
$shortHeader = ' top-short-header ';
$topStyle = '';
$curveDown = '';

// or you can force it if need be
if(wire('page')->short_header == 1)
{
   $shortHeader = ' top-short-header ';
}

// if header image exists, then its not a short header (simple, right?)
if(  count(wire('page')->header_image) > 0  || count(wire('page')->series_wide_graphic) > 0 || count(wire('page')->series_banner_graphic) > 0  )
{
  $shortHeader = '';
}

if(wire('page')->template == 'home')
{
   $shortHeader = '';
   $top_images = wire('page')->home_topimage_rotation->getRandom();

   $top_imgURL = $top_images->header_image->url;


   $topStyle = '  background: #bfbfbf url("'.$top_imgURL.'") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; ';
   if($live)  $topStyle .= " background-position:center 20px;";
}

if(count(wire('page')->header_image) > 0 || wire('page')->template == 'series' || wire('page')->template == 'media_archive' && wire('page')->short_header == 0 ){


      if( count(wire('page')->series_wide_graphic) > 0)
      {
        $top_imgURL = wire('page')->series_wide_graphic->url;
      }

      if( count(wire('page')->series_banner_graphic) > 0)
      {
        $top_imgURL = wire('page')->series_banner_graphic->url;
      }

      if( count(wire('page')->header_image) > 0 )
      {
          $top_imgURL = wire('page')->header_image->url;
      }

        if( wire('page')->header_img_cdn != '' )
      {
          $top_imgURL = wire('page')->header_img_cdn;
      }


      $topStyle = ' background: #bfbfbf url("'.$top_imgURL.'") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; ';
       if($live &&  wire('page')->template == 'home')  $topStyle .= " background-position:center 20px;";
}



$repositionHeaderImage = 0;
if( $shortHeader == '' && wire('page')->header_img_mobile_offset != '' ){
   $repositionHeaderImage = wire('page')->header_img_mobile_offset;
 }

if(wire('page')->template == 'home'){
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

    <title><?php echo wire('page')->get("headline|title"); ?></title>

          <?php $bodyText = wire("page")->summary;
            if($bodyText == ''){
               $bodyText = strip_tags(truncate(wire("page")->body, 200));
               $bodyText = str_replace(array("\r", "\n"), " ", $bodyText);
               $bodyText = str_replace('"', "&quot;", $bodyText);
               $bodyText = str_replace("    ", " ", $bodyText);
            }
      ?>

    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="<?php  echo $bodyText; ?>">
    <meta name="author" content="Crosspointchurch.church">

    <?php $td = wire('config')->urls->templates;
          $rp = wire('config')->ssl_rootName;
    ?>

    <link href='//fonts.googleapis.com/css?family=Noticia+Text:400,400italic,700,700italic|Open+Sans:100,200,300,400,600,700,800,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
   <!-- styles -->
   <link rel="stylesheet" href="<?php echo AIOM::CSS(array(
          'css/bootstrap.css','css/site-helpers.css', 'css/icon-font.css','css/site.css', 'css/events.css'
          )); ?>">


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



       <style>.top-home{<?php echo $topStyle;?>}<?php if( $repositionHeaderImage != 0 ){ $vpos = "0"; if($live &&  wire('page')->template == 'home') $vpos = "40";?>@media screen and (max-width: 480px) {.top-home{ background-position: <?php echo $repositionHeaderImage;?>px <?php echo $vpos;?>px !important;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}} <?php } ?>

  </style>


  </head>
  <body >
<div id='wrapper' class='page-id-<?php echo wire('page')->id;?> template-<?php echo wire('page')->template;?>  <?php if($live  &&  wire('page')->template == 'home') echo " streaming-live ";?>'>

<div class='header <?php echo $curveDown;?>  ' id='chapel-header-bar'>
    <div id='search-area'>
       <div class='container'>
                <div class='row'>
                    <div class='col-md-8 col-md-offset-2'>
                          <div class="searchTop">
                            <?php
                              $searchPage = wire('pages')->get('template=search');
                              $searchQuery = htmlentities(wire('input')->whitelist('q'), ENT_QUOTES, "UTF-8");
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

    <?php if($live &&  wire('page')->template == 'home'){?>

  <div id='top-bar-live'>
        <div class='container  pd-t-sm pd-b-sm'>
                <div class='row'>
                    <div class='col-md-12'>
                     <i id='live-btn-icon' class='icon-fw icon-video-camera-1'></i> We are streaming live.  <a id='live-btn'  href='/live/' title="Live" >Watch Now!</a>
              </div></div></div>
   </div>
   <?php } ?>

       <div id='top-quick-menu' class='<?php if($live &&  wire('page')->template == 'home') echo "has-top-live";?>'>
         <div class='container'>
                <div class='row'>
                    <div class='col-lg-12'>
                          <div class="logo pull-left">
                            <a href="/" class="crosspoint_logo" title='Cross Point Church'>
                             <img id="logo-mark"  src='/site/templates/css/img/logo-red.svg'>

                            </a>
                          </div>
                          <div class="top-nav-right pull-right">
                            <a id='menu-btn'  title="Menu" ><span id='menu-btn-icon' class='icon-fw icon-menu-3'></span> Menu</a>
                            <a id='search-btn' title="Search" ><span id='menu-search-btn-icon' class='icon-fw icon-zoom-2'></span><span class='hidden-xs'> Search</span></a>


                          </div>
                    </div>
               </div>
         </div>
      </div>


        <div id='nav-main-menu' class='nav-content-holder <?php if($live &&  wire('page')->template == 'home') echo "has-top-live";?>' >
            <div class='nav-top-border'></div>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-12'>

                            <ul id="nav-pullout">
                                <li id="nav_about" class='dropdown'><a href='#' id='about-nav' >About</a>
                                  <ul >
                                    <li ><a href='/about/staff/' >Staff  <span class="icon-right-circle-12"></span></a></li>
                                    <li ><a href='/about/beliefs/' >Beliefs <span class="icon-right-circle-12"></span></a></li>
                                    <li ><a href='/about/mission/' >Mission <span class="icon-right-circle-12"></span></a></li>

                                  </ul>
                                </li>
                                <li id="nav_connect" class='dropdown'><a href='#' >Connect</a>
                                  <ul>

                                    <li ><a href='/events/' >Events <span class="icon-right-circle-12"></span></a></li>
                                    <li ><a href='/serve/' >Serve <span class="icon-right-circle-12"></span></a></li>

                                     <li ><a href='/baptism-membership/' >Multi-section <span class="icon-right-circle-12"></span></a></li>


                                  </ul>
                                </li>
                                <li id="nav_outreach" class='dropdown'><a href='#' >Give</a>
                                   <ul>
                                    <li ><a href='/give/why-we-give/' >Why We Give <span class="icon-right-circle-12"></span></a></li>
                                    <li ><a href='#'>Give Now <span class="icon-right-circle-12"></span></a></li>

                                  </ul>
                                </li>
                                <li id="nav_resources" class='dropdown'><a href='#' >Resources</a>
                                  <ul>
                                     <li ><a href='/sermons/' >Sermons <span class="icon-right-circle-12"></span></a></li>
                                     <li ><a href='/blog/' >Blog <span class="icon-right-circle-12"></span></a></li>
                                     <li ><a href='/stories/' >Stories <span class="icon-right-circle-12"></span></a></li>
                                  </ul>
                                </li>


                              </ul>

                        </div>
                    </div>
                </div>
            </div>



  </div>





  <div id='top-area' class='top-home <?php echo $shortHeader;?> <?php if($liveHome) echo "has-top-live";?>' >

    <div class='top-cover-gradient-fromtop gradient'></div>
    <div class='top-cover-gradient-frombot gradient '></div>

      <?php if( wire('page')->header_title && wire('page')->header_title != ''){?>
      <div class='container  header-banner <?php if( wire('page')->header_description == '' &&  wire('page')->template != 'campus') echo ' no-subtitle '; ?>  <?php if( wire('page')->template == 'campus') echo ' header-campus ';?>  <?php if($liveHome) echo " has-top-live";?>'>

            <div class='row center-row'>
                <div class='col-lg-12 center-col  '>

                      <h1><?php echo wire('page')->header_title;?></h1>

                       <?php if( wire('page')->header_description != '' || wire('page')->template == 'campus') {?>

                       <div class='row'>
                         <div class='col-lg-10 col-lg-offset-1'>
                          <?php if( wire('page')->header_description != '') {?>
                            <h2><?php echo wire('page')->header_description;?></h2>
                          <?php } ?>
                          <?php if( wire('page')->template == 'campus') {?>
                            <h3>SERVICE TIMES</h3>
                            <p class='campus-times'><?php echo wire('page')->service_times;?></p>
                            <p class='campus-address'><?php echo wire('page')->address;?></p>
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
