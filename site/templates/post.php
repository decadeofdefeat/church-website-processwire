<?php

/**
 * Blog Post template
 *
 */

include_once("./includes/functions.inc");



$thumb = $pages->get('/blog')->images->first()->size(640,360)->url;

// add additional meta tags
 if( count($page->thumbnail) > 0)
 {
      $thumb = $page->thumbnail->url;
 }



include("./includes/head.inc");
include_once("./includes/blog.inc");

function renderNextPrevPosts($page) {
    $date = $page->getUnformatted('date');
    $nextPost = $page->parent->child("date>$date, sort=date");
    $prevPost = $page->parent->child("date<$date, sort=-date");

    $out = "<div class='next-prev-posts'>";
    if($prevPost->id > 0) $out .= "<p class='prev-post'><span>&lt;</span> <a href='{$prevPost->url}'>{$prevPost->title}</a></p>";
    if($nextPost->id > 0) $out .= "<p class='next-post'><a href='{$nextPost->url}'>{$nextPost->title}</a> <span>&gt;</span></p>";
    $out .= "</div>";
    return $out;
}


// render our blog post and comments
$content = renderPosts($page);

// get date info for creating link to archives page in subnav
//$date = $page->getUnformatted('date');
//$year = date('Y', $date);
//$month = date('n', $date);
?>




    <div class="container mg-t-lg mg-b-lg">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 page-content">

            <?php
            echo $content;
            ?>

            <a class='btn btn-default btn-left' style='margin-top:20px;' href='<?php echo $page->parent->url;?>'><i class='icon-left-4'></i> View All Posts</a>

            </div>


    </div>




<?php

include("./includes/foot.inc");

