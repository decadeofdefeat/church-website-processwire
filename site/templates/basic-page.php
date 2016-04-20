<?php

/**
 * Page template
 *
 */
include("./includes/head.inc");
?>


<div class='container mg-t-lg mg-b-lg serif'>
<div class="row">
<div class="col-lg-12">

<?php if($page->short_header == 1) echo "<h1 class='mg-b-md'>".$page->title."</h1>";?>


<?php echo $page->body; ?>



</div>
</div>
</div>


<?php
include("./includes/foot.inc");
