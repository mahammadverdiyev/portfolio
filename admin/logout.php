<?php
if (!isset($_SESSION)) {
    session_start();
}

if (session_status() === PHP_SESSION_ACTIVE)
    session_destroy();

header("Location: login.php");
?>