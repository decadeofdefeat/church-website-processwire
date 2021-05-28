<?php
/**
* Message/Media Search template
*
*/
include("./includes/head.php");
include("./includes/search-functions.php");
$resultsFound = false;
$q = $input->get->q;
if($q != '') {
// Send our sanitized query 'q' variable to the whitelist where it will be
// picked up and echoed in the search box by the head.inc file.
//print "val date is ".isValidDateTimeString($q);
$q = str_replace("%2C", "", $q);
$q = str_replace(",", "", $q);
//print "Q is ".$q;
if( isDate($q) == 'true')
{
//convert String to date Y-m-d
//print "ITS A DATE!!!";
$q = date( 'Y-m-d', strtotime( $q ));
$messages = $pages->find("template=media, has_parent!=tools,media_date=$q, sort=-media_date ");
}
else
{
$q = $sanitizer->selectorValue($input->get->q);
$input->whitelist('q', $q);
// not a date, so just search for string values
$messages = $pages->find("template=media|series,  has_parent!=tools,title|tags.title|media_date|media_speaker.title|category.title|body%=$q, sort=-media_date ");
}
$limit = 12;
$total = $messages->count();
$start = ($input->pageNum-1)*$limit;
if($total == 0)
{
$resultsFound = false;
}
else
{
$resultsFound = true;
}
$pageTitle = $page->title;
}
else
{
$resultsFound = false;
$q = "?";
$pageTitle = $page->title.": ".$q;
$messages = NULL;
$start = 0;
$total = 0;
$limit = 12;
}
$t = new TemplateFile(wire('config')->paths->templates .'markup/media/archive.php');
$t->set('messages', $messages);
$t->set('pageTitle', $pageTitle);
$t->set('start', $start);
$t->set('total', $total);
$t->set('limit', $limit);
$out = $t->render();
echo $out;
include("./includes/foot.php");