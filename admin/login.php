<?php include "../config/constants.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['user-not-login'])) {
            echo $_SESSION['user-not-login'];
            unset($_SESSION['user-not-login']);
        }
        ?>

        <form action="" method="post" class="text-center">
            UserName :
            <br>
            <input type="text" name="username" placeholder="Enter username">
            <br><br>
            PassWord : <br>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>
            <input type="submit" value="Login" name="submit" class="btn-primary">
        </form>
        <p class="text-center">Created By - <a href="https://www.youtube.com/watch?v=bk_5SAH7Oyk&t=1956s">Demo</a></p>
    </div>
</body>

</html>
<?php
//check whether the submit buttion is clicked or not
if (isset($_POST['submit'])) {
    //Process for login
    //1. Get the Data from login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $pass = mysqli_real_escape_string($conn, $raw_password);
    //2. Check whether the user and password exists or not.
    //Create SQL query to check the user and password.
    $sql = "SELECT * FROM tbl_admin WHERE username='$username'  AND password='$password'";
    //3. Execute the Query
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user available and login success
            $_SESSION['login'] = '<div class="success text-center" >Login Successful.</div>';
            $_SESSION['user'] = $username;
            //Redirect to Home page/dashboard
            header('location:' . URLPAGE . '/admin');
        } else {
            //User not available and login fail
            $_SESSION['login'] = '<div class="error text-center" >username or password did not match</div>';
            //Redirect to home page/dashboard
            header('location:' . URLPAGE . '/admin/login.php');
        }
    }
}
?>