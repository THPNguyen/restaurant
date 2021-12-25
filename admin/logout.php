<?php
//include constants.php for URLPAGE
include "../config/constants.php";
//1.Destroy the session
session_destroy();
//2.Redirect to login page
header('location:' . URLPAGE . '/admin/login.php');
