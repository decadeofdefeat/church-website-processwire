
<?php
 if ($user->hasRole("superuser")):
// echo content below if logged in
?>
<?php include("./includes/head.php");?>
<div class="row">
	<div class="">
		<header class="primary">
			<h1><?php echo $page->title;?></h1>
		</header>
		<nav class="primary">
			<ul class="nav-justified">
				<li>
					<a class="text-white" href="javascript:void();" data-toggle="modal" data-target="#set_presets">Assign Presets</a>
				</li>
				<li>
					<a class="text-white" href="javascript:void();" data-toggle="modal" data-target="#cam_adjust_control_settings">Preferences</a>
				</li>
			</ul>
		</nav>
		<form role="form" class="form-horizontal">
			<div class="row">
				<div class="col-xs-6">
					<fieldset class="presets">
						<div class="row">
							<h4 style="color: white;">Presets</h4>
						</div>
						<div class="row">
							<a style="width:200px;height:110px;" class="call_preset preset_button preset-1" data-preset="1" href="javascript:void();">
								<?php echo $page->preset1;?><br />
							1</a>
							<a style="width:200px;height:110px;" class="call_preset preset_button preset-2" data-preset="2" href="javascript:void();">
								<?php echo $page->preset2;?><br />
							2</a>
							<a style="width:200px;height:110px;" class="call_preset preset_button preset-3" data-preset="3" href="javascript:void();">
								<?php echo $page->preset3;?><br />
							3</a>
						</div>
						<div class="row">
							<a style="width:200px;height:110px;"  class="call_preset preset_button preset-4" data-preset="4" href="javascript:void();">
								<?php echo $page->preset4;?><br />
							4</a>
							<a style="width:200px;height:110px;"  class="call_preset preset_button preset-5" data-preset="5" href="javascript:void();">
								<?php echo $page->preset5;?><br />
							5</a>
							<a style="width:200px;height:110px;"  class="call_preset preset_button preset-6" data-preset="6" href="javascript:void();">
								<?php echo $page->preset6;?><br />
							6</a>
						</div>
						<div class="row">
							<a style="width:200px;height:110px;" class="call_preset preset_button preset-7" data-preset="7" href="javascript:void();">
								<?php echo $page->preset7;?><br />
							7</a>
							<a style="width:200px;height:110px;" class="call_preset preset_button preset-8" data-preset="8" href="javascript:void();">
								<?php echo $page->preset8;?><br />
							8</a>
							<a style="width:200px;height:110px;" class="call_preset preset_button preset-9" data-preset="9" href="javascript:void();">
								<?php echo $page->preset9;?><br />
							9</a>
						</div>
						
					</fieldset>
				</div>
				<div class="col-xs-6">
					<fieldset class="controls">
						<div class="row">
							<h4 style="color: white;">Pan Tilt Zoom</h4>
						</div>
						<div class="row">
							<a href="#" class="autopan"></a>
						</div>
						<div class="zoom_controls">
							<div class="rocker">
								<div class="row">
									<a class="toggle_button toggle-up toggle-zoom-in adjust_zoom" data-action="zoomin" href="javascript:void();"></a>
								</div>
								<div class="row">
									<a class="toggle_button toggle-down toggle-zoom-out adjust_zoom" data-action="zoomout" href="javascript:void();"></a>
								</div>
							</div>
						</div>
						<div class="focus_controls">
							<div class="rocker">
								<div class="row">
									<a class="toggle_button toggle-up toggle-focus-in adjust_focus" data-action="focusin" href="javascript:void(0);"></a>
								</div>
								<div class="row">
									<a class="toggle_button toggle-down toggle-focus-out adjust_focus" data-action="focusout" href="javascript:void();"></a>
								</div>
							</div>
						</div>
						<div class="pantilt_controls">
							<div class="row">
								<div class="pantilt_image pantilt-blank-top-left"></div>
								<a id="pantilt-button-up" class="pantilt-up pantilt_image adjust_pantilt" href="javascript:void();" data-action="up"></a>
								<div class="pantilt_image pantilt-blank-top-right"></div>
							</div>
							<div class="row">
								<a id="pantilt-button-left" class="pantilt-left pantilt_image adjust_pantilt" href="javascript:void();" data-action="left"></a>
								<a id="pantilt-button-home" class="pantilt-home pantilt_image adjust_pantilt" href="javascript:void();" data-action="home"></a>
								<a id="pantilt-button-right" class="pantilt-right pantilt_image adjust_pantilt" href="javascript:void();" data-action="right"></a>
							</div>
							<div class="row">
								<div class="pantilt_image pantilt-blank-bottom-left"></div>
								<a id="pantilt-button-down" class="pantilt-down pantilt_image adjust_pantilt" href="javascript:void();" data-action="down"></a>
								<div class="pantilt_image pantilt-blank-bottom-right"></div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<?php ob_start(); ?>
	<?php include'./js/camera.js.php';?>
	var remote = require('remote');
	var Menu = remote.require('menu');
	var template = [
	{
	label: 'Camera Control',
	submenu: [
	{
	label: 'About Camera Control',
	selector: 'orderFrontStandardAboutPanel:'
	},
	{
	type: 'separator'
	},
	{
	label: 'Services',
	submenu: []
	},
	{
	type: 'separator'
	},
	{
	label: 'Hide Camera Control',
	accelerator: 'Command+H',
	selector: 'hide:'
	},
	{
	label: 'Hide Others',
	accelerator: 'Command+Shift+H',
	selector: 'hideOtherApplications:'
	},
	{
	label: 'Show All',
	selector: 'unhideAllApplications:'
	},
	{
	type: 'separator'
	},
	{
	label: 'Quit',
	accelerator: 'Command+Q',
	selector: 'terminate:'
	},
	]
	},
	{
	label: 'Window',
	submenu: [
	{
	label: 'Minimize',
	accelerator: 'Command+M',
	selector: 'performMiniaturize:'
	},
	{
	label: 'Close',
	accelerator: 'Command+W',
	selector: 'performClose:'
	},
	{
	type: 'separator'
	},
	{
	label: 'Bring All to Front',
	selector: 'arrangeInFront:'
	}
	]
	},
	{
	label: 'Help',
	submenu: []
	}
	];
	menu = Menu.buildFromTemplate(template);
	Menu.setApplicationMenu(menu);
	<?php $additionalJS = ob_get_clean(); ?>
	<?php include("./includes/foot.php");?>
	<?php else: ?>
<?php $session->redirect($pages->get("/account/")->url); ?>
<?php endif; ?>