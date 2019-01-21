<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>


  <?php
  $query = "SELECT * FROM posts";
  $select_posts = mysqli_query($connection, $query);
  if(!$select_posts){
  echo die("QUERY FAILED" . mysqli_error());
  } else {
  while($row = mysqli_fetch_array($select_posts)){
    $post_id = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];

    //Counts comments in that post_status
              $query = "SELECT comment_id FROM comments
                        WHERE comment_post_id = {$post_id}";
              $comment_count_query = mysqli_query($connection, $query);
              if(!$comment_count_query){
                die("Counting comments failed" . mysqli_error($connection));
              } else {
              $comment_count = mysqli_num_rows($comment_count_query);
              }
    //Adds comment count value to database table 'posts' column 'post_coment_count'
              $query = "UPDATE posts
                        SET post_comment_count = $comment_count
                        WHERE post_id = {$post_id}";
              $update_post_count = mysqli_query($connection, $query);
              if(!$update_post_count){
                die('Updating post count failed' . mysqli_error($connection));
              }


    $post_status = $row['post_status'];

    echo "<tr>
      <td>{$post_id}</td>
      <td>{$post_author}</td>
      <td>{$post_title}</td>";
//Write Category name from 'Categories' table according to category_id from 'posts' table
    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
    $select_categories_id = mysqli_query($connection, $query);
    confirm($select_categories_id);
    while($row = mysqli_fetch_assoc($select_categories_id)){
      $cat_title = $row['cat_title'];
      echo "<td>{$cat_title}</td>";
    }

    echo "
      <td>{$post_status}</td>
      <td><img width='150' class='img-responsive' src='../images/{$post_image}' alt='Image of {$post_title}'></td>
      <td>{$post_tags}</td>
      <td>$post_comment_count</td>
      <td>$post_date</td>
      <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
      <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
      </tr>";
    }
  }
  ?>
    </tbody>
  </table>
</div>


<?php
if(isset($_GET['delete'])){
deletePosts();
}





 ?>
