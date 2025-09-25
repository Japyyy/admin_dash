<?php
session_start();
session_unset();
session_destroy();

// After logging out, always go back to the login page
header("Location: index.php");
exit;
