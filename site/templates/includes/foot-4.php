</main>

		<footer class="footer intro-book">
			<div class="container py-5">
				<div class="row">
					<div class="col-12 col-md-3">
						<h5 class="text-white">Thursday Service Times</h5>
						<ul class="list-unstyled text-small">
							<li>Vincennes, online 6:45pm</li>
						</ul>
						<h5 class="text-white">Sunday Service Times</h5>
						<ul class="list-unstyled text-small">
							<li><br>Vincennes, online 10:45am</li>
							<li><br>French (Creole) 12:30pm</li>
						</ul>
					</div>
					<div class="col-12 col-md-6 footer-social">
						<div class="d-block d-sm-block d-md-none border-top my-3"></div>
						<ul class="list-inline text-small">
							<li><a href="https://forms.thursdaychurch.org/forms/embed.php?id=12170" class="iframe btn btn-default">Request Prayer</a></li>

							<li><a href="https://forms.thursdaychurch.org/forms/embed.php?id=11234" class="iframe btn btn-default">Tech Support</a></li>

							<li><a href="https://forms.thursdaychurch.org/forms/embed.php?id=10708" class="iframe btn btn-default">Share Your Story</a></li>

							<li><a href="https://forms.thursdaychurch.org/forms/embed.php?id=10437" class="iframe btn btn-default">Contact Us</a></li>
		</ul>
						<h5 class="text-white">Follow Us</h5>
						<ul class="list-inline text-small">
							<li class="list-inline-item"><a target="_blank"
							href="https://fb.com/thursdaychurch2008"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item"><a target="_blank"
							href="https://instagram.com/thursday_church"><i class="fa fa-instagram"></i></a></li>
							<li class="list-inline-item"><a target="_blank"
							href="https://twitter.com/thursdaychurch"><i class="fa fa-twitter"></i></a></li>
							<li class="list-inline-item"><a target="_blank"
							href="https://youtube.com/c/thursdaychurchvin"><i class="fa fa-youtube"></i></a>
						</li>
					</ul>
				</div>
				<div class="col-12 col-md-3">
					<div class="d-block d-sm-block d-md-none border-top my-3"></div>
					<h5 class="text-white">Office Info</h5>
					<p>218 Main St.<br>
						Vincennes, IN 47591<br>
						812.882.2737<br>
						<a href="#contact-us" data-toggle="modal" data-target="#contact-us">Contact Us</a>
					</p>
					<p><strong>Hours</strong><br>
						9am&nbsp;-&nbsp;4pm Monday&nbsp;-&nbsp;Friday
					</p>
				</div>
			</div>
			<div class="row intro-book text-uppercase font-90">
				<div class="col-12 col-md">
					<div class="border-top my-3"></div>
					<ul class="list-inline">
						<li class="list-inline-item"> 2008-<?php echo date('Y');?> Thursday Church built with &hearts; by Greentree Consulting</li>
					<!--li class="list-inline-item">&nbsp;</li>
					<li class="list-inline-item"><a href="/privacy-policy/">Privacy Policy</a></li>
					<li class="list-inline-item">&nbsp;</li>
					<li class="list-inline-item"><a href="/jobs/">Employment Opportunities</a></li>
					<li class="list-inline-item">&nbsp;</li>
					<li class="list-inline-item"><a href="/media/videos/annual-family-updates/">Annual Reports</a></li-->
				</ul>
			</div>
		</div>
	</div>
</footer>
</div> <!-- end wrapper -->
<!-- Javascript ================================================== -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/site/templates/js/plugins/jquery/jquery-3.5.1.min.js" type="text/javascript"><\/script>')</script>
<script src="/site/templates/js/plugins/bootstrap-select/popper.min.js"></script>
<script src="/site/templates/js/bootstrap-4.min.js"></script>
<script src="/site/templates/js/plugins/emailObfuscation/emo.min.js"></script>
<script src="/site/templates/js/plugins/audio/audioplayer.js"></script>
<script src="/site/templates/js/plugins/fitvids/jquery.fitvids.min.js"></script>
<script src="/site/templates/js/plugins/share/share.js"></script>
<script src="/site/templates/js/plugins/validate/jquery.validate.js"></script>
<script src="/site/templates/js/plugins/magnific/jquery.magnific-popup.min.js"></script>
<script src="/site/templates/js/plugins/menuzord/menuzord.js?v=20190603"></script>
<script src="/site/templates/js/main-2019.js?v=20190603"></script>

<?php if(isset($additionalJS)) echo '<script>'. $additionalJS .'</script>'; ?>
<script src="/Scripts/jquery.colorbox-1.6.4-min.js"></script>
<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
<script src='https://platform-api.sharethis.com/js/sharethis.js#property=5cbe66b0c7f6b60012eed964&product=sop' async='async'></script>

		<!-- This contains the hidden content for inline calls -->
		<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
			<p><strong><?php echo $page->notificationtitle; ?></strong></p>
			<p><?php echo $page->notificationdetails;?>
        <!--a href="<?php //echo $page->notificationurl;?>" class="btn btn-outline-light"><?php //echo $page->notificationbtn;?></a--></p>
			
			
			</div>
		</div>
</body>
</html>