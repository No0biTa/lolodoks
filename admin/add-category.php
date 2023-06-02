<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Add Category</h2>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <br><br>

            <!-- Add Category Form Start -->
            <form action="" method="POST">

                <table class="tbl-50">
                    <div class="formbold-mb-2">
                        <label for="title" class="formbold-form-label"> Title </label>
                        <input type="text" name="title" placeholder="Category Title" class="formbold-form-input" />
                        <span class="error">*</span>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="username" class="formbold-form-label"> Featured </label>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="username" class="formbold-form-label"> Active </label>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </div><br/>

                    <div class="formbold-mb-2">
                        <input type="submit" name="submit" value="Save" class="btn btn-default waves-teal btn-success">
                        <a href="manage-category.php"><button type="button" class="btn btn-default waves-teal btn-danger">Cancel</button></a>
                    </div>


                </table>
            </form>

            <!-- Add Category Form Ends -->

        <?php
            //Check Apakah Submit Button ter-Click atau tidak
            if(isset($_POST['submit']))
            {
//                echo "Clicked";

                //1. Mendapatkan Value dari Form Category
                $title = $_POST['title'];

                //Untuk Input Radio, Harus Mengecek button ter-select atau tidak
                if(isset($_POST['featured']))
                {
                    //Mendapatkan valued dari form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set Default Value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //2. Membuat SQL query untuk memasukan data kedalam database
                $sql = "INSERT INTO tbl_category SET
                             title='$title',
                             featured='$featured',
                             active='$active'
                             ";

                //3. Eksekusi Query dan Simpan dalam Database
                $res = mysqli_query($conn, $sql);

                //4. Check Apakah query ter-eksekusi dan data tersimpan atau tidak
                if($res==TRUE)
                {
                    //Session untuk variable agar menampilkan message
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully </div>";
                    //Redirect
                    header("location:".HOME.'admin/manage-category.php');
                }
                else{
                    //Session untuk variable agar menampilkan message
                    $_SESSION['add'] = "<div class='failed'>Failed to Add Category </div>";
                    //Redirect
                    header("location:".HOME.'admin/add-category.php');
                }
            }

        ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>