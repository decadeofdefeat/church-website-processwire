<?php

/**
 * Message Speaker template
 *
 */

include("./includes/head.inc");

$pageTitle = $page->title;
$messages = $pages->find("template=media, media_speaker.title=$pageTitle,  sort=-media_date ");

$limit = 12;
$total = $messages->count();
$start = ($input->pageNum-1)*$limit;

$t = new TemplateFile(wire('config')->paths->templates .'markup/media/archive.php');
$t->set('messages', $messages);
$t->set('pageTitle', $pageTitle);
$t->set('start', $start);
$t->set('total', $total);
$t->set('limit', $limit);
$out = $t->render();
echo $out;


include("./includes/foot.inc");