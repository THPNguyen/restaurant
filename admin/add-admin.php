<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="fullname" placeholder="Enter fullname"></td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="fullname" placeholder="Enter fullname"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="fullname" placeholder="Enter fullname"></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="text" name="fullname" placeholder="Enter fullname"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" class="btn-secondary" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>
<?php
    //Process the value from form and Save it in database.
    if(isset($_POST['submit']))
?>