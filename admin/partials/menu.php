<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>The Lolodoks - Home</title>

        <link rel="stylesheet" href="../css/admin.css">
        <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        </style>
    </head>

    <body>
        <!-- Menu Seciton Start -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
            </div>
        </div>
        <!-- Menu Section End -->

        <script>
            function validate(){

                var a = document.getElementById("password").value;
                var b = document.getElementById("confirm_password").value;
                if (a!=b) {
                    alert("Passwords do no match");
                    return false;
                }
            }
        </script>