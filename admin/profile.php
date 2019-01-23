<?php include 'includes/admin_header.php' ?>
<?php
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];

  $query = "SELECT * FROM users WHERE user_name = '{$username}'";
  $select_user_profile_query = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_array($select_user_profile_query)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
  }
}
 ?>


    <div id="wrapper">

        <!-- Navigation -->
<?php include 'includes/admin_navigation.php' ?>>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                  <!-- Form to add new category -->
                    <div class="col-lg-12">
                      <h1 class="page-header">
                          Welcome to admin
                          <small>Author</small>
                      </h1>

<?php
if(isset($_POST['update_profile'])){                       //updates values once submitted
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_name =  $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $user_password;

  if(isset($_POST['user_password']) || isset($_POST['confirm_user_password'])){   //checks if user updates password
    if($_POST['user_password'] == $_POST['confirm_user_password']){
      $user_password = $_POST['user_password'];
    } else {
//function is only created if there are errors with password.
      function PasswordsNotMach(){
        echo "<h3 class='text-danger'>Your passwords do not match</h3>";
      }
    }
  }


  if($_FILES['user_image']['name'] != NULL || $_FILES['user_image']['name'] != ""){      //done differently than Teacher did
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/users_images/$user_image");
  } else {
    $user_image = $user_image;
  }

  $update_user_query ="UPDATE users SET
                      user_firstname = '{$user_firstname}',
                      user_lastname = '{$user_lastname}',
                      user_name = '{$user_name}',
                      user_email = '{$user_email}',
                      user_password = '{$user_password}',
                      user_image = '{$user_image}'
                      WHERE user_name = '{$username}' ";
  $update_user = mysqli_query($connection, $update_user_query);
  confirm($update_user);


  if(function_exists('PasswordsNotMach')){
    PasswordsNotMach();
  } else {
    if($update_user){
      echo "<h3 class='text-success'>Profile was updated successfully</h3>";
    }
  }
}
 ?>

                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="title">Firstname</label>
                          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                          </div>
                        <div class="form-group">
                          <label for="post_status">Lastname</label>
                          <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                        </div>
                        <div class="form-group">
                          <label for="post_category">User Role</label>
                          <label class="form-control"><?php echo $user_role ?></label>
                        </div>

                        <div class="form-group">
                              <div><label for="user_image">User Image</label></div>
                              <div><img width="150px" src="../images/users_images/<?php echo $user_image ?>"></div>
                              <br>
                              <div><label for="user_image">Post New Image</label></div>
                              <div><input class="form-control-file" type="file" name="user_image"></div>
                          </div>

                        <div class="form-group">
                          <label for="post_tags">Username</label>
                          <input type="text" class="form-control" name="user_name" value="<?php echo $user_name ?>">
                        </div>
                        <div class="form-group">
                          <label for="post_tags">Email</label>
                          <input type="text" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                        </div>

                        <div class="form-group">
                          <label for="post_tags">Create new Password</label>
                          <input type="password" class="form-control" name="user_password" placeholder="New password">
                          <input type="password" class="form-control" name="confirm_user_password" placeholder="Confirm new password">
                        </div>
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>
                      </form>





                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    </div>


    <!-- /#wrapper -->

<?php include 'includes/admin_footer.php' ?>
