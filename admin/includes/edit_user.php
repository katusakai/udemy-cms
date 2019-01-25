<?php
if(isset($_GET['u_id'])){                                    //gets current values to inputs
  $the_user_id = $_GET['u_id'];
  $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
  $select_user_by_id = mysqli_query($connection, $query);
  if(!$select_user_by_id){
    echo die("QUERY FAILED" . mysqli_error());
  } else {
    while($row = mysqli_fetch_array($select_user_by_id)){
      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];
    }


    if(isset($_POST['update_user'])){                       //updates values once submitted
      $user_firstname = $_POST['user_firstname'];
      $user_lastname = $_POST['user_lastname'];
      $user_role = $_POST['user_role'];
      $user_name =  $_POST['user_name'];
      $user_email = $_POST['user_email'];
      $user_password = $user_password;

      if(isset($_POST['user_password']) && $_POST['user_password'] != "" || isset($_POST['confirm_user_password']) && $_POST['confirm_user_password'] != "") {   //checks if user updates password
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
                          user_role = '{$user_role}',
                          user_name = '{$user_name}',
                          user_email = '{$user_email}',
                          user_password = '{$user_password}',
                          user_image = '{$user_image}'
                          WHERE user_id = {$the_user_id} ";
      $update_user = mysqli_query($connection, $update_user_query);
      confirm($update_user);


      if(function_exists('PasswordsNotMach')){
        PasswordsNotMach();
      } else {
        if($update_user){
          echo "<h3 class='text-success'>User was updated successfully</h3>";
        }
      }
    }
  }

  //function to check selected <select> option in 'user_role' column
  function SelectedUserRole($option){
    global $user_role;
    if($user_role == $option ){
      echo "selected";
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
    <label for="post_category">Select User Role</label>
    <select class="form-control" name="user_role">
      <option value="Subscriber" <?php SelectedUserRole('Subscriber') ?>>Subscriber</option>
      <option value="Admin" <?php SelectedUserRole('Admin') ?>>Admin</option>
    </select>
  </div>

  <div class="form-group">
    <label for="user_image">Post Image</label>
    <input class="form-control-file" type="file" name="user_image">
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
    <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
  </div>
</form>
