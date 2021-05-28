<?php

  if( $page->id == 1369 )
  {
    $cclass = ' not-full-width-tabs ';
  }
  else
  {
    $cclass = 'full-width-tabs';
  }

?>
<div class="row mg-t-md ">
  <div class="col-md-12">
<div role="tabpanel" class='page-section-tabs <?php echo $cclass;?>'>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified " role="tablist">

    <?php
    $xx = 0;
    foreach ($content as $c) {
        $active = ' ';
        $r = '';
        if($input->get->page) $r = $input->get->page;
        if( $r != '' ) {
          if( strtolower($r) == strtolower($c->title) )
          {
            $active = ' active ';
          }

        } else if( $xx == 0 ) {
          $active = ' active ';
        }

        $tabName =  wire('sanitizer')->pageName($c->title);
        echo " <li  class='{$active} '><a href='#{$tabName}-tab' aria-controls='{$tabName}-tab' role='tab' data-toggle='tab'><div class='text-center'><span> <i class='{$c->title}'></i> </span></div></a></li>";
        $xx++;
    }
    ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <?php
    $xx = 0;
    foreach ($content as $c) {
        $active = ' ';
        $r = '';
        if($input->get->page) $r = $input->get->page;
        if( $r != '' ) {
          if( strtolower($r) == strtolower($c->title) )
          {
            $active = ' active ';
          }

        } else if( $xx == 0 ) {
          $active = ' active ';
        }
        $tabName =  wire('sanitizer')->pageName($c->title);
        echo " <div role='tabpanel' class='tab-pane {$active} serif' id='{$tabName}-tab'>";

        $cols = "col-md-12";
        if($c->sidebar_content != '') $cols = 'col-md-8';
        echo ' <div class="row "><div class="'.$cols.'">';
        echo $c->body;
        echo "</div>";

        if($c->sidebar_content != '')
        {
            echo '<div class="col-md-3 col-md-offset-1  sidebar-section">';
            echo "<div class='sidebar_content mg-t-sm'>".$c->sidebar_content."</div>" ;
            echo "</div>";
        }

        echo "</div></div> ";
        $xx++;
    }
    ?>

  </div>

</div>
</div>
</div>


<?php ob_start(); ?>

 $(document).ready(function() {

            // Javascript to enable link to tab
var hash = document.location.hash;
var prefix = "page-";
if (hash) {
    $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
}

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash.replace("#", "#" + prefix);
});

        });
 <?php $config->additionalJS = ob_get_clean(); ?>

<?php

?>