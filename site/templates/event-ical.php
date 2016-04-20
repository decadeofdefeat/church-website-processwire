<?php
$e_id = $input->get->id;

$event = $pages->get("template=event, id=$e_id");

$ics = $modules->get("MarkupiCalendar");

$event_title = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $event->title);

$ics->title = $event_title;
$ics->description = strip_tags($event->body);

$today = time();
$items = new PageArray();

// if its a repeater, add the repeating events
if($event->numChildren > 0)
{
    foreach ($event->children as $child) {
        # code...
        ///print $child->url;
        $items->add($child);
    }
}
else
{
    $items->add($event);
}


$ics->render($items);
?>