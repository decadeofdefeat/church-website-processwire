<?php



    include("./includes/head-4.php");



    $sections = $pages->find('parent='.$page->id.',template=group-section, sort=sort');



    $bodySpacing = '';

    if(!empty($sections) == 0) {

        $bodySpacing = ' mg-b-lg ';

    }



    $topTwoColumn = false;

    if( $page->sidebar_content != '' || !empty($page->resource_links) > 0 ||  $page->ministry_website != '' || !empty($page->related_links) > 0 || !empty($page->related_events) > 0 )

    {

        $topTwoColumn = true;

    }



    $ministry_related_events = false;



    $num_events = 2;



    if( $page->number_of_events_to_show )

    {

      $num_events = $page->number_of_events_to_show;

    }



    if(!empty($page->ministry) > 0 ) {



      $ministry = $page->ministry->first();

      $ministry_events = $pages->find("template=event|event_repeater, ministry|parent.ministry=$ministry, numChildren=0, event_date>=today,  sort=event_date, limit=$num_events ");



      if(!empty($ministry_events) > 0)

      {

          $topTwoColumn = true;

          $ministry_related_events = true;

      }

    }

?>



 <div class="container page-section  mg-t-lg <?php echo $bodySpacing;?>">

    <div class="row ">

         <div class='<?php echo $topTwoColumn == true ? "col-md-8" : "col-md-12";?> '>

            <div class='serif'><?php echo $page->body;?></div>



        </div>

        <?php if( $topTwoColumn ) { ?>





                 <div class='col-md-3 col-md-offset-1 sidebar-section' style="display: none;">



                    <?php if($page->sidebar_content != ''){

                      echo "<div class='sidebar_content'>";

                      echo $page->sidebar_content;

                      echo "</div>";

                    } ?>











                    <?php if(!empty($page->resource_links) > 0 || $page->ministry_website != '') {?>



                   <div class='sidebar_content'> <h3 ><?php echo $page->resources_title == '' ? "RESOURCES" : $page->resources_title;?></h3>

                    <?php if($page->ministry_website != ''){

                            $ext = " target='_blank' ";

                            if( $page->ministry_website_external == 1) $ext = "";

                             echo "<a ".$ext." class='btn btn-default btn-left'  href='{$page->ministry_website}'><i class='fa-fw icon-external-link'></i> Visit Ministry Website</a>";

                          }

                    ?>









                     <?php if(!empty($page->resource_links) > 0 ) {





                        print "<ul class='related-links'";



                        if( $page->ministry_website != '') print " style='margin-top:30px;' ";



                        print ">";

                        foreach ($page->resource_links as $link) {

                          $ext = '';

                          $videoClass = '';

                          if( $link->external_link == 1) $ext = " target='_blank' ";

                          if( $link->video_popup == 1) $videoClass = "  video-popup ";

                          print "<li><a class=' {$videoClass} ' {$ext} href='{$link->link}'>".$link->title."</a></li>";

                        }

                        print "</ul>";

                    } ?>

                  </div>

                    <?php } ?>



                    <?php if(!empty($page->related_links) > 0 ) {



                        print " <div class='sidebar_content'><h3 >";

                        print $page->related_links_title == '' ? "RELATED" : $page->related_links_title;

                        print "</h3>";



                        print "<ul class='related-links'>";

                        foreach ($page->related_links as $link) {

                           $ext = '';

                          if( $link->external_link == 1) $ext = " target='_blank' ";

                          print "<li><a {$ext} href='{$link->link}'>".$link->title."</a></li>";

                        }

                        print "</ul>";

                        print "</div>";

                    } ?>





                 <?php

                      // if ministry page is there, look for related events automatically



                        if($ministry_related_events ) {

                           print "<div class='sidebar_content'>";

                           print "<h3>UPCOMING EVENTS</h3>";

                           print "<ul class='related-links'>";

                            foreach ($ministry_events as $e) {

                              if($e->numChildren == 0){

                                    $url = $e->url;

                                    $title = $e->title;

                                    $location = $e->location;

                                    if( $e->template == 'event_repeater')

                                    {

                                      $url = $e->parent->url;

                                      $title = $e->parent->title;

                                      $location = $e->parent->location;

                                    }



                                    print "<li>";

                                    $date = date("F j, Y", strtotime($e->event_date));

                                    print "<a href='".$url."'>".$title."</a><br/>";

                                    print "<small class='text-muted serif-tisa'>{$date}</small><br/>";

                                    if( $location ) echo "<small class='text-muted serif-tisa'>{$location->title}</small>";

                                    print "</li>";

                                }



                            }

                            print "</ul>";

                            print "</div>";



                      }

                      ?>





                      <?php if(!empty($page->related_events) > 0 ) {

                        echo "<div class='sidebar_content'>";

                       print "<h3>UPCOMING EVENTS</h3>";

                       print "<ul class='related-links'>";

                        foreach ($page->related_events as $event) {



                          print "<li><a href='{$event->url}'>".$event->title."</a></li>";

                        }

                        print "</ul>";

                        print "</div>";

                      }

                      ?>



                </div>



        <?php } ?>

     </div>











       <?php if( !empty($page->tabbed_content) > 0 ){

                        //print "<h1 style='margin-bottom:30px;'>{$section->title}</h1>";

                        $t = new TemplateFile(wire('config')->paths->templates .'markup/groups/tabbed_content.php');

                        $t->set('content', $page->tabbed_content);

                        $out = $t->render();

                        echo $out;

                    }



            ?>





</div>



<?php

    foreach ($sections as $section) { ?>



    <div class='page-section mg-t-lg mg-b-lg'>



        <?php

          if( !empty($section->header_image) > 0 )

          {

            $img_url = $section->header_image->url;

          }

          if( $section->header_img_cdn != '' )

          {

            $img_url = $section->header_img_cdn;

          }



          $sectionTitle = $sanitizer->pageName("section-".$section->title);

        ?>



        <?php if( $img_url  != '' ){?>

           <img src='<?php echo $img_url;?>'  id='<?php echo $sectionTitle;?>'  class='header-image'>

         <?php } ?>



        <div class="container  mg-t-lg">

            <div class="row ">



                <div class='<?php echo $section->no_sidebar == 1 ? " col-md-12 " : " col-md-8 ";?> '>



                    <?php if( !empty($section->tabbed_content) > 0 ){

                        print "<h1 style='margin-bottom:30px;'>{$section->title}</h1>";

                        $t = new TemplateFile(wire('config')->paths->templates .'markup/groups/tabbed_content.php');

                        $t->set('content', $section->tabbed_content);

                        $out = $t->render();

                        echo $out;





                   } else { ?>

                          <h1 class='mg-b-md mg-t-none'> <?php echo $section->title;?></h1>

                          <div class='serif'><?php echo $section->body;?></div>

                    <?php } ?>

                </div>

                 <?php if( $section->no_sidebar != 1){ ?>

                 <div class='col-md-3 col-md-offset-1 sidebar-section'>





                    <?php if($section->sidebar_content != ''){

                      echo "<div class='sidebar_content'>";

                      echo $section->sidebar_content;

                      echo "</div>";

                    } ?>









                    <?php if(!empty($section->resource_links) > 0 || $section->ministry_website != '') {?>

                    <div class='sidebar_content'><h3 ><?php echo $section->resources_title == '' ? "RESOURCES" : $section->resources_title;?></h3>

                    <?php if($section->ministry_website != ''){

                              $ext = " target='_blank' ";

                              $external_icon = '<i class="fa-fw icon-external-link"></i> ';

                              if( $section->ministry_website_external == 1) {

                                $ext = "";

                                $external_icon = '<i class="fa-fw icon-right-4"></i> ';

                              }

                             echo "<a ".$ext." class='btn btn-default btn-left' href='{$section->ministry_website}'>{$external_icon}Visit Ministry Website</a>";

                        }

                    ?>



                     <?php if(!empty($section->resource_links) > 0 ) {





                        print "<ul class='related-links'";

                        if( $section->ministry_website != '') print " style='margin-top:30px;' ";

                        print ">";

                        foreach ($section->resource_links as $link) {

                          $ext = '';

                          $videoClass = '';

                          if( $link->external_link == 1) $ext = " target='_blank' ";

                          if( $link->video_popup == 1) $videoClass = "  video-popup ";

                          print "<li><a class=' {$videoClass} ' {$ext} href='{$link->link}'>".$link->title."</a></li>";

                        }

                        print "</ul>";

                    } ?>

                  </div>

                    <?php } ?>



                    <?php if(!empty($section->related_links) > 0 ) {



                        print "<div class='sidebar_content'><h3>";



                        print $section->related_links_title == '' ? "RELATED" : $section->related_links_title;

                        print "</h3>";

                        print "<ul class='related-links'>";

                        foreach ($section->related_links as $link) {

                          $ext = '';

                          if( $link->external_link == 1) $ext = " target='_blank' ";

                          print "<li><a {$ext} href='{$link->link}'>".$link->title."</a></li>";

                        }

                        print "</ul>";

                        print "</div>";

                    } ?>





                    <?php

                      // if ministry page is there, look for related events automatically



                        if(!empty($section->ministry) > 0 ) {



                            $ministry = $section->ministry->first();

                            $ministry_events = $pages->find("template=event|event_repeater, numChildren=0, ministry|parent.ministry=$ministry,  event_date>=today, sort=event_date, limit=2");

                            $xx = 0;

                            if(!empty($ministry_events) > 0)

                            {

                                echo "<div class='sidebar_content'>";

                               print "<h3>UPCOMING EVENTS</h3>";

                               print "<ul class='related-links'>";

                               foreach ($ministry_events as $e) {

                                //if($e->numChildren == 0){



                                        $url = $e->url;

                                        $title = $e->title;

                                        $location = $e->location;

                                        if( $e->template == 'event_repeater')

                                        {

                                          $url = $e->parent->url;

                                          $title = $e->parent->title;

                                          $location = $e->parent->location;

                                        }



                                        print "<li>";

                                        $date = date("F j, Y", strtotime($e->event_date));

                                        print "<a href='".$url."'>".$title."</a><br/>";

                                        print "<small class='text-muted serif-tisa'>{$date}</small><br/>";

                                        if( $location ) echo "<small class='text-muted serif-tisa'>{$location->title}</small>";

                                        print "</li>";



                                        $xx++;

                                  //  }



                                }

                                print "</ul>";

                                print "</div>";

                            }



                      }

                      ?>



                     <?php if(!empty($section->related_events) > 0 ) {



                       print "<div class='sidebar_content'><h3><i class='icon-calendar-3'></i> UPCOMING EVENTS</h3>";

                       print "<ul class='related-links' style='margin-bottom:30px;'>";

                        foreach ($section->related_events as $event) {



                          print "<li><a href='{$event->url}'>".$event->title."</a></li>";

                        }

                        print "</ul></div>";

                      }

                      ?>





                </div>

                <?php } ?>

            </div>

        </div>

    </div>

<?php } ?>

<?php include("./includes/foot-4.php");?>