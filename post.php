<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php
              if(isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
                $select_all_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_array($select_all_posts_query)){
                  $post_title = $row['post_title'];
                  $post_author = $row['post_author'];
                  $post_date = $row['post_date'];
                  $post_image = $row['post_image'];
                  $post_content = $row['post_content'];
                  $post_id = $row['post_id'];

                  ?>

                  <h1 class="page-header">
                      Page Heading
                      <small>Secondary Text</small>
                  </h1>

                  <!-- First Blog Post -->
                  <h2>
                      <a href=""><?php echo $post_title ?></a>
                  </h2>
                  <p class="lead">
                      by <a href="index.php"><?php echo $post_author ?></a>
                  </p>
                  <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                  <hr>
                  <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                  <hr>
                  <p><?php echo $post_content ?></p>
                  <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                  <hr>


       <?php    }
               } else {
                   header("Location: index.php");
                 } ?>

       <!-- Blog Comments -->

        <?php
          $the_post_id = $_GET['p_id'];
          if(isset($_POST['create_comment'])){
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];
            $comment_status = "approved";     //default
            $comment_date = date('d-m-y');
//Adds new comment
            $query = "INSERT INTO comments
              (comment_post_id, comment_author, comment_email,
              comment_content, comment_status, comment_date)
              VALUES ({$the_post_id}, '{$comment_author}', '{$comment_email}',
              '{$comment_content}', '{$comment_status}', now() )";
            $insert_comment = mysqli_query($connection, $query);
            header("Location: #comments");
            if(!$insert_comment){
              die("Inserting comment failed" . mysqli_error($connection));
            }
          }

//Counts comments in that post_status
          $query = "SELECT comment_id FROM comments
                    WHERE comment_post_id = {$the_post_id}";
          $comment_count_query = mysqli_query($connection, $query);
          if(!$comment_count_query){
            die("Counting comments failed" . mysqli_error($connection));
          } else {
          $comment_count = mysqli_num_rows($comment_count_query);
          }
//Adds comment count value to database table 'posts' column 'post_coment_count'
          $query = "UPDATE posts
                    SET post_comment_count = $comment_count
                    WHERE post_id = {$the_post_id}";
          $update_post_count = mysqli_query($connection, $query);
          if(!$update_post_count){
            die('Updating post count failed' . mysqli_error($connection));
          }


         ?>


       <!-- Comments Form -->
       <div class="well" id="comments">
           <h4>Leave a Comment:</h4>
           <form action="" method="post" role="form">
             <div class="form-group">
               <label for="comment_author">Your name</label>
               <input type="text" class="form-control" name="comment_author">
             </div>
             <div class="form-group">
               <label for="comment_email">Your email</label>
               <input type="text" class="form-control" name="comment_email">
             </div>
               <div class="form-group">
                   <label for="comment_content">Comment here</label>
                   <textarea class="form-control" rows="3" name="comment_content"></textarea>
               </div>
               <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
           </form>
       </div>
       <hr>


<?php
$comments_query = "SELECT * FROM comments
                  WHERE comment_post_id = {$the_post_id}
                  AND comment_status = 'approved'
                  ORDER BY comment_id DESC";
$show_comments_query = mysqli_query($connection, $comments_query);
if(!$show_comments_query){
  die("Error showing comments" . mysqli_error($connection));
} else {
  while($row = mysqli_fetch_array($show_comments_query)){
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = $row['comment_content'];
    $comment_date = $row['comment_date'];
    $comment_id = $row['comment_id'];
?>
       <!-- Posted Comments -->
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a style="text-decoration:none" href="mailto:<?php echo $comment_email ?>"><?php echo $comment_author ?></a>
            <small><?php echo $comment_date ?></small>
        </h4>
        <?php echo $comment_content ?>
    </div>
</div>

<?php
  }
}
 ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>
<!-- Footer -->
<?php include 'includes/footer.php' ?>
