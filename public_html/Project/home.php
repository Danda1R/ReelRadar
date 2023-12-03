<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<h1 class="header">Home</h1>

<section>
  <h2>Welcome to my website!</h2>
  <p>You can view different types of media (Movies, TV Shows, Shorts & Video Games)</p>
  <p>If you are an admin or editor, you can also add media, edit media, or delete media</p>
</section>

<?php

if (is_logged_in(true)) {
  //comment this out if you don't want to see the session variables
  error_log("Session data: " . var_export($_SESSION, true));
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<?php
require(__DIR__ . "/../../partials/footer.php");
?>
