<?php include ('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h2> Update Category</h2>

        <br><br>

        <?php
//            Chech ID ter set atau tidak
        if(isset($_GET['id']))
        {
//            Mendapatkan semua detail
            $id = $_GET['id'];
//            Create SQL query untuk mendapatkan data
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

//            Execute the query
            $res = mysqli_query($conn, $sql);

//            Count the rows
            $count = mysqli_num_rows($res);

            if ($count==1)
            {
//                Get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
//            else
//            {
////                Redirect to manage cotegory with session
//                $_SESSION['no-category-found'] = "<div class='failed'>No Category Found. </div>";
//                header("location:".HOME.'admin/manage-category.php');
//            }

        }
//        else
//        {
//            header("location:".HOME.'admin/manage-category.php');
//        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-full">

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Title </label>
                    <input type="text" name="title" value="<?php echo $title;?>" class="formbold-form-input" />
                    <span class="error">*</span>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Current Image </label>
                    <?php
                        if ($current_image != "")
                        {
//                            Display Image
                            ?>
                            <img src="<?php echo HOME; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }else
                        {
                            echo "<div class='failed'>Image Not Added.</div>";
                        }
                    ?>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Select New Image </label>
                    <input type="file" name="image"/>
                    <span class="error">*</span>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="featured" class="formbold-form-label"> Featured </label>
                    <input type="radio" name="featured" value="Yes" /> Yes
                    <input type="radio" name="featured" value="No" /> No
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="active" class="formbold-form-label"> Active </label>
                    <input type="radio" name="active" value="Yes" /> Yes
                    <input type="radio" name="active" value="No" /> No
                </div><br/>

                <div class="formbold-mb-2">
                    <input type="submit" name="submit" value="Update Category" class="btn btn-default waves-teal btn-success">
                </div>

            </table>
        </form>
    </div>
</div>

<?php include ('partials/footer.php')?>
