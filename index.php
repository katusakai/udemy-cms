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
//pagination PHP start
              $post_query_count = "SELECT * FROM posts";
              $find_post_count = mysqli_query($connection, $post_query_count );
              $count = mysqli_num_rows($find_post_count);
              $per_page = 2;
              $count = ceil($count / $per_page);

              if(isset($_GET['page'])){
                $page = mysqli_real_escape_string($connection, $_GET['page']);
              } else {
                $page = 1;
              }

              if($page =="" || $page <=1){
                $page_1 = 0;
              } else {
                $page_1 = ($page * $per_page) - $per_page;
              }

//Pagination PHP end

// counts published posts
              $query = "SELECT * FROM posts
                        WHERE post_status = 'published'";
              $count_published_posts = mysqli_num_rows(mysqli_query($connection, $query));
// shows posts only if they are published
              if($count_published_posts > 0){
                $query = "SELECT * FROM posts
                          WHERE post_status = 'published'
                          ORDER BY post_date DESC, post_id DESC
                          LIMIT {$page_1}, 5";
                $select_all_posts_query = mysqli_query($connection, $query);
                if(!$select_all_posts_query){
                  die("error". mysqli_error($connection));
                }
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
                      by <a href="author_posts.php?author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
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
<!-- Pagination start -->

<ul class="pager">

  <?php
  $previous = $page-1;
  $next = $page + 1;
  echo "<li class='pull-left'><a href='?page={$previous}'>Previous</a></li>";
  for($i = 1 ; $i <= $count ; $i++){    
    if($count >= 5 ){
      if($i !=1 && $i != $count && $i != $page && $i != $page -1 && $i != $page + 1) {
        
        if($i == 2 || $i == $count-1){
          echo "......"; 
        }                     
        continue;
      }
    } if($i == $page){
      echo "<li><a class='active_link' href='?page={$i}'>{$i}</a></li>";
    } else {
      echo "<li><a href='?page={$i}'>{$i}</a></li>";
    }
  }
  echo "<li class='pull-right'><a href='?page={$next}'>Next</a></li>";
   ?>
</ul>
<!-- Pagination end -->


<!-- Footer -->
<?php include 'includes/footer.php' ?>

