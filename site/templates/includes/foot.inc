


    </div>   <!-- end Main -->


     <div id='footer-social-bar'>
            <div class='container'>
                <div class='row'>
                  <div class='col-xs-6 col-md-10 col-sm-9' >

                          <div class='item'><a href='#'>Share Your Story</a></div>
                          <div class='item'><a href="#">716.555.1234</a></div>
                          <div class='item'><a href='#'>info@crosspointchurch.church</a></div>
                  </div>
                  <div class='col-xs-6 col-md-2 col-sm-3' >
                        <div class='pull-right'>
                           <a target="_blank" href='https://facebook.com' class='social-fb'><i class="icon-facebook  "></i></a>
                           <a target="_blank" href='https://twitter.com' class='social-tw'><i class="icon-twitter"></i></a>
                           <a target="_blank" href='https://instagram.com' class='social-in'><i class="icon-instagram "></i></a>
                           <a target="_blank" href='https://youtube.com' class='social-yt'><i class="icon-youtube "></i></a>
                        </div>
                  </div>
              </div>
          </div>
    </div>


    <!-- FOOTER -->
    <div id='footer'>
       <div class='container '>


              <div class='row mg-t-md mg-b-md'>
                  <div class='col-md-12'>

                    <p>&copy; <?php echo date("Y");?> Cross Point Church

                      </p>
                  </div>
              </div>
          </div>
    </div>


    <!-- window resize helper -->
    <span id="mq-detector">
        <span class="visible-xs"></span>
        <span class="visible-sm"></span>
        <span class="visible-md"></span>
        <span class="visible-lg"></span>
    </span>



 </div> <!-- / wrapper -->

  <!-- Javascript
    ================================================== -->
  <?php
    $js_array = array( 'js/plugins/fastbutton/google.fastbutton.js',
                    'js/plugins/fastbutton/jquery.google.fastbutton.js',
                      'js/bootstrap.min.js',
                      'js/plugins/emailObfuscation/emo.min.js',
                      'js/plugins/fitvids/jquery.fitvids.min.js',
                      'js/plugins/validate/jquery.validate.js',
                      'js/main.js'
             )
  ?>

     <script src="<?php echo AIOM::JS( $js_array ); ?>"></script>



    <?php if(isset($additionalJS)) echo '<script>'. $additionalJS .'</script>'; ?>

    <?php


    // If the page is editable, then output a link that takes us straight to the page edit screen:
     if( !isset($external_page) ) {
      if(wire('page')->editable()) {
          echo "<a  id='editpage' href='".wire("config")->urls->admin."page/edit/?id=".wire('page')->id."'>Edit</a>";
      }
    }

    ?>


  </body></html>