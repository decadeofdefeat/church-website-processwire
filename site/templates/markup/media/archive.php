<?php


echo "<div class='section ' >

    <div class='container mg-t-lg mg-b-lg serif' >";

 $searchPage = wire('pages')->get('template=media-search');
 $searchQuery = htmlentities( $input->get->q , ENT_QUOTES, "UTF-8");
 if($searchQuery == '') $searchQuery = '';



echo "<div class='row'>
        <div class='col-md-6  '><h1 style='margin-top:0px;padding-top:0px;'>{$pageTitle}</h1>";
if($input->get->q != '') echo "<p>Results for: ".strip_tags($input->get->q)."</p>";
    echo "</div>";

echo "<div class='col-md-4 col-md-offset-2'><div id='search-content-form' class='search-series'>
     <form  id='search-content' action='".$searchPage->url."' method='get'>
            <input id='search-media-input'  placeholder='Search all media' type='text' name='q' value='".$searchQuery."' >
            <a id='search_content_query_btn' href='javascript:void(0);'' class='icon-right-4'></a>
    </form>
    </div> </div>";

echo "<div class='col-md-12'><hr class='thin-hr mg-t-sm2 mg-b-sm'></div>";
echo "</div>";

echo '<div class="row ">';

$series_root = $pages->get("/sermons/");
$generic_img = $series_root->images->first()->size(640, 360)->url;

$iterator = 1;


$out = '';
if( !empty($messages)> 0){
    foreach($messages->filter("start=$start, limit=$limit, sort=-media_date") as $m) {
                 $datestr = date("Y-m-d", strtotime($m->media_date));

                 $speakers = '';
                 if( !empty($m->media_speaker) )
                 {
                    $speakerTotal = !empty($m->media_speaker);
                    $s = 0;
                    foreach($m->media_speaker as $speaker) {
                        $speakers .= "<a href='".$speaker->url."'>".$speaker->title."</a>";
                        $s++;
                        if( $speakerTotal  != $s ) $speakers .= ", ";
                    }
                }

                 $out .= "<div class='item-and-audio-holder'  >";

                 $out .= "<div class='row mg-b-md2 mg-t-md2'>";

                if($m->template == 'series')
                {
                    if(!empty( $m->thumbnail) > 0)
                    {
                         $thumb =  $m->thumbnail->size(640, 360)->url;
                    }
                     else if(!empty( $m->series_wide_graphic) > 0)
                    {
                         $thumb =  $m->series_wide_graphic->size(640, 360)->url;
                    }
                }
                else
                {

                    if($m->media_thumbnail != '')
                    {
                        $thumb = $m->media_thumbnail;
                    }
                    else if(!empty( $m->parent->thumbnail) > 0)
                    {
                         $thumb =  $m->parent->thumbnail->size(640, 360)->url;
                    }
                     else if(!empty( $m->parent->series_wide_graphic) > 0)
                    {
                         $thumb =  $m->parent->series_wide_graphic->size(640, 360)->url;
                    }
                    else
                    {
                        $thumb = $generic_img;
                    }

                }



                 $out .= "<div class='col-sm-4 col-md-3 col-md-offset-1 text-center' >";
                  $out .= "<a href='{$m->url}'><img src='{$thumb}' class='img-responsive img-full-width mg-b-md'></a>";

                $viewTitle = 'View Sermon';
                if($m->rootParent != '/sermons/')
                {
                    $viewTitle = 'View';
                }
                if($m->template == 'series')
                {
                    $viewTitle = 'View Series';
                }

                $out .= "<a href='{$m->url}' class='hidden-xs btn btn-left btn-default'><i class='icon-right-4'></i> ".$viewTitle."</a>";

                $out .= "</div>";


                 $out .= "<div class='col-sm-8  col-md-7 sermon-item-info' >
                            <a href='{$m->url}'>
                            <h3 class='mg-t-none' >{$m->title}</h3></a>";




                if($m->rootParent == '/sermons/' && $m->parent->series_standalone_year != 1 && $m->template != 'series')
                {
                     $out .= "<h4 style='font-size:1.3em;padding-bottom:0x;margin-bottom:0px;'>".$m->parent->title."</h4>";
                }

                $out .= "<h4>";
                $out .= $m->media_date;
                if($speakers != '') $out .= " &middot; ".$speakers;

                if( $m->media_closed_captioning != '') $out .= "  &middot; <i class='icon-cc'></i>";

                $out .= "</h4>";

                $out .= "<div class='serif-sm'>".truncate(strip_tags($m->body), 220)."</div>";


                $out .= "</div>"; // end col-sm-8
                $out .= "</div>"; // end row

                if($tt != $iterator)
                $out .= "<div class='row'><div class='col-md-12'><hr></div></div>";

                $!emptyDown--;
                $iterator++;

                 $out .= "</div>";
    }
}
else
{
    $out .= '<p>Nothing found.</p>';

}
echo $out;

if( !empty($messages)> 0)
{
    $messages->setLimit($limit);
    $messages->setTotal($total);
    $messages->setStart($start);

    $pagination = $messages->renderPager(array(
        'nextItemLabel' => "&raquo;",
        'numPageLinks' => 5,
        'previousItemLabel' => "&laquo;",
        'listMarkup' => "<div class='text-center '><ul class='pagination'>{out}</ul></div>",
        'itemMarkup' => "<li class='{class}'>{out}</li>",
        'linkMarkup' => "<a href='{url}'>{out}</a>",
        'currentItemClass' => 'active',
        'separatorItemLabel' => "<a href='#'>&hellip;</a>"
    ));

    echo '</div>';
    echo "<div class='clearfix'></div>";
    echo "<div class='row mg-t-md'><div class='col-md-12'>".$pagination."</div></div>";
}

echo "</div>";
echo "</div>";
echo "</div>";

?>