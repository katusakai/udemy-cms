<?php
if(isset($_POST['create_post'])){
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
    $the_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post was created successfully. <a href='../post.php?p_id={$the_post_id}'>View this post</a> or <a href='posts.php'> Edit Posts</a></p><br>";
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
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>


  <div class="form-group">
    <label for="post_category">Select Post Category</label>
    <select class="form-control" name="post_category" id="post_category">

  <?php
  $list_categories = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $list_categories);
  confirm($select_categories);
  while($row = mysqli_fetch_array($select_categories)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<option value='{$cat_id}''>{$cat_title}</option>";
  }

  ?>

    </select>
    </div>



  <div class="form-group">
    <label for="title">Post Author</label>
    <input type="text" class="form-control" name="author">
    </div>
  <div class="form-group">
    <label for="post_status">Post Status</label>
    <select class="form-control" name="post_status" id="">
      <option value="UnPublished">Select Option</option>
      <option value="Published">Published</option>
      <option value="UnPublished">Unpublished</option>
    </select>
    <!-- <input type="text" class="form-control" name="post_status"> -->
  </div>
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input class="form-control-file" type="file" name="image">
    </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
    </textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
  </div>
</form>



<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
