<?php

    include ('../config/constants.php');

//    Check value id dan image_name ter set atau tidak
    if (isset($_GET['id']) AND isset($_GET['image_name']))
    {
//        get the value dan delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

//        Remove fisik file image
        if ($image_name != "")
        {
//            Image is available
            $path = "../images/category/".$image_name;
//            Remove image
            $remove = unlink($path);

//            If failed to remove image lalu munculkan error message
            if ($remove==false)
            {
//                Set session message
                $_SESSION['remove'] = "<div class='failed'>Failed to Remove Category Image.</div>";
//                Redirect to manage category
                header("location:".HOME.'admin/manage-category.php');
//                Stop the proces
                die();

            }
        }
//        Delete data from database
            $sql ="DELETE FROM tbl_category WHERE id=$id";
//        Execute the query
        $res = mysqli_query($conn, $sql);

//        Check data terhapus di database atau tidak
        if ($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
//            Redirect to manage category
            header("location:".HOME.'admin/manage-category.php');
        }
        else
        {
//            Set failed message dan redirect
            $_SESSION['delete'] = "<div class='failed'>Failed to Delete Category. </div>";
//            REdirect to manage category
            header("location:".HOME.'admin/manage-category.php');
        }

//        Redirect to maanage category page with message
    }else
    {
//        redirect to manage category
        header("location:".HOME.'admin/manage-category.php');
    }
?>
