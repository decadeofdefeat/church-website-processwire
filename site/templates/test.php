<?php



$homepage = wire('pages')->get("/");



$root = realpath($_SERVER["DOCUMENT_ROOT"]);

require_once( $root ."/site/templates/includes/functions.php");



$live = false;

if(wire('config')->live) $live = true;

// if you're on the live page, don't show the live top alert

if(wire('page')->id == 1369) $live = false;



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



<html lang='en'>



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

	<meta name="author" content="thursdaychurch.org">



	<?php $td = wire('config')->urls->templates;

          $rp = wire('config')->ssl_rootName;

    ?>



	<!-- styles -->

	<link href="http://church.jaygreentree.com/site/templates/css/styles.css" rel="stylesheet" >

	<script src="http://church.jaygreentree.com/site/templates/js/plugins/modernizr/modernizr.min.js"></script>



	<meta name="theme-color" content="#ffffff">



	<style id="fit-vids-style">

		.fluid-width-video-wrapper {

			width: 100%;

			position: relative;

			padding: 0;

		}



		.fluid-width-video-wrapper iframe,

		.fluid-width-video-wrapper object,

		.fluid-width-video-wrapper embed {

			position: absolute;

			top: 0;

			left: 0;

			width: 100%;

			height: 100%;

		}

	</style>

</head>



<body

	class='page-id-<?php echo wire('page')->id;?> template-<?php echo wire('page')->template;?>  <?php if($live  &&  wire('page')->template == 'home') echo " streaming-live ";?>'>



	<div class="wrapper">



		<section role="navigation" id="nav">



			<div id="menuzord" class="menuzord menuzord-responsive">

				<a href="javascript:void(0)" class="showhide">

					<em></em>

					<em></em>

					<em></em>

				</a>

				<div id="search-area">

					<?php $searchPage = wire('pages')->get('template=search');

$searchQuery = htmlentities(wire('input')->whitelist('q'), ENT_QUOTES, "UTF-8");

if($searchQuery == '') $searchQuery = '';?>

					<form id="search-form-top" class='clearfix' action='<?php echo $searchPage->url; ?>' method='get'>

						<input class="clear-click" id='search-site-input' placeholder='Search the site' type='text'

							name='q' value='<?php echo $searchQuery; ?>'>

						<a id="search_query_btn" href="javascript:void(0);" class="icon-right-4"></a>

					</form>

				</div>

				<a href="/" class="chapel-logo" alt="The Chapel" title="The Chapel">

					<div id="logo-mark">



					</div>

					<div id="logo-text">



					</div>

				</a>



				<ul class="menuzord-menu menuzord-right menuzord-indented scrollable" style="max-height: 400px;">

					<li><a>Who We Are<span class="indicator">

						</a>

						<ul class="dropdown" style="right: auto;">

							<li><a href='/about/' style="color: white;">About Us </a></li>

							<li><a href='/about/staff/' style="color: white;">Meet The Team </a></li>

							<li><a href='/about/beliefs/' style="color: white;">What We Believe </a></li>

							<li><a href='/about/contact/' style="color: white;">Contact Us </a></li>

						</ul>

					</li>



					<li><a href="/locations">Locations</a>

						<ul class="dropdown" style="right: auto;">

							<li><a href='/locations/vincennes/' style="color: white;">Vincennes </a></li>

							<li><a href='/locations/bicknell/' style="color: white;">Bicknell </a></li>

							<li><a href='/locations/french-creole/' style="color: white;">French (Creole) </a></li>

						</ul>

					</li>

					<li><a>Ministries<span class="indicator"></a>

						<ul class="dropdown" style="right: auto;">

							<li><a href='/ministries/kids/' style="color: white;">Kids </a></li>

							<li><a href='/ministries/students/' style="color: white;">Students </a></li>

							<li><a href='/ministries/life-groups/' style="color: white;">LIFE Groups </a></li>

							<li><a href='/ministries/global-missions/' style="color: white;">Global Missions </a></li>

							<li><a href='/ministries/celebrate-recovery/' style="color: white;">Celebrate Recovery </a>

							</li>

							<li><a href='/ministries/mobile-food-pantry/' style="color: white;">Mobile Food Pantry </a>

							</li>

							<li><a href='/ministries/3d-groups/' style="color: white;">3D Groups </a></li>

						</ul>

					</li>



					<li><a href="/events/">Events<span class="indicator"></a>

						<ul class="dropdown" style="right: auto;">

							<li><a href='/events/' style="color: white;">Events </a></li>

							<!--li><a href="/next-steps/meet-jesus/">Know Jesus</a></li>

							<li><a href="/next-steps/read-the-bible/">Read The Bible</a></li>

							<li><a href="/next-steps/discipleship">Discipleship</a></li>

							<li><a href="/next-steps/#section-baptism">Baptism</a></li>

							<li><a href="/next-steps/#section-membership">Membership</a></li>

							<li><a href="/next-steps/community-groups/">Community Groups</a></li>

							<li><a href="/next-steps/volunteer/">Volunteer</a></li>

							<li><a href="/next-steps/bible-education/">Bible Education</a></li>

							<li><a href="/next-steps/care/">Care</a></li>

							<li><a href="/next-steps/stewardship/">Stewardship</a></li -->

						</ul>

					</li>



					<li><a>Watch<span class="indicator"></a>

						<ul class="dropdown" style="right: auto;">

							<li><a href="/live/">Live</a></li>

							<li><a href="/messages/">Messages</a></li>

							<!--li><a href="/blog/">Articles &amp; Stories</a></li>

	<li><a href="/media/music/">Music</a></li>

	<li><a href="/stay-connected">Stay Connected</a></li-->

						</ul>

					</li>



					<li><a href="/give/">Give</a></li>

					<li><a id="open-search" href="javascript:void(0)"><i class="icon-zoom-2"></i></a><a

							id="mobile-search" class="text-center" href="/search">Search <i class="icon-zoom-2"></i></a>

					</li>

					<li class="scrollable-fix"></li>

				</ul>

			</div>

		</section>

		<header class="page-hero-header bg-cover " style=" background: url('<?php echo $top_imgURL;?>')">

			<div class="container h-100">

				<div class="row align-items-center h-100 text-white text-center hero-text">

					<div class="col-md-10 mx-auto slide-up-fade-in">

						<div class="px-2 pt-4">

							<h1><?php echo wire('page')->header_title;?></h1>

							<?php if( wire('page')->header_description != '') {?>

							<h2><?php echo wire('page')->header_description;?></h2>

							<?php } ?>

						</div>

					</div>

				</div>

			</div>

		</header>



		<main class="main">

			<div class="container mg-t-lg mg-b-lg serif" id="live-page">





				<div class="row">

					<div class="col-md-12">



						<div class="video-holder" id="video-holder">

							<iframe id="ls_embed_1458644761"

								src="https://livestream.com/accounts/6957/events/1000825/player?width=960&amp;height=540&amp;enableInfoAndActivity=false&amp;autoPlay=true&amp;mute=false"

								scrolling="no" allowfullscreen="" width="960" height="540" frameborder="0"></iframe>



						</div>



						<hr class="my-4">



						<div class="mb-3">



							We provide a live stream of the 9 and 11 am services for

							those times when you just can’t make it to The Chapel or if you’re out

							of town and you would like to share in the worship experience with the

							rest of the church body. Visit this page during our service times to

							join us for worship each week. </div>

					</div>

				</div>





				<div class="row my-3">

					<div class="col-md-12 ">

						<a target="_blank" href="https://livestream.com/chapelbuffalo/onlinecampus"

							class="btn btn-outline-dark  ">Watch Recent Live Stream</a>

					</div>

				</div>



				<div class="row my-3">

					<div class="col-md-12 ">

						<a href="/next-steps" class="btn btn-outline-dark ">Next Steps</a>

					</div>

				</div>





			</div>











		</main>



		<footer class="footer intro-book">

			<div class="container py-5">

				<div class="row">

					<div class="col-12 col-md-3">

						<h5>Sunday Service Times</h5>

						<ul class="list-unstyled text-small">

							<li>9 &amp; 11am<br>Cheektowaga, CrossPoint, Lockport</li>

							<li><br>10am<br>Niagara Falls Campus</li>

						</ul>

					</div>



					<div class="col-12 col-md-6 footer-social">

						<div class="d-block d-sm-block d-md-none border-top my-3"></div>

						<h5>Follow Us</h5>

						<ul class="list-inline text-small">

							<li class="list-inline-item"><a alt="Facebook" target="_blank"

									href="https://fb.com/chapelbuffalo"><i class="icon-facebook-square"></i></a></li>

							<li class="list-inline-item"><a alt="Instagram" target="_blank"

									href="https://instagram.com/chapelbuffalo"><i class="icon-instagram "></i></a></li>

							<li class="list-inline-item"><a alt="Twitter" target="_blank"

									href="https://twitter.com/chapelbuffalo"><i class="icon-twitter"></i></a></li>

							<li class="list-inline-item"><a alt="Vimeo" target="_blank"

									href="https://vimeo.com/chapelbuffalo"><i class="icon-vimeo-square2"></i></a></li>

							<li class="list-inline-item"><a alt="Youtube" target="_blank"

									href="https://youtube.com/c/chapelbuffalo"><i class="icon-youtube-play"></i></a>

							</li>

						</ul>

					</div>

					<div class="col-12 col-md-3">

						<div class="d-block d-sm-block d-md-none border-top my-3"></div>

						<h5>Central Office Info</h5>

						<p>500 CrossPoint Parkway<br>

							Getzville, New York 14068<br>

							716.631.2636<br>

							<a href="/contact-us/">Contact Us</a>

						</p>

						<p><strong>Hours</strong><br>

							9am&nbsp;-&nbsp;5pm Monday&nbsp;-&nbsp;Friday

						</p>

					</div>

				</div>



				<div class="row intro-book text-uppercase font-90">

					<div class="col-12 col-md">

						<div class="border-top my-3"></div>

						<ul class="list-inline">

							<li class="list-inline-item">© 2019</li>

							<li class="list-inline-item">·</li>

							<li class="list-inline-item"><a href="/privacy-policy/">Privacy Policy</a></li>

							<li class="list-inline-item">·</li>

							<li class="list-inline-item"><a href="/jobs/">Employment Opportunities</a></li>

							<li class="list-inline-item">·</li>

							<li class="list-inline-item"><a href="/media/videos/annual-family-updates/">Annual

									Reports</a></li>

						</ul>

					</div>

				</div>

			</div>

		</footer>



	</div> <!-- end wrapper -->



<!-- Javascript ================================================== -->	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>window.jQuery || document.write('<script src="/site/templates/js/plugins/jquery/jquery-3.5.1.min.js" type="text/javascript"><\/script>')</script>

<script src="/site/templates/js/plugins/bootstrap-select/popper.min.js"></script>

<script src="/site/templates/js/bootstrap-4.min.js"></script>

<script src="/site/templates/js/plugins/emailObfuscation/emo.min.js"></script>

<script src="/site/templates/js/plugins/audio/audioplayer.js"></script>

<script src="/site/templates/js/plugins/fitvids/jquery.fitvids.min.js"></script>

<script src="/site/templates/js/plugins/share/share.js"></script>

<script src="/site/templates/js/plugins/validate/jquery.validate.js"></script>

<script src="/site/templates/js/plugins/magnific/jquery.magnific-popup.min.js"></script>

<script src="/site/templates/js/plugins/menuzord/menuzord.js"></script>

<script src="/site/templates/js/main-2019.js"></script>



<style>

	div#corona-updates, div#corona-live {

		color: white;

		text-align: center;

		font-weight: bold;

	}

	div#corona-updates {

		background-color: #E16B37;

	}

	div#corona-live {

		background-color: #213EA7;

	}

	div#colorbox.corona-popup {

		background-color: #000;

	}

	div#cboxMiddleLeft, div#cboxMiddleRight {

		background-image: unset;

		width: 10px;

	}

	div#cboxTopLeft, div#cboxTopCenter, div#cboxTopRight, div#cboxBottomLeft, div#cboxBottomCenter, div#cboxBottomRight {

		background-image: unset;

		height: 10px;

		width: 10px;

	}

	div#cboxLoadedContent {

		margin-bottom: 0 !important;

	}

	button#cboxClose {

		display: none;

	}

	#colorbox, #cboxOverlay, #cboxWrapper {

		z-index: 99999;

	}

</style>



<div id="pop_up" class="hide">

	<div id="corona-updates" class="p-5 serif">

		<h4>CORONAVIRUS (COVID-19) UPDATES</h4>

		<a href="/coronavirus-updates" class="btn btn-outline-light">CLICK HERE</a>

	</div>

	<div id="corona-live" class="p-5 serif">

		<h4>DUE TO THE RECENT (COVID-19) PRECAUTIONS, WE’VE CANCELED GATHERINGS AT THE CROSSPOINT CAMPUS THIS SUNDAY, 3/15</h4>

		<a href="/live" class="btn btn-outline-light">WATCH LIVE 9 & 11 AM</a>

	</div>



	<div class="p-2 serif" style="background-color: #000; text-align: center;">

		<a href="#" onclick="$.colorbox.close(); return false;" class="btn btn-outline-light">Continue to Home Page</a>

	</div>



</div>



<script src="/Scripts/jquery.colorbox-1.6.4-min.js"></script>

<script>

	$(document).ready(function() {

		$.colorbox({

			open: true,

			html: $('#pop_up').html(),

			width:'80%',

			fixed: true,

		});

	});

</script>



</body>



</html>