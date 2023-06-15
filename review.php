<?php include('frontend/menu.php')?>;

<?php
if(isset($_SESSION['add_comment']))
{
    echo $_SESSION['add_comment'];
    unset($_SESSION['add_comment']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/review.css">
    <title>Review This Project</title>
</head>
    <body>
        <div class="wrapper">

            <form action="" method="POST" class="form">
                <div class="formbold-mb-5">
                    <label for="full_name" class="formbold-form-label"> Full Name </label>
                    <input type="text" name="name" placeholder="Full Name" class="formbold-form-input" >
                </div>

                <div class="formbold-mb-5">
                    <label for="rating" class="formbold-form-label"> Rate </label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"></label>
                        </div>
                </div>

                <div class="formbold-mb-5">
                    <label for="review" class="formbold-form-label"> Write a Comment </label>
                    <textarea name="message" cols="30" rows="10" class="formbold-form-input" placeholder="Message"></textarea>
                </div>

                <button type="submit" class="btn btn-default waves-teal btn-success" name="submit">Post Comment</button>
            </form>
            <?php
                if (isset($_POST['submit']))
                {

                    $name = $_POST['name'];
                    $message = mysqli_real_escape_string($conn, $_POST['message']);
                    $rating = $_POST['rating'];

                    $sql = " INSERT INTO tbl_reviews SET
                                        name='$name',
                                        message='$message',
                                        rating='$rating'
                                         ";

//                    echo $sql; die();

                    $res = mysqli_query($conn, $sql);

                    //4. Check Apakah query ter-eksekusi dan data tersimpan atau tidak
                    if($res==true)
                    {
                        //Session untuk variable agar menampilkan message
                        $_SESSION['add_comment'] = "<div class='success'>Comment Added Successfully </div>";
                        //Redirect
                        header("location:".HOME.'review.php');
                    }
                    else{
                        //Session untuk variable agar menampilkan message
                        $_SESSION['add_comment'] = "<div class='failed'>Failed to Add Comment </div>";
                        //Redirect
                        header("location:".HOME.'review.php');
                    }

//                    if ($conn->query($sql) === TRUE) {
//                        echo "";
//                    } else {
//                        echo "Error: " . $sql . "<br>" . $conn->error;
//                    }
                }
            ?>
        </div>

        <section class="comment-menu">
            <div class="container">
                <h2 class="text-center">This People Say..</h2>

                <?php
                //                Get the food from DB dimana yang aktif dan feature
                $sql2 = "SELECT * FROM tbl_reviews ORDER BY id DESC";

                $sn = 1;

                //            Execute the query
                $res2 = mysqli_query($conn, $sql2);

                $count = mysqli_num_rows($res2);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        $id = $row['id'];
                        $name = $row['name'];
                        $rating = $row['rating'];
                        $message = $row['message'];

                        ?>
                        <div class="comment-menu-box">
                            <div class="comment-menu-desc">
                                <h4><?php echo $name;?></h4>

                                <div class="thumb-content">
                                    <div class="star-rating">
                                        <ul class="horizontal-list">
                                            <?php

                                            $start=1;
                                            while ($start <= 5)
                                            {
                                                if ($row['rating'] < $start)
                                                {
                                                    ?>
                                                    <li class=""><i class="fa fa-star-o"></i></li>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <li class=""><i class="fa fa-star"></i></li>
                                                    <?php
                                                }

                                                $start++;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <p class="comment-detail">
                                    <?php echo $message; ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Comment Not Available.</div>";
                }
                ?>


                <div class="clearfix"></div>

            </div>
        </section>
    </body>
</html>

<?php include('frontend/footer.php')?>;