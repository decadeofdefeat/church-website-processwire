<?php


    $ignoreTpl = 'user|role|tags|feed|media-speaker|api|admin|permission|event-archive|event-repeater';


    // if someone searches for "february 14 sermon"

    $dateQuery = str_replace('sermon', '', $input->get->q);
    $dateQuery = str_replace("Today's", '', $dateQuery);
    $dateQuery = str_replace('service', '', $dateQuery);
    $dateQuery = trim(str_replace('message', '',$dateQuery));

    //print "3";


    if( isDate($dateQuery) == 'true')
    {
        //convert String to date Y-m-d
        //print "is date";

        $q = date( 'Y-m-d', strtotime( $dateQuery ));
        $matches = $pages->find("template!=$ignoreTpl,media_date=$q");
    }
    else
    {

        $selector = '';


        $qs = explode(" ", $q);

        $query = implode(' ',$qs);

        $query_full = $query;

        $num = 0;
        foreach($qs as $key => $q){
             $qs[$key] = $sanitizer->selectorValue($q);
             $num++;
        }

        $selector = "title|tags.title|category.title|media_speaker.title|sidebar_content|body%=" .$query_full.", ";

        if( count($matches) == 0 )
        {
             $selector = "title|tags.title|category.title|media_speaker.title|sidebar_content|body~=" . $query_full. ", ";

              $matches = $pages->find("template!=$ignoreTpl, ".$selector." has_parent!=/tools/");
        }

    }


?>