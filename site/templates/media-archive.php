<?php

/**
 * Message Archive template
 *
 */

include("./includes/head.inc");

$tagPage = false;

$pageTitle = $page->title;

switch( $page->id )
{
    case 2150:
         $messages = $pages->get("/sermons/")->find("template=media,  sort=-media_date ");
    break;
    case 2392:
        // tags page
        $tagPage = true;
        $tag = str_replace("-", " ", $input->urlSegment1);
        $pageTitle = "Media Tag: " .ucwords($tag);
        $messages = $pages->find("template=media, tags.title=$tag, sort=-media_date ");
    break;
    default:
        $messages = $page->find("template=media, sort=-media_date ");
    break;
}

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