<?php
if(isset($_POST['create_user'])){
  $post_title = $_POST['title'];
  $post_category_id = $_POST['post_category'];
  $post_author = $_POST['author'];
  $post_status = $_POST['post_status'];

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  $post_tags = $_POST['post_tags'];
  $post_content = $_POST['post_content'];
  $post_date = date('d-m-y');

  move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "INSERT INTO posts (post_category_id, post_title, post_author,
  post_date, post_image, post_content, post_tags, post_status)
  VALUES ({$post_category_id}, '{$post_title}', '{$post_author}',
  now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

  $create_post_query = mysqli_query($connection, $query);
  if($create_post_query){
    echo "<h2>Post was created successfully</h2>";
  }

  confirm($create_post_query);
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
    <label for="post_category">Select Post Category</label>
    <select class="form-control" name="user_role" id="post_category">

  <?php
  $query = "SELECT * FROM users";
  $select_roles = mysqli_query($connection, $query);
  confirm($select_roles);
  while($row = mysqli_fetch_array($select_roles)){
    $user_id = $row['user_id'];
    $user_role = $row['cat_role'];
    echo "<option value='{$user_id}'>{$user_role}</option>";
  }

  ?>
    </select>
    </div>

  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input class="form-control-file" type="file" name="image">
    </div> -->

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
