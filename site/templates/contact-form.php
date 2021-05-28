<?php

function toHTML( $string )

{

  $bad = array("content-type","bcc:","to:","cc:","href");

$stringNew = str_replace($bad,"",$string);

  $stringNew2 = str_replace("\n", "<br />", $stringNew);

  return $stringNew2;

}

$formComplete = false;

if( isset($input->post->first_name))

{

  // only send email for non-spammers

  if(isset($input->post->website) && $input->post->website == '')

  {

$name = $_POST["userName"];

$email = $_POST["userEmail"];

$subject = $_POST["subject"];

$content = $_POST["content"];

$toEmail = "jay@thursdaychurch.org";

$mailHeaders = "From: " . $name . "<". $email .">\r\n";

if(mail($toEmail, $subject, $content, $mailHeaders)) {

$message = "Your contact information has been received.";

$type = "success";

}

  }

}

include("./includes/head-4.php");

?>

<div class="row">

<div class="col-sm-6 col-sm-offset-3">

  <div class="panel panel-primary">

    <div class="panel-heading">How Can We Help?</div>

    <div class="panel-body">

      Complete the form below and we'll forward your inquiry to the appropriate team member. If you need assistance right away, please call 812.882.2737 to speak with someone.<br />

    </div></div></div>

    <div class="col-sm-6 col-sm-offset-3">

      <div class="panel panel-primary">

        <div class="panel-heading"></div>

        <div class="panel-body">

          <?php if(  $formComplete == false){ echo $page->body; } ?>

          <?php if( $formComplete) { ?>

          <p>Thank you for contacting us. If you have something that needs immediate attention, please call the Church office at 812.882.2737.</p>

          <?php } else { ?>

          <form class="form  form-validation" action='?' id='contact-form' method='post' role="form">

            <div class='form-group ' >

              <div class='row'>

                <div class='col-md-6 ' >

                  <label  for='first_name'>First Name<span class="required">*</span></label>

                  <input class='form-control required'  id='first_name' name='first_name' type='text'>

                </div>

                <div class='col-md-6 ' >

                  <label  for='last_name'>Last Name<span class="required">*</span></label>

                  <input class='form-control required'  id='last_name' name='last_name' type='text'>

                </div>

              </div>

            </div>

            <div class='form-group ' >

              <label  for='email'>Email</label>

              <input class='form-control email '  id='email' name='email' type='email'>

            </div>

            <div class='form-group ' >

              <label  for='phone'>Phone Number (with area code)<span class="required">*</span></label>

              <input class='form-control phone required'  id='phone' name='phone' type='tel' placeholder="(716) 555-5555">

            </div>

            <div class='form-group' >

              <label for='address'>Street Address</label>

              <input class='form-control required'  id='address' name='address' type='text'>

            </div>

            <div class='form-group'>

              <div class='row'>

                <div class='col-sm-6'>

                  <label  for='city'>City</label>

                  <input class='form-control required'  id='city' name='city' type='text'>

                </div>

                <div class='col-sm-3 col-xs-6'>

                  <label  for='state'>State</label>

                  <select name='state' class='form-control'>

                    <?php include("./includes/states.php");?>

                  </select>

                </div>

                <div class='col-sm-3 col-xs-6'>

                  <label  for='zip'>Zip Code<span class="required">*</span></label>

                  <input class='form-control zipcode'  id='zip' name='zip' type='text'>

                </div>

              </div>

            </div>

            <div class='form-group'>

              <label>Which location do you attend?<span class="required">*</span></label>

              <select name="campus" class="form-control">

                <option value=""></option>

                <option value="Vincennes">Vincennes</option>

                <option value="Bicknell" >Bicknell</option>

                <option value="Online">Online</option>

              </select>

            </div>

            <div class='form-group'>

              <label  for='availability'>Questions or Comments<span class="required">*</span></label>

              <textarea class='form-control' rows='5'  name='comments'></textarea>

            </div>

            <div class='mg-t-md'>

              <button class="btn btn-default mg-t-md btn-left" type="submit">Send</button>

            </div>

          </form>

          <?php } ?>

        </div>

      </div>

    </div>

    </div>

    



<?php ob_start(); ?>

$(document).ready(function(){

$("#contact-form").validate();

});

<?php $additionalJS = ob_get_clean(); ?>

<?php include("./includes/foot-4.php");?>