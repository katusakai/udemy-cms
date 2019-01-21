<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Aprrove</th>
        <th>Unaprrove</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>


  <?php
  $query = "SELECT * FROM comments";
  $select_comments = mysqli_query($connection, $query);
  if(!$select_comments){
  echo die("QUERY FAILED" . mysqli_error());
  } else {
  while($row = mysqli_fetch_array($select_comments)){
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = $row['comment_content'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>
      <td>{$comment_id}</td>
      <td>{$comment_author}</td>
      <td>{$comment_content}</td>
      <td><a href='mailo:{$comment_email}'>{$comment_email}</a></td>
      <td>{$comment_status}</td>";

      //Write Posts name from 'Posts' table according to comment_post_id from 'comments' table
      $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
      $select_post_id_query = mysqli_query($connection, $query);
      confirm($select_post_id_query);
      while($row = mysqli_fetch_assoc($select_post_id_query)){
        $post_title = $row['post_title'];
        $post_id = $row['post_id'];
        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
      }

    echo "
      <td>{$comment_date}</td>
      <td><a href='comments.php?approve_comment={$comment_id}'>Approve</a></td>
      <td><a href='comments.php?unapprove_comment={$comment_id}'>Unapprove</a></td>
      <td><a href='comments.php?delete_comment={$comment_id}'>Delete</a></td>
      </tr>";
    }
  }
  ?>
    </tbody>
  </table>
</div>


<?php
if(isset($_GET['delete_comment'])){
deleteComment();
}

if(isset($_GET['approve_comment'])){
approveComment();
}

if(isset($_GET['unapprove_comment'])){
unapproveComment();
}



 ?>
