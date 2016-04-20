  <script>
    $("document").ready(function() {

      /*  $('.share-series-twitter').sharrre({
    share: {
      twitter: true
    },
    buttons: { },
     enableHover: false,
    enableTracking: false,
    click: function(api, options){
      api.simulateClick();
      api.openPopup('twitter');
    }
  });
  */
  $('.share-series-facebook').sharrre({
    share: {
      facebook: true
    },
     enableHover: false,
    enableTracking: false,
    click: function(api, options){
      api.simulateClick();
      api.openPopup('facebook');
    }
  });

   $(".share-series-email .box a").on('click', function(event){
               event.preventDefault();
              $.magnificPopup.open({
              items: {
                src: '#share-email-popup'
              },
              type: 'inline'
            }, 0);
    });


          $("#send_note_email_friend").on('click', function(event) {
                    var email = $.trim($("#send_email_friend").val());
                    var email_friend = $.trim($("#send_email_friend_friendname").val());
                    if (email == "") {
                        $("#email_friend_status").html(" Please enter a valid email address.");
                        return false;
                    }
                    if (!validateEmail(email)) {
                        $("#email_friend_status").html(" Please enter a valid email address.");
                        return false;
                    }
                    if (email_friend == "") {
                        $("#email_friend_status").html(" Please enter your friend's email address.");
                        return false;
                    }
                    if (!validateEmail(email_friend)) {
                        $("#email_friend_status").html(" Please enter your friend's email address.");
                        return false;
                    }

                    $("#email_status").html(" Sending....");

                    var honeypot = $('#send_website').val();
                    if(honeypot == '' || honeypot == null) {

                      //Call a method on the server to send the email
                      $.post("/api/email-friend/", {
                          email: $("#send_email_friend").val(),
                          friend_email: $("#send_email_friend_friendname").val(),
                          message: $("#send_email_friend_message").val(),
                          page_id: $("#page_id").val()
                      }, function () {
                          $("#email_friend_status").html(" Your message was sent");
                          $("#send_email_friend_friendname").val('');

                      });
                    }
                });

});
</script>