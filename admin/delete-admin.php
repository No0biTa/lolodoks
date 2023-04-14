<?php

    //include contants php
    include ('../config/constants.php');

    // Mendapatkan ID yang akan di delet
    $id = $_GET['id'];

    //Membuat SQL query untuk delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //CHeck eksekusi query berhasil atau tidak
    if($res==TRUE)
    {
        //Eksekusi query berhasil dan admin berhasil di delete
        //echo 'Admin deleted';
        $_SESSION['delete'] = "Admin deleted successfully";
        //redirect ke manage admin
        header("location:".HOME.'admin/manage-admin.php');

    }else{
        //failed to delete admin
        //echo 'Failed to delete admin';
        $_SESSION['delete'] = "Failed to Delete Admin! Please Try Again Later";
        //redirect ke manage admin
        header("location:".HOME.'admin/manage-admin.php');
    }

    //Redirect ke manage admin dengan success/error
?>
