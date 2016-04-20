<?php




include("./includes/head.inc");
?>


<div class='container mg-t-lg mg-b-lg serif'>
<div class='row'>
    <div class='col-md-12'>
        <h1 class='mg-b-md'>Event Calendar</h1>
        <p><a href='/events/' class='btn btn-default'><i class='icon-menu-list-1'></i> Events List</a> </p>
         <hr class='thin-hr'>
<div class='visible-xs'>
              <h4>View events on our <a href='/events/'>list view.</a></h4>
</div>

 <div id='calendar-holder' class='hidden-xs'>

    <?php

    $modules->get('LibJulian');

    $totalMonths = 5;

    $day1ofthisMonth = date('01-m-Y');

    //print "****** day 1 is ". $day1ofthisMonth;

    $events = $pages->find("template=event|event-repeater,  event_repeater_boolean=0, event_date>=$day1ofthisMonth, include=hidden ");

    // loop through 12 months
    for ($i=0; $i < $totalMonths; $i++)
    {
        if($i == 0){
            $monthDate = new DateTime('now');
        } else {
            $monthDate = new DateTime('now');
            $myDayOfMonth = date_format($monthDate,'j');
            date_modify($monthDate,"+$i month");

            $myNewDayOfMonth = date_format($monthDate,'j');

            if ($myDayOfMonth > 28 && $myNewDayOfMonth < 4){
                date_modify($monthDate,"-$myNewDayOfMonth days");
            }

        }

        //print "<br>Month date is ".$monthDate;

        $calendar = new Julian();
        $calendar->current_year = date('Y',  $monthDate->getTimestamp());
        $calendar->current_month = date('m',  $monthDate->getTimestamp());

        // add events
        foreach($events as $e)
        {

          if(!$e->parent->is(Page::statusUnpublished))
          {
            $d = strtotime($e->event_date);
            $url = $e->url;

            $campus = '';

            $time_sort = '';

            $end_time_display = '';
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
                $loc_name = 'All Campuses';
                $loc = '';
                $campus = 'All Campuses';
              }
                else
                {
                $loc = $e->parent->location->address;
                $loc_name = $e->parent->location->title;
                if( $e->parent->event_room != '')
                {
                  $loc_name .= " - ".$e->parent->event_room;
                }

                $campus = $e->parent->location->campus_title;
              }
            }
            else
            {
              $date_time = date("l, F j, Y", strtotime($e->event_date));

              $time_sort = date("Gis", strtotime($e->event_date));

              $start_time = date("g:i A", strtotime($e->event_date));
              $end_time = date("g:i A", strtotime($e->event_date_end));
              if($end_time != $start_time)
                  {
                    $end_time_display = " - ".$end_time;
                  }
              $time = $date_time.", ".$start_time.$end_time_display;

              if( $e->all_campus_event == 1 )
              {
                $loc_name = 'All Campuses';
                $loc = '';
                $campus = 'All Campuses';
              }
              else
              {
                $loc = $e->location->address;
                $loc_name = $e->location->title;
                if( $e->event_room != '')
                {
                  $loc_name .= " - ".$e->event_room;
                }

                $campus = $e->location->campus_title;
              }
            }




            //print "Boolean is ". $e->event_repeater_boolean;
            if( $e->template == 'event_repeater') $url = $e->parent->url;
            $calendar->add_event( $d, $d, $e->title, array('url' => $url, 'campus' => $campus, 'loc' => $loc, 'loc_name' => $loc_name, 'time' => $time, 'time_sort' => $time_sort )  );
          }
        }

        $calendar->setup();

        $monthID = "month".($i+1);
        $monthTableID = "monthTable".($i+1);
        $prevMonthID = "month".$i;
        $nextMonthID = "month".($i+2);

        $weekDay = 0;
    ?>

    <div id="<?php echo $monthID;?>" class='list-month-cal'>



       <div class='list-controls' style=' margin:10px 0px 30px 0px;'>
                        <div class='list-event-prev '  ><i class='icon-left-4'></i></div>
                        <h2 class='list-month-title'><?php echo $calendar->current_month(); ?></h2>
                        <div class='list-event-next '><i class='icon-right-4'></i></div>
                        <div class='clearfix clear'></div>
                    </div>
          <div class=' clearfix clear'></div>
    <table class="calendar" id="<?php echo $monthTableID;?>">

      <tr>
        <?php foreach ($calendar->weekdays() as $weekday): ?>
                <th title="<?php echo $weekday; ?>"><?php echo $weekday; ?></th>
         <?php endforeach; ?>
      </tr>

      <?php foreach ($calendar->weeks() as $week): ?>

        <tr>
            <?php foreach ($week->days() as $day): ?>
                <td class="linked-day">
                    <?php if(!$day->blank()): ?>
                        <span class='calendar-day-number <?php echo $day->today_class(); ?>'><?php echo $day->day(); ?></span>
                        <?php if( count( $day->events() ) > 0 ) { ?>
                            <ul>
                            <?php



                                $event_d = array();
                                foreach ($day->events() as $event) {
                                   $event_d[] = array('time_sort'=>$event->extra('time_sort'), 'url'=>$event->extra('url'),'name' => $event->name(), 'time'=>$event->extra('time'), 'location' => $event->extra('loc_name') );
                                }

                                usort($event_d, function($a, $b)
                                {
                                     return $a['time_sort'] - $b['time_sort'];
                                });


                              foreach($event_d as $event){
                                $popupPlacement = 'right';
                                if($weekDay > 4) $popupPlacement = 'left';
                               ?>
                                <li>
                                    <a href='<?php echo $event['url'];?>' data-placement='<?php echo $popupPlacement;?>' data-toggle="popover" title="<?php echo $event['name'];?>" data-content="<span class='text-muted'><?php echo $event['time']."</span><span class='span-block mg-t-xs'>".$event['location']."</span>";?>"><?php echo truncate($event['name'], 40); ?> </a>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    <?php endif; ?>
                </td>
                 <?php $weekDay++; if($weekDay == 7) $weekDay = 0; ?>
            <?php endforeach; ?>
        </tr>

    <?php endforeach; ?>

     </table>
    </div>

  <?php
    } // end for loop ?>




</div> <!-- end calendar-holder -->


</div>
</div>

</div>


<?php ob_start(); ?>


$(document).ready(function(){

  /* List View */
  //initialize list view
  $('.list-controls').show();
  $('.list-month-cal').hide();
  $('.list-month-cal:eq(0)').addClass('active').show();

  //handle controls
  $('.list-month-cal').each(function(){
    if($(this).prev('.list-month-cal').length > 0){
      $(this).find('.list-event-prev').addClass('hasPrev');
    }
  });
  $('.list-month-cal').each(function(){
    if($(this).next('.list-month-cal').length > 0){
      $(this).find('.list-event-next').addClass('hasNext');
    }
  });

  $('.list-event-prev').on('click',function(e){

    if($('.list-month-cal.active').prev('.list-month-cal').length > 0){
      $('.list-month-cal.active').removeClass('active').hide().prev('.list-month-cal').addClass('active').show();
    }
    e.preventDefault();
  });

  $('.list-event-next').on('click',function(e){

    if($('.list-month-cal.active').next('.list-month-cal').length > 0){
      $('.list-month-cal.active').removeClass('active').hide().next('.list-month-cal').addClass('active').show();
    }
    e.preventDefault();
  });


  $('[data-toggle="popover"]').popover({html:true, trigger:'hover'});

});


<?php $additionalJS = ob_get_clean(); ?>

<?php

include("./includes/foot.inc");

?>
