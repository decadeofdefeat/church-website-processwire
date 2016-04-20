<?php

    include("./includes/head.inc");
    ?>


        <div class="page_header_wrapper">
            <div class="container serif">
                <div class="row">
                    <div class="col-md-12 mg-t-lg mg-b-md">

                             <h1 style='display:inline-block; float:left'>Staff</h1>

                             <a class='btn btn-default pull-right' style='margin-top:26px;' href='/about/staff/'><i class='icon-left-4'></i> View All Staff</a>

                            <div class='clear clearfix'></div>
                            <hr>
                    </div>
                </div>
            </div>
        </div>



    <div class="container mg-b-lg">
       <div class="row ">
            <div class='col-sm-4'>
                <?php
                    $thumb = $pages->get('/about/staff/')->images->first()->size(360,360)->url;

                    if( count($page->staff_photo) > 0)
                    {
                        $thumb = $page->staff_photo->url;
                    }
                    echo "<img src='{$thumb}' class='img-responsive img-full-width' />";
                ?>
            </div>

             <div class='col-sm-8 staff-left-detail'>

                <?php if($page->parent->id == 17090){ // board of directors ?>

                <h2><?php echo $page->title;?></h2>

                 <div class='staff-contact-info'>
                <p><strong><?php echo $page->job_title;?></strong></p>



                </div>


                <?php } else { ?>


                <h2><?php echo $page->title;?></h2>
                <div class='staff-contact-info'>
                <p><strong><?php echo $page->job_title;?></strong></p>



                <p><strong><a href='mailto:<?php echo $page->email;?>'><?php echo $page->email;?></a></strong></p>
                <?php if( $page->personal_website != ''){
                    $webShort = str_replace('http://', '', $page->personal_website);
                    $webShort = str_replace('/', '', $webShort);
                ?>
                <p><strong><a target="_blank" href='<?php echo $page->personal_website;?>'><?php echo $webShort;?></a></strong></p>
                <?php } ?>
                <p>Office: <?php echo $page->phone;?></p>
                </div>

                 <?php } ?>

                <?php
                    $name = explode(" ", $page->title);
                    $first = $name[0]."&#146;s";
                ?>

                <?php if( $page->body != ''){ ?>

                <div class='serif mg-t-md'>
                    <?php echo $page->body;?>

                </div>
                <?php } ?>
            </div>

        </div>

    </div>



<?php

include("./includes/foot.inc");


