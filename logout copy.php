
<?php
// destroys session on log out
session_start();
session_destroy();
header("Location: log.html");
 ?>
