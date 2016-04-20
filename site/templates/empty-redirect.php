<?php

if( $page->redirect_url != '')
{
    $session->redirect($page->redirect_url);
}
else
{
    // redirect home
    $session->redirect('/');
}

?>