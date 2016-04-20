<?php

$out = '';

include("./includes/functions.inc");

include("./includes/search-functions.inc");


if($q = $sanitizer->selectorValue($input->get->q)) {

    // Send our sanitized query 'q' variable to the whitelist where it will be
    // picked up and echoed in the search box by the head.inc file.
    $input->whitelist('q', $q);

    $original_q = $q;
    include("./includes/search-matches.inc");



    $limit = 5;
    $total = $matches->count();
    $start = ($input->pageNum-1)*$limit;

    $eventMatches = new PageArray();
    $eventMatches->import($matches);

    $mediaMatches = new PageArray();
    $mediaMatches->import($matches);

    $otherMatches = new PageArray();
    $otherMatches->import($matches);

    $eventTotal = $eventMatches->filter("template=event")->count();
    $mediaTotal = $mediaMatches->filter("template=media|series|media-archive")->count();
    $otherTotal = $otherMatches->filter("template!=media|event|series|media-archive")->count();

    if($total > 0) {

        if( $input->get->type == 'events')
        {
             /// Event Results
            $out .= "<div id='results-events' class='mg-t-md mg-b-lg'><h2>Your search for '".strip_tags($original_q)."' produced ".$eventTotal." event results</h2><hr>" .
                "<ul class='search_results'>";

                    foreach($eventMatches->filter("sort=event_date, template=event, limit=$limit, start=$start") as $m) {
                        $disclaimer = '';
                        $extraCopy = '';
                        $lineBreak1 = '';
                        $end_time_display = '';

                       if(empty($m->summary)) {
                        // summary is blank so we auto-generate a summary from the body
                        $m->summary = truncate(strip_tags($m->body), 300);
                        }

                        if( $m->summary != '')
                        {
                            $lineBreak1 = '<br/>';
                        }

                        if($m->event_repeater_boolean == 1)
                        {
                          $start_time = date("g:i A", strtotime($m->event_date));
                          $end_time = date("g:i A", strtotime($m->event_date_end));
                          if($end_time != $start_time)
                          {
                            $end_time_display = " - ".$end_time;
                          }

                          $start_day = date("m/d/Y", strtotime($m->event_date));
                          $end_day = date("m/d/Y", strtotime($m->event_date_end));

                          if($m->event_infinite_boolean == 1)
                          {
                            $time = $m->event_date_details.", ".$start_time.$end_time_display;
                          }
                          else
                          {
                             $edd = 'From ';
                             if( $m->event_date_details != '')
                                $edd = $m->event_date_details.", from ";
                            $time = $edd.$start_day." to ".$end_day.", ".$start_time.$end_time_display;
                          }
                        }
                        else
                        {
                          $date_time = date("l, F j, Y", strtotime($m->event_date));
                          $start_time = date("g:i A", strtotime($m->event_date));
                          $end_time = date("g:i A", strtotime($m->event_date_end));
                          if($end_time != $start_time)
                          {
                            $end_time_display = " - ".$end_time;
                          }
                          $time = $date_time.", ".$start_time.$end_time_display;


                        }

                        $extraCopy = "<span class='mg-t-xs span-block'><em>{$time}</em></span>";

                        $out .= "<li><h3><a href='{$m->url}'>{$m->title}</a></h3><p class='serif serif-small'>".$disclaimer."{$m->summary}{$lineBreak1}".$extraCopy."</p></li>";
                    }

                    $out .= "</ul>";

                    $eventMatches->setLimit($limit);
                    $eventMatches->setTotal($eventTotal);
                    $eventMatches->setStart($start);

                    $pagination_events = $eventMatches->renderPager(array(
                        'nextItemLabel' => "&raquo;",
                        'previousItemLabel' => "&laquo;",
                        'listMarkup' => "<div class='text-center '><ul id='pagination-events' class='pagination'>{out}</ul></div>",
                        'itemMarkup' => "<li class='{class}'>{out}</li>",
                        'linkMarkup' => "<a href='{url}'>{out}</a>",
                        'currentItemClass' => 'active',
                        'separatorItemLabel' => "<a href='#'>&hellip;</a>"
                    ));

                    // swap out with custom link
                    $pagination_events = str_replace('/tools/search-ajax/', '/search/', $pagination_events);

                    $out .= $pagination_events;

                    $out .= "</div>";


        } elseif(  $input->get->type == 'other') {

          /// Page, News and Blog Results


         $out .= "<div id='results-other' class='mg-t-md  mg-b-lg'><h2>Your search for '".strip_tags($original_q)."' produced ".$otherTotal." page results</h2><hr>" .
            "<ul class='search_results'>";

                foreach($otherMatches->filter("template!=media|event|series|media-archive, sort=-created, limit=$limit, start=$start") as $m) {
                    $disclaimer = '';
                    $extraCopy = '';
                    $type = "<p class='mg-t-xs mg-b-xs'>Type: Page</p>";

                    if($m->template == 'post')
                    {
                        $type = "<p class='mg-t-xs mg-b-xs'>Type: Blog Post</p>";
                    }
                    if($m->template == 'basic-page' || $m->template == 'group-sections' || $m->template == 'group-section')
                    {

                    }

                    if($m->parent->id == 14185)
                    {
                        $type = "<p class='mg-t-xs mg-b-xs'><strong>Type:</strong> Album</p>";
                    }


                     if($m->template == 'staff-detail' )
                    {
                         $type = "<p class='mg-t-xs mg-b-xs'>Type: Staff &amp; Board Page</p>";
                    }


                    if( $m->template->name == "tags") $disclaimer = " (Tag)<br />";

                    $summary = '';
                    if( $m->body != '')
                    {
                       //$q_without = notIncluding($q);
                       $summary =  truncatePreserveWords( strip_tags($m->body), $original_q, 5, "strong" );
                       /// truncate it again if its too long
                       $summary =  truncate( $summary, 300 );

                       if($summary == '')
                       {
                            $summary =  truncate( strip_tags($m->body), 300 );
                       }

                       // if there is no bolded text...
                       if( strpos($summary, "<strong>")  === false && $m->summary != '' )
                       {
                            $summary = $m->summary;
                       }
                    }




                    $out .= "<li><h3><a href='{$m->url}'>{$m->title}</a></h3>{$type}<p class='serif serif-small'>".$disclaimer."{$summary}".$extraCopy."</p></li>";
                }

                $out .= "</ul>";

                $otherMatches->setLimit($limit);
                $otherMatches->setTotal($otherTotal);
                $otherMatches->setStart($start);

                 $pagination = $otherMatches->renderPager(array(
                    'nextItemLabel' => "&raquo;",
                    'previousItemLabel' => "&laquo;",
                    'listMarkup' => "<div class='text-center '><ul id='pagination-other' class='pagination'>{out}</ul></div>",
                    'itemMarkup' => "<li class='{class}'>{out}</li>",
                    'linkMarkup' => "<a href='{url}'>{out}</a>",
                    'currentItemClass' => 'active',
                    'separatorItemLabel' => "<a href='#'>&hellip;</a>"
                ));

                // swap out with custom link
                $pagination = str_replace('/tools/search-ajax/', '/search/', $pagination);
                $out .= $pagination;

                $out .= "</div>";


        /// Media Results

        } elseif(  $input->get->type == 'media') {

        $out .= "<div id='results-media' class='mg-t-md'><h2>Your search for '".strip_tags($original_q)."' produced ".$mediaTotal." media results</h2><hr>" .
            "<ul class='search_results'>";

                foreach($mediaMatches->filter("sort=-media_date,sort=-series_date_start, template=media|series|media-archive, limit=$limit, start=$start") as $m) {
                    $disclaimer = '';
                    $extraCopy = '';
                    $lineBreak1 = '';
                    if( $m->template->name == "tags") $disclaimer = " (Tag)<br />";
                    if( $m->template->name == "media")
                    {
                        $speakers = '';
                         if( count($m->media_speaker) )
                         {
                            $speakerTotal = count($m->media_speaker);
                            $s = 0;
                            $speakers .= "<p class='mg-t-xs mg-b-xs'><strong>Speaker:</strong> ";
                            foreach($m->media_speaker as $speaker) {
                                $speakers .= $speaker->title;
                                $s++;
                                if( $speakerTotal  != $s ) $speakers .= ", ";
                            }
                            $speakers .= "</p>";
                         }

                        $extraCopy = "<span class='mg-t-xs span-block'><em>{$m->media_date}</em></span>";
                    }
                    if( $m->template->name == "series") $extraCopy = "Series";

                    $summary = '';
                    if( $m->body != '')
                     $summary = truncate(strip_tags($m->body), 300);




                    if( $summary != '')
                    {
                        $lineBreak1 = '<br/>';
                    }

                    $out .= "<li><h3><a href='{$m->url}'>{$m->title}</a></h3>{$speakers}<p class='serif serif-small'>".$disclaimer."{$summary}{$lineBreak1}".$extraCopy."</p></li>";
                }

                $out .= "</ul>";


                $mediaMatches->setLimit($limit);
                $mediaMatches->setTotal($mediaTotal);
                $mediaMatches->setStart($start);

                $pagination_media = $mediaMatches->renderPager(array(
                    'nextItemLabel' => "&raquo;",
                    'previousItemLabel' => "&laquo;",
                    'listMarkup' => "<div class='text-center '><ul id='pagination-media' class='pagination'>{out}</ul></div>",
                    'itemMarkup' => "<li class='{class}'>{out}</li>",
                    'linkMarkup' => "<a href='{url}'>{out}</a>",
                    'currentItemClass' => 'active',
                    'separatorItemLabel' => "<a href='#'>&hellip;</a>"
                ));

                // swap out with custom link
                $pagination_media = str_replace('/tools/search-ajax/', '/search/', $pagination_media);

                $out .= $pagination_media;

                $out .= "</div>";
        }

    }
}

print $out;

?>