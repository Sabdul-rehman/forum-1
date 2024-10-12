<?php
session_start();
session_unset();
session_destroy();

header("Location: index.php"); // Redirect back to index.php after destroying the session
exit;
?>
