<?php

// convert a php unix timestamp to a javascript datetime format
$js_datetime = $page->end_date * 1000;

$today = date("U");   
$end_date = date('d M Y', $page->end_date);

$out = '';
$out = "{$page->body}<br/>";
$out .= "Event ending date: {$end_date}<br/>";

if ($today > $page->end_date)
    $out .= "<h3>Event is ended.</h3>";
else {
    $js = '';
    $js .= "<script src='{$config->urls->templates}/js/jquery.countdown/jquery.plugin.js'></script>\r\n";
    $js .= "<script src='{$config->urls->templates}/js/jquery.countdown/jquery.countdown.js'></script>\r\n";
    $js .= "<script>$(function(){endDay = new Date({$js_datetime});$('#Countdown-widget').countdown({until: endDay});});</script>";    

    $out .= "<div id='defaultcountdown' class='clearfix'></div>";
}

include("./includes/head-4.php");

$page->body = $out;
echo $page->body;

include("./includes/foot-4.php");
?>