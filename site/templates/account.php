<?php

/*
 *
 * Account template
 *
 */
include("./includes/head-4.php");
?>

<div class="login-form">

  <div class='container pd-t-lg pd-b-lg'>

    <div class="row">

      <div class="panel panel-primary">
                    <div class="panel-heading">Members Area</div>
                    <div class="panel-body">
            <?php
                   $loginRegister = $modules->get('LoginRegister');
                   $loginRegister->set('renderStyles', true);
                   echo $loginRegister->execute();
        ?>
                    	</div>
                    </div>
                </div>
            </div>
        </div>

<?php include("./includes/foot-4.php");?>