<?php
    include ('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {

//        1. Get ID dan Image
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
//        2. Remove Image jika ad
//        CHeck image jika ada dan delete
        if($image_name != "")
        {
            $path ="../images/food/".$image_name;

            $remove = unlink($path);

            if($remove==false)
            {
                //failed to delete admin
                //echo 'Failed to delete admin';
                $_SESSION['upload_food'] = "<div class='failed'>Failed to Remove Image File</div>";
                //redirect ke manage admin
                header("location:".HOME.'admin/manage-food.php');
                die();
            }
        }

//        3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete_food'] = "<div class='success'>Food Deleted Successfully</div>";
            //redirect ke manage admin
            header("location:".HOME.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete_food'] = "<div class='failed'>Failed to Delete Food! </div>";
            //redirect ke manage admin
            header("location:".HOME.'admin/manage-food.php');
        }

//        4. Redirect with message
    }
    else
    {
        //failed to delete Food
        //echo 'Failed to delete Food';
        $_SESSION['unauthorize'] = "<div class='failed'>Unauthorized Access.</div>";
        //redirect ke manage admin
        header("location:".HOME.'admin/manage-food.php');
    }

?>
