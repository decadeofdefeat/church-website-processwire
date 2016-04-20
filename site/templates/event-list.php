<?php

include("./includes/head.inc");
?>

<div class='container mg-t-lg mg-b-lg serif'>
<div class='row'>
    <div class='col-md-12'>
        <h1 class='mg-b-md'>Event List</h1>
         <p><a href='/events/calendar/' class='btn btn-default  hidden-xs'><i class='icon-calendar-3'></i> Events Calendar</a></p>
         <hr class='thin-hr'>


 <div id='event-list-holder'>

    <?php

    $modules->get('LibJulian');


    $monthMaximum = 5;

    //$date_plus_5 = date("Y-m-d", strtotime('first day of this month + '.($monthMaximum-1).' months'));
    $last_month_value = date("Ym", strtotime('first day of this month + '.($monthMaximum-1).' months'));

    $events = $pages->find("template=event|event-repeater, event_repeater_boolean=0, event_date>=today ");



    /// Determine how many months we need
    /// based on how many events exist
    $years = array();

    foreach ($events as $event) {
        $years[]= date("Y", $event->getUnformatted("event_date"));
        // add properties event_year and event_month to the $event object
        $event->event_year = date("Y", $event->getUnformatted("event_date"));
        $event->event_month = date("m", $event->getUnformatted("event_date"));
    }

    $years = array_unique($years);
    asort($years);

    foreach($years as $key => $year)
    {

        //print "<br>Year is ".$year;

        $year_events = $events->find("event_year=$year");

        $months = array();

        foreach ($year_events as $year_event) {
            $months[]= date("m", $year_event->getUnformatted("event_date"));
        }
        $months = array_unique($months);
        asort($months);

        // truncate months list to maximum
        $shortened_months = array_slice($months, 0,$monthMaximum);

         foreach($shortened_months as $key => $month)
         {

            $yearMonth = intval($year.$month);
            //print "year month ".$yearMonth;
            if( $last_month_value >= $yearMonth)
            {

              //print "<br>Month is ".$month;

              // Render Each Month Event list

              $calendar = new Julian();
              $calendar->current_year = $year;
              $calendar->current_month = $month;

              // filter only the events for this month, from the $year_events array.
              $month_events = $year_events->find("event_month=$month");

              foreach($month_events as $e) {
                  // add events to calendar
                  $d = strtotime($e->event_date);
                  $url = $e->url;
                  $time = '';
                  $loc = '';
                  $loc_name = '';
                  /*
                  if( $e->parent->event_date_details )
                      $time = $e->parent->event_date_details;
                  else if( $e->event_date_details)
                      $time = $e->event_date_details;
                  */

                  $campus = '';
                  $time_sort = '';
                  $end_time_display = '';
                  if(!$e->parent->is(Page::statusUnpublished))
                  {

                  if($e->parent->event_repeater_boolean == 1)
                  {
                    $start_time = date("g:i A", strtotime($e->parent->event_date));
                    $time_sort = date("Gis", strtotime($e->parent->event_date));
                    $end_time = date("g:i A", strtotime($e->parent->event_date_end));
                    if($end_time != $start_time)
                    {
                      $end_time_display = " - ".$end_time;
                    }

                    $start_day = date("n/j/Y", strtotime($e->parent->event_date));
                    $end_day = date("n/j/Y", strtotime($e->parent->event_date_end));

                    if($e->parent->event_infinite_boolean == 1)
                    {
                      $time = $e->parent->event_date_details.", ".$start_time.$end_time_display;
                    }
                    else
                    {
                      $edd = 'From ';
                      if( $e->parent->event_date_details != '')
                          $edd = $e->parent->event_date_details.", from ";
                      $time = $edd.$start_day." to ".$end_day.", ".$start_time.$end_time_display;
                    }

                    if( $e->parent->all_campus_event == 1 )
                    {
                      $loc_name = '';
                      $loc = '';
                      $campus = 'All Campuses';
                    }
                    else
                    {
                      $loc = $e->parent->location->address;

                      if( $loc == '' && $e->parent->event_custom_address != '') $loc = $e->parent->event_custom_address;

                      $loc_name = $e->parent->location->title;
                      if( $e->parent->event_room != '')
                      {
                        $loc_name .= " - ".$e->parent->event_room;
                      }

                      $campus = "Campus: ".$e->parent->location->campus_title;
                     }
                  }
                  else
                  {
                    $date_time = date("l, F j, Y", strtotime($e->event_date));
                    $start_time = date("g:i A", strtotime($e->event_date));
                    $time_sort = date("Gis", strtotime($e->event_date));
                    $end_time = date("g:i A", strtotime($e->event_date_end));
                    if($end_time != $start_time)
                    {
                      $end_time_display = " - ".$end_time;
                    }
                    $time = $date_time.", ".$start_time.$end_time_display;

                    if( $e->all_campus_event == 1 )
                    {
                      $loc_name = '';
                      $loc = '';
                      $campus = 'All Campuses';
                    }
                    else
                    {
                      $loc = $e->location->address;
                      if( $loc == '' && $e->event_custom_address != '') $loc = $e->event_custom_address;
                      $loc_name = $e->location->title;
                      if( $e->event_room != '')
                      {
                        $loc_name .= " - ".$e->event_room;
                      }

                      $campus = "Campus: ".$e->location->campus_title;
                    }
                  }




                  if( $e->template == 'event-repeater') $url = $e->parent->url;
                  $calendar->add_event( $d, $d, $e->title, array('url' => $url, 'campus' => $campus, 'loc' => $loc, 'loc_name' => $loc_name, 'time' => $time, 'time_sort' => $time_sort )  );
                }
              }

              $calendar->setup();

              ?>

                  <div  class='list-month' >

                      <div class='list-controls clearfix'>
                          <div class='list-event-prev '><i class='icon-left-4'></i></div>
                          <h2 class='list-month-title'><?php echo $calendar->current_month(); ?></h2>
                          <div class='list-event-next '><i class='icon-right-4'></i></div>
                      </div>

                      <div class='clearfix'></div>
                      <hr class='thin-hr' >

                       <?php foreach ($calendar->weeks() as $week): ?>
                              <?php foreach ($week->days() as $day): ?>
                                      <?php if( count( $day->events() ) > 0 ): ?>
                                      <div class='list-day'>
                                          <div class='list-time'>

                                              <div class='list-time-month'><?php echo substr($calendar->month_name($day->month()), 0, 3);?></div>
                                              <div class='list-time-day'><?php echo $day->day();?></div>
                                              <div class='list-time-dayofweek'><?php echo date("D", strtotime($day->year()."-".$day->month()."-".$day->day()));?></div>
                                          </div>
                                          <div class='list-day-detail'>

                                          <?php

                                           $event_d = array();
                                            foreach ($day->events() as $event) {
                                               $event_d[] = array('campus' => $event->extra('campus'), 'time_sort'=>$event->extra('time_sort'), 'url'=>$event->extra('url'),'name' => $event->name(), 'time'=>$event->extra('time'),'loc' => $event->extra('loc'), 'loc_name' => $event->extra('loc_name') );
                                            }

                                            usort($event_d, function($a, $b)
                                            {
                                                 return $a['time_sort'] - $b['time_sort'];
                                            });


                                            foreach($event_d as $event): ?>
                                              <article class='event'>
                                                  <h4 class='mg-b-none'><a href='<?php echo $event['url']; ?>'><?php echo $event['name']; ?></a></h4>

                                                  <p class='mg-t-none' style='margin-bottom:0.45em;'><?php echo $event['campus'] != 'Campus: ' ? $event['campus'] : '';?></p>
                                                   <ul class="fa-ul event-quick-info">
                                                            <?php if( $event['time'] != ''){ ?>
                                                              <li><i class="fa-li icon-time-1"></i> <?php echo $event['time'];?></li>
                                                            <?php } ?>
                                                            <?php if( $event['loc'] != '' ){ ?>
                                                              <li><i class="fa-li icon-location-pin-1"></i> <?php echo "<a target='_blank' href='http://maps.google.com/maps?q=".urlencode($event['loc'])."'>".$event['loc_name'];?></a></li>
                                                            <?php } ?>
                                                    </ul>





                                               </article>
                                          <?php endforeach; ?>
                                          </div>
                                      </div>

                                      <?php endif; ?>
                              <?php endforeach; ?>
                      <?php endforeach; ?>

                      </div>

              <?php
            } // end if month is less than max month
        } // end foreach $months
    } // foreach $years


 ?>



</div> <!-- end event-list-holder -->


</div>
</div>
</div>

<?php ob_start(); ?>

$(document).ready(function(){

  /* List View */
  //initialize list view
  $('.list-controls').show();
  $('.list-month').hide();
  $('.list-month:eq(0)').addClass('active').show();

  //handle controls
  $('.list-month').each(function(){
    if($(this).prev('.list-month').length > 0){
      $(this).find('.list-event-prev').addClass('hasPrev');
    }
  });
  $('.list-month').each(function(){
    if($(this).next('.list-month').length > 0){
      $(this).find('.list-event-next').addClass('hasNext');
    }
  });

  $('.list-event-prev').on('click',function(e){
    if($('.list-month.active').prev('.list-month').length > 0){
      $('.list-month.active').removeClass('active').hide().prev('.list-month').addClass('active').show();
    }
     e.preventDefault();
  });

  $('.list-event-next').on('click',function(e){
    if($('.list-month.active').next('.list-month').length > 0){
      $('.list-month.active').removeClass('active').hide().next('.list-month').addClass('active').show();
    }
     e.preventDefault();
  });
});

<?php $additionalJS = ob_get_clean(); ?>

<?php

include("./includes/foot.inc");

?>

