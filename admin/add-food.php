<?php
include "partials/menu.php";
?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title</td>
                    <td><input type="text" name="title" placeholder="Enter title category"></td>
                </tr>


                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" min="0" name="price"></td>
                </tr>
                <tr>
                    <td>file image</td>
                    <td><input type="file" name="fimage"></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" id="category">
                            <?php
                            //Create php code to display categories from database.
                            //1.Create SQL to get all category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Execute the SQL query
                            $res = mysqli_query($conn, $sql);
                            if ($res) {
                                //count the data from database available or not
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    //2.Display on dropdown 
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                            ?>

                                        <option value="<?= $id ?>"><?= $title ?></option>

                                    <?php
                                    }
                                } else {
                                    //We do not have category.
                                    ?>
                                    <option value="0">No category Found</option>

                            <?php
                                }
                            }


                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
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
<?php
include "partials/footer.php";
?>

<?php
if (isset($_POST['submit'])) {
    //1.Get the data from form
    $title = $_POST['title'];
    $description = htmlentities($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    //For Radio input, we need to check whether the buttom is selected or not
    if (isset($_POST['featured'])) {
        //Get the value form form
        $featured = $_POST['featured'];
    } else {
        //Set the default value
        $featured = "No";
    }

    //For Radio input, we need to check whether the buttom is selected or not
    if (isset($_POST['active'])) {
        //Get the value form form
        $active = $_POST['active'];
    } else {
        //Set the default value
        $active = "No";
    }

    //check whether the image is selected or not and set the value for image name accordingly
    if (isset($_FILES['fimage']['name'])) {
        //upload the image
        //to upload image we need image name, source path and destination path
        $image_name = $_FILES['fimage']['name'];
        if ($image_name != "") {
            //auto rename our image
            //get the extension of our image(jpg, png, gif, ) 
            $ext = end(explode('.', $image_name));

            //Rename the image
            $image_name = "Food_Name" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['fimage']['tmp_name'];

            $destination_path = "../images/food/{$image_name}";

            //finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether the image is uploaded or not 
            //and if the image is not uploaded then we will stop the process and redirect with error message 
            if ($upload == false) {
                //set message
                $_SESSION['upload'] = '<div class="error">Failed to upload image.</div>';
                //redirect to add category page
                header('location:' . URLPAGE . '/admin/add-food.php');
                //stop the process.
                die();
            }
        }
    } else {
        //don't upload image and set the image name value as blank
        $image_name = '';
    }


    //2. Create SQL query to insert category into Database
    $sql = "INSERT INTO tbl_food SET 
    title='$title', 
    description='$description',
    price=$price,
    image_name='$image_name',
    featured='$featured', 
    category_id=$category,
    active='$active'";

    //3.Execute the query  and Save in Database
    $res = mysqli_query($conn, $sql);

    //4.Check whether the query executed or not and data added or not
    if ($res) {
        //Query Executed and Category Added
        $_SESSION['add'] = '<div class="success">Food Added Successfully</div>';
        //Redirect to manage category
        header('location:' . URLPAGE . '/admin/manage-food.php');
    } else {
        //Failed to Add category
        $_SESSION['add'] = '<div class="error">Failed to Add Food </div>';
        //Redirect to manage category
        header('location:' . URLPAGE . '/admin/add-food.php');
    }
}
?>