<?php
session_start();
?>

<script>
    if (confirm('Are You Sure You Want To Logout?')) {
        // If the user confirms, redirect to logout.php to destroy the session
        window.location.href = 'logout_handle.php';
    } else {
        // If the user cancels, redirect back to index.php or any other desired action
        window.location.href = 'index.php';
    }
</script>
