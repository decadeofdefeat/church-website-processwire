<?php
    // this page is a "section" of its parent page
    // so if someone links to it, redirect it to parent page
    $session->redirect($page->parent->url);
?>