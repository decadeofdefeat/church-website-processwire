<?php
/**
* Serve application template
*
*/
include_once("./includes/functions.php");
function toHTML( $string )
{
  $bad = array("content-type","bcc:","to:","cc:","href");
$stringNew = str_replace($bad,"",$string);
  $stringNew2 = str_replace("\n", "<BR>", $stringNew);
  return $stringNew2;
}
$formComplete = false;
if( isset($input->post->first_name))
{
  // only send email for non-spammers
  if(isset($input->post->website) && $input->post->website == '')
  {
/*************************************
/*************************************
//////////////////////////////////////////
  // send email to the Volunteer Coordinator
//////////////////////////////////////////
/*************************************
/*************************************/
  }
}
include("./includes/head-4.php");
?>
<div class='container mg-t-lg mg-b-lg serif '>
  <div class="row ">
    <div class="col-md-12 ">
      <h1 class='mg-b-md'><?php echo $page->title;?> Volunteer Application</h1>
      <?php if(  $formComplete == false){ echo $page->body; } ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 ">
      <?php if( $formComplete) { ?>
      <p>Thank you for submitting your volunteer application. Someone will be contacting you within a week. If you do not hear back in this amount of time, please call the main office at 555.1234.</p>
      <?php } else { ?>
      <form class="form  form-validation" action='?' id='service-form' method='post' role="form">
        <div class='form-group ' >
          <div class='row'>
            <div class='col-md-6 ' >
              <label  for='first_name'>First Name<span class="required">*</span></label>
              <input class='form-control required'  id='first_name' name='first_name' type='text'  >
            </div>
            <div class='col-md-6 ' >
              <label  for='last_name'>Last Name<span class="required">*</span></label>
              <input class='form-control required'  id='last_name' name='last_name' type='text'  >
            </div>
          </div>
        </div>
        <div class='form-group ' >
          <label  for='dob'>Date of birth<span class="required">*</span></label>
          <input class='form-control date required'  id='dob' name='dob' placeholder='MM/DD/YYYY' type='text'  >
        </div>
        <div class='form-group ' >
          <label  for='email'>Email</label>
          <input class='form-control email '  id='email' name='email' type='email'  >
        </div>
        <div class='form-group ' >
          <label  for='phone'>Phone Number (with area code)<span class="required">*</span></label>
          <input class='form-control phone required'  id='phone' name='phone' type='tel' placeholder="(716) 555-5555"  >
        </div>
        <div class='form-group' >
          <label for='address'>Street Address<span class="required">*</span></label>
          <input class='form-control required'  id='address' name='address' type='text'  >
        </div>
        <div class='form-group'    >
          <div class='row'>
            <div class='col-sm-6 ' >
              <label  for='city'>City<span class="required">*</span></label>
              <input class='form-control required'  id='city' name='city' type='text'  >
            </div>
            <div class='col-sm-3 col-xs-6 ' >
              <label  for='state'>State<span class="required">*</span></label>
              <select name='state' class='form-control required'>
                <?php include("./includes/states.php");?>
              </select>
            </div>
            <div class='col-sm-3 col-xs-6 ' >
              <label  for='zip'>Zip Code<span class="required">*</span></label>
              <input class='form-control zipcode required'  id='zip' name='zip' type='text'  >
            </div>
          </div>
        </div>
        <div class='form-group website-form ' >
          <label  for='website'>Website</label>
          <input class='form-control'  id='website' name='website' type='text'  >
        </div>
        <div class='form-group ' >
          <label>At which campus are you interested in serving?</label>
          <select name="campus" class="form-control">
            <option value="Gilroy" selected>Gilroy</option>
            <option value="Meadowville" >Meadowville</option>
            <option value="Fairhaven">Fairhaven</option>
          </select>
        </div>
        <div class='form-group'    >
          <label  for='why'>Why do you want to serve in this ministry?<span class="required">*</span></label>
          <textarea class='form-control required' rows='5'  id='why' name='why'   ></textarea>
        </div>
        <div class='form-group'    >
          <label  for='availability'>Please describe your availability:</label>
          <textarea class='form-control' rows='5'  id='availability' name='availability'   ></textarea>
        </div>
        <div class='mg-t-md'>
          <button class="btn btn-default mg-t-md btn-left" type="submit">Submit Application</button>
        </div>
        <?php } ?>
      </form>
    </div>
  </div>
</div>
<?php ob_start(); ?>
$(document).ready(function(){
$("#service-form").validate();
});
<?php $additionalJS = ob_get_clean(); ?>
<?php
include("./includes/foot-4.php");