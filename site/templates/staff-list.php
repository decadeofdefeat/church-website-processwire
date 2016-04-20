<?php

    include("./includes/head.inc");
    ?>


        <div class="page_header_wrapper">
            <div class="container serif">
                <div class="row">
                    <div class="col-md-12 mg-t-lg mg-b-lg">

                             <h1><?php echo $page->title;?></h1>

                    </div>
                </div>
            </div>
        </div>



        <div class="container mg-b-lg">

            <div class="row multi-columns-row ">
                <?php
                    $staff =  $pages->find("parent=/about/staff/, template=staff-detail, sort=staff_sorttitle");

                    foreach ($staff as $st) {
                        print "<div class='col-xs-6 col-sm-6 col-md-3 mg-b-md '>";



                        // default
                        $thumb = $pages->get('/about/staff/')->images->first()->size(360,412)->url;
                        if( count($st->staff_photo) > 0)
                        {
                            $thumb = $st->staff_photo->url;
                        }

                        print "<div class='staff-holder'>";
                           print "<a href='".$st->url."'>";
                           print "<div class='staff-photo'><img src='{$thumb}' class='img-responsive' /></div>";
                               print "<div class='staff-bar'>";
                               print "<h3>".$st->title."</h3>";
                               //print "<div class='staff-team'>".$st->staff_team->first()->title."</div>";
                               print "<div class='staff-title'>".$st->job_title."</div>";
                               print "</div>";
                            print "</a>";
                        print "</div>"; // end staff-holder
                       print "</div>";


                    }
                ?>
        </div>

    </div>





<?php

include("./includes/foot.inc");


