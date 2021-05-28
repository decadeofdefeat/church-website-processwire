<?php

/**
 * Output multiple blog posts
 *
 * Used by the /site/templates/blog.php (renderPosts function)
 *
 * VARIABLES:
 * ==========
 * $posts - all the blog posts to render (PageArray)
 * $small - whether to display them in a small/summarized format (boolean)
 *
 */

if($small) {
    // display a headline indicating quantities
    $start = $posts->getStart()+1;
    $end = $start + !empty($posts)-1;
    $total = $posts->getTotal();

    //if($total) echo "<h3>" . sprintf(__('Posts %1$d to %2$d of %3$d'), $start, $end, $total) . "</h3>";
}

?>

<div class='posts<?php if($small) echo " posts-small"; ?>'>

    <?php
    foreach($posts as $page) {
        include('./post.php');
    }
    ?>

    <?php if(!!empty($posts)) echo "<h5>" . __("No posts found.") . "</h5>"; ?>

</div><!--/.posts-->

