<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Manage Category</h1>

          <?php
          if(isset($_SESSION['add']))
          {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
          }
          ?>
          <br><br>
              <!-- Button to Add Admin -->
              <a href="add-category.php"><button type="button" class="btn btn-default waves-effect waves-light">Add Category</button></a>
    
              <br /><br/>

              <table class="tbl-full">
                <tr>
                        <th class="text-center">S.N.</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Featured</th>
                        <th class="text-center">Active</th>
                        <th class="text-center">Actions</th>
                </tr>

                  <?php
//                        Query Data from Database
                  $sql = "SELECT * FROM tbl_category";

//                  Execute query
                  $res = mysqli_query($conn, $sql);

//                  Count Rows
                  $count = mysqli_num_rows($res);

//                  Create Serial Number
                  $sn=1;

//                  Check apakah punya data dalam database atau tidak
                  if($count>0)
                  {
//                      Punya Data
//                      Tampilkan data
                      while($row=mysqli_fetch_assoc($res))
                      {
                          $id=$row['id'];
                          $title=$row['title'];
                          $image_name=$row['image_name'];
                          $featured=$row['featured'];
                          $active=$row['active'];

                          ?>
                          <tr>
                              <td class="text-center"><?php echo $sn++;?> </td>
                              <td class="text-center"><?php echo $title;?>></td>

                              <td class="text-center">

                                  <?php
                                        if ($image_name!="")
                                        {
//                                            DIsplay Image
                                            ?>
                                                <img src="<?php echo HOME; ?>images/category/<?php echo $image_name;?>" width="100px" >

                                            <?php
                                        }else
                                  {
//                                      Display Message
                                            echo "<div class='error'>Image Not Added.</div>";
                                  }
                                  ?>
                              </td>

                              <td class="text-center"><?php echo $featured;?></td>
                              <td class="text-center"><?php echo $active;?></td>
                              <td class="text-center">
                                  <a href="#" class="btn btn-default waves-teal btn-success">Update Category</a>
                                  <a href="#" class="btn btn-default waves-teal btn-danger">Delete Category</a>
                              </td>
                          </tr>

                          <?php
                      }
                  }else
                  {
//                      Tidak Punya data
//                      Display notif dalam label
                      ?>

                      <tr>
                          <td colspan="6"><div class="error">No Category Added.</div></td>
                      </tr>
                  <?php
                  }

                  ?>



              </table>

</div>

<?php include('partials/footer.php'); ?>
