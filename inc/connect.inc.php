<?php
if (!defined('PARENT')) die('Ty hackerze za dychę :P');
$host = "localhost";
$db_user = "root";
$db_password ="";
$db_name = "projekt";
mysqli_report(MYSQLI_REPORT_STRICT);
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);