<?php

/**
 * Story template
 *
 */

include_once("./includes/functions.inc");



include("./includes/head.inc");



echo "<div id='main-content'>";
echo "<div class='container mg-t-lg mg-b-lg serif'>";
echo "<div class='row'>";
echo "<div class='col-md-8 col-md-offset-2' >";



echo "<div class='story-title'>";
//if($page->vimeo_id != '' && $page->header_title == '')
echo "<h1 class='mg-b-none'>".$page->title."</h1>";
if( $page->story_subtitle != '')
{
  echo "<h3 class='mg-t-xs'>".$page->story_subtitle."</h3>";
}
echo "</div>";




echo "<div class='post-detail mg-t-md' >";
echo $page->body;

echo "<a class='btn btn-default btn-left' style='margin-top:20px;' href='/stories'><i class='icon-left-4'></i> View More Stories</a>
";
echo "</div>";

echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";


include("./includes/foot.inc");


