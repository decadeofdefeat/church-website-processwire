<?php

/**
 * Serve template
 *
 */

include("./includes/head.inc");
?>


<div class='container page-section  mg-t-lg mg-b-lg'>
<div class="row">
<div class="col-md-8">

<div class='serif'><?php echo $page->body; ?></div>

</div>

<div class='col-md-3 col-md-offset-1 sidebar-section'>

   <?php if(count($page->resource_links) > 0 ) {


                        print "<div class='sidebar_content'><ul class='related-links' style='margin-bottom:30px;'>";
                        foreach ($page->resource_links as $link) {
                          $ext = '';
                          $videoClass = '';
                          if( $link->external_link == 1) $ext = " target='_blank' ";
                          if( $link->video_popup == 1) $videoClass = "  video-popup ";
                          print "<li><a class=' {$videoClass} ' {$ext} href='{$link->link}'>".$link->title."</a></li>";
                        }
                        print "</ul></div>";
                    } ?>


                    <?php if(count($page->related_links) > 0 ) {

                        print "<div class='sidebar_content'><h3>";
                        print $page->related_links_title == '' ? "RELATED" : $page->related_links_title;
                        print "</h3>";

                        print "<ul class='related-links'>";
                        foreach ($page->related_links as $link) {
                           $ext = '';
                          if( $link->external_link == 1) $ext = " target='_blank' ";
                          print "<li><a {$ext} href='{$link->link}'>".$link->title."</a></li>";
                        }
                        print "</ul></div>";
                    } ?>

                        <?php if($page->sidebar_content != ''){
                      echo "<div class='sidebar_content'>";
                      echo $page->sidebar_content;
                      echo "</div>";
                    } ?>


</div>

</div>


<div class='mg-t-lg'>
<div class=" row multi-columns-row">
<?php

  $services = $pages->find('template=serve-application,  sort=sort');



    foreach ($services as $opp) {
        print "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6' style='margin-bottom:35px;'>";

        $img = $opp->images->first()->size(660,360);
        print "<img src='{$img->url}' class='img-responsive img-full-width'>";

        print "<h3>".$opp->title."</h3>";
        print "<div class='serif serif'>".$opp->body."</div>";

        $vol_link = $opp->url;
        if( $opp->link != '')
        	$vol_link = $opp->link;


        print "<p><a href='".$vol_link."'  class='btn btn-default btn-left mg-t-sm'><i class='icon-right-4 icon-fw'></i> Apply to Volunteer</a></p>";
        print "</div>";




    }

?>

</div>
</div>

</div>


<?php
include("./includes/foot.inc");
