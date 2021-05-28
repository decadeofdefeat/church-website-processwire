<?php  include("./includes/head-4.php"); ?>

<div class="pt-4">
	<section class="grid-animate py-5 serif">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-md-6 ">
					<div class="left-block animation-element anim-slide-up-fade-in"><h1>Location</h1>
						<p><?php echo $page->address;?></p>
						<h6><a href="<?php echo $page->directions; ?>" target="_blank">Get Directions</a></h6>
						<h1>Contact</h1>
						<h6>PHONE</h6>
						<p><?php echo $page->campus_phone;?></p>
						<h6>EMAIL</h6>
						<p><a href="/forms/contact/" class="btn btn-default">Contact Us</a></p></div>
					</div>
					<div class="col-md-6 block-img animation-element anim-slide-left-fade-in"
						style="min-height:30rem; background:url('/site/assets/files/<?php echo $page->id;?>/<?php echo $page->title;?>_color.jpg')">
					</div>
				</div>
			</div>
		</section>
		<?php 
	//	$map = wire('modules')->get('MarkupLeafletMap');
	//	echo $map->render($items, '$page->map_marker', array('height' => '500px'));
		?>
		<section class="grid-animate py-5 serif">
		<div class="container-fluid">
			<div class="row ">
				<div class="col-12 col-md-6 block-img animation-element anim-slide-right-fade-in"
					style="min-height:30rem; background:url('/site/assets/files/<?php echo $page->id;?>/<?php echo $page->title;?>_parking.jpg')">
				</div>
				<div class="col-12 col-md-6 ">
					<div class="right-block my-5 mx-5 animation-element anim-slide-up-fade-in"><h1>Parking Info</h1>
						<p><?php echo $page->campus_parking;?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="grid-animate py-5 serif">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-6 ">
				<div class="left-block animation-element anim-slide-up-fade-in">
					<h1>Children &amp; Students</h1>
					<?php $page->campus_kidsstudents;?>
				</div>
				</div>
				<div class="col-md-6 block-img animation-element anim-slide-left-fade-in"
					style="min-height:30rem; background:url('/site/assets/files/<?php echo $page->id;?>/<?php echo $page->title;?>.jpg')">
				</div>
			</div>
		</div>
	</section>

	<section class="grid-animate py-5 serif">
	<div class="container">
		<div class="row ">
			<div class="col-12 col-md-4 py-5 animation-element anim-slide-right-fade-in" >
				<img class="img-fluid img-full-width pastor-img" src="/site/assets/files/<?php echo $page->id;?>/<?php echo $Speakers = str_replace(' ', _, $page->Speakers);?>.jpg" />
			</div>
			<div class="col-12 col-md-8">

				<div class="right-block animation-element anim-slide-up-fade-in"><h1>Meet <?php echo $page->Speakers;?></h1>
					<p><em><?php echo $page->title;?> Pastor</em></p>
					<p>
					    <?php echo $page->bio;?>
					</p>
				</div>
				</div>
			</div>
		</div>
	</section></div>
	<section class="grid-animate py-5 serif">
		<div class="container">
			<div class="row text-center">
				<div class="col-12 px-5 py-5 animation-element anim-slide-up-fade-in">
					<h3 class="teal">Still have questions?</h3>
					<p>We can help you plan your first visit.</p>
					<a class="btn btn-outline-dark btn-sm mt-3" href="/about/contact/">Contact Us</a>
				</div>
			</div>
		</div>
	</section>

<?php include("./includes/foot-4.php");?>