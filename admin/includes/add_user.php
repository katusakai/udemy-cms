<?php
if(isset($_POST['create_user'])){
  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_role = $_POST['user_role'];

  $user_image = $_FILES['user_image']['name'];
  $user_image_temp = $_FILES['user_image']['tmp_name'];
  move_uploaded_file($user_image_temp, "../images/users_images/$user_image");

  $query = "INSERT INTO users (user_name, user_password, user_firstname,
  user_lastname, user_email, user_role, user_image)
  VALUES ('{$user_name}', '{$user_password}', '{$user_firstname}',
  '{$user_lastname}', '{$user_email}', '{$user_role}', '{$user_image}')";

  $create_user_query = mysqli_query($connection, $query);
  if($create_user_query){
    echo "<h2>User was created successfully</h2>";
  }

  confirm($create_user_query);
}


// $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
// $select_categories_id = mysqli_query($connection, $query);
// confirm($select_categories_id);
// while($row = mysqli_fetch_assoc($select_categories_id)){
//   $cat_title = $row['cat_title'];
// }



 ?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
    </div>
  <div class="form-group">
    <label for="post_status">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>
  <div class="form-group">
    <label for="post_category">Select User Role</label>
    <select class="form-control" name="user_role" id="post_category">
      <option value="Subscriber">Select Options</option>
      <option value="Subscriber">Subscriber</option>
      <option value="Admin">Admin</option>
    </select>
    </div>

  <div class="form-group">
    <label for="user_image">Post Image</label>
    <input class="form-control-file" type="file" name="user_image">
    </div>

  <div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" name="user_name">
  </div>
  <div class="form-group">
    <label for="post_tags">Email</label>
    <input type="text" class="form-control" name="user_email">
  </div>
  <div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Create user">
  </div>
</form>
