<?php
$homepage = $pages->get("/");
require_once( "functions.php");
$live = false;
if($config->live) $live = true;
// if you're on the live page, don't show the live top alert
if($page->id == 1369) $live = false;
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
if(  count($page->header_image) > 0  || count($page->series_wide_graphic) > 0 || count($page->series_banner_graphic) > 0  )
{
$shortHeader = '';
}
if($page->template == 'home')
{
$shortHeader = '';
$top_images = $page->home_topimage_rotation->getRandom();
$top_imgURL = $top_images->header_image->url;
$topStyle = '  background: #bfbfbf url("'.$top_imgURL.'") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; ';
if($live)  $topStyle .= " background-position:center 20px;";
}
if(count($page->header_image) > 0 || $page->template == 'series' || $page->template == 'media_archive' && $page->short_header == 0 ){
if( count($page->series_wide_graphic) > 0)
{
$top_imgURL = $page->series_wide_graphic->url;
}
if( count($page->series_banner_graphic) > 0)
{
$top_imgURL = $page->series_banner_graphic->url;
}
if( count($page->header_image) > 0 )
{
$top_imgURL = $page->header_image->url;
}
if( $page->header_img_cdn != '' )
{
$top_imgURL = $page->header_img_cdn;
}
$topStyle = ' background: #bfbfbf url("'.$top_imgURL.'") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; ';
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
<html lang='en'>
	<head>
		<title><?php echo $page->get("headline|title"); ?></title>
		<?php $bodyText = $page->summary;
		if($bodyText == ''){
		$bodyText = strip_tags(truncate(wire("page")->body, 200));
		$bodyText = str_replace(array("\r", "\n"), " ", $bodyText);
		$bodyText = str_replace('"', "&quot;", $bodyText);
		$bodyText = str_replace("    ", " ", $bodyText);
		}
		?>
		<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
		<meta content='width=device-width' name='viewport'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="<?php  echo $bodyText; ?>">
		<meta name="author" content="thursdaychurch.org">
		<?php $td = $config->urls->templates;
		$rp = $config->ssl_rootName;
		?>
		<!-- styles -->
		<meta name="google-site-verification" content="lWrYDL3BXnNmzxNLdgsEIowQBq5t935_iL40gZtSlSQ" />
		<link href="/site/templates/css/styles.css" rel="stylesheet" type="text/css">
		<script src="https://kit.fontawesome.com/6fed92b3c4.js" crossorigin="anonymous"></script>
		<meta name="theme-color" content="#ffffff">

	</head>
	<body class='page-id-<?php echo $page->id;?> template-<?php echo $page->template;?> <?php echo $shortHeader;?> <?php if($liveHome) echo "has-top-live";?>  <?php if($live) echo " streaming-live ";?>'>
		<div class="wrapper">
			<?php if($page->isnotification == '1'){?>
			<div id='top-news-bar'>
				<div class='container pd-t-sm pd-b-sm'-->
					<div class='row'>
						<div class='col-md-12'>
							<a class='inline' href="#inline_content"><i class="flaticon stroke wireless"></i> <?php echo $page->notificationtitle; ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if($live){?>
			<div id='top-news-bar'>
				<div class='container  pd-t-sm pd-b-sm'>
					<div class='row'>
						<div class='col-md-12'>
							<a class="button w-icon" href="http://live.thursdaychurch.org"><i class="flaticon stroke wireless"></i>We Are Live: Join Us Online</a>
						</div></div></div>
					</div>
					<?php } ?>
					<section id="nav">
						<div id="menuzord" class="menuzord">
							<h1 style="display:none;">menu</h1>
							<div id="search-area" style='display: none;'>
								<?php $searchPage = $pages->get('template=search');
								$searchQuery = htmlentities(wire('input')->whitelist('q'), ENT_QUOTES, "UTF-8");
								if($searchQuery == '') $searchQuery = '';?>
								<form id="search-form-top" action='<?php echo $searchPage->url; ?>' method='get'>
									<div class="input-container">
										<input aria-label="Search the site" class="form-control input-transparent" placeholder='Search the site' type='text' name='q' value='<?php echo $searchQuery; ?>'>
									</div>
									<a aria-label="Search the site" id="search_nav_btn" class="icon-zoom-2"></a>
								</form>
							</div>
							<a href="/" class="chapel-logo" title="Thursday Church">
								<!--div id="logo-mark"-->
								Thursday Church
								<!--/div-->
								<!--div id="logo-text">
									Church
							</div-->
						</a>
						<ul class="menuzord-menu menuzord-right">
							<li><a href="/">Home</a></li>
							<li><a>Who We Are</a>
							<ul class="dropdown">
								<li><a href='/about/'>About Us </a></li>
								<li><a href='/about/staff/'>Meet The Team </a></li>
								<li><a href='/about/beliefs/'>What We Believe </a></li>
								<li><a href="https://forms.thursdaychurch.org/forms/embed.php?id=10437" class="iframe">Contact Us </a></li>
							</ul>
						</li>
						<!--li><a href="/locations">Locations</a>
						<ul class="dropdown">
								<li><a href='/locations/vincennes/'>Vincennes </a></li>
								<li><a href='/locations/bicknell/'>Bicknell </a></li>
								<li><a href='/locations/french-creole/'>French (Creole) </a></li>
						</ul>
					</li-->
					<li><a href="javascript:void();">Ministries</a>
					<ul class="dropdown">
						<li><a href='/ministries/3d-groups/'>3D Groups </a></li>
						<li><a href='/ministries/kids/'>Kids </a></li>
						<li><a href='/ministries/students/'>Students </a></li>
						<li><a href='/ministries/life-groups/'>LIFE Groups </a></li>
						<li><a href='/ministries/global-missions/'>Global Missions </a></li>
						<li><a href='/ministries/mobile-food-pantry/'>Mobile Food Pantry </a></li>
						<li><a href='/ministries/businesses/'>Businesses </a></li>
					</ul>
				</li>
				<li><a href="/events/">Events</a></li>
				<li><a>Watch</a>
				<ul class="dropdown">
					<li><a href="//live.thursdaychurch.org" target="_blank">Live</a></li>
					<li><a href="/messages/">Messages</a></li>
				</ul>
			</li>
			<li><a href="https://faithlife.com/thursday-church-j/give?embed=true&ssi=0" class="iframe">Give</a></li>
			<li style='display: none;'><a id="open-search" href="javascript:void(0)"><i class="icon-zoom-2"></i></a></li>
			<li><a id="mobile-search" class="text-center" href="/search">Search <i class="icon-zoom-2"></i></a></li>
			<li class="scrollable-fix"></li>
		</ul>
	</div>
</section>

<header class="page-hero-header bg-cover " style="background: url('<?php echo $top_imgURL;?>')">
	<!-- ADD WELCOME BACKGROUND VIDEO -->
	<!--video loop muted autoplay class="fullscreen-bg-video">
	<source src="/site/assets/files/1/home-bg.mp4" type="video/mp4">
</video-->
<!-- /ADD WELCOME BACKGROUND VIDEO -->
<div class="container h-100">
	<div class="row align-items-center h-100 text-white text-center hero-text">
		<div class="col-md-10 mx-auto slide-up-fade-in">
			<div class="px-2 pt-4">
				<?php if( $page->header_title != '') {?>
				<h1><?php echo $page->header_title;?></h1>
				<?php } ?>
				<?php if( $page->header_description != '') {?>
				<p class='subline'><?php echo $page->header_description;?></p>
				<?php } ?>
				<br />
				<?php if($page->template == 'home') {?>
				<div class='mt-3'>
					<a href="https://forms.thursdaychurch.org/forms/embed.php?id=12170" class="iframe btn btn-outline-light">Request Prayer</a>
					
					<a class='btn btn-outline-light' href='/messages/'>Recent Sermons</a>
					<a class='iframe btn btn-outline-light' href="https://faithlife.com/thursday-church-j/give?embed=true&ssi=0">Give Online</a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

</header>
<main class="main">
<?php if($page->short_header == 1) {;?>
<section class="black-bg" >
	<div class="container py-xl ">
		<div class="row">
			<div class="col-12 teal">
				<h1 class="text-white"><?php echo("$page->title");?></h1>
			</div>
		</div>
	</div>
</section>
<?php } ?>