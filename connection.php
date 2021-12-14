<?php
$hostname="localhost";
$username="root";
$password="1234";

// Create connection
$cxl = new mysqli($hostname, $username, $password);
// Check connection
if ($cxl->connect_error) {
    die("Connection failed: " . $cxl->connect_error);
}

$cxl->set_charset("utf8mb4");
date_default_timezone_set('Turkey');
mb_internal_encoding("UTF-8");

array_walk_recursive($_POST, function (&$value) {
    global $cxl;
	$value = $cxl->real_escape_string($value);
    $value = htmlentities($value);
});

extract($_POST);

array_walk_recursive($_GET, function (&$value) {
    global $cxl;
	$value = $cxl->real_escape_string($value);
    $value = htmlentities($value);
});
extract($_GET);	