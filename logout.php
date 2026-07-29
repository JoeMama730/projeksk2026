<?php
define("ACCESS", true);
include('inc_header.php');

session_destroy();

echo " <script> alert('Log out successful.');
window.location.replace('index.php');</script> ";
?>