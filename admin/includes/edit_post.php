<?php
if(isset($_GET['p_id'])){                                    //gets current values to inputs
  $the_post_id = $_GET['p_id'];
  $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
  $select_posts_by_id = mysqli_query($connection, $query);
  if(!$select_posts_by_id){
    echo die("QUERY FAILED" . mysqli_error());
  } else {
    while($row = mysqli_fetch_array($select_posts_by_id)){
      $post_id = $row['post_id'];
      $post_category_id = $row['post_category_id'];
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_tags = $row['post_tags'];
      $post_comment_count = $row['post_comment_count'];
      $post_status = $row['post_status'];
    }


    if(isset($_POST['update_post'])){                       //updates values once submitted
      $post_author = $_POST['post_author'];
      $post_title = $_POST['post_title'];
      $post_category_id = $_POST['post_category'];
      $post_status =  $_POST['post_status'];
      $post_content = $_POST['post_content'];
      $post_tags = $_POST['post_tags'];

      if($_FILES['image']['name'] != NULL || $_FILES['image']['name'] != ""){      //done differently than Teacher did
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/$post_image");
      }

      $update_post_query ="UPDATE posts SET
                          post_title = '{$post_title}',
                          post_category_id = '{$post_category_id}',
                          post_date = now(),
                          post_author = '{$post_author}',
                          post_status = '{$post_status}',
                          post_tags = '{$post_tags}',
                          post_content = '{$post_content}',
                          post_image = '{$post_image}'
                          WHERE post_id = {$the_post_id} ";
      $update_post = mysqli_query($connection,$update_post_query);
      confirm($update_post);
      if($update_post){
        echo "<p class='bg-success'>Post was updated successfully. <a href='../post.php?p_id={$post_id}'>View post</a> or <a href='posts.php'> Edit More Posts</a></p><br>";
      }
    }

  }

  //function to check selected <select> option in Select Post Category
  function ifPostCategorySelected($option){
    global $post_category_id;
    if($post_category_id == $option ){
      echo "selected";
    }
  }

  //function to check selected <select> option in Post Status
  function whichPostStatusSelected($option){
    global $post_status;
    if($post_status == $option ){
      echo "selected";
    }

  }
}
 ?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title ?>" type="text" class="form-control" name="post_title">
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
  echo "<option value='{$cat_id}' ";
  ifPostCategorySelected($cat_id);                 //echos 'selected' if cat_id matches
  echo ">{$cat_title}</option>";
}

 ?>

    </select>
    </div>
  <div class="form-group">
    <label for="title">Post Author</label>
    <input value="<?php echo $post_author ?>" type="text" class="form-control" name="post_author">
    </div>
  <div class="form-group">
    <label for="post_status">Post Status</label>
    <select class="form-control" name="post_status" id="post_category">
      <option <?php whichPostStatusSelected('Published') ?> value="Published">Published</option>
      <option <?php whichPostStatusSelected('UnPublished') ?> value="UnPublished">UnPublished</option>
    </select>

  </div>
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <img width='400' class='img-responsive' src="../images/<?php echo $post_image ?>" alt="">
    <label for="change_image">Change Image</label>
    <input class="form-control-file" type="file" name="image">
    </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content ?>
    </textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_post" value="update">
  </div>
</form>



<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
