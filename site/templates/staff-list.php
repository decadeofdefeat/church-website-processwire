<?php
include("./includes/head-4.php");
?>
<div class="panel panel-default">
  <!--div class="panel-heading"><?php //echo($page->title);?>  </div-->
  <div class="panel-body">
    <div class="container mg-b-lg">
      <div class="row multi-columns-row ">
        <?php
        $staff =  $pages->find("parent=/about/staff/, template=staff-detail, sort=sort");
        foreach ($staff as $st) {
        print "<div class='col-xs-6 col-sm-6 col-md-3 mg-b-md '>";
          $thumb = $pages->get('/about/staff/')->images->first()->size(360,412)->url;
          if( !empty($st->staff_photo) > 0)
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
  </div>
</div>
<?php
include("./includes/foot-4.php");