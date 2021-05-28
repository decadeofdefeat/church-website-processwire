<?php
 if ($user->hasRole("superuser")):
// echo content below if logged in
?>
<?php else: ?>
<?php $session->redirect($pages->get("/maintenance/")->url); ?>
<?php endif; ?>