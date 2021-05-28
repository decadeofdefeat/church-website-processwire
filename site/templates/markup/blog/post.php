<?php

/**
 * Output a single blog post
 *
 * Used by /site/templates/markup/posts.php (via include)
 *
 * VARIABLES:
 * ==========
 * $page - the blog post to render (Page)
 * $small - whether to display it in a small/summarized format (boolean)
 *
 */


?>
<div class='post serif' id='post-<?php echo $page->id; ?>'>

    <div class='post-head'>

        <?php


        // headline
        $h = $small ? 'h2' : 'h1';
        echo "<$h class='post-headline'>";

        if($small) {
            echo "<a href='{$page->url}'>{$page->title}</a>";
        }
        else
        {
            echo "{$page->title}";
        }
        echo "</$h>";


         $authorURL = $sanitizer->pageName($page->createdUser->title);
        echo "<p class='post-author text-muted'>By <a href='/blog/author/{$authorURL}'>{$page->createdUser->title}</a>";

        if( count($page->category) > 0 ){
             echo "<span class='mg-l-sm mg-r-sm'>&middot;</span>Category: ";
             $out = '';
             foreach ($page->category as $cat) {
                $out .=  "<a href='{$cat->url}'>{$cat->title}</a>, ";
             }
             echo rtrim($out, ", ");
        }?>
<?php if( $page->show_publish_date == 1){ ?>
<span class='entry-date'><em>Posted on <?php echo $page->date;?></em></span>
<?php }  ?>
<?php        echo "</p>";

       if( count($page->thumbnail) > 0)
       {
            // use original image if it's one of two sizes..
            if( ($page->thumbnail->width() == '1280' &&  $page->thumbnail->height() == '720')
                || ($page->thumbnail->width() == '640' &&  $page->thumbnail->height() == '360'))
            {
                 $thumb = $page->thumbnail->url;
            }
            else
            {
                 $thumb = $page->thumbnail->size(640,360)->url;
            }

            if( $page->hide_thumbnail_detail != 1 && $thumb != '')
                echo " <div class='mg-b-sm2 mg-t-sm'><img src='{$thumb}' class=' img-responsive img-full-width' /></div>";
       }

    ?>
    </div>

    <div class='post-body post-detail'>

        <?php
        if($small) {
            echo "<p>" . $page->summary . "&hellip;</p><p><a class='btn btn-default mt-20' href='{$page->url}'>" . __('<i class="icon-right-4"></i> Read More') . "</a></p><hr>";
        } else {

            $bodyContent = $page->body;
            echo  $bodyContent;

        }
        ?>

    </div>
<?php /*
     if( $page->show_publish_date == 1){ 
   <div class='post-foot'>
      <span class='entry-date'><em>Posted on <?php echo $page->date;?></em></span>


    </div>
     }
    */?>
</div>