<?php include('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Update Admin</h2>

            <br></br>

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
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type+"text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

        </div>

    </div>

    <?php
        if($_POST['submit'])
        {
            //echo "Button Clicked";
            //mendapatkan semua value
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            //membuat SQL Query
            $sql = "UPDATE tbl_admin SET 
            full_name = '$full_name',
            username = '$username'
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
                $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
                header('location:'.HOME.'admin/manage-admin.php');
            }

        }
    ?>

<?php include('partials/footer.php')?>
