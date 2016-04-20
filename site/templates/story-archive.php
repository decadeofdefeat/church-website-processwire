<?php



if($input->urlSegment1) {

    include_once("./includes/blog.inc");

    // check for rss feed
    if($input->urlSegment1 != 'rss') throw new Wire404Exception();
    $homepage = $pages->get('/');



    renderRSS($page->children("limit=20"), $homepage->get('headline|title'), $homepage->get('summary|meta_description'), 'created', true);

} else {


    // display paginated blog list
    $headline = $page->get('headline|title');
    //$content = renderPosts("parent=$page,limit=2", true);

    //echo $content;

    include("./includes/head.inc");
    ?>



            <div class="container  mg-t-lg ">
                <div class="row ">
                    <div class="col-md-8 serif">

                             <?php echo $page->body;?>
                    </div>
                    <div class="col-md-3 col-md-offset-1  sidebar-section ">

                    <?php if($page->sidebar_content != ''){
                      echo "<div class='sidebar_content'>";
                      echo $page->sidebar_content;
                      echo "</div>";
                    } ?>


                      <?php if(count($page->related_events) > 0 ) {

                       print "<h3 style='margin-bottom:12px;margin-top:0px;'>EVENTS</h3>";
                       print "<ul class='related-links' style='margin-bottom:30px;'>";
                        foreach ($page->related_events as $event) {

                          print "<li><a href='{$event->url}'>".$event->title."</a></li>";
                        }
                        print "</ul>";
                      }
                      ?>


                    <?php if(count($page->resource_links) > 0 || $page->ministry_website != '') {?>

                    <h3 style='margin-bottom:12px;margin-top:0px;'><?php echo $page->resources_title == '' ? "RESOURCES" : $page->resources_title;?></h3>
                    <?php if($page->ministry_website != '')
                             echo "<a target='_blank' class='btn btn-default btn-left' style='margin-bottom:30px;' href='{$page->ministry_website}'>Visit Ministry Website</a>";
                    ?>




                     <?php if(count($page->resource_links) > 0 ) {


                        print "<ul class='related-links' style='margin-bottom:30px;'>";
                        foreach ($page->resource_links as $link) {
                          $ext = '';
                          $videoClass = '';
                          if( $link->external_link == 1) $ext = " target='_blank' ";
                          if( $link->video_popup == 1) $videoClass = "  video-popup ";
                          print "<li><a class=' {$videoClass} ' {$ext} href='{$link->link}'>".$link->title."</a></li>";
                        }
                        print "</ul>";
                    } ?>
                    <?php } ?>

                    <?php if(count($page->related_links) > 0 ) {

                        print "<h3 style='margin-top:0px;margin-bottom:12px;'>";
                        print $page->related_links_title == '' ? "RELATED" : $page->related_links_title;
                        print "</h3>";

                        print "<ul class='related-links'>";
                        foreach ($page->related_links as $link) {
                           $ext = '';
                          if( $link->external_link == 1) $ext = " target='_blank' ";
                          print "<li><a {$ext} href='{$link->link}'>".$link->title."</a></li>";
                        }
                        print "</ul>";
                    } ?>
                </div>
                </div>
            </div>




        <div class="container  mg-b-lg serif ">

            <div class='row'>
                <div class='col-md-12'>
                     <hr class='thin-hr' style='margin:40px 0px 40px 0px !important;'>
                <h2 class='mg-b-md'>Stories</h2>
                </div>
            </div>

            <div class="row multi-columns-row">
                <?php
                    $posts =  $pages->find("parent=/stories/, sort=-created, template=story-detail, limit=12");


                    $pagination =  $posts->renderPager(array(
                    'nextItemLabel' => "&raquo;",
                    'previousItemLabel' => "&laquo;",
                     'listMarkup' => "<div class='text-center '><ul class='pagination'>{out}</ul></div>",
                    'itemMarkup' => "<li class='{class}'>{out}</li>",
                    'linkMarkup' => "<a href='{url}'>{out}</a>",
                    'currentItemClass' => 'active',
                    'separatorItemLabel' => "<a href='#'>&hellip;</a>"
                ));


                    foreach ($posts as $post) {
                        echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mg-b-md media_item">';

                       $thumb = $pages->get('/blog')->images->first()->size(640,360)->url;


                       if( count($post->thumbnail) > 0)
                       {
                            $thumb = $post->thumbnail->size(640,360)->url;
                       }


                            echo " <a href='{$post->url}'><img src='{$thumb}' class='img-responsive img-full-width' /></a>
                                <h4 style='margin-bottom:2px;'><a href='{$post->url}'>{$post->title}</a></h4>";

                            echo "<p>".$post->summary."</p>";


                       echo '</div>';
                    }
                ?>
        </div>

    </div>

    <?php if($pagination != ''){?>
   <div class='container mg-b-lg'>
        <div class='row'>
            <div class='col-md-12'>


            <?php

             echo $pagination;
            ?>
        </div>
        </div>

    </div>
    <?php } ?>

<?php


    include("./includes/foot.inc");

}

