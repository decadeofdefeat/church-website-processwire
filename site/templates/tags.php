<?php

/**
 * Tags template
 *
 */

include("./includes/head.inc");
?>

 <div class="container mg-t-lg mg-b-lg serif">
                <div class="row">
                    <div class="col-md-12 ">
                            <?php if( $page->id != 1011) {?>
                             <h1>Topic results for "<?php echo $page->title;?>"</h1>
                             <?php } else { ?>
                                <h1>Tags</h1>
                             <?php } ?>

                    </div>
                </div>

<div class="row mg-t-md">
<div class="col-md-12">

<?php if( $page->id == 1011) {

        // list all tags, by most pages with tag
        $tags = $page->children->filter('sort=name, featured_tag=1, limit=50');

        $n = 0;
        print "<div class='row'>";
        foreach ($tags as $t) {
             if( $n == 0 || $n == 12 || $n == 24 || $n == 36 )
            {
                print "<div class='col-sm-3 col-md-3'>";
            }
            print "<p class='mg-b-sm'><a href='" .$t->url. "'].'>".ucwords($t->title)."</a></p>";
            if( $n == 11 || $n == 23 || $n == 35  )
            {
                print "</div>";
            }
            $n++;

             $t->of(false);
                $t->featured_tag = 1;
                $t->save();
        }
         print "</div></div>";

        /*

            // FUNCTION TO GET the total count of tags for pages
            // this should be refreshed every once in a while


            $tag_array = array();
            foreach ($page->children as $t) {
                # code...

                // determine number of tagged items for it
                $count = $pages->count("tags=$t");
                $newdata =  array (
                      'title' => $t->title,
                      'url' => $t->url,
                      'count' => $count
                    );

                $tag_array[] = $newdata;

                $t->of(false);
                $t->pages_count = $count;
                $t->save();
            }

            $name = 'count';
            usort($tag_array, function ($a, $b) use($name){ return $b[$name] - $a[$name];});

            $sliced_array = array_slice($tag_array,0,40);

            $name = 'title';
            usort($sliced_array, function ($a, $b) use($name){ return $a[$name] - $b[$name];});

            $n = 0;
            print "<div class='row'>";
            foreach ($sliced_array as $tagg) {
                if( $n == 0 || $n == 11 || $n == 21 || $n == 31 )
                {
                    print "<div class='col-md-3'>";
                }
                print "<p class='mg-b-md'><a href='".$tagg['url']."'>".ucfirst($tagg['title'])."</a></p>";
                if( $n == 10 || $n == 20 || $n == 30 || $n == 40 )
                {
                    print "</div>";
                }
                $n++;
            }
             print "</div>";

                */
 ?>




<?php } else { ?>


        <?php
        $posts = $pages->find("tags=$page, template=post");
        $events = $pages->find("tags=$page, template=event");
        $media = $pages->find("tags=$page, template=media");

        if( count($posts) > 0){
        ?>
        <h4>Blog</h4>
        <ul class='list-unstyled '><?php
        foreach($posts as $child)
           echo "<li><a href='{$child->url}'>{$child->title}</a><span class='text-muted'><small> - {$child->date}</small></span></li>";
        ?> </ul>
        <?php } ?>

        <?php if( count($events) > 0){
        ?>
        <h4>Events</h4>
        <ul class='list-unstyled '><?php
        foreach($events as $child)
           echo "<li><a href='{$child->url}'>{$child->title}</a></li>";
        ?> </ul>
        <?php } ?>

        <?php if( count($media) > 0){
        ?>
        <h4>Media Resources</h4>
        <ul class='list-unstyled '><?php
        foreach($media as $child)
           echo "<li><a href='{$child->url}'>{$child->title}</a><span class='text-muted'><small> - {$child->media_date}</small></span></li>";
        ?> </ul>
        <?php } ?>

<?php } ?>

</div>
</div>
</div>


<?php
include("./includes/foot.inc");

