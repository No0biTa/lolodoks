<?php include('frontend/menu.php')?>

        <?php
            if(isset($_GET['food_id']))
            {
                $food_id= $_GET['food_id'];

                $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
//                    Have a data
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                }
                else
                {
                    header('location:'.HOME);
                }
            }
            else
            {
                header('location:'.HOME);
            }
        ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-black">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="post">
                <fieldset>
                    <legend><h3>Selected Food</h3></legend>

                    <div class="food-menu-img">

                        <?php
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo HOME; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <input type="hidden" name="food" value="<?php echo $title;  ?>">
                        <p class="food-price">Rp. <?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;  ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="formbold-form-input" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend><h3>Delivery Details</h3></legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="formbold-form-input" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="formbold-form-input" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="formbold-form-input" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="formbold-form-input" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

                <?php
                    if(isset($_POST['submit']))
                    {
//                        Get all detail from the form
                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];

                        $total = $price * $qty; //total harga * jumlah

                        $order_date = date("Y-m-d h:i:sa"); //Order Date

                        $status = "Ordered"; //Ordered, on delibery, cancelled

                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];

//                        Save all data to database
                        $sql2 = "INSERT INTO tbl_order SET
                                food = '$food',
                                price = $price,
                                qty = $qty,
                                total = $total,
                                order_date = '$order_date',
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                                ";

//                        echo $sql2; die();

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2==true)
                        {
                            $_SESSION['order'] = "<div class='success'> Order Successfully Created.</div>";
                            header('location:'.HOME);
                        }
                        else
                        {
                            $_SESSION['order'] = "<div class='failed'> Failed to Order ! Please Try Again Later.</div>";
                            header('location:'.HOME);
                        }
                    }
                ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('frontend/footer.php')?>