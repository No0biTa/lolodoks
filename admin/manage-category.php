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
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                </tr>

                <tr>
                        <td>1. </td>
                        <td>Dummy</td>
                        <td>Dummy</td>
                        <td>
                                <a href="#" class="btn btn-default waves-teal btn-success">Update Admin</a>        
                                <a href="#" class="btn btn-default waves-teal btn-danger">Delete Admin</a>
                        </td>
                </tr>

                <tr>
                        <td>2. </td>
                        <td>Dummy</td>
                        <td>Dummy</td>
                        <td>
                                <a href="#" class="btn btn-default waves-teal btn-success">Update Admin</a>        
                                <a href="#" class="btn btn-default waves-teal btn-danger">Delete Admin</a>
                        </td>
                </tr>

                <tr>
                        <td>3. </td>
                        <td>Dummy</td>
                        <td>Dummy</td>
                        <td>
                                <a href="#" class="btn btn-default waves-teal btn-success">Update Admin</a>        
                                <a href="#" class="btn btn-default waves-teal btn-danger">Delete Admin</a>
                        </td>
                </tr>
              </table>

</div>

<?php include('partials/footer.php'); ?>
