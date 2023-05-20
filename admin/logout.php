<?php
    include('../config/constants.php');

    //1. Destroy the Session
    session_destroy();

    //2. Redirect to login Page
    header('location:'.HOME.'admin/login.php');
?>