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
// counts published posts
              $query = "SELECT * FROM posts
                        WHERE post_status = 'published'";
              $count_published_posts = mysqli_num_rows(mysqli_query($connection, $query));
// shows posts only if they are published
              if($count_published_posts > 0){
                $query = "SELECT * FROM posts
                          WHERE post_status = 'published'
                          ORDER BY post_date, post_id DESC";
                $select_all_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_array($select_all_posts_query)){
                  $post_id = $row['post_id'];
                  $post_title = $row['post_title'];
                  $post_author = $row['post_author'];
                  $post_date = $row['post_date'];
                  $post_image = $row['post_image'];
                  $post_content = substr($row['post_content'], 0, 500);
                  $post_status = $row['post_status'];
                  ?>

                  <h1 class="page-header">
                      Page Heading
                      <small>Secondary Text</small>
                  </h1>
                  <!-- First Blog Post -->
                  <h2>
                      <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                  </h2>
                  <p class="lead">
                      by <a href="index.php"><?php echo $post_author ?></a>
                  </p>
                  <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                  <hr>
                  <a href="post.php?p_id=<?php echo $post_id ?>">
                  <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                  </a>
                  <hr>
                  <p><?php echo $post_content ?></p>
                  <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                  <hr>

                  <?php
                }
              } else {
                echo "<h1 class='page-header'>There are no published posts</h1>";
              }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>
<!-- Footer -->
<?php include 'includes/footer.php' ?>
