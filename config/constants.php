<?php
//session start
session_start();
//create  constants to store non repeating values
define("LOCALHOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "food-order");
define("URLPAGE", "http://restaurant.local");
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);  //connect db.
$db_select = mysqli_select_db($conn, DB_DATABASE) or die(mysqli_error($conn));