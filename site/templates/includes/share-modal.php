<div id='share-email-popup' class="white-popup mfp-hide">

        <h2>Share This With A Friend</h2>
        <div class='form-group'>
            <label>Your Email Address</label>
            <input id="send_email_friend" name="send_email_friend" type="text" class="form-control email" />
        </div>
        <div class='form-group'>

            <label>Your Friend's Email Address</label>
            <input id="send_email_friend_friendname" name="send_email_friend_friendname" type="text" class="form-control email" />
        </div>
        <div class='form-group'>
          <p class=' mg-b-xs'><strong>Subject:</strong> <?php echo $page->title;?></p>
          <label>Your Message</label>
           <textarea class='form-control' id="send_email_friend_message" name="send_email_friend_message"></textarea>

            <p class='mg-t-sm'><strong>Sharing URL:</strong> <?php echo $page->httpUrl;?></p>
        </div>
        <input name="website" type="hidden" id="send_website" value="">
        <input id="page_id" name="page_id" type="hidden" value="<?php echo $page->id;?>"/>

        <a href="javascript:void(0)" id="send_note_email_friend" class="btn btn-default btn-left mg-t-sm"><i class='icon-send-1'></i> Send Email</a>
        <span id="email_friend_status"></span>

    </div>

<?php
    $include_share_modal_js = true;
?>