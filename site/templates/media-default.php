<?php

/**

* Media template

*

*/

$media_date = date('Y-m-d', strtotime( $page->media_date ));

include("./includes/head-4.php");

//$expanded = $bitly->expand( 'http://thecha.pl/11FxTrE'  );

//$newURL = preg_replace('/\s+/', '', $newURL);

$series_part_number = '';

if( $page->rootParent == '/sermons/' && $page->parent->series_standalone_year == 0)

{

$countDown = $page->parent->numChildren;

$messages_series = $pages->find("template=media, sort=-media_date, parent=$page->parent");

$countDown = count($messages_series);

foreach($messages_series as $m) {

if( $m->id == $page->id )

{

$series_part_number = $countDown;

}

$countDown--;

}

}

echo "<div id='main-content'>";

  echo "<div class='container mg-t-lg mg-b-lg serif'>";

    echo "<div class='row'>";

      echo "<div class='col-md-10 col-md-offset-1' >";

        ?>

          <ol class='breadcrumb'>

          

          <li itemscope itemtype='http://data-vocabulary.org/Breadcrumb'>

            <a href='<?php echo $parent->url; ?>' itemprop='url'>

              <span itemprop='title'><?php echo $parent->title; ?></span></a>

            </li>

            <?php } ?>

            <?php endforeach ?>

            <li><?php echo truncate($page->title, 46); ?></li>

          </ol>

          <!--div class='mg-t-sm mg-b-md'-->

  <div class="page-section live-sidebar">

      <ul class="nav nav-tabs nav-justified">

        <li class="active "><a href="#sermon-tab" data-toggle="tab">Sermon Only</a></li>

        <li class=" "><a href="#full-tab" data-toggle="tab">Full Service</a></li>

        <li class=" "><a href="#notes-tab" data-toggle="tab">Notes</a></li>

        <li class=" "><a href="#bible-tab" data-toggle="tab">Bible</a></li>

      </ul>

      <div class="tab-content" id="tabbed-content">

        <div class="tab-pane active" id="sermon-tab">

            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $page->youtube_id;?>" allowfullscreen></iframe>

        </div>

        <div class="tab-pane " id="full-tab">

          <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $page->full_sermon;?>" allowfullscreen></iframe>

        </div>

        <div class="tab-pane" id="notes-tab">

          <?php

          if( $page->body == '' && $page->parent->body != '' && $page->parent->series_standalone_year != 1) {

            echo $page->parent->body;

          } else {

            echo $page->body;

          }

          ?>

        </div>

        <div class="tab-pane" id="bible-tab">

          <iframe frameborder="0" allowtransparency="true" src="https://www.bible.com/bible/116/GEN.1.NLT" class="bible-iframe"  style="padding:0px;margin:0px;width:100%;min-height: 645px;max-height: 700px;height: 100%;" ></iframe>

        </div>

      </div>





        <?php

        echo "<h2 class='mg-b-none pd-b-none'>".$page->title."</h2>";

        if( $page->parent && $page->parent->series_standalone_year != 1 )

        {

        echo "<h4 class='pd-t-none mg-t-none'>".$page->parent->title."</h4>";

        }

        $speakers = '';

        if( count($page->media_speaker) )

        {

        $speakerTotal = count($page->media_speaker);

        $s = 0;

        foreach($page->media_speaker as $speaker) {

        $speakers .= "<a href='".$speaker->url."'>".$speaker->title."</a>";

        $s++;

        if( $speakerTotal != $s ) $speakers .= ", ";

        }

        }

        echo "<span class='bold-link-new-line'>";

          if($speakers != '') echo $speakers." - ";

          echo $page->media_date;

        echo "</span>";

        if( $page->parent->template == 'series' && $page->parent->series_standalone_year != 1 )

        {

        $other_messages =  $pages->find("parent=$page->parent, sort=media_date, template=media");

        $mediaMatches = new PageArray();

        $mediaMatches->import($other_messages);

        if(count($other_messages) > 1)

        {

        echo "<hr><div class='mg-b-sm'><h4 >More From This Series</h4></div>";

        echo ' <div class="row multi-columns-row">';

          $partNumber = 1;

          foreach ($mediaMatches as $m) {

          echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';

            if($m->media_thumbnail != '') {

            $thumb = $m->media_thumbnail;

            }else if(count($m->parent->series_wide_graphic) > 0){

            $thumb = $m->parent->series_wide_graphic->size(640, 360)->url;

            }

            else

            {

            $thumb = $pages->get(1008)->images->first()->size(640, 360)->url;

            }

            echo " <a href='{$m->url}' class='related-thumb'><img src='{$thumb}'  />";

              if( $m->id == $page->id){

              echo "<div class='watching-now'><span>Watching Now</span></div>";

              }

            echo "</a>

            <h4 style='margin-bottom:-2px;padding-bottom:0px;padding-top:0px;margin-top:0px;'><a href='{$m->url}'>{$m->title}</a></h4>";

            echo "<span class='bold-link' style='font-size:16px;'>Part ".$partNumber." - ". date("M j, Y", strtotime($m->media_date))."</span>" ;

          echo '</div>';

          $partNumber++;

          }

        echo '</div>';

        }

        }

      echo '</div>';

    echo "</div>";

  echo "</div>";

echo "</div>";

echo "</div>";

?>

    <script>

        $(document).ready(function(){



            $(".tabs-list li a").click(function(e){

                e.preventDefault();

            });



            $(".tabs-list li").click(function(){

                var tabid = $(this).find("a").attr("href");

                $(".tabs-list li,.tabs div.tab").removeClass("active");   // removing active class from tab and tab content

                $(".tab").hide();   // hiding open tab

                $(tabid).show();    // show tab

                $(this).addClass("active"); //  adding active class to clicked tab



            });



        });

    </script>

<?php include("./includes/foot-4.php");?>