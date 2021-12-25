<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['user-not-login'] = '<div class="error text-center" >You must login first</div>';
    //Redirect to login page
    header('location:'.URLPAGE.'/admin/login.php');

}
