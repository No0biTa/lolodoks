<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Food</h2>
        <br><br>

        <form action="" method="POST" onsubmit="return validate();" enctype="multipart/form-data">
            <table class="tbl-50">
                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Title </label>
                    <input type="text" name="title" placeholder="Full Name" class="formbold-form-input" />
                    <span class="error">*</span>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Description </label>
                    <textarea name="description" class="formbold-form-input" cols="30" rows="5" placeholder="Description"></textarea>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Price </label>
                    <input type="number" name="price" class="formbold-form-input" />
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Select Image </label>
                    <input type="file" name="image"/>
                    <span class="error">*</span>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Category </label>
                    <select name="category" class="formbold-form-input">

                        <?php
    //                            Create PHP code to display category from database
    //                        1. Create SQL to get all active category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

    //                        Execute the query
                            $res = mysqli_query($conn, $sql);

    //                        Count riws ti check apakah kita punya kategorinya atau tidak
                            $count = mysqli_num_rows($res);

    //                        IF count is generate than zero, we have category jika tidak ya tidak
                            if($count>0)
                            {
//                                We Hace category
                                while($row=mysqli_fetch_assoc($res))
                                {
//                                    Get the detail of category
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title;?></option>

                                    <?php
                                }
                            }else
                            {
//                              We dont have
                        ?>
                                <option value="0">No Category FOund</option>
                        <?php
                            }
                        ?>
                    </select>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="featured" class="formbold-form-label"> Featured </label>
                    <input type="radio" name="featured" value="Yes" /> Yes
                    <input type="radio" name="featured" value="No" /> No
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="active" class="formbold-form-label"> Active </label>
                    <input type="radio" name="active" value="Yes" /> Yes
                    <input type="radio" name="active" value="No" /> No
                </div><br/>


                <div class="formbold-mb-2">
                    <input type="submit" name="submit" value="Add Food" class="btn btn-default waves-teal btn-success">
                </div>

            </table>

        </form>
    </div>
</div>

<?php include("partials/footer.php")?>
