<?php

/**
 * Event Detail template
 *
 */


$thumb = '';
if(count($page->images) > 0)
    $thumb = $page->images->first();
else if(count($page->parent->images) > 0)
    $thumb = $page->parent->images->first();

include("./includes/head.inc");
?>

<div class='container mg-t-lg mg-b-lg  '>



<div class="row">
    <div class="col-md-8 serif">
      <h1 class='mg-b-sm2'><?php echo $page->title;?></h1>

         <?php




        $thumb = '';
        if(count($page->images) > 0)
        {
          if( $page->images->first()->width > 640)
          {
            $thumb = $page->images->first()->size(760, 428);
          }
          else
          {
            $thumb = $page->images->first()->size(640, 360);
          }

        }
        else if(count($page->parent->images) > 0)
        {
           $thumb = $page->parent->images->first()->size(640, 360);
        }


        if($thumb != '')
        {
            echo "<img src='{$thumb->url}' class='img-responsive img-full-width mg-b-md' />";
        }

        $end_time_display = '';

        if($page->event_repeater_boolean == 1)
        {
          $start_time = date("g:i A", strtotime($page->event_date));
          $end_time = date("g:i A", strtotime($page->event_date_end));

          if($end_time != $start_time)
          {
            $end_time_display = " - ".$end_time;
          }
          $start_day = date("n/j/Y", strtotime($page->event_date));
          $end_day = date("n/j/Y", strtotime($page->event_date_end));

          if($page->event_infinite_boolean == 1)
          {
            $time = $page->event_date_details.", ".$start_time.$end_time_display;
          }
          else
          {
            $edd = 'From ';
            if( $page->event_date_details != '')
                $edd = $page->event_date_details.", from ";


            $time = $edd.$start_day." to ".$end_day.", ".$start_time.$end_time_display;
          }

          if( $page->all_campus_event == 1 )
          {
            $loc_name = '';
            $loc = '';
            $campus = 'All Campuses';
          }
          else
          {
            $loc = $page->location->address;
            if( $loc == '' && $page->event_custom_address != '') $loc = $page->event_custom_address;
            $loc_name = $page->location->title;
            if( $page->event_room != '')
            {
              $loc_name .= " - ".$page->event_room;
            }

            $campus = $page->location->campus_title;
          }
        }
        else
        {
          $date_time = date("l, F j, Y", strtotime($page->event_date));
          $start_time = date("g:i A", strtotime($page->event_date));
          $end_time = date("g:i A", strtotime($page->event_date_end));

          if($end_time != $start_time)
          {
            $end_time_display = " - ".$end_time;
          }

          $time = $date_time.", ".$start_time.$end_time_display;

          $loc = $page->location->address;
          if( $loc == '' && $page->event_custom_address != '') $loc = $page->event_custom_address;
          $loc_name = $page->location->title;
          if( $page->event_room != '')
          {
            $loc_name .= " - ".$page->event_room;
          }

          $campus = $page->location->campus_title;
        }


    ?>
         <?php if($campus != '') echo "<p style='margin-bottom:0.45em;'><strong>Campus: ".$campus,"</strong></p>";?>


         <ul class="fa-ul event-quick-info">
              <?php if( $time != ''){ ?>
                <li><i class="fa-li icon-time-1"></i> <?php echo $time;?></li>
              <?php } ?>
              <?php if( $loc != '' ){ ?>
                <li><i class="fa-li icon-location-pin-1"></i> <?php echo "<a target='_blank'  onClick='ga(\'send\',\'event\', \'button\', \'click\',\'Google Maps\');' href='http://maps.google.com/maps?q=".urlencode($loc)."'>".$loc_name;?></a></li>
              <?php } ?>

               <li><i class="fa-li icon-download-2"></i> <a onClick="ga('send','event', 'button', 'click','Download iCal Event');" href='/events/ical/?id=<?php echo $page->id;?>'>Download Event</a></li>

      </ul>


    <div class=''>
    <?php
    if( $page->body == '')
    {
        echo $page->parent->body;
    }
    else
    {

      echo $page->body;
    }


    if( $page->event_registration_link != '' || $page->parent->event_registration_link != '')
    {

        $eventLink = $page->event_registration_link == '' ? $page->parent->event_registration_link : $page->event_registration_link;



          $btnText = "Register Now";
          if( $page->event_registration_link_custom_text != '') $btnText = $page->event_registration_link_custom_text;

          echo "<div class='mg-t-md'><a class='btn-left btn btn-default' href='".$eventLink."'><i class='icon-right-4 icon-fw'></i> ".$btnText."</a></div>";

    }

    ?>
    </div>
    </div>

    <!-- other featured events -->
    <div class="col-md-3  col-md-offset-1 sidebar-section  ">

        <h3 class='top-sidebar-title'>FEATURED EVENTS</h3>

        <?php

            $featured = $pages->find("template=event|event-repeater, event_featured=1, sort=event_date, event_date>=today, limit=12 ");

            print "<ul class='related-links'>";

            foreach ($featured as $e) {
                if( $e->id != $page->id){
                print "<li>";
                    $date = date("F j, Y", strtotime($e->event_date));
                    print "<a href='{$e->url}'>{$e->title}<br/>";
                    if( $e->location && $e->location->title != 'Off-site' ) echo "<small class='serif-tisa'>{$e->location->title}</small></a>";
                    print "</li>";
                }
            }




            print "</ul>";
        ?>

          <div class='mg-t-md'><a href='/events/' class='btn btn-default btn-left'><i class='icon-left-4'></i> Return to Events</a></div>

    </div>
    <!-- end other featured events -->

</div>
<div class="clearfix visible-xs"></div>
</div>
<?php


include("./includes/foot.inc");
