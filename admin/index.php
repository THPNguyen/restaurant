<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Cateogries
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Cateogries
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Cateogries
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Cateogries
        </div>
        <div class="clearfix">

        </div>
    </div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>