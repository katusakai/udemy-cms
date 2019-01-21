<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
  $query = "SHOW TABLES";
  $showTables = mysqli_query($connection, $query);
  if(!$showTables) {
    die();
  }
  function IsInTable($table_value){
    global $showTables;
    while($row = mysqli_fetch_array($showTables)){
      $table_name= $row['Tables_in_cms'];
      if($table_name == $table_value){
        return TRUE;
      }

    }
  }




  if(isset($_POST['create_categories'])){
    $query = "CREATE TABLE categories (
              cat_id int(3) NOT NULL AUTO_INCREMENT,
              cat_title varchar(255) NOT NULL,
              PRIMARY KEY (cat_id));";
    $create_table = mysqli_query($connection, $query);
    if(!$create_table){
      die("creating table failed" . mysqli_error($connection));
    } else {
      header("Location: install.php");
    }
  }

  if(isset($_POST['create_posts'])){
    $query = "CREATE TABLE posts (
              post_id int(3) NOT NULL AUTO_INCREMENT,
              post_category_id int(3) NOT NULL,
              post_title varchar(255) NOT NULL,
              post_author varchar(255) NOT NULL,
              post_date date NOT NULL,
              post_image text NOT NULL,
              post_content text NOT NULL,
              post_tags varchar(255) NOT NULL,
              post_comment_count int(11) NOT NULL,
              post_status	varchar(255) NOT NULL,
              PRIMARY KEY (post_id));";
    $create_table = mysqli_query($connection, $query);
    if(!$create_table){
      die("creating table failed" . mysqli_error($connection));
    } else {
      header("Location: install.php");
    }
  }
  if(isset($_POST['create_comments'])){
    $query = "CREATE TABLE comments (
              comment_id int(3) NOT NULL AUTO_INCREMENT,
              comment_post_id int(3) NOT NULL,
              comment_author varchar(255) NOT NULL,
              comment_email varchar(255) NOT NULL,
              comment_content text NOT NULL,
              comment_status varchar(255) NOT NULL,
              comment_date date NOT NULL,
              PRIMARY KEY (comment_id));";
    $create_table = mysqli_query($connection, $query);
    if(!$create_table){
      die("creating table failed" . mysqli_error($connection));
    } else {
      header("Location: install.php");
    }
  }
 ?>



<h3>Press buttons to create tables</h3><br>
<?php if(!IsInTable('categories')){ ?>
<div class="form-group">
  <form action="" method="post">
    <label class="form-control" for="create_categories">Create CATEGORIES table</label>
    <input class="form-control" type="submit" name="create_categories" value="Create">
  </form>
</div>
<hr>
<?php } ?>

<?php if(!IsInTable('posts')){ ?>
<div class="form-group">
  <form action="" method="post">
    <label class="form-control" for="create_posts">Create POSTS table</label>
    <input class="form-control" type="submit" name="create_posts" value="Create">
  </form>
</div>
<hr>
<?php } ?>

<?php if(!IsInTable('comments')){ ?>
<div class="form-group">
  <form action="" method="post">
    <label class="form-control" for="create_comments">Create COMMENTS table</label>
    <input class="form-control" type="submit" name="create_comments" value="Create">
  </form>
</div>
<hr>
<?php } ?>
<!-- Footer -->
<?php include 'includes/footer.php' ?>
