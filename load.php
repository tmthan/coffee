<?php
require_once( dirname( __FILE__ ). '/include/config.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
$conn = new mysqli(HOST, USER, PASS, DB);
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function coverDateToVN($date)
{
   	return substr($date, 8, 2) . "/" . substr($date, 5, 2) . "/" . substr($date, 0, 4);
}

function coverDateToUS($date)
{
   	return substr($date, 6, 4) . "-" . substr($date, 3, 2) . "-" . substr($date, 0, 2);
}

function locKyTu($string)
{
	return preg_replace("/[^a-zA-Z]/", "", $string);
}

function locSo($number)
{
	if (is_numeric($number)) {
		return $number;
	}
	else {
		return null;
	}
}

function truNgay($first_date, $second_date)
{
	$first_date = strtotime($first_date);
	$second_date = strtotime($second_date);
	$datediff = $first_date - $second_date;
	$ketQua = floor($datediff / (60*60*24));
	return $ketQua;
}

?>