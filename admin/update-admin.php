<?php include('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Update Admin</h2>

            <br>

            <?php
                //mendapatkan ID
                $id=$_GET['id'];

                //membuat SQL Query
                $sql="SELECT * FROM tbl_admin WHERE id=$id";

                //execute the query
                $res=mysqli_query($conn, $sql);

                //check whether the query
                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        //echo "Admin Available";
                        $row=mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else
                    {
                        header('location:'.HOME.'admin/manage-admin.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">

                    <div class="formbold-mb-2">
                        <label for="full_name" class="formbold-form-label"> Full Name </label>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" class="formbold-form-input" />
                        <span class="error">*</span>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="username" class="formbold-form-label"> Username </label>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="formbold-form-input" />
                        <span class="error">*</span>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="username" class="formbold-form-label"> Password </label>
                        <input type="password" name="current_password" id="current_password" placeholder="Current Password" class="formbold-form-input" />
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="username" class="formbold-form-label"> New Password </label>
                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="formbold-form-input" />
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="confirm_password" class="formbold-form-label"> Confirm Password </label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Re-enter New Password" class="formbold-form-input" />
                    </div><br/>


                    <div class="formbold-mb-2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Save" class="btn btn-default waves-teal btn-success">
                    </div>

                </table>

            </form>

        </div>

    </div>

    <?php
        if(isset($_POST['submit']))
        {
            //echo "Button Clicked";
            //mendapatkan semua value
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            // check current ID dan current Password
            $sql3 = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            //execute the Query
            $res3 = mysqli_query($conn, $sql3);

            if($res3==true)
            {
                $count=mysqli_num_rows($res3);

                if($count==1)
                {
                    //echo "User Found";

                    //membuat SQL Query
                    $sql = "UPDATE tbl_admin SET 
                            full_name = '$full_name',
                            username = '$username',
                            password='$new_password'
                            WHERE id='$id' 
                            ";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check query
                    if($res==true)
                    {
                        $_SESSION['update'] = "<div class='success'>Admin Update Sucessfully.</div>";
                        header('location:'.HOME.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
                        header('location:'.HOME.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                    header('location:'.HOME.'admin/manage-admin.php');
                }
            }



        }
    ?>

<?php include('partials/footer.php')?>
