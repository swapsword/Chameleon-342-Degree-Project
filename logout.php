<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("Location: http://localhost/admin.php"); // Redirecting To Home Page
}
?>
