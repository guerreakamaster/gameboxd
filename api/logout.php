<?php
session_start();
session_unset();    // Remove all session variables
session_destroy();  // Destroy the session completely

// Send them back to the homepage
header("Location: ../web/index.php?msg=loggedout");
exit;
